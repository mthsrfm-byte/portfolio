<?php
/**
 * Home.
 *
 * Cases = Pages with the category (or tag) "portfolio", ordered by "Order".
 * Nothing is listed without its own page/URL.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

get_header();

$cases    = sera_case_query();
$featured = sera_mod( 'work_all' ) ? PHP_INT_MAX : max( 0, (int) sera_mod( 'work_featured' ) );
$logos    = sera_logos();
$hidden   = array_filter( array_map( 'trim', explode( ',', (string) sera_mod( 'logos_hidden' ) ) ) );
$logos    = array_diff_key( $logos, array_flip( $hidden ) );
$now_logo = sera_mod( 'hero_now_logo' );
?>

<?php // Hero + Selected work wrapper (the v3.4.1 "sheet" transition was removed in 3.5.3: normal scroll until the first case). ?>
<?php // v3.42 · Cover: SERAFIM masthead + 3D bust (template-parts/cover.php). The old headline block is gone; the logo strip stays. ?>
<?php get_template_part( 'template-parts/cover' ); ?>
<div class="hero-scope">
<section class="hero hero-logos-only">
	<?php if ( $logos ) : ?>
		<div class="logos" role="region" aria-label="<?php echo esc_attr( sera_mod( 'logos_title' ) ); ?>">
			<div class="wrap">
				<div class="logos-head"><span class="eyebrow"><?php echo esc_html( sera_mod( 'logos_title' ) ); ?></span></div>
				<div class="marquee" style="--dur:<?php echo (int) max( 30, count( $logos ) * 4 ); ?>s">
					<div class="marquee-track">
						<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
							<ul class="marquee-list"<?php echo $copy ? ' aria-hidden="true"' : ''; ?>>
								<?php foreach ( $logos as $slug => $l ) : ?>
									<?php
									// Optical sizing: wide wordmarks shorter, square marks taller.
									$h = $l['ratio'] > 3.2 ? 26 : ( $l['ratio'] > 1.8 ? 34 : 44 );
									?>
									<li><?php echo sera_logo_mask( $slug, $h, ! $copy ); // phpcs:ignore ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>

<section class="block" id="work">
	<div class="wrap">
		<?php
		// 3.44.1 · no pinned "Selected work" line: the cards stack on plain, native scrolling (no snap, no stepping).
		// The heading stays for screen readers and the outline.
		?>
		<h2 class="screen-reader-text"><?php echo esc_html( sera_mod( 'work_title' ) ); ?></h2>

		<?php if ( $cases->have_posts() ) : ?>
			<div class="cases">
				<?php
				$i    = 0;
				$rest = array();
				while ( $cases->have_posts() ) :
					$cases->the_post();
					if ( $i < $featured ) {
						get_template_part( 'template-parts/case-card' );
					} else {
						$rest[] = get_the_ID();
					}
					$i++;
				endwhile;
				?>
			</div>

			<?php if ( $rest ) : ?>
				<section class="more-work reveal" aria-labelledby="more-work-title">
					<h3 id="more-work-title" class="screen-reader-text"><?php echo esc_html( sera_mod( 'more_title' ) ); ?></h3>
					<?php
					foreach ( $rest as $id ) {
						get_template_part( 'template-parts/case-row', null, array( 'id' => $id ) );
					}
					?>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php elseif ( current_user_can( 'edit_pages' ) ) : ?>
			<div class="empty-state">Nenhuma página com a categoria <strong>portfolio</strong> ainda. <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>">Criar um case</a>. (Só você, logado, vê esta mensagem.)</div>
		<?php endif; ?>
	</div>
</section>
</div>

<?php
// 3.55 · Approach "Piso vivo" at every width: the title in grains + a perspective floor of glyphs (assets/js/approach.js).
// Texts come from the Customizer; the h2 stays real for screen readers, the canvases are decoration.
$sera_ap       = array();
for ( $i = 1; $i <= 4; $i++ ) {
	if ( sera_mod( "p{$i}_title" ) ) {
		$sera_ap_proof = (string) sera_mod( "p{$i}_proof" );
		$sera_ap_co    = '';
		if ( preg_match( '/^([^:]{1,40}):\s*(.+)$/u', $sera_ap_proof, $m ) ) {
			$sera_ap_co    = $m[1];
			$sera_ap_proof = $m[2];
		}
		$sera_ap[] = array(
			'i'     => $i,
			'n'     => sprintf( '%02d', $i ),
			'title' => sera_mod( "p{$i}_title" ),
			'text'  => sera_mod( "p{$i}_text" ),
			'co'    => $sera_ap_co,
			'proof' => $sera_ap_proof,
		);
	}
}
$sera_ap_proof_html = function ( $p ) {
	if ( '' === $p['proof'] ) {
		return '';
	}
	return '<p class="ap-proof">' . ( $p['co'] ? '<b>' . esc_html( $p['co'] ) . '</b>' : '' ) . esc_html( $p['proof'] ) . '</p>';
};
?>
<div class="ap-fade" data-header-tint="ink" aria-hidden="true"></div>
<section class="block" id="approach" data-ap-title="<?php echo esc_attr( sera_mod( 'approach_title' ) ); ?>">

	<div class="ap-pin"><div class="ap-floor">
		<div class="wrap">
			<h2 class="ap-floor-h"><?php echo esc_html( sera_mod( 'approach_title' ) ); ?></h2>
			<div class="ap-top">
				<div class="ap-mast" aria-hidden="true"></div>
				<p class="ap-intro"><?php echo esc_html( sera_mod( 'approach_intro' ) ); ?></p>
			</div>
		</div>
		<div class="ap-stage" aria-hidden="true">
			<canvas></canvas>
			<div class="wrap"><div class="ap-now"><span class="ap-n"><?php echo esc_html( $sera_ap ? $sera_ap[0]['n'] : '' ); ?></span><span class="ap-cap"><?php echo esc_html( $sera_ap ? $sera_ap[0]['title'] : '' ); ?></span></div></div>
		</div>
		<div class="wrap">
			<ol class="ap-list">
				<?php foreach ( $sera_ap as $k => $p ) : ?>
					<li class="ap-p<?php echo 0 === $k ? ' on' : ''; ?>">
						<h3 class="ap-t"><button type="button" aria-pressed="<?php echo 0 === $k ? 'true' : 'false'; ?>"><span class="ap-n"><?php echo esc_html( $p['n'] ); ?></span><span class="ap-tt"><?php echo esc_html( $p['title'] ); ?></span></button></h3>
						<p class="ap-tx"><?php echo esc_html( $p['text'] ); ?></p>
						<?php echo $sera_ap_proof_html( $p ); // phpcs:ignore ?>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div></div>
</section>

<section class="block" id="experience">
	<div class="wrap">
		<?php
		$sera_xp     = sera_lines( sera_mod( 'xp_items' ), 4 );
		$sera_xp_now = '/\b(now|present|hoje|atual|o momento)\b/iu';
		?>
		<?php // 3.x · Experience "Masthead": each company is a thin condensed cover name; role and area sit on the name's baseline, tied to it by a dashed leader (assets/css/experience.css). ?>
		<div class="xpm">
			<div class="xpm-head reveal">
				<h2><?php echo esc_html( sera_mod( 'xp_title' ) ); ?></h2>
			</div>
			<div class="xpm-list reveal">
				<?php foreach ( $sera_xp as $i => $row ) : ?>
					<?php
					$sera_is_now = (bool) preg_match( $sera_xp_now, $row[0] );
					// "Title, area" → title on top, area in mono below (only splits the existing text at its first comma).
					$sera_role = array_map( 'trim', explode( ',', (string) $row[2], 2 ) );
					?>
					<article class="xpm-row<?php echo $sera_is_now ? ' is-now' : ''; ?>">
						<div class="xpm-meta">
							<span class="xpm-when"><?php echo esc_html( sprintf( '%02d', $i + 1 ) . ' · ' . $row[0] ); ?></span>
							<?php if ( $sera_is_now ) : ?>
								<span class="xpm-now"><i></i><?php echo esc_html( sera_t( 'Now', 'Atual' ) ); ?></span>
							<?php endif; ?>
						</div>
						<div class="xpm-line">
							<h3 class="xpm-name"><?php echo esc_html( $row[1] ); ?></h3>
							<span class="xpm-lead" aria-hidden="true"></span>
							<p class="xpm-role">
								<span class="xpm-title"><?php echo esc_html( $sera_role[0] ); ?></span>
								<?php if ( ! empty( $sera_role[1] ) ) : ?>
									<span class="xpm-area"><?php echo esc_html( $sera_role[1] ); ?></span>
								<?php endif; ?>
							</p>
						</div>
						<?php if ( ! empty( $row[3] ) ) : ?>
							<p class="xpm-what"><?php echo esc_html( $row[3] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
			<?php if ( sera_mod( 'xp_more' ) ) : ?>
				<p class="xpm-more"><?php echo esc_html( sera_mod( 'xp_more' ) ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="block" id="about">
	<div class="wrap ab-wrap">
		<div class="ab-bento">
			<div class="ab-tile ab-lead reveal">
				<span class="eyebrow"><?php sera_e( 'About', 'Sobre' ); ?></span>
				<p class="about-text"><?php echo sera_emphasis( sera_mod( 'about_text' ) ); // phpcs:ignore ?></p>
				<?php $chips = array_filter( array_map( 'trim', explode( ';', (string) sera_mod( 'about_chips' ) ) ) ); ?>
				<?php if ( $chips ) : ?>
					<ul class="ab-chips">
						<?php foreach ( $chips as $c ) : ?>
							<li><?php echo esc_html( $c ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<figure class="ab-tile ab-me reveal" data-ab-parallax>
				<img class="ab-me-img" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/about/me-mic.jpg' ); ?>" width="1000" height="1000" loading="lazy" decoding="async" alt="<?php echo esc_attr( sera_t( 'Matheus Serafim holding a microphone, wearing a New York cap', 'Matheus Serafim segurando um microfone, de boné New York' ) ); ?>">
				<figcaption class="ab-me-cap"><span>Matheus Serafim</span></figcaption>
			</figure>
			<?php $ab_items = sera_lines( sera_mod( 'about_items' ) ); ?>
			<div class="ab-facts" data-ab-facts>
				<?php foreach ( $ab_items as $n => $item ) : ?>
					<?php
					$parts = array_map( 'trim', explode( '|', $item, 2 ) );
					$title = count( $parts ) > 1 ? $parts[0] : '';
					$body  = count( $parts ) > 1 ? $parts[1] : $parts[0];
					?>
					<article class="ab-tile ab-fact ab-f<?php echo (int) ( $n + 1 ); ?> reveal">
						<?php echo sera_about_media( $n + 1 ); // phpcs:ignore ?>
						<div class="ab-fact-body">
							<div class="ab-top"><span class="ab-ico" aria-hidden="true"><?php echo sera_about_icon( $n + 1 ); // phpcs:ignore ?></span><span class="ab-k"><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></span></div>
							<?php if ( $title ) : ?><h3><?php echo esc_html( $title ); ?></h3><?php endif; ?>
							<p><?php echo esc_html( $body ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
			<?php if ( count( $ab_items ) > 1 ) : ?>
				<p class="ab-count" aria-hidden="true"><span data-ab-now>01</span> / <?php echo esc_html( sprintf( '%02d', count( $ab_items ) ) ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
