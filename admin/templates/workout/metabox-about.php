<div class="fitplan-section fitplan-flex">
  <div class="f50">

    <?php FitnessSchedule\Helpers\Fields::image('fitplan_workout_pic', $this->datas); ?>

  </div>
  <div class="f50">
    <label class="fitplan-label" for="fitplan_workout_color"><?php _e('Color', 'fitness-schedule'); ?></label>
    <p class="fitplan-description"><?php _e('Choose a background color for this workout', 'fitness-schedule'); ?></p>
    <input type="text" class="color-picker" data-alpha="true" data-default-color="rgba(0,0,0,0.85)" name="fitplan_workout_color" value="<?php echo $this->datas['fitplan_workout_color'] ?>">

    <label class="fitplan-label" for="fitplan_workout_url"><?php _e('URL', 'fitness-schedule'); ?></label>
    <p class="fitplan-description"><?php _e('Optional. Workout official description page URL', 'fitness-schedule'); ?></p>
    <input type="url" name="fitplan_workout_url" value="<?php echo $this->datas['fitplan_workout_url'] ?>">

  </div>

  <div class="f100 with-top-margin">
    <label class="fitplan-label" for="fitplan_workout_desc"><?php _e('Description', 'fitness-schedule'); ?></label>
    <?php wp_editor($this->datas['fitplan_workout_desc'], 'fitplan_workout_desc', $settings = FitnessSchedule\Helpers\Consts::EDITOR_PARAMS); ?>
  </div>

</div>
