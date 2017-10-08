<?php

class Fitness_Planning_Admin {

	public function register_hooks() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function enqueue_assets($hook) {
		global $post_type;

		if($hook != 'toplevel_page_fitness-planning' and !in_array($post_type, Fitness_Planning_Helper::get_CPT_list())) {
      return;
    }

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style(
			Fitness_Planning_Helper::PLUGIN_NAME,
			plugin_dir_url(dirname(__FILE__)).'admin/css/fitness-planning-admin.css',
			array(),
			Fitness_Planning_Helper::VERSION,
			'all'
		);

		wp_enqueue_script(
			Fitness_Planning_Helper::PLUGIN_NAME,
			plugin_dir_url(dirname(__FILE__)).'admin/js/fitness-planning-admin.js',
			array('jquery', 'wp-color-picker'),
			Fitness_Planning_Helper::VERSION,
			false
		);

		wp_localize_script(
			Fitness_Planning_Helper::PLUGIN_NAME,
			'fitnessPlanningStrings',
			Fitness_Planning_Helper::strings_to_js()
		);

	}

	public function add_admin_menu() {
		global $submenu;

		add_menu_page(
			'Fitness Planning',
			'Fitness Planning',
			'edit_posts',
			Fitness_Planning_Helper::PLUGIN_NAME,
			null,
			'dashicons-calendar',
			30
		);
	}

}
