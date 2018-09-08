<div class="fitplan-planning-item fitplan-planning-item-<?php echo $entry['workout']->ID; ?> fitplan-planning-item-<?php echo sanitize_title($entry['workout']->post_title); ?>" style="top: <?php echo $entry['top']; ?>; height: <?php echo $entry['height']; ?>">
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
      <?php echo 'border-radius: '.$this->datas['fitplan_planning_workout_radius']; ?>px;"

    data-color="<?php
      if($this->datas['fitplan_planning_workout_display_color']):
        echo $this->datas['fitplan_planning_workout_default_color'];
      else:
        echo $entry['workout']->metas['fitplan_workout_color'];
      endif;
    ?>">

    <?php if($entry['workout']->metas['fitplan_workout_pic']['url'] != ""): ?>
    <div class="fitplan-planning-item-pic" style="<?php if($this->datas['fitplan_planning_workout_display_pic'] == "off" or intval($entry['height']) < 50 ): ?>display: none;<?php endif; ?>">
      <img src="<?php echo $entry['workout']->metas['fitplan_workout_pic']['url']; ?>" alt="<?php echo $entry['workout']->post_title; ?>">
    </div>
    <?php endif; ?>

    <p
      class="fitplan-planning-item-title<?php if($entry['workout']->metas['fitplan_workout_pic']['url'] == ""): echo ' fitplan-dont-hide'; endif; ?>" style="
        <?php echo 'color: '.$this->datas['fitplan_planning_workout_text_color']; ?>;
        <?php if($this->datas['fitplan_planning_workout_display_title'] == "off" and intval($entry['height']) >= 50 and $entry['workout']->metas['fitplan_workout_pic']['url'] != "" ): ?>display: none;<?php endif; ?>
    ">
      <?php echo $entry['workout']->post_title; ?>
    </p>

    <p class="fitplan-planning-item-hour" style="<?php echo 'color: '.$this->datas['fitplan_planning_workout_text_color']; ?>;">
      <span class="fitplan-planning-item-hour-start"><?php echo $entry['start_display']; ?></span>
      -
      <span class="fitplan-planning-item-hour-finish"><?php echo $entry['finish_display']; ?></span>
    </p>
  </div>

  <div class="fitplan-planning-item-bubble">
    <?php if(isset($entry['workout']->metas['fitplan_workout_pic']['url'])): ?>
    <p class="fitplan-planning-modal-pic">
      <img src="<?php echo $entry['workout']->metas['fitplan_workout_pic']['url']; ?>" alt="<?php echo $entry['workout']->post_title; ?>">
    </p>
    <?php else: ?>
    <p class="fitplan-planning-modal-title">
      <?php echo $entry['workout']->post_title; ?>
    </p>
    <?php endif; ?>

    <div class="fitplan-planning-modal-hour">
      <span><?php echo $day['name']; ?></span>
      <span class="fitplan-planning-modal-hour-start"><?php echo $entry['start_display']; ?></span>
      -
      <span class="fitplan-planning-modal-hour-finish"><?php echo $entry['finish_display']; ?></span>
    </div>

    <div class="fitplan-planning-modal-desc">
      <?php echo nl2br( $entry['workout']->metas['fitplan_workout_desc'] ); ?>
    </div>

    <?php if($entry['workout']->metas['fitplan_workout_url'] != ""): ?>
    <p class="fitplan-planning-modal-link"><a target="_blank" href="<?php echo $entry['workout']->metas['fitplan_workout_url']; ?>"><?php _e('Visit official page', 'fitness-schedule'); ?></a></p>
    <?php endif; ?>

    <?php if(isset($entry['coach'])): ?>
    <div class="fitplan-planning-modal-coach">
      <img class="fitplan-planning-modal-coach-img" src="<?php echo $entry['coach']->metas['fitplan_coach_pic']['url']; ?>" alt="<?php echo $entry['coach']->post_title; ?>">
      <span class="fitplan-planning-modal-coach-by"><?php _e('By', 'fitness-schedule'); ?></span>
      <br>
      <strong class="fitplan-planning-item-coach-name"><?php echo $entry['coach']->post_title; ?></strong>
      <div class="fitplan-planning-modal-coach-bio">
        <?php echo $entry['coach']->metas['fitplan_coach_bio']; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>

</div>
