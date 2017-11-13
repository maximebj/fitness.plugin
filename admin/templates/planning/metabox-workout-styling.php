<p>
  <input type="hidden" name="fitplan_planning_workout_display_pic" value="off">
  <input type="checkbox" name="fitplan_planning_workout_display_pic" id="fitplan_planning_workout_display_pic" <?php if($this->datas['fitplan_planning_workout_display_pic']): ?>checked<?php endif; ?>>
  <label for="fitplan_planning_workout_display_pic"><?php _e('Show workout logo', 'fitness-planning'); ?></label>
</p>

<p>
  <input type="hidden" name="fitplan_planning_workout_display_title" value="off">
  <input type="checkbox" name="fitplan_planning_workout_display_title" id="fitplan_planning_workout_display_title" <?php if($this->datas['fitplan_planning_workout_display_title']): ?>checked<?php endif; ?>>
  <label for="fitplan_planning_workout_display_title"><?php _e('Show workout name', 'fitness-planning'); ?></label>
</p>

<p>
  <input type="hidden" name="fitplan_planning_workout_display_color" value="off">
  <input type="checkbox" name="fitplan_planning_workout_display_color" id="fitplan_planning_workout_display_color"<?php if($this->datas['fitplan_planning_workout_display_color']): ?>checked<?php endif; ?>>
  <label for="fitplan_planning_workout_display_color"><?php _e('Show background color', 'fitness-planning'); ?></label>
</p>

<label class="fitplan-label" for="fitplan_planning_workout_text_color"><?php _e('Text color', 'fitness-planning'); ?></label>

<p class="fitplan-color-label">
  <input type="text" class="color-picker" data-alpha="true"  name="fitplan_planning_workout_text_color" value="<?php echo $this->datas['fitplan_planning_workout_text_color']; ?>">
</p>

<label class="fitplan-label" for="fitplan_planning_workout_default_color"><?php _e('Workout default color', 'fitness-planning'); ?></label>

<p>
  <input type="text" class="color-picker" data-alpha="true" name="fitplan_planning_workout_default_color" value="<?php echo $this->datas['fitplan_planning_workout_default_color']; ?>">
</p>
