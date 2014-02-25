!function ($) {
	
	
	
	$(document).ready(function() {
		
		var docHeight = $(document).height()
		
		$('.docker-wrapper').each(function(){
			
			var stdOffset = 40
			,	theWrapper = $(this)
			,	theSidebar = theWrapper.find('.docker-sidebar')
			,	sidebarTopOff = $('.pl-fixed-top').height() + theSidebar.position().top + $('#wpadminbar').height() + stdOffset
			,	sidebarBottomOff = docHeight - theWrapper.offset().top - theWrapper.height() + stdOffset
			
			 theSidebar.sticky({
						topSpacing: sidebarTopOff
						, bottomSpacing: sidebarBottomOff
					})
					
			
		})

	})
}(window.jQuery);