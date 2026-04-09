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
		'Free' => 'Gratis',
		'Start Learning' => 'Comenzar curso',
		'Share' => 'Compartir',
		'Featured Review' => 'Rese?a destacada',
		'All levels' => 'Todos los niveles',
		'All Levels' => 'Todos los niveles',
		'Duration:' => 'Duraci?n:',
		'Duration' => 'Duraci?n',
		'Lesson:' => 'Lecci?n:',
		'Lesson' => 'Lecci?n',
		'Lessons' => 'Lecciones',
		'Quiz:' => 'Cuestionario:',
		'Quiz' => 'Cuestionario',
		'Quizzes' => 'Cuestionarios',
		'Student:' => 'Estudiante:',
		'Student' => 'Estudiante',
		'Students' => 'Estudiantes',
		'Level:' => 'Nivel:',
		'Level' => 'Nivel',
		'Enrollment in the course is not mandatory. You can access course for learning now.' => 'La inscripci?n en el curso no es obligatoria. Ya pod?s acceder al curso para aprender.',
	);

	if ( isset( $map[ $text ] ) ) {
		return $map[ $text ];
	}

	return $translated;
}
add_filter( 'gettext', 'datamaq_lp_translate_string', 20, 3 );

function datamaq_lp_translate_plural( $translated, $single, $plural, $number, $domain ) {
	if ( '%d student' === $single && '%d students' === $plural ) {
		return _n( '%d estudiante', '%d estudiantes', $number, 'default' );
	}
	if ( '%d lesson' === $single && '%d lessons' === $plural ) {
		return _n( '%d lecci?n', '%d lecciones', $number, 'default' );
	}
	if ( '%d quiz' === $single && '%d quizzes' === $plural ) {
		return _n( '%d cuestionario', '%d cuestionarios', $number, 'default' );
	}

	return $translated;
}
add_filter( 'ngettext', 'datamaq_lp_translate_plural', 20, 5 );
