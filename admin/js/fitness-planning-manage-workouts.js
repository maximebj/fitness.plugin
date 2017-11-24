(function($) {
	'use strict';
	$(document).ready(function() {

		// Selectors

		// General components
		var $fitplanPlanning = $('.fitplan-planning');
		var $fitplanModal = $('.fitplan-planning-modal');

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
		var $morningStart = $('input[name=fitplan_planning_morning_start]');
		var $morningFinish = $('input[name=fitplan_planning_morning_finish');
		var $afternoonStart = $('input[name=fitplan_planning_afternoon_start]');
		var $afternoonFinish = $('input[name=fitplan_planning_afternoon_finish');


		// Vars

		var ratio = parseInt($fitplanPlanning.attr('data-px-per-hour')) / 60 ;

		var oldTitle = '';
		var oldButton = '';
		var oldAction = '';

		// Add or edit workout to planning

		$workoutFormButton.click(function(e){
		  e.preventDefault();

			// Get datas
			var day = $workoutFormDayField.val();

		  var datas = {
		    "workout": $workoutFormWorkoutField.val(),
		    "start": $workoutFormStartField.val(),
		    "finish": $workoutFormFinishField.val(),
		    "coach": $workoutFormCoachField.val()
		  };

			var morningFinish = $morningFinish.val();
		  var morningFinishTime = moment(morningFinish, "HH:mm");
		  var workoutStartTime = moment(datas.start, "HH:mm");
		  var workoutFinishTime = moment(datas.finish, "HH:mm");

			// Fields Validation
			if(workoutStartTime > workoutFinishTime) {
				alert(fitnessPlanningStrings.addWorkoutTimeError);
				return false;
			}

		  if(workoutStartTime < morningFinishTime) {
				datas.time = "morning";
			} else {
				datas.time = "afternoon";
			}

		  var planning = $planningField.val();

		  // For new planning : when it's the first entry in a new planning
		  if(planning == ""){
		    planning = { "monday": {}, "tuesday": {}, "wednesday": {}, "thursday": {}, "friday": {}, "saturday": {}, "sunday": {}};
		  } else {
		    planning = JSON.parse(planning);

				// Fields Validation
				var result = true;
				$.each(planning[day], function(index, value) {

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
				});

				if(!result) {
					return;
				}
		  }

			// Define a new unique ID for the entry
			var id = Object.keys(planning[day]).length;
		  planning[day][id] = datas;

			// Add JSON value to field
		  $planningField.val(JSON.stringify(planning));

			// Clone template, populate with datas and add item to planning
			var $item = $($planningItemTemplate.clone().html());

			// Get IDs from Add form
			var workoutId = $workoutFormWorkoutField.val();
			var coachId = $workoutFormCoachField.val();

			// Get Values from fitnessPlanningWorkouts & fitnessPlanningCoachs JS var (from PHP)

			// fitnessPlanningWorkouts
			// fitnessPlanningCoachs

			// TODO

			console.log(fitnessPlanningWorkouts[workoutId]);
			console.log(fitnessPlanningCoachs[coachId]);

			var workoutName = $workoutFormWorkoutField.find('option:selected').html();
			var coachName = $('.js-fitplan-coach option:selected').html();

			// Datas
			$item.attr('data-position-id', id);
			$item.find('.fitplan-planning-item-title').html(workoutName).attr('data-workout-id', workoutId);
			$item.find('.fitplan-planning-item-coach-name').html(coachName).attr('data-coach-id', coachId);
			$item.find('.fitplan-planning-item-hour-start').html(datas.start);
			$item.find('.fitplan-planning-item-hour-finish').html(datas.finish);

			// Position
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

			$item.css({'top': fromTop+'px', 'height': height+'px'});

			$('.fitplan-planning-day[data-day='+day+'] .fitplan-planning-'+datas.time).append($item);

			// Edition mode : delete old item
			var $editedItem = $('.fitplan-planning-item.is-edited');

			if($editedItem.length) {
				removeFromPlanning($editedItem);
				backToAdd();
			}
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

			console.log(planning, id);
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
			var startHour = $item.find('.fitplan-planning-item-hour-start').html();
			var finishHour = $item.find('.fitplan-planning-item-hour-finish').html();
			var coachID = $item.find('.fitplan-planning-item-coach-name').attr('data-coach-id');
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

		// Recalculate Planning items positions
		function recalculatePlanning() {
			console.log('...');
		}

		function checkItemsMinHeight() {
			$('.fitplan-planning-item').each(function() {
				if (this.clientHeight < 50) {
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
    $('input[name=fitplan_planning_workout_display_pic]').change(function(){
      $('.fitplan-planning-item-pic').toggle();
			checkItemsMinHeight();
    });

    // --- Show Name
    $('input[name=fitplan_planning_workout_display_title]').change(function(){
      $('.fitplan-planning-item-title').toggle();
			checkItemsMinHeight();
    });

		// --- Show Background Color
    $('input[name=fitplan_planning_workout_display_color]').change(function(){
			$('.fitplan-default-bg-color').slideToggle(200); // Default color field

			$('.fitplan-planning-item-inside').each(function() {
				var currentVal = $(this).css('background-color');
				var replaceWith = $(this).attr('data-color');

				$(this).css('background-color', replaceWith);
				$(this).attr('data-color', currentVal);
			});
    });

		// --- Background Color
		$('input[name=fitplan_planning_workout_default_color]').change(function(){
			var color = $(this).val();
			var showBGColor = $('input[name=fitplan_planning_workout_display_color]').prop('checked');

			$('.fitplan-planning-item-inside').each(function() {
				if(showBGColor) {
					$(this).attr('data-color', color);
				} else {
					$(this).css('background-color', color);
				}
			});

		});

		// --- Text Color
		$('input[name=fitplan_planning_workout_text_color]').change(function(){
			var color = $(this).val();
			$('.fitplan-planning-item-inside').css('color', color);
		});

		// --- Border Radius
		$('input[name=fitplan_planning_workout_radius]').change(function(){
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
			recalculatePlanning();
		});

	});
})(jQuery);
