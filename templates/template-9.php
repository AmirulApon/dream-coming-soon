<?php
if (!defined('ABSPATH')) exit;
$wpdcsm_data = wpdcsm_get_template_data();
$wpdcsm_bg_style = '';
if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])) {
    $wpdcsm_bg_style = "background-image: url('" . esc_url($wpdcsm_data['bg_image']) . "'); background-size: cover; background-position: center; position: relative;";
} else {
    $wpdcsm_bg_style = "background-color: " . esc_attr($wpdcsm_data['bg_color']) . ";";
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html__('Coming Soon', 'dream-coming-soon'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        @keyframes gridMove { 0% { transform: translate(0, 0); } 100% { transform: translate(50px, 50px); } }
        @keyframes scanline { 0% { transform: translateY(-100%); } 100% { transform: translateY(100vh); } }
        @keyframes glitch { 0%, 100% { transform: translate(0); } 20% { transform: translate(-2px, 2px); } 40% { transform: translate(-2px, -2px); } 60% { transform: translate(2px, 2px); } 80% { transform: translate(2px, -2px); } }
        @keyframes gradientShift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        body { font-family: 'Courier New', monospace; background: #0c0c0c; overflow-x: hidden; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: linear-gradient(rgba(102,126,234,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(102,126,234,0.1) 1px, transparent 1px); background-size: 50px 50px; animation: gridMove 20s linear infinite; opacity: 0.3; }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: rgba(0,0,0,0.8); padding: 60px; border: 2px solid rgba(102,126,234,0.5); box-shadow: 0 0 50px rgba(102,126,234,0.3), inset 0 0 50px rgba(102,126,234,0.1); }
        .wpdcsm-logo { margin-bottom: 40px; filter: drop-shadow(0 0 20px rgba(102,126,234,0.8)); }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: #00ffff; margin-bottom: 30px; font-family: 'Courier New', monospace; text-shadow: 0 0 20px #00ffff, 0 0 40px #00ffff; letter-spacing: 3px; animation: glitch 0.3s infinite; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #00ff88; margin-bottom: 50px; font-family: 'Courier New', monospace; line-height: 1.8; text-shadow: 0 0 10px rgba(0,255,136,0.5); }
        .wpdcsm-countdown-wrapper { margin: 50px 0; }
        .wpdcsm-countdown { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: rgba(102,126,234,0.1); border: 2px solid rgba(102,126,234,0.5); padding: 30px 25px; min-width: 110px; position: relative; box-shadow: 0 0 30px rgba(102,126,234,0.3), inset 0 0 20px rgba(102,126,234,0.1); }
        .wpdcsm-countdown-item::before { content: ''; position: absolute; top: -2px; left: -2px; right: -2px; bottom: -2px; background: linear-gradient(45deg, #00ffff, #667eea, #00ff88, #667eea); background-size: 400% 400%; animation: gradientShift 3s ease infinite; z-index: -1; opacity: 0.5; }
        .wpdcsm-countdown-number { display: block; font-size: 48px; font-weight: bold; color: #00ffff; text-shadow: 0 0 20px #00ffff; font-family: 'Courier New', monospace; }
        .wpdcsm-countdown-label { display: block; font-size: 12px; margin-top: 10px; color: #00ff88; text-transform: uppercase; letter-spacing: 2px; font-family: 'Courier New', monospace; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 15px; margin: 40px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 15px 25px; border: 2px solid rgba(102,126,234,0.5); border-radius: 5px; font-size: 16px; background: rgba(0,0,0,0.6); color: #00ffff; font-family: 'Courier New', monospace; transition: all 0.3s; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #00ffff; box-shadow: 0 0 20px rgba(0,255,255,0.5); }
        .wpdcsm-contact-form textarea { min-height: 140px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 15px 40px; background: transparent; color: #00ffff; border: 2px solid #00ffff; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: all 0.3s; font-family: 'Courier New', monospace; text-transform: uppercase; letter-spacing: 2px; text-shadow: 0 0 10px #00ffff; box-shadow: 0 0 20px rgba(0,255,255,0.3); }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { background: rgba(0,255,255,0.1); box-shadow: 0 0 40px rgba(0,255,255,0.6); transform: translateY(-2px); }
        .wpdcsm-social-icons { display: flex; gap: 20px; justify-content: center; margin: 40px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: rgba(102,126,234,0.2); border: 2px solid rgba(102,126,234,0.5); border-radius: 5px; color: #00ffff; transition: all 0.3s; box-shadow: 0 0 20px rgba(102,126,234,0.3); }
        .wpdcsm-social-icon:hover { border-color: #00ffff; box-shadow: 0 0 30px rgba(0,255,255,0.6); transform: scale(1.1); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 15px; border-radius: 5px; text-align: center; border: 2px solid; font-family: 'Courier New', monospace; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: rgba(0,255,136,0.1); border-color: #00ff88; color: #00ff88; text-shadow: 0 0 10px rgba(0,255,136,0.5); }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: rgba(255,0,0,0.1); border-color: #ff0066; color: #ff0066; text-shadow: 0 0 10px rgba(255,0,102,0.5); }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 40px 30px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; animation: none; }
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
