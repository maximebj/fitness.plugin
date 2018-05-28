<div class="fitplan-wrapper" id="fitplan-<?php echo $attributes['id']; ?>">

  <div class="fitplan-planning fitplan-planning-<?php echo $attributes['id']; ?>" style="background-color: <?php echo $this->datas['fitplan_planning_background_color']; ?>; border-color: <?php echo $this->datas['fitplan_planning_border_color']; ?>;">
    <?php
      foreach($this->datas['weekdays'] as $day):
        if($day['displayed']):
    ?>
    <div class="fitplan-planning-day fitplan-planning-day-<?php echo $day['slug']; ?>" style="color: <?php echo $this->datas['fitplan_planning_days_text_color']; ?>; border-color:<?php echo $this->datas['fitplan_planning_border_color']; ?>;">
      <div class="fitplan-planning-title" style="border-color: <?php echo $this->datas['fitplan_planning_border_color']; ?>;"><?php echo $day['name']; ?></div>

      <?php if($this->datas['fitplan_planning_show_morning']): ?>
      <div class="fitplan-planning-morning" style="height: <?php echo $this->datas['planning_height']['morning']; ?>px; border-color: <?php echo $this->datas['fitplan_planning_border_color']; ?>; border-color: <?php echo $this->datas['fitplan_planning_border_color']; ?>44;">
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
      <?php endif; ?>

      <?php if($this->datas['fitplan_planning_show_afternoon']): ?>
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
      <?php endif; ?>

    </div>
    <?php
      endif;
    endforeach;
    ?>
  </div>
</div>
