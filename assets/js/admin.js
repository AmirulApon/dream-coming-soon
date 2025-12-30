(function($) {
    'use strict';
    
    // Initialize color picker
    $('.color-picker').wpColorPicker();
    
    // Image upload handler
    $(document).on('click', '.wpdcsm-upload-image', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var targetId = button.data('target');
        var targetInput = $('#' + targetId);
        var previewContainer = $('#' + targetId + '_preview');
        
        var strings = wpdcsm_admin.strings || {};
        var frame = wp.media({
            title: strings.selectImage || 'Select Image',
            button: {
                text: strings.selectImage || 'Use this image'
            },
            library: {
                type: 'image'
            },
            multiple: false
        });
        
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            targetInput.val(attachment.url);
            
            // Update preview with proper structure
            var removeText = targetId === 'wpdcsm_logo_image' ? (strings.removeLogo || 'Remove Logo') : (strings.removeImage || 'Remove Image');
            var changeText = targetId === 'wpdcsm_logo_image' ? (strings.changeLogo || 'Change Logo') : (strings.changeImage || 'Change Image');
            var previewHtml = '<div class="wpdcsm-image-preview-container">' +
                '<img src="' + attachment.url + '" alt="Preview">' +
                '<button type="button" class="wpdcsm-remove-image button" data-target="' + targetId + '">' + removeText + '</button>' +
                '</div>';
            previewContainer.html(previewHtml);
            
            // Update button text
            button.text(changeText);
        });
        
        frame.open();
    });
    
    // Remove image handler
    $(document).on('click', '.wpdcsm-remove-image', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var targetInputId = button.data('target');
        var targetInput = $('#' + targetInputId);
        var previewContainer = $('#' + targetInputId + '_preview');
        
        // Clear input value
        targetInput.val('');
        
        // Clear preview
        previewContainer.html('');
    });
    
    // Template selector
    $(document).on('click', '.wpdcsm-template-option', function() {
        $('.wpdcsm-template-option').css('border-color', '#ddd');
        $(this).css('border-color', '#0073aa');
        $(this).find('input[type="radio"]').prop('checked', true);
    });
    
    // Range value display updater
    $(document).on('input change', 'input[type="range"]', function() {
        var $input = $(this);
        var id = $input.attr('id');
        var value = $input.val();
        
        if (id) {
            // Map input IDs to their corresponding value span IDs
            var valueSpanMap = {
                'wpdcsm_heading_range': 'heading_range_value',
                'wpdcsm_desc_range': 'desc_range_value',
                'wpdcsm_bg_overlay_opacity': 'overlay_opacity_value'
            };
            
            var valueSpanId = valueSpanMap[id];
            if (valueSpanId) {
                $('#' + valueSpanId).text(value);
            } else if (id.includes('_range')) {
                // Fallback: try to construct the ID
                var baseId = id.replace('wpdcsm_', '').replace('_range', '');
                $('#' + baseId + '_range_value').text(value);
            }
        }
    });
    
    
    // AJAX Form Submission Handler
    $(document).on('submit', '.wpdcsm-settings-form', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $button = $form.find('.wpdcsm-save-button, .button-primary');
        var originalText = $button.text();
        var formData = $form.serialize();
        var action = $form.data('action');
        var nonce = $form.find('input[name="_wpnonce"]').val();
        
        var strings = wpdcsm_admin.strings || {};
        // Show loading state
        $button.prop('disabled', true);
        if (!$button.find('.spinner').length) {
            $button.prepend('<span class="spinner is-active" style="float: none; margin: 0 10px 0 0; visibility: visible;"></span>');
        }
        $button.find('.spinner').addClass('is-active');
        $button.text(strings.saving || 'Saving...');
        
        // Remove existing notices
        $form.find('.wpdcsm-admin-notice').remove();
        
        // AJAX request
        $.ajax({
            url: wpdcsm_admin.ajax_url || ajaxurl,
            type: 'POST',
            data: {
                action: action,
                _wpnonce: nonce,
                form_data: formData
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    var $notice = $('<div class="wpdcsm-admin-notice success">' + response.data.message + '</div>');
                    $form.prepend($notice);
                    
                    // Remove notice after 5 seconds
                    setTimeout(function() {
                        $notice.fadeOut(300, function() {
                            $(this).remove();
                        });
                    }, 5000);
                } else {
                    // Show error message
                    var strings = wpdcsm_admin.strings || {};
                    var $notice = $('<div class="wpdcsm-admin-notice error">' + (response.data.message || (strings.errorSaving || 'An error occurred while saving.')) + '</div>');
                    $form.prepend($notice);
                }
            },
            error: function() {
                var strings = wpdcsm_admin.strings || {};
                var $notice = $('<div class="wpdcsm-admin-notice error">' + (strings.error || 'An error occurred. Please try again.') + '</div>');
                $form.prepend($notice);
            },
            complete: function() {
                // Restore button
                $button.prop('disabled', false);
                $button.find('.spinner').removeClass('is-active');
                $button.text(originalText);
            }
        });
    });
    
    // Background type toggle
    function toggleBgSettings() {
        var bgType = $('#wpdcsm_bg_type').val();
        if (bgType === 'color') {
            $('.bg-image-row').hide();
            $('.bg-color-row').show();
        } else {
            $('.bg-color-row').hide();
            $('.bg-image-row').show();
        }
    }
    
    $(document).on('change', '#wpdcsm_bg_type', toggleBgSettings);
    $(document).ready(function() {
        toggleBgSettings();
        
        // Initialize range values on page load
        $('input[type="range"]').each(function() {
            var $input = $(this);
            var id = $input.attr('id');
            var value = $input.val();
            
            var valueSpanMap = {
                'wpdcsm_heading_range': 'heading_range_value',
                'wpdcsm_desc_range': 'desc_range_value',
                'wpdcsm_bg_overlay_opacity': 'overlay_opacity_value'
            };
            
            var valueSpanId = valueSpanMap[id];
            if (valueSpanId) {
                $('#' + valueSpanId).text(value);
            }
        });
    });
    
})(jQuery);

