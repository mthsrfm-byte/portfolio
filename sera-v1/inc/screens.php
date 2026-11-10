<?php
/**
 * Recreated app screens (HTML/CSS). Each function returns the inner HTML of a
 * 393×852 screen; sera_device() adds the iPhone frame and status bar.
 * Values are illustrative, as in the original prototypes.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/* ------------------------------------------------------------- motion helpers
 * Decorative layers for the v3.2 in-screen loops (mockups.css · "mockup motion").
 * All aria-hidden and invisible by default: they only appear once case.js arms a
 * stage (.mk-armed), so without JS or with reduced motion the screens are static. */

/**
 * Touch indicator that travels to (x, y) — screen px of the 393×852 screen — and presses.
 *
 * @param int    $x     Target centre x.
 * @param int    $y     Target centre y.
 * @param float  $t     Offset in seconds inside the 7.2 s cycle (0 = beat A, 3.6 = beat B).
 * @param string $class Extra classes (is-light on dark screens, mk-solo …).
 * @param array  $next  Optional second press [dx, dy] relative to the first (two-stop tap).
 */
function sera_mk_tap( $x, $y, $t = 0, $class = '', $next = null ) {
	$style = '--x:' . (int) $x . 'px;--y:' . (int) $y . 'px';
	if ( $t ) {
		$style .= ';--mk-t:' . (float) $t . 's';
	}
	if ( is_array( $next ) ) {
		$style .= ';--dx:' . (int) $next[0] . 'px;--dy:' . (int) $next[1] . 'px';
		$class .= ' is-two';
	}
	return '<i class="mk-tap ' . esc_attr( trim( $class ) ) . '" style="' . esc_attr( $style ) . '" aria-hidden="true"></i>';
}

/**
 * Desktop pointer for browser stages: rests, clicks (x, y), then clicks (x + dx, y + dy). Page px (1280 wide).
 */
function sera_mk_cursor( $x, $y, $dx, $dy ) {
	$style = '--x:' . (int) $x . 'px;--y:' . (int) $y . 'px;--dx:' . (int) $dx . 'px;--dy:' . (int) $dy . 'px';
	return '<i class="mk-cursor" style="' . esc_attr( $style ) . '" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 3l14 8.2-6.1 1.3 3.6 6.9-2.6 1.4-3.6-7L5 18z"/></svg></i>';
}

/**
 * iOS-style notification banner that drops in from the top of the screen.
 */
/**
 * App icon for a notification: the brand mark, or the iOS app icon (Calendar, Messages).
 */
