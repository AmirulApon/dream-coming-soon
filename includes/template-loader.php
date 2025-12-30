<?php

namespace WPDCSM;

class Template_Loader {
    
    public function load_template() {
        // Load template functions and parts
        require_once WPDCSM__PLUGIN_DIR . 'includes/template-functions.php';
        require_once WPDCSM__PLUGIN_DIR . 'includes/template-parts.php';
        
        $template = get_option('wpdcsm_selected_template', 'template-1');
        $template_file = WPDCSM__PLUGIN_DIR . 'templates/' . $template . '.php';
        
        if (file_exists($template_file)) {
            include($template_file);
        } else {
            // Fallback to default template
            include(WPDCSM__PLUGIN_DIR . 'templates/template-1.php');
        }
    }
}

