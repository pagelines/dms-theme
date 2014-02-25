!function ($) {
	
	
	
	$(document).ready(function() {
		
		var theSidebar = $('.idocs-sidebar')
		,	theWrapper = $('.idocs-wrapper')
		,	sidebarTopOff = $('.pl-fixed-top').height() + theSidebar.position().top + $('#wpadminbar').height() + 40
		,	sidebarBottomOff = $(document).height() - theWrapper.offset().top - theWrapper.height() + 40

    $('.idocs-sidebar')
		.sticky({
			topSpacing: sidebarTopOff
			, bottomSpacing: sidebarBottomOff
		})


	
		
	})
}(window.jQuery);