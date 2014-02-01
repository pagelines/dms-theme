<?php
/*
	Section: Counter
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Add numeric and animated counters to your pages.
	Class Name: PLCounter
	Filter: component
	Loading: active
*/

class PLCounter extends PageLinesSection {

	function section_styles(){
		wp_enqueue_script( 'appear', PL_JS.'/utils.appear.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'countto', $this->base_url.'/countto.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'pl-counter', $this->base_url.'/pl.counter.js', array( 'jquery' ), pl_get_cache_key(), true );
	}
	
	
	
	function section_opts(){
		$options = array();
	
		return $options;

	}


	function section_template() {
		
		global $post;
		
		
		?>
		<div class="pl-counter" >
			<div class='number'>123</div>
		</div>
	<?php

	}
}
