<div class="share">
	<ul class="list--share">	
		<li><h6 class="share__heading">Share</h6></li>
		<li><a class="sharer" data-sharer="facebook" data-url="<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a></li>
		<li><a class="sharer" data-sharer="twitter" data-title="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a></li>
		<li><a class="sharer" data-sharer="google-plus" data-url="<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
		<li><a class="sharer" data-sharer="pinterest" data-url="<?php the_permalink(); ?>" data-description="<?php the_title(); ?>" data-image="<?php $image = get_field('td_post_hero_image'); echo $image['url']; ?>"><i class="fa fa-pinterest-p"></i></a></li>
		<li><a class="sharer" data-sharer="email" data-url="<?php the_permalink(); ?>" data-subject="<?php the_title(); ?>"><i class="fa fa-envelope"></i></a></li>
	</ul>
</div>