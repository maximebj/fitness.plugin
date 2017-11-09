<div class="fitplan-wrapper">

  <div class="fitplan-planning">

    <?php 
      foreach($this->datas['weekdays'] as $day):
        if($day['displayed']):
    ?>
    <div class="fitplan-planning-day" data-day="<?php echo $day['slug']; ?>">
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
    <?php
      endif;
    endforeach;
    ?>

  </div>
</div>
