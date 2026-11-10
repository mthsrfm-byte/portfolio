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
<div class="hero-scope">
<section class="hero">
	<div class="wrap">
		<?php // v3.15 · "Manifesto": signature line, full-width title, then lede + CTAs beside two availability cards. ?>
		<div class="hero-b">
			<div class="hb-who">
				<?php
				$photo_alt = sera_mod( 'hero_photo_alt' );
				$photo_alt = $photo_alt ? $photo_alt : 'Matheus Serafim';
				?>
				<img src="<?php echo esc_url( sera_photo_url() ); ?>" width="112" height="112" alt="<?php echo esc_attr( $photo_alt ); ?>" fetchpriority="high">
				<span><b>Matheus Serafim</b><span><?php echo esc_html( sera_mod( 'hero_role' ) ); ?></span></span>
			</div>
			<?php echo sera_hero_title_html(); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside. ?>
			<div class="hb-foot">
				<div>
					<p class="hero-lede"><?php echo esc_html( sera_mod( 'hero_lede' ) ); ?></p>
					<div class="hero-ctas">
						<a class="btn btn-dark" href="#work"><?php sera_e( 'See selected work', 'Ver trabalhos selecionados' ); ?> <?php echo sera_icon( 'arrow-down' ); // phpcs:ignore ?></a>
						<?php if ( sera_mod( 'contact_email' ) ) : ?>
							<a class="btn btn-line" href="mailto:<?php echo esc_attr( sera_mod( 'contact_email' ) ); ?>?subject=<?php echo rawurlencode( sera_t( 'A project', 'Um projeto' ) ); ?>"><?php sera_e( 'Start a project', 'Começar um projeto' ); ?> <?php echo sera_icon( 'arrow-up-right' ); // phpcs:ignore ?></a>
						<?php endif; ?>
					</div>
				</div>
				<ul class="hb-av">
					<?php if ( sera_mod( 'hero_status' ) ) : ?>
						<li><i aria-hidden="true"></i><?php echo esc_html( sera_mod( 'hero_status' ) ); ?><span><?php echo esc_html( sera_mod( 'hero_status_note' ) ); ?></span></li>
					<?php endif; ?>
					<?php if ( sera_mod( 'hero_freela' ) ) : ?>
						<li class="is-freela"><i aria-hidden="true"></i><?php echo esc_html( sera_mod( 'hero_freela' ) ); ?><span><?php echo esc_html( sera_mod( 'hero_freela_note' ) ); ?></span></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<div class="facts">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<?php if ( sera_mod( "fact_{$i}_value" ) ) : ?>
					<div class="fact"><b><?php echo esc_html( sera_mod( "fact_{$i}_value" ) ); ?></b><span><?php echo esc_html( sera_mod( "fact_{$i}_label" ) ); ?></span></div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</div>

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
		$sera_cards = $cases->have_posts() ? min( (int) $featured, (int) $cases->post_count ) : 0;
		get_template_part( 'template-parts/work-head', null, array( 'total' => $sera_cards ) );
		?>

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

