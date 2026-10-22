<?php
/**
 * Artifacts — Paperplane Studio (own product, solo founder, in beta).
 * Screens are recreations in code; projects, characters and lines come from the sample
 * episodes; prices and times are illustrative.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

switch ( $args['name'] ) :

	case 'pp-glance':
		?>
		<dl class="glance">
			<div><dt>Empresa</dt><dd>Paperplane Studio · produto próprio, fundado solo</dd></div>
			<div><dt>Meu papel</dt><dd>Fundador · pesquisa, produto, design e construção, tudo com IA</dd></div>
			<div><dt>Para quem</dt><dd>Roteiristas, creators e estúdios pequenos que contam histórias com IA</dd></div>
			<div><dt>Status</dt><dd>Beta fechado · lista de espera aberta, convites aos poucos</dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label">O que eu construí</dt><ul><li>O estúdio em 10 etapas, da ideia à montagem</li><li>Roteiro em formato de cinema, com um assistente de IA</li><li>Elenco com ficha em quatro vistas e voz própria</li><li>Decupagem e storyboard aprovados antes de animar</li><li>Montagem multitrilha com upscale até 4K</li><li>Um roteador de modelos de imagem, vídeo e voz</li><li>Três jeitos de pagar: créditos, GPU por hora, GPU própria</li><li>A landing e dois episódios feitos no próprio produto</li></ul></div>
		<?php
		break;

	case 'pp-scatter':
		$tools = array(
			array( 'Roteiro', 'Editor de texto' ),
			array( 'Referências', 'Mural de imagens' ),
			array( 'Personagens', 'Gerador de imagem' ),
			array( 'Storyboard', 'Planilha e prints' ),
			array( 'Vídeo', 'Gerador de vídeo' ),
			array( 'Vozes', 'Gerador de voz' ),
			array( 'Montagem', 'Editor de vídeo' ),
			array( 'Upscale', 'Programa à parte' ),
		);
		$hops  = array( 'copia · cola', 'baixa · sobe', 'print · planilha', 'reescreve o prompt', 'exporta · importa', 'baixa · sobe', 'exporta de novo' );
		?>
		<div class="art-panel pp-scatter">
			<span class="art-label">Um minuto de filme, hoje</span>
			<span class="art-title">Oito ferramentas, sete viagens de arquivo, e nenhuma lembra o que a anterior fez.</span>
			<ol class="pp-chain">
				<?php foreach ( $tools as $i => $t ) : ?>
					<li class="pp-tool" style="--i:<?php echo (int) $i; ?>"><span class="pp-tool-n"><?php printf( '%02d', $i + 1 ); ?></span><b><?php echo esc_html( $t[0] ); ?></b><span><?php echo esc_html( $t[1] ); ?></span><?php if ( isset( $hops[ $i ] ) ) : ?><em class="pp-hop"><?php echo esc_html( $hops[ $i ] ); ?></em><?php endif; ?></li>
				<?php endforeach; ?>
			</ol>
			<div class="pp-one">
				<span class="art-label">No Paperplane</span>
				<div class="pp-one-bar"><span>Ideia</span><span>Universo</span><span>Roteiro</span><span>Estilo</span><span>Elenco</span><span>Cenários</span><span>Decupagem</span><span>Storyboard</span><span>Animação</span><span>Montagem · 4K</span></div>
				<p>Um projeto, uma janela. O roteiro, o elenco e cada quadro aprovado viajam juntos até a exportação.</p>
			</div>
		</div>
		<?php
		break;

	case 'pp-pains':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label">Continuidade</span><h4>O personagem muda de cara a cada plano</h4><p>Cada gerador começa do zero. Sem uma ficha que viaje com o projeto, a protagonista da cena 1 não é a mesma da cena 8, e o figurino troca sozinho no meio da história.</p></div>
			<div class="art-card"><span class="art-label">Dispersão</span><h4>O roteiro não conversa com a imagem</h4><p>Roteiro, decupagem e storyboard moram em lugares diferentes. Aprovar com um cliente vira uma pasta de prints e uma planilha de planos, montada à mão, que fica velha na primeira alteração.</p></div>
			<div class="art-card"><span class="art-label">Custo cego</span><h4>Paga-se para descobrir que o plano não funcionava</h4><p>Vídeo é a parte cara, e quase tudo cobra por geração. Sem aprovar o quadro antes, gasta-se crédito animando a ideia errada, no modelo e no preço que a plataforma escolheu.</p></div>
		</div>
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
			array( 'Rodar na própria GPU', 'n', 'f', 'n', 'h' ),
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
								<td<?php echo 4 === $k ? ' class="is-pp"' : ''; ?>><i class="pp-dot is-<?php echo esc_attr( $r[ $k ] ); ?>" role="img" aria-label="<?php echo esc_attr( $lbl[ $r[ $k ] ] ); ?>"></i><?php echo ( 4 === $k && 'h' === $r[ $k ] ) ? '<small>em pesquisa</small>' : ''; ?></td>
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
			<p>Sua ideia deveria virar filme sem precisar de uma equipe de 50 pessoas. <em>Da primeira frase ao 4K, num estúdio só.</em></p>
			<span class="by">O Paperplane começa por uma frase e termina num episódio montado. No meio, tudo o que um estúdio faz: universo, roteiro, elenco, cenários, decupagem, storyboard, animação e montagem, ligados ao mesmo projeto. A IA faz o trabalho pesado; a palavra final é sempre de quem dirige.</span>
		</div>
		<?php
		break;

	case 'pp-principles':
		?>
		<div class="decisions">
			<div><i>01</i><div><b>O roteiro manda</b><span>Tudo nasce do texto. O Paperplane lê o roteiro, encontra os personagens, quebra as cenas em tomadas e só então gera imagem. Mudou a cena, o resto do projeto sabe.</span></div></div>
			<div><i>02</i><div><b>Imagem barata antes de vídeo caro</b><span>Um quadro custa centavos; um vídeo, dólares. O storyboard é a etapa de aprovação, e só vira vídeo o que já foi aprovado como imagem.</span></div></div>
			<div><i>03</i><div><b>O elenco é um contrato</b><span>Cada personagem tem ficha em quatro vistas, figurino fixo e voz própria, e entra em todo pedido de imagem. Na cena 1 ou na cena 80, a Hana continua sendo a Hana.</span></div></div>
			<div><i>04</i><div><b>O motor é escolha, não prisão</b><span>Quem dirige escolhe o modelo de cada etapa e quem paga a GPU: créditos, uma GPU alugada por hora ou a própria placa. O estúdio é o mesmo; muda só o motor.</span></div></div>
		</div>
		<?php
		break;

	case 'pp-acts':
		$acts = array(
			array(
				'Escrever',
				array(
					array( 'Ideia', 'Uma frase vira título, formato e duração' ),
					array( 'Universo', 'Tom, lugar e as regras que o roteiro respeita' ),
					array( 'Roteiro', 'Cena por cena, em formato de cinema' ),
				),
			),
			array(
				'Visualizar',
				array(
					array( 'Estilo', 'Traço e paleta presos do início ao fim' ),
					array( 'Personagens', 'Ficha em quatro vistas e voz própria' ),
					array( 'Cenários', 'Cada lugar, de qualquer ângulo' ),
					array( 'Decupagem', 'A cena vira tomadas, com plano e motivo' ),
					array( 'Storyboard', 'Um quadro por tomada, aprovado antes de animar', 'gate' ),
				),
			),
			array(
				'Filmar',
				array(
					array( 'Animação', 'O quadro aprovado ganha movimento e voz' ),
					array( 'Montagem', 'Linha do tempo multitrilha e upscale até 4K' ),
				),
			),
		);
		$n = 0;
		?>
		<div class="pp-acts">
			<?php foreach ( $acts as $ai => $a ) : ?>
				<div class="pp-act<?php echo 1 === $ai ? ' is-mid' : ''; ?>">
					<div class="pp-act-h"><span class="art-label">Ato <?php echo (int) ( $ai + 1 ); ?></span><h4><?php echo esc_html( $a[0] ); ?></h4><span class="pp-act-c"><?php echo count( $a[1] ); ?> etapas</span></div>
					<ol>
						<?php foreach ( $a[1] as $s ) : ?>
							<?php $n++; ?>
							<li<?php echo isset( $s[2] ) ? ' class="is-gate"' : ''; ?>><span class="pp-act-i"><?php printf( '%02d', $n ); ?></span><b><?php echo esc_html( $s[0] ); ?></b><span><?php echo esc_html( $s[1] ); ?></span><?php echo isset( $s[2] ) ? '<em>a porta do vídeo</em>' : ''; ?></li>
						<?php endforeach; ?>
					</ol>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		break;

	case 'pp-consist':
		?>
		<div class="steps3">
			<div><h4>Estilo preso</h4><p>Das referências que a pessoa sobe saem regras de traço, proporção, acabamento e paleta. Elas entram em todo pedido, e trocar o estilo redesenha os quadros sem mexer no elenco, nos lugares e nos planos.</p></div>
			<div><h4>Ficha em quatro vistas</h4><p>Frente, três quartos, perfil e costas, com figurino fixo e uma descrição de aparência que não muda. O gerador recebe a ficha em vez de adivinhar a pessoa a partir de um prompt.</p></div>
			<div><h4>Continuidade conferida</h4><p>Cada pedido carrega o quadro anterior e o que não pode aparecer (“Dante NÃO está de chapéu”). No storyboard, um botão confere luz, figurino e objetos entre tomadas antes de qualquer vídeo.</p></div>
		</div>
		<?php
		break;

	case 'pp-engines':
		?>
		<div class="pp-engines">
			<article class="pp-way">
				<div class="pp-way-vis">
					<div class="pp-cred"><svg viewBox="0 0 120 120" aria-hidden="true"><circle cx="60" cy="60" r="50" fill="none" stroke="rgba(26,26,26,.12)" stroke-width="8"/><circle cx="60" cy="60" r="50" fill="none" stroke="#1A1A1A" stroke-width="8" stroke-linecap="round" stroke-dasharray="314" stroke-dashoffset="90" transform="rotate(-90 60 60)"/></svg><div><b>4:12</b><span>min de vídeo</span></div></div>
					<div class="pp-cred-rows"><div><span>Econômica</span><i style="--w:100%"></i></div><div><span>Equilibrada</span><i style="--w:62%"></i></div><div><span>Máxima</span><i style="--w:28%"></i></div></div>
				</div>
				<span class="art-label">01 · Créditos</span><h4>Paga só pelo que gerar</h4><p>O saldo mostra quantos minutos de filme ele rende em cada qualidade, e todo botão diz o preço antes de gerar.</p>
			</article>
			<article class="pp-way">
				<div class="pp-way-vis">
					<div class="pp-mp"><div class="pp-mp-h"><span>Gerador de vídeo</span><span>cena 3</span></div><div class="on"><span>LTX-2.5 Pro</span><em>equilíbrio</em></div><div><span>Kling</span><em>movimento</em></div><div><span>Seedance</span><em>rápido</em></div><div><span>MiniMax</span><em>econômico</em></div></div>
				</div>
				<span class="art-label">02 · O modelo de cada etapa</span><h4>Quem gera é escolha de quem dirige</h4><p>Imagem, vídeo e voz podem vir de modelos diferentes em cada projeto, ou em cada cena: Nano Banana, GPT Image, FLUX, Seedance, Kling, LTX e companhia.</p>
			</article>
			<article class="pp-way">
				<div class="pp-way-vis">
					<div class="pp-gpu"><div class="pp-gpu-h"><i></i><span>GPU online</span><small>H100 · 80 GB</small></div><b>00:42:17</b><div class="pp-gpu-bars" aria-hidden="true"><?php for ( $i = 0; $i < 24; $i++ ) : ?><i style="height:<?php echo (int) ( 30 + abs( sin( $i * 1.3 ) ) * 60 ); ?>%"></i><?php endfor; ?></div><div class="pp-gpu-f"><span>Cobrança por hora</span><span>sem custo por geração</span></div></div>
				</div>
				<span class="art-label">03 · GPU por hora</span><h4>Liga, gera à vontade, desliga</h4><p>Uma GPU na nuvem só para o projeto. Paga-se o tempo ligada, não cada imagem. Para sessões longas de storyboard e animação, a conta muda de ordem de grandeza.</p>
			</article>
			<article class="pp-way is-own">
				<div class="pp-way-vis">
					<div class="pp-gpu is-local"><div class="pp-gpu-h"><i></i><span>Sua GPU</span><small>conectada</small></div><b>RTX 4090</b><div class="pp-gpu-spec"><span>24 GB de VRAM</span><span>setup mínimo</span></div><div class="pp-gpu-f"><span>App de desktop</span><span>custo por geração: zero</span></div></div>
				</div>
				<span class="art-label">04 · A sua própria GPU <em class="pp-soon">em pesquisa</em></span><h4>O estúdio, rodando na sua placa</h4><p>Quem já tem uma placa de vídeo forte não deveria pagar de novo para gerar. A ideia é conectar a GPU da pessoa ao mesmo estúdio, com o mesmo fluxo de fichas e storyboard.</p>
			</article>
		</div>
		<?php
		break;

	case 'pp-gpu-map':
		?>
		<div class="pp-map">
			<div class="pp-map-grid">
				<div class="pp-stack">
					<div class="pp-node"><span class="art-label">Quem dirige</span><h4>O estúdio, na web e no celular</h4><p>As dez etapas, o Origami e o preço de cada botão. A interface não muda com o motor.</p></div>
					<div class="pp-node"><span class="art-label">O projeto</span><h4>Roteiro, elenco e quadros</h4><p>A ficha de cada personagem, o estilo e o quadro anterior entram em todo pedido.</p></div>
				</div>
				<div class="pp-arrow" aria-hidden="true"><small>pedido · etapa</small></div>
				<div class="pp-node is-core"><span class="art-label">A camada do motor</span><h4>Roteador de modelos</h4><p>Monta o pedido, escolhe quem gera imagem, vídeo e voz em cada etapa e mostra o custo antes. Trocar de motor não muda o projeto.</p></div>
				<div class="pp-arrow" aria-hidden="true"><small>gera · devolve</small></div>
				<div class="pp-stack">
					<div class="pp-node"><span class="art-label">Créditos</span><h4>APIs dos modelos</h4><p>Paga por geração, no modelo que a pessoa escolheu.</p></div>
					<div class="pp-node"><span class="art-label">Por hora</span><h4>GPU na nuvem</h4><p>Uma máquina só do projeto, cobrada pelo tempo ligada.</p></div>
					<div class="pp-node is-next"><span class="art-label">Próximo</span><h4>A GPU de quem usa</h4><p>Um app de desktop conecta a placa ao estúdio. Requisito mínimo: algo como uma RTX 4090, 24 GB.</p></div>
				</div>
			</div>
			<div class="pp-map-foot"><span>Claude</span><span>Nano Banana</span><span>GPT Image</span><span>FLUX</span><span>Seedream</span><span>Seedance</span><span>Kling</span><span>LTX</span><span>MiniMax</span><span>Wan</span><span>ElevenLabs</span><span>Muse</span></div>
		</div>
		<?php
		break;

	case 'pp-lab':
		?>
		<div class="pp-lab">
			<div class="pp-lab-card">
				<div class="pp-lab-top"><span class="pp-beta">Beta</span><span class="art-label">Origami Assistant</span></div>
				<h4>Um ajudante de bastidor em todo o estúdio</h4>
				<p>Pede-se do jeito que vier. Ele mostra o antes e o depois, aplica com um clique e guarda tudo, com um canal para cada etapa.</p>
				<div class="pp-ori">
					<div class="pp-ori-ch"><span class="art-label">A estação sem nome</span><div class="on"># roteiro<b>12</b></div><div># elenco<b>4</b></div><div># storyboard<b>9</b></div><div># montagem<b>2</b></div></div>
					<div class="pp-ori-hist"><span class="art-label">Histórico</span><div><b>Elenco · Lia</b><span>Ficha refeita com o casaco molhado</span><em>ontem</em></div><div><b>Storyboard · 3F</b><span>Take #1.2 aprovado</span><em>ontem</em></div><div><b>Universo</b><span>Nova regra: sempre é noite lá fora</span><em>seg</em></div><div class="pp-ori-ok">✓ Mudança aplicada · guardada no histórico</div></div>
				</div>
			</div>
			<div class="pp-lab-card">
				<div class="pp-lab-top"><span class="pp-beta">Beta</span><span class="art-label">Smart Engine</span></div>
				<h4>Vídeo gerado só onde a cena pede</h4>
				<p>Ligado na decupagem, ele decide como filmar cada tomada. No resto, truques clássicos de cinema que custam quase nada.</p>
				<div class="pp-smart">
					<?php
					$takes = array(
						array( 'freio', '3A', 'O trem freia de repente', 'Plano geral · 6 s', 'Vídeo gerado', 'v' ),
						array( 'hana-plat', '3B', 'Hana espera na plataforma', 'Plano geral · 5 s', 'Imagem + câmera', 'p' ),
						array( 'close', '3C', 'Lia: “Ainda dá tempo.”', 'Close · 4 s · fala', 'Rosto falando', 'f' ),
						array( 'ombro', '3D', 'Dante de costas, Lia escuta', 'Sobre o ombro · 5 s', 'Reação', 'r' ),
						array( 'xicara', '3E', 'A xícara treme na mesa', 'Detalhe · 3 s', 'Imagem + zoom', 'p' ),
					);
					foreach ( $takes as $t ) :
						?>
						<div class="pp-smart-r">
							<?php echo sera_pp_frame( $t[0], 'width:62px;height:36px;flex:none;border-radius:4px' ); // phpcs:ignore ?>
							<div><b><?php echo esc_html( $t[1] ); ?></b> <?php echo esc_html( $t[2] ); ?><span><?php echo esc_html( $t[3] ); ?></span></div>
							<em class="is-<?php echo esc_attr( $t[5] ); ?>"><?php echo esc_html( $t[4] ); ?></em>
						</div>
					<?php endforeach; ?>
					<div class="pp-smart-cost"><div><span>Tudo em vídeo</span><i><em style="width:100%"></em></i><b>US$ 4,80</b></div><div><span>Smart engine</span><i><em class="lime" style="width:24%"></em></i><b>US$ 1,15</b></div></div>
				</div>
			</div>
		</div>
		<p class="art-cap">Valores ilustrativos de uma cena de cinco tomadas, para mostrar a ordem de grandeza.</p>
		<?php
		break;

	case 'pp-solo':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label">Produto e código</span><h4>Uma conversa no lugar de uma equipe</h4><p>O Paperplane é vibe coded. Eu descrevo a tela, a regra e o porquê; a IA escreve; eu testo, corto e peço de novo. Construir uma tela leva uma tarde, então dá para jogar fora sem dó.</p></div>
			<div class="art-card"><span class="art-label">Comer a própria comida</span><h4>O produto fez o próprio material</h4><p>Os dois episódios de exemplo, “Sem Partidas” e “A estação sem nome”, foram produzidos no Paperplane. Foram a melhor demo e o teste mais duro: cada furo da história virou um ajuste no produto.</p></div>
			<div class="art-card"><span class="art-label">O que fica comigo</span><h4>Decidir continua sendo o trabalho</h4><p>O que o estúdio mostra, quanto cada botão custa e o que chega a quem usa. A IA acelerou o fazer quase até zero; saber o que deveria existir continua levando o tempo que leva.</p></div>
		</div>
		<?php
		break;

	case 'pp-status':
		?>
		<div class="pp-status">
			<div><span class="art-label">Funcionando</span><ul><li>As dez etapas, da ideia à montagem, no computador e no celular</li><li>Roteiro com o Origami, elenco em quatro vistas e cenários de qualquer ângulo</li><li>Storyboard com aprovação por tomada e modo avançado em nós</li><li>Montagem multitrilha, exportação em 1080p e upscale até 4K</li><li>Créditos, escolha de modelo por etapa e GPU por hora</li><li>Landing com lista de espera e consentimento pela LGPD</li></ul></div>
			<div class="now"><span class="art-label">Em ajuste · beta</span><ul><li>Origami Assistant, com canais, histórico e desfazer</li><li>Smart Engine, que escolhe como filmar cada tomada</li><li>O custo em minutos de filme para cada qualidade</li></ul></div>
			<div class="next"><span class="art-label">Próximo</span><ul><li>Conectar a GPU própria por um app de desktop</li><li>Abrir o beta para a lista de espera, aos poucos</li><li>Os primeiros projetos de roteiristas e estúdios de fora</li></ul></div>
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
			<div><h3>Ainda falta provar: quem troca oito ferramentas por uma?</h3><p>A aposta é que roteiristas, creators e estúdios pequenos preferem um estúdio inteiro a um quebra-cabeça. A lista de espera é o primeiro sinal; o beta aberto é a prova.</p></div>
		</div>
		<?php
		break;

	case 'pp-coldopen':
		// One sentence typed at the top, the episode it became rolling underneath (A estação sem nome).
		$roll = array(
			array( 'n-c5b568cf', '1A' ),
			array( 'n-716c2a5a', '2A' ),
			array( 'n-28767caf', '2C' ),
			array( 'sb-a', '3A' ),
			array( 'sb-b', '3B' ),
			array( 'sb-d', '3C' ),
			array( 'sb-e', '3D' ),
			array( 'n-4f6f962b', '4E' ),
			array( 'n-dbccf7a7', '5B' ),
			array( 'n-64e0721f', '8A' ),
			array( 'n-8eebb5ec', '8C' ),
		);
		?>
		<div class="pp-cold">
			<div class="pp-cold-top">
				<span class="art-label">Cena 0 · antes do case</span>
				<p class="pp-cold-line"><span class="pp-cold-q">“</span>Uma garçonete de trem noturno descobre que o passageiro da mesa 4 sabe exatamente como ela vai morrer.<i class="pp-cold-caret" aria-hidden="true"></i></p>
				<span class="pp-cold-arrow"><b>Uma frase</b><i aria-hidden="true"></i><b>Um episódio</b></span>
			</div>
			<div class="pp-reel" role="img" aria-label="Onze quadros do episódio A estação sem nome, da plataforma ao vagão-restaurante, todos gerados no Paperplane a partir da frase acima">
				<div class="pp-reel-track">
					<?php for ( $loop = 0; $loop < 2; $loop++ ) : ?>
						<?php foreach ( $roll as $r ) : ?>
							<figure class="pp-reel-f"<?php echo $loop ? ' aria-hidden="true"' : ''; ?>><img src="<?php echo sera_pp_src( $r[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><figcaption><b><?php echo esc_html( $r[1] ); ?></b></figcaption></figure>
						<?php endforeach; ?>
					<?php endfor; ?>
				</div>
			</div>
			<div class="pp-cold-foot"><span><b>A estação sem nome</b> · episódio 1 · 8 cenas · 2:23</span><span>Isto aqui já foi só uma frase. Cada quadro desta página nasceu no Paperplane.</span></div>
		</div>
		<?php
		break;

	case 'pp-cast':
		$views = array( array( 'ren-frente', 'Frente' ), array( 'ren-34', 'Três quartos' ), array( 'ren-perfil', 'Perfil' ), array( 'ren-costas', 'Costas' ) );
		$lia   = array( array( 'sb-a', '3A · Plano médio' ), array( 'sb-b', '3B · Close' ), array( 'sb-d', '3C · Sobre o ombro' ), array( 'n-4f6f962b', '4E · Close' ) );
		?>
		<div class="pp-cast">
			<div class="pp-cast-sheet">
				<div class="pp-cast-h"><span class="art-label">A ficha · Sem Partidas</span><h4>Ren, em quatro vistas</h4></div>
				<div class="pp-cast-views">
					<?php foreach ( $views as $v ) : ?>
						<figure><img src="<?php echo sera_pp_src( $v[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><figcaption><?php echo esc_html( $v[1] ); ?></figcaption></figure>
					<?php endforeach; ?>
				</div>
				<p>Rapaz de 19 anos, rosto fino e olhar desconfiado. Jaqueta escura de gola, camiseta verde-escura, botas marrons. <b>Isso não muda.</b></p>
			</div>
			<div class="pp-cast-shots">
				<div class="pp-cast-h"><span class="art-label">A mesma pessoa · A estação sem nome</span><h4>Cena 3 ou cena 80, a Lia continua sendo a Lia.</h4></div>
				<div class="pp-cast-grid">
					<?php foreach ( $lia as $l ) : ?>
						<figure><img src="<?php echo sera_pp_src( $l[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><figcaption><?php echo esc_html( $l[1] ); ?></figcaption></figure>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<p class="art-cap">Quadros e fichas gerados no Paperplane para os dois episódios de exemplo. Planos, luz e lugar mudam; rosto, cabelo e figurino ficam.</p>
		<?php
		break;

	case 'pp-styles':
		$deck = array(
			array( 'ns-2d-sombrio', 'Drama 2D sombrio' ),
			array( 'ns-live-action-de-drama', 'Drama live action' ),
			array( 'ns-preto-e-branco-dos-anos-60', 'Noir anos 60' ),
			array( 'ns-sci-fi-ambicioso', 'Sci-fi épico' ),
			array( 'ns-sitcom-nostalgico', 'Sitcom anos 90' ),
			array( 'ns-stop-motion', 'Stop motion' ),
		);
		?>
		<div class="pp-styles">
			<div class="pp-styles-copy">
				<span class="art-label">Biblioteca de estilos</span>
				<h4>Feitiço <mark>trocou.</mark><br>História <mark>ficou.</mark></h4>
				<p>Escolha um traço da biblioteca ou ensine um novo com algumas imagens. Ele vira regra do projeto e entra em todo pedido.</p>
			</div>
			<ol class="pp-deck">
				<?php foreach ( $deck as $i => $d ) : ?>
					<li style="--i:<?php echo (int) $i; ?>"><img src="<?php echo sera_pp_src( $d[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><span><?php echo esc_html( $d[1] ); ?></span></li>
				<?php endforeach; ?>
			</ol>
		</div>
		<?php
		break;

	case 'pp-made':
		$eps = array(
			array(
				'Sem Partidas',
				'Hana corre pela plataforma e perde o último trem. No banco escuro, Ren já estava lá.',
				array( array( 'v-placa', '1A' ), array( 'v-corrida', '1B' ), array( 'v-banco', '1C' ), array( 'v-close', '1E' ), array( 'v-encontro', '2A' ) ),
				array( array( 'hana', 'Hana' ), array( 'ren', 'Ren' ), array( 'okabe', 'Sr. Okabe' ), array( 'bilh', 'Bilheteiro' ) ),
			),
			array(
				'A estação sem nome',
				'Uma garçonete de trem noturno descobre que o passageiro da mesa 4 sabe exatamente como ela vai morrer.',
				array( array( 'n-716c2a5a', '2A' ), array( 'n-9d3e32ea', '2D' ), array( 'v-mesa', '3C' ), array( 'v-vagao', '3F' ), array( 'n-dbccf7a7', '5B' ) ),
				array(),
			),
		);
		?>
		<div class="pp-made">
			<?php foreach ( $eps as $n => $e ) : ?>
				<div class="pp-ep">
					<div class="pp-ep-h"><span class="art-label">Episódio de exemplo · <?php printf( '%02d', $n + 1 ); ?></span><h4><?php echo esc_html( $e[0] ); ?></h4><p><?php echo esc_html( $e[1] ); ?></p></div>
					<div class="pp-ep-strip">
						<?php foreach ( $e[2] as $f ) : ?>
							<figure><img src="<?php echo sera_pp_src( $f[0] ); // phpcs:ignore ?>" alt="" loading="lazy" decoding="async"><figcaption>Tomada <?php echo esc_html( $f[1] ); ?></figcaption></figure>
						<?php endforeach; ?>
					</div>
					<?php if ( $e[3] ) : ?>
						<div class="pp-ep-cast"><span class="art-label">Elenco</span>
							<?php foreach ( $e[3] as $c ) : ?>
								<span class="pp-ep-p"><?php echo sera_pp_portrait( $c[0] ); // phpcs:ignore ?><?php echo esc_html( $c[1] ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		break;

endswitch;
