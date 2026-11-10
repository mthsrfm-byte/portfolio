<?php
/**
 * Acordo Certo — recreated pages (2021–22 redesign), with light modern polish.
 * Photos are replaced by abstract portrait placeholders; copy follows the
 * original pages. The logo is the official one (assets/logos/acordo-certo.svg).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

function sera_ac_logo( $class = 'ac-logo' ) {
	return '<img class="' . esc_attr( $class ) . '" src="' . esc_url( get_template_directory_uri() . '/assets/logos/acordo-certo.svg' ) . '" alt="Acordo Certo">';
}

/**
 * Abstract portrait placeholder (no real people).
 */
function sera_ac_ph( $shape = 'pill', $tone = 'blue' ) {
	$person = '<svg viewBox="0 0 100 100" preserveAspectRatio="xMidYMax meet" aria-hidden="true"><circle cx="50" cy="38" r="17"/><path d="M14 104c2-22 17-36 36-36s34 14 36 36z"/></svg>';
	return '<span class="ac-ph ac-ph--' . esc_attr( $shape ) . ' ac-t--' . esc_attr( $tone ) . '">' . $person . '</span>';
}

function sera_ac_icon( $name ) {
	$p = array(
		'edit'   => '<path d="M4 20h4l10-10-4-4L4 16z"/><path d="M13 7l4 4"/>',
		'search' => '<circle cx="11" cy="11" r="6"/><path d="M20 20l-4.5-4.5"/>',
		'doc'    => '<rect x="6" y="3" width="12" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/>',
		'check'  => '<circle cx="12" cy="12" r="8"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>',
		'phone'  => '<path d="M6 3h3l2 5-2 1a11 11 0 0 0 6 6l1-2 5 2v3a2 2 0 0 1-2 2A17 17 0 0 1 4 5a2 2 0 0 1 2-2z"/>',
		'card'   => '<rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18M7 15h3"/>',
		'mail'   => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
		'shield' => '<path d="M12 3l7 3v6c0 4-3 7-7 9-4-2-7-5-7-9V6z"/><path d="M9 12l2 2 4-4"/>',
		'chev'   => '<path d="M6 9l6 6 6-6"/>',
		'arrow'  => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'star'   => '<path d="M12 3l2.6 5.6 6 .7-4.5 4.1 1.2 6L12 16.5 6.7 19.4l1.2-6L3.4 9.3l6-.7z"/>',
		'play'   => '<path d="M9 7l8 5-8 5z"/>',
		'menu'   => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'lock'   => '<rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/>',
	);
	return isset( $p[ $name ] ) ? '<svg class="ac-i" viewBox="0 0 24 24" aria-hidden="true">' . $p[ $name ] . '</svg>' : '';
}

/**
 * Browser window frame, scaled like the phones (--bs).
 */
function sera_browser( $content, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'url'     => 'acordocerto.com.br',
			'caption' => '',
			'label'   => '',
			'class'   => '',
		)
	);
	$label = $args['label'] ? ' role="img" aria-label="' . esc_attr( $args['label'] ) . '"' : ' aria-hidden="true"';
	$html  = '<figure class="browser ' . esc_attr( $args['class'] ) . '"' . $label . '><div class="browser-scale"><div class="browser-frame">';
	$html .= '<div class="browser-bar"><span class="dots"><i></i><i></i><i></i></span><span class="url">' . sera_ac_icon( 'lock' ) . esc_html( $args['url'] ) . '</span><span></span></div>';
	$html .= '<div class="browser-page">' . $content . '</div></div></div>';
	if ( $args['caption'] ) {
		$html .= '<figcaption>' . esc_html( $args['caption'] ) . '</figcaption>';
	}
	return $html . '</figure>';
}

/* ------------------------------------------------------------- BEFORE */

