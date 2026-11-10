<?php
/**
 * "Selected work" head: one slim line (title · intro · n / total) that stays pinned under the header
 * while the case cards stack below it (v3.6).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$total = isset( $args['total'] ) ? (int) $args['total'] : 0;
?>
<div class="work-head" data-total="<?php echo esc_attr( $total ); ?>">
	<h2><?php echo esc_html( sera_mod( 'work_title' ) ); ?></h2>
	<p><?php echo esc_html( sera_mod( 'work_intro' ) ); ?></p>
	<?php if ( $total > 1 ) : ?>
		<span class="wh-n" aria-hidden="true"><b>01</b><span> / <?php echo esc_html( sprintf( '%02d', $total ) ); ?></span></span>
		<span class="wh-p" aria-hidden="true"><i></i></span>
	<?php endif; ?>
</div>
