<?php
if ( ! defined( 'WPCACHEHOME' ) ) {
	define( 'WPCACHEHOME', '/home/datamaq/public_html/cursos/wp-content/plugins/wp-super-cache/' );
}

$cache_enabled = true;
$super_cache_enabled = true;
$wp_cache_mod_rewrite = 0;
$cache_compression = 1;
$cache_rebuild_files = 1;
$cache_max_time = 1800;
$cache_path = WP_CONTENT_DIR . '/cache/';
$file_prefix = 'wp-cache-';
$wp_cache_mutex_disabled = 1;
$sem_id = 5419;

$cache_acceptable_files = array( 'wp-comments-popup.php', 'wp-links-opml.php', 'wp-locations.php' );

// LearnPress dynamic routes/endpoints should never be cached.
$cache_rejected_uri = array(
	'wp-.*\\.php',
	'index\\.php',
	'^/lp-checkout/?',
	'^/lp-profile/?',
	'^/instructor/?',
	'^/instructors/?',
	'^/become_a_teacher/?',
	'lp-ajax',
	'enroll-course',
	'lpnonce'
);

// Avoid caching pages tied to LMS/cart/session cookies.
$wpsc_rejected_cookies = array(
	'lp_session_guest',
	'learn_press_session',
	'wordpress_logged_in_'
);

// Also include custom cookies in cache-key logic when present.
$wpsc_cookies = array(
	'lp_session_guest',
	'learn_press_session'
);

$wp_cache_not_logged_in = 2;
$wp_cache_no_cache_for_get = 1;
$wp_super_cache_late_init = 0;
$wp_cache_mobile_enabled = 0;
$wp_cache_make_known_anon = 0;
$wp_cache_clear_on_post_edit = 0;
$wp_supercache_304 = 0;
$wp_cache_disable_utf8 = 0;
$wp_cache_preload_on = 0;
$cache_scheduled_time = '00:00';
$cache_schedule_type = 'interval';
$cache_schedule_interval = 'daily';
$wp_cache_preload_interval = 600;
$wp_cache_preload_posts = 0;
$wp_cache_preload_taxonomies = 0;
$wp_cache_preload_email_me = 0;
$wp_cache_preload_email_volume = 'none';
$cached_direct_pages = array();
$wpsc_served_header = false;
$wpsc_save_headers = 0;
$wp_super_cache_comments = 1;
$wpsc_version = 172;

if ( '/' != substr( $cache_path, -1 ) ) {
	$cache_path .= '/';
}
?>
