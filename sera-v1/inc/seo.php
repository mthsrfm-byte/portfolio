<?php
/**
 * SEO + link previews (Open Graph, Twitter, JSON-LD), canonical, robots, sitemaps.
 * Turns itself off when an SEO plugin (Yoast, Rank Math, SEOPress, AIOSEO) is active.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

function sera_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'SEOPRESS_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

function sera_seo_home_title() {
	return sera_mod( 'seo_title' );
}

function sera_seo_description() {
	if ( is_front_page() || is_home() ) {
		return sera_mod( 'seo_description' );
	}
	if ( is_singular() ) {
		$post = get_queried_object();
		if ( function_exists( 'sera_is_case' ) && sera_is_case( $post->ID ) ) {
			return sera_case_description( $post->ID );
		}
		return has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 32, '…' );
	}
	return get_bloginfo( 'description' );
}

function sera_seo_trim( $text, $len = 160 ) {
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $text ) ) );
	if ( mb_strlen( $text ) <= $len ) {
		return $text;
	}
	$cut = mb_substr( $text, 0, $len - 1 );
	$cut = preg_replace( '/\s+\S*$/u', '', $cut );
	return rtrim( $cut, " ,.;:–—" ) . '…';
}

/**
 * [url, width, height, mime].
 */
function sera_seo_image() {
	$dir = get_template_directory() . '/assets/og/';
	$uri = get_template_directory_uri() . '/assets/og/';
	if ( is_singular() ) {
		$post = get_queried_object();
		if ( has_post_thumbnail( $post ) ) {
			$tid = get_post_thumbnail_id( $post );
			$src = wp_get_attachment_image_src( $tid, 'full' );
			if ( $src ) {
				return array( $src[0], $src[1], $src[2], get_post_mime_type( $tid ) );
			}
		}
		if ( file_exists( $dir . $post->post_name . '.jpg' ) ) {
			return array( $uri . $post->post_name . '.jpg', 1200, 630, 'image/jpeg' );
		}
	}
	$custom = absint( sera_mod( 'seo_image' ) );
	if ( $custom ) {
		$src = wp_get_attachment_image_src( $custom, 'full' );
		if ( $src ) {
			return array( $src[0], $src[1], $src[2], get_post_mime_type( $custom ) );
		}
	}
	return array( $uri . 'home.jpg?v=' . SERA_VERSION, 1200, 630, 'image/jpeg' ); // ?v= makes WhatsApp/LinkedIn fetch the new file.
}

/**
 * Clean canonical: the home or the permalink, never a raw query string.
 */
function sera_seo_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		$c = wp_get_canonical_url( get_queried_object() );
		return $c ? $c : get_permalink( get_queried_object() );
	}
	if ( is_home() ) {
		return get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' );
	}
	return home_url( '/' );
}

function sera_seo_is_case() {
	return is_page() && function_exists( 'sera_is_case' ) && sera_is_case();
}

/* Title: Customizer title on the home, "Case headline — Matheus Serafim" on cases. */
add_filter(
	'pre_get_document_title',
	function ( $title ) {
		if ( sera_seo_plugin_active() ) {
			return $title;
		}
		if ( is_front_page() && sera_seo_home_title() ) {
			return sera_seo_home_title();
		}
		if ( sera_seo_is_case() ) {
			return wp_strip_all_tags( sera_case_headline( get_queried_object_id() ) ) . ' — ' . get_bloginfo( 'name' );
		}
		return $title;
	}
);
add_filter( 'document_title_separator', function () { return '—'; } );

/* Canonical: ours (clean), not core's. */
add_action(
	'init',
	function () {
		if ( ! sera_seo_plugin_active() ) {
			remove_action( 'wp_head', 'rel_canonical' );
		}
	}
);

/* Robots: index + rich snippets on real pages, noindex on thin archives. */
add_filter(
	'wp_robots',
	function ( $robots ) {
		if ( sera_seo_plugin_active() ) {
			return $robots;
		}
		if ( is_archive() || is_search() || is_author() || is_date() || ( is_home() && ! is_front_page() ) ) {
			unset( $robots['index'] );
			$robots['noindex'] = true;
			$robots['follow']  = true;
			return $robots;
		}
		$robots['max-snippet:-1']          = true;
		$robots['max-image-preview:large'] = true;
		return $robots;
	}
);

