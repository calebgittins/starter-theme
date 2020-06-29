<?php get_header(); ?>

<div class="wrap">
	
	<?php get_template_part('inc/heading'); ?>
	
	<?php if(have_posts()) : ?>
			
		<?php if (function_exists('wp_searchheader')) : ?>
			<div class="wysiwyg">
				<?php wp_searchheader()?>
			</div>
		<?php endif; ?>

		<!-- RESULTS -->

			<div class="wysiwyg">
				<ol class="search__results" start="<?php echo ($posts_per_page*($paged-1)+1) ?>">
				<?php while(have_posts()) : the_post(); ?>
				<?php
					$title     = get_the_title();
					$keys      = explode(" ",$s);
					$title     = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title);
					$excerpt   = get_the_excerpt();
					$permalink = get_permalink();
					// Flexible content
					if( have_rows('td_flexible_content') ): while ( have_rows('td_flexible_content') ) : the_row(); 
						if(get_sub_field('content')):
							$excerpt .= get_sub_field('content');
						elseif(get_sub_field('blockquote')):
							$excerpt .= get_sub_field('blockquote');
						endif;
			    	endwhile; endif; 
			    	// Course
			    	if( get_post_type() == 'td_course') {
			    		if(get_field('td_course_outline')) {
				    		$excerpt .= get_field('td_course_outline');
				    	}
			    	}
			    	// Course Calendar
			    	if( get_post_type() == 'td_course_calendar') {
			    		$permalink = get_permalink(210);
			    	}
					$excerpt = strip_tags($excerpt);
					$excerpt = substr($excerpt, 0, 205) . '...';
					//$excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $excerpt);
					//$excerpt = str_replace(' [...]', '...', $excerpt);
				?>
				<li>
					<a href="<?php echo $permalink; ?>"><?php echo $title; ?></a><br/>
					<?php echo $excerpt; ?>
				</li>
				<?php endwhile; ?>
				</ol>
			</div>	

		<!-- NAVIGATION -->

			<div class="nav--pagination">
				
				<?php
				global $wp_query;

				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'type'      => 'list',
					'prev_text' => 'Previous',
					'next_text' => 'Next',
					'format'    => '?paged=%#%',
					'current'   => max( 1, get_query_var('paged') ),
					'total'     => $wp_query->max_num_pages
				) );
				?>

			</div><!-- /nav-pagination -->
		    
	    <?php else:  ?>
		    
		    <p>No results found.</p>

		<?php endif; ?>

</div>

<?php get_footer(); ?>