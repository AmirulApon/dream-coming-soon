<?php
namespace WPDCSM\Backend\BasicTabs;

class Contact {
    
    public static function output() {
        // Retrieve settings
        $contact_enabled = get_option('wpdcsm_contact_enabled', 1);
        $contact_title = get_option('wpdcsm_contact_title', 'Get In Touch');
        $contact_description = get_option('wpdcsm_contact_description', 'Have a question? Send us a message!');
        $contact_button_text = get_option('wpdcsm_contact_button_text', 'Send Message');
        $contact_email = get_option('wpdcsm_contact_email', get_option('admin_email'));
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Contact Form Settings', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Configure the contact form on your coming soon page.', 'dream-coming-soon'); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_contact">
                <?php wp_nonce_field('wpdcsm_save_contact'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_contact_enabled"><?php echo esc_html__('Enable Contact Form', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpdcsm_contact_enabled" id="wpdcsm_contact_enabled" value="1" <?php checked(1, $contact_enabled); ?>>
                            <label for="wpdcsm_contact_enabled"><?php echo esc_html__('Show contact form on coming soon page', 'dream-coming-soon'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_contact_title"><?php echo esc_html__('Title', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_contact_title" id="wpdcsm_contact_title" value="<?php echo esc_attr($contact_title); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_contact_description"><?php echo esc_html__('Description', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <textarea name="wpdcsm_contact_description" id="wpdcsm_contact_description" class="large-text" rows="3"><?php echo esc_textarea($contact_description); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_contact_button_text"><?php echo esc_html__('Button Text', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_contact_button_text" id="wpdcsm_contact_button_text" value="<?php echo esc_attr($contact_button_text); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_contact_email"><?php echo esc_html__('Notification Email', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="email" name="wpdcsm_contact_email" id="wpdcsm_contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text">
                            <p class="description"><?php echo esc_html__('Email address to receive contact form submissions', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <button type="submit" class="wpdcsm-save-button button-primary"><?php echo esc_html__('Save Settings', 'dream-coming-soon'); ?></button>
                </p>
            </form>
            
            <hr>
            <p>
                <a href="<?php echo esc_url(admin_url('admin.php?page=wp-dcsm-messages')); ?>" class="button">
                    <?php echo esc_html__('View Messages', 'dream-coming-soon'); ?>
                </a>
            </p>
        </div>
        <?php
    }
}

