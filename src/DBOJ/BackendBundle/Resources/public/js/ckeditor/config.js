/*
 Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

        CKEDITOR.editorConfig = function(config)
        {
            // Define changes to default configuration here. For example:
            // config.language = 'fr';
            config.uiColor = '#FFF';
            config.resize_enabled = false;
            config.toolbarCanCollapse = false;
            config.toolbar = [
                ['NewPage', 'Preview', '-', 'Templates'],
                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
                ['Bold', 'Italic'],
                [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ],
                [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'SpecialChar','Iframe' ],
                '/',
                [ 'Styles', 'Format', 'Font', 'FontSize' ],
                [ 'TextColor', 'BGColor' ]
            ];
        };
