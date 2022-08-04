<div class="wrap">
	<div class="contact">
		<div class="contact__content">
			<?php if ( get_sub_field('title') ) : ?>
				<h2 class="contact__heading"><?php echo get_sub_field('title'); ?></h2>
			<?php endif; ?>
			<ul class="list list--text">
				<?php if ( get_field('td_address','options') ) : ?>
					<li><?php echo get_field('td_address','options'); ?></li>
				<?php endif; ?>
				<?php if ( get_field('td_phone_number','options') ) : $phone = get_field('td_phone_number','options'); ?>
					<li><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></li>
				<?php endif; ?>
				<?php if ( get_field('td_email_address','options') ) : $email = get_field('td_email_address','options'); ?>
					<li><a href="mailto:<?php echo antispambot($email); ?>" class="link--text"><?php echo antispambot($email); ?></a></li>
				<?php endif; ?>	
			</ul>				
			<?php get_template_part('inc/social'); ?>
		</div>
		<div class="contact__form">
			<?php 
			    $form_object = get_sub_field('form');
				echo do_shortcode('[gravityform id="' . $form_object['id'] . '" title="false" description="false" ajax="true" tabindex="tabindex"]');
			?>
		</div>
	</div>
</div>