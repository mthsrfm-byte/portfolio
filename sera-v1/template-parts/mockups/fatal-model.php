<?php
/**
 * Mockup: Fatal Model · PerfisAD — the asynchronous interview.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-fm mockup-hover">
	<span class="brand-chip"><?php echo sera_fm_logo( 'chip-logo' ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-fm mk-scr-ask', sera_scr_fm_ask() . sera_mk_tap( 196, 576, 0, 'is-light' ) . sera_mk_tap( 196, 642, 3.6, 'is-light mk-solo' ), array( 'dark' => true, 'label' => sera_t( 'A video question from the research team', 'Uma pergunta em vídeo do time de pesquisa' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-fm mk-scr-rec', sera_scr_fm_rec(), array( 'position' => 'up', 'dark' => true, 'label' => sera_t( 'An advertiser answering on video, with automatic transcription', 'Resposta em vídeo de quem anuncia, com transcrição automática' ) ) ); // phpcs:ignore
	?>
</div>
