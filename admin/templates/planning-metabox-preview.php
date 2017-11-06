<div class="postbox-inside">
  <div class="fitplan-planning">

    <?php foreach($this->weekdays as $day): ?>
    <div class="fitplan-planning-day<?php if($day['displayed']): ?> is-shown<?php endif; ?>" data-day="<?php echo $day['slug']; ?>">
      <div class="fitplan-planning-title"><?php echo $day['name']; ?></div>

      <div class="fitplan-planning-item fitplan-planning-duration-1h">
        <p class="fitplan-planning-item-title">Body Attack</p>
        <p class="fitplan-planning-item-hour">9h00 <br> 10h00</p>
      </div>

      <div class="fitplan-planning-item fitplan-planning-duration-1h fitplan-planning-offset-30m">
        <p class="fitplan-planning-item-title">Body Pump</p>
        <p class="fitplan-planning-item-hour">10h30 <br> 11h30</p>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</div>
