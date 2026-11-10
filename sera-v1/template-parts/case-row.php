<?php
/**
 * Compact case row ("More work").
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$id = isset( $args['id'] ) ? (int) $args['id'] : get_the_ID();
?>
<a class="work-row" href="<?php echo esc_url( get_permalink( $id ) ); ?>">
	<span class="yr"><?php echo esc_html( get_post_meta( $id, '_sera_year', true ) ); ?></span>
	<span class="t"><?php echo esc_html( get_the_title( $id ) ); ?><?php echo 'publish' !== get_post_status( $id ) ? ' <small class="eyebrow">· rascunho</small>' : ''; ?></span>
	<span class="d"><?php echo esc_html( get_post_meta( $id, '_sera_company', true ) ); ?></span>
	<span class="c"><?php echo esc_html( get_post_meta( $id, '_sera_role', true ) ); ?></span>
	<?php echo sera_icon( 'arrow-right' ); // phpcs:ignore ?>
</a>
