<?php

class Fitness_Planning_Public {

	public function register_hooks() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
	}

	public function enqueue_styles() {
		global $post;

		if(has_shortcode($post->post_content, 'fitness-planning')) {
			wp_enqueue_style(
				Fitness_Planning_Consts::PLUGIN_NAME,
				Fitness_Planning_Consts::get_url().'public/css/fitness-planning-public.css',
				array(),
				Fitness_Planning_Consts::VERSION,
				'all'
			);
		}
	}

	public function enqueue_scripts() {
		global $post;

		// if(has_shortcode($post->post_content, 'fitness-planning')) {
		// 	wp_enqueue_script(
		// 		Fitness_Planning_Consts::PLUGIN_NAME,
		// 		Fitness_Planning_Consts::get_url().'public/js/fitness-planning-public.js',
		// 		array('jquery'),
		// 		Fitness_Planning_Consts::VERSION,
		// 		false
		// 	);
		// }
	}

}
