<?php get_header(); ?>
<div class="not-found">
	<div class="wrap">
		<?php if ( get_field('td_404_title','options') ) : ?>
			<h1 class="h0 not-found__heading"><?php the_field('td_404_title','options'); ?></h1>
		<?php endif; ?>
		<?php if ( get_field('td_404_subtitle','options') ) : ?>
			<h2 class="not-found__subheading"><?php the_field('td_404_subtitle','options'); ?></h2>
		<?php endif; ?>
		<?php if ( get_field('td_404_content','options') ) : ?>
			<div class="wysiwyg">
				<?php the_field('td_404_content','options'); ?>
			</div>
		<?php endif; ?>
		<?php 
		$link = get_field('td_404_button','options');
		if( $link ): 
		    $link_url = $link['url'];
		    $link_title = $link['title'];
		    $link_target = $link['target'] ? $link['target'] : '_self';
		?>
		    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>