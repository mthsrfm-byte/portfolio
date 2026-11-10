<?php
/**
 * Mockup: Western Union — before (one ambiguous step) × after (two distinct steps).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-wu stage-row stage-ba" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Before and after, three screens – scroll sideways', 'Antes e depois, três telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip brand-chip--wu"><?php echo sera_logo_mask( 'western-union', 15 ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-wu mk-scr-before', sera_scr_wu_before() . sera_mk_tap( 196, 664 ), array( 'dark' => true, 'caption' => sera_t( 'Before · one step, two photos, same screen', 'Antes · uma etapa, duas fotos, a mesma tela' ), 'label' => sera_t( 'Before: a single step asking for one photo showing both sides of the ID', 'Antes: uma etapa só, pedindo as fotos dos dois lados do RG' ) ) ); // phpcs:ignore
	?>
	<span class="ba-arrow" aria-hidden="true"><?php echo sera_icon( 'arrow-right' ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-wu mk-scr-front', sera_scr_wu_front() . sera_mk_tap( 196, 729 ), array( 'caption' => sera_t( 'After · step 1, the front', 'Depois · etapa 1, a frente' ), 'label' => sera_t( 'After: step 1 of 2, front of the ID', 'Depois: etapa 1 de 2, frente do RG' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-wu mk-scr-back', sera_scr_wu_back_dark(), array( 'dark' => true, 'caption' => sera_t( 'After · step 2, the back, on a new background', 'Depois · etapa 2, o verso, num fundo novo' ), 'label' => sera_t( 'After: step 2 of 2, back of the ID, visually distinct', 'Depois: etapa 2 de 2, verso do RG, visualmente diferente' ) ) ); // phpcs:ignore
	?>
</div>
