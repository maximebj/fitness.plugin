<div class="workout postbox-inside">
  <div class="workout-description">
    <label for="fitplan_workout_desc"><?php _e('Description', 'fitness-planning'); ?></label>
    <?php wp_editor( $fitplan_workout_desc, 'fitplan_workout_desc', $settings = Fitness_Planning_Helper::EDITOR_PARAMS); ?>

  </div>



</div>
