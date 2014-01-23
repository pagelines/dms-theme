<?php
/*
	Section: PageHeader
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A dynamic page header area that supports image background and sub navigation.
	Class Name: PLPageHeader
	Filter: full-width, component
	Loading: active
*/

class PLPageHeader extends PageLinesSection {

	
	function section_opts(){
		$options = array();
		
	//	$options['config']	= array();
		$options['config'] = array(
			'title' => __( 'Header Config', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				
				array(
					'key'			=> 'ph_format',
					'label' 		=> __( 'Format', 'pagelines' ),
					'type'			=> 'select',
					'opts'	=> array(
						'left-side'	=> array('name'=> 'Text On Left'),
						'centered'		=> array('name'=> 'Centered'),
					)
				),
				array(
					'key'			=> 'ph_mode',
					'label' 		=> __( 'Mode', 'pagelines' ),
					'type'			=> 'select',
					'opts'	=> array(
						'nav'	=> array('name'=> 'Use Nav Menu'),
						'links'	=> array('name'=> 'Use Link Buttons'),
					)
				),
				array(
					'key'			=> 'ph_padding',
					'type' 			=> 'select_padding',
					'label' 		=> __( 'Header Top/Bottom Padding in px', 'pagelines' ),
				),
			)
		);
		$options['content'] = array(
			'title' => __( 'Header Text', 'pagelines' ),
			'type'	=> 'multi',
			'col'	=> 2,
			'opts'	=> array(
				array(
					'key'			=> 'ph_header',
					'type' 			=> 'text',
					'label' 		=> __( 'Header Text', 'pagelines' ),
				),
				array(
					'key'			=> 'ph_sub',
					'type' 			=> 'text',
					'label' 		=> __( 'Header Sub Text', 'pagelines' ),
				),
			)
		);
		
		$options['meta'] = array(
				'title' => __( 'Header Meta', 'pagelines' ),
				'type'	=> 'multi',
				'col'	=> 2,
				'opts'	=> array(
					array(
						'key'			=> 'ph_header',
						'type' 			=> 'select_menu',
						'label' 		=> __( 'Header Menu (menu mode only)', 'pagelines' ),
					),
					array(
						'key'			=> 'ph_link1',
						'type' 			=> 'button_link',
						'label' 		=> __( 'Header Link 1 (link mode only)', 'pagelines' ),
					),
					array(
						'key'			=> 'ph_link2',
						'type' 			=> 'button_link',
						'label' 		=> __( 'Header Link 2 (link mode only)', 'pagelines' ),
					),
				)			
		); 
		
		$options[] = pl_get_background_options('ph', 3);
		
		
		return $options;

	}

	function section_template() {
		
		global $post;
		$format = '';
		$title = ( $this->opt('ph_header') ) ? $this->opt('ph_header') : get_the_title( $post->ID );
		$text = ( $this->opt('ph_sub') ) ? $this->opt('ph_sub') : '';
	
		$link = ( $this->opt('ph_link1') ) ? $this->opt('ph_link1') : false;
		$style = ( $this->opt('ph_link1_style') ) ? $this->opt('ph_link1_style') : 'btn-primary';
		$link_text = ( $this->opt('ph_link1_text') ) ? $this->opt('ph_link1_text') : false;
		
		$link2 = ( $this->opt('ph_link2') ) ? $this->opt('ph_link2') : false;
		$style2 = ( $this->opt('ph_link2_style') ) ? $this->opt('ph_link2_style') : '';
		$link_text2 = ( $this->opt('ph_link2_text') ) ? $this->opt('ph_link2_text') : false;
		
		$button1 = ($link) ? sprintf('<a href="%s" class="btn btn-large %s">%s</a>', $link, $style, $link_text) : '';
		$button2 = ($link2) ? sprintf('<a href="%s" class="btn btn-large %s">%s</a>', $link2, $style2, $link_text2) : '';

		$style =  ( $this->opt('ph_background') ) ? sprintf('background-image: url(%s);', $this->opt('ph_background')) : '';
		
		$padding = ( $this->opt('ph_padding') ) ? sprintf( 'padding: %spx 0;', $this->opt('ph_padding')) : '';
		
		?>
		<div class="pl-ph-container <?php echo $format;?>" style="<?php echo $style; ?>">
			<div class="pl-content fix pl-centerer" style="">
				<div class="ph-text">
					<h2 class="ph-head" data-sync="icallout_text"><?php echo $title; ?></h2>
					<div class="ph-sub"><?php echo $text; ?></div>
				</div>
				<div class="ph-meta pl-centered">
					<?php echo $button1 .' '. $button2;?>
				</div>
			</div>
		</div>
	<?php

	}
}
