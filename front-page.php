<?php get_header(); ?>
<main class="site-main">
	<div class="container">
		<h1><?php bloginfo( 'name' ); ?></h1>
		<p><?php bloginfo( 'description' ); ?></p>
		<?php if ( function_exists( 'wc_get_products' ) ) : ?>
			<h2><?php esc_html_e( 'Featured products', 'quality-metteresess' ); ?></h2>
			<?php echo do_shortcode( '[products limit="6" columns="3"]' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
