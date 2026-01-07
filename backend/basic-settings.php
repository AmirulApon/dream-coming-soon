<?php
namespace WPDCSM\Backend;

class Basic_Settings {
    public static function output() {
        ?>
        <div class="wrap wpdcsm-admin-wrap">
            <h1 class="wp-heading-inline"><?php echo esc_html(get_admin_page_title()); ?></h1>
    
            <nav class="nav-tab-wrapper">
                <?php self::output_tabs(); ?>
            </nav>
    
            <div class="tab-content" id="wpdcsm-tab-content">
                <?php
                // Output content based on the selected tab
                $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'settings';
    
                if ($active_tab === 'settings') {
                    \WPDCSM\Backend\BasicTabs\Settings::output();
                } elseif ($active_tab === 'templates') {
                    \WPDCSM\Backend\BasicTabs\Templates::output();
                } elseif ($active_tab === 'coming-soon-templates') {
                    \WPDCSM\Backend\BasicTabs\Templates::output('coming-soon');
                } elseif ($active_tab === 'maintenance-templates') {
                    \WPDCSM\Backend\BasicTabs\Templates::output('maintenance');
                } elseif ($active_tab === 'construction-templates') {
                    \WPDCSM\Backend\BasicTabs\Templates::output('under-construction');
                } elseif ($active_tab === 'all-templates') {
                    \WPDCSM\Backend\BasicTabs\Templates::output('all');
                } elseif ($active_tab === 'main-content') {
                    \WPDCSM\Backend\BasicTabs\MainContent::output();
                } elseif ($active_tab === 'countdown') {
                    \WPDCSM\Backend\BasicTabs\Countdown::output();
                } elseif ($active_tab === 'newsletter') {
                    \WPDCSM\Backend\BasicTabs\Newsletter::output();
                } elseif ($active_tab === 'social') {
                    \WPDCSM\Backend\BasicTabs\Social::output();
                } elseif ($active_tab === 'contact') {
                    \WPDCSM\Backend\BasicTabs\Contact::output();
                } elseif ($active_tab === 'appearance') {
                    \WPDCSM\Backend\BasicTabs\Appearance::output();
                } elseif ($active_tab === 'style') {
                    \WPDCSM\Backend\BasicTabs\Style::output();
                }
                ?>
            </div>
        </div>
        <?php
    }

    private static function output_tabs() {
        $tabs = array(
            'settings' => __('Settings', 'dream-coming-soon'),
            'templates' => __('Templates', 'dream-coming-soon'),
            'main-content' => __('Main Content', 'dream-coming-soon'),
            'countdown' => __('Countdown', 'dream-coming-soon'),
            'newsletter' => __('Newsletter', 'dream-coming-soon'),
            'social' => __('Social Media', 'dream-coming-soon'),
            'contact' => __('Contact Form', 'dream-coming-soon'),
            'appearance' => __('Appearance', 'dream-coming-soon'),
            'style' => __('Style', 'dream-coming-soon')
        );

        $active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'settings';

        foreach ($tabs as $tab_key => $tab_title) {
            $tab_url = add_query_arg('tab', $tab_key, admin_url('admin.php?page=wp-dcsm-basic-settings'));
            $is_active = $active_tab === $tab_key;

            printf(
                '<a href="%s" class="nav-tab %s">%s</a>',
                esc_url($tab_url),
                $is_active ? 'nav-tab-active' : '',
                esc_html($tab_title)
            );
        }
    }
}
?>
