<div class="fitplan-section fitplan-flex">
  <div class="f100">
    <p class="fitplan-label"><?php _e('Show', 'fitness-planning'); ?></p>

    <div class="fitplan-inline-boxes">
      <?php foreach($this->datas['weekdays'] as $day): ?>
      <div class="fitplan-inline-boxes-item">
        <input type="checkbox" name="fitplan_planning_weekdays[]" id="fitplan_planning_weekdays_<?php echo $day['slug']; ?>" value="<?php echo $day['slug']; ?>" <?php if($day['displayed']): ?>checked<?php endif; ?>>
        <label for="fitplan_planning_weekdays_<?php echo $day['slug']; ?>"><?php echo $day['name']; ?></label>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="fitplan-label"><?php _e('Planning hours', 'fitness-planning'); ?></p>

    <p>
      <input type="checkbox" name="fitplan_planning_show_morning" id="fitplan_planning_show_morning" <?php if($this->datas['fitplan_planning_show_morning']): ?>checked<?php endif; ?>>
      <label for="fitplan_planning_show_morning" class="fitplan-row"><?php _e('Morning:', 'fitness-planning'); ?></label>

      <?php _e('from', 'fitness-planning'); ?>
      <input type="time" name="fitplan_planning_morning_start" step="<?php echo intval(esc_attr(get_option('fitplan_time_step', 15))) * 60; ?>" value="<?php echo $this->datas['fitplan_planning_morning_start'] ?>" <?php if(!$this->datas['fitplan_planning_show_morning']): ?>disabled <?php endif; ?>>

      <?php _e('to', 'fitness-planning'); ?>
      <input type="time" name="fitplan_planning_morning_finish" step="<?php echo intval(esc_attr(get_option('fitplan_time_step', 15))) * 60; ?>" value="<?php echo $this->datas['fitplan_planning_morning_finish'] ?>" <?php if(!$this->datas['fitplan_planning_show_morning']): ?>disabled <?php endif; ?>>

      <span class="fitplan-field-error js-fitplan-morning-finish-before-start">
        <span class="dashicons dashicons-warning"></span> <?php _e("Start time can't be later than finish time", 'fitness-planning'); ?>
      </span>
    </p>

    <p>
      <input type="checkbox" name="fitplan_planning_show_afternoon" id="fitplan_planning_show_afternoon" <?php if($this->datas['fitplan_planning_show_afternoon']): ?>checked<?php endif; ?>>
      <label for="fitplan_planning_show_afternoon" class="fitplan-row"><?php _e('Afternoon:', 'fitness-planning'); ?></label>
      <?php _e('from', 'fitness-planning'); ?>
      <input type="time" name="fitplan_planning_afternoon_start" step="<?php echo intval(esc_attr(get_option('fitplan_time_step', 15))) * 60; ?>" value="<?php echo $this->datas['fitplan_planning_afternoon_start'] ?>" <?php if(!$this->datas['fitplan_planning_show_afternoon']): ?>disabled <?php endif; ?>>

      <?php _e('to', 'fitness-planning'); ?>
      <input type="time" name="fitplan_planning_afternoon_finish" step="<?php echo intval(esc_attr(get_option('fitplan_time_step', 15))) * 60; ?>" value="<?php echo $this->datas['fitplan_planning_afternoon_finish'] ?>" <?php if(!$this->datas['fitplan_planning_show_afternoon']): ?>disabled<?php endif; ?>>

      <span class="fitplan-field-error js-fitplan-afternoon-finish-before-start">
        <span class="dashicons dashicons-warning"></span> <?php _e("Start time can't be later than finish time", 'fitness-planning'); ?>
      </span>
      <span class="fitplan-field-error js-fitplan-afternoon-start-before-morning-finish">
        <span class="dashicons dashicons-warning"></span> <?php _e("Afternoon starts before morning finish", 'fitness-planning'); ?>
      </span>
    </p>

    <p class="fitplan-label"><?php _e('Others', 'fitness-planning'); ?></p>
    <p>
      <?php _e('You can customize the first day of the week or the date format in <a href="options-general.php" target="_blank">Settings > General</a>.', 'fitness-planning'); ?>
    </p>
  </div>
</div>
