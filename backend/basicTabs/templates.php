<?php
namespace WPDCSM\Backend\BasicTabs;

class Templates {
    
    public static function output($mode = 'coming-soon') {
        // Get the currently selected plugin mode from settings
        $plugin_mode = get_option('wpdcsm_plugin_mode', 'coming-soon');
        
        // Determine which template option to use based on plugin_mode (not tab mode)
        if ($plugin_mode === 'maintenance') {
            $template_option = 'wpdcsm_selected_template_maintenance';
            $selected_template = get_option($template_option, 'maintenance-template-1');
        } elseif ($plugin_mode === 'under-construction') {
            $template_option = 'wpdcsm_selected_template_under-construction';
            $selected_template = get_option($template_option, 'construction-template-1');
        } else {
            // Default to coming-soon
            $template_option = 'wpdcsm_selected_template';
            $selected_template = get_option($template_option, 'template-1');
        }
        
        // Get templates based on the selected plugin mode (not the tab mode)
        $templates = self::get_templates_for_mode($plugin_mode);
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html(self::get_mode_title($plugin_mode)); ?></h2>
            <p><?php echo esc_html(self::get_mode_description($plugin_mode)); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_template">
                <?php wp_nonce_field('wpdcsm_save_template'); ?>
                <input type="hidden" name="template_mode" value="<?php echo esc_attr($plugin_mode); ?>">
                
                <div class="wpdcsm-template-selector" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin: 20px 0;">
                    <?php foreach ($templates as $template_key => $template_info): 
                        $bg_color = isset($template_info['bg']) ? $template_info['bg'] : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                        $preview_image = isset($template_info['image']) ? $template_info['image'] : '';
                        $text_color = (strpos($bg_color, '#0a0e27') !== false || strpos($bg_color, '#2c3e50') !== false || strpos($bg_color, '#1e3c72') !== false) ? '#ffffff' : ((strpos($bg_color, '#ffffff') !== false || strpos($bg_color, '#f8f9fa') !== false || strpos($bg_color, '#f5f7fa') !== false) ? '#333333' : '#ffffff');
                        $has_image = !empty($preview_image);
                    ?>
                        <label class="wpdcsm-template-option" style="display: block; cursor: pointer; border: 3px solid <?php echo ($selected_template === $template_key) ? '#0073aa' : '#ddd'; ?>; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s; background: #fff;">
                            <input type="radio" name="wpdcsm_selected_template" value="<?php echo esc_attr($template_key); ?>" <?php checked($selected_template, $template_key); ?> style="display: none;">
                            <div class="template-preview" style="background: <?php echo $has_image ? 'transparent' : esc_attr($bg_color); ?>; height: 180px; border-radius: 5px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; color: <?php echo esc_attr($text_color); ?>; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); position: relative; overflow: hidden; background-size: cover; background-position: center; <?php echo $has_image ? 'background-image: url(' . esc_url($preview_image) . ');' : ''; ?>">
                                <?php if (!$has_image): ?>
                                <div style="position: absolute; top: 10px; left: 10px; right: 10px; bottom: 10px; border: 2px dashed rgba(255,255,255,0.3); border-radius: 3px; display: flex; align-items: center; justify-content: center;">
                                    <div style="text-align: center; padding: 10px;">
                                        <div style="font-size: 24px; margin-bottom: 8px;">📄</div>
                                        <div><?php echo esc_html($template_info['name']); ?></div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <strong style="color: #333;"><?php echo esc_html($template_info['name']); ?></strong>
                        </label>
                    <?php endforeach; ?>
                </div>
                
                <p class="submit">
                    <button type="submit" class="wpdcsm-save-button button-primary"><?php echo esc_html__('Save Template', 'dream-coming-soon'); ?></button>
                </p>
            </form>
        </div>
        <?php
    }
    
