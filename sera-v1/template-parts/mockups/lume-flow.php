<?php
/**
 * Mockup: Pagaleve · Lume — the participant's session, 7 screens in code.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$steps = array(
	array( 'P1', sera_t( '1 · One screening question', '1 · Uma pergunta de triagem' ), sera_t( 'Screening question with one option tapped', 'Pergunta de triagem com uma opção tocada' ) ),
	array( 'P2', sera_t( '2 · Say “hi”: the mic check', '2 · Diga “oi”: teste do microfone' ), sera_t( 'Microphone check: say hi, the waveform reacts', 'Teste do microfone: diga oi, a onda reage' ) ),
	array( 'P3', sera_t( '3 · Think out loud, with examples', '3 · Pensar em voz alta, com exemplos' ), sera_t( 'Think-aloud examples and a checkbox', 'Exemplos de pensar em voz alta e um checkbox' ) ),
	array( 'P4', sera_t( '4 · The Lume intro while it loads', '4 · A abertura do Lume enquanto carrega' ), sera_t( 'The Lume’s intro and the scenario while the prototype loads', 'A abertura do Lume e o cenário enquanto o protótipo carrega' ) ),
	array( 'P5b', sera_t( '5 · Released: go ahead and tap', '5 · Liberado: pode tocar' ), sera_t( 'The prototype full screen; the Lume waits for the tap the person described', 'O protótipo em tela cheia; o Lume espera o toque que a pessoa descreveu' ) ),
	array( 'P6', sera_t( '6 · A quick rating', '6 · Uma nota rápida' ), sera_t( 'An ease rating from 1 to 5', 'Uma nota de facilidade de 1 a 5' ) ),
	array( 'P7', sera_t( '7 · The coupon date, and goodbye', '7 · A data do cupom e tchau' ), sera_t( 'Final screen with the coupon date', 'Tela final com a data do cupom' ) ),
);
?>
<div class="mockup-stage mk-anim stage-rh stage-lume stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'A Lume session in seven screens – scroll sideways', 'Uma sessão do Lume em sete telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_logo_mask( 'pagaleve', 15 ); // phpcs:ignore ?><span>Lume</span></span>
	<?php
	foreach ( $steps as $s ) {
		echo sera_device( 'lmx-screen', sera_lm_phone( $s[0] ), array( 'dark' => 'P4' === $s[0], 'caption' => $s[1], 'label' => $s[2] ) ); // phpcs:ignore
	}
	?>
</div>
