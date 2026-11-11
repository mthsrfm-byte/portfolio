<?php
/**
 * Template helpers: icons, logos, device frames.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * UI icons (site chrome).
 */
function sera_icon( $name, $class = 'ico' ) {
	$paths = array(
		'arrow-right' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'arrow-up-right' => '<path d="M7 17 17 7M8 7h9v9"/>',
		'arrow-down' => '<path d="M12 5v14M6 13l6 6 6-6"/>',
		'menu'  => '<path d="M4 8h16M4 16h16"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths[ $name ] . '</svg>';
}

/**
 * Phosphor Regular icons (MIT), inlined. Used sparingly: the Approach principles.
 *
 * @param string $name Icon name.
 * @return string
 */
function sera_ph( $name ) {
	$p = array(
		'chart-line-up' => 'M232,208a8,8,0,0,1-8,8H32a8,8,0,0,1-8-8V48a8,8,0,0,1,16,0V156.69l50.34-50.35a8,8,0,0,1,11.32,0L128,132.69,180.69,80H160a8,8,0,0,1,0-16h40a8,8,0,0,1,8,8v40a8,8,0,0,1-16,0V91.31l-58.34,58.35a8,8,0,0,1-11.32,0L96,123.31l-56,56V200H224A8,8,0,0,1,232,208Z',
		'magnifying-glass' => 'M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z',
		'target' => 'M221.87,83.16A104.1,104.1,0,1,1,195.67,49l22.67-22.68a8,8,0,0,1,11.32,11.32l-96,96a8,8,0,0,1-11.32-11.32l27.72-27.72a40,40,0,1,0,17.87,31.09,8,8,0,1,1,16-.9,56,56,0,1,1-22.38-41.65L184.3,60.39a87.88,87.88,0,1,0,23.13,29.67,8,8,0,0,1,14.44-6.9Z',
		'wrench' => 'M226.76,69a8,8,0,0,0-12.84-2.88l-40.3,37.19-17.23-3.7-3.7-17.23,37.19-40.3A8,8,0,0,0,187,29.24,72,72,0,0,0,88,96,72.34,72.34,0,0,0,94,124.94L33.79,177c-.15.12-.29.26-.43.39a32,32,0,0,0,45.26,45.26c.13-.13.27-.28.39-.42L131.06,162A72,72,0,0,0,232,96,71.56,71.56,0,0,0,226.76,69ZM160,152a56.14,56.14,0,0,1-27.07-7,8,8,0,0,0-9.92,1.77L67.11,211.51a16,16,0,0,1-22.62-22.62L109.18,133a8,8,0,0,0,1.77-9.93,56,56,0,0,1,58.36-82.31l-31.2,33.81a8,8,0,0,0-1.94,7.1L141.83,108a8,8,0,0,0,6.14,6.14l26.35,5.66a8,8,0,0,0,7.1-1.94l33.81-31.2A56.06,56.06,0,0,1,160,152Z',
	);
	if ( ! isset( $p[ $name ] ) ) {
		return '';
	}
	return '<svg class="ph" viewBox="0 0 256 256" fill="currentColor" aria-hidden="true"><path d="' . $p[ $name ] . '"/></svg>';
}

/**
 * Icons used inside the recreated app screens.
 */
function sera_s_icon( $name, $extra = '' ) {
	$p = array(
		'back'     => '<path d="M19 12H5M11 6l-6 6 6 6"/>',
		'chev-l'   => '<path d="M15 5l-7 7 7 7"/>',
		'chev-r'   => '<path d="M9 5l7 7-7 7"/>',
		'close'    => '<path d="M6 6l12 12M18 6 6 18"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'check'    => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
		'tag'      => '<path d="M3 12V4h8l10 10-8 8z"/><circle cx="7.5" cy="8.5" r="1.5"/>',
		'sync'     => '<path d="M4 12a8 8 0 0 1 14-5.3L20 9M20 4v5h-5M20 12a8 8 0 0 1-14 5.3L4 15M4 20v-5h5"/>',
		'bell'     => '<path d="M6 16V11a6 6 0 1 1 12 0v5l2 2H4z"/><path d="M10 20a2 2 0 0 0 4 0"/>',
		'calendar' => '<rect x="4" y="5" width="16" height="15" rx="2"/><path d="M4 10h16M9 3v4M15 3v4"/>',
		'info'     => '<circle cx="12" cy="12" r="9"/><path d="M12 11v5M12 8h.01"/>',
		'pix'      => '<path d="M12 3 21 12 12 21 3 12z"/><path d="M8.5 8.5 12 12l3.5-3.5M8.5 15.5 12 12l3.5 3.5"/>',
		'barcode'  => '<path d="M4 6v12M7 6v12M10 6v12M14 6v12M17 6v12M20 6v12"/>',
		'phone'    => '<rect x="7" y="3" width="10" height="18" rx="2"/><path d="M11 18h2"/>',
		'chart'    => '<rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 16v-4M12 16V8M16 16v-6"/>',
		'plus'     => '<path d="M12 5v14M5 12h14"/>',
		'invoice'  => '<path d="M6 3h12v18l-3-2-3 2-3-2-3 2z"/><path d="M9 8h6M9 12h6"/>',
		'at'       => '<circle cx="12" cy="12" r="4"/><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-4 7.5"/>',
		'cart'     => '<path d="M3 4h2l2.4 11h10.2L20 8H6.2"/><circle cx="9" cy="19" r="1.4"/><circle cx="17" cy="19" r="1.4"/>',
		'bag'      => '<path d="M5 8h14l-1 12H6z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
		'bus'      => '<rect x="5" y="3" width="14" height="15" rx="3"/><path d="M5 11h14M8 18v2M16 18v2"/><circle cx="8.5" cy="14.5" r=".6"/><circle cx="15.5" cy="14.5" r=".6"/>',
		'lock'     => '<rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
		'send'     => '<path d="M21 3 10 14M21 3l-7 18-4-7-7-4z"/>',
		'pay'      => '<rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18M7 15h3"/>',
	);
	if ( ! isset( $p[ $name ] ) ) {
		return '';
	}
	return '<svg class="s-ico ' . esc_attr( $extra ) . '" viewBox="0 0 24 24" aria-hidden="true">' . $p[ $name ] . '</svg>';
}

/**
 * Bundled company / client logos. Files live in assets/logos.
 * ratio = width / height (precomputed from the files), used to size the mask.
 */
function sera_logos() {
	static $cache = null;
	if ( null !== $cache ) {
		return $cache;
	}
	$logos = array(
		// Where I've worked.
		'pagaleve'         => array( 'Pagaleve', 'pagaleve.svg', 5.275 ),
		'western-union'    => array( 'Western Union', 'western-union.svg', 4.225 ),
		'will-bank'        => array( 'will bank', 'will-bank.svg', 3.075 ),
		'acordo-certo'     => array( 'Acordo Certo', 'acordo-certo.svg', 3.912 ),
		'nubank'           => array( 'Nubank', 'nubank.svg', 1.833 ),
		'jussi'            => array( 'Jüssi', 'jussi.svg', 2.848 ),
		'laureate'         => array( 'Laureate International Universities', 'laureate.svg', 6.241 ),
		'pgfn'             => array( 'Procuradoria-Geral da Fazenda Nacional', 'pgfn.png', 0.973 ),
		// Clients and brands (agency years).
		'mastercard'       => array( 'Mastercard', 'mastercard.png', 1.291 ),
		'paypal'           => array( 'PayPal', 'paypal.png', 0.847 ),
		'sanofi'           => array( 'Sanofi', 'sanofi.png', 1.254 ),
		'lg'               => array( 'LG', 'lg.png', 2.268 ),
		'o-boticario'      => array( 'O Boticário', 'o-boticario.png', 2.703 ),
		'sodexo'           => array( 'Sodexo', 'sodexo.png', 3.146 ),
		'dunkin'           => array( 'Dunkin’', 'dunkin.png', 2.179 ),
		'tedx-sp'          => array( 'TEDx São Paulo', 'tedx-sp.png', 1.433 ),
		'senai'            => array( 'SENAI', 'senai.png', 5.29 ),
		'mint'             => array( 'Ministério do Turismo', 'mint.png', 3.581 ),
		'mine'             => array( 'Ministério do Esporte', 'mine.png', 3.602 ),
		'unb'              => array( 'Universidade de Brasília', 'unb.png', 1.221 ),
		'onemarket'        => array( 'OneMarket', 'onemarket.png', 1.355 ),
		'nwi'              => array( 'NWI Telecom', 'nwi.png', 2.84 ),
		'grancursosonline' => array( 'Gran Cursos Online', 'grancursosonline.png', 3.778 ),
		'rede-salesiana'   => array( 'Rede Salesiana Brasil', 'rede-salesiana.png', 1.006 ),
	);

	$dir = get_template_directory() . '/assets/logos/';
	$uri = get_template_directory_uri() . '/assets/logos/';
	$out = array();
	foreach ( $logos as $slug => $data ) {
		if ( ! file_exists( $dir . $data[1] ) ) {
			continue;
		}
		$out[ $slug ] = array(
			'name'  => $data[0],
			'url'   => $uri . $data[1],
			'ratio' => $data[2],
		);
	}
	$cache = apply_filters( 'sera_logos', $out );
	return $cache;
}

/**
 * A logo rendered as a CSS mask, so it can be recoloured by CSS.
 */
function sera_logo_mask( $slug, $height = 34, $label = true ) {
	$logos = sera_logos();
	if ( empty( $logos[ $slug ] ) ) {
		return '';
	}
	$l     = $logos[ $slug ];
	$style = sprintf( '--logo:url(%s);--ratio:%s;--h:%dpx', esc_url( $l['url'] ), esc_attr( $l['ratio'] ), (int) $height );
	$aria  = $label ? ' role="img" aria-label="' . esc_attr( $l['name'] ) . '"' : ' aria-hidden="true"';
	return '<span class="logo-mask" style="' . $style . '"' . $aria . '></span>';
}

/**
 * Inline SVG of the Western Union mark (recolourable via currentColor).
 */
function sera_wu_mark() {
	static $svg = null;
	if ( null === $svg ) {
		$file = get_template_directory() . '/assets/logos/wu-mark.svg';
		$svg  = file_exists( $file ) ? (string) file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	return $svg;
}

/**
 * Personal logo (inline SVG).
 */
function sera_brand_logo() {
	static $svg = null;
	if ( null === $svg ) {
		$file = get_template_directory() . '/assets/img/logo-serafim.svg';
		$svg  = file_exists( $file ) ? (string) file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	return $svg;
}

/**
 * H1 of the fallback template (archives, search, blog index).
 */
function sera_index_title() {
	if ( is_archive() ) {
		return wp_strip_all_tags( get_the_archive_title() );
	}
	if ( is_search() ) {
		return sprintf( sera_t( 'Search: %s', 'Busca: %s' ), get_search_query() );
	}
	return get_bloginfo( 'name' );
}

/**
 * iPhone frame around a recreated screen.
 *
 * @param string $screen_class Extra classes for the .screen element.
 * @param string $content      Screen HTML (trusted, produced by theme templates).
 * @param array  $args         position: up|down|'' ; dark: bool ; label: aria label.
 */
function sera_device( $screen_class, $content, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'position' => '',
			'dark'     => false,
			'label'    => '',
			'caption'  => '',
		)
	);
	$pos  = $args['position'] ? ' is-' . $args['position'] : '';
	$dark = $args['dark'] ? ' is-dark' : '';

	$signal = '<svg viewBox="0 0 18 12" aria-hidden="true"><rect x="0" y="8" width="3" height="4" rx=".8" fill="currentColor"/><rect x="5" y="5.5" width="3" height="6.5" rx=".8" fill="currentColor"/><rect x="10" y="3" width="3" height="9" rx=".8" fill="currentColor"/><rect x="15" y="0" width="3" height="12" rx=".8" fill="currentColor"/></svg>';
	$wifi   = '<svg viewBox="0 0 16 12" aria-hidden="true"><path fill="currentColor" d="M8 2.3c2.3 0 4.4.9 6 2.4l1.1-1.2A10.2 10.2 0 0 0 8 .6C5.3.6 2.8 1.6.9 3.5L2 4.7a8.6 8.6 0 0 1 6-2.4Zm0 3.4c1.4 0 2.6.5 3.6 1.4l1.1-1.2A6.9 6.9 0 0 0 8 4c-1.8 0-3.4.7-4.7 1.9l1.1 1.2c1-.9 2.2-1.4 3.6-1.4Zm0 3.3c-.6 0-1.1.2-1.5.6L8 11.4l1.5-1.8c-.4-.4-.9-.6-1.5-.6Z"/></svg>';
	$batt   = '<svg viewBox="0 0 27 12" aria-hidden="true"><rect x=".5" y=".5" width="23" height="11" rx="3.3" fill="none" stroke="currentColor" opacity=".4"/><rect x="2" y="2" width="20" height="8" rx="2" fill="currentColor"/><path d="M25 4v4c.8-.3 1.3-1.1 1.3-2S25.8 4.3 25 4Z" fill="currentColor" opacity=".45"/></svg>';

	$label = $args['label'] ? ' role="img" aria-label="' . esc_attr( $args['label'] ) . '"' : ' aria-hidden="true"';

	$html  = '<div class="device' . $pos . '"' . $label . '><div class="device-frame">';
	$html .= '<div class="screen ' . esc_attr( $screen_class ) . $dark . '">';
	$html .= '<div class="island"></div>';
	$html .= '<div class="statusbar"><span>9:41</span><span class="sb-right">' . $signal . $wifi . $batt . '</span></div>';
	$html .= $content;
	$html .= '<div class="home-ind"></div>';
	$html .= '</div></div>';
	if ( $args['caption'] ) {
		$html .= '<span class="device-cap">' . esc_html( $args['caption'] ) . '</span>';
	}
	$html .= '</div>';
	return $html;
}

/**
 * Available built-in mockups (template-parts/mockups/<slug>.php).
 */
function sera_mockups() {
	return array(
		'pagaleve'          => 'Pagaleve · Combina Antes (Home + nova data)',
		'pagaleve-flow'     => 'Pagaleve · Fluxo completo (4 telas)',
		'western-union'     => 'Western Union · Onboarding (frente + confirmação)',
		'wu-before-after'   => 'Western Union · Antes × depois',
		'wu-solutions'      => 'Western Union · Soluções (câmera, SMS, etapas)',
		'will-bank'         => 'will bank · Cartão de crédito',
		'will-bank-detail'  => 'will bank · Detalhe da compra',
		'will-bank-bills'   => 'will bank · Faturas no tempo (2 telas)',
		'will-bank-advance' => 'will bank · Antecipar parcelas (4 telas)',
		'will-bank-plan'    => 'will bank · Planejar compras (4 telas)',
		'fatal-model'       => 'Fatal Model · Entrevista assíncrona (2 telas)',
		'fm-method'         => 'Fatal Model · Fluxo da pesquisa (3 telas)',
		'acordo-certo'      => 'Acordo Certo · Home nova (desktop + mobile)',
		'ac-before-after'   => 'Acordo Certo · Antes × depois (páginas inteiras)',
		'ac-mobile'         => 'Acordo Certo · Versão mobile (3 telas)',
		'bastidores'        => 'Bastidores · Home nova (desktop + mobile)',
		'nb-before-after'   => 'Bastidores · 2022 × 2026 (páginas inteiras)',
		'nb-mobile'         => 'Bastidores · Mobile antes × depois',
		'research-hub'      => 'Pagaleve · Research Hub (desktop + mobile)',
		'research-hub-ask'  => 'Pagaleve · Research Hub · Perguntar ao acervo (desktop + mobile)',
		'rh-shots-archive'  => 'Pagaleve · Research Hub · Telas reais: acervo (slider desktop + mobile)',
		'rh-shots-ask'      => 'Pagaleve · Research Hub · Telas reais: perguntar ao acervo (slider desktop + mobile)',
		'rh-shots-roadmap'  => 'Pagaleve · Research Hub · Telas reais: roadmap (slider desktop + mobile)',
		'lume'              => 'Pagaleve · Lume · Replay (desktop) + sessão (mobile), em código',
		'lume-flow'         => 'Pagaleve · Lume · A sessão do participante (7 telas, em código)',
		'lm-shots-setup'    => 'Pagaleve · Lume · Slider: área do designer no computador e no celular',
		'lm-findings'       => 'Pagaleve · Lume · Achados no computador e no celular',
		'paperplane'        => 'Paperplane Studio · Início (computador + celular), em código',
	);
}

/**
 * Render a built-in mockup stage.
 */
function sera_render_mockup( $slug ) {
	$slug = sanitize_key( $slug );
	if ( ! array_key_exists( $slug, sera_mockups() ) ) {
		return '';
	}
	ob_start();
	get_template_part( 'template-parts/mockups/' . $slug );
	return sera_pin_row_chip( ob_get_clean() );
}

/**
 * Row stages scroll sideways, so their brand chip is moved out of the scroller on the server:
 * it stays centred at the top of the block on every browser (no JS needed, iOS included).
 * A display:contents wrapper carries the stage classes so the chip keeps its colours.
 *
 * @param string $html Mockup markup.
 */
function sera_pin_row_chip( $html ) {
	if ( false === strpos( $html, 'stage-row' ) ) {
		return $html;
	}
	$start = strpos( $html, '<span class="brand-chip' );
	if ( false === $start ) {
		return $html;
	}
	$depth = 0;
	$i     = $start;
	$len   = strlen( $html );
	$end   = false;
	while ( $i < $len ) {
		$open  = strpos( $html, '<span', $i );
		$close = strpos( $html, '</span>', $i );
		if ( false === $close ) {
			break;
		}
		if ( false !== $open && $open < $close ) {
			$depth++;
			$i = $open + 5;
		} else {
			$depth--;
			$i = $close + 7;
			if ( 0 === $depth ) {
				$end = $i;
				break;
			}
		}
	}
	if ( false === $end ) {
		return $html;
	}
	$chip  = substr( $html, $start, $end - $start );
	$html  = substr( $html, 0, $start ) . substr( $html, $end );
	$chip  = preg_replace( '/^<span class="brand-chip/', '<span class="brand-chip is-fixed', $chip );
	$stage = '';
	if ( preg_match( '/class="mockup-stage([^"]*)"/', $html, $m ) ) {
		$stage = implode( ' ', preg_grep( '/^stage-(?!row$)/', preg_split( '/\s+/', trim( $m[1] ) ) ) );
	}
	return $html . '<span class="' . esc_attr( trim( $stage . ' chip-host' ) ) . '">' . $chip . '</span>';
}

/**
 * Visual of a case (mockup, or featured image fallback).
 */
function sera_case_visual( $post_id ) {
	$visual = get_post_meta( $post_id, '_sera_visual', true );
	if ( $visual && 'image' !== $visual ) {
		$html = sera_render_mockup( $visual );
		if ( $html ) {
			return $html;
		}
	}
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, 'large', array( 'class' => 'cover', 'loading' => 'lazy' ) );
	}
	return '';
}

