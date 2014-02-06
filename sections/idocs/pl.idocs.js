!function ($) {
	
	$(document).ready(function() {
		
    	
		
		
		plMasonryLayout()
		$(window).resize( plMasonryLayout )
	
		$('.masonic-nav a').click(function(e){
			 e.preventDefault()
			
			
			var theLink = $(this)
			,	theFilter = theLink.text()
			// highlight
			$('.masonic-nav li').removeClass('pl-link active')
			theLink.parent().addClass('pl-link active')
			
			
			// title text
			$('.masonic-title').text( theFilter )
			
			 //add css animation only for sorting
				var clearIsoAnimation = null;
			  clearTimeout(clearIsoAnimation);
			  $('.isotope, .isotope .isotope-item').css('transition-duration','0.7s');
			  clearIsoAnimation = setTimeout(function(){  $('.isotope, .isotope .isotope-item').css('transition-duration','0s'); },700);	 
			
			var selector = $(this).attr('data-filter')
			, 	theIsotope = $(this).closest('.masonic-wrap').find('.isotope')
			
			theIsotope
				.isotope({ filter: selector })
			
			return false;
		})
	    
		
		function plMasonryLayout( ){
			
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