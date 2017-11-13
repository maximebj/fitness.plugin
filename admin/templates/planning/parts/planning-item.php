<div class="fitplan-planning-item" data-id="<?php echo @$id ?>" style="top: <?php echo @$entry['top']; ?>; height: <?php echo @$entry['height']; ?>;">
  <div
    class="fitplan-planning-item-inside"
    style="
      <?php if($this->datas['fitplan_planning_workout_display_color']): echo 'background-color: '.@$entry['workout']['metas']['fitplan_workout_color']; else: echo 'background-color: '.$this->datas['fitplan_planning_workout_default_color']; endif; ?>;
      <?php echo 'color: '.$this->datas['fitplan_planning_workout_text_color']; ?>;"
    data-color="<?php echo @$entry['workout']['metas']['fitplan_workout_color']; ?>">

    <div class="fitplan-planning-item-pic" <?php if(!$this->datas['fitplan_planning_workout_display_pic']): ?>style="display: none;"<?php endif; ?>>
      <img src="<?php echo @$entry['workout']['metas']['fitplan_workout_pic']['url']; ?>" alt="<?php echo @$entry['workout']['name']; ?>">
    </div>

    <p class="fitplan-planning-item-title" data-workout-id="<?php echo @$entry['workout']['id']; ?>" <?php if(!$this->datas['fitplan_planning_workout_display_title']): ?>style="display: none;"<?php endif; ?>>
      <?php echo @$entry['workout']['name']; ?>
    </p>

    <p class="fitplan-planning-item-hour">
      <span class="fitplan-planning-item-hour-start"><?php echo @$entry['start']; ?></span>
      -
      <span class="fitplan-planning-item-hour-finish"><?php echo @$entry['finish']; ?></span>
    </p>
  </div>

  <div class="fitplan-planning-item-bubble">
    <p class="fitplan-planning-item-coach">
      <?php _e('With', 'fitness-planning'); ?> <span class="fitplan-planning-item-coach-name" data-coach-id="<?php echo @$entry['coach']['id']; ?>"><?php echo @$entry['coach']['name']; ?></span>
    </p>
  </div>

  <div class="fitplan-planning-item-overlay">
    <a href="#" class="fitplan-planning-edit-item"><span><?php _e('Click to edit', 'fitness-planning'); ?></span></a>
    <a href="#" class="fitplan-planning-delete-item">×</a>
  </div>
</div>
