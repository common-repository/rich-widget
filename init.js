/**
 * Set textarea to content of rich editor
 */
RBRichWidget.setBlockContent = function(textBoxID) {
	var newValue = jQuery('#rbrichwidget-editor-contents').val();
	jQuery('#' + textBoxID).val(newValue);
	jQuery('#' + textBoxID + '_preview').html(newValue);
	tb_remove();
	return false;
}

/**
 * Display rich editor
 */
RBRichWidget.openRichEditor = function(textBoxID) {	
	var currentEditor = jQuery('#current-editor-id');
	if (currentEditor.get(0) == null) {
		var el = document.createElement("input");
		el.type = 'hidden';
		el.id = 'current-editor-id';
		jQuery('body').append(el);
		currentEditor = jQuery(el);
	}
	
	currentEditor.val(textBoxID);
	
	var contents = jQuery('#' + textBoxID).val();
	
	var url = RBRichWidget.editorUrl;
	tb_show("Content Editor", url);
	
	// Close button
	jQuery('#TB_closeWindowButton').unbind('click');
	jQuery('#TB_closeWindowButton').click(function() {
		setTimeout('RBRichWidget.setBlockContent("' + textBoxID + '");', 200);
		return false;
	});
	
	// Overlay click
	jQuery('#TB_overlay').unbind('click');
	jQuery('#TB_overlay').click(function() {
		setTimeout('RBRichWidget.setBlockContent("' + textBoxID + '");', 200);
		return false;
	});
	
	
	return false;
}