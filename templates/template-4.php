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
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        body { font-family: 'Times New Roman', serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: rgba(255,255,255,0.98); padding: 70px 60px; border-radius: 0; box-shadow: 0 0 0 8px rgba(255,255,255,0.2), 0 0 0 16px rgba(255,255,255,0.1); animation: fadeIn 1s ease-out; }
        .wpdcsm-logo { margin-bottom: 50px; border-bottom: 3px solid #1e3c72; padding-bottom: 30px; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: #1e3c72; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; letter-spacing: 3px; text-transform: uppercase; position: relative; padding-bottom: 20px; }
        h1::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 100px; height: 4px; background: linear-gradient(90deg, transparent, #1e3c72, transparent); }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #555; margin-bottom: 50px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 2; font-style: italic; }
        .wpdcsm-countdown-wrapper { margin: 60px 0; }
        .wpdcsm-countdown { display: flex; gap: 25px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: #1e3c72; padding: 35px 30px; border-radius: 0; min-width: 120px; position: relative; border: 3px solid #2a5298; box-shadow: inset 0 0 20px rgba(0,0,0,0.2); }
        .wpdcsm-countdown-item::before { content: ''; position: absolute; top: -3px; left: -3px; right: -3px; bottom: -3px; background: linear-gradient(45deg, #1e3c72, #2a5298); z-index: -1; }
        .wpdcsm-countdown-number { display: block; font-size: 56px; font-weight: bold; color: white; font-family: 'Georgia', serif; }
        .wpdcsm-countdown-label { display: block; font-size: 14px; margin-top: 15px; color: rgba(255,255,255,0.8); text-transform: uppercase; letter-spacing: 3px; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 20px; margin: 50px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 18px 30px; border: 2px solid #ddd; border-radius: 0; font-size: 16px; transition: all 0.3s; background: white; font-family: 'Times New Roman', serif; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #1e3c72; }
        .wpdcsm-contact-form textarea { min-height: 150px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 18px 50px; background: #1e3c72; color: white; border: 3px solid #1e3c72; border-radius: 0; font-size: 18px; font-weight: bold; cursor: pointer; transition: all 0.3s; text-transform: uppercase; letter-spacing: 2px; font-family: 'Times New Roman', serif; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { background: transparent; color: #1e3c72; }
        .wpdcsm-social-icons { display: flex; gap: 20px; justify-content: center; margin: 50px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 55px; height: 55px; display: flex; align-items: center; justify-content: center; background: #1e3c72; border-radius: 0; color: white; transition: all 0.3s; border: 2px solid #1e3c72; }
        .wpdcsm-social-icon:hover { background: transparent; color: #1e3c72; transform: scale(1.1); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 20px; border-radius: 0; text-align: center; border: 2px solid; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: #f0f9f4; border-color: #28a745; color: #155724; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: #fef5f5; border-color: #dc3545; color: #721c24; }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 50px 30px; }
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
            <?php echo wpdcsm_render_countdown($wpdcsm_data; ?>
            <?php echo wpdcsm_render_newsletter($wpdcsm_data; ?>
            <?php echo wpdcsm_render_social($wpdcsm_data; ?>
            <?php echo wpdcsm_render_contact($wpdcsm_data; ?>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
