<?php
/**
 * @file
 * Define some basic settings that will be used throughout the plugin.
 */
define('RB_RICHWIDGET_SITEURL', get_bloginfo('wpurl'));
define('RB_RICHWIDGET_BASEURL', RB_RICHWIDGET_SITEURL . '/wp-content/plugins/rich-widget');
define('RB_RICHWIDGET_FILEPATH', realpath(dirname(__FILE__) . '/../../uploads/rich-widget') . '/');
define('RB_RICHWIDGET_EDITOR_HEIGHT', '500');
define('RB_RICHWIDGET_EDITOR_WIDTH', '700');
?>