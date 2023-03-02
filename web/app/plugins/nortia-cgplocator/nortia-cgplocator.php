<?php
/*
Plugin Name: Nortia — CGP Locator
Description: Extension nécessaire au fonctionnement du CGP Locator.
Author: Le Pitch
Version: 0.0.1
Author URI: https://wordpress.lepitch-web.com/
*/

/** Absolute path to plugin directory (with trailing slash). */
define( 'NORTIACGP_DIR', trailingslashit( __DIR__ ) );

/** Public URL to plugin directory (with trailing slash). */
define( 'NORTIACGP_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/** Plugin text domain. */
define( 'NORTIACGP_TEXT_DOMAIN', 'nortia-cgplocator' );

/** Plugin version. */
define( 'NORTIACGP_VERSION', '0.0.1' );

// Verify composer autoloader is installed.
if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    add_action( 'admin_notices', function() {
        $class = 'notice notice-error';
        $message = __( 'Error: the composer autoloader does not exist for nortia-cgplocator', NORTIACGP_TEXT_DOMAIN );
        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    });
    return;
}

// Load composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Initialize plugin.
NortiaCGPLocator\NortiaCGPLocator::get_instance();

// On register activate hook, set an option that which triggers  upon the next admin request.
// This allows the fully initialized state of WordPress and all plugin functionalities.
// The option is immediately deleted after firing once, effectively replacing the
// activation hook with higher functional access.
register_activation_hook( __FILE__, function() {
    $option_key = 'NORTIACGP_ACTIVATE';
    update_option( $option_key, 1 );
});

register_deactivation_hook( __FILE__, function() {
    new NortiaCGPLocator\Setup\DeactivatePlugin;
});

//TODO: Disable - Debugging only.
// add_filter( 'wp_queue_default_connection', function() {
// 	return 'sync';
// } );

// Add custom lat/lng fields to posts.
add_action('acf/save_post', 'extract_lat_lng', 20);
function extract_lat_lng( $post_id )
{
    $values = get_field('address', $post_id);

    if (isset($values['lat']) && isset($values['lng'])) {
        update_post_meta($post_id, '_latitude', $values['lat']);
        update_post_meta($post_id, '_longitude', $values['lng']);
    }
}

wp_queue()->cron(1, 1);