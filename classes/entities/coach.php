<?php

namespace FitnessPlanning\Entities;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessPlanning\Helpers\Consts;

/**
 * Coachs to be attached to a Workout in a Planning
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Coach extends Entity {

	public function __construct() {
    $this->CPT_slug = Consts::CPT_COACH;

    // Custom fields and thier default values
    $this->fields = array(
			'fitplan_coach_pic' => array("type" => "picture", "default" => ""),
			'fitplan_coach_bio' => array("type" => "text", "default" => ""),
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
			'show_in_menu' => false,
			'supports' => array('title'),
		);

		if(get_option('fitplan_coach_archive')) {
			$args_compl = array(
				'has_archive' => true,
				'rewrite' => array(
					'slug' => _x('coachs', 'Post type slug', 'fitness-planning'),
					'with_front' => apply_filters('fitness_planning_with_front', true)
				)
			);

		} else {
			$args_compl = array(
				'exclude_from_search' => true,
				'publicly_queryable' => false,
				'show_in_nav_menus' => false,
			);
		}

		$args += $args_compl;
		register_post_type($this->CPT_slug, $args);
	}

	public function add_admin_menu() {
		global $submenu;

		$submenu[Consts::PLUGIN_NAME][] = array(
			__('Coachs', 'fitness-planning'),
			'edit_posts',
			'edit.php?post_type='.$this->CPT_slug
		);
	}

	public function register_meta_boxes() {
		add_meta_box('fitness-planning-coach-about', __('About the coach', 'fitness-planning'), array($this, 'render_metabox_about'), $this->CPT_slug, 'normal', 'high');
	}

	public function render_metabox_about($post) {

		// Get custom fields values (in AbstractEntity)
    $this->datas = $this->get_custom_fields($post->ID);

		wp_enqueue_media();

    include Consts::get_path().'admin/templates/coach/metabox-about.php';
	}
}
