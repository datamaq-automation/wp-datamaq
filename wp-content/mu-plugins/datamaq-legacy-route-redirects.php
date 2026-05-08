<?php
/**
 * Plugin Name: DataMaq Legacy Route Redirects
 * Description: Mantiene redirecciones legacy criticas independientemente del tema activo.
 * Version: 0.1.0
 *
 * @package DataMaq
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'template_redirect',
	static function () {
		if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
			return;
		}

		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '/';
		$path        = wp_parse_url( $request_uri, PHP_URL_PATH );
		if ( ! is_string( $path ) || '' === $path ) {
			return;
		}

		$normalized = trim( $path, '/' );

		if ( 'cotizador' === $normalized || preg_match( '#^cotizador/[^/]+/web$#', $normalized ) ) {
			wp_safe_redirect( home_url( '/contact/' ), 301 );
			exit;
		}
	},
	1
);
