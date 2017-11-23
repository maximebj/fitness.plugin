<?php

namespace FitnessPlanning\WP;

use FitnessPlanning\Helpers\Consts;

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
	}

	public function enqueue_styles() {
		global $post;

		if(has_shortcode($post->post_content, 'fitness-planning')) {
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

		if(has_shortcode($post->post_content, 'fitness-planning')) {
			wp_enqueue_script(
				Consts::PLUGIN_NAME,
				Consts::get_url().'public/js/fitness-planning-public.js',
				array('jquery'),
				Consts::VERSION,
				false
			);
		}
	}

}
