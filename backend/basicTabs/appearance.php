<?php
namespace WPDCSM\Backend\BasicTabs;

class Appearance {
    
    public static function output() {
        // Retrieve settings
        $bg_type = get_option('wpdcsm_bg_type', 'color');
        $bg_color = get_option('wpdcsm_bg_color', '#ffffff');
        $bg_image = get_option('wpdcsm_bg_image', '');
        $bg_overlay = get_option('wpdcsm_bg_overlay', '#000000');
        $bg_overlay_opacity = get_option('wpdcsm_bg_overlay_opacity', 0.5);
        $logo_enabled = get_option('wpdcsm_logo_enabled', 0);
        $logo_image = get_option('wpdcsm_logo_image', '');
        $logo_width = get_option('wpdcsm_logo_width', 200);
        $heading_font_family = get_option('wpdcsm_heading_font_family', 'inherit');
        $heading_font_weight = get_option('wpdcsm_heading_font_weight', 'bold');
        $desc_font_family = get_option('wpdcsm_desc_font_family', 'inherit');
        $content_width = get_option('wpdcsm_content_width', 800);
        $content_alignment = get_option('wpdcsm_content_alignment', 'center');
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Appearance Settings', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Customize the visual appearance of your coming soon page.', 'dream-coming-soon'); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_appearance">
                <?php wp_nonce_field('wpdcsm_save_appearance'); ?>
                
