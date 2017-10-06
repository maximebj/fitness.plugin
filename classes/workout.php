<?php

class Fitness_Planning_Workout extends Fitness_Planning_Types {

	public function __construct() {
    $this->CPT_slug = Fitness_Planning_Helper::CPT_WORKOUT;
		$this->fields = array(
			'fitplan_workout_desc',
			'fitplan_workout_pic',
			'fitplan_workout_duration',
		);
  }

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
		add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
		add_action('save_post', array($this, 'save_custom_fields'), 10, 3);
	}

	public function define_post_types() {

		$labels = array(
 		  'name' => __('Workouts', 'fitness-planning'),
 		  'all_items' => __('All workouts', 'fitness-planning'),
 		  'singular_name' => __('Workout', 'fitness-planning'),
 		  'add_new_item' => __('Add a workout', 'fitness-planning'),
 		  'edit_item' => __('Edit workout', 'fitness-planning'),
      'not_found' => __('No workout found.', 'fitness-planning'),
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

 		register_post_type($this->CPT_slug, $args);
	}

	public function add_admin_menu() {
		global $submenu;

		$submenu[Fitness_Planning_Helper::PLUGIN_NAME][] = array(
			__('Workouts', 'fitness-planning'),
			'edit_posts',
			'edit.php?post_type='.$this->CPT_slug
		);
	}

	public function register_meta_boxes() {
		add_meta_box('fitness-planning-workout-about', __('About the workout', 'fitness-planning'), array($this, 'render_metabox_about'), $this->CPT_slug, 'normal', 'high');
	}

	public function render_metabox_about($post) {
    include plugin_dir_path(dirname(__FILE__)).'admin/templates/workout-metabox-about.php';
	}

}
