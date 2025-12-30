<?php
namespace WPDCSM\Backend\BasicTabs;

class Newsletter {
    
    public static function output() {
        // Retrieve settings
        $newsletter_enabled = get_option('wpdcsm_newsletter_enabled', 1);
        $newsletter_title = get_option('wpdcsm_newsletter_title', 'Subscribe to Our Newsletter');
        $newsletter_description = get_option('wpdcsm_newsletter_description', 'Get notified when we launch!');
        $newsletter_button_text = get_option('wpdcsm_newsletter_button_text', 'Subscribe');
        $newsletter_show_name = get_option('wpdcsm_newsletter_show_name', 0);
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Newsletter Settings', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Configure the newsletter subscription form on your coming soon page.', 'dream-coming-soon'); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_newsletter">
                <?php wp_nonce_field('wpdcsm_save_newsletter'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_newsletter_enabled"><?php echo esc_html__('Enable Newsletter', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpdcsm_newsletter_enabled" id="wpdcsm_newsletter_enabled" value="1" <?php checked(1, $newsletter_enabled); ?>>
                            <label for="wpdcsm_newsletter_enabled"><?php echo esc_html__('Show newsletter subscription form', 'dream-coming-soon'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_newsletter_title"><?php echo esc_html__('Title', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_newsletter_title" id="wpdcsm_newsletter_title" value="<?php echo esc_attr($newsletter_title); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_newsletter_description"><?php echo esc_html__('Description', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <textarea name="wpdcsm_newsletter_description" id="wpdcsm_newsletter_description" class="large-text" rows="3"><?php echo esc_textarea($newsletter_description); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_newsletter_button_text"><?php echo esc_html__('Button Text', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_newsletter_button_text" id="wpdcsm_newsletter_button_text" value="<?php echo esc_attr($newsletter_button_text); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_newsletter_show_name"><?php echo esc_html__('Show Name Field', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpdcsm_newsletter_show_name" id="wpdcsm_newsletter_show_name" value="1" <?php checked(1, $newsletter_show_name); ?>>
                            <label for="wpdcsm_newsletter_show_name"><?php echo esc_html__('Include name field in subscription form', 'dream-coming-soon'); ?></label>
                        </td>
                    </tr>
                </table>
                
                <p class="submit">
                    <button type="submit" class="wpdcsm-save-button button-primary"><?php echo esc_html__('Save Settings', 'dream-coming-soon'); ?></button>
                </p>
            </form>
            
            <hr>
            <p>
                <a href="<?php echo esc_url(admin_url('admin.php?page=wp-dcsm-subscribers')); ?>" class="button">
                    <?php echo esc_html__('View Subscribers', 'dream-coming-soon'); ?>
                </a>
            </p>
        </div>
        <?php
    }
}

