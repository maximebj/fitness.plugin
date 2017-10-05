(function( $ ) {
	'use strict';
	$(document).ready(function() {

		// Copy shortcode
		$('.wp-list-table').on('click', '.fitness-planning-shortcode button, .fitness-planning-shortcode input', function(e){
			e.preventDefault();

			if(event.target.tagName === 'BUTTON') {
				var $input = $(this).prev('input');
				var $button = $(this);
			}

			if(event.target.tagName === 'INPUT') {
				var $input = $(this);
				var $button = $(this).next('button');
			}

			$input.focus();
			$input[0].setSelectionRange(0, $input.val().length);
			$button.html('✓');
			document.execCommand("copy");
		});


	});
})( jQuery );
