<div class="workout postbox-inside flex">
  <div class="workout-description f100">
    <label for="fitplan_workout_desc"><?php _e('Description', 'fitness-planning'); ?></label>
    <?php wp_editor( $fitplan_workout_desc, 'fitplan_workout_desc', $settings = Fitness_Planning_Helper::EDITOR_PARAMS); ?>
  </div>
  <div class="workout-picture f33">
    <?php Fitness_Planning_Fields::image('fitplan_coach_pic', $fields, 'circle'); ?>
  </div>
  <div class="workout-others f66">
    coucou
  </div>

</div>
