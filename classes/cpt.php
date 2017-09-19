<?php

class Fitness_Planning_CPT {

 	public function register_hooks() {
 		add_action('init', array($this, 'define_post_types'));
 	}

 	// Define new post types
 	public function define_post_types() {

 		// Plannings
 		$labels = array(
 		  'name' => __('Plannings', 'fitness-planning'),
 		  'all_items' => __('All plannings', 'fitness-planning'),
 		  'singular_name' => __('Planning', 'fitness-planning'),
 		  'add_new_item' => __('Add a planning', 'fitness-planning'),
 		  'edit_item' => __('Edit planning', 'fitness-planning'),
 		  'not_found' => __('No plannings found.', 'fitness-planning'),
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

 		// Workouts
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

 		register_post_type('workout', $args);

    // Coachs
    $labels = array(
 		  'name' => __('Coachs', 'fitness-planning'),
 		  'all_items' => __('All coachs', 'fitness-planning'),
 		  'singular_name' => __('Coach', 'fitness-planning'),
 		  'add_new_item' => __('Add a coach', 'fitness-planning'),
 		  'edit_item' => __('Edit coach', 'fitness-planning'),
      'not_found' => __('No coachs found.', 'fitness-planning'),
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

 }
