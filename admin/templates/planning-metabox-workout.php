<div class="postbox-inside flex">
  <div class="add-workout f100">

      <?php if(count($workouts) == 0): ?>
      <p><?php _e("You don't have any workout to add to the planning. <a href='edit.php?post_type=workout'>Add a Workout</a>.", 'fitness-planning'); ?></p>
      <?php else: ?>
      <select name="fitplan_addworkout_name" id="" required>
        <?php foreach($workouts as $workout): ?>
        <option value="<?php echo $workout->ID; ?>"><?php echo $workout->post_title; ?></option>
        <?php endforeach; ?>
      </select>

      <span><?php _e('On', 'fitness-planning'); ?></span>

      <select name="fitplan_addworkout_day" required>
        <?php foreach($this->weekdays as $day): ?>
        <option value="<?php echo $day['slug']; ?>" <?php if(!$day['displayed']) echo 'disabled'; ?>><?php echo $day['name']; ?></option>
        <?php endforeach; ?>
      </select>

      <span><?php _e('From', 'fitness-planning'); ?></span>

      <input type="time" required>

      <span><?php _e('To', 'fitness-planning'); ?></span>

      <input type="time" required>


      <span><?php _e('With', 'fitness-planning'); ?></span>

      <select name="" id="" <?php if(count($coachs) == 0) echo "disabled"; ?>>
        <?php foreach($coachs as $coach): ?>
        <option value="<?php echo $coach->ID; ?>"><?php echo $coach->post_title; ?></option>
        <?php endforeach; ?>
        <?php if(count($coachs) == 0): ?>
        <option value=""><?php _e('No coach defined'); ?></option>
        <?php endif; ?>
      </select>

      <button class="button button-primary"><?php _e('Add to planning', 'fitness-planning'); ?></button>
      <?php endif; ?>

  </div>
</div>
