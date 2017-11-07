<div class="postbox-inside">
  <div class="fitplan-planning">

    <?php foreach($this->weekdays as $day): ?>
    <div class="fitplan-planning-day<?php if($day['displayed']): ?> is-shown<?php endif; ?>" data-day="<?php echo $day['slug']; ?>">
      <div class="fitplan-planning-title"><?php echo $day['name']; ?></div>

      <!-- <div class="fitplan-planning-item fitplan-planning-duration-1h">
        <p class="fitplan-planning-item-title">Body Attack</p>
        <p class="fitplan-planning-item-hour">9h00 - 10h00</p>
        <p class="fitplan-planning-item-coach">Avec Aaron</p>
      </div> -->

    </div>
    <?php endforeach; ?>

  </div>

  <input type="hidden" name="fitplan_planning" value="<?php echo esc_js($this->datas['fitplan_planning']); ?>">

</div>
