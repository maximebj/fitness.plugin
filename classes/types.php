<?php

class Fitness_Planning_Types {

	protected $CPT_slug;
	protected $fields;

	public function get_slug(){
		return self::$CPT_slug;
	}

	public function save_custom_fields($post_id, $post, $update) {
		global $post_type;

		if($this->check_saved_post($post_type, $this->CPT_slug, $update, $post_id)) { return; }

		foreach($this->fields as $field) {
			if(array_key_exists($field, $_POST)) {
	      update_post_meta(
	        $post_id,
	        '_'.$field,
	        $_POST[$field]
	      );
	    }
		}
	}

	public static function check_saved_post($post_type, $current_type, $update, $post_id) {

		return
			$post_type != $current_type
			or !$update
			or wp_is_post_revision($post_id)
			or (defined('DOING_AUTOSAVE') and DOING_AUTOSAVE);
	}

}
