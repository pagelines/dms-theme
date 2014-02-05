!function ($) {

	$(document).ready(function() {
		
		$('.pl-testimonials-container').each(function(){
			
			var tst = $(this)
			,	mode = tst.data('mode')
			,	height_set = Boolean( tst.data('height') )
			,	speed = tst.data('speed')
			,	auto = Boolean( tst.data('auto') )
		
			tst.quovolver({
				children : 'li',
				transitionSpeed : 200,
				autoPlay : auto,
				autoPlaySpeed: speed,
				equalHeight : height_set,
			//	navPosition : 'below',
				navPrev     : false,
				navNext     : false,
				navNum      : true,
				navText     : false,
			  })
		
			// generated by quovolver
			var theNav = $(this).parent().find('.nav-numbers')
		
			if( mode == 'avatar' ){
				
				$(this).find('li').each(function(i){
					var avatar = $(this).data('avatar')
					,	link = sprintf('<img src="%s" />', avatar)


					theNav.find('li').addClass('avatar-nav').eq(i).find('a').attr('style', sprintf('background-image: url(%s);', avatar) )
				})
				
			} else 
				theNav.addClass('nav-theme')
				
			
		})
		
	})
	

}(window.jQuery);