function sera_mk_app_icon( $app ) {
	$k = strtolower( $app );
	if ( false !== strpos( $k, 'western' ) ) {
		return '<i class="ap ap-wu">' . sera_wu_mark() . '</i>';
	}
	if ( false !== strpos( $k, 'will' ) ) {
		static $wb = null;
		if ( null === $wb ) {
			$f  = get_template_directory() . '/assets/logos/will-bank.svg';
			$wb = file_exists( $f ) ? preg_replace( '/\s(role|aria-label)="[^"]*"/', '', (string) file_get_contents( $f ) ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions
			$wb = str_replace( '<svg ', '<svg aria-hidden="true" ', $wb );
		}
		return '<i class="ap ap-wb">' . $wb . '</i>';
	}
	if ( false !== strpos( $k, 'calend' ) ) {
		return '<i class="ap ap-cal"><em>QUA</em><b>30</b></i>';
	}
	if ( false !== strpos( $k, 'mensag' ) || false !== strpos( $k, 'messag' ) ) {
		return '<i class="ap ap-msg"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="#fff" d="M12 4C7 4 3 7.3 3 11.4c0 2.3 1.3 4.4 3.3 5.8-.2 1.2-.8 2.4-1.8 3.3 1.8 0 3.5-.7 4.7-1.7.9.2 1.8.3 2.8.3 5 0 9-3.3 9-7.4S17 4 12 4Z"/></svg></i>';
	}
	return '<i class="ap"></i>';
}

function sera_mk_toast( $app, $title, $text, $class = '' ) {
	return '<div class="mk-toast ' . esc_attr( $class ) . '" aria-hidden="true">' . sera_mk_app_icon( $app ) . '<div><small>' . esc_html( $app ) . '<span>agora</span></small><b>' . esc_html( $title ) . '</b><span>' . esc_html( $text ) . '</span></div></div>';
}

/**
 * Bottom sheet that slides up over the screen (trusted HTML from the theme).
 */
function sera_mk_sheet( $html, $class = '' ) {
	return '<div class="mk-sheet ' . esc_attr( $class ) . '" aria-hidden="true"><i class="grab"></i>' . $html . '</div>';
}

/**
 * Two values that roll from $from to $to (static: only $to is shown).
 */
function sera_mk_roll( $from, $to, $class = '' ) {
	return '<span class="mk-roll ' . esc_attr( $class ) . '"><span class="mk-ri"><span class="mk-from" aria-hidden="true">' . $from . '</span><span>' . $to . '</span></span></span>';
}

/* ------------------------------------------------------------------ Pagaleve */

function sera_scr_pg_home() {
	$h  = '<div class="mk-body"><div class="pg-head"><img class="pg-logo" src="' . esc_url( get_template_directory_uri() . '/assets/logos/pagaleve.svg' ) . '" alt="">' . '<span class="pg-chip ok">' . sera_s_icon( 'check' ) . '9 pagas em dia</span><span class="pg-chip rem">' . sera_s_icon( 'bell' ) . 'lembrete</span><span class="pg-help" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.2"/><path d="M9.6 9.4a2.5 2.5 0 0 1 4.8 1c0 1.7-2.4 2.1-2.4 3.6"/><circle cx="12" cy="17" r=".6" fill="currentColor"/></svg></span></div>';
	$h .= '<div class="pg-card pg-pay">';
	$h .= '<div class="pg-row"><div><div class="pg-lbl">A PAGAR</div><span class="pg-badge">Vence em 5 dias</span></div><div class="pg-amt"><b>R$ 228,05</b><span>4 parcelas de 4 lojas</span></div></div>';
	$h .= '<div class="pg-btn">Pagar R$ 228,05 ' . sera_s_icon( 'arrow' ) . '</div>';
	$h .= '<div class="pg-btn line">Antecipar parcelas ' . sera_s_icon( 'calendar' ) . '</div>';
	$h .= '<div class="pg-limit"><small>Limite disponível</small><div class="v"><b>R$ 387,35 <span>de R$ 1.000,00</span></b><a>Detalhes ›</a></div><div class="pg-bar"><i></i></div></div>';
	$h .= '</div>';
	$h .= '<div class="pg-card pg-offer mk-offer"><div class="top"><div class="pg-date"><small>SET</small><b>23</b></div><div><h4>Não vai dar pra pagar dia 23?</h4><p>A parcela de R$ 68,55 da Drogaria São Paulo vence quarta, 23/09. Combine uma nova data pra ela e pras outras que vencem este mês.</p></div><span class="x">' . sera_s_icon( 'close' ) . '</span></div>';
	$h .= '<div class="cta">Combinar nova data ' . sera_s_icon( 'arrow' ) . '</div></div>';
	$h .= '<div class="pg-sec">Próximas parcelas</div>';
	$h .= '<div class="pg-next">';
	foreach ( array( array( 'R$ 68,55', 'Drogaria São Paulo', 'Parcela 2 de 4', 'Vence dia 23', true, 'bag' ), array( 'R$ 50,00', 'Lojas Renova', 'Parcela 3 de 4', 'Em 12 dias', false, 'bag' ), array( 'R$ 62,50', 'Netshoes', 'Parcela 2 de 4', 'Em 19 dias', false, 'bag' ) ) as $c ) {
		$h .= '<div><span class="ic">' . sera_s_icon( $c[5] ) . '</span><b>' . $c[0] . '</b><span>' . $c[1] . '</span><em>' . $c[2] . '</em><i' . ( $c[4] ? ' class="soon"' : '' ) . '>' . $c[3] . '</i><a>Pagar ' . sera_s_icon( 'arrow' ) . '</a></div>';
	}
	$h .= '</div>';
	$h .= '<div class="pg-open"><div class="hd"><b>Parcelamentos em aberto</b></div><div class="pg-card lst"><div class="th"><span>Lançamento</span><span>Em aberto</span></div>';
	foreach ( array( array( 'Renner', '18/09 · 2 de 4 pagas', 'R$ 250,00', 'resta R$ 125,00' ), array( 'Drogaria São Paulo', '11/09 · 1 de 4 pagas', 'R$ 274,20', 'resta R$ 205,65' ), array( 'Netshoes', '04/09 · 1 de 4 pagas', 'R$ 250,00', 'resta R$ 187,50' ) ) as $r ) {
		$h .= '<div class="tr"><span class="ic">' . sera_s_icon( 'bag' ) . '</span><div class="l"><b>' . $r[0] . '</b><span>' . $r[1] . '</span></div><div class="r"><b>' . $r[2] . '</b><span>' . $r[3] . '</span></div>' . sera_s_icon( 'chev-r' ) . '</div>';
	}
	$h .= '</div></div></div>';
	$h .= '<nav class="pg-tab"><span>' . sera_pg_tab_i( 'home' ) . 'Início</span><span>' . sera_pg_tab_i( 'store' ) . 'Lojas</span><span class="mid"><i>' . sera_pg_tab_i( 'grid' ) . '</i>Parcelar tudo</span><span class="on">' . sera_pg_tab_i( 'bag' ) . 'Compras</span><span>' . sera_pg_tab_i( 'menu' ) . 'Menu</span></nav>';
	return $h;
}

function sera_pg_tab_i( $n ) {
	$p = array(
		'home'  => '<path d="M4 11l8-6 8 6v8a1 1 0 0 1-1 1h-4v-5h-6v5H5a1 1 0 0 1-1-1z"/>',
		'store' => '<path d="M5 9h14l-1 11H6z"/><path d="M9 9V7a3 3 0 0 1 6 0v2"/>',
		'grid'  => '<rect x="5" y="5" width="6" height="6" rx="1.5"/><rect x="13" y="5" width="6" height="6" rx="1.5"/><rect x="5" y="13" width="6" height="6" rx="1.5"/><rect x="13" y="13" width="6" height="6" rx="1.5"/>',
		'bag'   => '<rect x="5" y="8" width="14" height="12" rx="2"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
		'menu'  => '<path d="M5 7h14M5 12h14M5 17h14"/>',
	);
	return '<svg class="t-ico" viewBox="0 0 24 24" aria-hidden="true">' . $p[ $n ] . '</svg>';
}

function sera_scr_pg_nav( $step ) {
	$steps = '';
	for ( $i = 1; $i <= 3; $i++ ) {
		$steps .= '<i' . ( $i <= $step ? ' class="on"' : '' ) . '></i>';
	}
	return '<div class="pg-nav">' . sera_s_icon( 'back' ) . '<h5>Combinar nova data</h5>' . sera_s_icon( 'close' ) . '</div><div class="pg-steps">' . $steps . '</div>';
}

function sera_scr_pg_date() {
	$h  = sera_scr_pg_nav( 2 );
	$h .= '<div class="pg-h">Escolha a nova data</div>';
	$h .= '<div class="pg-sub">Sua parcela de R$ 68,55 vence 23/09. Quanto mais perto, menos juros.</div>';
	$h .= '<div class="pg-opts"><i class="mk-slide" aria-hidden="true"></i>';
	$opts = array(
		array( 'Sábado, 26/09', '3 dias depois', 'R$ 68,96', '+ R$ 0,41', false ),
		array( 'Segunda, 28/09', '5 dias depois', 'R$ 69,24', '+ R$ 0,69', false, 'mk-opt-a' ),
		array( 'Quarta, 30/09', '7 dias depois', 'R$ 69,51', '+ R$ 0,96', true, 'mk-opt-b' ),
	);
	foreach ( $opts as $o ) {
		$h .= '<div class="pg-opt' . ( $o[4] ? ' on' : '' ) . ( isset( $o[5] ) ? ' ' . $o[5] : '' ) . '"><span class="r"></span><div class="l"><b>' . $o[0] . '</b><span>' . $o[1] . '</span></div><div class="p"><b>' . $o[2] . '</b><span>' . $o[3] . '</span></div></div>';
	}
	$h .= '<div class="pg-cal">' . sera_s_icon( 'calendar' ) . 'Escolher data no calendário' . sera_s_icon( 'chev-r' ) . '</div></div>';
	$h .= '<div class="pg-cmp"><small>COMPARANDO</small><div class="ln"><span>Combinando para ' . sera_mk_roll( '28/09', '30/09' ) . '</span><b>' . sera_mk_roll( 'R$ 69,24', 'R$ 69,51' ) . '</b></div><div class="ln late"><span>Atrasando até ' . sera_mk_roll( '28/09', '30/09' ) . '</span><span>+ multa e encargos</span></div><p>No atraso entram multa, encargos de mora e cobranças.</p></div>';
	$h .= '<div class="pg-foot"><div class="pg-btn">Continuar</div></div>';
	return $h;
}

function sera_scr_pg_review() {
	$h  = sera_scr_pg_nav( 3 );
	$h .= '<div class="pg-h">Revise o combinado</div>';
	$h .= '<div class="pg-card pg-sum">';
	$h .= '<div class="it"><span class="pg-store">' . sera_s_icon( 'bag' ) . '</span><div><b>Drogaria São Paulo</b><span>Parcela 2 de 4</span></div></div>';
	$h .= '<div class="ln"><span>Vencimento atual</span><s>Quarta, 23/09</s></div>';
	$h .= '<div class="ln"><span>Nova data</span><b>Quarta, 30/09</b></div>';
	$h .= '<div class="ln"><span>Parcela</span><span>R$ 68,55</span></div>';
	$h .= '<div class="ln"><span>Juros do combinado (7 dias)</span><span>+ R$ 0,96</span></div>';
	$h .= '<div class="ln tot"><span>Total a pagar</span><b>R$ 69,51</b></div>';
	$h .= '</div>';
	$h .= '<div class="pg-warn"><b>' . sera_s_icon( 'info' ) . 'Fica de olho</b><p>Se não der pra pagar até 30/09, o combinado deixa de valer e a parcela volta às regras de atraso desde 23/09.</p></div>';
	$h .= '<div class="pg-accept"><i class="mk-check"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5 10 17l9-10"/></svg></i><span>Li e concordo com as condições do combinado</span></div>';
	$h .= '<div class="pg-foot"><div class="pg-btn mk-ready">Confirmar nova data</div></div>';
	return $h;
}

function sera_scr_pg_done() {
	$h  = '<div class="pg-done">';
	$h .= '<div class="pg-ok mk-pop"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5 10 17l9-10"/></svg></div>';
	$h .= '<div class="pg-h c">Combinado!</div>';
	$h .= '<div class="pg-sub c">Sua parcela de R$ 69,51 agora vence<br><b>quarta, 30/09</b>.</div>';
	$h .= '<ol class="pg-tl"><li class="on"><i></i><div><b>Hoje</b><span>Combinado feito</span></div></li><li><i></i><div><b>Seg, 28/09</b><span>Lembrete com o Pix pronto</span></div></li><li><i></i><div><b>Qua, 30/09</b><span>Novo vencimento</span></div></li></ol>';
	$h .= '<div class="pg-rate"><span>Como foi combinar?</span><div><i>1</i><i>2</i><i>3</i><i>4</i><i class="on">5</i></div></div>';
	$h .= '</div>';
	$h .= '<div class="pg-foot two"><div class="pg-btn line">' . sera_s_icon( 'calendar' ) . 'Adicionar à agenda</div><div class="pg-btn">Voltar ao início</div></div>';
	return $h;
}

/* ------------------------------------------------------------ Western Union */

function sera_wu_id_svg( $side = 'front' ) {
	if ( 'front' === $side ) {
		return '<svg viewBox="0 0 300 196" aria-hidden="true"><defs><linearGradient id="wuidf" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#D8EDD9"/><stop offset=".55" stop-color="#BFE0C4"/><stop offset="1" stop-color="#A9D3B1"/></linearGradient><pattern id="wuguil" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M0 5 Q2.5 0 5 5 T10 5" fill="none" stroke="#9CCAA5" stroke-width=".6"/></pattern></defs>'
			. '<rect width="300" height="196" rx="8" fill="url(#wuidf)"/><rect width="300" height="196" rx="8" fill="url(#wuguil)" opacity=".7"/><rect x="4" y="4" width="292" height="188" rx="6" fill="none" stroke="#5FA070" stroke-width="1.4"/>'
			. '<rect x="4" y="4" width="292" height="18" fill="#5FA070" opacity=".85"/><text x="150" y="16.5" text-anchor="middle" font-family="Geist, sans-serif" font-size="8.5" font-weight="700" letter-spacing="1.2" fill="#F1FAF2">REPÚBLICA FEDERATIVA DO BRASIL</text>'
			. '<text x="16" y="38" font-family="Geist, sans-serif" font-size="8" font-weight="700" fill="#2F6B40">CARTEIRA DE IDENTIDADE</text>'
			. '<rect x="16" y="48" width="74" height="96" rx="3" fill="#EEF3EF" stroke="#7FB38C"/><circle cx="53" cy="84" r="16" fill="#9AA5A0"/><path d="M26 144c3-19 14-28 27-28s24 9 27 28z" fill="#9AA5A0"/>'
			. '<g fill="#6E9F7B" opacity=".75"><rect x="104" y="50" width="120" height="5" rx="2"/><rect x="104" y="64" width="170" height="5" rx="2"/><rect x="104" y="78" width="150" height="5" rx="2"/><rect x="104" y="92" width="80" height="5" rx="2"/><rect x="196" y="92" width="78" height="5" rx="2"/><rect x="104" y="106" width="120" height="5" rx="2"/><rect x="104" y="120" width="60" height="5" rx="2"/><rect x="176" y="120" width="98" height="5" rx="2"/></g>'
			. '<path d="M110 150c20-8 40 8 60 0" fill="none" stroke="#2F6B40" stroke-width="1.2"/><text x="150" y="182" text-anchor="middle" font-family="Geist, sans-serif" font-size="7.5" font-weight="700" letter-spacing="1" fill="#2F6B40">VÁLIDA EM TODO O TERRITÓRIO NACIONAL</text></svg>';
	}
	return '<svg viewBox="0 0 300 196" aria-hidden="true"><defs><linearGradient id="wuidb" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#DCEFDD"/><stop offset="1" stop-color="#B3D8BA"/></linearGradient></defs>'
		. '<rect width="300" height="196" rx="8" fill="url(#wuidb)"/><rect x="4" y="4" width="292" height="188" rx="6" fill="none" stroke="#5FA070" stroke-width="1.4"/>'
		. '<g fill="#6E9F7B" opacity=".75"><rect x="16" y="20" width="150" height="5" rx="2"/><rect x="16" y="34" width="190" height="5" rx="2"/><rect x="16" y="48" width="120" height="5" rx="2"/><rect x="16" y="62" width="180" height="5" rx="2"/><rect x="16" y="76" width="100" height="5" rx="2"/><rect x="128" y="76" width="68" height="5" rx="2"/><rect x="16" y="90" width="170" height="5" rx="2"/><rect x="16" y="104" width="140" height="5" rx="2"/><rect x="16" y="118" width="186" height="5" rx="2"/><rect x="16" y="132" width="90" height="5" rx="2"/></g>'
		. '<rect x="216" y="30" width="68" height="100" rx="3" fill="#F7FAF7" stroke="#7FB38C"/><g fill="none" stroke="#3A3F3C" stroke-width="1.1"><ellipse cx="250" cy="80" rx="8" ry="11"/><ellipse cx="250" cy="80" rx="14" ry="18"/><ellipse cx="250" cy="81" rx="20" ry="25"/><ellipse cx="250" cy="82" rx="26" ry="32" opacity=".6"/></g>'
		. '<text x="150" y="176" text-anchor="middle" font-family="Geist, sans-serif" font-size="7.5" font-weight="700" letter-spacing="1" fill="#2F6B40">VÁLIDA EM TODO O TERRITÓRIO NACIONAL</text></svg>';
}

function sera_wu_check() {
	return '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12.5 10 17l9-10"/></svg>';
}

function sera_wu_snap() {
	return '<span class="mk-snap" aria-hidden="true"><i></i><i></i><i></i><i></i><b class="mk-flash"></b><em class="mk-ok">' . sera_wu_check() . '</em></span>';
}

function sera_scr_wu_front() {
	$h  = '<div class="wu-top">' . sera_s_icon( 'back' ) . '<span></span></div>';
	$h .= '<div class="wu-step">Etapa 1 de 2<div class="wu-bar"><i></i></div></div>';
	$h .= '<div class="wu-h">Foto da <u>FRENTE</u> do seu RG</div>';
	$h .= '<div class="wu-id">' . sera_wu_id_svg( 'front' ) . sera_wu_snap() . '</div>';
	$h .= '<div class="wu-ex">Ex: RG Antigo. <u>Trocar?</u></div>';
	$h .= '<ol class="wu-list mk-steps"><li><span>1</span>Vá para um local bem iluminado e não utilize flash</li><li><span>2</span>Tire o documento do plástico</li><li><span>3</span>Coloque o documento em uma superfície lisa, sem estampas</li></ol>';
	$h .= '<div class="wu-btns"><div class="wu-btn">Tirar foto</div><div class="wu-btn line">Escolher foto da galeria</div></div>';
	return $h;
}

function sera_scr_wu_back_dark() {
	$h  = '<div class="wu-glow"></div><div class="wu-top y">' . sera_s_icon( 'back' ) . '<span></span></div>';
	$h .= '<div class="wu-step w">Etapa 2 de 2<div class="wu-bar d"><i class="mk-fill" style="width:100%"></i></div></div>';
	$h .= '<div class="wu-h w">Foto da <u>PARTE DE TRÁS</u> do seu RG</div>';
	$h .= '<div class="wu-id mk-flip"><span class="mk-card"><span class="mk-face mk-front" aria-hidden="true">' . sera_wu_id_svg( 'front' ) . '</span><span class="mk-face mk-back">' . sera_wu_id_svg( 'back' ) . '</span></span></div>';
	$h .= '<div class="wu-ex w">Ex: RG Antigo. <u>Trocar?</u></div>';
	$h .= '<ol class="wu-list w"><li><span>1</span>Vá para um local bem iluminado e não utilize flash</li><li><span>2</span>Tire o documento do plástico</li><li><span>3</span>Coloque o documento em uma superfície lisa, sem estampas</li></ol>';
	$h .= '<div class="wu-btns"><div class="wu-btn">Tirar foto</div><div class="wu-btn line d">Escolher foto da galeria</div></div>';
	return $h;
}

function sera_scr_wu_before() {
	$h  = '<div class="wu-top y">' . sera_s_icon( 'back' ) . '<span></span></div>';
	$h .= '<div class="wu-step w">Passo 5 de 5<div class="wu-bar d"><i style="width:100%"></i></div></div>';
	$h .= '<div class="wu-h w b">Tire uma foto do seu RG</div>';
	$h .= '<div class="wu-ids"><span></span><span class="l"></span></div>';
	$h .= '<p class="wu-p w">Você deve tirar <em>uma foto da frente e uma do verso</em> do seu RG.</p>';
	$h .= '<div class="wu-box mk-rules"><i class="mk-ring" aria-hidden="true"></i><b>Importante</b>Envie apenas jpg.<br>As informações devem ser claramente legíveis. O documento deve ser original e sem cortes.<br><br>Use um fundo sólido para garantir a clareza.</div>';
	$h .= '<div class="wu-btns"><div class="wu-btn mk-press">Ok, entendi</div><div class="wu-btn line d">Carregar manualmente</div><div class="wu-btn">Prefiro carregar meu ID Digital</div></div>';
	return $h;
}

function sera_scr_wu_confirm() {
	$h  = '<div class="wu-top">' . sera_s_icon( 'back' ) . '<span></span></div>';
	$h .= '<div class="wu-photo">' . sera_wu_id_svg( 'back' ) . '</div>';
	$h .= '<ul class="wu-checks"><li><i class="mk-tick">' . sera_wu_check() . '</i><span>Essa é uma foto da <b>parte de trás do documento</b>?</span></li><li><i>' . sera_wu_check() . '</i><span>A foto está <b>legível</b>?</span></li></ul>';
	$h .= '<div class="wu-btns"><div class="wu-btn mk-ready">Tudo certo, continuar</div><div class="wu-btn line">Tentar de novo</div></div>';
	return $h;
}

function sera_scr_wu_camera() {
	$h  = '<div class="wu-top">' . sera_s_icon( 'back' ) . '<span></span></div>';
	$h .= '<div class="wu-frame"><div class="wu-cam mk-frame"><span class="mk-idcam" aria-hidden="true">' . sera_wu_id_svg( 'front' ) . '</span><span class="c1"></span><span class="c2"></span><span class="c3"></span><span class="c4"></span><b class="mk-flash" aria-hidden="true"></b></div></div>';
	$h .= '<div class="wu-h" style="font-size:20px;padding-top:24px">Foto da <u>FRENTE</u> do RG</div>';
	$h .= '<p class="wu-p c">Alinhe o documento dentro do quadro.</p>';
	$h .= '<div class="wu-btns"><div class="wu-btn">Tirar foto</div></div>';
	return $h;
}

function sera_scr_wu_otp() {
	$h  = '<div class="wu-notif mk-drop"><div class="t">' . sera_mk_app_icon( 'Mensagens' ) . 'MENSAGENS<span>agora</span></div><b>999-112</b><span>Seu código de 6 dígitos é 999-112</span></div>';
	$h .= '<div class="wu-otp-h">Digite o código de 6 dígitos enviado para (11) 9●●●●-8888</div>';
	$h .= '<a class="wu-link">Este não é seu número de celular?</a>';
	$h .= '<div class="wu-code mk-code"><i><b style="--w:0">9</b></i><i><b style="--w:1">9</b></i><i><b style="--w:2">9</b></i><em>-</em><i><b style="--w:3">1</b></i><i><b style="--w:4">1</b></i><i><b style="--w:5">2</b></i></div>';
	$h .= '<p class="wu-err">Seu código de verificação expirou</p>';
	$h .= '<div class="wu-resend">Não recebeu o código?<br><b>Solicite um novo código em 00:59</b></div>';
	$h .= '<div class="wu-btns"><div class="wu-btn off">Continuar</div></div>';
	return $h;
}

function sera_scr_wu_almost() {
	$h  = '<div class="wu-almost"><span class="wu-card-ico"></span>';
	$h .= '<div class="wu-h b" style="font-size:21px">Quase pronto. Preencha os detalhes restantes para começar a receber dinheiro.</div>';
	$h .= '<p class="wu-p c">Você pode concluir a configuração agora ou somente quando a conta estiver aberta.</p></div>';
	$h .= '<div class="wu-btns"><div class="wu-btn">Completar cadastro</div><div class="wu-btn line">Agora não</div></div>';
	return $h;
}

/* ---------------------------------------------------------------- will bank */

function sera_scr_wb_card() {
	$h  = '<div class="wb-yellow"></div><div class="wb-rel">';
	$h .= '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>cartão de crédito</h5><span class="wb-q">?</span></div>';
	$h .= '<span class="wb-pill">' . sera_s_icon( 'info' ) . 'Fatura aberta</span>';
	$h .= '<div class="wb-amt">' . sera_mk_roll( 'R$ 1.000,00', 'R$ 1.316,60' ) . ' ' . sera_s_icon( 'chev-r' ) . '</div>';
	$h .= '<div class="wb-info"><span>Vence 12/01 • em 29 dias</span><span>Fecha 02/01 • melhor dia de compra 03/01</span><span>Limite disponível <b>R$ 1.046,72</b></span></div>';
	$h .= '<div class="wb-adv">' . sera_s_icon( 'invoice' ) . 'Adiantar fatura' . sera_s_icon( 'chev-r' ) . '</div>';
	$tiles = array(
		array( 'pix', 'Fazer<br>Pix' ),
		array( 'barcode', 'Pagar<br>boleto' ),
		array( 'phone', 'Recarregar<br>celular' ),
		array( 'chart', 'Conferir<br>faturas' ),
		array( 'calendar', 'Alterar<br>vencimento' ),
		array( 'plus', 'Mais<br>opções' ),
	);
	$h .= '<div class="wb-grid">';
	foreach ( $tiles as $t ) {
		$h .= '<div class="wb-tile"><div class="t">' . sera_s_icon( $t[0] ) . sera_s_icon( 'chev-r' ) . '</div><span>' . $t[1] . '</span></div>';
	}
	$h .= '</div><div class="wb-sec">Últimas compras<span class="wb-all">Ver todas</span></div>';
	$h .= '<ul class="wb-list wb-list-s mk-list">';
	foreach ( array( array( 'cart', 'Mercadinho Santa Tereza', 'Hoje • 13h50', 'R$ 316,60', 'À vista' ), array( 'bag', 'Farmácia Pague Menos', '12 dez • 19h12', 'R$ 48,70', 'À vista' ), array( 'at', 'Amazon Marketplace', '16 nov', 'R$ 340,16', 'Parcela 2 de 2' ) ) as $r ) {
		$h .= '<li><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b>' . $r[3] . '</b><span>' . $r[4] . '</span></div></li>';
	}
	$h .= '</ul></div>';
	return $h;
}

function sera_scr_wb_list() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>últimas compras</h5><span style="width:24px"></span></div>';
	$h .= '<div style="height:22px"></div><span class="wb-chip">Compras parceladas</span>';
	$rows = array(
		array( 'at', 'Amazon Marketplace', '16 nov', 'R$ 680,31', 'Em 2 parcelas' ),
		array( 'cart', 'Zaffari', '12 nov', 'R$ 120,22', 'Em 3 parcelas' ),
		array( 'bus', 'ClickBus', '28 jun', 'R$ 313,50', 'Em 6 parcelas' ),
		array( 'bag', 'Mercado Livre', '04 abr', 'R$ 1.390,90', 'Em 10 parcelas' ),
	);
	$h .= '<ul class="wb-list">';
	foreach ( $rows as $r ) {
		$h .= '<li><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b>' . $r[3] . '</b><span>' . $r[4] . '</span></div>' . sera_s_icon( 'chev-r', 'chev' ) . '</li>';
	}
	$h .= '</ul><div class="wb-day"><span class="wb-chip">Quarta • 13 de dezembro</span></div>';
	$h .= '<ul class="wb-list"><li><span class="ic y">' . sera_s_icon( 'invoice' ) . '</span><div class="l"><b>Pagamento de fatura</b><span>Você pagou R$ 2.107,30</span></div><div class="r"><span>14h03</span></div></li></ul>';
	$h .= '<div class="wb-day"><span class="wb-chip">Terça • 12 de dezembro</span></div><ul class="wb-list">';
	foreach ( array( array( 'bus', 'Uber', 'À vista', 'R$ 23,90', '18h40' ), array( 'cart', 'Padaria Real', 'À vista', 'R$ 18,50', '08h05' ) ) as $r ) {
		$h .= '<li><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b>' . $r[3] . '</b><span>' . $r[4] . '</span></div></li>';
	}
	$h .= '</ul>';
	return $h;
}

