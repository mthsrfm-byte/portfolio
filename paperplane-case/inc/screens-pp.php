<?php
/**
 * Paperplane Studio · product screens in code (desktop 1280×800 + phone), rebuilt from the
 * Paperplane UI. The generated frames (storyboard, cast, locations) are drawn in SVG here,
 * so the case has no images or videos: everything on the page is code.
 * Styles: assets/css/pp-ui.css (scoped to .ppx).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/* ------------------------------------------------------------- icons */

function sera_pp_svg( $paths, $w = 1.5 ) {
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . $w . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths . '</svg>';
}

/** The Paperplane logo (paper plane). */
function sera_pp_logo() {
	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" aria-hidden="true"><path d="M21.5 3 2.5 10.6l7 2.9L21.5 3Z"/><path d="m21.5 3-7.6 18-4.4-7.5"/></svg>';
}

/** The Origami assistant mark (tsuru). */
function sera_pp_tsuru( $size = 0 ) {
	$wh = $size ? ' width="' . (int) $size . '" height="' . (int) $size . '"' : '';
	return '<svg' . $wh . ' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round" aria-hidden="true"><path d="M1.2 7.6 7.6 15.6l2.6-1.1Z"/><path d="M2.2 21.5 7.6 15.6h2.6l5.4 3.4Z"/><path d="M2.2 21.5 15.6 19"/><path d="M10.2 15.6 12.7 13.3l2.9 3.9.7 3.8-2.1-1.4"/><path d="M16.3 21 18.6 13l.9-.6 3.8 3-3.6-.6-3.1 6.2"/><path d="M10.9 14.6 11.1 11 19.9 2.5l-.5 10.2"/><path d="M19.9 2.5 14.5 15"/></svg>';
}

function sera_pp_rail_icons() {
	return array(
		'idea'   => '<path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-4 10.5c.6.6 1 1.4 1 2.5h6c0-1.1.4-1.9 1-2.5A6 6 0 0 0 12 3Z"/>',
		'world'  => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3.5 3 14.5 0 18M12 3c-3 3.5-3 14.5 0 18"/>',
		'doc'    => '<path d="M6 3h9l4 4v14H6z"/><path d="M9 12h7M9 16h7M9 8h3"/>',
		'style'  => '<path d="M12 3a9 9 0 1 0 0 18c1 0 1.5-.8 1.2-1.6-.4-1 .3-2 1.3-2H17a4 4 0 0 0 4-4c0-5-4-10.4-9-10.4Z"/><circle cx="8" cy="10" r="1"/><circle cx="12" cy="7" r="1"/><circle cx="16" cy="10" r="1"/>',
		'people' => '<circle cx="9" cy="8" r="3.2"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.4"/><path d="M16 14c2.8 0 5 2.2 5 5"/>',
		'mount'  => '<path d="M3 20 9 9l4 7 3-5 5 9z"/><circle cx="16" cy="6" r="1.6"/>',
		'shot'   => '<path d="M4 4h4M4 4v4M20 4h-4M20 4v4M4 20h4M4 20v-4M20 20h-4M20 20v-4"/><circle cx="12" cy="12" r="3"/>',
		'grid'   => '<rect x="4" y="4" width="7" height="7" rx="1"/><rect x="13" y="4" width="7" height="7" rx="1"/><rect x="4" y="13" width="7" height="7" rx="1"/><rect x="13" y="13" width="7" height="7" rx="1"/>',
		'play'   => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m10 9 5 3-5 3z"/>',
		'cut'    => '<path d="M4 7h16M4 12h10M4 17h13"/>',
	);
}

/** Shot-size pictograms used by the shot list (decupagem). */
function sera_pp_shot_icon( $k ) {
	$p = array(
		'gpg'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M4 16h16"/><path d="M12 16v-3"/><circle cx="12" cy="11.5" r="1"/>',
		'pg'    => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M10 19v-6h4v6"/><circle cx="12" cy="10" r="1.8"/>',
		'close' => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="11" r="4"/><path d="M6 19c1-3 11-3 12 0"/>',
		'ombro' => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M3 19c0-4 3-6 6-6"/><circle cx="16" cy="10" r="2.2"/><path d="M13 19v-3c0-2 6-2 6 0v3"/>',
		'medio' => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="9.5" r="2.4"/><path d="M7 19c0-4 10-4 10 0"/>',
		'ppp'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="12" r="6"/><circle cx="10" cy="11" r=".6"/><circle cx="14" cy="11" r=".6"/>',
		'det'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><circle cx="12" cy="12" r="3.5"/><path d="M14.5 14.5 18 18"/>',
		'sub'   => '<rect x="2" y="5" width="20" height="14" rx="1.5"/><path d="M5 12c2-3 5-4 7-4s5 1 7 4c-2 3-5 4-7 4s-5-1-7-4Z"/><circle cx="12" cy="12" r="1.6"/>',
	);
	return isset( $p[ $k ] ) ? '<span class="ppx-ico"><svg viewBox="0 0 24 24" aria-hidden="true">' . $p[ $k ] . '</svg></span>' : '';
}

/* ------------------------------------------------------------- frames from the episodes */

/**
 * URL of an image made in the Paperplane for the two sample episodes (assets/cases/paperplane/).
 *
 * @param string $file File name without extension.
 */
function sera_pp_src( $file ) {
	return esc_url( get_template_directory_uri() . '/assets/cases/paperplane/' . $file . '.webp' );
}

/**
 * A frame of “A estação sem nome” or “Sem Partidas” (16:9). Scene keys used by the screens map to
 * the real images; any other key is taken as a file name.
 *
 * @param string $k     Scene key or file name.
 * @param string $style Inline style for the frame box.
 * @param string $pos   Optional object-position.
 */
function sera_pp_frame( $k, $style = '', $pos = '' ) {
	$map  = array(
		'vagao'      => 'loc-vagao', // the dining car, empty
		'plataforma' => 'loc-plataforma', // the platform under the lamp
		'hana-plat'  => 'c-545cac2b', // Hana on the platform
		'tunel'      => 'loc-tunel', // tracks into the tunnel
		'relogio'    => 'sb-a', // 3A · Lia looks at the stopped watch
		'close'      => 'sb-b', // 3B · close on Lia, frightened
		'ombro'      => 'sb-d', // 3C · Dante pushes the ticket
		'freio'      => 'sb-e', // 3D · the train brakes
		'xicara'     => 'sb-i', // 3E · detail
		'mesa'       => 'v-mesa-f0', // 3F · Lia and Dante at table 4
		'estilo-a'   => 'cel-1',
	);
	$file = isset( $map[ $k ] ) ? $map[ $k ] : $k;
	$img  = '<img src="' . sera_pp_src( $file ) . '" alt="" loading="lazy" decoding="async"' . ( $pos ? ' style="object-position:' . esc_attr( $pos ) . '"' : '' ) . '>';
	return '<div class="ppx-img"' . ( $style ? ' style="' . esc_attr( $style ) . '"' : '' ) . '>' . $img . '</div>';
}

