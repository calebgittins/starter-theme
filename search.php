<?php get_header(); ?>

<div class="wrap">

	<?php if(have_posts()) : ?>

		<h1>Search results for <?php echo esc_html(stripslashes_deep(get_search_query())); ?></h1>

		<?php if (function_exists('wp_searchheader')) : ?>
			<div class="wysiwyg">
				<?php wp_searchheader()?>
			</div>
		<?php endif; ?>

		<div class="wysiwyg">
			<ol class="list--search">
			<?php while(have_posts()) : the_post(); ?>
			<?php
				$title     = get_the_title();
				$title     = html_entity_decode($title);
				$keys      = explode(" ",$s);
				$title     = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title);
				$excerpt   = get_the_excerpt();
				$permalink = get_permalink();
				// Flexible content
				if( have_rows('td_page_content') ): while ( have_rows('td_page_content') ) : the_row();
					if(get_sub_field('content')):
						$excerpt .= get_sub_field('content');
					endif;
		    	endwhile; endif;
		    	// Home page
		    	if(get_the_ID() == get_option('page_on_front')) {
		    		// Get the meta description since there's not usually suitable text on page
		    		$excerpt .= get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
		    	}
		    	// Post
		    	if( get_post_type() == 'post') {
		    		if(get_field('td_post_content')) {
			    		$excerpt .= get_field('td_post_content');
			    	}
		    	}
				$excerpt = strip_tags($excerpt);
				$excerpt = substr($excerpt, 0, 220) . '&hellip;';
			?>
			<li>
				<a href="<?php echo $permalink; ?>"><?php echo $title; ?></a><br/>
				<?php echo $excerpt; ?>
			</li>
			<?php endwhile; ?>
			</ol>
		</div>

		<div class="nav--pagination">
			<?php
				global $wp_query;
				$big = 999999999;
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
		</div>

    <?php else:  ?>

	    <p>No results found.</p>

	<?php endif; ?>

</div>

<?php get_footer(); ?>