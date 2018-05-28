(function($) {
	'use strict';
	$(document).ready(function() {

		// This is gonna be rewritten soon in React
		// It will be less messy

		// Selectors

		// General components
		var $fitplanPlanning = $('.fitplan-planning');

		// General planning morning/afternoon sub parts
		var $fitplanPlanningMorning = $('.fitplan-planning-morning');
		var $fitplanPlanningAfternoon = $('.fitplan-planning-afternoon');

		// Hidden field storing JSON
		var $planningField = $('input[name=fitplan_planning]');

		// Template
		var $planningItemTemplate = $('.fitplan-planning-item-template');

		// Add/Edit Workout Fields
		var $workoutForm = $('#fitness-planning-workout');

		// -- Strings
		var $workoutFormTitle = $workoutForm.find('h2 span');
		var $workoutFormButton = $workoutForm.find('.js-fitplan-add-to-planning');
		var $workoutFormAction = $workoutForm.find('.fitplan-add-workout-action');
		var $workoutFormCancelButton = $workoutForm.find('.fitplan-add-workout-cancel');

		// -- Fields
		var $workoutFormWorkoutField = $(':input[name=fitplan_addworkout_workout]');
		var $workoutFormDayField = $(':input[name=fitplan_addworkout_day]');
		var $workoutFormStartField = $(':input[name=fitplan_addworkout_start]');
		var $workoutFormFinishField = $(':input[name=fitplan_addworkout_finish]');
		var $workoutFormCoachField = $(':input[name=fitplan_addworkout_coach]');

		// Settings Fiels
		var $showMorning = $(':input[name=fitplan_planning_show_morning]');
		var $showAfternoon = $(':input[name=fitplan_planning_show_afternoon]');
		var $morningStart = $(':input[name=fitplan_planning_morning_start]');
		var $morningFinish = $(':input[name=fitplan_planning_morning_finish]');
		var $afternoonStart = $(':input[name=fitplan_planning_afternoon_start]');
		var $afternoonFinish = $(':input[name=fitplan_planning_afternoon_finish]');

		// Customize Fields
		var $customizeWorkoutDisplayPic = $('#fitplan_planning_workout_display_pic');
		var $customizeWorkoutDisplayTitle = $('#fitplan_planning_workout_display_title');
		var $customizeWorkoutColor = $('#fitplan_planning_workout_display_color');
		var $customizeWorkoutDefaultColor = $(':input[name=fitplan_planning_workout_default_color]');
		var $customizeWorkoutRadius = $(':input[name=fitplan_planning_workout_radius]');
		var $customizeWorkoutTextColor = $(':input[name=fitplan_planning_workout_text_color]');

		// Vars

		var minHeightForImage = 50;
		var ratio = parseInt($('input[name=fitplan_planning_px_per_hour]').val()) / 60;

		var oldTitle = '';
		var oldButton = '';
		var oldAction = '';

		// Add or edit workout to planning

		$workoutFormButton.click(function(e){
		  e.preventDefault();

			// Edit mode : delete old item before continue
			var $editedItem = $('.fitplan-planning-item.is-edited');

			if($editedItem.length) {
				removeFromPlanning($editedItem);
				backToAdd();
			}

			// Get datas
			var day = $workoutFormDayField.val();

		  var datas = {
		    "workout": $workoutFormWorkoutField.val(),
		    "start": $workoutFormStartField.val(),
		    "finish": $workoutFormFinishField.val(),
		    "coach": $workoutFormCoachField.val()
		  };

			var workoutStartTime = moment(datas.start, "HH:mm");
		  var workoutFinishTime = moment(datas.finish, "HH:mm");

			var morningStart = $morningStart.val();
		  var morningStartTime = moment(morningStart, "HH:mm");
			var morningFinish = $morningFinish.val();
		  var morningFinishTime = moment(morningFinish, "HH:mm");
			var afternoonStart = $afternoonStart.val();
		  var afternoonStartTime = moment(afternoonStart, "HH:mm");
			var afternoonFinish = $afternoonFinish.val();
		  var afternoonFinishTime = moment(afternoonFinish, "HH:mm");


			// Fields Validation

			// Case start is later than end
			if(workoutStartTime > workoutFinishTime) {
				alert(fitnessPlanningStrings.addWorkoutTimeError);
				return false;
			}


			// Define the moment of the day
		  if(workoutStartTime < morningFinishTime) {
				datas.time = "morning";
			} else {
				datas.time = "afternoon";
			}

			// Case workout start or finish outside current hours limits
			if(datas.time == "morning" && (workoutStartTime < morningStartTime || workoutFinishTime > morningFinishTime)) {
				alert(fitnessPlanningStrings.addWorkoutOutsideBoundariesError);
				return false;
			}

			if(datas.time == "afternoon" && (workoutStartTime < afternoonStartTime || workoutFinishTime > afternoonFinishTime)) {
				alert(fitnessPlanningStrings.addWorkoutOutsideBoundariesError);
				return false;
			}


			// Get value from the input hidden field
			var planning = $planningField.val();

		  // For new planning : when it's the first entry in a new planning
		  if(planning == ""){
		    planning = { "monday": {}, "tuesday": {}, "wednesday": {}, "thursday": {}, "friday": {}, "saturday": {}, "sunday": {}};
		  } else {

				// Get the Json
				planning = JSON.parse(planning);

				// Fields Validation
				var result = true;

				// Search for conflict with existing items
				$.each(planning[day], function(index, value) {

					if(typeof(value) != "undefined"){

						var otherWorkoutStartTime = moment(value.start, "HH:mm");
						var otherWorkoutFinishTime = moment(value.finish, "HH:mm");

						// check for start time conflict
						if(workoutStartTime >= otherWorkoutStartTime && workoutStartTime < otherWorkoutFinishTime) {
							alert(fitnessPlanningStrings.addWorkoutConflictError);
							result = false;
							return false;
						}

						// check for finish time conflict
						if(result && workoutFinishTime > otherWorkoutStartTime && workoutFinishTime <= otherWorkoutFinishTime) {
							alert(fitnessPlanningStrings.addWorkoutConflictError);
							result = false;
							return false;
						}
					}
				});

				if(!result) {
					return;
				}
		  }

			// Define a new unique ID for the entry

      if( jQuery.isEmptyObject( planning[day] ) ) {
        var id = 0;
      } else {
  			var objKeys = Object.keys(planning[day]);
  			var lastUsedKey = objKeys[objKeys.length - 1];
  			var id = parseInt(lastUsedKey) + 1
      }

		  planning[day][id] = datas;
      console.log(planning[day]);

			// Add JSON value to field
		  $planningField.val(JSON.stringify(planning));

			// Clone template, populate with datas and add item to planning
			var $template = $($planningItemTemplate.clone().html());

			// Get IDs from Add form
			var workoutId = $workoutFormWorkoutField.val();
			var coachId = $workoutFormCoachField.val();

			// Get Values from fitnessPlanningWorkouts & fitnessPlanningCoachs JS var (from PHP)
			var workout = fitnessPlanningWorkouts[workoutId];

			// Don't handle coach If no one has been created yet
			if(coachId != ""){
				var coach = fitnessPlanningCoachs[coachId];
			}

			// Populate base datas
			$template.attr('data-position-id', id);

      var timeFormat = $fitplanPlanning.attr('data-time-format');

			if(timeFormat == "g:i a") {
				datas.startDisplay = moment(datas.start, "HH:mm").format("hh:mm a");
				datas.finishDisplay = moment(datas.finish, "HH:mm").format("hh:mm a");
			}
			else if(timeFormat == "g:i A") {
				datas.startDisplay = moment(datas.start, "HH:mm").format("hh:mm A");
				datas.finishDisplay = moment(datas.finish, "HH:mm").format("hh:mm A");
			}
			else {
				datas.startDisplay = datas.start;
				datas.finishDisplay = datas.finish;
			}

			$template.find('.fitplan-planning-item-hour-start').attr('data-start', datas.start);
			$template.find('.fitplan-planning-item-hour-finish').attr('data-finish', datas.finish);

      $template.find('.fitplan-planning-item-hour-start, .fitplan-planning-modal-hour-start').html(datas.startDisplay);
			$template.find('.fitplan-planning-item-hour-finish, .fitplan-planning-modal-hour-finish').html(datas.finishDisplay);

			$template.find('.fitplan-planning-modal-day').html($workoutFormDayField.find('option[selected]').html());

			// Populate Workout datas
			if('url' in workout.metas.fitplan_workout_pic){
				$template.find('.fitplan-planning-item-pic img, .fitplan-planning-modal-pic img').attr('src', workout.metas.fitplan_workout_pic.url).attr('alt', workout.post_title);
			} else {
				$template.find('.fitplan-planning-item-pic img, .fitplan-planning-modal-pic img').remove();
				$template.find('.fitplan-planning-modal-title').html(workout.post_title);
			}

			$template.find('.fitplan-planning-item-title').html(workout.post_title).attr('data-workout-id', workout.ID);
			$template.find('.fitplan-planning-modal-desc').html(workout.metas.fitplan_workout_desc);


			if(workout.metas.fitplan_workout_url != "") {
				$template.find('.fitplan-planning-modal-link a').attr('href', workout.metas.fitplan_workout_url);
			} else {
				$template.find('.fitplan-planning-modal-link').hide();
			}

			// Populate Coach datas
			if(coachId != ""){

				if('url' in coach.metas.fitplan_coach_pic){
					$template.find('.fitplan-planning-modal-coach-img').attr('src', coach.metas.fitplan_coach_pic.url).attr('alt', coach.post_title);
				} else {
					$template.find('.fitplan-planning-modal-coach-img').remove();
				}

				$template.find('.fitplan-planning-modal-coach-name').html(coach.post_title).attr('data-coach-id', coach.ID);
				$template.find('.fitplan-planning-modal-coach-bio').html(coach.metas.fitplan_coach_bio);

			} else {
				// remove coach markup
				$template.find('.fitplan-planning-modal-coach').remove();
			}

			// Define colors and styles

			// Item background color
			var showBGColor = $customizeWorkoutColor.prop('checked');
			var bgColor = $customizeWorkoutDefaultColor.val();

			var $itemInside = $template.find('.fitplan-planning-item-inside');

			if(showBGColor) {
				$itemInside.css('background-color', workout.metas.fitplan_workout_color);
				$itemInside.attr('data-color', bgColor);
			} else {
				$itemInside.css('background-color', bgColor);
				$itemInside.attr('data-color', workout.metas.fitplan_workout_color);
			}

			// Item border radius
			$itemInside.css('border-radius', $customizeWorkoutRadius.val()+'px');

			// Item color
			$itemInside.css('color', $customizeWorkoutTextColor.val());

			// Item picture
			if(!$customizeWorkoutDisplayPic.prop('checked')) {
				$template.find('.fitplan-planning-item-pic').hide();
			}

			// Item title
			if(!$customizeWorkoutDisplayTitle.prop('checked')) {
				$template.find('.fitplan-planning-item-title').hide();
			}

			// Hide workout pic if missing or item height is too small and show title instead
			var gotImage = $template.find('.fitplan-planning-item-pic img').length;

			// Can't test minHeight here because item is not yet rendered to DOM
			if(gotImage == 0) {
				$template.find('.fitplan-planning-item-pic').hide();
				$template.find('.fitplan-planning-item-title').show();
			}


			// Set item Position in planning grid
			if(datas.time == "morning")  {
				var periodStart = $morningStart.val();
			} else {
				var periodStart = $afternoonStart.val();
			}

			var workoutStart = datas.start;
			var workoutFinish = datas.finish;

		  var periodStartTime = moment(periodStart, "HH:mm");
		  var workoutStartTime = moment(workoutStart, "HH:mm");
		  var workoutFinishTime = moment(workoutFinish, "HH:mm");

		  var fromTop = workoutStartTime.diff(periodStartTime, 'minutes') * ratio;
		  var height = workoutFinishTime.diff(workoutStartTime, 'minutes') * ratio;

			$template.css({'top': fromTop+'px', 'height': height+'px'});

			// Write the template to the DOM
			$('.fitplan-planning-day[data-day='+day+'] .fitplan-planning-'+datas.time).append($template);

			checkItemsMinHeight();
		});


    // Remove Workout from planning

    $fitplanPlanning.on('click', '.fitplan-planning-delete-item', function(e){
			e.preventDefault();

			var $item = $(this).parents('.fitplan-planning-item');
			removeFromPlanning($item);
    });


		// Global function for removing item

		function removeFromPlanning($item) {
			var id = $item.attr('data-position-id');
			var day = $item.parents('.fitplan-planning-day').attr('data-day');
			var planning = JSON.parse($planningField.val());

			delete planning[day][id];

			$planningField.val(JSON.stringify(planning));

      $item.remove();
		}


		// Edit Workout

		$fitplanPlanning.on('click', '.fitplan-planning-edit-item' ,function(e){
			e.preventDefault();

			// In case someone is already being edited
			$('.fitplan-planning-item.is-edited').removeClass('is-edited');

			var $item = $(this).parents('.fitplan-planning-item');

			$item.addClass('is-edited');

			// Scroll to form
	    $('html,body').animate({scrollTop: $workoutForm.offset().top - 50 }, 300);

			// Store original texts
			if(oldTitle == '') {
				oldTitle = $workoutFormTitle.html();
				oldButton = $workoutFormButton.html();
				oldAction = $workoutFormAction.html();
			}

			// Change texts
			$workoutFormTitle.html(fitnessPlanningStrings.editWorkoutTitle);
			$workoutFormButton.html(fitnessPlanningStrings.editWorkoutButton);
			$workoutFormAction.html(fitnessPlanningStrings.editWorkoutAction);
			$workoutFormCancelButton.show();

			// Populate values
			var workoutID = $item.find('.fitplan-planning-item-title').attr('data-workout-id');
			var startHour = $item.find('.fitplan-planning-item-hour-start').attr('data-start');
			var finishHour = $item.find('.fitplan-planning-item-hour-finish').attr('data-finish');
			var coachID = $item.find('.fitplan-planning-modal-coach-name').attr('data-coach-id');
			var day = $item.parents('.fitplan-planning-day').attr('data-day');

			$workoutFormWorkoutField.val(workoutID);
		  $workoutFormStartField.val(startHour);
		  $workoutFormFinishField.val(finishHour);
		  $workoutFormCoachField.val(coachID);
		  $workoutFormDayField.val(day);

			// Visually animate color
			var $workoutFormContent = $workoutForm.find('.fitplan-section');
			$workoutFormContent.addClass('is-featured');

			window.setTimeout(function(){
				$workoutFormContent.removeClass('is-featured');
			}, 400);
		});


		// Cancel edit
		$workoutFormCancelButton.click(function(e){
			e.preventDefault();

			backToAdd();
		});

		function backToAdd() {
			var $item = $('.fitplan-planning-item.is-edited');

			$item.removeClass('is-edited');

			$workoutFormTitle.html(oldTitle);
			$workoutFormButton.html(oldButton);
			$workoutFormAction.html(oldAction);
			$workoutFormCancelButton.hide();
		}

		// Adapt planning size from opening hours

		$morningStart.change(function() { adaptPlanning() });
		$morningFinish.change(function() { adaptPlanning() });
		$afternoonStart.change(function() { adaptPlanning() });
		$afternoonFinish.change(function() { adaptPlanning() });

		function adaptPlanning() {

		  // Morning

		  var morningStart = $morningStart.val();
		  var morningFinish = $morningFinish.val();

		  var morningStartTime = moment(morningStart, "HH:mm");
		  var morningFinishTime = moment(morningFinish, "HH:mm");

			if( morningStartTime > morningFinishTime ) {
				$('.js-fitplan-morning-finish-before-start').show();
			} else {
				$('.js-fitplan-morning-finish-before-start').hide();
			}

		  var diffMorning = morningFinishTime.diff(morningStartTime, 'minutes') * ratio;

		  $fitplanPlanningMorning.css('height', diffMorning+'px');

		  // Afternoon

		  var afternoonStart = $afternoonStart.val();
		  var afternoonFinish = $afternoonFinish.val();

		  var afternoonStartTime = moment(afternoonStart, "HH:mm");
		  var afternoonFinishTime = moment(afternoonFinish, "HH:mm");

			if( afternoonStartTime > afternoonFinishTime ) {
				$('.js-fitplan-afternoon-finish-before-start').show();
			} else {
				$('.js-fitplan-afternoon-finish-before-start').hide();
			}

			if( morningFinishTime > afternoonStartTime ) {
				$('.js-fitplan-afternoon-start-before-morning-finish').show();
			} else {
				$('.js-fitplan-afternoon-start-before-morning-finish').hide();
			}

		  var diffAfternoon = afternoonFinishTime.diff(afternoonStartTime, 'minutes') * ratio;

		  $fitplanPlanningAfternoon.css('height', diffAfternoon+'px');
		}


    // Show / hide morning / afternoon

    $showMorning.change(function() {

      if ( $(this).prop('checked') ) {
        $morningStart.prop('disabled', false);
        $morningFinish.prop('disabled', false);
        $fitplanPlanningMorning.show();
      } else {
        $morningStart.prop('disabled', true);
        $morningFinish.prop('disabled', true);
        $fitplanPlanningMorning.hide();
      }
    });

    $showAfternoon.change(function() {

      if ( $(this).prop('checked') ) {
        $afternoonStart.prop('disabled', false);
        $afternoonFinish.prop('disabled', false);
        $fitplanPlanningAfternoon.show();
      } else {
        $afternoonStart.prop('disabled', true);
        $afternoonFinish.prop('disabled', true);
        $fitplanPlanningAfternoon.hide();
      }
    });


		// Display Title if there is not enough room for image or if workout image is not set
		function checkItemsMinHeight() {
			$('.fitplan-planning-item').each(function() {
				var hasImage = $(this).find('.fitplan-planning-item-pic img').attr('src') != "";

				if (parseInt($(this).height()) <= minHeightForImage || !hasImage) {
					$(this).find('.fitplan-planning-item-pic').hide();
					$(this).find('.fitplan-planning-item-title').show();
				}
			});
		}

		// Change weekdays
		$(':input[name="fitplan_planning_weekdays[]"]').change(function() {

			var day = $(this).val();

			// Toggle in planning
			$('.fitplan-planning-day[data-day='+day+']').toggle();

			// Toggle in Add select
			$('select[name=fitplan_addworkout_day] option[value='+day+']').prop('disabled', !$(this).prop('checked'));
		});


		// Fields controls

		// --- Auto update Finish Hour when changing Starting hour

		$workoutFormStartField.change(function() {
			var start = $(this).val();

			var endTime = moment(start, "HH:mm").add(1, 'h');

			$workoutFormFinishField.val(endTime.format("HH:mm"));
		});


    // Live customization

		// # Workouts

    // --- Show Logo
    $customizeWorkoutDisplayPic.change(function(){
      $('.fitplan-planning-item-pic').toggle();
			checkItemsMinHeight();
    });

    // --- Show Name
    $customizeWorkoutDisplayTitle.change(function(){
      $('.fitplan-planning-item-title').toggle();
			checkItemsMinHeight();
    });

		// --- Show Background Color
    $customizeWorkoutColor.change(function(){
			$('.fitplan-default-bg-color').slideToggle(200); // Default color field

			$('.fitplan-planning-item-inside').each(function() {
				var currentVal = $(this).css('background-color');
				var replaceWith = $(this).attr('data-color');

				$(this).css('background-color', replaceWith);
				$(this).attr('data-color', currentVal);
			});
    });

		// --- Background Color
		$customizeWorkoutDefaultColor.change(function(){
			var color = $(this).val();
			var showBGColor = $customizeWorkoutColor.prop('checked');

			$('.fitplan-planning-item-inside').each(function() {
				if(showBGColor) {
					$(this).attr('data-color', color);
				} else {
					$(this).css('background-color', color);
				}
			});

		});

		// --- Text Color
		$customizeWorkoutTextColor.change(function(){
			var color = $(this).val();
			$('.fitplan-planning-item-inside').css('color', color);
		});

		// --- Border Radius
		$customizeWorkoutRadius.change(function(){
			var radius = $(this).val();
			$('.fitplan-planning-item-inside').css('border-radius', radius+'px');
    });


		// # Planning

		// --- Text Color
		$('input[name=fitplan_planning_days_text_color]').change(function(){
			var color = $(this).val();
			$('.fitplan-planning-title').css('color', color);
		});

		// --- Background Color
		$('input[name=fitplan_planning_background_color]').change(function(){
			var color = $(this).val();
			$fitplanPlanning.css('background-color', color);
		});

		// --- Border Color
		$('input[name=fitplan_planning_border_color]').change(function(){
			var color = $(this).val();
			$fitplanPlanning.css('border-color', color);
			$fitplanPlanning.find('.fitplan-planning-day').css('border-color', color);
			$fitplanPlanning.find('.fitplan-planning-title').css('border-color', color);
			$fitplanPlanning.find('.fitplan-planning-morning').css('border-color', color+'44');
		});


		$('input[name=fitplan_planning_px_per_hour]').change(function(){

			// Calc new ratio
			ratio = parseInt($(this).val()) / 60;

			// First, adapt planning height
			adaptPlanning();

			// Then, adapt items heights and top positions
			$('.fitplan-planning-item').each(function() {

				var period = $(this).parent().attr('class');

				if(period == "fitplan-planning-morning")  {
					var periodStart = $morningStart.val();
				} else {
					var periodStart = $afternoonStart.val();
				}

				var workoutStart = $(this).find('.fitplan-planning-item-hour-start').attr('data-start');
				var workoutFinish = $(this).find('.fitplan-planning-item-hour-finish').attr('data-finish');

			  var periodStartTime = moment(periodStart, "HH:mm");
			  var workoutStartTime = moment(workoutStart, "HH:mm");
			  var workoutFinishTime = moment(workoutFinish, "HH:mm");

			  var fromTop = workoutStartTime.diff(periodStartTime, 'minutes') * ratio;
			  var height = workoutFinishTime.diff(workoutStartTime, 'minutes') * ratio;

				$(this).css({'top': fromTop+'px', 'height': height+'px'});

				// Finally, check is there is still enough roomm for images
				var hasImage = $(this).find('.fitplan-planning-item-pic img').attr('src') != "";

				if (height <= minHeightForImage || !hasImage) {
					$(this).find('.fitplan-planning-item-pic').hide();
					$(this).find('.fitplan-planning-item-title').show();
				}
				else if(height > minHeightForImage && hasImage && $customizeWorkoutDisplayPic.prop('checked')) {
					$(this).find('.fitplan-planning-item-pic').show();
					$(this).find('.fitplan-planning-item-title').hide();
				}
			});
		});

	});
})(jQuery);
