<?php
/**
 * Proposal access gate. Shows nothing about the proposal beyond who it was prepared for.
 *
 * Variables: $p, $url, $error, $locked, $ready, $asset, $logo.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$sera_msg = '';
if ( ! $ready ) {
	$sera_msg = "This proposal isn't available right now.";
} elseif ( $locked || 'e-locked' === $error ) {
	$sera_msg = 'Too many attempts. Please try again later.';
} elseif ( 'e-code' === $error ) {
	$sera_msg = "That code doesn't match. Please try again.";
} elseif ( 'e-session' === $error || 'e-token' === $error ) {
	$sera_msg = 'Your session has ended. Enter your code to continue.';
}
$sera_info = 'left' === $error ? "You've left the proposal. Enter your code to view it again." : '';
$sera_off  = ! $ready || $locked;
?><!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
<meta name="referrer" content="no-referrer">
<title>Private proposal · Matheus Serafim</title>
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/favicon.svg' ); ?>" type="image/svg+xml">
<link rel="stylesheet" href="<?php echo esc_url( $asset( 'assets/css/proposal.css' ) ); ?>">
<script src="<?php echo esc_url( $asset( 'assets/js/proposal.js' ) ); ?>" defer></script>
</head>
<body class="prop prop-gate">
<main class="gate" id="content">
	<div class="gate-card">
		<span class="gate-logo" aria-hidden="true"><?php echo $logo; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<h1 class="gate-title">A private proposal, prepared for <?php echo esc_html( $p['client'] ); ?>.</h1>
		<p class="gate-lede" id="gate-help">Enter your four-digit access code to continue.</p>
		<form class="gate-form" method="post" action="<?php echo esc_url( $url ); ?>" data-prop-form="unlock" novalidate>
			<input type="hidden" name="sera_action" value="unlock">
			<label class="screen-reader-text" for="gate-code">Access code</label>
			<input class="gate-code" id="gate-code" name="code" type="text" inputmode="numeric" pattern="[0-9]{4}" maxlength="4" autocomplete="one-time-code" placeholder="····" spellcheck="false" required aria-describedby="gate-help gate-msg"<?php echo $sera_msg && ! $sera_off ? ' aria-invalid="true"' : ''; ?><?php disabled( $sera_off ); ?> autofocus>
			<button class="p-btn p-btn-ink gate-btn" type="submit"<?php disabled( $sera_off ); ?>><span class="p-btn-label">View proposal</span></button>
			<p class="gate-msg<?php echo $sera_msg ? ' is-error' : ''; ?>" id="gate-msg" role="alert"><?php echo esc_html( $sera_msg ? $sera_msg : $sera_info ); ?></p>
		</form>
	</div>
	<p class="gate-foot">Matheus Serafim, Staff Product Designer</p>
</main>
</body>
</html>
