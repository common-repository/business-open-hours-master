<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://icanwp.com/plugins/business-open-hours-master/
 * @since             1.0.0
 * @package           Business_Open_Hours_Master
 *
 * @wordpress-plugin
 * Plugin Name:       Business Open Hours Master
 * Plugin URI:        https://icanwp.com/plugins/business-open-hours-master/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            iCanWP Team, Sean Roh, Chris Couweleers
 * Author URI:        https://icanwp.com/plugins/business-open-hours-master/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       business-open-hours-master
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-business-open-hours-master-activator.php
 */
function activate_Business_Open_Hours_Master() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-business-open-hours-master-activator.php';
	Business_Open_Hours_Master_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-business-open-hours-master-deactivator.php
 */
function deactivate_Business_Open_Hours_Master() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-business-open-hours-master-deactivator.php';
	Business_Open_Hours_Master_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Business_Open_Hours_Master' );
register_deactivation_hook( __FILE__, 'deactivate_Business_Open_Hours_Master' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-business-open-hours-master.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Business_Open_Hours_Master() {

	$plugin = new Business_Open_Hours_Master();
	$plugin->run();

}
run_Business_Open_Hours_Master();
