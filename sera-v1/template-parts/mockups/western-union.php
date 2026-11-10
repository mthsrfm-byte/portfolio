<?php
/**
 * Mockup: Western Union — ID capture step 1 + confirmation.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-wu mockup-hover">
	<span class="brand-chip brand-chip--wu"><?php echo sera_logo_mask( 'western-union', 15 ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-wu mk-scr-front', sera_scr_wu_front() . sera_mk_tap( 196, 729 ), array( 'position' => 'up', 'label' => sera_t( 'Onboarding step 1 of 2: photo of the front of the ID, with numbered instructions', 'Onboarding, etapa 1 de 2: foto da frente do RG, com instruções numeradas' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wu mk-scr-confirm', sera_scr_wu_confirm() . sera_mk_tap( 37, 496, 3.6 ), array( 'position' => 'down', 'label' => sera_t( 'Confirmation: the user checks the photo shows the back of the ID and is legible', 'Confirmação: a pessoa confere se a foto mostra o verso do RG e se está legível' ) ) ); // phpcs:ignore
	?>
</div>
