CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others', groups: [ 'others' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	config.height=500;
	config.contentsCss = '../CSS/editor.css';
	config.removeButtons = 'Underline,Subscript,Superscript,Cut,Copy,Paste,PasteText,PasteFromWord,Scayt,Link,Unlink,Anchor,Image,Table,HorizontalRule,SpecialChar,Source,Bold,Italic,Strike,RemoveFormat,NumberedList,BulletedList,Outdent,Indent,Blockquote,Format,Styles,About';
};