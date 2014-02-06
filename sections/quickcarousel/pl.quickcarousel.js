!function ($) {
	
	$(document).ready(function() {
		
    	
		$('.pl-quickcarousel').each(function(){
	    	var $that = $(this);
	    	var columns; 
	    	(parseInt($(this).attr('data-max'))) ? columns = parseInt($(this).attr('data-max')) : columns = 5;
	    	if($(window).width() < 690 && $('body').attr('data-responsive') == '1') { columns = 2; $(this).addClass('phone') }

	    	var $element = $that;
			if($that.find('img').length == 0) $element = $('body');

			$element.imagesLoaded( function(instance){

		    	$that.carouFredSel({
			    		circular: true,
			    		responsive: true, 
				        items       : {

							height : $that.find('> li:first').height(),
							width  : $that.find('> li:first').width(),
					        visible     : {
					            min         : 1,
					            max         : columns
					        }
					    },
					    swipe       : {
					        onTouch     : true,
					        onMouse         : true
					    },
					    scroll: {
					    	items           : 1,
					    	easing          : 'easeInOutCubic',
				            duration        : '800',
				            pauseOnHover    : true
					    },
					    auto    : {
					    	play            : true,
					    	timeoutDuration : 2700
					    }
			    }).animate({'opacity': 1},1300);

			    $that.parents('.carousel-wrap').wrap('<div class="carousel-outer">');

			    //cients carousel height
		  		$(window).resize(function(){

		  			var tallestImage = 0;

			    	 $('.pl-quickcarousel').each(function(){

			    	 	$(this).find('> li').each(function(){
							($(this).height() > tallestImage) ? tallestImage = $(this).height() : tallestImage = tallestImage;
						});	

			         	$(this).css('height',tallestImage);
			         	$(this).parent().css('height',tallestImage);
			         });
		   	    });  	

			    $(window).trigger('resize');


		    });

	    });
		
	})
}(window.jQuery);