/** A clip made in the Paperplane, inside a frame box: poster first, the file loads and plays only on screen. */
function sera_pp_clip( $file, $style = '' ) {
	$base = get_template_directory_uri() . '/assets/cases/paperplane/' . $file;
	return '<div class="ppx-img"' . ( $style ? ' style="' . esc_attr( $style ) . '"' : '' ) . '><video data-pp-video data-src="' . esc_url( $base . '.mp4' ) . '" poster="' . esc_url( $base . '.webp' ) . '" muted loop playsinline preload="none" aria-hidden="true"></video></div>';
}

/** One view of Ren's character sheet: front, three quarters, profile or back. */
function sera_pp_sheet_view( $v ) {
	$files = array( 'front' => 'ren-frente', 'tq' => 'ren-34', 'side' => 'ren-perfil', 'back' => 'ren-costas' );
	return '<img src="' . sera_pp_src( $files[ $v ] ) . '" alt="" loading="lazy" decoding="async">';
}

/** A cast portrait cropped from the character sheet, for the cast grid. */
function sera_pp_portrait( $who, $style = '' ) {
	$cast = array(
		'hana'  => array( 'cast-6ab7d758', '4% 22%' ),
		'ren'   => array( 'cast-80a5c5b7', '4% 22%' ),
		'okabe' => array( 'cast-60c2a332', '4% 22%' ),
		'bilh'  => array( 'cast-64a6ee13', '4% 22%' ),
		'rosto' => array( 'ren-rosto', '50% 30%' ),
	);
	$c = $cast[ $who ];
	return '<div class="ppx-img is-sheet"' . ( $style ? ' style="' . esc_attr( $style ) . '"' : '' ) . '><img src="' . sera_pp_src( $c[0] ) . '" alt="" loading="lazy" decoding="async" style="object-position:' . $c[1] . '"></div>';
}

/* ------------------------------------------------------------- desktop shell */

function sera_pp_shell( $active, $done, $inner, $args = array() ) {
	$args  = wp_parse_args( $args, array( 'dots' => false, 'pad' => true, 'ori' => true ) );
	$order = array( 'idea', 'world', 'doc', '|', 'style', 'people', 'mount', 'shot', 'grid', '|', 'play', 'cut' );
	$ic    = sera_pp_rail_icons();
	$rail  = '';
	foreach ( $order as $k ) {
		if ( '|' === $k ) {
			$rail .= '<div class="gap"></div>';
			continue;
		}
		$cls   = 'ic' . ( $k === $active ? ' on' : '' ) . ( in_array( $k, $done, true ) ? ' ok' : '' );
		$rail .= '<div class="' . $cls . '">' . sera_pp_svg( $ic[ $k ] ) . '</div>';
	}
	$main_cls = 'ppx-main' . ( $args['dots'] ? ' ppx-dots' : '' ) . ( $args['pad'] ? '' : ' is-flush' );
	$ori      = $args['ori'] ? '<div class="ppx-ori"><i>' . sera_pp_tsuru() . '</i>Origami</div>' : '';
	return '<div class="ppx ppx-desk"><div class="ppx-app"><div class="ppx-rail"><div class="lg">' . sera_pp_logo() . '</div>' . $rail . '<div class="cred">21</div></div><div class="' . $main_cls . '">' . $inner . $ori . '</div></div></div>';
}

function sera_pp_head( $step, $title, $sub, $btn = '', $extra = '' ) {
	return '<div class="ppx-h"><div><div class="ppx-step">' . esc_html( $step ) . '</div><div class="ppx-title">' . $title . '</div><div class="ppx-sub">' . esc_html( $sub ) . '</div></div><div class="ppx-h-act">' . $extra . ( $btn ? '<span class="ppx-btn">' . esc_html( $btn ) . ' →</span>' : '' ) . '</div></div>';
}

function sera_pp_wave( $n, $seed = 1 ) {
	$h = '';
	for ( $i = 0; $i < $n; $i++ ) {
		$h .= '<b style="height:' . round( 20 + abs( sin( ( $i + $seed ) * 1.7 ) * 60 + sin( ( $i + $seed ) * .6 ) * 20 ) ) . '%"></b>';
	}
	return '<div class="ppx-wave">' . $h . '</div>';
}

/**
 * Desktop screens (1280×800).
 *
 * @param string $id Screen id.
 */
