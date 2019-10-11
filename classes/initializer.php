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
		require_once $path . 'classes/helpers/consts.php';
		require_once $path . 'classes/helpers/fields.php';

		require_once $path . 'classes/wp/admin.php';
		require_once $path . 'classes/wp/front.php';
		require_once $path . 'classes/wp/settings.php';

		require_once $path . 'classes/entities/abstractentity.php';
		require_once $path . 'classes/entities/planning.php';
		require_once $path . 'classes/entities/workout.php';
		require_once $path . 'classes/entities/coach.php';

		require_once $path . 'classes/services/planningservices.php';


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
