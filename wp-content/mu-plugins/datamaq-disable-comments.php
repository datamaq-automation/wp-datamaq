<?php
/**
 * Plugin Name: Datamaq Disable Comments
 * Description: Disable comments site-wide (frontend and admin).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Frontend/API behavior.
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 20 );

// Block direct comment posting endpoint.
add_action(
	'init',
	function () {
		global $pagenow;
		if ( 'wp-comments-post.php' === $pagenow ) {
			wp_safe_redirect( home_url() );
			exit;
		}
	}
);

// Remove comments support from all post types.
add_action(
	'admin_init',
	function () {
		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}

		if ( is_admin() ) {
			global $pagenow;
			if ( 'edit-comments.php' === $pagenow ) {
				wp_safe_redirect( admin_url() );
				exit;
			}
		}
	}
);

// Hide comments UI in admin and admin bar.
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);

add_action(
	'wp_before_admin_bar_render',
	function () {
		global $wp_admin_bar;
		if ( $wp_admin_bar ) {
			$wp_admin_bar->remove_node( 'comments' );
		}
	}
);
