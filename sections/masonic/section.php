<?php
/*
	Section: Masonic Gallery
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: A robust gallery section that includes sorting and lightboxing.
	Class Name: PLMasonic
	Filter: format, dual-width
*/

class PLMasonic extends PageLinesSection {


	var $default_limit = 3;

	function section_persistent(){

	}

	function section_styles(){
		wp_enqueue_script( 'isotope', PL_JS . '/utils.isotope.min.js', array('jquery'), pl_get_cache_key(), true);
	//	wp_enqueue_script( 'isotope', PL_JS . '/utils.isotope2.js', array('jquery'), pl_get_cache_key(), true);
		wp_enqueue_script( 'pl-masonic', $this->base_url.'/pl.masonic.js', array( 'jquery' ), pl_get_cache_key(), true );
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
		
		if($this->opt($this->id.'_post_type') == 'post'){
			$selection_opts[] = array(
				'label'			=> 'Post Category',
				'key'			=> $this->id.'_category', 
				'type'			=> 'select_taxonomy', 
				'post_type'		=> 'post', 
				'help'		=> __( 'Only applies for standard blog posts.', 'pagelines' ),
			); 
		}
		
		
		

		$options[] = array(

			'title' => __( 'Additional Post Selection', 'pagelines' ),
			'type'	=> 'multi',
			
			'opts'	=> $selection_opts
		);



		return $options;
	}
	
	function section_template(  ) {

		global $post;
		
		$format = ( $this->opt( $this->id.'_format' ) ) ? $this->opt( $this->id.'_format' ) : 'image';
		
		$gutter_class = ( $format == 'grid' ) ? 'with-gutter' : '';
		
		$post_type = ($this->opt($this->id.'_post_type')) ? $this->opt($this->id.'_post_type') : 'post';

		$pt = get_post_type_object($post_type);

		$total = ($this->opt($this->id.'_total')) ? $this->opt($this->id.'_total') : '10';

		

		$meta = ($this->opt($this->id.'_meta')) ? $this->opt($this->id.'_meta') : '[post_date] [post_edit]';

		$sizes = ($this->opt($this->id.'_sizes')) ? $this->opt($this->id.'_sizes') : 'aspect-thumb';
	

		$sorting = ($this->opt($this->id.'_post_sort')) ? $this->opt($this->id.'_post_sort') : 'DESC';

		$orderby = ( 'rand' == $this->opt($this->id.'_post_sort') ) ? 'rand' : 'date'; 

		$the_query = array(
			'posts_per_page' 	=> $total,
			'post_type' 		=> $post_type,
			'orderby'          => $orderby,
			'order'            => $sorting,
		);

		if( $this->opt($this->id.'_meta_key') && $this->opt($this->id.'_meta_key') != '' && $this->opt($this->id.'_meta_value') ){
			$the_query['meta_key'] = $this->opt($this->id.'_meta_key');
			$the_query['meta_value'] = $this->opt($this->id.'_meta_value');
		}
		
		if( $this->opt($this->id.'_category') && $this->opt($this->id.'_category') != '' ){
			$cat = get_category_by_slug( $this->opt($this->id.'_category') ); 
			$the_query['category'] = $cat->term_id;
		}

		$posts = get_posts( $the_query );
		

		if(!empty($posts)) { setup_postdata( $post ); ?>

			

			<div class="masonic-wrap">

				<ul class="masonic-gallery row row-closed <?php echo $gutter_class;?> no-transition"  data-format="<?php echo $format;?>">
		<?php } ?>

			<?php

			if(!empty($posts)):
				$item_cols = 3;
				$count = 1;
				$total = count($posts);
				 foreach( $posts as $post ): 
					
					setup_postdata( $post ); 
					
				//	echo pl_grid_tool('row_start', $item_cols, $count, $total);
					
						?>


			<li class="span3">
				<div class="span-wrap pl-grid-wrap">
					<div class="pl-grid-image fix">
						<?php
						if ( has_post_thumbnail() )
							echo get_the_post_thumbnail( $post->ID, $sizes	, array('title' => ''));
						else
							printf('<img src="%s" alt="no image added yet." />', pl_default_image());
					
						
							 ?>

						<div class="pl-grid-image-hover"></div>
					
						<a class="pl-grid-image-info" href="<?php echo get_permalink();?>">

							<div class="pl-center-table"><div class="pl-center-cell">
								
								<?php if( $format == 'masonry' ): ?>
									<h4>
										<?php the_title(); ?>
									</h4>
									<div class="metabar">
										<?php  echo do_shortcode( '[post_date]' ); ?>
									</div>
								<?php else: ?>
									<div class="info-text"><i class="icon-link"></i></div>
								<?php endif;?>
							</div></div>

						</a>
					</div><!--work-item-->

					<?php if( $format == 'grid' ) : ?>
						<div class="pl-grid-content fix">
							<div class="pl-grid-meta">
								<?php if( ! $disable_show_love ) echo pl_love( $post->ID );?>
							</div>
							<div class="pl-grid-text">
								<h4>
									<a href="<?php echo get_permalink();?>">
									<?php the_title(); ?>
									</a>
								</h4>
								<div class="pl-grid-metabar">
									<?php echo do_shortcode( $meta ); ?>
								</div>
						
								<?php if( $show_excerpt ): ?>
								<div class="pl-grid-excerpt pl-border">
									<?php the_excerpt();?>
								</div>
								<?php endif;?>
							</div>
						</div>
					<?php endif;?>

					<div class="clear"></div>
				</div>

			</li>

<?php 

			//echo pl_grid_tool('row_end', $item_cols, $count, $total);
	
			$count++;
			endforeach; endif;


			if(!empty($posts))
		 		echo '</ul></div>';

		//	wp_reset_query();

	}




}