<?php
/**
 * Footer / contact.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$email    = sera_mod( 'contact_email' );
$linkedin = sera_mod( 'contact_linkedin' );
$resume   = sera_mod( 'contact_resume' );
// Coffee cup (credits line + slot machine reels).
$sera_cup = '<svg class="fs-cup" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 7h8v3.2A3.3 3.3 0 0 1 7.7 13.5h-1.4A3.3 3.3 0 0 1 3 10.2Z"/><path d="M11 8h.9a1.6 1.6 0 0 1 0 3.2H10.7"/><path d="M5.6 2.6c-.5.6.5 1.1 0 1.8M8.4 2.6c-.5.6.5 1.1 0 1.8"/></svg>';
?>
</main>

<footer class="site-footer" id="contact">
	<svg class="liquid-defs" width="0" height="0" aria-hidden="true" focusable="false"><filter id="sera-liquid" x="-5%" y="-20%" width="110%" height="140%" color-interpolation-filters="sRGB"><feTurbulence type="fractalNoise" baseFrequency="0.004 0.014" numOctaves="1" seed="7" result="n"/><feGaussianBlur in="n" stdDeviation="7" result="s"/><feDisplacementMap in="SourceGraphic" in2="s" scale="0" xChannelSelector="R" yChannelSelector="G"/></filter></svg>
	<div class="wrap">
		<span class="eyebrow"><?php sera_e( 'Contact', 'Contato' ); ?></span>
		<h2 class="footer-title"><?php echo esc_html( sera_mod( 'contact_title' ) ); ?> <span class="soft"><?php echo esc_html( sera_mod( 'contact_title_2' ) ); ?></span></h2>
		<?php if ( $email ) : ?>
			<a class="footer-mail" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?> <?php echo sera_icon( 'arrow-up-right' ); // phpcs:ignore ?></a>
		<?php endif; ?>

		<div class="footer-bottom">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( sera_t( 'Matheus Serafim — home', 'Matheus Serafim — início' ) ); ?>"><?php echo sera_brand_logo(); // phpcs:ignore ?></a>
			<?php
			// Easter egg: a tiny slot machine on the footer's last line. Tap it, or keep pulling once you hit the end.
			// Symbols: 7 · coffee (cup defined at the top) · 3 · ✦ · 1 (the jackpot is 7-7-7 or coffee-coffee-coffee).
			$sera_reel = '<span class="fs-reel"><span class="fs-strip">' . str_repeat( '<i>7</i><i>' . $sera_cup . '</i><i>3</i><i>✦</i><i>1</i>', 3 ) . '</span></span>';
			?>
			<div class="footer-slot">
				<button class="fs-machine" type="button" aria-describedby="fs-msg">
					<span class="fs-reels" aria-hidden="true"><?php echo $sera_reel . $sera_reel . $sera_reel; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="screen-reader-text"><?php sera_e( 'Spin the slot machine', 'Girar o caça-níquel' ); ?></span>
				</button>
				<span class="fs-msg" id="fs-msg" aria-live="polite"><span class="fs-line"><?php sera_e( 'The end. Pull for luck.', 'Fim. Tenta a sorte.' ); ?></span></span>
				<?php $sera_win = $linkedin ? $linkedin : ( $email ? 'mailto:' . antispambot( $email ) : '#contact' ); ?>
				<a class="fs-win" tabindex="-1" aria-hidden="true" href="<?php echo esc_url( $sera_win ); ?>"<?php echo $linkedin ? ' target="_blank" rel="noopener"' : ''; ?>><?php sera_e( 'Jackpot. Now hire me', 'Bingo! Agora me contrata' ); ?> ↗</a>
			</div>
			<span class="footer-credit"><?php echo $sera_cup; // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php sera_e( 'Powered by coffee.', 'Movido a café.' ); ?> <?php sera_e( 'Designed by', 'Desenhado por' ); ?> Matheus Serafim <span class="fc-y"><span class="fc-sep" aria-hidden="true">|</span>©&nbsp;<?php echo esc_html( gmdate( 'Y' ) ); ?></span></span></span>
			<nav aria-label="<?php echo esc_attr( sera_t( 'Footer', 'Rodapé' ) ); ?>">
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'depth'          => 1,
							'items_wrap'     => '<ul class="footer-menu">%3$s</ul>',
						)
					);
					?>
				<?php else : ?>
					<?php if ( $linkedin ) : ?><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener">LinkedIn ↗</a><?php endif; ?>
					<?php if ( $resume ) : ?><a href="<?php echo esc_url( $resume ); ?>" target="_blank" rel="noopener"><?php sera_e( 'Resume', 'Currículo' ); ?> ↗</a><?php endif; ?>
				<?php endif; ?>
				<a href="#top"><?php sera_e( 'Back to top', 'Voltar ao topo' ); ?> ↑</a>
			</nav>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