/* Author / date archives → home (301). Nothing lives there. */
add_action(
	'template_redirect',
	function () {
		if ( is_author() || is_date() ) {
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}
);

/* Sitemaps: pages only. */
add_filter(
	'wp_sitemaps_add_provider',
	function ( $provider, $name ) {
		return in_array( $name, array( 'users', 'taxonomies' ), true ) ? false : $provider;
	},
	10,
	2
);
add_filter(
	'wp_sitemaps_post_types',
	function ( $post_types ) {
		return isset( $post_types['page'] ) ? array( 'page' => $post_types['page'] ) : $post_types;
	}
);

add_action(
	'wp_head',
	function () {
		if ( sera_seo_plugin_active() ) {
			return;
		}
		$is_case = sera_seo_is_case();
		$id      = $is_case ? get_queried_object_id() : 0;
		$title   = wp_get_document_title();
		$desc    = sera_seo_trim( sera_seo_description() );
		$url     = sera_seo_url();
		$img     = sera_seo_image();
		$site    = get_bloginfo( 'name' );
		$type    = $is_case ? 'article' : 'website';
		$og_t    = $is_case ? wp_strip_all_tags( sera_case_headline( $id ) ) : $title;
		$linkedin = (string) sera_mod( 'contact_linkedin' );
		$lede     = sera_seo_trim( sera_mod( 'hero_lede' ), 300 );

		echo "\n<!-- Sera SEO -->\n";
		if ( $desc ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		if ( is_front_page() || is_singular() ) {
			printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );
		}
		echo '<meta name="author" content="Matheus Serafim">' . "\n";
		if ( $linkedin ) {
			printf( '<link rel="me" href="%s">' . "\n", esc_url( $linkedin ) );
		}
		printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $type ) );
		printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( $site ) );
		echo '<meta property="og:locale" content="' . ( sera_is_pt() ? 'pt_BR' : 'en_US' ) . '">' . "\n";
		echo '<meta property="og:locale:alternate" content="' . ( sera_is_pt() ? 'en_US' : 'pt_BR' ) . '">' . "\n";
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $og_t ) );
		if ( $desc ) {
			printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $img[0] ) );
		printf( '<meta property="og:image:secure_url" content="%s">' . "\n", esc_url( set_url_scheme( $img[0], 'https' ) ) );
		if ( ! empty( $img[3] ) ) {
			printf( '<meta property="og:image:type" content="%s">' . "\n", esc_attr( $img[3] ) );
		}
		printf( '<meta property="og:image:width" content="%d">' . "\n<meta property=\"og:image:height\" content=\"%d\">\n", (int) $img[1], (int) $img[2] );
		printf( '<meta property="og:image:alt" content="%s">' . "\n", esc_attr( $og_t ) );
		if ( $is_case ) {
			printf( '<meta property="article:published_time" content="%s">' . "\n", esc_attr( get_the_date( 'c', $id ) ) );
			printf( '<meta property="article:modified_time" content="%s">' . "\n", esc_attr( get_the_modified_date( 'c', $id ) ) );
			echo '<meta property="article:author" content="Matheus Serafim">' . "\n";
		}
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $og_t ) );
		if ( $desc ) {
			printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );
		}
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $img[0] ) );

		$person = array(
			'@type'       => 'Person',
			'@id'         => sera_lang_url( home_url( '/' ), 'en' ) . '#person',
			'name'        => 'Matheus Serafim',
			'jobTitle'    => 'Staff-level Product Designer',
			'description' => $lede,
			'url'         => home_url( '/' ),
			'image'       => sera_photo_url(),
			'sameAs'      => array_values( array_filter( array( $linkedin ) ) ),
			'knowsAbout'  => array( 'Product design', 'UX design', 'Fintech', 'Buy now, pay later', 'Credit cards', 'Digital banking', 'Remittances', 'Design systems', 'User research' ),
			'worksFor'    => array(
				'@type' => 'Organization',
				'name'  => 'Pagaleve',
				'url'   => 'https://www.pagaleve.com.br/',
			),
			'address'     => array(
				'@type'           => 'PostalAddress',
				'addressLocality' => 'Fortaleza',
				'addressCountry'  => 'BR',
			),
		);
		$graph = array(
			$person,
			array(
				'@type'      => 'WebSite',
				'@id'        => home_url( '/#website' ),
				'url'        => home_url( '/' ),
				'name'       => $site,
				'publisher'  => array( '@id' => home_url( '/#person' ) ),
				'inLanguage' => sera_t( 'en', 'pt-BR' ),
			),
		);
		if ( is_front_page() ) {
			$graph[] = array(
				'@type'       => 'ProfilePage',
				'@id'         => home_url( '/#profile' ),
				'url'         => home_url( '/' ),
				'name'        => $title,
				'description' => $desc,
				'mainEntity'  => array( '@id' => home_url( '/#person' ) ),
				'isPartOf'    => array( '@id' => home_url( '/#website' ) ),
				'inLanguage'  => sera_t( 'en', 'pt-BR' ),
			);
		}
		if ( $is_case ) {
			$company  = (string) get_post_meta( $id, '_sera_company', true );
			$article  = array(
				'@type'            => 'Article',
				'@id'              => $url . '#case',
				'mainEntityOfPage' => array( '@type' => 'WebPage', '@id' => $url ),
				'headline'         => $og_t,
				'name'             => wp_strip_all_tags( get_the_title( $id ) ),
				'description'      => $desc,
				'image'            => array(
					'@type'  => 'ImageObject',
					'url'    => $img[0],
					'width'  => (int) $img[1],
					'height' => (int) $img[2],
				),
				'url'              => $url,
				'datePublished'    => get_the_date( 'c', $id ),
				'dateModified'     => get_the_modified_date( 'c', $id ),
				'author'           => array( '@id' => home_url( '/#person' ) ),
				'publisher'        => array( '@id' => home_url( '/#person' ) ),
				'inLanguage'       => sera_t( 'en', 'pt-BR' ),
				'isPartOf'         => array( '@id' => home_url( '/#website' ) ),
			);
			if ( $company ) {
				$article['about'] = array( '@type' => 'Organization', 'name' => $company );
			}
			$chips = array_values( sera_case_chips( $id ) );
			if ( $chips ) {
				$article['keywords'] = $chips;
			}
			$graph[] = $article;
			$graph[] = array(
				'@type'           => 'BreadcrumbList',
				'itemListElement' => array(
					array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
					array( '@type' => 'ListItem', 'position' => 2, 'name' => $og_t, 'item' => $url ),
				),
			);
		}
		echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n<!-- /Sera SEO -->\n";
	},
	1
);
