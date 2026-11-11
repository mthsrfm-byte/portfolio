<?php
/**
 * Sera v.1 — theme bootstrap.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

define( 'SERA_VERSION', '3.23.0' );

require_once get_template_directory() . '/inc/i18n.php';
require_once get_template_directory() . '/inc/i18n/customizer-pt.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/screens.php';
require_once get_template_directory() . '/inc/screens-ac.php';
require_once get_template_directory() . '/inc/screens-nb.php';
require_once get_template_directory() . '/inc/screens-fm.php';
require_once get_template_directory() . '/inc/screens-rh.php';
require_once get_template_directory() . '/inc/screens-lm.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/llms.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/case-meta.php';
require_once get_template_directory() . '/inc/importer-notice.php';
require_once get_template_directory() . '/inc/blocks.php';
require_once get_template_directory() . '/inc/starter-content.php';
require_once get_template_directory() . '/inc/copy-pack.php';
require_once get_template_directory() . '/inc/paperplane.php';

/**
 * Asset version: SERA_VERSION in production, file mtime while SCRIPT_DEBUG is on.
 *
 * @param string $rel Path relative to the theme root (e.g. 'assets/css/main.css').
 */
function sera_asset_ver( $rel ) {
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		$file = get_template_directory() . '/' . ltrim( $rel, '/' );
		if ( file_exists( $file ) ) {
			return (string) filemtime( $file );
		}
	}
	return SERA_VERSION;
}

/**
 * Theme supports.
 */
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
		add_editor_style( array( 'assets/css/editor.css', 'assets/css/mockups.css', 'assets/css/case.css' ) );
		register_nav_menus(
			array(
				'primary' => 'Menu principal',
				'footer'  => 'Links do rodapé',
			)
		);
	}
);

/**
 * Is the current request a case page?
 */
function sera_is_case_page() {
	return is_page() && function_exists( 'sera_is_case' ) && sera_is_case();
}

/**
 * Case prefixes (pg, rh, …) used by the page content: artifacts and mockups.
 * Lets us load only assets/css/cases/<prefix>.css for what the page actually shows.
 *
 * @param string $content Raw post content (block markup).
 * @return string[]
 */
function sera_case_prefixes( $content ) {
	$found = array();
	if ( preg_match_all( '/wp:sera\/artifact\s+\{"name":"(pg|rh|wu|wb|fm|ac|nb|lm)-/', (string) $content, $m ) ) {
		$found = $m[1];
	}
	if ( preg_match_all( '/wp:sera\/mockup\s+\{[^}]*"mockup":"([a-z0-9\-]+)"/', (string) $content, $m ) ) {
		foreach ( $m[1] as $slug ) {
			$found = array_merge( $found, sera_mockup_prefixes( $slug ) );
		}
	}
	return array_values( array_unique( $found ) );
}

/**
 * Mockup slug → case prefix(es).
 */
function sera_mockup_prefixes( $slug ) {
	$map = array(
		'pagaleve'     => array( 'pg' ),
		'research-hub' => array( 'pg', 'rh' ),
		'lume'         => array( 'lm' ),
		'lm-'          => array( 'lm' ),
		'western-union' => array( 'wu' ),
		'wu-'          => array( 'wu' ),
		'will-bank'    => array( 'wb' ),
		'fatal-model'  => array( 'fm' ),
		'fm-'          => array( 'fm' ),
		'acordo-certo' => array( 'ac' ),
		'ac-'          => array( 'ac' ),
		'bastidores'   => array( 'nb' ),
		'nb-'          => array( 'nb' ),
		'paperplane'   => array( 'pp' ),
	);
	foreach ( $map as $prefix => $out ) {
		if ( 0 === strpos( $slug, $prefix ) ) {
			return $out;
		}
	}
	return array();
}

