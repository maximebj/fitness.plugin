<?php

class Fitness_Planning_Admin_Planning {

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function define_post_types() {

		$labels = array(
 		  'name' => __('Plannings', PLUGIN_NAME),
 		  'all_items' => __('All plannings', PLUGIN_NAME),
 		  'singular_name' => __('Planning', PLUGIN_NAME),
 		  'add_new_item' => __('Add a planning', PLUGIN_NAME),
 		  'edit_item' => __('Edit planning', PLUGIN_NAME),
 		  'not_found' => __('No plannings found.', PLUGIN_NAME),
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

 	 register_post_type('planning', $args);
	}

	public function add_admin_menu() {
		global $submenu;

		$submenu[PLUGIN_NAME][] = array(
			__('Plannings', PLUGIN_NAME),
			'edit_posts',
			'edit.php?post_type=planning'
		);

	}
}
