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
		wp_enqueue_script( 'quovolver', $this->base_url . '/jquery.quovolver.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'pagelines-quovolver', $this->base_url . '/pl.quovolver.js', array( 'quovolver' ), pl_get_cache_key(), true );
	}
	
	function section_opts(){
		
		$options = array();
		
		$options[] = array(
			'key'		=> 'pl_testimonial_array',
	    	'type'		=> 'accordion', 
			'title'		=> __('Testimonials Setup', 'pagelines'), 
			'post_type'	=> __('Testimonial', 'pagelines'), 
			'opts'	=> array(
				array(
					'key'	=> 'text',
					'label'	=> __( 'Text', 'pagelines' ),
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
					'text'	=> 'The difference between stupidity and genius is that genius has its limits.',
					'cite'	=> 'Albert Einstein, <a href="http://www.pagelines.com">PageLines</a>'
				),
				array(
					'text'	=> 'Be a yardstick of quality. Some people are not used to an environment where excellence is expected.',
					'cite'	=> 'Steve Jobs, <a href="http://www.pagelines.com">PageLines</a>'
				),
				array(
					'text'	=> 'Any product that needs a manual to work is broken.',
					'cite'	=> 'Elon Musk, <a href="http://www.pagelines.com">PageLines</a>'
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
