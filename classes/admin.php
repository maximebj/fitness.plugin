<?php

class Fitness_Planning_Admin {

	public function register_hooks() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function enqueue_styles() {
		wp_enqueue_style('fitness-planning', plugin_dir_url(__FILE__).'css/fitness-planning-admin.css', array(), PLUGIN_VERSION, 'all');
	}

	public function enqueue_scripts() {
		wp_enqueue_script('fitness-planning', plugin_dir_url( __FILE__ ).'js/fitness-planning-admin.js', array('jquery'), PLUGIN_VERSION, false );
	}

	public function add_admin_menu() {
		global $submenu;

		add_menu_page(
			'Fitness Planning',
			'Fitness Planning',
			'edit_posts',
			'fitness-planning',
			null,
			'dashicons-calendar',
			30
		);
	}
}
