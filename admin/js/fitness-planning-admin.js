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


		// Upload Image
    if($('.js-fitness-planning-media').length){
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id;
			var set_to_post_id = 0; // TODO

			$('.js-fitness-planning-change-pic').on('click', function(e){
				e.preventDefault();

				if(file_frame) {
					file_frame.uploader.uploader.param('post_id', set_to_post_id);
					file_frame.open();
					return;
				} else {
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: fitnessPlanningStrings.mediaUploaderTitle,
					button: {
						text: fitnessPlanningStrings.mediaUploaderButton,
					},
					multiple: false
				});

				// Callback when image is selected
				file_frame.on('select', function() {
					let attachment = file_frame.state().get('selection').first().toJSON();

					$('#fitness-planning-pic-preview').attr('src', attachment.url);
					$('#fitness-planning-pic-id').val(attachment.id);
					$('.coach-picture-actions a:eq(1), .coach-picture-actions a:eq(2)').show();
					$('.coach-picture-actions a:eq(0)').hide();

					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Open the modal
				file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			$('a.add_media').on('click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});

			// Remove Image
			$('.js-fitness-planning-remove-pic').on('click', function(e){
				e.preventDefault();

				$('#fitness-planning-pic-preview').attr('src', 'http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g');
				$('#fitness-planning-pic-id').val('');

				$('.coach-picture-actions a:eq(1), .coach-picture-actions a:eq(2)').hide();
				$('.coach-picture-actions a:eq(0)').show();
			});
		}


	});
})( jQuery );
