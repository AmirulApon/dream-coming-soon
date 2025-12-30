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
        @keyframes sparkle { 0%, 100% { opacity: 0; } 50% { opacity: 1; } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        body { font-family: 'Courier New', monospace; background: #0a0e27; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> overflow: hidden; }
        .wpdcsm-container::before { content: ''; position: absolute; width: 200%; height: 200%; background: radial-gradient(circle, rgba(102,126,234,0.1) 0%, transparent 70%); animation: float 20s infinite; }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; }
        .wpdcsm-logo { margin-bottom: 40px; filter: drop-shadow(0 0 20px rgba(102,126,234,0.5)); }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: #667eea; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; text-shadow: 0 0 30px rgba(102,126,234,0.8), 0 0 60px rgba(102,126,234,0.4); letter-spacing: 5px; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #a0aec0; margin-bottom: 50px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.8; text-shadow: 0 0 10px rgba(160,174,192,0.3); }
        .wpdcsm-countdown-wrapper { margin: 50px 0; }
        .wpdcsm-countdown { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: rgba(102,126,234,0.1); backdrop-filter: blur(10px); padding: 30px 25px; border-radius: 15px; min-width: 100px; border: 2px solid rgba(102,126,234,0.3); box-shadow: 0 0 30px rgba(102,126,234,0.2), inset 0 0 20px rgba(102,126,234,0.1); transition: all 0.3s; }
        .wpdcsm-countdown-item:hover { border-color: rgba(102,126,234,0.6); box-shadow: 0 0 50px rgba(102,126,234,0.4); transform: translateY(-5px); }
        .wpdcsm-countdown-number { display: block; font-size: 48px; font-weight: bold; color: #667eea; text-shadow: 0 0 20px rgba(102,126,234,0.8); }
        .wpdcsm-countdown-label { display: block; font-size: 12px; margin-top: 10px; color: #a0aec0; text-transform: uppercase; letter-spacing: 2px; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 15px; margin: 40px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 15px 25px; border: 2px solid rgba(102,126,234,0.3); border-radius: 10px; font-size: 16px; background: rgba(10,14,39,0.8); color: #fff; transition: all 0.3s; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #667eea; box-shadow: 0 0 20px rgba(102,126,234,0.3); }
        .wpdcsm-contact-form textarea { min-height: 140px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 15px 40px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 10px; font-size: 16px; font-weight: bold; cursor: pointer; transition: all 0.3s; box-shadow: 0 0 30px rgba(102,126,234,0.4); text-transform: uppercase; letter-spacing: 2px; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { box-shadow: 0 0 50px rgba(102,126,234,0.6); transform: translateY(-2px); }
        .wpdcsm-social-icons { display: flex; gap: 20px; justify-content: center; margin: 40px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: rgba(102,126,234,0.2); backdrop-filter: blur(10px); border-radius: 10px; color: #667eea; transition: all 0.3s; border: 2px solid rgba(102,126,234,0.3); }
        .wpdcsm-social-icon:hover { background: rgba(102,126,234,0.4); border-color: #667eea; box-shadow: 0 0 30px rgba(102,126,234,0.5); transform: scale(1.1); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 15px; border-radius: 10px; text-align: center; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: rgba(40,167,69,0.2); border: 2px solid #28a745; color: #28a745; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: rgba(220,53,69,0.2); border: 2px solid #dc3545; color: #dc3545; }
        @media (max-width: 768px) {
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; letter-spacing: 2px; }
            .wpdcsm-countdown-item { padding: 25px 20px; min-width: 80px; }
            .wpdcsm-countdown-number { font-size: 36px; }
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
            <?php echo wpdcsm_render_countdown($wpdcsm_data; ?>
            <?php echo wpdcsm_render_newsletter($wpdcsm_data; ?>
            <?php echo wpdcsm_render_social($wpdcsm_data; ?>
            <?php echo wpdcsm_render_contact($wpdcsm_data; ?>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
