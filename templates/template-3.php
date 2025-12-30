<?php
if (!defined('ABSPATH')) exit;
$wpdcsm_data = wpdcsm_get_template_data();
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
        @keyframes slideInUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes glow { 0%, 100% { box-shadow: 0 0 20px rgba(255,255,255,0.3); } 50% { box-shadow: 0 0 40px rgba(255,255,255,0.6); } }
        body { font-family: 'Arial', sans-serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; animation: slideInUp 0.8s ease-out; }
        .wpdcsm-logo { margin-bottom: 50px; animation: glow 2s ease-in-out infinite; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; filter: brightness(1.2); }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: white; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; text-shadow: 0 5px 20px rgba(0,0,0,0.3); letter-spacing: 2px; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: rgba(255,255,255,0.95); margin-bottom: 50px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.8; text-shadow: 0 2px 10px rgba(0,0,0,0.2); }
        .wpdcsm-countdown-wrapper { margin: 50px 0; }
        .wpdcsm-countdown { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; max-width: 600px; margin: 0 auto; }
        .wpdcsm-countdown-item { background: rgba(255,255,255,0.2); backdrop-filter: blur(20px); padding: 30px 20px; border-radius: 15px; border: 2px solid rgba(255,255,255,0.3); transition: all 0.3s; }
        .wpdcsm-countdown-item:hover { background: rgba(255,255,255,0.3); transform: translateY(-5px); }
        .wpdcsm-countdown-number { display: block; font-size: 48px; font-weight: bold; color: white; text-shadow: 0 3px 15px rgba(0,0,0,0.3); }
        .wpdcsm-countdown-label { display: block; font-size: 14px; margin-top: 10px; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 2px; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; gap: 10px; margin: 40px 0; flex-wrap: wrap; justify-content: center; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 15px 25px; border: 2px solid rgba(255,255,255,0.3); border-radius: 50px; font-size: 16px; flex: 1; min-width: 280px; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); }
        .wpdcsm-contact-form textarea { border-radius: 20px; min-height: 140px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 15px 35px; background: white; color: #667eea; border: none; border-radius: 50px; font-size: 16px; font-weight: bold; cursor: pointer; transition: all 0.3s; box-shadow: 0 5px 20px rgba(0,0,0,0.2); text-transform: uppercase; letter-spacing: 1px; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(0,0,0,0.3); background: #f0f0f0; }
        .wpdcsm-social-icons { display: flex; gap: 15px; justify-content: center; margin: 40px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 50%; color: white; transition: all 0.3s; border: 2px solid rgba(255,255,255,0.3); }
        .wpdcsm-social-icon:hover { background: rgba(255,255,255,0.3); transform: scale(1.2) rotate(360deg); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 15px; border-radius: 10px; text-align: center; background: rgba(255,255,255,0.95); }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { color: #155724; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { color: #721c24; }
        @media (max-width: 768px) {
            .wpdcsm-countdown { grid-template-columns: repeat(2, 1fr); }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body>
    <div class="wpdcsm-container">
        <div class="wpdcsm-content">
            <?php if ($wpdcsm_data['logo_enabled'] && !empty($wpdcsm_data['logo_image'])): ?>
                <div class="wpdcsm-logo"><img src="<?php echo esc_url($wpdcsm_data['logo_image']); ?>" alt="Logo"></div>
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
