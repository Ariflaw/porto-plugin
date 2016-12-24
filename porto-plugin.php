<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.ariflaw.com
 * @since             1.0.0
 * @package           Porto_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Porto Plugin
 * Plugin URI:        http://www.ariflaw.com
 * Description:       Plugin for Porto Themes
 * Version:           0.1.0
 * Author:            Ariflaw
 * Author URI:        http://www.ariflaw.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       porto-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-porto-plugin-activator.php
 */
function activate_porto_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-porto-plugin-activator.php';
	Porto_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-porto-plugin-deactivator.php
 */
function deactivate_porto_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-porto-plugin-deactivator.php';
	Porto_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_porto_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_porto_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-porto-plugin.php';
// require plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-portfolio-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-freebies-post-type-registrations.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$portfolio_post_type_registrations = new Portfolio_Post_Type_Registrations;
// Instantiate registration class, so we can add it as a dependency to main plugin class.
$freebies_post_type_registrations = new Freebies_Post_Type_Registrations;

// // Instantiate main plugin file, so activation callback does not need to be static.
// $post_type = new Post_Type( $portfolio_post_type_registrations );
//
// // Register callback that is fired when the plugin is activated.
// register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$portfolio_post_type_registrations->init();
$freebies_post_type_registrations->init();


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_porto_plugin() {

	$plugin = new Porto_Plugin();
	$plugin->run();

}
run_porto_plugin();
