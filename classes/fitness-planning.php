<?php

class Fitness_Planning {

	protected $plugin_name = 'fitness-planning';
	protected $plugin_version = '0.0.1';

	public function run() {

		// Load Classes
		require_once plugin_dir_path(dirname(__FILE__)).'classes/i18n.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin-planning.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin-workout.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin-coach.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin-settings.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/public.php';


		// Init Classes and Hooks
		$plugin_i18n = new Fitness_Planning_i18n();
		$plugin_i18n->register_hooks();

		$class_admin = new Fitness_Planning_Admin();
    $class_admin->register_hooks();

		$class_admin_planning = new Fitness_Planning_Admin_Planning();
    $class_admin_planning->register_hooks();

		$class_admin_workout = new Fitness_Planning_Admin_Workout();
    $class_admin_workout->register_hooks();

		$class_admin_coach = new Fitness_Planning_Admin_Coach();
    $class_admin_coach->register_hooks();

		$class_admin_settings = new Fitness_Planning_Admin_Settings();
		$class_admin_settings->register_hooks();

    $class_public = new Fitness_Planning_Public();
    $class_public->register_hooks();

	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_version() {
		return $this->plugin_version;
	}

}
