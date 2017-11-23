<?php

namespace FitnessPlanning\Services;

use FitnessPlanning\Helpers\Consts;
use FitnessPlanning\Entities\Workout;
use FitnessPlanning\Entities\Coach;

use Datetime;

/**
 * Datas preparation for Planning
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Planning_Services {

	public function __construct() {
  }

	public function prepare_datas($datas) {

		// Datas needed by all the metaboxes
		$datas['weekdays'] = $this->get_weekdays($datas);

		if($datas['fitplan_planning'] != ""){

			// Get the planning entries JSON
			$datas['planning'] = json_decode($datas['fitplan_planning'], true);
			$to_remove = array();

      // Ratio. eg: 90px per hour = 1.5 ratio in height
      $ratio = intval($datas['fitplan_planning_px_per_hour']) / 60;

      // Define Planning Morning and Afternoon areas height in px
      $morning_start_time = DateTime::createFromFormat('H:i', $datas['fitplan_planning_morning_start']);
      $morning_finish_time = DateTime::createFromFormat('H:i', $datas['fitplan_planning_morning_finish']);

      $afternoon_start_time = DateTime::createFromFormat('H:i', $datas['fitplan_planning_afternoon_start']);
      $afternoon_finish_time = DateTime::createFromFormat('H:i', $datas['fitplan_planning_afternoon_finish']);

      $morning_duration = $morning_finish_time->diff($morning_start_time);
      $morning_duration = ($morning_duration->h * 60 + $morning_duration->i) * $ratio;

      $afternoon_duration = $afternoon_finish_time->diff($afternoon_start_time);
      $afternoon_duration = ($afternoon_duration->h * 60 + $afternoon_duration->i) * $ratio;

      $datas['planning_height'] = array(
        "morning" => $morning_duration,
        "afternoon" => $afternoon_duration,
      );

      // Prepare datas for each Workouts Entries in the planning
			foreach($datas['planning'] as $day => $entries) {
				foreach($entries as $key => $entry) {
					if($entry != null){

						$workout_datas = get_post($entry['workout']);

						// If workout has been deleted (in Workouts)
						if($workout_datas == null) {
							$to_remove[] = array("day" =>$day, "key" => $key);
							unset($datas['planning'][$day][$key]);

							continue;
						}

						// Get the Workout datas (name, description...)
						$workout = new Workout();
						$workout_metas = $workout->get_custom_fields($workout_datas->ID);
						$workout_metas['fitplan_workout_pic'] = $workout->get_custom_field_image($workout_metas, 'fitplan_workout_pic');

						$entry['workout'] = array(
							"id" => $entry['workout'],
							"name" => $workout_datas->post_title,
							"metas" => $workout_metas,
						);

						$coach_datas = get_post($entry['coach']);

						// If coach has been deleted (In Coachs)
						if($coach_datas == null){
							unset($datas['planning'][$day][$key]['coach']);
						} else {

							// Get the coach assigned to this Workout
							$coach = new Coach();
							$coach_metas = $coach->get_custom_fields($coach_datas->ID);
							$coach_metas['fitplan_coach_pic'] = $coach->get_custom_field_image($coach_metas, 'fitplan_coach_pic');

							$entry['coach'] = array(
								"id" => $entry['coach'],
								"name" => $coach_datas->post_title,
								"metas" => $coach_metas,
							);
						}

						// Define the absolute Position of the entry in the planning column
						$start_time  = DateTime::createFromFormat('H:i', $entry['start']);
						$finish_time = DateTime::createFromFormat('H:i', $entry['finish']);

						$duration = $finish_time->diff($start_time);
						$duration_in_min = $duration->h * 60 + $duration->i;

						$base_time = ($entry['time'] == "morning") ? $morning_start_time : $afternoon_start_time;

						$from_top = $start_time->diff($base_time);
						$from_top_in_min = $from_top->h * 60 + $from_top->i;

						$top = $from_top_in_min * $ratio;
						$height = $duration_in_min * $ratio;

						$entry['top'] = $top."px";
						$entry['height'] = $height."px";

						// Set item datas in global array
						$datas['planning'][$day][$key] = $entry;
					}
				}
			}

			// Updated field in case changes were made
			if(count($to_remove) > 0){
				$prov = json_decode($datas['fitplan_planning'], true);

				foreach($to_remove as $remove) {

					$day = $remove['day'];
					$key = $remove['key'];

					unset($prov[$day][$key]);
				}
				$datas['fitplan_planning'] = json_encode($prov);

			}
		}

		// Load datas for the Add a Workout metabox
		// Workouts, Coachs, available days of the week...

		$args = array(
			'post_type' => Consts::CPT_WORKOUT,
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		);
		$workouts_raw = get_posts($args);
		$datas['workouts'] = array();

		foreach($workouts_raw as $workout):
			$datas['workouts'][$workout->ID] = $workout->post_title;
		endforeach;

		$args['post_type'] = Consts::CPT_COACH;
		$coachs_raw = get_posts($args);
		$datas['coachs'] = array();

		foreach($coachs_raw as $coach):
			$datas['coachs'][$coach->ID] = $coach->post_title;
		endforeach;

		return $datas;
	}

	public function get_weekdays($datas) {

		// Get the start of the week defined in WordPress options
		$start_of_week = get_option('start_of_week');

		$base_week = array(
			array('slug' => 'sunday', 'name' => __('Sunday')),
			array('slug' => 'monday', 'name' => __('Monday')),
			array('slug' => 'tuesday', 'name' => __('Tuesday')),
			array('slug' => 'wednesday', 'name' => __('Wednesday')),
			array('slug' => 'thursday', 'name' => __('Thursday')),
			array('slug' => 'friday', 'name' => __('Friday')),
			array('slug' => 'saturday', 'name' => __('Saturday')),
		);

		// Define which days are dislayed
		foreach($base_week as &$day) {

			if($datas['fitplan_planning_weekdays'] == "" ) {

				// All days are selected by default
				$day['displayed'] = true;
			} else {

				// if 'monday' is in selected weekdays array
				$day['displayed'] = in_array($day['slug'], $datas['fitplan_planning_weekdays']);
			}
		}

		$weekdays = array();

		for($i = $start_of_week; $i < 7; $i++) {
			$weekdays[] = $base_week[$i];
		}

		if($start_of_week != 0) {
			for($i = 0; $i < $start_of_week; $i++) {
				$weekdays[] = $base_week[$i];
			}
		}

		return $weekdays;
	}
}