                <h3><?php echo esc_html__('Background', 'dream-coming-soon'); ?></h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_bg_type"><?php echo esc_html__('Background Type', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <select name="wpdcsm_bg_type" id="wpdcsm_bg_type">
                                <option value="color" <?php selected($bg_type, 'color'); ?>><?php echo esc_html__('Solid Color', 'dream-coming-soon'); ?></option>
                                <option value="image" <?php selected($bg_type, 'image'); ?>><?php echo esc_html__('Image', 'dream-coming-soon'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="bg-color-row">
                        <th scope="row">
                            <label for="wpdcsm_bg_color"><?php echo esc_html__('Background Color', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <div class="wpdcsm-color-field-wrapper">
                                <input type="color" name="wpdcsm_bg_color" id="wpdcsm_bg_color" value="<?php echo esc_attr($bg_color); ?>" class="wpdcsm-color-input">
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-image-row">
                        <th scope="row">
                            <label for="wpdcsm_bg_image"><?php echo esc_html__('Background Image', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <div class="wpdcsm-image-upload-wrapper">
                                <input type="hidden" name="wpdcsm_bg_image" id="wpdcsm_bg_image" value="<?php echo esc_attr($bg_image); ?>" class="regular-text wpdcsm-image-url">
                                <div class="wpdcsm-image-preview" id="wpdcsm_bg_image_preview">
                                    <?php if (!empty($bg_image)): ?>
                                        <div class="wpdcsm-image-preview-container">
                                            <img src="<?php echo esc_url($bg_image); ?>" alt="Background Preview">
                                            <button type="button" class="wpdcsm-remove-image button" data-target="wpdcsm_bg_image"><?php echo esc_html__('Remove Image', 'dream-coming-soon'); ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="button wpdcsm-upload-image" data-target="wpdcsm_bg_image">
                                    <?php echo !empty($bg_image) ? esc_html__('Change Image', 'dream-coming-soon') : esc_html__('Select Image', 'dream-coming-soon'); ?>
                                </button>
                                <p class="description"><?php echo esc_html__('Select or upload image from WordPress media library', 'dream-coming-soon'); ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-image-row">
                        <th scope="row">
                            <label for="wpdcsm_bg_overlay"><?php echo esc_html__('Overlay Color', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <div class="wpdcsm-color-field-wrapper">
                                <input type="color" name="wpdcsm_bg_overlay" id="wpdcsm_bg_overlay" value="<?php echo esc_attr($bg_overlay); ?>" class="wpdcsm-color-input">
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-image-row">
                        <th scope="row">
                            <label for="wpdcsm_bg_overlay_opacity"><?php echo esc_html__('Overlay Opacity', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="range" name="wpdcsm_bg_overlay_opacity" id="wpdcsm_bg_overlay_opacity" min="0" max="1" step="0.1" value="<?php echo esc_attr($bg_overlay_opacity); ?>" class="regular-text">
                            <span id="overlay_opacity_value"><?php echo esc_attr($bg_overlay_opacity); ?></span>
                        </td>
                    </tr>
                </table>
                
                <h3><?php echo esc_html__('Logo', 'dream-coming-soon'); ?></h3>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_logo_enabled"><?php echo esc_html__('Show Logo', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="wpdcsm_logo_enabled" id="wpdcsm_logo_enabled" value="1" <?php checked(1, $logo_enabled); ?>>
                            <label for="wpdcsm_logo_enabled"><?php echo esc_html__('Display logo on coming soon page', 'dream-coming-soon'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_logo_image"><?php echo esc_html__('Logo Image', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <div class="wpdcsm-image-upload-wrapper">
                                <input type="hidden" name="wpdcsm_logo_image" id="wpdcsm_logo_image" value="<?php echo esc_attr($logo_image); ?>" class="regular-text wpdcsm-image-url">
                                <div class="wpdcsm-image-preview" id="wpdcsm_logo_image_preview">
                                    <?php if (!empty($logo_image)): ?>
                                        <div class="wpdcsm-image-preview-container">
                                            <img src="<?php echo esc_url($logo_image); ?>" alt="Logo Preview">
                                            <button type="button" class="wpdcsm-remove-image button" data-target="wpdcsm_logo_image"><?php echo esc_html__('Remove Logo', 'dream-coming-soon'); ?></button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="button wpdcsm-upload-image" data-target="wpdcsm_logo_image">
                                    <?php echo !empty($logo_image) ? esc_html__('Change Logo', 'dream-coming-soon') : esc_html__('Select Logo', 'dream-coming-soon'); ?>
                                </button>
                                <p class="description"><?php echo esc_html__('Select or upload logo from WordPress media library', 'dream-coming-soon'); ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_logo_width"><?php echo esc_html__('Logo Width (px)', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="wpdcsm_logo_width" id="wpdcsm_logo_width" value="<?php echo esc_attr($logo_width); ?>" class="small-text" min="50" max="500">
                        </td>
                    </tr>
                </table>
                
                <h3><?php echo esc_html__('Typography', 'dream-coming-soon'); ?></h3>
                <div style="clear: both;"></div>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_heading_font_family"><?php echo esc_html__('Heading Font Family', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <select name="wpdcsm_heading_font_family" id="wpdcsm_heading_font_family">
                                <option value="inherit" <?php selected($heading_font_family, 'inherit'); ?>><?php echo esc_html__('Default', 'dream-coming-soon'); ?></option>
                                <option value="Arial, sans-serif" <?php selected($heading_font_family, 'Arial, sans-serif'); ?>>Arial</option>
                                <option value="'Helvetica Neue', Helvetica, sans-serif" <?php selected($heading_font_family, "'Helvetica Neue', Helvetica, sans-serif"); ?>>Helvetica</option>
                                <option value="Georgia, serif" <?php selected($heading_font_family, 'Georgia, serif'); ?>>Georgia</option>
                                <option value="'Times New Roman', serif" <?php selected($heading_font_family, "'Times New Roman', serif"); ?>>Times New Roman</option>
                                <option value="'Courier New', monospace" <?php selected($heading_font_family, "'Courier New', monospace"); ?>>Courier New</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_heading_font_weight"><?php echo esc_html__('Heading Font Weight', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <select name="wpdcsm_heading_font_weight" id="wpdcsm_heading_font_weight">
                                <option value="normal" <?php selected($heading_font_weight, 'normal'); ?>><?php echo esc_html__('Normal', 'dream-coming-soon'); ?></option>
                                <option value="bold" <?php selected($heading_font_weight, 'bold'); ?>><?php echo esc_html__('Bold', 'dream-coming-soon'); ?></option>
                                <option value="300" <?php selected($heading_font_weight, '300'); ?>><?php echo esc_html__('Light (300)', 'dream-coming-soon'); ?></option>
                                <option value="600" <?php selected($heading_font_weight, '600'); ?>><?php echo esc_html__('Semi-Bold (600)', 'dream-coming-soon'); ?></option>
                                <option value="700" <?php selected($heading_font_weight, '700'); ?>><?php echo esc_html__('Bold (700)', 'dream-coming-soon'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_desc_font_family"><?php echo esc_html__('Description Font Family', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <select name="wpdcsm_desc_font_family" id="wpdcsm_desc_font_family">
                                <option value="inherit" <?php selected($desc_font_family, 'inherit'); ?>><?php echo esc_html__('Default', 'dream-coming-soon'); ?></option>
                                <option value="Arial, sans-serif" <?php selected($desc_font_family, 'Arial, sans-serif'); ?>>Arial</option>
                                <option value="'Helvetica Neue', Helvetica, sans-serif" <?php selected($desc_font_family, "'Helvetica Neue', Helvetica, sans-serif"); ?>>Helvetica</option>
                                <option value="Georgia, serif" <?php selected($desc_font_family, 'Georgia, serif'); ?>>Georgia</option>
                                <option value="'Times New Roman', serif" <?php selected($desc_font_family, "'Times New Roman', serif"); ?>>Times New Roman</option>
                            </select>
                        </td>
                    </tr>
                </table>
                
                <h3><?php echo esc_html__('Layout', 'dream-coming-soon'); ?></h3>
                <div style="clear: both;"></div>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_content_width"><?php echo esc_html__('Content Width (px)', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="wpdcsm_content_width" id="wpdcsm_content_width" value="<?php echo esc_attr($content_width); ?>" class="small-text" min="400" max="1200">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpdcsm_content_alignment"><?php echo esc_html__('Content Alignment', 'dream-coming-soon'); ?></label>
                        </th>
                        <td>
                            <select name="wpdcsm_content_alignment" id="wpdcsm_content_alignment">
                                <option value="left" <?php selected($content_alignment, 'left'); ?>><?php echo esc_html__('Left', 'dream-coming-soon'); ?></option>
                                <option value="center" <?php selected($content_alignment, 'center'); ?>><?php echo esc_html__('Center', 'dream-coming-soon'); ?></option>
                                <option value="right" <?php selected($content_alignment, 'right'); ?>><?php echo esc_html__('Right', 'dream-coming-soon'); ?></option>
                            </select>
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