function sera_pp_desk( $id ) {
	$all  = array( 'idea', 'world', 'doc', 'style', 'people', 'mount', 'shot', 'grid', 'play', 'cut' );
	$done = function ( $k ) use ( $all ) {
		return array_slice( $all, 0, array_search( $k, $all, true ) );
	};
	$ts12 = sera_pp_tsuru( 12 );

	switch ( $id ) {
		case 'ideia':
			$in  = sera_pp_head( 'Passo 1 de 10 · Escrever', 'Qual é a história?', 'Comece pela ideia. Título, duração e formato aparecem no caminho, conforme o roteiro cresce.', 'Próximo: universo' );
			$in .= '<div class="ppx-card pp-fx" style="margin-top:26px;width:860px"><div class="ppx-lbl" style="margin-bottom:10px">A ideia em uma frase</div><div style="font-size:19px;line-height:1.45;min-height:56px"><span class="ppx-typed">Uma garçonete de trem noturno descobre que o passageiro da mesa 4 sabe exatamente como ela vai morrer.</span><span class="ppx-caret"></span></div></div>';
			$in .= '<div class="ppx-card" style="margin-top:14px;width:860px"><div style="display:flex;justify-content:space-between;align-items:center"><div class="ppx-lbl">Título</div><span class="ppx-chip on">' . $ts12 . ' Pedir sugestões</span></div><div class="ppx-input" style="margin-top:10px">A estação sem nome</div></div>';
			$in .= '<div class="ppx-note" style="margin-top:14px;width:860px"><span class="ppx-tag">Duração</span>&nbsp; Hoje o episódio tem 2:23, somando 8 cenas. Ela muda sozinha quando você adiciona ou corta cenas.</div>';
			$in .= '<div style="margin-top:14px;width:860px;display:grid;grid-template-columns:repeat(3,1fr);gap:10px">';
			foreach ( array( array( 'Formato', 'Série · 16:9' ), array( 'Episódios', '1 de 6' ), array( 'Público', 'Adulto · drama' ) ) as $r ) {
				$in .= '<div class="ppx-card" style="padding:12px 14px"><div class="ppx-lbl">' . $r[0] . '</div><div style="font-size:15px;margin-top:4px">' . $r[1] . '</div></div>';
			}
			$in .= '</div>';
			return sera_pp_shell( 'idea', array(), $in );

		case 'universo':
			$in  = sera_pp_head( 'Passo 2 de 10 · Escrever', 'O universo da série', 'O que é verdade nesse mundo: lugar, tom, personagens e regras. O Origami consulta esta página antes de escrever qualquer coisa.', 'Próximo: roteiro' );
			$in .= '<div style="display:grid;grid-template-columns:640px 330px;gap:16px;margin-top:22px"><div style="display:flex;flex-direction:column;gap:14px">';
			$in .= '<div class="ppx-card"><div style="font-size:17px;margin-bottom:8px">O mundo</div><div style="color:var(--p-ink-2)">Um trem noturno que cruza o interior sem nunca parar na mesma estação duas vezes. Quem embarca não lembra de ter comprado o bilhete. A equipe de bordo envelhece normalmente; os passageiros, não.</div></div>';
			$in .= '<div class="ppx-card"><div style="font-size:17px;margin-bottom:10px">Tom</div><div style="display:flex;gap:6px"><span class="ppx-chip on">Melancólico ×</span><span class="ppx-chip on">Tenso ×</span><span class="ppx-chip on">Silencioso ×</span><span class="ppx-chip">+ Adicionar</span></div></div>';
			$in .= '<div class="ppx-card"><div style="font-size:17px;margin-bottom:8px">Regras que nunca mudam</div><div style="color:var(--p-ink-2);line-height:1.8">• Sempre é noite do lado de fora, mesmo quando o relógio diz o contrário.<br>• O relógio do pai da Lia é o único objeto que funciona certo no trem.<br>• Ninguém fala o nome da próxima estação.</div></div>';
			$in .= '</div><div class="ppx-card pp-fx" style="display:flex;flex-direction:column;gap:10px"><div style="font-size:17px">Perguntas em aberto</div><div style="font-size:11.5px;color:var(--p-muted)">O Origami achou pontos que a história ainda não explica.</div>';
			foreach ( array( 'Por que só a Lia percebe que os passageiros não envelhecem?', 'O que acontece com quem desce do trem?', 'Dante está ajudando a Lia ou prendendo ela ali?' ) as $q ) {
				$in .= '<div class="ppx-soft"><div style="font-weight:500">' . $q . '</div><div style="font-size:11px;color:var(--p-muted);margin-top:4px">Sugestão do Origami pronta para virar regra.</div><span class="ppx-chip" style="margin-top:8px">Virar regra</span></div>';
			}
			$in .= '</div></div>';
			return sera_pp_shell( 'world', $done( 'world' ), $in );

		case 'roteiro':
			$in  = sera_pp_head( 'Passo 3 de 10 · Escrever', 'Roteiro', 'Escreva cena por cena. Para pedir ajuda, use o Origami ao lado: ele sugere, você aceita ou não.' );
			$in .= '<div style="display:flex;gap:6px;margin-top:16px;align-items:center"><span class="ppx-chip">‹</span><span class="ppx-chip">Cena 3 de 8 · <b style="font-weight:500">Mesa 4</b></span><span class="ppx-chip">›</span><span class="ppx-mono" style="margin-left:auto">8 cenas · 2:23</span><span class="ppx-chip">+ Cena</span></div>';
			$in .= '<div style="display:flex;gap:16px;margin-top:12px"><div class="ppx-card ppx-script" style="width:700px;height:520px;padding:28px 40px"><div class="ppx-lbl">Cena 3 · 0:24</div><div style="font-family:var(--p-sans);font-size:20px;margin:4px 0 18px">Mesa 4</div>INT. VAGÃO-RESTAURANTE — NOITE<br><br>O vagão balança vazio. Copos tilintam nas mesas. LIA (28) entra, o casaco molhado de chuva.<br><br><span class="hl">Ela senta perto da janela. Do outro lado, DANTE (34) já estava ali.</span><br><br><div style="text-align:center">DANTE</div><div style="margin:0 120px">Você não devia estar aqui.</div><br>Ele empurra um bilhete amassado sobre a mesa.<br><br>O trem freia de repente. Lia é jogada contra Dante.</div>';
			$in .= '<div class="ppx-card ppx-side pp-fx" style="width:320px;height:560px;margin-top:-40px"><div style="display:flex;align-items:center;gap:8px"><span class="ppx-ori-ic">' . sera_pp_tsuru( 15 ) . '</span><div><div style="font-size:15px">Origami</div><div class="ppx-lbl">seu assistente de IA</div></div><span class="ppx-tag is-muted" style="margin-left:auto">vendo: roteiro</span></div>';
			$in .= '<div class="ppx-sug">Deixar a fala do Dante mais ameaçadora<div class="ppx-sug-a"><span class="ppx-chip">Aplicar</span><u>Agora não</u></div></div>';
			$in .= '<div class="ppx-sug">Adicionar uma cena depois da cena 3<div class="ppx-sug-a"><span class="ppx-chip">Aplicar</span><u>Agora não</u></div></div>';
			$in .= '<div class="ppx-soft" style="color:var(--p-ink-2)">Oi, Matheus. Estou acompanhando o episódio inteiro. Peça qualquer coisa: se for de outra etapa, eu te levo até lá.</div><div class="ppx-soft" style="color:var(--p-ink-2)">Encontrei 3 personagens: Lia, Dante e o Condutor. Já estou gerando o visual.</div>';
			$in .= '<div class="ppx-ask">Peça qualquer coisa, de qualquer etapa<span></span></div></div></div>';
			return sera_pp_shell( 'doc', $done( 'doc' ), $in, array( 'ori' => false ) );

		case 'personagem':
			$in  = '<div class="ppx-step">Personagens e vozes › Ren</div>';
			$in .= '<div style="display:flex;align-items:center;gap:14px;margin-top:10px">' . sera_pp_portrait( 'rosto', 'width:52px;height:52px;border-radius:50%' ) . '<div><div class="ppx-title" style="font-size:48px;margin:0">Ren</div><div class="ppx-sub" style="margin-top:2px">Rapaz de 19 anos que espera no banco da plataforma</div></div><span class="ppx-tag ok" style="margin-left:auto">Visual aprovado</span></div>';
			$in .= '<div class="ppx-tabs"><span class="on">Visual</span><span>Voz</span><span>Falas (6)</span></div>';
			$in .= '<div class="ppx-card pp-fx" style="margin-top:14px;width:1000px;padding:12px"><div class="ppx-sheet">' . sera_pp_sheet_view( 'front' ) . sera_pp_sheet_view( 'tq' ) . sera_pp_sheet_view( 'side' ) . sera_pp_sheet_view( 'back' ) . '</div><div class="ppx-sheet-l"><span>Frente</span><span>Três quartos</span><span>Perfil</span><span>Costas</span></div></div>';
			$in .= '<div class="ppx-card" style="margin-top:12px;width:1000px"><div style="font-weight:500;margin-bottom:6px">Aparência fixa</div><div style="color:var(--p-ink-2)">Rapaz de 19 anos, rosto fino e olhar desconfiado. Cabelo preto curto e despenteado. Figurino fixo: jaqueta escura de gola, camiseta verde-escura, calça e botas marrom-escuras.</div></div>';
			return sera_pp_shell( 'people', $done( 'people' ), $in );

		case 'estilo':
			$in  = sera_pp_head( 'Passo 4 de 10 · Visualizar', 'Estilo visual', 'O visual do filme inteiro: personagens, cenários e quadros.', 'Próximo: personagens', '<span class="ppx-chip">Modo básico</span>' );
			$in .= '<div class="ppx-card pp-fx" style="margin-top:24px;width:640px;display:flex;gap:18px;padding:12px"><div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;width:340px;height:204px;border-radius:6px;overflow:hidden">';
			foreach ( array( 'cel-1', 'cel-2', 'cel-3', 'cel-4' ) as $c ) {
				$in .= sera_pp_frame( $c, 'border-radius:0;height:100px' );
			}
			$in .= '</div><div style="flex:1;padding-top:12px"><div style="font-size:20px;letter-spacing:-.02em">Anime 2D Cel</div><div class="ppx-lbl" style="margin-top:4px">6 regras · 4 referências</div><div style="display:flex;gap:4px;margin-top:16px">';
			foreach ( array( '#1B2330', '#2B3446', '#495B74', '#6F7E86', '#8A8E6E', '#C6A06A' ) as $c ) {
				$in .= '<span style="width:26px;height:26px;border-radius:3px;background:' . $c . '"></span>';
			}
			$in .= '</div><div style="display:flex;gap:6px;margin-top:18px"><span class="ppx-chip">Ver regras</span><span class="ppx-chip">Editar</span></div></div></div>';
			$in .= '<div style="font-size:17px;margin:30px 0 12px">Sua biblioteca</div><div style="display:flex;gap:12px"><div class="ppx-card" style="width:150px;height:132px;display:grid;place-items:center;text-align:center;color:var(--p-muted);font-size:11.5px"><div><span style="display:inline-grid;place-items:center;width:24px;height:24px;border-radius:50%;background:var(--p-lime);color:var(--p-on-lime)">+</span><div style="margin-top:6px;color:var(--p-ink)">Novo estilo</div>Das suas imagens</div></div>';
			foreach ( array( array( 'ns-stop-motion', 'Stop motion' ), array( 'ns-live-action-de-drama', 'Drama live action' ), array( 'ns-preto-e-branco-dos-anos-60', 'Noir anos 60' ), array( 'ns-sci-fi-ambicioso', 'Sci-fi épico' ), array( 'ns-sitcom-nostalgico', 'Sitcom anos 90' ) ) as $n ) {
				$in .= '<div class="ppx-card" style="width:170px;padding:6px">' . sera_pp_frame( $n[0], 'height:92px' ) . '<div style="font-size:11.5px;margin:6px 2px 0">' . $n[1] . '</div></div>';
			}
			$in .= '</div>';
			return sera_pp_shell( 'style', $done( 'style' ), $in );

		case 'cenarios':
			$in  = sera_pp_head( 'Passo 6 de 10 · Visualizar', 'Cenários', 'A IA gera cada lugar de um ângulo só. Outros ângulos você cria quando precisar, apontando a câmera no mapa.', 'Próximo: decupagem' );
			$in .= '<div style="display:flex;gap:16px;margin-top:22px"><div style="width:220px;flex:none;display:flex;flex-direction:column;gap:8px">';
			foreach ( array( array( 'loc-plataforma', 'Plataforma' ), array( 'loc-vagao', 'Interior do vagão' ), array( 'loc-tunel', 'Trilhos e túnel' ) ) as $i => $l ) {
				$in .= '<div class="ppx-row' . ( 2 === $i ? ' is-sel' : '' ) . '" style="padding:8px">' . sera_pp_frame( $l[0], 'width:54px;height:34px;flex:none' ) . '<div><div style="font-size:12px">' . $l[1] . '</div><div class="ppx-lbl">4 ângulos</div></div></div>';
			}
			$in .= '<div class="ppx-row" style="justify-content:center">+ Novo cenário</div></div>' . sera_pp_frame( 'loc-tunel', 'width:880px;height:470px' ) . '</div>';
			$in .= '<div class="ppx-angle pp-fx"><div class="ppx-lbl">Outro ângulo · Trilhos e túnel</div><div class="ppx-angle-in"><div class="ppx-compass"><i class="cone"></i><b class="cam"></b>';
			foreach ( range( 0, 7 ) as $k ) {
				$in .= '<span style="--k:' . $k . '"' . ( in_array( $k, array( 0, 2, 5 ), true ) ? ' class="has"' : '' ) . '></span>';
			}
			$in .= '</div><div style="flex:1">' . sera_pp_frame( 'loc-tunel', 'height:150px', '30% 50%' ) . '<div style="font-size:12px;margin-top:8px">Câmera a sudoeste, na altura dos olhos</div><div style="display:flex;gap:4px;margin-top:8px"><span class="ppx-chip">Baixa</span><span class="ppx-chip on">Olhos</span><span class="ppx-chip">Alta</span></div><span class="ppx-btn" style="margin-top:12px">Gerar este ângulo · US$ 0,04</span></div></div></div>';
			return sera_pp_shell( 'mount', $done( 'mount' ), $in );

		case 'decupagem':
			$in   = sera_pp_head( 'Passo 7 de 10 · Visualizar', 'Decupagem', 'Cada cena vira tomadas: trechos sem corte de câmera, com o plano e o lugar da câmera escolhidos a partir dos personagens e cenários.', 'Próximo: storyboard', '<span class="ppx-chip">' . $ts12 . ' Decupar todas</span>' );
			$in  .= '<div style="display:flex;gap:16px;margin-top:20px"><div style="width:780px;display:flex;flex-direction:column;gap:8px">';
			$rows = array(
				array( 'ppp', '1A', 'Chuva bate no telhado da plataforma vazia sob o poste que pisca.', 'Primeiríssimo plano · 8 s' ),
				array( 'gpg', '1B', 'Hana corre pela plataforma, mochila num ombro, celular apagado na mão.', 'Grande plano geral · 8 s · com movimento' ),
				array( 'close', '1C', 'Hana para, sem fôlego, olhando os trilhos vazios.', 'Close · 10 s · escolha da IA' ),
				array( 'medio', '1D', 'Atrás dela, Ren sentado no banco escuro, fone em um ouvido.', 'Plano médio · 9 s · escolha da IA' ),
				array( 'ombro', '1E', 'Hana se vira para Ren e o questiona.', 'Sobre o ombro · 8 s · escolha da IA' ),
			);
			foreach ( $rows as $i => $r ) {
				$in .= '<div class="ppx-row' . ( 2 === $i ? ' is-sel pp-fx' : '' ) . '">' . sera_pp_shot_icon( $r[0] ) . '<div style="flex:1"><div><b style="font-weight:500;margin-right:6px">' . $r[1] . '</b>' . $r[2] . '</div><div style="font-size:11px;color:var(--p-muted)">' . $r[3] . '</div></div><span style="color:var(--p-muted)">›</span></div>';
			}
			$in .= '<div class="ppx-why"><span class="ppx-tag">Por que close</span> A cena pede a reação antes da explicação: o rosto da Hana conta que o trem já foi antes de a gente ver os trilhos.</div>';
			$in .= '</div><div class="ppx-card" style="width:330px"><div class="ppx-lbl">Cena 1</div><div style="font-size:19px;margin:4px 0 2px">Estação Shinji-mae</div><div style="font-size:11px;color:var(--p-muted)">9 tomadas · 75 s</div><div class="ppx-lbl" style="margin:14px 0 8px">Tipos de plano</div><div class="ppx-shots">';
			foreach ( array( array( 'gpg', 'Grande plano geral' ), array( 'pg', 'Plano geral' ), array( 'medio', 'Plano médio' ), array( 'ombro', 'Sobre o ombro' ), array( 'close', 'Close' ), array( 'ppp', 'Primeiríssimo' ), array( 'det', 'Detalhe' ), array( 'sub', 'Subjetiva' ) ) as $k ) {
				$in .= '<div' . ( 'close' === $k[0] ? ' class="on"' : '' ) . '>' . sera_pp_shot_icon( $k[0] ) . $k[1] . '</div>';
			}
			$in .= '</div></div></div>';
			return sera_pp_shell( 'shot', $done( 'shot' ), $in );

		case 'storyboard':
			$in  = sera_pp_head( 'Passo 8 de 10 · Visualizar', 'Storyboard', 'Uma imagem por tomada, já com personagens, cenário e plano. Imagem é barata; vídeo não. Aprove aqui antes de animar.', 'Próximo: animação', '<span class="ppx-chip">Modo básico</span>' );
			$in .= '<div class="ppx-card" style="margin-top:18px;display:flex;align-items:center;gap:20px"><div><span style="font-size:30px;font-weight:300">8</span> de 9 tomadas aprovadas<div class="ppx-bar" style="width:420px"><i style="width:88%"></i></div></div><span class="ppx-chip" style="margin-left:auto">' . $ts12 . ' Conferir continuidade</span></div>';
			$in .= '<div class="pp-fx" style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:14px">';
			$sb  = array( array( 'relogio', '3A', 'Lia olha o relógio parado', 'Plano médio · 5 s' ), array( 'close', '3B', 'Close de Lia, assustada', 'Close · 4 s' ), array( 'ombro', '3C', 'Dante empurra o bilhete', 'Sobre o ombro · 5 s' ), array( 'freio', '3D', 'O trem freia de repente', 'Plano geral · 6 s' ) );
			foreach ( $sb as $i => $f ) {
				$in .= '<div class="ppx-card ppx-sb">' . sera_pp_frame( $f[0], 'height:150px' ) . '<span class="ppx-tag ppx-sb-tag">' . $f[1] . '</span><div class="ppx-sb-t">' . $f[2] . '</div><div class="ppx-sb-m">' . $f[3] . '</div><div class="ppx-sb-a">' . ( $i < 3 ? '<span class="ppx-tag ok">✓ Aprovada</span><u>Desfazer</u>' : '<span class="ppx-btn sm">Aprovar</span>' ) . '</div></div>';
			}
			$in .= '</div>';
			return sera_pp_shell( 'grid', $done( 'grid' ), $in );

		case 'animacao':
			$in  = '<div class="ppx-topbar"><span style="font-size:18px">Animação</span><span class="ppx-chip">Cena 3 de 8 · Mesa 4</span><span style="display:flex;gap:4px">';
			foreach ( array( '3A', '3B', '3C', '3D', '3E' ) as $x ) {
				$in .= '<span class="ppx-chip">' . $x . '</span>';
			}
			$in .= '<span class="ppx-chip on">3F</span></span><span class="ppx-btn" style="margin-left:auto">Próximo: montagem →</span></div>';
			$in .= '<svg class="ppx-wire" viewBox="0 0 1228 800" aria-hidden="true"><path d="M230 170C290 170 280 150 330 150"/><path d="M850 280C880 280 870 220 900 220"/></svg>';
			$in .= '<div class="ppx-node" style="left:40px;top:100px;width:190px;padding:7px"><div class="ppx-lbl" style="margin-bottom:5px">Primeiro quadro · 3F</div>' . sera_pp_frame( 'mesa', 'height:100px' ) . '<div style="font-size:10.5px;color:var(--p-muted);margin-top:6px">A imagem do storyboard.</div></div>';
			$in .= '<div class="ppx-node pp-fx" style="left:330px;top:100px;width:520px;padding:0;overflow:hidden"><div class="ppx-node-h">Movimento</div><div style="padding:14px 16px"><div class="ppx-lbl">O que se move nesta tomada</div><div class="ppx-input is-plain" style="margin-top:6px;height:84px;font-size:12.5px"><span class="ppx-typed">O trem freia forte, Lia é jogada contra Dante; os copos deslizam e a luminária balança.</span><span class="ppx-caret"></span></div>';
			$in .= '<div style="display:flex;gap:6px;margin-top:10px"><span class="ppx-chip">' . $ts12 . ' Refinar com o Origami</span><span class="ppx-chip">Ver o pedido completo</span></div>';
			$in .= '<div class="ppx-lbl" style="margin-top:16px">Qualidade</div><div class="ppx-input is-plain" style="margin-top:6px;font-size:12.5px">Equilibrada · LTX-2.5 Pro</div>';
			$in .= '<div class="ppx-lbl" style="margin-top:14px">Duração</div><div style="display:flex;gap:4px;margin-top:6px">';
			foreach ( array( 'Auto · 4 s', '4 s', '5 s', '6 s', '8 s', '10 s' ) as $i => $d ) {
				$in .= '<span class="ppx-chip' . ( 0 === $i ? ' on' : '' ) . '">' . $d . '</span>';
			}
			$in .= '</div><div class="ppx-lbl" style="margin-top:14px">Áudio</div><div style="display:flex;gap:4px;margin-top:6px"><span class="ppx-chip on">Fala na voz da Lia</span><span class="ppx-chip">Com som ambiente</span></div><div class="ppx-take-new">Novo take · #2.0 · US$ 0,32</div></div></div>';
			$in .= '<div class="ppx-node" style="left:900px;top:120px;width:290px"><div class="nh"><span style="font-size:17px">Take #1.0</span><span class="ppx-tag">Em revisão</span></div>' . sera_pp_frame( 'mesa', 'height:160px' ) . '<div class="ppx-play">▶</div><div class="ppx-meta"><span>Modelo</span><b>LTX-2.5 Pro</b><span>Duração</span><b>6 s</b></div><div style="margin-top:10px"><span class="ppx-btn" style="width:100%;justify-content:center">Aprovar</span></div></div>';
			return sera_pp_shell( 'play', $done( 'play' ), $in, array( 'dots' => true, 'pad' => false ) );

		case 'nodes':
			$in  = '<div class="ppx-topbar"><span style="font-size:18px">Storyboard</span><span class="ppx-chip">Modo avançado</span><span class="ppx-chip">Cena 3 de 8 · Mesa 4</span><span class="ppx-tag ok" style="margin-left:auto">Todas aprovadas</span></div>';
			$in .= '<svg class="ppx-wire" viewBox="0 0 1228 800" aria-hidden="true"><path d="M190 140C300 140 300 250 390 250"/><path d="M190 330C300 330 300 280 390 280"/><path d="M190 500C300 500 300 300 390 310"/><path d="M190 660C300 660 300 330 390 340"/><path d="M760 300C820 300 820 300 880 300"/></svg>';
			foreach ( array( array( 'Estilo do projeto', 'estilo-a', 90 ), array( 'Personagem · Lia', 'relogio', 270 ), array( 'Quadro anterior · 3E', 'xicara', 440 ), array( 'Cenário · vagão', 'vagao', 600 ) ) as $n ) {
				$in .= '<div class="ppx-node" style="left:30px;top:' . $n[2] . 'px;width:160px;padding:7px"><div class="ppx-lbl" style="margin-bottom:5px">' . $n[0] . '</div>' . sera_pp_frame( $n[1], 'height:76px' ) . '</div>';
			}
			$in .= '<div class="ppx-node lime" style="left:390px;top:120px;width:370px;height:430px"><div class="nh"><span style="font-size:17px">Pedido</span><span class="ppx-tag is-ink">3F</span></div><div style="display:flex;gap:6px;margin-bottom:8px"><span class="ppx-chip">Plano médio</span><span class="ppx-chip">4 s</span></div>';
			$in .= '<div class="ppx-prompt"><span class="ppx-typed">Trem freia, Lia é jogada contra Dante. Plano médio, câmera parada. Luz dourada das arandelas, sombras azuladas da janela. Lia de colete cinza e avental; Dante de terno escuro. Dante NÃO está de chapéu. O condutor NÃO está no quadro.</span></div>';
			$in .= '<div class="ppx-lbl" style="margin:10px 0 4px;color:var(--p-on-lime)">Em português · só para você ler</div><div style="font-size:11.5px">O trem freia, Lia é jogada contra Dante. Plano médio, câmera parada.</div><div class="ppx-take-new is-white">Novo take · #2.0</div></div>';
			$in .= '<div class="ppx-node" style="left:880px;top:150px;width:320px"><div class="nh"><span style="font-size:17px">Take #1.0</span><span class="ppx-tag ok">Aprovado</span></div>' . sera_pp_frame( 'mesa', 'height:180px' ) . '<div class="ppx-meta"><span>Modelo</span><b>FLUX.2</b><span>Formato</span><b>16:9 · 1280×720</b><span>Seed</span><b>2210</b><span>Custo</span><b>US$ 0,04</b></div><div style="display:flex;gap:6px;margin-top:12px"><span class="ppx-chip">Iterar</span><span class="ppx-chip">Comparar</span><span class="ppx-chip">Recortar</span></div><div style="margin-top:8px"><span class="ppx-btn" style="width:100%;justify-content:center">' . sera_pp_tsuru( 13 ) . ' Editar com Origami</span></div></div>';
			return sera_pp_shell( 'grid', $done( 'grid' ), $in, array( 'dots' => true, 'pad' => false ) );

		case 'montagem':
			$clips = array( 'plataforma', 'hana-plat', 'tunel', 'relogio', 'close', 'ombro', 'freio', 'xicara', 'mesa', 'vagao', 'plataforma', 'tunel' );
			$in    = '<div class="ppx-cut">';
			$in   .= '<div class="ppx-cut-top"><div><div class="ppx-lbl">Montagem</div><div style="font-size:14px">A estação sem nome · Episódio 1</div></div><span class="ppx-mono" style="margin-left:auto">26 tomadas com vídeo · 2:23</span><span class="ppx-btn">Exportar ▾</span></div>';
			$in   .= '<div class="ppx-cut-list"><div class="ppx-cut-tabs"><b>Tomadas</b><span>Áudios</span><span>Textos</span></div>';
			foreach ( array( '1 · A plataforma', '2 · Primeira noite', '3 · Mesa 4', '4 · A freada', '5 · O vagão das fotos', '6 · Cabine vazia', '7 · O relógio volta', '8 · A estação sem nome' ) as $i => $t ) {
				$in .= '<div class="ppx-cut-sc' . ( 2 === $i ? ' on' : '' ) . '"><span>' . $t . '</span><span class="ppx-mono">0:' . array( 20, 28, 25, 16, 16, 14, 13, 16 )[ $i ] . '</span></div>';
			}
			$in .= '</div><div class="ppx-cut-view">' . sera_pp_clip( 'v-4k', 'flex:1' ) . '<div class="ppx-cut-ctl">‹‹ <span>▶</span> ››</div></div>';
			$in .= '<div class="ppx-cut-insp"><div style="display:flex;justify-content:space-between"><b style="font-weight:500;font-size:15px">3C</b><span class="ppx-mono">5,0 s</span></div><div style="color:var(--p-muted)">Cena 3 · Sobre o ombro</div><div class="ppx-lbl">Enquadramento</div><div class="ppx-kv"><span>Escala</span><span>100%</span></div><div class="ppx-lbl">Transição</div><div class="ppx-kv"><span>Entrada</span><span>Corte</span></div><div class="ppx-lbl">Áudio</div><div style="display:flex;align-items:center;gap:8px"><span style="flex:1;height:3px;background:var(--p-lime);border-radius:3px"></span>100%</div></div>';
			$in .= '<div class="ppx-tl pp-fx"><div class="ppx-tl-hint"><span>✂</span><span>Arraste as bordas para aparar; S divide; espaço toca.</span></div><div class="ppx-tl-ruler">';
			foreach ( array( '0:00', '0:15', '0:30', '0:45', '1:00', '1:15', '1:30', '1:45', '2:00' ) as $t ) {
				$in .= '<span>' . $t . '</span>';
			}
			$in .= '</div><div class="ppx-tl-row is-v"><span><b>V1</b>Vídeo</span><div>';
			foreach ( $clips as $i => $c ) {
				$in .= sera_pp_frame( $c, 'flex:' . ( 4 === $i ? '1.6' : '1' ) . ';height:100%;border-radius:3px' );
			}
			$in .= '</div></div>';
			$in .= '<div class="ppx-tl-row is-a"><span><b>A1</b>Efeitos</span><div><i style="flex:5">' . sera_pp_wave( 80, 1 ) . '</i><em style="flex:2"></em><i style="flex:3">' . sera_pp_wave( 50, 7 ) . '</i></div></div>';
			$in .= '<div class="ppx-tl-row is-b"><span><b>A2</b>Falas</span><div><em style="flex:1"></em><i style="flex:2">' . sera_pp_wave( 30, 3 ) . '</i><em style="flex:2"></em><i style="flex:3">' . sera_pp_wave( 40, 9 ) . '</i><em style="flex:2"></em></div></div>';
			$in .= '<div class="ppx-tl-row is-c"><span><b>A3</b>Trilha</span><div><i style="flex:1">' . sera_pp_wave( 140, 5 ) . '</i></div></div>';
			$in .= '<div class="ppx-tl-head"><i></i></div></div>';
			$in .= '<div class="ppx-export"><div class="ppx-lbl">Exportar episódio</div><div class="ppx-ex-r"><span>MP4 · 1080p</span><em>nativo</em></div><div class="ppx-ex-r on"><span>Upscale · 4K (2160p)</span><em>+ 3 min</em></div><div class="ppx-ex-r"><span>Só as falas · WAV</span><em></em></div><div class="ppx-ex-c">Custo do upscale <b>US$ 0,90</b></div><span class="ppx-btn" style="width:100%;justify-content:center">Exportar em 4K</span></div>';
			$in .= '</div>';
			return sera_pp_shell( 'cut', $done( 'cut' ), $in, array( 'pad' => false, 'ori' => false ) );
	}
	return '';
}

