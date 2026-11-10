<?php
/**
 * Mockup: Fatal Model · PerfisAD — interview flow (3 screens).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-fm stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'The interview flow, three screens – scroll sideways', 'O fluxo da entrevista, três telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_fm_logo( 'chip-logo' ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-fm mk-scr-ask', sera_scr_fm_ask() . sera_mk_tap( 196, 576, 0, 'is-light' ), array( 'dark' => true, 'caption' => sera_t( 'A question on video, answered in video, audio or text', 'Uma pergunta em vídeo, respondida em vídeo, áudio ou texto' ), 'label' => sera_t( 'Video question', 'Pergunta em vídeo' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-fm mk-scr-rec', sera_scr_fm_rec(), array( 'dark' => true, 'caption' => sera_t( 'Answered in their own time and space, transcribed automatically', 'Respondida no tempo e no espaço de cada pessoa, com transcrição automática' ), 'label' => sera_t( 'Recording an answer', 'Gravando uma resposta' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-fm mk-scr-survey', sera_scr_fm_survey() . sera_mk_tap( 196, 406, 0, 'is-light' ) . sera_mk_tap( 196, 778, 3.6, 'is-light' ), array( 'dark' => true, 'caption' => sera_t( 'Then a survey to check the patterns at scale', 'Depois, um questionário para checar os padrões em escala' ), 'label' => sera_t( 'Survey question', 'Pergunta do questionário' ) ) ); // phpcs:ignore
	?>
</div>