function sera_scr_wb_detail() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>detalhes da compra</h5><span style="width:24px"></span></div>';
	$h .= '<div class="wb-det"><span class="wb-store">' . sera_s_icon( 'cart' ) . '</span>';
	$h .= '<b class="n">Mercadinho Santa Tereza</b><b class="v">R$ 316,60</b><span class="d">14/12/2023 às 13h50</span>';
	$h .= '<span class="wb-chip s">Compra à vista</span>';
	$h .= '<div class="wb-split">' . sera_s_icon( 'chart' ) . '<b>Parcelar compra</b>' . sera_s_icon( 'chev-r' ) . '</div>';
	$h .= '<dl><dt>Cartão final</dt><dd>0123</dd><dt>Categoria</dt><dd>Mercado</dd><dt>Status</dt><dd class="ok">' . sera_mk_roll( 'Em análise…', 'Aprovada e já somada à fatura aberta' ) . '</dd></dl></div>';
	return $h;
}

/**
 * will bank sheets for the motion loops: installments of a purchase, and "parcelar compra".
 */
function sera_wb_sheet_inst() {
	$h  = '<b class="t">Mercado Livre</b><span class="s">R$ 1.390,90 em 10 parcelas de R$ 139,09</span>';
	$h .= '<span class="wb-dots">' . str_repeat( '<i class="on"></i>', 3 ) . str_repeat( '<i></i>', 7 ) . '</span>';
	$h .= '<span class="wb-sl"><span>3 de 10 pagas</span><b>Próxima em 12/01</b></span>';
	return sera_mk_sheet( $h, 'wb-sheet' );
}

