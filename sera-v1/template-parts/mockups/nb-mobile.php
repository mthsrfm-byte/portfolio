<?php
/**
 * Mockup: Bastidores — mobile, before × after.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-nb stage-row" tabindex="0" aria-label="<?php echo esc_attr( sera_t( 'Mobile before and after, three screens – scroll sideways', 'Celular, antes e depois, três telas – deslize para o lado' ) ); ?>">
	<span class="brand-chip"><?php echo sera_nb_logo(); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-nbo mk-scr-old', sera_scr_nb_before_m(), array( 'caption' => sera_t( 'Before · menus and thumbnails before the first story', 'Antes · menus e miniaturas antes da primeira matéria' ), 'label' => sera_t( 'The 2022 homepage on mobile', 'A home de 2022 no celular' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-nbn-s mk-scr-m1', sera_scr_nb_m1(), array( 'caption' => sera_t( 'After · the story is the first thing you see', 'Depois · a matéria é a primeira coisa que você vê' ), 'label' => sera_t( 'The 2026 homepage on mobile: hero', 'A home de 2026 no celular: topo' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-nbn-s mk-scr-m2', sera_scr_nb_m2(), array( 'caption' => sera_t( 'After · sections and ads with their own place', 'Depois · seções e anúncios com lugar próprio' ), 'label' => sera_t( 'The 2026 homepage on mobile: sections and an ad slot', 'A home de 2026 no celular: seções e um espaço de anúncio' ) ) ); // phpcs:ignore
	?>
</div>
