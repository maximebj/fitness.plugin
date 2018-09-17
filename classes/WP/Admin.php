<?php

namespace FitnessSchedule\WP;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessSchedule\Helpers\Consts;

/**
 * Admin enqueue styles, scripts and menu declaration
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Admin {

	public function register_hooks() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function enqueue_assets($hook) {
		global $post_type;

		if($hook != 'toplevel_page_fitness-planning' and !in_array($post_type, Consts::get_CPT_list())) {
      return;
    }

		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style(
			Consts::PLUGIN_NAME,
			Consts::get_url().'admin/css/fitness-planning-admin.css',
			array(),
			Consts::VERSION,
			'all'
		);

		if(($hook == 'post.php' or $hook == 'post-new.php') and $post_type == Consts::CPT_PLANNING) {

			wp_enqueue_script(
				'moment',
				Consts::get_url().'admin/js/libs/moment.min.js',
				array(),
				'2.1.9',
				false
			);

			wp_enqueue_script(
				Consts::PLUGIN_NAME.'-manage-workouts',
				Consts::get_url().'admin/js/fitness-planning-manage-workouts.js',
				array('jquery', 'moment'),
				Consts::VERSION,
				false
			);
    }

		wp_enqueue_script(
			Consts::PLUGIN_NAME,
			Consts::get_url().'admin/js/fitness-planning-admin.js',
			array('jquery', 'wp-color-picker'),
			Consts::VERSION,
			false
		);

		wp_localize_script(
			Consts::PLUGIN_NAME,
			'fitnessPlanningStrings',
			Consts::strings_to_js()
		);

	}

	public function add_admin_menu() {

		add_menu_page(
			'Fitness Schedule',
			'Fitness Schedule',
			'edit_posts',
			Consts::PLUGIN_NAME,
			null,
			'dashicons-calendar',
			30
		);
	}

}
