<div class="postbox-inside flex">
  <div class="f100">
    <p class="label"><?php _e('Show', 'fitness-planning'); ?></p>

    <div class="inline-boxes">
      <?php foreach($this->weekdays as $day): ?>
      <div class="inline-boxes-item">
        <input type="checkbox" name="fitplan_planning_weekdays[]" id="fitplan_planning_weekdays_<?php echo $day['slug']; ?>" value="<?php echo $day['slug']; ?>" <?php if($day['displayed']): ?>checked<?php endif; ?>>
        <label for="fitplan_planning_weekdays_<?php echo $day['slug']; ?>"><?php echo $day['name']; ?></label>
      </div>
      <?php endforeach; ?>
    </div>

    <p class="label"><?php _e('Others', 'fitness-planning'); ?></p>
    <p>
      <?php _e('You can customize the first day of the week or the date format in <a href="options-general.php" target="_blank">Settings > General</a>.', 'fitness-planning'); ?>
    </p>
  </div>
</div>
