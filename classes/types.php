<?php

class Fitness_Planning_Types {

	protected $CPT_slug;
	protected $fields;

	public function get_slug(){
		return self::$CPT_slug;
	}

	public function get_custom_fields($post_id) {

		$values = array();

		foreach($this->fields as $field) {
			$values[$field] = get_post_meta($post_id, '_'.$field, true);
		}

		return $values;
	}

	public function get_custom_field_image($fields, $key) {
		if(array_key_exists($key, $fields) and $fields[$key]!='') {

			$picture = wp_get_attachment_image_src($fields[$key], "thumbnail");

			if($picture) {
				$url = $picture[0];
			} else {
				$url = "http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g";
			}

			return array(
				"id" => $fields[$key],
				"isset" => $picture,
				"url" => $url,
			);

		} else {
			return array(
				"id" => 0,
				"isset" => false,
				"url" => "http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g",
			);
		}
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