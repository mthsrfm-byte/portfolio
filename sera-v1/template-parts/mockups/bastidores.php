<?php
/**
 * Mockup: Bastidores — the 2026 homepage on desktop + mobile.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-nb mockup-hover">
	<span class="brand-chip"><?php echo sera_nb_logo(); // phpcs:ignore ?></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( sera_scr_nb_after(), array( 'url' => 'nosbastidores.com.br', 'class' => 'is-crop', 'label' => sera_t( 'The redesigned Bastidores homepage on desktop', 'A nova home do Bastidores no desktop' ) ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'scr-nbn-s mk-scr-m1', sera_scr_nb_m1(), array( 'position' => 'up', 'label' => sera_t( 'The redesigned homepage on mobile', 'A nova home no celular' ) ) ); // phpcs:ignore ?>
	</div>
</div>
