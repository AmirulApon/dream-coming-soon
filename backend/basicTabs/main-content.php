<?php
namespace WPDCSM\Backend\BasicTabs;

class MainContent {
    public static function output() {
        // Retrieve the settings
        $wpdcsm_heading = get_option('wpdcsm_heading', 'Coming Soon!');
        $wpdcsm_description = get_option('wpdcsm_description', 'We\'re working on something awesome. Stay tuned!');
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Main Content', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Configure the main heading and description text for your coming soon page.', 'dream-coming-soon'); ?></p>

            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_main_content">
                <?php wp_nonce_field('wpdcsm_save_main_content'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_heading"><?php echo esc_html__('Heading', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_heading" id="wpdcsm_heading" value="<?php echo esc_attr($wpdcsm_heading); ?>" class="regular-text">
                            <p class="description"><?php echo esc_html__('The main heading displayed on your coming soon page', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_description"><?php echo esc_html__('Description', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <textarea name="wpdcsm_description" id="wpdcsm_description" class="large-text" rows="5"><?php echo esc_textarea($wpdcsm_description); ?></textarea>
                            <p class="description"><?php echo esc_html__('A brief description or message for your visitors', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                </table>

                <p class="submit">
                    <button type="submit" class="wpdcsm-save-button button-primary"><?php echo esc_html__('Save Settings', 'dream-coming-soon'); ?></button>
                </p>
            </form>
        </div>
        <?php
    }
}
