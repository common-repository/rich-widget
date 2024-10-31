<?php
/*
Plugin Name: Rich Widget
Plugin URI: http://www.theriddlebrothers.com/our-services/wordpress-plugins/rich-widget
Description: Add a WYSIWYG-enabled widget to a sidebar location. Includes title, sub-title and image uploads.
Author: Joshua Riddle
Version: 0.2.4
Stable tag: 0.2.4
Author URI: http://www.theriddlebrothers.com/
*/

/*  Copyright 2009  Joshua Riddle  (email : josh@theriddlebrothers.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
 * If you want to change the links within the FCKEditor, you can edit the RichWidget toolbar in fckeditor/fckconfig.js (line 122)
 */
require('config.php');
		
/**
 * Primary widget for plugin
 */
class RB_RichWidget extends WP_Widget {
	
	function RB_RichWidget() {		
		$widget_ops = array('classname' 	=> 	'widget_rbrichwidget', 
							'description'	=> 	'Use a WYSIWYG editor to add HTML content to your sidebars.' );
		$this->WP_Widget('rbrichwidget', 'Rich Text Editor', $widget_ops);
	}
 
 	/**
	 * Display widget instance
	 */
	function widget($args, $instance) {		
		extract($args, EXTR_SKIP);
		echo $before_widget;
		
		$rbrw_title = empty($instance['rbrw_title']) ? '' : apply_filters('rbrw_title', $instance['rbrw_title']);
		if ( !empty( $rbrw_title ) ) { echo $before_title . $rbrw_title . $after_title; };
		
		
		$rbrw_subtitle = empty($instance['rbrw_subtitle']) ? '' : apply_filters('rbrw_subtitle', $instance['rbrw_subtitle']);
		
		$rbrw_content = empty($instance['rbrw_content']) ? '' : apply_filters('rbrw_content', $instance['rbrw_content']);
		
		if ( !empty( $rbrw_subtitle ) )  echo '<h3>' . $rbrw_subtitle . '</h3>';
		
		echo $rbrw_content;
		
		echo $after_widget;
	}
 
 	/**
	 * Update widget instance
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		//var_dump($_POST);die();
		$instance['rbrw_title'] = strip_tags($new_instance['rbrw_title']);
		$instance['rbrw_subtitle'] = strip_tags($new_instance['rbrw_subtitle']);
		$instance['rbrw_content'] = $new_instance['rbrw_content'];
		
		return $instance;
	}
 
 	/**
	 * Display admin widget form
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'rbrw_title' => '', 'rbrw_subtitle' => '', 'rbrw_content' => ''));
		$rbrw_title = strip_tags($instance['rbrw_title']);
		$rbrw_subtitle = strip_tags($instance['rbrw_subtitle']);
		$rbrw_content = $instance['rbrw_content'];
		?>
        <p>
        	<label for="<?php echo $this->get_field_id('rbrw_title'); ?>">Title:
            	<input class="widefat" id="<?php echo $this->get_field_id('rbrw_title'); ?>" name="<?php echo $this->get_field_name('rbrw_title'); ?>" type="text" value="<?php echo attribute_escape($rbrw_title); ?>" />
           	</label>
      	</p>
        
        <p>
        	<label for="<?php echo $this->get_field_id('rbrw_subtitle'); ?>">Subtitle:
            	<input class="widefat" id="<?php echo $this->get_field_id('rbrw_subtitle'); ?>" name="<?php echo $this->get_field_name('rbrw_subtitle'); ?>" type="text" value="<?php echo attribute_escape($rbrw_subtitle); ?>" />
           	</label>
      	</p>
        
        <p>
            <label for="<?php echo $this->get_field_id('rbrw_content'); ?>">Content:
                
                <div style="display:none;">
               		<textarea class="widefat fckEditor" style="height:150px;" id="<?php echo $this->get_field_id('rbrw_content'); ?>" name="<?php echo $this->get_field_name('rbrw_content'); ?>"><?php echo attribute_escape($rbrw_content); ?></textarea>
                </div>
                
                <div id="<?php echo $this->get_field_id('rbrw_content'); ?>_preview" style="border:1px solid #e3e3e3; position:relative; overflow:auto; width:100%; height:200px;">
                	<?php echo $rbrw_content; ?>
                </div>
            </label>
            <a href="#" onclick="return RBRichWidget.openRichEditor('<?php echo $this->get_field_id('rbrw_content'); ?>');">Open Rich Text Editor</a>
        </p>          
         
	<?php
	}
	
	/**
	 * Add necessary stylesheets and scripts for widget functionality
	 */
	function printScripts() {
		
		// @bug - enqueue style not working below? echo stylesheet directly.
		echo '<link href="' . RB_RICHWIDGET_BASEURL . '/thickbox/thickbox.css" rel="stylesheet" type="text/css" />';
		
		// load up scripts
		wp_enqueue_script('thickbox_custom', RB_RICHWIDGET_BASEURL . '/thickbox/thickbox.js');
		wp_enqueue_script('fckeditor', RB_RICHWIDGET_BASEURL . '/fckeditor/fckeditor.js');
		wp_enqueue_script('rbrichwidget_init', RB_RICHWIDGET_BASEURL . '/init.js');
		
		// create instance of widget editor settings
		echo "<script type=\"text/javascript\">
				var RBRichWidget = {
					editorUrl : '" . RB_RICHWIDGET_BASEURL . "/editor.php?KeepThis=true&width=" . RB_RICHWIDGET_EDITOR_WIDTH . "&height=" . RB_RICHWIDGET_EDITOR_HEIGHT . "'
				}
				</script>";
	}
}

function RB_RichWidgetInit() {
	register_widget('RB_RichWidget');
}

/***************************************************
 * ACTIONS
 ***************************************************/
add_action('widgets_init', 'RB_RichWidgetInit');
	
if (is_admin()) {
	add_action('admin_print_scripts-widgets.php', array('RB_RichWidget', 'printScripts'));
}