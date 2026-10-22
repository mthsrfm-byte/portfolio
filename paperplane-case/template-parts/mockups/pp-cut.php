<?php
/**
 * Mockup: Paperplane · filming: the montage on desktop (export menu with the 4K upscale) + the animation step on the phone.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-pp pp-cut-stage mockup-hover">
	<span class="brand-chip"><span class="pp-chip-logo"><?php echo sera_pp_logo(); // phpcs:ignore ?></span><span>Paperplane</span></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( sera_pp_desk( 'montagem' ), array( 'url' => 'paperplane.studio/montagem', 'class' => 'pp-hero-browser', 'label' => 'A montagem no computador: linha do tempo com vídeo, efeitos, falas e trilha, e o menu de exportação com upscale até 4K' ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'ppx-screen', sera_pp_phone( 'animacao' ), array( 'position' => 'up', 'label' => 'A animação no celular: o quadro aprovado, o que se move na tomada e o preço do take antes de gerar' ) ); // phpcs:ignore ?>
	</div>
</div>
