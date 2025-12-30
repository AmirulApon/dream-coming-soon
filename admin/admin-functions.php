<?php

// Check if called from the main plugin file
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

// Define plugin version if not already defined
if (!defined('WPDCSM_VERSION')) {
    define('WPDCSM_VERSION', '1.0.1');
}

// Your admin-related functions go here

function wpdcsm_admin_enqueue_scripts() {
     
    wp_enqueue_script('jquery');
    

    $plugin_url = WPDCSM_PLUGIN_URL;
    
    wp_enqueue_style(
        'wpdcsm-backend',
        $plugin_url . 'assets/css/backend.css',
        array(),
        WPDCSM_VERSION
    );
    

    // Localize script with data that needs to be available in your JavaScript file
    wp_localize_script('wpdcsm-admin-script', 'wpdcsm_script_vars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        // Add more variables as needed
    ));
}

add_action('admin_enqueue_scripts', 'wpdcsm_admin_enqueue_scripts');
?>
