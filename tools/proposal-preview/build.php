<?php
/**
 * Static preview of a private proposal: renders the real templates (gate + page) with stubs and
 * inlines CSS, JS, fonts and images into one HTML file. No access code is involved: in the preview,
 * any four digits open the page (0000 shows the error) and forms answer locally.
 *
 * Usage: php tools/proposal-preview/build.php [key] [out.html]
 */

define( 'ABSPATH', __DIR__ . '/' );
$theme = dirname( __DIR__, 2 ) . '/sera-v1';
$key   = isset( $argv[1] ) ? $argv[1] : 'evanly';
$out   = isset( $argv[2] ) ? $argv[2] : __DIR__ . '/' . $key . '-preview.html';

function add_action() {}
function add_filter() {}
function esc_html( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $s ) { return esc_html( $s ); }
function esc_url( $s ) { return esc_html( $s ); }
function disabled( $on ) { echo $on ? ' disabled' : ''; }
function get_template_directory() { return $GLOBALS['theme']; }
function get_template_directory_uri() { return 'THEME'; }
function get_post_meta() { return ''; }
function home_url( $p = '' ) { return 'https://matheusserafim.com' . $p; }
function sanitize_key( $k ) { return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( (string) $k ) ); }
function wp_parse_args( $a, $d = array() ) { return array_merge( (array) $d, (array) $a ); }
function absint( $n ) { return abs( (int) $n ); }
function apply_filters( $h, $v ) { return $v; }
function wp_strip_all_tags( $s ) { return trim( strip_tags( (string) $s ) ); }
function is_admin() { return false; }
function wp_doing_ajax() { return false; }
function get_option( $k, $d = false ) { return 'home' === $k ? 'https://matheusserafim.com' : $d; }
function get_template_part( $slug ) { include $GLOBALS['theme'] . '/' . $slug . '.php'; }
putenv( 'SERA_LANG=en' );
require $theme . '/inc/i18n.php';
require $theme . '/inc/template-tags.php';
foreach ( glob( $theme . '/inc/screens*.php' ) as $f ) { require $f; }
require $theme . '/inc/proposals.php';

$p        = require $theme . '/inc/proposals/' . $key . '.php';
$p['key'] = $key;
$asset    = function ( $rel ) { return 'ASSET:' . $rel; };
$logo     = file_get_contents( $theme . '/assets/img/logo-serafim.svg' );
$photo    = 'data:image/webp;base64,' . base64_encode( file_get_contents( $theme . '/assets/img/proposal-photo.webp' ) );
$url      = '#';

function render( $file, $vars ) {
	extract( $vars );
	ob_start();
	include $file;
	return ob_get_clean();
}
$common = compact( 'p', 'asset', 'logo', 'photo', 'url' );
$gate   = render( $theme . '/template-parts/proposals/gate.php', $common + array( 'error' => '', 'locked' => false, 'ready' => true ) );
$page   = render( $theme . '/template-parts/proposals/' . $key . '.php', $common + array( 'csrf' => 'preview', 'accepted' => null, 'flag' => '', 'expired' => sera_prop_expired( $p ), 'until' => sera_prop_valid_until( $p ) ) );

$body = function ( $html ) {
	preg_match( '#<body[^>]*>(.*)</body>#s', $html, $m );
	return $m[1];
};
preg_match( '#<title>(.*?)</title>#', $page, $t );

// Inline every stylesheet and script the page links (ASSET:path), with url() assets as data URIs.
$data_uri = function ( $file ) {
	$ext  = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
	$mime = array( 'woff2' => 'font/woff2', 'svg' => 'image/svg+xml', 'png' => 'image/png', 'webp' => 'image/webp', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg' );
	return 'data:' . ( isset( $mime[ $ext ] ) ? $mime[ $ext ] : 'application/octet-stream' ) . ';base64,' . base64_encode( file_get_contents( $file ) );
};
$css_of = function ( $rel ) use ( $theme, $data_uri ) {
	$dir = dirname( $theme . '/' . $rel );
	return preg_replace_callback(
		'#url\(\s*["\']?(?!data:|https?:|\#)([^"\')]+)["\']?\s*\)#',
		function ( $m ) use ( $dir, $data_uri ) {
			$f = realpath( $dir . '/' . $m[1] );
			return $f ? 'url("' . $data_uri( $f ) . '")' : $m[0];
		},
		file_get_contents( $theme . '/' . $rel )
	);
};
preg_match_all( '#<link rel="stylesheet" href="ASSET:([^"]+)">#', $page, $lm );
$css = implode( "\n", array_map( $css_of, $lm[1] ) );
preg_match_all( '#<script src="ASSET:([^"]+)"[^>]*></script>#', $page, $sm );
$js = implode( "\n", array_map( function ( $r ) use ( $theme ) { return file_get_contents( $theme . '/' . $r ); }, $sm[1] ) );
// Theme URLs inside markup (logo masks etc.).
$fix = function ( $html ) use ( $theme, $data_uri ) {
	return preg_replace_callback(
		'#THEME/([A-Za-z0-9_./\-]+)#',
		function ( $m ) use ( $theme, $data_uri ) {
			$f = $theme . '/' . $m[1];
			return is_file( $f ) ? $data_uri( $f ) : $m[0];
		},
		$html
	);
};
$gate = $fix( $gate );
$page = $fix( $page );
$icon = 'data:image/svg+xml;base64,' . base64_encode( file_get_contents( $theme . '/assets/img/favicon.svg' ) );

$html = '<!doctype html>
<html lang="en" class="no-js" data-preview>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Private proposal · Matheus Serafim (preview)</title>
<link rel="icon" href="' . $icon . '" type="image/svg+xml">
<style>' . $css . '</style>
</head>
<body class="prop">
<p class="p-preview" role="note">Local preview. Any four digits open it (0000 shows the error); in the live page the code, records and emails are handled by the server.</p>

<div class="prop-gate" data-preview-gate>' . $body( $gate ) . '</div>
<div data-preview-page data-title="' . esc_attr( html_entity_decode( $t[1] ) ) . '" hidden>' . $body( $page ) . '</div>
<script>' . $js . '</script>
</body>
</html>
';
file_put_contents( $out, $html );
echo $out, ' (', round( strlen( $html ) / 1024 ), " KB)\n";
