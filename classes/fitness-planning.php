<?php

class Fitness_Planning {

	public function run() {

		$path = plugin_dir_path(dirname(__FILE__));

		// Load Classes
		require_once $path.'classes/helpers/helper.php';
		require_once $path.'classes/helpers/fields.php';

		require_once $path.'classes/wp/i18n.php';
		require_once $path.'classes/wp/admin.php';
		require_once $path.'classes/wp/public.php';
		require_once $path.'classes/wp/settings.php';

		require_once $path.'classes/entities/abstract-entity.php';
		require_once $path.'classes/entities/planning.php';
		require_once $path.'classes/entities/workout.php';
		require_once $path.'classes/entities/coach.php';

		require_once $path.'classes/services/planningServices.php';


		// Init Classes and Hooks
		$plugin_i18n = new Fitness_Planning_i18n();
		$plugin_i18n->register_hooks();

		$class_admin = new Fitness_Planning_Admin();
    $class_admin->register_hooks();

		$class_public = new Fitness_Planning_Public();
    $class_public->register_hooks();

		$class_planning = new Fitness_Planning_Planning();
    $class_planning->register_hooks();

		$class_workout = new Fitness_Planning_Workout();
    $class_workout->register_hooks();

		$class_coach = new Fitness_Planning_Coach();
    $class_coach->register_hooks();

		$class_settings = new Fitness_Planning_Settings();
		$class_settings->register_hooks();

	}

	public function get_plugin_name() {
		return Fitness_Planning_Helper::PLUGIN_NAME;
	}

	public function get_version() {
		return Fitness_Planning_Helper::VERSION;
	}

}
