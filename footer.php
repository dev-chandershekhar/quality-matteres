<footer class="site-footer">
	<div class="container">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
		<?php wp_nav_menu( [ 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false ] ); ?>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
