<?php
/**
 * Artifacts — Fatal Model · who are the advertisers? (Atlas Technologies, 2024).
 * Quotes translated from Portuguese and anonymised. Revenue figures from the
 * internal deck are omitted.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

switch ( $args['name'] ) :

	case 'fm-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Company', 'Empresa' ); ?></dt><dd><?php sera_e( 'Atlas Technologies, the company behind Fatal Model, a Brazilian platform where independent escorts advertise their services', 'Atlas Technologies, a empresa por trás do Fatal Model, plataforma brasileira onde acompanhantes independentes anunciam seus serviços' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Staff Product Designer in the advertiser (AD) tribe. I led the study from method to final readout', 'Staff Product Designer na tribo de anunciantes (ADs). Liderei a pesquisa do método à apresentação final' ); ?></dd></div>
			<div><dt><?php sera_e( 'Team', 'Time' ); ?></dt><dd><?php sera_e( 'Product management, data science, marketing and the product design team', 'Gestão de produto, ciência de dados, marketing e o time de product design' ); ?></dd></div>
			<div><dt><?php sera_e( 'Timeline', 'Período' ); ?></dt><dd><?php sera_e( '2024 (first half)', '2024 (primeiro semestre)' ); ?></dd></div>
			<div><dt><?php sera_e( 'Scope', 'Escopo' ); ?></dt><dd><?php sera_e( 'A research case: no screens shipped from this study', 'Um case de pesquisa: nenhuma tela foi lançada a partir deste estudo' ); ?></dd></div>
		</dl>
		<?php
		break;

	case 'fm-chair':
		?>
		<div class="statement">
			<span class="art-label"><?php sera_e( 'Where we started', 'O ponto de partida' ); ?></span>
			<p><?php sera_e( 'Inside the company, an advertiser was a plan, a score and a place in the ranking. <em>Behind each of those rows was someone running a business on their own.</em>', 'Dentro da empresa, uma anunciante era um plano, uma pontuação e uma posição no ranking. <em>Por trás de cada linha dessas havia alguém tocando o próprio negócio sozinha.</em>' ); ?></p>
			<span class="by"><?php sera_e( 'So the readout opened with their routines, in their own words, before any chart.', 'Por isso a apresentação dos resultados abriu com a rotina delas, nas palavras delas, antes de qualquer gráfico.' ); ?></span>
		</div>
		<?php
		break;

	case 'fm-rfm':
		$p = array(
			array( 'Veterans', 'Veteranos', 'Champions', sera_t( 'Always buy', 'Sempre compram' ), '#E25352' ),
			array( 'Loyal', 'Leais', 'Loyal', sera_t( 'Buy sometimes', 'Compram às vezes' ), '#B25CF0' ),
			array( 'Jugglers', 'Malabaristas', 'Potential', sera_t( 'Started buying', 'Começaram a comprar' ), '#4C7DF0' ),
			array( 'Improvisers', 'Improvisadores', 'Free', sera_t( 'Never bought', 'Nunca compraram' ), '#2FB67C' ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The cut · RFM segmentation', 'O recorte · segmentação RFM' ); ?></span>
			<span class="art-title"><?php sera_e( 'Four profiles, from the people who spend the most on plans to those who never bought one.', 'Quatro perfis, de quem mais gasta com planos a quem nunca comprou nenhum.' ); ?></span>
			<div class="fm-rfm">
				<?php foreach ( $p as $x ) : ?>
					<?php if ( sera_is_pt() ) : ?>
						<div style="--c:<?php echo esc_attr( $x[4] ); ?>"><small><?php echo esc_html( $x[2] ); ?></small><b><?php echo esc_html( $x[1] ); ?></b><span><?php echo esc_html( $x[3] ); ?></span></div>
					<?php else : ?>
						<div style="--c:<?php echo esc_attr( $x[4] ); ?>"><small><?php echo esc_html( $x[2] ); ?></small><b><?php echo esc_html( $x[0] ); ?></b><em><?php echo esc_html( $x[1] ); ?></em><span><?php echo esc_html( $x[3] ); ?></span></div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="fm-rfm-axis"><span><?php sera_e( '← spend more on plans', '← gastam mais com planos' ); ?></span><span><?php sera_e( 'spend less →', 'gastam menos →' ); ?></span></div>
			<div class="fm-rfm-foot"><div><b>R</b><?php sera_e( 'How recently did they buy?', 'Quando compraram pela última vez?' ); ?></div><div><b>F</b><?php sera_e( 'How often do they buy?', 'Com que frequência compram?' ); ?></div><div><b>M</b><?php sera_e( 'How much have they generated for the platform?', 'Quanto já geraram para a plataforma?' ); ?></div><div class="hl"><?php sera_e( '<b>Most</b>of the active advertisers, and most of the revenue, sit in these four profiles', '<b>A maioria</b>dos anunciantes ativos, e da receita, está nesses quatro perfis' ); ?></div></div>
		</div>
		<?php
		break;

	case 'fm-pipeline':
		$s = array(
			array( '01', sera_t( 'Video interviews', 'Entrevistas em vídeo' ), sera_t( 'Asynchronous questions on VideoAsk. Each person answered by video, audio or text, when and where they felt safe.', 'Perguntas assíncronas no VideoAsk. Cada pessoa respondeu por vídeo, áudio ou texto, quando e onde se sentia segura.' ) ),
			array( '02', sera_t( 'Speech to text', 'Transcrição' ), sera_t( 'Every answer was transcribed automatically, so every interview could be read, searched and quoted.', 'Toda resposta foi transcrita automaticamente, então cada entrevista podia ser lida, buscada e citada.' ) ),
			array( '03', sera_t( 'AI synthesis', 'Síntese com IA' ), sera_t( 'An AI pass grouped similar answers and surfaced recurring themes, which the team then checked by hand.', 'Uma rodada de IA agrupou respostas parecidas e trouxe os temas recorrentes, que o time depois conferiu à mão.' ) ),
			array( '04', sera_t( 'Survey', 'Questionário' ), sera_t( 'The themes became a survey, to see which patterns held at scale.', 'Os temas viraram um questionário, para ver quais padrões se sustentavam em escala.' ) ),
			array( '05', 'Clusters', sera_t( 'Crossing answers with behaviour data gave each profile its sub-groups, habits, goals and pains.', 'Cruzar as respostas com dados de comportamento deu a cada perfil seus subgrupos, hábitos, objetivos e dores.' ) ),
			array( '06', sera_t( 'Readout', 'Apresentação' ), sera_t( 'Profiles told as people, with their quotes, presented to the company as the base for the next cycle.', 'Perfis contados como pessoas, com as próprias falas, apresentados à empresa como base para o ciclo seguinte.' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The method', 'O método' ); ?></span>
			<span class="art-title"><?php sera_e( 'Qualitative interviews at a scale live sessions couldn’t reach.', 'Entrevistas qualitativas numa escala que sessões ao vivo não alcançariam.' ); ?></span>
			<div class="fm-pipe">
				<?php foreach ( $s as $x ) : ?>
					<div><i><?php echo esc_html( $x[0] ); ?></i><b><?php echo esc_html( $x[1] ); ?></b><span><?php echo esc_html( $x[2] ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
		break;

	case 'fm-profiles':
		$p = array(
			array(
				sera_t( 'Veterans', 'Veteranos' ),
				'#E25352',
				sera_t( 'Profitable · Strategic', 'Lucrativos · Estratégicos' ),
				array(
					sera_t( 'Invest the most and know the plans best, but returns vary a lot inside the group', 'Investem mais e conhecem melhor os planos, mas o retorno varia muito dentro do grupo' ),
					sera_t( 'Put earnings before self-care: skipped meals, answering clients until bedtime', 'Põem o ganho antes do autocuidado: pulam refeições e respondem clientes até a hora de dormir' ),
					sera_t( 'Reached big goals through the work and plan an exit: a flat, a business, a degree', 'Conquistaram coisas grandes com o trabalho e planejam a saída: um apartamento, um negócio, um diploma' ),
					sera_t( 'Feel undervalued as loyal customers, and see the ranking as a way to extract money', 'Se sentem pouco valorizados como clientes fiéis e veem o ranking como um jeito de arrancar dinheiro' ),
				),
			),
			array(
				sera_t( 'Loyal', 'Leais' ),
				'#B25CF0',
				sera_t( 'The most satisfied profile', 'O perfil mais satisfeito' ),
				array(
					sera_t( 'Well-defined routines with room for the gym, study, family and friends', 'Rotinas bem definidas, com espaço para academia, estudo, família e amigos' ),
					sera_t( 'Value the flexibility and the financial stability the platform gave them', 'Valorizam a flexibilidade e a estabilidade financeira que a plataforma trouxe' ),
					sera_t( 'Some, mostly longer-standing ones with fixed costs like rent, worry about fluctuating earnings', 'Alguns, sobretudo os mais antigos e com custos fixos como aluguel, se preocupam com a renda que oscila' ),
					sera_t( 'See growing competition in the ranking as a threat to staying visible', 'Veem a concorrência crescente no ranking como ameaça à própria visibilidade' ),
				),
			),
			array(
				sera_t( 'Jugglers', 'Malabaristas' ),
				'#4C7DF0',
				sera_t( 'A double working day', 'Dupla jornada' ),
				array(
					sera_t( 'Split time between a formal job, study or home office and escort work', 'Dividem o tempo entre emprego formal, estudo ou home office e o trabalho como acompanhante' ),
					sera_t( 'The central goal is a fixed, predictable income outside the profession', 'O objetivo central é uma renda fixa e previsível fora da profissão' ),
					sera_t( 'Struggle to attract clients even with paid plans, so they stay sceptical', 'Têm dificuldade de atrair clientes mesmo com plano pago, por isso seguem desconfiados' ),
					sera_t( 'Describe the platform as bureaucratic, buggy and expensive, and see the face check at login as a risk to the discretion their other job requires', 'Descrevem a plataforma como burocrática, cheia de bugs e cara, e veem a verificação facial no login como um risco à discrição que o outro emprego exige' ),
				),
			),
			array(
				sera_t( 'Improvisers', 'Improvisadores' ),
				'#2FB67C',
				sera_t( 'Idle, between jobs · Occasional', 'Ociosos, entre empregos · Ocasionais' ),
				array(
					sera_t( 'Never bought a plan, and many already earn reasonably without one', 'Nunca compraram um plano, e muitos já ganham razoavelmente sem ele' ),
					sera_t( 'Admit they don’t understand plans or the ranking at all', 'Admitem que não entendem nada de planos nem de ranking' ),
					sera_t( 'Lack a fixed place to meet clients and depend on ride apps', 'Não têm um lugar fixo para receber clientes e dependem de apps de transporte' ),
					sera_t( 'Men in the group are often approached by clients they don’t want to serve', 'Os homens do grupo costumam ser procurados por clientes que eles não querem atender' ),
				),
			),
		);
		?>
		<div class="fm-prof">
			<?php foreach ( $p as $x ) : ?>
				<div style="--c:<?php echo esc_attr( $x[1] ); ?>">
					<span class="glow"></span>
					<b><?php echo esc_html( $x[0] ); ?></b><small><?php echo esc_html( $x[2] ); ?></small>
					<ul><?php foreach ( $x[3] as $li ) : ?><li><?php echo esc_html( $li ); ?></li><?php endforeach; ?></ul>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
		break;

	case 'fm-voices':
		$q = array(
			array( sera_t( 'Veteran', 'Veteranos' ), sera_t( 'I usually eat lunch late, because when I’m doing this I forget to eat.', 'Eu costumo almoçar tarde porque, fazendo isso, eu esqueço de comer.' ) ),
			array( sera_t( 'Veteran', 'Veteranos' ), sera_t( 'My personal life has shrunk to my professional life.', 'Minha vida pessoal se resumiu à minha vida profissional.' ) ),
			array( sera_t( 'Loyal', 'Leais' ), sera_t( 'I wake up around 9, go to the gym and start working on Fatal Model from 1 pm.', 'Acordo lá pelas 9, vou pra academia e começo a trabalhar no Fatal Model a partir da 1 da tarde.' ) ),
			array( sera_t( 'Juggler', 'Malabaristas' ), sera_t( 'I’m working to survive more than to live.', 'Tô trabalhando mais pra sobreviver do que pra viver.' ) ),
			array( sera_t( 'Juggler', 'Malabaristas' ), sera_t( 'In five years I hope to have graduated and be working in my field. Once I am, I’ll leave escort work.', 'Daqui a cinco anos espero ter terminado a faculdade e estar trabalhando na minha área. Quando isso acontecer, saio da profissão.' ) ),
			array( sera_t( 'Improviser', 'Improvisadores' ), sera_t( 'I don’t do it for luxury, or to achieve big things. It’s to survive. To pay my bills.', 'Não faço isso por luxo, nem pra conquistar grandes coisas. É pra sobreviver. Pra pagar minhas contas.' ) ),
		);
		?>
		<div class="quotes">
			<?php foreach ( $q as $x ) : ?>
				<div class="quote"><p><?php echo esc_html( $x[1] ); ?></p><span><?php echo esc_html( $x[0] ); ?></span></div>
			<?php endforeach; ?>
		</div>
		<p class="art-cap"><?php sera_e( 'Quotes translated from Portuguese. Participants are not identified.', 'Falas anonimizadas. Ninguém que participou é identificado.' ); ?></p>
		<?php
		break;

	case 'fm-warnings':
		$w = array(
			array( sera_t( 'Veterans', 'Veteranos' ), 22, '#E25352', sera_t( 'Highest', 'Mais alta' ) ),
			array( sera_t( 'Loyal', 'Leais' ), 18, '#B25CF0', sera_t( 'High', 'Alta' ) ),
			array( sera_t( 'Jugglers', 'Malabaristas' ), 6, '#4C7DF0', sera_t( 'Low', 'Baixa' ) ),
			array( sera_t( 'Improvisers', 'Improvisadores' ), 4, '#2FB67C', sera_t( 'Lowest', 'Mais baixa' ) ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Triangulation · behaviour data', 'Triangulação · dados de comportamento' ); ?></span>
			<span class="art-title"><?php sera_e( 'The most engaged advertisers are also the most exposed to its penalties.', 'Os anunciantes mais engajados também são os mais expostos às punições da plataforma.' ); ?></span>
			<div class="fm-bars">
				<?php foreach ( $w as $x ) : ?>
					<div><span><?php echo esc_html( $x[0] ); ?></span><i style="--v:<?php echo (int) $x[1]; ?>;--c:<?php echo esc_attr( $x[2] ); ?>"></i><b><?php echo esc_html( $x[3] ); ?></b></div>
				<?php endforeach; ?>
			</div>
			<p class="art-cap"><?php sera_e( 'Relative share of each profile with warnings on the platform (figures withheld). In the interviews, advertisers said feedback on warnings and bans was unclear.', 'Parcela relativa de cada perfil com advertências na plataforma (números omitidos). Nas entrevistas, os anunciantes disseram que não entendiam o motivo das advertências e dos banimentos.' ); ?></p>
		</div>
		<?php
		break;

	case 'fm-common':
		$all = sera_t( 'Across all profiles', 'Em todos os perfis' );
		?>
		<div class="statement fm-st">
			<span class="art-label"><?php sera_e( 'What we didn’t set out to find', 'O que a gente não foi procurar' ); ?></span>
			<p><?php sera_e( '“We never know what we’re in for <em>when we open the door.</em>”', '“A gente nunca sabe o que vai encontrar <em>quando abre a porta.</em>”' ); ?></p>
		</div>
		<div class="art-grid cols-3 fm-common">
			<div class="art-card"><span class="art-label"><?php echo esc_html( $all ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Toxic interactions are part of the routine', 'Interações tóxicas fazem parte da rotina' ); ?></h4><p><?php sera_e( 'Rude and disrespectful clients, constant haggling over price, and a daily exposure that takes a real psychological toll.', 'Clientes grosseiros e desrespeitosos, pechincha o tempo todo e uma exposição diária que cobra um preço psicológico real.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php echo esc_html( $all ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Time-wasters and scams', 'Curiosos e golpes' ); ?></h4><p><?php sera_e( 'People asking for free photos and videos, bookings that never show up, and attempts to scam, which keep advertisers on constant alert.', 'Gente pedindo foto e vídeo de graça, agendamentos em que ninguém aparece e tentativas de golpe, que deixam os anunciantes em alerta constante.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php echo esc_html( $all ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Limits are not always respected', 'Os limites nem sempre são respeitados' ); ?></h4><p><?php sera_e( 'Many reports of clients asking for things outside what was agreed, during the appointment itself.', 'Muitos relatos de clientes pedindo coisas fora do combinado, já durante o atendimento.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php echo esc_html( $all ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'A constant sense of vulnerability', 'Uma sensação constante de vulnerabilidade' ); ?></h4><p><?php sera_e( 'Fear of violence when meeting a new client is, sadly, a common part of the job.', 'O medo de violência ao encontrar um cliente novo é, infelizmente, parte comum do trabalho.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'What they asked for', 'O que pediram' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Safety designed for advertisers', 'Segurança pensada para quem anuncia' ); ?></h4><p><?php sera_e( 'A clear request for stronger checks on clients, to protect advertisers from possible threats.', 'Um pedido claro por uma verificação mais rígida dos clientes, para proteger os anunciantes de possíveis ameaças.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( 'What they value most', 'O que mais valorizam' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Reputation and safety', 'Reputação e segurança' ); ?></h4><p><?php sera_e( 'Face verification and comparison media were seen as protection for them too, because clients trust the platform more.', 'A verificação facial e as mídias de comparação também foram vistas como proteção para eles, porque os clientes confiam mais na plataforma.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'fm-impact':
		?>
		<div class="impact" style="background:#0E0D14">
			<span class="art-label"><?php sera_e( 'Impact', 'Impacto' ); ?></span>
			<h3><?php sera_e( 'A study about revenue that became the base for how the company organised itself around the people behind it.', 'Uma pesquisa sobre receita que virou a base de como a empresa se organizou em torno das pessoas por trás dela.' ); ?></h3>
			<div class="impact-grid">
				<div><b><?php sera_e( 'Async', 'Em vídeo' ); ?></b><span><?php sera_e( 'Advertisers heard by video, on their own time', 'Anunciantes ouvidos de forma assíncrona, no tempo de cada um' ); ?></span></div>
				<div><b><?php sera_e( 'At scale', 'Em escala' ); ?></b><span><?php sera_e( 'A survey that confirmed the patterns', 'Um questionário que confirmou os padrões' ); ?></span></div>
				<div><b>4</b><span><?php sera_e( 'Profiles, each with its routines, goals and pains', 'Perfis, cada um com suas rotinas, objetivos e dores' ); ?></span></div>
				<div><b><?php sera_e( 'New OKRs', 'Novos OKRs' ); ?></b><span><?php sera_e( 'The base for the next planning cycle and a reorganisation around advertisers', 'A base do ciclo de planejamento seguinte e de uma reorganização em torno dos anunciantes' ); ?></span></div>
			</div>
			<div class="impact-foot"><span><?php sera_e( 'Safety for advertisers', 'Segurança para anunciantes' ); ?></span><span><?php sera_e( 'Clarity on plans and ranking', 'Clareza sobre planos e ranking' ); ?></span><span><?php sera_e( 'Fair, explained moderation', 'Moderação justa e explicada' ); ?></span><span><?php sera_e( 'Recognition for loyalty', 'Reconhecimento da fidelidade' ); ?></span><span><?php sera_e( 'Discreet access', 'Acesso discreto' ); ?></span></div>
		</div>
		<p class="art-cap"><?php sera_e( 'The tags are the opportunity areas the study opened, taken from the insights above.', 'As tags são as áreas de oportunidade que o estudo abriu, tiradas dos insights acima.' ); ?></p>
		<?php
		break;

	case 'fm-next':
		?>
		<div class="art-panel fm-later">
			<span class="art-label"><?php sera_e( 'Planned next · Perfis 2.0', 'Próxima rodada · Perfis 2.0' ); ?></span>
			<span class="art-title"><?php sera_e( 'We started in the middle of the lifecycle. The next round goes to both ends.', 'Começamos pelo meio do ciclo de vida. A próxima rodada vai às duas pontas.' ); ?></span>
			<div class="fm-cycle"><div><small><?php sera_e( 'Pre-cycle', 'Antes do ciclo' ); ?></small><b><?php sera_e( 'People who haven’t signed up yet', 'Quem ainda não se cadastrou' ); ?></b></div><div class="on"><small><?php sera_e( 'This study', 'Este estudo' ); ?></small><b><?php sera_e( 'From never bought to most loyal', 'De quem nunca comprou aos mais fiéis' ); ?></b></div><div><small><?php sera_e( 'End of cycle', 'Fim do ciclo' ); ?></small><b><?php sera_e( 'Advertisers in the process of leaving', 'Anunciantes de saída da plataforma' ); ?></b></div></div>
		</div>
		<?php
		break;

	case 'fm-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><li><?php sera_e( 'The asynchronous format: video questions answered on each person’s own time reached people a calendar of live interviews never would', 'O formato assíncrono: perguntas em vídeo, respondidas no tempo de cada pessoa, chegaram a gente que nenhuma agenda de entrevistas ao vivo alcançaria' ); ?></li><li><?php sera_e( 'Closing a revenue readout with safety. It was the one finding every profile shared, and the company acted on it', 'Fechar uma apresentação sobre receita falando de segurança. Foi o único achado comum a todos os perfis, e a empresa agiu a partir dele' ); ?></li></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><li><?php sera_e( 'Hear advertisers who are leaving, and people who never signed up, in the same round instead of a planned second one', 'Ouvir quem está saindo da plataforma, e quem nunca se cadastrou, já nesta rodada, em vez de deixar para uma segunda' ); ?></li><li><?php sera_e( 'Attach a measurable OKR to each opportunity area in the readout itself, so the restructuring started with numbers to beat', 'Amarrar um OKR mensurável a cada área de oportunidade na própria apresentação, para a reestruturação já começar com números a bater' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'fm-signals':
		?>
		<div class="signals">
			<div><i>01</i><b><?php sera_e( 'Designed the method and ran the study', 'Desenhei o método e conduzi a pesquisa' ); ?></b><span><?php sera_e( 'An asynchronous, AI-assisted method that reached people live interviews never would, then tested the patterns at scale.', 'Um método assíncrono, com apoio de IA, que chegou a gente que entrevista ao vivo nunca alcançaria, e depois testou os padrões em escala.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'Humanised a stigmatised audience', 'Humanizei um público estigmatizado' ); ?></b><span><?php sera_e( 'Advertisers presented as people, with their own routines, goals and fears.', 'Anunciantes apresentados como pessoas, com rotinas, objetivos e medos próprios.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Followed the evidence past the brief', 'Segui a evidência além do briefing' ); ?></b><span><?php sera_e( 'A question about profitability uncovered vulnerability, and the study made room for it.', 'Uma pergunta sobre rentabilidade revelou vulnerabilidade, e o estudo abriu espaço para ela.' ); ?></span></div>
			<div><i>04</i><b><?php sera_e( 'Turned insight into organisation', 'Transformei insight em organização' ); ?></b><span><?php sera_e( 'The readout became the base for the next cycle’s OKRs and a reorganisation around advertisers.', 'A apresentação virou a base dos OKRs do ciclo seguinte e de uma reorganização em torno dos anunciantes.' ); ?></span></div>
			<div><i>05</i><b><?php sera_e( 'Triangulated words with behaviour', 'Cruzei o que diziam com o que faziam' ); ?></b><span><?php sera_e( 'Started from an RFM cut with data science, and checked what people said against what the platform recorded.', 'Partimos de um recorte RFM com ciência de dados e conferimos o que as pessoas diziam com o que a plataforma registrava.' ); ?></span></div>
			<div><i>06</i><b><?php sera_e( 'Kept the open questions open', 'Deixei as perguntas abertas à vista' ); ?></b><span><?php sera_e( 'Requests the company couldn’t act on yet stayed in the readout as open questions.', 'Pedidos que a empresa ainda não podia atender ficaram na apresentação como perguntas em aberto.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'fm-day':
		/* Routines as each profile described them. Blocks in order through the day; widths are relative, not clock time. */
		$d = array(
			array( sera_t( 'Veterans', 'Veteranos' ), '#E25352', sera_t( 'Work fills the day. Self-care fits into the gaps.', 'O trabalho ocupa o dia. O autocuidado cabe nas brechas.' ), array(
				array( 'self', 2, sera_t( 'Meals when there’s a lull, sometimes just one a day', 'Comem quando o movimento dá uma trégua, às vezes uma vez só no dia' ) ),
				array( 'fm', 4, sera_t( 'The whole afternoon tuning profiles for more engagement', 'A tarde inteira ajustando o perfil para ter mais engajamento' ) ),
				array( 'fm', 3, sera_t( 'Answering clients until bedtime', 'Respondendo clientes até a hora de dormir' ) ),
			) ),
			array( sera_t( 'Loyal', 'Leais' ), '#B25CF0', sera_t( 'Work has its slot, and life has room.', 'O trabalho tem hora marcada, e a vida tem espaço.' ), array(
				array( 'self', 2, sera_t( 'Wake around 9 to 11, a healthy breakfast', 'Acordam entre 9h e 11h, café da manhã saudável' ) ),
				array( 'self', 2, sera_t( 'Gym or a walk', 'Academia ou caminhada' ) ),
				array( 'fm', 3, sera_t( 'Platform work from 1 pm', 'Trabalho na plataforma a partir das 13h' ) ),
				array( 'self', 2, sera_t( 'Friends, family, reading, painting, language classes', 'Amigos, família, leitura, pintura, aula de idiomas' ) ),
			) ),
			array( sera_t( 'Jugglers', 'Malabaristas' ), '#4C7DF0', sera_t( 'Two working days in one.', 'Duas jornadas em uma.' ), array(
				array( 'job', 2, sera_t( 'Early start, as early as 5 am', 'Começam cedo, às vezes às 5h' ) ),
				array( 'job', 4, sera_t( 'Formal job, home office or a doctorate', 'Emprego formal, home office ou doutorado' ) ),
				array( 'fm', 2, sera_t( 'Clients fitted in between, or after a late shift', 'Clientes encaixados no meio, ou depois de um turno que acaba tarde' ) ),
				array( 'self', 2, sera_t( 'Weekends kept for rest and family', 'Fim de semana reservado para descanso e família' ) ),
			) ),
			array( sera_t( 'Improvisers · Idle', 'Improvisadores · Ociosos' ), '#2FB67C', sera_t( 'Plenty of time, not enough demand.', 'Tempo de sobra, demanda de menos.' ), array(
				array( 'self', 3, sera_t( 'Mostly at home: series, podcasts, hobbies', 'Quase sempre em casa: séries, podcasts, hobbies' ) ),
				array( 'job', 2, sera_t( 'Some are looking for a new job', 'Alguns procuram um novo emprego' ) ),
				array( 'wait', 4, sera_t( 'Waiting for a client, sometimes one or two a week', 'Esperando cliente, às vezes um ou dois por semana' ) ),
			) ),
			array( sera_t( 'Improvisers · Occasional', 'Improvisadores · Ocasionais' ), '#2FB67C', sera_t( 'The fixed job always comes first.', 'O emprego fixo sempre vem primeiro.' ), array(
				array( 'job', 2, sera_t( 'Up early to beat traffic, or home from a night shift', 'Acordam cedo para fugir do trânsito, ou chegam de um turno da noite' ) ),
				array( 'job', 4, sera_t( 'A full day at a fixed job, from ride-hailing to retail', 'Um dia inteiro no emprego fixo, de motorista de app a vendedor' ) ),
				array( 'fm', 2, sera_t( 'A client only if it fits the free time left', 'Cliente só se couber no tempo livre que sobra' ) ),
			) ),
		);
		$legend = array(
			'fm'   => sera_t( 'Escort work on the platform', 'Trabalho como acompanhante na plataforma' ),
			'job'  => sera_t( 'Another job or study', 'Outro emprego ou estudo' ),
			'self' => sera_t( 'Self-care and personal life', 'Autocuidado e vida pessoal' ),
			'wait' => sera_t( 'Idle, waiting for clients', 'Tempo parado, à espera de clientes' ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'A normal day · the routine question', 'Um dia normal · a pergunta da rotina' ); ?></span>
			<span class="art-title"><?php sera_e( 'Asked to walk us through a normal day, each profile described a different one.', 'Quando pedimos que contassem um dia normal, cada perfil descreveu um dia diferente.' ); ?></span>
			<div class="fm-day-axis" aria-hidden="true"><span><?php sera_e( 'Wake up', 'Acordar' ); ?></span><i></i><span><?php sera_e( 'Go to sleep', 'Dormir' ); ?></span></div>
			<div class="fm-day">
				<?php foreach ( $d as $row ) : ?>
					<div class="fm-day-row" style="--c:<?php echo esc_attr( $row[1] ); ?>">
						<div class="who"><b><?php echo esc_html( $row[0] ); ?></b><span><?php echo esc_html( $row[2] ); ?></span></div>
						<div class="strip">
							<?php foreach ( $row[3] as $blk ) : ?>
								<div class="blk k-<?php echo esc_attr( $blk[0] ); ?>" style="--w:<?php echo (int) $blk[1]; ?>"><span><?php echo esc_html( $blk[2] ); ?></span></div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="fm-day-key">
				<?php foreach ( $legend as $k => $l ) : ?>
					<span><i class="k-<?php echo esc_attr( $k ); ?>"></i><?php echo esc_html( $l ); ?></span>
				<?php endforeach; ?>
			</div>
			<p class="art-cap"><?php sera_e( 'Built from the routines participants described in the interviews. Blocks follow the order of the day; widths show emphasis, not clock time.', 'Montado a partir das rotinas que os participantes descreveram nas entrevistas. Os blocos seguem a ordem do dia; a largura mostra ênfase, não horário.' ); ?></p>
		</div>
		<?php
		break;

	case 'fm-plans':
		$r = array(
			array( sera_t( 'Veterans · Profitable', 'Veteranos · Lucrativos' ), sera_t( 'Most Veterans', 'A maioria dos Veteranos' ), '#E25352', sera_t( 'Buy all the time, some weekly to keep it affordable', 'Compram o tempo todo, alguns por semana para caber no bolso' ), sera_t( 'A clear, steady return on what they paid', 'Um retorno claro e constante sobre o que pagaram' ), sera_t( 'Understand plans and ranking best, and many still call it “just a way to squeeze money out of escorts”', 'São quem mais entende de planos e ranking, e muitos ainda chamam de “só um jeito de arrancar dinheiro das acompanhantes”' ) ),
			array( sera_t( 'Veterans · Strategic', 'Veteranos · Estratégicos' ), sera_t( 'The other Veterans', 'Os demais Veteranos' ), '#E25352', sera_t( 'Time every purchase: skip the end of the month, spend more when fewer clients are searching', 'Escolhem a hora de cada compra: pulam o fim do mês e gastam mais quando há menos clientes buscando' ), sera_t( 'A smaller return for the same investment', 'Um retorno menor pelo mesmo investimento' ), sera_t( 'The same critique, plus a sense that one ranking across so many cities and services is unfair to small towns', 'A mesma crítica, e a sensação de que um ranking único para tantas cidades e serviços é injusto com as cidades pequenas' ) ),
			array( sera_t( 'Loyal', 'Leais' ), sera_t( 'The most satisfied profile', 'O perfil mais satisfeito' ), '#B25CF0', sera_t( 'Buy regularly. Some cut back from every plan to two as earnings dropped', 'Compram com regularidade. Alguns passaram de todos os planos para dois quando a renda caiu' ), sera_t( 'Adequate or better, and almost immediate', 'Adequado ou melhor, e quase imediato' ), sera_t( 'Growing competition for visibility makes them wonder if they’ll stay relevant', 'A disputa crescente por visibilidade faz eles se perguntarem se vão continuar relevantes' ) ),
			array( sera_t( 'Jugglers', 'Malabaristas' ), sera_t( 'Sceptical of plans', 'Desconfiados dos planos' ), '#4C7DF0', sera_t( 'Mostly the cheapest plan, the one that shows their phone number', 'Quase sempre o plano mais barato, o que mostra o telefone' ), sera_t( 'Below expectations: on a top plan, “I felt like I was paying for the lowest one”', 'Abaixo do esperado: num plano top, “parecia que eu estava pagando o mais básico”' ), sera_t( '“I don’t really understand how the ranking works”, and they doubt it changes their exposure', '“Não entendo muito bem como o ranking funciona”, e duvidam que ele mude a exposição' ) ),
			array( sera_t( 'Improvisers', 'Improvisadores' ), sera_t( 'Never bought a plan', 'Nunca compraram um plano' ), '#2FB67C', sera_t( 'Never. Prices looked too high, and some tried to pay and couldn’t', 'Nunca. Os preços pareciam altos demais, e alguns tentaram pagar e não conseguiram' ), sera_t( 'Reasonable earnings without a plan, so less reason to invest', 'Ganham razoavelmente sem plano, então têm menos motivo para investir' ), sera_t( '“I don’t even know what this ranking is”', '“Nem sei o que é esse ranking”' ) ),
		);
		$hb = sera_t( 'How they buy', 'Como compram' );
		$hg = sera_t( 'What they get back', 'O que recebem de volta' );
		$hr = sera_t( 'How they read the ranking', 'Como leem o ranking' );
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Plans and ranking · by profile', 'Planos e ranking · por perfil' ); ?></span>
			<span class="art-title"><?php sera_e( 'The same plans, and five very different relationships with them.', 'Os mesmos planos, e cinco relações bem diferentes com eles.' ); ?></span>
			<div class="fm-plans">
				<div class="fm-plans-head" aria-hidden="true"><span></span><span><?php echo esc_html( $hb ); ?></span><span><?php echo esc_html( $hg ); ?></span><span><?php echo esc_html( $hr ); ?></span></div>
				<?php foreach ( $r as $x ) : ?>
					<div class="fm-plans-row" style="--c:<?php echo esc_attr( $x[2] ); ?>">
						<div class="who"><b><?php echo esc_html( $x[0] ); ?></b><small><?php echo esc_html( $x[1] ); ?></small></div>
						<div><em><?php echo esc_html( $hb ); ?></em><?php echo esc_html( $x[3] ); ?></div>
						<div><em><?php echo esc_html( $hg ); ?></em><?php echo esc_html( $x[4] ); ?></div>
						<div><em><?php echo esc_html( $hr ); ?></em><?php echo esc_html( $x[5] ); ?></div>
					</div>
				<?php endforeach; ?>
				<div class="fm-plans-rail" aria-hidden="true"><span><?php sera_e( 'Understand plans best', 'Entendem mais os planos' ); ?></span><i></i><span><?php sera_e( 'Understand them least', 'Entendem menos' ); ?></span></div>
			</div>
			<p class="art-cap"><?php sera_e( 'Quotes translated from Portuguese. Return is as participants described it; revenue figures are omitted.', 'Falas anonimizadas. O retorno é o que os participantes descreveram; números de receita foram omitidos.' ); ?></p>
		</div>
		<?php
		break;

	case 'fm-asks':
		$vet = sera_t( 'Veteran', 'Veteranos' );
		$jug = sera_t( 'Juggler', 'Malabaristas' );
		$m   = array(
			array( sera_t( 'Safety for advertisers', 'Segurança para anunciantes' ), array( array( sera_t( 'Finding across all profiles', 'Achado em todos os perfis' ), sera_t( 'A clear request for stronger checks on clients, to protect advertisers from possible threats.', 'Um pedido claro por uma verificação mais rígida dos clientes, para proteger os anunciantes de possíveis ameaças.' ), 1 ) ) ),
			array( sera_t( 'Fair, explained moderation', 'Moderação justa e explicada' ), array( array( $vet, sera_t( 'A three-day penalty, and in the end I didn’t know why.', 'Três dias de punição, e no fim eu nem sabia por quê.' ) ), array( $vet, sera_t( 'Penalties could be lighter. If it isn’t something serious, give the person a chance to make it right instead of a ban.', 'As punições podiam ser mais leves. Se não for nada grave, dá uma chance de a pessoa corrigir em vez de banir.' ) ) ) ),
			array( sera_t( 'Clarity on plans and ranking', 'Clareza sobre planos e ranking' ), array( array( sera_t( 'Improviser', 'Improvisadores' ), sera_t( 'I’ve seen the plans, but this ranking thing, I don’t know what it is.', 'Os planos eu já vi, mas essa coisa de ranking eu não sei o que é.' ) ), array( $jug, sera_t( 'I don’t really understand how the ranking works. I know points and ranking are linked.', 'Não entendo muito bem como o ranking funciona. Sei que ponto e ranking estão ligados.' ) ) ) ),
			array( sera_t( 'Recognition for loyalty', 'Reconhecimento da fidelidade' ), array( array( $vet, sera_t( 'It would be great to launch coupons for those who always buy every package.', 'Seria ótimo lançar cupom pra quem sempre compra todos os pacotes.' ) ), array( $vet, sera_t( 'For those of us who joined a long time ago, there’s no discount. New girls get lots of them.', 'Pra quem entrou há muito tempo não tem desconto nenhum. As meninas novas ganham um monte.' ) ) ) ),
			array( sera_t( 'Discreet access', 'Acesso discreto' ), array( array( $jug, sera_t( 'Showing my face every time I log in feels bureaucratic. Sometimes I’m somewhere I can’t, because of my other job.', 'Mostrar o rosto toda vez que entro é burocrático. Às vezes estou num lugar onde não dá, por causa do meu outro trabalho.' ) ) ) ),
		);
		$open = array(
			sera_t( 'A minimum price per appointment, to curb haggling (Veterans)', 'Um preço mínimo por atendimento, para frear a pechincha (Veteranos)' ),
			sera_t( 'Plans that activate right away, and profiles that don’t freeze (Jugglers)', 'Planos que ativam na hora, e perfis que não travam (Malabaristas)' ),
			sera_t( 'Monthly vouchers to change city, for top-plan holders (Veterans)', 'Vouchers mensais para mudar de cidade, para quem tem plano top (Veteranos)' ),
		);
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'From their words to the work', 'Das palavras deles para o trabalho' ); ?></span>
			<span class="art-title"><?php sera_e( 'Every opportunity area traces back to something advertisers asked for.', 'Cada área de oportunidade nasce de algo que os anunciantes pediram.' ); ?></span>
			<div class="fm-asks">
				<div class="fm-asks-head" aria-hidden="true"><span><?php sera_e( 'What advertisers asked for', 'O que os anunciantes pediram' ); ?></span><span><?php sera_e( 'Opportunity area', 'Área de oportunidade' ); ?></span></div>
				<?php foreach ( $m as $i => $x ) : ?>
					<div class="fm-asks-row">
						<div class="said">
							<?php foreach ( $x[1] as $q ) : ?>
								<p<?php echo empty( $q[2] ) ? '' : ' class="para"'; ?>><?php echo esc_html( empty( $q[2] ) ? '“' . $q[1] . '”' : $q[1] ); ?><small><?php echo esc_html( $q[0] ); ?></small></p>
							<?php endforeach; ?>
						</div>
						<span class="link" aria-hidden="true"><i></i></span>
						<div class="area"><small><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></small><b><?php echo esc_html( $x[0] ); ?></b></div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="fm-asks-open"><span class="art-label"><?php sera_e( 'Also raised, left as open questions', 'Também apareceram, e ficaram como perguntas em aberto' ); ?></span><ul><?php foreach ( $open as $o ) : ?><li><?php echo esc_html( $o ); ?></li><?php endforeach; ?></ul></div>
			<p class="art-cap"><?php sera_e( 'Requests translated from Portuguese. Participants are not identified.', 'Pedidos anonimizados. Ninguém que participou é identificado.' ); ?></p>
		</div>
		<?php
		break;

endswitch;
