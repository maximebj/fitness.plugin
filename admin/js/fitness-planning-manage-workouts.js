(function( $ ) {
	'use strict';
	$(document).ready(function() {

		// Vars and Selectors

		var ratio = 1.5;

		var $morningStart = $('input[name=fitplan_planning_morning_start]');
		var $morningFinish = $('input[name=fitplan_planning_morning_finish');
		var $afternoonStart = $('input[name=fitplan_planning_afternoon_start]');
		var $afternoonFinish = $('input[name=fitplan_planning_afternoon_finish');

		var $fitplanPlanningMorning = $('.fitplan-planning-morning');
		var $fitplanPlanningAfternoon = $('.fitplan-planning-afternoon');

		var $planningField = $('input[name=fitplan_planning]');

		var $planningItemTemplate = $('.fitplan-planning-item-template');

		// Planning - Add workout to planning

		$('.js-fitplan-add-to-planning').click(function(e){
		  e.preventDefault();

		  var day = $('.js-fitplan-day').val();

		  var datas = {
		    "name": $('.js-fitplan-name').val(),
		    "start": $('.js-fitplan-start').val(),
		    "finish": $('.js-fitplan-finish').val(),
		    "coach": $('.js-fitplan-coach').val()
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
		    planning = { "monday": [], "tuesday": [], "wednesday": [], "thursday": [], "friday": [], "saturday": [], "sunday": []};
		  } else {
		    planning = JSON.parse(planning);
		  }

		  planning[day].push(datas);

			// Add JSON value to field
		  $planningField.val(JSON.stringify(planning));

			// Add item to planning

			var $item = $($planningItemTemplate.clone().html());

			var workoutName = $('.js-fitplan-name option:selected').html();
			var coachName = $('.js-fitplan-coach option:selected').html();

			// datas

			$item.find('.fitplan-planning-item-title').html(workoutName);
			$item.find('.fitplan-planning-item-coach span').html(coachName);
			$item.find('.fitplan-planning-item-hour').html(datas.start+' - '+datas.finish);

			// position

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

		});


		// Adapt planning size from opening hours

		adaptPlanning();

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

	});
})( jQuery );
