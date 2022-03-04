<?php get_header(); ?>
<div class="wrap">
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
							<div class="post__excerpt">
								<p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
							</div>
							<a href="<?php the_permalink(); ?>" class="button">Read More</a>
						</div>
			        </div>
				</div>
			<?php endwhile; ?>	
		</div>
		<div class="nav-pagination">
			<?php next_posts_link('Next Entries &raquo;',''); ?>
		</div><!-- /nav-pagination -->	
	<?php endif; ?>
</div>
<?php get_footer(); ?>