function sera_wb_sheet_split( $class = '' ) {
	$h  = '<b class="t">Parcelar compra</b><span class="s">Mercadinho Santa Tereza · R$ 316,60</span>';
	foreach ( array( array( '2x', 'R$ 162,28', 'Total R$ 324,56', true ), array( '3x', 'R$ 109,73', 'Total R$ 329,19', false ), array( '6x', 'R$ 56,76', 'Total R$ 340,56', false ) ) as $o ) {
		$h .= '<span class="wb-op' . ( $o[3] ? ' on' : '' ) . '"><b>' . $o[0] . '</b><span>' . $o[1] . '</span><small>' . $o[2] . '</small></span>';
	}
	return sera_mk_sheet( $h, trim( 'wb-sheet ' . $class ) );
}


/* ------------------------------------------- will bank · time control (v3.9) */
/* Reconstructed screens (the originals are gone): bills past and future, and paying installments
   early with a discount. Same visual language as the card screens above (.scr-wb). */

function sera_wbx_check() {
	return '<svg class="s-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12.5 4.5 4.5L19 7.5"/></svg>';
}

/**
 * Month timeline shared by the two bill screens: a row of month cards (paid, open, upcoming)
 * sitting on a time track with a "hoje" marker. The row is scrolled so the selected month sits second.
 *
 * @param int $sel Index of the selected month.
 */
