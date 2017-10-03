<?php

class Fitness_Planning_Admin {

	public function register_hooks() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function enqueue_assets($hook) {
		global $post_type;

		$plugin_cpts = array(
			Fitness_Planning_Admin_Workout::CPT_SLUG,
			Fitness_Planning_Admin_Planning::CPT_SLUG,
			Fitness_Planning_Admin_Coach::CPT_SLUG,
		);

		if($hook != 'toplevel_page_fitness-planning' and !in_array($post_type, $plugin_cpts)) {
      return;
    }

		wp_enqueue_style(Fitness_Planning_Helper::PLUGIN_NAME, plugin_dir_url(__FILE__).'css/fitness-planning-admin.css', array(), '1.0', 'all');
		wp_enqueue_script(Fitness_Planning_Helper::PLUGIN_NAME, plugin_dir_url(__FILE__).'js/fitness-planning-admin.js', array('jquery'), '1.0', false );
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
