<?php
/**
 * Home cover: the SERAFIM logo as masthead, the 3D bust and four cover lines.
 * The bust, its choreography and the scroll into the header logo live in assets/js/cover.js.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$sera_logo = sera_brand_logo();
// The masthead is decorative (the header already names the site); drop the svg's own label.
$sera_mast = preg_replace( '/\s(role|aria-label)="[^"]*"/', '', $sera_logo );
$sera_mast = preg_replace( '/<svg\b/', '<svg aria-hidden="true" focusable="false"', $sera_mast, 1 );
?>
<section class="cv" id="cover" aria-label="<?php echo esc_attr( sera_t( 'Matheus Serafim, product designer', 'Matheus Serafim, product designer' ) ); ?>"
	data-model="<?php echo esc_url( get_template_directory_uri() . '/assets/models/matheus-busto.glb?v=' . SERA_VERSION ); ?>"
	data-model-m="<?php echo esc_url( get_template_directory_uri() . '/assets/models/matheus-busto-m.glb?v=' . SERA_VERSION ); ?>"
	data-me="Matheus" data-you="<?php echo esc_attr( sera_t( 'You', 'Você' ) ); ?>" data-say="<?php echo esc_attr( sera_t( 'hi!', 'oi!' ) ); ?>">
	<span class="grid3d" id="g3" aria-hidden="true"><span class="fl near"><span class="pl"></span></span><span class="fl mid"><span class="pl"></span></span><span class="fl far"><span class="pl"></span></span></span>
	<div class="mast" aria-hidden="true"><?php echo $sera_mast; // phpcs:ignore WordPress.Security.EscapeOutput -- theme file. ?></div>
	<span class="bust-box" id="bustBox" aria-hidden="true"></span>
	<img class="cv-photo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/cover-fallback.webp?v=' . SERA_VERSION ); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async">
	<canvas class="bust" role="img" aria-label="<?php echo esc_attr( sera_t( '3D portrait of Matheus Serafim, turning to follow your pointer', 'Retrato 3D de Matheus Serafim, que vira a cabeça seguindo o cursor' ) ); ?>"></canvas>
	<div class="frame">
		<div class="cl c1"><span class="cap k"><?php sera_e( 'The fintech years', 'Os anos de fintech' ); ?></span><h2 class="thin"><?php sera_e( 'Nubank to Pagaleve', 'Do Nubank à Pagaleve' ); ?></h2><p><?php sera_e( 'Seven years designing credit, accounts, payment plans and debt negotiation.', 'Sete anos desenhando crédito, conta, parcelamento e negociação de dívidas.' ); ?></p></div>
		<div class="cl c2"><span class="cap k"><?php sera_e( 'Now building', 'Agora construindo' ); ?></span><h2 class="thin"><?php sera_e( 'The AI that ships them', 'A IA que coloca tudo no ar' ); ?></h2><p><?php sera_e( 'Research, design and build, with AI in every step.', 'Pesquisa, design e código, com IA em cada etapa.' ); ?></p></div>
		<div class="cl c3"><h1 class="thin"><?php sera_e( 'I design money', 'Eu desenho produtos' ); ?><br><?php sera_e( 'products people trust', 'de dinheiro que dão confiança' ); ?></h1><a class="cv-btn" href="#work"><?php sera_e( 'See selected work', 'Ver trabalhos selecionados' ); ?></a></div>
		<div class="cl c4"><span class="cap k"><?php sera_e( 'Open to', 'Aberto a' ); ?></span><h2 class="thin"><?php sera_e( 'Lead &amp; design manager roles', 'Vagas de lead e design manager' ); ?></h2><p><?php sera_e( 'And freelance projects, by project.', 'E freelas, por projeto.' ); ?></p></div>
	</div>
	<div class="cv-lab" hidden><p id="how"></p><div id="chips"></div><p id="readout" hidden></p></div>
</section>
