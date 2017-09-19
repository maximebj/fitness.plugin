<?php

class Fitness_Planning_i18n {

	public function register_hooks() {
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
	}

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fitness-planning',
			false,
			dirname(dirname(plugin_basename(__FILE__))).'/languages/'
		);

	}
}