function sera_scr_ac_before() {
	$h  = '<div class="acb">';
	$h .= '<header class="acb-head">' . sera_ac_logo() . '<nav><b>Início</b><span>Sobre nós</span><span>Como funciona</span><span>Dúvidas</span><span>Blog</span></nav><span class="acb-btn line">Entrar</span><span class="acb-btn">Consultar CPF</span></header>';
	$h .= '<section class="acb-hero"><div class="acb-photo">' . sera_ac_ph( 'blob', 'warm' ) . '<p>Mais<br>barato<br>do que <b>a pizza</b><br>no final de semana.</p></div>';
	$h .= '<div class="acb-form"><h2>Negocie dívidas com<br>parcelas a partir de <em>R$ 100</em></h2><span class="acb-input">Digite seu CPF</span><span class="acb-cta">' . sera_ac_icon( 'search' ) . 'Buscar minhas dívidas</span><small>Já tem cadastro na Acordo Certo? ›</small><p>O valor das parcelas pode variar de acordo com as características específicas de cada dívida e condições oferecidas pelas empresas.</p></div></section>';
	$h .= '<section class="acb-about"><div><h3>Saiba mais sobre a<br>Acordo Certo</h3><p class="lead">Quite sua dívida na maior empresa de negociação online do Brasil e do Mundo!</p><p>Com apenas alguns cliques você pode <b>consultar seu CPF</b>, <b>negociar agora</b> com mais de 30 empresas parceiras e <b>pagar a dívida com desconto</b>. Este <b>acerto de dívidas é feito online</b>, de maneira 100% transparente e segura, com todo o suporte necessário para você alcançar seu <b>bem-estar financeiro</b>.</p></div><div class="acb-video">' . sera_ac_ph( 'rect', 'teal' ) . '<span class="play">' . sera_ac_icon( 'play' ) . '</span></div></section>';
	$h .= '<section class="acb-nums"><h3>A Acordo Certo em números</h3><div>';
	foreach ( array( array( '+ 18 milhões', 'de clientes cadastrados em nosso portal de negociação' ), array( '+ 480 mil', 'acordos de dívidas fechados por mês' ), array( '+ 57 milhões', 'de CPFs com dívidas para negociação' ), array( '+ 119 bilhões', 'em valor em negociação de dívidas' ) ) as $n ) {
		$h .= '<span><b>' . $n[0] . '</b>' . $n[1] . '</span>';
	}
	$h .= '</div></section>';
	$h .= '<section class="acb-steps"><h3>Veja como é fácil quitar seus débitos:</h3><div>';
	foreach ( array( array( 'edit', '1. Faça seu cadastro' ), array( 'search', '2. Visualize seus débitos' ), array( 'doc', '3. Escolha uma opção de pagamento' ), array( 'check', '4. Acordo certo' ) ) as $s ) {
		$h .= '<span><i>' . sera_ac_icon( $s[0] ) . '</i><b>' . $s[1] . '</b><small>Texto de apoio explicando a etapa, em letras pequenas.</small></span>';
	}
	$h .= '</div></section>';
	$h .= '</div>';
	return $h;
}

/* -------------------------------------------------------------- AFTER */

function sera_ac_collage() {
	return '<div class="ac-collage">'
		. sera_ac_ph( 'rect', 'blue' ) . sera_ac_ph( 'pill', 'yellow' ) . sera_ac_ph( 'circle', 'orange' )
		. sera_ac_ph( 'arch', 'purple' ) . sera_ac_ph( 'leaf', 'green' )
		. '<i class="spark" aria-hidden="true"></i><i class="dot" aria-hidden="true"></i>'
		. '</div>';
}

