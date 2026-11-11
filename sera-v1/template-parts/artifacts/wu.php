<?php
/**
 * Artifacts — Western Union · Digital account onboarding.
 * Company financials and internal rates (conversion, attempts, shares) omitted:
 * results are told as direction and size, not as figures.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

switch ( $args['name'] ) :

	case 'wu-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Product', 'Produto' ); ?></dt><dd><?php sera_e( 'Western Union digital account in Brazil: Pix, bills and essential banking', 'Conta digital da Western Union no Brasil: Pix, pagamento de contas e o essencial de um banco' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Specialist Product Designer, acting as Designer + PO', 'Product Designer Especialista, atuando como Designer + PO' ); ?></dd></div>
			<div><dt><?php sera_e( 'Worked with', 'Trabalhei com' ); ?></dt><dd><?php sera_e( 'A lean engineering squad, Compliance, Legal and LATAM leadership', 'Um squad de engenharia enxuto, Compliance, Jurídico e a liderança LATAM' ); ?></dd></div>
			<div><dt><?php sera_e( 'Timeline', 'Período' ); ?></dt><dd>2025–26</dd></div>
		</dl>
		<div class="glance-did"><dt class="art-label"><?php sera_e( 'What I owned', 'O que ficou comigo' ); ?></dt><ul><?php sera_e( '<li>Discovery with zero budget</li><li>Problem definition</li><li>Strategy &amp; roadmap</li><li>UX, UI and UX writing</li><li>Backlog and release decisions</li><li>Stakeholder alignment</li>', '<li>Discovery com orçamento zero</li><li>Definição do problema</li><li>Estratégia e roadmap</li><li>UX, UI e UX writing</li><li>Backlog e decisões de release</li><li>Alinhamento com stakeholders</li>' ); ?></ul></div>
		<?php
		break;

	case 'wu-constraints':
		?>
		<div class="art-grid cols-4">
			<div class="art-card"><span class="art-label">01</span><h4 style="margin-top:14px"><?php sera_e( 'No research budget', 'Sem orçamento de pesquisa' ); ?></h4><p><?php sera_e( 'No recruiting, no panels, no paid tools beyond what we already had.', 'Sem recrutamento, sem painel, sem ferramenta paga além do que a gente já tinha.' ); ?></p></div>
			<div class="art-card"><span class="art-label">02</span><h4 style="margin-top:14px"><?php sera_e( 'No OCR or liveness', 'Sem OCR nem prova de vida' ); ?></h4><p><?php sera_e( 'A vendor would have solved part of it, but there was no budget for one yet.', 'Um fornecedor resolveria parte do problema, mas ainda não havia orçamento para isso.' ); ?></p></div>
			<div class="art-card"><span class="art-label">03</span><h4 style="margin-top:14px"><?php sera_e( 'A lean engineering team', 'Um time de engenharia enxuto' ); ?></h4><p><?php sera_e( 'Every change had to earn its place in a short backlog.', 'Cada mudança precisava merecer seu lugar num backlog curto.' ); ?></p></div>
			<div class="art-card"><span class="art-label">04</span><h4 style="margin-top:14px"><?php sera_e( 'Compliance on every step', 'Compliance em cada etapa' ); ?></h4><p><?php sera_e( 'Legal and Compliance approved each change, in every step of the funnel.', 'Jurídico e Compliance aprovavam cada mudança, em todas as etapas do funil.' ); ?></p></div>
		</div>
		<div class="econ-rule" style="background:#FFF6B8"><span><?php sera_e( '<b>The strategy:</b> exhaust what UX and technical stability can do before asking for money for a third-party vendor. Then use the results to ask for it.', '<b>A estratégia:</b> esgotar tudo o que UX e estabilidade técnica conseguem fazer antes de pedir dinheiro para um fornecedor externo. Depois, usar os resultados para pedir.' ); ?></span></div>
		<?php
		break;

	case 'wu-triangle':
		?>
		<div class="art-panel art-dark">
			<span class="art-label"><?php sera_e( 'Research without a budget', 'Pesquisa sem orçamento' ); ?></span>
			<span class="art-title"><?php sera_e( 'Three sources we already had, to find out why people failed the document step.', 'Três fontes que a gente já tinha, para entender por que as pessoas travavam na etapa do documento.' ); ?></span>
			<div class="tri" style="margin-top:32px">
				<div><span class="n">1</span><h4><?php sera_e( 'Session analytics', 'Analytics de sessão' ); ?></h4><ul><?php sera_e( '<li>Repeated re-uploads</li><li>Going back a screen (hesitation)</li><li>Abandonment right after opening the camera</li><li>Rage taps and erratic navigation</li>', '<li>Reenvios em sequência</li><li>Voltar uma tela (hesitação)</li><li>Abandono logo depois de abrir a câmera</li><li>Rage taps e navegação errática</li>' ); ?></ul></div>
				<div><span class="n">2</span><h4><?php sera_e( 'Physical stores', 'Lojas físicas' ); ?></h4><ul><?php sera_e( '<li>Where customers go when something breaks</li><li>Staff see the same patterns every day</li><li>The customer’s real words, for free</li>', '<li>É para lá que o cliente vai quando algo dá errado</li><li>A equipe vê os mesmos padrões todo dia</li><li>As palavras reais do cliente, de graça</li>' ); ?></ul></div>
				<div class="key"><span class="n">3</span><h4><?php sera_e( 'The rejected documents', 'Os documentos recusados' ); ?></h4><ul><?php sera_e( '<li>Asked for the batch of rejected photos</li><li>Categorised every rejection reason</li><li>Looked for the pattern behind them</li>', '<li>Pedi o lote de fotos recusadas</li><li>Categorizei cada motivo de recusa</li><li>Procurei o padrão por trás delas</li>' ); ?></ul></div>
			</div>
		</div>
		<?php
		break;

	case 'wu-voices':
		?>
		<div class="quotes">
			<div class="quote"><p><?php sera_e( 'I’m sending the right document and it keeps getting rejected.', 'Tô mandando o documento certo e ele continua sendo recusado.' ); ?></p><span><?php sera_e( 'Customer at a store', 'Cliente na loja' ); ?></span></div>
			<div class="quote"><p><?php sera_e( 'I don’t understand what’s wrong.', 'Não entendo o que está errado.' ); ?></p><span><?php sera_e( 'Customer at a store', 'Cliente na loja' ); ?></span></div>
			<div class="quote"><p><?php sera_e( 'Some of the texts are confusing, or in English.', 'Alguns textos são confusos, ou estão em inglês.' ); ?></p><span><?php sera_e( 'Customer at a store', 'Cliente na loja' ); ?></span></div>
		</div>
		<?php
		break;

	case 'wu-audit':
		?>
		<div class="art-panel art-dark">
			<div class="audit">
				<div>
					<span class="art-label"><?php sera_e( 'The audit of rejected documents', 'A auditoria dos documentos recusados' ); ?></span>
					<div class="audit-ids" style="margin-top:22px">
						<figure><?php echo sera_wu_id_svg( 'front' ); // phpcs:ignore ?><figcaption><?php sera_e( 'Photo 1 · front', 'Foto 1 · frente' ); ?></figcaption></figure>
						<span class="plus">+</span>
						<figure><?php echo sera_wu_id_svg( 'front' ); // phpcs:ignore ?><span class="x">✕</span><figcaption><?php sera_e( 'Photo 2 · front again', 'Foto 2 · frente de novo' ); ?></figcaption></figure>
					</div>
				</div>
				<div class="audit-num">
					<b><?php sera_e( 'Most', 'A maioria' ); ?></b>
					<p><?php sera_e( 'rejections were the same mistake: the front of the ID sent twice, instead of front and back.', 'das recusas era o mesmo erro: a frente do documento enviada duas vezes, no lugar de frente e verso.' ); ?></p>
					<div class="audit-bar" aria-hidden="true"><i></i></div>
				</div>
			</div>
		</div>
		<?php
		break;

	case 'wu-statement':
		?>
		<div class="statement" style="background:#0D0D0D">
			<span class="art-label"><?php sera_e( 'The insight', 'O insight' ); ?></span>
			<p><?php sera_e( 'The photos were usually fine. The rejections came from <em>an ambiguous instruction</em>, two steps that looked the same, and feedback that arrived too late.', 'As fotos, em geral, estavam boas. As recusas vinham de <em>uma instrução ambígua</em>, de duas etapas que pareciam iguais e de um feedback que chegava tarde.' ); ?></p>
			<span class="by"><?php sera_e( 'So the work focused on preventing the error before the photo was sent.', 'Por isso o trabalho se concentrou em evitar o erro antes do envio da foto.' ); ?></span>
		</div>
		<?php
		break;

	case 'wu-solutions':
		?>
		<div class="decisions">
			<div><i>01</i><div><b><?php sera_e( 'One step per side', 'Uma etapa para cada lado' ); ?></b><span><?php sera_e( '“Step 1 of 2: FRONT” and “Step 2 of 2: BACK”, each with its own illustration, and the second on a different background so it can’t be mistaken for the first.', '“Etapa 1 de 2: FRENTE” e “Etapa 2 de 2: PARTE DE TRÁS”, cada uma com sua ilustração, e a segunda num fundo diferente, para não ser confundida com a primeira.' ); ?></span></div></div>
			<div><i>02</i><div><b><?php sera_e( 'A framing guide in the camera', 'Um guia de enquadramento na câmera' ); ?></b><span><?php sera_e( 'Clearer instructions and a frame that shows exactly where the document goes.', 'Instruções mais claras e uma moldura que mostra exatamente onde o documento entra.' ); ?></span></div></div>
			<div><i>03</i><div><b><?php sera_e( 'Confirm before sending', 'Confirmar antes de enviar' ); ?></b><span><?php sera_e( '“Is this the back of the document?” and “Is it legible?”. ', '“Essa é uma foto da parte de trás do documento?” e “A foto está legível?”.' ); ?></span></div></div>
			<div><i>04</i><div><b><?php sera_e( 'Translation QA across the funnel', 'QA de tradução no funil inteiro' ); ?></b><span><?php sera_e( 'Screen titles and error messages that still showed up in English, such as on the SMS code screen, now in Portuguese.', 'Títulos de tela e mensagens de erro que ainda apareciam em inglês, como na tela do código por SMS, agora em português.' ); ?></span></div></div>
			<div><i>05</i><div><b><?php sera_e( 'Remove what the account doesn’t need', 'Tirar o que a conta não precisa' ); ?></b><span><?php sera_e( 'Two steps asked for data only required to send money abroad. With Compliance and LATAM leadership, they moved to after the account opens.', 'Duas etapas pediam dados exigidos só para enviar dinheiro ao exterior. Com Compliance e a liderança LATAM, elas foram para depois da abertura da conta.' ); ?></span></div></div>
			<div><i>06</i><div><b><?php sera_e( 'Shorter copy', 'Textos mais curtos' ); ?></b><span><?php sera_e( 'After testing: shorter texts, with the one thing that matters in bold and underlined.', 'Depois dos testes: textos mais curtos, com a única coisa que importa em negrito e sublinhada.' ); ?></span></div></div>
		</div>
		<?php
		break;

	case 'wu-testing':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label"><?php sera_e( 'Method', 'Método' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Customers, in the stores', 'Clientes, nas lojas' ); ?></h4><p><?php sera_e( 'Task: open an account, with the focus on the document step, using the new prototypes.', 'Tarefa: abrir uma conta, com foco na etapa do documento, usando os novos protótipos.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'What we saw', 'O que vimos' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'The confusion was gone', 'A confusão sumiu' ); ?></h4><p><?php sera_e( 'Clearer texts ended the “two fronts” mistake. The new camera and the checkboxes gave people confidence in the task.', 'Textos mais claros acabaram com o erro das “duas frentes”. A nova câmera e os checkboxes deram segurança para concluir a tarefa.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'What changed', 'O que mudou' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Less text, one checkbox fewer', 'Menos texto, um checkbox a menos' ); ?></h4><p><?php sera_e( 'We cut copy to the minimum, highlighted the key words, and removed one of the confirmation checkboxes.', 'Cortamos o texto ao mínimo, destacamos as palavras-chave e tiramos um dos checkboxes de confirmação.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'wu-release':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Release history · onboarding conversion', 'Histórico de releases · conversão do onboarding' ); ?></span>
			<span class="art-title"><?php sera_e( 'The first release made it worse. We treated it as an incident.', 'O primeiro release piorou a conversão. Tratamos como incidente.' ); ?></span>
			<div class="chart-wrap" style="margin-top:32px">
				<div class="chart">
					<?php // phone version: narrower canvas so the labels stay readable at real size ?>
					<svg class="wu-rel-m" viewBox="0 0 340 310" role="img" aria-label="<?php echo esc_attr( sera_t( 'Onboarding conversion: release 1 dropped sharply, release 2 climbed above the OKR target, reaching an all-time record in January 2026.', 'Conversão do onboarding: o release 1 caiu forte, o release 2 subiu acima da meta do OKR e chegou ao recorde histórico em janeiro de 2026.' ) ); ?>">
						<line x1="12" y1="112" x2="328" y2="112" stroke="#111110" stroke-dasharray="4 6" stroke-width="1.2"/>
						<text x="14" y="102" font-size="13" fill="#6E6C66"><?php sera_e( 'OKR target', 'Meta do OKR' ); ?></text>
						<line x1="12" y1="276" x2="328" y2="276" stroke="#E2E0D8"/>
						<path d="M24 140 C 64 140, 84 202, 116 202 S 156 202, 182 160 S 230 116, 252 108 S 300 96, 314 92" fill="none" stroke="#111110" stroke-width="3" stroke-linecap="round"/>
						<circle cx="116" cy="202" r="15" fill="#E5484D" opacity=".18"/><circle cx="116" cy="202" r="8" fill="#E5484D"/>
						<circle cx="252" cy="108" r="7" fill="#111110"/>
						<circle cx="314" cy="92" r="10" fill="#FFDD00" stroke="#111110" stroke-width="2.5"/>
						<text x="116" y="236" text-anchor="middle" font-size="16" font-weight="600" fill="#B42318"><?php sera_e( 'Sharp dip', 'Queda forte' ); ?></text>
						<text x="116" y="255" text-anchor="middle" font-size="13" fill="#6E6C66">Release 1</text>
						<text x="328" y="140" text-anchor="end" font-size="13" fill="#6E6C66">Release 2</text>
						<text x="328" y="157" text-anchor="end" font-size="13" fill="#6E6C66"><?php sera_e( 'above target', 'acima da meta' ); ?></text>
						<text x="328" y="44" text-anchor="end" font-size="16" font-weight="600" fill="#111110"><?php sera_e( 'All-time record', 'Recorde histórico' ); ?></text>
						<text x="328" y="63" text-anchor="end" font-size="13" fill="#6E6C66"><?php sera_e( 'Jan 2026', 'jan. 2026' ); ?></text>
						<text x="14" y="298" font-size="13" fill="#6E6C66"><?php sera_e( 'Before', 'Antes' ); ?></text>
						<text x="328" y="298" text-anchor="end" font-size="13" fill="#6E6C66"><?php sera_e( 'Oct 2025 → Jan 2026', 'out. 2025 → jan. 2026' ); ?></text>
					</svg>
					<svg class="wu-rel-d" viewBox="0 0 640 320" role="img" aria-label="<?php echo esc_attr( sera_t( 'Onboarding conversion: release 1 dropped sharply, release 2 climbed above the OKR target, reaching an all-time record in January 2026.', 'Conversão do onboarding: o release 1 caiu forte, o release 2 subiu acima da meta do OKR e chegou ao recorde histórico em janeiro de 2026.' ) ); ?>">
						<line x1="40" y1="100" x2="620" y2="100" stroke="#111110" stroke-dasharray="4 6" stroke-width="1.2"/>
						<text x="44" y="90" font-size="12" fill="#6E6C66"><?php sera_e( 'OKR target', 'Meta do OKR' ); ?></text>
						<g stroke="#E2E0D8"><line x1="40" y1="280" x2="620" y2="280"/></g>
						<path d="M60 128 C 120 128, 150 200, 200 200 S 260 200, 300 150 S 380 104, 420 96 S 520 84, 600 80" fill="none" stroke="#111110" stroke-width="3" stroke-linecap="round"/>
						<circle cx="200" cy="200" r="9" fill="#E5484D"/><circle cx="200" cy="200" r="16" fill="#E5484D" opacity=".18"/>
						<circle cx="420" cy="96" r="8" fill="#111110"/>
						<circle cx="600" cy="80" r="11" fill="#FFDD00" stroke="#111110" stroke-width="2.5"/>
						<text x="200" y="236" text-anchor="middle" font-size="15" font-weight="600" fill="#B42318"><?php sera_e( 'Sharp dip', 'Queda forte' ); ?></text>
						<text x="200" y="256" text-anchor="middle" font-size="12" fill="#6E6C66">Release 1</text>
						<text x="420" y="130" text-anchor="middle" font-size="12" fill="#6E6C66"><?php sera_e( 'Release 2 · above target', 'Release 2 · acima da meta' ); ?></text>
						<text x="600" y="58" text-anchor="end" font-size="15" font-weight="600" fill="#111110"><?php sera_e( 'All-time record · Jan 2026', 'Recorde histórico · jan. 2026' ); ?></text>
						<text x="60" y="300" font-size="12" fill="#6E6C66"><?php sera_e( 'Before', 'Antes' ); ?></text>
						<text x="600" y="300" text-anchor="end" font-size="12" fill="#6E6C66"><?php sera_e( 'Oct 2025 → Jan 2026', 'out. 2025 → jan. 2026' ); ?></text>
					</svg>
				</div>
				<div class="chart-notes">
					<p class="art-cap" style="margin:0"><?php sera_e( 'Illustrative curve. The real figures stay with Western Union.', 'Curva ilustrativa. Os números reais ficam com a Western Union.' ); ?></p>
					<div class="bad"><b><?php sera_e( 'What broke', 'O que quebrou' ); ?></b><span><?php sera_e( 'The camera-overlay plugin was too heavy and crashed entry-level phones before the capture finished. And almost every rejected PDF was a scan, not a valid digital document.', 'O plugin da moldura da câmera era pesado demais e travava celulares de entrada antes de terminar a captura. E quase todo PDF recusado era um documento escaneado, não um documento digital válido.' ); ?></span></div>
					<div><b><?php sera_e( 'How we fixed it', 'Como corrigimos' ); ?></b><span><?php sera_e( 'An engineering task force removed the crash. Product removed the PDF option. We rolled out again.', 'Uma força-tarefa de engenharia acabou com o travamento. Produto tirou a opção de PDF. Lançamos de novo.' ); ?></span></div>
					<div><b><?php sera_e( 'What stayed', 'O que ficou' ); ?></b><span><?php sera_e( 'A QA routine on entry-level devices, an internal device lab with the three most-used Androids, a release checklist for critical flows and easier rollbacks.', 'Uma rotina de QA em aparelhos de entrada, um device lab interno com os três Androids mais usados, um checklist de release para fluxos críticos e rollbacks mais fáceis.' ); ?></span></div>
				</div>
			</div>
		</div>
		<?php
		break;

	case 'wu-impact':
		?>
		<div class="impact" style="background:#0D0D0D">
			<span class="art-label"><?php sera_e( 'Impact', 'Impacto' ); ?></span>
			<h3><?php sera_e( 'A double-digit gain in onboarding conversion from UX and stability work, with no research budget and no OCR vendor.', 'Um ganho de dois dígitos na conversão do onboarding, vindo de UX e estabilidade, sem orçamento de pesquisa e sem fornecedor de OCR.' ); ?></h3>
			<div class="impact-grid">
				<div><b><?php sera_e( 'Record', 'Recorde' ); ?></b><span><?php sera_e( 'All-time high onboarding conversion, in January 2026, above the OKR', 'A maior conversão de onboarding da história, em janeiro de 2026, acima do OKR' ); ?></span></div>
				<div><b><?php sera_e( 'Double-digit', 'Dois dígitos' ); ?></b><span><?php sera_e( 'Conversion gain delivered by UX and stability, before any vendor', 'De ganho de conversão com UX e estabilidade, antes de qualquer fornecedor' ); ?></span></div>
				<div><b><?php sera_e( 'Fewer', 'Menos' ); ?></b><span><?php sera_e( 'Document attempts per customer, much closer to one', 'Tentativas de envio por cliente, muito mais perto de uma só' ); ?></span></div>
				<div><b>~2 <small class="u">min</small></b><span><?php sera_e( 'Removed from the funnel by moving two steps to after the account opens', 'A menos no funil, com duas etapas movidas para depois da abertura da conta' ); ?></span></div>
			</div>
			<div class="impact-foot"><span><?php sera_e( 'Proven ROI turned into budget for an identity-verification vendor', 'ROI comprovado virou orçamento para um fornecedor de verificação de identidade' ); ?></span><span><?php sera_e( 'Next goal: a higher OKR', 'Próxima meta: um OKR mais alto' ); ?></span></div>
		</div>
		<?php
		break;

	case 'wu-error-screen':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The old rejection message · annotated', 'A antiga mensagem de recusa · anotada' ); ?></span>
			<span class="art-title"><?php sera_e( 'The error screen explained the wrong problem, after the attempt was already spent.', 'A tela de erro explicava o problema errado, e só depois que a tentativa já tinha sido gasta.' ); ?></span>
			<div class="wuerr">
				<div class="wuerr-phone" aria-label="<?php echo esc_attr( sera_t( 'Old rejection screen, in Portuguese: we couldn’t validate the photo of your RG or RNE; take the document out of the plastic; make sure the information is legible; if the problem persists, contact customer service.', 'Antiga tela de recusa: não conseguimos validar a foto do seu RG ou RNE; retire o documento do plástico; garanta que as informações estejam legíveis; se o problema persistir, procure o Atendimento ao Cliente.' ) ); ?>">
					<div class="wuerr-bar"><i></i><i></i></div>
					<span class="wuerr-ico" aria-hidden="true">!</span>
					<b class="wuerr-h">Não conseguimos validar a foto do seu RG ou RNE<em class="pin">A</em></b>
					<ol>
						<li><span>1</span>Retire o documento do plástico</li>
						<li><span>2</span>Garanta que todas as informações estejam legíveis na foto<em class="pin">B</em></li>
					</ol>
					<div class="wuerr-help">Se o problema persistir, procure nosso Atendimento ao Cliente<small>Telefone · Segunda a Sábado · 08:00 às 18:00</small><em class="pin">C</em></div>
				</div>
				<ol class="wuerr-notes">
					<li><em class="pin">A</em><div><b><?php sera_e( 'It arrives after the failure', 'Chega depois da falha' ); ?></b><span><?php sera_e( 'The customer only learns something is wrong once a photo has been rejected, so every lesson costs an attempt.', 'O cliente só descobre que algo está errado quando a foto já foi recusada. Cada aprendizado custa uma tentativa.' ); ?></span></div></li>
					<li><em class="pin">B</em><div><b><?php sera_e( 'It names causes almost nobody had', 'Aponta causas que quase ninguém tinha' ); ?></b><span><?php sera_e( 'Plastic sleeves and legibility. It never mentions the back of the document, which was behind most rejections.', 'Plástico e legibilidade. Nunca fala do verso do documento, que estava por trás da maioria das recusas.' ); ?></span></div></li>
					<li><em class="pin">C</em><div><b><?php sera_e( 'The fallback is a phone line', 'O plano B é um telefone' ); ?></b><span><?php sera_e( 'If it fails again, the product hands the problem to customer service, and customers end up telling the stores “I don’t understand what’s wrong”.', 'Se falhar de novo, o produto empurra o problema para o atendimento, e o cliente acaba dizendo na loja “não entendo o que está errado”.' ); ?></span></div></li>
				</ol>
			</div>
		</div>
		<?php
		break;

	case 'wu-diagnosis':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'From diagnosis to decisions', 'Do diagnóstico às decisões' ); ?></span>
			<span class="art-title"><?php sera_e( 'Every decision traces back to one cause, and all of them answer to the same criteria.', 'Cada decisão nasce de uma causa, e todas respondem aos mesmos critérios.' ); ?></span>
			<div class="wudx" role="table" aria-label="<?php echo esc_attr( sera_t( 'Root causes mapped to design decisions', 'Causas-raiz ligadas às decisões de design' ) ); ?>">
				<div class="wudx-row wudx-head" role="row"><span role="columnheader"><?php sera_e( 'Root cause', 'Causa-raiz' ); ?></span><span role="columnheader"><?php sera_e( 'Decisions that address it', 'Decisões que atacam a causa' ); ?></span></div>
				<div class="wudx-row" role="row">
					<div class="wudx-cause" role="cell"><i>A</i><b><?php sera_e( 'Ambiguous instruction', 'Instrução ambígua' ); ?></b><span><?php sera_e( '“A photo of the front and one of the back”, on one screen, under a dense “Important” box.', '“Uma foto da frente e uma do verso”, numa tela só, embaixo de um quadro “Importante” cheio de texto.' ); ?></span></div>
					<div class="wudx-dec" role="cell"><span><i>01</i><?php sera_e( 'One step per side', 'Uma etapa para cada lado' ); ?></span><span><i>02</i><?php sera_e( 'Framing guide in the camera', 'Guia de enquadramento na câmera' ); ?></span><span><i>04</i><?php sera_e( 'Translation QA', 'QA de tradução' ); ?></span><span><i>06</i><?php sera_e( 'Shorter copy', 'Textos mais curtos' ); ?></span></div>
				</div>
				<div class="wudx-row" role="row">
					<div class="wudx-cause" role="cell"><i>B</i><b><?php sera_e( 'Two steps that looked the same', 'Duas etapas que pareciam iguais' ); ?></b><span><?php sera_e( 'Front and back were indistinguishable moments in the flow.', 'Frente e verso eram momentos idênticos no fluxo.' ); ?></span></div>
					<div class="wudx-dec" role="cell"><span><i>01</i><?php sera_e( 'Step marker: “1 of 2”, “2 of 2”', 'Marcador de etapa: “1 de 2”, “2 de 2”' ); ?></span><span><i>01</i><?php sera_e( 'A different background for the back', 'Um fundo diferente para o verso' ); ?></span></div>
				</div>
				<div class="wudx-row" role="row">
					<div class="wudx-cause" role="cell"><i>C</i><b><?php sera_e( 'Feedback at the wrong moment', 'Feedback na hora errada' ); ?></b><span><?php sera_e( 'The customer found out after the rejection, not before sending.', 'O cliente descobria depois da recusa, não antes de enviar.' ); ?></span></div>
					<div class="wudx-dec" role="cell"><span><i>02</i><?php sera_e( 'A frame that shows where the document goes', 'Uma moldura que mostra onde o documento entra' ); ?></span><span><i>03</i><?php sera_e( '“Is this the back?” “Is it legible?”', '“É o verso?” “Está legível?”' ); ?></span></div>
				</div>
				<div class="wudx-row" role="row">
					<div class="wudx-cause" role="cell"><i>D</i><b><?php sera_e( 'Friction with no value', 'Atrito sem valor' ); ?></b><span><?php sera_e( 'Sender-only data asked of people who came to receive.', 'Dados que só servem para quem envia, pedidos a quem veio receber.' ); ?></span></div>
					<div class="wudx-dec" role="cell"><span><i>05</i><?php sera_e( 'Two steps moved to after the account opens', 'Duas etapas movidas para depois da abertura da conta' ); ?></span></div>
				</div>
			</div>
			<div class="wudx-foot">
				<span class="art-label"><?php sera_e( 'Measured against', 'Medido por' ); ?></span>
				<ul><?php sera_e( '<li>More correct front and back submissions</li><li>Fewer rejections from simple mistakes</li><li class="g">Higher conversion without raising fraud risk</li>', '<li>Mais envios corretos de frente e verso</li><li>Menos recusas por erros simples</li><li class="g">Mais conversão sem aumentar o risco de fraude</li>' ); ?></ul>
			</div>
		</div>
		<?php
		break;

	case 'wu-journey':
		$door = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 21h17M6.5 21V4.2a1 1 0 0 1 .84-.99l9-1.4a1 1 0 0 1 1.16.99V21"/><circle cx="14.2" cy="12" r="1" fill="currentColor" stroke="none"/></svg>';
		$tag  = '<em class="wujr-tag">' . sera_t( 'Sender-only', 'Só para envio' ) . '</em>';
		$pt   = sera_is_pt();
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The path to an account · before and after', 'O caminho até a conta · antes e depois' ); ?></span>
			<span class="art-title"><?php sera_e( 'The account stopped waiting for data only senders need.', 'A conta parou de esperar por dados que só quem envia dinheiro precisa.' ); ?></span>
			<div class="wujr">
				<section class="wujr-col old" aria-label="<?php echo esc_attr( sera_t( 'Before', 'Antes' ) ); ?>">
					<header class="wujr-hd"><b><?php sera_e( 'Before', 'Antes' ); ?></b><span><?php sera_e( '3 gates before the door', '3 barreiras antes da porta' ); ?></span></header>
					<ol class="wujr-steps" role="list">
						<li class="wujr-gate"><i>1</i><div><b><?php sera_e( 'Document photo', 'Foto do documento' ); ?></b><span><?php sera_e( '“Passo 5 de 5” (step 5 of 5): front and back on one screen', '“Passo 5 de 5”: frente e verso numa tela só' ); ?></span></div></li>
						<li class="wujr-gate"><i>2</i><div><b><?php sera_e( 'Occupation', 'Ocupação' ); ?> <?php echo $tag; // phpcs:ignore ?></b><span><?php sera_e( 'Occupation, position, monthly income, source of funds', 'Ocupação, cargo, renda mensal, origem dos recursos' ); ?></span></div></li>
						<li class="wujr-gate"><i>3</i><div><b><?php sera_e( 'Identification data', 'Dados de identificação' ); ?> <?php echo $tag; // phpcs:ignore ?></b><span><?php sera_e( 'Document type and number, issue and expiry dates, issuer, state', 'Tipo e número do documento, datas de emissão e validade, órgão emissor, UF' ); ?></span></div></li>
						<li class="wujr-door"><?php echo $door; // phpcs:ignore ?><b><?php sera_e( 'Account opens', 'Conta aberta' ); ?></b><span><?php sera_e( 'after all three', 'depois das três' ); ?></span></li>
					</ol>
				</section>
				<section class="wujr-col new" aria-label="<?php echo esc_attr( sera_t( 'After', 'Depois' ) ); ?>">
					<header class="wujr-hd"><b><?php sera_e( 'After', 'Depois' ); ?></b><span><?php sera_e( '1 gate before the door', '1 barreira antes da porta' ); ?></span></header>
					<ol class="wujr-steps" role="list">
						<li class="wujr-gate"><i>1</i><div><b><?php sera_e( 'Document photo', 'Foto do documento' ); ?></b><span><?php sera_e( 'Two steps that can’t be confused, then a check', 'Duas etapas impossíveis de confundir, e uma checagem no fim' ); ?></span><span class="wujr-sub"><em><?php sera_e( '1 of 2 · Front', '1 de 2 · Frente' ); ?></em><em class="dk"><?php sera_e( '2 of 2 · Back', '2 de 2 · Verso' ); ?></em><em><?php sera_e( '“Is it legible?”', '“Está legível?”' ); ?></em></span></div></li>
						<li class="wujr-door"><?php echo $door; // phpcs:ignore ?><b><?php sera_e( 'Account opens', 'Conta aberta' ); ?></b><span><?php sera_e( 'right after the photo', 'logo depois da foto' ); ?></span></li>
						<li class="wujr-later">
							<span class="wujr-later-hd"><b><?php sera_e( '“Quase pronto” (almost there)', '“Quase pronto”' ); ?></b><span><?php sera_e( 'Moved after the door', 'Depois da porta' ); ?></span></span>
							<span class="wujr-item"><b><?php sera_e( 'Occupation', 'Ocupação' ); ?></b><?php echo $tag; // phpcs:ignore ?></span>
							<span class="wujr-item"><b><?php sera_e( 'Identification data', 'Dados de identificação' ); ?></b><?php echo $tag; // phpcs:ignore ?></span>
							<span class="wujr-btns" aria-label="<?php echo esc_attr( sera_t( 'Complete now or later', 'Completar agora ou depois' ) ); ?>"><span class="pri">Completar cadastro<?php echo $pt ? '' : ' <small>(complete now)</small>'; ?></span><span>Agora não<?php echo $pt ? '' : ' <small>(not now)</small>'; ?></span></span>
						</li>
					</ol>
				</section>
			</div>
			<ul class="wujr-foot">
				<li><?php sera_e( '<b>Most</b> users came to receive money', '<b>A maioria</b> veio receber dinheiro' ); ?></li>
				<li><?php sera_e( '<b>2</b> steps were sender-only', '<b>2</b> etapas serviam só para envio' ); ?></li>
				<li><?php sera_e( '<b>~2 min</b> removed from the funnel', '<b>~2 min</b> a menos no funil' ); ?></li>
				<li><?php sera_e( '<b>Aligned</b> with Compliance and LATAM', '<b>Alinhado</b> com Compliance e LATAM' ); ?></li>
			</ul>
		</div>
		<?php
		break;

	case 'wu-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'Why this case matters', 'Por que este case importa' ); ?></span><ul><?php sera_e( '<li>Worked as Designer and Product Owner at the same time</li><li>Did research with no budget: stores, analytics and an audit of rejected documents</li><li>Cut friction that added no value, with Compliance on board</li><li>Handled a failed release like an incident, and recovered fast</li><li>Turned UX results into budget for the next step</li>', '<li>Atuei como Designer e Product Owner ao mesmo tempo</li><li>Fiz pesquisa sem orçamento: lojas, analytics e uma auditoria dos documentos recusados</li><li>Cortei o atrito que não agregava nada, com Compliance junto</li><li>Tratei um release que deu errado como incidente, e a gente se recuperou rápido</li><li>Transformei resultado de UX em orçamento para o próximo passo</li>' ); ?></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d do differently', 'O que eu faria diferente' ); ?></span><ul><?php sera_e( '<li>Audit the rejected documents first, before anything else</li><li>Bring engineering into discovery earlier</li><li>Test on entry-level phones from day one</li>', '<li>Auditar os documentos recusados primeiro, antes de qualquer outra coisa</li><li>Trazer a engenharia para o discovery mais cedo</li><li>Testar em celulares de entrada desde o primeiro dia</li>' ); ?></ul></div>
		</div>
		<?php
		break;

	case 'wu-signals':
		?>
		<div class="signals">
			<div><i>01</i><b><?php sera_e( 'Worked as designer and product owner', 'Atuei como designer e product owner' ); ?></b><span><?php sera_e( 'The backlog, the releases and the screens all came from the same diagnosis.', 'O backlog, os releases e as telas saíram do mesmo diagnóstico.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'Found the evidence that was already there', 'Achei a evidência que já estava ali' ); ?></b><span><?php sera_e( 'Session analytics, the stores and a pile of rejected photos answered the question without a research budget.', 'Analytics de sessão, as lojas e uma pilha de fotos recusadas responderam a pergunta sem orçamento de pesquisa.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Prevented the error before it happened', 'Evitei o erro antes de ele acontecer' ); ?></b><span><?php sera_e( 'Two steps that can’t be confused replaced an error screen that arrived after the attempt was spent.', 'Duas etapas impossíveis de confundir substituíram uma tela de erro que só chegava depois da tentativa perdida.' ); ?></span></div>
			<div><i>04</i><b><?php sera_e( 'Cut friction with Compliance in the room', 'Cortei atrito com Compliance na sala' ); ?></b><span><?php sera_e( 'Sender-only data moved behind a choice, agreed with Compliance and LATAM leadership.', 'Os dados de envio foram para trás de uma escolha, acordada com Compliance e a liderança LATAM.' ); ?></span></div>
			<div><i>05</i><b><?php sera_e( 'Treated a bad release as an incident', 'Tratei um release ruim como incidente' ); ?></b><span><?php sera_e( 'Found the causes, fixed them, shipped again, and left a device lab and a checklist behind.', 'Achei as causas, corrigi, lancei de novo, e deixei de legado um device lab e um checklist.' ); ?></span></div>
			<div><i>06</i><b><?php sera_e( 'Turned results into the next budget', 'Transformei resultado no próximo orçamento' ); ?></b><span><?php sera_e( 'A record from UX and stability work paid for the identity-verification vendor.', 'Um recorde vindo de UX e estabilidade pagou o fornecedor de verificação de identidade.' ); ?></span></div>
		</div>
		<?php
		break;

endswitch;
