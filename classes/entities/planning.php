<?php

class Fitness_Planning_Planning extends Fitness_Planning_Entity {

	public $services;

	public function __construct() {
    $this->CPT_slug = Fitness_Planning_Consts::CPT_PLANNING;
		$this->fields = array(
			'fitplan_planning' => "",

			'fitplan_planning_weekdays' => "",
			'fitplan_planning_morning_start' => "09:00",
			'fitplan_planning_morning_finish' => "13:00",
			'fitplan_planning_afternoon_start' => "17:00",
			'fitplan_planning_afternoon_finish' => "21:00",

			'fitplan_planning_workout_display_pic' => true,
      'fitplan_planning_workout_display_color' => true,
      'fitplan_planning_workout_display_title' => false,
      'fitplan_planning_workout_text_color' => "#444",
			'fitplan_planning_workout_default_color' => "#eee",
			'fitplan_planning_workout_radius' => "4",

			'fitplan_planning_background_color' => "",
			'fitplan_planning_days_text_color' => "#000",
			'fitplan_planning_px_per_hour' => '90',
		);

		$this->services = new Fitness_Planning_Planning_Services();
  }

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
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
 		  'name' => __('Plannings', 'fitness-planning'),
 		  'all_items' => __('All plannings', 'fitness-planning'),
 		  'singular_name' => __('Planning', 'fitness-planning'),
 		  'add_new_item' => __('Add a planning', 'fitness-planning'),
 		  'edit_item' => __('Edit planning', 'fitness-planning'),
 		  'not_found' => __('No plannings found.', 'fitness-planning'),
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

		$submenu[Fitness_Planning_Consts::PLUGIN_NAME][] = array(
			__('Plannings', 'fitness-planning'),
			'edit_posts',
			'edit.php?post_type='.$this->CPT_slug
		);
	}

	public function register_meta_boxes() {
		global $post;

		$raw_datas = $this->get_custom_fields($post->ID);
		$this->datas = $this->services->prepare_datas($raw_datas);

		add_meta_box('fitness-planning-workout', __('Add a workout', 'fitness-planning'), array($this, 'render_metabox_workout'), $this->CPT_slug, 'normal', 'high');
		add_meta_box('fitness-planning-preview', __('Planning Preview', 'fitness-planning'), array($this, 'render_metabox_preview'), $this->CPT_slug, 'normal', 'high');
		add_meta_box('fitness-planning-settings', __('Settings', 'fitness-planning'), array($this, 'render_metabox_settings'), $this->CPT_slug, 'normal', 'high');
		add_meta_box('fitness-planning-workout-styling', __('Customize Workouts', 'fitness-planning'), array($this, 'render_metabox_workout_styling'), $this->CPT_slug, 'side', 'low');

		add_meta_box('fitness-planning-styling', __('Customize Planning', 'fitness-planning'), array($this, 'render_metabox_planning_styling'), $this->CPT_slug, 'side', 'low');
	}

	public function render_metabox_workout($post) {
    include Fitness_Planning_Consts::get_path().'admin/templates/planning/metabox-workout.php';
	}

	public function render_metabox_preview($post) {
		include Fitness_Planning_Consts::get_path().'admin/templates/planning/metabox-preview.php';
	}

	public function render_metabox_settings($post) {
		include Fitness_Planning_Consts::get_path().'admin/templates/planning/metabox-settings.php';
	}

	public function render_metabox_workout_styling($post) {
		include Fitness_Planning_Consts::get_path().'admin/templates/planning/metabox-workout-styling.php';
	}

	public function render_metabox_planning_styling($post) {
		include Fitness_Planning_Consts::get_path().'admin/templates/planning/metabox-planning-styling.php';
	}

  public function register_custom_columns($columns) {
		unset($columns['date']);
    $columns['shortcode'] = __('Shortcode', 'fitness-planning');

    return $columns;
  }

  public function add_custom_column_content($column, $post_id) {
    switch ($column) {
      case 'shortcode':
        include Fitness_Planning_Consts::get_path().'admin/templates/planning/column-shortcode.php';
        break;
    }
  }

	public function add_duplicate_link($actions, $post) {
		if ($post->post_type == $this->CPT_slug and current_user_can('edit_posts') and isset($actions['trash'])) {
			$trash = $actions['trash'];
			unset($actions['trash']);

			$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=duplicate&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="'.__('Duplicate', 'fitness-planning').'" rel="permalink">'.__('Duplicate', 'fitness-planning').'</a>';

			$actions['trash'] = $trash;
		}
		return $actions;
	}

	public function duplicate_post() {

		// Nonce verification
		if (!isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce($_GET['duplicate_nonce'], basename( __FILE__ ))) {
			return;
		}

		// Get original post
		$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
		$post = get_post($post_id);

		if (isset($post) && $post != null) {

			$args = array(
				'post_author'    => $post->post_author,
				'post_name'      => $post->post_name,
				'post_status'    => $post->post_status,
				'post_title'     => $post->post_title.' - '._x('Copy', 'noun', 'fitness-planning'),
				'post_type'      => $post->post_type,
			);

			$new_post_id = wp_insert_post($args);

			// Custom fields
			$post_metas = $this->get_custom_fields($post_id);

			foreach($post_metas as $key => $value) {
				update_post_meta($new_post_id, '_'.$key, $value);
			}

			wp_redirect(admin_url('post.php?action=edit&post='.$new_post_id));
			exit;
		}

		wp_redirect(admin_url('edit.php?post_type='.$this->CPT_slug));
	}

	public function execute_planning_shortcode($attributes) {

		$raw_datas = $this->get_custom_fields($attributes['id']);
		$this->datas = $this->services->prepare_datas($raw_datas);

		include Fitness_Planning_Consts::get_path().'public/templates/shortcode-planning.php';
	}

}
