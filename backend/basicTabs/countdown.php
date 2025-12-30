<?php
namespace WPDCSM\Backend\BasicTabs;

class Countdown {
    
    public static function output() {
        // Retrieve settings
        $countdown_enabled = get_option('wpdcsm_countdown_enabled', 0);
        $countdown_datetime = get_option('wpdcsm_countdown_date', date('Y-m-d H:i:s', strtotime('+30 days')));
        $countdown_label = get_option('wpdcsm_countdown_label', 'We\'re launching in:');
        
        // Split datetime
        $datetime_parts = explode(' ', $countdown_datetime);
        $countdown_date = isset($datetime_parts[0]) ? $datetime_parts[0] : date('Y-m-d', strtotime('+30 days'));
        $countdown_time = isset($datetime_parts[1]) ? substr($datetime_parts[1], 0, 5) : '00:00';
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Countdown Timer', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Configure the countdown timer for your coming soon page.', 'dream-coming-soon'); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_countdown">
                <?php wp_nonce_field('wpdcsm_save_countdown'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_countdown_enabled"><?php echo esc_html__('Enable Countdown', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpdcsm_countdown_enabled" id="wpdcsm_countdown_enabled" value="1" <?php checked(1, $countdown_enabled); ?>>
                            <label for="wpdcsm_countdown_enabled"><?php echo esc_html__('Show countdown timer on coming soon page', 'dream-coming-soon'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_countdown_label"><?php echo esc_html__('Countdown Label', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wpdcsm_countdown_label" id="wpdcsm_countdown_label" value="<?php echo esc_attr($countdown_label); ?>" class="regular-text">
                            <p class="description"><?php echo esc_html__('Text displayed above the countdown timer', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_countdown_date"><?php echo esc_html__('Target Date', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="date" name="wpdcsm_countdown_date" id="wpdcsm_countdown_date" value="<?php echo esc_attr($countdown_date); ?>" class="regular-text">
                            <p class="description"><?php echo esc_html__('The date when your site will launch', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_countdown_time"><?php echo esc_html__('Target Time', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="time" name="wpdcsm_countdown_time" id="wpdcsm_countdown_time" value="<?php echo esc_attr($countdown_time); ?>" class="regular-text">
                            <p class="description"><?php echo esc_html__('The time when your site will launch', 'dream-coming-soon'); ?></p>
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

