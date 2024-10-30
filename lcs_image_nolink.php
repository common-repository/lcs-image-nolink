<?php
/*
Plugin Name: LCS Image Nolink
Plugin URI: http://www.latcomsystems.com/index.cfm?SheetIndex=wp_lcs_image_nolink
Description: Stops images from linking to themselves and disables existing image self-links.
Version: 1.3
Author: LatCom Systems
Author URI: http://www.latcomsystems.com/
License: GPLv2
Licence URI: http://www.gnu.org/licenses/gpl-2.0.html
Copyright 2016 LatCom Systems
*/

//************** Save current default link option **************
register_activation_hook(__FILE__, 'lcs_image_nolink_activation');

function lcs_image_nolink_activation() {
	update_option('lcs_saved_image_default_link_type', get_option( 'image_default_link_type' ));
}

//************** Restore original default link option **************
register_deactivation_hook(__FILE__, 'lcs_image_nolink_deactivation');

function lcs_image_nolink_deactivation() {
	update_option('image_default_link_type', get_option( 'lcs_saved_image_default_link_type' ));
}

//************** Remove existing links from content **************
add_filter( 'the_content', 'lcs_attachment_image_link_remove_filter' ); 

function lcs_attachment_image_link_remove_filter( $content ) { 
	if (!function_exists('str_get_html')) :
		require_once('simple_html_dom.php');
	endif;
	$html = str_get_html($content, true, true, DEFAULT_TARGET_CHARSET, false);
	if ($html) :
		foreach($html->find('a') as $e) :
			if (!empty($e->href) && $e->find('img')) :
				$ei = $e->find('img', 0);
				if (trim($e->innertext) == trim($ei->outertext)) :
					$len = strrpos($e->href, '.');
					$ext = strtolower(substr($e->href,$len + 1));
					$ar_valid_images = array('bmp', 'gif', 'png', 'jpg', 'jpeg');
					if ($len > 0 && in_array($ext, $ar_valid_images, true)) :
						$src_h = substr($e->href, 0, $len);
						$src_i = substr($ei->src, 0, $len);
						$src_d = substr($ei->dsrc, 0, $len);
						if ($src_h == $src_i || $src_h == $src_d) :
							$e->outertext = $e->innertext;
						endif;
					endif;
				endif;
			endif;
		endforeach;
		$content = $html;
		$content .= '';
		$html->clear();
		unset($html);
	endif;
	return $content;
}

//****************** Prevent new images from becoming links ****************
add_action('admin_init', 'lcs_imagelink_setup', 10);

function lcs_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('lcs_saved_image_default_link_type', $image_set);
		update_option('image_default_link_type', 'none');
	}
}

?>