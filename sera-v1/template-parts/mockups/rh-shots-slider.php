<?php
/**
 * Research Hub · real product screenshots (anonymised) shown as desktop + mobile pair cards in a slider.
 * Shared renderer for the rh-shots-* mockups (not a mockup itself). Styles: assets/css/shots.css; behaviour: assets/js/shots.js.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'sera_rh_shot_img' ) ) {
	/**
	 * URL of a Research Hub screenshot.
	 *
	 * @param string $file File name inside assets/img/rh/.
	 */
	function sera_rh_shot_url( $file ) {
		return esc_url( get_template_directory_uri() . '/assets/img/rh/' . $file . '?v=' . SERA_VERSION );
	}

	/**
	 * <img> of a desktop (1600×1000) or mobile (600×1298) screenshot.
	 *
	 * @param string $name  Shot name (e.g. 01-home).
	 * @param string $kind  desk|mob.
	 * @param string $alt   English alt text.
	 * @param bool   $lazy  Lazy-load.
	 */
	function sera_rh_shot_img( $name, $kind, $alt, $lazy = true ) {
		$is_desk = 'desk' === $kind;
		return '<img class="shots-img shots-img--' . esc_attr( $kind ) . '" src="' . sera_rh_shot_url( $name . '-' . $kind . '.webp' ) . '" width="' . ( $is_desk ? 1600 : 600 ) . '" height="' . ( $is_desk ? 1000 : 1298 ) . '" alt="' . esc_attr( $alt ) . '"' . ( $lazy ? ' loading="lazy"' : '' ) . ' decoding="async">';
	}

	/**
	 * Phone screen content: a strip behind the iPhone status bar painted like the top of the screenshot, then the screenshot.
	 *
	 * @param string $name Shot name.
	 * @param string $alt  Alt text.
	 * @param bool   $lazy Lazy-load.
	 */
	function sera_rh_shot_phone( $name, $alt, $lazy = true ) {
		// Colour of each screenshot's first rows, so the status bar reads as part of the app.
		$tops = array(
			'08-pick'     => '#A0A9AB',
			'09-menu'     => 'linear-gradient(90deg,#B6BFC3 12%,#FDFDFD 12%)',
			'10a-ideas'   => '#11191D',
			'10b-prioritise' => '#11191D',
			'10c-timeline' => '#11191D',
			'11-feedback' => '#B7C0C4',
		);
		$top = isset( $tops[ $name ] ) ? $tops[ $name ] : '#FDFDFD';
		return '<span class="shots-sb" style="background:' . esc_attr( $top ) . '"></span>' . sera_rh_shot_img( $name, 'mob', $alt, $lazy );
	}

	/**
	 * Slider of pair cards.
	 *
	 * @param array $args label (region label), url (browser bar), shots: list of [name, title, description, desktop alt, mobile alt].
	 */
	function sera_rh_shots_slider( $args ) {
		$shots = $args['shots'];
		$total = count( $shots );
		$pad   = function ( $n ) {
			return sprintf( '%02d', $n );
		};
		$dark  = array( '10a-ideas', '10b-prioritise', '10c-timeline' );
		$uid   = 'shots-' . sanitize_html_class( $args['id'] );

		$h  = '<div class="shots shots-rh" id="' . esc_attr( $uid ) . '" role="region" aria-roledescription="carousel" aria-label="' . esc_attr( $args['label'] ) . '">';
		$h .= '<div class="shots-track" tabindex="0" aria-label="' . esc_attr( $args['label'] . sera_t( ': scroll sideways or use the arrow keys', ': deslize para o lado ou use as setas do teclado' ) ) . '">';
		foreach ( $shots as $i => $s ) {
			$n   = $i + 1;
			$h  .= '<figure class="shots-card' . ( 0 === $i ? ' is-active' : '' ) . '" role="group" aria-roledescription="slide" aria-label="' . esc_attr( $n . sera_t( ' of ', ' de ' ) . $total . ': ' . $s[1] ) . '" data-i="' . $i . '">';
			$h  .= '<div class="shots-stage mk-anim">';
			$h  .= '<div class="shots-bwrap"><div class="shots-browser"><div class="shots-bar" aria-hidden="true"><span class="shots-dotsw"><i></i><i></i><i></i></span><span class="shots-url">' . esc_html( $args['url'] ) . '</span></div><div class="shots-page">' . sera_rh_shot_img( $s[0], 'desk', $s[3] ) . '</div></div></div>';
			$h  .= '<div class="shots-phone"><div class="shots-settle">' . sera_device( 'shots-screen', sera_rh_shot_phone( $s[0], $s[4] ), array( 'dark' => in_array( $s[0], $dark, true ), 'label' => $s[4] ) ) . '</div></div>';
			$h  .= '</div>';
			$h  .= '<figcaption class="shots-cap"><span class="shots-idx">' . $pad( $n ) . ' / ' . $pad( $total ) . '</span><span class="shots-t">' . esc_html( $s[1] ) . '</span><span class="shots-d">' . esc_html( $s[2] ) . '</span></figcaption>';
			$h  .= '</figure>';
		}
		$h .= '</div>';
		$h .= '<div class="shots-nav" hidden>';
		$h .= '<button type="button" class="shots-btn shots-prev" aria-label="' . esc_attr( sera_t( 'Previous screen', 'Tela anterior' ) ) . '" aria-controls="' . esc_attr( $uid ) . '"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M12.5 4.5 7 10l5.5 5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
		$h .= '<div class="shots-dots">';
		foreach ( $shots as $i => $s ) {
			$h .= '<button type="button" class="shots-dot" aria-label="' . esc_attr( sera_t( 'Screen ', 'Tela ' ) . ( $i + 1 ) . ': ' . $s[1] ) . '"' . ( 0 === $i ? ' aria-current="true"' : '' ) . '></button>';
		}
		$h .= '</div>';
		$h .= '<span class="shots-count" aria-live="polite"><b>' . $pad( 1 ) . '</b> / ' . $pad( $total ) . '</span>';
		$h .= '<button type="button" class="shots-btn shots-next" aria-label="' . esc_attr( sera_t( 'Next screen', 'Próxima tela' ) ) . '" aria-controls="' . esc_attr( $uid ) . '"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7.5 4.5 13 10l-5.5 5.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
		$h .= '</div></div>';
		return $h;
	}
}