/* ------------------------------------------------------------- phone */

function sera_pp_mob( $crumb, $body, $ori = true ) {
	return '<div class="ppx ppx-ph"><div class="ppx-mtop"><span class="ppx-mlg">' . sera_pp_logo() . '</span><span class="ppx-mcrumb">' . esc_html( $crumb ) . '</span><span class="ppx-mburger"><i></i><i></i></span></div><div class="ppx-mbody">' . $body . '</div>' . ( $ori ? '<div class="ppx-mori">' . sera_pp_tsuru() . '</div>' : '' ) . '</div>';
}

/**
 * Phone screens (393 px wide, under the device status bar).
 *
 * @param string $id Screen id.
 */
function sera_pp_phone( $id ) {
	switch ( $id ) {
		case 'inicio':
			$b = '<div class="ppx-step">Boa tarde, Matheus</div><div class="ppx-mtitle">A estação<br>sem nome</div><div class="ppx-sub">Storyboard pronto. Faltam 30 vídeos.</div><span class="ppx-btn lg">Continuar de onde parei →</span>';
			$b .= '<div class="ppx-card" style="margin-top:14px;padding:10px"><div class="ppx-lbl" style="display:flex;justify-content:space-between"><span>Cena 3</span><span>Animação · 0 de 6</span></div>' . sera_pp_frame( 'freio', 'height:150px;margin-top:8px' ) . '<div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px"><span style="font-size:19px">Episódio 1</span><span class="ppx-tag">8 de 10 etapas</span></div><div class="ppx-bar"><i style="width:80%"></i></div></div>';
			$b .= '<div class="ppx-row" style="margin-top:10px;padding:8px">' . sera_pp_frame( 'plataforma', 'width:64px;height:40px;flex:none' ) . '<div><div>Sem Partidas</div><div class="ppx-lbl">Montagem · exportado</div></div></div>';
			return sera_pp_mob( 'Início', $b );

		case 'ideia':
			$b = '<div class="ppx-step">Passo 1 de 10 · Escrever</div><div class="ppx-mtitle">Qual é a<br>história?</div><div class="ppx-sub">Comece pela ideia. Título, duração e formato aparecem no caminho.</div>';
			$b .= '<div class="ppx-card pp-fxm" style="margin-top:18px"><div class="ppx-lbl" style="margin-bottom:8px">A ideia em uma frase</div><div style="font-size:17px;line-height:1.45">Uma garçonete de trem noturno descobre que o passageiro da mesa 4 sabe exatamente como ela vai morrer.<span class="ppx-caret"></span></div></div>';
			$b .= '<div class="ppx-card" style="margin-top:10px"><div style="display:flex;justify-content:space-between;align-items:center"><div class="ppx-lbl">Título</div><span class="ppx-chip on">' . sera_pp_tsuru( 12 ) . ' Sugerir</span></div><div class="ppx-input" style="margin-top:8px">A estação sem nome</div></div>';
			$b .= '<span class="ppx-btn lg">Próximo: universo →</span>';
			return sera_pp_mob( 'Escrever', $b );

		case 'universo':
			$b = '<div class="ppx-step">Passo 2 de 10 · Escrever</div><div class="ppx-mtitle">O universo</div>';
			$b .= '<div class="ppx-card" style="margin-top:14px"><div style="font-size:15px;margin-bottom:6px">Regras que nunca mudam</div><div style="color:var(--p-ink-2);line-height:1.6;font-size:12.5px">• Sempre é noite do lado de fora.<br>• O relógio do pai da Lia é o único que funciona.<br>• Ninguém fala o nome da próxima estação.</div></div>';
			$b .= '<div class="ppx-card pp-fxm" style="margin-top:10px;display:flex;flex-direction:column;gap:8px"><div style="font-size:15px">Perguntas em aberto</div>';
			foreach ( array( 'O que acontece com quem desce do trem?', 'Dante está ajudando a Lia ou prendendo ela ali?' ) as $q ) {
				$b .= '<div class="ppx-soft"><div style="font-weight:500;font-size:12.5px">' . $q . '</div><span class="ppx-chip" style="margin-top:6px">Virar regra</span></div>';
			}
			return sera_pp_mob( 'Escrever', $b . '</div>' );

		case 'roteiro':
			$b = '<div class="ppx-step">Passo 3 de 10 · Escrever</div><div class="ppx-mtitle">Roteiro</div><div style="display:flex;gap:6px;margin:14px 0"><span class="ppx-chip">‹</span><span class="ppx-chip" style="flex:1;justify-content:center">Cena 3 · Mesa 4</span><span class="ppx-chip">›</span></div>';
			$b .= '<div class="ppx-card ppx-script" style="font-size:13.5px;padding:18px">INT. VAGÃO-RESTAURANTE — NOITE<br><br>O vagão balança vazio. Copos tilintam nas mesas. LIA (28) entra, o casaco molhado de chuva.<br><br><span class="hl">Ela senta perto da janela. Do outro lado, DANTE (34) já estava ali.</span><br><br><div style="text-align:center">DANTE</div><div style="margin:0 30px">Você não devia estar aqui.</div></div>';
			$b .= '<div class="ppx-sug pp-fxm" style="margin-top:10px">Deixar a fala do Dante mais ameaçadora<div class="ppx-sug-a"><span class="ppx-chip">Aplicar</span><u>Agora não</u></div></div>';
			return sera_pp_mob( 'Escrever', $b );

		case 'elenco':
			$b = '<div class="ppx-step">Passo 5 de 10 · Visualizar</div><div class="ppx-mtitle">Personagens<br>e vozes</div><div class="ppx-cast pp-fxm">';
			foreach ( array( array( 'hana', 'Hana' ), array( 'ren', 'Ren' ), array( 'okabe', 'Sr. Okabe' ), array( 'bilh', 'Bilheteiro' ) ) as $c ) {
				$b .= '<div class="ppx-card" style="padding:6px">' . sera_pp_portrait( $c[0], 'height:150px' ) . '<div style="font-size:13px;margin:6px 2px 2px">' . $c[1] . '</div><span class="ppx-chip sm">◉ voz</span></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'estilo':
			$b = '<div class="ppx-step">Passo 4 de 10 · Visualizar</div><div class="ppx-mtitle">Estilo visual</div><div class="ppx-card pp-fxm" style="margin-top:14px;padding:8px"><div style="display:grid;grid-template-columns:1fr 1fr;gap:3px;border-radius:6px;overflow:hidden">';
			foreach ( array( 'cel-1', 'cel-2', 'cel-3', 'cel-4' ) as $c ) {
				$b .= sera_pp_frame( $c, 'height:84px;border-radius:0' );
			}
			$b .= '</div><div style="font-size:16px;margin:10px 2px 2px">Anime 2D Cel</div><div class="ppx-lbl" style="margin:0 2px">6 regras · 4 referências</div></div><div class="ppx-lbl" style="margin:16px 0 8px">Sua biblioteca</div><div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">';
			foreach ( array( array( 'ns-stop-motion', 'Stop motion' ), array( 'ns-preto-e-branco-dos-anos-60', 'Noir anos 60' ) ) as $n ) {
				$b .= '<div class="ppx-card" style="padding:5px">' . sera_pp_frame( $n[0], 'height:70px' ) . '<div style="font-size:11px;margin:5px 2px 0">' . $n[1] . '</div></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'cenarios':
			$b = '<div class="ppx-step">Passo 6 de 10 · Visualizar</div><div class="ppx-mtitle">Cenários</div>' . str_replace( 'class="ppx-img"', 'class="ppx-img pp-fxm"', sera_pp_frame( 'loc-tunel', 'height:180px;margin-top:14px' ) ) . '<div style="display:flex;flex-direction:column;gap:7px;margin-top:12px">';
			foreach ( array( array( 'loc-plataforma', 'Plataforma' ), array( 'loc-vagao', 'Interior do vagão' ), array( 'loc-tunel', 'Trilhos e túnel' ) ) as $i => $l ) {
				$b .= '<div class="ppx-row' . ( 2 === $i ? ' is-sel' : '' ) . '" style="padding:7px">' . sera_pp_frame( $l[0], 'width:52px;height:32px;flex:none' ) . '<div style="font-size:12.5px">' . $l[1] . '<div class="ppx-lbl">4 ângulos</div></div></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'montagem':
			$b = '<div class="ppx-step">Passo 10 de 10 · Filmar</div><div class="ppx-mtitle">Montagem</div>' . sera_pp_frame( 'ombro', 'height:170px;margin-top:14px' ) . '<div class="ppx-mtl pp-fxm">';
			foreach ( array( 'plataforma', 'relogio', 'close', 'ombro', 'freio', 'mesa' ) as $c ) {
				$b .= sera_pp_frame( $c, 'flex:1;height:100%;border-radius:2px' );
			}
			$b .= '</div><div class="ppx-mtl is-a">' . sera_pp_wave( 40, 2 ) . '</div><div class="ppx-card" style="margin-top:12px;padding:12px"><div class="ppx-lbl">Exportar</div><div class="ppx-ex-r on" style="margin-top:8px"><span>Upscale · 4K</span><em>+ 3 min</em></div></div><span class="ppx-btn lg">Exportar episódio</span>';
			return sera_pp_mob( 'Filmar', $b );

		case 'decupagem':
			$b    = '<div class="ppx-step">Passo 7 de 10 · Visualizar</div><div class="ppx-mtitle">Decupagem</div><div class="ppx-lbl" style="margin-top:14px">Cena 1 · Estação Shinji-mae · 9 tomadas</div><div style="display:flex;flex-direction:column;gap:7px;margin-top:8px">';
			$rows = array( array( 'ppp', '1A', 'Chuva no telhado da plataforma vazia', 'Primeiríssimo · 8 s' ), array( 'gpg', '1B', 'Hana corre pela plataforma', 'Grande plano geral · 8 s' ), array( 'close', '1C', 'Hana para, olhando os trilhos', 'Close · 10 s · IA' ), array( 'medio', '1D', 'Ren no banco escuro', 'Plano médio · 9 s · IA' ), array( 'ombro', '1E', 'Hana se vira para Ren', 'Sobre o ombro · 8 s' ) );
			foreach ( $rows as $i => $r ) {
				$b .= '<div class="ppx-row' . ( 2 === $i ? ' is-sel pp-fxm' : '' ) . '" style="padding:8px 10px">' . sera_pp_shot_icon( $r[0] ) . '<div style="flex:1;font-size:12.5px"><div><b style="font-weight:500;margin-right:4px">' . $r[1] . '</b>' . $r[2] . '</div><div style="font-size:10.5px;color:var(--p-muted)">' . $r[3] . '</div></div></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'storyboard':
			$b = '<div class="ppx-step">Passo 8 de 10 · Visualizar</div><div class="ppx-mtitle">Storyboard</div><div class="ppx-card" style="margin-top:14px;padding:12px"><span style="font-size:26px;font-weight:300">6</span> de 6 tomadas aprovadas <span class="ppx-tag ok">Tudo aprovado</span></div><div class="ppx-cast is-sb pp-fxm">';
			foreach ( array( array( 'relogio', 'Plano médio' ), array( 'close', 'Close' ), array( 'ombro', 'Ombro' ), array( 'freio', 'Geral' ) ) as $i => $f ) {
				$b .= '<div class="ppx-card" style="padding:5px">' . sera_pp_frame( $f[0], 'height:84px' ) . '<div style="font-size:11px;margin:5px 2px 3px">3' . 'ABCD'[ $i ] . ' · ' . $f[1] . '</div><span class="ppx-tag ok">✓ Aprovada</span></div>';
			}
			return sera_pp_mob( 'Visualizar', $b . '</div>' );

		case 'animacao':
			$b = '<div class="ppx-step">Passo 9 de 10 · Filmar</div><div class="ppx-mtitle">Animação</div>' . sera_pp_frame( 'mesa', 'height:190px;margin-top:14px' );
			$b .= '<div class="ppx-card pp-fxm" style="margin-top:10px"><div class="ppx-lbl">O que se move · 3F</div><div style="font-size:13px;margin-top:6px">O trem freia forte, Lia é jogada contra Dante; os copos deslizam.<span class="ppx-caret"></span></div></div>';
			$b .= '<div style="display:flex;gap:5px;margin-top:10px"><span class="ppx-chip on">Auto · 4 s</span><span class="ppx-chip">6 s</span><span class="ppx-chip">Voz da Lia</span></div><span class="ppx-btn lg">Gerar take · US$ 0,32</span>';
			return sera_pp_mob( 'Filmar', $b );
	}
	return '';
}
