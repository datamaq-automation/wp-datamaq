<?php
/**
 * Plugin Name: Datamaq Spanish Overrides (LearnPress)
 * Description: Override fallback translations for LearnPress/UI strings still shown in English.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function datamaq_lp_translate_string( $translated, $text, $domain ) {
	$map = array(
		'Home' => 'Inicio',
		'Last updated:' => "\xC3\x9Altima actualizaci\xC3\xB3n:",
		'Free' => 'Gratis',
		'Start Learning' => 'Comenzar curso',
		'Share' => 'Compartir',
		'Featured Review' => "Rese\xC3\xB1a destacada",
		'All levels' => 'Todos los niveles',
		'All Levels' => 'Todos los niveles',
		'Duration:' => "Duraci\xC3\xB3n:",
		'Duration' => "Duraci\xC3\xB3n",
		'Lesson:' => "Lecci\xC3\xB3n:",
		'Lesson' => "Lecci\xC3\xB3n",
		'Lessons' => 'Lecciones',
		'Quiz:' => 'Cuestionario:',
		'Quiz' => 'Cuestionario',
		'Quizzes' => 'Cuestionarios',
		'Student:' => 'Estudiante:',
		'Student' => 'Estudiante',
		'Instructor' => 'Instructor',
		'User Avatar' => 'Avatar de usuario',
		'Course' => 'Curso',
		'Courses' => 'Cursos',
		'Students' => 'Estudiantes',
		'Level:' => 'Nivel:',
		'Level' => 'Nivel',
		'Enrollment in the course is not mandatory. You can access course for learning now.' => "La inscripci\xC3\xB3n en el curso no es obligatoria. Ya pod\xC3\xA9s acceder al curso para aprender.",
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
		return _n( "%d lecci\xC3\xB3n", '%d lecciones', $number, 'default' );
	}
	if ( ( '%d quiz' === $single && '%d quizzes' === $plural ) || ( '%d Quiz' === $single && '%d Quizzes' === $plural ) ) {
		return _n( '%d cuestionario', '%d cuestionarios', $number, 'default' );
	}

	return $translated;
}
add_filter( 'ngettext', 'datamaq_lp_translate_plural', 20, 5 );

function datamaq_lp_buffer_replace( $html ) {
	if ( ! is_string( $html ) || $html === '' ) {
		return $html;
	}

	$html = str_replace(
		array( 'Home', 'Last updated:', 'Instructor', 'User Avatar' ),
		array( 'Inicio', "\xC3\x9Altima actualizaci\xC3\xB3n:", 'Instructor', 'Avatar de usuario' ),
		$html
	);
	$html = str_replace(
		array( '<label>by</label>', '<label>By</label>' ),
		array( '<label>por</label>', '<label>por</label>' ),
		$html
	);

	$html = preg_replace( '/(\d+)\s+Lessons\b/u', '$1 Lecciones', $html );
	$html = preg_replace( '/(\d+)\s+Students\b/u', '$1 Estudiantes', $html );
	$html = preg_replace( '/(\d+)\s+Student\b/u', '$1 Estudiante', $html );
	$html = preg_replace( '/(\d+)\s+Weeks\b/u', '$1 Semanas', $html );
	$html = preg_replace( '/(\d+)\s+Quizzes\b/u', '$1 Cuestionarios', $html );
	$html = preg_replace( '/(\d+)\s+Courses\b/u', '$1 Cursos', $html );
	$html = preg_replace( '/(\d+)\s+Course\b/u', '$1 Curso', $html );
	$html = preg_replace( '/\b[Bb]y\s+([^<]{1,80})/u', 'por $1', $html );

	$months = array(
		'January' => 'enero', 'February' => 'febrero', 'March' => 'marzo', 'April' => 'abril',
		'May' => 'mayo', 'June' => 'junio', 'July' => 'julio', 'August' => 'agosto',
		'September' => 'septiembre', 'October' => 'octubre', 'November' => 'noviembre', 'December' => 'diciembre',
	);
	$html = strtr( $html, $months );

	return $html;
}

function datamaq_lp_start_buffer() {
	if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	if ( strpos( $request_uri, '/courses' ) !== false || strpos( $request_uri, '/course' ) !== false || strpos( $request_uri, '/lp-' ) !== false ) {
		ob_start( 'datamaq_lp_buffer_replace' );
	}
}
add_action( 'template_redirect', 'datamaq_lp_start_buffer', 0 );

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
