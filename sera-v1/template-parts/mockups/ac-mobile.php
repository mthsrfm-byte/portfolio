<?php
/**
 * Mockup: Acordo Certo — the new homepage on mobile.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-ac stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'The new homepage on mobile, three screens – scroll sideways', 'A nova home no celular, três telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_ac_logo( 'chip-logo' ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-acm mk-scr-m1', sera_scr_ac_m1() . sera_mk_tap( 196, 351, 0, '', array( 0, 62 ) ), array( 'caption' => sera_t( 'One promise, one field, one button', 'Uma promessa, um campo, um botão' ), 'label' => sera_t( 'Mobile hero with the CPF field', 'Topo no celular, com o campo de CPF' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-acm mk-scr-m2', sera_scr_ac_m2(), array( 'caption' => sera_t( 'No phone calls, and the process in 4 steps', 'Sem ligações, e o processo em 4 passos' ), 'label' => sera_t( 'Mobile: benefits and how it works', 'Celular: benefícios e como funciona' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-acm mk-scr-m3', sera_scr_ac_m3() . sera_mk_tap( 196, 757, 3.6 ), array( 'caption' => sera_t( 'Proof and answers before the doubt', 'Prova e respostas antes da dúvida' ), 'label' => sera_t( 'Mobile: numbers, reviews and FAQ', 'Celular: números, avaliações e perguntas frequentes' ) ) ); // phpcs:ignore
	?>
</div>
