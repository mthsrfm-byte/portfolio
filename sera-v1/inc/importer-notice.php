<?php
/**
 * Admin notice on Appearance › Sera · Cases when a case was imported from an
 * older version of the theme's library (its _sera_library_version ≠ SERA_VERSION).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cases whose stored library version differs from the current theme version.
 *
 * @return array[] [ [ 'title' => string, 'version' => string, 'edit' => url ], … ]
 */
function sera_outdated_cases() {
	if ( ! function_exists( 'sera_starter_cases' ) ) {
		return array();
	}
	$out = array();
	foreach ( sera_starter_cases() as $case ) {
		$page = get_page_by_path( $case['slug'], OBJECT, 'page' );
		if ( ! $page ) {
			continue;
		}
		$v = (string) get_post_meta( $page->ID, '_sera_library_version', true );
		if ( $v !== SERA_VERSION ) {
			$out[] = array(
				'title'   => $case['title'],
				'version' => $v ? $v : '?',
				'edit'    => get_edit_post_link( $page->ID ),
			);
		}
	}
	return $out;
}

add_action(
	'admin_notices',
	function () {
		if ( ! isset( $_GET['page'] ) || 'sera-cases' !== $_GET['page'] || ! current_user_can( 'edit_pages' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		$old = sera_outdated_cases();
		if ( ! $old ) {
			return;
		}
		echo '<div class="notice notice-warning"><p><strong>' . esc_html( sprintf( '%d case(s) com conteúdo de uma versão anterior da biblioteca (tema atual: %s).', count( $old ), SERA_VERSION ) ) . '</strong> Use “Atualizar conteúdo” para trazer a versão nova (edições manuais são sobrescritas; o WordPress guarda a anterior em Revisões).</p><ul style="margin:0 0 8px 20px;list-style:disc">';
		foreach ( $old as $c ) {
			echo '<li>' . esc_html( $c['title'] ) . ' <span style="color:#646970">(biblioteca ' . esc_html( $c['version'] ) . ')</span></li>';
		}
		echo '</ul></div>';
	}
);
