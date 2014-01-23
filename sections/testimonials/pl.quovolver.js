!function ($) {

	$(document).ready(function() {
		
		$('.pl-testimonials-container').each(function(){
			
			$(this).quovolver({
				children : 'li',
				transitionSpeed : 300,
				autoPlay : true,
				autoPlaySpeed: 6000,
				equalHeight : false,
				navPosition : 'below',
				navPrev     : false,
				navNext     : false,
				navNum      : true,
				navText     : false,
				navTextContent : 'Quote @a of @b'
			  });
		
		})
		
	})
	

}(window.jQuery);