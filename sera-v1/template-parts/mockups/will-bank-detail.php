<?php
/**
 * Mockup: will bank — purchase detail, open bill, installments.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-willbank stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Credit card screens, three screens – scroll sideways', 'Telas do cartão de crédito, três telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_logo_mask( 'will-bank', 15 ); // phpcs:ignore ?><span><?php sera_e( 'credit card', 'cartão de crédito' ); ?></span></span>
	<?php
	echo sera_device( 'scr-wb mk-scr-detail', sera_scr_wb_detail() . sera_mk_tap( 196, 376, 3.6 ) . sera_wb_sheet_split(), array( 'caption' => sera_t( 'Every purchase, visible the moment it’s approved', 'Cada compra visível assim que é aprovada' ), 'label' => sera_t( 'Purchase detail', 'Detalhes da compra' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb mk-scr-card', sera_scr_wb_card() . sera_mk_toast( 'will bank', 'Compra aprovada', 'R$ 316,60 no Mercadinho Santa Tereza, já na fatura aberta.' ), array( 'caption' => sera_t( 'An open bill that updates in real time', 'Uma fatura aberta que se atualiza em tempo real' ), 'label' => sera_t( 'Credit card home with the open bill', 'Home do cartão de crédito com a fatura aberta' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb mk-scr-list', sera_scr_wb_list() . sera_mk_tap( 196, 397, 3.6 ) . sera_wb_sheet_inst(), array( 'caption' => sera_t( 'All installments, from day one of the bill', 'Todas as parcelas, desde o primeiro dia da fatura' ), 'label' => sera_t( 'Installment purchases list', 'Lista de compras parceladas' ) ) ); // phpcs:ignore
	?>
</div>
