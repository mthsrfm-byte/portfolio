<?php
/**
 * Paperplane Studio · product screens in code (desktop 1280×800 + phone), rebuilt from the
 * Paperplane UI. The generated frames (storyboard, cast, locations) are drawn in SVG here,
 * so the case has no images or videos: everything on the page is code.
 * Styles: assets/css/pp-ui.css (scoped to .ppx).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/* ------------------------------------------------------------- icons */

function sera_pp_svg( $paths, $w = 1.5 ) {
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . $w . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths . '</svg>';
}

/** The Paperplane logo (paper plane). */
function sera_pp_logo() {
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" aria-hidden="true"><path d="M21.5 3 2.5 10.6l7 2.9L21.5 3Z"/><path d="m21.5 3-7.6 18-4.4-7.5"/></svg>';
}

/** The Origami assistant mark (tsuru). */
function sera_pp_tsuru( $size = 0 ) {
	$wh = $size ? ' width="' . (int) $size . '" height="' . (int) $size . '"' : '';
	return '<svg' . $wh . ' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round" aria-hidden="true"><path d="M1.2 7.6 7.6 15.6l2.6-1.1Z"/><path d="M2.2 21.5 7.6 15.6h2.6l5.4 3.4Z"/><path d="M2.2 21.5 15.6 19"/><path d="M10.2 15.6 12.7 13.3l2.9 3.9.7 3.8-2.1-1.4"/><path d="M16.3 21 18.6 13l.9-.6 3.8 3-3.6-.6-3.1 6.2"/><path d="M10.9 14.6 11.1 11 19.9 2.5l-.5 10.2"/><path d="M19.9 2.5 14.5 15"/></svg>';
}

function sera_pp_rail_icons() {
	return array(
		'idea'   => '<path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-4 10.5c.6.6 1 1.4 1 2.5h6c0-1.1.4-1.9 1-2.5A6 6 0 0 0 12 3Z"/>',
		'world'  => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3.5 3 14.5 0 18M12 3c-3 3.5-3 14.5 0 18"/>',
		'doc'    => '<path d="M6 3h9l4 4v14H6z"/><path d="M9 12h7M9 16h7M9 8h3"/>',
		'style'  => '<path d="M12 3a9 9 0 1 0 0 18c1 0 1.5-.8 1.2-1.6-.4-1 .3-2 1.3-2H17a4 4 0 0 0 4-4c0-5-4-10.4-9-10.4Z"/><circle cx="8" cy="10" r="1"/><circle cx="12" cy="7" r="1"/><circle cx="16" cy="10" r="1"/>',
		'people' => '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.4"/><path d="M16 14c2.8 0 5 2.2 5 5"/>',
		'mount'  => '<path d="M3 20 9 9l4 7 3-5 5 9z"/><circle cx="16" cy="6" r="1.6"/>',
		'shot'   => '<path d="M4 4h4M4 4v4M20 4h-4M20 4v4M4 20h4M4 20v-4M20 20h-4M20 20v-4"/><circle cx="12" cy="12" r="3"/>',
		'grid'   => '<rect x="4" y="4" width="7" height="7" rx="1"/><rect x="13" y="4" width="7" height="7" rx="1"/><rect x="4" y="13" width="7" height="7" rx="1"/><rect x="13" y="13" width="7" height="7" rx="1"/>',
		'play'   => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m10 9 5 3-5 3z"/>',
		'cut'    => '<path d="M4 7h16M4 12h10M4 17h13"/>',
	);
}

/** Shot-size pictograms used by the shot list (decupagem). */
function sera_pp_shot_icon( $k ) {
	$p = array(
		'gpg'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M4 16h16"/><path d="M12 16v-3"/><circle cx="12" cy="11.5" r="1"/>',
		'pg'    => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M10 19v-6h4v6"/><circle cx="12" cy="10" r="1.8"/>',
		'close' => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="11" r="4"/><path d="M6 19c1-3 11-3 12 0"/>',
		'ombro' => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M3 19c0-4 3-6 6-6"/><circle cx="16" cy="10" r="2.2"/><path d="M13 19v-3c0-2 6-2 6 0v3"/>',
		'medio' => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="9.5" r="2.4"/><path d="M7 19c0-4 10-4 10 0"/>',
		'ppp'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="12" r="6"/><circle cx="10" cy="11" r=".6"/><circle cx="14" cy="11" r=".6"/>',
		'det'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="12" r="3.5"/><path d="M14.5 14.5 18 18"/>',
		'sub'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M5 12c2-3 5-4 7-4s5 1 7 4c-2 3-5 4-7 4s-5-1-7-4Z"/><circle cx="12" cy="12" r="1.6"/>',
	);
	return isset( $p[ $k ] ) ? '<span class="ppx-ico"><svg viewBox="0 0 24 24" aria-hidden="true">' . $p[ $k ] . '</svg></span>' : '';
}

/* ------------------------------------------------------------- frames drawn in code */

/**
 * Rain: thin slanted strokes inside a box, deterministic (same drawing on every render).
 */
function sera_pp_rain( $x, $y, $w, $h, $n, $color = '#6F7E86', $op = '.5' ) {
	$s = '<g stroke="' . $color . '" stroke-width=".5" stroke-linecap="round" opacity="' . $op . '">';
	for ( $i = 0; $i < $n; $i++ ) {
		$px = $x + fmod( abs( sin( $i * 12.9898 ) * 437.58 ), $w );
		$py = $y + fmod( abs( sin( $i * 78.233 ) * 943.17 ), max( 1, $h - 6 ) );
		$s .= sprintf( '<path d="M%.1f %.1fl-1.6 5"/>', $px, $py );
	}
	return $s . '</g>';
}

/**
 * A character as a bust, drawn in a 40×46 box (head centred at 20,16).
 */
function sera_pp_bust( $who, $tx = 0, $ty = 0, $sc = 1, $mood = '' ) {
	$c = array(
		'lia'   => array( '#D8B08C', '#2A1E1A', '#8C9096', '#EDE4D0' ),
		'dante' => array( '#C99A78', '#15161B', '#1E2230', '#D9D4C8' ),
		'hana'  => array( '#E0BC98', '#3A2A22', '#2B3446', '#EDE4D0' ),
		'ren'   => array( '#D2A47E', '#121318', '#6F7E86', '#2B3446' ),
		'okabe' => array( '#CFA27E', '#9AA0A6', '#1E2A3A', '#C6A06A' ),
		'bilh'  => array( '#C99A78', '#3B2A22', '#6F2E2E', '#EDE4D0' ),
	);
	list( $skin, $hair, $top, $in ) = $c[ $who ];
	$g  = sprintf( '<g transform="translate(%s %s) scale(%s)">', $tx, $ty, $sc );
	$g .= '<path d="M3 46C3 35 9 30 20 30s17 5 17 16Z" fill="' . $top . '"/>';
	$g .= '<path d="M15.5 30.5 20 38l4.5-7.5Z" fill="' . $in . '"/>';
	$g .= '<rect x="17" y="22" width="6" height="9" rx="2" fill="' . $skin . '" opacity=".85"/>';
	// hair behind the head
	if ( 'hana' === $who ) {
		$g .= '<path d="M11 15c0-8 18-8 18 0l1.5 14c-2 1-4 0-4.5-3h-12c-.5 3-2.5 4-4.5 3Z" fill="' . $hair . '"/>';
	} elseif ( 'lia' === $who ) {
		$g .= '<circle cx="20" cy="5.5" r="4" fill="' . $hair . '"/>';
	}
	$g .= '<ellipse cx="20" cy="16" rx="7.4" ry="9" fill="' . $skin . '"/>';
	// hair on top
	switch ( $who ) {
		case 'lia':
			$g .= '<path d="M12.4 15c-.4-6.5 3.4-9.6 7.6-9.6s8 3.1 7.6 9.6c-1.2-3.4-3.8-5.2-7.6-5.2s-6.4 1.8-7.6 5.2Z" fill="' . $hair . '"/>';
			break;
		case 'dante':
			$g .= '<path d="M12.6 13.6c0-5.2 3.2-7.4 7.4-7.4s7.4 2.2 7.4 7.4c-1.4-2.2-4-3.1-7.4-3.1s-6 .9-7.4 3.1Z" fill="' . $hair . '"/>';
			$g .= '<path d="M18.5 30.5h3l.6 7-2.1 2.5-2.1-2.5Z" fill="#6F2E2E"/>';
			break;
		case 'hana':
			$g .= '<path d="M12.4 16c-.6-6.6 3.4-10 7.6-10s8.2 3.4 7.6 10c-2-3-4.4-4.4-6.6-4.6-1 1.6-4.4 3.4-8.6 4.6Z" fill="' . $hair . '"/>';
			break;
		case 'ren':
			$g .= '<path d="M12 14c-1-6 3-9.5 8-9.5s9 3 8 9.5l-1.6-2.4-1.2 2-1.6-2.6-1.6 2.2-1.6-2.4-1.6 2.4-1.6-2.2-1.6 2.6-1.2-2Z" fill="' . $hair . '"/>';
			$g .= '<path d="M11.6 15.5a8.4 8.4 0 0 1 16.8 0" fill="none" stroke="#C6A06A" stroke-width="1.4"/><rect x="10.4" y="14.5" width="2.6" height="5" rx="1.2" fill="#C6A06A"/>';
			break;
		case 'okabe':
			$g .= '<path d="M12.4 15.5c-.4-4 1.2-6.4 3-7.4h9.2c1.8 1 3.4 3.4 3 7.4l-1.4-3H13.8Z" fill="' . $hair . '"/>';
			$g .= '<path d="M11.4 9.4c1.4-3.6 4.8-5.2 8.6-5.2s7.2 1.6 8.6 5.2Z" fill="#1E2A3A"/><rect x="10" y="8.6" width="20" height="2" rx="1" fill="#14202E"/>';
			break;
		case 'bilh':
			$g .= '<path d="M11.4 10c1.4-3.6 4.8-5.2 8.6-5.2s7.2 1.6 8.6 5.2Z" fill="#6F2E2E"/><rect x="10.4" y="9.2" width="19.2" height="2" rx="1" fill="#4A1E1E"/>';
			$g .= '<path d="M16.4 20.2c1.2-.8 2.4-.8 3.6 0 1.2-.8 2.4-.8 3.6 0-1.2 1.4-2.4 1.4-3.6.4-1.2 1-2.4 1-3.6-.4Z" fill="' . $hair . '"/>';
			break;
	}
	// face
	if ( 'wide' === $mood ) {
		$g .= '<ellipse cx="17.2" cy="16.6" rx="1.4" ry="1.1" fill="#F4EEE4"/><ellipse cx="22.8" cy="16.6" rx="1.4" ry="1.1" fill="#F4EEE4"/><circle cx="17.2" cy="16.7" r=".6" fill="#16161A"/><circle cx="22.8" cy="16.7" r=".6" fill="#16161A"/><path d="M15.6 14.2c.8-.6 1.8-.7 2.8-.4M21.6 13.8c1-.3 2-.2 2.8.4" stroke="#2A1E1A" stroke-width=".55" fill="none" stroke-linecap="round"/><ellipse cx="20" cy="21.6" rx="1" ry=".8" fill="#7A3E3A"/>';
	} else {
		$g .= '<circle cx="17.2" cy="16.8" r=".75" fill="#16161A"/><circle cx="22.8" cy="16.8" r=".75" fill="#16161A"/><path d="M18.6 21.4c.9.4 1.9.4 2.8 0" stroke="#7A3E3A" stroke-width=".6" fill="none" stroke-linecap="round"/>';
	}
	// shade on one side of the face (key light from the window)
	$g .= '<path d="M20 7c4.1 0 7.4 4 7.4 9s-3.3 9-7.4 9c2.2-2.6 3-5.6 3-9s-.8-6.4-3-9Z" fill="#0E0E13" opacity=".12"/>';
	if ( 'lia' === $who ) {
		$g .= '<path d="M13 38h14v8H13Z" fill="#EDE4D0" opacity=".9"/>';
	}
	return $g . '</g>';
}

