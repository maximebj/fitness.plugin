<?php

namespace FitnessPlanning\Helpers;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

/**
 * Constants, Strings, values shared by the plugin
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

abstract class Consts {

	const PLUGIN_NAME = 'fitness-schedule';
	const VERSION = '1.1';

	const CPT_PLANNING = 'planning';
	const CPT_WORKOUT = 'workout';
	const CPT_COACH = 'coach';

	// Options for WP WYSIWYG Editor
	const EDITOR_PARAMS = array(
    'media_buttons' => false,
    'textarea_rows' => 8
  );

	// Plugin Path for includes
	public static function get_path() {
		return WP_PLUGIN_DIR.'/'.Consts::PLUGIN_NAME.'/';
	}

	// Plugin URL for assets enqueing
  public static function get_url() {
    return plugin_dir_url(dirname(dirname(__FILE__)));
  }

	public static function get_CPT_list() {
		return array(
			self::CPT_PLANNING,
			self::CPT_WORKOUT,
			self::CPT_COACH,
		);
	}

	// Translatable string sent to JS
	public static function strings_to_js() {
		return array(
			'mediaUploaderTitle' => __('Select a image to upload', 'fitness-planning'),
			'mediaUploaderButton' => __('Use this image', 'fitness-planning'),
			'editWorkoutTitle' => __('Edit this Workout', 'fitness-planning'),
			'editWorkoutButton' => __('Apply changes', 'fitness-planning'),
			'editWorkoutAction' => __('Edit', 'fitness-planning'),
			'addWorkoutTimeError' => __('Start time must be before end Time', 'fitness-planning'),
			'addWorkoutConflictError' => __("You can't add a workout here because there is already another one at this time. We suggest you make another planning (eg: special bike planning) ", 'fitness-planning'),
			'addWorkoutOutsideBoundariesError' => __("This workout is outside the current planning hours boundaries", 'fitness-planning'),
		);
	}

}
