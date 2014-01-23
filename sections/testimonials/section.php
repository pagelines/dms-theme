<?php
/*
	Section: Testimonials
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: List testimonials with quotes, links and gravatar images.
	Class Name: PLTestimonials
	Filter: component
	Loading: active
*/

class PLTestimonials extends PageLinesSection {

	function section_styles(){
		wp_enqueue_script( 'quovolver', $this->base_url . '/jquery.quovolver.js', array( 'jquery' ), PL_CORE_VERSION, true );
		wp_enqueue_script( 'pagelines-quovolver', $this->base_url . '/pl.quovolver.js', array( 'quovolver' ), PL_CORE_VERSION, true );
	}
	
	function section_opts(){
		
		$options = array();
		
		$options[] = array(
			'key'		=> 'pl_testimonial_array',
	    	'type'		=> 'accordion', 
			'col'		=> 2,
			'title'		=> __('Testimonials Setup', 'pagelines'), 
			'post_type'	=> __('Testimonial', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'	=> 'text',
					'label'	=> __( 'Slide Text', 'pagelines' ),
					'type'			=> 'text'
				),
				array(
					'key'	=> 'cite',
					'label'	=> __( 'Citation', 'pagelines' ),
					'type'	=> 'text'
				),
				

			)
	    );

		return $options;

	}

	function section_template() {

		$item_array = $this->opt('pl_testimonial_array');
		
		if( ! is_array($item_array) ){

			$item_array = array(
				array(
					'text'	=> 'Test1',
					'cite'	=> 'Andrew Powers'
				),
				array(
					'text'	=> 'Test2',
					'cite'	=> 'Andrew Powers'
				),
				array(
					'text'	=> 'Test3',
					'cite'	=> 'Andrew Powers'
				),
			);


		} 

		?>
		<div class="pl-testimonials-container">
		  <ul class="pl-testimonials">
			
			<?php foreach( $item_array as $item ): 
				
					$text = pl_array_get( 'text', $item ); 
					$cite = pl_array_get( 'cite', $item );
					
					if( $text == '')
						continue;
				?>
		  <li>
		    <blockquote>
		    	<p><?php echo $text; ?></p>
		    	<cite><?php echo $cite; ?></cite>
		    </blockquote>
		  </li>
			<?php endforeach; ?>
		  
		  </ul>
		</div><!-- .quotes -->
	<?php
	}
}
