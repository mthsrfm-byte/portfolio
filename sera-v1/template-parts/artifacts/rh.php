<?php
/**
 * Artifacts — Pagaleve · Research Hub.
 * Screens are recreations with fictional studies, insights and quotes:
 * Pagaleve's real findings, totals and internal data are confidential: none appear here.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'sera_rh_img' ) ) {
	/**
	 * Theme image from assets/img/rh/.
	 */
	function sera_rh_img( $file, $alt, $w, $h, $class = '' ) {
		return sprintf(
			'<img src="%s" alt="%s" width="%d" height="%d" loading="lazy" decoding="async"%s>',
			esc_url( get_template_directory_uri() . '/assets/img/rh/' . $file . '?v=' . SERA_VERSION ),
			esc_attr( $alt ),
			(int) $w,
			(int) $h,
			$class ? ' class="' . esc_attr( $class ) . '"' : ''
		);
	}
}

if ( ! function_exists( 'sera_rh_frame' ) ) {
	/**
	 * A recreated desktop screen in a browser frame that scales to the column.
	 */
	function sera_rh_frame( $html, $label ) {
		return '<div class="rh-fit">' . sera_browser( $html, array( 'url' => sera_t( 'research-hub · internal', 'research-hub · interno' ), 'label' => $label ) ) . '</div>';
	}
}

if ( ! function_exists( 'sera_timeline' ) ) {
	/**
	 * One timeline component shared by the case pages (.tl, styled per case CSS).
	 * Each step: array( title, description, meta, flags ) where flags may hold
	 * 'key' (the step the highlight travels to) and 'you' (a human's turn).
	 */
	function sera_timeline( $steps ) {
		$n   = count( $steps );
		$key = 0;
		foreach ( $steps as $i => $s ) {
			if ( false !== strpos( $s[3] ?? '', 'key' ) ) {
				$key = $i;
			}
		}
		$h = sprintf( '<div class="tl mk-anim" style="--n:%d;--tl-step:%ss"><ol class="tl-list">', $n, rtrim( rtrim( number_format( 1.4 / max( 1, $n - 1 ), 3, '.', '' ), '0' ), '.' ) );
		foreach ( $steps as $i => $s ) {
			$flags = $s[3] ?? '';
			$cls   = 'tl-step';
			$cls  .= $i < $key ? ' is-path' : '';
			$cls  .= $i === $key ? ' is-key' : '';
			$cls  .= false !== strpos( $flags, 'you' ) ? ' is-you' : '';
			$h    .= sprintf(
				'<li class="%s" style="--i:%d"><span class="tl-mark" aria-hidden="true"></span><span class="tl-idx">%02d</span><h4 class="tl-title">%s</h4><p class="tl-desc">%s</p>%s</li>',
				esc_attr( $cls ),
				$i,
				$i + 1,
				esc_html( $s[0] ),
				esc_html( $s[1] ),
				$s[2] ? '<span class="tl-meta">' . esc_html( $s[2] ) . '</span>' : ''
			);
		}
		return $h . '</ol></div>';
	}
}

