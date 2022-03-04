</main>

<div class="footer">		
	<div class="wrap">		
		<div class="footer__copyright">
			&copy; Copyright <?php echo date('Y');?> <?php echo (get_field('td_business_name','options')) ? get_field('td_business_name','options') : get_bloginfo('name'); ?>. All Rights Reserved.
		</div>		
		<a class="footer__credit" href="https://thirteendigital.com.au/" target="_blank">Site by Thirteen Digital</a>
	</div>
</div>

<?php get_template_part('inc/offscreen'); ?>

<?php wp_footer(); ?>

</body>

</html>