function sera_wbx_rail( $sel ) {
	$m = array(
		array( 'nov', '1.842,10', 'paid', 'Paga' ),
		array( 'dez', '2.107,30', 'paid', 'Paga' ),
		array( 'jan', '1.316,60', 'open', 'Aberta' ),
		array( 'fev', '612,40', 'next', 'Prevista' ),
		array( 'mar', '488,15', 'next', 'Prevista' ),
		array( 'abr', '302,70', 'next', 'Prevista' ),
	);
	$h = '<div class="wbx-tl"><div class="wbx-track" style="--o:' . max( 0, $sel - 1 ) . '">';
	foreach ( $m as $i => $x ) {
		$h .= '<span class="wbx-mc is-' . $x[2] . ( $i === $sel ? ' on' : '' ) . '"><em>' . $x[0] . '</em><b><small>R$</small> ' . $x[1] . '</b><span>' . ( 'paid' === $x[2] ? sera_wbx_check() : '' ) . $x[3] . '</span></span>';
	}
	$h .= '<span class="wbx-line"><i class="past"></i><i class="now">hoje</i><i class="fut"></i></span>';
	return $h . '</div></div>';
}

function sera_scr_wb_bills() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>faturas</h5><span class="wb-q">?</span></div>';
	$h .= sera_wbx_rail( 2 );
	$h .= '<div class="wbx-sum"><span class="wbx-st open">Aberta</span><b>R$ 1.316,60</b><span>Fecha 02/01 · vence 12/01</span></div>';
	$h .= '<div class="wb-sec">O que já está nela<span class="wb-all">Ver todas</span></div><ul class="wb-list wb-list-s">';
	foreach ( array( array( 'cart', 'Mercadinho Santa Tereza', 'Hoje • 13h50', 'R$ 316,60', 'À vista' ), array( 'bag', 'Mercado Livre', 'Parcela 3 de 10', 'R$ 139,09', '' ), array( 'bus', 'ClickBus', 'Parcela 4 de 6', 'R$ 52,25', '' ), array( 'at', 'Amazon Marketplace', 'Parcela 1 de 2', 'R$ 340,16', '' ) ) as $r ) {
		$h .= '<li><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b>' . $r[3] . '</b>' . ( $r[4] ? '<span>' . $r[4] . '</span>' : '' ) . '</div></li>';
	}
	return $h . '</ul>';
}

