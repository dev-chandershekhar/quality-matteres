<?php
defined( 'ABSPATH' ) || exit;

define( 'QM_VERSION', '0.1.0' );

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'quality-metteresess', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'responsive-embeds' );
	// WooCommerce
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'quality-metteresess' ),
		'footer'  => __( 'Footer Menu', 'quality-metteresess' ),
	] );
} );

// Optional split-out code
foreach ( [ 'inc/vite.php', 'inc/woocommerce.php' ] as $file ) {
	$path = get_template_directory() . '/' . $file;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}
