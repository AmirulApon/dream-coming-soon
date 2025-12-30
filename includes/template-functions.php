<?php

if (!defined('ABSPATH')) exit;

/**
 * Get all template data
 */
function wpdcsm_get_template_data() {
    return array(
        // Content
        'heading' => get_option('wpdcsm_heading', 'Coming Soon!'),
        'description' => get_option('wpdcsm_description', 'We\'re working on something awesome. Stay tuned!'),
        
        // Countdown
        'countdown_enabled' => get_option('wpdcsm_countdown_enabled', 0),
        'countdown_date' => get_option('wpdcsm_countdown_date', date('Y-m-d H:i:s', strtotime('+30 days'))),
        'countdown_label' => get_option('wpdcsm_countdown_label', 'We\'re launching in:'),
        
        // Newsletter
        'newsletter_enabled' => get_option('wpdcsm_newsletter_enabled', 1),
        'newsletter_title' => get_option('wpdcsm_newsletter_title', 'Subscribe to Our Newsletter'),
        'newsletter_description' => get_option('wpdcsm_newsletter_description', 'Get notified when we launch!'),
        'newsletter_button_text' => get_option('wpdcsm_newsletter_button_text', 'Subscribe'),
        'newsletter_show_name' => get_option('wpdcsm_newsletter_show_name', 0),
        
        // Social
        'social_enabled' => get_option('wpdcsm_social_enabled', 1),
        'social_title' => get_option('wpdcsm_social_title', 'Follow Us'),
        'social_facebook' => get_option('wpdcsm_social_facebook', ''),
        'social_twitter' => get_option('wpdcsm_social_twitter', ''),
        'social_instagram' => get_option('wpdcsm_social_instagram', ''),
        'social_linkedin' => get_option('wpdcsm_social_linkedin', ''),
        'social_youtube' => get_option('wpdcsm_social_youtube', ''),
        'social_pinterest' => get_option('wpdcsm_social_pinterest', ''),
        'social_tiktok' => get_option('wpdcsm_social_tiktok', ''),
        'social_github' => get_option('wpdcsm_social_github', ''),
        
        // Contact
        'contact_enabled' => get_option('wpdcsm_contact_enabled', 1),
        'contact_title' => get_option('wpdcsm_contact_title', 'Get In Touch'),
        'contact_description' => get_option('wpdcsm_contact_description', 'Have a question? Send us a message!'),
        'contact_button_text' => get_option('wpdcsm_contact_button_text', 'Send Message'),
        
        // Appearance
        'bg_type' => get_option('wpdcsm_bg_type', 'color'),
        'bg_color' => get_option('wpdcsm_bg_color', '#ffffff'),
        'bg_image' => get_option('wpdcsm_bg_image', ''),
        'bg_overlay' => get_option('wpdcsm_bg_overlay', '#000000'),
        'bg_overlay_opacity' => get_option('wpdcsm_bg_overlay_opacity', 0.5),
        'logo_enabled' => get_option('wpdcsm_logo_enabled', 0),
        'logo_image' => get_option('wpdcsm_logo_image', ''),
        'logo_width' => get_option('wpdcsm_logo_width', 200),
        'heading_font_family' => get_option('wpdcsm_heading_font_family', 'inherit'),
        'heading_font_weight' => get_option('wpdcsm_heading_font_weight', 'bold'),
        'desc_font_family' => get_option('wpdcsm_desc_font_family', 'inherit'),
        'content_width' => get_option('wpdcsm_content_width', 800),
        'content_alignment' => get_option('wpdcsm_content_alignment', 'center'),
        
        // Style (legacy)
        'heading_color' => get_option('wpdcsm_heading_color', '#000000'),
        'desc_color' => get_option('wpdcsm_desc_color', '#000000'),
        'heading_range' => get_option('wpdcsm_heading_range', 50),
        'desc_range' => get_option('wpdcsm_desc_range', 20),
        'section_bg_color' => get_option('wpdcsm_section_bg_color', '#ffffff'),
    );
}

