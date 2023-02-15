<?php
/*Plugin Name:	Advanced Custom Fields parameters
Description: Advanced Custom Fields parameters
Version:     1.0
Author:     Le Pitch
Author URI:  https://wordpress.lepitch-web.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
*/

/**
 * Place ACF JSON in content directory
 */

add_filter('acf/settings/save_json', function ($path){
    return dirname(__FILE__)  . '/acf-json';
});

add_filter('acf/settings/load_json', function ($path) {
    $paths = [];
    unset($paths[0]);
    $paths[] = dirname(__FILE__)  . '/acf-json';
    return $paths;
});

/**
 * Add ACF options page
 */
add_action('init', function () {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    acf_add_options_page([
        'page_title'    => 'Options',
        'menu_title'    => 'Options',
        'menu_slug'     => 'options',
        'capability'    => 'edit_posts',
        'parent_slug'   => '',
        'position'      => 2, // Below 'Dashboard' menu item
        'icon_url'      => 'dashicons-admin-generic'
    ]);
    acf_add_options_sub_page([
        'page_title'    => 'App Settings',
        'menu_title'    => 'App Settings',
        'menu_slug'     => 'settings',
        'capability'    => 'manage_options',
        'parent_slug'   => 'options'
    ]);
});