<section class="block" id="approach">
	<div class="wrap">
		<div class="section-head reveal">
			<h2><?php echo esc_html( sera_mod( 'approach_title' ) ); ?></h2>
			<p><?php echo esc_html( sera_mod( 'approach_intro' ) ); ?></p>
		</div>
		<div class="principles">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<?php if ( sera_mod( "p{$i}_title" ) ) : ?>
					<div class="principle reveal">
						<div class="p-top"><span class="p-ico"><?php echo sera_ph( array( 1 => 'chart-line-up', 2 => 'magnifying-glass', 3 => 'target', 4 => 'wrench' )[ $i ] ); // phpcs:ignore ?></span><span class="n"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></span></div>
						<h3><?php echo esc_html( sera_mod( "p{$i}_title" ) ); ?></h3>
						<p><?php echo esc_html( sera_mod( "p{$i}_text" ) ); ?></p>
						<?php if ( sera_mod( "p{$i}_proof" ) ) : ?>
							<span class="proof"><?php echo esc_html( sera_mod( "p{$i}_proof" ) ); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="block" id="experience">
	<div class="wrap">
		<?php
		$sera_xp     = sera_lines( sera_mod( 'xp_items' ), 4 );
		$sera_xp_now = '/\b(now|present|hoje|atual|o momento)\b/iu';
		?>
		<?php if ( count( $sera_xp ) > 1 ) : ?>
			<?php // Compact bar: same component as the Selected work bar (title, intro in one line, current role, n / total). ?>
			<div class="work-bar section-bar xp-bar" aria-hidden="true">
				<div class="work-bar-in">
					<span class="wbar-t"><?php echo esc_html( sera_mod( 'xp_title' ) ); ?></span>
					<span class="wbar-d"><?php echo esc_html( sera_mod( 'xp_intro' ) ); ?></span>
					<span class="wbar-c"></span>
					<span class="wbar-n"><b>01</b><span> / <?php echo esc_html( sprintf( '%02d', count( $sera_xp ) ) ); ?></span></span>
					<span class="wbar-p"><i></i></span>
				</div>
			</div>
		<?php endif; ?>
		<div class="section-head reveal xp-head">
			<h2><?php echo esc_html( sera_mod( 'xp_title' ) ); ?></h2>
			<p><?php echo esc_html( sera_mod( 'xp_intro' ) ); ?></p>
		</div>
		<div class="xp reveal">
			<?php foreach ( $sera_xp as $row ) : ?>
				<?php
				// "2026 — now" → "2026–now" for the bar label.
				$sera_when = preg_replace( '/\s*[—–-]\s*/u', '–', $row[0] );
				?>
				<div class="xp-row" data-label="<?php echo esc_attr( $row[1] . ' · ' . $sera_when ); ?>">
					<span class="when"><?php echo esc_html( $row[0] ); ?></span>
					<div>
						<div class="co"><?php echo esc_html( $row[1] ); ?><?php echo preg_match( $sera_xp_now, $row[0] ) ? '<span class="now">' . esc_html( sera_t( 'Now', 'Atual' ) ) . '</span>' : ''; ?></div>
						<div class="role"><?php echo esc_html( $row[2] ); ?></div>
					</div>
					<p class="what"><?php echo esc_html( $row[3] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ( sera_mod( 'xp_more' ) ) : ?>
			<p class="xp-more"><?php echo esc_html( sera_mod( 'xp_more' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>

<section class="block" id="about">
	<div class="wrap about">
		<div class="reveal">
			<span class="eyebrow"><?php sera_e( 'About', 'Sobre' ); ?></span>
			<p class="about-text"><?php echo sera_emphasis( sera_mod( 'about_text' ) ); // phpcs:ignore ?></p>
			<?php $chips = array_filter( array_map( 'trim', explode( ';', (string) sera_mod( 'about_chips' ) ) ) ); ?>
			<?php if ( $chips ) : ?>
				<ul class="chips">
					<?php foreach ( $chips as $c ) : ?>
						<li class="chip"><?php echo esc_html( $c ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<ol class="about-list reveal">
			<?php foreach ( sera_lines( sera_mod( 'about_items' ) ) as $n => $item ) : ?>
				<?php
				$parts = array_map( 'trim', explode( '|', $item, 2 ) );
				$title = count( $parts ) > 1 ? $parts[0] : '';
				$body  = count( $parts ) > 1 ? $parts[1] : $parts[0];
				?>
				<li>
					<span class="k"><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></span>
					<span class="txt"><?php if ( $title ) : ?><b><?php echo esc_html( $title ); ?></b><?php endif; ?><?php echo esc_html( $body ); ?></span>
					<?php echo sera_about_pop( $n + 1 ); // phpcs:ignore ?>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<?php
get_footer();
