<?php

namespace WPDCSM;

use WPDCSM\Backend\Basic_Settings;
use WPDCSM\Backend\BasicTabs\Settings; 

class WP_DCSM {

    // Constructor
    public function __construct() {
        // Actions and filters go here
        add_action('init', array($this, 'wpdcsm_textdomain'));
        add_action('template_redirect', array($this, 'wpdcsm_template_redirect'));
        add_action('admin_menu', array($this, 'wpdcsm_plugin_action_links'));    
        add_action('wp_enqueue_scripts', array($this, 'wpdcsm_enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'wpdcsm_admin_enqueue_scripts'));
        
        // AJAX handlers
        add_action('wp_ajax_wpdcsm_newsletter_subscribe', array($this, 'handle_newsletter_subscribe'));
        add_action('wp_ajax_nopriv_wpdcsm_newsletter_subscribe', array($this, 'handle_newsletter_subscribe'));
        add_action('wp_ajax_wpdcsm_contact_submit', array($this, 'handle_contact_submit'));
        add_action('wp_ajax_nopriv_wpdcsm_contact_submit', array($this, 'handle_contact_submit'));
        
        // Admin AJAX handlers for settings
        add_action('wp_ajax_wpdcsm_save_settings', array($this, 'ajax_save_settings'));
        add_action('wp_ajax_wpdcsm_save_template', array($this, 'ajax_save_template'));
        add_action('wp_ajax_wpdcsm_save_main_content', array($this, 'ajax_save_main_content'));
        add_action('wp_ajax_wpdcsm_save_countdown', array($this, 'ajax_save_countdown'));
        add_action('wp_ajax_wpdcsm_save_newsletter', array($this, 'ajax_save_newsletter'));
        add_action('wp_ajax_wpdcsm_save_social', array($this, 'ajax_save_social'));
        add_action('wp_ajax_wpdcsm_save_contact', array($this, 'ajax_save_contact'));
        add_action('wp_ajax_wpdcsm_save_appearance', array($this, 'ajax_save_appearance'));
        add_action('wp_ajax_wpdcsm_save_style', array($this, 'ajax_save_style'));
    }
    
    // Generic AJAX save handler
    private function parse_form_data($form_data_string) {
        parse_str($form_data_string, $form_data);
        return $form_data;
    }
    
    // AJAX Save Settings
    public function ajax_save_settings() {
        check_ajax_referer('wpdcsm_save_settings', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $coming_soon_enabled = isset($form_data['wpdcsm_coming_soon_enabled']) ? 1 : 0;
        update_option('wpdcsm_coming_soon_enabled', $coming_soon_enabled);
        
        wp_send_json_success(array('message' => __('Settings saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Template
    public function ajax_save_template() {
        check_ajax_referer('wpdcsm_save_template', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $selected_template = isset($form_data['wpdcsm_selected_template']) ? sanitize_text_field($form_data['wpdcsm_selected_template']) : 'template-1';
        update_option('wpdcsm_selected_template', $selected_template);
        
        wp_send_json_success(array('message' => __('Template saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Main Content
    public function ajax_save_main_content() {
        check_ajax_referer('wpdcsm_save_main_content', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $heading = isset($form_data['wpdcsm_heading']) ? sanitize_text_field($form_data['wpdcsm_heading']) : '';
        $description = isset($form_data['wpdcsm_description']) ? sanitize_textarea_field($form_data['wpdcsm_description']) : '';
        
        update_option('wpdcsm_heading', $heading);
        update_option('wpdcsm_description', $description);
        
        wp_send_json_success(array('message' => __('Main content saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Countdown
    public function ajax_save_countdown() {
        check_ajax_referer('wpdcsm_save_countdown', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $countdown_enabled = isset($form_data['wpdcsm_countdown_enabled']) ? 1 : 0;
        $countdown_date = isset($form_data['wpdcsm_countdown_date']) ? sanitize_text_field($form_data['wpdcsm_countdown_date']) : '';
        $countdown_time = isset($form_data['wpdcsm_countdown_time']) ? sanitize_text_field($form_data['wpdcsm_countdown_time']) : '';
        $countdown_label = isset($form_data['wpdcsm_countdown_label']) ? sanitize_text_field($form_data['wpdcsm_countdown_label']) : '';
        
        $full_datetime = $countdown_date . ' ' . $countdown_time;
        
        update_option('wpdcsm_countdown_enabled', $countdown_enabled);
        update_option('wpdcsm_countdown_date', $full_datetime);
        update_option('wpdcsm_countdown_label', $countdown_label);
        
        wp_send_json_success(array('message' => __('Countdown settings saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Newsletter
    public function ajax_save_newsletter() {
        check_ajax_referer('wpdcsm_save_newsletter', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $newsletter_enabled = isset($form_data['wpdcsm_newsletter_enabled']) ? 1 : 0;
        $newsletter_title = isset($form_data['wpdcsm_newsletter_title']) ? sanitize_text_field($form_data['wpdcsm_newsletter_title']) : '';
        $newsletter_description = isset($form_data['wpdcsm_newsletter_description']) ? sanitize_textarea_field($form_data['wpdcsm_newsletter_description']) : '';
        $newsletter_button_text = isset($form_data['wpdcsm_newsletter_button_text']) ? sanitize_text_field($form_data['wpdcsm_newsletter_button_text']) : '';
        $newsletter_show_name = isset($form_data['wpdcsm_newsletter_show_name']) ? 1 : 0;
        
        update_option('wpdcsm_newsletter_enabled', $newsletter_enabled);
        update_option('wpdcsm_newsletter_title', $newsletter_title);
        update_option('wpdcsm_newsletter_description', $newsletter_description);
        update_option('wpdcsm_newsletter_button_text', $newsletter_button_text);
        update_option('wpdcsm_newsletter_show_name', $newsletter_show_name);
        
        wp_send_json_success(array('message' => __('Newsletter settings saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Social
    public function ajax_save_social() {
        check_ajax_referer('wpdcsm_save_social', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $social_enabled = isset($form_data['wpdcsm_social_enabled']) ? 1 : 0;
        $social_title = isset($form_data['wpdcsm_social_title']) ? sanitize_text_field($form_data['wpdcsm_social_title']) : '';
        
        update_option('wpdcsm_social_enabled', $social_enabled);
        update_option('wpdcsm_social_title', $social_title);
        update_option('wpdcsm_social_facebook', isset($form_data['wpdcsm_social_facebook']) ? esc_url_raw($form_data['wpdcsm_social_facebook']) : '');
        update_option('wpdcsm_social_twitter', isset($form_data['wpdcsm_social_twitter']) ? esc_url_raw($form_data['wpdcsm_social_twitter']) : '');
        update_option('wpdcsm_social_instagram', isset($form_data['wpdcsm_social_instagram']) ? esc_url_raw($form_data['wpdcsm_social_instagram']) : '');
        update_option('wpdcsm_social_linkedin', isset($form_data['wpdcsm_social_linkedin']) ? esc_url_raw($form_data['wpdcsm_social_linkedin']) : '');
        update_option('wpdcsm_social_youtube', isset($form_data['wpdcsm_social_youtube']) ? esc_url_raw($form_data['wpdcsm_social_youtube']) : '');
        update_option('wpdcsm_social_pinterest', isset($form_data['wpdcsm_social_pinterest']) ? esc_url_raw($form_data['wpdcsm_social_pinterest']) : '');
        update_option('wpdcsm_social_tiktok', isset($form_data['wpdcsm_social_tiktok']) ? esc_url_raw($form_data['wpdcsm_social_tiktok']) : '');
        update_option('wpdcsm_social_github', isset($form_data['wpdcsm_social_github']) ? esc_url_raw($form_data['wpdcsm_social_github']) : '');
        
        wp_send_json_success(array('message' => __('Social media settings saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Contact
    public function ajax_save_contact() {
        check_ajax_referer('wpdcsm_save_contact', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        $contact_enabled = isset($form_data['wpdcsm_contact_enabled']) ? 1 : 0;
        $contact_title = isset($form_data['wpdcsm_contact_title']) ? sanitize_text_field($form_data['wpdcsm_contact_title']) : '';
        $contact_description = isset($form_data['wpdcsm_contact_description']) ? sanitize_textarea_field($form_data['wpdcsm_contact_description']) : '';
        $contact_button_text = isset($form_data['wpdcsm_contact_button_text']) ? sanitize_text_field($form_data['wpdcsm_contact_button_text']) : '';
        $contact_email = isset($form_data['wpdcsm_contact_email']) ? sanitize_email($form_data['wpdcsm_contact_email']) : '';
        
        update_option('wpdcsm_contact_enabled', $contact_enabled);
        update_option('wpdcsm_contact_title', $contact_title);
        update_option('wpdcsm_contact_description', $contact_description);
        update_option('wpdcsm_contact_button_text', $contact_button_text);
        update_option('wpdcsm_contact_email', $contact_email);
        
        wp_send_json_success(array('message' => __('Contact form settings saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Appearance
    public function ajax_save_appearance() {
        check_ajax_referer('wpdcsm_save_appearance', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        
        $bg_type = isset($form_data['wpdcsm_bg_type']) ? sanitize_text_field($form_data['wpdcsm_bg_type']) : 'color';
        $bg_color = isset($form_data['wpdcsm_bg_color']) ? sanitize_hex_color($form_data['wpdcsm_bg_color']) : '#ffffff';
        $bg_image = isset($form_data['wpdcsm_bg_image']) ? esc_url_raw($form_data['wpdcsm_bg_image']) : '';
        $bg_overlay = isset($form_data['wpdcsm_bg_overlay']) ? sanitize_hex_color($form_data['wpdcsm_bg_overlay']) : '';
        $bg_overlay_opacity = isset($form_data['wpdcsm_bg_overlay_opacity']) ? floatval($form_data['wpdcsm_bg_overlay_opacity']) : 0.5;
        $logo_enabled = isset($form_data['wpdcsm_logo_enabled']) ? 1 : 0;
        $logo_image = isset($form_data['wpdcsm_logo_image']) ? esc_url_raw($form_data['wpdcsm_logo_image']) : '';
        $logo_width = isset($form_data['wpdcsm_logo_width']) ? intval($form_data['wpdcsm_logo_width']) : 200;
        $heading_font_family = isset($form_data['wpdcsm_heading_font_family']) ? sanitize_text_field($form_data['wpdcsm_heading_font_family']) : 'inherit';
        $heading_font_weight = isset($form_data['wpdcsm_heading_font_weight']) ? sanitize_text_field($form_data['wpdcsm_heading_font_weight']) : 'bold';
        $desc_font_family = isset($form_data['wpdcsm_desc_font_family']) ? sanitize_text_field($form_data['wpdcsm_desc_font_family']) : 'inherit';
        $content_width = isset($form_data['wpdcsm_content_width']) ? intval($form_data['wpdcsm_content_width']) : 800;
        $content_alignment = isset($form_data['wpdcsm_content_alignment']) ? sanitize_text_field($form_data['wpdcsm_content_alignment']) : 'center';
        
        update_option('wpdcsm_bg_type', $bg_type);
        update_option('wpdcsm_bg_color', $bg_color);
        update_option('wpdcsm_bg_image', $bg_image);
        update_option('wpdcsm_bg_overlay', $bg_overlay);
        update_option('wpdcsm_bg_overlay_opacity', $bg_overlay_opacity);
        update_option('wpdcsm_logo_enabled', $logo_enabled);
        update_option('wpdcsm_logo_image', $logo_image);
        update_option('wpdcsm_logo_width', $logo_width);
        update_option('wpdcsm_heading_font_family', $heading_font_family);
        update_option('wpdcsm_heading_font_weight', $heading_font_weight);
        update_option('wpdcsm_desc_font_family', $desc_font_family);
        update_option('wpdcsm_content_width', $content_width);
        update_option('wpdcsm_content_alignment', $content_alignment);
        
        wp_send_json_success(array('message' => __('Appearance settings saved successfully!', 'dream-coming-soon')));
    }
    
    // AJAX Save Style
    public function ajax_save_style() {
        check_ajax_referer('wpdcsm_save_style', '_wpnonce');
        
        $form_data = $this->parse_form_data($_POST['form_data']);
        
        $heading_color = isset($form_data['wpdcsm_heading_color']) ? sanitize_hex_color($form_data['wpdcsm_heading_color']) : '#000000';
        $bg_color = isset($form_data['wpdcsm_bg_color']) ? sanitize_hex_color($form_data['wpdcsm_bg_color']) : '#ffffff';
        $section_bg_color = isset($form_data['wpdcsm_section_bg_color']) ? sanitize_hex_color($form_data['wpdcsm_section_bg_color']) : '#ffffff';
        $desc_color = isset($form_data['wpdcsm_desc_color']) ? sanitize_hex_color($form_data['wpdcsm_desc_color']) : '#000000';
        $wpdcsm_heading_range = isset($form_data['wpdcsm_heading_range']) ? intval($form_data['wpdcsm_heading_range']) : 50;
        $wpdcsm_desc_range = isset($form_data['wpdcsm_desc_range']) ? intval($form_data['wpdcsm_desc_range']) : 50;
        
        update_option('wpdcsm_heading_color', $heading_color);
        update_option('wpdcsm_bg_color', $bg_color);
        update_option('wpdcsm_section_bg_color', $section_bg_color);
        update_option('wpdcsm_desc_color', $desc_color);
        update_option('wpdcsm_heading_range', $wpdcsm_heading_range);
        update_option('wpdcsm_desc_range', $wpdcsm_desc_range);
        
        wp_send_json_success(array('message' => __('Style settings saved successfully!', 'dream-coming-soon')));
    }
    
    // Enqueue frontend scripts
    public function wpdcsm_enqueue_scripts() {
        $coming_soon_enabled = get_option('wpdcsm_coming_soon_enabled');
        if ($coming_soon_enabled) {
            wp_enqueue_style('wpdcsm-frontend', WPDCSM_PLUGIN_URL . 'assets/css/frontend.css', array(), WPDCSM_VERSION);
            wp_enqueue_script('wpdcsm-countdown', WPDCSM_PLUGIN_URL . 'assets/js/countdown.js', array('jquery'), WPDCSM_VERSION, true);
            wp_enqueue_script('wpdcsm-frontend', WPDCSM_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), WPDCSM_VERSION, true);
            
            wp_localize_script('wpdcsm-frontend', 'wpdcsm', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('wpdcsm_nonce')
            ));
        }
    }
    
    // Enqueue admin scripts
    public function wpdcsm_admin_enqueue_scripts($hook) {
        if (strpos($hook, 'wp-dcsm') === false) {
            return;
        }
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_media();
        wp_enqueue_style('wpdcsm-admin', WPDCSM_PLUGIN_URL . 'assets/css/admin.css', array(), WPDCSM_VERSION);
        wp_enqueue_script('wpdcsm-admin', WPDCSM_PLUGIN_URL . 'assets/js/admin.js', array('jquery', 'wp-color-picker'), WPDCSM_VERSION, true);
        
        wp_localize_script('wpdcsm-admin', 'wpdcsm_admin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'strings' => array(
                'selectImage' => __('Select Image', 'dream-coming-soon'),
                'changeImage' => __('Change Image', 'dream-coming-soon'),
                'removeImage' => __('Remove Image', 'dream-coming-soon'),
                'selectLogo' => __('Select Logo', 'dream-coming-soon'),
                'changeLogo' => __('Change Logo', 'dream-coming-soon'),
                'removeLogo' => __('Remove Logo', 'dream-coming-soon'),
                'saving' => __('Saving...', 'dream-coming-soon'),
                'error' => __('An error occurred. Please try again.', 'dream-coming-soon'),
                'errorSaving' => __('An error occurred while saving.', 'dream-coming-soon')
            )
        ));
    }
    
    // AJAX handler for newsletter subscription
    public function handle_newsletter_subscribe() {
        check_ajax_referer('wpdcsm_nonce', 'nonce');
        
        $email = sanitize_email($_POST['email']);
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        
        if (!is_email($email)) {
            wp_send_json_error(array('message' => __('Please enter a valid email address.', 'dream-coming-soon')));
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'dcsm_newsletter_subscribers';
        
        $result = $wpdb->insert(
            $table_name,
            array(
                'email' => $email,
                'name' => $name,
                'subscribed_date' => current_time('mysql'),
                'status' => 'subscribed'
            ),
            array('%s', '%s', '%s', '%s')
        );
        
        if ($result) {
            wp_send_json_success(array('message' => __('Thank you for subscribing!', 'dream-coming-soon')));
        } else {
            if ($wpdb->last_error) {
                if (strpos($wpdb->last_error, 'Duplicate') !== false) {
                    wp_send_json_error(array('message' => __('You are already subscribed!', 'dream-coming-soon')));
                }
            }
            wp_send_json_error(array('message' => __('An error occurred. Please try again.', 'dream-coming-soon')));
        }
    }
    
    // AJAX handler for contact form
    public function handle_contact_submit() {
        check_ajax_referer('wpdcsm_nonce', 'nonce');
        
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : '';
        $message = sanitize_textarea_field($_POST['message']);
        
        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error(array('message' => __('Please fill in all required fields.', 'dream-coming-soon')));
        }
        
        if (!is_email($email)) {
            wp_send_json_error(array('message' => __('Please enter a valid email address.', 'dream-coming-soon')));
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'dcsm_contact_submissions';
        
        $result = $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'submitted_date' => current_time('mysql'),
                'status' => 'new'
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s')
        );
        
        if ($result) {
            // Optionally send email notification
            $admin_email = get_option('admin_email');
            $email_subject = sprintf(__('New Contact Form Submission: %s', 'dream-coming-soon'), $subject);
            $email_message = sprintf(__("Name: %s\nEmail: %s\nSubject: %s\n\nMessage:\n%s", 'dream-coming-soon'), $name, $email, $subject, $message);
            wp_mail($admin_email, $email_subject, $email_message);
            
            wp_send_json_success(array('message' => __('Thank you for your message. We will get back to you soon!', 'dream-coming-soon')));
        } else {
            wp_send_json_error(array('message' => __('An error occurred. Please try again.', 'dream-coming-soon')));
        }
    }

    // Initialization
    public function wpdcsm_textdomain() {
        // Load plugin text domain
        load_plugin_textdomain('dream-coming-soon', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    // Template Redirect Action
    public function wpdcsm_template_redirect() {
        // Check if on the admin side or during AJAX request
        if (is_admin() || defined('DOING_AJAX')) {
            return;
        }

        $coming_soon_enabled = get_option('wpdcsm_coming_soon_enabled');

        // Check if "Coming Soon" mode is enabled
        if ($coming_soon_enabled) {
            // Use template loader
            $template_loader = new \WPDCSM\Template_Loader();
            $template_loader->load_template();
            exit();
        }

    }
 

    // Plugin Action Links
    public function wpdcsm_plugin_action_links() {
        // Add a main menu item
        add_menu_page(
            __('Coming Soon', 'dream-coming-soon'),
            __('Coming Soon', 'dream-coming-soon'),
            'manage_options',
            'wp-dcsm-settings',
            array($this, 'settings_page')
        );

        // Add submenus
        add_submenu_page(
            'wp-dcsm-settings',
            __('Basic Settings', 'dream-coming-soon'),
            __('Basic Settings', 'dream-coming-soon'),
            'manage_options',
            'wp-dcsm-basic-settings',
            array(Basic_Settings::class, 'output')
        );

        // Newsletter Subscribers
        add_submenu_page(
            'wp-dcsm-settings',
            __('Newsletter Subscribers', 'dream-coming-soon'),
            __('Subscribers', 'dream-coming-soon'),
            'manage_options',
            'wp-dcsm-subscribers',
            array($this, 'subscribers_page')
        );
        
        // Contact Submissions
        add_submenu_page(
            'wp-dcsm-settings',
            __('Contact Submissions', 'dream-coming-soon'),
            __('Messages', 'dream-coming-soon'),
            'manage_options',
            'wp-dcsm-messages',
            array($this, 'messages_page')
        );

        // Remove the first submenu
        remove_submenu_page('wp-dcsm-settings', 'wp-dcsm-settings');
    }

    // Main Settings Page
    public function settings_page() {
        // Output your main settings page HTML here
        ?>
        <h1></h1>
        <?php
    }
    
    // Newsletter Subscribers Page
    public function subscribers_page() {
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $subscriber_id = intval($_GET['id']);
            check_admin_referer('delete_subscriber_' . $subscriber_id);
            global $wpdb;
            $table_name = $wpdb->prefix . 'dcsm_newsletter_subscribers';
            $wpdb->delete($table_name, array('id' => $subscriber_id), array('%d'));
            echo '<div class="notice notice-success"><p>' . esc_html__('Subscriber deleted successfully.', 'dream-coming-soon') . '</p></div>';
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'dcsm_newsletter_subscribers';
        $table_name_escaped = esc_sql($table_name);
        $subscribers = $wpdb->get_results("SELECT * FROM {$table_name_escaped} ORDER BY subscribed_date DESC");
        
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Newsletter Subscribers', 'dream-coming-soon'); ?></h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('ID', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Email', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Name', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Subscribed Date', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Status', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Actions', 'dream-coming-soon'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($subscribers): ?>
                        <?php foreach ($subscribers as $subscriber): ?>
                            <tr>
                                <td><?php echo esc_html($subscriber->id); ?></td>
                                <td><?php echo esc_html($subscriber->email); ?></td>
                                <td><?php echo esc_html($subscriber->name); ?></td>
                                <td><?php echo esc_html($subscriber->subscribed_date); ?></td>
                                <td><?php echo esc_html($subscriber->status); ?></td>
                                <td>
                                    <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'delete', 'id' => $subscriber->id)), 'delete_subscriber_' . $subscriber->id)); ?>" class="button button-small" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to delete this subscriber?', 'dream-coming-soon')); ?>');"><?php echo esc_html__('Delete', 'dream-coming-soon'); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6"><?php echo esc_html__('No subscribers found.', 'dream-coming-soon'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    // Contact Messages Page
    public function messages_page() {
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $message_id = intval($_GET['id']);
            check_admin_referer('delete_message_' . $message_id);
            global $wpdb;
            $table_name = $wpdb->prefix . 'dcsm_contact_submissions';
            $wpdb->delete($table_name, array('id' => $message_id), array('%d'));
            echo '<div class="notice notice-success"><p>' . esc_html__('Message deleted successfully.', 'dream-coming-soon') . '</p></div>';
        }
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'dcsm_contact_submissions';
        $table_name_escaped = esc_sql($table_name);
        $messages = $wpdb->get_results("SELECT * FROM {$table_name_escaped} ORDER BY submitted_date DESC");
        
        ?>
        <div class="wrap">
            <h1><?php echo esc_html__('Contact Form Messages', 'dream-coming-soon'); ?></h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('ID', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Name', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Email', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Subject', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Message', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Date', 'dream-coming-soon'); ?></th>
                        <th><?php echo esc_html__('Actions', 'dream-coming-soon'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($messages): ?>
                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?php echo esc_html($message->id); ?></td>
                                <td><?php echo esc_html($message->name); ?></td>
                                <td><?php echo esc_html($message->email); ?></td>
                                <td><?php echo esc_html($message->subject); ?></td>
                                <td><?php echo esc_html(wp_trim_words($message->message, 20)); ?></td>
                                <td><?php echo esc_html($message->submitted_date); ?></td>
                                <td>
                                    <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'delete', 'id' => $message->id)), 'delete_message_' . $message->id)); ?>" class="button button-small" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to delete this message?', 'dream-coming-soon')); ?>');"><?php echo esc_html__('Delete', 'dream-coming-soon'); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7"><?php echo esc_html__('No messages found.', 'dream-coming-soon'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}