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

    // Avoid bubble to be displyed out of the page
    $('.fitplan-planning-item').on('hover', function( event ) {

      if ( $( window ).width() >= 600 && $( window ).width() - event.pageX < 350 ) {
        $(this).find('.fitplan-planning-item-bubble').css({ 'left': 'auto', 'right': '100%'});
      } else {
        $(this).find('.fitplan-planning-item-bubble').attr('style', '');
      }
    });

	});
})(jQuery);
