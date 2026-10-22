<?php
/**
 * Mockup: Paperplane Studio — screens in code: the storyboard on desktop + the phone home ("continue where I left off").
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-pp mockup-hover">
	<span class="brand-chip"><span class="pp-chip-logo"><?php echo sera_pp_logo(); // phpcs:ignore ?></span><span>Paperplane</span></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( sera_pp_desk( 'storyboard' ), array( 'url' => 'paperplane.studio/storyboard', 'class' => 'pp-hero-browser', 'label' => 'O Paperplane no computador: o storyboard da cena 3, com oito de nove tomadas aprovadas antes de animar' ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'ppx-screen', sera_pp_phone( 'inicio' ), array( 'position' => 'up', 'label' => 'O Paperplane no celular: a home do projeto, com o storyboard pronto e o botão para continuar de onde parou' ) ); // phpcs:ignore ?>
	</div>
</div>
