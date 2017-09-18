<?php

class Fitness_Planning_Admin {

	private $plugin_name;
  private $version;


  public function __construct( $plugin_name, $version ) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

	public function register_hooks() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function enqueue_styles() {
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__).'css/fitness-planning-admin.css', array(), $this->version, 'all');
	}

	public function enqueue_scripts() {
		wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ).'js/fitness-planning-admin.js', array('jquery'), $this->version, false );
	}

	public function add_admin_menu() {
		add_menu_page(
			'Fitness Planning',
			'Fitness Planning',
			'edit_posts',
			$this->plugin_name,
			null,
			'dashicons-calendar',
			30
		);

		add_submenu_page(
			$this->plugin_name,
			__('Plannings', 'fitness-planning'),
			__('Plannings', 'fitness-planning'),
			'edit_posts',
			$this->plugin_name,
			array($this, 'menu_page1')
		);

		add_submenu_page(
			$this->plugin_name,
			__('Other', 'fitness-planning'),
			__('Other', 'fitness-planning'),
			'edit_posts',
			'other',
			array($this, 'menu_page1')
		);
	}

	public function menu_page1(){
    require_once plugin_dir_path(dirname(__FILE__)).'admin/templates/page1.php';
	}


}
