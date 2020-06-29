<?php
	$hero_type = get_field('td_page_hero');
	$page_id   = get_the_ID();
	if(is_blog_page()) { // If is blog / category / single
		$page_id = get_option('page_for_posts');
	} elseif( $hero_type == 'parent') { // Else if using parent
		global $post;
		$parents = get_post_ancestors( $post->ID );
		$id      = ($parents) ? $parents[count($parents)-1]: $post->ID;
		$page_id = $id;
	}
?>

<?php if($hero_type == 'slider'): // Slider ?>

	<?php if ( have_rows('td_page_hero_slider') ) : ?>
	<div class="hero hero--slider">
		<div class="js-slick-single">
		<?php while( have_rows('td_page_hero_slider') ) : the_row(); ?>
			<div class="js-slick-item">
				<div class="hero__item">
					<div class="wrap wrap--fixed">
						<div class="hero__item__content">
							<?php if ( get_sub_field('title') ) : ?>
								<h2 class="heading--alpha hero__item__heading"><?php echo get_sub_field('title'); ?></h2>
							<?php endif; ?>
							<?php if ( get_sub_field('content') ) : ?>
								<div class="hero__item__text">
									<?php echo get_sub_field('content'); ?>
								</div>
							<?php endif; ?>
							<div class="hero__item__footer">
								<?php echo td_display_button('button',$id,'button button--light',true); ?>
							</div>
						</div>
					</div>
					<?php if ( get_sub_field('image') ) : $image = get_sub_field('image'); ?>
						<div class="spinner"></div>
		                <div class="hero__item__image b-lazy" data-src="<?php echo $image['url']; ?>"></div>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>

<?php else: // Single image ?>

	<?php if ( have_rows('td_page_hero_image', $page_id) ) : ?>
		<?php while( have_rows('td_page_hero_image', $page_id) ) : the_row(); ?>
			<?php
				$hero_image = get_field('td_page_hero_image', $page_id);
				$background = $hero_image['image']['url'];
				$title      = $hero_image['title'];
			?>
		<?php endwhile; ?>
	<?php else: ?>
		<?php
			$hero_image = get_field('td_default_hero_image', 'options');
			$background = $hero_image['url'];
		?>
	<?php endif; ?>

	<div class="hero hero--image">
		<div class="wrap wrap--fixed">
			<div class="hero__item__content">
				<h2 class="heading--alpha hero__item__heading">
					<?php if($title): ?>
						<?php echo $title; ?>
					<?php else: ?>
						<?php get_template_part('inc/heading'); ?>
					<?php endif; ?>
				</h2>
			</div>
		</div>
		<div class="spinner"></div>
		<div class="hero__item__image b-lazy" data-src="<?php echo $background; ?>"></div>
	</div>

<?php endif; ?>