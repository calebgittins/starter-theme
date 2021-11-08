<?php
// Add Acf Options Pages
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' => 'Options',
			'menu_title' => 'Options',
			'menu_slug'  => 'options-settings',
			'capability' => 'options-settings',
			'redirect'   => false
		));
		acf_add_options_sub_page(array(
			'title'       => 'Global',
			'parent_slug' => 'options-settings',
			'capability'  => 'manage_options'
		));
		acf_add_options_sub_page(array(
			'title'       => 'Contact Details',
			'parent_slug' => 'options-settings',
			'capability'  => 'manage_options'
		));
		acf_add_options_sub_page(array(
			'title'       => 'Footer',
			'parent_slug' => 'options-settings',
			'capability'  => 'manage_options'
		));
	}
// Flexible Preview Plugin
	function td_acf_image_path() {
		$path = 'images/acf';
		return $path;
	}
	add_filter( 'acf-flexible-content-preview.images_path', 'td_acf_image_path' );
// Limit Acf Wysiwyg
	add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
	function my_toolbars( $toolbars ) {
		$toolbars['Very Basic' ] = array();
		$toolbars['Very Basic' ][1] = array( 'bold' , 'italic' , 'underline' );
		if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false ) {
			unset( $toolbars['Full' ][2][$key] );
		}
		return $toolbars;
	}
?>