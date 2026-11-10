<?php
/**
 * Bastidores (nosbastidores.com.br) — recreated pages.
 * Before: the 2022 homepage (as archived by the Wayback Machine, Sept 2022).
 * After: the 2026 redesign. Headlines are real ones from each period; article
 * photos are replaced by abstract poster placeholders. Both logos are the
 * site's own (assets/logos/bastidores-2022.webp and bastidores-icon.svg).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

function sera_nb_old_logo() {
	return '<img class="nbo-logo" src="' . esc_url( get_template_directory_uri() . '/assets/logos/bastidores-2022.webp' ) . '" alt="' . esc_attr( sera_t( 'Bastidores (2022 logo)', 'Bastidores (logo de 2022)' ) ) . '">';
}

function sera_nb_icon() {
	static $svg = null;
	if ( null === $svg ) {
		$file = get_template_directory() . '/assets/logos/bastidores-icon.svg';
		$svg  = file_exists( $file ) ? file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions
		$svg  = str_replace( '<svg ', '<svg class="nb-icon" aria-hidden="true" ', $svg );
	}
	return $svg;
}

function sera_nb_logo( $class = '' ) {
	return '<span class="nb-brand ' . esc_attr( $class ) . '">' . sera_nb_icon() . '<b>Bastidores<sup>®</sup></b></span>';
}

/**
 * Abstract poster placeholder instead of press photos.
 */
function sera_nb_th( $tone = 1, $class = '' ) {
	return '<span class="nb-th nb-t' . (int) $tone . ' ' . esc_attr( $class ) . '"><i></i><i></i></span>';
}

function sera_nb_i( $name ) {
	$p = array(
		'search' => '<circle cx="11" cy="11" r="6"/><path d="M20 20l-4.5-4.5"/>',
		'menu'   => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'fire'   => '<path d="M12 3c1 4 5 5 5 10a5 5 0 0 1-10 0c0-2 1-3 2-4 0 2 1 3 2 3 0-3-1-5 1-9z"/>',
		'star'   => '<path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z"/>',
		'trend'  => '<path d="M4 16l6-6 4 4 6-6"/><path d="M15 8h5v5"/>',
		'user'   => '<circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 4-6 8-6s7 2 8 6"/>',
		'chev'   => '<path d="M6 9l6 6 6-6"/>',
		'arrow'  => '<path d="M5 12h14M13 6l6 6-6 6"/>',
	);
	return isset( $p[ $name ] ) ? '<svg class="nb-i" viewBox="0 0 24 24" aria-hidden="true">' . $p[ $name ] . '</svg>' : '';
}

/* ------------------------------------------------------------- BEFORE (2022) */

function sera_nb_old_head() {
	$h  = '<div class="nbo-social"><span>facebook</span><span>twitter</span><span>instagram</span><span>youtube</span></div>';
	$h .= '<div class="nbo-logo-row">' . sera_nb_old_logo() . '<div class="nbo-quick"><span>' . sera_nb_i( 'fire' ) . 'POPULAR</span><span>' . sera_nb_i( 'star' ) . 'QUENTE</span><span>' . sera_nb_i( 'trend' ) . 'TENDÊNCIA</span></div></div>';
	$h .= '<nav class="nbo-menu"><span>INÍCIO</span><span>NOS BASTIDORES ▾</span><span>NOTÍCIAS ▾</span><span>CINEMA ▾</span><span>ARTIGOS ▾</span><span>LISTAS</span><span>ESPECIAIS ▾</span><em>' . sera_nb_i( 'search' ) . '</em><em>' . sera_nb_i( 'user' ) . 'ACESSAR CONTA</em></nav>';
	return $h;
}

