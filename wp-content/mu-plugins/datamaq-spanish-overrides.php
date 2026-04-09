<?php
/**
 * Plugin Name: Datamaq Spanish Overrides (LearnPress)
 * Description: Minimal and safe translation/UI overrides for LearnPress.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function datamaq_lp_translate_string( $translated, $text, $domain ) {
	$map = array(
		'Home' => 'Inicio',
		'Last updated:' => '?ltima actualizaci?n:',
		'Start Learning' => 'Comenzar curso',
		'Featured Review' => 'Rese?a destacada',
		'Related Course' => 'Curso relacionado',
		'Related Courses' => 'Cursos relacionados',
		'User Avatar' => 'Avatar de usuario',
		'Course thumbnail' => 'Miniatura del curso',
		'course thumbnail' => 'miniatura del curso',
	);

	if ( isset( $map[ $text ] ) ) {
		return $map[ $text ];
	}

	return $translated;
}
add_filter( 'gettext', 'datamaq_lp_translate_string', 20, 3 );

function datamaq_lp_translate_plural( $translated, $single, $plural, $number, $domain ) {
	if ( ( '%d student' === $single && '%d students' === $plural ) || ( '%d Student' === $single && '%d Students' === $plural ) ) {
		return _n( '%d estudiante', '%d estudiantes', $number, 'default' );
	}
	if ( ( '%d lesson' === $single && '%d lessons' === $plural ) || ( '%d Lesson' === $single && '%d Lessons' === $plural ) ) {
		return _n( '%d lecci?n', '%d lecciones', $number, 'default' );
	}
	if ( ( '%d quiz' === $single && '%d quizzes' === $plural ) || ( '%d Quiz' === $single && '%d Quizzes' === $plural ) ) {
		return _n( '%d cuestionario', '%d cuestionarios', $number, 'default' );
	}
	if ( 'Quiz' === $single && 'Quizzes' === $plural ) {
		return ( 1 === (int) $number ) ? 'Cuestionario' : 'Cuestionarios';
	}

	return $translated;
}
add_filter( 'ngettext', 'datamaq_lp_translate_plural', 20, 5 );

/**
 * Remove search/order controls from LearnPress list-courses block output
 * on courses listing pages (server-side, no CSS dependency).
 */
function datamaq_lp_strip_courses_controls_html( $block_content, $block ) {
	if ( ! is_string( $block_content ) || '' === $block_content ) {
		return $block_content;
	}

	if ( ! is_array( $block ) || ( $block['blockName'] ?? '' ) !== 'learnpress/list-courses' ) {
		return $block_content;
	}

	if ( ! ( is_front_page() || is_home() || is_post_type_archive( 'lp_course' ) || is_page( 'courses' ) ) ) {
		return $block_content;
	}

	$patterns = array(
		'~<div class="wp-block-learnpress-course-search">.*?</div>\s*~is',
		'~<div class="courses-order-by-wrapper">.*?</div>\s*~is',
		'~<div class="course-filter-btn-mobile">.*?</div>\s*~is',
	);

	return preg_replace( $patterns, '', $block_content );
}
add_filter( 'render_block', 'datamaq_lp_strip_courses_controls_html', 20, 2 );

function datamaq_lp_hide_share_and_featured_review() {
	if ( is_admin() ) {
		return;
	}
	?>
	<style id="datamaq-lp-hide-share-featured-review">
		.wp-block-learnpress-course-share,
		.wp-block-learnpress-course-feature-review {
			display: none !important;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'datamaq_lp_hide_share_and_featured_review', 99 );
