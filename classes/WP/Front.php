<?php

namespace FitnessSchedule\WP;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessSchedule\Helpers\Consts;

/**
 * Styles and script enqueued on public website
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Front {

	public function register_hooks() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

		add_action('template_include', array($this, 'archives_templates'));
	}

	public function enqueue_styles() {
		global $post;

		if(isset($post) and has_shortcode($post->post_content, 'fitness-planning')) {
			wp_enqueue_style(
				Consts::PLUGIN_NAME,
				Consts::get_url().'public/css/fitness-planning-public.css',
				array(),
				Consts::VERSION,
				'all'
			);
		}
	}

	public function enqueue_scripts() {
		global $post;

		if(isset($post) and has_shortcode($post->post_content, 'fitness-planning')) {
			wp_enqueue_script(
				Consts::PLUGIN_NAME,
				Consts::get_url().'public/js/fitness-planning-public.js',
				array('jquery'),
				Consts::VERSION,
				true
			);
		}
	}

	// Checks first if template exists in current theme or child theme, else load default
	public function archives_templates($template) {

		if (is_post_type_archive(Consts::CPT_WORKOUT) and !locate_template('archive-workout.php')) {
			return Consts::get_path()."public/templates/archive-workout.php";
		}

		if (is_singular(Consts::CPT_WORKOUT) and !locate_template('single-workout.php')) {
			return Consts::get_path()."public/templates/single-workout.php";
		}

		if (is_post_type_archive(Consts::CPT_COACH) and !locate_template('archive-coach.php')) {
			return Consts::get_path()."public/templates/archive-coach.php";
		}

		if (is_singular(Consts::CPT_COACH) and !locate_template('single-coach.php')) {
			return Consts::get_path()."public/templates/single-coach.php";
		}

		return $template;
	}

}
