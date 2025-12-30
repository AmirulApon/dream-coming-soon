<?php
namespace WPDCSM\Backend\BasicTabs;

class Settings {

    public static function output() {
        $coming_soon_enabled = get_option('wpdcsm_coming_soon_enabled', 0);
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Coming Soon Mode Status', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Enable or disable the coming soon mode on your website.', 'dream-coming-soon'); ?></p>

            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_settings">
                <?php wp_nonce_field('wpdcsm_save_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_coming_soon_enabled"><?php echo esc_html__('Enable Coming Soon', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="wpdcsm_coming_soon_enabled" id="wpdcsm_coming_soon_enabled" value="1" <?php checked(1, $coming_soon_enabled); ?>>
                                <?php echo esc_html__('Enable coming soon mode', 'dream-coming-soon'); ?>
                            </label>
                            <p class="description"><?php echo esc_html__('When enabled, visitors will see the coming soon page instead of your website.', 'dream-coming-soon'); ?></p>
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
?>
