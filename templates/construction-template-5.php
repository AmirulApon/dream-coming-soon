<?php
if (!defined('ABSPATH')) exit;
$wpdcsm_data = wpdcsm_get_template_data();

// Get background style
$wpdcsm_bg_style = '';
if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])) {
    $wpdcsm_bg_style = "background-image: url('" . esc_url($wpdcsm_data['bg_image']) . "'); background-size: cover; background-position: center; position: relative;";
} else {
    $wpdcsm_bg_style = "background-color: " . sanitize_hex_color($wpdcsm_data['bg_color']) . ";";
}
$wpdcsm_bg_style = wp_strip_all_tags($wpdcsm_bg_style);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html__('Under Construction', 'dream-coming-soon'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @keyframes pulse { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: rgba(255,255,255,0.98); padding: 60px 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .construction-icon { width: 80px; height: 80px; margin: 0 auto 30px; border: 4px solid #e0e0e0; border-top-color: #0073aa; border-radius: 50%; animation: pulse 1s linear infinite; }
        .wpdcsm-logo { margin-bottom: 30px; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: <?php echo esc_attr($wpdcsm_data['heading_color']); ?>; margin-bottom: 20px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: <?php echo esc_attr($wpdcsm_data['desc_color']); ?>; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.6; }
        .wpdcsm-countdown-wrapper { margin: 30px 0; }
        .wpdcsm-countdown { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: #f5f5f5; padding: 20px 15px; border-radius: 8px; min-width: 80px; border: 1px solid #e0e0e0; }
        .wpdcsm-countdown-number { display: block; font-size: 32px; font-weight: bold; color: <?php echo esc_attr($wpdcsm_data['heading_color']); ?>; }
        .wpdcsm-countdown-label { display: block; font-size: 12px; margin-top: 5px; color: <?php echo esc_attr($wpdcsm_data['desc_color']); ?>; text-transform: uppercase; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; gap: 10px; margin: 30px 0; flex-wrap: wrap; justify-content: center; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 12px 20px; border: 2px solid #e0e0e0; border-radius: 5px; font-size: 16px; flex: 1; min-width: 250px; }
        .wpdcsm-contact-form textarea { border-radius: 5px; min-height: 120px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 12px 30px; background: #0073aa; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background 0.2s; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { background: #005a87; }
        .wpdcsm-social-icons { display: flex; gap: 15px; justify-content: center; margin: 30px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #f5f5f5; border-radius: 50%; color: <?php echo esc_attr($wpdcsm_data['heading_color']); ?>; transition: background 0.2s; border: 1px solid #e0e0e0; }
        .wpdcsm-social-icon:hover { background: #e0e0e0; }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 15px; padding: 10px; border-radius: 5px; text-align: center; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 40px 20px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; }
            .construction-icon { width: 60px; height: 60px; }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body>
    <div class="wpdcsm-container">
        <div class="wpdcsm-content">
            <div class="construction-icon"></div>
            <?php if ($wpdcsm_data['logo_enabled'] && !empty($wpdcsm_data['logo_image'])): ?>
                <div class="wpdcsm-logo">
                    <img src="<?php echo esc_url($wpdcsm_data['logo_image']); ?>" alt="Logo">
                </div>
            <?php endif; ?>
            
            <h1><?php echo esc_html($wpdcsm_data['heading']); ?></h1>
            <p><?php echo esc_html($wpdcsm_data['description']); ?></p>
            
            <?php echo wp_kses_post(wpdcsm_render_countdown($wpdcsm_data)); ?>
            <?php echo wp_kses_post(wpdcsm_render_newsletter($wpdcsm_data)); ?>
            <?php echo wp_kses_post(wpdcsm_render_social($wpdcsm_data)); ?>
            <?php echo wp_kses_post(wpdcsm_render_contact($wpdcsm_data)); ?>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>

