<?php

namespace FitnessSchedule\Entities;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessSchedule\Helpers\Consts;
use FitnessSchedule\Services\Planning_Services;

/**
 * Plannings to be displayed on website, showing Workouts hours and Coachs
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Planning extends Entity {

	public $services;

	public function __construct() {

    $this->CPT_slug = Consts::CPT_PLANNING;

		// Custom fields and thier default values
		$this->fields = array(
			'fitplan_planning' => array("type" => "json", "default" => ""),

			'fitplan_planning_weekdays' 				=> array("type" => "array", "default" => ""),
			'fitplan_planning_morning_start' 		=> array("type" => "time", "default" => "09:00"),
			'fitplan_planning_morning_finish' 	=> array("type" => "time", "default" => "13:00"),
			'fitplan_planning_afternoon_start' 	=> array("type" => "time", "default" => "17:00"),
			'fitplan_planning_afternoon_finish' => array("type" => "time", "default" => "21:00"),
			'fitplan_planning_show_morning'     => array("type" => "bool", "default" => "on"),
			'fitplan_planning_show_afternoon'   => array("type" => "bool", "default" => "on"),

			'fitplan_planning_workout_display_pic' 		=> array("type" => "time", "default" => true),
      'fitplan_planning_workout_display_color' 	=> array("type" => "time", "default" => true),
      'fitplan_planning_workout_display_title' 	=> array("type" => "time", "default" => false),
      'fitplan_planning_workout_text_color' 	 	=> array("type" => "color", "default" => "#444"),
			'fitplan_planning_workout_default_color' 	=> array("type" => "color", "default" => "#eee"),
			'fitplan_planning_workout_radius' 				=> array("type" => "int", "default" => 4),

			'fitplan_planning_background_color' => array("type" => "text", "default" => ""),
			'fitplan_planning_border_color' 		=> array("type" => "color", "default" => "#eee"),
			'fitplan_planning_days_text_color' 	=> array("type" => "color", "default" => "#000"),
			'fitplan_planning_px_per_hour' 			=> array("type" => "int", "default" => 90),
		);

		// Methods for preparing datas
		$this->services = new Planning_Services();
  }

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
		add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
		add_action('save_post', array($this, 'save_custom_fields'), 10, 3);
    add_filter('manage_'.$this->CPT_slug.'_posts_columns', array($this, 'register_custom_columns'));
    add_action('manage_'.$this->CPT_slug.'_posts_custom_column' , array($this, 'add_custom_column_content'), 10, 2);
		add_filter('post_row_actions', array($this, 'add_duplicate_link'), 10, 2);
		add_action('admin_action_duplicate', array($this,'duplicate_post'));
    add_shortcode('fitness-planning', array($this,'execute_planning_shortcode'));
	}

	public function define_post_types() {

		$labels = array(
 		  'name' => __('Plannings', 'fitness-schedule'),
 		  'all_items' => __('All plannings', 'fitness-schedule'),
 		  'singular_name' => __('Planning', 'fitness-schedule'),
 		  'add_new_item' => __('Add a planning', 'fitness-schedule'),
 		  'edit_item' => __('Edit planning', 'fitness-schedule'),
 		  'not_found' => __('No plannings found.', 'fitness-schedule'),
 	  );

 	 $args = array(
 		  'labels' => $labels,
 		  'public' => true,
 		  'exclude_from_search' => true,
 		  'publicly_queryable' => false,
 		  'show_in_nav_menus' => false,
 		  'show_in_menu' => false,
 		  'supports' => array('title'),
 	  );

 	 	register_post_type($this->CPT_slug, $args);
	}

	public function add_admin_menu() {
		global $submenu;

		$submenu[Consts::PLUGIN_NAME][] = array(
			__('Plannings', 'fitness-schedule'),
			'edit_posts',
			'edit.php?post_type='.$this->CPT_slug
		);
	}

	// Send datas about Workouts and Coachs to JS
	public function enqueue_assets() {

		wp_localize_script(
			Consts::PLUGIN_NAME,
			'fitnessPlanningWorkouts',
			$this->datas['workouts']
		);

		wp_localize_script(
			Consts::PLUGIN_NAME,
			'fitnessPlanningCoachs',
			$this->datas['coachs']
		);
	}

	public function register_meta_boxes() {
		global $post;

		// Get custom fields values and prepare datas for template
		// These methods are in AbstractEntity
		$raw_datas = $this->get_custom_fields($post->ID);
		$this->datas = $this->services->prepare_datas($raw_datas);

		add_meta_box('fitness-planning-workout', __('Add a workout', 'fitness-schedule'), array($this, 'render_metabox_workout'), $this->CPT_slug, 'normal', 'high');

		add_meta_box('fitness-planning-preview', __('Planning Preview', 'fitness-schedule'), array($this, 'render_metabox_preview'), $this->CPT_slug, 'normal', 'high');

		add_meta_box('fitness-planning-settings', __('Settings', 'fitness-schedule'), array($this, 'render_metabox_settings'), $this->CPT_slug, 'normal', 'high');

		add_meta_box('fitness-planning-shortcode', __('Shortcode', 'fitness-schedule'), array($this, 'render_metabox_shortcode'), $this->CPT_slug, 'side', 'low');

		add_meta_box('fitness-planning-workout-styling', __('Customize Workouts', 'fitness-schedule'), array($this, 'render_metabox_workout_styling'), $this->CPT_slug, 'side', 'low');

		add_meta_box('fitness-planning-styling', __('Customize Planning', 'fitness-schedule'), array($this, 'render_metabox_planning_styling'), $this->CPT_slug, 'side', 'low');
	}

	public function render_metabox_workout($post) {
    include Consts::get_path().'admin/templates/planning/metabox-workout.php';
	}

	public function render_metabox_preview($post) {
		include Consts::get_path().'admin/templates/planning/metabox-preview.php';
	}

	public function render_metabox_settings($post) {
		include Consts::get_path().'admin/templates/planning/metabox-settings.php';
	}

	public function render_metabox_shortcode($post) {
		$post_id = $post->ID;
		include Consts::get_path().'admin/templates/planning/metabox-shortcode.php';
	}

	public function render_metabox_workout_styling($post) {
		include Consts::get_path().'admin/templates/planning/metabox-workout-styling.php';
	}

	public function render_metabox_planning_styling($post) {
		include Consts::get_path().'admin/templates/planning/metabox-planning-styling.php';
	}

  public function register_custom_columns($columns) {
		unset($columns['date']);
    $columns['shortcode'] = __('Shortcode', 'fitness-schedule');

    return $columns;
  }

	// Add a column in Admin > Planning > All items showing the shortcode to use
  public function add_custom_column_content($column, $post_id) {
    switch ($column) {
      case 'shortcode':
        include Consts::get_path().'admin/templates/planning/column-shortcode.php';
        break;
    }
  }

	// Add a duplicate link in Admin >Planning > All Items
	public function add_duplicate_link($actions, $post) {
		if ($post->post_type == $this->CPT_slug and current_user_can('edit_posts') and isset($actions['trash'])) {

			// Keep delete link at the end of actions list
			$trash = $actions['trash'];
			unset($actions['trash']);

			$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=duplicate&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="'.__('Duplicate', 'fitness-schedule').'" rel="permalink">'.__('Duplicate', 'fitness-schedule').'</a>';

			$actions['trash'] = $trash;
		}
		return $actions;
	}

	// Duplicate a planning
	public function duplicate_post() {

		// Nonce verification
		if (!isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__))) {
			return;
		}

		// Get original post
		$post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
		$post = get_post($post_id);

		if (isset($post) && $post != null) {

			$args = array(
				'post_author'    => $post->post_author,
				'post_name'      => $post->post_name,
				'post_status'    => $post->post_status,
				'post_title'     => $post->post_title.' - '._x('Copy', 'noun', 'fitness-schedule'),
				'post_type'      => $post->post_type,
			);

			// Duplicate post
			$new_post_id = wp_insert_post($args);

			// Get Custom fields
			$post_metas = $this->get_custom_fields($post_id);

			// Add the custom fields values to duplicate post
			foreach($post_metas as $key => $value) {
				update_post_meta($new_post_id, '_'.$key, $value);
			}

			// Go to duplicated post edit page
			wp_redirect(admin_url('post.php?action=edit&post='.$new_post_id));
			exit;
		}

		wp_redirect(admin_url('edit.php?post_type='.$this->CPT_slug));
		exit;
	}

	public function execute_planning_shortcode($attributes) {

		// Get all required datas
		$raw_datas = $this->get_custom_fields($attributes['id']);
		$this->datas = $this->services->prepare_datas($raw_datas);

		// Store content in buffer (goal is to return var, not echoing it now)
		ob_start();
		include Consts::get_path().'public/templates/shortcode-planning.php';
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

}
