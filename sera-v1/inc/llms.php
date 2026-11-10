<?php
/**
 * /llms.txt and /llms-full.txt — a plain-text summary of the site for AI crawlers,
 * generated from the Customizer copy and the case meta (no internal figures: the meta is already clean).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

function sera_llms_rewrites() {
	add_rewrite_rule( '^llms\.txt$', 'index.php?sera_llms=summary', 'top' );
	add_rewrite_rule( '^llms-full\.txt$', 'index.php?sera_llms=full', 'top' );
}
add_action( 'init', 'sera_llms_rewrites' );

add_action(
	'after_switch_theme',
	function () {
		sera_llms_rewrites();
		flush_rewrite_rules();
	}
);

add_filter(
	'query_vars',
	function ( $vars ) {
		$vars[] = 'sera_llms';
		return $vars;
	}
);

add_action(
	'template_redirect',
	function () {
		$mode = get_query_var( 'sera_llms' );
		if ( ! $mode ) {
			return;
		}
		$full = 'full' === $mode;
		status_header( 200 );
		nocache_headers();
		header( 'Content-Type: text/markdown; charset=utf-8' );
		header( 'X-Robots-Tag: noindex' );
		echo sera_llms_text( $full ); // phpcs:ignore WordPress.Security.EscapeOutput
		exit;
	}
);

/* robots.txt: point crawlers at /llms.txt (core already adds the Sitemap line when sitemaps are on). */
add_filter(
	'robots_txt',
	function ( $output ) {
		$output .= "\n# AI-readable summary of this site\n# " . home_url( '/llms.txt' ) . "\n# " . home_url( '/llms-full.txt' ) . "\n";
		if ( false === stripos( $output, 'Sitemap:' ) ) {
			$output .= "\nSitemap: " . home_url( '/wp-sitemap.xml' ) . "\n";
		}
		return $output;
	},
	20
);

/**
 * Plain text of one Customizer field (tags stripped, *emphasis* markers removed).
 */
function sera_llms_mod( $key ) {
	return trim( str_replace( '*', '', wp_strip_all_tags( html_entity_decode( (string) sera_mod( $key ), ENT_QUOTES, 'UTF-8' ) ) ) );
}

/**
 * Block markup → Markdown-ish plain text. Artifacts and mockups are dropped.
 */
function sera_llms_body( $content ) {
	$c = (string) $content;
	$c = preg_replace( '#<!-- wp:sera/[^>]*?/-->#', '', $c );
	$c = preg_replace( '#<!-- /?wp:[^>]*-->#', '', $c );
	$c = preg_replace( '#<figure\b[^>]*>.*?</figure>#is', '', $c );
	$c = preg_replace_callback( '#<h([1-6])\b[^>]*>(.*?)</h\1>#is', function ( $m ) { return "\n\n" . str_repeat( '#', max( 2, (int) $m[1] ) ) . ' ' . trim( wp_strip_all_tags( $m[2] ) ) . "\n\n"; }, $c );
	$c = preg_replace_callback( '#<li\b[^>]*>(.*?)</li>#is', function ( $m ) { return "\n- " . trim( wp_strip_all_tags( $m[1] ) ); }, $c );
	$c = preg_replace( '#<(?:p|blockquote|ul|ol|div)\b[^>]*>#i', "\n\n", $c );
	$c = preg_replace( '#</(?:p|blockquote|ul|ol|div)>#i', "\n\n", $c );
	$c = preg_replace( '#<br\s*/?>#i', "\n", $c );
	$c = wp_strip_all_tags( $c );
	$c = html_entity_decode( $c, ENT_QUOTES, 'UTF-8' );
	$c = preg_replace( "/[ \t]+/", ' ', $c );
	$c = preg_replace( "/[ \t]*\n[ \t]*/", "\n", $c );
	$c = preg_replace( "/\n{3,}/", "\n\n", $c );
	return trim( $c );
}

/**
 * The document.
 */
