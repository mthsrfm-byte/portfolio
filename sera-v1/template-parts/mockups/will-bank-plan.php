<?php
/**
 * Mockup: will bank — planning ahead: simulate a purchase, best purchase day and due date.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-willbank stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Planning purchases, four screens – scroll sideways', 'Planejar compras, quatro telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_logo_mask( 'will-bank', 15 ); // phpcs:ignore ?><span><?php sera_e( 'plan ahead', 'planejar' ); ?></span></span>
	<?php
	echo sera_device( 'scr-wb', sera_scr_wb_sim(), array( 'caption' => sera_t( 'Simulate before buying', 'Simular antes de comprar' ), 'label' => sera_t( 'Purchase simulation in 6 installments', 'Simulação de compra em 6x' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_sim_result(), array( 'caption' => sera_t( 'Every future bill, with and without the purchase', 'Cada fatura futura, com e sem a compra' ), 'label' => sera_t( 'Future bills with the simulated purchase', 'Faturas futuras com a compra simulada' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_bestday(), array( 'caption' => sera_t( 'The bill cycle as a calendar', 'O ciclo da fatura em calendário' ), 'label' => sera_t( 'Best purchase day on the January calendar', 'Melhor dia de compra no calendário de janeiro' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_due(), array( 'caption' => sera_t( 'Change the due date, see the new best day', 'Mudar o vencimento e ver o novo melhor dia' ), 'label' => sera_t( 'Due date options with the best purchase day for each', 'Opções de vencimento com o melhor dia de compra de cada uma' ) ) ); // phpcs:ignore
	?>
</div>
