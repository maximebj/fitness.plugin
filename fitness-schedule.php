<?php

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessSchedule\Initializer;
use FitnessSchedule\WP\Activator;
use FitnessSchedule\WP\Deactivator;

/**
 * Plugin Name:       Fitness Schedule
 * Plugin URI:        https://dysign.fr
 * Description:       Easily create and customize weekly timetables for your fitness club : Body Attack, Pump, Combat, Zumba...
 * Version:           1.3.5
 * Author:            Maxime BERNARD-JACQUET
 * Author URI:        https://dysign.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fitness-schedule
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
	die;
}

function activate_fitness_schedule() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/WP/Activator.php';
	Activator::activate();
}

function deactivate_fitness_schedule() {
	require_once plugin_dir_path( __FILE__ ) . 'classes/WP/Deactivator.php';
	Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fitness_schedule' );
register_deactivation_hook( __FILE__, 'deactivate_fitness_schedule' );

load_plugin_textdomain( 'fitness-schedule', false, basename( __DIR__ ) . '/languages');

require plugin_dir_path( __FILE__ ) . 'classes/Initializer.php';
$fitness_planning = new Initializer();
$fitness_planning->run();
