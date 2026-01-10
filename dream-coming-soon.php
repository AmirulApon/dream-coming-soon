<?php
/* 
 * Plugin Name: Dream Maintenance Mode, Under Construction & Coming Soon Page
 * Description: Dream Maintenance Mode, Under Construction & Coming Soon Page is a powerful plugin that allows you to enable Maintenance Mode, Under Construction Mode, or Coming Soon Mode on your WordPress site. Choose from beautiful templates for each mode with full customization options.
 * Version: 2.0.1
 * Author URI: https://profiles.wordpress.org/dreamscarnival/ 
 * Plugin URI: https://wordpress.org/plugins/dreams-coming-soon-maintenance/
 * Author: Dream Carnival
 * License: GPL v2 or later
 * License URI:http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 6.0
 * Tested up to: 6.9
 * Requires PHP: 7.4
 * Text Domain: dream-coming-soon
 * Domain Path: /languages
 */


/* Prevent direct access to the file */
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

/* * 
 * Define Custom Constant Variables 
 */
define('WPDCSM_VERSION', '2.0.1');
define('WPDCSM__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPDCSM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WPDCSM_FILE', __FILE__);
define('WPDCSM_BASENAME', plugin_basename(__FILE__));
/** 
 * Include the main class 
 */
require_once WPDCSM__PLUGIN_DIR . 'includes/class-wp-dcsm.php';

/* 
 * Include activation, deactivation, and uninstall files 
 */
require_once WPDCSM__PLUGIN_DIR . 'admin/activation.php';
require_once WPDCSM__PLUGIN_DIR . 'admin/deactivation.php';
require_once WPDCSM__PLUGIN_DIR . 'admin/uninstall.php';
require_once WPDCSM__PLUGIN_DIR . 'admin/admin-functions.php';

/* 
 *Include Submenu Class
 */
require_once WPDCSM__PLUGIN_DIR . 'backend/basic-settings.php';


/* 
 *Include BasicTabs Class
 */
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/settings.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/main-content.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/style.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/templates.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/countdown.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/newsletter.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/social.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/contact.php';
require_once WPDCSM__PLUGIN_DIR . 'backend/basicTabs/appearance.php';
require_once WPDCSM__PLUGIN_DIR . 'includes/template-loader.php';

/* 
 *Instantiate the plugin class
 */
$wp_dcsm_plugin = new \WPDCSM\WP_DCSM();

/* 
 * Register activation, deactivation, and uninstall hooks 
 */
register_activation_hook(WPDCSM_FILE, array('WPDCSM\Activation', 'activate'));
register_deactivation_hook(WPDCSM_FILE, array('WPDCSM\Deactivation', 'deactivate'));
register_uninstall_hook(WPDCSM_FILE, array('WPDCSM\Uninstall', 'uninstall'));
