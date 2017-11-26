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

		foreach($this->fields as $field => $field_datas) {
			$values[$field] = get_post_meta($post_id, '_'.$field, true);

			// Assign default value if not set (as defined in each Entity)
			if($values[$field] == "") {
				$values[$field] = $field_datas['default'];
			}

			// Handle Images
			if($field_datas['type'] == "picture") {
				$values[$field] = $this->get_custom_field_image($values[$field]);
			}

			// Handle Checkboxes
			if($field_datas['type'] == "bool") {
				if($values[$field] == "off" or !$values[$field]) {
					$values[$field] = false;
				}
				if($values[$field] == "on" or $values[$field] == true) {
					$values[$field] = true;
				}
			}
		}

		return $values;
	}

  // Get Custom field image and convert image ID in an URL
	public function get_custom_field_image($field) {
		$picture = false;
		$url = "";

		if($field != "") {

			$picture = wp_get_attachment_image_src($field, "large");
			if($picture) {
				$url = $picture[0];
			}
		}

		return array(
			"id" => $field,
			"isset" => ($picture) ? true : false,
			"url" => $url,
		);
	}

  // Save custom fields
	public function save_custom_fields($post_id, $post, $update) {
		global $post_type;

		if($this->check_saved_post($post_type, $this->CPT_slug, $update, $post_id)) { return; }

		foreach($this->fields as $field => $field_metas) {

      // Check if the field is registered by the Entity before saving it
			if(array_key_exists($field, $_POST)) {

				// TODO later security check for types
				// bool / int ...

				// Save the value in post meta
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
