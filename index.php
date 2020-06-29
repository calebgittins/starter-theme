<?php get_header(); ?>

	<div class="content">

	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		
		<div <?php post_class(); ?>>					

			<h2 class="post__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
			<div class="post__image">
				
				<?php if(has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post_thumbnail'); ?></a>						
				<?php } ?>
			
			</div><!-- /post__image -->
			
			<div class="post__content">
				
				<span class="post__meta"><?php the_date(); ?></span>

				<div class="post__excerpt">
					<p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
				</div>

				<a href="<?php the_permalink(); ?>" class="button no-mb">Read More</a>

			</div><!-- /post__content -->

        </div><!-- post -->

	<?php endwhile; ?>	

	<div class="nav-pagination">
		<?php next_posts_link('Next Entries &raquo;',''); ?>
	</div><!-- /nav-pagination -->
        		
	<?php endif; ?>

	</div><!-- /content -->    	         

<?php get_footer(); ?>