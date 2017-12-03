<?php

namespace FitnessPlanning\WP;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use FitnessPlanning\Helpers\Consts;

/**
 * Things to do on Plugin activation
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Activator {

	public static function activate() {

		// Create default content on first activation
		if(get_option('fitplan_activated') == ""){

			// Prepare datas
			$workouts = array(

				"Body Attack" => array(
					"pic" => "bodyattack.png",
					"desc" => _x("BODYATTACK™ is a high-energy fitness class with moves that cater for total beginners to total addicts. We combine athletic movements like running, lunging and jumping with strength exercises such as push-ups and squats.", 'Find it on official website', 'fitness-planning'),
					"color" => "#FFF6E8",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/bodyattack/",
				),

				"Body Pump" => array(
					"pic" => "bodypump.png",
					"desc" => _x("BODYPUMP™ is a barbell workout for anyone looking to get lean, toned and fit – fast. Using light to moderate weights with lots of repetition, BODYPUMP gives you a total body workout. It will burn up to 540 calories.", 'Find it on official website', 'fitness-planning'),
					"color" => "#FEE2E2",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/bodypump/",
				),

				"Body Combat" => array(
					"pic" => "bodycombat.png",
					"desc" => _x("Step into a BODYCOMBAT workout and you’ll punch and kick your way to fitness, burning up to 740 calories along the way. This high-energy martial-arts inspired workout is totally non-contact and there are no complex moves to master. ", 'Find it on official website', 'fitness-planning'),
					"color" => "#F6F5E1",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/bodycombat/",
				),

				"Body Jam" => array(
					"pic" => "bodyjam.png",
					"desc" => _x("Choreographed by Gandalf Archer-Mills in Auckland, New Zealand, BODYJAM™ is the ultimate combination of music and dance. Tracks that you love right now? They’re in BODYJAM. That new style you’ve heard about? It was in BODYJAM last year.", 'Find it on official website', 'fitness-planning'),
					"color" => "#FFFCE8",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/bodyjam/",
				),

				"Body Vive" => array(
					"pic" => "bodyvive.png",
					"desc" => _x("If you want the optimal mix of strength, cardio and core training this is it. Step into a BODYVIVE™ class and you'll tick off a complete workout. The challenging mix of lunges, squats, running and tubing exercises will help you burn calories and take your fitness to the next level. You'll leave fizzing with energy and on track for all-around healthy living.", 'Find it on official website', 'fitness-planning'),
					"color" => "#F7E9FF",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/bodyvive/",
				),

				"Body Balance" => array(
					"pic" => "bodybalance.png",
					"desc" => _x("Ideal for anyone and everyone, BODYBALANCE™ is the yoga-based class that will improve your mind, your body and your life.", 'Find it on official website', 'fitness-planning'),
					"color" => "#F3FBE1",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/bodybalance/",
				),

				"RPM" => array(
					"pic" => "rpm.png",
					"desc" => _x("RPM™ is a group indoor cycling workout where you control the intensity. It’s fun, low impact and you can burn up to 675 calories a session. With great music pumping and the group spinning as one, your instructor takes you on a journey of hill climbs, sprints and flat riding.", 'Find it on official website', 'fitness-planning'),
					"color" => "#E1F4FF",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/rpm/",
				),

				"CXWORX" => array(
					"pic" => "cxworx.png",
					"desc" => _x("Exercising muscles around the core, CXWORX™ provides the vital ingredient for a stronger body. A stronger core makes you better at all things you do, from everyday life to your favorite sports - it’s the glue that holds everything together.", 'Find it on official website', 'fitness-planning'),
					"color" => "#FFECE4",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/cxworx/",
				),

				"SH'BAM" => array(
					"pic" => "shbam.png",
					"desc" => _x("A fun-loving, insanely addictive dance workout. SH’BAM™ is an ego-free zone – no dance experience required. All you need is a playful attitude and a cheeky smile so forget being a wallflower – even if you walk in thinking you can’t, you’ll walk out knowing you can!", 'Find it on official website', 'fitness-planning'),
					"color" => "#FFDDF1",
					"url" => "https://www.lesmills.com/workouts/fitness-classes/shbam/",
				),

				"Les Mills Grit Cardio" => array(
					"pic" => "grit.png",
					"desc" => _x("LES MILLS GRIT™ Cardio is a 30-minute high-intensity interval training (HIIT) workout that improves cardiovascular fitness, increase speed and maximize calorie burn. This workout uses a variety of body weight exercises and provides the challenge and intensity you need to get results fast.", 'Find it on official website', 'fitness-planning'),
					"color" => "#F7F7F7",
					"url" => "https://www.lesmills.com/workouts/high-intensity-interval-training/les-mills-grit-cardio/",
				),

				"Les Mills Grit Plyo" => array(
					"pic" => "grit.png",
					"desc" => _x("LES MILLS GRIT™ Plyo is a 30-minute high-intensity interval training (HIIT) plyometric-based workout, designed to make you perform like an athlete. This workout uses a bench and combines explosive jumping exercises with agility training to increase explosiveness and to build a lean and athletic body. ", 'Find it on official website', 'fitness-planning'),
					"color" => "#F7F7F7",
					"url" => "https://www.lesmills.com/workouts/high-intensity-interval-training/les-mills-grit-plyo/",
				),

				"Les Mills Grit Strength" => array(
					"pic" => "grit.png",
					"desc" => _x("LES MILLS GRIT™ Strength is a 30-minute high-intensity interval training (HIIT) workout, designed to improve strength and build lean muscle. This workout uses barbell, weight plate and body weight exercises to blast all major muscle groups.", 'Find it on official website', 'fitness-planning'),
					"color" => "#F7F7F7",
					"url" => "https://www.lesmills.com/workouts/high-intensity-interval-training/les-mills-grit-strength/",
				),

				"Les Mills Sprint" => array(
					"pic" => false,
					"desc" => _x("LES MILLS SPRINT™ is a 30-minute High-Intensity Interval Training (HIIT) workout, using an indoor bike to achieve fast results.", 'Find it on official website', 'fitness-planning'),
					"color" => "#F7F7F7",
					"url" => "https://www.lesmills.com/workouts/high-intensity-interval-training/les-mills-sprint/",
				),

				"Zumba" => array(
					"pic" => "zumba.png",
					"desc" => _x("Zumba involves dance and aerobic movements performed to energetic music. The choreography incorporates hip-hop, soca, samba, salsa, merengue and mambo. Squats and lunges are also included.", 'Find it on official website', 'fitness-planning'),
					"color" => "#F9FFD4",
					"url" => "https://www.zumba.com/",
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
				$pic = $workout['pic'];

				if($pic) {
					unset($workout['pic']);

					$attachment_args = array(
		        'posts_per_page' => 1,
		        'post_type'      => 'attachment',
		        'name'     			 => $pic
    			);

					$check = get_posts($attachment_args);

					if(count($check) == 1) {

						// If image already exists in media
						update_post_meta($post_id, '_fitplan_workout_pic', $check[0]->ID);

					} else {
						// Create Image
						$file = Consts::get_path()."img/workouts/".$pic;

						$upload_file = wp_upload_bits($pic, null, file_get_contents($file));

						if (!$upload_file['error']) {
							$wp_filetype = wp_check_filetype($pic, null );
							$attachment = array(
								'post_mime_type' => $wp_filetype['type'],
								'post_parent' => $post_id,
								'post_title' => $pic,
								'post_content' => '',
								'post_status' => 'inherit'
							);

							$attachment_id = wp_insert_attachment($attachment, $upload_file['file'], $post_id);

							// Add to post meta
							update_post_meta($post_id, '_fitplan_workout_pic', $attachment_id);

							if (!is_wp_error($attachment_id)) {
								require_once(ABSPATH . "wp-admin" . '/includes/image.php');
								$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
								wp_update_attachment_metadata( $attachment_id,  $attachment_data );
							}
						}
					}
				}

				// Insert Post Metas
				foreach($workout as $key => $value) {
					update_post_meta($post_id, "_fitplan_workout_$key" , $value, true);
				}

			}

			add_option('fitplan_activated', true);
		}
	}

}
