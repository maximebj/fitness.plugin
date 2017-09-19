<?php

class Fitness_Planning_Admin_Settings {

	public function register_hooks() {
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function add_admin_menu() {


		add_submenu_page(
			PLUGIN_NAME,
			__('Settings', PLUGIN_NAME),
			__('Settings', PLUGIN_NAME),
			'edit_posts',
			PLUGIN_NAME,
			array($this, 'settings_page')
		);

	}

	public function settings_page(){
    require_once plugin_dir_path(dirname(__FILE__)).'admin/templates/settings.php';
	}
}
