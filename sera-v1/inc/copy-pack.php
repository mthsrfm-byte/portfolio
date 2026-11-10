<?php
/**
 * Positioning pack (v3.10): "Product Design Lead who builds with AI".
 *
 * The new copy ships as the Customizer defaults (inc/customizer.php + inc/i18n/customizer-pt.php),
 * but values already saved in Personalizar win over defaults. This box, on Aparência › Sera · Cases,
 * clears the saved values of the fields below (EN and PT) so the new defaults show, after backing
 * them up. "Desfazer" puts the backed-up values back exactly as they were.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * Fields the pack touches.
 */
function sera_copy_pack_keys() {
	return array( 'hero_status', 'hero_rotate', 'hero_title', 'hero_title_2', 'hero_lede', 'hero_now_text', 'fact_1_value', 'fact_1_label', 'fact_3_value', 'fact_3_label', 'work_intro', 'cases_order', 'approach_intro', 'xp_intro', 'p4_title', 'p4_text', 'p4_proof', 'xp_intro', 'xp_items', 'seo_title', 'seo_description' );
}

/**
 * Admin box (rendered at the top of Sera · Cases).
 */
function sera_copy_pack_box() {
	$backup = get_option( 'sera_copy_backup_310' );
	$done   = isset( $_GET['sera_copy'] ) ? sanitize_key( wp_unslash( $_GET['sera_copy'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	?>
	<div style="max-width:1000px;margin:18px 0 8px;padding:18px 22px;background:#fff;border:1px solid #c3c4c7;border-left:4px solid #FF009B">
		<h2 style="margin:0 0 6px">Novo posicionamento da Home (v3.10)</h2>
		<p style="margin:0 0 10px;max-width:760px">“Product Design Lead que constrói com IA”: novo título, parágrafo, números do topo, um 4º princípio (“Construir a ferramenta, não só a tela”), a linha da Pagaleve na experiência, SEO e a ordem dos cases (Combina Antes, Research Hub e Lume primeiro). Em inglês e em português.</p>
		<p style="margin:0 0 12px;max-width:760px;color:#646970">Aplicar limpa os textos salvos nesses campos para valer o padrão novo do tema. Os textos atuais ficam guardados: “Desfazer” devolve tudo como estava. Os campos ficam editáveis em Personalizar › Sera · Home, como sempre.</p>
		<?php if ( 'applied' === $done ) : ?><div class="notice notice-success inline"><p>Posicionamento aplicado. Confira a Home em inglês e em /pt/.</p></div><?php endif; ?>
		<?php if ( 'undone' === $done ) : ?><div class="notice notice-info inline"><p>Textos anteriores restaurados.</p></div><?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline-block;margin-right:8px">
			<?php wp_nonce_field( 'sera_copy_pack' ); ?>
			<input type="hidden" name="action" value="sera_copy_apply">
			<button class="button button-primary"<?php disabled( (bool) $backup ); ?>>Aplicar o novo posicionamento</button>
		</form>
		<?php if ( $backup ) : ?>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:inline-block">
				<?php wp_nonce_field( 'sera_copy_pack' ); ?>
				<input type="hidden" name="action" value="sera_copy_undo">
				<button class="button">Desfazer (voltar aos textos anteriores)</button>
			</form>
		<?php endif; ?>
	</div>
	<?php
}

add_action(
	'admin_post_sera_copy_apply',
	function () {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( 'Sem permissão.' );
		}
		check_admin_referer( 'sera_copy_pack' );
		$backup = array();
		foreach ( sera_copy_pack_keys() as $k ) {
			foreach ( array( 'sera_' . $k, 'sera_' . $k . '_pt' ) as $mod ) {
				$v = get_theme_mod( $mod, null );
				if ( null !== $v ) {
					$backup[ $mod ] = $v;
					remove_theme_mod( $mod );
				}
			}
		}
		update_option( 'sera_copy_backup_310', $backup ? $backup : array( '_empty' => 1 ), false );
		wp_safe_redirect( admin_url( 'themes.php?page=sera-cases&sera_copy=applied' ) );
		exit;
	}
);

add_action(
	'admin_post_sera_copy_undo',
	function () {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( 'Sem permissão.' );
		}
		check_admin_referer( 'sera_copy_pack' );
		$backup = (array) get_option( 'sera_copy_backup_310', array() );
		foreach ( $backup as $mod => $v ) {
			if ( '_empty' !== $mod ) {
				set_theme_mod( $mod, $v );
			}
		}
		delete_option( 'sera_copy_backup_310' );
		wp_safe_redirect( admin_url( 'themes.php?page=sera-cases&sera_copy=undone' ) );
		exit;
	}
);
