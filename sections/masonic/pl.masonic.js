!function ($) {
	$(window).load(function(){
	
		$('.masonic-gallery').each(function(){
			
	    	var element = $(this)
			,	scrollSpeed
			, 	easing
			, 	shown = element.data('shown') || 3
			,	scrollSpeed = element.data('scroll-speed') || 700
			,	easing = element.data('easing') || 'linear'
		
	    });
		
	})
}(window.jQuery);