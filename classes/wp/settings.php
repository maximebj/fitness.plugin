<?php

namespace FitnessPlanning\WP;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessPlanning\Helpers\Consts;

/**
 * Settings page fields registration
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Settings {

	public function register_hooks() {
		// No settings for now
		//add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function add_admin_menu() {

		add_submenu_page(
			'fitness-planning',
			__('Settings', 'fitness-planning'),
			__('Settings', 'fitness-planning'),
			'edit_posts',
			'fitness-planning',
			array($this, 'settings_page')
		);

	}

	public function settings_page(){
    require_once Consts::get_path().'admin/templates/settings.php';
	}
}
