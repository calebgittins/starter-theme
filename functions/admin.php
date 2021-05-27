<?php
// Custom header icon
	function td_custom_admin_icon() {
	echo '
		<style type="text/css">
			#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
				background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/admin/admin-icon.png) !important;
				background-position: 0 0;
				color: rgba(0, 0, 0, 0);
				background-size: cover;
			}
			#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon { background-position: 0 0; }
		</style>
	';
	}
	add_action('wp_before_admin_bar_render', 'td_custom_admin_icon');
// Favicon
	add_action('admin_head', 'td_admin_favicon');
	function td_admin_favicon() {
		echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri(). '/images/favicon/favicon.png" sizes="32x32" type="image/x-icon" />';
	}
// Custom admin theme
	function td_additional_admin_color_schemes() {
		$theme_name = wp_get_theme()->get('Name');
		$theme_dir  = get_template_directory_uri();
		wp_admin_css_color( $theme_name, __( $theme_name ),
			$theme_dir . '/css/admin/admin-colors.css',
			array( '#131313', '#262626', '#313131', '#FFFFFF' )
		);
	}
	add_action('admin_init', 'td_additional_admin_color_schemes');
// Custom admin theme - for new user
	function td_set_default_admin_color($user_id) {
		$theme_name = wp_get_theme()->get('Name');
		$args = array(
			'ID'          => $user_id,
			'admin_color' => $theme_name
		);
		wp_update_user( $args );
	}
	add_action('user_register', 'td_set_default_admin_color');
// Custom login style
	function td_login_stylesheet() {
		wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/admin/login.css' );
	}
	add_action( 'login_enqueue_scripts', 'td_login_stylesheet' );
// WP custom fonts wysiwyg editor
	function theme_add_editor_styles() {
		add_editor_style( '/css/admin/login.css' );
	}
	add_action( 'init', 'theme_add_editor_styles' );
// Admin - Frontend Toolbar
	function thirteen_admin_bar_overrides() {
		if ( is_admin_bar_showing() ) {
			wp_enqueue_style( 'admin-bar-overrides', get_bloginfo( 'template_url' ) . '/css/admin/admin-colors.css', array( 'admin-bar' ), null, 'all' );
		}
	}
	add_action( 'init', 'thirteen_admin_bar_overrides' );
// Admin - no default link on media library images
	update_option('image_default_link_type','none');
// Admin - footer
	function custom_admin_footer() {
		echo 'By <a href="http://thirteendigital.com.au/" title="Visit thirteendigital.com.au for more information">thirteendigital.com.au</a>';
	}
	add_filter('admin_footer_text', 'custom_admin_footer');
// Admin - hide comments
	add_action( 'admin_menu', 'my_remove_menu_pages' );
	function my_remove_menu_pages() {
		remove_menu_page('edit-comments.php');
	}
// Custom Editor Styles
	// Callback function to insert 'styleselect' into the $buttons array
		function my_mce_buttons_2( $buttons ) {
			array_unshift( $buttons, 'styleselect' );
			return $buttons;
		}
	// Register our callback to the appropriate filter
		add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );
	// Callback function to filter the MCE settings
		function my_mce_before_init_insert_formats( $init_array ) {
			// Define the style_formats array
			$style_formats = array(
				// Each array child is a format with it's own settings
				array(
					'title'    => 'Button',
					'classes'  => 'button',
					'selector' => 'a'
				),
				array(
					'title'   => 'Small Text',
					'block'   => 'div',
					'classes' => 'small',
					'wrapper' => true,
				),
			);
			// Insert the array, JSON ENCODED, into 'style_formats'
			$init_array['style_formats'] = json_encode( $style_formats );
			return $init_array;
		}
	// Attach callback to 'tiny_mce_before_init'
		add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
// Media Library - Set max size of uploaded images
	function td_max_image_upload_size($imagesize, $file, $attachment_id){
		return 2600;
	}
	add_filter( 'big_image_size_threshold', 'td_max_image_upload_size',10,3 );
?>