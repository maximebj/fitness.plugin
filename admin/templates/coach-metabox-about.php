<div class="coach postbox-inside flex">
  <div class="coach-picture f33">
    <?php Fitness_Planning_Fields::image('fitplan_coach_pic', $fields, 'circle'); ?>
  </div>
  <div class="coach-bio f66">
    <label for="fitplan_coach_bio"><?php _e('A few words about him', 'fitness-planning'); ?></label>
    <textarea name="fitplan_coach_bio" rows="5"><?php echo $fields['fitplan_coach_bio']; ?></textarea>
  </div>
</div>
