<div class="wrap">
  <h1><?php _e('Settings', 'fitness-schedule'); ?></h1>

  <form method="post" action="options.php">
    <?php settings_fields('fitness-planning-settings'); ?>
    <?php do_settings_sections('fitness-planning-settings'); ?>

    <table class="form-table">

      <tr>
        <th scope="row">
          <label for="fitplan_time_step"><?php _e('Time Step'); ?></label>
        </th>
        <td>
          <input name="fitplan_time_step" type="number" min="5" max="30" step="5" value="<?php echo esc_attr(get_option('fitplan_time_step', 1)); ?>" class="small-text"> <?php _e('minutes'); ?>
          <p class="description"><?php _e('Interval of time used for choosing workouts start time and duration. Default: 15 minutes.'); ?></p>
        </td>
      </tr>

      <tr>
        <th scope="row"><?php _e('Workouts archive'); ?></th>
        <td>
          <fieldset>
            <legend class="screen-reader-text">
              <span><?php _e('Workouts archive', 'fitness-schedule'); ?></span>
            </legend>

            <label for="fitplan_workout_archive">
              <input name="fitplan_workout_archive" type="checkbox" id="fitplan_workout_archive" <?php if(esc_attr(get_option('fitplan_workout_archive'))): echo 'checked'; endif ?> value="1">
              <?php _e('Activate', 'fitness-schedule'); ?>
            </label>
          </fieldset>
        </td>
      </tr>

      <tr>
        <th scope="row"><?php _e('Coachs archive'); ?></th>
        <td>
          <fieldset>
            <legend class="screen-reader-text">
              <span><?php _e('Coachs archive', 'fitness-schedule'); ?></span>
            </legend>

            <label for="fitplan_coach_archive">
              <input name="fitplan_coach_archive" type="checkbox" id="fitplan_coach_archive" <?php if(esc_attr(get_option('fitplan_coach_archive'))): echo 'checked'; endif ?> value="1">
              <?php _e('Activate', 'fitness-schedule'); ?>
            </label>
          </fieldset>
        </td>
      </tr>

    </table>

    <p><em><?php _e("Don't forget to flush WP permalinks structure after enabling archives pages. Go in Settings > Permalinks and hit Save button", 'fitness-schedule'); ?></em></p>

    <?php submit_button(); ?>
  </form>
</div>
