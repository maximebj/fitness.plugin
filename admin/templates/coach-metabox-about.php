<div class="coach postbox-inside">
  <div class="coach-picture">
    <?php Fitness_Planning_Fields::image('fitplan_coach_pic', $fields); ?>
  </div>
  <div class="coach-bio">
    <label for="fitplan_coach_bio"><?php _e('A few words about him', 'fitness-planning'); ?></label>
    <textarea name="fitplan_coach_bio" rows="5"><?php echo $fields['fitplan_coach_bio']; ?></textarea>
  </div>
</div>
