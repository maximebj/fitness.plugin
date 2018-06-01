<div class="fitplan-section">
  <div class="fitplan-add-workout">

    <?php if(count($this->datas['workouts']) == 0): ?>
    <p><?php _e("You don't have any workout to add to the planning. <a href='edit.php?post_type=workout'>Add a Workout</a>.", 'fitness-planning'); ?></p>
    <?php else: ?>

    <span class="fitplan-add-workout-action" ><?php _e('Add', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_workout">
      <?php $first = true; foreach($this->datas['workouts'] as $ID => $workout): ?>
      <option value="<?php echo $ID; ?>" <?php if($first){ $first=false; echo 'selected'; } ?>><?php echo $workout->post_title; ?></option>
      <?php endforeach; ?>
    </select>

    <span><?php _e('on', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_day">
      <?php $first = true; foreach($this->datas['weekdays'] as $day): ?>
      <option value="<?php echo $day['slug']; ?>" <?php if($first){ $first=false; echo 'selected'; } ?> <?php if(!$day['displayed']) echo 'disabled'; ?>><?php echo $day['name']; ?></option>
      <?php endforeach; ?>
    </select>

    <span><?php _e('from', 'fitness-planning'); ?></span>

    <input name="fitplan_addworkout_start" type="time" step="<?php echo intval(esc_attr(get_option('fitplan_time_step', 15))) * 60; ?>" value="17:00">

    <span><?php _e('to', 'fitness-planning'); ?></span>

    <input name="fitplan_addworkout_finish" type="time" step="<?php echo intval(esc_attr(get_option('fitplan_time_step', 15))) * 60; ?>" value="18:00">

    <span><?php _e('with', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_coach" <?php if(count($this->datas['coachs']) == 0) echo "disabled"; ?>>
      <?php $first = true; foreach($this->datas['coachs'] as $ID => $coach): ?>
      <option value="<?php echo $ID; ?>" <?php if($first){ $first=false; echo 'selected'; } ?>><?php echo $coach->post_title; ?></option>
      <?php endforeach; ?>
      <?php if(count($this->datas['coachs']) == 0): ?>
      <option value=""><?php _e('No coach defined'); ?></option>
      <?php endif; ?>
    </select>

    <button class="button button-primary js-fitplan-add-to-planning"><?php _e('Add to planning', 'fitness-planning'); ?></button>
    <?php endif; ?>

    <a href="#" class="fitplan-add-workout-cancel"><?php  _e('Cancel', 'fitness-planning'); ?></a>

  </div>
</div>
