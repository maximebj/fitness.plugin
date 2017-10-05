<?php

class Fitness_Planning_Admin_Planning {

	const CPT_SLUG = 'planning';

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
		add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
		add_action('save_post', array($this, 'save_custom_fields'), 10, 3);
    add_filter('manage_'.self::CPT_SLUG.'_posts_columns', array($this, 'register_custom_columns'));
    add_action('manage_'.self::CPT_SLUG.'_posts_custom_column' , array($this, 'add_custom_column_content'), 10, 2);
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

 	 register_post_type(self::CPT_SLUG, $args);
	}

	public function add_admin_menu() {
		global $submenu;

		$submenu[Fitness_Planning_Helper::PLUGIN_NAME][] = array(
			__('Plannings', 'fitness-planning'),
			'edit_posts',
			'edit.php?post_type='.self::CPT_SLUG
		);
	}

	public function register_meta_boxes() {
		add_meta_box('delipress-planning-workout', __('Add a workout', 'fitness-planning'), array($this, 'render_metabox_workout'), self::CPT_SLUG);
		add_meta_box('delipress-planning-preview', __('Planning Preview', 'fitness-planning'), array($this, 'render_metabox_preview'), self::CPT_SLUG);
		add_meta_box('delipress-planning-settings', __('Settings', 'fitness-planning'), array($this, 'render_metabox_settings'), self::CPT_SLUG);
	}

	public function render_metabox_workout($post) {
    include plugin_dir_path(dirname(__FILE__)).'admin/templates/planning-metabox-workout.php';
	}

	public function render_metabox_preview($post) {
		include plugin_dir_path(dirname(__FILE__)).'admin/templates/planning-metabox-preview.php';
	}

	public function render_metabox_settings($post) {
		include plugin_dir_path(dirname(__FILE__)).'admin/templates/planning-metabox-settings.php';
	}

	public function save_custom_fields($post_id, $post, $update) {
		global $post_type;
		if(Fitness_Planning_Helper::check_saved_post($post_type, self::CPT_SLUG, $update, $post_id)) { return; }
	}

  public function register_custom_columns($columns) {
		unset($columns['date']);
    $columns['shortcode'] = __('Shortcode', 'fitness-planning');

    return $columns;
  }

  public function add_custom_column_content($column, $post_id) {
    switch ($column) {
      case 'shortcode':
        include plugin_dir_path(dirname(__FILE__)).'admin/templates/planning-column-shortcode.php';
        break;
    }
  }

	public function execute_planning_shortcode() {
		echo "it's a me, planning";
	}
}
