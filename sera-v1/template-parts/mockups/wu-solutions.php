<?php
/**
 * Mockup: Western Union — supporting solutions.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-wu stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Supporting solutions, four screens – scroll sideways', 'Soluções de apoio, quatro telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip brand-chip--wu"><?php echo sera_logo_mask( 'western-union', 15 ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-wu mk-scr-camera', sera_scr_wu_camera(), array( 'caption' => sera_t( 'Framing guide in the camera', 'Guia de enquadramento na câmera' ), 'label' => sera_t( 'Camera with a framing guide for the ID', 'Câmera com guia de enquadramento para o RG' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wu mk-scr-confirm', sera_scr_wu_confirm() . sera_mk_tap( 37, 496, 3.6 ), array( 'caption' => sera_t( 'Confirm before sending', 'Confirmar antes de enviar' ), 'label' => sera_t( 'Confirmation checkboxes before sending', 'Checkboxes de confirmação antes de enviar' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wu mk-scr-otp', sera_scr_wu_otp(), array( 'caption' => sera_t( 'Translation QA across the funnel', 'QA de tradução no funil inteiro' ), 'label' => sera_t( 'SMS code screen, fully translated', 'Tela do código por SMS, toda em português' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wu mk-scr-almost', sera_scr_wu_almost() . sera_mk_tap( 196, 791, 3.6 ) . sera_mk_toast( 'Western Union', 'Sua conta está aberta', 'Complete o cadastro quando quiser para receber dinheiro.' ), array( 'caption' => sera_t( 'Two steps moved to after the account opens', 'Duas etapas movidas para depois da abertura da conta' ), 'label' => sera_t( 'Remaining details can be completed later', 'Os dados restantes podem ser preenchidos depois' ) ) ); // phpcs:ignore
	?>
</div>
