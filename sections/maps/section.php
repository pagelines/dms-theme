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
	public $desc = '<a href="http://www.pagelines.com">PageLines</a>';
	public $help = 'To find map the coordinates use this easy tool: <a href="http://www.mapcoordinates.net/en">ww.mapcoordinates.net</a>';
	
	function section_styles(){
		
		wp_enqueue_script( 'google-maps', 'https://maps.google.com/maps/api/js?sensor=false', NULL, NULL, true );
		wp_enqueue_script( 'pl-maps', $this->base_url.'/maps.js', array( 'jquery' ), pl_get_cache_key(), true );
	}

	function section_head() {
		$locations = $this->opt('locations_array');
		
		$defaults = array(
			'lat'	=> floatval( $this->lat ),
			'lng'	=> floatval( $this->lng ),
			'mapinfo'	=> $this->desc,
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
					'lat'	=> ( isset( $data['latitude'] ) ) ? floatval( $data['latitude'] ): floatval( $this->lat ),
					'lng'	=> ( isset( $data['longitude'] ) ) ? floatval( $data['longitude'] ) : floatval( $this->lng ),
					'mapinfo'	=> ( isset( $data['text'] ) && '' != $data['text'] ) ? $data['text'] : $this->desc,
					'image'		=> ( isset( $data['image'] ) && '' != $data['image'] ) ? do_shortcode( $data['image'] ) : $this->base_url.'/marker.png'
				);
				$i++;
			}
		}
		
		$defaults = array(
			'lat'	=> floatval( $this->lat ),
			'lng'	=> floatval( $this->lng ),
			'zoom_level'	=> 10,
			'zoom_enable'	=> true,
			'enable_animation' => true,
			'image'			=> $this->base_url.'/marker.png'
		);

		$main = array(
			'lat'			=> $this->opt( 'center_lat' ),
			'lng'			=> $this->opt( 'center_lng' ),
			'zoom_level'	=> floatval( $this->opt( 'map_zoom_level') ),
			'zoom_enable'	=> $this->opt( 'map_zoom_enable'),
			'enable_animation' => $this->opt( 'enable_animation'),	
		);
		foreach( $main as $k => $d )
			if( ! isset( $d ) )
				unset( $main[$k] );

		$zoom = $this->opt( 'map_zoom_enable');
		$zoom_level = $this->opt( 'map_zoom_level');
		$animations = $this->opt( 'enable_animation');
		wp_localize_script( 'pl-maps', 'map_data', $maps );
		
		$main = wp_parse_args( $main, $defaults );

		wp_localize_script( 'pl-maps', 'map_main', $main );
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
						'label'	=> 'Latitude',
						'help'	=> $this->help
					),
					array(
						'key'	=> 'center_lng',
						'type'	=> 'text_small',
						'default'	=> $this->lng,
						'place'	=> $this->lng,
						'label'	=> 'Longitude',
						'help'	=> $this->help
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
							'default'		=> true,
							'compile'		=> true,
						),					
					array(
						'type'	=> 'check',
						'key'	=> 'enable_animation', 
						'label'	=> 'Enable Animations',
						'default'		=> true,
						'compile'		=> true,
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
					'help'	=> $this->help,
				),
				array(
					'key'	=> 'longitude',
					'label'	=> __( 'Longitude', 'pagelines' ),
					'type'	=> 'text_small',
					'place'	=> '-0.256505',
					'help'	=> $this->help,
				),
				array(
					'key'	=> 'text',
					'label'	=> 'Location Description',
					'type'	=> 'textarea',
					'default'	=> $this->desc,
					'place'		=> $this->desc
				)
			)
	    );
		return $options;
	}

   function section_template( ) {

		echo '<div class="pl-map-wrap"><div id="pl-map"></div></div>';

	}

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