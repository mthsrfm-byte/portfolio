<?php
/**
 * Artifacts — Paperplane Studio (own product, solo founder, in beta).
 * Screens are recreations in code; frames, cast sheets, locations and clips were made in the
 * Paperplane for the two sample episodes (assets/cases/paperplane/); prices and times are illustrative.
 * Animated pieces (tabs, styles, take, router, lab, reels) are driven by assets/js/pp-case.js and
 * fall back to a still, complete layout under reduced motion.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'sera_pp_video' ) ) {
	/**
	 * A muted clip from the episodes: poster first, the file only loads and plays while on screen.
	 *
	 * @param string $file  File name without extension.
	 * @param string $class Extra class.
	 */
	function sera_pp_video( $file, $class = '' ) {
		$base = get_template_directory_uri() . '/assets/cases/paperplane/' . $file;
		return '<video class="pp-vid' . ( $class ? ' ' . esc_attr( $class ) : '' ) . '" data-pp-video data-src="' . esc_url( $base . '.mp4' ) . '" poster="' . esc_url( $base . '.webp' ) . '" muted loop playsinline preload="none" aria-hidden="true"></video>';
	}
}

switch ( $args['name'] ) :

	case 'pp-glance':
		?>
		<dl class="glance">
			<div><dt>Empresa</dt><dd>Paperplane Studio · produto próprio, fundado solo</dd></div>
			<div><dt>Meu papel</dt><dd>Fundador · pesquisa, produto, design e construção, tudo com IA</dd></div>
			<div><dt>Para quem</dt><dd>Roteiristas, creators e estúdios pequenos que contam histórias com IA</dd></div>
			<div><dt>Status</dt><dd>No ar, em beta fechado · lista de espera aberta, convites aos poucos</dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label">O que eu construí</dt><ul><li>O estúdio em 10 etapas, da ideia à montagem</li><li>Roteiro em formato de cinema, com o Origami</li><li>Elenco com ficha em quatro vistas e voz própria</li><li>Storyboard com modo avançado em nós</li><li>Montagem multitrilha com upscale até 4K</li><li>Um roteador de modelos de imagem, vídeo e voz</li><li>Créditos, GPU por hora e GPU própria via app de desktop</li><li>Origami Assistant e Smart Engine, em beta</li><li>A landing e dois episódios feitos no próprio produto</li></ul></div>
		<?php
		break;

	case 'pp-coldopen':
		?>
		<div class="pp-open">
			<div class="pp-open-head">
				<span class="pp-open-k"><b>Sem Partidas</b> episódio 1 · cada quadro feito no Paperplane</span>
				<p class="pp-open-h">Isto aqui já foi<br><mark>só uma frase.</mark></p>
			</div>
			<div class="pp-open-film">
				<?php echo sera_pp_video( 'v-reel', 'pp-open-v' ); // phpcs:ignore ?>
				<span class="pp-open-hud" aria-hidden="true"><i></i>Sem Partidas · 1A → 2D</span>
				<span class="pp-open-prog" aria-hidden="true"><b></b></span>
			</div>
		</div>
		<?php
		break;

	case 'pp-tabs':
		$tabs = array(
			array( 'roteiro_v7_FINAL.docx', 'Editor de texto', 'Roteiro', 'A cena 3 mora aqui, na versão 7.', 'Depois do primeiro export, ninguém lê este arquivo de novo.', 'copia · cola' ),
			array( 'Referências · luz e figurino', 'Mural de imagens', 'Referências', 'Prints de luz, figurino e paleta, num mural bonito.', 'O gerador de imagem nunca vê este mural.', 'baixa · sobe' ),
			array( 'Gerador de imagem', 'Gerador de imagem', 'Personagens', 'A Lia sai linda na primeira imagem.', 'Na próxima, ela tem outro rosto.', 'print · planilha' ),
			array( 'storyboard_cena3.xlsx', 'Planilha e prints', 'Storyboard', 'Prints colados numa planilha de planos, para o cliente aprovar.', 'Fica velha na primeira alteração.', 'reescreve o prompt' ),
			array( 'Gerador de vídeo', 'Gerador de vídeo', 'Vídeo', 'Cada take é cobrado, acertando ou não.', 'O prompt é reescrito do zero, sem a ficha da Lia.', 'exporta · importa' ),
			array( 'Gerador de voz', 'Gerador de voz', 'Vozes', 'A fala da cena 3, gerada em outro site.', 'A voz não sabe qual take vai usar.', 'baixa · sobe' ),
			array( 'Editor de vídeo', 'Editor de vídeo', 'Montagem', 'Tudo baixado, importado e sincronizado à mão.', 'Mudou uma fala? Volte para a aba 1.', 'exporta de novo' ),
			array( 'Upscaler', 'Programa à parte', 'Upscale', 'Exporta, sobe, espera e baixa de novo.', 'Mais uma cópia do mesmo filme.', '' ),
		);
		$steps = array( 'Ideia', 'Universo', 'Roteiro', 'Estilo', 'Elenco', 'Cenários', 'Decupagem', 'Storyboard', 'Animação', 'Montagem 4K' );
		?>
		<div class="pp-tabs" data-pp-tabs>
			<div class="pp-tabs-win">
				<div class="pp-tabs-strip" aria-hidden="true">
					<span class="pp-tabs-dots"><i></i><i></i><i></i></span>
					<?php foreach ( $tabs as $i => $t ) : ?>
						<span class="pp-tab<?php echo 0 === $i ? ' is-on' : ''; ?>"><i></i><em><?php echo esc_html( $t[0] ); ?></em></span>
					<?php endforeach; ?>
					<span class="pp-tab is-pp"><i></i><em>Paperplane · A estação sem nome</em></span>
				</div>
				<div class="pp-tabs-body">
					<ol class="pp-tabs-panels">
						<?php foreach ( $tabs as $i => $t ) : ?>
							<li class="pp-tabs-p<?php echo 0 === $i ? ' is-on' : ''; ?>">
								<span class="pp-tabs-n"><?php printf( '%02d', $i + 1 ); ?> <small>/ 08</small></span>
								<div>
									<span class="art-label"><?php echo esc_html( $t[1] ); ?></span>
									<h4><?php echo esc_html( $t[2] ); ?></h4>
									<p><?php echo esc_html( $t[3] ); ?></p>
									<p class="pp-tabs-lost"><?php echo esc_html( $t[4] ); ?></p>
								</div>
								<?php if ( $t[5] ) : ?>
									<span class="pp-tabs-hop"><b>→</b> <?php echo esc_html( $t[5] ); ?> <small>para a aba <?php echo (int) ( $i + 2 ); ?></small></span>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ol>
					<div class="pp-tabs-one">
						<span class="art-label">No Paperplane · uma aba</span>
						<div class="pp-tabs-steps"><?php foreach ( $steps as $s ) : ?><span><?php echo esc_html( $s ); ?></span><?php endforeach; ?></div>
						<p>O roteiro, o elenco e cada quadro aprovado viajam juntos até a exportação. Nada é baixado para ser subido de novo.</p>
					</div>
				</div>
			</div>
			<p class="pp-tabs-sum" aria-hidden="true"><span>Um minuto de filme, hoje:</span> <b>8 abas</b> · <b>7 viagens de arquivo</b> · <b>nenhuma lembra o que a anterior fez</b></p>
		</div>
		<?php
		break;

	case 'pp-pains':
		$pains = array(
			array( 'Continuidade', 'A Lia da cena 1 não é a Lia da cena 8.', 'Cada gerador começa do zero. Sem uma ficha que viaje com o projeto, rosto, cabelo e figurino mudam no meio da história.', '05' ),
			array( 'Dispersão', 'O roteiro não conversa com a imagem.', 'Roteiro, decupagem e storyboard moram em lugares diferentes. Aprovar com o cliente vira uma pasta de prints que envelhece na primeira alteração.', '04' ),
			array( 'Custo cego', 'Paga-se para descobrir que o plano não funcionava.', 'Vídeo é a parte cara, e quase tudo cobra por geração. Sem aprovar o quadro antes, o crédito vai embora animando a ideia errada.', '06' ),
			array( 'Motor preso', 'O modelo e o preço são da plataforma.', 'Créditos, num modelo que ela escolheu. Para quem produz muito, a conta não fecha; para quem já tem uma placa boa, é pagar duas vezes.', '08' ),
		);
		?>
		<ol class="pp-pains">
			<?php foreach ( $pains as $i => $p ) : ?>
				<li>
					<span class="pp-pains-n"><?php printf( '%02d', $i + 1 ); ?></span>
					<div>
						<span class="art-label"><?php echo esc_html( $p[0] ); ?></span>
						<h4><?php echo esc_html( $p[1] ); ?></h4>
						<p><?php echo esc_html( $p[2] ); ?></p>
					</div>
					<span class="pp-pains-go">resposta no capítulo <b><?php echo esc_html( $p[3] ); ?></b></span>
				</li>
			<?php endforeach; ?>
		</ol>
		<?php
		break;

	case 'pp-market':
		$cols = array( 'Geradores de imagem e vídeo', 'Ferramentas locais de nós', 'Editores de vídeo', 'Paperplane' );
		$rows = array(
			array( 'Roteiro em formato de cinema', 'n', 'n', 'n', 'f' ),
			array( 'Elenco consistente entre cenas', 'h', 'h', 'n', 'f' ),
			array( 'Decupagem e storyboard para aprovar', 'n', 'n', 'n', 'f' ),
			array( 'Animar a partir do quadro aprovado', 'f', 'f', 'n', 'f' ),
			array( 'Montagem com várias trilhas', 'n', 'n', 'f', 'f' ),
			array( 'Upscale até 4K', 'h', 'f', 'h', 'f' ),
			array( 'Escolher o modelo de cada etapa', 'n', 'f', 'n', 'f' ),
			array( 'Rodar na própria GPU', 'n', 'f', 'n', 'f' ),
			array( 'Feito para quem não é técnico', 'f', 'n', 'f', 'f' ),
		);
		$lbl  = array( 'f' => 'Resolve', 'h' => 'Em parte', 'n' => 'Não resolve' );
		?>
		<div class="pp-market">
			<div class="pp-market-scroll" tabindex="0" role="region" aria-label="Mapa do mercado por categoria">
				<table>
					<thead><tr><th scope="col"><span class="art-label">O trabalho de quem faz filme</span></th><?php foreach ( $cols as $i => $c ) : ?><th scope="col"<?php echo 3 === $i ? ' class="is-pp"' : ''; ?>><?php echo esc_html( $c ); ?></th><?php endforeach; ?></tr></thead>
					<tbody>
						<?php foreach ( $rows as $r ) : ?>
							<tr><th scope="row"><?php echo esc_html( $r[0] ); ?></th>
							<?php for ( $k = 1; $k <= 4; $k++ ) : ?>
								<td<?php echo 4 === $k ? ' class="is-pp"' : ''; ?>><i class="pp-dot is-<?php echo esc_attr( $r[ $k ] ); ?>" role="img" aria-label="<?php echo esc_attr( $lbl[ $r[ $k ] ] ); ?>"></i></td>
							<?php endfor; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="pp-legend"><span><i class="pp-dot is-f"></i>Resolve</span><span><i class="pp-dot is-h"></i>Em parte, ou com esforço</span><span><i class="pp-dot is-n"></i>Não resolve</span></div>
		</div>
		<p class="art-cap">Leitura por categoria, feita para orientar o produto, não um ranking de marcas. As ferramentas locais de nós rodam na GPU de quem usa, mas pedem que a pessoa monte o fluxo à mão.</p>
		<?php
		break;

	case 'pp-statement':
		?>
		<div class="statement">
			<span class="art-label">A aposta</span>
			<p>Um filme com IA deveria começar numa frase e terminar num episódio, sem passar por oito abas. <em>Escreva. Dirija. O resto é com o estúdio.</em></p>
			<span class="by">O Paperplane junta o que um estúdio faz, universo, roteiro, elenco, cenários, decupagem, storyboard, animação e montagem, num projeto só. A IA faz o trabalho pesado; a palavra final é sempre de quem dirige.</span>
		</div>
		<?php
		break;

	case 'pp-principles':
		$d = array(
			array( 'O roteiro manda', 'Tudo nasce do texto. O Paperplane lê o roteiro, encontra os personagens, quebra as cenas em tomadas e só então gera imagem. Mudou a cena, o resto do projeto sabe.', '02' ),
			array( 'O elenco é um contrato', 'Cada personagem tem ficha em quatro vistas, figurino fixo e voz própria, e entra em todo pedido de imagem. Ninguém precisa lembrar de colar a descrição de novo.', '01' ),
			array( 'Imagem barata antes de vídeo caro', 'O storyboard é a porta do vídeo. Só anima o que já foi aprovado como imagem, e todo botão diz quanto custa antes de gerar.', '03' ),
			array( 'O motor é escolha, não prisão', 'Quem dirige escolhe o modelo de cada etapa e quem paga a GPU: créditos, uma GPU alugada por hora ou a própria placa. O estúdio é o mesmo.', '04' ),
		);
		?>
		<div class="pp-dec">
			<?php foreach ( $d as $i => $x ) : ?>
				<div class="pp-dec-c">
					<div class="pp-dec-top"><span class="pp-dec-n"><?php printf( '%02d', $i + 1 ); ?></span><span class="pp-dec-vs">contra a dor <b><?php echo esc_html( $x[2] ); ?></b></span></div>
					<h4><?php echo esc_html( $x[0] ); ?></h4>
					<p><?php echo esc_html( $x[1] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		break;

	case 'pp-cast':
		$views = array( array( 'ren-frente', 'Frente' ), array( 'ren-34', 'Três quartos' ), array( 'ren-perfil', 'Perfil' ), array( 'ren-costas', 'Costas' ) );
		$lia   = array( array( 'sb-a', '3A', 'Plano médio' ), array( 'sb-b', '3B', 'Close' ), array( 'sb-d', '3C', 'Sobre o ombro' ), array( 'n-28767caf', '2C', 'Plano médio' ), array( 'n-716c2a5a', '2A', 'Plano geral' ), array( 'v-mesa-f0', '3F', 'Plano médio' ) );
		?>
		<div class="pp-cast">
			<div class="pp-cast-sheet">
				<div class="pp-cast-h"><span class="art-label">A ficha · Sem Partidas</span><h4>Ren, em quatro vistas.<br>Do jeito que o gerador recebe.</h4></div>
				<div class="pp-cast-views">
					<?php foreach ( $views as $v ) : ?>
						<figure><img src="<?php echo sera_pp_src( $v[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><figcaption><?php echo esc_html( $v[1] ); ?></figcaption></figure>
					<?php endforeach; ?>
				</div>
				<p class="pp-cast-fix"><span class="art-label">Aparência fixa</span>Rapaz de 19 anos, rosto fino e olhar desconfiado. Cabelo preto curto e despenteado. Jaqueta escura de gola, camiseta verde-escura, calça e botas marrom-escuras.</p>
			</div>
			<div class="pp-cast-shots">
				<div class="pp-cast-h"><span class="art-label">A estação sem nome · seis tomadas</span><h4>Plano, luz e lugar mudam.<br>A Lia, não.</h4></div>
				<div class="pp-cast-grid">
					<?php foreach ( $lia as $l ) : ?>
						<figure><img src="<?php echo sera_pp_src( $l[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><figcaption><b><?php echo esc_html( $l[1] ); ?></b><?php echo esc_html( $l[2] ); ?></figcaption></figure>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
		break;

	case 'pp-styles':
		$deck = array(
			array( 'cel-1', 'Anime 2D cel', 'o estilo do episódio' ),
			array( 'ns-stop-motion', 'Stop motion', '' ),
			array( 'ns-live-action-de-drama', 'Drama live action', '' ),
			array( 'ns-preto-e-branco-dos-anos-60', 'Noir anos 60', '' ),
			array( 'ns-sci-fi-ambicioso', 'Sci-fi épico', '' ),
			array( 'ns-sitcom-nostalgico', 'Sitcom anos 90', '' ),
			array( 'ns-2d-sombrio', 'Drama 2D sombrio', '' ),
		);
		?>
		<div class="pp-sty" data-pp-styles>
			<div class="pp-sty-copy">
				<span class="art-label">Qualquer estilo</span>
				<h4 class="pp-swap" aria-label="Feitiço trocou. História ficou.">Feitiço <span class="pp-sw" data-sw="a">trocou.</span><br>História <span class="pp-sw" data-sw="b">ficou.</span></h4>
				<p>Anime hoje, noir amanhã, sitcom no fim de semana. Escolha um traço da biblioteca ou ensine um novo com algumas imagens. Ele vira regra do projeto e entra em todo pedido.</p>
				<ol class="pp-sty-list">
					<?php foreach ( $deck as $i => $d ) : ?>
						<li<?php echo 0 === $i ? ' class="is-on"' : ''; ?>><?php echo esc_html( $d[1] ); ?><?php echo $d[2] ? ' <small>' . esc_html( $d[2] ) . '</small>' : ''; ?></li>
					<?php endforeach; ?>
				</ol>
			</div>
			<div class="pp-sty-stage">
				<div class="pp-sty-frame">
					<?php foreach ( $deck as $i => $d ) : ?>
						<img<?php echo 0 === $i ? ' class="is-on"' : ''; ?> src="<?php echo sera_pp_src( $d[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async">
					<?php endforeach; ?>
					<span class="pp-sty-tag"><small>Estilo do projeto</small><b><?php echo esc_html( $deck[0][1] ); ?></b></span>
				</div>
				<div class="pp-sty-thumbs" aria-hidden="true">
					<?php foreach ( $deck as $i => $d ) : ?>
						<span<?php echo 0 === $i ? ' class="is-on"' : ''; ?>><img src="<?php echo sera_pp_src( $d[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<p class="art-cap">Miniaturas da biblioteca de estilos do Paperplane. Trocar o estilo redesenha os quadros; elenco, lugares e planos continuam no lugar.</p>
		<?php
		break;

	case 'pp-take':
		?>
		<div class="pp-take" data-pp-take>
			<figure class="pp-take-a">
				<div class="pp-take-img"><img src="<?php echo sera_pp_src( 'v-mesa-f0' ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><span class="pp-take-ok">✓ Aprovado</span></div>
				<figcaption><span class="art-label">Storyboard · 3F · imagem</span><b>Lia e Dante na mesa 4</b><span class="pp-take-m"><i>FLUX.2</i><i>16:9</i><i class="is-c">US$ 0,04</i></span></figcaption>
			</figure>
			<div class="pp-take-mid" aria-hidden="true"><span>vira o primeiro frame</span><i></i></div>
			<figure class="pp-take-b">
				<div class="pp-take-img"><?php echo sera_pp_video( 'v-mesa' ); // phpcs:ignore ?><span class="pp-take-play"><i></i>Take #2.0</span></div>
				<figcaption><span class="art-label">Animação · 3F · vídeo</span><b>“O trem freia, Lia é jogada contra Dante.”</b><span class="pp-take-m"><i>LTX-2.5 Pro</i><i>6 s</i><i>voz da Lia</i><i class="is-c">US$ 0,32</i></span></figcaption>
			</figure>
		</div>
		<p class="art-cap">Quadro e take gerados no Paperplane para “A estação sem nome”. Preços ilustrativos, para mostrar a ordem de grandeza entre imagem e vídeo.</p>
		<?php
		break;

	case 'pp-router':
		$req = array( 'Estilo · Anime 2D cel', 'Ficha · Lia', 'Ficha · Dante', 'Cenário · vagão', 'Quadro anterior · 3E', 'Plano médio · 6 s', 'NÃO: Dante de chapéu' );
		?>
		<div class="pp-route" data-pp-route>
			<div class="pp-route-h">
				<span class="art-label">Debaixo do capô</span>
				<h4>O que acontece quando você aperta <span class="pp-route-btn">Gerar take · US$ 0,32</span></h4>
			</div>
			<ol class="pp-route-flow">
				<li class="is-on">
					<span class="pp-route-n">01</span><b>O pedido se monta sozinho</b>
					<p>Tudo o que o projeto já sabe entra no pedido, sem ninguém colar nada.</p>
					<div class="pp-route-chips"><?php foreach ( $req as $i => $r ) : ?><span style="--i:<?php echo (int) $i; ?>"<?php echo 6 === $i ? ' class="is-neg"' : ''; ?>><?php echo esc_html( $r ); ?></span><?php endforeach; ?></div>
				</li>
				<li>
					<span class="pp-route-n">02</span><b>O roteador escolhe quem gera</b>
					<p>Cada etapa pode ter o seu modelo, escolhido por quem dirige.</p>
					<div class="pp-route-models"><div class="is-on"><span>Vídeo</span><b>LTX-2.5 Pro</b></div><div><span>Voz</span><b>ElevenLabs</b></div><div><span>Imagem</span><b>FLUX.2</b></div></div>
				</li>
				<li>
					<span class="pp-route-n">03</span><b>Roda no motor que você escolheu</b>
					<p>O pedido é o mesmo; muda só quem paga a GPU.</p>
					<div class="pp-route-eng"><span class="is-on">Créditos</span><span>GPU por hora</span><span>Sua GPU</span></div>
				</li>
				<li>
					<span class="pp-route-n">04</span><b>O take volta para a árvore</b>
					<p>Com modelo, seed e custo, ao lado das outras versões.</p>
					<div class="pp-route-take"><img src="<?php echo sera_pp_src( 'v-mesa-f0' ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><span>Take #2.0 · 6 s</span></div>
				</li>
			</ol>
			<div class="pp-route-line" aria-hidden="true"><i></i></div>
		</div>
		<?php
		break;

	case 'pp-engines':
		?>
		<div class="pp-engines">
			<article class="pp-way">
				<div class="pp-way-vis pp-cred">
					<svg viewBox="0 0 120 120" aria-hidden="true"><circle cx="60" cy="60" r="50" fill="none" stroke="rgba(26,26,26,.1)" stroke-width="7"/><circle class="pp-cred-arc" cx="60" cy="60" r="50" fill="none" stroke="#1A1A1A" stroke-width="7" stroke-linecap="round" stroke-dasharray="314" stroke-dashoffset="90" transform="rotate(-90 60 60)"/></svg>
					<div class="pp-cred-n"><b>4:12</b><span>min de filme</span></div>
					<div class="pp-cred-rows"><div><span>Econômica</span><i style="--w:100%"></i></div><div><span>Equilibrada</span><i style="--w:62%"></i></div><div><span>Máxima</span><i style="--w:28%"></i></div></div>
				</div>
				<span class="art-label">01 · Créditos</span><h4>Paga só pelo que gerar</h4><p>O saldo mostra quantos minutos de filme ele rende em cada qualidade, e todo botão diz o preço antes de gerar.</p>
			</article>
			<article class="pp-way">
				<div class="pp-way-vis pp-mp" data-pp-cycle>
					<div class="pp-mp-h"><span>Gerador de vídeo</span><span>cena 3</span></div>
					<div class="is-on"><span>LTX-2.5 Pro</span><em>equilíbrio</em></div><div><span>Kling</span><em>movimento</em></div><div><span>Seedance</span><em>rápido</em></div><div><span>MiniMax</span><em>econômico</em></div>
				</div>
				<span class="art-label">02 · O modelo de cada etapa</span><h4>Quem gera é escolha de quem dirige</h4><p>Imagem, vídeo e voz podem vir de modelos diferentes em cada projeto, ou em cada cena: Nano Banana, GPT Image, FLUX, Seedance, Kling, LTX e companhia.</p>
			</article>
			<article class="pp-way is-dark">
				<div class="pp-way-vis pp-gpu">
					<div class="pp-gpu-h"><i></i><span>GPU online</span><small>H100 · 80 GB</small></div>
					<b class="pp-gpu-t" data-pp-clock>00:42:17</b>
					<div class="pp-gpu-bars" aria-hidden="true"><?php for ( $i = 0; $i < 28; $i++ ) : ?><i style="--h:<?php echo (int) ( 30 + abs( sin( $i * 1.3 ) ) * 60 ); ?>%;--d:<?php echo (int) ( $i * 70 ); ?>ms"></i><?php endfor; ?></div>
				</div>
				<span class="art-label">03 · GPU por hora</span><h4>Liga, gera à vontade, desliga</h4><p>Uma GPU na nuvem só para o projeto. Paga-se o tempo ligada, não cada imagem. Em sessões longas de storyboard e animação, a conta muda de ordem de grandeza.</p>
			</article>
			<article class="pp-way is-own">
				<div class="pp-way-vis pp-gpu is-local">
					<div class="pp-gpu-h"><i></i><span>Sua GPU · conectada</span><small>app de desktop</small></div>
					<b>RTX 4090</b>
					<div class="pp-gpu-spec"><span>24 GB de VRAM</span><span>setup mínimo</span></div>
				</div>
				<span class="art-label">04 · A sua própria GPU <em class="pp-live">no ar</em></span><h4>O estúdio, rodando na sua placa</h4><p>Quem já tem uma placa forte não paga de novo para gerar. Um app de desktop conecta a GPU ao mesmo estúdio, com o mesmo fluxo de fichas e storyboard.</p>
			</article>
		</div>
		<?php
		break;

	case 'pp-lab':
		?>
		<div class="ppl">
			<article class="lx" id="labOri">
      <div class="lx-copy">
        <span class="beta-chip">No ar · em beta</span>
        <h3>Origami Assistant</h3>
        <p>O Origami é o seu ajudante de bastidor, presente em todo o estúdio. Peça do seu jeito: ele mostra o antes e o depois, e você aplica com um clique.</p>
        <ul class="lx-pts">
          <li><b>Um canal para cada etapa.</b> #roteiro, #elenco, #storyboard, cada conversa no seu canto.</li>
          <li><b>Nada some.</b> Tudo que o Origami mudou fica registrado, com antes e depois.</li>
          <li><b>Desfaz o feitiço.</b> Volte qualquer mudança, mesmo semanas depois.</li>
        </ul>
        <div class="lx-steps mono" id="oriSteps"><span>Pedir</span><span>Revisar</span><span>Aplicar</span><span>Histórico</span></div>
      </div>
      <div class="lx-stage"><div class="lx-canvas" id="oriCv">
        <div class="lx-win">
          <div class="lx-bar"><i></i><i></i><i></i><span>paperplane.studio/roteiro</span></div>
          <div class="oa">
            <div class="oa-doc">
              <div class="ap-lbl">Cena 3 · 0:24</div><div class="oa-h">Mesa 4</div>
              <div class="oa-script">
                <p>INT. VAGÃO-RESTAURANTE — NOITE</p>
                <p>O vagão balança vazio. Copos tilintam nas mesas. LIA (28) entra, o casaco molhado de chuva.</p>
                <p class="oa-c">DANTE</p>
                <p class="oa-d" id="oaLine"><span id="oaLineT">Você não devia estar aqui.</span></p>
                <p>Ele empurra um bilhete amassado sobre a mesa.</p>
              </div>
            </div>
            <aside class="oa-panel">
              <div class="oa-ph">
                <span class="oa-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"><path d="M1.2 7.6 7.6 15.6l2.6-1.1Z"/><path d="M2.2 21.5 7.6 15.6h2.6l5.4 3.4Z"/><path d="M2.2 21.5 15.6 19"/><path d="M10.2 15.6 12.7 13.3l2.9 3.9.7 3.8-2.1-1.4"/><path d="M16.3 21 18.6 13l.9-.6 3.8 3-3.6-.6-3.1 6.2"/><path d="M10.9 14.6 11.1 11 19.9 2.5l-.5 10.2"/><path d="M19.9 2.5 14.5 15"/></svg></span>
                <div class="oa-ch" id="oaCh"><b>A estação sem nome</b><span># roteiro ▾</span></div>
              </div>
              <div class="oa-menu" id="oaMenu">
                <div class="mono">A estação sem nome</div>
                <div class="on"># roteiro <i>12</i></div><div># elenco <i>4</i></div><div># storyboard <i>9</i></div><div># montagem <i>2</i></div>
                <div class="mono" style="margin-top:6px">Sem Partidas</div><div># roteiro <i>7</i></div>
              </div>
              <div class="oa-tabs"><span class="on" id="oaTabC">Conversa</span><span id="oaTabH">Histórico <i id="oaBadge">3</i></span></div>
              <div class="oa-body">
                <div class="oa-chat" id="oaChat"></div>
                <div class="oa-hist" id="oaHist">
                  <div class="oa-filter"><span class="on">Tudo</span><span>Roteiro</span><span>Elenco</span><span>Storyboard</span></div>
                  <div class="oa-list" id="oaList">
                    <div class="oa-e"><div><span>Elenco · Lia</span>Ficha refeita com o casaco molhado</div><em>ontem</em></div>
                    <div class="oa-e"><div><span>Storyboard · 3F</span>Take #1.2 aprovado</div><em>ontem</em></div>
                    <div class="oa-e"><div><span>Universo</span>Nova regra: sempre é noite lá fora</div><em>seg</em></div>
                  </div>
                </div>
              </div>
              <div class="oa-in"><span id="oaIn"></span><i class="oa-caret"></i><span class="oa-send">↑</span></div>
            </aside>
          </div>
          <div class="lx-toast" id="oaToast">✓ Mudança aplicada · guardada no histórico</div>
        </div>
        <div class="lx-cur" id="oriCur"><svg viewBox="0 0 24 24"><path d="M5 3l14 8-6 1.6L10 19z" fill="#1A1A1A" stroke="#fff" stroke-width="1.4" stroke-linejoin="round"/></svg></div>
      </div></div>
    </article>

    <article class="lx" id="labSmart">
      <div class="lx-copy">
        <span class="beta-chip">No ar · em beta</span>
        <h3>Smart Engine</h3>
        <p>Ligue na decupagem e ele decide como filmar cada tomada. Vídeo gerado só onde a cena pede; no resto, truques clássicos de cinema que custam quase nada.</p>
        <ul class="lx-pts">
          <li><b>Câmera que anda.</b> Panorâmica e travelling em cima de uma imagem só.</li>
          <li><b>Rosto falando.</b> Piscadas e bocas desenhadas a partir do próprio quadro, no tom da fala.</li>
          <li><b>Plano de reação.</b> Quem fala fica de costas e a gente vê quem escuta. Velho truque, ótimo resultado.</li>
        </ul>
        <div class="lx-steps mono" id="seSteps"><span>Ligar</span><span>Analisar</span><span>Rosto</span><span>Câmera</span><span>Custo</span></div>
      </div>
      <div class="lx-stage"><div class="lx-canvas" id="seCv">
        <div class="lx-win">
          <div class="lx-bar"><i></i><i></i><i></i><span>paperplane.studio/decupagem</span></div>
          <div class="sm">
            <div class="sm-l">
              <div class="sm-head"><div><div class="ap-lbl">Cena 3 · Mesa 4</div><div class="oa-h" style="margin:2px 0 0">Decupagem</div></div>
                <span class="sm-tg" id="smTg"><i></i>Smart engine</span></div>
              <div class="sm-rows" id="smRows">
                <div class="sm-r" data-k="v"><img src="<?php echo sera_pp_src( 'sb-e' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><div><b>3A</b> O trem freia de repente<span>Plano geral · 6 s</span></div><em>Vídeo gerado</em></div>
                <div class="sm-r" data-k="p"><img src="<?php echo sera_pp_src( 'loc-plataforma' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><div><b>3B</b> Hana espera na plataforma<span>Plano geral · 5 s</span></div><em>Imagem + câmera</em></div>
                <div class="sm-r" data-k="f"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><div><b>3C</b> Lia: “Ainda dá tempo.”<span>Close · 4 s · fala</span></div><em>Rosto falando</em></div>
                <div class="sm-r" data-k="r"><img src="<?php echo sera_pp_src( 'sb-d' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><div><b>3D</b> Dante de costas, Lia escuta<span>Sobre o ombro · 5 s</span></div><em>Reação</em></div>
                <div class="sm-r" data-k="p"><img src="<?php echo sera_pp_src( 'sb-i' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><div><b>3E</b> A xícara treme na mesa<span>Detalhe · 3 s</span></div><em>Imagem + zoom</em></div>
                <div class="sm-scan" id="smScan"></div>
              </div>
              <div class="sm-cost" id="smCost">
                <div><span>Tudo em vídeo</span><i><em id="smC1"></em></i><b>US$ 4,80</b></div>
                <div><span>Smart engine</span><i><em id="smC2" class="lime"></em></i><b id="smC2t">US$ 1,15</b></div>
              </div>
            </div>
            <div class="sm-d" id="smD">
              <div class="sm-empty" id="smEmpty"><span class="mono">Selecione uma tomada</span></div>
              <div class="sm-pane" data-p="f">
                <div class="ap-lbl">3C · Rosto falando</div>
                <div class="sm-face"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><i class="rig eyes"><u>olhos</u></i><i class="rig mouth"><u>boca</u></i><span class="sm-mouth"><span class="mcrop live"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""></span></span></div><div class="sm-emo"><span class="mono">Emoção da fala</span><div class="sm-wave" id="smWave"></div><div class="sm-emo-t"><b>Tensa</b><span>78%</span><b class="g">Esperança</b><span>22%</span></div></div><div class="sm-spr"><span class="mono">Bocas do próprio quadro</span><div id="smSpr"><figure class="c"><span class="sf"><span class="mcrop v0"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""></span></span><figcaption>fechada</figcaption></figure><figure class="c"><span class="sf"><span class="mcrop v1"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""></span></span><figcaption>A</figcaption></figure><figure class="c"><span class="sf"><span class="mcrop v2"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""></span></span><figcaption>E</figcaption></figure><figure class="c"><span class="sf"><span class="mcrop v3"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""></span></span><figcaption>O</figcaption></figure><figure class="c"><span class="sf"><span class="mcrop v4"><img src="<?php echo sera_pp_src( 'sb-b' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""></span></span><figcaption>U</figcaption></figure></div></div>
              </div>
              <div class="sm-pane" data-p="p">
                <div class="ap-lbl">3B · Imagem + câmera</div>
                <div class="sm-par" id="smPar"><img src="<?php echo sera_pp_src( 'loc-plataforma' ); // phpcs:ignore ?>" loading="lazy" decoding="async" alt=""><span class="cam-tag mono">Câmera · panorâmica lenta</span></div>
                <div class="sm-layers mono"><span>Uma imagem</span><span>0 vídeos gerados</span><span>5 s</span></div>
                <div class="sm-note">A câmera atravessa o quadro devagar, de um lado ao outro. Movimento de cinema sem gastar um vídeo.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="lx-cur" id="seCur"><svg viewBox="0 0 24 24"><path d="M5 3l14 8-6 1.6L10 19z" fill="#1A1A1A" stroke="#fff" stroke-width="1.4" stroke-linejoin="round"/></svg></div>
      </div></div>
    </article>
		</div>
		<p class="art-cap">Demonstrações recriadas em código a partir do Paperplane. Clique numa etapa para ver de novo; os valores são ilustrativos.</p>
		<?php
		break;

	case 'pp-made':
		$rows = array(
			array( 'Sem Partidas', array( array( 'v-placa', '1A' ), array( 'v-corrida', '1B' ), array( 'v-banco', '1C' ), array( 'v-close', '1E' ), array( 'v-encontro', '2A' ), array( 'v-tunel', 'ambiente' ) ) ),
			array( 'A estação sem nome', array( array( 'n-c5b568cf', '1A' ), array( 'n-716c2a5a', '2A' ), array( 'n-28767caf', '2C' ), array( 'n-9d3e32ea', '2D' ), array( 'v-mesa', '3C' ), array( 'v-vagao', '3F' ), array( 'n-4f6f962b', '4E' ), array( 'n-dbccf7a7', '5B' ), array( 'n-64e0721f', '8A' ), array( 'n-8eebb5ec', '8C' ) ) ),
		);
		?>
		<div class="pp-made" data-pp-made>
			<?php foreach ( $rows as $ri => $r ) : ?>
				<div class="pp-made-row<?php echo $ri ? ' is-rev' : ''; ?>">
					<span class="pp-made-l"><b><?php echo esc_html( $r[0] ); ?></b><?php echo count( $r[1] ); ?> takes</span>
					<div class="pp-made-track">
						<?php for ( $loop = 0; $loop < 2; $loop++ ) : ?>
							<?php foreach ( $r[1] as $c ) : ?>
								<figure class="pp-made-f"<?php echo $loop ? ' aria-hidden="true"' : ''; ?>><?php echo sera_pp_video( $c[0] ); // phpcs:ignore ?><figcaption><?php echo esc_html( 'ambiente' === $c[1] ? 'Movimento ambiente' : 'Tomada ' . $c[1] ); ?></figcaption></figure>
							<?php endforeach; ?>
						<?php endfor; ?>
					</div>
				</div>
			<?php endforeach; ?>
			<div class="pp-made-cast">
				<span class="art-label">Elenco de Sem Partidas</span>
				<?php foreach ( array( array( 'hana', 'Hana' ), array( 'ren', 'Ren' ), array( 'okabe', 'Sr. Okabe' ), array( 'bilh', 'Bilheteiro' ) ) as $c ) : ?>
					<span class="pp-made-p"><?php echo sera_pp_portrait( $c[0] ); // phpcs:ignore ?><?php echo esc_html( $c[1] ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		break;

	case 'pp-solo':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label">Produto e código</span><h4>Uma conversa no lugar de uma equipe</h4><p>Eu descrevo a tela, a regra e o porquê; a IA escreve; eu testo, corto e peço de novo. Construir uma tela leva uma tarde, então dá para jogar fora sem dó.</p></div>
			<div class="art-card"><span class="art-label">Comer a própria comida</span><h4>O produto fez o próprio material</h4><p>Os dois episódios de exemplo foram produzidos no Paperplane. Foram a melhor demo e o teste mais duro: cada furo da história virou um ajuste no produto.</p></div>
			<div class="art-card"><span class="art-label">O que fica comigo</span><h4>Decidir continua sendo o trabalho</h4><p>O que o estúdio mostra, quanto cada botão custa e o que chega a quem usa. A IA acelerou o fazer quase até zero; saber o que deveria existir continua levando o tempo que leva.</p></div>
		</div>
		<?php
		break;

	case 'pp-status':
		?>
		<div class="pp-status">
			<div><span class="art-label">No ar</span><ul><li>As dez etapas, da ideia à montagem, no computador e no celular</li><li>Roteiro com o Origami, elenco em quatro vistas e cenários de qualquer ângulo</li><li>Storyboard com aprovação por tomada e modo avançado em nós</li><li>Montagem multitrilha, exportação em 1080p e upscale até 4K</li><li>Créditos, escolha de modelo por etapa, GPU por hora e GPU própria via app de desktop</li><li>Landing com lista de espera e consentimento pela LGPD</li></ul></div>
			<div class="now"><span class="art-label">No ar, em beta</span><ul><li>Origami Assistant, com canais, histórico e desfazer</li><li>Smart Engine, que escolhe como filmar cada tomada</li><li>O custo em minutos de filme para cada qualidade</li></ul></div>
			<div class="next"><span class="art-label">Próximo</span><ul><li>Abrir o beta para a lista de espera, aos poucos</li><li>Os primeiros projetos de roteiristas e estúdios de fora</li><li>Tirar Origami e Smart Engine do beta com o que eles ensinarem</li></ul></div>
		</div>
		<?php
		break;

	case 'pp-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label">O que eu manteria</span><ul><li>Fazer do storyboard a porta do vídeo. Uma regra de fluxo mudou a conta do projeto inteiro</li><li>Usar o produto para fazer o produto: os episódios de exemplo acharam mais furos do que qualquer teste</li></ul></div>
			<div class="alt"><span class="art-label">O que eu mudaria</span><ul><li>Desenhar a camada do motor (créditos, GPU por hora, GPU própria) antes da primeira tela de geração, e não depois</li><li>Colocar roteiristas de fora dentro do estúdio mais cedo, antes de polir a landing</li></ul></div>
		</div>
		<?php
		break;

	case 'pp-signals':
		?>
		<div class="pp-learn">
			<div><h3>Fundar sozinho com IA muda o gargalo.</h3><p>O gargalo deixa de ser fazer e vira decidir. Quando uma tela custa uma tarde, o trabalho de design passa a ser escolher o que não construir.</p></div>
			<div><h3>Consistência é produto, não prompt.</h3><p>Personagem que não muda de cara não vem de um prompt melhor. Vem de uma ficha que viaja com o projeto e entra em todo pedido, sem a pessoa precisar lembrar.</p></div>
			<div><h3>O preço é parte da interface.</h3><p>Em IA generativa, mostrar o custo na hora da decisão importa tanto quanto mostrar o resultado. Todo botão do Paperplane diz quanto custa antes de gerar.</p></div>
			<div><h3>Ainda falta provar: quem troca oito abas por uma?</h3><p>A aposta é que roteiristas, creators e estúdios pequenos preferem um estúdio inteiro a um quebra-cabeça. A lista de espera é o primeiro sinal; o beta aberto é a prova.</p></div>
		</div>
		<?php
		break;

endswitch;
