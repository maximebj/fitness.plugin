<?php

class Fitness_Planning {

	protected $plugin_name;
	protected $version;

	public function __construct() {

		$this->version = '0.0.1';
		$this->plugin_name = 'fitness-planning';

	}

	public function run() {

		// Load Classes
		require_once plugin_dir_path(dirname(__FILE__)).'classes/i18n.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/cpt.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/admin.php';
		require_once plugin_dir_path(dirname(__FILE__)).'classes/public.php';


		// Init Classes and Hooks
		$plugin_i18n = new Fitness_Planning_i18n();
		$plugin_i18n->register_hooks();

		$plugin_cpt = new Fitness_Planning_CPT();
		$plugin_cpt->register_hooks();

		$class_admin = new Fitness_Planning_Admin($this->get_plugin_name(), $this->get_version());
    $class_admin->register_hooks();

    $class_public = new Fitness_Planning_Public($this->get_plugin_name(), $this->get_version());
    $class_public->register_hooks();

	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_version() {
		return $this->version;
	}

}
