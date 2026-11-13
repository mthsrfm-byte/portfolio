<?php
/**
 * Bilingual front end: English at /, Brazilian Portuguese at /pt/.
 *
 * How it works (no plugin, no rewrite flush):
 * - A request to /pt/... is detected here, at theme load, and the /pt prefix is removed from
 *   REQUEST_URI before WordPress parses it. WordPress then resolves the page as usual and
 *   sera_lang() returns 'pt' for the rest of the request.
 * - Links WordPress builds while rendering a Portuguese page (home_url, permalinks, menus)
 *   get the /pt prefix back, so navigation stays in Portuguese.
 * - Templates translate inline: sera_t( 'English', 'Português' ).
 * - Case pages keep their Portuguese copy in post meta written by the importer:
 *   _sera_content_pt, _sera_title_pt, _sera_excerpt_pt and <meta key>_pt for every _sera_ field.
 * - <html lang>, og:locale, hreflang and the sitemap know about both versions (see seo.php).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * Path prefix of the site home (e.g. '' or '/blog').
 */
function sera_home_path() {
	static $p = null;
	if ( null === $p ) {
		$p = untrailingslashit( (string) wp_parse_url( get_option( 'home' ), PHP_URL_PATH ) );
	}
	return $p;
}

/**
 * Detect /pt/ and strip it before WordPress parses the request.
 */
function sera_i18n_detect() {
	if ( isset( $GLOBALS['sera_lang'] ) ) {
		return;
	}
	$GLOBALS['sera_lang'] = 'en';
	if ( getenv( 'SERA_LANG' ) ) { // Harness / CLI.
		$GLOBALS['sera_lang'] = 'pt' === getenv( 'SERA_LANG' ) ? 'pt' : 'en';
		return;
	}
	if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || wp_doing_ajax() || empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}
	$uri  = wp_unslash( $_SERVER['REQUEST_URI'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$base = sera_home_path();
	$re   = '#^' . preg_quote( $base, '#' ) . '/pt(?=/|\?|$)#';
	if ( preg_match( $re, $uri ) ) {
		$GLOBALS['sera_lang']   = 'pt';
		$GLOBALS['sera_pt_uri'] = $uri;
		$rest                   = preg_replace( $re, $base, $uri, 1 );
		if ( '' === $rest || '?' === $rest[0] ) {
			$rest = $base . '/' . $rest;
		}
		$_SERVER['REQUEST_URI'] = $rest;
	}
}
sera_i18n_detect();

/**
 * Put the real /pt/... address back once WordPress has resolved the page.
 *
 * The host's page cache names its files after REQUEST_URI when the page finishes. With the
 * prefix still stripped, the Portuguese page was saved as the cache of the English address,
 * so "/" served Portuguese to everyone and the switcher looked dead.
 */
add_action(
	'parse_request',
	function () {
		if ( ! empty( $GLOBALS['sera_pt_uri'] ) ) {
			$_SERVER['REQUEST_URI'] = $GLOBALS['sera_pt_uri'];
		}
	},
	1
);

/**
 * Never build an http:// address for this site when its home is https.
 *
 * WordPress picks the scheme of theme, plugin and include URLs from the current request. A page
 * rendered for a request it did not see as secure got http:// stylesheets and scripts, the host's
 * page cache kept that copy, and browsers then blocked every asset on the https page.
 */
add_filter(
	'set_url_scheme',
	function ( $url ) {
		static $https = null;
		if ( null === $https ) {
			$https = 'https' === wp_parse_url( get_option( 'home' ), PHP_URL_SCHEME );
		}
		if ( $https && 0 === strpos( $url, 'http://' ) ) {
			$url = 'https://' . substr( $url, 7 );
		}
		return $url;
	}
);

/**
 * One-off: throw away the page cache that was saved with the wrong language or http:// assets.
 */
add_action(
	'init',
	function () {
		if ( 'done-3.36.4' === get_option( 'sera_cache_lang_fix' ) ) {
			return;
		}
		update_option( 'sera_cache_lang_fix', 'done-3.36.4', false );
		do_action( 'epc_purge' );
		$dir = WP_CONTENT_DIR . '/endurance-page-cache';
		if ( ! is_dir( $dir ) || ! class_exists( 'RecursiveDirectoryIterator' ) ) {
			return;
		}
		try {
			$it = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS ) );
			foreach ( $it as $f ) {
				if ( $f->isFile() && '_index.html' === $f->getFilename() ) {
					@unlink( $f->getPathname() ); // phpcs:ignore
				}
			}
		} catch ( Exception $e ) {
			return;
		}
	},
	99
);

/**
 * Current front-end language: 'en' or 'pt'.
 */
function sera_lang() {
	return ( isset( $GLOBALS['sera_lang'] ) && 'pt' === $GLOBALS['sera_lang'] ) ? 'pt' : 'en';
}

function sera_is_pt() {
	return 'pt' === sera_lang();
}

