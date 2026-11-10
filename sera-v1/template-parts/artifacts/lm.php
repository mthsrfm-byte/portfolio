<?php
/**
 * Artifacts — Pagaleve · Lume (work in progress).
 * Screens are recreations; studies, participants, questions and quotes are fictional.
 * Pagaleve's findings and internal data are confidential: none appear here.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

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

	case 'lm-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'Pagaleve, a Brazilian buy-now-pay-later fintech', 'Pagaleve, fintech brasileira de compre agora, pague depois (BNPL)' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Specialist Product Designer · concept, design and build', 'Product Designer Especialista · conceito, design e construção' ); ?></dd></div>
			<div><dt><?php sera_e( 'Users', 'Quem usa' ); ?></dt><dd><?php sera_e( 'Pagaleve customers on their phones · the Product Design chapter', 'Clientes da Pagaleve, no celular · o chapter de Product Design' ); ?></dd></div>
			<div><dt><?php sera_e( 'Status', 'Status' ); ?></dt><dd><?php sera_e( 'In progress · pilot stage, with an AI agent improving it every night', 'Em andamento · fase de piloto, com um agente de IA melhorando o produto toda noite' ); ?></dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label"><?php sera_e( 'What I built', 'O que eu construí' ); ?></dt><ul><li><?php sera_e( 'The Lume (Lovable)', 'O Lume (Lovable)' ); ?></li><li><?php sera_e( 'A voice moderator on a realtime model', 'Um moderador por voz sobre um modelo em tempo real' ); ?></li><li><?php sera_e( 'The participant’s session, mobile first', 'A sessão do participante, mobile first' ); ?></li><li><?php sera_e( 'A designer area: script, publish, report', 'Uma área do designer: roteiro, publicação, relatório' ); ?></li><li><?php sera_e( 'Simulated participants to rehearse a study', 'Participantes simulados para ensaiar um estudo' ); ?></li><li><?php sera_e( 'An MCP server + a Claude skill', 'Um servidor MCP + uma skill do Claude' ); ?></li><li><?php sera_e( 'A nightly product agent that audits and fixes it', 'Um agente de produto que audita e corrige à noite' ); ?></li></ul></div>
		<?php
		break;

	case 'lm-pains':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label"><?php sera_e( 'Scale', 'Escala' ); ?></span><h4><?php sera_e( 'A moderated test costs one designer-hour per participant', 'Um teste moderado custa uma hora de designer por participante' ); ?></h4><p><?php sera_e( 'Recruiting, scheduling, running and transcribing eight sessions eats a week. So most prototypes ship with no test at all.', 'Recrutar, agendar, conduzir e transcrever oito sessões consome uma semana. Então a maioria dos protótipos vai para a rua sem teste nenhum.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Bias', 'Viés' ); ?></span><h4><?php sera_e( 'The designer moderating their own screen leads the witness', 'O designer moderando a própria tela conduz a testemunha' ); ?></h4><p><?php sera_e( 'A hint, a pause, a “so you’d tap here?” Even careful moderators nudge people toward the answer they hope for.', 'Uma dica, uma pausa, um “então você tocaria aqui?”. Até moderadores cuidadosos empurram as pessoas para a resposta que esperam.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Depth', 'Profundidade' ); ?></span><h4><?php sera_e( 'Unmoderated tools show the click but lose the why', 'Ferramentas não moderadas mostram o clique, mas perdem o porquê' ); ?></h4><p><?php sera_e( 'Heatmaps and task success tell you where people got lost. They don’t ask what the person expected to happen.', 'Mapas de calor e taxa de sucesso mostram onde as pessoas se perderam. Não perguntam o que a pessoa esperava que acontecesse.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'lm-statement':
		?>
		<div class="statement">
			<span class="art-label"><?php sera_e( 'The bet', 'A aposta' ); ?></span>
			<p><?php sera_e( 'The best way to test a Figma prototype should be sending a link. <em>The moderator comes with it.</em>', 'O melhor jeito de testar um protótipo do Figma deveria ser mandar um link. <em>O moderador vai junto.</em>' ); ?></p>
			<span class="by"><?php sera_e( 'A customer opens the invite on their phone, a voice guides them through the prototype, asks a few questions per screen and never leads. The designer gets back a report with quotes and the exact screen each one came from.', 'O cliente abre o convite no celular, uma voz o guia pelo protótipo, faz poucas perguntas por tela e nunca induz. O designer recebe de volta um relatório com citações e a tela exata de onde cada uma veio.' ); ?></span>
		</div>
		<?php
		break;

	case 'lm-principles':
		?>
		<div class="decisions">
			<div><i>01</i><div><b><?php sera_e( 'A link is the whole setup', 'Um link é o setup inteiro' ); ?></b><span><?php sera_e( 'The designer sends a Figma prototype link and gets back an invite link for the CRM. Everything in between is the product’s job.', 'O designer manda o link do protótipo do Figma e recebe o link do convite para o CRM. Tudo o que fica no meio é trabalho do produto.' ); ?></span></div></div>
			<div><i>02</i><div><b><?php sera_e( 'Voice, not forms', 'Voz, não formulário' ); ?></b><span><?php sera_e( 'People explain what they expect far better out loud than typing. Nothing in the session asks the participant to type.', 'As pessoas explicam o que esperam muito melhor falando do que digitando. Nada na sessão pede para o participante escrever.' ); ?></span></div></div>
			<div><i>03</i><div><b><?php sera_e( 'The Lume asks, then gets out of the way', 'O Lume pergunta e depois sai da frente' ); ?></b><span><?php sera_e( 'A limited number of questions per screen, then “where would you tap?”, then silence until the person moves on. It never interrupts.', 'Um número limitado de perguntas por tela, depois “onde você tocaria?”, depois silêncio até a pessoa seguir. Ele nunca interrompe.' ); ?></span></div></div>
			<div><i>04</i><div><b><?php sera_e( 'The prototype is the stage', 'O protótipo é o palco' ); ?></b><span><?php sera_e( 'The Figma frame fills the phone. The moderator is one small card at the bottom, not a second interface competing for attention.', 'O frame do Figma ocupa o celular inteiro. O moderador é um cartão pequeno embaixo, não uma segunda interface disputando atenção.' ); ?></span></div></div>
		</div>
		<?php
		break;

	case 'lm-system':
		?>
		<div class="lm-map">
			<div class="lm-map-grid">
				<div class="lm-stack">
					<div class="lm-node"><span class="art-label"><?php sera_e( 'Input', 'Entrada' ); ?></span><h4><?php sera_e( 'A Figma prototype', 'Um protótipo do Figma' ); ?></h4><p><?php sera_e( 'The skill reads its screens through Figma and drafts the script; the Lume receives it as a study.', 'A skill lê as telas pelo Figma e monta o roteiro; o Lume recebe tudo como um estudo.' ); ?></p></div>
					<div class="lm-node"><span class="art-label"><?php sera_e( 'Designer', 'Designer' ); ?></span><h4><?php sera_e( 'Script, then publish', 'Roteiro, depois publicação' ); ?></h4><p><?php sera_e( 'Marks the essential blocks, picks 5–12 sessions, rehearses with simulated participants and publishes to the field.', 'Marca os blocos essenciais, escolhe de 5 a 12 sessões, ensaia com participantes simulados e publica para o campo.' ); ?></p></div>
				</div>
				<div class="lm-arrow both" aria-hidden="true"><small><?php sera_e( 'MCP · skill', 'MCP · skill' ); ?></small></div>
				<div class="lm-node is-core"><span class="art-label"><?php sera_e( 'Product', 'Produto' ); ?></span><h4>Lume</h4><p><?php sera_e( 'Built in Lovable. A realtime voice model runs the conversation; the session, the turn-taking rules and the report are the product’s own.', 'Feito no Lovable. Um modelo de voz em tempo real conduz a conversa; a sessão, as regras de turno e o relatório são do próprio produto.' ); ?></p></div>
				<div class="lm-arrow both" aria-hidden="true"><small><?php sera_e( 'invite · voice', 'convite · voz' ); ?></small></div>
				<div class="lm-stack">
					<div class="lm-node"><span class="art-label"><?php sera_e( 'Participant', 'Participante' ); ?></span><h4><?php sera_e( 'A customer, on their phone', 'Um cliente, no celular' ); ?></h4><p><?php sera_e( 'Opens the invite from the CRM, talks through the prototype for about ten minutes, gets a coupon by e-mail.', 'Abre o convite do CRM, conversa pelo protótipo por uns dez minutos e recebe um cupom por e-mail.' ); ?></p></div>
					<div class="lm-node"><span class="art-label"><?php sera_e( 'Output', 'Saída' ); ?></span><h4><?php sera_e( 'What we found so far', 'O que descobrimos até agora' ); ?></h4><p><?php sera_e( 'A report that fills in as sessions land: summary, findings with quotes and a link to the prototype screen each one came from.', 'Um relatório que se preenche conforme as sessões chegam: resumo, achados com citações e o link da tela do protótipo de onde cada um veio.' ); ?></p></div>
				</div>
			</div>
			<div class="lm-map-foot"><span>Lovable</span><span><?php sera_e( 'Realtime voice model', 'Modelo de voz em tempo real' ); ?></span><span><?php sera_e( 'Figma prototype link', 'Link de protótipo do Figma' ); ?></span><span><?php sera_e( 'Own MCP server · Claude skill', 'Servidor MCP próprio · skill do Claude' ); ?></span><span>Customer.io</span><span><?php sera_e( 'Google SSO · designer area', 'Google SSO · área do designer' ); ?></span><span><?php sera_e( 'Nightly product agent', 'Agente de produto noturno' ); ?></span></div>
		</div>
		<?php
		break;

	case 'lm-session':
		$steps = array(
			array( sera_t( 'Screening', 'Triagem' ), sera_t( 'The invite from the CRM opens on one question. No app, no account.', 'O convite do CRM abre numa pergunta só. Sem app, sem conta.' ), 'Customer.io' ),
			array( sera_t( 'Mic check', 'Teste do microfone' ), sera_t( 'Say “hi”. If the Lume can’t hear you, nothing else is worth starting.', 'Diga “oi”. Se o Lume não te ouve, não vale começar mais nada.' ), sera_t( 'Your turn · allow', 'Sua vez · permitir' ), 'you' ),
			array( sera_t( 'Think out loud', 'Pensar em voz alta' ), sera_t( 'The one rule the method depends on, taught with examples you can listen to.', 'A única regra de que o método depende, ensinada com exemplos que dá para ouvir.' ), sera_t( 'Your turn · agree', 'Sua vez · aceitar' ), 'you' ),
			array( sera_t( 'Intro', 'Abertura' ), sera_t( 'Who the Lume is and the scenario, while the prototype loads.', 'Quem é o Lume e o cenário, enquanto o protótipo carrega.' ), sera_t( 'Full screen', 'Tela cheia' ) ),
			array( sera_t( 'The prototype', 'O protótipo' ), sera_t( 'Fills the screen. The Lume asks a few questions per screen from a small card at the bottom.', 'Ocupa a tela. O Lume faz poucas perguntas por tela, num cartão pequeno embaixo.' ), sera_t( 'Voice', 'Voz' ), 'key' ),
			array( sera_t( 'Rating', 'Nota' ), sera_t( 'How easy was it, from 1 to 5, then why, out loud.', 'Quão fácil foi, de 1 a 5, e depois o porquê, falando.' ), sera_t( 'Per study', 'Por estudo' ) ),
			array( sera_t( 'Done', 'Fim' ), sera_t( 'The coupon arrives by e-mail within 10 business days, with the date on screen.', 'O cupom chega por e-mail em até 10 dias úteis, com a data na tela.' ), sera_t( 'Light mode', 'Modo claro' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The participant’s session · seven moments', 'A sessão do participante · sete momentos' ); ?></span>
			<span class="art-title"><?php sera_e( 'About ten minutes, on the phone, without typing a word.', 'Uns dez minutos, no celular, sem digitar uma palavra.' ); ?></span>
			<?php echo sera_timeline( $steps ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
		<?php
		break;

	case 'lm-turns':
		?>
		<div class="steps3">
			<div><h4><?php sera_e( 'The Lume speaks', 'O Lume fala' ); ?></h4><p><?php sera_e( 'One question, short, about the screen in front of the person. The orb pulses while it talks so nobody wonders whether it’s still going.', 'Uma pergunta, curta, sobre a tela na frente da pessoa. O orbe pulsa enquanto ele fala, para ninguém ficar na dúvida se ele ainda vai continuar.' ); ?></p></div>
			<div><h4><?php sera_e( 'The mic opens by itself', 'O microfone abre sozinho' ); ?></h4><p><?php sera_e( 'As soon as the Lume finishes. The person doesn’t hunt for a button to answer; they just talk.', 'Assim que o Lume termina. A pessoa não procura um botão para responder; só fala.' ); ?></p></div>
			<div><h4><?php sera_e( 'Only “Enviar” ends the turn', 'Só o “Enviar” encerra o turno' ); ?></h4><p><?php sera_e( 'Silence never sends. People pause to think, and the worst thing a moderator can do is fill that pause. The Lume cannot interrupt, by design.', 'Silêncio nunca envia. As pessoas param para pensar, e a pior coisa que um moderador pode fazer é preencher essa pausa. O Lume não consegue interromper, por construção.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'lm-cut':
		?>
		<div class="lm-cut">
			<div class="lm-cut-col"><span class="art-label"><?php sera_e( 'Removed from the session', 'Tirado da sessão' ); ?></span>
				<ul>
					<li><b><?php sera_e( 'The live transcript', 'A transcrição ao vivo' ); ?></b><span><?php sera_e( 'People read their own words and start editing themselves.', 'As pessoas leem as próprias palavras e começam a se editar.' ); ?></span></li>
					<li><b><?php sera_e( 'Typing as a fallback', 'Digitar como alternativa' ); ?></b><span><?php sera_e( 'A keyboard turns a conversation into a form.', 'Um teclado transforma a conversa em formulário.' ); ?></span></li>
					<li><b><?php sera_e( 'Progress counters', 'Contadores de progresso' ); ?></b><span><?php sera_e( '“Question 3 of 8” makes people rush the last five.', '“Pergunta 3 de 8” faz a pessoa correr nas cinco últimas.' ); ?></span></li>
					<li><b><?php sera_e( 'A chat panel and history', 'Um painel de chat e histórico' ); ?></b><span><?php sera_e( 'A second interface stealing the screen from the prototype.', 'Uma segunda interface roubando a tela do protótipo.' ); ?></span></li>
					<li><b><?php sera_e( 'A dark header on the final screen', 'Um bloco escuro na tela final' ); ?></b><span><?php sera_e( 'It broke the tone of the ending. The last screen is all light.', 'Quebrava o tom do final. A última tela é toda clara.' ); ?></span></li>
				</ul>
			</div>
			<div class="lm-cut-col alt"><span class="art-label"><?php sera_e( 'What stayed', 'O que ficou' ); ?></span>
				<ul>
					<li><b><?php sera_e( 'One card, one question', 'Um cartão, uma pergunta' ); ?></b><span><?php sera_e( 'The current question, the recorder and send. Nothing else.', 'A pergunta atual, o gravador e o enviar. Mais nada.' ); ?></span></li>
					<li><b><?php sera_e( 'A natural Brazilian voice', 'Uma voz brasileira natural' ); ?></b><span><?php sera_e( 'Male, Brazilian accent. The first voice sounded like Portugal, and a moderator shouldn’t sound foreign to the person.', 'Masculina, com sotaque do Brasil. A primeira voz soava como Portugal, e um moderador não deveria soar estrangeiro para a pessoa.' ); ?></span></li>
					<li><b><?php sera_e( 'The scenario on the intro', 'O cenário na abertura' ); ?></b><span><?php sera_e( 'Said once, in full, before the first screen.', 'Dito uma vez, inteiro, antes da primeira tela.' ); ?></span></li>
					<li><b><?php sera_e( 'A date on the coupon', 'Uma data no cupom' ); ?></b><span><?php sera_e( '“Up to 10 business days” plus the actual day. The one question every participant asks.', '“Até 10 dias úteis” mais o dia de fato. A única dúvida que todo participante tem.' ); ?></span></li>
				</ul>
			</div>
		</div>
		<?php
		break;

	case 'lm-designer':
		?>
		<div class="art-grid cols-4">
			<div class="art-card"><span class="art-label"><?php sera_e( 'Draft first', 'Rascunho primeiro' ); ?></span><h4><?php sera_e( 'Nothing reaches customers by accident', 'Nada chega ao cliente por acidente' ); ?></h4><p><?php sera_e( 'Every study is born as a draft. “Publish to the field” is a deliberate step, and the invite link only exists after it.', 'Todo estudo nasce como rascunho. “Publicar para o campo” é um passo deliberado, e o link do convite só existe depois dele.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Essential blocks', 'Blocos essenciais' ); ?></span><h4><?php sera_e( 'The designer marks what can’t be skipped', 'O designer marca o que não pode ser pulado' ); ?></h4><p><?php sera_e( 'The Lume adapts the rest to the person and the time. The marked blocks always happen.', 'O Lume adapta o resto à pessoa e ao tempo. Os blocos marcados acontecem sempre.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( '5–12 sessions', '5 a 12 sessões' ); ?></span><h4><?php sera_e( 'Enough to see a pattern, not a census', 'O bastante para ver um padrão, não um censo' ); ?></h4><p><?php sera_e( 'The designer picks the number per study, and the report fills in as the sessions land.', 'O designer escolhe o número por estudo, e o relatório vai se preenchendo conforme as sessões chegam.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Admin', 'Admin' ); ?></span><h4><?php sera_e( 'One account, company sign-in', 'Uma conta, login da empresa' ); ?></h4><p><?php sera_e( 'The designer area opens with the company Google account only. Participants never see it.', 'A área do designer abre só com a conta Google da empresa. O participante nunca a vê.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'lm-profiles':
		?>
		<div class="lm-sim">
			<div class="lm-sim-why"><span class="art-label"><?php sera_e( 'Rehearsal', 'Ensaio' ); ?></span><h4><?php sera_e( 'Simulated participants run the script before any customer does.', 'Participantes simulados rodam o roteiro antes de qualquer cliente.' ); ?></h4><p><?php sera_e( 'Each one is a personality the Lume has to handle well: the one in a hurry, the one who gets lost, the one who answers in one word, the one who won’t stop talking. A script that survives all of them is ready for the field. The sessions are logged like real ones, so the designer reads them as a dry run of the report.', 'Cada um é uma personalidade que o Lume precisa saber conduzir: o apressado, o que se perde, o que responde com uma palavra, o que não para de falar. Um roteiro que sobrevive a todos eles está pronto para o campo. As sessões ficam registradas como as reais, então o designer lê como um ensaio do relatório.' ); ?></p></div>
			<ul class="lm-sim-list">
				<li><b><?php sera_e( 'In a hurry', 'Apressado' ); ?></b><span><?php sera_e( 'Skips the scenario. Does the script still land the essential blocks?', 'Pula o cenário. O roteiro ainda entrega os blocos essenciais?' ); ?></span></li>
				<li><b><?php sera_e( 'Confused', 'Confuso' ); ?></b><span><?php sera_e( 'Gets lost on screen two. Does the Lume help without leading?', 'Se perde na tela dois. O Lume ajuda sem induzir?' ); ?></span></li>
				<li><b><?php sera_e( 'One-word answers', 'Monossilábico' ); ?></b><span><?php sera_e( '“Yes.” “No.” “Fine.” Does the follow-up open anything up?', '“Sim.” “Não.” “Tá.” A pergunta seguinte abre alguma coisa?' ); ?></span></li>
				<li><b><?php sera_e( 'Talkative', 'Falante' ); ?></b><span><?php sera_e( 'Tells a story per question. Does the session still fit in ten minutes?', 'Conta uma história por pergunta. A sessão ainda cabe em dez minutos?' ); ?></span></li>
				<li><b><?php sera_e( 'Distracted', 'Distraído' ); ?></b><span><?php sera_e( 'Answers something else. Does the Lume come back to the screen?', 'Responde outra coisa. O Lume volta para a tela?' ); ?></span></li>
			</ul>
		</div>
		<?php
		break;

	case 'lm-status':
		?>
		<div class="lm-status">
			<div><span class="art-label"><?php sera_e( 'Working', 'Funcionando' ); ?></span><ul><li><?php sera_e( 'The participant’s session end to end, on the phone, by voice', 'A sessão do participante de ponta a ponta, no celular, por voz' ); ?></li><li><?php sera_e( 'Script from a Figma prototype, with essential blocks', 'Roteiro a partir de um protótipo do Figma, com blocos essenciais' ); ?></li><li><?php sera_e( 'Draft → publish → invite link for the CRM', 'Rascunho → publicação → link do convite para o CRM' ); ?></li><li><?php sera_e( 'Simulated participants and the “what we found so far” report', 'Participantes simulados e o relatório “o que descobrimos até agora”' ); ?></li><li><?php sera_e( 'MCP server and a Claude skill: a Figma link in, a CRM link out', 'Servidor MCP e uma skill do Claude: entra um link do Figma, sai um link para o CRM' ); ?></li></ul></div>
			<div class="now"><span class="art-label"><?php sera_e( 'Being tuned', 'Em ajuste' ); ?></span><ul><li><?php sera_e( 'The voice interaction: latency, interruptions, how the Lume handles silence', 'A interação por voz: latência, interrupções, como o Lume lida com o silêncio' ); ?></li><li><?php sera_e( 'How many questions per screen is “a few”', 'Quantas perguntas por tela são “poucas”' ); ?></li><li><?php sera_e( 'Which findings the report should surface first', 'Quais achados o relatório deve mostrar primeiro' ); ?></li></ul></div>
			<div class="next"><span class="art-label"><?php sera_e( 'Next', 'Próximo' ); ?></span><ul><li><?php sera_e( 'First rounds with real customers, compared against a human-moderated round', 'Primeiras rodadas com clientes reais, comparadas com uma rodada moderada por humano' ); ?></li><li><?php sera_e( 'Findings published straight into the Research Hub', 'Achados publicados direto no Research Hub' ); ?></li><li><?php sera_e( 'This page, updated as it goes', 'Esta página, atualizada conforme avança' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'lm-agent':
		?>
		<div class="lm-agent">
			<div class="lm-term">
				<span class="c">// <?php sera_e( 'every night · 3 hours · the product agent', 'toda noite · 3 horas · o agente de produto' ); ?></span><br>
				<span class="p">audit</span> <?php sera_e( 'the session as a participant would', 'a sessão como um participante faria' ); ?><br>
				<span class="p">compare</span> <?php sera_e( 'against the vision and the logged decisions', 'com a visão e as decisões registradas' ); ?><br>
				<span class="p">fix</span> <?php sera_e( 'what it can, voice interaction first', 'o que der, interação por voz primeiro' ); ?><br>
				<span class="p">log</span> → <span class="g">docs/LUME_LOG.md</span><br>
				<span class="p">send</span> <?php sera_e( 'me the list of changes', 'a lista de mudanças para mim' ); ?><br>
				<span class="c">// <?php sera_e( 'I read the list over coffee and reject what moved away from the vision.', 'Leio a lista no café e rejeito o que se afastou da visão.' ); ?></span>
			</div>
			<div class="lm-agent-why">
				<div><span class="art-label"><?php sera_e( 'Why an agent', 'Por que um agente' ); ?></span><p><?php sera_e( 'A voice product has a thousand small failures you only hear by using it. I can’t run twenty sessions a night. The agent can, and it keeps a log I review in the morning.', 'Um produto de voz tem mil falhas pequenas que você só ouve usando. Eu não consigo rodar vinte sessões por noite. O agente consegue, e mantém um registro que eu reviso de manhã.' ); ?></p></div>
				<div><span class="art-label"><?php sera_e( 'Where the line is', 'Onde está a linha' ); ?></span><p><?php sera_e( 'It improves inside the decisions already made. New decisions (what the session shows, what the Lume may say, what reaches a customer) stay with me.', 'Ele melhora dentro das decisões já tomadas. Decisões novas (o que a sessão mostra, o que o Lume pode dizer, o que chega ao cliente) continuam comigo.' ); ?></p></div>
			</div>
		</div>
		<?php
		break;

	case 'lm-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><li><?php sera_e( 'Making “only Enviar ends the turn” a rule of the product. It removed the one thing that makes AI voice feel rude', 'Fazer do “só o Enviar encerra o turno” uma regra do produto. Tirou a única coisa que deixa voz de IA mal-educada' ); ?></li><li><?php sera_e( 'Rehearsing every script with simulated participants before a customer ever hears it', 'Ensaiar todo roteiro com participantes simulados antes de qualquer cliente ouvir' ); ?></li></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><li><?php sera_e( 'Start with the prototype maximised and one card. I built a chat, a bottom sheet and a phone-in-a-phone first, and threw all three away', 'Começar com o protótipo maximizado e um cartão. Construí um chat, um bottom sheet e um celular dentro do celular antes, e joguei os três fora' ); ?></li><li><?php sera_e( 'Run the first human-moderated control round earlier, so every design decision had a baseline to beat', 'Rodar a primeira rodada controle, moderada por humano, mais cedo, para cada decisão de design ter uma referência para bater' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'lm-signals':
		?>
		<div class="lm-learn">
			<div><h3><?php sera_e( 'Designing a conversation is designing turn-taking.', 'Desenhar uma conversa é desenhar os turnos.' ); ?></h3><p><?php sera_e( 'Most of the decisions that mattered were about who speaks when: when the mic opens, what ends a turn, what the Lume does with silence. The words came last.', 'A maioria das decisões que importaram era sobre quem fala quando: quando o microfone abre, o que encerra um turno, o que o Lume faz com o silêncio. As palavras vieram por último.' ); ?></p></div>
			<div><h3><?php sera_e( 'Subtraction is the work.', 'Subtrair é o trabalho.' ); ?></h3><p><?php sera_e( 'Every version got smaller. The session that works is the one where the moderator almost disappears and the prototype takes the whole screen.', 'Toda versão ficou menor. A sessão que funciona é a que o moderador quase desaparece e o protótipo fica com a tela inteira.' ); ?></p></div>
			<div><h3><?php sera_e( 'The product keeps improving while I sleep.', 'O produto continua melhorando enquanto eu durmo.' ); ?></h3><p><?php sera_e( 'A nightly agent with a clear vision and a log turned out to be the most productive teammate on the project. My job became writing the vision well and reviewing the log.', 'Um agente noturno com uma visão clara e um registro acabou sendo o colega mais produtivo do projeto. Meu trabalho virou escrever bem a visão e revisar o registro.' ); ?></p></div>
			<div><h3><?php sera_e( 'Still to prove: is it better than a person?', 'Ainda falta provar: é melhor que uma pessoa?' ); ?></h3><p><?php sera_e( 'The vision says the Lume should surface things a human interview misses. That claim needs a side-by-side round, and it’s the next thing on the list.', 'A visão diz que o Lume deve encontrar coisas que uma entrevista humana deixa passar. Essa afirmação precisa de uma rodada lado a lado, e é a próxima da lista.' ); ?></p></div>
		</div>
		<?php
		break;

endswitch;
