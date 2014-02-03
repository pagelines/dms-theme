!function ($) {
	
	$(document).ready(function() {
		
    	
		
		
		plMasonryLayout()
		$(window).resize( plMasonryLayout )
	
	    
		
		function plMasonryLayout( masonicElement ){
			
				var element = $(this)
				, 	format = element.data('format')
				,	layoutMode = ( format == 'grid' ) ? 'fitRows' : 'masonry'
				,	scrollSpeed
				, 	easing
				, 	shown = element.data('shown') || 3
				,	scrollSpeed = element.data('scroll-speed') || 700
				,	easing = element.data('easing') || 'linear'
				,	numberCols = 3
			//	,	bodySize = getComputedStyle(document.body, ':after').getPropertyValue('content'); 
	
				$('.masonic-gallery').each(function(  ){
			
						var galWidth = $(this).width()
						,	masonrySetup = { }
						,	numCols
				
						if( galWidth >= 1600 ){
							numCols = 5
						} else if ( galWidth >= 1300 ){
							numCols = 4
						} else if ( galWidth >= 990 ){
							numCols = 3
						} else if ( galWidth >= 470 ){
							numCols = 2
						} else {
							numCols = 1
						}
				
						masonrySetup = {
							columnWidth: parseInt( galWidth / numCols )
						}
						console.log(galWidth / numCols)
						console.log(masonrySetup)
			
		
						$(this).isotope({
							resizable: false, 
							itemSelector : 'li',
							filter: '*',
							layoutMode: layoutMode,
							masonry: masonrySetup
						}).isotope( 'reLayout' )
	
				})
			
			
		}
		
		
	})
}(window.jQuery);