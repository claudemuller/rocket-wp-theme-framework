/**
 * Scripts for the theme admin section
 */
jQuery(document).ready(function($) {
    /**
     * Media Library upload .js
     */
    // Upload a logo
    $('.image-upload-button').click(function() {
        var image_upload_container = $(this).parent();
        var image_upload_input = image_upload_container.find('.image-upload-url');
        var image_upload_preview = image_upload_container.find('.image-upload-preview');
        var image = wp.media({
            title: 'Upload Image',
            multiple: false // true if you want to upload multiple files at once
        }).open()
        .on('select', function(e){
            // The returned image
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;

            // Assign the url to the input field and preview image
            image_upload_input.val(image_url);
            image_upload_preview.attr('src', image_url);
        });

        return false;
    });

    // Remove the logo
    $('.image-remove-button').click(function() {
        var image_upload_container = $(this).parent();
        var image_upload_input = image_upload_container.find('.image-upload-url');
        var image_upload_preview = image_upload_container.find('.image-upload-preview');

        image_upload_input.val('');
        image_upload_preview.attr('src', window.LOGO_PLACEHOLDER);
    });

    /**
     * Color Picker API
     */
    if (window.location.href.indexOf('rocket-settings-page') > -1) {
        $('.colour-field').wpColorPicker();
    }
});
