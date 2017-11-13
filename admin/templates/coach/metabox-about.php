<div class="coach fitplan-section fitplan-flex">
  <div class="f100">
    <?php Fitness_Planning_Fields::image('fitplan_coach_pic', $this->datas, 'circle'); ?>

    <label class="fitplan-label" for="fitplan_coach_bio"><?php _e('A few words about him', 'fitness-planning'); ?></label>
    <?php wp_editor($this->datas['fitplan_coach_bio'], 'fitplan_coach_bio', $settings = Fitness_Planning_Consts::EDITOR_PARAMS); ?>

  </div>
</div>
