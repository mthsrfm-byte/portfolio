<?php
/**
 * Featured case card (inside the loop).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$id      = get_the_ID();
$visual  = sera_case_visual( $id );
$chips   = sera_case_chips( $id );
$is_live = 'publish' === get_post_status( $id );
?>
<article class="case-card reveal">
	<a class="case-link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( sera_t( 'Read case: %s', 'Ler o case: %s' ), get_the_title() ) ); ?>"></a>
	<?php if ( ! $is_live ) : ?>
		<span class="draft-badge">Rascunho · só você vê</span>
	<?php endif; ?>
	<div class="case-visual" aria-hidden="true"><?php echo $visual; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	<div class="case-body">
		<?php
		// Card: sem o nome da empresa (já está no selo da imagem); só ano e o papel resumido (antes do primeiro "·" ou ",").
		$sera_year = get_post_meta( $id, '_sera_year', true );
		$sera_role = trim( preg_split( '/\s+·\s+|,\s+/u', (string) get_post_meta( $id, '_sera_role', true ) )[0] );
		$sera_meta = array_filter( array( $sera_year ? '<span class="cm-year">' . esc_html( $sera_year ) . '</span>' : '', $sera_role ? '<span class="cm-role">' . esc_html( $sera_role ) . '</span>' : '' ) );
		if ( $sera_meta ) {
			echo '<div class="case-meta case-meta--card">' . implode( '<span class="sep" aria-hidden="true"></span>', $sera_meta ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput
		}
		?>
		<h3 class="case-title"><span class="ct-long"><?php echo esc_html( sera_case_headline( $id ) ); ?></span><span class="ct-short"><?php echo esc_html( get_the_title( $id ) ); ?></span></h3>
		<?php if ( has_excerpt( $id ) ) : ?>
			<p class="case-summary"><?php echo esc_html( get_the_excerpt( $id ) ); ?></p>
		<?php endif; ?>
		<?php echo sera_metrics_html( sera_case_metrics( $id ) ); // phpcs:ignore ?>
		<div class="case-foot">
			<?php if ( $chips ) : ?>
				<ul class="chips">
					<?php foreach ( $chips as $c ) : ?>
						<li class="chip"><?php echo esc_html( $c ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<span class="read" aria-hidden="true"><?php sera_e( 'Read case', 'Ler case' ); ?> <span class="arrow"><?php echo sera_icon( 'arrow-right' ); // phpcs:ignore ?></span></span>
		</div>
	</div>
</article>
