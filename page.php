<?php get_header(); ?>
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php if ( get_field('td_page_content') && !post_password_required() ) : ?>
        	<?php get_template_part('inc/flexible'); ?>
        <?php else: ?>
        	<div class="wrap">
        		<?php the_content(); ?>
        	</div>
        <?php endif; ?>
	<?php endwhile; ?><?php endif; ?>
<?php get_footer(); ?>