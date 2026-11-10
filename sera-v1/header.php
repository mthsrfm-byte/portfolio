<?php
/**
 * Header.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

// Language switcher: real links to this page in each language (no JS needed to switch).
$sera_langs = function_exists( 'sera_lang_switch_items' ) ? sera_lang_switch_items() : array();
$sera_cur   = function_exists( 'sera_lang' ) ? sera_lang() : 'en';
$sera_other = 'pt' === $sera_cur ? 'en' : 'pt';
$sera_meta  = array(
	'en' => array(
		'name'     => 'English',
		'exonym'   => 'Inglês',
		'hreflang' => 'en',
	),
	'pt' => array(
		'name'     => 'Português (Brasil)',
		'exonym'   => 'Portuguese (Brazil)',
		'hreflang' => 'pt-BR',
	),
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php sera_e( 'Skip to content', 'Pular para o conteúdo' ); ?></a>

<header class="site-header" id="top">
	<div class="wrap">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( sera_t( 'Matheus Serafim — home', 'Matheus Serafim — início' ) ); ?>">
			<?php echo sera_brand_logo(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span class="brand-name">Matheus Serafim</span>
		</a>

		<nav class="primary-nav" id="primary-nav" aria-label="<?php echo esc_attr( sera_t( 'Main', 'Principal' ) ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'depth'          => 1,
					)
				);
			} else {
				// The fallback menu lives in functions.php with English labels: translate them here.
				ob_start();
				sera_fallback_menu();
				$sera_fb = ob_get_clean();
				if ( function_exists( 'sera_is_pt' ) && sera_is_pt() && function_exists( 'sera_i18n_menu_label' ) ) {
					$sera_fb = preg_replace_callback(
						'#(<a\b[^>]*>)([^<]+)(</a>)#',
						function ( $m ) {
							return $m[1] . esc_html( sera_i18n_menu_label( html_entity_decode( $m[2], ENT_QUOTES, 'UTF-8' ) ) ) . $m[3];
						},
						$sera_fb
					);
				}
				echo $sera_fb; // phpcs:ignore WordPress.Security.EscapeOutput -- built by sera_fallback_menu() with escaping.
			}
			?>
		</nav>

		<div class="header-actions">
			<?php if ( isset( $sera_langs[ $sera_cur ], $sera_langs[ $sera_other ] ) ) : ?>
				<div class="lang" data-lang="<?php echo esc_attr( $sera_cur ); ?>">
					<a class="lang-trigger" href="<?php echo esc_url( $sera_langs[ $sera_other ]['url'] ); ?>" hreflang="<?php echo esc_attr( $sera_meta[ $sera_other ]['hreflang'] ); ?>" aria-label="<?php echo esc_attr( sera_t( 'Language: English. Change language', 'Idioma: português. Trocar idioma' ) ); ?>">
						<svg class="lang-globe" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M3.5 9h17M3.5 15h17M12 3c-2.4 2.5-3.6 5.5-3.6 9s1.2 6.5 3.6 9c2.4-2.5 3.6-5.5 3.6-9S14.4 5.5 12 3Z"/></svg>
						<span class="lang-code" aria-hidden="true"><span class="lang-code-strip"><span><?php echo esc_html( $sera_langs[ $sera_cur ]['short'] ); ?></span><span><?php echo esc_html( $sera_langs[ $sera_other ]['short'] ); ?></span></span></span>
						<svg class="lang-chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m7 10 5 5 5-5"/></svg>
					</a>
					<div class="lang-pop glass" id="lang-menu" role="menu" aria-label="<?php echo esc_attr( sera_t( 'Language', 'Idioma' ) ); ?>" hidden>
						<span class="lang-pop-label" aria-hidden="true"><?php sera_e( 'Language', 'Idioma' ); ?></span>
						<?php $sera_i = 0; ?>
						<?php foreach ( array( 'en', 'pt' ) as $sera_code ) : ?>
							<?php
							if ( ! isset( $sera_langs[ $sera_code ] ) ) {
								continue;
							}
							$sera_on = $sera_code === $sera_cur;
							?>
							<a class="lang-opt<?php echo $sera_on ? ' is-current' : ''; ?>" href="<?php echo esc_url( $sera_langs[ $sera_code ]['url'] ); ?>" hreflang="<?php echo esc_attr( $sera_meta[ $sera_code ]['hreflang'] ); ?>" lang="<?php echo esc_attr( $sera_meta[ $sera_code ]['hreflang'] ); ?>" data-lang="<?php echo esc_attr( $sera_code ); ?>" style="--i:<?php echo (int) $sera_i++; ?>" role="menuitemradio" aria-checked="<?php echo $sera_on ? 'true' : 'false'; ?>" tabindex="-1">
								<span class="lang-opt-code" aria-hidden="true"><?php echo esc_html( $sera_langs[ $sera_code ]['short'] ); ?></span>
								<span class="lang-opt-txt"><b><?php echo esc_html( $sera_meta[ $sera_code ]['name'] ); ?></b><small aria-hidden="true"><?php echo esc_html( $sera_meta[ $sera_code ]['exonym'] ); ?></small></span>
								<svg class="lang-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12.5 4.5 4.5L19 7.5" pathLength="1"/></svg>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			<a class="btn btn-dark" href="<?php echo esc_url( ( is_front_page() ? '' : home_url( '/' ) ) . '#contact' ); ?>"><?php sera_e( 'Let’s talk', 'Vamos conversar' ); ?></a>
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav"><?php echo sera_icon( 'menu', 'ico ico-menu' ); // phpcs:ignore ?><svg class="ico ico-x" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg><span class="menu-label"><?php sera_e( 'Menu', 'Menu' ); ?></span></button>
		</div>
	</div>
</header>

<main id="content" tabindex="-1">
