<div class="fitplan-section">
  <div class="fitplan-planning" style="background-color: <?php echo $this->datas['fitplan_planning_background_color']; ?>">

    <?php foreach($this->datas['weekdays'] as $day): ?>
    <div class="fitplan-planning-day" style="<?php if(!$day['displayed']): ?>display: none;<?php endif; ?>" data-day="<?php echo $day['slug']; ?>">
      <div class="fitplan-planning-title" style="color: <?php echo $this->datas['fitplan_planning_days_text_color']; ?>"><?php echo $day['name']; ?></div>

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