/** A night window of the train with rain, at x,y. */
function sera_pp_window( $x, $y, $w = 44, $h = 30 ) {
	return sprintf( '<rect x="%1$s" y="%2$s" width="%3$s" height="%4$s" rx="5" fill="#121A26"/><rect x="%1$s" y="%2$s" width="%3$s" height="%4$s" rx="5" fill="none" stroke="#495B74" stroke-width="1.2"/><path d="M%5$s %2$sl10 %4$s" stroke="#F4EEE4" stroke-width="5" opacity=".04"/>', $x, $y, $w, $h, $x + 8 ) . sera_pp_rain( $x + 3, $y + 2, $w - 6, $h - 2, (int) ( $w * .5 ), '#6F7E86', '.6' );
}

function sera_pp_sconce( $x, $y ) {
	return sprintf( '<circle cx="%1$s" cy="%2$s" r="11" fill="#C6A06A" opacity=".1"/><circle cx="%1$s" cy="%2$s" r="5" fill="#C6A06A" opacity=".22"/><circle cx="%1$s" cy="%2$s" r="1.8" fill="#F2D49A"/>', $x, $y );
}

/**
 * A frame of the episode “A estação sem nome”, drawn in SVG (16:9).
 *
 * @param string $k     Scene key.
 * @param string $style Inline style for the frame box.
 */
