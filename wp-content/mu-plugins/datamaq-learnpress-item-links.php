<?php
/**
 * Plugin Name: DataMaq LearnPress Item Links
 * Description: Normaliza los enlaces de items de LearnPress para cursos y lecciones publicas.
 * Version: 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter(
	'learn-press/course/item-link',
	static function ( $item_link, $item_id, $course ) {
		if ( ! $course || ! is_object( $course ) || ! method_exists( $course, 'get_id' ) ) {
			return $item_link;
		}

		$course_permalink = get_permalink( $course->get_id() );
		$item_slug        = get_post_field( 'post_name', $item_id );
		$item_type        = get_post_type( $item_id );

		if ( ! $course_permalink || ! $item_slug || ! $item_type ) {
			return $item_link;
		}

		$prefixes = array(
			'lp_lesson' => sanitize_title_with_dashes( LP_Settings::get_option( 'lesson_slug', 'lessons' ) ),
			'lp_quiz'   => sanitize_title_with_dashes( LP_Settings::get_option( 'quiz_slug', 'quizzes' ) ),
		);

		$prefix = '';
		if ( isset( $prefixes[ $item_type ] ) ) {
			$prefix = $prefixes[ $item_type ];
		}

		if ( '' === $prefix ) {
			return $item_link;
		}

		return trailingslashit( trailingslashit( $course_permalink ) . trailingslashit( $prefix ) . $item_slug );
	},
	20,
	3
);
