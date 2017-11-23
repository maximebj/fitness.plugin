<?php

namespace FitnessPlanning;

use FitnessPlanning\Helpers\Consts;
use FitnessPlanning\Helpers\Fields;

use FitnessPlanning\WP\I18n;
use FitnessPlanning\WP\Admin;
use FitnessPlanning\WP\Front;
use FitnessPlanning\WP\Settings;

use FitnessPlanning\Entities\Planning;
use FitnessPlanning\Entities\Workout;
use FitnessPlanning\Entities\Coach;

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

		require_once $path.'classes/WP/I18n.php';
		require_once $path.'classes/WP/Admin.php';
		require_once $path.'classes/WP/Front.php';
		require_once $path.'classes/WP/Settings.php';

		require_once $path.'classes/Entities/AbstractEntity.php';
		require_once $path.'classes/Entities/Planning.php';
		require_once $path.'classes/Entities/Workout.php';
		require_once $path.'classes/Entities/Coach.php';

		require_once $path.'classes/Services/planningServices.php';


		// Init Classes and Hooks
		$plugin_i18n = new I18n();
		$plugin_i18n->register_hooks();

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
