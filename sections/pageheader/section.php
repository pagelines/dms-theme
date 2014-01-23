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
		<div class="pl-ph-container <?php echo $format;?>">
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
