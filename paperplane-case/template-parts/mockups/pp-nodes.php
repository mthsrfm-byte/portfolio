<?php
/**
 * Mockup: Paperplane · storyboard, advanced mode: every take is a tree (references → request → takes).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-pp pp-wide-stage">
	<span class="brand-chip"><span class="pp-chip-logo"><?php echo sera_pp_logo(); // phpcs:ignore ?></span><span>Paperplane</span></span>
	<?php echo sera_browser( sera_pp_desk( 'nodes' ), array( 'url' => 'paperplane.studio/storyboard · modo avançado', 'class' => 'pp-wide-browser', 'label' => 'O storyboard em modo avançado: estilo, personagem, quadro anterior e cenário ligados ao pedido da tomada 3F, e o take aprovado com modelo, seed e custo' ) ); // phpcs:ignore ?>
</div>
