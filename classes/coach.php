<?php

class Fitness_Planning_Coach {

	const CPT_SLUG = 'coach';
	const FIELDS = array('fitplan_coach_pic', 'fitplan_coach_bio');

	public function register_hooks() {
		add_action('init', array($this, 'define_post_types'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
		add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
		add_action('save_post', array($this, 'save_custom_fields'), 10, 3);
	}

	public function define_post_types() {

	 $labels = array(
			'name' => __('Coachs', 'fitness-planning'),
			'all_items' => __('All coachs', 'fitness-planning'),
			'singular_name' => __('Coach', 'fitness-planning'),
			'add_new_item' => __('Add a coach', 'fitness-planning'),
			'edit_item' => __('Edit coach', 'fitness-planning'),
		  'not_found' => __('No coachs found.', 'fitness-planning'),
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
			__('Coachs', 'fitness-planning'),
			'edit_posts',
			'edit.php?post_type='.self::CPT_SLUG
		);
	}

	public function register_meta_boxes() {
		add_meta_box('fitness-planning-coach-about', __('About the coach', 'fitness-planning'), array($this, 'render_metabox_about'), self::CPT_SLUG, 'normal', 'high');
	}

	public function render_metabox_about($post) {

		wp_enqueue_media();

		foreach(self::FIELDS as $field) {
			$$field = get_post_meta($post->ID, '_'.$field, true);

			if($field == "fitplan_coach_pic") {

				$has_pic = wp_get_attachment_image_src($fitplan_coach_pic, "thumbnail");

				if($has_pic) {
					$fitplan_coach_pic_url = $has_pic[0];
				} else {
					$fitplan_coach_pic_url = "http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g";
				}

			}
		}

    include plugin_dir_path(dirname(__FILE__)).'admin/templates/coach-metabox-about.php';
	}

	public function save_custom_fields($post_id, $post, $update) {
		global $post_type;
		if(Fitness_Planning_Helper::check_saved_post($post_type, self::CPT_SLUG, $update, $post_id)) { return; }

		foreach(self::FIELDS as $field) {
			if(array_key_exists($field, $_POST)) {
	      update_post_meta(
	        $post_id,
	        '_'.$field,
	        $_POST[$field]
	      );
	    }
		}

	}
}