/**
 * Assets.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		$uri     = get_template_directory_uri();
		$dir     = get_template_directory();
		$is_case = sera_is_case_page();
		$post    = $is_case ? get_queried_object() : null;
		$content = $post ? (string) $post->post_content : '';
		// Paperplane Studio has its own layout and assets (inc/paperplane.php): none of the case CSS/JS below.
		$is_pp = $is_case && sera_is_paperplane( $post ? $post->ID : 0 );
		if ( $is_pp ) {
			$is_case = false;
		}

		wp_enqueue_style( 'sera-main', $uri . '/assets/css/main.css', array(), sera_asset_ver( 'assets/css/main.css' ) );

		$needs_mockups = is_front_page() || $is_case || ( ! $is_pp && is_singular() && has_block( 'sera/mockup' ) );
		if ( $needs_mockups ) {
			wp_enqueue_style( 'sera-mockups', $uri . '/assets/css/mockups.css', array( 'sera-main' ), sera_asset_ver( 'assets/css/mockups.css' ) );
			// Real-screenshot frames + pair-card sliders (Research Hub hero is on the home page too).
			wp_enqueue_style( 'sera-shots', $uri . '/assets/css/shots.css', array( 'sera-mockups' ), sera_asset_ver( 'assets/css/shots.css' ) );
			// Lume screens in code (home card + case).
			wp_enqueue_style( 'sera-lume-ui', $uri . '/assets/css/lume-ui.css', array( 'sera-mockups' ), sera_asset_ver( 'assets/css/lume-ui.css' ) );
			// Paperplane card (home, and the "next case" thumbnail on the case before it).
			wp_enqueue_style( 'sera-case-pp-card', $uri . '/assets/css/cases/pp.css', array( 'sera-mockups' ), sera_asset_ver( 'assets/css/cases/pp.css' ) );
		}

		if ( $is_pp ) {
			sera_pp_enqueue();
		}

		if ( $is_case ) {
			wp_enqueue_style( 'sera-case', $uri . '/assets/css/case.css', array( 'sera-main' ), sera_asset_ver( 'assets/css/case.css' ) );
			foreach ( sera_case_prefixes( $content ) as $prefix ) {
				$rel = 'assets/css/cases/' . $prefix . '.css';
				if ( file_exists( $dir . '/' . $rel ) ) {
					wp_enqueue_style( 'sera-case-' . $prefix, $uri . '/' . $rel, array( 'sera-case' ), sera_asset_ver( $rel ) );
				}
			}
		}

		wp_enqueue_script( 'sera-main', $uri . '/assets/js/main.js', array(), sera_asset_ver( 'assets/js/main.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );

		if ( ( $is_case || is_front_page() ) && file_exists( $dir . '/assets/js/case.js' ) ) {
			wp_enqueue_script( 'sera-case-js', $uri . '/assets/js/case.js', array(), sera_asset_ver( 'assets/js/case.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
		}

		if ( ! $is_pp && is_singular() && preg_match( '/(rh|lm)-shots-/', $content ? $content : (string) get_post_field( 'post_content', get_queried_object_id() ) ) ) {
			wp_enqueue_script( 'sera-shots', $uri . '/assets/js/shots.js', array(), sera_asset_ver( 'assets/js/shots.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
		}

		// Camada v2 (refino visual): carrega depois de tudo, com escopo em html.is-v2.
		wp_enqueue_style( 'sera-v2', $uri . '/assets/css/v2.css', array( 'sera-main' ), sera_asset_ver( 'assets/css/v2.css' ) );
		wp_enqueue_script( 'sera-v2', $uri . '/assets/js/v2.js', array( 'sera-main' ), sera_asset_ver( 'assets/js/v2.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
		if ( is_front_page() ) {
			wp_enqueue_style( 'sera-v2-home', $uri . '/assets/css/v2-home.css', array( 'sera-v2' ), sera_asset_ver( 'assets/css/v2-home.css' ) );
			wp_enqueue_script( 'sera-v2-home', $uri . '/assets/js/v2-home.js', array( 'sera-v2', 'sera-case-js' ), sera_asset_ver( 'assets/js/v2-home.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
		}
		if ( $is_case ) {
			wp_enqueue_style( 'sera-v2-case', $uri . '/assets/css/v2-case.css', array( 'sera-v2', 'sera-case' ), sera_asset_ver( 'assets/css/v2-case.css' ) );
			wp_enqueue_script( 'sera-v2-case', $uri . '/assets/js/v2-case.js', array( 'sera-v2', 'sera-case-js' ), sera_asset_ver( 'assets/js/v2-case.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );
		}

		if ( sera_skip_core_block_css() ) {
			wp_dequeue_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library-theme' );
			wp_dequeue_style( 'classic-theme-styles' );
			wp_dequeue_style( 'global-styles' );
		}
	},
	20
);

/**
 * Core block CSS is only needed where blocks are rendered (case pages / plain pages).
 */
function sera_skip_core_block_css() {
	return is_front_page() || is_404() || is_home() || is_archive() || is_search();
}

/* Classic themes with separate block assets enqueue global-styles in the footer; drop it there too. */
add_action(
	'wp_footer',
	function () {
		if ( sera_skip_core_block_css() ) {
			wp_dequeue_style( 'global-styles' );
			wp_dequeue_style( 'wp-block-library' );
		}
	},
	2
);

/**
 * Lighter <head>: per-block core assets, no emoji, no generator/RSD/WLW/shortlink.
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'emoji_svg_url', '__return_false' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
add_filter(
	'tiny_mce_plugins',
	function ( $plugins ) {
		return is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array();
	}
);

/**
 * Preload the two fonts used above the fold, and the hero photo on the home.
 */
