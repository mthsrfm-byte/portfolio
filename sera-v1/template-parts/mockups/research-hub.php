<?php
/**
 * Mockup: Pagaleve · Research Hub — real screens (anonymised): the archive home (desktop) + ask the archive (mobile).
 * Studies, people, quotes and figures are fictional.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/rh-shots-slider.php';

$desk = '<div class="shots-hero-page">' . sera_rh_shot_img( '01-home', 'desk', '', false ) . '</div>';
$mob  = sera_rh_shot_phone( '06-ask', '', false );
?>
<div class="mockup-stage mk-anim stage-rh mockup-hover">
	<span class="brand-chip"><?php echo sera_logo_mask( 'pagaleve', 15 ); // phpcs:ignore ?></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( $desk, array( 'url' => sera_t( 'research-hub · internal', 'research-hub · interno' ), 'class' => 'shots-hero-browser', 'label' => sera_t( 'Research Hub home on desktop: a greeting, a headline about everything the team has learned, shortcuts and the published roadmap', 'Home do Research Hub no desktop: uma saudação, um título sobre tudo o que o time já aprendeu, atalhos e o roadmap publicado' ) ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'scr-rh shots-screen', $mob, array( 'position' => 'up', 'label' => sera_t( 'Ask the archive on mobile: a blank page with starting questions', 'Pergunte ao acervo no celular: uma página em branco com perguntas para começar' ) ) ); // phpcs:ignore ?>
	</div>
</div>
