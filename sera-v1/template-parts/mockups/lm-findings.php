<?php
/**
 * Mockup: Lume · findings while the field is open, the same screen on desktop and on the phone (code).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="lmx-duo mk-anim">
	<figure class="lmx-duo-desk"><?php echo '<div class="rh-fit">' . sera_browser( sera_lm_desk( 'D5' ), array( 'url' => sera_t( 'lume · designer area', 'lume · área do designer' ), 'label' => sera_t( 'Findings on desktop: each finding with how many sessions back it up and a quote, and the sessions list with one live', 'Achados no computador: cada achado com quantas sessões o sustentam e uma citação, e a lista de sessões com uma ao vivo' ) ) ) . '</div>'; // phpcs:ignore ?></figure>
	<div class="lmx-duo-ph"><?php echo sera_device( 'lmx-screen', sera_lm_phone( 'M5' ), array( 'label' => sera_t( 'Findings on the phone: the same findings stacked, quotes below each one', 'Achados no celular: os mesmos achados empilhados, com a citação embaixo de cada um' ) ) ); // phpcs:ignore ?></div>
</div>
<p class="lmx-duo-cap"><?php sera_e( 'Findings fill in as sessions land, on the laptop and on the phone. Studies, quotes and figures are fictional.', 'Os achados se preenchem conforme as sessões chegam, no computador e no celular. Estudos, citações e números são fictícios.' ); ?></p>
