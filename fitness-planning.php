<?php

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessPlanning\Initializer;
use FitnessPlanning\WP\Activator;
use FitnessPlanning\WP\Deactivator;

/**
 * Plugin Name:       Fitness Schedule
 * Plugin URI:        https://dysign.fr
 * Description:       Easily create and customize weekly timetables for your fitness club : Body Attack, Pump, Combat, Zumba...
 * Version:           1.1.0
 * Author:            Maxime BERNARD-JACQUET
 * Author URI:        https://dysign.fr
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fitness-planning
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
	die;
}

function activate_fitness_planning() {
	require_once plugin_dir_path(__FILE__).'classes/WP/Activator.php';
	Activator::activate();
}

function deactivate_fitness_planning() {
	require_once plugin_dir_path(__FILE__).'classes/WP/Deactivator.php';
	Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_fitness_planning' );
register_deactivation_hook(__FILE__, 'deactivate_fitness_planning' );

load_plugin_textdomain('fitness-planning', false, basename(__DIR__).'/languages');

require plugin_dir_path(__FILE__).'classes/Initializer.php';
$fitness_planning = new Initializer();
$fitness_planning->run();
