Object.keys = Object.keys || function(o) { 
    var result = []; 
    for(var name in o) { 
        if (o.hasOwnProperty(name)) 
          result.push(name); 
    } 
    return result; 
};

jQuery(document).ready(function($){
	
	
    var zoomLevel = parseFloat($('#contact-map').attr('data-zoom-level')) || 12
    ,	centerlat = parseFloat($('#contact-map').attr('data-center-lat')) || 37.7830061
	,	centerlng = parseFloat($('#contact-map').attr('data-center-lng')) || -122.3902466
	,	markerImg = $('#contact-map').attr('data-marker-image')
	,	enableZoom = true
	,	enableAnimation = google.maps.Animation.BOUNCE 
	,	animationDelay = 180
	,	latLng = new google.maps.LatLng(centerlat,centerlng);
    
    
	var mapOptions = {
      center: latLng,
      zoom: zoomLevel,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false,
      panControl: false,
	  zoomControl: enableZoom,	  
	  zoomControlOptions: {
        style: google.maps.ZoomControlStyle.LARGE,
        position: google.maps.ControlPosition.LEFT_CENTER
   	  },
	  mapTypeControl: false,
	  scaleControl: false,
	  streetViewControl: false
	  
    };
	
	var map = new google.maps.Map(document.getElementById("contact-map"), mapOptions);
	
	var infoWindows = [];
	
	google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
		
		//don't start the animation until the marker image is loaded if there is one
		if(markerImg.length > 0) {
			var markerImgLoad = new Image();
			markerImgLoad.src = markerImg;
			
			$(markerImgLoad).load(function(){
				 setMarkers(map);
			});
		}
		else {
			setMarkers(map);
		}
    });
    
    
    function setMarkers(map) {
		for (var i = 1; i <= Object.keys(map_data).length; i++) {  
			
			(function(i) {
				setTimeout(function() {
				
			      var marker = new google.maps.Marker({
			      	position: new google.maps.LatLng(map_data[i].lat, map_data[i].lng),
			        map: map,
					infoWindowIndex : i - 1,
					animation: enableAnimation,
					icon: markerImg,
					optimized: false
			      });
				  
				  setTimeout(function(){marker.setAnimation(null);},200);
				  
			      //infowindows 
			      var infowindow = new google.maps.InfoWindow({
			   	    content: map_data[i].mapinfo,
			    	maxWidth: 300
				  });
				  
				  infoWindows.push(infowindow);
			      
			      google.maps.event.addListener(marker, 'click', (function(marker, i) {
			        return function() {
			        	infoWindows[this.infoWindowIndex].open(map, this);
			        }
			        
			      })(marker, i));
		     	
		         }, i * animationDelay);
		         
		         
		     }(i));
		     

		 }//end for loop
	}//setMarker
	
});
