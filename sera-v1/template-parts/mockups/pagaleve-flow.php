<?php
/**
 * Mockup: Pagaleve — the complete Combina Antes flow, 4 screens.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-pagaleve stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'The Combina Antes flow, four screens – scroll sideways', 'O fluxo do Combina Antes em quatro telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_logo_mask( 'pagaleve', 15 ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-pg mk-scr-home', sera_scr_pg_home() . sera_mk_tap( 196, 558 ), array( 'caption' => sera_t( '1 · The heads-up, 5 days before', '1 · O aviso, 5 dias antes' ), 'label' => sera_t( 'Home with the heads-up card', 'Home com o card de aviso' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-pg mk-scr-date', sera_scr_pg_date() . sera_mk_tap( 196, 403, 3.6 ), array( 'caption' => sera_t( '2 · Pick a date, see the final amount', '2 · Escolha a data e veja o valor final' ), 'label' => sera_t( 'Choose a new date', 'Escolha de uma nova data' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-pg mk-scr-review', sera_scr_pg_review() . sera_mk_tap( 31, 599, 0, '', array( 165, 194 ) ), array( 'caption' => sera_t( '3 · Review the rule, accept, confirm', '3 · Revise a regra, aceite e confirme' ), 'label' => sera_t( 'Review and accept the agreement', 'Revisão e aceite do acordo' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-pg mk-scr-done', sera_scr_pg_done() . sera_mk_tap( 196, 733, 3.6 ) . sera_mk_toast( 'Calendário', 'Adicionado à agenda', 'Qua, 30/09 · Parcela Pagaleve R$ 69,51' ), array( 'caption' => sera_t( '4 · Agreed, with reminder and Pix ready', '4 · Combinado, lembrete e Pix pronto' ), 'label' => sera_t( 'Agreement confirmed with a timeline', 'Acordo confirmado, com a linha do tempo' ) ) ); // phpcs:ignore
	?>
</div>
