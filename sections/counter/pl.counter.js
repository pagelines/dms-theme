!function ($) {

	$(document).ready(function() {
		
		$('.pl-counter').each(function() {
			
			var cntr = $(this)
			
			cntr.appear( function() {
				
			   	var the_number = parseInt( cntr.find('.number').text() )
				
				cntr.find('.number').countTo({
						from: 0
					,	to: the_number
					,	speed: 1500
					,	refreshInterval: 30
				})
			
			})
		
		})
		
	})
	

}(window.jQuery);