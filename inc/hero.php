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

<div class="hero hero--<?php echo $hero_type; ?>">
	<div class="wrap"></div>
</div>