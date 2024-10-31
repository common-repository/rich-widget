<?php
/**
 * @file
 * Display rich text editor (to be displayed within thickbox window
 */
require_once('../../../wp-config.php');
require('config.php');
?>

<input type="hidden" value="" id="rbrichwidget-editor-contents" />
<textarea id="editor" name="editor"></textarea>
<script type="text/javascript">
	var oFCKeditor = new FCKeditor( 'editor' ) ;
	oFCKeditor.BasePath = '<?php echo RB_RICHWIDGET_BASEURL; ?>/fckeditor/' ;	// '/fckeditor/' is the default value.
	oFCKeditor.ToolbarSet = 'RBRichWidget';
	oFCKeditor.Height = <?php echo intval(RB_RICHWIDGET_EDITOR_HEIGHT) - 10; ?>;
	oFCKeditor.Width = <?php echo RB_RICHWIDGET_EDITOR_WIDTH; ?>;
	oFCKeditor.ReplaceTextarea();
	
	/**
	 * Save contents of editor to widget textbox
	 */
	function doSave() {   
		var instance = FCKeditorAPI.GetInstance('editor');
		var editorValue = instance.GetHTML();
		jQuery('#rbrichwidget-editor-contents').val(editorValue);
	}
	
	/**
	 * When editor has loaded, set editor contents to existing value of widget content
	 */
	function FCKeditor_OnComplete( editorInstance ) {   
		// load default content
		var currentTextBoxID =  jQuery('#current-editor-id').val();
		var oldValue = jQuery('#' + currentTextBoxID).val();
		editorInstance.SetHTML(oldValue);
		editorInstance.Events.AttachEvent('OnBlur', doSave);
		jQuery('#rbrichwidget-editor-contents').val(oldValue);
	}
</script>