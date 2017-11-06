<div class="coach postbox-inside flex">
  <div class="f100">
    <?php Fitness_Planning_Fields::image('fitplan_coach_pic', $fields, 'circle'); ?>

    <label class="label" for="fitplan_coach_bio"><?php _e('A few words about him', 'fitness-planning'); ?></label>
    <?php wp_editor($fields['fitplan_coach_bio'], 'fitplan_coach_bio', $settings = Fitness_Planning_Helper::EDITOR_PARAMS); ?>

  </div>
</div>
