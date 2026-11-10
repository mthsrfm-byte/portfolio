<?php
/**
 * Mockup: will bank — credit card home + installments list.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-willbank mockup-hover">
	<span class="brand-chip"><?php echo sera_logo_mask( 'will-bank', 15 ); // phpcs:ignore ?><span><?php sera_e( 'credit card', 'cartão de crédito' ); ?></span></span>
	<?php
	echo sera_device( 'scr-wb mk-scr-card', sera_scr_wb_card() . sera_mk_toast( 'will bank', 'Compra aprovada', 'R$ 316,60 no Mercadinho Santa Tereza, já na fatura aberta.' ) . sera_mk_tap( 196, 655, 3.6, 'mk-solo' ) . sera_wb_sheet_split( 'mk-solo' ), array( 'position' => 'down', 'label' => sera_t( 'Credit card screen: open bill updated in real time, due and closing dates, available limit', 'Tela do cartão de crédito: fatura aberta atualizada em tempo real, vencimento, fechamento e limite disponível' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb mk-scr-list', sera_scr_wb_list() . sera_mk_tap( 196, 397, 3.6 ) . sera_wb_sheet_inst(), array( 'position' => 'up', 'label' => sera_t( 'Latest purchases with every installment purchase listed', 'Últimas compras, com todas as compras parceladas listadas' ) ) ); // phpcs:ignore
	?>
</div>
