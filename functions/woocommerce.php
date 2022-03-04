<?php

// Check if WooCommerce is activated
    if ( ! function_exists( 'is_woocommerce_activated' ) ) {
        function is_woocommerce_activated() {
            if ( class_exists( 'woocommerce' ) ) { 
                return true; 
            } else { 
                return false; 
            }
        }
    }

if(is_woocommerce_activated()) {

// WooCommerce
	add_theme_support( 'woocommerce' );

// Disable WooCommerce default styles
	add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Add gallery functionality
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

// Shop page layout
    add_action( 'init', 'td_shop_page_layout' );

    function td_shop_page_layout() {
        // Remove breadcrumbs
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
        // Remove sidebar
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

                $(this).parent('.quantity').find('input').trigger('change');
                console.log('Input field updated');                
                 
             });
              
          });
              
       </script>
       <?php
    }

// Display dynamic cart icon 

    function td_display_cart() {
        echo '<a class="dynamic-cart" href="' . wc_get_cart_url() . '"><div class="dynamic-cart__count">' . WC()->cart->cart_contents_count. '</div><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="screen-reader-text">items in cart</span></a>';
    }

// Update dynamic cart icon

    add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

    function woocommerce_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <a class="dynamic-cart" href="<?php echo wc_get_cart_url(); ?>"><div class="dynamic-cart__count"><?php echo WC()->cart->cart_contents_count; ?></div><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="screen-reader-text">items in cart</span></a>
        <?php
        $fragments['a.dynamic-cart'] = ob_get_clean();
        return $fragments;
    }

}