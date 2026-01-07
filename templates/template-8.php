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
        @keyframes leafFall { 0% { transform: translateY(-100px) rotate(0deg); opacity: 0; } 50% { opacity: 1; } 100% { transform: translateY(100vh) rotate(360deg); opacity: 0; } }
        @keyframes wave { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(-25px); } }
        body { font-family: 'Georgia', serif; }
        .wpdcsm-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; position: relative; <?php echo $wpdcsm_bg_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - CSS constructed from sanitized values ?> overflow: hidden; }
        .wpdcsm-container::before { content: '🍃'; position: absolute; font-size: 30px; opacity: 0.3; animation: leafFall 20s infinite; left: 10%; }
        .wpdcsm-container::after { content: '🌿'; position: absolute; font-size: 25px; opacity: 0.3; animation: leafFall 25s infinite; left: 80%; animation-delay: 5s; }
        <?php if ($wpdcsm_data['bg_type'] === 'image' && !empty($wpdcsm_data['bg_image'])): ?>
        .wpdcsm-container::before, .wpdcsm-container::after { display: none; }
        <?php endif; ?>
        .wpdcsm-content { max-width: <?php echo esc_attr($wpdcsm_data['content_width']); ?>px; width: 100%; text-align: <?php echo esc_attr($wpdcsm_data['content_alignment']); ?>; position: relative; z-index: 2; background: rgba(255,255,255,0.98); padding: 70px 60px; border-radius: 30px; box-shadow: 0 25px 70px rgba(0,0,0,0.15); border: 3px solid rgba(113,178,128,0.2); }
        .wpdcsm-logo { margin-bottom: 40px; }
        .wpdcsm-logo img { max-width: <?php echo esc_attr($wpdcsm_data['logo_width']); ?>px; height: auto; filter: drop-shadow(0 5px 15px rgba(113,178,128,0.3)); }
        h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range']); ?>px; font-weight: <?php echo esc_attr($wpdcsm_data['heading_font_weight']); ?>; color: #134e5e; margin-bottom: 30px; font-family: <?php echo esc_attr($wpdcsm_data['heading_font_family']); ?>; position: relative; }
        h1::before { content: '🌱'; position: absolute; left: -50px; top: 50%; transform: translateY(-50%); font-size: 40px; }
        p { font-size: <?php echo esc_attr($wpdcsm_data['desc_range']); ?>px; color: #2d5016; margin-bottom: 45px; font-family: <?php echo esc_attr($wpdcsm_data['desc_font_family']); ?>; line-height: 1.9; }
        .wpdcsm-countdown-wrapper { margin: 50px 0; }
        .wpdcsm-countdown { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .wpdcsm-countdown-item { background: linear-gradient(135deg, #71b280, #134e5e); padding: 30px 25px; border-radius: 20px; min-width: 110px; box-shadow: 0 10px 30px rgba(113,178,128,0.3); position: relative; overflow: hidden; }
        .wpdcsm-countdown-item::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%); }
        .wpdcsm-countdown-number { display: block; font-size: 50px; font-weight: bold; color: white; text-shadow: 0 3px 10px rgba(0,0,0,0.2); position: relative; z-index: 1; }
        .wpdcsm-countdown-label { display: block; font-size: 13px; margin-top: 12px; color: rgba(255,255,255,0.95); text-transform: uppercase; letter-spacing: 2px; position: relative; z-index: 1; }
        .wpdcsm-newsletter-form, .wpdcsm-contact-form { display: flex; flex-direction: column; gap: 18px; margin: 45px 0; }
        .wpdcsm-newsletter-form input, .wpdcsm-contact-form input, .wpdcsm-contact-form textarea { padding: 16px 24px; border: 3px solid #71b280; border-radius: 50px; font-size: 16px; transition: all 0.3s; background: #f8fdf9; color: #134e5e; }
        .wpdcsm-newsletter-form input:focus, .wpdcsm-contact-form input:focus, .wpdcsm-contact-form textarea:focus { outline: none; border-color: #134e5e; background: white; box-shadow: 0 0 0 4px rgba(113,178,128,0.2); }
        .wpdcsm-contact-form textarea { border-radius: 25px; min-height: 140px; resize: vertical; }
        .wpdcsm-newsletter-button, .wpdcsm-contact-button { padding: 16px 40px; background: linear-gradient(135deg, #71b280, #134e5e); color: white; border: none; border-radius: 50px; font-size: 17px; font-weight: bold; cursor: pointer; transition: all 0.3s; box-shadow: 0 8px 25px rgba(113,178,128,0.3); text-transform: uppercase; letter-spacing: 1px; }
        .wpdcsm-newsletter-button:hover, .wpdcsm-contact-button:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(113,178,128,0.4); }
        .wpdcsm-social-icons { display: flex; gap: 15px; justify-content: center; margin: 45px 0; flex-wrap: wrap; }
        .wpdcsm-social-icon { width: 52px; height: 52px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #71b280, #134e5e); border-radius: 50%; color: white; transition: all 0.3s; box-shadow: 0 5px 15px rgba(113,178,128,0.3); }
        .wpdcsm-social-icon:hover { transform: scale(1.15) rotate(-5deg); box-shadow: 0 8px 25px rgba(113,178,128,0.4); }
        .wpdcsm-newsletter-message, .wpdcsm-contact-message-result { margin-top: 20px; padding: 16px; border-radius: 25px; text-align: center; font-weight: 500; }
        .wpdcsm-newsletter-message.success, .wpdcsm-contact-message-result.success { background: #d4edda; color: #155724; border: 2px solid #71b280; }
        .wpdcsm-newsletter-message.error, .wpdcsm-contact-message-result.error { background: #f8d7da; color: #721c24; border: 2px solid #dc3545; }
        @media (max-width: 768px) {
            h1::before { display: none; }
            .wpdcsm-content { padding: 50px 35px; }
            h1 { font-size: <?php echo esc_attr($wpdcsm_data['heading_range'] * 0.75); ?>px; }
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
