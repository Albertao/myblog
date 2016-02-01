/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.language = 'zh-cn';
    config.toolbarGroups = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        '/',
        { name: 'insert', groups: [ 'insert' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] }
    ];

    config.removeButtons = 'Save,NewPage,Preview,Print,Templates,PasteFromWord,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,BidiLtr,BidiRtl,Language,PageBreak,ShowBlocks,About,Maximize';

    //config.extraPlugins = 'uploadimage';
    //config.imageUploadUrl = '/myblog/public/upload';
    //config.extraPlugins = 'imageuploader';


    config.filebrowserBrowseUrl ='/asset/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl ='/asset/ckfinder/ckfinder.html?Type=Images';
    config.filebrowserImageUploadUrl ='/asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
};
