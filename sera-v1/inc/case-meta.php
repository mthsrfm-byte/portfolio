<?php
/**
 * Portfolio pages: taxonomies on pages, excerpt, and the "Dados do case" meta box.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * Pages get categories, tags and excerpts.
 */
add_action(
	'init',
	function () {
		register_taxonomy_for_object_type( 'category', 'page' );
		register_taxonomy_for_object_type( 'post_tag', 'page' );
		add_post_type_support( 'page', 'excerpt' );

		foreach ( sera_case_meta_keys() as $key => $type ) {
			register_post_meta(
				'page',
				$key,
				array(
					'type'              => 'string',
					'single'            => true,
					'show_in_rest'      => true,
					'sanitize_callback' => 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field',
					'auth_callback'     => function () {
						return current_user_can( 'edit_pages' );
					},
				)
			);
		}
	}
);

/**
 * Make sure category/tag archives also list pages.
 */
add_action(
	'pre_get_posts',
	function ( $q ) {
		if ( is_admin() || ! $q->is_main_query() ) {
			return;
		}
		if ( $q->is_category() || $q->is_tag() ) {
			$q->set( 'post_type', array( 'post', 'page' ) );
		}
	}
);

function sera_case_meta_keys() {
	return array(
		'_sera_headline' => 'text',
		'_sera_company'  => 'text',
		'_sera_year'     => 'text',
		'_sera_role'     => 'text',
		'_sera_metrics'  => 'textarea',
		'_sera_chips'       => 'text',
		'_sera_visual'      => 'text',
		'_sera_description' => 'textarea',
	);
}

/**
 * Meta description of a case: the optional field, otherwise the excerpt.
 */
function sera_case_description( $post_id ) {
	$d = trim( (string) get_post_meta( $post_id, '_sera_description', true ) );
	if ( '' !== $d ) {
		return $d;
	}
	$post = get_post( $post_id );
	if ( ! $post ) {
		return '';
	}
	return has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 32, '…' );
}

/**
 * Is this page a portfolio case?
 */
function sera_is_case( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	return has_term( 'portfolio', 'category', $post_id ) || has_term( 'portfolio', 'post_tag', $post_id );
}

/**
 * Query portfolio pages. Editors also see drafts (so the home can be previewed).
 */
function sera_case_query( $args = array() ) {
	$status = array( 'publish' );
	if ( current_user_can( 'edit_pages' ) ) {
		$status = array( 'publish', 'draft', 'pending', 'future', 'private' );
	}
	$query = new WP_Query(
		wp_parse_args(
			$args,
			array(
				'post_type'           => 'page',
				'post_status'         => $status,
				'posts_per_page'      => 50,
				'orderby'             => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
				'tax_query'           => array( // phpcs:ignore WordPress.DB.SlowDBQuery
					'relation' => 'OR',
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => 'portfolio',
					),
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'slug',
						'terms'    => 'portfolio',
					),
				),
			)
		)
	);
	if ( empty( $args['sera_raw_order'] ) ) {
		$query->posts = sera_case_sort( $query->posts );
		if ( $query->posts ) {
			$query->post = $query->posts[0];
		}
	}
	return $query;
}

/**
 * Case order chosen in Personalizar › Sera · Home › Cases (page slugs, comma-separated).
 */
function sera_case_order() {
	$raw = (string) sera_mod( 'cases_order' );
	return array_values( array_filter( array_map( 'sanitize_title', explode( ',', $raw ) ) ) );
}

/**
 * Sort posts (WP_Post objects or IDs) by the Customizer order.
 * Cases missing from the list keep their "Ordem" position, after the listed ones.
 */
function sera_case_sort( $posts ) {
	$order = array_flip( sera_case_order() );
	if ( ! $order || ! $posts ) {
		return $posts;
	}
	$keyed = array();
	foreach ( array_values( $posts ) as $i => $p ) {
		$slug    = get_post_field( 'post_name', $p );
		$keyed[] = array( isset( $order[ $slug ] ) ? $order[ $slug ] : 1000 + $i, $i, $p );
	}
	usort(
		$keyed,
		function ( $a, $b ) {
			return $a[0] === $b[0] ? $a[1] - $b[1] : $a[0] - $b[0];
		}
	);
	return array_map(
		function ( $k ) {
			return $k[2];
		},
		$keyed
	);
}

/**
 * Meta box.
 */
