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
require $theme . '/inc/proposals.php';

$p        = require $theme . '/inc/proposals/' . $key . '.php';
$p['key'] = $key;
$asset    = function ( $rel ) { return 'ASSET:' . $rel; };
$logo     = file_get_contents( $theme . '/assets/img/logo-serafim.svg' );
$photo    = 'data:image/webp;base64,' . base64_encode( file_get_contents( $theme . '/assets/img/headshot.webp' ) );
$url      = '#';

function render( $file, $vars ) {
	extract( $vars );
	ob_start();
	include $file;
	return ob_get_clean();
}
$common = compact( 'p', 'asset', 'logo', 'photo', 'url' );
$gate   = render( $theme . '/template-parts/proposals/gate.php', $common + array( 'error' => '', 'locked' => false, 'ready' => true ) );
$page   = render( $theme . '/template-parts/proposals/' . $key . '.php', $common + array( 'csrf' => 'preview', 'accepted' => null, 'flag' => '' ) );

$body = function ( $html ) {
	preg_match( '#<body[^>]*>(.*)</body>#s', $html, $m );
	return $m[1];
};
preg_match( '#<title>(.*?)</title>#', $page, $t );

$css = file_get_contents( $theme . '/assets/css/proposal.css' );
$css = preg_replace_callback(
	'#url\("\.\./fonts/([^"]+)"\)#',
	function ( $m ) use ( $theme ) {
		return 'url("data:font/woff2;base64,' . base64_encode( file_get_contents( $theme . '/assets/fonts/' . $m[1] ) ) . '")';
	},
	$css
);
$js   = file_get_contents( $theme . '/assets/js/proposal.js' );
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
