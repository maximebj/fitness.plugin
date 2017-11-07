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
		var $pictureFields = $('.fitplan-picture');

		if($pictureFields.length) {
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id;
		}

    $pictureFields.each(function() {

			var $parent = $(this);
			var $valInput = $(this).find('input[type=hidden]');
			var $img = $(this).find('.fitplan-picture-field img');

			$parent.on('click', '.js-fitness-planning-change-pic', function(e){
				e.preventDefault();

				if(file_frame) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: fitnessPlanningStrings.mediaUploaderTitle,
					button: {
						text: fitnessPlanningStrings.mediaUploaderButton,
					},
					multiple: false
				});

				// Callback when media library is opened
				file_frame.on('open',function() {
				  let selection = file_frame.state().get('selection');
				  let id = $valInput.val();
					let attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : [] );
				});

				// Callback when image is selected
				file_frame.on('select', function() {
					let attachment = file_frame.state().get('selection').first().toJSON();

					$img.attr('src', attachment.url);
					$valInput.val(attachment.id);
					$parent.find('.fitplan-picture-actions a:eq(1), .fitplan-picture-actions a:eq(2)').show();
					$parent.find('.fitplan-picture-actions a:eq(0)').hide();

					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Open the modal
				file_frame.open();
			});

			// Remove Image
			$(this).on('click', '.js-fitness-planning-remove-pic', function(e){
				e.preventDefault();

				$img.attr('src', 'http://2.gravatar.com/avatar/520afd2daee093cefdac74fe50ee64b4?s=150&d=mm&f=y&r=g');
				$valInput.val('');

				$parent.find('.fitplan-picture-actions a:eq(1), .fitplan-picture-actions a:eq(2)').hide();
				$parent.find('.fitplan-picture-actions a:eq(0)').show();
			});
		});

		// Restore the main ID when the add media button is pressed
		$('a.add_media').on('click', function() {
			wp.media.model.settings.post.id = wp_media_post_id;
		});


    // Color Picker
     $('.color-picker').wpColorPicker();


		// Plannning - Change weekdays
		$('input[name="fitplan_planning_weekdays[]"]').change(function() {
			var day = $(this).val();

			// Toggle in planning
			$('.fitplan-planning-day[data-day='+day+']').toggleClass('is-shown');

			// Toggle in Add select
			$('select[name=fitplan_addworkout_day] option[value='+day+']').prop('disabled', !$(this).prop('checked'));
		});


		// Planning - Add workout to planning
		$('.js-fitplan-add-to-planning').click(function(e){
			e.preventDefault();

			var day = $('.js-fitplan-day').val();

			var datas = {
				"workout": $('.js-fitplan-name').val(),
				"start": $('.js-fitplan-start').val(),
				"finish": $('.js-fitplan-finish').val(),
				"coach": $('.js-fitplan-coach').val()
			};

			var $planningField = $('input[name=fitplan_planning]');
			var planning = $planningField.val();

			// For new planning
			if(planning == ""){
				planning = { "monday": [], "tuesday": [], "wednesday": [], "thursday": [], "friday": [], "saturday": [], "sunday": []};
			} else {
				planning = JSON.parse(planning);
			}

			planning[day].push(datas);

			$planningField.val(JSON.stringify(planning));

		});


		// Adapt planning size from opening hours

		var fitplanPlanning = $('.fitplan-planning');

		if(fitplanPlanning.length) {
			adaptPlanning();
		}

		$('input[name=fitplan_planning_morning_start], input[name=fitplan_planning_morning_end], input[name=fitplan_planning_afternoon_start], input[name=fitplan_planning_afternoon_end]').change(function(){
			adaptPlanning();
		});

		function adaptPlanning() {

			var ratio = 2; // 1h = 120px

			// Morning

			var morningStart = $('input[name=fitplan_planning_morning_start]').val();
			var morningEnd = $('input[name=fitplan_planning_morning_end').val();

			var m1 = moment(morningStart, "HH:mm");
			var m2 = moment(morningEnd, "HH:mm");

			var diffMorning = m2.diff(m1, 'minutes') * ratio;

			var $fitplanPlanningMorning = $('.fitplan-planning-morning');

			$fitplanPlanningMorning.css('height', diffMorning+'px');

			// Afternoon

			var afternoonStart = $('input[name=fitplan_planning_afternoon_start]').val();
			var afternoonEnd = $('input[name=fitplan_planning_afternoon_end').val();

			var m1 = moment(afternoonStart, "HH:mm");
			var m2 = moment(afternoonEnd, "HH:mm");

			var diffAfternoon = m2.diff(m1, 'minutes') * ratio;

			var $fitplanPlanningAfternoon = $('.fitplan-planning-afternoon');
			$fitplanPlanningAfternoon.css('height', diffAfternoon+'px');
		}



	});
})( jQuery );
