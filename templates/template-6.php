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
        @keyframes gradientShift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        body { font-family: 'Comic Sans MS', 'Arial', sans-serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: rgba(255,255,255,0.95); padding: 50px; border-radius: 50px; box-shadow: 0 30px 80px rgba(0,0,0,0.2); }
        .wpdcsm-logo { margin-bottom: 30px; animation: bounce 2s ease-in-out infinite; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; background: linear-gradient(135deg, #f093fb, #f5576c, #4facfe, #43e97b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 25px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #333; margin-bottom: 40px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.8; }
        .wpdcsm-countdown-wrapper { margin: 40px 0; }
        .wpdcsm-countdown { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: linear-gradient(135deg, #f093fb, #f5576c); padding: 25px 20px; border-radius: 25px; min-width: 90px; box-shadow: 0 15px 35px rgba(240,147,251,0.4); transform: rotate(-5deg); transition: all 0.3s; animation: bounce 3s ease-in-out infinite; }
        .wpdcsm-countdown-item:nth-child(2) { background: linear-gradient(135deg, #4facfe, #00f2fe); animation-delay: 0.2s; transform: rotate(3deg); }
        .wpdcsm-countdown-item:nth-child(3) { background: linear-gradient(135deg, #43e97b, #38f9d7); animation-delay: 0.4s; transform: rotate(-2deg); }
        .wpdcsm-countdown-item:nth-child(4) { background: linear-gradient(135deg, #fa709a, #fee140); animation-delay: 0.6s; transform: rotate(4deg); }
        .wpdcsm-countdown-item:hover { transform: rotate(0deg) scale(1.1); }
        .wpdcsm-countdown-number { display: block; font-size: 42px; font-weight: bold; color: white; text-shadow: 0 3px 10px rgba(0,0,0,0.2); }
        .wpdcsm-countdown-label { display: block; font-size: 12px; margin-top: 8px; color: rgba(255,255,255,0.95); text-transform: uppercase; font-weight: bold; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 15px; margin: 35px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 15px 25px; border: 3px solid #f093fb; border-radius: 50px; font-size: 16px; transition: all 0.3s; background: white; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #4facfe; box-shadow: 0 0 25px rgba(79,172,254,0.3); }
        .wpdcsm-contact-form textarea { border-radius: 30px; min-height: 130px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 15px 40px; background: linear-gradient(135deg, #f093fb, #f5576c, #4facfe); color: white; border: none; border-radius: 50px; font-size: 18px; font-weight: bold; cursor: pointer; transition: all 0.3s; box-shadow: 0 10px 30px rgba(240,147,251,0.4); text-transform: uppercase; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { transform: scale(1.05) rotate(2deg); box-shadow: 0 15px 40px rgba(240,147,251,0.6); }
        .wpdcsm-social-icons { display: flex; gap: 15px; justify-content: center; margin: 35px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f093fb, #4facfe); border-radius: 50%; color: white; transition: all 0.3s; box-shadow: 0 5px 20px rgba(240,147,251,0.3); }
        .wpdcsm-social-icon:hover { transform: scale(1.2) rotate(360deg); box-shadow: 0 8px 30px rgba(240,147,251,0.5); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 15px; padding: 15px; border-radius: 25px; text-align: center; font-weight: bold; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: linear-gradient(135deg, #43e97b, #38f9d7); color: white; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: linear-gradient(135deg, #f5576c, #fa709a); color: white; }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 40px 30px; border-radius: 30px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.7); ?>px; }
            .wpdcsm-countdown-item { transform: rotate(0deg) !important; }
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
