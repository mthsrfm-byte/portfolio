<?php
/**
 * Mockup: Paperplane Studio — the studio home in code (desktop) + the same home on a phone.
 * Static HTML/CSS (assets/css/cases/pp.css); the live screens only load on the case page itself.
 * Product UI stays in Portuguese, as in the product. Project and numbers are sample data.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$sera_pp_plane = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" stroke-linecap="round" aria-hidden="true"><path d="M3 11.5 21 3l-4.5 17-5-6.2L3 11.5Z"/><path d="M21 3 11.5 13.8l-1.2 5.8 2.8-3.7"/></svg>';
$sera_pp_steps = array(
	'Escrever'   => array( 'Ideia', 'Universo', 'Roteiro' ),
	'Visualizar' => array( 'Estilo visual', 'Personagens', 'Cenários', 'Decupagem', 'Storyboard' ),
	'Filmar'     => array( 'Movimento', 'Montagem' ),
);

// Desktop: the studio home (menu, continue card, episode progress, what the balance buys).
ob_start();
?>
<div class="ppk">
	<aside class="ppk-side">
		<div class="ppk-proj"><span class="ppk-logo"><?php echo $sera_pp_plane; // phpcs:ignore ?></span><span><b>O último trem</b><small>EPISÓDIO 1</small></span></div>
		<?php foreach ( $sera_pp_steps as $sera_pp_g => $sera_pp_items ) : ?>
			<p class="ppk-g"><?php echo esc_html( strtoupper( $sera_pp_g ) ); ?></p>
			<ul>
				<?php foreach ( $sera_pp_items as $sera_pp_i ) : ?>
					<li<?php echo 'Movimento' === $sera_pp_i ? ' class="is-next"' : ''; ?>><i></i><?php echo esc_html( $sera_pp_i ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
		<div class="ppk-saldo"><span class="ppk-ring"></span><span>≈ 1 min 3 s de vídeo</span></div>
	</aside>
	<div class="ppk-main">
		<div class="ppk-top"><span class="ppk-search">Buscar cena, tomada, personagem…</span><span class="ppk-next">Continuar: Movimento ›</span></div>
		<p class="ppk-kicker">Boa madrugada · Projeto aberto</p>
		<p class="ppk-h">O último trem</p>
		<p class="ppk-sub">Episódio 1 · 8 cenas · a duração se ajusta conforme você escreve.</p>
		<div class="ppk-row">
			<div class="ppk-card ppk-cont">
				<div>
					<span class="ppk-tag">STORYBOARD · CENA 3</span>
					<p class="ppk-ct">Continuar de onde parei</p>
					<p class="ppk-cs">Aprovar 3A · “Lia entra no vagão vazio, molhada de chuva”</p>
					<span class="ppk-btn">Abrir tomada 3A →</span>
				</div>
				<div class="ppk-art"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/cases/paperplane/site/media/cp-2-anime.webp' ); ?>" width="551" height="315" alt="" loading="lazy" decoding="async"></div>
			</div>
			<div class="ppk-card ppk-prog">
				<p class="ppk-ct2">Progresso do episódio</p>
				<p class="ppk-big"><b>8</b>/10 <small>etapas prontas</small></p>
				<div class="ppk-sq"><?php echo str_repeat( '<i class="on"></i>', 8 ) . '<i></i><i></i>'; // phpcs:ignore ?></div>
				<div class="ppk-groups"><span><b>3/3</b> Escrever</span><span><b>5/5</b> Visualizar</span><span><b>0/2</b> Filmar</span></div>
			</div>
		</div>
		<div class="ppk-row ppk-row-2">
			<div class="ppk-card ppk-list">
				<p class="ppk-ct2">Suas histórias</p>
				<?php foreach ( array( array( 'O último trem', 'Movimento', 'ABERTO' ), array( 'A estação sem nome', 'Estilo visual', '3 DE 10' ), array( 'Dona Odete', 'Estilo visual', '4 DE 10' ) ) as $sera_pp_r ) : ?>
					<p class="ppk-li"><i></i><b><?php echo esc_html( $sera_pp_r[0] ); ?></b><span><?php echo esc_html( $sera_pp_r[1] ); ?></span><em><?php echo esc_html( $sera_pp_r[2] ); ?></em></p>
				<?php endforeach; ?>
			</div>
			<div class="ppk-card ppk-cred">
				<p class="ppk-ct2">Seus créditos rendem <span class="ppk-pill">EQUILIBRADO</span></p>
				<p class="ppk-min">1 min 3 s <small>de vídeo</small></p>
				<div class="ppk-bar"><i></i></div>
				<p class="ppk-fine">Estimativa de uma tentativa por tomada.</p>
			</div>
		</div>
	</div>
</div>
<?php
$sera_pp_desk = ob_get_clean();

// Phone: the same home, with the navigation island above the thumb.
ob_start();
?>
<div class="ppk-m">
	<div class="ppk-m-top"><span class="ppk-logo"><?php echo $sera_pp_plane; // phpcs:ignore ?></span><b>O último trem</b><span class="ppk-next">Movimento ›</span></div>
	<p class="ppk-kicker">Boa madrugada · Projeto aberto</p>
	<p class="ppk-h">O último trem</p>
	<div class="ppk-card ppk-cont ppk-m-cont">
		<div class="ppk-art"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/cases/paperplane/site/media/cel-1.webp' ); ?>" width="409" height="234" alt="" loading="lazy" decoding="async"></div>
		<p class="ppk-ct">Continuar de onde parei</p>
		<span class="ppk-btn">Abrir tomada 3A →</span>
	</div>
	<div class="ppk-card ppk-prog">
		<p class="ppk-big"><b>8</b>/10 <small>etapas prontas</small></p>
		<div class="ppk-sq"><?php echo str_repeat( '<i class="on"></i>', 8 ) . '<i></i><i></i>'; // phpcs:ignore ?></div>
	</div>
	<div class="ppk-island"><span class="is-on">Início</span><i></i><i></i><i></i><span class="ppk-ori"><?php echo $sera_pp_plane; // phpcs:ignore ?></span></div>
</div>
<?php
$sera_pp_mob = ob_get_clean();
?>
<div class="mockup-stage mk-anim stage-pp mockup-hover">
	<span class="brand-chip"><span class="pp-chip-mark" aria-hidden="true"><?php echo $sera_pp_plane; // phpcs:ignore ?></span><span>Paperplane Studio</span></span>
	<div class="ac-hero-stage">
		<?php echo sera_browser( $sera_pp_desk, array( 'url' => 'beta.paperplanestudio.app', 'class' => 'pp-browser', 'label' => sera_t( 'Paperplane Studio home on desktop: pick up where you left off, episode progress at 8 of 10 steps, your stories and how much video the balance buys', 'Início do Paperplane Studio no computador: continuar de onde parei, progresso do episódio em 8 de 10 etapas, suas histórias e quanto vídeo o saldo rende' ) ) ); // phpcs:ignore ?>
		<?php echo sera_device( 'ppk-screen', $sera_pp_mob, array( 'position' => 'up', 'dark' => true, 'label' => sera_t( 'The same studio home on a phone, with the navigation island above the thumb', 'O mesmo Início do estúdio no celular, com a ilha de navegação acima do polegar' ) ) ); // phpcs:ignore ?>
	</div>
</div>
