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
        @keyframes slideIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #f8f9fa; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: white; padding: 80px 60px; border-radius: 20px; box-shadow: 0 10px 50px rgba(0,0,0,0.08); animation: slideIn 0.6s ease-out; }
        .wpdcsm-logo { margin-bottom: 50px; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; opacity: 0.9; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: #212529; margin-bottom: 25px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; letter-spacing: -1px; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #6c757d; margin-bottom: 45px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.7; }
        .wpdcsm-countdown-wrapper { margin: 50px 0; }
        .wpdcsm-countdown { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: #f8f9fa; padding: 30px 25px; border-radius: 12px; min-width: 100px; border: 1px solid #e9ecef; transition: all 0.3s; }
        .wpdcsm-countdown-item:hover { background: #e9ecef; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .wpdcsm-countdown-number { display: block; font-size: 48px; font-weight: 700; color: #212529; }
        .wpdcsm-countdown-label { display: block; font-size: 13px; margin-top: 12px; color: #6c757d; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 500; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 18px; margin: 45px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 16px 24px; border: 2px solid #e9ecef; border-radius: 8px; font-size: 16px; transition: all 0.3s; background: #f8f9fa; color: #212529; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #667eea; background: white; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
        .wpdcsm-contact-form textarea { min-height: 140px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 16px 36px; background: #212529; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { background: #495057; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(33,37,41,0.2); }
        .wpdcsm-social-icons { display: flex; gap: 12px; justify-content: center; margin: 45px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 8px; color: #6c757d; transition: all 0.3s; border: 1px solid #e9ecef; }
        .wpdcsm-social-icon:hover { background: #e9ecef; color: #212529; transform: translateY(-3px); box-shadow: 0 3px 10px rgba(0,0,0,0.1); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 16px; border-radius: 8px; text-align: center; font-weight: 500; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 60px 40px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.75); ?>px; }
            .wpdcsm-countdown-item { padding: 25px 20px; min-width: 80px; }
            .wpdcsm-countdown-number { font-size: 38px; }
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