function sera_scr_wb_bill_next() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>faturas</h5><span class="wb-q">?</span></div>';
	$h .= sera_wbx_rail( 3 );
	$h .= '<div class="wbx-sum"><span class="wbx-st next">Prevista</span><b>R$ 612,40</b><span>Vence 12/02 · pode mudar com novas compras</span></div>';
	$h .= '<div class="wbx-cta"><span class="ic">' . sera_s_icon( 'tag' ) . '</span><div><b>Antecipe parcelas com desconto</b><span>Pague antes e deixe de pagar parte dos juros</span></div>' . sera_s_icon( 'chev-r' ) . '</div>';
	$h .= '<div class="wb-sec">Já previsto para fevereiro</div><ul class="wb-list wb-list-s">';
	foreach ( array( array( 'bag', 'Mercado Livre', 'Parcela 4 de 10', 'R$ 139,09' ), array( 'at', 'Amazon Marketplace', 'Parcela 2 de 2', 'R$ 340,16' ), array( 'bus', 'ClickBus', 'Parcela 5 de 6', 'R$ 52,25' ), array( 'cart', 'Zaffari', 'Parcela 3 de 3', 'R$ 40,07' ), array( 'phone', 'Assinaturas', '2 cobranças mensais', 'R$ 40,83' ) ) as $r ) {
		$h .= '<li><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b>' . $r[3] . '</b></div></li>';
	}
	return $h . '</ul>';
}

