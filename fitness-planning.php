<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dysign.fr
 * @since             1.0.0
 * @package           Fitness_Planning
 *
 * @wordpress-plugin
 * Plugin Name:       Fitness Planning
 * Plugin URI:        https://dysign.fr
 * Description:       Easily create and customize interactive plannings for your fitness club : Body Attack, Pump, Combat, Zumba...
 * Version:           1.0.0
 * Author:            Maxime BERNARD-JACQUET
 * Author URI:        https://dysign.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fitness-planning
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fitness-planning-activator.php
 */
function activate_fitness_planning() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/class-fitness-planning-activator.php';
	Fitness_Planning_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fitness-planning-deactivator.php
 */
function deactivate_fitness_planning() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/class-fitness-planning-deactivator.php';
	Fitness_Planning_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fitness_planning' );
register_deactivation_hook( __FILE__, 'deactivate_fitness_planning' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'classes/class-fitness-planning.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_fitness_planning() {

	$plugin = new Fitness_Planning();
	$plugin->run();

}
run_fitness_planning();