/**
 * Inline translation. Returns the string for the current language.
 *
 * @param string $en English.
 * @param string $pt Brazilian Portuguese (falls back to English when empty).
 */
function sera_t( $en, $pt = '' ) {
	return ( sera_is_pt() && '' !== $pt ) ? $pt : $en;
}

/**
 * Echo variant (raw: callers escape when needed, same as before).
 */
function sera_e( $en, $pt = '' ) {
	echo sera_t( $en, $pt ); // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Add or remove the /pt prefix on an internal URL.
 *
 * @param string $url  Absolute or root-relative URL.
 * @param string $lang Target language.
 */
function sera_lang_url( $url, $lang = null ) {
	$lang = $lang ? $lang : sera_lang();
	$home = untrailingslashit( get_option( 'home' ) );
	$base = sera_home_path();
	$abs  = 0 === strpos( $url, $home );
	if ( $abs ) {
		$path = substr( $url, strlen( $home ) );
	} elseif ( '' !== $url && '/' === $url[0] && ( '' === $base || 0 === strpos( $url, $base ) ) ) {
		$path = substr( $url, strlen( $base ) );
	} else {
		return $url; // External, anchor-only or relative.
	}
	if ( preg_match( '#^/?(wp-admin|wp-json|wp-content|wp-includes|wp-login|feed|wp-sitemap|sitemap|llms|robots|xmlrpc)#', $path ) || false !== strpos( $path, 'rest_route=' ) ) {
		return $url;
	}
	$path = preg_replace( '#^/pt(?=/|\?|\#|$)#', '', $path );
	if ( 'pt' === $lang ) {
		$path = '/pt' . ( '' === $path ? '/' : ( in_array( $path[0], array( '?', '#' ), true ) ? '/' . $path : $path ) );
	}
	return ( $abs ? $home : $base ) . ( '' === $path ? '/' : $path );
}

/**
 * URL of the current page in a given language.
 */
function sera_current_url( $lang ) {
	$u = ( is_singular() && ! is_front_page() ) ? get_permalink( get_queried_object_id() ) : home_url( '/' );
	return sera_lang_url( $u, $lang );
}

/* -------------------------------------------------------- link rewriting */

function sera_i18n_home_url( $url, $path = '' ) {
	if ( ! sera_is_pt() || is_admin() ) {
		return $url;
	}
	return sera_lang_url( $url, 'pt' );
}

function sera_i18n_link( $url ) {
	return sera_is_pt() ? sera_lang_url( $url, 'pt' ) : $url;
}

add_action(
	'init',
	function () {
		if ( ! sera_is_pt() || is_admin() ) {
			return;
		}
		add_filter( 'home_url', 'sera_i18n_home_url', 20, 2 );
		add_filter( 'page_link', 'sera_i18n_link', 20 );
		add_filter( 'post_link', 'sera_i18n_link', 20 );
		add_filter(
			'nav_menu_link_attributes',
			function ( $atts ) {
				if ( ! empty( $atts['href'] ) ) {
					$atts['href'] = sera_lang_url( $atts['href'], 'pt' );
				}
				return $atts;
			}
		);
		add_filter(
			'nav_menu_item_title',
			function ( $title ) {
				return sera_i18n_menu_label( $title );
			}
		);
		// WordPress must not "correct" /pt/slug back to /slug.
		add_filter( 'redirect_canonical', '__return_false' );
	}
);

/**
 * Menu labels people usually type in Appearance › Menus.
 */
function sera_i18n_menu_label( $title ) {
	$map = array(
		'work'          => 'Trabalhos',
		'selected work' => 'Trabalhos',
		'cases'         => 'Cases',
		'case studies'  => 'Cases',
		'about'         => 'Sobre',
		'about me'      => 'Sobre mim',
		'approach'      => 'Como trabalho',
		'experience'    => 'Experiência',
		'contact'       => 'Contato',
		'resume'        => 'Currículo',
		'cv'            => 'Currículo',
		'home'          => 'Início',
		'blog'          => 'Blog',
		'writing'       => 'Textos',
	);
	$k = strtolower( trim( wp_strip_all_tags( $title ) ) );
	return isset( $map[ $k ] ) ? $map[ $k ] : $title;
}

/* ------------------------------------------------ Portuguese case content */

/**
 * Serve _sera_<key>_pt instead of _sera_<key> on Portuguese pages.
 */
add_filter(
	'get_post_metadata',
	function ( $value, $object_id, $meta_key, $single ) {
		if ( ! sera_is_pt() || is_admin() || ! $meta_key || 0 !== strpos( $meta_key, '_sera_' ) || '_pt' === substr( $meta_key, -3 ) ) {
			return $value;
		}
		if ( in_array( $meta_key, array( '_sera_library_version', '_sera_visual', '_sera_order' ), true ) ) {
			return $value;
		}
		$pt = get_post_meta( $object_id, $meta_key . '_pt', true );
		if ( '' === $pt || null === $pt || false === $pt ) {
			return $value;
		}
		return $single ? $pt : array( $pt );
	},
	10,
	4
);

add_filter(
	'the_content',
	function ( $content ) {
		if ( ! sera_is_pt() || is_admin() ) {
			return $content;
		}
		$id = get_the_ID();
		if ( $id ) {
			$pt = get_post_meta( $id, '_sera_content_pt', true );
			if ( is_string( $pt ) && '' !== trim( $pt ) ) {
				return $pt;
			}
		}
		return $content;
	},
	1
);

// Internal links typed into content keep the reader in Portuguese.
add_filter(
	'the_content',
	function ( $content ) {
		if ( ! sera_is_pt() || is_admin() ) {
			return $content;
		}
		return preg_replace_callback(
			'#href="([^"]+)"#',
			function ( $m ) {
				return 'href="' . esc_attr( sera_lang_url( html_entity_decode( $m[1] ), 'pt' ) ) . '"';
			},
			$content
		);
	},
	99
);

add_filter(
	'the_title',
	function ( $title, $id = 0 ) {
		if ( ! sera_is_pt() || is_admin() || ! $id ) {
			return $title;
		}
		$pt = get_post_meta( $id, '_sera_title_pt', true );
		return ( is_string( $pt ) && '' !== $pt ) ? $pt : $title;
	},
	10,
	2
);

add_filter(
	'get_the_excerpt',
	function ( $excerpt, $post = null ) {
		if ( ! sera_is_pt() || is_admin() || ! $post ) {
			return $excerpt;
		}
		$pt = get_post_meta( $post->ID, '_sera_excerpt_pt', true );
		return ( is_string( $pt ) && '' !== $pt ) ? $pt : $excerpt;
	},
	10,
	2
);

add_filter(
	'single_post_title',
	function ( $title, $post = null ) {
		if ( ! sera_is_pt() || ! $post ) {
			return $title;
		}
		$pt = get_post_meta( $post->ID, '_sera_title_pt', true );
		return ( is_string( $pt ) && '' !== $pt ) ? $pt : $title;
	},
	10,
	2
);

/* ------------------------------------------------------------- head bits */

/**
 * hreflang alternates on every front-end page.
 */
add_action(
	'wp_head',
	function () {
		if ( is_admin() || is_search() ) {
			return;
		}
		printf( '<link rel="alternate" hreflang="en" href="%s">' . "\n", esc_url( sera_current_url( 'en' ) ) );
		printf( '<link rel="alternate" hreflang="pt-BR" href="%s">' . "\n", esc_url( sera_current_url( 'pt' ) ) );
		printf( '<link rel="alternate" hreflang="x-default" href="%s">' . "\n", esc_url( sera_current_url( 'en' ) ) );
	},
	2
);

/**
 * Body class for language-specific tweaks.
 */
add_filter(
	'body_class',
	function ( $c ) {
		$c[] = 'lang-' . sera_lang();
		return $c;
	}
);

/* --------------------------------------------------------------- sitemap */

/**
 * Portuguese URLs in the core sitemap (/wp-sitemap-sera-1.xml).
 */
add_action(
	'init',
	function () {
		if ( ! function_exists( 'wp_register_sitemap_provider' ) || ! class_exists( 'WP_Sitemaps_Provider' ) ) {
			return;
		}
		if ( ! class_exists( 'Sera_PT_Sitemap' ) ) {
			// phpcs:ignore Generic.Files.OneObjectStructurePerFile
			class Sera_PT_Sitemap extends WP_Sitemaps_Provider {
				public function __construct() {
					$this->name        = 'sera';
					$this->object_type = 'pt';
				}
				public function get_url_list( $page_num, $object_subtype = '' ) {
					$home = untrailingslashit( get_option( 'home' ) );
					$list = array( array( 'loc' => $home . '/pt/' ) );
					$q    = get_posts(
						array(
							'post_type'      => 'page',
							'post_status'    => 'publish',
							'posts_per_page' => 200,
							'meta_key'       => '_sera_content_pt', // phpcs:ignore WordPress.DB.SlowDBQuery
							'fields'         => 'ids',
						)
					);
					foreach ( $q as $id ) {
						$list[] = array( 'loc' => sera_lang_url( get_permalink( $id ), 'pt' ) );
					}
					return $list;
				}
				public function get_max_num_pages( $object_subtype = '' ) {
					return 1;
				}
			}
		}
		wp_register_sitemap_provider( 'sera', new Sera_PT_Sitemap() );
	}
);

/* ------------------------------------------------------------- JS bridge */

/**
 * Data for the language switcher in the header.
 */
function sera_lang_switch_items() {
	return array(
		'en' => array(
			'label' => 'English',
			'short' => 'EN',
			'url'   => sera_current_url( 'en' ),
		),
		'pt' => array(
			'label' => 'Português',
			'short' => 'PT',
			'url'   => sera_current_url( 'pt' ),
		),
	);
}
