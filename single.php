<?php get_header(); ?>

<div class="wrap">

	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

	<div <?php post_class(); ?>>

		<?php get_template_part('inc/heading'); ?>

		<div class="post__image">
			<?php if(has_post_thumbnail()) { ?>
				<?php the_post_thumbnail('post-thumbnail'); ?>
			<?php } ?>
		</div>

		<div class="post__content">
			<div class="meta"><?php the_date(); ?></div>
			<div class="wysiwyg">
				<?php the_content(); ?>
			</div>
		</div><!-- /post-content -->

		<div class="post__share">
			<?php get_template_part('inc/share'); ?>
		</div>

		<?php
			$posts_page_id    = get_option('page_for_posts');
			$posts_page_title = get_the_title($posts_page_id);
			$posts_page_url   = get_permalink($posts_page_id);
		?>

		<a href="<?php echo $posts_page_url; ?>" class="button">Back to <?php echo $posts_page_title; ?></a>

	</div><!-- /post -->

	<?php endwhile; ?><?php endif; ?>

</div>

<?php get_footer(); ?>