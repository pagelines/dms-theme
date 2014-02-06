<?php
/*
	Section: iDocs
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: The easiest way to add docs to WordPress. Use iDocs and a custom post type.
	Class Name: PLIDocs
	Filter: format, dual-width
*/

class PLIDocs extends PageLinesSection {


	var $default_limit = 3;

	function section_persistent(){

	}

	function section_styles(){
		
	}

	function section_opts(){

		
		$options = array();

		$options[] = array(

			'title' => __( 'Config', 'pagelines' ),
			'type'	=> 'multi',
			'opts'	=> array(
				array(
					'key'		=> $this->id.'_format',
					'type'		=> 'select',
					'label'		=> __( 'Gallery Format', 'pagelines' ),
					'opts'			=> array(
						'grid'		=> array('name' => __( 'Grid Mode', 'pagelines' ) ),
						'masonry'	=> array('name' => __( 'Image/Masonry', 'pagelines' ) )
					)
				),
				array(
					'key'			=> $this->id.'_post_type',
					'type' 			=> 'select',
					'opts'			=> pl_get_thumb_post_types(),
					'default'		=> 4,
					'label' 	=> __( 'Select Post Type', 'pagelines' ),
					'help'		=> __( '<strong>Note</strong><br/> Post types for this section must have "featured images" enabled and be public.<br/><strong>Tip</strong><br/> Use a plugin to create custom post types for use.', 'pagelines' ),
				),
				array(
					'key'			=> $this->id.'_sizes',
					'type' 			=> 'select_imagesizes',
					'default'		=> 'large',
					'label' 		=> __( 'Select Thumb Size', 'pagelines' )
				),
				
				array(
					'key'			=> $this->id.'_total',
					'type' 			=> 'count_select',
					'count_start'	=> 5,
					'count_number'	=> 20,
					'default'		=> 10,
					'label' 		=> __( 'Total Posts Loaded', 'pagelines' ),
				)
				

			)

		);

		$options[] = array(

			'title' => __( 'Masonic Content', 'pagelines' ),
			'type'	=> 'multi',
			'help'		=> __( 'Options to control the text and link in the Masonic title.', 'pagelines' ),
			'opts'	=> array(
				array(
					'key'			=> $this->id.'_meta',
					'type' 			=> 'text',
					'label' 		=> __( 'Masonic Meta', 'pagelines' ),
					'ref'			=> __( 'Use shortcodes to control the dynamic meta info. Example shortcodes you can use are: <ul><li><strong>[post_categories]</strong> - List of categories</li><li><strong>[post_edit]</strong> - Link for admins to edit the post</li><li><strong>[post_tags]</strong> - List of post tags</li><li><strong>[post_comments]</strong> - Link to post comments</li><li><strong>[post_author_posts_link]</strong> - Author and link to archive</li><li><strong>[post_author_link]</strong> - Link to author URL</li><li><strong>[post_author]</strong> - Post author with no link</li><li><strong>[post_time]</strong> - Time of post</li><li><strong>[post_date]</strong> - Date of post</li><li><strong>[post_type]</strong> - Type of post</li></ul>', 'pagelines' ),
				),
				


			)

		);

	
		$options[] = array(
			'key'		=> $this->id.'_post_sort',
			'type'		=> 'select',
			'label'		=> __( 'Sort elements by postdate', 'pagelines' ),
			'default'	=> 'DESC',
			'opts'			=> array(
				'DESC'		=> array('name' => __( 'Date Descending (default)', 'pagelines' ) ),
				'ASC'		=> array('name' => __( 'Date Ascending', 'pagelines' ) ),
				'rand'		=> array('name'	=> __( 'Random', 'pagelines' ) )
			)
		);	
		
		$selection_opts = array(
			array(
				'key'			=> $this->id.'_meta_key',
				'type' 			=> 'text',

				'label' 	=> __( 'Meta Key', 'pagelines' ),
				'help'		=> __( 'Select only posts which have a certain meta key and corresponding meta value. Useful for featured posts, or similar.', 'pagelines' ),
			),
			array(
				'key'			=> $this->id.'_meta_value',
				'type' 			=> 'text',

				'label' 	=> __( 'Meta Key Value', 'pagelines' ),
			),
		);
		
			$selection_opts[] = array(
				'label'			=> 'Post Category',
				'key'			=> $this->id.'_category', 
				'type'			=> 'select_wp_tax', 
				'post_type'		=> $this->opt($this->id.'_post_type'), 
				'help'		=> __( 'Only applies for standard blog posts.', 'pagelines' ),
			);
		
		

		$options[] = array(

			'title' => __( 'Additional Post Selection', 'pagelines' ),
			'type'	=> 'multi',
			
			'opts'	=> $selection_opts
		);



		return $options;
	}
	

	
	function section_template(  ) {


	}




}

