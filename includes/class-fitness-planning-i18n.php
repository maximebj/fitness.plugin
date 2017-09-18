<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://dysign.fr
 * @since      1.0.0
 *
 * @package    Fitness_Planning
 * @subpackage Fitness_Planning/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Fitness_Planning
 * @subpackage Fitness_Planning/includes
 * @author     Maxime BERNARD-JACQUET <maxime@dysign.fr>
 */
class Fitness_Planning_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'fitness-planning',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