function sera_llms_text( $full = false ) {
	$nl    = "\n";
	$lines = array();

	$lines[] = '# Matheus Serafim';
	$lines[] = '';
	$lines[] = '> Matheus Serafim is a Staff-level Product Designer based in Fortaleza, Brazil, working in fintech (BNPL, credit cards, digital banking, remittances) since 2019.';
	$lines[] = '';
	$lines[] = sera_llms_mod( 'hero_lede' );
	$lines[] = '';
	$lines[] = '- Site: ' . home_url( '/' );
	$linkedin = sera_llms_mod( 'contact_linkedin' );
	if ( $linkedin ) {
		$lines[] = '- LinkedIn: ' . $linkedin;
	}
	$email = sera_llms_mod( 'contact_email' );
	if ( $email ) {
		$lines[] = '- Email: ' . $email;
	}
	$lines[] = '- Current role: ' . sera_llms_mod( 'hero_now_text' ) . ' at Pagaleve';
	$lines[] = '- Status: ' . sera_llms_mod( 'hero_status' );
	$lines[] = '';

	$lines[] = '## How I work';
	$lines[] = '';
	foreach ( array( 1, 2, 3 ) as $i ) {
		$t = sera_llms_mod( 'p' . $i . '_title' );
		if ( ! $t ) {
			continue;
		}
		$lines[] = '### ' . $t;
		$lines[] = '';
		$lines[] = sera_llms_mod( 'p' . $i . '_text' );
		$proof   = sera_llms_mod( 'p' . $i . '_proof' );
		if ( $proof ) {
			$lines[] = '';
			$lines[] = 'Proof: ' . $proof;
		}
		$lines[] = '';
	}

	$lines[] = '## Experience';
	$lines[] = '';
	foreach ( sera_lines( sera_llms_mod( 'xp_items' ), 4 ) as $xp ) {
		$lines[] = '- ' . $xp[0] . ' — ' . $xp[1] . ' — ' . $xp[2] . '. ' . $xp[3];
	}
	$more = sera_llms_mod( 'xp_more' );
	if ( $more ) {
		$lines[] = '';
		$lines[] = $more;
	}
	$lines[] = '';

	$lines[] = '## Case studies';
	$lines[] = '';
	$q = sera_case_query( array( 'post_status' => 'publish' ) );
	foreach ( $q->posts as $p ) {
		$id      = $p->ID;
		$lines[] = '### ' . wp_strip_all_tags( sera_case_headline( $id ) );
		$lines[] = '';
		$lines[] = '- URL: ' . get_permalink( $id );
		foreach ( array( '_sera_company' => 'Company', '_sera_year' => 'Year', '_sera_role' => 'Role' ) as $k => $label ) {
			$v = trim( (string) get_post_meta( $id, $k, true ) );
			if ( $v ) {
				$lines[] = '- ' . $label . ': ' . $v;
			}
		}
		$metrics = sera_case_metrics( $id );
		if ( $metrics ) {
			$lines[] = '- Results: ' . implode( '; ', array_map( function ( $m ) { return trim( $m[0] . ' ' . $m[1] ); }, $metrics ) );
		}
		$chips = sera_case_chips( $id );
		if ( $chips ) {
			$lines[] = '- Topics: ' . implode( ', ', $chips );
		}
		$excerpt = trim( wp_strip_all_tags( has_excerpt( $p ) ? $p->post_excerpt : sera_case_description( $id ) ) );
		if ( $excerpt ) {
			$lines[] = '';
			$lines[] = $excerpt;
		}
		if ( $full ) {
			$body = sera_llms_body( $p->post_content );
			if ( $body ) {
				$lines[] = '';
				$lines[] = $body;
			}
		}
		$lines[] = '';
	}

	// Portuguese version of the site (same content, translated): /pt/ and the case pages under it.
	if ( function_exists( 'sera_lang_url' ) ) {
		$lines[] = '## Português (Brasil)';
		$lines[] = '';
		$lines[] = 'This site is also available in Brazilian Portuguese at ' . sera_lang_url( home_url( '/' ), 'pt' ) . ' (same content, translated).';
		$lines[] = '';
		$lines[] = '- ' . sera_lang_url( home_url( '/' ), 'pt' ) . ': Home';
		foreach ( $q->posts as $p ) {
			$pt_content = get_post_meta( $p->ID, '_sera_content_pt', true );
			if ( ! is_string( $pt_content ) || '' === trim( $pt_content ) ) {
				continue;
			}
			$pt_title = trim( (string) get_post_meta( $p->ID, '_sera_headline_pt', true ) );
			if ( '' === $pt_title ) {
				$pt_title = trim( (string) get_post_meta( $p->ID, '_sera_title_pt', true ) );
			}
			$lines[] = '- ' . sera_lang_url( get_permalink( $p->ID ), 'pt' ) . ': ' . wp_strip_all_tags( '' !== $pt_title ? $pt_title : sera_case_headline( $p->ID ) );
		}
		$lines[] = '';
	}

	if ( ! $full ) {
		$lines[] = '## Full text';
		$lines[] = '';
		$lines[] = '- ' . home_url( '/llms-full.txt' ) . ': every case study as plain text.';
		$lines[] = '';
	}

	return implode( $nl, $lines ) . $nl;
}
