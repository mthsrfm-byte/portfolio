<?php
/**
 * Mockup: Pagaleve — Home offer card + choose a new date.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-pagaleve mockup-hover">
	<span class="brand-chip"><?php echo sera_logo_mask( 'pagaleve', 15 ); // phpcs:ignore ?></span>
	<?php
	echo sera_device( 'scr-pg mk-scr-home', sera_scr_pg_home() . sera_mk_tap( 196, 558 ), array( 'position' => 'down', 'label' => sera_t( 'Pagaleve app home showing the card “Não vai dar pra pagar dia 23?”', 'Home do app da Pagaleve com o card “Não vai dar pra pagar dia 23?”' ) ) ); // phpcs:ignore
	echo sera_device( 'scr-pg mk-scr-date', sera_scr_pg_date() . sera_mk_tap( 196, 403, 3.6 ), array( 'position' => 'up', 'label' => sera_t( 'Choosing a new due date: +3, +5 or +7 days with the final amount of each option', 'Escolha do novo vencimento: +3, +5 ou +7 dias, com o valor final de cada opção' ) ) ); // phpcs:ignore
	?>
</div>
