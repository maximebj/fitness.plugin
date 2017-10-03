<?php

abstract class Fitness_Planning_Helper {

	const PLUGIN_NAME = 'fitness-planning';
	const VERSION = '1.0';

	public static function check_saved_post($post_type, $current_type, $update, $post_id) {

		return
			$post_type != $current_type
			or !$update
			or wp_is_post_revision($post_id)
			or (defined('DOING_AUTOSAVE') and DOING_AUTOSAVE);
	}

}
