<?php
/**
 * Paperplane Studio case: its own layout (template-parts/cases/paperplane.php) and its own assets
 * (assets/cases/paperplane/), loaded only on that page. Every other page is untouched.
 *
 * The case page is a regular portfolio page (slug "paperplane-studio") imported from the case library;
 * its block content is a plain-text version used for SEO, llms.txt and the editor.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

if ( file_exists( get_template_directory() . '/inc/paperplane-data.php' ) ) {
	require_once get_template_directory() . '/inc/paperplane-data.php';
}

/**
 * Is this page the Paperplane Studio case?
 *
 * @param int $post_id Page ID (defaults to the current one).
 */
function sera_is_paperplane( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id || ! function_exists( 'sera_pp_case_data' ) ) {
		return false;
	}
	$is = 'paperplane-studio' === get_post_field( 'post_name', $post_id );
	/**
	 * Lets a renamed page keep the Paperplane layout.
	 *
	 * @param bool $is      Whether the page uses the Paperplane layout.
	 * @param int  $post_id Page ID.
	 */
	return (bool) apply_filters( 'sera_is_paperplane', $is, $post_id );
}

/**
 * Styles and scripts of the case. Called from the theme's enqueue (functions.php) only on that page.
 * GSAP and its plugins ship as local files (no CDN); every script is deferred.
 */
function sera_pp_enqueue() {
	$rel  = 'assets/cases/paperplane/';
	$base = get_template_directory_uri() . '/' . $rel;
	$dir  = get_template_directory() . '/' . $rel;
	$ver  = function ( $f ) use ( $rel ) {
		return sera_asset_ver( $rel . $f );
	};
	$js = array(
		'strategy'  => 'defer',
		'in_footer' => true,
	);

	wp_enqueue_style( 'sera-pp-micro', $base . 'micro.css', array( 'sera-main' ), $ver( 'micro.css' ) );
	wp_enqueue_style( 'sera-pp-case', $base . 'pp-case.css', array( 'sera-main', 'sera-pp-micro' ), $ver( 'pp-case.css' ) );

	$deps = array();
	foreach ( array( 'gsap', 'ScrollTrigger', 'SplitText', 'CustomEase', 'MotionPathPlugin', 'DrawSVGPlugin', 'Draggable' ) as $lib ) {
		$handle = 'sera-pp-' . strtolower( $lib );
		wp_enqueue_script( $handle, $base . 'lib/' . $lib . '.min.js', 'gsap' === $lib ? array() : array( 'sera-pp-gsap' ), $ver( 'lib/' . $lib . '.min.js' ), $js );
		$deps[] = $handle;
	}
	wp_enqueue_script( 'sera-pp-micro', $base . 'micro.js', array(), $ver( 'micro.js' ), $js );
	$deps[] = 'sera-pp-micro';
	if ( file_exists( $dir . 'aviao.js' ) ) {
		if ( file_exists( $dir . 'aviao.css' ) ) {
			wp_enqueue_style( 'sera-pp-aviao', $base . 'aviao.css', array( 'sera-pp-case' ), $ver( 'aviao.css' ) );
		}
		wp_enqueue_script( 'sera-pp-aviao', $base . 'aviao.js', array(), $ver( 'aviao.js' ), $js );
		$deps[] = 'sera-pp-aviao';
	}
	wp_enqueue_script( 'sera-pp-case', $base . 'pp-case.js', $deps, $ver( 'pp-case.js' ), $js );

	$data = sera_pp_case_data();
	wp_localize_script(
		'sera-pp-case',
		'PPCaseConfig',
		array(
			'base'   => $base,
			'ver'    => sera_asset_ver( $rel . 'pp-case.js' ),
			'telas'  => isset( $data['telas'] ) ? $data['telas'] : array(),
			'midias' => isset( $data['midias'] ) ? $data['midias'] : array(),
			'ceu'    => isset( $data['ceu'] ) ? $data['ceu'] : array(),
		)
	);
	wp_localize_script( 'sera-pp-case', 'PPCaseI18n', sera_pp_case_i18n() );
}

/**
 * Body class for the case (the theme's own case CSS/JS stay off this page).
 */
add_filter(
	'body_class',
	function ( $classes ) {
		if ( is_page() && sera_is_paperplane( get_queried_object_id() ) ) {
			$classes[] = 'is-pp';
		}
		return $classes;
	}
);
