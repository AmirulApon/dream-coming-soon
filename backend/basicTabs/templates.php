<?php
namespace WPDCSM\Backend\BasicTabs;

class Templates {
    
    public static function output() {
        $selected_template = get_option('wpdcsm_selected_template', 'template-1');
        
        // Available templates
        $templates = array(
            'template-1' => array('name' => 'Modern Minimal', 'preview' => 'modern-minimal.jpg'),
            'template-2' => array('name' => 'Creative Studio', 'preview' => 'creative-studio.jpg'),
            'template-3' => array('name' => 'Bold Gradient', 'preview' => 'bold-gradient.jpg'),
            'template-4' => array('name' => 'Elegant Classic', 'preview' => 'elegant-classic.jpg'),
            'template-5' => array('name' => 'Dark Mode', 'preview' => 'dark-mode.jpg'),
            'template-6' => array('name' => 'Vibrant Colors', 'preview' => 'vibrant-colors.jpg'),
            'template-7' => array('name' => 'Clean White', 'preview' => 'clean-white.jpg'),
            'template-8' => array('name' => 'Nature Theme', 'preview' => 'nature-theme.jpg'),
            'template-9' => array('name' => 'Tech Futuristic', 'preview' => 'tech-futuristic.jpg'),
            'template-10' => array('name' => 'Corporate Professional', 'preview' => 'corporate-professional.jpg')
        );
        
        ?>
        <div class="wrap">
            <h2><?php echo esc_html__('Select Template', 'dream-coming-soon'); ?></h2>
            <p><?php echo esc_html__('Choose a template for your coming soon page. You can customize the content and styling after selecting a template.', 'dream-coming-soon'); ?></p>
            
            <form class="wpdcsm-settings-form" data-action="wpdcsm_save_template">
                <?php wp_nonce_field('wpdcsm_save_template'); ?>
                
                <div class="wpdcsm-template-selector" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin: 20px 0;">
                    <?php foreach ($templates as $template_key => $template_info): ?>
                        <label class="wpdcsm-template-option" style="display: block; cursor: pointer; border: 3px solid <?php echo ($selected_template === $template_key) ? '#0073aa' : '#ddd'; ?>; border-radius: 8px; padding: 15px; text-align: center; transition: all 0.3s;">
                            <input type="radio" name="wpdcsm_selected_template" value="<?php echo esc_attr($template_key); ?>" <?php checked($selected_template, $template_key); ?> style="display: none;">
                            <div class="template-preview" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 150px; border-radius: 5px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                <?php echo esc_html($template_info['name']); ?>
                            </div>
                            <strong><?php echo esc_html($template_info['name']); ?></strong>
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
}

