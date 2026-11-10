<?php
/**
 * Mockup: will bank — bills over time: past, open and upcoming.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-willbank stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Bills over time, two screens – scroll sideways', 'Faturas no tempo, duas telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_logo_mask( 'will-bank', 15 ); // phpcs:ignore ?><span><?php sera_e( 'bills', 'faturas' ); ?></span></span>
	<?php
	echo sera_device( 'scr-wb', sera_scr_wb_bills(), array( 'caption' => sera_t( 'Paid, open and upcoming bills on one timeline', 'Pagas, aberta e previstas numa linha do tempo' ), 'label' => sera_t( 'Bills timeline with the open January bill', 'Linha do tempo das faturas com janeiro aberta' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_bill_next(), array( 'caption' => sera_t( 'Next month’s bill, before it even opens', 'A fatura do mês que vem, antes de abrir' ), 'label' => sera_t( 'Upcoming February bill and what is already in it', 'Fatura prevista de fevereiro e o que já está nela' ) ) ); // phpcs:ignore
	?>
</div>
