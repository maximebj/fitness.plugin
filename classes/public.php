<?php

class Fitness_Planning_Public {

	public function register_hooks() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
	}

	public function enqueue_styles() {

		wp_enqueue_style('fitness-planning', plugin_dir_url(__FILE__).'css/fitness-planning-public.css', array(), $this->version, 'all');
	}

	public function enqueue_scripts() {
		wp_enqueue_script('fitness-planning', plugin_dir_url(__FILE__).'js/fitness-planning-public.js', array('jquery'), $this->version, false);

	}

}
