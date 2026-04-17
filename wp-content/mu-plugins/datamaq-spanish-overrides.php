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

	if ( ! is_array( $block ) || ( isset( $block['blockName'] ) ? $block['blockName'] : '' ) !== 'learnpress/list-courses' ) {
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

/**
 * Visual bridge: align LearnPress look & feel with Datamaq identity
 * without changing templates.
 */
function datamaq_lp_theme_bridge_styles() {
	if ( is_admin() ) {
		return;
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	$is_lp_surface = is_post_type_archive( 'lp_course' ) || is_singular( 'lp_course' ) || is_page( 'courses' ) || is_page( 'instructor' ) || is_page( 'instructors' ) || strpos( $request_uri, '/instructor/' ) !== false;
	if ( ! $is_lp_surface ) {
		return;
	}
	?>
	<style id="datamaq-lp-theme-bridge">
		:root {
			--dm-accent: #ff6a00;
			--dm-accent-2: #ff9a4d;
			--dm-ink: #0f1b3a;
			--dm-muted: #55627a;
			--dm-line: #e5e8f0;
			--dm-surface: #ffffff;
			--dm-surface-soft: #f7f9fc;
		}

		body.post-type-archive-lp_course .wp-site-blocks,
		body.single-lp_course .wp-site-blocks,
		body.page-template-default.page .wp-site-blocks {
			background: radial-gradient(circle at 100% 0%, #f4f7ff 0%, #ffffff 45%);
		}

		/* Global navigation rhythm */
		.wp-site-blocks > header.wp-block-template-part {
			position: sticky;
			top: 0;
			z-index: 40;
			backdrop-filter: blur(10px);
			background: rgba(255, 255, 255, 0.88);
			border-bottom: 1px solid var(--dm-line);
		}

		.wp-site-blocks > header.wp-block-template-part .alignwide {
			padding-top: .7rem !important;
			padding-bottom: .7rem !important;
		}

		.wp-site-blocks > header.wp-block-template-part .wp-block-site-title a {
			font-weight: 800;
			letter-spacing: -.01em;
			color: var(--dm-ink);
			text-decoration: none;
		}

		.wp-site-blocks > header.wp-block-template-part .wp-block-navigation .wp-block-navigation-item__content {
			color: var(--dm-ink);
			font-weight: 600;
			padding: .38rem .62rem;
			border-radius: 9px;
			text-decoration: none;
		}

		.wp-site-blocks > header.wp-block-template-part .wp-block-navigation .wp-block-navigation-item__content:hover,
		.wp-site-blocks > header.wp-block-template-part .wp-block-navigation .wp-block-navigation-item__content:focus-visible {
			background: #eef3ff;
			color: #14367a;
			outline: none;
		}

		/* Main spacing */
		main.wp-block-group {
			padding-top: .35rem;
		}

		main .alignwide,
		main .is-layout-constrained {
			max-width: 1180px;
		}

		.learn-press-courses .course-item,
		.lp-single-instructor .course-item,
		.lp-course-curriculum,
		.lp-section-instructor,
		.info-meta {
			background: var(--dm-surface);
			border: 1px solid var(--dm-line);
			border-radius: 14px;
			box-shadow: 0 10px 24px rgba(15, 27, 58, 0.06);
		}

		.learn-press-courses .course-item {
			overflow: hidden;
			transition: transform .16s ease, box-shadow .16s ease;
		}

		.learn-press-courses .course-item:hover {
			transform: translateY(-2px);
			box-shadow: 0 14px 28px rgba(15, 27, 58, 0.10);
		}

		.learn-press-courses .course-content,
		.lp-single-instructor .course-content {
			padding: 1rem 1.1rem 1.2rem;
		}

		.learn-press-courses .course-title,
		.learn-press-courses .wap-course-title,
		.lp-course-curriculum__title,
		.section-title,
		.wp-block-post-title {
			color: var(--dm-ink);
			letter-spacing: -.01em;
		}

		.learn-press-courses .course-wrap-meta .meta-item,
		.lp-course-curriculum .course-curriculum-info li,
		.info-meta .info-meta-item {
			color: var(--dm-muted);
			font-size: .93rem;
		}

		.learn-press-courses .course-price .free,
		.course-item-price .free {
			display: inline-block;
			background: #fff1e8;
			color: #b84b00;
			border: 1px solid #ffd2b5;
			padding: .2rem .55rem;
			border-radius: 999px;
			font-weight: 700;
		}

		.learn-press-courses .course-readmore a,
		.lp-single-instructor .course-readmore a,
		.lp-profile-content .course-readmore a,
		.wp-block-learnpress-course-button-read-more a,
		.learn-press-courses a.lp-button,
		.lp-single-instructor a.lp-button,
		.learn-press-courses .lp-button,
		.lp-single-instructor .lp-button,
		.course-button-read-more button.wp-block-learnpress-course-button-read-more,
		button.wp-block-learnpress-course-button-read-more,
		.wp-block-learnpress-course-button-read-more {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: .35rem;
			padding: .62rem .92rem;
			border-radius: 10px;
			border: 1px solid #d85800 !important;
			background: linear-gradient(180deg, var(--dm-accent) 0%, #e85d00 100%) !important;
			color: #fff !important;
			font-weight: 700;
			text-decoration: none !important;
		}

		.learn-press-courses .course-readmore a:hover,
		.learn-press-courses .course-readmore a:focus,
		.learn-press-courses .course-readmore a:active,
		.lp-single-instructor .course-readmore a:hover,
		.lp-single-instructor .course-readmore a:focus,
		.lp-single-instructor .course-readmore a:active,
		.lp-profile-content .course-readmore a:hover,
		.lp-profile-content .course-readmore a:focus,
		.lp-profile-content .course-readmore a:active,
		.wp-block-learnpress-course-button-read-more a:hover,
		.wp-block-learnpress-course-button-read-more a:focus,
		.wp-block-learnpress-course-button-read-more a:active,
		.course-button-read-more button.wp-block-learnpress-course-button-read-more:hover,
		.course-button-read-more button.wp-block-learnpress-course-button-read-more:focus,
		.course-button-read-more button.wp-block-learnpress-course-button-read-more:active,
		button.wp-block-learnpress-course-button-read-more:hover,
		button.wp-block-learnpress-course-button-read-more:focus,
		button.wp-block-learnpress-course-button-read-more:active,
		.wp-block-learnpress-course-button-read-more:hover,
		.wp-block-learnpress-course-button-read-more:focus,
		.wp-block-learnpress-course-button-read-more:active {
			background: linear-gradient(180deg, #ff7a1f 0%, #f06600 100%) !important;
			border-color: #d85800 !important;
			color: #fff !important;
			text-decoration: none !important;
			filter: none !important;
			outline: none;
		}

		.lp-course-curriculum .course-toggle-all-sections,
		.lp-course-curriculum .course-toggle-all-sections.lp-collapse {
			color: #c14f00;
			font-weight: 600;
		}

		.lp-instructor-meta .instructor-item-meta {
			background: var(--dm-surface-soft);
			border: 1px solid var(--dm-line);
			border-radius: 10px;
			padding: .35rem .6rem;
		}

		/* Footer harmonization */
		.wp-site-blocks > footer.wp-block-template-part {
			margin-top: 2.2rem;
			background: linear-gradient(180deg, #f7f9fd 0%, #eef3fb 100%);
			border-top: 1px solid var(--dm-line);
		}

		.wp-site-blocks > footer.wp-block-template-part .alignwide {
			padding-top: 1rem !important;
			padding-bottom: 1rem !important;
		}

		.wp-site-blocks > footer.wp-block-template-part .wp-block-site-title a,
		.wp-site-blocks > footer.wp-block-template-part p,
		.wp-site-blocks > footer.wp-block-template-part a {
			color: var(--dm-muted);
		}

		@media (max-width: 768px) {
			.learn-press-courses .course-content,
			.lp-single-instructor .course-content {
				padding: .85rem .85rem 1rem;
			}

			.wp-site-blocks > header.wp-block-template-part .alignwide,
			.wp-site-blocks > footer.wp-block-template-part .alignwide {
				padding-left: .8rem !important;
				padding-right: .8rem !important;
			}
		}
	</style>
	<?php
}
add_action( 'wp_head', 'datamaq_lp_theme_bridge_styles', 110 );

/**
 * Force local avatar for instructor profile page/user card.
 */
function datamaq_lp_force_instructor_avatar_src( $uploaded_avatar_src, $user ) {
	if ( ! is_object( $user ) || ! method_exists( $user, 'get_id' ) ) {
		return $uploaded_avatar_src;
	}

	if ( 2 === (int) $user->get_id() ) {
		return 'https://datamaq.com.ar/wp-content/uploads/2026/04/agustinbustos-avatar-250.webp';
	}

	return $uploaded_avatar_src;
}
add_filter( 'learn-press/user/upload-avatar-src', 'datamaq_lp_force_instructor_avatar_src', 20, 2 );
