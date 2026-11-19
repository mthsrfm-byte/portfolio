<?php
/**
 * Featured case card (inside the loop) · v3.44 "Capa".
 *
 * A magazine cover per case, in the language of the home cover: the short case name is the masthead,
 * the mockup stands in front of it (like the bust over SERAFIM), four cover lines sit in the corners
 * and the cover's 3D floor runs underneath. Fit, grains and parallax: assets/js/capa.js.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$id      = get_the_ID();
$visual  = sera_case_visual( $id );
$is_live = 'publish' === get_post_status( $id );
$metrics = sera_case_metrics( $id );

// "Name: what it is" → the name is the masthead, the rest is the bottom-left cover line.
$title = get_the_title( $id );
$parts = array_map( 'trim', explode( ':', $title, 2 ) );
$name  = $parts[0];
$rest  = isset( $parts[1] ) && '' !== $parts[1] ? $parts[1] : '';
if ( '' === $rest ) {
	$headline = sera_case_headline( $id );
	$rest     = $headline !== $title ? $headline : '';
}

// Top-left cover line: year · company, and the role up to its first "·" or ",".
$year    = (string) get_post_meta( $id, '_sera_year', true );
$company = (string) get_post_meta( $id, '_sera_company', true );
$role    = trim( preg_split( '/\s+·\s+|,\s+/u', (string) get_post_meta( $id, '_sera_role', true ) )[0] );
$kicker  = implode( ' · ', array_filter( array( $year, $company ) ) );
?>
<article class="case-card case-capa reveal">
	<a class="case-link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( sera_t( 'Read case: %s', 'Ler o case: %s' ), $title ) ); ?>"></a>
	<?php if ( ! $is_live ) : ?>
		<span class="draft-badge">Rascunho · só você vê</span>
	<?php endif; ?>
	<span class="cc-floor" aria-hidden="true"><span class="fl near"><span class="pl"></span></span><span class="fl mid"><span class="pl"></span></span><span class="fl far"><span class="pl"></span></span></span>
	<p class="cc-mast" aria-hidden="true"><span class="cc-mast-t"><?php echo esc_html( $name ); ?></span><i class="bl"></i></p>
	<div class="cc-fig case-visual" aria-hidden="true"><?php echo $visual; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	<div class="cc-lines">
		<div class="cl c1">
			<?php if ( $kicker ) : ?>
				<span class="cap k"><?php echo esc_html( $kicker ); ?></span>
			<?php endif; ?>
			<?php if ( $role ) : ?>
				<div class="h thin"><?php echo esc_html( $role ); ?></div>
			<?php endif; ?>
		</div>
		<?php if ( $metrics ) : ?>
			<div class="cl c2">
				<span class="cap k"><?php sera_e( 'Proof', 'Resultado' ); ?></span>
				<div class="h thin big"><?php echo esc_html( $metrics[0][0] ); ?></div>
				<?php if ( $metrics[0][1] ) : ?>
					<p><?php echo esc_html( $metrics[0][1] ); ?></p>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="cl c3">
			<h3 class="thin"><span class="screen-reader-text"><?php echo esc_html( $name ); ?>: </span><?php echo esc_html( $rest ? $rest : $name ); ?></h3>
			<span class="cc-cta" aria-hidden="true"><?php sera_e( 'Read case', 'Ler case' ); ?> <i><?php echo sera_icon( 'arrow-right' ); // phpcs:ignore ?></i></span>
		</div>
		<?php if ( count( $metrics ) > 1 ) : ?>
			<div class="cl c4">
				<?php foreach ( array_slice( $metrics, 1 ) as $m ) : ?>
					<div><div class="h thin"><?php echo esc_html( $m[0] ); ?></div><?php echo $m[1] ? '<p>' . esc_html( $m[1] ) . '</p>' : ''; // phpcs:ignore ?></div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<span class="cc-grain" aria-hidden="true"></span>
</article>
