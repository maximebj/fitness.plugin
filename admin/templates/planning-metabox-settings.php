<div class="postbox-inside flex">
  <div class="f100">
    <p class="label"><?php _e('Show', 'fitness-planning'); ?></p>

    <div class="inline-boxes">
      <?php foreach($this->datas['weekdays'] as $day): ?>
      <div class="inline-boxes-item">
        <input type="checkbox" name="fitplan_planning_weekdays[]" id="fitplan_planning_weekdays_<?php echo $day['slug']; ?>" value="<?php echo $day['slug']; ?>" <?php if($day['displayed']): ?>checked<?php endif; ?>>
        <label for="fitplan_planning_weekdays_<?php echo $day['slug']; ?>"><?php echo $day['name']; ?></label>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="label"><?php _e('Planning hours', 'fitness-planning'); ?></p>

    <p>
      <span class="fitplan-row"><?php _e('Morning:', 'fitness-planning'); ?></span>
      <?php _e('from', 'fitness-planning'); ?> <input type="time" name="fitplan_planning_morning_start" value="<?php echo $this->datas['fitplan_planning_morning_start'] ?>">
      <?php _e('to', 'fitness-planning'); ?> <input type="time" name="fitplan_planning_morning_finish" value="<?php echo $this->datas['fitplan_planning_morning_finish'] ?>">
    </p>

    <p>
      <span class="fitplan-row"><?php _e('Afternoon:', 'fitness-planning'); ?></span>
      <?php _e('from', 'fitness-planning'); ?> <input type="time" name="fitplan_planning_afternoon_start" step="900" value="<?php echo $this->datas['fitplan_planning_afternoon_start'] ?>">
      <?php _e('to', 'fitness-planning'); ?> <input type="time" name="fitplan_planning_afternoon_finish" step="900" value="<?php echo $this->datas['fitplan_planning_afternoon_finish'] ?>">
    </p>

    <p class="label"><?php _e('Others', 'fitness-planning'); ?></p>
    <p>
      <?php _e('You can customize the first day of the week or the date format in <a href="options-general.php" target="_blank">Settings > General</a>.', 'fitness-planning'); ?>
    </p>
  </div>
</div>