/**
 * Case metrics from meta (array of [value,label]).
 */
function sera_case_metrics( $post_id ) {
	$raw = (string) get_post_meta( $post_id, '_sera_metrics', true );
	$out = array();
	foreach ( preg_split( '/\r\n|\r|\n/', $raw ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$parts = array_map( 'trim', explode( '|', $line, 2 ) );
		$out[] = array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
	}
	return array_slice( $out, 0, 3 );
}

function sera_case_chips( $post_id ) {
	$raw = (string) get_post_meta( $post_id, '_sera_chips', true );
	return array_filter( array_map( 'trim', explode( ',', $raw ) ) );
}

function sera_case_headline( $post_id ) {
	$h = get_post_meta( $post_id, '_sera_headline', true );
	return $h ? $h : get_the_title( $post_id );
}

/**
 * Render metrics block.
 */
function sera_metrics_html( $metrics ) {
	if ( ! $metrics ) {
		return '';
	}
	$html = '<div class="metrics">';
	foreach ( $metrics as $m ) {
		$html .= '<div class="metric"><b>' . esc_html( $m[0] ) . '</b><span>' . esc_html( $m[1] ) . '</span></div>';
	}
	return $html . '</div>';
}

/**
 * Meta line: company · year · role.
 */
function sera_case_meta_html( $post_id ) {
	$bits = array_filter(
		array(
			get_post_meta( $post_id, '_sera_company', true ) ? '<strong>' . esc_html( get_post_meta( $post_id, '_sera_company', true ) ) . '</strong>' : '',
			get_post_meta( $post_id, '_sera_year', true ) ? '<span class="cm-year">' . esc_html( get_post_meta( $post_id, '_sera_year', true ) ) . '</span>' : '',
			get_post_meta( $post_id, '_sera_role', true ) ? '<span class="sep cm-role-sep" aria-hidden="true"></span><span class="cm-role">' . esc_html( get_post_meta( $post_id, '_sera_role', true ) ) . '</span>' : '',
		)
	);
	$role = array_pop( $bits );
	if ( $role && false === strpos( $role, 'cm-role' ) ) {
		$bits[] = $role;
		$role   = '';
	}
	return ( $bits || $role ) ? '<div class="case-meta">' . implode( '<span class="sep" aria-hidden="true"></span>', $bits ) . $role . '</div>' : '';
}

/**
 * Hero title with an optional rotating word (slot) on the first rotate word.
 */
function sera_hero_title_html() {
	$t1    = sera_mod( 'hero_title' );
	$t2    = sera_mod( 'hero_title_2' );
	$words = array_values( array_filter( array_map( 'trim', explode( ',', (string) sera_mod( 'hero_rotate' ) ) ), 'strlen' ) );
	$label = trim( $t1 . ' ' . $t2 );
	$first = $words ? $words[0] : '';
	$pos   = ( $first && count( $words ) > 1 ) ? mb_strpos( $t1, $first ) : false;
	if ( false === $pos ) {
		$main = esc_html( $t1 );
	} else {
		$slot = '<span class="slot" aria-hidden="true"><span class="slot-sizer">' . esc_html( $first ) . '</span>';
		foreach ( $words as $i => $w ) {
			$slot .= '<span class="slot-item' . ( 0 === $i ? ' is-on' : '' ) . '">' . esc_html( $w ) . '</span>';
		}
		$slot .= '</span>';
		$main  = esc_html( mb_substr( $t1, 0, $pos ) ) . $slot . esc_html( mb_substr( $t1, $pos + mb_strlen( $first ) ) );
	}
	return '<h1 class="hero-title" aria-label="' . esc_attr( $label ) . '">' . $main . ' <span class="soft">' . esc_html( $t2 ) . '</span></h1>';
}

/**
 * Hover card ("polaroid") for each About item.
 */
function sera_about_pop( $i ) {
	$img_id = absint( sera_mod( 'about_img_' . $i ) );
	$uri    = get_template_directory_uri() . '/assets/img/about/';
	$caps   = array( 1 => sera_t( 'Player 1, loading…', 'Player 1, carregando…' ), 2 => sera_t( 'Greetings from the capital', 'Lembranças da capital' ), 3 => 'MIOPIA & CTRL ALT DEL', 4 => sera_t( 'Runs on espresso', 'Movido a espresso' ) );
	$cap    = isset( $caps[ $i ] ) ? $caps[ $i ] : '';
	if ( $img_id ) {
		$src = wp_get_attachment_image_url( $img_id, 'medium_large' );
		if ( 1 === $i ) {
			$cap = sera_t( 'Me, long before Figma', 'Eu, bem antes do Figma' );
		}
		return '<figure class="about-pop pop-' . (int) $i . '" aria-hidden="true"><span class="ph"><img src="' . esc_url( $src ) . '" alt="" loading="lazy"></span><figcaption>' . esc_html( $cap ) . '</figcaption></figure>';
	}
	switch ( $i ) {
		case 1:
			$art = '<img src="' . esc_url( $uri . 'kid.webp' ) . '" alt="" loading="lazy">';
			$cap = sera_t( 'Me, long before Figma', 'Eu, bem antes do Figma' );
			break;
		case 2:
			$art = '<img src="' . esc_url( $uri . 'brasilia.webp' ) . '" alt="" loading="lazy"><span class="stamp">BSB</span>';
			break;
		case 3:
			$art = '<span class="posters"><img src="' . esc_url( $uri . 'miopia.webp' ) . '" alt="" loading="lazy"><img src="' . esc_url( $uri . 'ctrlaltdel.webp' ) . '" alt="" loading="lazy"></span>';
			break;
		default:
			$art = '<img src="' . esc_url( $uri . 'coffee.webp' ) . '" alt="" loading="lazy"><span class="tags"><b>PT</b><b>EN</b></span>';
	}
	return '<figure class="about-pop pop-' . (int) $i . '" aria-hidden="true"><span class="ph">' . $art . '</span><figcaption>' . esc_html( $cap ) . '</figcaption></figure>';
}
