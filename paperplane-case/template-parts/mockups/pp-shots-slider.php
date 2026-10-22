<?php
/**
 * Paperplane · product screens in code (inc/screens-pp.php, assets/css/pp-ui.css) as desktop + mobile
 * pair cards, in the same slider as the Research Hub and the Lume (assets/css/shots.css + assets/js/shots.js).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'sera_pp_shots_slider' ) ) {
	/**
	 * Slider of pair cards. shots: list of [desk, mob, title, description, desk alt, mob alt, url].
	 */
	function sera_pp_shots_slider( $args ) {
		$shots = $args['shots'];
		$total = count( $shots );
		$pad   = function ( $n ) {
			return sprintf( '%02d', $n );
		};
		$uid = 'shots-pp-' . sanitize_html_class( $args['id'] );

		$h  = '<div class="shots shots-rh shots-lm shots-pp" id="' . esc_attr( $uid ) . '" role="region" aria-roledescription="carousel" aria-label="' . esc_attr( $args['label'] ) . '">';
		$h .= '<div class="shots-track" tabindex="0" aria-label="' . esc_attr( $args['label'] . ': deslize para o lado ou use as setas do teclado' ) . '">';
		foreach ( $shots as $i => $s ) {
			$n  = $i + 1;
			$h .= '<figure class="shots-card' . ( 0 === $i ? ' is-active' : '' ) . '" role="group" aria-roledescription="slide" aria-label="' . esc_attr( $n . ' de ' . $total . ': ' . $s[2] ) . '" data-i="' . $i . '">';
			$h .= '<div class="shots-stage mk-anim">';
			$h .= '<div class="shots-bwrap"><div class="shots-browser"><div class="shots-bar" aria-hidden="true"><span class="shots-dotsw"><i></i><i></i><i></i></span><span class="shots-url">paperplane.studio/' . esc_html( $s[6] ) . '</span></div><div class="shots-page" role="img" aria-label="' . esc_attr( $s[4] ) . '"><div class="lmx-fit">' . sera_pp_desk( $s[0] ) . '</div></div></div></div>';
			$h .= '<div class="shots-phone"><div class="shots-settle">' . sera_device( 'ppx-screen', sera_pp_phone( $s[1] ), array( 'label' => $s[5] ) ) . '</div></div>';
			$h .= '</div>';
			$h .= '<figcaption class="shots-cap"><span class="shots-idx">' . $pad( $n ) . ' / ' . $pad( $total ) . '</span><span class="shots-t">' . esc_html( $s[2] ) . '</span><span class="shots-d">' . esc_html( $s[3] ) . '</span></figcaption>';
			$h .= '</figure>';
		}
		$h .= '</div>';
		$h .= '<div class="shots-nav" hidden>';
		$h .= '<button type="button" class="shots-btn shots-prev" aria-label="Tela anterior" aria-controls="' . esc_attr( $uid ) . '"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M12.5 4.5 7 10l5.5 5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
		$h .= '<div class="shots-dots">';
		foreach ( $shots as $i => $s ) {
			$h .= '<button type="button" class="shots-dot" aria-label="' . esc_attr( 'Tela ' . ( $i + 1 ) . ': ' . $s[2] ) . '"' . ( 0 === $i ? ' aria-current="true"' : '' ) . '></button>';
		}
		$h .= '</div>';
		$h .= '<span class="shots-count" aria-live="polite"><b>' . $pad( 1 ) . '</b> / ' . $pad( $total ) . '</span>';
		$h .= '<button type="button" class="shots-btn shots-next" aria-label="Próxima tela" aria-controls="' . esc_attr( $uid ) . '"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7.5 4.5 13 10l-5.5 5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
		$h .= '</div></div>';
		return $h;
	}
}
