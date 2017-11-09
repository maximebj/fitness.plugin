<div class="postbox-inside">
  <div class="add-workout">

    <?php if(count($this->datas['workouts']) == 0): ?>
    <p><?php _e("You don't have any workout to add to the planning. <a href='edit.php?post_type=workout'>Add a Workout</a>.", 'fitness-planning'); ?></p>
    <?php else: ?>

    <span class="fitplan-add-workout-action" ><?php _e('Add', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_workout" class="js-fitplan-workout">
      <?php $first = true; foreach($this->datas['workouts'] as $ID => $title): ?>
      <option value="<?php echo $ID; ?>" <?php if($first){ $first=false; echo 'selected'; } ?>><?php echo $title; ?></option>
      <?php endforeach; ?>
    </select>

    <span><?php _e('On', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_day" class="js-fitplan-day">
      <?php $first = true; foreach($this->datas['weekdays'] as $day): ?>
      <option value="<?php echo $day['slug']; ?>" <?php if($first){ $first=false; echo 'selected'; } ?> <?php if(!$day['displayed']) echo 'disabled'; ?>><?php echo $day['name']; ?></option>
      <?php endforeach; ?>
    </select>

    <span><?php _e('From', 'fitness-planning'); ?></span>

    <input name="fitplan_addworkout_start" type="time" step="900" class="js-fitplan-start" value="17:00">

    <span><?php _e('To', 'fitness-planning'); ?></span>

    <input name="fitplan_addworkout_finish" type="time" step="900" class="js-fitplan-finish" value="18:00">

    <span><?php _e('With', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_coach" <?php if(count($this->datas['coachs']) == 0) echo "disabled"; ?> class="js-fitplan-coach">
      <?php $first = true; foreach($this->datas['coachs'] as $ID => $title): ?>
      <option value="<?php echo $ID; ?>" <?php if($first){ $first=false; echo 'selected'; } ?>><?php echo $title; ?></option>
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
