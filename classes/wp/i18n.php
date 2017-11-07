<?php

class Fitness_Planning_i18n {

	public function register_hooks() {
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
	}

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fitness-planning',
			false,
			Fitness_Planning_Consts::get_path().'languages/'
		);

	}
}
