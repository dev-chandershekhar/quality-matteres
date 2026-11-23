<?php
/**
 * Vite integration: dev server (HMR) when `hot` file exists, built manifest otherwise.
 */
defined( 'ABSPATH' ) || exit;

const QM_VITE_ENTRY = 'assets/js/main.js';

function qm_vite_dev_url(): ?string {
	$hot = get_template_directory() . '/hot';
	return file_exists( $hot ) ? trim( (string) file_get_contents( $hot ) ) : null;
}

function qm_vite_manifest(): array {
	static $manifest = null;
	if ( null === $manifest ) {
		$file     = get_template_directory() . '/dist/.vite/manifest.json';
		$manifest = file_exists( $file ) ? ( json_decode( file_get_contents( $file ), true ) ?: [] ) : [];
	}
	return $manifest;
}

/** URL of a built asset by its source path, e.g. qm_asset( 'assets/images/logo.svg' ). */
function qm_asset( string $path ): string {
	if ( $dev = qm_vite_dev_url() ) {
		return $dev . '/' . ltrim( $path, '/' );
	}
	$manifest = qm_vite_manifest();
	return isset( $manifest[ $path ] )
		? get_template_directory_uri() . '/dist/' . $manifest[ $path ]['file']
		: get_template_directory_uri() . '/' . ltrim( $path, '/' );
}

add_action( 'wp_enqueue_scripts', function () {
	if ( $dev = qm_vite_dev_url() ) {
		wp_enqueue_script_module( 'qm-vite-client', $dev . '/@vite/client' );
		wp_enqueue_script_module( 'qm-main', $dev . '/' . QM_VITE_ENTRY );
		return;
	}

	$manifest = qm_vite_manifest();
	if ( empty( $manifest[ QM_VITE_ENTRY ] ) ) {
		wp_enqueue_style( 'qm-style', get_stylesheet_uri(), [], QM_VERSION ); // fallback: run `npm run build`
		return;
	}

	$entry = $manifest[ QM_VITE_ENTRY ];
	$uri   = get_template_directory_uri() . '/dist/';
	foreach ( $entry['css'] ?? [] as $i => $css ) {
		wp_enqueue_style( "qm-main-$i", $uri . $css, [], null );
	}
	wp_enqueue_script_module( 'qm-main', $uri . $entry['file'], [], null );
} );
