(function($) {
    'use strict';
    
    // Newsletter form submission
    $('#wpdcsm-newsletter-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $button = $form.find('button[type="submit"]');
        var $message = $form.find('.wpdcsm-newsletter-message');
        var originalText = $button.text();
        
        // Get form data
        var formData = {
            action: 'wpdcsm_newsletter_subscribe',
            nonce: wpdcsm.nonce,
            email: $form.find('.wpdcsm-newsletter-email').val(),
            name: $form.find('.wpdcsm-newsletter-name').val() || ''
        };
        
        // Disable button
        $button.prop('disabled', true).text('Subscribing...');
        $message.removeClass('success error').text('');
        
        // Submit via AJAX
        $.ajax({
            url: wpdcsm.ajax_url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $message.addClass('success').text(response.data.message);
                    $form[0].reset();
                } else {
                    $message.addClass('error').text(response.data.message);
                }
            },
            error: function() {
                $message.addClass('error').text('An error occurred. Please try again.');
            },
            complete: function() {
                $button.prop('disabled', false).text(originalText);
            }
        });
    });
    
    // Contact form submission
    $('#wpdcsm-contact-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $button = $form.find('button[type="submit"]');
        var $message = $form.find('.wpdcsm-contact-message-result');
        var originalText = $button.text();
        
        // Get form data
        var formData = {
            action: 'wpdcsm_contact_submit',
            nonce: wpdcsm.nonce,
            name: $form.find('.wpdcsm-contact-name').val(),
            email: $form.find('.wpdcsm-contact-email').val(),
            subject: $form.find('.wpdcsm-contact-subject').val() || '',
            message: $form.find('.wpdcsm-contact-message').val()
        };
        
        // Disable button
        $button.prop('disabled', true).text('Sending...');
        $message.removeClass('success error').text('');
        
        // Submit via AJAX
        $.ajax({
            url: wpdcsm.ajax_url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $message.addClass('success').text(response.data.message);
                    $form[0].reset();
                } else {
                    $message.addClass('error').text(response.data.message);
                }
            },
            error: function() {
                $message.addClass('error').text('An error occurred. Please try again.');
            },
            complete: function() {
                $button.prop('disabled', false).text(originalText);
            }
        });
    });
    
})(jQuery);