function sera_scr_nb_before() {
	$feat = array( 'Assassin´s Creed finalmente irá ao Japão com Codename Red', 'Marvel exibe primeiro trailer de Invasão Secreta na D23', 'Ubisoft revela Assassin’s Creed Mirage com trailer cinematográfico; confira', 'Crítica | Pinóquio (2022) é um conto vazio e sem encanto', 'O Rei Leão ganhará prequel live action focado em Mufasa', 'Disney anuncia Divertida Mente 2 na D23' );
	$h  = '<div class="nbo">' . sera_nb_old_head();
	$h .= '<section class="nbo-feat"><b class="nbo-feat-t">ÚLTIMAS PUBLICAÇÕES</b><div>';
	foreach ( $feat as $i => $t ) {
		$h .= '<span>' . sera_nb_th( $i % 6 + 1 ) . '<small>' . esc_html( mb_strtoupper( $t ) ) . '</small></span>';
	}
	$h .= '</div></section>';
	$h .= '<div class="nbo-body"><div class="nbo-main">';
	$lists = array(
		array( 'Crítica | Pinóquio (2022) é um conto vazio e sem encanto', 'Crítica | Ingresso para o Paraíso é o retorno de Julia Roberts às Comédias Românticas', 'Morre Rainha Elizabeth II aos 96 anos de idade', '7 filmes para comemorar o centenário do rádio' ),
		array( 'Marvel exibe primeiro trailer de Invasão Secreta na D23', 'Ubisoft revela Assassin’s Creed Mirage com trailer cinematográfico; confira', 'Pixar anuncia nova animação original, Elio, sobre extraterrestres', 'Desencantada, sequência de Encantada, ganha primeiro trailer; confira', 'Showrunner de Os Anéis de Poder rebate críticas', 'Sexto ano de The Handmaid’s Tale será o último' ),
	);
	$h .= '<article class="nbo-tile mk-first">' . sera_nb_th( 2 ) . '<span class="cats">Capa, Games, Notícias</span><h3>Assassin´s Creed finalmente irá ao Japão com Codename Red</h3></article>';
	$h .= '<div class="nbo-list">';
	foreach ( $lists[0] as $i => $t ) {
		$h .= '<span>' . sera_nb_th( $i + 3 ) . '<b>' . esc_html( $t ) . '</b></span>';
	}
	$h .= '</div><h2 class="nbo-h">ÚLTIMAS NOTÍCIAS</h2>';
	$h .= '<article class="nbo-tile">' . sera_nb_th( 5 ) . '<span class="cats">Capa, Cinema, Lançamentos</span><h3>Histórias de Tolkien que renderiam séries e filmes melhores que Anéis de Poder</h3></article>';
	$h .= '<div class="nbo-list">';
	foreach ( $lists[1] as $i => $t ) {
		$h .= '<span>' . sera_nb_th( ( $i + 1 ) % 6 + 1 ) . '<b>' . esc_html( $t ) . '</b></span>';
	}
	$h .= '</div><h2 class="nbo-h">LISTAS</h2><div class="nbo-list">';
	foreach ( array( 'House of the Dragon e muito mais! Todos os derivados de Game of Thrones', 'Conheça os 8 melhores filmes de esportes', 'Melhores filmes da produtora de filmes A24', 'Lista | 8 épocas diferentes para ambientar o novo filme do Predador' ) as $i => $t ) {
		$h .= '<span>' . sera_nb_th( $i + 2 ) . '<b>' . esc_html( $t ) . '</b></span>';
	}
	$h .= '</div></div>';
	$h .= '<aside class="nbo-side"><div class="nbo-w nl"><b>NEWSLETTER</b><p>Receba notícias e histórias que estão bombando</p><span class="in">Endereço de Email:</span><span class="btn">GRÁTIS! INSCREVA-SE</span><small>Nunca vamos te enviar spam.</small></div>';
	$h .= '<div class="nbo-w"><b>TODOS ESTÃO LENDO…</b>';
	foreach ( array( 'Após término, Leonardo Dicaprio é visto saindo com modelo de 25 anos', 'Crítica | Pinóquio (2022) é um conto vazio e sem encanto', 'Morre Rainha Elizabeth II aos 96 anos de idade', 'Showrunner de Os Anéis de Poder rebate críticas' ) as $i => $t ) {
		$h .= '<span class="rk"><i>' . ( $i + 1 ) . '</i>' . esc_html( $t ) . '</span>';
	}
	$h .= '</div><div class="nbo-w"><b>DISCUSSÕES AGORA</b><span class="cm">Bruxas no cinema: entre a fantasia e a demonização – Jornalismo…</span><span class="cm">Crítica | O Segredo do Abismo é o filme mais subestimado de James Cameron</span></div></aside></div>';
	$h .= '<div class="nbo-social-row"><span>facebook</span><span>twitter</span><span>instagram</span><span>youtube</span></div>';
	$h .= '<footer class="nbo-foot"><div><b>SOBRE</b><p>Nos Bastidores, aqui a crítica acontece! Você pode nos contatar para envio de midiakit, sugestões ou críticas nos seguintes endereços.</p></div><div><b>SIGA NO FACEBOOK</b></div><div><b>PROCURANDO ALGO?</b><span class="in">Search for:</span></div><div><b>MAIS DISCUSSÕES…</b><p>Bruxas no cinema: entre a fantasia e a demonização</p></div></footer>';
	$h .= '<div class="nbo-copy">© 2022 Bastidores - Aqui a crítica acontece!</div>';
	return $h . '</div>';
}

