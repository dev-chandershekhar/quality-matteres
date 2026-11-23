<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="container">
		<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<nav class="main-nav" aria-label="Primary">
			<?php wp_nav_menu( [ 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => false ] ); ?>
		</nav>
		<?php if ( function_exists( 'WC' ) ) : ?>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Cart (<span class="qm-cart-count"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>)</a>
		<?php endif; ?>
	</div>
</header>
