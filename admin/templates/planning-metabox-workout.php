<div class="postbox-inside flex">
  <div class="add-workout f100">

    <?php if(count($this->datas['workouts']) == 0): ?>
    <p><?php _e("You don't have any workout to add to the planning. <a href='edit.php?post_type=workout'>Add a Workout</a>.", 'fitness-planning'); ?></p>
    <?php else: ?>

    <span><?php _e('Add', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_name" class="js-fitplan-name">
      <?php foreach($this->datas['workouts'] as $ID => $title): ?>
      <option value="<?php echo $ID; ?>"><?php echo $title; ?></option>
      <?php endforeach; ?>
    </select>

    <span><?php _e('On', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_day" class="js-fitplan-day">
      <?php foreach($this->datas['weekdays'] as $day): ?>
      <option value="<?php echo $day['slug']; ?>" <?php if(!$day['displayed']) echo 'disabled'; ?>><?php echo $day['name']; ?></option>
      <?php endforeach; ?>
    </select>

    <span><?php _e('From', 'fitness-planning'); ?></span>

    <input name="fitplan_addworkout_start" type="time" step="900" class="js-fitplan-start" value="17:00">

    <span><?php _e('To', 'fitness-planning'); ?></span>

    <input name="fitplan_addworkout_finish" type="time" step="900" class="js-fitplan-finish" value="18:00">

    <span><?php _e('With', 'fitness-planning'); ?></span>

    <select name="fitplan_addworkout_coach" <?php if(count($this->datas['coachs']) == 0) echo "disabled"; ?> class="js-fitplan-coach">
      <?php foreach($this->datas['coachs'] as $ID => $title): ?>
      <option value="<?php echo $ID; ?>"><?php echo $title; ?></option>
      <?php endforeach; ?>
      <?php if(count($this->datas['coachs']) == 0): ?>
      <option value=""><?php _e('No coach defined'); ?></option>
      <?php endif; ?>
    </select>

    <button class="button button-primary js-fitplan-add-to-planning"><?php _e('Add to planning', 'fitness-planning'); ?></button>
    <?php endif; ?>

  </div>
</div>
