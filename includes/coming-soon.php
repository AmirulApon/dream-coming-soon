<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Hook to enqueue styles
add_action( 'wp_enqueue_scripts', 'enqueue_coming_soon_styles' );

function enqueue_coming_soon_styles() {
    // Adjust condition to target specific pages if needed
    $version = "1.0.0";
    wp_enqueue_style( 'coming-soon-style', WPDCSM_PLUGIN_URL. "assets/css/backend.css", array(), $version );
}

// Fetch settings values
$heading = get_option('wpdcsm_heading', 'Coming Soon!');
$description = get_option('wpdcsm_description', 'We\'re working on something awesome. Stay tuned!');
$wpdcsm_heading_color = get_option('wpdcsm_heading_color', '#000000');
$wpdcsm_bg_color = get_option('wpdcsm_bg_color', '#ffffff');
$wpdcsm_bg_section_color = get_option('wpdcsm_section_bg_color', '#ffffff');
$wpdcsm_desc_color = get_option('wpdcsm_desc_color', '#000000');
$wpdcsm_heading_range = get_option('wpdcsm_heading_range', 50);
$wpdcsm_desc_range = get_option('wpdcsm_desc_range', 50);

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html__('Coming Soon', 'dream-coming-soon'); ?></title>
    <style>
        .coming-soon-container {
            background-color: <?php echo esc_attr($wpdcsm_bg_color); ?>;
        }
        .coming-soon-container-main {
            background-color: <?php echo esc_attr($wpdcsm_bg_section_color); ?>;
        }
        .coming-soon-title {
            color: <?php echo esc_attr($wpdcsm_heading_color); ?>;
            font-size: <?php echo esc_attr($wpdcsm_heading_range); ?>px;
        }
        .coming-soon-message {
            color: <?php echo esc_attr($wpdcsm_desc_color); ?>;
            font-size: <?php echo esc_attr($wpdcsm_desc_range); ?>px;
        }
    </style>
    <?php wp_head(); // This function call is necessary for WordPress to enqueue styles and scripts properly ?>
</head>
<body>
    <div class="coming-soon-container">
        <div class="coming-soon-container-main">
            <h1 class="coming-soon-title"><?php echo esc_html($heading); ?></h1>
            <p class="coming-soon-message"><?php echo esc_html($description); ?></p>
            
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" name="email" placeholder="<?php echo esc_attr__('Enter your email', 'dream-coming-soon'); ?>" required>
                <button type="submit" class="newsletter-button"><?php echo esc_html__('Subscribe', 'dream-coming-soon'); ?></button>
            </form>
        </div>
    </div>
    <?php wp_footer(); // This function call is necessary for WordPress to enqueue scripts properly ?>
</body>
</html>