switch ( $args['name'] ) :

	case 'rh-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'Pagaleve, a Brazilian buy-now-pay-later fintech', 'Pagaleve, fintech brasileira de compre agora, pague depois (BNPL)' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Specialist Product Designer · concept, design and build', 'Product Designer Especialista · conceito, design e construção' ); ?></dd></div>
			<div><dt><?php sera_e( 'Users', 'Quem usa' ); ?></dt><dd><?php sera_e( 'The Product Design chapter and anyone at Pagaleve', 'O chapter de Product Design e qualquer pessoa da Pagaleve' ); ?></dd></div>
			<div><dt><?php sera_e( 'Credits', 'Créditos' ); ?></dt><dd><?php sera_e( 'Requested by design leadership · built with help from the team', 'Pedido pela liderança de design · construído com a ajuda do time' ); ?></dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label"><?php sera_e( 'What I built', 'O que eu construí' ); ?></dt><ul><li><?php sera_e( 'Research Hub (Lovable)', 'Research Hub (Lovable)' ); ?></li><li><?php sera_e( 'The hub’s MCP server', 'O servidor MCP do hub' ); ?></li><li><?php sera_e( 'A Claude skill for end-to-end research', 'Uma skill do Claude para pesquisa de ponta a ponta' ); ?></li><li><?php sera_e( 'Ask-the-archive chat with sources', 'Um chat com o acervo, com fontes' ); ?></li><li><?php sera_e( 'One report format', 'Um formato único de relatório' ); ?></li><li><?php sera_e( 'A guide that gets people started', 'Um guia para ninguém travar no começo' ); ?></li><li><?php sera_e( 'A Claude connector for the whole company', 'Um conector do Claude para a empresa toda' ); ?></li><li><?php sera_e( 'An AI research roadmap that ships to Jira', 'Um roadmap com IA que cai direto no Jira' ); ?></li><li><?php sera_e( 'LGPD guardrails by default', 'Proteções de LGPD por padrão' ); ?></li></ul></div>
		<?php
		break;

	case 'rh-failures':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label"><?php sera_e( 'Findability', 'Busca' ); ?></span><h4><?php sera_e( 'Nobody could find past studies', 'Ninguém achava os estudos antigos' ); ?></h4><p><?php sera_e( 'Answers were buried in slide 27 of a deck whose name you had to remember.', 'As respostas estavam enterradas no slide 27 de um deck cujo nome você precisava lembrar.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Repeatability', 'Método' ); ?></span><h4><?php sera_e( 'Every study started from zero', 'Todo estudo começava do zero' ); ?></h4><p><?php sera_e( 'No shared process and no shared format. Quality depended on who ran it.', 'Sem processo nem formato em comum. A qualidade dependia de quem conduzia.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Safety', 'Segurança' ); ?></span><h4><?php sera_e( 'Personal data next to the slides', 'Dado pessoal do lado dos slides' ); ?></h4><p><?php sera_e( 'Protection depended on someone remembering to lock a file.', 'A proteção dependia de alguém lembrar de trancar um arquivo.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'rh-statement':
		?>
		<div class="statement">
			<span class="art-label"><?php sera_e( 'The principle behind every decision', 'O princípio por trás de cada decisão' ); ?></span>
			<p><?php sera_e( 'Repositories die because publishing is extra work. So publishing became <em>the last step of doing research</em>, done by the same tool that runs the study.', 'Repositórios morrem porque publicar dá trabalho extra. Então publicar virou <em>o último passo da própria pesquisa</em>, feito pela mesma ferramenta que conduz o estudo.' ); ?></p>
		</div>
		<?php
		break;

	case 'rh-principles':
		?>
		<div class="decisions">
			<div><i>01</i><div><b><?php sera_e( 'Zero extra work to publish', 'Zero trabalho extra para publicar' ); ?></b><span><?php sera_e( 'The archive fills itself as a by-product of running a study, straight from the Drive folder or from the skill.', 'O acervo se enche sozinho, como consequência de fazer o estudo, direto da pasta do Drive ou pela skill.' ); ?></span></div></div>
			<div><i>02</i><div><b><?php sera_e( 'Every answer shows its source', 'Toda resposta mostra de onde veio' ); ?></b><span><?php sera_e( 'Nothing the hub says is unsourced. Each claim links to its study, so anyone can check it.', 'Nada do que o hub diz fica sem fonte. Cada afirmação leva ao seu estudo, então qualquer pessoa pode conferir.' ); ?></span></div></div>
			<div><i>03</i><div><b><?php sera_e( 'One shape for every study', 'Um formato para todo estudo' ); ?></b><span><?php sera_e( 'The same six sections every time, so a usability test and a survey can be compared at a glance.', 'As mesmas seis seções, sempre, para dar para comparar um teste de usabilidade e um survey num relance.' ); ?></span></div></div>
			<div><i>04</i><div><b><?php sera_e( 'Findings open, personal data locked', 'Achados abertos, dado pessoal trancado' ); ?></b><span><?php sera_e( 'Findings are for everyone. The people behind them aren’t. The system enforces the difference, so nobody has to remember it.', 'Os achados são de todo mundo. As pessoas por trás deles, não. O sistema garante essa diferença, e ninguém precisa lembrar dela.' ); ?></span></div></div>
		</div>
		<?php
		break;

	case 'rh-system':
		?>
		<div class="rh-map">
			<div class="rh-map-grid">
				<div class="rh-stack">
					<div class="rh-node"><span class="art-label"><?php sera_e( 'Process', 'Processo' ); ?></span><h4><?php sera_e( 'Claude skill', 'Skill do Claude' ); ?></h4><p><?php sera_e( 'Walks any designer from question to report. Reads the archive before a study and publishes the insights after it.', 'Leva qualquer designer da pergunta ao relatório. Lê o acervo antes do estudo e publica os insights depois.' ); ?></p></div>
					<div class="rh-node"><span class="art-label"><?php sera_e( 'Source of truth', 'Fonte da verdade' ); ?></span><h4>Google Drive</h4><p><?php sera_e( 'The team’s research folder, organised by area and study.', 'A pasta de pesquisa do time, organizada por área e por estudo.' ); ?></p></div>
				</div>
				<div class="rh-arrow both" aria-hidden="true"><small><?php sera_e( 'MCP · sync', 'MCP · sync' ); ?></small></div>
				<div class="rh-node is-hub"><span class="art-label"><?php sera_e( 'Product', 'Produto' ); ?></span><h4>Research Hub</h4><p><?php sera_e( 'Built in Lovable, with its own MCP server. Standardised reports, themes tagged on import, a timeline of everything we’ve learned, and privacy rules applied to every file.', 'Feito no Lovable, com servidor MCP próprio. Relatórios padronizados, temas marcados na importação, uma linha do tempo de tudo o que aprendemos e regras de privacidade aplicadas a cada arquivo.' ); ?></p></div>
				<div class="rh-arrow both" aria-hidden="true"><small><?php sera_e( 'ask · cite', 'pergunta · cita' ); ?></small></div>
				<div class="rh-stack">
					<div class="rh-node"><span class="art-label"><?php sera_e( 'Interface', 'Interface' ); ?></span><h4><?php sera_e( 'Ask the archive', 'Pergunte ao acervo' ); ?></h4><p><?php sera_e( 'In the hub’s chat or in anyone’s Claude, through the connector. Every claim links to its study.', 'No chat do hub ou no Claude de qualquer pessoa, pelo conector. Cada afirmação leva ao seu estudo.' ); ?></p></div>
					<div class="rh-node"><span class="art-label"><?php sera_e( 'Looking ahead', 'Daqui para a frente' ); ?></span><h4><?php sera_e( 'Research roadmap', 'Roadmap de pesquisa' ); ?></h4><p><?php sera_e( 'AI turns past findings into next quarter’s studies. The team prioritises, and each study lands in Jira.', 'A IA transforma achados antigos nos estudos do próximo trimestre. O time prioriza, e cada estudo cai no Jira.' ); ?></p></div>
				</div>
			</div>
			<div class="rh-map-foot"><span>Lovable</span><span><?php sera_e( 'Custom MCP server · Claude connector', 'Servidor MCP próprio · conector do Claude' ); ?></span><span><?php sera_e( 'Claude · custom skill', 'Claude · skill própria' ); ?></span><span><?php sera_e( 'REST API', 'API REST' ); ?></span><span>Jira</span><span><?php sera_e( 'Google Drive sync', 'Sync com o Google Drive' ); ?></span><span><?php sera_e( 'Google SSO · company domain only', 'Google SSO · só o domínio da empresa' ); ?></span><span><?php sera_e( 'LGPD guardrails', 'Proteções de LGPD' ); ?></span></div>
		</div>
		<?php
		break;

	case 'rh-home':
		?>
		<figure class="rh-shot is-dark">
			<?php echo sera_rh_frame( sera_scr_rh_home(), sera_t( 'Research Hub home: entry points to ask, connect to Claude and the guide, the published roadmap and the latest studies', 'Home do Research Hub: atalhos para perguntar, conectar ao Claude e abrir o guia, o roadmap publicado e os últimos estudos' ) ); // phpcs:ignore ?>
		</figure>
		<p class="art-cap"><?php sera_e( 'The home. The studies on screen are fictional.', 'A home. Os estudos na tela são fictícios.' ); ?></p>
		<?php
		break;

	case 'rh-import':
		?>
		<figure class="rh-shot is-tint"><?php echo sera_rh_frame( sera_scr_rh_import(), sera_t( 'Import review: each file in a zip shows what it becomes and who can open it, with spreadsheets and recordings locked to the uploader', 'Revisão da importação: cada arquivo do zip mostra o que vai virar e quem pode abrir, com planilhas e gravações trancadas para quem enviou' ) ); // phpcs:ignore ?></figure>
		<p class="art-cap"><?php sera_e( 'The review step. Each file shows what it becomes and who can open it, before anything is published.', 'A etapa de revisão. Cada arquivo mostra o que vai virar e quem pode abrir, antes de qualquer coisa ir para o ar.' ); ?></p>
		<div class="art-grid cols-3" style="margin-top:20px">
			<div class="art-card"><h4><?php sera_e( 'Themes tag themselves', 'Os temas se marcam sozinhos' ); ?></h4><p><?php sera_e( 'Tags are pulled from each study on import, so “most researched themes” is always current.', 'As tags saem de cada estudo na importação, então “temas mais pesquisados” está sempre em dia.' ); ?></p></div>
			<div class="art-card"><h4><?php sera_e( 'A timeline of learning', 'Uma linha do tempo do aprendizado' ); ?></h4><p><?php sera_e( 'Studies are grouped by month, so you can see what the company was curious about, and when.', 'Os estudos ficam agrupados por mês, então dá para ver o que a empresa queria entender, e quando.' ); ?></p></div>
			<div class="art-card"><h4><?php sera_e( 'Open to other tools', 'Aberto a outras ferramentas' ); ?></h4><p><?php sera_e( 'Besides the MCP server, a REST endpoint with a key lets any tool publish a study without opening the hub.', 'Além do servidor MCP, um endpoint REST com chave deixa qualquer ferramenta publicar um estudo sem abrir o hub.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'rh-flow':
		$steps = array(
			array( sera_t( 'Plan', 'Planejar' ), sera_t( 'From a vague question to hypotheses and a script.', 'De uma pergunta vaga a hipóteses e um roteiro.' ), 'Claude' ),
			array( sera_t( 'Review', 'Revisar' ), sera_t( 'Reads similar past studies in the hub, then checks the script for bias.', 'Lê estudos parecidos no hub e depois revisa o roteiro atrás de vieses.' ), sera_t( 'Hub via MCP · read', 'Hub via MCP · leitura' ) ),
			array( sera_t( 'Build the form', 'Montar o formulário' ), sera_t( 'Generates the survey and its links.', 'Gera o questionário e os links.' ), 'Claude' ),
			array( sera_t( 'Send', 'Enviar' ), sera_t( 'Audience, invite and CRM approval. No one gets a third email that day.', 'Base, convite e aprovação do CRM. Ninguém recebe um terceiro e-mail no mesmo dia.' ), sera_t( 'Your turn · send', 'Sua vez · enviar' ), 'you' ),
			array( sera_t( 'Field', 'Campo' ), sera_t( 'Daily scoreboard and auto-close, on a schedule.', 'Placar diário e encerramento automático, tudo agendado.' ), sera_t( 'Scheduled', 'Agendado' ) ),
			array( 'Debrief', sera_t( 'Hypothesis scoreboard and tweet-sized insights.', 'Placar de hipóteses e insights do tamanho de um tweet.' ), 'Claude' ),
			array( sera_t( 'Approve', 'Aprovar' ), sera_t( 'The only required stop. A person decides what’s true.', 'A única parada obrigatória. Uma pessoa decide o que é verdade.' ), sera_t( 'Your turn · approve', 'Sua vez · aprovar' ), 'you key' ),
			array( sera_t( 'Report + publish', 'Relatório + publicação' ), sera_t( 'Deck and PDF, then the insights go live in the hub.', 'Deck e PDF, e os insights entram no ar no hub.' ), sera_t( 'Hub via MCP · publish', 'Hub via MCP · publicação' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The skill, end to end · eight steps', 'A skill de ponta a ponta · oito etapas' ); ?></span>
			<span class="art-title"><?php sera_e( 'Claude does the work and stops when it needs you.', 'O Claude faz o trabalho e para quando precisa de você.' ); ?></span>
			<?php echo sera_timeline( $steps ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
		<?php
		break;

	case 'rh-mcp':
		?>
		<div class="rh-mcp">
			<?php if ( sera_is_pt() ) : ?>
			<div class="rh-term"><span class="c"># início de um estudo</span><br><span class="p">→</span> research-hub · list_studies("lembretes, tom, cobrança")<br><span class="p">✓</span> 2 estudos parecidos · 1 pergunta já respondida, cortada do roteiro<br><br><span class="c"># fim do mesmo estudo</span><br><span class="p">✓</span> 4 insights aprovados · respostas_anonimas.csv pronto<br><span class="p">→</span> research-hub · publish_study(relatorio.md)<br><span class="g">✓ Publicado.</span> Arquivos confidenciais trancados para quem enviou.</div>
			<?php else : ?>
			<div class="rh-term"><span class="c"># start of a study</span><br><span class="p">→</span> research-hub · list_studies("reminders, tone, collections")<br><span class="p">✓</span> 2 similar studies found · 1 question already answered, cut from the script<br><br><span class="c"># end of the same study</span><br><span class="p">✓</span> 4 insights approved · anonymised_answers.csv ready<br><span class="p">→</span> research-hub · publish_study(report.md)<br><span class="g">✓ Published.</span> Confidential files locked to uploader.</div>
			<?php endif; ?>
			<div class="rh-mcp-why">
				<div><span class="art-label"><?php sera_e( 'Why a skill', 'Por que uma skill' ); ?></span><p><?php sera_e( 'The skill runs the whole process for you. A designer who has never written a survey gets the same bias review, the same email guardrails and the same report format as a seasoned researcher.', 'A skill executa o processo inteiro por você. Quem nunca escreveu um questionário ganha a mesma revisão de viés, as mesmas travas de e-mail e o mesmo formato de relatório de alguém com anos de pesquisa.' ); ?></p></div>
				<div><span class="art-label"><?php sera_e( 'Why the hub speaks MCP', 'Por que o hub fala MCP' ); ?></span><p><?php sera_e( 'The skill uses the archive directly. At the start, it reads every past study and flags anything similar, so duplicate questions are cut before they reach a customer’s inbox. At the end, it publishes the approved insights by itself, so nobody has to do the step where most repositories die.', 'A skill usa o acervo diretamente. No começo, ela lê todos os estudos anteriores e aponta o que for parecido, então pergunta repetida cai antes de chegar à caixa de entrada do cliente. No fim, publica sozinha os insights aprovados, então ninguém precisa fazer a etapa em que a maioria dos repositórios morre.' ); ?></p></div>
			</div>
		</div>
		<p class="art-cap"><?php sera_e( 'The connector’s real tools; arguments simplified for readability.', 'As ferramentas reais do conector; argumentos simplificados para facilitar a leitura.' ); ?></p>
		<?php
		break;

	case 'rh-format':
		?>
		<div class="rh-format">
			<ol class="rh-anatomy">
				<li><span>#01</span><div><b><?php sera_e( 'Executive summary', 'Resumo executivo' ); ?></b><small><?php sera_e( 'The paragraph most stakeholders will read.', 'O parágrafo que a maioria dos stakeholders vai ler.' ); ?></small></div></li>
				<li><span>#02</span><div><b><?php sera_e( 'Context and method', 'Contexto e método' ); ?></b><small><?php sera_e( 'Why we asked, how, and who answered.', 'Por que perguntamos, como e quem respondeu.' ); ?></small></div></li>
				<li><span>#03</span><div><b><?php sera_e( 'Key findings', 'Principais achados' ); ?></b><small><?php sera_e( 'Each one with its evidence attached.', 'Cada um com a sua evidência.' ); ?></small></div></li>
				<li><span>#04</span><div><b><?php sera_e( 'What we heard', 'O que ouvimos' ); ?></b><small><?php sera_e( 'Quotes, anonymised.', 'Citações, anonimizadas.' ); ?></small></div></li>
				<li><span>#05</span><div><b><?php sera_e( 'What to do with it', 'O que fazer com isso' ); ?></b><small><?php sera_e( 'Recommendations and next steps, side by side.', 'Recomendações e próximos passos, lado a lado.' ); ?></small></div></li>
				<li><span>#06</span><div><b><?php sera_e( 'Materials', 'Materiais' ); ?></b><small><?php sera_e( 'Decks, data and recordings, each with its access level.', 'Decks, dados e gravações, cada um com seu nível de acesso.' ); ?></small></div></li>
			</ol>
			<figure class="rh-shot"><?php echo sera_rh_frame( sera_scr_rh_report(), sera_t( 'A standardised study: method, date, author, participants, counts, a short summary and numbered findings with evidence', 'Um estudo padronizado: método, data, autor, participantes, contagens, um resumo curto e achados numerados com evidência' ) ); // phpcs:ignore ?></figure>
		</div>
		<p class="art-cap"><?php sera_e( 'Every finding carries its evidence, so nobody has to take the summary on faith.', 'Todo achado traz a sua evidência, então ninguém precisa acreditar no resumo de olhos fechados.' ); ?></p>
		<?php
		break;

	case 'rh-ask':
		?>
		<div class="rh-duo">
			<figure class="rh-shot"><?php echo sera_rh_frame( sera_scr_rh_ask(), sera_t( 'Ask the archive on desktop: the hub menu on the left, a question limited to two studies, and an answer with a source on every point', 'Pergunte ao acervo no desktop: o menu do hub à esquerda, uma pergunta limitada a dois estudos e uma resposta com fonte em cada ponto' ) ); // phpcs:ignore ?></figure>
			<div class="rh-phone"><?php echo sera_device( 'scr-rh', sera_scr_rh_ask_mobile(), array( 'label' => sera_t( 'Ask the archive on mobile: a blank page with starting questions', 'Pergunte ao acervo no celular: uma página em branco com perguntas para começar' ) ) ); // phpcs:ignore ?></div>
		</div>
		<p class="art-cap"><?php sera_e( 'Findings first, then a design reading, always with the source chips. Studies and answers are fictional.', 'Primeiro os achados, depois uma leitura de design, sempre com os chips de fonte. Estudos e respostas são fictícios.' ); ?></p>
		<?php
		break;

	case 'rh-ask-more':
		$feats = array(
			array( sera_t( 'One menu for the whole hub', 'Um menu para o hub inteiro' ), sera_t( 'Archive, chat, roadmap, guide and the Claude connector in one place: a sidebar on desktop, a drawer on mobile.', 'Acervo, chat, roadmap, guia e o conector do Claude num lugar só: barra lateral no desktop, gaveta no celular.' ) ),
			array( sera_t( 'Conversations you can keep', 'Conversas que ficam' ), sera_t( 'Recent chats stay in the menu, and you can pin, rename or delete them.', 'As conversas recentes ficam no menu, e dá para fixar, renomear ou apagar.' ) ),
			array( sera_t( 'Ask inside chosen studies', 'Pergunte dentro dos estudos que escolher' ), sera_t( 'Attach up to ten studies to a question. The answer stays inside them, and the chips stay on the message.', 'Anexe até dez estudos a uma pergunta. A resposta fica dentro deles, e os chips ficam na mensagem.' ) ),
			array( sera_t( 'Stop without losing it', 'Pare sem perder nada' ), sera_t( 'Stopping an answer freezes exactly what is on screen and saves it to the conversation.', 'Interromper uma resposta congela exatamente o que está na tela e salva na conversa.' ) ),
			array( sera_t( 'Says what it’s doing', 'Diz o que está fazendo' ), sera_t( '“Leafing through the interviews…”, “checking the quotes…” while you wait.', '“Folheando as entrevistas…”, “conferindo as citações…” enquanto você espera.' ) ),
			array( sera_t( 'Every answer can be judged', 'Toda resposta pode ser avaliada' ), sera_t( 'Copy, redo, thumbs up or down. A thumbs down opens a short note on what was missing.', 'Copiar, refazer, joinha para cima ou para baixo. O joinha para baixo abre um campo curto sobre o que faltou.' ) ),
		);
		?>
		<div class="rh-askmore">
			<div class="rh-phone"><?php echo sera_device( 'scr-rh', sera_scr_rh_menu_mobile(), array( 'label' => sera_t( 'The hub menu as a drawer on mobile, with recent conversations', 'O menu do hub como gaveta no celular, com as conversas recentes' ) ) ); // phpcs:ignore ?></div>
			<div class="rh-askmore-list">
				<?php foreach ( $feats as $n => $f ) : ?>
					<div><i><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></i><b><?php echo esc_html( $f[0] ); ?></b><span><?php echo esc_html( $f[1] ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		break;

	case 'rh-privacy':
		?>
		<figure class="rh-shot is-tint"><?php echo sera_rh_frame( sera_scr_rh_privacy(), sera_t( 'Materials of a study: the deck and anonymised answers open to everyone, spreadsheets and recordings locked to the uploader, plus access rules', 'Materiais de um estudo: o deck e as respostas anonimizadas abertos a todos, planilhas e gravações trancadas para quem enviou, e as regras de acesso' ) ); // phpcs:ignore ?></figure>
		<p class="art-cap"><?php sera_e( 'Open what’s safe, lock what’s personal. The team still gets every insight.', 'Abre o que é seguro, tranca o que é pessoal. O time continua recebendo todos os insights.' ); ?></p>
		<div class="rh-locks">
			<div><span class="ic"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 4.5-6 8-6s6.5 2 8 6"/></svg></span><h4><?php sera_e( 'Company accounts only', 'Só contas da empresa' ); ?></h4><p><?php sera_e( 'Google sign-in restricted to the company domain.', 'Login com Google restrito ao domínio da empresa.' ); ?></p></div>
			<div><span class="ic"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg></span><h4><?php sera_e( 'Raw data locks itself', 'Dado bruto se tranca sozinho' ); ?></h4><p><?php sera_e( 'Spreadsheets and recordings open only for the person who uploaded them.', 'Planilhas e gravações só abrem para quem enviou.' ); ?></p></div>
			<div><span class="ic"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 3l18 18"/><path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/><path d="M9.9 5.1A9 9 0 0 1 12 5c5 0 8.5 4 9.5 7a13 13 0 0 1-2.6 3.9M6.3 6.3C4.2 7.7 2.9 9.8 2.5 12c1 3 4.5 7 9.5 7 1.6 0 3-.4 4.3-1"/></svg></span><h4><?php sera_e( 'Anonymised before it leaves', 'Anonimizado antes de sair' ); ?></h4><p><?php sera_e( 'The skill strips name, email and customer ID, and cuts open answers that mention contact details.', 'A skill tira nome, e-mail e ID do cliente, e corta respostas abertas que mencionam dados de contato.' ); ?></p></div>
			<div><span class="ic"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20 12V7l-8-4-8 4v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9z"/></svg></span><h4><?php sera_e( 'Two levels, always visible', 'Dois níveis, sempre à vista' ); ?></h4><p><?php sera_e( 'Every study and file is tagged Confidential or Internal, right where you see it.', 'Todo estudo e todo arquivo levam a etiqueta Confidencial ou Interno, bem onde você vê.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'rh-impact':
		?>
		<div class="art-grid cols-4">
			<div class="stat is-word hl"><b><?php sera_e( 'One place', 'Um lugar só' ); ?></b><span><?php sera_e( 'for every study, old and new, instead of decks scattered across Drive.', 'para todo estudo, antigo ou novo, em vez de decks espalhados pelo Drive.' ); ?></span></div>
			<div class="stat is-word"><b><?php sera_e( 'Plain language', 'Do seu jeito' ); ?></b><span><?php sera_e( 'to search everyone we’ve heard, with the source of every answer.', 'para buscar em tudo o que já ouvimos, com a fonte de cada resposta.' ); ?></span></div>
			<div class="stat is-word"><b><?php sera_e( 'Same shape', 'Padrão único' ); ?></b><span><?php sera_e( 'for every insight, so studies can be compared at a glance.', 'para todo insight, então dá para comparar estudos num relance.' ); ?></span></div>
			<div class="stat is-word dark"><b><?php sera_e( 'Classified', 'Rotulado' ); ?></b><span><?php sera_e( 'on import: every material gets its access level before it goes live.', 'na importação: todo material ganha seu nível de acesso antes de ir para o ar.' ); ?></span></div>
		</div>
		<div class="signals" style="margin-top:16px">
			<div><i>01</i><b><?php sera_e( 'Research outlives the meeting', 'A pesquisa sobrevive à reunião' ); ?></b><span><?php sera_e( 'Every study and every voice is one question away, months after its deck was presented.', 'Cada estudo e cada voz estão a uma pergunta de distância, meses depois da apresentação do deck.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'More people can run research well', 'Mais gente faz pesquisa bem-feita' ); ?></b><span><?php sera_e( 'Designers without a research background follow the same process and ship the same format, with the guardrails built in.', 'Designers sem formação em pesquisa seguem o mesmo processo e entregam o mesmo formato, com as travas já embutidas.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Research got a calendar', 'A pesquisa ganhou um calendário' ); ?></b><span><?php sera_e( 'The next quarter’s studies are chosen from what we already know, prioritised in the open and tracked in Jira.', 'Os estudos do próximo trimestre saem do que já sabemos, são priorizados às claras e acompanhados no Jira.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'rh-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><li><?php sera_e( 'Making publishing the last step of a study. It is the only reason the archive stays alive', 'Fazer da publicação o último passo do estudo. É o único motivo de o acervo continuar vivo' ); ?></li><li><?php sera_e( 'The privacy rules designed before the first screen, so the system remembers LGPD and people don’t have to', 'As regras de privacidade desenhadas antes da primeira tela, para o sistema lembrar da LGPD e as pessoas não precisarem' ); ?></li></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><li><?php sera_e( 'Start with the roadmap and the archive together: the memory only earned its keep once it fed the next question', 'Começar com o roadmap e o acervo juntos: a memória só se pagou quando passou a alimentar a próxima pergunta' ); ?></li><li><?php sera_e( 'Put the connector in people’s own Claude from the first week, instead of expecting them to visit the hub', 'Colocar o conector no Claude de cada pessoa desde a primeira semana, em vez de esperar que elas fossem até o hub' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'rh-signals':
		?>
		<div class="rh-learn">
			<div><h3><?php sera_e( 'Writing the spec became the work.', 'Escrever a especificação virou o trabalho.' ); ?></h3><p><?php sera_e( 'With Lovable and Claude, the distance between a well-written intent and working software got very short. The craft moved to describing behaviour precisely: what the system should do, refuse to do, and always show.', 'Com Lovable e Claude, a distância entre uma intenção bem escrita e um software funcionando ficou muito curta. O ofício passou a ser descrever comportamento com precisão: o que o sistema deve fazer, o que deve recusar e o que deve mostrar sempre.' ); ?></p></div>
			<div><h3><?php sera_e( 'I started from the constraints.', 'Comecei pelas restrições.' ); ?></h3><p><?php sera_e( 'Starting from LGPD made the product simpler. Once “who can see this?” had an answer for every file, the rest of the design fell into place.', 'Começar pela LGPD deixou o produto mais simples. Quando “quem pode ver isso?” ganhou resposta para cada arquivo, o resto do design se encaixou.' ); ?></p></div>
			<div><h3><?php sera_e( 'People trust what they can check.', 'As pessoas confiam no que podem conferir.' ); ?></h3><p><?php sera_e( 'A chat that answers about customers is only useful if people believe it. The source chip turned out to be the most important component in the whole hub.', 'Um chat que responde sobre clientes só serve se as pessoas acreditam nele. O chip de fonte acabou sendo o componente mais importante do hub inteiro.' ); ?></p></div>
			<div><h3><?php sera_e( 'An archive also needs a plan.', 'Um acervo também precisa de um plano.' ); ?></h3><p><?php sera_e( 'Once the past was searchable, the team started asking what to learn next. The roadmap reuses the same archive to plan it, so every new study starts from existing evidence.', 'Com o passado pesquisável, o time passou a perguntar o que aprender em seguida. O roadmap usa o mesmo acervo para planejar, e cada novo estudo parte da evidência que já existe.' ); ?></p></div>
			<div><h3><?php sera_e( 'Next: satisfaction data every week.', 'Próximo passo: satisfação toda semana.' ); ?></h3><p><?php sera_e( 'Plugging continuous, in-flow satisfaction surveys straight into the archive, so the hub gets new data every week, between studies too.', 'Ligar pesquisas contínuas de satisfação, feitas dentro dos fluxos, direto no acervo, para o hub receber dados novos toda semana, também entre um estudo e outro.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'rh-guide':
		?>
		<figure class="rh-shot is-tint"><?php echo sera_rh_frame( sera_scr_rh_guide(), sera_t( 'The research guide: the first question built in four parts and turned into a request to paste into Claude', 'O guia de pesquisa: a primeira pergunta montada em quatro partes e transformada num pedido para colar no Claude' ) ); // phpcs:ignore ?></figure>
		<p class="art-cap"><?php sera_e( 'The guide. Four fields become a request ready to paste into Claude, next to the skill download.', 'O guia. Quatro campos viram um pedido pronto para colar no Claude, ao lado do download da skill.' ); ?></p>
		<?php
		break;

	case 'rh-connect':
		?>
		<div class="rh-cx">
			<div class="rh-cx-flow">
				<div class="rh-cx-node">
					<span class="art-label"><?php sera_e( 'Anyone at Pagaleve', 'Qualquer pessoa da Pagaleve' ); ?></span>
					<h4><?php sera_e( 'Their own Claude', 'O próprio Claude' ); ?></h4>
					<p><?php sera_e( 'Asks in plain Portuguese, in the chat they already use every day.', 'Pergunta em português, do jeito que fala, no chat que já usa todo dia.' ); ?></p>
				</div>
				<div class="rh-cx-arrow" aria-hidden="true"><small><?php sera_e( 'asks', 'pergunta' ); ?></small><small><?php sera_e( 'cited answer', 'resposta com fonte' ); ?></small></div>
				<div class="rh-cx-node is-gate">
					<span class="art-label"><?php sera_e( 'The gate', 'A porta de entrada' ); ?></span>
					<h4><?php sera_e( 'Research Hub connector', 'Conector do Research Hub' ); ?></h4>
					<p><?php sera_e( 'Signs in with a company Google account. No account, no access.', 'Login com a conta Google da empresa. Sem conta, sem acesso.' ); ?></p>
					<div class="rh-cx-tools">
						<div><b><?php sera_e( 'Reads', 'Lê' ); ?></b><code>list_studies</code><code>read_roadmap</code></div>
						<div><b><?php sera_e( 'Writes', 'Escreve' ); ?></b><code>publish_study</code><code>update_roadmap</code><em><?php sera_e( 'roadmap owner only', 'só quem é dono do roadmap' ); ?></em></div>
					</div>
				</div>
				<div class="rh-cx-arrow" aria-hidden="true"><small><?php sera_e( 'site rules', 'regras do site' ); ?></small></div>
				<div class="rh-cx-node is-hub">
					<span class="art-label"><?php sera_e( 'The archive', 'O acervo' ); ?></span>
					<h4><?php sera_e( 'Every study + the roadmap', 'Todos os estudos + o roadmap' ); ?></h4>
					<p><?php sera_e( 'Confidential files stay locked here too. Only what the site would show, the connector shows.', 'Arquivos confidenciais continuam trancados aqui também. O conector só mostra o que o site mostraria.' ); ?></p>
				</div>
			</div>
			<div class="rh-cx-chat">
				<span class="art-label"><?php sera_e( 'What it looks like', 'Como fica na prática' ); ?></span>
				<p class="q">A gente já pesquisou alguma coisa sobre a primeira compra?</p>
				<p class="tool"><code>list_studies</code> <?php sera_e( '“first purchase” · 2 studies found', '“primeira compra” · 2 estudos encontrados' ); ?></p>
				<p class="a">Sim, dois estudos tocam nisso. No <span class="src">Checkout no Celular</span> a maioria saiu da compra para conferir o extrato e não voltou. No <span class="src">Carteira Digital</span> quem tinha saldo não pensou em usá-lo. Nenhum dos dois ouviu quem ainda não comprou: essa pergunta segue aberta.</p>
			</div>
		</div>
		<p class="art-cap"><?php sera_e( 'Example with fictional studies. The question asks “have we researched anything about the first purchase?”; the answer names two studies and the question still open. The four tools are the connector’s real ones.', 'Exemplo com estudos fictícios: a resposta cita dois estudos e aponta a pergunta que segue aberta. As quatro ferramentas são as reais do conector.' ); ?></p>
		<?php
		break;

	case 'rh-roadmap-steps':
		?>
		<div class="steps3">
			<div><h4><?php sera_e( 'Ideas', 'Ideias' ); ?></h4><p><?php sera_e( 'AI suggests studies from what the archive already knows, reading only Internal content and citing the study behind each one. Anyone can add an idea and vote. Every idea arrives as a brief: question, decision it informs, audience and why now.', 'A IA sugere estudos a partir do que o acervo já sabe, lendo só conteúdo Interno e citando o estudo por trás de cada sugestão. Qualquer pessoa pode adicionar uma ideia e votar. Toda ideia chega como um brief: pergunta, decisão que ela informa, público e por que agora.' ); ?></p></div>
			<div><h4><?php sera_e( 'Priority', 'Prioridade' ); ?></h4><p><?php sera_e( 'AI proposes impact and effort, each with a one-line reason. The team moves whatever it disagrees with on an impact × effort map, and the top of the list goes first.', 'A IA propõe impacto e esforço, cada um com uma justificativa de uma linha. O time mexe no que discordar num mapa de impacto × esforço, e o topo da lista vai primeiro.' ); ?></p></div>
			<div><h4><?php sera_e( 'Calendar', 'Calendário' ); ?></h4><p><?php sera_e( 'The ranked list becomes one study per week on a timeline, with duration and status. Publishing sends each study to Jira with its question, decision and audience.', 'A lista ordenada vira um estudo por semana numa linha do tempo, com duração e status. Publicar manda cada estudo para o Jira com a pergunta, a decisão e o público.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'rh-ideas':
		?>
		<figure class="rh-shot is-dark"><?php echo sera_rh_frame( sera_scr_rh_ideas(), sera_t( 'Roadmap step 1: idea cards suggested by AI or added by the team, each with its question, method, source study and votes', 'Passo 1 do roadmap: cards de ideias sugeridas pela IA ou adicionadas pelo time, cada um com pergunta, método, estudo de origem e votos' ) ); // phpcs:ignore ?></figure>
		<p class="art-cap"><?php sera_e( 'Step 1 · Ideas. Suggested ones show the study they came from.', 'Passo 1 · Ideias. As sugeridas mostram o estudo de onde vieram.' ); ?></p>
		<?php
		break;

	case 'rh-priority':
		?>
		<figure class="rh-shot is-dark"><?php echo sera_rh_frame( sera_scr_rh_priority(), sera_t( 'Roadmap step 2: an impact × effort map with numbered ideas and the reason behind each score', 'Passo 2 do roadmap: um mapa de impacto × esforço com ideias numeradas e o motivo de cada nota' ) ); // phpcs:ignore ?></figure>
		<p class="art-cap"><?php sera_e( 'Step 2 · Priority. AI proposes the score; people make the call.', 'Passo 2 · Prioridade. A IA propõe a nota; as pessoas decidem.' ); ?></p>
		<?php
		break;

	case 'rh-track':
		?>
		<figure class="rh-shot is-dark"><?php echo sera_rh_frame( sera_scr_rh_track(), sera_t( 'Roadmap step 3: studies on a weekly timeline with their Jira keys, an out-of-order warning and a dry run of the Jira sync', 'Passo 3 do roadmap: estudos numa linha do tempo semanal com as chaves do Jira, um alerta de fora de ordem e uma simulação da sincronização com o Jira' ) ); // phpcs:ignore ?></figure>
		<p class="art-cap"><?php sera_e( 'Step 3 · Calendar. Publishing turns each study into a Jira card.', 'Passo 3 · Calendário. Publicar transforma cada estudo num card do Jira.' ); ?></p>
		<?php
		break;

endswitch;
