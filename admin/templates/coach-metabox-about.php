<div class="coach postbox-inside">
  <div class="coach-picture">
    <label for="fitplan_coach_pic"><?php _e('Picture', 'fitness-planning'); ?></label>
    <a href="#" class="coach-picture-field js-fitness-planning-change-pic">
      <img src="<?php echo $fitplan_coach_pic_url; ?>" id="fitness-planning-pic-preview" alt="<?php _e('Coach profile picture', 'fitness-planning'); ?>">
    </a>
    <input type="hidden" id="fitness-planning-pic-id" name="fitplan_coach_pic" value="<?php echo $fitplan_coach_pic; ?>">

    <div class="coach-picture-actions">
      <?php if($has_pic): ?>
      <a href="#" class="js-fitness-planning-change-pic"><? _e('Change', 'fitness-planning'); ?></a>
      <a href="#" class="js-fitness-planning-remove-pic"><? _e('Remove', 'fitness-planning'); ?></a>
      <?php else: ?>
      <a href="#" class="js-fitness-planning-change-pic"><? _e('Choose picture', 'fitness-planning'); ?></a>
      <?php endif; ?>
    </div>

  </div>
  <div class="coach-bio">
    <label for="fitplan_coach_bio"><?php _e('A few words about him', 'fitness-planning'); ?></label>
    <textarea name="fitplan_coach_bio" rows="5"><?php echo $fitplan_coach_bio; ?></textarea>
  </div>
</div>
