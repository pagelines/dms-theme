<?php
/*
	Section: Navi
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A stylized navigation bar with multiple modes and styles. 
	Class Name: PLNavi
	Filter: nav, dual-width
*/


class PLNavi extends PageLinesSection {

	function section_styles(){


		wp_enqueue_script( 'superfish', $this->base_url.'/superfish.js', array( 'jquery' ), pl_get_cache_key(), true );
		wp_enqueue_script( 'pl-navi', $this->base_url.'/pl.navi.js', array( 'superfish' ), pl_get_cache_key(), true );
	
	}

	function section_persistent(){
		register_nav_menus( array( 'navi_nav' => __( 'Navi Section', 'pagelines' ) ) );

	}

	function section_opts(){

		$opts = array(
			// array(
			// 				'type'	=> 'multi',
			// 				'key'	=> 'navi_format', 
			// 				'title'	=> 'Navboard Format and Formatting',
			// 				'opts'	=> array(
			// 					array(
			// 						'type'	=> 'select',
			// 						'key'	=> 'navi_format', 
			// 						'label'	=> 'Select Format',
			// 						'opts'	=> array(
			// 							'center_logo'	=> array( 'name' => 'Logo Center, Pop out menu' ),
			// 							'left_logo'		=> array( 'name' => 'Logo Left, standard menu' ),
			// 						), 
			// 
			// 					)
			// 				)
			// 				
			// 			),
			array(
				'type'	=> 'multi',
				'key'	=> 'navi_content', 
				'title'	=> 'Logo',
				'col'	=> 1,
				'opts'	=> array(
					array(
						'type'	=> 'image_upload',
						'key'	=> 'navi_logo', 
						'label'	=> 'Navboard Logo',
						'opts'	=> array(
							'center_logo'	=> 'Center: Logo | Right: Pop Menu | Left: Site Search',
							'left_logo'		=> 'Left: Logo | Right: Standard Menu',
						), 
					),
				)
				
			),
			array(
				'type'	=> 'multi',
				'key'	=> 'navi_nav', 
				'title'	=> 'Navigation',
				'col'	=> 2,
				'opts'	=> array(
					array(
						'key'	=> 'navi_menu', 
						'type'	=> 'select_menu',
						'label'	=> 'Select Menu',
					),
					array(
						'key'	=> 'navi_search', 
						'type'	=> 'check',
						'label'	=> 'Hide Search?',
					)
				)
				
			)
			

		);

		return $opts;

	}

	/**
	* Section template.
	*/
   function section_template( $location = false ) {


		$logo = ( $this->opt('navi_logo') ) ? $this->opt('navi_logo') : pl_get_theme_logo(); 
		$menu = ( $this->opt('navi_menu') ) ? $this->opt('navi_menu') : false;
		$hide_search = ( $this->opt('navi_search') ) ? true : false; 
		$class = ( $this->meta['draw'] == 'area' ) ? 'pl-content' : ''; 

	?>
	<div class="navi-wrap <?php echo $class; ?> fix">
		<div class="navi-left navi-container">
			<a href="<?php echo home_url();?>"><img src="<?php echo $logo; ?>" /></a>
		</div>
		<div class="navi-right">
			<?php 
				echo pl_navigation( array( 'theme_location' => 'navi_nav', 'menu' => $menu, 'menu_class'	=> 'inline-list pl-nav sf-menu') ); 
				if( ! $hide_search )
					pagelines_search_form( true, 'navi-searchform'); 
			?>
			
		</div>
		<div class="navi-left navi-search">
			
		</div>
		
		
		
	</div>
<?php }

}
