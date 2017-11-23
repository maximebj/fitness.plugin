<?php

namespace FitnessPlanning\Helpers;

abstract class Fields {

	public static function image($field_name, $fields, $shape = "square") {
?>

<label class="fitplan-label" for="<?php echo $field_name; ?>"><?php _e('Picture', 'fitness-planning'); ?></label>

<div class="fitplan-picture" id="<?php echo $field_name; ?>">
	<a href="#" class="fitplan-picture-field <?php if($shape == "circle"): ?>fitplan-picture-field-circle<?php endif; ?> js-fitness-planning-change-pic">
		<img src="<?php echo $fields[$field_name]['url']; ?>" alt="<?php _e('Picture', 'fitness-planning'); ?>">
	</a>
	<input type="hidden" class="js-fitness-planning-media" name="<?php echo $field_name; ?>" value="<?php echo $fields[$field_name]['id']; ?>">

	<div class="fitplan-picture-actions">
		<a href="#" <?php if($fields[$field_name]['isset']): ?>style="display: none"<?php endif; ?> class="js-fitness-planning-change-pic"><? _e('Choose picture', 'fitness-planning'); ?></a>
		<a href="#" <?php if(!$fields[$field_name]['isset']): ?>style="display: none"<?php endif; ?> class="js-fitness-planning-change-pic"><? _e('Change', 'fitness-planning'); ?></a>
		<a href="#" <?php if(!$fields[$field_name]['isset']): ?>style="display: none"<?php endif; ?> class="js-fitness-planning-remove-pic"><? _e('Remove', 'fitness-planning'); ?></a>
	</div>
</div>

<?php
	}

}
