<div class="fitplan-section">
  <div class="fitplan-planning" id="fitplan-planning-<?php echo $post->ID; ?>" style="background-color: <?php echo $this->datas['fitplan_planning_background_color']; ?>" data-px-per-hour="<?php echo $this->datas['fitplan_planning_px_per_hour']; ?>">

    <?php foreach($this->datas['weekdays'] as $day): ?>
    <div class="fitplan-planning-day" style="<?php if(!$day['displayed']): ?>display: none;<?php endif; ?>" data-day="<?php echo $day['slug']; ?>">
      <div class="fitplan-planning-title" style="color: <?php echo $this->datas['fitplan_planning_days_text_color']; ?>"><?php echo $day['name']; ?></div>

      <div class="fitplan-planning-morning" style="height: <?php echo $this->datas['planning_height']['morning']; ?>px">
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

      <div class="fitplan-planning-afternoon" style="height: <?php echo $this->datas['planning_height']['afternoon']; ?>px">
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
