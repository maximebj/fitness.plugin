<div class="workout postbox-inside flex">
  <div class="workout-description f66">

    <?php Fitness_Planning_Fields::image('fitplan_workout_pic', $this->datas); ?>

    <label class="label" for="fitplan_workout_desc"><?php _e('Description', 'fitness-planning'); ?></label>
    <?php wp_editor($this->datas['fitplan_workout_desc'], 'fitplan_workout_desc', $settings = Fitness_Planning_Helper::EDITOR_PARAMS); ?>

  </div>
  <div class="f33">

    <label class="label" for="fitplan_workout_color"><?php _e('Color', 'fitness-planning'); ?></label>
    <p class="description"><?php _e('Choose a background color for this workout', 'fitness-planning'); ?></p>
    <input type="text" class="color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.85)" name="fitplan_workout_color" value="<?php echo $this->datas['fitplan_workout_color'] ?>">

    <label class="label" for="fitplan_workout_duration"><?php _e('Duration', 'fitness-planning'); ?></label>
    <p class="description"><?php _e('Eg: 45 min, 1 hour'); ?></p>
    <input type="text" class="small-input" name="fitplan_workout_duration"value="<?php echo $this->datas['fitplan_workout_duration']; ?>">

    <label class="label" for="fitplan_workout_url"><?php _e('URL', 'fitness-planning'); ?></label>
    <p class="description"><?php _e('Optional. Workout official description page URL', 'fitness-planning'); ?></p>
    <input type="url" name="fitplan_workout_url" value="<?php echo $this->datas['fitplan_workout_url'] ?>">

    <label class="label" for="fitplan_workout_public"><?php _e('Public', 'fitness-planning'); ?></label>
    <p class="description"><?php _e('This workout suits best to...'); ?></p>
    <input type="text" name="fitplan_workout_public" value="<?php echo $this->datas['fitplan_workout_public']; ?>">
  </div>

</div>
