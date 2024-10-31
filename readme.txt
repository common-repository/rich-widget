=== Rich Widget ===
Contributors: jkriddle 
Tags: wysiwyg, rich text, fckeditor
Requires at least: 2.7
Tested up to: 2.9
Version: 0.2.4
Stable tag: 0.2.4
	
A widget that allows you to enter content via a WYSIWYG editor (FCKEditor).

== Description ==

This plugin creates a "Rich Text Editor" widget that allows you to edit sidebar content via a rich text editor (FCKEditor). The editor is displayed in a DHTML window so you are not limited to a small space.

Our main purpose for this plugin was to create an intuitive interface for clients that do not know HTML, and are used to a WYSIWYG interface. it would have been nice to include the standard WordPress editor, but we had some technical difficulties and opted for the still-free and open-source FCKEditor.

Requires PHP5 and is not tested on Windows.
	
== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page. 

You will also need to create a folder /wp-content/uploads/rich-widget/ to be used for image uploading in the editor, and give it write permissions. Otherwise you will receive a JavaScript alert when trying to upload an image or file.

== Screenshots ==
1. Rich editor interface when opened.

== Changelog ==

= 0.2.3 =

Bug fix for WP installs not under site root (i.e. www.mydomain.com/wordpress/wp-admin)

= 0.2.2 = 

Replaced textarea with preview html so you can see your edits before saving them.

= 0.2.1 = 
Minor bug fixes.

= 0.2 =
Updated configuration file so installation is one-click (no need to modify any files).