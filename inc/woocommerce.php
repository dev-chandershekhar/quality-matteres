<?php
/**
 * WooCommerce customisations. Override templates by copying them into /woocommerce.
 */
defined( 'ABSPATH' ) || exit;

// Products per page / columns
add_filter( 'loop_shop_per_page', fn() => 12 );
add_filter( 'loop_shop_columns', fn() => 3 );

// Wrap WooCommerce content in theme markup
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', fn() => print '<main class="site-main"><div class="container">', 10 );
add_action( 'woocommerce_after_main_content', fn() => print '</div></main>', 10 );

// Cart item count fragment (AJAX refresh)
add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {
	$fragments['span.qm-cart-count'] = '<span class="qm-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
} );
