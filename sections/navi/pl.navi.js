!function ($) {

	$(document).ready(function() {
		
		$('.sf-menu').each(function(){
		
			$(this).superfish({
				 delay: 800,
				 speed: 'fast',
				 speedOut: 'fast',             
				 animation:   {opacity:'show'}
			});
			
			$(this)
				.find('.sf-with-ul')
				.append('<span class="sub-indicator"><i class="icon-angle-down"></i></span>')
			
			$(this).find('.megamenu').each(function(){
				var cols = $(this).find('> .sub-menu > li').length
				
				$(this).addClass('mega-col-'+cols)
			})
			
		})
		
		
		
	})
	

}(window.jQuery);