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
					'type' 			=> 'text_small',
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
		
		$options['background'] = array(
			'title' => __( 'Header Background', 'pagelines' ),
			'type'	=> 'multi',
			'col'	=> 3,
			'opts'	=> array(
				array(
					'key'			=> 'ph_background',
					'type' 			=> 'image_upload',
					'label' 		=> __( 'Header Background Image', 'pagelines' ),
				),
				array(
					'key'			=> 'ph_video',
					'type' 			=> 'media_select_video',
					'label' 		=> __( 'Header Link 1 (link mode only)', 'pagelines' ),
				),
				array(
					'key'			=> 'ph_color',
					'type' 			=> 'color',
					'label' 		=> __( 'Header Background Color (optional)', 'pagelines' ),
				),
			)
		);
		
		return $options;

	}

	function section_template() {

		$format = '';
		$title = 'Testing';
		$text = 'Testing';
		$style = '';
		$link = '';
		$link_text = 'Test';
		

		?>
		<div class="pl-ph-container pl-contrast <?php echo $format;?>">
			<div class="pl-content fix pl-centerer">
				<div class="ph-text">
					<h2 class="ph-head" data-sync="icallout_text"><?php echo $title; ?></h2>
					<div class="ph-sub"><?php echo $text; ?></div>
				</div>
				<div class="ph-meta pl-centered">
				<a class="icallout-action btn <?php echo $style;?> btn-large" href="<?php echo $link; ?>" data-sync="icallout_link_text"><?php echo $link_text; ?></a>
				</div>
			</div>
		</div>
	<?php

	}
}
