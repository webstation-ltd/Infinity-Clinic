/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function(config) {
   config.filebrowserBrowseUrl = 'html/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = 'html/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = 'html/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = 'html/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = 'html/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = 'html/kcfinder/upload.php?type=flash';
   
config.toolbar_CodeDigestTool =
    [  
    	['Bold', 'Italic', 'Underline', 'Strike', '-', 'Smiley'],
    ];
};
