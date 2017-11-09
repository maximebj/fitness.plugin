<?php

/**
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

if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_fitness_planning() {
	require_once plugin_dir_path( __FILE__ ).'classes/WP/Activator.php';
	Fitness_Planning_Activator::activate();
}

function deactivate_fitness_planning() {
	require_once plugin_dir_path( __FILE__ ).'classes/WP/Deactivator.php';
	Fitness_Planning_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fitness_planning' );
register_deactivation_hook( __FILE__, 'deactivate_fitness_planning' );


require plugin_dir_path( __FILE__ ).'classes/fitness-planning.php';
$fitness_planning = new Fitness_Planning();
$fitness_planning->run();
