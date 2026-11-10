<?php
/**
 * Mockup: Pagaleve · Research Hub — Ask the archive, desktop + mobile, in the hero stage.
 * Recreated screens: fictional studies and answers.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-rh">
	<span class="brand-chip"><?php echo sera_logo_mask( 'pagaleve', 15 ); // phpcs:ignore ?></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( sera_scr_rh_ask(), array( 'url' => sera_t( 'research-hub · internal', 'research-hub · interno' ), 'class' => 'is-crop', 'label' => sera_t( 'Ask the archive on desktop: the hub menu, a question limited to two studies and an answer with a source on every point', 'Pergunte ao acervo no desktop: o menu do hub, uma pergunta limitada a dois estudos e uma resposta com fonte em cada ponto' ) ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'scr-rh', sera_scr_rh_ask_mobile(), array( 'position' => 'up', 'label' => sera_t( 'Ask the archive on mobile: a blank page with starting questions', 'Pergunte ao acervo no celular: uma página em branco com perguntas para começar' ) ) ); // phpcs:ignore ?>
	</div>
</div>