function sera_scr_nb_before_m() {
	$h  = '<div class="nbo nbo-m"><span class="mk-ruler" aria-hidden="true"><i></i></span>';
	$h .= '<div class="nbo-mhead"><span class="hb">' . sera_nb_i( 'menu' ) . '</span>' . sera_nb_old_logo() . '<span class="hb">' . sera_nb_i( 'search' ) . '</span></div>';
	$h .= '<div class="nbo-quick m"><span>' . sera_nb_i( 'fire' ) . 'POPULAR</span><span>' . sera_nb_i( 'star' ) . 'QUENTE</span><span>' . sera_nb_i( 'trend' ) . 'TENDÊNCIA</span></div>';
	$h .= '<section class="nbo-feat m"><b class="nbo-feat-t">ÚLTIMAS PUBLICAÇÕES</b><div>';
	foreach ( array( 'ASSASSIN´S CREED FINALMENTE IRÁ AO JAPÃO COM CODENAME RED', 'MARVEL EXIBE PRIMEIRO TRAILER DE INVASÃO SECRETA NA D23', 'UBISOFT REVELA ASSASSIN’S CREED MIRAGE' ) as $i => $t ) {
		$h .= '<span>' . sera_nb_th( $i + 1 ) . '<small>' . esc_html( $t ) . '</small></span>';
	}
	$h .= '</div></section>';
	$h .= '<article class="nbo-tile mk-first">' . sera_nb_th( 2 ) . '<span class="cats">Capa, Games, Notícias</span><h3>Assassin´s Creed finalmente irá ao Japão com Codename Red</h3></article>';
	$h .= '<div class="nbo-list m">';
	foreach ( array( 'Crítica | Pinóquio (2022) é um conto vazio e sem encanto', 'Crítica | Ingresso para o Paraíso é o retorno de Julia Roberts às Comédias Românticas', 'Morre Rainha Elizabeth II aos 96 anos de idade', '7 filmes para comemorar o centenário do rádio' ) as $i => $t ) {
		$h .= '<span>' . sera_nb_th( $i + 3 ) . '<b>' . esc_html( $t ) . '</b></span>';
	}
	$h .= '</div><h2 class="nbo-h">ÚLTIMAS NOTÍCIAS</h2>';
	return $h . '</div>';
}

/* ------------------------------------------------------------- AFTER (2026) */

function sera_nb_ticker() {
	return '<div class="nbn-ticker"><b><i></i>ÚLTIMAS</b><span class="nbn-tk"><span class="mk-ticker">Vingadores: Ultimato Encore fatura US$ 26 milhões e lidera melhor fim de setembro desde 2015 <em>·</em> Marvel’s Wolverine agora deixa desligar rastros que viraram piada na web <em>·</em> Ace Combat 8 terá base em porta-aviões e quatro modos online</span></span></div>';
}

function sera_nb_sec_title( $a, $b, $em_first = true ) {
	$t = $em_first ? '<em>' . esc_html( $a ) . '</em> <small>de</small> <strong>' . esc_html( $b ) . '</strong>' : '<strong>' . esc_html( $a ) . '</strong> <em>' . esc_html( $b ) . '</em>';
	return '<div class="nbn-sec-h"><h2>' . $t . '</h2>' . ( $em_first ? '<span>VER TODAS →</span>' : '' ) . '</div>';
}

function sera_nb_ad( $class = '', $size = '970 × 250' ) {
	return '<div class="nbn-ad ' . esc_attr( $class ) . '"><span>PUBLICIDADE</span></div>';
}

