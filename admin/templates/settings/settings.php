<div class="wrap">
  <h1><?php _e('Settings', 'fitness-planning'); ?></h1>

  <form method="post" action="options.php">
    <?php settings_fields('fitness-planning-settings'); ?>
    <?php do_settings_sections('fitness-planning-settings'); ?>

    <table class="form-table">
      <tr>
        <th scope="row"><?php _e('Workouts archive'); ?></th>
        <td>
          <fieldset>
            <legend class="screen-reader-text">
              <span><?php _e('Workouts archive', 'fitness-planning'); ?></span>
            </legend>

            <label for="fitplan_workout_archive">
              <input name="fitplan_workout_archive" type="checkbox" id="fitplan_workout_archive" <?php if(esc_attr(get_option('fitplan_workout_archive'))): echo 'checked'; endif ?> value="1">
              <?php _e('Activate', 'fitness-planning'); ?>
            </label>
          </fieldset>
        </td>
      </tr>

      <tr>
        <th scope="row"><?php _e('Coachs archive'); ?></th>
        <td>
          <fieldset>
            <legend class="screen-reader-text">
              <span><?php _e('Coachs archive', 'fitness-planning'); ?></span>
            </legend>

            <label for="fitplan_coach_archive">
              <input name="fitplan_coach_archive" type="checkbox" id="fitplan_coach_archive" <?php if(esc_attr(get_option('fitplan_coach_archive'))): echo 'checked'; endif ?> value="1">
              <?php _e('Activate', 'fitness-planning'); ?>
            </label>
          </fieldset>
        </td>
      </tr>

    </table>

    <?php submit_button(); ?>
  </form>
</div>
