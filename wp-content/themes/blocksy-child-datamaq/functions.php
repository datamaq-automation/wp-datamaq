<?php
/**
 * Blocksy Child Datamaq functions and definitions
 * SOLID Refactoring - Modular Architecture
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Data Layer
require_once get_stylesheet_directory() . '/inc/site-data.php';

// 2. Business Logic & AJAX
require_once get_stylesheet_directory() . '/inc/ajax-handlers.php';

// 3. Theme Setup & Assets
require_once get_stylesheet_directory() . '/inc/theme-setup.php';

/**
 * Injection Controller (Legacy wrapper for backward compatibility if needed)
 * Note: New sections should be loaded via get_template_part() in templates.
 */
function blocksy_child_inject_section($slug) {
    get_template_part('template-parts/content', $slug);
}
