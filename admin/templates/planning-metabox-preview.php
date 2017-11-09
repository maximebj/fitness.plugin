<div class="postbox-inside">
  <div class="fitplan-planning">

    <?php foreach($this->datas['weekdays'] as $day): ?>
    <div class="fitplan-planning-day<?php if($day['displayed']): ?> is-shown<?php endif; ?>" data-day="<?php echo $day['slug']; ?>">
      <div class="fitplan-planning-title"><?php echo $day['name']; ?></div>

      <div class="fitplan-planning-morning">
        <?php
          if(isset($this->datas['planning'])):
            foreach($this->datas['planning'][$day['slug']] as $id => $entry):
              if($entry['time'] == "morning"){
                include 'parts/planning-item.php';
              }
            endforeach;
          endif;
        ?>
      </div>

      <div class="fitplan-planning-afternoon">
        <?php
          if(isset($this->datas['planning'])):
            foreach($this->datas['planning'][$day['slug']] as $id => $entry):
              if($entry['time'] == "afternoon"){
                include 'parts/planning-item.php';
              }
            endforeach;
          endif;
        ?>
      </div>

    </div>
    <?php endforeach; ?>
  </div>

  <template class="fitplan-planning-item-template">
    <?php include 'parts/planning-item.php'; ?>
  </template>

  <input type="hidden" name="fitplan_planning" value="<?php echo esc_js($this->datas['fitplan_planning']); ?>">

</div>
