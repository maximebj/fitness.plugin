<div class="coach fitplan-section fitplan-flex">
  <div class="f100">
    <?php FitnessSchedule\Helpers\Fields::image('fitplan_coach_pic', $this->datas, 'circle'); ?>

    <label class="fitplan-label" for="fitplan_coach_bio"><?php _e('A few words about him', 'fitness-schedule'); ?></label>
    <?php wp_editor($this->datas['fitplan_coach_bio'], 'fitplan_coach_bio', $settings = FitnessSchedule\Helpers\Consts::EDITOR_PARAMS); ?>

  </div>
</div>
