<?php
// GRAVITY FORMS
	// Hide label option
		add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
	// Change <input type="submit"> to <button>
		add_filter( 'gform_submit_button', 'td_form_submit_button', 10, 5 );
		function td_form_submit_button ( $button, $form ){
			$button = str_replace( "input", "button", $button );
			$button = str_replace( "/", "", $button );
			$button .= "{$form['button']['text']}</button>";
			return $button;
		}
	// Load datepicker style
		add_action( 'gform_enqueue_scripts', 'enqueue_custom_script' );
		function enqueue_custom_script() {
			$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';
			wp_enqueue_style( 'gforms_datepicker_css', GFCommon::get_base_url() . "/css/datepicker{$min}.css", null, GFCommon::$version );
		}
	// Update spinner image
		function gf_spinner_replace( $image_src, $form ) {
			return  'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'; 
		}
		add_filter( 'gform_ajax_spinner_url', 'gf_spinner_replace', 10, 2 );
	// Radio buttons and checkboxes markup
		add_filter( 'gform_field_choice_markup_pre_render', function ( $choice_markup, $choice, $field, $value ) {
			if ( $field->get_input_type() == 'radio' || $field->get_input_type() == 'checkbox' ) {
				$new_choice_markup .= str_replace('</label>','<span class="custom-input custom-input--' . $field->get_input_type() . '"></span></label>',$choice_markup);
				$choice_markup = $new_choice_markup;
			}
			return $choice_markup;
		}, 10, 4 );