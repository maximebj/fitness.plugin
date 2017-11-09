<?php

class Fitness_Planning_Activator {

	public static function activate() {

		// Create default content on first activation
		//if(get_option('fitplan_activated') == ""){

			// Prepare datas
			$workouts = array(

				"Body Attack" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Body Pump" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Body Combat" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Body Jam" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Body Vive" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Body Balance" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"RPM" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"CXWORX" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"SH'BAM" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Grit" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

				"Zumba" => array(
					"pic" => "",
					"desc" => "",
					"color" => "",
					"duration" => "",
					"url" => "",
					"public" => "",
				),

			);


			// Insert in WordPress

			foreach($workouts as $name => $workout) {

				// Insert post
				$post = array(
					'post_type' => 'workout',
					'post_status' => 'publish',
					'post_title' => $name,
					'post_content' => '',
				);

				$post_id = wp_insert_post($post);

				// Handle Picture
				$pic = "";

				// Insert Post Metas
				foreach($workout as $key => $value) {
					add_post_meta($post_id, 'fitplan_workout_'.$key , $value, true);
				}

			}

			add_option('fitplan_activated', true);
		//}
	}

}
