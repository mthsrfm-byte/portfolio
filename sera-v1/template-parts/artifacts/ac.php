<?php
/**
 * Artifacts — Acordo Certo · Homepage redesign (2021–22).
 * Based on the case published by Carolina Miguel, modernised visually.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

switch ( $args['name'] ) :

	case 'ac-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'Acordo Certo, Brazil’s online debt-negotiation platform', 'Acordo Certo, plataforma brasileira de negociação de dívidas online' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Product Design Manager, leading a two-person design team', 'Product Design Manager, à frente de um time de design de duas pessoas' ); ?></dd></div>
			<div><dt><?php sera_e( 'Team', 'Time' ); ?></dt><dd><?php sera_e( 'Me and Carolina, a junior product designer, with Marketing, CRO, Customer Service and tribe leads', 'Eu e a Carolina, product designer júnior, com Marketing, CRO, Atendimento e líderes de tribo' ); ?></dd></div>
			<div><dt><?php sera_e( 'Timeline', 'Período' ); ?></dt><dd>2021–22</dd></div>
			<div><dt><?php sera_e( 'Outcome', 'Resultado' ); ?></dt><dd><?php sera_e( '+15% conversion, the Atlas design system and new design roles opened', '+15% de conversão, o design system Atlas e novas vagas de design abertas' ); ?></dd></div>
		</dl>
		<?php
		break;

	case 'ac-duo':
		?>
		<div class="duo">
			<div class="p me"><span class="art-label"><?php sera_e( 'Matheus Serafim · Design lead', 'Matheus Serafim · Liderança de design' ); ?></span><h4><?php sera_e( 'Led strategy, research, the vision workshop and the direction', 'Liderei estratégia, pesquisa, o workshop de visão e a direção' ); ?></h4><ul><li><?php sera_e( 'Framed the problem and the plan: customers → vision → layout', 'Enquadrei o problema e o plano: clientes → visão → layout' ); ?></li><li><?php sera_e( 'Adapted Jobs-to-be-Done and led the interviews', 'Adaptei o Jobs-to-be-Done e conduzi as entrevistas' ); ?></li><li><?php sera_e( 'Planned and facilitated the vision workshop and the brainstorm', 'Planejei e facilitei o workshop de visão e o brainstorm' ); ?></li><li><?php sera_e( 'Set the direction for the Atlas design system', 'Dei a direção do design system Atlas' ); ?></li><li><?php sera_e( 'Mentored Carolina in her first design role', 'Fui mentor da Carolina no primeiro emprego dela em design' ); ?></li></ul></div>
			<div class="p both"><span class="art-label"><?php sera_e( 'Together', 'Juntos' ); ?></span><h4><?php sera_e( 'Discovery, side by side', 'Discovery, lado a lado' ); ?></h4><ul><li><?php sera_e( 'Customer interviews', 'Entrevistas com clientes' ); ?></li><li><?php sera_e( 'Synthesis and archetypes', 'Síntese e arquétipos' ); ?></li><li><?php sera_e( 'CSD matrix, desk research, benchmark', 'Matriz CSD, desk research, benchmark' ); ?></li><li><?php sera_e( 'Usability tests', 'Testes de usabilidade' ); ?></li></ul></div>
			<div class="p her"><span class="art-label"><?php sera_e( 'Carolina · Junior Product Designer', 'Carolina · Product Designer Júnior' ); ?></span><h4><?php sera_e( 'Made the visuals tangible, throughout', 'Deu forma ao visual, do começo ao fim' ); ?></h4><ul><li><?php sera_e( 'Wireframes and high-fidelity UI', 'Wireframes e UI em alta fidelidade' ); ?></li><li><?php sera_e( 'Visual language: type, colour, shapes, illustration', 'Linguagem visual: tipografia, cor, formas, ilustração' ); ?></li><li><?php sera_e( 'New Atlas components for the homepage', 'Novos componentes do Atlas para a home' ); ?></li><li><?php sera_e( 'About, Partners and partner landing pages', 'Páginas Sobre, Parceiros e landing pages de parceiros' ); ?></li></ul></div>
		</div>
		<p class="art-cap"><?php sera_e( 'Carolina wrote about this project from her side on <a href="https://carolinamiguel.medium.com/how-a-simple-redesign-increased-our-companys-conversion-by-15-7a3e99fa1e46" target="_blank" rel="noopener">Medium</a>.', 'A Carolina contou o projeto do ponto de vista dela no <a href="https://carolinamiguel.medium.com/how-a-simple-redesign-increased-our-companys-conversion-by-15-7a3e99fa1e46" target="_blank" rel="noopener">Medium</a> (em inglês).' ); ?></p>
		<?php
		break;

	case 'ac-obstacles':
		?>
		<div class="art-grid cols-4">
			<div class="art-card"><span class="art-label">01</span><h4 style="margin-top:14px"><?php sera_e( 'We didn’t know our customers', 'A gente não conhecia nossos clientes' ); ?></h4><p><?php sera_e( 'We knew there were happy and unhappy customers, but not why they came, stayed or gave up.', 'Sabíamos que havia clientes satisfeitos e insatisfeitos, mas não por que chegavam, ficavam ou desistiam.' ); ?></p></div>
			<div class="art-card"><span class="art-label">02</span><h4 style="margin-top:14px"><?php sera_e( 'No product vision', 'Sem visão de produto' ); ?></h4><p><?php sera_e( 'Without knowing the customer, there was no shared picture of what the product should become.', 'Sem conhecer o cliente, não havia uma imagem comum do que o produto deveria se tornar.' ); ?></p></div>
			<div class="art-card"><span class="art-label">03</span><h4 style="margin-top:14px"><?php sera_e( 'No design system', 'Sem design system' ); ?></h4><p><?php sera_e( 'Inconsistent components everywhere, in a product where people type their CPF (the Brazilian tax ID) and financial data.', 'Componentes inconsistentes por todo lado, num produto em que as pessoas digitam CPF e dados financeiros.' ); ?></p></div>
			<div class="art-card"><span class="art-label">04</span><h4 style="margin-top:14px"><?php sera_e( 'A trust problem', 'Um problema de confiança' ); ?></h4><p><?php sera_e( 'Online reviews showed fear of scams, bad past experiences and a site that felt confusing and suspicious.', 'As avaliações online mostravam medo de golpe, experiências ruins no passado e um site que parecia confuso e suspeito.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'ac-jtbd':
		$stages = array(
			array( '1', sera_t( 'First thought', 'Primeiro pensamento' ), sera_t( 'What was the first thing that came to your mind when you realised you had debts in your name?', 'Qual foi a primeira coisa que passou pela sua cabeça quando você percebeu que tinha dívidas no seu nome?' ) ),
			array( '2', sera_t( 'Passive search', 'Busca passiva' ), sera_t( 'Did something change in your life that made you decide to start negotiating your debt?', 'Aconteceu alguma mudança na sua vida que fez você decidir negociar sua dívida?' ) ),
			array( '3', sera_t( 'Active search', 'Busca ativa' ), sera_t( 'What were your alternatives for debt negotiation besides Acordo Certo?', 'Além da Acordo Certo, que outras opções você tinha para negociar a dívida?' ) ),
			array( '4', sera_t( 'Deal closure', 'Fechamento do acordo' ), sera_t( 'Complete the sentence: Acordo Certo helped me to… so I could…', 'Complete a frase: a Acordo Certo me ajudou a… para que eu pudesse…' ) ),
			array( '5', sera_t( 'After closure', 'Depois do acordo' ), sera_t( 'Now that your debt is cleared, were you able to do something you couldn’t before?', 'Agora que a dívida está quitada, você conseguiu fazer algo que não conseguia antes?' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Jobs-to-be-Done interviews · promoters (NPS &gt; 8) and detractors (NPS &lt; 6)', 'Entrevistas de Jobs-to-be-Done · promotores (NPS &gt; 8) e detratores (NPS &lt; 6)' ); ?></span>
			<span class="art-title"><?php sera_e( 'Every question asked what the person was trying to get done.', 'Toda pergunta buscava entender o que a pessoa estava tentando resolver.' ); ?></span>
			<div class="jtbd">
				<?php foreach ( $stages as $i => $s ) : ?>
					<div><i><?php echo esc_html( $s[0] ); ?></i><b><?php echo esc_html( $s[1] ); ?></b><q><?php echo esc_html( $s[2] ); ?></q></div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		break;

	case 'ac-voices':
		$src = sera_t( 'Customer interview', 'Entrevista com cliente' );
		?>
		<div class="statement" style="background:#0E2A8A">
			<span class="art-label"><?php sera_e( 'What we heard, over and over', 'O que a gente ouviu, de novo e de novo' ); ?></span>
			<p><?php sera_e( '“Having a clean name is <em>freedom</em>.”', '“Ter o nome limpo é <em>liberdade</em>.”' ); ?></p>
			<span class="by"><?php sera_e( 'What customers wanted was credit back: a card, a home, a trip. The debt stood between them and those plans.', 'O que as pessoas queriam era o crédito de volta: um cartão, uma casa, uma viagem. A dívida ficava entre elas e esses planos.' ); ?></span>
		</div>
		<div class="quotes" style="margin-top:16px">
			<div class="quote"><p><?php sera_e( 'I want to get a credit card to buy my things, but I can’t. I have to pay everything in cash.', 'Quero tirar um cartão de crédito pra comprar minhas coisas, mas não consigo. Tenho que pagar tudo à vista.' ); ?></p><span><?php echo esc_html( $src ); ?></span></div>
			<div class="quote"><p><?php sera_e( 'Don’t use complicated words, we’re not experts.', 'Não usa palavra difícil, a gente não é especialista.' ); ?></p><span><?php echo esc_html( $src ); ?></span></div>
			<div class="quote"><p><?php sera_e( 'I thought I had to pay everything to clear my name. I didn’t know the first installment already removed the restriction.', 'Eu achava que tinha que pagar tudo pra limpar o nome. Não sabia que a primeira parcela já tirava a restrição.' ); ?></p><span><?php echo esc_html( $src ); ?></span></div>
		</div>
		<?php
		break;

	case 'ac-findings':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label"><?php sera_e( 'Triggers &amp; motivators', 'Gatilhos e motivadores' ); ?></span><ul class="ticks"><li><?php sera_e( 'Constant contact from creditors', 'Contato constante dos credores' ); ?></li><li><?php sera_e( 'Needing credit to reach personal goals', 'Precisar de crédito para realizar objetivos pessoais' ); ?></li><li><?php sera_e( 'Shame, and the weight of carrying debt', 'Vergonha, e o peso de carregar uma dívida' ); ?></li><li><?php sera_e( 'Trying to manage money with spreadsheets', 'Tentar controlar o dinheiro com planilhas' ); ?></li></ul></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Obstacles', 'Obstáculos' ); ?></span><ul class="ticks"><li><?php sera_e( 'Can’t reach a deal with the original creditor', 'Não conseguir acordo com o credor original' ); ?></li><li><?php sera_e( 'Low financial literacy and jargon', 'Pouca educação financeira, e muito jargão' ); ?></li><li><?php sera_e( 'Interest seen as a wall', 'Juros vistos como um muro' ); ?></li><li><?php sera_e( 'Bigger debts get postponed', 'Dívidas maiores ficam para depois' ); ?></li><li><?php sera_e( 'Fear of scams, and of giving data by phone', 'Medo de golpe, e de passar dados por telefone' ); ?></li></ul></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'How they choose', 'Como escolhem' ); ?></span><ul class="ticks"><li><?php sera_e( 'They compare platforms for the best deal', 'Comparam plataformas atrás da melhor proposta' ); ?></li><li><?php sera_e( 'They check if the company is trustworthy', 'Checam se a empresa é confiável' ); ?></li><li><?php sera_e( 'Once they agree, they don’t want to break it', 'Depois de fechar o acordo, não querem quebrar' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'ac-personas':
		$pt = sera_is_pt();
		?>
		<div class="personas">
			<div class="pa go"><span class="tag"><?php sera_e( 'Archetype 1', 'Arquétipo 1' ); ?></span><h4><?php sera_e( 'The Go-Getter', 'O Emergente' ); ?></h4><?php if ( ! $pt ) : ?><span class="em">“O Emergente”</span><?php endif; ?><p><?php sera_e( 'Wants a clean name fast to get credit, a home, a trip. Accepts a smaller discount for flexible terms, looks for trust signals and won’t come back after a bad experience.', 'Quer o nome limpo rápido para ter crédito, uma casa, uma viagem. Aceita um desconto menor em troca de prazo flexível, procura sinais de confiança e não volta depois de uma experiência ruim.' ); ?></p></div>
			<div class="pa le"><span class="tag"><?php sera_e( 'Archetype 2', 'Arquétipo 2' ); ?></span><h4><?php sera_e( 'The Learner', 'O Aprendiz' ); ?></h4><?php if ( ! $pt ) : ?><span class="em">“O Aprendiz”</span><?php endif; ?><p><?php sera_e( 'Waits for the biggest discount, even if it takes longer. Often scammed before, ashamed of the debt, and committed once they agree.', 'Espera pelo maior desconto, mesmo que demore. Muitas vezes já caiu em golpe, tem vergonha da dívida e, quando fecha acordo, cumpre.' ); ?></p></div>
			<div class="pa su"><span class="tag"><?php sera_e( 'Archetype 3', 'Arquétipo 3' ); ?></span><h4><?php sera_e( 'The Survivor', 'O Sobrevivente' ); ?></h4><?php if ( ! $pt ) : ?><span class="em">“O Sobrevivente”</span><?php endif; ?><p><?php sera_e( 'Basic needs come first. Less digital, often unbanked, negotiates hoping for a new job, and is more likely to break an agreement.', 'O básico vem primeiro. Menos digital, muitas vezes sem conta em banco, negocia na esperança de um emprego novo e tem mais chance de quebrar o acordo.' ); ?></p></div>
		</div>
		<div class="story">
			<span class="art-label"><?php sera_e( 'Storyboard for the company · from Survivor to Go-Getter', 'Storyboard para a empresa · de Sobrevivente a Emergente' ); ?></span>
			<ol>
				<li><b><?php sera_e( 'Loses his job', 'Perde o emprego' ); ?></b><span><?php sera_e( 'Marcos juggles temporary work; the debts pile up.', 'Marcos se vira com bicos; as dívidas se acumulam.' ); ?></span></li>
				<li><b><?php sera_e( 'A better job', 'Um emprego melhor' ); ?></b><span><?php sera_e( 'With a better salary, he starts dreaming again.', 'Com um salário melhor, ele volta a sonhar.' ); ?></span></li>
				<li><b><?php sera_e( 'Starts small', 'Começa pelo pequeno' ); ?></b><span><?php sera_e( 'An email from Acordo Certo. He settles the smaller debts first.', 'Chega um email da Acordo Certo. Ele quita primeiro as dívidas menores.' ); ?></span></li>
				<li><b><?php sera_e( 'Comes back', 'Volta' ); ?></b><span><?php sera_e( 'More stable, he closes the remaining negotiations.', 'Mais estável, fecha as negociações que faltavam.' ); ?></span></li>
				<li><b><?php sera_e( 'Credit again', 'Crédito de novo' ); ?></b><span><?php sera_e( 'Credit card and a financed home for his family.', 'Cartão de crédito e uma casa financiada para a família.' ); ?></span></li>
			</ol>
		</div>
		<?php
		break;

	case 'ac-vision':
		?>
		<div class="art-panel art-dark" style="background:#0E2A8A">
			<span class="art-label"><?php sera_e( 'Vision workshop · A time machine to 2022', 'Workshop de visão · Máquina do tempo até 2022' ); ?></span>
			<span class="art-title"><?php sera_e( 'Goal: help people every day move toward their dreams through financial well-being.', 'Objetivo: ajudar as pessoas, todos os dias, a chegar mais perto dos seus sonhos por meio do bem-estar financeiro.' ); ?></span>
			<p class="ac-prompt"><?php sera_e( 'The prompt: it’s the end of 2022 and you’re reading an article about our product. What does it say?', 'O ponto de partida: é fim de 2022 e você está lendo uma matéria sobre o nosso produto. O que ela diz?' ); ?></p>
			<div class="vision">
				<p><?php sera_e( '“We help and care for you so you can achieve your well-being as quickly as possible.”', '“A gente ajuda e cuida de você para você conquistar seu bem-estar o quanto antes.”' ); ?></p>
				<p><?php sera_e( '“We’re like a virtual hug and a breath of relief at the end of the day.”', '“Somos como um abraço virtual e um suspiro de alívio no fim do dia.”' ); ?></p>
				<p><?php sera_e( '“No fancy words or over-complicated jargon.”', '“Nada de palavras difíceis nem jargão complicado.”' ); ?></p>
			</div>
		</div>
		<?php
		break;

	case 'ac-process':
		$stk = array(
			sera_t( 'Texts are bad', 'Textos ruins' ),
			sera_t( 'Poor layout', 'Layout fraco' ),
			sera_t( 'Lack of trust', 'Falta confiança' ),
			sera_t( 'No consistency', 'Sem consistência' ),
			sera_t( 'Main banner', 'Banner principal' ),
			sera_t( 'Too generic', 'Genérico demais' ),
			sera_t( 'Weak video', 'Vídeo fraco' ),
			sera_t( 'Huge footer', 'Rodapé enorme' ),
			'Bugs',
			sera_t( 'User support', 'Suporte ao usuário' ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Double Diamond, for the homepage', 'Double Diamond, para a home' ); ?></span>
			<div class="diamond">
				<div><i>01</i><b><?php sera_e( 'Immersion', 'Imersão' ); ?></b><span><?php sera_e( 'Desk research · CSD matrix · Benchmarking', 'Desk research · Matriz CSD · Benchmarking' ); ?></span></div>
				<div><i>02</i><b><?php sera_e( 'Ideation', 'Ideação' ); ?></b><span><?php sera_e( 'Brainstorm with Marketing, Customer Service, CRO and tribe leads', 'Brainstorm com Marketing, Atendimento, CRO e líderes de tribo' ); ?></span></div>
				<div><i>03</i><b><?php sera_e( 'Prototyping', 'Prototipação' ); ?></b><span><?php sera_e( 'Low-fidelity wireframes on mobile and desktop', 'Wireframes de baixa fidelidade no mobile e no desktop' ); ?></span></div>
				<div><i>04</i><b><?php sera_e( 'Testing', 'Teste' ); ?></b><span><?php sera_e( 'Low-fidelity prototype tested with users', 'Protótipo de baixa fidelidade testado com usuários' ); ?></span></div>
			</div>
			<div class="stickies">
				<?php foreach ( $stk as $s ) : ?><span><?php echo esc_html( $s ); ?></span><?php endforeach; ?>
			</div>
			<p class="art-cap"><?php sera_e( 'Groups that came out of the company-wide brainstorm about the old homepage.', 'Agrupamentos que saíram do brainstorm com a empresa toda sobre a home antiga.' ); ?></p>
		</div>
		<?php
		break;

	case 'ac-pillars':
		?>
		<div class="pillars">
			<div style="--c:#1F4FE0"><b><?php sera_e( 'Comfort', 'Conforto' ); ?></b><span><?php sera_e( 'A heavy subject, on a page that feels light.', 'Um assunto pesado, numa página leve.' ); ?></span></div>
			<div style="--c:#02BEDF"><b><?php sera_e( 'Clarity', 'Clareza' ); ?></b><span><?php sera_e( 'Plain words, one main action, a visible process.', 'Palavras simples, uma ação principal, um processo à vista.' ); ?></span></div>
			<div style="--c:#7B4BD8"><b><?php sera_e( 'Trust', 'Confiança' ); ?></b><span><?php sera_e( 'Team photos, honest reviews, clear proof.', 'Fotos do time, avaliações honestas, provas claras.' ); ?></span></div>
			<div style="--c:#3CC47C"><b><?php sera_e( 'Consistency', 'Consistência' ); ?></b><span><?php sera_e( 'One system, the same components everywhere.', 'Um sistema, os mesmos componentes em todo lugar.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'ac-testing':
		?>
		<div class="art-grid cols-3">
			<div class="art-card"><span class="art-label"><?php sera_e( 'Finding 01', 'Achado 01' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Real people build trust', 'Gente de verdade gera confiança' ); ?></h4><p><?php sera_e( 'Photos of the actual team eased the fear of scams and made the company feel legitimate. They went into the homepage and About page.', 'Fotos do time de verdade diminuíram o medo de golpe e fizeram a empresa parecer legítima. Elas foram para a home e a página Sobre.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Finding 02', 'Achado 02' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Perfect reviews look fake', 'Avaliação perfeita parece falsa' ); ?></h4><p><?php sera_e( 'We picked honest reviews, some with small typos or a criticism, and linked them to Google so anyone could check.', 'Escolhemos avaliações honestas, algumas com errinhos de digitação ou uma crítica, e linkamos para o Google para qualquer pessoa conferir.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'Finding 03', 'Achado 03' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Simple words, always', 'Palavras simples, sempre' ); ?></h4><p><?php sera_e( 'Every financial term that could be replaced by everyday language was replaced.', 'Todo termo financeiro que podia virar linguagem do dia a dia, virou.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'ac-system':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Atlas, the design system we built', 'Atlas, o design system que construímos' ); ?></span>
			<span class="art-title"><?php sera_e( 'One blue and no rules became a system that makes a heavy subject feel lighter.', 'Um azul só e nenhuma regra viraram um sistema que trata com leveza um assunto pesado.' ); ?></span>
			<div class="ds">
				<div class="sw"><span style="background:#0048DB"><?php sera_e( 'Blue', 'Azul' ); ?></span><span style="background:#02BEDF"><?php sera_e( 'Cyan', 'Ciano' ); ?></span><span style="background:#7B4BD8"><?php sera_e( 'Purple', 'Roxo' ); ?></span><span style="background:#3CC47C"><?php sera_e( 'Green', 'Verde' ); ?></span><span style="background:#FFD66B;color:#141B2D"><?php sera_e( 'Yellow', 'Amarelo' ); ?></span><span style="background:#FF9A52"><?php sera_e( 'Orange', 'Laranja' ); ?></span></div>
				<div class="ty"><b>Aa</b><div><strong>Mangueira</strong><span><?php sera_e( 'Rounded headings, already used by Marketing', 'Títulos arredondados, já usados pelo Marketing' ); ?></span><strong>Source Sans</strong><span><?php sera_e( 'Readable body copy', 'Texto corrido fácil de ler' ); ?></span></div></div>
				<div class="sh"><i class="r1"></i><i class="r2"></i><i class="r3"></i><i class="r4"></i><span><?php sera_e( 'Rounded shapes on cards, buttons, forms and photos', 'Formas arredondadas em cards, botões, formulários e fotos' ); ?></span></div>
				<div class="cp"><span class="b1">Consultar CPF grátis</span><span class="b2">Ver parceiros</span><span class="in">Digite aqui o seu CPF</span></div>
			</div>
			<p class="art-cap"><?php sera_e( 'Type and shapes as defined in the redesign; palette and components reconstructed for this case. “Consultar CPF grátis”: check your CPF for free. “Ver parceiros”: see partners. “Digite aqui o seu CPF”: type your CPF here.', 'Tipografia e formas como definidas no redesign; paleta e componentes reconstruídos para este case.' ); ?></p>
		</div>
		<?php
		break;

	case 'ac-impact':
		?>
		<div class="impact" style="background:#0E2A8A">
			<span class="art-label"><?php sera_e( 'Impact', 'Impacto' ); ?></span>
			<h3><?php sera_e( 'A “simple” redesign that moved the company’s main number.', 'Um redesign “simples” que mexeu no principal número da empresa.' ); ?></h3>
			<div class="impact-grid">
				<div><b>+15<small class="u">%</small></b><span><?php sera_e( 'Conversion on the homepage and landing pages', 'De conversão na home e nas landing pages' ); ?></span></div>
				<div><b>3</b><span><?php sera_e( 'Archetypes the company adopted to talk about customers', 'Arquétipos que a empresa adotou para falar dos clientes' ); ?></span></div>
				<div><b>1</b><span><?php sera_e( 'Design system, Atlas, adopted across the site', 'Design system, o Atlas, adotado no site inteiro' ); ?></span></div>
				<div><b><?php sera_e( 'New roles', 'Novas vagas' ); ?></b><span><?php sera_e( 'Design became visible enough to open new design positions', 'O design ficou visível o bastante para abrir novas vagas na área' ); ?></span></div>
			</div>
			<div class="impact-foot"><span><?php sera_e( 'Plain language throughout', 'Linguagem simples do começo ao fim' ); ?></span><span><?php sera_e( 'Consistency across pages', 'Consistência entre as páginas' ); ?></span><span><?php sera_e( 'Structure still live years later', 'Estrutura ainda no ar anos depois' ); ?></span></div>
		</div>
		<?php
		break;

	case 'ac-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><li><?php sera_e( 'The order of the work: customers, then a vision with the company, then the layout. The page was the last step, and that is why it held', 'A ordem do trabalho: clientes, depois uma visão com a empresa, depois o layout. A página foi o último passo, e é por isso que ela se sustentou' ); ?></li><li><?php sera_e( 'Bringing Marketing, CRO and Customer Service into the brainstorm. They shaped the page, so they defended it', 'Trazer Marketing, CRO e Atendimento para o brainstorm. Quem ajudou a moldar a página saiu defendendo a página' ); ?></li></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><li><?php sera_e( 'Test the low-fidelity prototype with more people and in more than one round, before committing the high fidelity', 'Testar o protótipo de baixa fidelidade com mais gente e em mais de uma rodada, antes de partir para a alta fidelidade' ); ?></li><li><?php sera_e( 'Measure beyond conversion: how many first installments were paid, and whether the agreements held', 'Medir além da conversão: quantas primeiras parcelas foram pagas, e se os acordos se mantiveram' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'ac-signals':
		?>
		<div class="signals">
			<div><i>01</i><b><?php sera_e( 'Led by helping a junior designer grow', 'Liderei ajudando uma designer júnior a crescer' ); ?></b><span><?php sera_e( 'Mentored a junior designer into making the company’s main page tangible, while I held the direction.', 'Fui mentor de uma designer júnior enquanto ela dava forma à página mais importante da empresa, e eu segurava a direção.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'Research before layout', 'Pesquisa antes do layout' ); ?></b><span><?php sera_e( 'Customers first, then vision, then pixels. The homepage came last.', 'Clientes primeiro, depois visão, depois pixels. A home veio por último.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Brought the company into discovery', 'Trouxe a empresa para o discovery' ); ?></b><span><?php sera_e( 'Marketing, CRO, Customer Service and tribe leads helped shape the solution, so they also defended it.', 'Marketing, CRO, Atendimento e líderes de tribo ajudaram a moldar a solução, por isso também a defenderam.' ); ?></span></div>
			<div><i>04</i><b><?php sera_e( 'Built the system underneath', 'Construí o sistema por baixo' ); ?></b><span><?php sera_e( 'Atlas made this page, and every page after it, faster and more consistent.', 'O Atlas deixou esta página, e todas as que vieram depois, mais rápidas de fazer e mais consistentes.' ); ?></span></div>
			<div><i>05</i><b><?php sera_e( 'Designed for trust in a sensitive category', 'Desenhei para gerar confiança numa categoria sensível' ); ?></b><span><?php sera_e( 'Real people, honest reviews and plain words, where fear of scams is the main obstacle.', 'Gente de verdade, avaliações honestas e palavras simples, onde o medo de golpe é o maior obstáculo.' ); ?></span></div>
			<div><i>06</i><b><?php sera_e( 'Planted design culture', 'Plantei cultura de design' ); ?></b><span><?php sera_e( 'The visibility of the work opened new design positions in the company.', 'A visibilidade do trabalho abriu novas vagas de design na empresa.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'ac-sequence':
		$lanes  = array(
			'duo' => sera_t( 'Design duo', 'Dupla de design' ),
			'cus' => sera_t( 'Customers', 'Clientes' ),
			'co'  => sera_t( 'The company', 'A empresa' ),
		);
		$phases = array(
			array( sera_t( 'Interviews', 'Entrevistas' ), sera_t( 'Jobs-to-be-Done guide, run side by side', 'Roteiro de Jobs-to-be-Done, conduzido lado a lado' ), sera_t( 'Promoters and detractors who had closed a deal', 'Promotores e detratores que tinham fechado acordo' ), '', sera_t( 'The job: a clean name and credit back', 'O trabalho: nome limpo e crédito de volta' ) ),
			array( sera_t( 'Archetypes', 'Arquétipos' ), sera_t( 'Synthesis into three archetypes and a storyboard', 'Síntese em três arquétipos e um storyboard' ), '', sera_t( 'A shared language to talk about the customer', 'Uma língua comum para falar do cliente' ), sera_t( 'Go-Getter, Learner, Survivor', 'Emergente, Aprendiz, Sobrevivente' ) ),
			array( sera_t( 'Vision', 'Visão' ), sera_t( 'Workshop planned and facilitated', 'Workshop planejado e facilitado' ), '', sera_t( 'Key people read “tomorrow’s article”', 'Pessoas-chave leem “a matéria de amanhã”' ), sera_t( 'People, every day, toward their dreams', 'Pessoas, todos os dias, mais perto dos sonhos' ) ),
			array( 'Brainstorm', sera_t( 'Double Diamond for the homepage', 'Double Diamond para a home' ), '', sera_t( 'Marketing, Customer Service, CRO, tribe leads', 'Marketing, Atendimento, CRO, líderes de tribo' ), sera_t( 'Four pillars for the page', 'Quatro pilares para a página' ) ),
			array( sera_t( 'Test', 'Teste' ), sera_t( 'Low-fidelity prototype, mobile and desktop', 'Protótipo de baixa fidelidade, mobile e desktop' ), sera_t( 'A round with users', 'Uma rodada com usuários' ), '', sera_t( 'Three decisions that changed the page', 'Três decisões que mudaram a página' ) ),
			array( sera_t( 'Build', 'Construção' ), sera_t( 'High fidelity on Atlas: Carolina makes it tangible, I set the direction', 'Alta fidelidade no Atlas: a Carolina dá forma, eu dou a direção' ), '', '', sera_t( 'Homepage, About, Partners, partner pages', 'Home, Sobre, Parceiros, páginas de parceiros' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The order of the work · who was in the room', 'A ordem do trabalho · quem estava na sala' ); ?></span>
			<span class="art-title"><?php sera_e( 'Customers first, the company second, pixels last.', 'Clientes primeiro, a empresa depois, pixels por último.' ); ?></span>
			<div class="acx-seq">
				<div class="acx-seq-lab" aria-hidden="true"><span></span><?php foreach ( $lanes as $l ) : ?><span><?php echo esc_html( $l ); ?></span><?php endforeach; ?><span><?php sera_e( 'What came out', 'O que saiu' ); ?></span></div>
				<?php foreach ( $phases as $i => $p ) : ?>
					<div class="acx-ph">
						<b class="acx-ph-h"><i><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></i><?php echo esc_html( $p[0] ); ?></b>
						<?php $k = 1; foreach ( $lanes as $slug => $l ) : ?>
							<?php if ( $p[ $k ] ) : ?>
								<span class="acx-slot is-<?php echo esc_attr( $slug ); ?>" data-lane="<?php echo esc_attr( $l ); ?>"><?php echo esc_html( $p[ $k ] ); ?></span>
							<?php else : ?>
								<span class="acx-slot is-empty" aria-hidden="true"></span>
							<?php endif; ?>
						<?php $k++; endforeach; ?>
						<span class="acx-out"><?php echo esc_html( $p[4] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
			<p class="art-cap"><?php sera_e( 'Customers were in the room at the start and before the build. The company joined in the middle, where the decisions about the product were made.', 'Os clientes estavam na sala no começo e antes da construção. A empresa entrou no meio, onde se decidiu o produto.' ); ?></p>
		</div>
		<?php
		break;

	case 'ac-journey':
		$steps = array(
			array( sera_t( 'First thought', 'Primeiro pensamento' ), sera_t( 'Shame, the weight of carrying debt, creditors calling again and again.', 'Vergonha, o peso de carregar a dívida, credores ligando sem parar.' ), '', sera_t( 'Comfort before any number.', 'Acolhimento antes de qualquer número.' ) ),
			array( sera_t( 'Passive search', 'Busca passiva' ), sera_t( 'Something changes: they need credit to reach a personal goal.', 'Algo muda: a pessoa precisa de crédito para realizar um objetivo.' ), sera_t( 'I want to get a credit card to buy my things, but I can’t.', 'Quero tirar um cartão de crédito pra comprar minhas coisas, mas não consigo.' ), sera_t( 'A reason to start: their own plans.', 'Um motivo para começar: os próprios planos.' ) ),
			array( sera_t( 'Active search', 'Busca ativa' ), sera_t( 'They compare platforms and check who is trustworthy. Fear of scams, and of giving data by phone.', 'Compara plataformas e checa quem é confiável. Medo de golpe, e de passar dados por telefone.' ), '', sera_t( 'Proof this is real, with no phone calls.', 'Prova de que é sério, sem ligação.' ) ),
			array( sera_t( 'Deal closure', 'Fechamento do acordo' ), sera_t( 'Jargon, low financial literacy, interest seen as a wall.', 'Jargão, pouca educação financeira, juros vistos como um muro.' ), sera_t( 'Don’t use complicated words, we’re not experts.', 'Não usa palavra difícil, a gente não é especialista.' ), sera_t( 'Plain words and a process they can see.', 'Palavras simples e um processo à vista.' ) ),
			array( sera_t( 'After closure', 'Depois do acordo' ), sera_t( 'Once they agree, they don’t want to break it.', 'Depois de fechar o acordo, não quer quebrar.' ), sera_t( 'Having a clean name is freedom.', 'Ter o nome limpo é liberdade.' ), sera_t( 'To know what happens next, and that the name clears.', 'Saber o que vem depois, e que o nome vai ficar limpo.' ) ),
		);
		?>
		<div class="art-panel acx-jr">
			<span class="art-label"><?php sera_e( 'The findings, laid along the journey', 'Os achados, ao longo da jornada' ); ?></span>
			<span class="art-title"><?php sera_e( 'From “debts in my name” to “credit again”, each stage has its own weight to lift.', 'De “dívidas no meu nome” a “crédito de novo”, cada etapa tem um peso próprio a tirar.' ); ?></span>
			<div class="acx-jr-road" aria-hidden="true">
				<svg viewBox="0 0 1000 120" preserveAspectRatio="none"><path d="M0 108 C 140 104, 180 92, 300 84 S 520 70, 600 52 S 820 22, 1000 10" fill="none" stroke="var(--ca-soft)" stroke-width="14" stroke-linecap="round" vector-effect="non-scaling-stroke"/><path d="M0 108 C 140 104, 180 92, 300 84 S 520 70, 600 52 S 820 22, 1000 10" fill="none" stroke="var(--ca)" stroke-width="2" stroke-dasharray="6 8" vector-effect="non-scaling-stroke"/></svg>
				<?php foreach ( array( 89, 70, 54, 34, 13 ) as $i => $y ) : ?>
					<i style="left:<?php echo esc_attr( 10 + $i * 20 ); ?>%;top:<?php echo esc_attr( $y ); ?>%"><?php echo esc_html( $i + 1 ); ?></i>
				<?php endforeach; ?>
				<small class="a"><?php sera_e( 'heavier', 'mais pesado' ); ?></small><small class="b"><?php sera_e( 'lighter', 'mais leve' ); ?></small>
			</div>
			<ol class="acx-jr-steps">
				<?php foreach ( $steps as $i => $s ) : ?>
					<li>
						<span class="n"><?php echo esc_html( $i + 1 ); ?></span>
						<b><?php echo esc_html( $s[0] ); ?></b>
						<span class="k"><?php sera_e( 'What they carry', 'O que a pessoa carrega' ); ?></span>
						<p><?php echo esc_html( $s[1] ); ?></p>
						<?php if ( $s[2] ) : ?><q><?php echo esc_html( $s[2] ); ?></q><?php endif; ?>
						<span class="need"><span class="k"><?php sera_e( 'What they need from us', 'O que precisa de nós' ); ?></span><?php echo esc_html( $s[3] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
			<p class="art-cap"><?php sera_e( 'Stages from our Jobs-to-be-Done guide; findings and quotes from the interviews. <span class="acx-jr-note">The curve is illustrative, not measured.</span>', 'Etapas do nosso roteiro de Jobs-to-be-Done; achados e falas das entrevistas. <span class="acx-jr-note">A curva é ilustrativa, não medida.</span>' ); ?></p>
		</div>
		<?php
		break;

	case 'ac-anatomy':
		$cla  = sera_t( 'Clarity', 'Clareza' );
		$tru  = sera_t( 'Trust', 'Confiança' );
		$pins = array(
			array( $cla, '#02BEDF', sera_t( 'One promise, one field, one button', 'Uma promessa, um campo, um botão' ), sera_t( '“Don’t use complicated words, we’re not experts.”', '“Não usa palavra difícil, a gente não é especialista.”' ) ),
			array( sera_t( 'Comfort', 'Conforto' ), '#1F4FE0', sera_t( 'Rounded shapes, a wider palette, simple illustrations', 'Formas arredondadas, uma paleta mais ampla, ilustrações simples' ), sera_t( 'Shame, and the weight of carrying debt', 'Vergonha, e o peso de carregar uma dívida' ) ),
			array( $tru, '#7B4BD8', sera_t( 'No phone calls, said up front', 'Sem ligações, dito logo de cara' ), sera_t( 'Fear of scams, and of giving data by phone', 'Medo de golpe, e de passar dados por telefone' ) ),
			array( $cla, '#02BEDF', sera_t( 'The negotiation flow, right on the page', 'O passo a passo da negociação, na própria página' ), sera_t( '“I didn’t know the first installment already removed the restriction.”', '“Não sabia que a primeira parcela já tirava a restrição.”' ) ),
			array( $tru, '#7B4BD8', sera_t( 'Photos of the actual team', 'Fotos do time de verdade' ), sera_t( 'Usability test, finding 01', 'Teste de usabilidade, achado 01' ) ),
			array( $tru, '#7B4BD8', sera_t( 'Honest reviews, linked to Google', 'Avaliações honestas, com link para o Google' ), sera_t( 'Usability test, finding 02', 'Teste de usabilidade, achado 02' ) ),
			array( sera_t( 'Consistency', 'Consistência' ), '#3CC47C', sera_t( 'Every block built from Atlas', 'Todo bloco construído com o Atlas' ), sera_t( 'No design system, in a product where people type their CPF', 'Sem design system, num produto em que as pessoas digitam o CPF' ) ),
		);
		?>
		<div class="art-panel acx-an">
			<span class="art-label"><?php sera_e( 'Anatomy of the new homepage · every block traced to evidence', 'Anatomia da nova home · cada bloco ligado a uma evidência' ); ?></span>
			<span class="art-title"><?php sera_e( 'The new homepage, block by block.', 'A nova home, bloco a bloco.' ); ?></span>
			<div class="acx-an-grid">
				<div class="acx-wf" aria-hidden="true">
					<i class="pin p7" style="--c:#3CC47C">7</i>
					<div class="wf-nav"><span class="lg"></span><span></span><span></span><span></span><span class="btn"></span></div>
					<div class="wf-hero">
						<div><span class="ln w90 h"></span><span class="ln w70 h"></span><span class="ln w60"></span><span class="fld"><span></span><span class="btn"></span></span><i class="pin" style="--c:#02BEDF">1</i></div>
						<div class="col"><span class="s1"></span><span class="s2"></span><span class="s3"></span><span class="s4"></span><i class="pin" style="--c:#1F4FE0">2</i></div>
					</div>
					<div class="wf-band"><span class="ln w50 h lt"></span><div class="cards"><span></span><span></span><span></span></div><i class="pin" style="--c:#7B4BD8">3</i></div>
					<div class="wf-flow"><span class="ln w30 h"></span><div><span>1</span><span>2</span><span>3</span><span class="on">4</span></div><i class="pin" style="--c:#02BEDF">4</i></div>
					<div class="wf-row"><span class="ln w40 h"></span><div class="tiles"><span></span><span></span><span></span><span></span><span></span><span></span></div></div>
					<div class="wf-team"><div class="ph"><span></span><span></span><span></span></div><div><span class="ln w80 h"></span><span class="ln w60"></span></div><i class="pin" style="--c:#7B4BD8">5</i></div>
					<div class="wf-rev"><span></span><span></span><span></span><i class="pin" style="--c:#7B4BD8">6</i></div>
					<div class="wf-faq"><span></span><span></span><span></span></div>
				</div>
				<ol class="acx-an-list">
					<?php foreach ( $pins as $i => $p ) : ?>
						<li style="--c:<?php echo esc_attr( $p[1] ); ?>">
							<i><?php echo esc_html( $i + 1 ); ?></i>
							<div><b><?php echo esc_html( $p[2] ); ?></b><span class="ev"><?php echo esc_html( $p[3] ); ?></span></div>
							<em><?php echo esc_html( $p[0] ); ?></em>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
			<p class="art-cap"><?php sera_e( 'Wireframe sketch of the redesigned desktop homepage. Pillar colours as in the four pillars above.', 'Esboço em wireframe da nova home no desktop. As cores seguem os quatro pilares acima.' ); ?></p>
		</div>
		<?php
		break;

endswitch;
