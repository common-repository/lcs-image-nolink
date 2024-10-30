=== LCS Image Nolink ===
Plugin URI: http://www.latcomsystems.com/index.cfm?SheetIndex=wp_lcs_image_nolink
Contributors: latcomsystems
Tags: prevent,remove,link,links,image,picture,automatic,filter,self,selves,themselves,default
Requires at least: 3.0
Tested up to: 5.2
Stable tag: 1.3
License: GPLv2
License URI: http://www.gnu.org/licenses/agpl-2.0.html

New images inserted into posts will have no links by default.  Existing self-links on all images are removed before the post content is shown.

== Description ==
By default, all images in WordPress posts link to themselves.  When a user sees a link, they click on it, and the image shows up by itself for no apparent reason.  This has several drawbacks:

- This is bad for SEO because these links are dead ends.
- User experience is diminished due to wasted clicks.
- Potential for higher bounce rate since no easy method is provided to get back to the site except for the browser "Back" button.

This plugin uses a standards compliant HTML DOM parser (http://sourceforge.net/projects/simplehtmldom/). It does not use regular expressions (regex) to accomplish link removal and therefore will not break your site pages or mess up your theme.

== Installation ==
1. Download the latest zip file and extract the `lcs-image-nolink` directory.
2. Upload this directory inside your `/wp-content/plugins/` directory.
3. Activate 'LCS Image Nolink' on the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==
= Why does WordPress create image self-links? =

This is the default WordPress functionality and cannot be turned off using regular settings.

= Will your plugin break some pages on my site? =

No.  This plugin uses an HTML DOM parser and is fully standards compliant.  A few other plugins use regular expressions which tend to remove too much HTML and mess page display in many cases.

= What about legitimate links for images? =

As long as the link doesn't point to the image itself, or any of the WordPress auto-resized variations of itself, the link will work normally.

= Are there any options or settings for this plugin? =

No.  This plugin is fully automatic.  Just activate, and enjoy immediate results.

== Changelog ==

= 1.3 =
Prevent PHP errors if DOM parser does not return an object.

= 1.2 =
Prevent default minification which was occasionally affecting some javascript code.

= 1.1 =
Minor wording change in description.

= 1.0 =
Original stable version.

== Support ==
* [sysdev@latcomsystems.com](mailto:sysdev@latcomsystems.com)