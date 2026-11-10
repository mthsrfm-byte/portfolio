<?php
/**
 * Mockup: Acordo Certo — hero stage (new homepage on desktop + mobile).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-ac mockup-hover">
	<span class="brand-chip"><?php echo sera_ac_logo( 'chip-logo' ); // phpcs:ignore ?></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( sera_scr_ac_after() . sera_mk_cursor( 248, 538, 257, 0 ), array( 'class' => 'is-crop', 'label' => sera_t( 'New Acordo Certo homepage on desktop', 'Nova home da Acordo Certo no desktop' ) ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'scr-acm mk-scr-m1', sera_scr_ac_m1() . sera_mk_tap( 196, 351, 0, '', array( 0, 62 ) ), array( 'position' => 'up', 'label' => sera_t( 'New homepage on mobile', 'Nova home no celular' ) ) ); // phpcs:ignore ?>
	</div>
</div>