function sera_pp_frame( $k, $style = '' ) {
	$s = '';
	switch ( $k ) {
		case 'vagao': // the dining car, empty
			$s .= '<rect width="160" height="90" fill="#2B3446"/><rect width="160" height="11" fill="#1B2330"/><rect y="11" width="160" height="1.6" fill="#C6A06A" opacity=".35"/>';
			foreach ( array( 6, 58, 110 ) as $x ) {
				$s .= sera_pp_window( $x, 18 );
				$s .= sprintf( '<rect x="%s" y="46" width="6" height="32" rx="2" fill="#495B74"/><rect x="%s" y="46" width="6" height="32" rx="2" fill="#495B74"/>', $x - 4, $x + 42 );
				$s .= sprintf( '<path d="M%s 60h46l3 4H%sz" fill="#8A8E6E"/><rect x="%s" y="64" width="4" height="14" fill="#1B2330"/>', $x - 1, $x - 4, $x + 20 );
			}
			$s .= sera_pp_sconce( 54, 24 ) . sera_pp_sconce( 106, 24 );
			$s .= '<rect y="78" width="160" height="12" fill="#141B26"/>';
			break;

		case 'plataforma': // the platform under the flickering lamp
			$s .= '<rect width="160" height="90" fill="#1B2330"/><path d="M0 0h160v9L0 17Z" fill="#0E0E13"/>';
			$s .= '<path d="M0 56 160 50v40H0Z" fill="#2B3446"/><path d="M0 56 160 50v2L0 58.4Z" fill="#C6A06A" opacity=".75"/>';
			$s .= '<path d="M0 66 160 60" stroke="#495B74" stroke-width=".6"/><path d="M0 74 160 68" stroke="#495B74" stroke-width=".6"/>';
			$s .= '<path d="M119 20 98 74h44Z" fill="#C6A06A" opacity=".16"/><rect x="118" y="14" width="2.2" height="42" fill="#495B74"/><rect x="113" y="14" width="12" height="3" rx="1.5" fill="#6F7E86"/><circle cx="119" cy="19" r="2.4" fill="#F2D49A"/>';
			$s .= '<rect x="132" y="44" width="20" height="2.4" rx="1" fill="#6F7E86"/><rect x="134" y="46" width="1.6" height="7" fill="#495B74"/><rect x="148" y="46" width="1.6" height="7" fill="#495B74"/>';
			$s .= sera_pp_rain( 0, 14, 160, 50, 70, '#6F7E86', '.45' );
			break;

		case 'hana-plat': // Hana waits on the platform
			$s .= sera_pp_frame_svg( 'plataforma' );
			$s .= '<g transform="translate(58 26)"><path d="M6 48 7.5 22h9L18 48h-3.2L12 30l-2.8 18Z" fill="#141A24"/><rect x="5.4" y="12" width="13" height="13" rx="4" fill="#2B3446"/><circle cx="12" cy="7" r="5" fill="#E0BC98"/><path d="M7 8c0-6 10-6 10 0l.6 6c-1 .6-2 0-2.2-1.6H8.6C8.4 14 7.4 14.6 6.4 14Z" fill="#3A2A22"/><rect x="17" y="13" width="5" height="9" rx="2" fill="#495B74"/></g>';
			break;

		case 'tunel': // tracks into the tunnel
			$s .= '<rect width="160" height="90" fill="#2B3446"/><path d="M0 0h160v20H0Z" fill="#1B2330"/>';
			$s .= '<path d="M38 90V44a42 36 0 0 1 84 0v46Z" fill="#0E0E13"/><path d="M38 90V44a42 36 0 0 1 84 0" fill="none" stroke="#495B74" stroke-width="2"/>';
			$s .= '<ellipse cx="80" cy="52" rx="9" ry="6" fill="#C6A06A" opacity=".35"/><ellipse cx="80" cy="52" rx="3.4" ry="2.4" fill="#F2D49A" opacity=".8"/>';
			$s .= '<path d="M16 90 76 56M144 90 84 56" stroke="#6F7E86" stroke-width="1.4"/>';
			foreach ( array( 86, 78, 71, 65, 61 ) as $i => $y ) {
				$hw = 52 - $i * 10;
				$s .= sprintf( '<path d="M%s %sh%s" stroke="#495B74" stroke-width="%s"/>', 80 - $hw, $y, 2 * $hw, 1.6 - $i * .25 );
			}
			$s .= sera_pp_rain( 0, 0, 36, 90, 16, '#6F7E86', '.4' ) . sera_pp_rain( 124, 0, 36, 90, 16, '#6F7E86', '.4' );
			break;

		case 'relogio': // 3A · Lia looks at the stopped watch · medium shot
			$s .= '<rect width="160" height="90" fill="#2B3446"/>' . sera_pp_window( 92, 12, 60, 40 ) . sera_pp_sconce( 76, 18 );
			$s .= sera_pp_bust( 'lia', 30, 18, 1.55 );
			$s .= '<g transform="translate(86 60)"><circle r="8" fill="#C6A06A"/><circle r="6.2" fill="#EDE4D0"/><path d="M0 0V-4.4M0 0l3 1.6" stroke="#1B2330" stroke-width=".9" stroke-linecap="round"/><rect x="-1.4" y="-10.4" width="2.8" height="2.6" rx=".8" fill="#C6A06A"/></g>';
			$s .= '<path d="M70 72c6-6 10-10 16-12" stroke="#D8B08C" stroke-width="4.6" stroke-linecap="round" fill="none"/>';
			$s .= '<rect y="80" width="160" height="10" fill="#8A8E6E"/>';
			break;

		case 'close': // 3B · close on Lia, frightened
			$s .= '<rect width="160" height="90" fill="#495B74"/><rect x="104" width="56" height="90" fill="#2B3446"/>' . sera_pp_rain( 106, 0, 52, 90, 26, '#6F7E86', '.5' );
			$s .= sera_pp_bust( 'lia', 42, 2, 2.05, 'wide' );
			break;

		case 'ombro': // 3C · Dante pushes the ticket · over the shoulder
			$s .= '<rect width="160" height="90" fill="#2B3446"/>' . sera_pp_window( 74, 10, 64, 36 ) . sera_pp_sconce( 60, 16 );
			$s .= sera_pp_bust( 'lia', 82, 22, 1.3 );
			$s .= '<path d="M0 70h160v20H0Z" fill="#8A8E6E"/><path d="M68 76 84 73l3 4-16 3Z" fill="#EDE4D0"/><path d="M71 76.6h9" stroke="#8A8E6E" stroke-width=".5"/>';
			$s .= '<path d="M-6 90C-6 64 6 52 28 52c10 0 18 4 22 10 6 8 8 18 8 28Z" fill="#14161E"/><ellipse cx="26" cy="38" rx="15" ry="18" fill="#14161E"/><path d="M14 30c2-8 8-12 13-12 7 0 12 5 13 12-4-3-8-5-13-5s-9 2-13 5Z" fill="#0B0C10"/>';
			break;

		case 'freio': // 3D · the train brakes · wide shot
			$s .= '<rect width="160" height="90" fill="#121A26"/><rect y="66" width="160" height="24" fill="#0E0E13"/>';
			$s .= '<g stroke="#495B74" stroke-width=".8" opacity=".8"><path d="M0 22h40M10 30h28M2 60h30M120 26h40M128 58h32"/></g>';
			$s .= '<rect x="22" y="30" width="122" height="34" rx="6" fill="#2B3446"/><rect x="22" y="56" width="122" height="4" fill="#1B2330"/>';
			foreach ( array( 30, 52, 74, 96, 118 ) as $x ) {
				$s .= sprintf( '<rect x="%s" y="36" width="16" height="12" rx="2" fill="#C6A06A" opacity=".85"/>', $x );
			}
			$s .= '<circle cx="44" cy="64" r="5" fill="#1B2330"/><circle cx="122" cy="64" r="5" fill="#1B2330"/>';
			$s .= '<g fill="#F7FF9E"><circle cx="50" cy="67" r=".9"/><circle cx="53" cy="65.6" r=".6"/><circle cx="55" cy="68" r=".7"/><circle cx="128" cy="67" r=".9"/><circle cx="131" cy="65.4" r=".6"/></g>';
			$s .= '<path d="M0 69h160" stroke="#6F7E86" stroke-width="1"/>';
			break;

		case 'xicara': // 3E · the cup shakes on the table · detail
			$s .= '<rect width="160" height="90" fill="#2B3446"/><path d="M0 44h160v46H0Z" fill="#8A8E6E"/>';
			$s .= '<ellipse cx="80" cy="70" rx="30" ry="7" fill="#6F7E86" opacity=".55"/><ellipse cx="80" cy="68" rx="26" ry="5.6" fill="#EDE4D0"/>';
			$s .= '<path d="M62 40h36l-4 26H66Z" fill="#EDE4D0"/><ellipse cx="80" cy="40" rx="18" ry="4" fill="#E2D8C2"/><ellipse cx="80" cy="40.6" rx="15.6" ry="3" fill="#5A3A24"/><path d="M98 45c8 0 8 13-1 13" stroke="#EDE4D0" stroke-width="3" fill="none"/>';
			$s .= '<g stroke="#F4EEE4" stroke-width=".7" fill="none" opacity=".6"><path d="M54 40c-3 6-3 14 0 20M48 38c-4 8-4 18 0 26M106 40c3 6 3 14 0 20M112 38c4 8 4 18 0 26"/></g>';
			break;

		case 'mesa': // 3F · Lia thrown against Dante · medium
			$s .= '<rect width="160" height="90" fill="#2B3446"/>' . sera_pp_window( 48, 8, 64, 34 ) . sera_pp_sconce( 30, 16 ) . sera_pp_sconce( 130, 16 );
			$s .= sera_pp_bust( 'dante', 38, 22, 1.4 ) . sera_pp_bust( 'lia', 70, 26, 1.32, 'wide' );
			$s .= '<path d="M0 74h160v16H0Z" fill="#8A8E6E"/>';
			$s .= '<g stroke="#F4EEE4" stroke-width=".8" opacity=".5"><path d="M118 40h20M122 46h16M120 52h14"/></g>';
			break;

		case 'estilo-a':
			$s .= sera_pp_frame_svg( 'vagao' );
			break;
		case 'estilo-b': // neon street
			$s .= '<rect width="160" height="90" fill="#1B2330"/><rect x="10" y="20" width="40" height="70" fill="#2B3446"/><rect x="60" y="8" width="36" height="82" fill="#232B3A"/><rect x="106" y="26" width="46" height="64" fill="#2B3446"/>';
			$s .= '<rect x="16" y="30" width="22" height="6" rx="2" fill="#C6A06A"/><rect x="66" y="22" width="24" height="4" rx="2" fill="#8A8E6E"/><rect x="112" y="36" width="30" height="5" rx="2" fill="#C6A06A" opacity=".8"/>';
			$s .= '<path d="M0 82h160v8H0Z" fill="#0E0E13"/><path d="M0 84h160" stroke="#C6A06A" stroke-width=".6" opacity=".5"/>' . sera_pp_rain( 0, 0, 160, 80, 50, '#6F7E86', '.4' );
			break;
		case 'estilo-c': // car at night
			$s .= '<rect width="160" height="90" fill="#121A26"/><path d="M0 64h160v26H0Z" fill="#1B2330"/><path d="M30 62c4-12 14-18 26-18h40c12 0 20 6 26 18Z" fill="#2B3446"/><rect x="24" y="60" width="112" height="12" rx="5" fill="#495B74"/><circle cx="48" cy="73" r="6" fill="#0E0E13"/><circle cx="112" cy="73" r="6" fill="#0E0E13"/><rect x="128" y="62" width="8" height="3" rx="1.5" fill="#F2D49A"/><path d="M136 63 160 58v10Z" fill="#F2D49A" opacity=".18"/>';
			break;
		case 'estilo-d': // anime-like sky
			$s .= '<rect width="160" height="90" fill="#495B74"/><circle cx="118" cy="26" r="12" fill="#EDE4D0" opacity=".85"/><path d="M0 60c30-10 60-6 90 0s50 4 70-2v32H0Z" fill="#2B3446"/><path d="M0 72c40-8 80-4 160 0v18H0Z" fill="#1B2330"/>';
			break;
	}
	return '<div class="ppx-img"' . ( $style ? ' style="' . esc_attr( $style ) . '"' : '' ) . '><svg class="ppx-art" viewBox="0 0 160 90" preserveAspectRatio="xMidYMid slice" aria-hidden="true">' . $s . '</svg></div>';
}

/** Raw SVG content of a scene (to layer a figure on top of a location). */
function sera_pp_frame_svg( $k ) {
	$h = sera_pp_frame( $k );
	return preg_replace( '#^.*?<svg[^>]*>|</svg></div>$#s', '', $h );
}

/**
 * Hana's character sheet: front, three quarters, profile and back (60×120 each).
 */
