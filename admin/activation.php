<?php

namespace WPDCSM;

class Activation {
    public static function activate() {
        // Create database tables
        self::create_tables();
        
        // Set default options
        self::set_default_options();
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    private static function create_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // Newsletter subscribers table
        $table_name = $wpdb->prefix . 'dcsm_newsletter_subscribers';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            email varchar(255) NOT NULL,
            name varchar(255) DEFAULT '',
            subscribed_date datetime DEFAULT CURRENT_TIMESTAMP,
            status varchar(20) DEFAULT 'subscribed',
            PRIMARY KEY  (id),
            UNIQUE KEY email (email)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        
        // Contact form submissions table
        $table_name = $wpdb->prefix . 'dcsm_contact_submissions';
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            subject varchar(255) DEFAULT '',
            message text NOT NULL,
            submitted_date datetime DEFAULT CURRENT_TIMESTAMP,
            status varchar(20) DEFAULT 'new',
            PRIMARY KEY  (id)
        ) $charset_collate;";
        
        dbDelta($sql);
    }
    
    private static function set_default_options() {
        // Set default template
        if (!get_option('wpdcsm_selected_template')) {
            update_option('wpdcsm_selected_template', 'template-1');
        }
        
        // Set default countdown date (30 days from now)
        if (!get_option('wpdcsm_countdown_date')) {
            update_option('wpdcsm_countdown_date', date('Y-m-d H:i:s', strtotime('+30 days')));
        }
    }
}
