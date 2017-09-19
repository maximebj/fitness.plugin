<?php

class Fitness_Planning_Admin_Coach {

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function define_post_types() {

	 $labels = array(
			'name' => __('Coachs', PLUGIN_NAME),
			'all_items' => __('All coachs', PLUGIN_NAME),
			'singular_name' => __('Coach', PLUGIN_NAME),
			'add_new_item' => __('Add a coach', PLUGIN_NAME),
			'edit_item' => __('Edit coach', PLUGIN_NAME),
		  'not_found' => __('No coachs found.', PLUGIN_NAME),
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
		  'exclude_from_search' => true,
		  'publicly_queryable' => false,
		  'show_in_nav_menus' => false,
		  'show_in_menu' => false,
			'supports' => array('title'),
		);

		register_post_type('coach', $args);
	}

	public function add_admin_menu() {
		global $submenu;

		$submenu[PLUGIN_NAME][] = array(
			__('Coachs', PLUGIN_NAME),
			'edit_posts',
			'edit.php?post_type=coach'
		);

	}
}
