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
 		);

 		$args = array(
 		  'labels' => $labels,
 		  'public' => false,
 		  'supports' => array('title'),
 		);

 		register_post_type('planning', $args);

 		// Coachs
    $labels = array(
 		  'name' => __('Coachs', 'fitness-planning'),
 		  'all_items' => __('All coachs', 'fitness-planning'),
 		  'singular_name' => __('Coach', 'fitness-planning'),
 		  'add_new_item' => __('Add a coach', 'fitness-planning'),
 		  'edit_item' => __('Edit coach', 'fitness-planning'),
 		);

 		$args = array(
 		  'labels' => $labels,
 		  'public' => false,
 		  'supports' => array('title'),
 		);

 		register_post_type('coach', $args);

 	}

 }
