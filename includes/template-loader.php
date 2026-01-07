<?php

namespace WPDCSM;

class Template_Loader {
    
    public function load_template() {
        // Load template functions and parts
        require_once WPDCSM__PLUGIN_DIR . 'includes/template-functions.php';
        require_once WPDCSM__PLUGIN_DIR . 'includes/template-parts.php';
        
        $plugin_mode = get_option('wpdcsm_plugin_mode', 'coming-soon');
        
        // Get template based on mode
        if ($plugin_mode === 'maintenance') {
            $template_option = 'wpdcsm_selected_template_maintenance';
            $default_template = 'maintenance-template-1';
        } elseif ($plugin_mode === 'under-construction') {
            $template_option = 'wpdcsm_selected_template_under-construction';
            $default_template = 'construction-template-1';
        } else {
            $template_option = 'wpdcsm_selected_template';
            $default_template = 'template-1';
        }
        
        $template = get_option($template_option, $default_template);
        
        // Fallback to main template option if mode-specific option doesn't exist
        if (empty($template) || $template === $default_template) {
            $template = get_option('wpdcsm_selected_template', $default_template);
        }
        
        $template_file = WPDCSM__PLUGIN_DIR . 'templates/' . $template . '.php';
        
        if (file_exists($template_file)) {
            include($template_file);
        } else {
            // Fallback to default template based on mode
            $fallback_template = WPDCSM__PLUGIN_DIR . 'templates/' . $default_template . '.php';
            if (file_exists($fallback_template)) {
                include($fallback_template);
            } else {
                // Ultimate fallback
                include(WPDCSM__PLUGIN_DIR . 'templates/template-1.php');
            }
        }
    }
}