function sera_pp_sheet_view( $v ) {
	$skin = '#E0BC98';
	$hair = '#3A2A22';
	$jk   = '#2B3446';
	$s    = '<rect width="60" height="120" fill="#DCDDDC"/><ellipse cx="30" cy="112" rx="16" ry="2.4" fill="#0E0E13" opacity=".12"/>';
	$legs = '<path d="M20 64 21.6 106h7.2L30 74l1.2 32h7.2L40 64Z" fill="#495B74"/><rect x="20.4" y="105" width="8.8" height="4" rx="1.6" fill="#15161B"/><rect x="31" y="105" width="8.8" height="4" rx="1.6" fill="#15161B"/>';
	switch ( $v ) {
		case 'front':
			$s .= $legs;
			$s .= '<path d="M17 36c0-4 6-6 13-6s13 2 13 6l1.4 28H15.6Z" fill="' . $jk . '"/><path d="M26 30.4 30 41l4-10.6Z" fill="#EDE4D0"/>';
			$s .= '<path d="M17 37 12.4 62l3.6 1 4.4-21Z" fill="' . $jk . '"/><path d="M43 37l4.6 25-3.6 1-4.4-21Z" fill="' . $jk . '"/><circle cx="14" cy="64" r="2.4" fill="' . $skin . '"/><circle cx="46" cy="64" r="2.4" fill="' . $skin . '"/>';
			$s .= '<path d="M20.6 17c0-9 18.8-9 18.8 0l1.6 14c-2.2 1-4.4 0-4.8-3H23.8c-.4 3-2.6 4-4.8 3Z" fill="' . $hair . '"/>';
			$s .= '<rect x="27.4" y="25" width="5.2" height="6" rx="2" fill="' . $skin . '"/><ellipse cx="30" cy="18" rx="7.6" ry="9.2" fill="' . $skin . '"/>';
			$s .= '<path d="M22.4 18c-.6-6.8 3.4-10.2 7.6-10.2s8.2 3.4 7.6 10.2c-2-3-4.4-4.6-6.6-4.8-1 1.6-4.4 3.4-8.6 4.8Z" fill="' . $hair . '"/>';
			$s .= '<circle cx="27.2" cy="19" r=".8" fill="#16161A"/><circle cx="32.8" cy="19" r=".8" fill="#16161A"/><path d="M28.6 23.4c.9.4 1.9.4 2.8 0" stroke="#7A3E3A" stroke-width=".6" fill="none" stroke-linecap="round"/>';
			break;
		case 'tq':
			$s .= $legs;
			$s .= '<path d="M19 36c0-4 5-6 11.4-6S42 32 42 36l1 28H17.6Z" fill="' . $jk . '"/><path d="M29 30.4 32 40l3-9.6Z" fill="#EDE4D0"/>';
			$s .= '<path d="M41.6 37l4 25-3.6 1-3.8-21Z" fill="' . $jk . '"/><circle cx="44" cy="64" r="2.4" fill="' . $skin . '"/><path d="M19.4 38 17 61l3 .8 2.4-20Z" fill="#232B3A"/>';
			$s .= '<path d="M21 17c0-9 19-9 19 0l.4 14c-2 .8-3.6-.4-4-3H24c-.8 2.4-2.4 3.6-4.2 3Z" fill="' . $hair . '"/>';
			$s .= '<rect x="29" y="25" width="5.2" height="6" rx="2" fill="' . $skin . '"/><ellipse cx="31.4" cy="18" rx="7" ry="9.2" fill="' . $skin . '"/><path d="M38 19.4l1.6 1.4-1.6.6Z" fill="' . $skin . '"/>';
			$s .= '<path d="M23.6 18.6c-.8-7 3.4-10.8 7.8-10.8s8.4 3.6 7.6 10.4c-2-3-4-4.6-6-4.6-1.4 1.8-5 3.6-9.4 5Z" fill="' . $hair . '"/>';
			$s .= '<circle cx="31" cy="19" r=".8" fill="#16161A"/><circle cx="35.8" cy="19" r=".75" fill="#16161A"/><path d="M32.6 23.4c.8.4 1.6.4 2.4 0" stroke="#7A3E3A" stroke-width=".6" fill="none" stroke-linecap="round"/>';
			break;
		case 'side':
			$s .= '<path d="M25 64 26 106h7l1-42Z" fill="#495B74"/><rect x="25.4" y="105" width="11" height="4" rx="1.6" fill="#15161B"/>';
			$s .= '<path d="M23 36c0-4 3-6 7-6s7 2 7.4 6l.6 28H22.4Z" fill="' . $jk . '"/><path d="M27.4 37 26.4 62l3.6.6 1-24Z" fill="#232B3A"/><circle cx="28.4" cy="64" r="2.4" fill="' . $skin . '"/>';
			$s .= '<path d="M22 17c0-9 16-10 16-1l-6 0 .4 15c-2.4.4-4-.8-4.6-3h-5.6c-.6 1.4-1.4 2-2.4 2Z" fill="' . $hair . '"/>';
			$s .= '<rect x="29.4" y="25" width="5" height="6" rx="2" fill="' . $skin . '"/><path d="M27 10c6 0 10.4 3.6 10.4 8.4l1.8 2.6-1.8.6c0 4.2-3 6.6-7 6.6-3 0-4.4-2-4.4-2Z" fill="' . $skin . '"/>';
			$s .= '<path d="M24.4 18c0-7 3.6-10.2 8-10.2 4 0 6.4 2.6 6.6 6.4-2.6-1.6-5.2-2.2-8-2-1 2.2-3.6 4.4-6.6 5.8Z" fill="' . $hair . '"/><circle cx="35" cy="19" r=".8" fill="#16161A"/>';
			break;
		case 'back':
			$s .= $legs;
			$s .= '<path d="M17 36c0-4 6-6 13-6s13 2 13 6l1.4 28H15.6Z" fill="' . $jk . '"/><path d="M30 31v32" stroke="#232B3A" stroke-width=".8"/>';
			$s .= '<path d="M17 37 12.4 62l3.6 1 4.4-21Z" fill="' . $jk . '"/><path d="M43 37l4.6 25-3.6 1-4.4-21Z" fill="' . $jk . '"/><circle cx="14" cy="64" r="2.4" fill="' . $skin . '"/><circle cx="46" cy="64" r="2.4" fill="' . $skin . '"/>';
			$s .= '<path d="M20.6 17c0-11 18.8-11 18.8 0l1.6 14c-3 1.4-6.6 1.4-11 1.4s-8-.2-11-1.4Z" fill="' . $hair . '"/><path d="M30 9v21" stroke="#2A1E18" stroke-width=".5" opacity=".6"/>';
			break;
	}
	return '<svg class="ppx-art" viewBox="0 0 60 120" preserveAspectRatio="xMidYMid meet" aria-hidden="true">' . $s . '</svg>';
}

/** A cast portrait (bust on the sheet's grey), for the cast grid. */
function sera_pp_portrait( $who, $style = '' ) {
	return '<div class="ppx-img is-sheet"' . ( $style ? ' style="' . esc_attr( $style ) . '"' : '' ) . '><svg class="ppx-art" viewBox="0 0 40 46" preserveAspectRatio="xMidYMax slice" aria-hidden="true"><rect width="40" height="46" fill="#DCDDDC"/>' . sera_pp_bust( $who, 2, 4, .9 ) . '</svg></div>';
}

/* ------------------------------------------------------------- desktop shell */

function sera_pp_shell( $active, $done, $inner, $args = array() ) {
	$args  = wp_parse_args( $args, array( 'dots' => false, 'pad' => true, 'ori' => true ) );
	$order = array( 'idea', 'world', 'doc', '|', 'style', 'people', 'mount', 'shot', 'grid', '|', 'play', 'cut' );
	$ic    = sera_pp_rail_icons();
	$rail  = '';
	foreach ( $order as $k ) {
		if ( '|' === $k ) {
			$rail .= '<div class="gap"></div>';
			continue;
		}
		$cls   = 'ic' . ( $k === $active ? ' on' : '' ) . ( in_array( $k, $done, true ) ? ' ok' : '' );
		$rail .= '<div class="' . $cls . '">' . sera_pp_svg( $ic[ $k ] ) . '</div>';
	}
	$main_cls = 'ppx-main' . ( $args['dots'] ? ' ppx-dots' : '' ) . ( $args['pad'] ? '' : ' is-flush' );
	$ori      = $args['ori'] ? '<div class="ppx-ori"><i>' . sera_pp_tsuru() . '</i>Origami</div>' : '';
	return '<div class="ppx ppx-desk"><div class="ppx-app"><div class="ppx-rail"><div class="lg">' . sera_pp_logo() . '</div>' . $rail . '<div class="cred">21</div></div><div class="' . $main_cls . '">' . $inner . $ori . '</div></div></div>';
}

function sera_pp_head( $step, $title, $sub, $btn = '', $extra = '' ) {
	return '<div class="ppx-h"><div><div class="ppx-step">' . esc_html( $step ) . '</div><div class="ppx-title">' . $title . '</div><div class="ppx-sub">' . esc_html( $sub ) . '</div></div><div class="ppx-h-act">' . $extra . ( $btn ? '<span class="ppx-btn">' . esc_html( $btn ) . ' →</span>' : '' ) . '</div></div>';
}

