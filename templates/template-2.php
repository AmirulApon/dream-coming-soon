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
        @keyframes gradientShift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        body { font-family: 'Georgia', serif; overflow-x: hidden; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: rgba(255,255,255,0.95); padding: 60px; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); animation: float 6s ease-in-out infinite; }
        .wpdcsm-logo { margin-bottom: 30px; animation: pulse 3s ease-in-out infinite; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2)); }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; background: linear-gradient(135deg, #667eea, #764ba2, #f093fb); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 25px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; text-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #555; margin-bottom: 35px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.8; }
        .wpdcsm-countdown-wrapper { margin: 40px 0; }
        .wpdcsm-countdown { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: linear-gradient(135deg, #667eea, #764ba2); padding: 25px 20px; border-radius: 20px; min-width: 90px; box-shadow: 0 10px 30px rgba(102,126,234,0.4); transform: perspective(1000px) rotateX(5deg); transition: transform 0.3s; }
        .wpdcsm-countdown-item:hover { transform: perspective(1000px) rotateX(0deg) scale(1.05); }
        .wpdcsm-countdown-number { display: block; font-size: 42px; font-weight: bold; color: white; text-shadow: 0 2px 10px rgba(0,0,0,0.2); }
        .wpdcsm-countdown-label { display: block; font-size: 12px; margin-top: 8px; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 1px; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 15px; margin: 35px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 15px 25px; border: 3px solid #e0e0e0; border-radius: 50px; font-size: 16px; transition: all 0.3s; background: white; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #667eea; box-shadow: 0 0 20px rgba(102,126,234,0.2); }
        .wpdcsm-contact-form textarea { border-radius: 25px; min-height: 130px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 15px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 50px; font-size: 18px; font-weight: bold; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 30px rgba(102,126,234,0.4); text-transform: uppercase; letter-spacing: 1px; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(102,126,234,0.6); }
        .wpdcsm-social-icons { display: flex; gap: 20px; justify-content: center; margin: 35px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; color: white; transition: all 0.3s; box-shadow: 0 5px 15px rgba(102,126,234,0.3); }
        .wpdcsm-social-icon:hover { transform: scale(1.15) rotate(5deg); box-shadow: 0 8px 25px rgba(102,126,234,0.5); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 15px; padding: 15px; border-radius: 15px; text-align: center; font-weight: bold; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: linear-gradient(135deg, #84fab0, #8fd3f4); color: #155724; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: linear-gradient(135deg, #fa709a, #fee140); color: #721c24; }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 40px 30px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; }
            .wpdcsm-countdown-item { padding: 20px 15px; min-width: 70px; }
            .wpdcsm-countdown-number { font-size: 32px; }
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
