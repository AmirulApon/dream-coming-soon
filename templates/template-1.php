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
    <title><?php echo esc_html__('Coming Soon', 'dream-coming-soon'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; }
        .wpdcsm-logo { margin-bottom: 40px; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: <?php echo esc_attr($wpdcsm_data['heading_color']); ?>; margin-bottom: 20px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: <?php echo esc_attr($wpdcsm_data['desc_color']); ?>; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.6; }
        .wpdcsm-countdown-wrapper { margin: 40px 0; }
        .wpdcsm-countdown { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 20px; border-radius: 10px; min-width: 80px; }
        .wpdcsm-countdown-number { display: block; font-size: 36px; font-weight: bold; color: <?php echo esc_attr($wpdcsm_data['heading_color']); ?>; }
        .wpdcsm-countdown-label { display: block; font-size: 14px; margin-top: 5px; color: <?php echo esc_attr($wpdcsm_data['desc_color']); ?>; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; gap: 10px; margin: 30px 0; flex-wrap: wrap; justify-content: center; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 12px 20px; border: 2px solid rgba(0,0,0,0.1); border-radius: 50px; font-size: 16px; flex: 1; min-width: 250px; }
        .wpdcsm-contact-form textarea { border-radius: 15px; min-height: 120px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 12px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 50px; font-size: 16px; cursor: pointer; transition: transform 0.2s; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { transform: translateY(-2px); }
        .wpdcsm-social-icons { display: flex; gap: 15px; justify-content: center; margin: 30px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 50%; color: <?php echo esc_attr($wpdcsm_data['heading_color']); ?>; transition: transform 0.2s; }
        .wpdcsm-social-icon:hover { transform: scale(1.1); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 15px; padding: 10px; border-radius: 5px; text-align: center; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: #d4edda; color: #155724; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: #f8d7da; color: #721c24; }
        @media (max-width: 768px) {
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; }
            .wpdcsm-countdown { gap: 10px; }
            .wpdcsm-countdown-item { padding: 15px; min-width: 60px; }
            .wpdcsm-countdown-number { font-size: 28px; }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body>
    <div class="wpdcsm-container">
        <div class="wpdcsm-content">
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

