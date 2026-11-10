<?php
/**
 * Fatal Model · PerfisAD — recreated research screens (2024).
 * The interview flow is an illustrative recreation of the asynchronous video
 * interview; no participant images or names are shown. The logo is the one
 * used in the original research deck (assets/logos/fatal-model.svg).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

function sera_fm_logo( $class = 'fm-logo' ) {
	return '<img class="' . esc_attr( $class ) . '" src="' . esc_url( get_template_directory_uri() . '/assets/logos/fatal-model.svg' ) . '" alt="Fatal Model">';
}

function sera_fm_i( $name ) {
	$p = array(
		'video' => '<rect x="3" y="6" width="13" height="12" rx="3"/><path d="M16 10l5-3v10l-5-3"/>',
		'mic'   => '<rect x="9" y="3" width="6" height="11" rx="3"/><path d="M5 11a7 7 0 0 0 14 0M12 18v3"/>',
		'text'  => '<path d="M4 6h16M4 12h16M4 18h10"/>',
		'lock'  => '<rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
		'check' => '<path d="M5 12.5l4.5 4.5L19 7.5"/>',
		'x'     => '<path d="M6 6l12 12M18 6L6 18"/>',
	);
	return '<svg class="fm-i" viewBox="0 0 24 24" aria-hidden="true">' . ( isset( $p[ $name ] ) ? $p[ $name ] : '' ) . '</svg>';
}

function sera_fm_top( $step, $total ) {
	$pct = round( 100 * $step / $total );
	return '<div class="fm-top"><span class="close">' . sera_fm_i( 'x' ) . '</span><span class="prog"><i style="width:' . (int) $pct . '%"></i></span><span class="step">' . (int) $step . '/' . (int) $total . '</span></div>';
}

/* 1 — the question, recorded by the team */
function sera_scr_fm_ask() {
	$h  = '<div class="fm-scr fm-ask"><span class="fm-bg" aria-hidden="true"></span>';
	$h .= sera_fm_top( 3, 9 );
	$h .= '<div class="fm-host"><span class="av"></span><span><b>Product Design · Fatal Model</b><small>Pergunta em vídeo · 0:24</small></span></div>';
	$h .= '<div class="fm-q"><small>PERGUNTA 3</small><h3>Como é um dia normal na sua rotina, do momento em que você acorda até a hora de dormir?</h3><p>Não existe resposta certa. Conte do seu jeito, no seu tempo.</p></div>';
	$h .= '<div class="fm-opts"><i class="mk-pick" aria-hidden="true"></i><span class="on mk-opt-b">' . sera_fm_i( 'video' ) . 'Responder por vídeo</span><span class="mk-opt-a">' . sera_fm_i( 'mic' ) . 'Responder por áudio</span><span>' . sera_fm_i( 'text' ) . 'Responder por texto</span></div>';
	$h .= '<p class="fm-priv">' . sera_fm_i( 'lock' ) . 'Suas respostas são confidenciais e usadas apenas nesta pesquisa.</p>';
	return $h . '</div>';
}

/* 2 — answering in her own time and space */
function sera_scr_fm_rec() {
	$h  = '<div class="fm-scr fm-rec2"><span class="fm-bg" aria-hidden="true"></span>';
	$h .= sera_fm_top( 3, 9 );
	$h .= '<div class="fm-chips"><span class="fm-live"><i></i>REC 01:42</span><span class="fm-anon">' . sera_fm_i( 'lock' ) . 'Anônimo</span></div>';
	$h .= '<div class="fm-qmini"><small>PERGUNTA 3</small>Como é um dia normal na sua rotina?</div>';
	$h .= '<div class="fm-orb"><i class="r3"></i><i class="r2"></i><i class="r1"></i><span class="core"></span><span class="bars mk-bars">' . str_repeat( '<b></b>', 9 ) . '</span></div>';
	$h .= '<div class="fm-pip"><span class="ph"><i></i><i></i></span><small>Você</small></div>';
	$h .= '<div class="fm-tx"><small>' . sera_fm_i( 'text' ) . 'Transcrição ao vivo</small><p><span class="done">Eu costumo almoçar tarde porque,</span> <span class="mk-w" style="--w:0">fazendo isso,</span> <span class="mk-w" style="--w:1">normalmente eu</span> <mark class="mk-w" style="--w:2">esqueço de comer.</mark></p></div>';
	$h .= '<div class="fm-recbar"><span class="t">Regravar</span><span class="stop mk-rec"><i></i></span><span class="t">Enviar</span></div>';
	return $h . '</div>';
}

/* 3 — the survey that scaled what the interviews found */
function sera_scr_fm_survey() {
	$h  = '<div class="fm-scr fm-survey"><span class="fm-bg" aria-hidden="true"></span>';
	$h .= str_replace( '<span class="prog">', '<span class="prog mk-prog">', sera_fm_top( 6, 14 ) );
	$h .= '<div class="fm-q"><small>PESQUISA · PARTE 2</small><h3>Quanto você entende de como funcionam os planos e o ranking da Fatal?</h3></div>';
	$opts = array( 'Entendo bem', 'Entendo em parte', 'Não entendo', 'Nunca procurei saber' );
	$h .= '<div class="fm-choices">';
	foreach ( $opts as $i => $o ) {
		$h .= '<span' . ( 1 === $i ? ' class="on mk-choice"' : '' ) . '><i>' . ( 1 === $i ? sera_fm_i( 'check' ) : '' ) . '</i>' . esc_html( $o ) . '</span>';
	}
	$h .= '</div><span class="fm-next mk-ready">Continuar</span>';
	return $h . '</div>';
}
