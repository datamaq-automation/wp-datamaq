<?php
/**
 * AJAX Handlers refactored to use Clean Architecture
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use DataMaq\UI\Http\Ajax\ContactController;

add_action( 'wp_ajax_datamaq_submit_contact', 'dm_ajax_handle_contact' );
add_action( 'wp_ajax_nopriv_datamaq_submit_contact', 'dm_ajax_handle_contact' );

function dm_ajax_handle_contact() {
	$controller = new ContactController();
	$controller->handleRequest();
}
