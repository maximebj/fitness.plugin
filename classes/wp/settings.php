<?php

class Fitness_Planning_Settings {

	public function register_hooks() {
		add_action('admin_menu', array( $this, 'add_admin_menu'));
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
    require_once Fitness_Planning_Consts::get_path().'admin/templates/settings.php';
	}
}
