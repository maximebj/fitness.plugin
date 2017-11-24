<?php

namespace FitnessPlanning\Entities;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessPlanning\Helpers\Consts;

/**
 * Pre-registered Workouts like Body Attack & Zumba
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Workout extends Entity {

	public function __construct() {
    $this->CPT_slug = Consts::CPT_WORKOUT;

		// Custom fields and thier default values
		$this->fields = array(
			'fitplan_workout_desc' => "",
			'fitplan_workout_pic' => "",
			'fitplan_workout_color' => "#eee",
			'fitplan_workout_url' => "",
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

		$submenu[Consts::PLUGIN_NAME][] = array(
			__('Workouts', 'fitness-planning'),
			'edit_posts',
			'edit.php?post_type='.$this->CPT_slug
		);
	}

	public function register_meta_boxes() {
		add_meta_box('fitness-planning-workout-about', __('About the workout', 'fitness-planning'), array($this, 'render_metabox_about'), $this->CPT_slug, 'normal', 'high');
	}

	public function render_metabox_about($post) {

		// Get custom fields values
		// These methods are in AbstractEntity
		$this->datas = $this->get_custom_fields($post->ID);
		$this->datas['fitplan_workout_pic'] = $this->get_custom_field_image($this->datas, 'fitplan_workout_pic');

		wp_enqueue_media();

    include Consts::get_path().'admin/templates/workout/metabox-about.php';
	}

}
