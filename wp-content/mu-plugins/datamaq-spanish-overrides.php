<?php
/**
 * Plugin Name: Datamaq Spanish Overrides (LearnPress)
 * Description: Minimal and safe translation overrides for LearnPress/UI strings.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Keep only explicit string overrides that still appear untranslated in some contexts.
 */
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

/**
 * Patch pluralization edge-cases found in current LearnPress locale pack.
 */
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

	// LearnPress pack currently has msgstr[1] empty for this pair in some contexts.
	if ( 'Quiz' === $single && 'Quizzes' === $plural ) {
		return ( 1 === (int) $number ) ? 'Cuestionario' : 'Cuestionarios';
	}

	return $translated;
}
add_filter( 'ngettext', 'datamaq_lp_translate_plural', 20, 5 );

/**
 * Hide share + featured review blocks on course pages.
 */
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

/**
 * Hide course search and order-by controls on home/courses listing pages.
 */
function datamaq_lp_hide_home_search_and_orderby() {
	if ( is_admin() ) {
		return;
	}

	if ( is_front_page() || is_home() || is_post_type_archive( 'lp_course' ) || is_page( 'courses' ) ) {
		?>
		<style id="datamaq-lp-hide-home-filters">
			.wp-block-learnpress-course-search,
			.courses-order-by-wrapper {
				display: none !important;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'datamaq_lp_hide_home_search_and_orderby', 100 );