function sera_scr_wb_adv_pick() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>antecipar parcelas</h5><span style="width:24px"></span></div>';
	$h .= '<div class="wbx-buy"><span class="ic">' . sera_s_icon( 'bag' ) . '</span><div><b>Mercado Livre</b><span>R$ 1.390,90 em 10x · 3 pagas</span></div></div>';
	$h .= '<p class="wbx-hint">Escolha quais parcelas quer pagar agora. Quanto mais longe a parcela, maior o desconto.</p><ul class="wbx-inst">';
	$rows = array(
		array( '4', 'fev', 'R$ 139,09', 'R$ 136,31', true ),
		array( '5', 'mar', 'R$ 139,09', 'R$ 133,56', true ),
		array( '6', 'abr', 'R$ 139,09', 'R$ 130,86', true ),
		array( '7', 'mai', 'R$ 139,09', 'R$ 128,21', true ),
		array( '8', 'jun', 'R$ 139,09', 'R$ 125,61', false ),
	);
	foreach ( $rows as $r ) {
		$h .= '<li' . ( $r[4] ? ' class="on"' : '' ) . '><span class="cb">' . ( $r[4] ? sera_wbx_check() : '' ) . '</span><div class="l"><b>Parcela ' . $r[0] . ' de 10</b><span>Fatura de ' . $r[1] . '</span></div><div class="r"><s>' . $r[2] . '</s><b>' . $r[3] . '</b></div></li>';
	}
	$h .= '</ul><div class="wbx-bar"><div><span>4 parcelas · você economiza <b>R$ 27,42</b></span><b class="t">R$ 528,94</b></div><span class="wbx-btn">Continuar</span></div>';
	return $h;
}

function sera_scr_wb_adv_review() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>revisar</h5><span style="width:24px"></span></div>';
	$h .= '<div class="wbx-rev"><span class="wbx-k">Você vai pagar agora</span><b class="wbx-big">R$ 528,94</b><span class="wbx-save">' . sera_s_icon( 'tag' ) . 'R$ 27,42 a menos em juros</span>';
	$h .= '<dl><dt>Parcelas</dt><dd>4 a 7 de 10 · Mercado Livre</dd><dt>Valor sem desconto</dt><dd>R$ 556,36</dd><dt>Desconto</dt><dd class="ok">– R$ 27,42</dd><dt>Entra na fatura de</dt><dd>Janeiro, a aberta</dd><dt>Limite liberado</dt><dd>R$ 528,94, assim que a fatura for paga</dd></dl></div>';
	$h .= '<div class="wbx-pay"><span class="wbx-opt on"><i></i>Somar à fatura aberta</span><span class="wbx-opt"><i></i>Pagar agora com Pix</span></div>';
	$h .= '<div class="wbx-bar solo"><span class="wbx-btn">Antecipar R$ 528,94</span></div>';
	return $h;
}

function sera_scr_wb_adv_done() {
	$h  = '<div class="wb-yellow wbx-y"></div><div class="wb-rel">';
	$h .= '<div class="wbx-done"><span class="wbx-ok">' . sera_wbx_check() . '</span><b>Parcelas antecipadas</b><span>Você economizou R$ 27,42 e as faturas dos próximos meses já foram atualizadas.</span></div>';
	$h .= '<div class="wbx-after"><span class="wbx-k">Próximas faturas</span>';
	foreach ( array( array( 'fev', 'R$ 612,40', 'R$ 473,31' ), array( 'mar', 'R$ 488,15', 'R$ 349,06' ), array( 'abr', 'R$ 302,70', 'R$ 163,61' ), array( 'mai', 'R$ 139,09', 'R$ 0,00' ) ) as $r ) {
		$h .= '<div class="row"><span>' . $r[0] . '</span><s>' . $r[1] . '</s><b>' . $r[2] . '</b></div>';
	}
	$h .= '</div></div><div class="wbx-bar solo"><span class="wbx-btn">Ver faturas</span></div>';
	return $h;
}

/* ------------------------------------------- will bank · time control, part 2 (v3.9) */
/* Simulate before buying, best purchase day + change due date, and the limit coming back on the spot. */

function sera_scr_wb_sim() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>simular compra</h5><span style="width:24px"></span></div>';
	$h .= '<div class="wbs-val"><span class="wbx-k">Valor da compra</span><b>R$ 960,00</b><span>Limite disponível R$ 1.046,72</span></div>';
	$h .= '<span class="wbs-lab">Em quantas vezes?</span><ul class="wbs-opts">';
	foreach ( array( array( '1x', 'R$ 960,00', 'Tudo em uma fatura', false ), array( '3x', 'R$ 320,00', 'De fev a abr', false ), array( '6x', 'R$ 160,00', 'De fev a jul', true ), array( '10x', 'R$ 96,00', 'De fev a nov', false ) ) as $o ) {
		$h .= '<li' . ( $o[3] ? ' class="on"' : '' ) . '><b>' . $o[0] . '</b><div class="l"><b>' . $o[1] . '</b><span>' . $o[2] . '</span></div><i></i></li>';
	}
	$h .= '</ul><span class="wbs-lab">Quando?</span><div class="wbs-seg"><span>Hoje</span><span class="on">A partir de 03/01</span></div>';
	$h .= '<p class="wbs-note">' . sera_s_icon( 'calendar' ) . 'Comprando a partir de 03/01, a 1ª parcela só vence em 12/02.</p>';
	$h .= '<div class="wbx-bar solo"><span class="wbx-btn">Ver como ficam as faturas</span></div>';
	return $h;
}

