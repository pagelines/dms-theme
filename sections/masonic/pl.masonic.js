!function ($) {
	$(window).load(function(){
	
		$('.masonic-gallery').each(function(){
			
	    	var element = $(this)
			, 	format = element.data('format')
			,	layoutMode = ( format == 'grid' ) ? 'fitRows' : 'masonry'
			,	scrollSpeed
			, 	easing
			, 	shown = element.data('shown') || 3
			,	scrollSpeed = element.data('scroll-speed') || 700
			,	easing = element.data('easing') || 'linear'
			,	numberCols = 3
		
			
			
			//element.isotope()
			element.isotope({
			//	resizable: false, 
				itemSelector : 'li',
				filter: '*',
				layoutMode: layoutMode,
				
			}).isotope( 'reLayout' );
		
		
	    })
		
	})
}(window.jQuery);