<?php
/**
 * Artifacts — will bank · Switching the brain.
 * Transaction volumes deliberately anonymised.
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

$img = get_template_directory_uri() . '/assets/cases/will-bank/';

switch ( $args['name'] ) :

	case 'wb-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'will bank, a digital bank for lower-income Brazilians, with millions of customers', 'will bank, um banco digital para brasileiros de menor renda, com milhões de clientes' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Staff Product Designer, Credit Card', 'Staff Product Designer, Cartão de Crédito' ); ?></dd></div>
			<div><dt><?php sera_e( 'Worked with', 'Trabalhei com' ); ?></dt><dd><?php sera_e( 'Engineering, Product, leadership, and Mastercard for benchmarking', 'Engenharia, Produto, liderança e a Mastercard no benchmark' ); ?></dd></div>
			<div><dt><?php sera_e( 'Timeline', 'Período' ); ?></dt><dd>2023</dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label"><?php sera_e( 'What I owned', 'O que ficou comigo' ); ?></dt><ul><?php sera_e( '<li>Framing the migration as a product opportunity with the team</li><li>AI-assisted contact-rate analysis</li><li>Interviews</li><li>Benchmark with Mastercard</li><li>Leadership workshop</li><li>Prototypes &amp; usability tests</li><li>Temporal Control screens</li><li>Backlog influence</li>', '<li>Enquadrar a migração como oportunidade de produto, junto com o time</li><li>Análise da taxa de contato com IA</li><li>Entrevistas</li><li>Benchmark com a Mastercard</li><li>Workshop com a liderança</li><li>Protótipos e testes de usabilidade</li><li>Telas do Controle Temporal</li><li>Influência no backlog</li>' ); ?></ul></div>
		<?php
		break;

	case 'wb-stakes':
		?>
		<div class="art-grid cols-3">
			<div class="stat is-word dark"><b><?php sera_e( 'Lower', 'Menor' ); ?></b><span><?php sera_e( 'transaction approval rate than the main competitors', 'taxa de aprovação de transações que a dos principais concorrentes' ); ?></span><small><?php sera_e( 'A cost of the outsourced setup', 'Um custo do modelo terceirizado' ); ?></small></div>
			<div class="stat is-word"><b><?php sera_e( 'Lost volume', 'Volume perdido' ); ?></b><span><?php sera_e( 'transactions the bank was failing to process every month', 'transações que o banco deixava de processar todo mês' ); ?></span><small><?php sera_e( 'Figures withheld', 'Números omitidos' ); ?></small></div>
			<div class="stat hl"><b><?php sera_e( '1 brain', '1 cérebro' ); ?></b><span><?php sera_e( 'The processor orchestrated every card operation. The team decided to bring its most critical part in-house: the authorizer.', 'O processador orquestrava toda operação do cartão. O time decidiu internalizar a parte mais crítica: o autorizador.' ); ?></span><small><?php sera_e( 'A change in the core of the card', 'Uma mudança no núcleo do cartão' ); ?></small></div>
		</div>
		<?php
		break;

	case 'wb-statement':
		?>
		<div class="statement">
			<span class="art-label"><?php sera_e( 'The opportunity', 'A oportunidade' ); ?></span>
			<p><?php sera_e( 'On paper it was a back-end migration. We saw the chance to give customers <em>control over time</em> on their own bill.', 'No papel, era uma migração de <span style="white-space:nowrap">back-end</span>. A gente viu ali a chance de devolver ao cliente <em>o controle do tempo</em> da própria fatura.' ); ?></p>
			<span class="by"><?php sera_e( 'How might we use the new authorizer so customers know what they’ve paid, what they’re paying and what they’ll pay?', 'Como podemos usar o novo autorizador para o cliente saber o que já pagou, o que está pagando e o que ainda vai pagar?' ); ?></span>
		</div>
		<?php
		break;

	case 'wb-quotes':
		?>
		<div class="quotes">
			<div class="quote"><p><?php sera_e( 'I use future bills to plan my purchases, but with this bank I need an Excel spreadsheet. It’s archaic.', 'Eu uso as faturas futuras pra planejar minhas compras, mas com esse banco eu preciso de uma planilha de Excel. É arcaico.' ); ?></p><span><?php sera_e( 'Customer interview', 'Entrevista com cliente' ); ?></span></div>
			<div class="quote"><p><?php sera_e( 'I paid, tried to use the card and couldn’t, even with the app saying everything was normal.', 'Paguei, fui usar o cartão e não consegui, mesmo com o app dizendo que estava tudo normal.' ); ?></p><span><?php sera_e( 'Customer interview', 'Entrevista com cliente' ); ?></span></div>
			<div class="quote"><p><?php sera_e( 'You see the bill one day and set the money aside. On the due date the amount is different, because an installment you thought was included shows up.', 'Você vê a fatura num dia e separa o dinheiro. No vencimento, o valor é outro, porque aparece uma parcela que você achava que já estava ali.' ); ?></p><span><?php sera_e( 'Customer interview', 'Entrevista com cliente' ); ?></span></div>
		</div>
		<?php
		break;

	case 'wb-pains':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Contact-rate data (analysed with AI) × interviews', 'Dados de taxa de contato (analisados com IA) × entrevistas' ); ?></span>
			<span class="art-title"><?php sera_e( 'Of five pains, one was making people reconsider the card.', 'Das cinco dores, uma fazia as pessoas repensarem o cartão.' ); ?></span>
			<ol class="pains">
				<li class="focus"><span><?php sera_e( 'Bills they couldn’t predict <em>our focus</em>', 'Faturas imprevisíveis <em>nosso foco</em>' ); ?></span></li>
				<li><span><?php sera_e( 'Services unavailable', 'Serviços fora do ar' ); ?></span></li>
				<li><span><?php sera_e( 'Trouble paying the bill', 'Dificuldade para pagar a fatura' ); ?></span></li>
				<li><span><?php sera_e( 'Bills closing late', 'Fatura fechando com atraso' ); ?></span></li>
				<li><span><?php sera_e( 'Can’t prepay installment purchases', 'Sem como antecipar compras parceladas' ); ?></span></li>
			</ol>
		</div>
		<?php
		break;

	case 'wb-framework':
		$pt = sera_is_pt();
		?>
		<div class="art-panel">
			<div class="venn-wrap wbv-wrap">
				<div>
					<span class="art-label"><?php sera_e( 'Benchmark + ideation', 'Benchmark + ideação' ); ?></span>
					<span class="art-title"><?php sera_e( 'Mastercard’s “Impeccable Basics”, then a workshop with the team and leadership.', 'Os “Básicos Impecáveis” da Mastercard, depois um workshop com o time e a liderança.' ); ?></span>
					<p class="wbv-copy"><?php sera_e( 'To fit the market better, we started from what already existed. With Mastercard, we mapped the essential credit card features in Brazil, the list Mastercard calls “The Impeccable Basics”. Then we brought research and market data to a workshop with the team and leadership, and prioritised ideas with a framework adapted from IDEO: what the business expects, what customers expect, and what the new authorizer could technically do.', 'Para nos encaixar melhor no mercado, partimos do que já existia. Com a Mastercard, mapeamos as funcionalidades essenciais de um cartão de crédito no Brasil, a lista que a Mastercard chama de “Básicos Impecáveis”. Depois levamos pesquisa e dados de mercado para um workshop com o time e a liderança, e priorizamos as ideias com um framework adaptado da IDEO: o que o negócio espera, o que o cliente espera e o que o novo autorizador conseguia fazer tecnicamente.' ); ?></p>
				</div>
				<figure class="wbv">
					<svg viewBox="0 -42 480 568" role="img" aria-labelledby="wbvT">
						<title id="wbvT"><?php sera_e( 'Framework: customer expectations, business needs and technical feasibility overlap on what we built: a real-time open bill and every installment from day one.', 'Framework: expectativas do cliente, necessidades do negócio e viabilidade técnica se cruzam no que construímos: a fatura aberta em tempo real e todas as parcelas desde o primeiro dia.' ); ?></title>
						<defs><pattern id="wbvHatch" width="7" height="7" patternUnits="userSpaceOnUse" patternTransform="rotate(45)"><line x1="0" y1="0" x2="0" y2="7" stroke="#26220F" stroke-opacity=".09" stroke-width="2"/></pattern><clipPath id="wbvK1"><circle cx="175" cy="180" r="150"/></clipPath><clipPath id="wbvK2" clip-path="url(#wbvK1)"><circle cx="305" cy="180" r="150"/></clipPath></defs>
						<circle class="wbv-c1" cx="175" cy="180" r="150"/>
						<circle class="wbv-c2" cx="305" cy="180" r="150"/>
						<circle class="wbv-c3" cx="240" cy="292.6" r="150"/>
						<circle class="wbv-c3h" cx="240" cy="292.6" r="150" fill="url(#wbvHatch)"/>
						<circle class="wbv-core" cx="240" cy="292.6" r="150" clip-path="url(#wbvK2)"/>
						<g class="wbv-lead" aria-hidden="true">
								<line x1="110" y1="18" x2="110" y2="39"/><circle cx="110" cy="45" r="3"/>
								<line x1="370" y1="18" x2="370" y2="39"/><circle cx="370" cy="45" r="3"/>
								<line x1="240" y1="449" x2="240" y2="468"/><circle cx="240" cy="442.6" r="3"/>
							</g>
							<g class="wbv-lbl">
								<text x="110" y="-14"><tspan class="wbv-t" x="110"><?php sera_e( 'Customer', 'Cliente' ); ?></tspan><tspan class="wbv-s" x="110" y="9"><?php sera_e( 'what people expect', 'o que o cliente espera' ); ?></tspan></text>
								<text x="370" y="-14"><tspan class="wbv-t" x="370"><?php sera_e( 'Business', 'Negócio' ); ?></tspan><tspan class="wbv-s" x="370" y="9"><?php sera_e( 'what will bank needs', 'o que o banco precisa' ); ?></tspan></text>
								<text x="240" y="494"><tspan class="wbv-t" x="240"><?php sera_e( 'Technical', 'Tecnologia' ); ?></tspan><tspan class="wbv-s" x="240" y="517"><?php sera_e( 'what the new authorizer can do', 'o que o novo autorizador faz' ); ?></tspan></text>
							</g>
						<?php if ( $pt ) : ?>
						<rect class="wbv-pill" x="174" y="208" width="132" height="40" rx="20"/>
						<?php else : ?>
						<rect class="wbv-pill" x="194" y="208" width="92" height="40" rx="20"/>
						<?php endif; ?>
						<text class="wbv-build" x="240" y="233.5"><?php sera_e( 'BUILD', 'CONSTRUIR' ); ?></text>
					</svg>
					<figcaption class="wbv-out">
						<span class="wbv-key"><i aria-hidden="true"></i><?php sera_e( 'Build', 'Construir' ); ?></span>
						<span class="wbv-arr" aria-hidden="true">→</span>
						<span class="wbv-items"><span><?php sera_e( 'Real-time open bill', 'Fatura aberta em tempo real' ); ?></span><span><?php sera_e( 'Every installment from day one', 'Todas as parcelas desde o 1º dia' ); ?></span></span>
					</figcaption>
				</figure>
			</div>
		</div>
		<?php
		break;

	case 'wb-before-after':
		?>
		<div class="ba">
			<div class="was"><h4><?php sera_e( 'How it was', 'Como era' ); ?></h4>
				<div class="row"><b><?php sera_e( 'Pending purchases were missing', 'Compras pendentes ficavam de fora' ); ?></b><span><?php sera_e( 'Purchases still being processed weren’t added to the open bill, so the amount on screen was out of date.', 'Compras ainda em processamento não entravam na fatura aberta, então o valor na tela ficava desatualizado.' ); ?></span></div>
				<div class="row"><b><?php sera_e( 'Bills opened incomplete', 'Faturas abriam incompletas' ); ?></b><span><?php sera_e( 'When a new bill opened, installments from earlier purchases didn’t show up yet. The amount changed later.', 'Quando uma fatura nova abria, as parcelas de compras anteriores ainda não apareciam. O valor mudava depois.' ); ?></span></div>
			</div>
			<div class="now"><h4><?php sera_e( 'How it became', 'Como ficou' ); ?></h4>
				<div class="row"><b><?php sera_e( 'Real-time open bill', 'Fatura aberta em tempo real' ); ?></b><span><?php sera_e( 'Every authorised purchase is added instantly, so customers control their spending as it happens.', 'Toda compra autorizada entra na hora, e o cliente controla os gastos enquanto eles acontecem.' ); ?></span></div>
				<div class="row"><b><?php sera_e( 'Every installment, from day one', 'Todas as parcelas, desde o primeiro dia' ); ?></b><span><?php sera_e( 'Bills open already including all installments from previous months, a feature not every card in Brazil offers.', 'A fatura já abre com todas as parcelas dos meses anteriores, algo que nem todo cartão no Brasil oferece.' ); ?></span></div>
			</div>
		</div>
		<?php
		break;

	case 'wb-lessons':
		?>
		<div class="art-grid cols-2">
			<div class="statement"><span class="art-label"><?php sera_e( 'The order of delivery', 'A ordem da entrega' ); ?></span><p><?php sera_e( 'We started with the present because <em>no one plans the coming months</em> on a bill that keeps changing. The past and the future came after.', 'Começamos pelo presente porque <em>ninguém planeja os próximos meses</em> em cima de uma fatura que muda. O passado e o futuro vieram depois.' ); ?></p></div>
			<div class="statement is-ca"><span class="art-label"><?php sera_e( 'One lesson', 'Uma lição' ); ?></span><p><?php sera_e( 'Prioritise what users ask for, and also what gives you a <em>competitive edge</em>.', 'Priorize o que o usuário pede, e também o que te dá <em>vantagem competitiva</em>.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'wb-impact':
		?>
		<div class="impact">
			<span class="art-label"><?php sera_e( 'Impact · test group vs. control group', 'Impacto · grupo de teste vs. grupo de controle' ); ?></span>
			<h3><?php sera_e( 'An infrastructure migration became control over time for customers.', 'Uma migração de infraestrutura virou controle do tempo para o cliente.' ); ?></h3>
			<div class="impact-grid cols-3">
				<div><b>A/B</b><span><?php sera_e( 'Rolled out against a control group', 'Lançado contra um grupo de controle' ); ?></span></div>
				<div><b>CSAT &amp;&nbsp;NPS&nbsp;<span class="arr">↑</span></b><span><?php sera_e( 'Higher in the test group than in control', 'Maiores no grupo de teste do que no de controle' ); ?></span></div>
				<div><b><?php sera_e( 'Contacts', 'Contatos' ); ?>&nbsp;<span class="arr">↓</span></b><span><?php sera_e( 'Fewer tickets in the test group', 'Menos chamados no grupo de teste' ); ?></span></div>
			</div>
			<div class="impact-foot"><span><?php sera_e( 'Controlled rollout, A/B by design', 'Rollout controlado, A/B desde o desenho' ); ?></span><span><?php sera_e( 'Features not every card in Brazil offered', 'Funcionalidades que nem todo cartão no Brasil oferecia' ); ?></span><span><?php sera_e( 'An authorizer other teams built on', 'Um autorizador em que outros times construíram' ); ?></span></div>
		</div>
		<?php
		break;

	case 'wb-next':
		?>
		<div class="temporal">
			<div><small><?php sera_e( 'The past', 'O passado' ); ?></small><h4><?php sera_e( 'Closed bills', 'Faturas fechadas' ); ?></h4><p><?php sera_e( 'Everything already charged, with no surprises.', 'Tudo o que já foi cobrado, sem surpresas.' ); ?></p></div>
			<div class="now"><small><?php sera_e( 'The present', 'O presente' ); ?></small><h4><?php sera_e( 'The open bill', 'A fatura aberta' ); ?></h4><p><?php sera_e( 'Updated in real time, every purchase and every installment included.', 'Atualizada em tempo real, com cada compra e cada parcela.' ); ?></p></div>
			<div><small><?php sera_e( 'The future', 'O futuro' ); ?></small><h4><?php sera_e( 'Future bills', 'Faturas futuras' ); ?></h4><p><?php sera_e( 'What’s already committed for the next months, so no one needs a spreadsheet to plan.', 'O que já está comprometido nos próximos meses, para ninguém precisar de planilha para se planejar.' ); ?></p></div>
		</div>
		<p class="art-cap"><?php sera_e( '“Temporal Control”: the direction that came out of the workshop. Each part became a delivery.', '“Controle Temporal”: o norte que saiu do workshop. Cada parte virou entrega.' ); ?></p>
		<?php
		break;

	case 'wb-process':
		$steps = array(
			array( sera_t( 'Desk research', 'Desk research' ), sera_t( 'Contact-rate data analysed with AI, then interviews. Five pains found, one chosen as focus.', 'Dados de taxa de contato analisados com IA, depois entrevistas. Cinco dores encontradas, uma escolhida como foco.' ), sera_t( 'User perspective', 'Visão do usuário' ) ),
			array( sera_t( 'Benchmark', 'Benchmark' ), sera_t( 'With Mastercard, the essential card features in Brazil: the “Impeccable Basics”.', 'Com a Mastercard, as funcionalidades essenciais de um cartão no Brasil: os “Básicos Impecáveis”.' ), sera_t( 'Market perspective', 'Visão de mercado' ) ),
			array( sera_t( 'Ideation', 'Ideação' ), sera_t( 'A workshop with leadership, prioritised with a framework adapted from IDEO.', 'Um workshop com a liderança, priorizado com um framework adaptado da IDEO.' ), sera_t( 'Team and leadership', 'Time e liderança' ) ),
			array( sera_t( 'Prototyping', 'Prototipação' ), sera_t( 'Low fidelity with engineering, high fidelity in usability tests.', 'Baixa fidelidade com a engenharia, alta fidelidade nos testes de usabilidade.' ), sera_t( 'Engineering, then customers', 'Engenharia, depois clientes' ) ),
			array( sera_t( 'Deliveries', 'Entregas' ), sera_t( 'A predictable open bill first, then the past and the future.', 'Primeiro a fatura aberta previsível, depois o passado e o futuro.' ), sera_t( 'Backlog', 'Backlog' ), 'key' ),
			array( sera_t( 'Impact', 'Impacto' ), sera_t( 'A controlled rollout, measured against a control group.', 'Um rollout controlado, medido contra um grupo de controle.' ), sera_t( 'Test vs. control', 'Teste vs. controle' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'How the work ran · six stages', 'Como o trabalho rodou · seis etapas' ); ?></span>
			<span class="art-title"><?php sera_e( 'Each stage added a perspective before anything reached the backlog.', 'Cada etapa somou uma perspectiva antes de qualquer coisa chegar ao backlog.' ); ?></span>
			<?php echo sera_timeline( $steps ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
		<?php
		break;

	case 'wb-bill-model':
		$wbb_phone = static function ( $after ) {
			$rows = array(
				array( 'cart', 'Padaria', 'Ontem', 'R$ 18,50' ),
				array( 'bus', 'Recarga do ônibus', 'Seg', 'R$ 40,00' ),
			);
			$h  = '<div class="wb-yellow wbb-yellow"></div><div class="wb-rel">';
			$h .= '<div class="wb-head">' . sera_s_icon( 'chev-l' ) . '<h5>cartão de crédito</h5><span class="wb-q">?</span></div>';
			$h .= '<div class="wbb-pills"><span class="wb-pill wbb-pill">' . sera_s_icon( 'info' ) . 'Fatura aberta</span>';
			if ( $after ) {
				$h .= '<span class="wbb-live">' . sera_s_icon( 'sync' ) . 'Atualizada agora</span>';
			}
			$h .= '</div>';
			$h .= '<div class="wbb-amt"><span class="wbb-cur">R$</span>';
			if ( $after ) {
				$h .= '<span class="wbb-roll"><span class="wbb-roll-in"><span>1.226,70</span><span>1.316,60</span></span></span>';
			} else {
				$h .= '<span class="wbb-roll is-still"><span class="wbb-roll-in"><span>1.226,70</span></span></span>';
			}
			$h .= '</div>';
			$h .= '<div class="wbb-due">Vence 12 jan · fecha 02 jan</div>';
			$h .= '</div>';
			$h .= '<div class="wbb-sec">Últimas compras</div>';
			$h .= '<ul class="wb-list wbb-list">';
			$h .= '<li class="wbb-new"><span class="ic y">' . sera_s_icon( 'at' ) . '</span><div class="l"><b>Mercado Livre</b><span>Hoje · 14:02</span></div><div class="r"><b>R$ 89,90</b>';
			$h .= $after ? '<span class="wbb-st ok">Na fatura</span>' : '<span class="wbb-st pend">Pendente</span>';
			$h .= '</div></li>';
			foreach ( $rows as $r ) {
				$h .= '<li class="wbb-old"><span class="ic">' . sera_s_icon( $r[0] ) . '</span><div class="l"><b>' . $r[1] . '</b><span>' . $r[2] . '</span></div><div class="r"><b>' . $r[3] . '</b><span>Na fatura</span></div></li>';
			}
			$h .= '</ul>';
			if ( $after ) {
				$h .= '<div class="wbb-toast is-ok">' . sera_s_icon( 'check' ) . '<span><b>Fatura atualizada</b>R$ 89,90 já está no total</span></div>';
			} else {
				$h .= '<div class="wbb-toast">' . sera_s_icon( 'bell' ) . '<span><b>Vencimento</b>R$ 89,90 a mais do que você planejou</span></div>';
			}
			return $h;
		};
		?>
		<div class="art-panel wbb-panel">
			<span class="art-label"><?php sera_e( 'The mental model · how customers read the bill', 'O modelo mental · como o cliente lê a fatura' ); ?></span>
			<span class="art-title"><?php sera_e( 'The open bill is the budget. The old brain showed only part of it.', 'A fatura aberta é o orçamento. O cérebro antigo mostrava só uma parte dela.' ); ?></span>
			<div class="wbb mk-anim">
				<input class="wbb-r" type="radio" name="wbb-view" id="wbb-v-before" checked>
				<input class="wbb-r" type="radio" name="wbb-view" id="wbb-v-after">
				<div class="wbb-tog"><label for="wbb-v-before"><?php sera_e( 'Before', 'Antes' ); ?></label><label for="wbb-v-after"><?php sera_e( 'After', 'Depois' ); ?></label></div>
				<figure class="wbb-col is-before">
					<div class="wbb-crop"><?php echo sera_device( 'scr-wb wbb-scr', $wbb_phone( false ), array( 'label' => sera_t( 'Before: a new R$ 89,90 purchase stays pending, the open bill still shows R$ 1.226,70, and on the due date the bill is R$ 89,90 higher than planned.', 'Antes: uma compra nova de R$ 89,90 fica pendente, a fatura aberta continua mostrando R$ 1.226,70 e, no vencimento, a fatura vem R$ 89,90 mais alta do que o planejado.' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<figcaption><b><?php sera_e( 'Before', 'Antes' ); ?></b><span><?php sera_e( 'The bill you planned for wasn’t the bill you paid', 'A fatura que você planejou não era a fatura que você pagava' ); ?></span></figcaption>
				</figure>
				<figure class="wbb-col is-after">
					<div class="wbb-crop"><?php echo sera_device( 'scr-wb wbb-scr', $wbb_phone( true ), array( 'label' => sera_t( 'After: the same R$ 89,90 purchase is added to the open bill at once, which updates from R$ 1.226,70 to R$ 1.316,60.', 'Depois: a mesma compra de R$ 89,90 entra na fatura aberta na hora, e o total passa de R$ 1.226,70 para R$ 1.316,60.' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<figcaption><b><?php sera_e( 'After', 'Depois' ); ?></b><span><?php sera_e( 'You pay the bill you see', 'Você paga a fatura que vê' ); ?></span></figcaption>
				</figure>
			</div>
			<p class="art-cap"><?php sera_e( 'Simulation with fictional amounts. Installments from earlier months had the same gap, and became the second delivery.', 'Simulação com valores fictícios. As parcelas de meses anteriores tinham a mesma lacuna, e viraram a segunda entrega.' ); ?></p>
		</div>
		<?php
		break;

	case 'wb-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><?php sera_e( '<li>Reading the tickets before the interviews: the contact-rate data said where it hurt, the customers said why</li><li>Shipping the two basics first. A predictable bill was what made the rest of Temporal Control useful</li>', '<li>Ler os chamados antes das entrevistas: os dados de contato diziam onde doía, os clientes diziam por quê</li><li>Entregar os dois básicos primeiro. Era a fatura previsível que dava sentido ao resto do Controle Temporal</li>' ); ?></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><?php sera_e( '<li>Frame the migration as a product opportunity before the engineering plan was set</li><li>Measure the control group on the bill-related contacts alone, so the result can be attributed to the change</li>', '<li>Enquadrar a migração como oportunidade de produto antes de o plano de engenharia estar fechado</li><li>Medir o grupo de controle só nos contatos sobre fatura, para o resultado poder ser atribuído à mudança</li>' ); ?></ul></div>
		</div>
		<?php
		break;

	case 'wb-signals':
		?>
		<div class="signals">
			<div><i>01</i><b><?php sera_e( 'Saw a product in an infrastructure ticket', 'Vi um produto num ticket de infraestrutura' ); ?></b><span><?php sera_e( 'A back-end migration became a chance to fix what customers complained about most.', 'Uma migração de back-end virou a chance de resolver o que mais fazia o cliente reclamar.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'Let the data pick the pain', 'Deixei os dados escolherem a dor' ); ?></b><span><?php sera_e( 'Chat transcripts classified by cause, then interviews to understand what the biggest one meant.', 'Transcrições de chat classificadas por causa, depois entrevistas para entender o que a maior delas significava.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Benchmarked before inventing', 'Fiz benchmark antes de inventar' ); ?></b><span><?php sera_e( 'With Mastercard, mapped what every card in Brazil is expected to do, and found our gap.', 'Com a Mastercard, mapeei o que se espera de todo cartão no Brasil, e achei a nossa lacuna.' ); ?></span></div>
			<div><i>04</i><b><?php sera_e( 'Prototyped for feasibility first', 'Prototipei pela viabilidade primeiro' ); ?></b><span><?php sera_e( 'Low fidelity with engineering, because everything depended on what the new authorizer could do.', 'Baixa fidelidade com a engenharia, porque tudo dependia do que o novo autorizador conseguia fazer.' ); ?></span></div>
			<div><i>05</i><b><?php sera_e( 'Measured the result', 'Medi o resultado' ); ?></b><span><?php sera_e( 'A gradual rollout, with the test group compared to a control group.', 'Um rollout gradual, com o grupo de teste comparado a um grupo de controle.' ); ?></span></div>
			<div><i>06</i><b><?php sera_e( 'Turned a migration into a roadmap', 'Transformei uma migração em roadmap' ); ?></b><span><?php sera_e( 'Temporal Control shipped, and other teams built on the same authorizer.', 'O Controle Temporal saiu do papel, e outros times construíram sobre o mesmo autorizador.' ); ?></span></div>
		</div>
		<?php
		break;

endswitch;
