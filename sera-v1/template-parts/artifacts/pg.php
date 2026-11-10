<?php
/**
 * Artifacts — Pagaleve · Combina Antes.
 * No figures from Pagaleve: no rates, shares, volumes, pricing or results.
 * Only the design logic, told qualitatively.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

switch ( $args['name'] ) :

	case 'pg-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'Pagaleve, a Brazilian buy-now-pay-later fintech', 'Pagaleve, fintech brasileira de compre agora, pague depois (BNPL)' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Specialist Product Designer, hackathon squad', 'Product Designer Especialista, no squad do hackathon' ); ?></dd></div>
			<div><dt><?php sera_e( 'Squad', 'Squad' ); ?></dt><dd><?php sera_e( 'Strategy, financial data, sales engineering, front end and collections', 'Estratégia, dados financeiros, engenharia de vendas, front end e cobrança' ); ?></dd></div>
			<div><dt><?php sera_e( 'Timeline', 'Período' ); ?></dt><dd><?php sera_e( 'Hackathon 2026 → production', 'Hackathon 2026 → produção' ); ?></dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label"><?php sera_e( 'What I owned', 'O que ficou comigo' ); ?></dt><ul><li><?php sera_e( 'Problem framing', 'Enquadramento do problema' ); ?></li><li><?php sera_e( 'Two-layer system design (AI × credit)', 'Desenho do sistema em duas camadas (IA × crédito)' ); ?></li><li><?php sera_e( 'End-to-end UX &amp; prototype', 'UX de ponta a ponta e protótipo' ); ?></li><li><?php sera_e( 'Orchestrator v0 with AI', 'Orquestrador v0 com IA' ); ?></li><li><?php sera_e( 'Pitch narrative for leadership', 'Narrativa do pitch para a liderança' ); ?></li></ul></div>
		<?php
		break;

	case 'pg-stats':
		?>
		<div class="art-grid cols-3">
			<div class="stat is-word hl"><b><?php sera_e( 'It snowballs', 'Vira bola de neve' ); ?></b><span><?php sera_e( 'Customers with one overdue installment are far more likely to miss the next one than those who are up to date.', 'Quem tem uma parcela em atraso tem muito mais chance de perder a próxima do que quem está em dia.' ); ?></span><small><?php sera_e( 'Before the due date', 'Antes do vencimento' ); ?></small></div>
			<div class="stat is-word"><b><?php sera_e( 'Out of reach', 'Fora de alcance' ); ?></b><span><?php sera_e( 'Many of those with one overdue installment can’t even use today’s renegotiation: they owe less than the minimum, and it only opens after the delay.', 'Muita gente com uma parcela em atraso nem consegue usar a renegociação de hoje: deve menos que o mínimo, e ela só abre depois do atraso.' ); ?></span><small><?php sera_e( 'Today’s way out', 'A saída de hoje' ); ?></small></div>
			<div class="stat is-word dark"><b><?php sera_e( 'Never back', 'Não volta mais' ); ?></b><span><?php sera_e( 'A meaningful share of installments that go late stays unpaid for months. The late fee never arrives, and neither does the principal.', 'Uma parte relevante das parcelas que atrasam fica meses sem pagamento. A multa nunca chega, e o principal também não.' ); ?></span><small><?php sera_e( 'After the delay', 'Depois do atraso' ); ?></small></div>
		</div>
		<p class="art-cap"><?php sera_e( 'Patterns from the squad’s analysis. Figures are Pagaleve’s and stay confidential.', 'Padrões da análise do squad. Os números são da Pagaleve e continuam confidenciais.' ); ?></p>
		<?php
		break;

	case 'pg-gap':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The customer’s week', 'A semana do cliente' ); ?></span>
			<span class="art-title"><?php sera_e( 'Customers know days ahead, and the app only acts after the late fee.', 'O cliente sabe dias antes, e o app só age depois da multa.' ); ?></span>
			<div class="gap-rows">
				<div class="gap-row"><span class="who"><?php sera_e( 'Before', 'Antes' ); ?></span><div class="bar"><span><?php sera_e( 'Days before · “I won’t make this one”', 'Dias antes · “Essa não vai dar”' ); ?></span><span class="x"><?php sera_e( 'Day after · late fee', 'Dia seguinte · multa' ); ?></span><span class="x"><?php sera_e( 'Collections', 'Cobrança' ); ?></span><span class="x"><?php sera_e( 'Later · credit bureau', 'Depois · negativação' ); ?></span></div></div>
				<div class="gap-row new"><span class="who"><?php sera_e( 'With Combina Antes', 'Com o Combina Antes' ); ?></span><div class="bar"><span class="y"><?php sera_e( 'Days before · “Can’t pay on the 23rd?”', 'Dias antes · “Não vai dar pra pagar dia 23?”' ); ?></span><span class="y"><?php sera_e( 'Picks a new date, a few days out', 'Escolhe uma nova data, poucos dias depois' ); ?></span><span><?php sera_e( 'Reminder with Pix ready', 'Lembrete com o Pix pronto' ); ?></span><span><?php sera_e( 'Pays on the agreed day', 'Paga no dia combinado' ); ?></span></div></div>
			</div>
		</div>
		<?php
		break;

	case 'pg-steps':
		?>
		<div class="steps3">
			<div><h4><?php sera_e( 'Heads-up', 'O aviso' ); ?></h4><p><?php sera_e( 'A few days before the due date, a card on the home screen, in the customer’s own words: “Can’t pay on the 23rd?”. The orchestrator decides who sees it.', 'Poucos dias antes do vencimento, um card na home, com as palavras do próprio cliente: “Não vai dar pra pagar dia 23?”. O orquestrador decide quem vê.' ); ?></p></div>
			<div><h4><?php sera_e( 'Pick a new date', 'Escolha uma nova data' ); ?></h4><p><?php sera_e( 'A few days later, from a short list or the calendar, with the final amount of each option on screen. No down payment, no minimum, no cut in the amount.', 'Poucos dias à frente, numa lista curta ou no calendário, com o valor final de cada opção na tela. Sem entrada, sem valor mínimo, sem mexer no valor da parcela.' ); ?></p></div>
			<div><h4><?php sera_e( 'Pay on the agreed day', 'Pague no dia combinado' ); ?></h4><p><?php sera_e( 'Only the interest for the days requested, a reminder and Pix ready. If it isn’t paid, the agreement lapses and the original due date applies.', 'Só os juros dos dias pedidos, um lembrete e o Pix pronto. Se não pagar, o acordo cai e volta a valer o vencimento original.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'pg-decisions':
		?>
		<div class="decisions">
			<div><i>01</i><div><b><?php sera_e( 'Speak up before the due date', 'Falar antes do vencimento' ); ?></b><span><?php sera_e( '“Can’t pay on the 23rd?” instead of a collections tone. The card has no alarm, no red, and can be dismissed.', '“Não vai dar pra pagar dia 23?” em vez de tom de cobrança. O card não tem alarme, não tem vermelho e pode ser dispensado.' ); ?></span></div></div>
			<div><i>02</i><div><b><?php sera_e( 'Show the price of every option', 'Mostrar o preço de cada opção' ); ?></b><span><?php sera_e( 'Each date shows the final amount, and a comparison with what being late until that same day would cost.', 'Cada data mostra o valor final e quanto custaria ficar em atraso até esse mesmo dia.' ); ?></span></div></div>
			<div><i>03</i><div><b><?php sera_e( 'Keep the original due date as the safety net', 'Manter o vencimento original como rede de segurança' ); ?></b><span><?php sera_e( 'It isn’t debt renegotiation. If the agreement isn’t honoured, the installment goes back to the late rules from the original date.', 'Não é renegociação de dívida. Se o combinado não for cumprido, a parcela volta às regras de atraso a partir da data original.' ); ?></span></div></div>
			<div><i>04</i><div><b><?php sera_e( 'Make the rule impossible to miss', 'Deixar a regra impossível de passar batido' ); ?></b><span><?php sera_e( 'A “keep an eye on this” box and an acceptance checkbox that starts unchecked. The button only lights up after it.', 'Um box de “fique de olho” e um checkbox de aceite que começa desmarcado. O botão só acende depois dele.' ); ?></span></div></div>
			<div><i>05</i><div><b><?php sera_e( 'Limit it on purpose', 'Limitar de propósito' ); ?></b><span><?php sera_e( 'Occasional use, a short window, never crossing the credit-bureau date. Keeping it scarce stops it becoming a habit.', 'Uso ocasional, janela curta, nunca passando da data de negativação. Com uso limitado, ele não vira hábito.' ); ?></span></div></div>
			<div><i>06</i><div><b><?php sera_e( 'End with what happens next', 'Terminar com o que vem depois' ); ?></b><span><?php sera_e( 'A timeline with a reminder before the new date, Pix ready and the new due date, plus “add to calendar”.', 'Uma linha do tempo com o lembrete antes da nova data, o Pix pronto e o novo vencimento, além de “adicionar à agenda”.' ); ?></span></div></div>
		</div>
		<?php
		break;

	case 'pg-economics':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The objection, turned into the mechanism', 'A objeção, transformada no mecanismo' ); ?></span>
			<span class="art-title"><?php sera_e( '“If everyone gets the button, everyone clicks, and we lose late fees.” They were right, so only some customers get it.', '“Se todo mundo tiver o botão, todo mundo clica, e a gente perde multa.” Tinham razão, então só parte dos clientes tem.' ); ?></span>
			<div class="econ" style="margin-top:32px">
				<div class="win"><span class="art-label"><?php sera_e( 'Case A', 'Caso A' ); ?></span><b class="big"><?php sera_e( 'Gain', 'Ganho' ); ?></b><h4><?php sera_e( 'Would have lost the installment, and pays on the new date', 'Ia perder a parcela e paga na nova data' ); ?></h4><p><?php sera_e( 'The principal comes back, plus a small interest, and the credit-bureau cost is avoided.', 'O principal volta, com um pouco de juros, e o custo da negativação sai da conta.' ); ?></p></div>
				<div class="loss"><span class="art-label"><?php sera_e( 'Case B', 'Caso B' ); ?></span><b class="big"><?php sera_e( 'Cost', 'Custo' ); ?></b><h4><?php sera_e( 'Would have paid a day late anyway', 'Ia pagar um dia atrasado de qualquer jeito' ); ?></h4><p><?php sera_e( 'The interest replaces a bigger late fee. This is the cannibalisation the orchestrator exists to avoid.', 'Os juros entram no lugar de uma multa maior. É essa canibalização que o orquestrador existe para evitar.' ); ?></p></div>
				<div class="zero"><span class="art-label"><?php sera_e( 'Case C', 'Caso C' ); ?></span><b class="big"><?php sera_e( 'Neutral', 'Neutro' ); ?></b><h4><?php sera_e( 'Agrees, then doesn’t pay', 'Combina e não paga' ); ?></h4><p><?php sera_e( 'The agreement lapses, the original date applies, collections work as today. The only cost was the notification.', 'O acordo cai, vale a data original e a cobrança segue como hoje. O único custo foi a notificação.' ); ?></p></div>
			</div>
			<div class="econ-rule"><span class="dots"><i class="w"></i><em>≫</em><i></i></span><span><?php sera_e( '<b>A saved installment is worth far more than a cannibalised late fee.</b> So the offer goes to customers already behind, never to those who pay a day late.', '<b>Uma parcela salva vale muito mais que uma multa canibalizada.</b> Por isso a oferta vai para quem já está atrasado, nunca para quem paga um dia depois.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'pg-orchestrator':
		$arrow = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';
		?>
		<div class="art-panel art-dark" style="background:#071431">
			<span class="art-label"><?php sera_e( 'System design · two layers', 'Desenho de sistema · duas camadas' ); ?></span>
			<span class="art-title"><?php sera_e( 'AI decides who sees the offer. Credit decides who gets it.', 'A IA decide quem vê a oferta. O crédito decide quem leva.' ); ?></span>
			<div class="orch" style="margin-top:32px">
				<div class="node agent"><small><?php sera_e( 'Every day · before due dates', 'Todo dia · antes dos vencimentos' ); ?></small><h4><?php sera_e( 'Analyst agent', 'Agente analista' ); ?></h4><p><?php sera_e( 'Reads each customer’s payment history and estimates whether showing the offer creates more value than not showing it. Writes down why.', 'Lê o histórico de pagamento de cada cliente e estima se mostrar a oferta gera mais valor do que não mostrar. E registra o porquê.' ); ?></p><q><?php sera_e( '“Recent payments late, one installment already overdue: show and send a heads-up.”', '“Pagamentos recentes com atraso, uma parcela já vencida: mostrar e mandar aviso.”' ); ?></q></div>
				<div class="arrow"><?php echo $arrow; // phpcs:ignore ?></div>
				<div class="groups">
					<div class="grp"><b><?php sera_e( 'Doesn’t see it', 'Não vê' ); ?></b><span><?php sera_e( 'Would pay a day late: showing it would cost money', 'Pagaria um dia atrasado: mostrar custaria dinheiro' ); ?></span></div>
					<div class="grp"><b><?php sera_e( 'Sees the button', 'Vê o botão' ); ?></b><span><?php sera_e( 'The customer decides whether to use it', 'O cliente decide se usa' ); ?></span></div>
					<div class="grp on"><b><?php sera_e( 'Sees it + gets a heads-up', 'Vê + recebe um aviso' ); ?></b><span><?php sera_e( 'Already overdue, often before the customer notices', 'Já está em atraso, muitas vezes sem o cliente perceber' ); ?></span></div>
				</div>
				<div class="arrow"><?php echo $arrow; // phpcs:ignore ?></div>
				<div class="node agent"><small><?php sera_e( 'Every week', 'Toda semana' ); ?></small><h4><?php sera_e( 'Optimiser agent', 'Agente otimizador' ); ?></h4><p><?php sera_e( 'Measures each group against a control group and proposes widening or narrowing the rule. A person approves before anything changes.', 'Mede cada grupo contra um grupo de controle e propõe abrir ou fechar a regra. Uma pessoa aprova antes de qualquer mudança.' ); ?></p><q><?php sera_e( 'Guardrails: a group in the red goes back to “doesn’t see it” · cap on heads-ups per cycle · every decision logged with its reason.', 'Travas: grupo no vermelho volta para “não vê” · limite de avisos por ciclo · toda decisão registrada com o motivo.' ); ?></q></div>
			</div>
			<div class="orch-foot">
				<div><b><?php sera_e( 'What the customer sees', 'O que o cliente vê' ); ?></b><?php sera_e( 'Never a score, a group or a reason. Only the offer, when it makes sense.', 'Nunca um score, um grupo ou um motivo. Só a oferta, quando faz sentido.' ); ?></div>
				<div class="engine"><b><?php sera_e( 'Outside the orchestrator', 'Fora do orquestrador' ); ?></b><?php sera_e( 'Whether someone can actually postpone, for how many days and at what price stays with the credit engine and the Risk team, at the moment of the click.', 'Se a pessoa pode mesmo adiar, por quantos dias e a que preço continua com o motor de crédito e o time de Risco, na hora do clique.' ); ?></div>
			</div>
		</div>
		<?php
		break;

	case 'pg-impact':
		?>
		<div class="impact" style="background:#071431">
			<span class="art-label"><?php sera_e( 'Impact', 'Impacto' ); ?></span>
			<h3><?php sera_e( 'From a hackathon pitch to a product in production.', 'De um pitch de hackathon a um produto em produção.' ); ?></h3>
			<div class="impact-grid">
				<div><b><?php sera_e( 'Live', 'No ar' ); ?></b><span><?php sera_e( 'Implemented after the leadership pitch, with the credit rules still owned by Risk', 'Implementado depois do pitch para a liderança, com as regras de crédito ainda nas mãos de Risco' ); ?></span></div>
				<div><b>6</b><span><?php sera_e( 'Disciplines aligned around one narrative', 'Disciplinas alinhadas em torno de uma só narrativa' ); ?></span></div>
				<div><b>3</b><span><?php sera_e( 'AI-orchestrated audiences, so late fees from customers who pay a day late are protected', 'Públicos orquestrados por IA, para proteger a multa de quem paga só um dia depois' ); ?></span></div>
				<div><b><?php sera_e( 'Weekly', 'Semanal' ); ?></b><span><?php sera_e( 'Every group measured against a control group, so each result comes from measurement', 'Cada grupo medido contra um grupo de controle, para cada resultado vir de medição' ); ?></span></div>
			</div>
			<div class="impact-foot"><span><?php sera_e( '“I agreed” instead of “I was charged”', '“Eu combinei” em vez de “fui cobrado”' ); ?></span><span><?php sera_e( 'Original due date kept as the safety net', 'Vencimento original como rede de segurança' ); ?></span><span><?php sera_e( 'Risk team kept ownership of credit', 'O crédito continuou com o time de Risco' ); ?></span></div>
		</div>
		<p class="art-cap"><?php sera_e( 'Results are Pagaleve’s and stay confidential.', 'Os resultados são da Pagaleve e continuam confidenciais.' ); ?></p>
		<?php
		break;

	case 'pg-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><li><?php sera_e( 'The hard line between the two layers: AI decides exposure, credit decides the offer. It is what made the idea shippable', 'A linha firme entre as duas camadas: a IA decide a exposição, o crédito decide a oferta. Foi isso que fez a ideia sair do papel' ); ?></li><li><?php sera_e( 'Turning the cannibalisation objection into the mechanism itself', 'Transformar a objeção da canibalização no próprio mecanismo' ); ?></li></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><li><?php sera_e( 'Bring Risk and collections into the room on day one, instead of asking them to sign off at the end', 'Trazer Risco e cobrança para a sala no primeiro dia, em vez de pedir o aval deles só no fim' ); ?></li><li><?php sera_e( 'Run the fake-door test earlier, so the pitch could lean on behaviour from the first draft', 'Rodar o teste de fake door mais cedo, para o pitch se apoiar em comportamento desde o primeiro rascunho' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'pg-signals':
		?>
		<div class="signals">
			<div><i>01</i><b><?php sera_e( 'Framed it as a P&amp;L problem', 'Tratei como um problema de P&amp;L' ); ?></b><span><?php sera_e( 'Started from where the money was being lost, then designed toward it.', 'Comecei por onde o dinheiro estava escapando e desenhei a partir dali.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'Drew the system boundary', 'Desenhei a fronteira do sistema' ); ?></b><span><?php sera_e( 'AI owns exposure, credit owns the decision. That line made it shippable without taking credit decisions away from Risk.', 'A IA cuida da exposição, o crédito cuida da decisão. Essa linha fez a ideia sair do papel sem tirar de Risco as decisões de crédito.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Turned the objection into the design', 'Transformei a objeção no design' ); ?></b><span><?php sera_e( 'The leadership concern about cannibalisation became the orchestrator’s whole job.', 'A preocupação da liderança com canibalização virou o trabalho inteiro do orquestrador.' ); ?></span></div>
			<div><i>04</i><b><?php sera_e( 'Built the AI myself', 'Construí a IA eu mesmo' ); ?></b><span><?php sera_e( 'A working orchestrator v0, built without exporting customer data to prototyping tools.', 'Um orquestrador v0 funcionando, feito sem exportar dados de clientes para ferramentas de prototipação.' ); ?></span></div>
			<div><i>05</i><b><?php sera_e( 'Aligned six disciplines in days', 'Alinhei seis disciplinas em poucos dias' ); ?></b><span><?php sera_e( 'Design, strategy, financial data, sales engineering, front end and collections around one narrative.', 'Design, estratégia, dados financeiros, engenharia de vendas, front end e cobrança em torno de uma só narrativa.' ); ?></span></div>
			<div><i>06</i><b><?php sera_e( 'Designed for measurement', 'Desenhei para medir' ); ?></b><span><?php sera_e( 'Control groups and guardrails from the first version, so it could scale safely.', 'Grupos de controle e travas desde a primeira versão, para crescer com segurança.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'pg-window':
		$marks = array(
			array( 0, sera_t( 'Before', 'Antes' ), sera_t( 'The heads-up can appear', 'O aviso pode aparecer' ), 'on' ),
			array( 14.29, sera_t( 'Due', 'Vencimento' ), sera_t( 'Original due date', 'Data original' ), '' ),
			array( 34.29, sera_t( 'Days later', 'Dias depois' ), sera_t( 'Latest new date allowed', 'Última data possível' ), 'on' ),
			array( 42.86, sera_t( 'Bureau', 'Negativação' ), sera_t( 'Sent to the credit bureau', 'Entra no birô de crédito' ), 'x' ),
			array( 57.14, sera_t( 'Weeks', 'Semanas' ), sera_t( 'Chance of paying drops fast', 'Chance de pagar despenca' ), 'x' ),
			array( 100, sera_t( 'A month', 'Um mês' ), sera_t( 'Few customers come back', 'Poucos clientes voltam' ), 'x' ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Why the agreement is short', 'Por que o acordo é curto' ); ?></span>
			<span class="art-title"><?php sera_e( 'Every day of delay makes the money harder to get back. So the window closes before the credit bureau does.', 'Cada dia de atraso deixa o dinheiro mais difícil de recuperar. Por isso a janela fecha antes da negativação.' ); ?></span>
			<div class="pgw-track" role="img" aria-label="<?php echo esc_attr( sera_t( 'Timeline from a few days before the due date to a month after it. The Combina Antes window opens before the due date and closes a few days after it, before the credit-bureau date. After that, the chance of paying drops fast, and a month later few customers come back.', 'Linha do tempo de alguns dias antes do vencimento até um mês depois. A janela do Combina Antes abre antes do vencimento e fecha poucos dias depois dele, antes da data de negativação. A partir daí, a chance de pagar despenca, e um mês depois poucos clientes voltam.' ) ); ?>">
				<div class="pgw-rail">
					<span class="pgw-band"><em><?php sera_e( 'Combina Antes window', 'Janela do Combina Antes' ); ?></em></span>
					<span class="pgw-fade"></span>
				</div>
				<ol class="pgw-marks">
					<?php foreach ( $marks as $i => $m ) : ?>
						<li class="<?php echo esc_attr( $m[3] . ( $i % 2 ? ' lo' : '' ) ); ?>" style="--x:<?php echo esc_attr( $m[0] ); ?>%"><b><?php echo esc_html( $m[1] ); ?></b><span><?php echo esc_html( $m[2] ); ?></span></li>
					<?php endforeach; ?>
				</ol>
			</div>
			<div class="pgw-spiral">
				<div class="pgw-spiral-txt"><span class="art-label"><?php sera_e( 'And it compounds', 'E vira espiral' ); ?></span><p><?php sera_e( '<b>One late payment pulls the next one with it.</b> Days before a due date, the chance of missing it grows with every installment already overdue.', '<b>Um atraso puxa o próximo.</b> Dias antes de um vencimento, a chance de não pagar cresce a cada parcela que já está em atraso.' ); ?></p></div>
				<div class="pgw-bars">
					<div><span><?php sera_e( 'No overdue installment', 'Nenhuma em atraso' ); ?></span><i style="--w:14%"></i><b>·</b></div>
					<div><span><?php sera_e( '1 overdue', '1 em atraso' ); ?></span><i style="--w:52%"></i><b>↑</b></div>
					<div class="hl"><span><?php sera_e( '2 or more overdue', '2 ou mais em atraso' ); ?></span><i style="--w:80%"></i><b>↑↑</b></div>
				</div>
			</div>
			<p class="art-cap"><?php sera_e( 'Illustrative shape of the pattern. The real figures are Pagaleve’s and stay confidential.', 'Formato ilustrativo do padrão. Os números reais são da Pagaleve e continuam confidenciais.' ); ?></p>
		</div>
		<?php
		break;

	case 'pg-paths':
		/* One installment, one main line. Each stop: who decides, label, detail, and (optional) the exit and where it lands. */
		$stops = array(
			array( 'st', sera_t( 'Start', 'Início' ), sera_t( 'Before the due date', 'Antes do vencimento' ), sera_t( 'One installment coming up', 'Uma parcela chegando' ), '', '' ),
			array( 'ai', sera_t( 'AI · orchestrator', 'IA · orquestrador' ), sera_t( 'Picks who sees the offer', 'Escolhe quem vê a oferta' ), sera_t( 'Places the installment in a group', 'Coloca a parcela num grupo' ), sera_t( 'Not shown', 'Não mostra' ), sera_t( 'Nothing changes · today’s rules', 'Nada muda · regras de hoje' ) ),
			array( 'cx', sera_t( 'Customer', 'Cliente' ), sera_t( '“Can’t pay on the 23rd?”', '“Não vai dar pra pagar dia 23?”' ), sera_t( 'Card on Home, installment pre-selected', 'Card na home, parcela já selecionada' ), sera_t( 'Taps ✕', 'Toca no ✕' ), sera_t( 'Card dismissed for this one', 'Card dispensado para esta parcela' ) ),
			array( 'cr', sera_t( 'Credit · at the click', 'Crédito · no clique' ), sera_t( 'Checks if, how long, what price', 'Define se, quanto tempo e a que preço' ), sera_t( 'The credit engine keeps the decision', 'A decisão fica com o motor de crédito' ), sera_t( 'Not eligible', 'Não elegível' ), sera_t( '“Offer not available right now”', '“Oferta indisponível no momento”' ) ),
			array( 'cx', sera_t( 'Customer', 'Cliente' ), sera_t( 'Picks a date, accepts the rule', 'Escolhe a data e aceita a regra' ), sera_t( 'Final amount shown · reminder with Pix', 'Valor final na tela · lembrete com Pix' ), sera_t( 'Doesn’t pay', 'Não paga' ), sera_t( 'Original due date applies', 'Vale o vencimento original' ) ),
			array( 'end', sera_t( 'Outcome', 'Resultado' ), sera_t( 'Paid on the new date', 'Pago na nova data' ), sera_t( 'Principal back, plus a little interest', 'O principal volta, com um pouco de juros' ), '', '' ),
		);
		$check = '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3.5 8.4l2.9 2.8 6.1-6.4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'One installment, every path', 'Uma parcela, todos os caminhos' ); ?></span>
			<span class="art-title"><?php sera_e( 'One main line, and every exit lands somewhere the customer already knows.', 'Uma linha principal, e toda saída cai num lugar que o cliente já conhece.' ); ?></span>
			<ul class="pgp-key" aria-label="<?php echo esc_attr( sera_t( 'Legend', 'Legenda' ) ); ?>">
				<li class="ai"><?php sera_e( 'AI decides who sees it', 'IA decide quem vê' ); ?></li>
				<li class="cr"><?php sera_e( 'Credit decides the offer', 'Crédito decide a oferta' ); ?></li>
				<li class="cx"><?php sera_e( 'Customer decides', 'Cliente decide' ); ?></li>
				<li class="safe"><?php sera_e( 'Safe landing', 'Pouso seguro' ); ?></li>
			</ul>
			<div class="pgp-map mk-anim">
				<span class="pgp-track" aria-hidden="true"><span class="pgp-run"><i class="pgp-train"></i></span></span>
				<ol class="pgp-line">
					<?php foreach ( $stops as $i => $st ) : ?>
						<li class="pgp-stop <?php echo esc_attr( $st[0] ); ?><?php echo 3 === $i ? ' is-mid' : ''; ?>">
							<span class="pgp-dot" aria-hidden="true"><?php echo 'end' === $st[0] ? $check : ''; // phpcs:ignore ?></span>
							<div class="pgp-name"><small><?php echo esc_html( $st[1] ); ?></small><b><?php echo esc_html( $st[2] ); ?></b><span><?php echo esc_html( $st[3] ); ?></span></div>
							<?php if ( $st[4] ) : ?>
								<div class="pgp-exit"><em><?php echo esc_html( $st[4] ); ?></em><p><?php echo $check; // phpcs:ignore ?><span><?php echo esc_html( $st[5] ); ?></span></p></div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
			<p class="art-cap"><?php sera_e( 'No exit ends in a surprise. The new date never crosses the day an installment goes to the credit bureau, and the customer never sees a score, a group or a reason.', 'Nenhuma saída termina em surpresa. A nova data nunca passa do dia em que a parcela iria para negativação, e o cliente nunca vê um score, um grupo ou um motivo.' ); ?></p>
		</div>
		<?php
		break;

	case 'pg-pilot':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The ask · pilot plan', 'O pedido · plano do piloto' ); ?></span>
			<span class="art-title"><?php sera_e( 'A small, fenced pilot that trades estimates for measured numbers in a few weeks.', 'Um piloto pequeno e cercado, que troca estimativas por números medidos em poucas semanas.' ); ?></span>
			<div class="pgl-plan">
				<section class="pgl-phase">
					<i>00</i><h4><?php sera_e( 'Validate before switching on', 'Validar antes de ligar' ); ?></h4>
					<ul>
						<li><?php sera_e( '<b>Credit</b> interest per day requested, no down payment', '<b>Crédito</b> juros por dia pedido, sem entrada' ); ?></li>
						<li><?php sera_e( '<b>Funding</b> pausing collections doesn’t change the receivable', '<b>Funding</b> pausar a cobrança não muda o recebível' ); ?></li>
						<li><?php sera_e( '<b>Collections</b> holds its actions until the agreed date, then resumes from the original one', '<b>Cobrança</b> segura as ações até a data combinada e depois retoma a partir da original' ); ?></li>
						<li><?php sera_e( '<b>Sources</b> opt-out and active renegotiation data located', '<b>Fontes</b> dados de opt-out e de renegociação ativa mapeados' ); ?></li>
					</ul>
				</section>
				<section class="pgl-phase on">
					<i>01</i><h4><?php sera_e( 'Switch on for a small share of the base', 'Ligar para uma fatia pequena da base' ); ?></h4>
					<ul>
						<li><?php sera_e( 'A control group inside every group', 'Um grupo de controle dentro de cada grupo' ); ?></li>
						<li><?php sera_e( 'Orchestrator sorts installments into 3 groups before the due date', 'O orquestrador separa as parcelas em 3 grupos antes do vencimento' ); ?></li>
						<li><?php sera_e( 'Heads-up only for customers already overdue', 'Aviso só para quem já está em atraso' ); ?></li>
						<li><?php sera_e( 'Occasional use and a short window', 'Uso ocasional e janela curta' ); ?></li>
					</ul>
				</section>
				<section class="pgl-phase wide">
					<i>02</i><h4><?php sera_e( 'Run for a few weeks, read every week', 'Rodar por algumas semanas, ler toda semana' ); ?></h4>
					<div class="pgl-weeks" aria-label="<?php echo esc_attr( sera_t( 'Weekly cycles', 'Ciclos semanais' ) ); ?>">
						<?php for ( $w = 1; $w <= 3; $w++ ) : ?>
							<span><b><?php echo esc_html( sera_t( 'W', 'S' ) ); ?><?php echo (int) $w; ?></b></span>
						<?php endfor; ?>
							<span><b>…</b></span>
					</div>
					<p class="pgl-loop"><span><?php sera_e( 'Optimiser measures each group vs. control', 'O otimizador mede cada grupo vs. controle' ); ?></span><span><?php sera_e( 'Proposes widening or narrowing', 'Propõe abrir ou fechar a regra' ); ?></span><span><?php sera_e( 'A person approves', 'Uma pessoa aprova' ); ?></span><span><?php sera_e( 'Rule changes', 'A regra muda' ); ?></span></p>
				</section>
				<section class="pgl-phase">
					<i>03</i><h4><?php sera_e( 'Read out', 'Leitura' ); ?></h4>
					<ul>
						<li><?php sera_e( 'Profit per group against the control', 'Lucro por grupo contra o controle' ); ?></li>
						<li><?php sera_e( 'Real acceptance of the offer', 'Aceite real da oferta' ); ?></li>
						<li><?php sera_e( '% who pay on the agreed date', '% que paga na data combinada' ); ?></li>
						<li><?php sera_e( 'Longer-term volume, NPS and app reviews', 'Volume no longo prazo, NPS e avaliações nas lojas' ); ?></li>
					</ul>
				</section>
			</div>
		</div>
		<?php
		break;

endswitch;