function sera_scr_nb_after() {
	$h  = '<div class="nbn mk-page">' . sera_nb_ticker();
	$h .= '<header class="nbn-head">' . sera_nb_logo() . '<nav><span>Início</span><span>Notícias ' . sera_nb_i( 'chev' ) . '</span><span>Críticas ' . sera_nb_i( 'chev' ) . '</span><span>Artigos</span><span>Listas</span><span>Colunas</span></nav><div class="act"><span>' . sera_nb_i( 'search' ) . '</span><span class="mb">' . sera_nb_i( 'menu' ) . '</span></div></header>';
	$h .= sera_nb_ad( 'top' );
	$h .= '<section class="nbn-hero"><article class="main">' . sera_nb_th( 7, 'mk-zoom' ) . '<b class="mk-pop" aria-hidden="true">Breaking</b><div class="ov"><span class="kick">REVIEW · GAMES</span><h3>Review | Silent Hill Townfall traz uma excelente experiência de terror, porém preso a sombra de Silent Hill 2</h3><p>Silent Hill: Townfall aposta em uma nova dinâmica de terror com monstros que perseguem o jogador, uma cidade gigantesca e a misteriosa CRTV.</p></div></article>';
	foreach ( array( array( 8, 'CRÍTICA · CINEMA', 'Crítica | Coração Selvagem não apela ao sentimentalismo para emocionar o espectador' ), array( 9, 'FAMOSOS', 'Rick, da dupla com Renner, morre aos 59 anos em queda de helicóptero em SC' ), array( 10, 'REVIEW · GAMES', 'Review | Fire Emblem Fortune’s Weave é o RPG tático mais ambicioso da série' ), array( 11, 'CRÍTICA · CINEMA', 'Crítica | Resident Evil (2026) é experiência imersiva, mas banal como cinema' ) ) as $c ) {
		$h .= '<article>' . sera_nb_th( $c[0] ) . '<div class="ov"><span class="kick">' . esc_html( $c[1] ) . '</span><h3>' . esc_html( $c[2] ) . '</h3></div></article>';
	}
	$h .= '</section>';
	$h .= '<section class="nbn-sec">' . sera_nb_sec_title( 'Críticas', 'Cinema' ) . '<div class="nbn-grid g4">';
	foreach ( array( 'Crítica | A Ilha Esquecida oferece ao público infantil roupagem modernizada para folclore filipino', 'Crítica | Oasis: Don’t Look Back in Anger celebra rock como experiência de encontro coletivo', 'Crítica | Da Magia à Sedução: Feitiço de Amor é pacote fechado de Hollywood', 'Crítica | O Grande Arco de Paris é comovente relato histórico sobre arquitetura' ) as $i => $t ) {
		$h .= '<article>' . sera_nb_th( $i + 1 ) . '<h4>' . esc_html( $t ) . '</h4></article>';
	}
	$h .= '</div></section>';
	$h .= '<section class="nbn-sec">' . sera_nb_sec_title( 'Críticas', 'Games' ) . '<div class="nbn-grid g4">';
	foreach ( array( 'Review | Marvel’s Wolverine acerta na fúria de Logan, mas foge do risco que faria a diferença', 'Review | The Blood of Dawnwalker traz um ótimo Dilema do Monstro', 'Review | BioEden tem um coração lindo para relaxar, mas mecânicas podem ser melhores', 'Review | Moonlighter 2: The Endless Vault, quando explorar masmorras vira um grande negócio' ) as $i => $t ) {
		$h .= '<article>' . sera_nb_th( $i + 7 ) . '<h4>' . esc_html( $t ) . '</h4></article>';
	}
	$h .= '</div></section>';
	$h .= '<section class="nbn-sec">' . sera_nb_sec_title( 'Últimas', 'do Bastidores', false ) . '<div class="nbn-grid g3 latest">';
	$latest = array(
		array( 'CINEMA', 'Vingadores: Ultimato Encore fatura US$ 26 milhões e lidera melhor fim de setembro desde 2015', 'Bilheteria dos EUA soma US$ 122,3 milhões, e Coração Selvagem, de Brad Pitt, abre com US$ 20 milhões, acima das previsões.' ),
		array( 'GAMES', 'Marvel’s Wolverine agora deixa desligar rastros que viraram piada na web', '' ),
		array( 'GAMES', 'Ace Combat 8 terá base em porta-aviões e quatro modos online, mostra trailer', '' ),
	);
	foreach ( $latest as $i => $l ) {
		$h .= '<article>' . sera_nb_th( $i + 4 ) . '<span class="chip">' . $l[0] . '</span><h4>' . esc_html( $l[1] ) . '</h4><p>' . esc_html( $l[2] ) . '</p></article>';
	}
	$h .= '</div>' . sera_nb_ad( 'inline', '728 × 90' ) . '<div class="nbn-grid g3 latest">';
	foreach ( array( array( 'FAMOSOS', 'Família de Rick pede compreensão a fãs que se sentiram excluídos do velório' ), array( 'GAMES', 'Ex-designer diz que Starfield não fez sucesso suficiente para ganhar sequência' ), array( 'CINEMA', 'Vingadores: Doutor Destino ainda tem elenco secreto, diz diretor' ) ) as $i => $l ) {
		$h .= '<article>' . sera_nb_th( $i + 9 ) . '<span class="chip">' . $l[0] . '</span><h4>' . esc_html( $l[1] ) . '</h4></article>';
	}
	$h .= '</div><span class="nbn-more">CARREGAR MAIS</span></section>';
	$h .= '<footer class="nbn-foot"><div class="top"><div>' . sera_nb_logo( 'light' ) . '<p>Aqui a crítica acontece!</p><p class="ads">📣 Quer anunciar? Manda um email pro Matheus.</p></div><div><small>NAVEGAÇÃO</small><span>Início</span><span>Notícias</span><span>Críticas</span><span>Artigos</span><span>Listas</span></div><div><small>LEGAL</small><span>Privacidade</span><span>Termos</span><span>Cookies</span></div></div><div class="bot">© 2026 BASTIDORES. TODOS OS DIREITOS RESERVADOS. <span>FEITO COM CAFÉ POR MATHEUS SERAFIM</span></div></footer>';
	return $h . '</div>';
}

