<?php get_header(); ?>
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
	<div class="article">
		<div class="wrap">
			<div class="article__header">
				<h1 class="article__heading"><?php the_title(); ?></h1>
				<div class="article__meta"><?php the_date(); ?></div>
			</div>
			<div class="article__media">
				<?php if ( get_field('td_post_image') ) : $image = get_field('td_post_image'); ?>
				<div class="article__image has-spinner">
					<div class="default-spinner"></div>
					<img class="b-lazy" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				</div>
				<?php endif; ?>
			</div>
			<div class="article__main">
				<?php if ( get_field('td_page_post') && !post_password_required() ) : ?>
		        	<?php echo get_field('td_post_content'); ?>
		        <?php else: ?>
		        	<div class="wysiwyg">
		        		<?php the_content(); ?>
		        	</div>
		        <?php endif; ?>
			</div>
			<div class="article__footer">
				<?php
					$posts_page = get_option('page_for_posts');
				?>
				<a href="<?php echo get_permalink($posts_page); ?>" class="button">Back to <?php echo get_the_title($posts_page); ?></a>
			</div>
		</div>
	</div>
	<?php endwhile; ?><?php endif; ?>
<?php get_footer(); ?>