<?php if ( have_rows('td_social_media','options') ) : ?>
<ul class="nav nav--social">
	<?php while( have_rows('td_social_media','options') ) : the_row(); ?>
	<li><a href="<?php the_sub_field('link'); ?>" target="_blank" aria-label="<?php the_sub_field('title'); ?>"><i class="fa <?php the_sub_field('icon'); ?>" aria-hidden="true"></i></a></li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>