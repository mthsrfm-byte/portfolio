<?php
/**
 * Pagaleve · Research Hub — recreated screens, in HTML.
 * Every study, idea, insight, quote and number on these screens is fictional,
 * and the interface copy is rewritten: the real findings are confidential.
 * Only the archive totals on the home are real.
 *
 * Desktop screens are 1280 px wide (they go inside sera_browser); the phone
 * screen is 393 px (inside sera_device).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/** Inline icon (24 × 24, stroke). */
function sera_rh_i( $name, $class = '' ) {
	$p = array(
		'search'   => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
		'sparkles' => '<path stroke-linejoin="round" d="M10 5Q11.53 11.97 18.5 13.5Q11.53 15.03 10 22Q8.47 15.03 1.5 13.5Q8.47 11.97 10 5ZM19 1.4Q19.65 4.35 22.6 5Q19.65 5.65 19 8.6Q18.35 5.65 15.4 5Q18.35 4.35 19 1.4ZM19.5 16.9Q19.97 19.03 22.1 19.5Q19.97 19.97 19.5 22.1Q19.03 19.97 16.9 19.5Q19.03 19.03 19.5 16.9Z"/>',
		'house'    => '<path d="M4 11l8-6.5 8 6.5v8.5a1 1 0 0 1-1 1h-4.5v-6h-5v6H5a1 1 0 0 1-1-1z"/>',
		'chats'    => '<path d="M4 15V6a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H8z"/><path d="M17 9h1a2 2 0 0 1 2 2v9l-3.5-3H11a2 2 0 0 1-2-2v-1"/>',
		'chat'     => '<path d="M5 18.5V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H8z"/>',
		'pin'      => '<path d="M9 4h6l-1 6 4 4H6l4-4zM12 14v7"/>',
		'chevl2'   => '<path d="M12 6l-6 6 6 6M19 6l-6 6 6 6"/>',
		'thdown'   => '<path d="M17 14V3h3v11zM17 14l-4 7a2 2 0 0 1-3-2l1-5H5a2 2 0 0 1-2-2.3l1.3-7A2 2 0 0 1 6.3 3H17"/>',
		'feedback' => '<path d="M4 5h16v11H9l-5 4z"/><path d="M8 9h8M8 12h5"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'up'       => '<path d="M12 19V5M6 11l6-6 6 6"/>',
		'down'     => '<path d="M12 5v14M6 13l6 6 6-6"/>',
		'left'     => '<path d="M19 12H5M11 6l-6 6 6 6"/>',
		'lock'     => '<rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
		'file'     => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5M9 13h6M9 17h4"/>',
		'spark'    => '<path d="M12 3v4M12 17v4M3 12h4M17 12h4M6.3 6.3l2.5 2.5M15.2 15.2l2.5 2.5M6.3 17.7l2.5-2.5M15.2 8.8l2.5-2.5"/>',
		'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'cal'      => '<rect x="4" y="5" width="16" height="16" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/>',
		'check'    => '<path d="m5 12 5 5 9-10"/>',
		'thumb'    => '<path d="M7 10v11H4V10zM7 10l4-7a2 2 0 0 1 3 2l-1 5h6a2 2 0 0 1 2 2.3l-1.3 7A2 2 0 0 1 17.7 21H7"/>',
		'shield'   => '<path d="M20 12V7l-8-4-8 4v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9z"/>',
		'plus'     => '<path d="M12 5v14M5 12h14"/>',
		'pen'      => '<path d="M4 20h4L19 9l-4-4L4 16z"/>',
		'send'     => '<path d="M21 3 10 14M21 3l-7 18-4-7-7-4z"/>',
		'x'        => '<path d="M6 6l12 12M18 6 6 18"/>',
		'flask'    => '<path d="M9 3h6M10 3v6l-5 9a2 2 0 0 0 1.7 3h10.6a2 2 0 0 0 1.7-3l-5-9V3"/>',
		'user'     => '<circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 4.5-6 8-6s6.5 2 8 6"/>',
		'users'    => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20c1-3.5 3.5-5 6.5-5s5.5 1.5 6.5 5M16 4.5a3.5 3.5 0 0 1 0 7M18 15c2 .6 3.2 2.2 3.8 5"/>',
		'tag'      => '<path d="M3 12V4h8l10 10-8 8z"/><circle cx="7.5" cy="8.5" r="1.5"/>',
		'bulb'     => '<path d="M9 18h6M10 21h4M12 3a6 6 0 0 0-4 10.5c.8.8 1 1.5 1 2.5h6c0-1 .2-1.7 1-2.5A6 6 0 0 0 12 3z"/>',
		'quote'    => '<path d="M7 7H4v6h4v-2c0-2-1-3-1-4zM17 7h-3v6h4v-2c0-2-1-3-1-4z"/>',
		'list'     => '<path d="M9 6h11M9 12h11M9 18h11M4 6h.01M4 12h.01M4 18h.01"/>',
		'folder'   => '<path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>',
		'clip'     => '<path d="M20 11 12 19a5 5 0 0 1-7-7l8-8a3.5 3.5 0 0 1 5 5l-8 8a2 2 0 0 1-3-3l7-7"/>',
		'copy'     => '<rect x="8" y="8" width="12" height="12" rx="2"/><path d="M16 8V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3"/>',
		'video'    => '<rect x="3" y="6" width="13" height="12" rx="2"/><path d="m16 10 5-3v10l-5-3"/>',
		'sheet'    => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M4 9h16M4 15h16M10 3v18"/>',
		'book'     => '<path d="M4 5a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2zM4 19V5"/>',
		'refresh'  => '<path d="M20 11a8 8 0 0 0-14-5l-2 2M4 13a8 8 0 0 0 14 5l2-2M4 4v4h4M20 20v-4h-4"/>',
		'jira'     => '<path d="M12 2 2 12l10 10 10-10zM12 8l-4 4 4 4 4-4z"/>',
		'plug'     => '<path d="M12 2v6M12 16v6M2 12h6M16 12h6M5 5l4 4M15 15l4 4M5 19l4-4M15 9l4-4"/>',
		'alert'    => '<path d="M12 3 2 20h20zM12 10v4M12 17h.01"/>',
		'dots'     => '<circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>',
		'sync'     => '<path d="M4 12a8 8 0 0 1 14-5.3L20 9M20 4v5h-5M20 12a8 8 0 0 1-14 5.3L4 15M4 20v-5h5"/>',
		'beaker'   => '<path d="M5 3h14M7 3v14a4 4 0 0 0 4 4h2a4 4 0 0 0 4-4V3M7 12h10"/>',
	);
	if ( empty( $p[ $name ] ) ) {
		return '';
	}
	return '<svg class="rhs-i ' . esc_attr( $class ) . '" viewBox="0 0 24 24" aria-hidden="true">' . $p[ $name ] . '</svg>';
}

