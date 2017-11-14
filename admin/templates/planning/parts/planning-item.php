<div class="fitplan-planning-item fitplan-planning-item-workout-<?php echo @$entry['workout']['id']; ?>" data-id="<?php echo @$id ?>" style="top: <?php echo @$entry['top']; ?>; height: <?php echo @$entry['height']; ?>;">
  <div
    class="fitplan-planning-item-inside"
    style="
      <?php
      if($this->datas['fitplan_planning_workout_display_color']):
        echo 'background-color: '.@$entry['workout']['metas']['fitplan_workout_color'];
      else:
        echo 'background-color: '.$this->datas['fitplan_planning_workout_default_color'];
      endif;
      ?>;
      <?php echo 'color: '.$this->datas['fitplan_planning_workout_text_color']; ?>;
      <?php echo 'border-radius: '.$this->datas['fitplan_planning_workout_radius']; ?>px;"

    data-color="<?php
      if($this->datas['fitplan_planning_workout_display_color']):
        echo $this->datas['fitplan_planning_workout_default_color'];
      else:
        echo @$entry['workout']['metas']['fitplan_workout_color'];
      endif;
    ?>">

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
    <?php if(isset($entry['workout']['metas']['fitplan_workout_pic']['url'])): ?>
    <p class="fitplan-planning-modal-pic">
      <img src="<?php echo @$entry['workout']['metas']['fitplan_workout_pic']['url']; ?>" alt="<?php echo @$entry['workout']['name']; ?>">
    </p>
    <?php else: ?>
    <p class="fitplan-planning-modal-title">
      <?php echo @$entry['workout']['name']; ?>
    </p>
    <?php endif; ?>

    <div class="fitplan-planning-modal-hour">
      <span><?php echo $day['name']; ?></span>
      <span class="fitplan-planning-modal-hour-start"><?php echo @$entry['start']; ?></span>
      -
      <span class="fitplan-planning-modal-hour-finish"><?php echo @$entry['finish']; ?></span>
    </div>

    <div class="fitplan-planning-modal-desc">
      <?php echo @$entry['workout']['metas']['fitplan_workout_desc']; ?>
    </div>

    <div class="fitplan-planning-modal-coach">
      <img class="fitplan-planning-modal-coach-img" src="<?php echo @$entry['coach']['metas']['fitplan_coach_pic']['url']; ?>" alt="<?php echo @$entry['coach']['name']; ?>">
      <?php _e('By', 'fitness-planning'); ?> <br><strong class="fitplan-planning-item-coach-name" data-coach-id="<?php echo @$entry['coach']['id']; ?>"><?php echo @$entry['coach']['name']; ?></strong>
      <div class="fitplan-planning-modal-coach-bio">
        <?php echo @$entry['coach']['metas']['fitplan_coach_bio']; ?>
      </div>
    </div>
  </div>

  <div class="fitplan-planning-item-overlay">
    <a href="#" class="fitplan-planning-edit-item"><span><?php _e('Click to edit', 'fitness-planning'); ?></span></a>
    <a href="#" class="fitplan-planning-delete-item">×</a>
  </div>
</div>
