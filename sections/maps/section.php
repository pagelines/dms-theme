<?php
/*
	Section: Maps
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Google maps with markers.
	Class Name: PLMaps
	Filter: gallery, full-width
	Loading: active
*/


class PLMaps extends PageLinesSection {

	function section_styles(){
		
		wp_enqueue_script( 'google-maps', 'https://maps.google.com/maps/api/js?sensor=false', NULL, NULL, true );

		wp_enqueue_script( 'pl-maps', $this->base_url.'/maps.js', array( 'jquery' ), pl_get_cache_key(), true );
		


	}

	function section_opts(){


		$options = array();
		
		$options[] = array(
				'type'	=> 'multi',
				'key'	=> 'popshot_config', 
				'title'	=> 'Popshot Configuration',
				'col'	=> 1,
				'opts'	=> array(
					
					array(
						'type'	=> 'select',
						'key'	=> 'popshot_format', 
						'label'	=> 'Select Image Style',
						'opts'	=> array(
							'shadow'	=> array( 'name' => 'Images w/ Drop Shadows'),
							'nostyle'	=> array( 'name' => 'No Style'),
							'frame'		=> array( 'name' => 'Images with Frame'),
							'browser'	=> array( 'name' => 'Faux Browser Wrap (for screenshots)'),
						), 
					),
					array(
						'type'	=> 'text_small',
						'key'	=> 'popshot_height', 
						'label'	=> 'Total Height of PopShot',
						'place'	=> '280px'
					),
				)
				
			);
		
		
		$options[] = array(
			'key'		=> 'popshot_array',
	    	'type'		=> 'accordion', 
			'col'		=> 2,
			'title'		=> __('PopShot Setup', 'pagelines'), 
			'post_type'	=> __('PopShot', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'		=> 'image',
					'label' 	=> __( 'PopShot Image <span class="badge badge-mini badge-warning">REQUIRED</span>', 'pagelines' ),
					'type'		=> 'image_upload',
				),
				array(
					'key'	=> 'offset',
					'label'	=> __( 'Offset from center', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '-300px',
					'help'	=> __( 'Left edge offset from center. For example -100px  would move the left edge of the image 100 pixels left from center.', 'pagelines' ),
				),
				array(
					'key'	=> 'width',
					'label'	=> __( 'Maximum Width', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '600px',
					'help'	=> __( 'Max width of image.', 'pagelines' ),
				),
				array(
					'key'	=> 'height',
					'label'	=> __( 'Maximum Height', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '280px',
					'help'	=> __( 'Max height from bottom in pixels.', 'pagelines' ),
				),
				array(
					'key'	=> 'index',
					'label'	=> __( 'Z-Index (Stacking order)', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '10',
					'help'	=> __( 'Higher numbers will be placed higher in the stack.', 'pagelines' ),
				),
				
				

			)
	    );
	
		
		return $options;

	}


	function get_content( $array ){
		
		$out = '';
		
		$browser_buttons = '<div class="browser-btns"><span class="bbtn-red"></span><span class="bbtn-orange"></span><span class="bbtn-green"></span></div>';
		
		if( is_array( $array ) ){
			foreach( $array as $key => $item ){
				$image = pl_array_get( 'image', $item ); 
				$offset = pl_array_get( 'offset', $item, '-300px' );
				$index = pl_array_get( 'index', $item, '0' );
				$width = pl_array_get( 'width', $item, '600px' );
				$height = pl_array_get( 'height', $item, '250px' );

				if( $image ){
					$out .= sprintf(
						'<div class="pl-animation pla-from-bottom popshot popshot-%s" style="margin-left: %s; z-index: %s; max-width: %s; max-height: %s;">%s<img src="%s" alt="" /></div>', 
						$key, 
						$offset, 
						$index,
						$width,
						$height,
						$browser_buttons,
						$image
					);
				}

			}
		}
		
		
		return $out;
	}
	
	function section_head(){
		?>
			<script type='text/javascript'>
			/* <![CDATA[ */
			var map_data = {"1":{"lat":"51.464382","lng":"-0.256505","mapinfo":"I am an infowindow!"},"2":{"lat":"51.468499","lng":"-0.283456","mapinfo":"Every infowindow can have unique content!"},"3":{"lat":"51.475342","lng":"-0.269895","mapinfo":"Display up to 10 map locations!"},"4":{"lat":"51.471867","lng":"-0.235949","mapinfo":"I am another infowindow! "},"5":{"lat":"51.475610","lng":"-0.218868","mapinfo":"Add your own custom marker icons!"},"6":{"lat":"51.471119","lng":"-0.311909","mapinfo":"I am an infowindow! "},"7":{"lat":"51.469194","lng":"-0.204792","mapinfo":"Just an infowindow..."},"8":{"lat":"51.465558","lng":"-0.334225","mapinfo":"BAM! an infowindow!"}};
			/* ]]> */
			</script>
		<?php
	}

	// function markers(){
	// 		$options = get_option('salient'); 
	// 
	// 		$map_data = null;
	// 		$count = 0;
	// 
	// 		for($i = 1; $i <= 10; $i++){
	// 			if(!empty($options['map-point-'.$i]) && $options['map-point-'.$i] != 0 ) {
	// 				$count++;
	// 				$map_data[$count]['lat'] = $options['latitude'.$i];
	// 				$map_data[$count]['lng'] = $options['longitude'.$i];
	// 				$map_data[$count]['mapinfo'] = $options['map-info'.$i];
	// 			}	
	// 		}
	// 
	// 		
	// 		wp_localize_script( 'nectarMap', 'map_data', json_map_data() );
	// 	}
	// 	
	// 	function json_map_data() {
	// 		global $map_data; 
	// 		return $map_data;
	// 	}
	// 	

   function section_template( ) { 
	
		$classes = array(); 
		$format = $this->opt('popshot_format');
		
		if( $format == 'browser' )
			$classes[] = 'popshot-browser';
		elseif( $format == 'frame' )	
			$classes[] = 'popshot-frame';
		elseif( $format == 'nostyle' )	
			$classes[] = 'popshot-nostyle';
		else
			$classes[] = 'popshot-shadow';
		
		$array = $this->opt('popshot_array');
		
		$height = ( $this->opt('popshot_height') ) ? $this->opt('popshot_height') : '280px';
		
		
	?>
	
	<div id="contact-map" data-marker-image="<?php echo $this->base_url.'/marker.png';?>" class="popshot-wrap <?php echo join( ' ', $classes );?>" style="height: <?php echo $height;?>;">
		
	</div>

<?php }


}