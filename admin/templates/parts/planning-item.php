<div class="fitplan-planning-item" style="top: <?php echo $workout['top']; ?>; height: <?php echo $workout['height']; ?>">
  <div class="fitplan-planning-item-inside">
    <p class="fitplan-planning-item-title"><?php echo $workout['name']; ?></p>
    <p class="fitplan-planning-item-hour"><?php echo $workout['start']; ?> - <?php echo $workout['finish']; ?></p>
  </div>

  <div class="fitplan-planning-item-bubble">
    <p class="fitplan-planning-item-coach">
      With <span><<?php echo $workout['coach']; ?></span>
    </p>
  </div>
</div>
