<?php
/*
	Section: Maps
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Google maps with markers.
	Class Name: PLMaps
	Filter: component
	Loading: active
*/


class PLMaps extends PageLinesSection {

	public $lat = '37.774929';
	public $lng = '-122.419416';
	
	public $br_lat = '37.817785';
	public $br_lng = '-122.477474';

	function section_styles(){
		
		wp_enqueue_script( 'google-maps', 'https://maps.google.com/maps/api/js?sensor=false', NULL, NULL, true );
		wp_enqueue_script( 'pl-maps', $this->base_url.'/maps.js', array( 'jquery' ), pl_get_cache_key(), true );
	}

	function section_head() {
		$locations = $this->opt('locations_array');
		
		$defaults = array(
			'lat'	=> floatval( $this->br_lat ),
			'lng'	=> floatval( $this->br_lng ),
			'mapinfo'	=> 'The Golden Gate!',
			'image'		=> $this->base_url.'/marker.png'
		);
		
		if( ! is_array( $locations ) ) {
			$maps = array(
				1 => $defaults
			);
		} else {
			$maps = array();
			$i = 1;
			foreach( $locations as $k => $data ) {

				$maps[$i] = array(
					'lat'	=> ( isset( $data['latitude'] ) ) ? floatval( $data['latitude'] ): floatval( $this->br_lat ),
					'lng'	=> ( isset( $data['longitude'] ) ) ? floatval( $data['longitude'] ) : floatval( $this->br_lng ),
					'mapinfo'	=> ( isset( $data['text'] ) ) ? $data['text'] : 'Location',
					'image'		=> ( isset( $data['image'] ) ) ? do_shortcode( $data['image'] ) : ''
				);
				$i++;
			}
		}

		wp_localize_script( 'pl-maps', 'map_data', $maps );
	}

	function section_opts(){


		$options = array();
		
		$options[] = array(
				'type'	=> 'multi',
				'key'	=> 'plmap_config', 
				'title'	=> 'Google Maps Configuration',
				'col'	=> 1,
				'opts'	=> array(
					
					array(
						'key'	=> 'center_lat',
						'type'	=> 'text_small',
						'default'	=> $this->lat,
						'place'		=> $this->lat,
						'label'	=> 'Latitude'
					),
					array(
						'key'	=> 'center_lng',
						'type'	=> 'text_small',
						'default'	=> $this->lng,
						'place'	=> $this->lng,
						'label'	=> 'Longitude'
					),
					
					array(
						'type'	=> 'select',
						'key'	=> 'map_height',
						'default'	=> '350px',
						'label'	=> 'Select Map Height ( default 350px)',
						'opts'	=> array(
							'200px'	=> array( 'name' => '200px'),
							'250px'	=> array( 'name' => '250px'),
							'300px'	=> array( 'name' => '300px'),
							'350px'	=> array( 'name' => '350px'),
							'400px'	=> array( 'name' => '400px'),
						)
					),
						array(
							'type'	=> 'count_select',
							'key'	=> 'map_zoom_level',
							'default'	=> '12',
							'label'	=> 'Select Map Zoom Level ( default 10)',
							'count_start'	=> 1,
							'count_number'	=> 18,
							'default'		=> '10',
						),
						array(
							'type'	=> 'check',
							'key'	=> 'map_zoom_enable', 
							'label'	=> 'Enable Zoom Controls',
							'default'	=> true
						),					
					array(
						'type'	=> 'check',
						'key'	=> 'enable_animation', 
						'label'	=> 'Enable Animations',
						'default'	=> true
					),
				)
				
			);
		
		$options[] = array(
			'key'		=> 'locations_array',
	    	'type'		=> 'accordion', 
			'col'		=> 2,
			'opts_cnt'	=> 1,
			'title'		=> __('Pointer Locations', 'pagelines'), 
			'post_type'	=> __('Location', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'		=> 'image',
					'label' 	=> __( 'Pointer Image', 'pagelines' ),
					'type'		=> 'image_upload',
				),
				array(
					'key'	=> 'latitude',
					'label'	=> __( 'Latitude', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '51.464382',
					'help'	=> __( 'Latitude', 'pagelines' ),
				),
				array(
					'key'	=> 'longitude',
					'label'	=> __( 'Longitude', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '-0.256505',
					'help'	=> __( 'Longitude', 'pagelines' ),
				),
				array(
					'key'	=> 'text',
					'label'	=> 'Some text',
					'type'	=> 'text_small',
					'default'	=> 'PageLines<br />FTW!!'
				)
			)
	    );
		return $options;
	}

   function section_template( ) {
	
		$zoom = $this->opt( 'map_zoom_enable');
		$zoom_level = $this->opt( 'map_zoom_level');
		$animations = $this->opt( 'enable_animation');
		
		$center_lat = $this->opt( 'center_lat');
		$center_lng = $this->opt( 'center_lng');
		
		$map_data = sprintf( '<div id="pl-map" data-marker-image="%s"  data-enable-animation="%s" data-enable-zoom="%s" data-zoom-level="%s" data-center-lat="%s" data-center-lng="%s">',
		$this->base_url.'/marker.png',
		$animations,
		$zoom,
		$zoom_level,
		$center_lat,
		$center_lng	
		);		
	?>
	<div class="pl-map-wrap">
		<?php echo $map_data; ?>
	</div>
	</div>

<?php }

	function section_foot() {
		$height = ( $this->opt( 'map_height' ) ) ? $this->opt( 'map_height' ) : '350px';
		?>
		<script>
		jQuery(document).ready(function(){
			jQuery('#pl-map').css({ height: '<?php echo $height; ?>' });
		})
		</script>
		<?php
	}

}