function sera_scr_wb_sim_result() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>suas faturas</h5><span style="width:24px"></span></div>';
	$h .= '<div class="wbs-top"><span class="wbx-k">Fatura mais alta · fevereiro</span><b>R$ 772,40</b><span>R$ 612,40 já previstos + R$ 160,00 da 1ª parcela</span></div>';
	$h .= '<div class="wbs-rows"><div class="hd"><span>Mês</span><span>Hoje</span><span>Com a compra</span></div>';
	foreach ( array( array( 'fev', '612,40', '772,40' ), array( 'mar', '488,15', '648,15' ), array( 'abr', '302,70', '462,70' ), array( 'mai', '139,09', '299,09' ), array( 'jun', '139,09', '299,09' ), array( 'jul', '139,09', '299,09' ) ) as $r ) {
		$h .= '<div class="row"><span>' . $r[0] . '</span><s>R$ ' . $r[1] . '</s><em>+ 160,00</em><b>R$ ' . $r[2] . '</b></div>';
	}
	$h .= '</div><div class="wbs-lim"><span>Limite depois da compra</span><b>R$ 86,72</b></div>';
	$h .= '<div class="wbx-bar solo"><span class="wbs-btn2">' . sera_s_icon( 'bell' ) . 'Me lembrar em 03/01</span><span class="wbx-btn">Pronto</span></div>';
	return $h;
}

function sera_scr_wb_bestday() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>melhor dia de compra</h5><span style="width:24px"></span></div>';
	$h .= '<div class="wbs-best"><span class="wbx-k">Seu melhor dia de compra</span><b>Dia 03</b><span>O que você comprar a partir desse dia só vence no mês seguinte, até 40 dias depois.</span></div>';
	$h .= '<div class="wbs-cal"><div class="mo">janeiro</div><div class="wd"><span>D</span><span>S</span><span>T</span><span>Q</span><span>Q</span><span>S</span><span>S</span></div><div class="dd">';
	$h .= str_repeat( '<span></span>', 4 );
	for ( $d = 1; $d <= 31; $d++ ) {
		$c = '';
		if ( 2 === $d ) {
			$c = 'cl';
		} elseif ( 3 === $d ) {
			$c = 'best';
		} elseif ( 12 === $d ) {
			$c = 'due';
		}
		$h .= '<span' . ( $c ? ' class="' . $c . '"' : '' ) . '>' . $d . '</span>';
	}
	$h .= '</div><div class="lg"><span><i class="cl"></i>Fecha</span><span><i class="best"></i>Melhor dia</span><span><i class="due"></i>Vence</span></div></div>';
	$h .= '<div class="wbs-cycle"><div><b>03/01</b><span>Você compra</span></div><i></i><div><b>02/02</b><span>Fatura fecha</span></div><i></i><div><b>12/02</b><span>Você paga</span></div></div>';
	$h .= '<div class="wbs-link">' . sera_s_icon( 'calendar' ) . '<div><b>Mudar dia de vencimento</b><span>O melhor dia de compra muda junto</span></div>' . sera_s_icon( 'chev-r' ) . '</div>';
	return $h;
}

function sera_scr_wb_due() {
	$h  = '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>alterar vencimento</h5><span style="width:24px"></span></div>';
	$h .= '<p class="wbs-lead">Escolha o dia em que a fatura vence. Embaixo de cada um, o melhor dia de compra.</p><div class="wbs-days">';
	foreach ( array( array( 1, 22 ), array( 5, 26 ), array( 10, 31 ), array( 12, 3, 'Atual' ), array( 15, 6 ), array( 20, 11 ), array( 25, 16 ), array( 28, 19 ) ) as $d ) {
		$cls = 20 === $d[0] ? ' on' : ( isset( $d[2] ) ? ' cur' : '' );
		$h  .= '<span class="d' . $cls . '"><b>' . $d[0] . '</b><small>' . ( isset( $d[2] ) ? $d[2] . '<br>&nbsp;' : 'compra<br>dia ' . $d[1] ) . '</small></span>';
	}
	$h .= '</div><div class="wbs-sum"><span class="wbx-k">Com vencimento no dia 20</span><dl><dt>Melhor dia de compra</dt><dd>11</dd><dt>Primeira fatura no novo dia</dt><dd>Fevereiro, vence 20/02</dd><dt>Fatura de janeiro</dt><dd>Não muda, vence 12/01</dd></dl></div>';
	$h .= '<div class="wbx-bar solo"><span class="wbx-btn">Mudar para dia 20</span></div>';
	return $h;
}

function sera_scr_wb_limit() {
	$h  = '<div class="wbs-push">' . sera_mk_app_icon( 'will bank' ) . '<div><small>will bank<span>agora</span></small><b>Seu limite já voltou</b><span>Recebemos o Pix de R$ 528,94. O valor já está disponível para usar.</span></div></div>';
	$h .= '<div class="wb-head wbs-hd">' . sera_s_icon( 'chev-l' ) . '<h5>limite</h5><span class="wb-q">?</span></div>';
	$h .= '<div class="wbs-card"><span class="wbx-k">Limite disponível</span><b>R$ 1.575,66</b><span class="wbs-up">+ R$ 528,94 agora</span>';
	$h .= '<div class="wbs-meter"><i class="a" style="width:26.2%"></i><i class="n" style="width:13.2%"></i></div>';
	$h .= '<div class="wbs-ml"><span>Usado <b>R$ 2.424,34</b></span><span>Total <b>R$ 4.000,00</b></span></div></div>';
	$h .= '<div class="wb-sec wbs-sec">Movimentações do limite</div><ul class="wb-list wb-list-s">';
	foreach ( array( array( 'pix', 'Pix · antecipação', 'Agora', '+ R$ 528,94', 'up' ), array( 'cart', 'Mercadinho Santa Tereza', 'Hoje • 13h50', '– R$ 316,60', '' ), array( 'bag', 'Farmácia Pague Menos', '12 dez', '– R$ 48,70', '' ) ) as $r ) {
		$h .= '<li><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b' . ( $r[4] ? ' class="wbs-pos"' : '' ) . '>' . $r[3] . '</b></div></li>';
	}
	return $h . '</ul>';
}