add_action(
	'add_meta_boxes_page',
	function () {
		add_meta_box( 'sera-case', 'Dados do case (Sera)', 'sera_case_metabox', 'page', 'normal', 'high' );
	}
);

function sera_case_metabox( $post ) {
	wp_nonce_field( 'sera_case_save', 'sera_case_nonce' );
	$v = function ( $k ) use ( $post ) {
		return get_post_meta( $post->ID, $k, true );
	};
	?>
	<p style="margin-top:0;color:#646970">Estes campos alimentam o card da Home e o topo da página do case. A página só aparece na Home se tiver a categoria (ou tag) <strong>portfolio</strong>. A ordem segue o campo <em>Ordem</em> em Atributos da página. O resumo do card vem do <em>Resumo</em> (excerpt) da página.</p>
	<table class="form-table" role="presentation">
		<tr><th><label for="sera_headline">Título do card</label></th><td><input class="large-text" id="sera_headline" name="_sera_headline" value="<?php echo esc_attr( $v( '_sera_headline' ) ); ?>" placeholder="Se vazio, usa o título da página"></td></tr>
		<tr><th><label for="sera_company">Empresa</label></th><td><input class="regular-text" id="sera_company" name="_sera_company" value="<?php echo esc_attr( $v( '_sera_company' ) ); ?>"></td></tr>
		<tr><th><label for="sera_year">Ano</label></th><td><input class="regular-text" id="sera_year" name="_sera_year" value="<?php echo esc_attr( $v( '_sera_year' ) ); ?>" placeholder="2025–26"></td></tr>
		<tr><th><label for="sera_role">Seu papel</label></th><td><input class="large-text" id="sera_role" name="_sera_role" value="<?php echo esc_attr( $v( '_sera_role' ) ); ?>"></td></tr>
		<tr><th><label for="sera_metrics">Métricas (até 3)</label></th><td><textarea class="large-text" rows="3" id="sera_metrics" name="_sera_metrics" placeholder="+15% | Onboarding conversion"><?php echo esc_textarea( $v( '_sera_metrics' ) ); ?></textarea><p class="description">Uma por linha, no formato <code>valor | legenda</code>.</p></td></tr>
		<tr><th><label for="sera_chips">Tags do card</label></th><td><input class="large-text" id="sera_chips" name="_sera_chips" value="<?php echo esc_attr( $v( '_sera_chips' ) ); ?>" placeholder="Onboarding, Research, Compliance"><p class="description">Separadas por vírgula.</p></td></tr>
		<tr><th><label for="sera_description">Descrição para o Google (opcional)</label></th><td><textarea class="large-text" rows="2" id="sera_description" name="_sera_description" placeholder="Se vazio, usa o Resumo (excerpt) da página"><?php echo esc_textarea( $v( '_sera_description' ) ); ?></textarea><p class="description">Meta description e prévias de link (~155 caracteres).</p></td></tr>
		<tr><th><label for="sera_visual">Visual</label></th><td>
			<select id="sera_visual" name="_sera_visual">
				<option value="image" <?php selected( $v( '_sera_visual' ), 'image' ); ?>>Imagem destacada da página</option>
				<?php foreach ( sera_mockups() as $slug => $label ) : ?>
					<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $v( '_sera_visual' ), $slug ); ?>>Mockup: <?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</td></tr>
	</table>
	<?php
}

add_action(
	'save_post_page',
	function ( $post_id ) {
		if ( ! isset( $_POST['sera_case_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sera_case_nonce'] ) ), 'sera_case_save' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
		foreach ( sera_case_meta_keys() as $key => $type ) {
			if ( ! isset( $_POST[ $key ] ) ) {
				continue;
			}
			$raw   = wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$value = 'textarea' === $type ? sanitize_textarea_field( $raw ) : sanitize_text_field( $raw );
			if ( '_sera_visual' === $key && 'image' !== $value && ! array_key_exists( $value, sera_mockups() ) ) {
				$value = 'image';
			}
			update_post_meta( $post_id, $key, $value );
		}
	}
);

/**
 * "Portfolio" column in the pages list.
 */
add_filter(
	'manage_page_posts_columns',
	function ( $cols ) {
		$cols['sera_case'] = 'Portfolio';
		return $cols;
	}
);
add_action(
	'manage_page_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'sera_case' === $col ) {
			echo sera_is_case( $post_id ) ? '● #' . (int) get_post_field( 'menu_order', $post_id ) : '—';
		}
	},
	10,
	2
);
