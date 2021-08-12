<?php

// WooCommerce
	add_theme_support( 'woocommerce' );

// Disable WooCommerce styles
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Gallery files
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

// Shop page layout
    add_action( 'init', 'td_shop_page_layout' );

    function td_shop_page_layout() {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }

// Custom wrapper
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    add_action('woocommerce_before_main_content', 'td_wrapper_start', 10);
    add_action('woocommerce_after_main_content', 'td_wrapper_end', 10);

    function td_wrapper_start() {
        echo '<div class="wrap wrap--woocommerce">';
    }

    function td_wrapper_end() {
        echo '</div>';
    }

// Wrap archive 

	add_action('woocommerce_before_shop_loop', function() {
		echo '<div class="woocommerce-products-subheader">';
	}, 15 );  

	add_action('woocommerce_before_shop_loop', function() {
		echo '</div>';
	}, 40 );  

// Product page layout
    add_action('init', 'td_product_layout');

    function td_product_layout() {        
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    }

// Checkout fields

    add_filter( 'woocommerce_checkout_fields' , 'td_override_checkout_fields' );

    // Our hooked in function - $fields is passed via the filter!
    function td_override_checkout_fields( $fields ) {
        // Classes
        $fields['billing']['billing_city']['class'] = array('form-row-third');
        $fields['billing']['billing_state']['class'] = array('form-row-third');
        $fields['billing']['billing_postcode']['class'] = array('form-row-third');
        $fields['billing']['billing_phone']['class'] = array('form-row-first');
        $fields['billing']['billing_email']['class'] = array('form-row-last');
        return $fields;
    }

// Quantity Field

    add_action( 'woocommerce_after_quantity_input_field', 'ts_quantity_plus_sign' );
 
function ts_quantity_plus_sign() {
   echo '<button type="button" class="plus" >+</button>';
}
 
add_action( 'woocommerce_before_quantity_input_field', 'ts_quantity_minus_sign' );
function ts_quantity_minus_sign() {
   echo '<button type="button" class="minus" >-</button>';
}
 
add_action( 'wp_footer', 'ts_quantity_plus_minus' );
 
function ts_quantity_plus_minus() {
   // To run this on the single product page
   if ( ! is_product() && ! is_cart() ) return;
   ?>
   <script type="text/javascript">
          
      jQuery(document).ready(function($){   
          
            $('.quantity').on( 'click', 'button.plus, button.minus', function() {
 
            // Get current quantity values
            var qty = $( this ).closest( '.quantity' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
 
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } 
            else {
               qty.val( val + step );
                 }
            } 
            else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } 
               else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
             
         });
          
      });
          
   </script>
   <?php
}