function sera_scr_ac_after() {
	$h  = '<div class="aca mk-scroll">';
	$h .= '<header class="aca-head">' . sera_ac_logo() . '<nav><span>Como funciona</span><span>Parceiros</span><span>Sobre nós</span><span>Ajuda</span></nav><span class="aca-btn">Consultar CPF grátis</span></header>';
	$h .= '<section class="aca-hero"><div class="copy"><span class="aca-kicker">' . sera_ac_icon( 'shield' ) . 'Negociação 100% online, sem ligações</span><h1>Tire o peso dos ombros e negocie suas dívidas com até <em>99% de desconto</em></h1><p>Ajudamos milhões de pessoas a <b>conquistar o bem-estar financeiro</b>.</p><div class="aca-form"><span class="aca-input mk-focus"><span class="ph">Digite aqui o seu CPF</span><span class="mk-typed" aria-hidden="true">123.456.789-09</span></span><span class="aca-btn big mk-press">Consultar CPF grátis</span></div><div class="aca-trust"><span>' . sera_ac_icon( 'star' ) . '<b>+5 milhões</b> de brasileiros</span><span>' . sera_ac_icon( 'check' ) . 'Empresa indicada no Reclame Aqui</span></div></div>' . sera_ac_collage() . '</section>';
	$h .= '<section class="aca-press"><span>Onde já<br>aparecemos</span><div><b>Globo</b><b>SBT</b><b>Record</b><b>Band</b><b>Veja</b><b>Exame</b><b>CNN</b></div></section>';
	$h .= '<section class="aca-phone"><div><h2>Negocie dívidas <em>sem falar ao telefone</em></h2><p>Tão bom que até parece mentira. Mas não é ;)</p></div><div class="aca-cards">';
	foreach ( array( array( 'phone', 'mint', 'Troque horas no telefone por um <b>cadastro feito em minutos</b>' ), array( 'card', 'peach', 'Pague seu acordo em até 24x no <b>boleto ou cartão de crédito</b>' ), array( 'mail', 'lilac', 'Receba seus boletos por SMS e e-mail, <b>sem tarifas extras</b>' ) ) as $c ) {
		$h .= '<span class="aca-card"><i class="ill ac-t--' . $c[1] . '">' . sera_ac_icon( $c[0] ) . '</i>' . $c[2] . '</span>';
	}
	$h .= '</div></section>';
	$h .= '<section class="aca-flow"><h2>Como funciona</h2><div>';
	foreach ( array( array( 'search', 'Consulte seu CPF', 'Grátis e seguro, em segundos.' ), array( 'doc', 'Veja as ofertas', 'Todas as dívidas e descontos num só lugar.' ), array( 'card', 'Escolha como pagar', 'Parcelas que cabem no seu bolso.' ), array( 'check', 'Nome limpo', 'Pagou a 1ª parcela, a restrição sai do seu CPF.' ) ) as $i => $s ) {
		$h .= '<span><em>' . ( $i + 1 ) . '</em><i>' . sera_ac_icon( $s[0] ) . '</i><b>' . $s[1] . '</b><small>' . $s[2] . '</small></span>';
	}
	$h .= '</div></section>';
	$h .= '<section class="aca-partners"><h2>Negocie com mais de 30 empresas parceiras. <em>Só um cadastro. Zero ligações.</em></h2><span class="aca-btn line">Ver todas as empresas parceiras</span><div class="grid"><span>Bancos</span><span>Cartões</span><span>Varejo</span><span>Telefonia</span><span>Faculdades</span><span>Financeiras</span></div></section>';
	$h .= '<section class="aca-stats"><div><h2><b>Mais de 5 milhões de brasileiros</b> já fizeram um Acordo Certo com a gente</h2><p>Somos a maior empresa de negociação de dívidas do Brasil.</p></div><div class="nums"><span><b>+ de 500 mil</b> acordos fechados todos os meses</span><span><b>+ de R$ 8 bilhões</b> em descontos oferecidos aos clientes</span></div></section>';
	$h .= '<section class="aca-team">' . '<div class="ac-collage small">' . sera_ac_ph( 'arch', 'yellow' ) . sera_ac_ph( 'rect', 'blue' ) . sera_ac_ph( 'leaf', 'orange' ) . '</div><div><h2>Pode deixar, <em>nosso time lida com a parte difícil</em> por você ;)</h2><p>Cuidamos para que dê tudo certo, desde buscar as melhores ofertas até condições que cabem no seu bolso.</p><span class="aca-btn line">Conheça nosso time</span></div></section>';
	$h .= '<section class="aca-reviews"><div><h2>O que nossos clientes estão falando</h2><p>Confira o que nossos clientes estão falando da gente.</p></div><div class="row">';
	foreach ( array( 'Negociei pelo celular e resolvi na hora, sem ligação.', 'Tive um probleminha no boleto, mas o suporte respondeu rápido.', 'Consegui um desconto que não achava em lugar nenhum.' ) as $i => $q ) {
		$h .= '<span class="rev">' . sera_ac_ph( 'circle', array( 'blue', 'orange', 'green' )[ $i ] ) . '<b>Cliente · via Google</b><i class="stars">★★★★★</i><q>' . $q . '</q></span>';
	}
	$h .= '</div></section>';
	$h .= '<section class="aca-faq"><div><h2>Como podemos te ajudar hoje?</h2>';
	foreach ( array( 'Recebi uma mensagem de uma dívida que não reconheço. O que devo fazer?', 'Por que tenho que fazer um cadastro para consultar minhas dívidas?', 'Quanto tempo leva para o meu pagamento ser reconhecido?' ) as $q ) {
		$h .= '<span class="q">' . $q . sera_ac_icon( 'chev' ) . '</span>';
	}
	$h .= '</div><div class="help">' . sera_ac_ph( 'circle', 'teal' ) . '<b>Ainda ficou com dúvidas?</b><span>A gente te ajuda.</span><span class="aca-btn">Central de ajuda</span></div></section>';
	$h .= '<section class="aca-news"><h2>Conquiste o bem-estar financeiro com dicas e conteúdos exclusivos</h2><div class="aca-form"><span class="aca-input">Digite seu melhor e-mail</span><span class="aca-btn light">Quero receber dicas</span></div></section>';
	$h .= '</div>';
	return $h;
}

