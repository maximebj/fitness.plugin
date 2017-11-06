<?php

class Fitness_Planning {

	public function run() {

		// Load Classes
		require_once plugin_dir_path(dirname(__FILE__)).'classes/helper.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/fields.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/types.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/i18n.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/planning.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/workout.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/coach.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/settings.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/public.php';


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
