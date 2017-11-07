<?php

class Fitness_Planning {

	public function run() {

		$path = plugin_dir_path(dirname(__FILE__));

		// Load Classes
		require_once $path.'classes/Helpers/Consts.php';
		require_once $path.'classes/Helpers/Fields.php';

		require_once $path.'classes/WP/I18n.php';
		require_once $path.'classes/WP/Admin.php';
		require_once $path.'classes/WP/Public.php';
		require_once $path.'classes/WP/Settings.php';

		require_once $path.'classes/Entities/AbstractEntity.php';
		require_once $path.'classes/Entities/Planning.php';
		require_once $path.'classes/Entities/Workout.php';
		require_once $path.'classes/Entities/Coach.php';

		require_once $path.'classes/Services/planningServices.php';


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
		return Fitness_Planning_Consts::PLUGIN_NAME;
	}

	public function get_version() {
		return Fitness_Planning_Consts::VERSION;
	}

}
