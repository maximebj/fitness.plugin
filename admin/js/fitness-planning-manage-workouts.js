(function( $ ) {
	'use strict';
	$(document).ready(function() {

		// Vars and Selectors

		var ratio = 1.5;

		var oldTitle = '';
		var oldButton = '';
		var oldAction = '';


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
		var $workoutFormWorkoutField = $('input[name=fitplan_addworkout_workout]');
		var $workoutFormDayField = $('input[name=fitplan_addworkout_day]');
		var $workoutFormStartField = $('input[name=fitplan_addworkout_start]');
		var $workoutFormFinishField = $('input[name=fitplan_addworkout_finish]');
		var $workoutFormCoachField = $('input[name=fitplan_addworkout_coach]');

		// Settings Fiels
		var $morningStart = $('input[name=fitplan_planning_morning_start]');
		var $morningFinish = $('input[name=fitplan_planning_morning_finish');
		var $afternoonStart = $('input[name=fitplan_planning_afternoon_start]');
		var $afternoonFinish = $('input[name=fitplan_planning_afternoon_finish');


		// Add or edit workout to planning

		$('.js-fitplan-add-to-planning').click(function(e){
		  e.preventDefault();

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

		  if(workoutStartTime < morningFinishTime) {
				datas.time = "morning";
			} else {
				datas.time = "afternoon";
			}

		  var planning = $planningField.val();

		  // For new planning
		  if(planning == ""){
		    planning = { "monday": {}, "tuesday": {}, "wednesday": {}, "thursday": {}, "friday": {}, "saturday": {}, "sunday": {}};
		  } else {
		    planning = JSON.parse(planning);
		  }

			var id = Object.keys(planning[day]).length;
		  planning[day][id] = datas;

			// Add JSON value to field
		  $planningField.val(JSON.stringify(planning));

			// Add item to planning
			var $item = $($planningItemTemplate.clone().html());

			var workoutName = $workoutFormWorkoutField.find('option:selected').html();
			var workoutId = $workoutFormWorkoutField.val();
			var coachName = $('.js-fitplan-coach option:selected').html();
			var coachId = $workoutFormCoachField.val();

			// Datas
			$item.attr('data-id', id);
			$item.find('.fitplan-planning-item-title').html(workoutName).attr('data-workout-id', workoutId);
			$item.find('.fitplan-planning-item-coach-name').html(coachName).attr('data-coach-id', coachId);
			$item.find('.fitplan-planning-item-hour-start').html(datas.start);
			$item.find('.fitplan-planning-item-hour-finish').html(datas.finish);

			// Position
			if( datas.time == "morning" ) {
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

    $('.fitplan-planning').on('click', '.fitplan-planning-delete-item', function(e){
			e.preventDefault();

			var $item = $(this).parents('.fitplan-planning-item');
			removeFromPlanning($item);

    });


		// Global function for removing item

		function removeFromPlanning($item) {
			var id = $item.attr('data-id');
			var day = $item.parents('.fitplan-planning-day').attr('data-day');

			var planning = JSON.parse($planningField.val());

			console.log(planning, id);
			delete planning[day][id];
			$planningField.val(JSON.stringify(planning));

      $item.remove();
		}


		// Edit Workout

		$('.fitplan-planning').on('click', '.fitplan-planning-edit-item' ,function(e){
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



		// Launch at Startup

		adaptPlanning();
		checkItemsMinHeight();



		// Adapt planning size from opening hours

		$('input[name=fitplan_planning_morning_start], input[name=fitplan_planning_morning_finish], input[name=fitplan_planning_afternoon_start], input[name=fitplan_planning_afternoon_finish]').change(function(){
		  adaptPlanning();
		});

		function adaptPlanning() {

		  // Morning

		  var morningStart = $morningStart.val();
		  var morningFinish = $morningFinish.val();

		  var morningStartTime = moment(morningStart, "HH:mm");
		  var morningFinishTime = moment(morningFinish, "HH:mm");

		  var diffMorning = morningFinishTime.diff(morningStartTime, 'minutes') * ratio;

		  $fitplanPlanningMorning.css('height', diffMorning+'px');

		  // Afternoon

		  var afternoonStart = $afternoonStart.val();
		  var afternoonFinish = $afternoonFinish.val();

		  var afternoonStartTime = moment(afternoonStart, "HH:mm");
		  var afternoonFinishTime = moment(afternoonFinish, "HH:mm");

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


		// Fields controls

		$workoutFormStartField.change(function() {
			var start = $(this).val();

			var minStartTime = moment(start, "HH:mm").add(30, 'm');
			var endTime = moment(start, "HH:mm").add(1, 'h');

			$workoutFormFinishField.val(endTime.format("HH:mm")).attr('min', minStartTime.format("HH:mm"));
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
			$('.fitplan-planning').css('background-color', color);
		});

		$('input[name=fitplan_planning_px_per_hour]').change(function(){
			recalculatePlanning();
		});


	});
})( jQuery );
