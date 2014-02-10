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
				'title'	=> __( 'Logo', 'pagelines' ),
				'col'	=> 1,
				'opts'	=> array(
					array(
						'type'	=> 'image_upload',
						'key'	=> 'navi_logo',
						'label'	=> __( 'Navboard Logo', 'pagelines' ),
						'has_alt'	=> true,
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
						'key'	=> 'navi_help',
						'type'	=> 'help_important',
						'label'	=> __( 'Using Megamenus (multi column drop down)', 'pagelines' ),
						'help'	=> __( 'Want a full width, multi column "mega menu"? Simply add a class of "megamenu" to the list items using the WP menu creation tool.', 'pagelines' )
					),
					array(
						'key'	=> 'navi_menu',
						'type'	=> 'select_menu',
						'label'	=> __( 'Select Menu', 'pagelines' ),
					),
					array(
						'key'	=> 'navi_search',
						'type'	=> 'check',
						'label'	=> __( 'Hide Search?', 'pagelines' ),
					),
					array(
						'key'	=> 'navi_offset',
						'type'	=> 'text_small',
						'place'	=> '100%',
						'label'	=> __( 'Dropdown offset from top of nav (optional)', 'pagelines' ),
						'help'	=> __( 'Default is 100% aligned to bottom. Can be PX or %.', 'pagelines' )
					), 
					
				)

			)


		);

		return $opts;

	}

	/**
	* Section template.
	*/
   function section_template( $location = false ) {

		$menu = ( $this->opt('navi_menu') ) ? $this->opt('navi_menu') : false;
		$offset = ( $this->opt('navi_offset') ) ? sprintf( 'data-offset="%s"', $this->opt('navi_offset') ) : false;
		$hide_search = ( $this->opt('navi_search') ) ? true : false;
		$class = ( $this->meta['draw'] == 'area' ) ? 'pl-content' : '';

	?>
	<div class="navi-wrap <?php echo $class; ?> fix">
		<div class="navi-left navi-container">
			<a href="<?php echo home_url('/');?>"><?php echo $this->image( 'navi_logo', pl_get_theme_logo() ); ?></a>
		</div>
		<div class="navi-right">
			<?php

				$menu_args = array(
					'theme_location' => 'navi_nav',
					'menu' => $menu,
					'menu_class'	=> 'inline-list pl-nav sf-menu',
					'attr'			=> $offset,
					'walker' => new PageLines_Walker_Nav_Menu
				);
				echo pl_navigation( $menu_args );

				if( ! $hide_search )
					pagelines_search_form( true, 'navi-searchform');
			?>

		</div>
		<div class="navi-left navi-search">

		</div>



	</div>
<?php }

}

// Adds arrows and classes
class PageLines_Walker_Nav_Menu extends Walker_Nav_Menu {

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {

  		$id_field = $this->db_fields['id'];

        if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent == 0) {
            $element->title =  $element->title . '<span class="sub-indicator"><i class="icon icon-angle-down"></i></span>';
			$element->classes[] = 'sf-with-ul';

        }

		if (!empty($children_elements[$element->$id_field]) && $element->menu_item_parent != 0) {
            $element->title =  $element->title . '<span class="sub-indicator"><i class="icon icon-angle-right"></i></span>';
        }

        Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
