<?php

namespace FitnessPlanning\WP;

use FitnessPlanning\Helpers\Consts;

class I18n {

	public function register_hooks() {
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
	}

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fitness-planning',
			false,
			Consts::get_path().'languages/'
		);

	}
}
