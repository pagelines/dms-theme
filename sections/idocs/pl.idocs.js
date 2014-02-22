!function ($) {
	
	$(document).ready(function() {
		
		var sidebarOffsetFixed = $('.pl-fixed-top').height() + $('.idocs-sidebar').position().top + $('#wpadminbar').height() + 20
		
    $('.idocs-sidebar').sticky({topSpacing: sidebarOffsetFixed, bottomSpacing: 600})
		$('.idocs-wrapper').each( function(){
			
			var wrapper = $(this)
			,	sidebar = wrapper.find('.idocs-sidebar')
			,	content = wrapper.find('.idocs-content')
			,	sidebarWidth = sidebar.outerWidth( true ) 
			,	sidebarOffsetFixed = $('.pl-fixed-top').height() + sidebar.position().top + $('#wpadminbar').height()
			,	sidebarTop = sidebar.offset().top
			
			
			
			
						// 
						// console.log('sb'+ $('.pl-fixed-top').height() + 'ft' +  sidebar.position().top)
						// $(document).on('scroll', function(){
						// 	
						// 	var fromTop = $(this).scrollTop()
						// 	
						// 	console.log( 'from top '+ fromTop + 'sb top '+sidebarTop )
						// 	
						// 	if( fromTop >= sidebarTop ){
						// 		sidebar.css({ position: 'fixed', top: sidebarOffsetFixed, width: sidebarWidth })
						// 		content.css({'margin-left': sidebarWidth})
						// 	}else {
						// 		sidebar.removeAttr('style')
						// 		content.removeAttr('style')
						// 	}
						// 		
						// 	
						// })
			
		})
	
		
	})
}(window.jQuery);