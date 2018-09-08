<label class="fitplan-label" for="fitplan_planning_days_text_color"><?php _e('Days text color', 'fitness-schedule'); ?></label>
<input type="text" class="color-picker" data-alpha="true"  name="fitplan_planning_days_text_color" value="<?php echo $this->datas['fitplan_planning_days_text_color']; ?>">

<label class="fitplan-label" for="fitplan_planning_background_color"><?php _e('Background color', 'fitness-schedule'); ?></label>
<input type="text" class="color-picker" data-alpha="true" name="fitplan_planning_background_color" value="<?php echo $this->datas['fitplan_planning_background_color']; ?>">

<label class="fitplan-label" for="fitplan_planning_border_color"><?php _e('Border color', 'fitness-schedule'); ?></label>
<input type="text" class="color-picker" data-alpha="true" name="fitplan_planning_border_color" value="<?php echo $this->datas['fitplan_planning_border_color']; ?>">

<label class="fitplan-label" for="fitplan_planning_px_per_hour"><?php _e('Pixels per hour', 'fitness-schedule'); ?></label>
<p class="fitplan-description"><?php _e("Info: logos won't show when there isn't enough height", 'fitness-schedule'); ?></p>
<input type="number" class="fitplan-small-num" name="fitplan_planning_px_per_hour" step="5" value="<?php echo $this->datas['fitplan_planning_px_per_hour']; ?>"> px <?php _e('per hour', 'fitness-schedule'); ?>
