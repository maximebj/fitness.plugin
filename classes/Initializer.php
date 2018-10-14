<?php

namespace FitnessSchedule;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessSchedule\Helpers\Consts;
use FitnessSchedule\Helpers\Fields;

use FitnessSchedule\WP\Admin;
use FitnessSchedule\WP\Front;
use FitnessSchedule\WP\Settings;

use FitnessSchedule\Entities\Planning;
use FitnessSchedule\Entities\Workout;
use FitnessSchedule\Entities\Coach;

/**
 * Initialize all the needed plugin classes
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Initializer {

	public function run() {

		$path = plugin_dir_path(dirname(__FILE__));

		// Load Classes
		require_once $path.'classes/Helpers/Consts.php';
		require_once $path.'classes/Helpers/Fields.php';

		require_once $path.'classes/WP/Admin.php';
		require_once $path.'classes/WP/Front.php';
		require_once $path.'classes/WP/Settings.php';

		require_once $path.'classes/Entities/AbstractEntity.php';
		require_once $path.'classes/Entities/Planning.php';
		require_once $path.'classes/Entities/Workout.php';
		require_once $path.'classes/Entities/Coaches.php';

		require_once $path.'classes/Services/PlanningServices.php';


		// Init Classes and Hooks
		$class_admin = new Admin();
    $class_admin->register_hooks();

		$class_public = new Front();
    $class_public->register_hooks();

		$class_planning = new Planning();
    $class_planning->register_hooks();

		$class_workout = new Workout();
    $class_workout->register_hooks();

		$class_coach = new Coach();
    $class_coach->register_hooks();

		$class_settings = new Settings();
		$class_settings->register_hooks();

	}

	public function get_plugin_name() {
		return Consts::PLUGIN_NAME;
	}

	public function get_version() {
		return Consts::VERSION;
	}

}
