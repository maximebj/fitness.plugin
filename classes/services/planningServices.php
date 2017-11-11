<?php

class Fitness_Planning_Planning_Services {

	public function __construct() {
  }

	public function prepare_datas($datas) {

		// All metaboxes stuff

		if($datas['fitplan_planning_morning_start'] == "") { $datas['fitplan_planning_morning_start'] = '09:00'; }
		if($datas['fitplan_planning_morning_finish'] == "") { $datas['fitplan_planning_morning_finish'] = '13:00'; }
		if($datas['fitplan_planning_afternoon_start'] == "") { $datas['fitplan_planning_afternoon_start'] = '17:00'; }
		if($datas['fitplan_planning_afternoon_finish'] == "") { $datas['fitplan_planning_afternoon_finish'] = '21:00'; }

		$datas['weekdays'] = $this->get_weekdays($datas);

		if($datas['fitplan_planning'] != ""){
			$datas['planning'] = json_decode($datas['fitplan_planning'], true);
		}

		$morning_start_time   = DateTime::createFromFormat('H:i', $datas['fitplan_planning_morning_start']);
		$afternoon_start_time = DateTime::createFromFormat('H:i', $datas['fitplan_planning_afternoon_start']);

		if(isset($datas['planning'])){
			foreach($datas['planning'] as $day => $entries) {
				foreach($entries as $key => $entry) {

					// Transform IDs in names

					$workout_datas = get_post($entry['workout']);

					// If workout has been deleted
					if(is_null($workout_datas)){
						unset($datas['planning'][$day][$key]);
						continue;
					} else {
						$datas['planning'][$day][$key]['workout'] = array(
							"id" => $entry['workout'],
							"name" => $workout_datas->post_title,
						);
					}

					$coach_datas = get_post($entry['coach']);

					if(is_null($coach_datas)){
						unset($datas['planning'][$day][$key]['coach']);
					} else {
						$datas['planning'][$day][$key]['coach'] = array(
							"id" => $entry['coach'],
							"name" => $coach_datas->post_title,
						);
					}

					// Positions

					$start_time  = DateTime::createFromFormat('H:i', $entry['start']);
					$finish_time = DateTime::createFromFormat('H:i', $entry['finish']);

					$duration = $finish_time->diff($start_time);
					$duration_in_min = $duration->h * 60 + $duration->i;

					$base_time = ($entry['time'] == "morning") ? $morning_start_time : $afternoon_start_time;

					$from_top = $start_time->diff($base_time);
					$from_top_in_min = $from_top->h * 60 + $from_top->i;

					// TODO change to get value from $datas['fitplan_planning_height_ratio'];
					$ratio = 1.5;

					$top = $from_top_in_min * $ratio;
					$height = $duration_in_min * $ratio;

					$datas['planning'][$day][$key]['top'] = $top."px";
					$datas['planning'][$day][$key]['height'] = $height."px";

				}
			}
		}

		// Workout Metabox stuff

		$args = array(
			'post_type' => Fitness_Planning_Consts::CPT_WORKOUT,
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		);
		$workouts_raw = get_posts($args);
		$datas['workouts'] = array();

		foreach($workouts_raw as $workout):
			$datas['workouts'][$workout->ID] = $workout->post_title;
		endforeach;

		$args['post_type'] = Fitness_Planning_Consts::CPT_COACH;
		$coachs_raw = get_posts($args);
		$datas['coachs'] = array();

		foreach($coachs_raw as $coach):
			$datas['coachs'][$coach->ID] = $coach->post_title;
		endforeach;

		return $datas;
	}

	public function get_weekdays($datas) {
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
