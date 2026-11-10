<?php
/**
 * Mockup: Pagaleve · Lume — screens in code: what the team reads back (replay, desktop) + what the customer sees (session, mobile).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="mockup-stage mk-anim stage-rh stage-lume mockup-hover">
	<span class="brand-chip"><?php echo sera_logo_mask( 'pagaleve', 15 ); // phpcs:ignore ?><span>Lume</span></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( sera_lm_desk( 'D6' ), array( 'url' => sera_t( 'lume · designer area', 'lume · área do designer' ), 'class' => 'shots-hero-browser', 'label' => sera_t( 'Lume on desktop: a session replay, with the conversation on the left and the audio player and blocks on the right', 'O Lume no computador: o replay de uma sessão, com a conversa à esquerda e o player e os blocos à direita' ) ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'lmx-screen', sera_lm_phone( 'P5' ), array( 'position' => 'up', 'label' => sera_t( 'A Lume session on mobile: the prototype on screen and the Lume’s question in a card at the bottom', 'Uma sessão do Lume no celular: o protótipo na tela e a pergunta do Lume num cartão embaixo' ) ) ); // phpcs:ignore ?>
	</div>
</div>