function sera_pp_wave( $n, $seed = 1 ) {
	$h = '';
	for ( $i = 0; $i < $n; $i++ ) {
		$h .= '<b style="height:' . round( 20 + abs( sin( ( $i + $seed ) * 1.7 ) * 60 + sin( ( $i + $seed ) * .6 ) * 20 ) ) . '%"></b>';
	}
	return '<div class="ppx-wave">' . $h . '</div>';
}

/**
 * Desktop screens (1280×800).
 *
 * @param string $id Screen id.
 */
function sera_pp_desk( $id ) {
	$all  = array( 'idea', 'world', 'doc', 'style', 'people', 'mount', 'shot', 'grid', 'play', 'cut' );
	$done = function ( $k ) use ( $all ) {
		return array_slice( $all, 0, array_search( $k, $all, true ) );
	};
	$ts12 = sera_pp_tsuru( 12 );

	switch ( $id ) {
		case 'ideia':
			$in  = sera_pp_head( 'Passo 1 de 10 · Escrever', 'Qual é a história?', 'Comece pela ideia. Título, duração e formato aparecem no caminho, conforme o roteiro cresce.', 'Próximo: universo' );
			$in .= '<div class="ppx-card" style="margin-top:26px;width:860px"><div class="ppx-lbl" style="margin-bottom:10px">A ideia em uma frase</div><div style="font-size:19px;line-height:1.45;min-height:56px"><span class="ppx-typed">Uma garçonete de trem noturno descobre que o passageiro da mesa 4 sabe exatamente como ela vai morrer.</span><span class="ppx-caret"></span></div></div>';
			$in .= '<div class="ppx-card" style="margin-top:14px;width:860px"><div style="display:flex;justify-content:space-between;align-items:center"><div class="ppx-lbl">Título</div><span class="ppx-chip on">' . $ts12 . ' Pedir sugestões</span></div><div class="ppx-input" style="margin-top:10px">A estação sem nome</div></div>';
			$in .= '<div class="ppx-note" style="margin-top:14px;width:860px"><span class="ppx-tag">Duração</span>&nbsp; Hoje o episódio tem 2:23, somando 8 cenas. Ela muda sozinha quando você adiciona ou corta cenas.</div>';
			$in .= '<div style="margin-top:14px;width:860px;display:grid;grid-template-columns:repeat(3,1fr);gap:10px">';
			foreach ( array( array( 'Formato', 'Série · 16:9' ), array( 'Episódios', '1 de 6' ), array( 'Público', 'Adulto · drama' ) ) as $r ) {
				$in .= '<div class="ppx-card" style="padding:12px 14px"><div class="ppx-lbl">' . $r[0] . '</div><div style="font-size:15px;margin-top:4px">' . $r[1] . '</div></div>';
			}
			$in .= '</div>';
			return sera_pp_shell( 'idea', array(), $in );

		case 'universo':
			$in  = sera_pp_head( 'Passo 2 de 10 · Escrever', 'O universo da série', 'O que é verdade nesse mundo: lugar, tom, personagens e regras. O Origami consulta esta página antes de escrever qualquer coisa.', 'Próximo: roteiro' );
			$in .= '<div style="display:grid;grid-template-columns:640px 330px;gap:16px;margin-top:22px"><div style="display:flex;flex-direction:column;gap:14px">';
			$in .= '<div class="ppx-card"><div style="font-size:17px;margin-bottom:8px">O mundo</div><div style="color:var(--p-ink-2)">Um trem noturno que cruza o interior sem nunca parar na mesma estação duas vezes. Quem embarca não lembra de ter comprado o bilhete. A equipe de bordo envelhece normalmente; os passageiros, não.</div></div>';
			$in .= '<div class="ppx-card"><div style="font-size:17px;margin-bottom:10px">Tom</div><div style="display:flex;gap:6px"><span class="ppx-chip on">Melancólico ×</span><span class="ppx-chip on">Tenso ×</span><span class="ppx-chip on">Silencioso ×</span><span class="ppx-chip">+ Adicionar</span></div></div>';
			$in .= '<div class="ppx-card"><div style="font-size:17px;margin-bottom:8px">Regras que nunca mudam</div><div style="color:var(--p-ink-2);line-height:1.8">• Sempre é noite do lado de fora, mesmo quando o relógio diz o contrário.<br>• O relógio do pai da Lia é o único objeto que funciona certo no trem.<br>• Ninguém fala o nome da próxima estação.</div></div>';
			$in .= '</div><div class="ppx-card" style="display:flex;flex-direction:column;gap:10px"><div style="font-size:17px">Perguntas em aberto</div><div style="font-size:11.5px;color:var(--p-muted)">O Origami achou pontos que a história ainda não explica.</div>';
			foreach ( array( 'Por que só a Lia percebe que os passageiros não envelhecem?', 'O que acontece com quem desce do trem?', 'Dante está ajudando a Lia ou prendendo ela ali?' ) as $q ) {
				$in .= '<div class="ppx-soft"><div style="font-weight:500">' . $q . '</div><div style="font-size:11px;color:var(--p-muted);margin-top:4px">Sugestão do Origami pronta para virar regra.</div><span class="ppx-chip" style="margin-top:8px">Virar regra</span></div>';
			}
			$in .= '</div></div>';
			return sera_pp_shell( 'world', $done( 'world' ), $in );

		case 'roteiro':
			$in  = sera_pp_head( 'Passo 3 de 10 · Escrever', 'Roteiro', 'Escreva cena por cena. Para pedir ajuda, use o Origami ao lado: ele sugere, você aceita ou não.' );
			$in .= '<div style="display:flex;gap:6px;margin-top:16px;align-items:center"><span class="ppx-chip">‹</span><span class="ppx-chip">Cena 3 de 8 · <b style="font-weight:500">Mesa 4</b></span><span class="ppx-chip">›</span><span class="ppx-mono" style="margin-left:auto">8 cenas · 2:23</span><span class="ppx-chip">+ Cena</span></div>';
			$in .= '<div style="display:flex;gap:16px;margin-top:12px"><div class="ppx-card ppx-script" style="width:700px;height:520px;padding:28px 40px"><div class="ppx-lbl">Cena 3 · 0:24</div><div style="font-family:var(--p-sans);font-size:20px;margin:4px 0 18px">Mesa 4</div>INT. VAGÃO-RESTAURANTE — NOITE<br><br>O vagão balança vazio. Copos tilintam nas mesas. LIA (28) entra, o casaco molhado de chuva.<br><br><span class="hl">Ela senta perto da janela. Do outro lado, DANTE (34) já estava ali.</span><br><br><div style="text-align:center">DANTE</div><div style="margin:0 120px">Você não devia estar aqui.</div><br>Ele empurra um bilhete amassado sobre a mesa.<br><br>O trem freia de repente. Lia é jogada contra Dante.</div>';
			$in .= '<div class="ppx-card ppx-side" style="width:320px;height:560px;margin-top:-40px"><div style="display:flex;align-items:center;gap:8px"><span class="ppx-ori-ic">' . sera_pp_tsuru( 15 ) . '</span><div><div style="font-size:15px">Origami</div><div class="ppx-lbl">seu assistente de IA</div></div><span class="ppx-tag is-muted" style="margin-left:auto">vendo: roteiro</span></div>';
			$in .= '<div class="ppx-sug">Deixar a fala do Dante mais ameaçadora<div class="ppx-sug-a"><span class="ppx-chip">Aplicar</span><u>Agora não</u></div></div>';
			$in .= '<div class="ppx-sug">Adicionar uma cena depois da cena 3<div class="ppx-sug-a"><span class="ppx-chip">Aplicar</span><u>Agora não</u></div></div>';
			$in .= '<div class="ppx-soft" style="color:var(--p-ink-2)">Oi, Matheus. Estou acompanhando o episódio inteiro. Peça qualquer coisa: se for de outra etapa, eu te levo até lá.</div><div class="ppx-soft" style="color:var(--p-ink-2)">Encontrei 3 personagens: Lia, Dante e o Condutor. Já estou gerando o visual.</div>';
			$in .= '<div class="ppx-ask">Peça qualquer coisa, de qualquer etapa<span></span></div></div></div>';
			return sera_pp_shell( 'doc', $done( 'doc' ), $in, array( 'ori' => false ) );

		case 'personagem':
			$in  = '<div class="ppx-step">Personagens e vozes › Hana</div>';
			$in .= '<div style="display:flex;align-items:center;gap:14px;margin-top:10px">' . sera_pp_portrait( 'hana', 'width:52px;height:52px;border-radius:50%' ) . '<div><div class="ppx-title" style="font-size:48px;margin:0">Hana</div><div class="ppx-sub" style="margin-top:2px">Garota de 17 anos que perde o último trem da noite</div></div><span class="ppx-tag ok" style="margin-left:auto">Visual aprovado</span></div>';
			$in .= '<div class="ppx-tabs"><span class="on">Visual</span><span>Voz</span><span>Falas (6)</span></div>';
			$in .= '<div class="ppx-card" style="margin-top:14px;width:1000px;padding:12px"><div class="ppx-sheet">' . sera_pp_sheet_view( 'front' ) . sera_pp_sheet_view( 'tq' ) . sera_pp_sheet_view( 'side' ) . sera_pp_sheet_view( 'back' ) . '</div><div class="ppx-sheet-l"><span>Frente</span><span>Três quartos</span><span>Perfil</span><span>Costas</span></div></div>';
			$in .= '<div class="ppx-card" style="margin-top:12px;width:1000px"><div style="font-weight:500;margin-bottom:6px">Aparência fixa</div><div style="color:var(--p-ink-2)">Garota de 17 anos, aparência jovem e traços delicados, expressão ansiosa mas contida. Cabelo castanho-escuro na altura dos ombros. Figurino fixo: jaqueta de tecido escuro sobre camiseta simples e calça jeans.</div></div>';
			return sera_pp_shell( 'people', $done( 'people' ), $in );

		case 'decupagem':
			$in   = sera_pp_head( 'Passo 7 de 10 · Visualizar', 'Decupagem', 'Cada cena vira tomadas: trechos sem corte de câmera, com o plano e o lugar da câmera escolhidos a partir dos personagens e cenários.', 'Próximo: storyboard', '<span class="ppx-chip">' . $ts12 . ' Decupar todas</span>' );
			$in  .= '<div style="display:flex;gap:16px;margin-top:20px"><div style="width:780px;display:flex;flex-direction:column;gap:8px">';
			$rows = array(
				array( 'ppp', '1A', 'Chuva bate no telhado da plataforma vazia sob o poste que pisca.', 'Primeiríssimo plano · 8 s' ),
				array( 'gpg', '1B', 'Hana corre pela plataforma, mochila num ombro, celular apagado na mão.', 'Grande plano geral · 8 s · com movimento' ),
				array( 'close', '1C', 'Hana para, sem fôlego, olhando os trilhos vazios.', 'Close · 10 s · escolha da IA' ),
				array( 'medio', '1D', 'Atrás dela, Ren sentado no banco escuro, fone em um ouvido.', 'Plano médio · 9 s · escolha da IA' ),
				array( 'ombro', '1E', 'Hana se vira para Ren e o questiona.', 'Sobre o ombro · 8 s · escolha da IA' ),
			);
			foreach ( $rows as $i => $r ) {
				$in .= '<div class="ppx-row' . ( 2 === $i ? ' is-sel' : '' ) . '">' . sera_pp_shot_icon( $r[0] ) . '<div style="flex:1"><div><b style="font-weight:500;margin-right:6px">' . $r[1] . '</b>' . $r[2] . '</div><div style="font-size:11px;color:var(--p-muted)">' . $r[3] . '</div></div><span style="color:var(--p-muted)">›</span></div>';
			}
			$in .= '<div class="ppx-why"><span class="ppx-tag">Por que close</span> A cena pede a reação antes da explicação: o rosto da Hana conta que o trem já foi antes de a gente ver os trilhos.</div>';
			$in .= '</div><div class="ppx-card" style="width:330px"><div class="ppx-lbl">Cena 1</div><div style="font-size:19px;margin:4px 0 2px">Estação Shinji-mae</div><div style="font-size:11px;color:var(--p-muted)">9 tomadas · 75 s</div><div class="ppx-lbl" style="margin:14px 0 8px">Tipos de plano</div><div class="ppx-shots">';
			foreach ( array( array( 'gpg', 'Grande plano geral' ), array( 'pg', 'Plano geral' ), array( 'medio', 'Plano médio' ), array( 'ombro', 'Sobre o ombro' ), array( 'close', 'Close' ), array( 'ppp', 'Primeiríssimo' ), array( 'det', 'Detalhe' ), array( 'sub', 'Subjetiva' ) ) as $k ) {
				$in .= '<div' . ( 'close' === $k[0] ? ' class="on"' : '' ) . '>' . sera_pp_shot_icon( $k[0] ) . $k[1] . '</div>';
			}
			$in .= '</div></div></div>';
			return sera_pp_shell( 'shot', $done( 'shot' ), $in );

		case 'storyboard':
			$in  = sera_pp_head( 'Passo 8 de 10 · Visualizar', 'Storyboard', 'Uma imagem por tomada, já com personagens, cenário e plano. Imagem é barata; vídeo não. Aprove aqui antes de animar.', 'Próximo: animação', '<span class="ppx-chip">Modo básico</span>' );
			$in .= '<div class="ppx-card" style="margin-top:18px;display:flex;align-items:center;gap:20px"><div><span style="font-size:30px;font-weight:300">8</span> de 9 tomadas aprovadas<div class="ppx-bar" style="width:420px"><i style="width:88%"></i></div></div><span class="ppx-chip" style="margin-left:auto">' . $ts12 . ' Conferir continuidade</span></div>';
			$in .= '<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:14px">';
			$sb  = array( array( 'relogio', '3A', 'Lia olha o relógio parado', 'Plano médio · 5 s' ), array( 'close', '3B', 'Close de Lia, assustada', 'Close · 4 s' ), array( 'ombro', '3C', 'Dante empurra o bilhete', 'Sobre o ombro · 5 s' ), array( 'freio', '3D', 'O trem freia de repente', 'Plano geral · 6 s' ) );
			foreach ( $sb as $i => $f ) {
				$in .= '<div class="ppx-card ppx-sb">' . sera_pp_frame( $f[0], 'height:150px' ) . '<span class="ppx-tag ppx-sb-tag">' . $f[1] . '</span><div class="ppx-sb-t">' . $f[2] . '</div><div class="ppx-sb-m">' . $f[3] . '</div><div class="ppx-sb-a">' . ( $i < 3 ? '<span class="ppx-tag ok">✓ Aprovada</span><u>Desfazer</u>' : '<span class="ppx-btn sm">Aprovar</span>' ) . '</div></div>';
			}
			$in .= '</div>';
			return sera_pp_shell( 'grid', $done( 'grid' ), $in );

		case 'animacao':
			$in  = '<div class="ppx-topbar"><span style="font-size:18px">Animação</span><span class="ppx-chip">Cena 3 de 8 · Mesa 4</span><span style="display:flex;gap:4px">';
			foreach ( array( '3A', '3B', '3C', '3D', '3E' ) as $x ) {
				$in .= '<span class="ppx-chip">' . $x . '</span>';
			}
			$in .= '<span class="ppx-chip on">3F</span></span><span class="ppx-btn" style="margin-left:auto">Próximo: montagem →</span></div>';
			$in .= '<svg class="ppx-wire" viewBox="0 0 1228 800" aria-hidden="true"><path d="M230 170C290 170 280 150 330 150"/><path d="M850 280C880 280 870 220 900 220"/></svg>';
			$in .= '<div class="ppx-node" style="left:40px;top:100px;width:190px;padding:7px"><div class="ppx-lbl" style="margin-bottom:5px">Primeiro quadro · 3F</div>' . sera_pp_frame( 'mesa', 'height:100px' ) . '<div style="font-size:10.5px;color:var(--p-muted);margin-top:6px">A imagem do storyboard.</div></div>';
			$in .= '<div class="ppx-node" style="left:330px;top:100px;width:520px;padding:0;overflow:hidden"><div class="ppx-node-h">Movimento</div><div style="padding:14px 16px"><div class="ppx-lbl">O que se move nesta tomada</div><div class="ppx-input is-plain" style="margin-top:6px;height:84px;font-size:12.5px"><span class="ppx-typed">O trem freia forte, Lia é jogada contra Dante; os copos deslizam e a luminária balança.</span><span class="ppx-caret"></span></div>';
			$in .= '<div style="display:flex;gap:6px;margin-top:10px"><span class="ppx-chip">' . $ts12 . ' Refinar com o Origami</span><span class="ppx-chip">Ver o pedido completo</span></div>';
			$in .= '<div class="ppx-lbl" style="margin-top:16px">Qualidade</div><div class="ppx-input is-plain" style="margin-top:6px;font-size:12.5px">Equilibrada · LTX-2.5 Pro</div>';
			$in .= '<div class="ppx-lbl" style="margin-top:14px">Duração</div><div style="display:flex;gap:4px;margin-top:6px">';
			foreach ( array( 'Auto · 4 s', '4 s', '5 s', '6 s', '8 s', '10 s' ) as $i => $d ) {
				$in .= '<span class="ppx-chip' . ( 0 === $i ? ' on' : '' ) . '">' . $d . '</span>';
			}
			$in .= '</div><div class="ppx-lbl" style="margin-top:14px">Áudio</div><div style="display:flex;gap:4px;margin-top:6px"><span class="ppx-chip on">Fala na voz da Lia</span><span class="ppx-chip">Com som ambiente</span></div><div class="ppx-take-new">Novo take · #2.0 · US$ 0,32</div></div></div>';
			$in .= '<div class="ppx-node" style="left:900px;top:120px;width:290px"><div class="nh"><span style="font-size:17px">Take #1.0</span><span class="ppx-tag">Em revisão</span></div>' . sera_pp_frame( 'mesa', 'height:160px' ) . '<div class="ppx-play">▶</div><div class="ppx-meta"><span>Modelo</span><b>LTX-2.5 Pro</b><span>Duração</span><b>6 s</b></div><div style="margin-top:10px"><span class="ppx-btn" style="width:100%;justify-content:center">Aprovar</span></div></div>';
			return sera_pp_shell( 'play', $done( 'play' ), $in, array( 'dots' => true, 'pad' => false ) );

		case 'nodes':
			$in  = '<div class="ppx-topbar"><span style="font-size:18px">Storyboard</span><span class="ppx-chip">Modo avançado</span><span class="ppx-chip">Cena 3 de 8 · Mesa 4</span><span class="ppx-tag ok" style="margin-left:auto">Todas aprovadas</span></div>';
			$in .= '<svg class="ppx-wire" viewBox="0 0 1228 800" aria-hidden="true"><path d="M190 140C300 140 300 250 390 250"/><path d="M190 330C300 330 300 280 390 280"/><path d="M190 500C300 500 300 300 390 310"/><path d="M190 660C300 660 300 330 390 340"/><path d="M760 300C820 300 820 300 880 300"/></svg>';
			foreach ( array( array( 'Estilo do projeto', 'estilo-a', 90 ), array( 'Personagem · Lia', 'relogio', 270 ), array( 'Quadro anterior · 3E', 'xicara', 440 ), array( 'Cenário · vagão', 'vagao', 600 ) ) as $n ) {
				$in .= '<div class="ppx-node" style="left:30px;top:' . $n[2] . 'px;width:160px;padding:7px"><div class="ppx-lbl" style="margin-bottom:5px">' . $n[0] . '</div>' . sera_pp_frame( $n[1], 'height:76px' ) . '</div>';
			}
			$in .= '<div class="ppx-node lime" style="left:390px;top:120px;width:370px;height:430px"><div class="nh"><span style="font-size:17px">Pedido</span><span class="ppx-tag is-ink">3F</span></div><div style="display:flex;gap:6px;margin-bottom:8px"><span class="ppx-chip">Plano médio</span><span class="ppx-chip">4 s</span></div>';
			$in .= '<div class="ppx-prompt"><span class="ppx-typed">Trem freia, Lia é jogada contra Dante. Plano médio, câmera parada. Luz dourada das arandelas, sombras azuladas da janela. Lia de colete cinza e avental; Dante de terno escuro. Dante NÃO está de chapéu. O condutor NÃO está no quadro.</span></div>';
			$in .= '<div class="ppx-lbl" style="margin:10px 0 4px;color:var(--p-on-lime)">Em português · só para você ler</div><div style="font-size:11.5px">O trem freia, Lia é jogada contra Dante. Plano médio, câmera parada.</div><div class="ppx-take-new is-white">Novo take · #2.0</div></div>';
			$in .= '<div class="ppx-node" style="left:880px;top:150px;width:320px"><div class="nh"><span style="font-size:17px">Take #1.0</span><span class="ppx-tag ok">Aprovado</span></div>' . sera_pp_frame( 'mesa', 'height:180px' ) . '<div class="ppx-meta"><span>Modelo</span><b>FLUX.2</b><span>Formato</span><b>16:9 · 1280×720</b><span>Seed</span><b>2210</b><span>Custo</span><b>US$ 0,04</b></div><div style="display:flex;gap:6px;margin-top:12px"><span class="ppx-chip">Iterar</span><span class="ppx-chip">Comparar</span><span class="ppx-chip">Recortar</span></div><div style="margin-top:8px"><span class="ppx-btn" style="width:100%;justify-content:center">' . sera_pp_tsuru( 13 ) . ' Editar com Origami</span></div></div>';
			return sera_pp_shell( 'grid', $done( 'grid' ), $in, array( 'dots' => true, 'pad' => false ) );

		case 'montagem':
			$clips = array( 'plataforma', 'hana-plat', 'tunel', 'relogio', 'close', 'ombro', 'freio', 'xicara', 'mesa', 'vagao', 'plataforma', 'tunel' );
			$in    = '<div class="ppx-cut">';
			$in   .= '<div class="ppx-cut-top"><div><div class="ppx-lbl">Montagem</div><div style="font-size:14px">A estação sem nome · Episódio 1</div></div><span class="ppx-mono" style="margin-left:auto">26 tomadas com vídeo · 2:23</span><span class="ppx-btn">Exportar ▾</span></div>';
			$in   .= '<div class="ppx-cut-list"><div class="ppx-cut-tabs"><b>Tomadas</b><span>Áudios</span><span>Textos</span></div>';
			foreach ( array( '1 · A plataforma', '2 · Primeira noite', '3 · Mesa 4', '4 · A freada', '5 · O vagão das fotos', '6 · Cabine vazia', '7 · O relógio volta', '8 · A estação sem nome' ) as $i => $t ) {
				$in .= '<div class="ppx-cut-sc' . ( 2 === $i ? ' on' : '' ) . '"><span>' . $t . '</span><span class="ppx-mono">0:' . array( 20, 28, 25, 16, 16, 14, 13, 16 )[ $i ] . '</span></div>';
			}
			$in .= '</div><div class="ppx-cut-view">' . sera_pp_frame( 'ombro', 'flex:1' ) . '<div class="ppx-cut-ctl">‹‹ <span>▶</span> ››</div></div>';
			$in .= '<div class="ppx-cut-insp"><div style="display:flex;justify-content:space-between"><b style="font-weight:500;font-size:15px">3C</b><span class="ppx-mono">5,0 s</span></div><div style="color:var(--p-muted)">Cena 3 · Sobre o ombro</div><div class="ppx-lbl">Enquadramento</div><div class="ppx-kv"><span>Escala</span><span>100%</span></div><div class="ppx-lbl">Transição</div><div class="ppx-kv"><span>Entrada</span><span>Corte</span></div><div class="ppx-lbl">Áudio</div><div style="display:flex;align-items:center;gap:8px"><span style="flex:1;height:3px;background:var(--p-lime);border-radius:3px"></span>100%</div></div>';
			$in .= '<div class="ppx-tl"><div class="ppx-tl-hint"><span>✂</span><span>Arraste as bordas para aparar; S divide; espaço toca.</span></div><div class="ppx-tl-ruler">';
			foreach ( array( '0:00', '0:15', '0:30', '0:45', '1:00', '1:15', '1:30', '1:45', '2:00' ) as $t ) {
				$in .= '<span>' . $t . '</span>';
			}
			$in .= '</div><div class="ppx-tl-row is-v"><span><b>V1</b>Vídeo</span><div>';
			foreach ( $clips as $i => $c ) {
				$in .= sera_pp_frame( $c, 'flex:' . ( 4 === $i ? '1.6' : '1' ) . ';height:100%;border-radius:3px' );
			}
			$in .= '</div></div>';
			$in .= '<div class="ppx-tl-row is-a"><span><b>A1</b>Efeitos</span><div><i style="flex:5">' . sera_pp_wave( 80, 1 ) . '</i><em style="flex:2"></em><i style="flex:3">' . sera_pp_wave( 50, 7 ) . '</i></div></div>';
			$in .= '<div class="ppx-tl-row is-b"><span><b>A2</b>Falas</span><div><em style="flex:1"></em><i style="flex:2">' . sera_pp_wave( 30, 3 ) . '</i><em style="flex:2"></em><i style="flex:3">' . sera_pp_wave( 40, 9 ) . '</i><em style="flex:2"></em></div></div>';
			$in .= '<div class="ppx-tl-row is-c"><span><b>A3</b>Trilha</span><div><i style="flex:1">' . sera_pp_wave( 140, 5 ) . '</i></div></div>';
			$in .= '<div class="ppx-tl-head"><i></i></div></div>';
			$in .= '<div class="ppx-export"><div class="ppx-lbl">Exportar episódio</div><div class="ppx-ex-r"><span>MP4 · 1080p</span><em>nativo</em></div><div class="ppx-ex-r on"><span>Upscale · 4K (2160p)</span><em>+ 3 min</em></div><div class="ppx-ex-r"><span>Só as falas · WAV</span><em></em></div><div class="ppx-ex-c">Custo do upscale <b>US$ 0,90</b></div><span class="ppx-btn" style="width:100%;justify-content:center">Exportar em 4K</span></div>';
			$in .= '</div>';
			return sera_pp_shell( 'cut', $done( 'cut' ), $in, array( 'pad' => false, 'ori' => false ) );
	}
	return '';
}