function sera_rh_logo_url( $file = 'pagaleve-2026-symbol.svg' ) {
	return esc_url( get_template_directory_uri() . '/assets/logos/pagaleve-2026/' . $file );
}

/** App header: official symbol + product name. */
function sera_rh_appbar( $right = '', $dark = false ) {
	$sym = sera_rh_logo_url();
	$img = '<img class="rhs-sym' . ( $dark ? ' is-mono' : '' ) . '" src="' . $sym . '" alt="">';
	return '<div class="rhs-bar' . ( $dark ? ' is-dark' : '' ) . '"><div class="rhs-brand">' . $img . '<div><b>Research Hub</b><span>Design · Pesquisa</span></div></div><div class="rhs-nav">' . $right . '</div></div>';
}

/* ------------------------------------------------------------------ home */
function sera_scr_rh_home() {
	ob_start();
	?>
	<div class="rhs rhs-home">
		<?php echo sera_rh_appbar( '<span class="rhs-lnk">' . sera_rh_i( 'menu' ) . 'Menu</span><span class="rhs-pill">' . sera_rh_i( 'spark' ) . 'Perguntar</span>' ); // phpcs:ignore ?>
		<div class="rhs-wrap">
			<p class="rhs-eyebrow">Olá, Matheus</p>
			<h2 class="rhs-h">O que já <em>aprendemos</em>, num lugar só. <span>Cada conversa com quem usa o produto, com a fonte junto.</span></h2>
			<div class="rhs-stats"><div><b>Drive</b><span>Fonte dos estudos</span></div><div><b>#01–06</b><span>Mesmo formato</span></div><div><b>LGPD</b><span>Por padrão</span></div><div><b>MCP</b><span>No seu Claude</span></div></div>
			<div class="rhs-entries">
				<div class="mk-pulse"><i><?php echo sera_rh_i( 'spark' ); // phpcs:ignore ?></i><span><b>Pergunte ao acervo</b><small>Respostas com a fonte de cada achado</small></span><?php echo sera_rh_i( 'arrow' ); // phpcs:ignore ?></div>
				<div><i class="is-claude"><?php echo sera_rh_i( 'plug' ); // phpcs:ignore ?></i><span><b>Use no seu Claude</b><small>Conector com login da empresa</small></span><?php echo sera_rh_i( 'arrow' ); // phpcs:ignore ?></div>
				<div><i class="is-soft"><?php echo sera_rh_i( 'book' ); // phpcs:ignore ?></i><span><b>Guia de pesquisa</b><small>Da dúvida ao relatório</small></span><?php echo sera_rh_i( 'arrow' ); // phpcs:ignore ?></div>
			</div>
			<div class="rhs-strip">
				<div class="rhs-strip-h"><i><?php echo sera_rh_i( 'cal' ); // phpcs:ignore ?></i><b>Próximos estudos · plano do trimestre</b><span class="rhs-beta">Beta</span><span class="rhs-go">Abrir plano <?php echo sera_rh_i( 'arrow' ); // phpcs:ignore ?></span></div>
				<p class="rhs-strip-m">Publicado em 02/10 · <u><?php echo sera_rh_i( 'pen' ); // phpcs:ignore ?>rascunho com mudanças</u></p>
				<div class="rhs-strip-row">
					<div><small>Out · S2 · <em>em campo</em></small><b>Saldo da carteira no checkout</b></div>
					<div><small>Out · S3 · planejada</small><b>Lembrete na hora certa</b></div>
					<div><small>Out · S4 · planejada</small><b>Checkout que sobrevive à saída</b></div>
				</div>
			</div>
			<h3 class="rhs-sec">Últimos estudos</h3>
			<div class="rhs-recent">
				<div class="is-feat"><p class="m"><span>Carteira · Teste de usabilidade</span><span class="rhs-tag is-conf"><?php echo sera_rh_i( 'lock' ); // phpcs:ignore ?>Confidencial</span></p><h4>Carteira Digital · Teste de Usabilidade</h4><p>O saldo da carteira é lido como “troco” de compras antigas, e não como dinheiro disponível.</p><div class="pi"><small>Principal insight</small><b>Saldo parece troco, não dinheiro</b></div></div>
				<div><p class="m"><span>Comunicação · Survey</span><span class="rhs-tag is-int">Interno</span></p><h4>Lembretes de Vencimento #2 · Survey</h4><p>Mensagens curtas, com valor e um botão, ganharam dos e-mails formais em todos os perfis.</p></div>
				<div><p class="m"><span>Checkout · Entrevista</span><span class="rhs-tag is-conf"><?php echo sera_rh_i( 'lock' ); // phpcs:ignore ?>Confidencial</span></p><h4>Checkout no Celular · Entrevistas</h4><p>Quem sai do checkout não desiste: sai para conferir o extrato e não acha o caminho de volta.</p></div>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/* ---------------------------------------------------------------- report */
function sera_scr_rh_report() {
	ob_start();
	?>
	<div class="rhs rhs-modal-wrap">
		<div class="rhs-modal rhs-report">
			<div class="rhs-rep-h">
				<div class="rhs-rep-top"><span class="rhs-eyebrow is-ink"><?php echo sera_rh_i( 'file' ); // phpcs:ignore ?>Estudo</span><span class="rhs-tag is-conf">Confidencial</span><span class="rhs-x"><?php echo sera_rh_i( 'x' ); // phpcs:ignore ?></span></div>
				<h2>Carteira Digital ·<br>Teste de Usabilidade</h2>
				<div class="rhs-meta">
					<div><i><?php echo sera_rh_i( 'flask' ); // phpcs:ignore ?></i><span><small>Método</small><b>Teste de usabilidade</b></span></div>
					<div><i><?php echo sera_rh_i( 'cal' ); // phpcs:ignore ?></i><span><small>Quando</small><b>set. de 2026</b></span></div>
					<div><i><?php echo sera_rh_i( 'user' ); // phpcs:ignore ?></i><span><small>Autor</small><b>Matheus Serafim</b></span></div>
					<div><i><?php echo sera_rh_i( 'users' ); // phpcs:ignore ?></i><span><small>Participantes</small><b>10</b></span></div>
					<div><i><?php echo sera_rh_i( 'tag' ); // phpcs:ignore ?></i><span><small>Tema</small><b>Carteira</b></span></div>
				</div>
				<div class="rhs-counts">
					<div><i><?php echo sera_rh_i( 'bulb' ); // phpcs:ignore ?></i><span><b>4</b>achados</span></div>
					<div><i><?php echo sera_rh_i( 'quote' ); // phpcs:ignore ?></i><span><b>3</b>citações</span></div>
					<div><i><?php echo sera_rh_i( 'list' ); // phpcs:ignore ?></i><span><b>3</b>recomendações</span></div>
					<div><i><?php echo sera_rh_i( 'folder' ); // phpcs:ignore ?></i><span><b>5</b>materiais</span></div>
				</div>
			</div>
			<div class="rhs-rep-b">
				<div class="rhs-summary"><i><?php echo sera_rh_i( 'bulb' ); // phpcs:ignore ?></i><div><small>#01 · Em poucas palavras</small><p>O saldo da carteira é lido como “troco” de compras antigas, não como dinheiro. Por isso o atalho de adicionar saldo some: ninguém procura colocar dinheiro num lugar que parece um cofrinho de moedas.</p></div></div>
				<div class="rhs-sh"><i><?php echo sera_rh_i( 'search' ); // phpcs:ignore ?></i><span><small>#03</small><b>Achados · 4</b></span></div>
				<div class="rhs-find"><span>01</span><div><h5>Saldo parece troco, não dinheiro</h5><p>7 de 10 participantes descreveram o valor da carteira como sobra de compras anteriores. Nenhum considerou usar o saldo para pagar uma parcela.</p><p class="ev"><b>Evidência ·</b> “Isso aqui é tipo o troquinho que sobra, né? Não é dinheiro de verdade.”</p></div></div>
				<div class="rhs-find"><span>02</span><div><h5>O atalho de adicionar saldo compete com o banner</h5><p>O botão fica logo abaixo de um banner de ofertas animado. Nos testes, o olhar ia direto para a oferta.</p></div></div>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/* ------------------------------------------------------------------- ask */
function sera_rh_answer( $compact = false ) {
	if ( $compact ) {
		return '<p>Em setembro, três estudos dominaram a conversa:</p><ul>'
			. '<li><b>Carteira:</b> o saldo é lido como troco. <span class="rhs-chip">' . sera_rh_i( 'file' ) . 'Carteira Digital</span></li>'
			. '<li><b>Lembretes:</b> curtos e com botão ganham. <span class="rhs-chip">' . sera_rh_i( 'file' ) . 'Lembretes #2</span></li>'
			. '<li><b>Checkout:</b> quem sai, sai para conferir o extrato. <span class="rhs-chip">' . sera_rh_i( 'file' ) . 'Checkout no Celular</span></li></ul>'
			. '<h4>Por onde começar</h4><p>Leia primeiro o estudo da Carteira: ele explica dois dos outros achados.</p>';
	}
	return '<p>Os estudos apontam menos para “desistência” e mais para <b>interrupção</b>: a pessoa sai do fluxo por um motivo legítimo e não acha o caminho de volta.</p>'
		. '<h4>O que já sabemos</h4><ul>'
		. '<li><b>Saída para conferir o extrato.</b> 6 de 9 entrevistados abriram o app do banco no meio da compra. Ao voltar, o carrinho tinha expirado. <span class="rhs-chip">' . sera_rh_i( 'file' ) . 'Checkout no Celular · Entrevistas</span></li>'
		. '<li><b>Saldo invisível na hora de pagar.</b> Quem tinha saldo na carteira não lembrou de usá-lo. <span class="rhs-chip">' . sera_rh_i( 'file' ) . 'Carteira Digital · Teste</span></li>'
		. '<li><b>Lembrete certo, no momento errado.</b> O aviso em até 10 minutos trouxe mais gente de volta que o do dia seguinte. <span class="rhs-chip">' . sera_rh_i( 'file' ) . 'Lembretes de Vencimento #2</span></li></ul>'
		. '<h4>O que isso sugere para o design</h4><p>Testar um checkout que <b>sobrevive à saída</b>: estado salvo, retorno por notificação e o saldo aparecendo como forma de pagamento.</p>';
}

/** Shared hub menu (sidebar on desktop, drawer on mobile). */
function sera_rh_side( $drawer = false ) {
	$i = 'sera_rh_i';
	$recent = array(
		array( 'pin', 'Por que as pessoas abandonam o checkout no celular?', true ),
		array( 'chat', 'Acabei de chegar. Me dá um resumo dos últimos estudos', false ),
		array( 'chat', 'O que sabemos sobre a carteira?', false ),
		array( 'chat', 'Que tom funciona nos lembretes?', false ),
		array( 'chat', 'Dores do lojista no painel', false ),
	);
	$h  = '<aside class="rhs-side">';
	$h .= '<div class="rhs-side-h"><span class="rhs-side-b"><img src="' . sera_rh_logo_url() . '" alt="">Research Hub</span><span class="rhs-side-a"><i>' . $i( 'search' ) . '</i><i>' . $i( $drawer ? 'x' : 'chevl2' ) . '</i></span></div>';
	$h .= '<nav class="rhs-side-n"><p>' . $i( 'house' ) . 'Acervo</p><p class="on">' . $i( 'chats' ) . 'Perguntar ao acervo</p><p>' . $i( 'cal' ) . 'Roadmap de pesquisa</p><p>' . $i( 'book' ) . 'Como fazer pesquisa</p><p>' . $i( 'spark' ) . 'Usar no Claude</p></nav>';
	$h .= '<small>Recentes</small><div class="rhs-side-r">';
	foreach ( $recent as $r ) {
		$h .= '<p' . ( $r[2] ? ' class="on"' : '' ) . '>' . $i( $r[0] ) . '<span>' . esc_html( $r[1] ) . '</span>' . ( $r[2] ? '<em>' . $i( 'dots' ) . '</em>' : '' ) . '</p>';
	}
	$h .= '<p class="all">' . $i( 'dots' ) . '<span>Ver todas</span></p></div>';
	$h .= '<p class="rhs-side-fb">' . $i( 'feedback' ) . 'Mande seu feedback!</p>';
	$h .= '<div class="rhs-side-f"><span class="av">M</span><span class="rhs-side-new">' . $i( 'plus' ) . 'Nova conversa</span></div>';
	$h .= '</aside>';
	return $h;
}

/** The hub's answer mark: sparkles on a pink circle. */
function sera_rh_mark( $big = false ) {
	return '<span class="rhs-mark' . ( $big ? ' is-l' : '' ) . '">' . sera_rh_i( 'sparkles', 'is-fill' ) . '</span>';
}

function sera_scr_rh_ask() {
	$i = 'sera_rh_i';
	ob_start();
	?>
	<div class="rhs rhs-ask2">
		<?php echo sera_rh_side(); // phpcs:ignore ?>
		<div class="rhs-chat">
			<div class="rhs-cbar"><span class="rhs-cbar-b"><img src="<?php echo sera_rh_logo_url(); // phpcs:ignore ?>" alt=""><span><b>Research Hub</b><small>Por que as pessoas abandonam o checkout no celular?</small></span></span><i><?php echo $i( 'menu' ); // phpcs:ignore ?></i></div>
			<div class="rhs-thread">
				<div class="rhs-ufocus"><span class="rhs-att"><?php echo $i( 'file' ); // phpcs:ignore ?>Checkout no Celular</span><span class="rhs-att"><?php echo $i( 'file' ); // phpcs:ignore ?>Carteira Digital</span></div>
				<p class="q">Por que as pessoas abandonam o checkout no celular?</p>
				<p class="who"><?php echo sera_rh_mark(); // phpcs:ignore ?><b>Research Hub</b> · baseado no acervo</p>
				<div class="rhs-ans"><?php echo sera_rh_answer(); // phpcs:ignore ?></div>
				<div class="rhs-acts"><span><?php echo $i( 'copy' ); // phpcs:ignore ?>Copiar</span><span class="on"><?php echo $i( 'thumb' ); // phpcs:ignore ?></span><span><?php echo $i( 'thdown' ); // phpcs:ignore ?></span><span><?php echo $i( 'refresh' ); // phpcs:ignore ?>Refazer</span></div>
			</div>
			<div class="rhs-dock">
				<div class="rhs-box">
					<div class="rhs-ufocus is-in"><span class="rhs-att"><?php echo $i( 'file' ); // phpcs:ignore ?>Checkout no Celular<em><?php echo $i( 'x' ); // phpcs:ignore ?></em></span><span class="rhs-att"><?php echo $i( 'file' ); // phpcs:ignore ?>Carteira Digital<em><?php echo $i( 'x' ); // phpcs:ignore ?></em></span></div>
					<p class="ph">Pergunte mais alguma coisa…</p>
					<div class="row"><span class="rhs-clip"><?php echo $i( 'clip' ); // phpcs:ignore ?></span><small>Perguntando sobre 2 pesquisas</small><span class="rhs-send mk-pulse"><?php echo $i( 'up' ); // phpcs:ignore ?></span></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
function sera_scr_rh_ask_mobile() {
	$i = 'sera_rh_i';
	$sug = array(
		array( 'cal', 'Cobrança', 'O que já sabemos sobre por que as pessoas atrasam parcelas?' ),
		array( 'tag', 'Checkout', 'Quais dores aparecem no checkout?' ),
	);
	ob_start();
	?>
	<div class="rhs rhs-m rhs-empty">
		<div class="rhs-cbar is-m"><span class="rhs-cbar-b"><img src="<?php echo sera_rh_logo_url(); // phpcs:ignore ?>" alt=""><b>Research Hub</b></span><i><?php echo $i( 'menu' ); // phpcs:ignore ?></i></div>
		<div class="rhs-aur" aria-hidden="true"><span></span><span></span></div>
		<div class="rhs-empty-c mk-scroll">
			<span class="rhs-mark-o"><?php echo sera_rh_i( 'sparkles' ); // phpcs:ignore ?></span>
			<h3>O que você quer saber sobre <em>quem usa o produto?</em></h3>
			<div class="rhs-box is-big"><p class="ph">Ex.: por que as pessoas abandonam o checkout no celular?</p><div class="row"><span class="rhs-clip"><?php echo $i( 'clip' ); // phpcs:ignore ?></span><span class="rhs-send is-off"><?php echo $i( 'up' ); // phpcs:ignore ?></span></div></div>
			<small class="cap">Comece por uma destas</small>
			<?php foreach ( $sug as $x ) : ?>
				<div class="rhs-sug"><p><span><?php echo $i( $x[0] ); // phpcs:ignore ?><?php echo esc_html( $x[1] ); ?></span><i><?php echo $i( 'arrow' ); // phpcs:ignore ?></i></p><b><?php echo esc_html( $x[2] ); ?></b></div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/** Mobile: the hub menu as a drawer from the right, over the chat. */
function sera_scr_rh_menu_mobile() {
	ob_start();
	?>
	<div class="rhs rhs-m rhs-drawer-s">
		<div class="rhs-scrim"></div>
		<div class="rhs-drawer"><?php echo sera_rh_side( true ); // phpcs:ignore ?></div>
	</div>
	<?php
	return ob_get_clean();
}

/* ---------------------------------------------------------------- import */
function sera_scr_rh_import() {
	$files = array(
		array( 'md', 'resumo.md', 'Resumo + 4 insights', '<span class="rhs-chip">' . sera_rh_i( 'spark' ) . 'Vira o estudo</span>', '<span class="rhs-tag is-int">Interno</span>' ),
		array( 'pdf', 'Relatorio_Checkout_Celular.pdf', 'Deck · 24 páginas', '<span class="rhs-chip is-grey">Material</span>', '<span class="rhs-tag is-int">Interno</span>' ),
		array( 'xls', 'agendamentos_entrevistas.xlsx', 'Planilha · 9 linhas', '<span class="rhs-tag is-warn">' . sera_rh_i( 'user' ) . 'Dado pessoal: e-mail, ID</span>', '<span class="rhs-tag is-conf">' . sera_rh_i( 'lock' ) . 'Só para quem enviou</span>' ),
		array( 'vid', 'gravacoes/', '9 vídeos · grupo de arquivos', '<span class="rhs-tag is-warn">' . sera_rh_i( 'user' ) . 'Rosto e voz</span>', '<span class="rhs-tag is-conf">' . sera_rh_i( 'lock' ) . 'Só para quem enviou</span>' ),
		array( 'csv', 'respostas_anonimas.csv', 'Sem nome, e-mail ou customer_id', '<span class="rhs-tag is-ok">' . sera_rh_i( 'shield' ) . 'Sem dado pessoal</span>', '<span class="rhs-tag is-int">Interno</span>' ),
	);
	ob_start();
	?>
	<div class="rhs rhs-modal-wrap">
		<div class="rhs-modal rhs-import">
			<div class="rhs-rep-top"><span><small class="rhs-kick">Importar · revisão</small><h2>Antes de publicar, veja o que cada arquivo vira</h2></span><span class="rhs-x"><?php echo sera_rh_i( 'x' ); // phpcs:ignore ?></span></div>
			<div class="rhs-zip"><i><?php echo sera_rh_i( 'folder' ); // phpcs:ignore ?></i><span><b>checkout-celular-2026-08.zip</b><small>Checkout/ → área · 2026-08 Entrevistas/ → um estudo · resumo.md → resumo e insights</small></span></div>
			<div class="rhs-files">
				<?php foreach ( $files as $f ) : ?>
					<div><i class="ft-<?php echo esc_attr( $f[0] ); ?>"><?php echo esc_html( strtoupper( $f[0] ) ); ?></i><span><b><?php echo esc_html( $f[1] ); ?></b><small><?php echo esc_html( $f[2] ); ?></small></span><?php echo $f[3]; // phpcs:ignore ?><?php echo $f[4]; // phpcs:ignore ?></div>
				<?php endforeach; ?>
			</div>
			<div class="rhs-lgpd"><i><?php echo sera_rh_i( 'shield' ); // phpcs:ignore ?></i><p><b>Proteção LGPD aplicada automaticamente.</b> Planilhas e gravações ficam trancadas para quem enviou. O resto do time vê o resumo, os achados e as citações, nunca a pessoa por trás delas.</p></div>
			<div class="rhs-btns"><span class="rhs-ghost">Voltar</span><span class="rhs-pill">Publicar no acervo</span></div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/* --------------------------------------------------------------- privacy */
function sera_scr_rh_privacy() {
	$rules = array(
		array( 'Entrar só com conta Google corporativa', 'Login restrito ao domínio da empresa', true ),
		array( 'Trancar planilhas e gravações para quem enviou', 'Aplicado na importação, sem depender de lembrar', true ),
		array( 'Tirar nome, e-mail e customer_id das respostas', 'Gera respostas_anonimas.csv antes de publicar', true ),
		array( 'Sugestões da IA leem só material Interno', 'Estudos confidenciais não entram nas ideias do plano', true ),
	);
	ob_start();
	?>
	<div class="rhs rhs-modal-wrap">
		<div class="rhs-modal rhs-privacy">
			<div class="rhs-rep-top"><span class="rhs-eyebrow is-ink"><?php echo sera_rh_i( 'file' ); // phpcs:ignore ?>Carteira Digital · Teste de Usabilidade</span><span class="rhs-tag is-conf">Confidencial</span><span class="rhs-x"><?php echo sera_rh_i( 'x' ); // phpcs:ignore ?></span></div>
			<div class="rhs-sh"><i><?php echo sera_rh_i( 'folder' ); // phpcs:ignore ?></i><span><small>#06</small><b>Materiais · 5</b></span></div>
			<div class="rhs-mat">
				<div><i class="ft-pdf">PDF</i><span><b>Carteira · O que descobrimos.pdf</b><small>Deck · Interno</small></span><em class="open">Abrir</em></div>
				<div><i class="ft-csv">CSV</i><span><b>respostas_anonimas.csv</b><small>Planilha · Interno · sem dado pessoal</small></span><em class="open">Abrir</em></div>
				<div class="is-locked"><i class="ft-xls">XLS</i><span><b>participantes_teste.xlsx</b><small>Planilha · Confidencial</small></span><em><?php echo sera_rh_i( 'lock' ); // phpcs:ignore ?>Só para quem enviou</em></div>
				<div class="is-locked"><i class="ft-vid">VID</i><span><b>gravacoes/ · 10 vídeos</b><small>Gravação · Confidencial</small></span><em><?php echo sera_rh_i( 'lock' ); // phpcs:ignore ?>Só para quem enviou</em></div>
			</div>
			<div class="rhs-sh"><i><?php echo sera_rh_i( 'shield' ); // phpcs:ignore ?></i><span><small>Acesso</small><b>Quem vê o quê</b></span></div>
			<div class="rhs-rules">
				<?php foreach ( $rules as $r ) : ?>
					<div><span><b><?php echo esc_html( $r[0] ); ?></b><small><?php echo esc_html( $r[1] ); ?></small></span><i class="tog<?php echo $r[2] ? '' : ' off'; ?>"></i></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/* ---------------------------------------------------------------- guide */
function sera_scr_rh_guide() {
	$seven = array( array( 'Plano', 'A decisão vem antes das perguntas.' ), array( 'Revisão', 'Viés e o que o acervo já responde.' ), array( 'Formulário', 'Montado direto do roteiro.' ), array( 'Envio', 'Base, convite e aprovação.' ), array( 'Incentivo', 'Pedido quando o campo fecha.' ), array( 'Análise', 'Hipótese por hipótese.' ), array( 'Relatório', 'E publicado no hub.' ) );
	ob_start();
	?>
	<div class="rhs rhs-guide">
		<?php echo sera_rh_appbar( '<span class="rhs-lnk">' . sera_rh_i( 'menu' ) . 'Menu</span>' ); // phpcs:ignore ?>
		<div class="rhs-wrap">
			<p class="rhs-kick">Guia rápido · 5 minutos</p>
			<h2 class="rhs-gh">Toda dúvida do time<br>pode virar um estudo.</h2>
			<p class="rhs-lede">Perguntar no canal qual versão o time prefere já é pesquisar, só que sem método. Este guia mostra o caminho completo, com a skill fazendo o trabalho pesado.</p>
			<div class="rhs-g2">
				<div class="rhs-gcards">
					<p><small>A ferramenta</small>Uma skill no Claude que conduz o estudo do começo ao fim.</p>
					<p><small>O primeiro passo</small>Instale e escreva a dúvida como contaria a um colega.</p>
					<p><small>Sempre com você</small>Decidir o que perguntar, para quem, e quando enviar.</p>
					<span class="rhs-pill"><?php echo sera_rh_i( 'spark' ); // phpcs:ignore ?>Instalar a skill</span>
				</div>
				<div class="rhs-cut">
					<small class="rhs-kick is-mono">Passo 1 · a pergunta</small>
					<h3>Escreva sua pergunta em quatro partes</h3>
					<div class="eq"><p><small>Público</small>Quem tem saldo na carteira</p><b>+</b><p><small>Momento</small>No checkout</p><b>+</b><p><small>Dúvida</small>Se usaria o saldo pra pagar</p><b>=</b><p class="r"><small>Decisão</small>O novo botão de pagamento</p></div>
					<p class="out">Quero entender se quem tem saldo na carteira usaria esse saldo no checkout. A decisão que isso informa é o novo botão de pagamento.</p>
					<div class="row"><span>Pronto para colar</span><span class="rhs-pill is-sm"><?php echo sera_rh_i( 'copy' ); // phpcs:ignore ?>Copiar pedido</span></div>
				</div>
			</div>
			<div class="rhs-seven">
				<?php foreach ( $seven as $i => $s ) : ?>
					<p><i><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></i><b><?php echo esc_html( $s[0] ); ?></b><span><?php echo esc_html( $s[1] ); ?></span></p>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/* ------------------------------------------------------------- connector */
function sera_scr_rh_connect() {
	ob_start();
	?>
	<div class="rhs rhs-modal-wrap">
		<div class="rhs-modal rhs-connect">
			<div class="rhs-rep-top"><span class="rhs-cn"><i class="is-claude"><?php echo sera_rh_i( 'plug' ); // phpcs:ignore ?></i><span><small class="rhs-kick is-mono">Conector MCP</small><b>O acervo dentro do seu Claude</b></span></span><span class="rhs-x"><?php echo sera_rh_i( 'x' ); // phpcs:ignore ?></span></div>
			<div class="rhs-cn-steps"><span class="on">1 · Conectores</span><span class="on">2 · Login da empresa</span><span class="on is-now">3 · Pergunte</span></div>
			<h3>Abra uma conversa, ligue o conector e peça em português mesmo.</h3>
			<div class="rhs-prompts">
				<p><?php echo sera_rh_i( 'search' ); // phpcs:ignore ?>O que o acervo já sabe sobre a primeira compra?</p>
				<p><?php echo sera_rh_i( 'list' ); // phpcs:ignore ?>Mostre os estudos de Checkout com os achados de cada um.</p>
				<p><?php echo sera_rh_i( 'send' ); // phpcs:ignore ?>Publique este relatório no Research Hub.</p>
				<p><?php echo sera_rh_i( 'cal' ); // phpcs:ignore ?>Qual estudo do plano entra em campo na semana que vem?</p>
			</div>
			<div class="rhs-tools"><small>Ferramentas do conector</small><code>list_studies</code><code>publish_study</code><code>read_roadmap</code><code>update_roadmap</code></div>
			<div class="rhs-lgpd is-light"><i><?php echo sera_rh_i( 'lock' ); // phpcs:ignore ?></i><p>As regras do site valem aqui: arquivos confidenciais continuam trancados, e só contas da empresa conectam.</p></div>
			<div class="rhs-btns"><span class="rhs-ghost">Voltar</span><span class="rhs-pill">Pronto, conectei</span></div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/* ------------------------------------------------------------- roadmap */
function sera_rh_dk_head( $step ) {
	$steps = array( array( 'Ideias', 'junte e escolha' ), array( 'Prioridade', 'IA propõe, o time decide' ), array( 'Calendário', 'semana a semana' ) );
	$h     = '<div class="rhs-dk-bg"></div>' . sera_rh_appbar( '<span class="rhs-lnk">' . sera_rh_i( 'menu' ) . '</span>', true );
	$h    .= '<div class="rhs-dk-head"><small>Plano de pesquisa · Design</small><h2>Próximo trimestre <span class="rhs-beta">Beta</span></h2><p>Rascunho do trimestre</p></div><div class="rhs-steps">';
	foreach ( $steps as $i => $s ) {
		$h .= '<div' . ( $i === $step ? ' class="on"' : '' ) . '><i>' . ( $i + 1 ) . '</i><span><b>' . esc_html( $s[0] ) . '</b>' . esc_html( $s[1] ) . '</span></div>';
	}
	return $h . '</div>';
}

function sera_scr_rh_ideas() {
	$ideas = array(
		array( true, 'ai', true, 'Saldo da carteira no checkout', 'O saldo aparecendo como forma de pagamento muda a escolha na hora de pagar?', 'Checkout', 'Teste de usabilidade', 'Vem de: Carteira Digital', 4 ),
		array( true, 'ai', true, 'Lembrete na hora certa', 'Em que momento o aviso de carrinho traz a pessoa de volta sem soar como cobrança?', 'Comunicação', 'Survey', 'Vem de: Lembretes #2', 3 ),
		array( false, 'team', false, 'Primeira compra sem medo', 'O que a pessoa precisa ver antes de confiar na primeira parcela?', 'Onboarding', 'Entrevista', 'Ideia de Ana · Produto', 5 ),
	);
	ob_start();
	?>
	<div class="rhs rhs-dk">
		<?php echo sera_rh_dk_head( 0 ); // phpcs:ignore ?>
		<div class="rhs-dk-body">
			<div class="rhs-focus"><span class="in"><?php echo sera_rh_i( 'search' ); // phpcs:ignore ?>Sobre o que o time quer aprender? ex.: confiança no primeiro pagamento</span><span class="rhs-dbtn is-pink"><?php echo sera_rh_i( 'spark' ); // phpcs:ignore ?>Sugerir com IA</span><span class="rhs-dbtn"><?php echo sera_rh_i( 'plus' ); // phpcs:ignore ?>Nova ideia</span></div>
			<div class="rhs-filters"><span class="on">Tudo</span><span>Sugeridas</span><span>Do time</span><span>Com mais votos</span></div>
			<div class="rhs-ideas">
				<?php foreach ( $ideas as $d ) : ?>
					<div class="<?php echo $d[0] ? 'sel' : ''; ?>">
						<p class="tg"><?php echo 'ai' === $d[1] ? '<span class="ai">' . sera_rh_i( 'spark' ) . 'IA</span>' : '<span class="tm">Time</span>'; // phpcs:ignore ?><?php echo $d[2] ? '<span class="rm">No plano</span>' : ''; ?></p>
						<h5><?php echo esc_html( $d[3] ); ?></h5><p><?php echo esc_html( $d[4] ); ?></p>
						<p class="src"><?php echo sera_rh_i( 'file' ); // phpcs:ignore ?><?php echo esc_html( $d[7] ); ?></p>
						<p class="ft"><span><?php echo sera_rh_i( 'thumb' ); // phpcs:ignore ?><?php echo (int) $d[8]; ?></span><i class="ck"><?php echo sera_rh_i( 'check' ); // phpcs:ignore ?></i></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="rhs-dk-foot"><b>2 selecionadas</b><span class="rhs-pill is-dk">Ordenar <?php echo sera_rh_i( 'arrow' ); // phpcs:ignore ?></span></div>
	</div>
	<?php
	return ob_get_clean();
}

function sera_scr_rh_priority() {
	$dots = array( array( 1, 20, 24, true ), array( 2, 32, 36, true ), array( 3, 64, 26, false ), array( 4, 42, 64, false ) );
	$why  = array(
		array( 'Checkout que sobrevive à saída', 'Impacto 5 · Esforço 1', 'A saída para conferir o extrato aparece em 3 estudos; um A/B curto responde.' ),
		array( 'Saldo da carteira no checkout', 'Impacto 5 · Esforço 2 · ajustado', 'O saldo é lido como troco; um teste focal mostra se vira forma de pagamento.' ),
		array( 'Lembrete na hora certa', 'Impacto 4 · Esforço 4', 'O tom já foi validado; falta o momento. Pede survey com grupos por horário.' ),
	);
	ob_start();
	?>
	<div class="rhs rhs-dk">
		<?php echo sera_rh_dk_head( 1 ); // phpcs:ignore ?>
		<div class="rhs-dk-body">
			<p class="rhs-dk-sub">Cada ideia chega com uma nota de impacto e de esforço. Mexa no que discordar: quem está no topo vai primeiro.</p>
			<div class="rhs-prio">
				<div class="rhs-mx">
					<span class="q q1">Primeiro</span><span class="q q2">Vale planejar</span><span class="q q3">Quando der</span><span class="q q4">Repensar</span>
					<?php foreach ( $dots as $d ) : ?>
						<i class="<?php echo $d[3] ? 'hot' : ''; ?>" style="left:<?php echo (int) $d[1]; ?>%;top:<?php echo (int) $d[2]; ?>%"><?php echo (int) $d[0]; ?></i>
					<?php endforeach; ?>
					<small class="ax-y">Impacto ↑</small><small class="ax-x">Esforço →</small>
				</div>
				<div class="rhs-why">
					<p class="h"><b>Por quê</b><span class="rhs-dbtn is-sm"><?php echo sera_rh_i( 'refresh' ); // phpcs:ignore ?>Pedir nova nota</span></p>
					<?php foreach ( $why as $i => $w ) : ?>
						<div><i><?php echo (int) $i + 1; ?></i><span><b><?php echo esc_html( $w[0] ); ?></b><small><?php echo esc_html( $w[1] ); ?></small><em><?php echo esc_html( $w[2] ); ?></em></span></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="rhs-dk-foot"><b>Fila do trimestre</b><span class="rhs-pill is-dk">Ver calendário <?php echo sera_rh_i( 'arrow' ); // phpcs:ignore ?></span></div>
	</div>
	<?php
	return ob_get_clean();
}

function sera_scr_rh_track() {
	$weeks = array( 'Out|05/10', '|12/10', '|19/10', '|26/10', 'Nov|02/11', '|09/11', '|16/11', '|23/11', '|30/11', 'Dez|07/12', '|14/12', '|21/12', '|28/12' );
	$lane1 = array( array( 2, 'Saldo da carteira no checkout', 'Em campo', 0, 2, 'live', 'RES-41' ), array( 3, 'Lembrete na hora certa', 'Comunicação', 2, 2, '', 'RES-42' ), array( 1, 'Checkout que sobrevive à saída', 'Checkout', 4, 2, 'moved', 'RES-43' ), array( 4, 'Primeira compra sem medo', 'Onboarding', 6, 3, '', 'RES-44' ) );
	$lane2 = array( array( 5, 'Recibo que tira dúvida', 'Atendimento', 9, 2, '', '' ), array( 6, 'Lojista sem planilha', 'Dashboard B2B', 11, 2, '', '' ) );
	$pc    = function ( $p ) {
		$w = 100 / 13;
		return sprintf(
			'<div class="pc %6$s" style="left:calc(%1$.3f%% + 4px);width:calc(%2$.3f%% - 8px)"><b><i>%3$d</i>%4$s</b><small>%5$s · %7$d sem.</small>%8$s</div>',
			$p[3] * $w,
			$p[4] * $w,
			$p[0],
			esc_html( $p[1] ),
			esc_html( $p[2] ),
			esc_attr( $p[5] ),
			$p[4],
			$p[6] ? '<code>' . sera_rh_i( 'jira' ) . esc_html( $p[6] ) . '</code>' : ''
		);
	};
	ob_start();
	?>
	<div class="rhs rhs-dk rhs-track">
		<?php echo sera_rh_dk_head( 2 ); // phpcs:ignore ?>
		<div class="rhs-dk-body">
			<p class="rhs-dk-sub">A fila vira semanas. Arraste para mudar a data ou a duração e publique quando o time concordar.</p>
			<div class="rhs-tkbar">
				<span class="seg"><span class="on"><?php echo sera_rh_i( 'list' ); // phpcs:ignore ?>Linha do tempo</span><span>Lista</span></span>
				<span class="rhs-draft"><?php echo sera_rh_i( 'pen' ); // phpcs:ignore ?>Rascunho</span>
				<span class="rhs-warn"><?php echo sera_rh_i( 'alert' ); // phpcs:ignore ?>Fora da ordem de prioridade · <u>Reordenar</u></span>
			</div>
			<div class="rhs-tk">
				<div class="tk-m"><?php foreach ( $weeks as $wk ) { list( $m, $d ) = explode( '|', $wk ); echo '<span><b>' . ( $m ? esc_html( $m ) : '&nbsp;' ) . '</b>' . esc_html( $d ) . '</span>'; } // phpcs:ignore ?></div>
				<div class="tk-lane"><span class="today"><i>hoje</i></span><?php foreach ( $lane1 as $p ) { echo $pc( $p ); } // phpcs:ignore ?></div>
				<div class="tk-lane"><?php foreach ( $lane2 as $p ) { echo $pc( $p ); } // phpcs:ignore ?></div>
			</div>
		</div>
		<div class="rhs-dk-foot"><b>Mudanças não publicadas</b><span class="rhs-pill is-dk"><?php echo sera_rh_i( 'send' ); // phpcs:ignore ?>Publicar e criar no Jira</span></div>
	</div>
	<?php
	return ob_get_clean();
}
