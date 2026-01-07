<?php
namespace WPDCSM\Backend\BasicTabs;

class Settings {

    public static function output() {
        $plugin_mode = get_option('wpdcsm_plugin_mode', 'coming-soon');
        $plugin_enabled = get_option('wpdcsm_coming_soon_enabled', 0);
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Plugin Settings', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Choose your mode and enable the plugin to show a maintenance, under construction, or coming soon page to visitors.', 'dream-coming-soon'); ?></p>

            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_settings">
                <?php wp_nonce_field('wpdcsm_save_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_plugin_mode"><?php echo esc_html__('Select Mode', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label>
                                    <input type="radio" name="wpdcsm_plugin_mode" value="coming-soon" <?php checked($plugin_mode, 'coming-soon'); ?>>
                                    <?php echo esc_html__('Coming Soon Mode', 'dream-coming-soon'); ?>
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="wpdcsm_plugin_mode" value="maintenance" <?php checked($plugin_mode, 'maintenance'); ?>>
                                    <?php echo esc_html__('Maintenance Mode', 'dream-coming-soon'); ?>
                                </label>
                                <br>
                                <label>
                                    <input type="radio" name="wpdcsm_plugin_mode" value="under-construction" <?php checked($plugin_mode, 'under-construction'); ?>>
                                    <?php echo esc_html__('Under Construction Mode', 'dream-coming-soon'); ?>
                                </label>
                            </fieldset>
                            <p class="description"><?php echo esc_html__('Select which mode you want to use for your site.', 'dream-coming-soon'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_coming_soon_enabled"><?php echo esc_html__('Enable Plugin', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <label>
                                <input type="checkbox" name="wpdcsm_coming_soon_enabled" id="wpdcsm_coming_soon_enabled" value="1" <?php checked(1, $plugin_enabled); ?>>
                                <?php echo esc_html__('Enable the selected mode', 'dream-coming-soon'); ?>
                            </label>
                            <p class="description"><?php echo esc_html__('When enabled, visitors will see the selected mode page instead of your website.', 'dream-coming-soon'); ?></p>
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