    private static function get_templates_for_mode($mode) {
        $templates = array();
        
        // Plugin URL and directory for images
        $plugin_url = defined('WPDCSM_PLUGIN_URL') ? WPDCSM_PLUGIN_URL : plugin_dir_url(dirname(dirname(__FILE__)));
        $plugin_dir = defined('WPDCSM__PLUGIN_DIR') ? WPDCSM__PLUGIN_DIR : plugin_dir_path(dirname(dirname(__FILE__)));
        
        // Filter templates based on the selected plugin mode
        if ($mode === 'coming-soon') {
            $templates = array(
                'template-1' => array('name' => 'Modern Minimal', 'bg' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'),
                'template-2' => array('name' => 'Creative Studio', 'bg' => 'linear-gradient(135deg, #667eea, #764ba2, #f093fb)'),
                'template-3' => array('name' => 'Bold Gradient', 'bg' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)'),
                'template-4' => array('name' => 'Elegant Classic', 'bg' => 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)'),
                'template-5' => array('name' => 'Dark Mode', 'bg' => '#0a0e27'),
                'template-6' => array('name' => 'Vibrant Colors', 'bg' => 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)'),
                'template-7' => array('name' => 'Clean White', 'bg' => '#ffffff'),
                'template-8' => array('name' => 'Nature Theme', 'bg' => 'linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%)'),
                'template-9' => array('name' => 'Tech Futuristic', 'bg' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'),
                'template-10' => array('name' => 'Corporate Professional', 'bg' => 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)')
            );
        } elseif ($mode === 'maintenance') {
            $templates = array(
                'maintenance-template-1' => array('name' => 'Modern', 'bg' => 'linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)'),
                'maintenance-template-2' => array('name' => 'Classic', 'bg' => 'linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%)'),
                'maintenance-template-3' => array('name' => 'Minimal', 'bg' => '#f8f9fa'),
                'maintenance-template-4' => array('name' => 'Professional', 'bg' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'),
                'maintenance-template-5' => array('name' => 'Elegant', 'bg' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)')
            );
        } elseif ($mode === 'under-construction') {
            $templates = array(
                'construction-template-1' => array('name' => 'Modern', 'bg' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'),
                'construction-template-2' => array('name' => 'Classic', 'bg' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)'),
                'construction-template-3' => array('name' => 'Minimal', 'bg' => '#ffffff'),
                'construction-template-4' => array('name' => 'Professional', 'bg' => 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)'),
                'construction-template-5' => array('name' => 'Elegant', 'bg' => 'linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%)')
            );
        } else {
            // Default to coming-soon templates
            $templates = array(
                'template-1' => array('name' => 'Modern Minimal', 'bg' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'),
                'template-2' => array('name' => 'Creative Studio', 'bg' => 'linear-gradient(135deg, #667eea, #764ba2, #f093fb)'),
                'template-3' => array('name' => 'Bold Gradient', 'bg' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)'),
                'template-4' => array('name' => 'Elegant Classic', 'bg' => 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)'),
                'template-5' => array('name' => 'Dark Mode', 'bg' => '#0a0e27'),
                'template-6' => array('name' => 'Vibrant Colors', 'bg' => 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)'),
                'template-7' => array('name' => 'Clean White', 'bg' => '#ffffff'),
                'template-8' => array('name' => 'Nature Theme', 'bg' => 'linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%)'),
                'template-9' => array('name' => 'Tech Futuristic', 'bg' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'),
                'template-10' => array('name' => 'Corporate Professional', 'bg' => 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)')
            );
        }
        
        // Add image paths to each template based on template key
        foreach ($templates as $template_key => &$template_info) {
            $image_file = $plugin_dir . 'assets/img/templates/' . $template_key . '.jpg';
            $image_url = $plugin_url . 'assets/img/templates/' . $template_key . '.jpg';
            // Only set image URL if file exists
            $template_info['image'] = file_exists($image_file) ? $image_url : '';
        }
        unset($template_info); // Break reference
        
        return $templates;
    }
    
    private static function get_mode_title($mode) {
        $titles = array(
            'coming-soon' => __('Coming Soon Templates', 'dream-coming-soon'),
            'maintenance' => __('Maintenance Mode Templates', 'dream-coming-soon'),
            'under-construction' => __('Under Construction Templates', 'dream-coming-soon'),
            'all' => __('All Templates', 'dream-coming-soon')
        );
        return isset($titles[$mode]) ? $titles[$mode] : __('Templates', 'dream-coming-soon');
    }
    
    private static function get_mode_description($mode) {
        $descriptions = array(
            'coming-soon' => __('Choose a template for your coming soon page. You can customize the content and styling after selecting a template.', 'dream-coming-soon'),
            'maintenance' => __('Choose a template for your maintenance mode page. You can customize the content and styling after selecting a template.', 'dream-coming-soon'),
            'under-construction' => __('Choose a template for your under construction page. You can customize the content and styling after selecting a template.', 'dream-coming-soon'),
            'all' => __('View and select from all available templates for any mode.', 'dream-coming-soon')
        );
        return isset($descriptions[$mode]) ? $descriptions[$mode] : __('Choose a template for your page.', 'dream-coming-soon');
    }
}
