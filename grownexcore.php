<?php
/*
Plugin Name: Grownex Core
Author: Grownex
Author URI: http://grownex.com
Version: 1.0.1
Description: This plugin is Required for Grownex WordPress theme
Text Domain: grownexcore
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Extremely simple approach - just disable display_errors for this plugin file
@ini_set('display_errors', 0);

define('GROWNEX_CORE_VERSION', '1.0.1');
define('GROWNEX_CORE', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/');
define('GROWNEX_CORE_ASSETS', trailingslashit(GROWNEX_CORE . 'assets'));

// Load textdomain during init hook
function grownexcore_load_textdomain() {
    load_plugin_textdomain( 'grownexcore', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    // Re-enable error display after textdomain is loaded
    @ini_set('display_errors', 1);
}
add_action( 'init', 'grownexcore_load_textdomain', 1 );


/*
 *  Add CSF
 */
require_once 'inc/library/codestar-framework/codestar-framework.php';

/*
 *  Add Elementor Addons
 */
include_once 'elementor-widgets/custom-widgets-for-elementor.php';

/*
 *  HEADER AND FOOTER BUILDER
 */
include_once 'elementor-widgets/hf-builder/header-footer-builder.php';


/*
 *  Add Grownex Core Function
 */
include_once 'inc/grownexcore-functions.php';

/*
 *  Add Elementor Addons Icon
 */
include_once 'addon-icon.php';

/*
 *  Add Custom WordPress Widgets
 */
if (class_exists('CSF')) {
    include_once 'inc/widgets/custom-widgets.php';
    include_once 'inc/icons.php';
}

/*
 *  Add Custom Post Type
 */
$theme = wp_get_theme();
if ('Grownex' == $theme->name || 'Grownex' == $theme->parent_theme) {
    include_once 'inc/wp-custom-posts.php';
}

// Registering toolkit files
function grownexcore_files()
{
    wp_enqueue_style('grownexcore-custom-widgets', GROWNEX_CORE_ASSETS . 'css/custom-widgets.css', array(), GROWNEX_CORE_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'grownexcore_files');
/**
 * Enqueue Backend Styles And Scripts.
 **/
function grownexcore_backend_css_js($screen)
{
    wp_enqueue_style('bootstrap-icons', get_theme_file_uri('assets/bootstrap/bootstrap-icons.css'), array(), GROWNEX_CORE_VERSION, 'all');
    wp_enqueue_style('fontawesome-all', get_theme_file_uri('assets/css/fontawesome-all.css'), array(), GROWNEX_CORE_VERSION, 'all');
    wp_enqueue_style('flaticon', GROWNEX_CORE_ASSETS . 'css/flaticon.css', array(), GROWNEX_CORE_VERSION, 'all');
}
add_action('admin_enqueue_scripts', 'grownexcore_backend_css_js');

// Support Font Awesome Five Free Version
if (!function_exists('grownex_fontawesome2')) {
    function grownex_fontawesome2()
    {
        wp_enqueue_style('fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all');
        wp_enqueue_style('fa5-v4-shims', 'https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css', array(), '5.13.0', 'all');
    }
    add_action('wp_enqueue_scripts', 'grownex_fontawesome2');
}
