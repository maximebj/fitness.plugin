<?php

namespace FitnessSchedule\Helpers;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

/**
 * HTML Fields generator helper
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

abstract class Fields {

	public static function image($field_name, $fields, $shape = "square") {
?>

<label class="fitplan-label" for="<?php echo $field_name; ?>"><?php _e('Picture', 'fitness-schedule'); ?></label>

<div class="fitplan-picture" id="<?php echo $field_name; ?>">
	<a href="#" class="fitplan-picture-field <?php if($shape == "circle"): ?>fitplan-picture-field-circle<?php endif; ?> js-fitness-planning-change-pic">
		<img src="<?php
      if($fields[$field_name]['url'] != ""):
        echo $fields[$field_name]['url'];
      else:
        echo 'http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g';
      endif;
    ?>" alt="<?php _e('Picture', 'fitness-schedule'); ?>">
	</a>
	<input type="hidden" class="js-fitness-planning-media" name="<?php echo $field_name; ?>" value="<?php echo $fields[$field_name]['id']; ?>">

	<div class="fitplan-picture-actions">
		<a href="#" <?php if($fields[$field_name]['isset']): ?>style="display: none"<?php endif; ?> class="js-fitness-planning-change-pic"><? _e('Choose picture', 'fitness-schedule'); ?></a>
		<a href="#" <?php if(!$fields[$field_name]['isset']): ?>style="display: none"<?php endif; ?> class="js-fitness-planning-change-pic"><? _e('Change', 'fitness-schedule'); ?></a>
		<a href="#" <?php if(!$fields[$field_name]['isset']): ?>style="display: none"<?php endif; ?> class="js-fitness-planning-remove-pic"><? _e('Remove', 'fitness-schedule'); ?></a>
	</div>
</div>

<?php
	}

}