add_action(
	'wp_head',
	function () {
		$uri = get_template_directory_uri() . '/assets/fonts/';
		foreach ( array( 'bricolage-grotesque.woff2', 'geist.woff2' ) as $f ) {
			printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $uri . $f ) );
		}
		if ( is_front_page() ) {
			$id     = (int) sera_mod( 'hero_photo' );
			$srcset = $id ? wp_get_attachment_image_srcset( $id, 'large' ) : '';
			$sizes  = $id ? wp_get_attachment_image_sizes( $id, 'large' ) : '';
			$extra  = '';
			if ( $srcset ) {
				$extra = ' imagesrcset="' . esc_attr( $srcset ) . '"' . ( $sizes ? ' imagesizes="' . esc_attr( $sizes ) . '"' : '' );
			}
			printf( '<link rel="preload" as="image" href="%s" fetchpriority="high"%s>' . "\n", esc_url( sera_photo_url() ), $extra ); // phpcs:ignore WordPress.Security.EscapeOutput
		}
		echo '<script>document.documentElement.className=document.documentElement.className.replace("no-js","js");</script>' . "\n";
	},
	1
);

/**
 * <html lang="en" class="no-js"> on the front end (the admin keeps the site locale).
 */
add_filter(
	'language_attributes',
	function ( $out ) {
		if ( is_admin() ) {
			return $out;
		}
		$out = preg_replace( '/\s*lang="[^"]*"/', '', $out );
		$out = trim( $out . ' lang="' . ( sera_is_pt() ? 'pt-BR' : 'en' ) . '"' );
		if ( false === strpos( $out, 'class=' ) ) {
			$out .= ' class="no-js is-v2"';
		} else {
			$out = preg_replace( '/class="([^"]*)"/', 'class="$1 no-js is-v2"', $out, 1 );
		}
		return $out;
	}
);

/**
 * Fallback menu: in-page anchors (work from any page).
 */
function sera_fallback_menu() {
	$home  = trailingslashit( home_url() );
	$links = array(
		'#work'       => 'Work',
		'#approach'   => 'Approach',
		'#experience' => 'Experience',
		'#about'      => 'About',
	);
	echo '<ul>';
	foreach ( $links as $hash => $label ) {
		printf( '<li><a href="%s" data-section="%s">%s</a></li>', esc_url( ( is_front_page() ? '' : $home ) . $hash ), esc_attr( ltrim( $hash, '#' ) ), esc_html( $label ) );
	}
	$resume = sera_mod( 'contact_resume' );
	if ( $resume ) {
		printf( '<li><a href="%s" target="_blank" rel="noopener">Resume</a></li>', esc_url( $resume ) );
	}
	echo '</ul>';
}

/**
 * Photo URL (Customizer image or bundled default).
 */
function sera_photo_url() {
	$id = (int) sera_mod( 'hero_photo' );
	if ( $id ) {
		$src = wp_get_attachment_image_url( $id, 'large' );
		if ( $src ) {
			return $src;
		}
	}
	return get_template_directory_uri() . '/assets/img/headshot.webp';
}

/**
 * Parse "a | b | c | d" lines.
 */
function sera_lines( $text, $cols = 1 ) {
	$out = array();
	foreach ( preg_split( '/\r\n|\r|\n/', (string) $text ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$out[] = $cols > 1 ? array_pad( array_map( 'trim', explode( '|', $line, $cols ) ), $cols, '' ) : $line;
	}
	return $out;
}

/**
 * *word* → <em>word</em> (escaped first).
 */
function sera_emphasis( $text ) {
	return preg_replace( '/\*([^*]+)\*/', '<em>$1</em>', esc_html( $text ) );
}

/**
 * Excerpt length / more for cards.
 */
add_filter(
	'excerpt_more',
	function () {
		return '…';
	}
);

/**
 * Body classes.
 */
add_filter(
	'body_class',
	function ( $classes ) {
		if ( sera_is_case_page() ) {
			$classes[] = 'is-case';
		}
		return $classes;
	}
);

/**
 * Favicon from the theme (only when no Site Icon is set in Personalizar › Identidade do site).
 */
add_action(
	'wp_head',
	function () {
		if ( has_site_icon() ) {
			return;
		}
		$u = get_template_directory_uri() . '/assets/img/';
		printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( $u . 'favicon.svg' ) );
		printf( '<link rel="icon" href="%s" sizes="32x32" type="image/png">' . "\n", esc_url( $u . 'favicon-32.png' ) );
		printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( $u . 'apple-touch-icon.png' ) );
		echo '<meta name="theme-color" content="#F5F4EF">' . "\n";
	},
	2
);