/* ------------------------------------------------------------- MOBILE */

function sera_scr_ac_m_head() {
	return '<div class="acm-head">' . sera_ac_logo() . sera_ac_icon( 'menu' ) . '</div>';
}

function sera_scr_ac_m1() {
	$h  = sera_scr_ac_m_head();
	$h .= '<div class="acm-hero"><span class="aca-kicker">' . sera_ac_icon( 'shield' ) . 'Sem ligações</span><h1>Tire o peso dos ombros e negocie suas dívidas com até <em>99% de desconto</em></h1><p>Ajudamos milhões de pessoas a <b>conquistar o bem-estar financeiro</b>.</p><span class="aca-input mk-focus"><span class="ph">Digite aqui o seu CPF</span><span class="mk-typed" aria-hidden="true">123.456.789-09</span></span><span class="aca-btn big mk-press">Consultar CPF grátis</span><div class="aca-trust"><span>' . sera_ac_icon( 'star' ) . '<b>+5 milhões</b> de brasileiros</span></div></div>';
	$h .= '<div class="acm-collage">' . sera_ac_collage() . '</div>';
	return $h;
}

function sera_scr_ac_m2() {
	$h  = sera_scr_ac_m_head();
	$h .= '<div class="acm-blue"><h2>Negocie dívidas <em>sem falar ao telefone</em></h2><p>Tão bom que até parece mentira. Mas não é ;)</p>';
	foreach ( array( array( 'phone', 'mint', 'Troque horas no telefone por um <b>cadastro feito em minutos</b>' ), array( 'card', 'peach', 'Pague em até 24x no <b>boleto ou cartão</b>' ), array( 'mail', 'lilac', 'Boletos por SMS e e-mail, <b>sem tarifas extras</b>' ) ) as $c ) {
		$h .= '<span class="aca-card row"><i class="ill ac-t--' . $c[1] . '">' . sera_ac_icon( $c[0] ) . '</i><span>' . $c[2] . '</span></span>';
	}
	$h .= '</div><div class="acm-flow"><h2>Como funciona</h2>';
	foreach ( array( 'Consulte seu CPF', 'Veja as ofertas', 'Escolha como pagar', 'Nome limpo' ) as $i => $s ) {
		$h .= '<span><em class="mk-step" style="--w:' . $i . '">' . ( $i + 1 ) . '</em>' . $s . '</span>';
	}
	$h .= '</div>';
	return $h;
}

function sera_scr_ac_m3() {
	$h  = sera_scr_ac_m_head();
	$h .= '<div class="acm-stats"><h2><b>Mais de 5 milhões de brasileiros</b> já fizeram um Acordo Certo</h2><span><b>+ de 500 mil</b> acordos por mês</span><span><b>+ de R$ 8 bi</b> em descontos</span></div>';
	$h .= '<div class="acm-rev"><h3>O que dizem nossos clientes</h3><div class="mk-track"><span class="rev">' . sera_ac_ph( 'circle', 'orange' ) . '<b>Cliente · via Google</b><i class="stars">★★★★★</i><q>Negociei pelo celular e resolvi na hora, sem ligação.</q></span><span class="rev mk-next" aria-hidden="true">' . sera_ac_ph( 'circle', 'green' ) . '<b>Cliente · via Google</b><i class="stars">★★★★★</i><q>Consegui um desconto que não achava em lugar nenhum.</q></span></div><div class="dots"><i class="on"></i><i></i><i></i></div></div>';
	$h .= '<div class="acm-faq"><h3>Como podemos te ajudar?</h3><span class="q mk-q">Recebi uma mensagem de uma dívida que não reconheço' . sera_ac_icon( 'chev' ) . '</span><span class="q">Quanto tempo leva para meu pagamento ser reconhecido?' . sera_ac_icon( 'chev' ) . '</span></div>';
	return $h;
}
