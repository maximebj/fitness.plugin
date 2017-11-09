<div class="fitplan-planning-item" data-id="<?php echo @$id ?>" style="top: <?php echo @$entry['top']; ?>; height: <?php echo @$entry['height']; ?>">
  <div class="fitplan-planning-item-inside">
    <p class="fitplan-planning-item-title" data-workout-id="<?php echo @$entry['workout']['id']; ?>"><?php echo @$entry['workout']['name']; ?></p>
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

</div>
