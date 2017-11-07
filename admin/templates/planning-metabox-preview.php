<div class="postbox-inside">
  <div class="fitplan-planning">

    <?php foreach($this->datas['weekdays'] as $day): ?>
    <div class="fitplan-planning-day<?php if($day['displayed']): ?> is-shown<?php endif; ?>" data-day="<?php echo $day['slug']; ?>">
      <div class="fitplan-planning-title"><?php echo $day['name']; ?></div>

      <div class="fitplan-planning-morning">
        <?php foreach($this->datas['planning'] as $ID => $title): ?>
          <div class="fitplan-planning-item ">
            <p class="fitplan-planning-item-title">...</p>
            <p class="fitplan-planning-item-hour">...</p>
            <p class="fitplan-planning-item-coach">...</p>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="fitplan-planning-afternoon">

      </div>


    </div>
    <?php endforeach; ?>

  </div>

  <input type="hidden" name="fitplan_planning" value="<?php echo esc_js($this->datas['fitplan_planning']); ?>">

</div>
