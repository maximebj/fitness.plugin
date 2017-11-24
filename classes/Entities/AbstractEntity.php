<?php

namespace FitnessPlanning\Entities;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

/**
 * Common methods for each entities
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

abstract class Entity {

	protected $CPT_slug;
	protected $fields;
	protected $datas;

	public function get_slug(){
		return self::$CPT_slug;
	}

  // Get all the custom fields defined by the Entity Class
	public function get_custom_fields($post_id) {

		$values = array();

		foreach($this->fields as $field => $default) {
			$values[$field] = get_post_meta($post_id, '_'.$field, true);

			// Assign default value if not set (as defined in each Entity)
			if($values[$field] == "") {
				$values[$field] = $default;
			}

			// Handle Checkboxes
			if($values[$field] == "off") {
				$values[$field] = false;
			}
			if($values[$field] == "on") {
				$values[$field] = true;
			}
		}

		return $values;
	}

  // Get Custom field image and convert image ID in an URL
	public function get_custom_field_image($fields, $key) {
		if(array_key_exists($key, $fields) and $fields[$key]!='') {

			$picture = wp_get_attachment_image_src($fields[$key], "large");

			if($picture) {
				$url = $picture[0];
			} else {
				$url = "http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g";
			}

			return array(
				"id" => $fields[$key],
				"isset" => ($picture) ? true : false,
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

  // Save custom fields
	public function save_custom_fields($post_id, $post, $update) {
		global $post_type;

		if($this->check_saved_post($post_type, $this->CPT_slug, $update, $post_id)) { return; }

		foreach($this->fields as $field => $value) {

      // Check if the field is registered by the Entity before saving it
			if(array_key_exists($field, $_POST)) {

	      update_post_meta(
	        $post_id,
	        '_'.$field,
	        $_POST[$field]
	      );
	    }
		}
	}

  // This method check if WP is in the right place and is performing a standard save post
	private function check_saved_post($post_type, $current_type, $update, $post_id) {

		return
			$post_type != $current_type
			or !$update
			or wp_is_post_revision($post_id)
			or (defined('DOING_AUTOSAVE') and DOING_AUTOSAVE);
	}

}
