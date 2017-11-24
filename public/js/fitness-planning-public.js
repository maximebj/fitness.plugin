(function($) {
	'use strict';
	$(document).ready(function() {

    var $plannings = $('.fitplan-planning');

    // Handle Planning responsive view
		resizePlannings();

    window.onresize = function(event) {
			resizePlannings();
    };

		function resizePlannings() {
			$plannings.each(function() {

				if(this.clientWidth < 600) {
					$(this).addClass('fitplan-planning-mobile');
				} else {
					$(this).removeClass('fitplan-planning-mobile');
				}
			});
		}
	});
})(jQuery);
