<?php
namespace WPDCSM\Backend\BasicTabs;

class Style {
    public static function output() {
        // Retrieve the settings
        $wpdcsm_heading_color = get_option('wpdcsm_heading_color', '#000000');
        $wpdcsm_bg_color = get_option('wpdcsm_bg_color', '#ffffff');
        $wpdcsm_section_bg_color = get_option('wpdcsm_section_bg_color', '#ffffff');
        $wpdcsm_desc_color = get_option('wpdcsm_desc_color', '#000000');
        $wpdcsm_heading_range = get_option('wpdcsm_heading_range', 50);
        $wpdcsm_desc_range = get_option('wpdcsm_desc_range', 20);

        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Style', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Customize colors and font sizes for your coming soon page.', 'dream-coming-soon'); ?></p>

            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_style">
                <?php wp_nonce_field('wpdcsm_save_style'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_bg_color"><?php echo esc_html__('Background Color', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <div class="wpdcsm-color-fields-row">
                                <div class="wpdcsm-color-field-wrapper">
                                    <label for="wpdcsm_bg_color"><?php echo esc_html__('Background', 'dream-coming-soon'); ?></label>
                                    <input type="color" name="wpdcsm_bg_color" id="wpdcsm_bg_color" value="<?php echo esc_attr($wpdcsm_bg_color); ?>" class="wpdcsm-color-input">
                                </div>
                                <div class="wpdcsm-color-field-wrapper">
                                    <label for="wpdcsm_section_bg_color"><?php echo esc_html__('Section Background', 'dream-coming-soon'); ?></label>
                                    <input type="color" name="wpdcsm_section_bg_color" id="wpdcsm_section_bg_color" value="<?php echo esc_attr($wpdcsm_section_bg_color); ?>" class="wpdcsm-color-input">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_heading_color"><?php echo esc_html__('Text Colors', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <div class="wpdcsm-color-fields-row">
                                <div class="wpdcsm-color-field-wrapper">
                                    <label for="wpdcsm_heading_color"><?php echo esc_html__('Heading', 'dream-coming-soon'); ?></label>
                                    <input type="color" name="wpdcsm_heading_color" id="wpdcsm_heading_color" value="<?php echo esc_attr($wpdcsm_heading_color); ?>" class="wpdcsm-color-input">
                                </div>
                                <div class="wpdcsm-color-field-wrapper">
                                    <label for="wpdcsm_desc_color"><?php echo esc_html__('Description', 'dream-coming-soon'); ?></label>
                                    <input type="color" name="wpdcsm_desc_color" id="wpdcsm_desc_color" value="<?php echo esc_attr($wpdcsm_desc_color); ?>" class="wpdcsm-color-input">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_heading_range"><?php echo esc_html__('Heading Font Size', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="range" name="wpdcsm_heading_range" id="wpdcsm_heading_range" min="20" max="100" value="<?php echo esc_attr($wpdcsm_heading_range); ?>" class="regular-text">
                            <span id="heading_range_value"><?php echo esc_attr($wpdcsm_heading_range); ?></span>px
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_desc_range"><?php echo esc_html__('Description Font Size', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="range" name="wpdcsm_desc_range" id="wpdcsm_desc_range" min="12" max="30" value="<?php echo esc_attr($wpdcsm_desc_range); ?>" class="regular-text">
                            <span id="desc_range_value"><?php echo esc_attr($wpdcsm_desc_range); ?></span>px
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
