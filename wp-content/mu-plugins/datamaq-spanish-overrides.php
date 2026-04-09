<?php
/**
 * Plugin Name: Datamaq Spanish Overrides (LearnPress)
 * Description: Override fallback translations for LearnPress/UI strings still shown in English.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function datamaq_lp_translate_string( , ,  ) {
	// Keep scope broad enough for widgets/templates that may use default domain.
	 = array(
		'Free' => 'Gratis',
		'Start Learning' => 'Comenzar curso',
		'Share' => 'Compartir',
		'Featured Review' => 'Reseña destacada',
		'All levels' => 'Todos los niveles',
		'All Levels' => 'Todos los niveles',
		'Duration:' => 'Duración:',
		'Duration' => 'Duración',
		'Lesson:' => 'Lección:',
		'Lesson' => 'Lección',
		'Lessons' => 'Lecciones',
		'Quiz:' => 'Cuestionario:',
		'Quiz' => 'Cuestionario',
		'Quizzes' => 'Cuestionarios',
		'Student:' => 'Estudiante:',
		'Student' => 'Estudiante',
		'Students' => 'Estudiantes',
		'Level:' => 'Nivel:',
		'Level' => 'Nivel',
		'Enrollment in the course is not mandatory. You can access course for learning now.' => 'La inscripción en el curso no es obligatoria. Ya podés acceder al curso para aprender.',
	);

	if ( isset( [  ] ) ) {
		return [  ];
	}

	return ;
}
add_filter( 'gettext', 'datamaq_lp_translate_string', 20, 3 );

function datamaq_lp_translate_plural( , , , ,  ) {
	// Handle common LearnPress count formats in loop cards.
	if ( '%d student' ===  && '%d students' ===  ) {
		return _n( '%d estudiante', '%d estudiantes', , 'default' );
	}
	if ( '%d lesson' ===  && '%d lessons' ===  ) {
		return _n( '%d lección', '%d lecciones', , 'default' );
	}
	if ( '%d quiz' ===  && '%d quizzes' ===  ) {
		return _n( '%d cuestionario', '%d cuestionarios', , 'default' );
	}

	return ;
}
add_filter( 'ngettext', 'datamaq_lp_translate_plural', 20, 5 );
