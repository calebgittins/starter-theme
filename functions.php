<?php
// Admin Functions
	// Load /functions/ folder
		include('functions/loader.php');
	// Add title tag support
		add_theme_support( 'title-tag' );
	// Add support for custom styles in WordPress editor
		add_editor_style('/css/admin/editor-style.css');
	// Add default content width
		if ( ! !empty( $content_width ) ) $content_width = 1200;
	// Add support for WordPress custom menus
		add_action( 'init', 'register_my_menu' );
	// Register areas for custom menus
		function register_my_menu() {
			register_nav_menu( 'menu-header', __( 'Header Menu' ) );
			register_nav_menu( 'menu-footer', __( 'Footer Menu' ) );
		}
	// Enable post thumbnails
		add_theme_support('post-thumbnails');
	// Remove inline gallery styling
		add_filter( 'use_default_gallery_style', '__return_false' );
	// Remove inline caption style
		add_filter( 'img_caption_shortcode_width', '__return_false' );
// Scripts
	// Load custom javascript files
		add_action( 'wp_enqueue_scripts', 'td_load_javascript_files' );
		function td_load_javascript_files() {
			$rand = rand( 1, 9999 );
			wp_register_script( 'theme-vendor', get_template_directory_uri() . '/js/min/vendor.min.js', array('jquery'), $rand, true );
			wp_enqueue_script( 'theme-vendor' );
			wp_register_script( 'theme-functions', get_template_directory_uri() . '/js/min/custom.min.js', array('jquery'), $rand, true );
			wp_enqueue_script( 'theme-functions' );
		}
// Styles
	// Load Stylesheet
		function td_load_styles () {
			$rand = rand( 1, 9999 );
			wp_enqueue_style( 'td-style', get_stylesheet_uri(), '', $rand );
		}
		add_action( 'wp_enqueue_scripts', 'td_load_styles' );
	// Gutenberg CSS removal
	function wps_deregister_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
// Miscellaneous
	// Remove related YouTube videos
		add_filter('oembed_dataparse','td_strip_related_videos', 10, 3);
		function td_strip_related_videos($return, $data, $url) {
			if ($data->provider_name == 'YouTube') {
				$data->html = str_replace('feature=oembed', 'feature=oembed&#038;rel=0&#038;showinfo=0', $data->html);
				return $data->html;
			} else return $return;
		}
		function td_custom_youtube_settings($code){
			if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
				$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&autohide=1", $code);
				return $return;
			}
			return $code;
		}
		add_filter('embed_handler_html', 'td_custom_youtube_settings');
		add_filter('embed_oembed_html', 'td_custom_youtube_settings');
	// Conditional statement for blog pages
		function is_blog_page(){
			global $wp_query;
			if (is_home() || is_category() || is_tag() || is_singular('post')) return true;
			return false;
		}
	// Custom body class
		add_filter( 'body_class', 'td_body_class' );
		function td_body_class( $classes ) {
			if (is_blog_page())
			$classes[] = 'page--blog';
			if (!is_front_page())
			$classes[] = 'not-home';
			return $classes;
		}
	// Apple Icons
		add_action('wp_head', 'td_favicon_header');
		function td_favicon_header() {
			?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/favicon.png" sizes="32x32" type="image/x-icon" />			
			<link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon.png">
			<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon.png">
			<meta name="msapplication-square310x310logo" content="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon_largetile.png">
			<?php
		}
// Update Search Form Html
	function td_change_search_form( $form ) {
		$form = '
		<div class="search">
			<form role="search" method="get" id="search-form" action="' . home_url( '/' ) . '" >
				<label class="screen-reader-text" for="s">' . __('Search',  'domain') . '</label>
				<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="Search&hellip;" />
				<input type="submit" id="searchsubmit" value="'. esc_attr__('Go', 'domain') .'" />
			</form>
		</div>
		';
		return $form;
	}
	add_filter( 'get_search_form', 'td_change_search_form' );
// Add Current Class When On Single
	function td_menu_item_classes( $classes, $item, $args ) {
		$posts_page = get_option('page_for_posts');
		if( ( is_singular( 'post' ) || is_category() || is_tag() ) && $posts_page == $item->object_id )
		    $classes[] = 'current-menu-item';
		return array_unique( $classes );
	}
	add_filter( 'nav_menu_css_class', 'td_menu_item_classes', 10, 3 );
// Display Hamburger
	function td_display_hamburger() {
		echo '
		<div class="hamburger js-nav-toggle">
			<div class="hamburger__line hamburger__line--top"></div>
			<div class="hamburger__line hamburger__line--middle"></div>
			<div class="hamburger__line hamburger__line--bottom"></div>
		</div>';
	}
?>