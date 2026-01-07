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
        @keyframes slideUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
        body { font-family: 'Arial', 'Helvetica', sans-serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: <?php echo esc_attr($wpdcsm_data['bg_overlay']); ?>; opacity: <?php echo esc_attr($wpdcsm_data['bg_overlay_opacity']); ?>; z-index: 1; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: white; padding: 80px 70px; border-radius: 15px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); animation: slideUp 0.8s ease-out; }
        .wpdcsm-logo { margin-bottom: 50px; border-bottom: 2px solid #e0e0e0; padding-bottom: 30px; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: #1e3c72; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; letter-spacing: 1px; position: relative; padding-bottom: 25px; }
        h1::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background: linear-gradient(90deg, #1e3c72, #2a5298); }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #555; margin-bottom: 50px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.8; }
        .wpdcsm-countdown-wrapper { margin: 60px 0; }
        .wpdcsm-countdown-label { font-size: 18px; color: #1e3c72; margin-bottom: 30px; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; }
        .wpdcsm-countdown { display: flex; gap: 25px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: linear-gradient(135deg, #1e3c72, #2a5298); padding: 35px 30px; border-radius: 10px; min-width: 120px; box-shadow: 0 10px 30px rgba(30,60,114,0.3); transition: all 0.3s; }
        .wpdcsm-countdown-item:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(30,60,114,0.4); }
        .wpdcsm-countdown-number { display: block; font-size: 54px; font-weight: 700; color: white; }
        .wpdcsm-countdown-label { display: block; font-size: 14px; margin-top: 15px; color: rgba(255,255,255,0.9); text-transform: uppercase; letter-spacing: 2px; font-weight: 500; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 20px; margin: 50px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 18px 28px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; transition: all 0.3s; background: #f8f9fa; color: #333; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #1e3c72; background: white; box-shadow: 0 0 0 3px rgba(30,60,114,0.1); }
        .wpdcsm-contact-form textarea { min-height: 150px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 18px 45px; background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border: none; border-radius: 8px; font-size: 17px; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 5px 20px rgba(30,60,114,0.3); text-transform: uppercase; letter-spacing: 1px; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(30,60,114,0.4); }
        .wpdcsm-social-icons { display: flex; gap: 15px; justify-content: center; margin: 50px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 8px; color: #1e3c72; transition: all 0.3s; border: 2px solid #e0e0e0; }
        .wpdcsm-social-icon:hover { background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-color: #1e3c72; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(30,60,114,0.3); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 18px; border-radius: 8px; text-align: center; font-weight: 500; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: #d4edda; color: #155724; border: 2px solid #c3e6cb; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: #f8d7da; color: #721c24; border: 2px solid #f5c6cb; }
        @media (max-width: 768px) {
            .wpdcsm-content { padding: 60px 40px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.75); ?>px; }
            .wpdcsm-countdown-item { padding: 30px 25px; min-width: 100px; }
            .wpdcsm-countdown-number { font-size: 42px; }
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

