<?php
/**
 * Pages. Portfolio pages get the case layout; any other page is a plain page.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$id = get_the_ID();

	if ( sera_is_case( $id ) ) :
		$visual = sera_case_visual( $id );
		$chips  = sera_case_chips( $id );
		?>
		<article <?php post_class( 'case' ); ?>>
			<header class="case-hero">
				<div class="wrap">
					<a class="back-link" href="<?php echo esc_url( home_url( '/#work' ) ); ?>"><?php echo sera_icon( 'arrow-right' ); // phpcs:ignore ?><?php sera_e( 'All work', 'Todos os trabalhos' ); ?></a>
					<?php echo sera_case_meta_html( $id ); // phpcs:ignore ?>
					<h1><?php echo esc_html( sera_case_headline( $id ) ); ?></h1>
					<?php if ( has_excerpt() ) : ?>
						<p class="lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
					<?php endif; ?>
					<?php echo sera_metrics_html( sera_case_metrics( $id ) ); // phpcs:ignore ?>
					<?php if ( $chips ) : ?>
						<ul class="chips" style="margin-top:28px">
							<?php foreach ( $chips as $c ) : ?>
								<li class="chip"><?php echo esc_html( $c ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if ( $visual ) : ?>
						<div class="case-hero-visual"><?php echo $visual; // phpcs:ignore ?></div>
					<?php endif; ?>
				</div>
			</header>

			<div class="case-content">
				<?php the_content(); ?>
			</div>

			<?php
			// Next case: the following portfolio page by order (loops back to the first).
			$all  = array_map( 'intval', sera_case_query( array( 'fields' => 'ids' ) )->posts );
			$pos  = array_search( (int) $id, $all, true );
			$next = ( false !== $pos && count( $all ) > 1 ) ? $all[ ( $pos + 1 ) % count( $all ) ] : 0;
			if ( $next ) :
				// Accent + thumbnail from the next case's hero mockup (visual slug → case prefix).
				$next_visual = (string) get_post_meta( $next, '_sera_visual', true );
				$next_prefix = '';
				foreach ( array( 'pagaleve' => 'pg', 'research-hub' => 'rh', 'western-union' => 'wu', 'wu-' => 'wu', 'will-bank' => 'wb', 'fatal-model' => 'fm', 'fm-' => 'fm', 'acordo-certo' => 'ac', 'ac-' => 'ac', 'bastidores' => 'nb', 'nb-' => 'nb' ) as $k => $v ) {
					if ( 0 === strpos( $next_visual, $k ) ) {
						$next_prefix = $v;
						break;
					}
				}
				$next_thumb = ( $next_visual && 'image' !== $next_visual && function_exists( 'sera_render_mockup' ) ) ? sera_render_mockup( $next_visual ) : '';
				?>
				<div class="wrap">
					<?php // A div, not a link, wraps the thumbnail: the recreated screens contain inert <a> tags that would split an outer anchor. ?>
					<div class="next-case<?php echo $next_prefix ? ' is-' . esc_attr( $next_prefix ) : ''; ?><?php echo $next_thumb ? ' has-thumb' : ''; ?>">
						<a class="next-link" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
							<span class="eyebrow"><?php sera_e( 'Next case', 'Próximo case' ); ?> · <?php echo esc_html( get_post_meta( $next, '_sera_company', true ) ); ?></span>
							<span class="t"><?php echo esc_html( sera_case_headline( $next ) ); ?><?php echo sera_icon( 'arrow-right' ); // phpcs:ignore ?></span>
						</a>
						<?php if ( $next_thumb ) : ?>
							<div class="next-thumb" aria-hidden="true"><div class="case-card nt-card"><div class="case-visual"><?php echo $next_thumb; // phpcs:ignore ?></div></div></div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</article>
		<?php
	else :
		?>
		<article <?php post_class( 'page-plain' ); ?>>
			<div class="wrap"><h1><?php the_title(); ?></h1></div>
			<div class="case-content"><?php the_content(); ?></div>
		</article>
		<?php
	endif;
endwhile;

get_footer();
