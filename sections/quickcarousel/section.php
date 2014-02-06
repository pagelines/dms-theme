<?php
/*
	Section: QuickCarousel
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A fast way to create an animated image carousel.
	Class Name: PLQuickCarousel
	Filter: gallery, dual-width
*/


class PLQuickCarousel extends PageLinesSection {

	function section_styles(){
		wp_enqueue_script( 'caroufredsel', $this->base_url.'/caroufredsel.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'pl-quickcarousel', $this->base_url.'/pl.quickcarousel.js', array( 'jquery' ), pl_get_cache_key(), true );
	}

	function section_opts(){


		$options = array();
		
		$options[] = array(
				'type'	=> 'multi',
				'key'	=> 'config', 
				'title'	=> 'Config',
				'col'	=> 1,
				'opts'	=> array(
					
					array(
						'type'	=> 'select',
						'key'	=> 'format', 
						'label'	=> 'Select Format',
						'opts'	=> array(
							'shadow'	=> array( 'name' => 'Images w/ Drop Shadows'),
							'nostyle'	=> array( 'name' => 'No Style'),
							'frame'		=> array( 'name' => 'Images with Frame'),
							'browser'	=> array( 'name' => 'Faux Browser Wrap (for screenshots)'),
						), 
					),
					array(
						'type'	=> 'text_small',
						'key'	=> 'max', 
						'label'	=> 'Max Items',
						'default'	=> 6
					),
				)
				
			);
		
		
		$options[] = array(
			'key'		=> 'array',
	    	'type'		=> 'accordion', 
			'col'		=> 2,
			'title'		=> __('Image Setup', 'pagelines'), 
			'post_type'	=> __('Image', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'		=> 'image',
					'label' 	=> __( 'Carousel Image <span class="badge badge-mini badge-warning">REQUIRED</span>', 'pagelines' ),
					'type'		=> 'image_upload',
				),
				array(
					'key'	=> 'link',
					'label'	=> __( 'Image Link', 'pagelines' ),
					'type'	=> 'text',
				),

			)
	    );
	
		
		return $options;

	}


	function get_content( $array ){
		
		$out = '';
		
		if( is_array( $array ) ){
			foreach( $array as $key => $item ){
				$image = pl_array_get( 'image', $item ); 
				$image_id = pl_array_get( 'image_attach_id', $item ); 
				$link = pl_array_get( 'link', $item );
			
				if( $image ){
					
					$image_meta = wp_get_attachment_image_src( $image_id, 'aspect-thumb' );
					
					$image_url = (isset($image_meta[0])) ? $image_meta[0] : $image;
				
					$image_out = ( $link ) ? sprintf('<a href="%s"><img src="%s" alt="" /></a>', $link, $image_url) : sprintf('<img src="%s" alt="" />', $image_url);
					
					$out .= sprintf(
						'<li class="pl-animation pla-from-bottom carousel-item span2" style="">%s</li>', 
						$image_out
					);
				}

			}
		}
		
		
		return $out;
	}

   function section_template( ) { 
	
		$classes = array(); 
		
		$max = ($this->opt('max')) ? $this->opt('max') : 6;
		$format = $this->opt('format');
		$classes[] = 'format-'.$format;
		
		$array = $this->opt('array');
	
	?>
	
	<div class="pl-quickcarousel <?php echo join( ' ', $classes );?> pl-animation-group row row-closed" data-max="<?php echo $max;?>">
	
		<?php

		$out = $this->get_content( $array ); 

		if( $out == '' ){
			$array = array(
				array( 'image'		=> pl_default_image() ),
				array( 'image'		=> pl_default_image() ),
				array( 'image'		=> pl_default_image() ),
				array( 'image'		=> pl_default_image() ),
				array( 'image'		=> pl_default_image() ),
				array( 'image'		=> pl_default_image() ),
				array( 'image'		=> pl_default_image() ),
			);

			$out = $this->get_content( $array ); 
		} 

		echo $out;

		?>
	</div>

			

<?php }


}