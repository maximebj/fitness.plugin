<div class="fitplan-planning-item fitplan-planning-item-workout-<?php echo $entry['workout']->ID; ?>" data-position-id="<?php echo $id ?>" style="top: <?php echo $entry['top']; ?>; height: <?php echo $entry['height']; ?>;">
  <div
    class="fitplan-planning-item-inside"
    style="
      <?php
        if($this->datas['fitplan_planning_workout_display_color'] == "on"):
          echo 'background-color: '.$entry['workout']->metas['fitplan_workout_color'];
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
        echo $entry['workout']->metas['fitplan_workout_color'];
      endif;
    ?>">

    <div class="fitplan-planning-item-pic" <?php if($this->datas['fitplan_planning_workout_display_pic'] == "off" or intval($entry['height']) < 50 or !$entry['workout']->metas['fitplan_workout_pic']['isset']): ?>style="display: none;"<?php endif; ?>>
      <img src="<?php if(isset($entry['workout']->metas['fitplan_workout_pic']['url'])): echo $entry['workout']->metas['fitplan_workout_pic']['url']; endif; ?>" alt="<?php echo $entry['workout']->post_title; ?>">
    </div>

    <p class="fitplan-planning-item-title" data-workout-id="<?php echo $entry['workout']->ID; ?>" <?php if($this->datas['fitplan_planning_workout_display_title'] == "off" and intval($entry['height']) >= 50 and $entry['workout']->metas['fitplan_workout_pic']['isset']): ?>style="display: none;"<?php endif; ?>>
      <?php echo $entry['workout']->post_title; ?>
    </p>

    <p class="fitplan-planning-item-hour">
      <span class="fitplan-planning-item-hour-start" data-start="<?php echo $entry['start']; ?>"><?php echo $entry['start_display']; ?></span>
      -
      <span class="fitplan-planning-item-hour-finish" data-finish="<?php echo $entry['finish']; ?>"><?php echo $entry['finish_display']; ?></span>
    </p>
  </div>

  <div class="fitplan-planning-item-bubble">
    <?php if(isset($entry['workout']->metas['fitplan_workout_pic']['isset'])): ?>
    <p class="fitplan-planning-modal-pic">
      <img src="<?php echo $entry['workout']->metas['fitplan_workout_pic']['url']; ?>" alt="<?php echo $entry['workout']->post_title; ?>">
    </p>
    <?php else: ?>
    <p class="fitplan-planning-modal-title">
      <?php echo $entry['workout']->post_title; ?>
    </p>
    <?php endif; ?>

    <div class="fitplan-planning-modal-hour">
      <span class="fitplan-planning-modal-day"><?php echo $day['name']; ?></span>
      <span class="fitplan-planning-modal-hour-start"><?php echo $entry['start_display']; ?></span>
      -
      <span class="fitplan-planning-modal-hour-finish"><?php echo $entry['finish_display']; ?></span>
    </div>

    <div class="fitplan-planning-modal-desc">
      <?php echo $entry['workout']->metas['fitplan_workout_desc']; ?>
    </div>

    <?php if($entry['workout']->metas['fitplan_workout_url'] != ""): ?>
    <p class="fitplan-planning-modal-link"><a target="_blank" href="<?php echo $entry['workout']->metas['fitplan_workout_url']; ?>"><?php _e('Visit official page', 'fitness-planning'); ?></a></p>
    <?php endif; ?>

    <?php if(isset($entry['coach'])): ?>
    <div class="fitplan-planning-modal-coach">
      <img class="fitplan-planning-modal-coach-img" src="<?php echo $entry['coach']->metas['fitplan_coach_pic']['url']; ?>" alt="<?php echo $entry['coach']->post_title; ?>">
      <span class="fitplan-planning-modal-coach-by"><?php _e('By', 'fitness-planning'); ?></span>
      <br>
      <strong class="fitplan-planning-modal-coach-name" data-coach-id="<?php echo $entry['coach']->ID; ?>"><?php echo $entry['coach']->post_title; ?></strong>
      <div class="fitplan-planning-modal-coach-bio">
        <?php echo $entry['coach']->metas['fitplan_coach_bio']; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <div class="fitplan-planning-item-overlay">
    <a href="#" class="fitplan-planning-edit-item"><span><?php _e('Click to edit', 'fitness-planning'); ?></span></a>
    <a href="#" class="fitplan-planning-delete-item">×</a>
  </div>
</div>
