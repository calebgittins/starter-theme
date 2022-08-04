<?php get_header(); ?>
<div class="wrap">
	<?php 
		$page_for_posts = get_option('page_for_posts');
		if(is_home()) {
			$title = get_the_title($page_for_posts);
		} else {
			$title = single_cat_title('', false);
		}
	?>
	<h1><?php echo $title; ?></h1>
	<?php if(have_posts()) : ?>
		<div class="grid">
			<?php while(have_posts()) : the_post(); ?>
				<div class="grid__item grid__item--third">
					<div <?php post_class(); ?>>			
						<h2 class="post__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post__image">
							<?php if(has_post_thumbnail()) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post_thumbnail'); ?></a>						
							<?php } ?>
						</div>
						<div class="post__content">
							<div class="post__meta"><?php the_date(); ?></div>
							<a href="<?php the_permalink(); ?>" class="button">Read More</a>
						</div>
			        </div>
				</div>
			<?php endwhile; ?>	
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
	<?php endif; ?>
</div>
<?php get_footer(); ?>