/* ------------------------------------------------------------- phone */

function sera_pp_mob( $crumb, $body, $ori = true ) {
	return '<div class="ppx ppx-ph"><div class="ppx-mtop"><span class="ppx-mlg">' . sera_pp_logo() . '</span><span class="ppx-mcrumb">' . esc_html( $crumb ) . '</span><span class="ppx-mburger"><i></i><i></i></span></div><div class="ppx-mbody">' . $body . '</div>' . ( $ori ? '<div class="ppx-mori">' . sera_pp_tsuru() . '</div>' : '' ) . '</div>';
}

/**
 * Phone screens (393 px wide, under the device status bar).
 *
 * @param string $id Screen id.
 */
function sera_pp_phone( $id ) {
	switch ( $id ) {
		case 'inicio':
			$b = '<div class="ppx-step">Boa tarde, Matheus</div><div class="ppx-mtitle">A estação<br>sem nome</div><div class="ppx-sub">Storyboard pronto. Faltam 30 vídeos.</div><span class="ppx-btn lg">Continuar de onde parei →</span>';
			$b .= '<div class="ppx-card" style="margin-top:14px;padding:10px"><div class="ppx-lbl" style="display:flex;justify-content:space-between"><span>Cena 3</span><span>Animação · 0 de 6</span></div>' . sera_pp_frame( 'freio', 'height:150px;margin-top:8px' ) . '<div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px"><span style="font-size:19px">Episódio 1</span><span class="ppx-tag">8 de 10 etapas</span></div><div class="ppx-bar"><i style="width:80%"></i></div></div>';
			$b .= '<div class="ppx-row" style="margin-top:10px;padding:8px">' . sera_pp_frame( 'plataforma', 'width:64px;height:40px;flex:none' ) . '<div><div>Sem Partidas</div><div class="ppx-lbl">Montagem · exportado</div></div></div>';
			return sera_pp_mob( 'Início', $b );

		case 'ideia':
			$b = '<div class="ppx-step">Passo 1 de 10 · Escrever</div><div class="ppx-mtitle">Qual é a<br>história?</div><div class="ppx-sub">Comece pela ideia. Título, duração e formato aparecem no caminho.</div>';
			$b .= '<div class="ppx-card" style="margin-top:18px"><div class="ppx-lbl" style="margin-bottom:8px">A ideia em uma frase</div><div style="font-size:17px;line-height:1.45">Uma garçonete de trem noturno descobre que o passageiro da mesa 4 sabe exatamente como ela vai morrer.<span class="ppx-caret"></span></div></div>';
			$b .= '<div class="ppx-card" style="margin-top:10px"><div style="display:flex;justify-content:space-between;align-items:center"><div class="ppx-lbl">Título</div><span class="ppx-chip on">' . sera_pp_tsuru( 12 ) . ' Sugerir</span></div><div class="ppx-input" style="margin-top:8px">A estação sem nome</div></div>';
			$b .= '<span class="ppx-btn lg">Próximo: universo →</span>';
			return sera_pp_mob( 'Escrever', $b );

		case 'universo':
			$b = '<div class="ppx-step">Passo 2 de 10 · Escrever</div><div class="ppx-mtitle">O universo</div>';
			$b .= '<div class="ppx-card" style="margin-top:14px"><div style="font-size:15px;margin-bottom:6px">Regras que nunca mudam</div><div style="color:var(--p-ink-2);line-height:1.6;font-size:12.5px">• Sempre é noite do lado de fora.<br>• O relógio do pai da Lia é o único que funciona.<br>• Ninguém fala o nome da próxima estação.</div></div>';
			$b .= '<div class="ppx-card" style="margin-top:10px;display:flex;flex-direction:column;gap:8px"><div style="font-size:15px">Perguntas em aberto</div>';
			foreach ( array( 'O que acontece com quem desce do trem?', 'Dante está ajudando a Lia ou prendendo ela ali?' ) as $q ) {
				$b .= '<div class="ppx-soft"><div style="font-weight:500;font-size:12.5px">' . $q . '</div><span class="ppx-chip" style="margin-top:6px">Virar regra</span></div>';
			}
			return sera_pp_mob( 'Escrever', $b . '</div>' );

		case 'roteiro':
			$b = '<div class="ppx-step">Passo 3 de 10 · Escrever</div><div class="ppx-mtitle">Roteiro</div><div style="display:flex;gap:6px;margin:14px 0"><span class="ppx-chip">‹</span><span class="ppx-chip" style="flex:1;justify-content:center">Cena 3 · Mesa 4</span><span class="ppx-chip">›</span></div>';
			$b .= '<div class="ppx-card ppx-script" style="font-size:13.5px;padding:18px">INT. VAGÃO-RESTAURANTE — NOITE<br><br>O vagão balança vazio. Copos tilintam nas mesas. LIA (28) entra, o casaco molhado de chuva.<br><br><span class="hl">Ela senta perto da janela. Do outro lado, DANTE (34) já estava ali.</span><br><br><div style="text-align:center">DANTE</div><div style="margin:0 30px">Você não devia estar aqui.</div></div>';
			$b .= '<div class="ppx-sug" style="margin-top:10px">Deixar a fala do Dante mais ameaçadora<div class="ppx-sug-a"><span class="ppx-chip">Aplicar</span><u>Agora não</u></div></div>';
			return sera_pp_mob( 'Escrever', $b );

		case 'elenco':
			$b = '<div class="ppx-step">Passo 5 de 10 · Visualizar</div><div class="ppx-mtitle">Personagens<br>e vozes</div><div class="ppx-cast">';
			foreach ( array( array( 'hana', 'Hana' ), array( 'ren', 'Ren' ), array( 'okabe', 'Sr. Okabe' ), array( 'bilh', 'Bilheteiro' ) ) as $c ) {
				$b .= '<div class="ppx-card" style="padding:6px">' . sera_pp_portrait( $c[0], 'height:150px' ) . '<div style="font-size:13px;margin:6px 2px 2px">' . $c[1] . '</div><span class="ppx-chip sm">◉ voz</span></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'decupagem':
			$b    = '<div class="ppx-step">Passo 7 de 10 · Visualizar</div><div class="ppx-mtitle">Decupagem</div><div class="ppx-lbl" style="margin-top:14px">Cena 1 · Estação Shinji-mae · 9 tomadas</div><div style="display:flex;flex-direction:column;gap:7px;margin-top:8px">';
			$rows = array( array( 'ppp', '1A', 'Chuva no telhado da plataforma vazia', 'Primeiríssimo · 8 s' ), array( 'gpg', '1B', 'Hana corre pela plataforma', 'Grande plano geral · 8 s' ), array( 'close', '1C', 'Hana para, olhando os trilhos', 'Close · 10 s · IA' ), array( 'medio', '1D', 'Ren no banco escuro', 'Plano médio · 9 s · IA' ), array( 'ombro', '1E', 'Hana se vira para Ren', 'Sobre o ombro · 8 s' ) );
			foreach ( $rows as $i => $r ) {
				$b .= '<div class="ppx-row' . ( 2 === $i ? ' is-sel' : '' ) . '" style="padding:8px 10px">' . sera_pp_shot_icon( $r[0] ) . '<div style="flex:1;font-size:12.5px"><div><b style="font-weight:500;margin-right:4px">' . $r[1] . '</b>' . $r[2] . '</div><div style="font-size:10.5px;color:var(--p-muted)">' . $r[3] . '</div></div></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'storyboard':
			$b = '<div class="ppx-step">Passo 8 de 10 · Visualizar</div><div class="ppx-mtitle">Storyboard</div><div class="ppx-card" style="margin-top:14px;padding:12px"><span style="font-size:26px;font-weight:300">6</span> de 6 tomadas aprovadas <span class="ppx-tag ok">Tudo aprovado</span></div><div class="ppx-cast is-sb">';
			foreach ( array( array( 'relogio', 'Plano médio' ), array( 'close', 'Close' ), array( 'ombro', 'Ombro' ), array( 'freio', 'Geral' ) ) as $i => $f ) {
				$b .= '<div class="ppx-card" style="padding:5px">' . sera_pp_frame( $f[0], 'height:84px' ) . '<div style="font-size:11px;margin:5px 2px 3px">3' . 'ABCD'[ $i ] . ' · ' . $f[1] . '</div><span class="ppx-tag ok">✓ Aprovada</span></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'animacao':
			$b = '<div class="ppx-step">Passo 9 de 10 · Filmar</div><div class="ppx-mtitle">Animação</div>' . sera_pp_frame( 'mesa', 'height:190px;margin-top:14px' );
			$b .= '<div class="ppx-card" style="margin-top:10px"><div class="ppx-lbl">O que se move · 3F</div><div style="font-size:13px;margin-top:6px">O trem freia forte, Lia é jogada contra Dante; os copos deslizam.<span class="ppx-caret"></span></div></div>';
			$b .= '<div style="display:flex;gap:5px;margin-top:10px"><span class="ppx-chip on">Auto · 4 s</span><span class="ppx-chip">6 s</span><span class="ppx-chip">Voz da Lia</span></div><span class="ppx-btn lg">Gerar take · US$ 0,32</span>';
			return sera_pp_mob( 'Filmar', $b );
	}
	return '';
}
