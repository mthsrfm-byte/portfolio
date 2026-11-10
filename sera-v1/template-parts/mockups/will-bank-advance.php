<?php
/**
 * Mockup: will bank — paying installments early with a discount.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-willbank stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Paying installments early, four screens – scroll sideways', 'Antecipar parcelas, quatro telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_logo_mask( 'will-bank', 15 ); // phpcs:ignore ?><span><?php sera_e( 'pay early', 'antecipar parcelas' ); ?></span></span>
	<?php
	echo sera_device( 'scr-wb', sera_scr_wb_adv_pick(), array( 'caption' => sera_t( 'Pick which future installments to pay now', 'Escolher quais parcelas futuras pagar agora' ), 'label' => sera_t( 'Choosing installments 4 to 7 of 10', 'Escolha das parcelas 4 a 7 de 10' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_adv_review(), array( 'caption' => sera_t( 'The discount, before confirming', 'O desconto, antes de confirmar' ), 'label' => sera_t( 'Review with the amount and the discount', 'Revisão com o valor e o desconto' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_adv_done(), array( 'caption' => sera_t( 'The next bills, already recalculated', 'As próximas faturas, já recalculadas' ), 'label' => sera_t( 'Confirmation with the recalculated bills', 'Confirmação com as faturas recalculadas' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wb', sera_scr_wb_limit(), array( 'caption' => sera_t( 'The limit back on the spot', 'O limite de volta na hora' ), 'label' => sera_t( 'Notification and the limit freed by the Pix', 'Notificação e o limite liberado pelo Pix' ) ) ); // phpcs:ignore
	?>
</div>
