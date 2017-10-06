<?php

abstract class Fitness_Planning_Helper {

	const PLUGIN_NAME = 'fitness-planning';
	const VERSION = '1.0';

	const CPT_PLANNING = 'planning';
	const CPT_WORKOUT = 'workout';
	const CPT_COACH = 'coach';

	public static function get_CPT_list() {
		return array(
			self::CPT_PLANNING,
			self::CPT_WORKOUT,
			self::CPT_COACH,
		);
	}

	public static function strings_to_js() {
		return array(
			'mediaUploaderTitle' => __('Select a image to upload', 'fitness-planning'),
			'mediaUploaderButton' => __('Use this image', 'fitness-planning'),
		);
	}

}