function sera_nb_m_head() {
	return sera_nb_ticker() . '<header class="nbn-head m">' . sera_nb_logo() . '<div class="act"><span>' . sera_nb_i( 'search' ) . '</span><span class="mb">' . sera_nb_i( 'menu' ) . '</span></div></header>';
}

function sera_scr_nb_m1() {
	$h  = '<div class="nbn nbn-m">' . sera_nb_m_head() . '<div class="mk-body">';
	$h .= '<section class="nbn-hero m"><article class="main">' . sera_nb_th( 7, 'mk-zoom' ) . '<b class="mk-pop" aria-hidden="true">Breaking</b><div class="ov"><span class="kick">REVIEW · GAMES</span><h3>Review | Silent Hill Townfall traz uma excelente experiência de terror, porém preso a sombra de Silent Hill 2</h3></div></article>';
	foreach ( array( array( 8, 'CRÍTICA · CINEMA', 'Crítica | Coração Selvagem não apela ao sentimentalismo para emocionar o espectador' ), array( 10, 'REVIEW · GAMES', 'Review | Fire Emblem Fortune’s Weave é o RPG tático mais ambicioso da série' ) ) as $c ) {
		$h .= '<article>' . sera_nb_th( $c[0] ) . '<div class="ov"><span class="kick">' . esc_html( $c[1] ) . '</span><h3>' . esc_html( $c[2] ) . '</h3></div></article>';
	}
	$h .= '</section><section class="nbn-sec">' . sera_nb_sec_title( 'Críticas', 'Cinema' ) . '<div class="nbn-grid"><article>' . sera_nb_th( 1 ) . '<h4>Crítica | A Ilha Esquecida oferece ao público infantil roupagem modernizada para folclore filipino</h4></article></div></section>';
	return $h . '</div></div>';
}

function sera_scr_nb_m2() {
	$h  = '<div class="nbn nbn-m">' . sera_nb_m_head();
	$h .= '<section class="nbn-sec">' . sera_nb_sec_title( 'Críticas', 'Cinema' ) . '<div class="nbn-grid">';
	$h .= '<article>' . sera_nb_th( 1 ) . '<h4>Crítica | A Ilha Esquecida oferece ao público infantil roupagem modernizada para folclore filipino</h4></article>';
	$h .= '</div></section>' . str_replace( '<span>PUBLICIDADE</span>', '<span>PUBLICIDADE</span><span class="mk-adfill" aria-hidden="true"><i></i><b></b><b></b><em>Anúncio</em></span>', sera_nb_ad( 'inline m', '320 × 100' ) );
	$h .= '<section class="nbn-sec">' . sera_nb_sec_title( 'Últimas', 'do Bastidores', false ) . '<div class="nbn-grid latest">';
	$h .= '<article>' . sera_nb_th( 4 ) . '<span class="chip">CINEMA</span><h4>Vingadores: Ultimato Encore fatura US$ 26 milhões e lidera melhor fim de setembro desde 2015</h4></article>';
	return $h . '</div></section></div>';
}
