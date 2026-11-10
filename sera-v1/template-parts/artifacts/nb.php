<?php
/**
 * Artifacts — Bastidores · editorial redesign and ad strategy (2026).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

switch ( $args['name'] ) :

	case 'nb-glance':
		?>
		<dl class="glance">
			<div><dt><?php sera_e( 'Product', 'Produto' ); ?></dt><dd><?php sera_e( 'Bastidores (nosbastidores.com.br), a Brazilian site of film, TV and game criticism and pop-culture news', 'Bastidores (nosbastidores.com.br), site brasileiro de crítica de cinema, séries e games e de notícias de cultura pop' ); ?></dd></div>
			<div><dt><?php sera_e( 'My role', 'Meu papel' ); ?></dt><dd><?php sera_e( 'Owner of the product: strategy, design and front end, end to end', 'Dono do produto: estratégia, design e front-end, de ponta a ponta' ); ?></dd></div>
			<div><dt><?php sera_e( 'Scope', 'Escopo' ); ?></dt><dd><?php sera_e( 'Identity, homepage and templates, mobile, performance and the ad strategy', 'Identidade, home e templates, mobile, performance e a estratégia de anúncios' ); ?></dd></div>
			<div><dt><?php sera_e( 'Timeline', 'Período' ); ?></dt><dd><?php sera_e( 'Redesign shipped in 2026', 'Redesign lançado em 2026' ); ?></dd></div>
		</dl>
		<?php
		break;

	case 'nb-audit':
		?>
		<div class="art-grid cols-4">
			<div class="art-card"><span class="art-label"><?php sera_e( '01 · Identity', '01 · Identidade' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'A viral-news theme for a criticism site', 'Um tema de notícia viral num site de crítica' ); ?></h4><p><?php sera_e( 'A stock theme made for quizzes and viral lists. Uppercase everywhere, generic blue, nothing that said “this is where criticism happens”.', 'Um tema pronto, feito para quizzes e listas virais. Caixa-alta em tudo, azul genérico, nada que dissesse “aqui a crítica acontece”.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( '02 · Hierarchy', '02 · Hierarquia' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Three menus before the first story', 'Três menus antes da primeira matéria' ); ?></h4><p><?php sera_e( 'Social links, a “Popular · Quente · Tendência” bar, the main menu and a row of six thumbnails, all above the fold and all at the same volume.', 'Links de redes sociais, uma barra “Popular · Quente · Tendência”, o menu principal e uma fileira de seis miniaturas, tudo acima da dobra e tudo no mesmo volume.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( '03 · Content', '03 · Conteúdo' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Reviews buried in the feed', 'Críticas enterradas no feed' ); ?></h4><p><?php sera_e( 'The reviews, the reason the site exists, looked exactly like any piece of news, mixed into long lists with small thumbnails.', 'As críticas, a razão de o site existir, pareciam uma notícia qualquer, misturadas em listas longas com miniaturas pequenas.' ); ?></p></div>
			<div class="art-card"><span class="art-label"><?php sera_e( '04 · Revenue', '04 · Receita' ); ?></span><h4 style="margin-top:14px"><?php sera_e( 'Ads with no place of their own', 'Anúncios sem lugar próprio' ); ?></h4><p><?php sera_e( 'Ad units had to fight the layout for space. Every new unit made reading worse, and every page was heavier than it needed to be.', 'Os anúncios tinham que brigar com o layout por espaço. Cada bloco novo piorava a leitura, e toda página pesava mais do que precisava.' ); ?></p></div>
		</div>
		<?php
		break;

	case 'nb-levers':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'The bet', 'A aposta' ); ?></span>
			<span class="art-title"><?php sera_e( 'One product, two levers that usually fight each other.', 'Um produto, duas alavancas que costumam brigar entre si.' ); ?></span>
			<div class="nb-levers">
				<div><b><?php sera_e( 'Audience', 'Audiência' ); ?></b><span><?php sera_e( 'Give people a reason to come, stay and come back: criticism up front, a clear hierarchy, fast pages on the phone.', 'Dar às pessoas um motivo para chegar, ficar e voltar: crítica na frente, hierarquia clara, páginas rápidas no celular.' ); ?></span><ul><li><?php sera_e( 'Reviews as the front door', 'Críticas como porta de entrada' ); ?></li><li><?php sera_e( 'Editorial identity', 'Identidade editorial' ); ?></li><li><?php sera_e( 'Lighter pages, mobile first', 'Páginas mais leves, mobile first' ); ?></li></ul></div>
				<i aria-hidden="true">+</i>
				<div><b><?php sera_e( 'Revenue', 'Receita' ); ?></b><span><?php sera_e( 'Grow revenue without taxing the reading: fewer, better-placed units that belong to the grid.', 'Aumentar a receita sem cobrar pedágio da leitura: menos anúncios, mais bem posicionados, que fazem parte do grid.' ); ?></span><ul><li><?php sera_e( 'Ad slots designed into the layout', 'Espaços de anúncio desenhados no layout' ); ?></li><li><?php sera_e( 'Reserved space, no layout jumps', 'Espaço reservado, sem a página pular' ); ?></li><li><?php sera_e( 'A direct channel for advertisers', 'Um canal direto para anunciantes' ); ?></li></ul></div>
			</div>
			<p class="art-cap"><?php sera_e( 'The rule for every decision: an ad that makes the page worse to read costs more traffic than it earns.', 'A regra para toda decisão: um anúncio que piora a leitura custa mais audiência do que rende.' ); ?></p>
		</div>
		<?php
		break;

	case 'nb-system':
		?>
		<div class="art-panel nb-ds">
			<span class="art-label"><?php sera_e( 'The editorial system', 'O sistema editorial' ); ?></span>
			<span class="art-title"><?php sera_e( 'A stock theme replaced by an editorial identity.', 'Um tema pronto trocado por uma identidade editorial.' ); ?></span>
			<div class="nb-ds-grid">
				<div class="brand"><?php echo sera_nb_logo(); // phpcs:ignore ?><small><?php sera_e( 'The director’s chair icon, kept from the old logo, with a heavy serif wordmark', 'O ícone da cadeira de diretor, mantido do logo antigo, com um logotipo em serifa pesada' ); ?></small></div>
				<div class="type"><b>Aa</b><div><strong>Fraunces</strong><span><?php sera_e( 'Headlines and section titles', 'Títulos e nomes de seção' ); ?></span><strong>Inter</strong><span><?php sera_e( 'Body copy, built for long reads', 'Texto corrido, feito para leituras longas' ); ?></span><strong class="mono">JetBrains Mono</strong><span><?php sera_e( 'Labels, chips, the news ticker', 'Rótulos, chips, o ticker de notícias' ); ?></span></div></div>
				<div class="sw"><span style="background:#F7F5F0;color:#0A0A0A"><?php sera_e( 'Paper', 'Papel' ); ?></span><span style="background:#0A0A0A"><?php sera_e( 'Ink', 'Tinta' ); ?></span><span style="background:#FF3B00"><?php sera_e( 'Breaking', 'Urgente' ); ?></span><span style="background:#0A4F63"><?php sera_e( 'Category', 'Categoria' ); ?></span></div>
				<div class="titles"><span><em>Críticas</em> <small>de</small> <strong>Cinema</strong></span><span><em>Críticas</em> <small>de</small> <strong>Games</strong></span><span><strong>Últimas</strong> <em>do Bastidores</em></span></div>
			</div>
		</div>
		<?php
		break;

	case 'nb-ads':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Ad strategy', 'Estratégia de anúncios' ); ?></span>
			<span class="art-title"><?php sera_e( 'Ads designed as part of the page.', 'Anúncios desenhados como parte da página.' ); ?></span>
			<div class="nb-adplan">
				<div class="page" aria-hidden="true">
					<i class="bar"></i><i class="head"></i><i class="ad a1"><?php sera_e( 'Header slot', 'Slot do topo' ); ?></i>
					<i class="hero"></i><i class="row"></i><i class="row"></i><i class="ad a2"><?php sera_e( 'In-feed', 'No feed' ); ?></i><i class="row"></i><i class="foot"></i>
				</div>
				<ol>
					<li><b><?php sera_e( 'Planned places', 'Lugares planejados' ); ?></b><span><?php sera_e( 'Ads live in places decided with the layout: under the header and between feed sections.', 'Os anúncios moram em lugares decididos junto com o layout: abaixo do cabeçalho e entre as seções do feed.' ); ?></span></li>
					<li><b><?php sera_e( 'Fewer, better placed', 'Menos anúncios, mais bem posicionados' ); ?></b><span><?php sera_e( 'One slot under the header and in-feed units between sections, so the stories stay in focus.', 'Um espaço abaixo do cabeçalho e anúncios no feed entre as seções, para as matérias seguirem em destaque.' ); ?></span></li>
					<li><b><?php sera_e( 'Two sources of demand', 'Duas fontes de demanda' ); ?></b><span><?php sera_e( 'An ad network for fill, and a direct channel for brands (“Quer anunciar? Manda um email pro Matheus”: want to advertise? Email Matheus).', 'Uma rede de anúncios para preencher os espaços, e um canal direto com as marcas (“Quer anunciar? Manda um email pro Matheus”).' ); ?></span></li>
				</ol>
			</div>
		</div>
		<?php
		break;

	case 'nb-impact':
		?>
		<div class="impact" style="background:#0A0A0A">
			<span class="art-label"><?php sera_e( 'Impact', 'Impacto' ); ?></span>
			<h3><?php sera_e( 'More people reading, and a more profitable site.', 'Mais gente lendo, e um site mais lucrativo.' ); ?></h3>
			<div class="impact-grid">
				<div><b>~500<small class="u">%</small></b><span><?php sera_e( 'More visits in the 30 days after launch, vs the 30 before', 'Mais visitas nos 30 dias após o lançamento, contra os 30 anteriores' ); ?></span></div>
				<div><b>+20<small class="u">%</small></b><span><?php sera_e( 'Higher ad revenue per visit in the same window', 'De receita de anúncios por visita, no mesmo período' ); ?></span></div>
				<div><b>~4<small class="u">×</small></b><span><?php sera_e( 'Lighter homepage HTML, from about 200 KB to about 52 KB', 'Mais leve: o HTML da home caiu de cerca de 200 KB para cerca de 52 KB' ); ?></span></div>
			</div>
			<div class="impact-foot"><span><?php sera_e( 'Reviews as the front door', 'Críticas como porta de entrada' ); ?></span><span><?php sera_e( 'Designed ad slots', 'Espaços de anúncio desenhados' ); ?></span><span>Mobile first</span></div>
		</div>
		<p class="art-cap"><?php sera_e( 'Visits and ad revenue per visit measured in the 30 days after launch against the 30 days before, same publishing rhythm, from the site’s own analytics and ad reports. HTML weights measured on archived snapshots of the homepage (April and May 2026).', 'Visitas e receita de anúncios por visita medidas nos 30 dias após o lançamento contra os 30 dias anteriores, com o mesmo ritmo de publicação, a partir do analytics e dos relatórios de anúncios do próprio site. Peso do HTML medido em snapshots arquivados da home (abril e maio de 2026).' ); ?></p>
		<?php
		break;

	case 'nb-reflection':
		?>
		<div class="reflect">
			<div><span class="art-label"><?php sera_e( 'What I’d keep', 'O que eu manteria' ); ?></span><ul><li><?php sera_e( 'Deciding where the ads live before drawing the layout. Reserved, labelled slots are why the page never jumps', 'Decidir onde os anúncios moram antes de desenhar o layout. Espaços reservados e sinalizados são o motivo de a página nunca pular' ); ?></li><li><?php sera_e( 'Criticism as the front door. The mosaic of reviews shows what the site is about, which the old theme never did', 'A crítica como porta de entrada. O mosaico de críticas mostra do que o site trata, coisa que o tema antigo nunca fez' ); ?></li></ul></div>
			<div class="alt"><span class="art-label"><?php sera_e( 'What I’d change', 'O que eu mudaria' ); ?></span><ul><li><?php sera_e( 'Measure over a longer window: 30 days show the launch worked, but not yet whether the audience stays', 'Medir por mais tempo: 30 dias mostram que o lançamento deu certo, mas ainda não se a audiência fica' ); ?></li><li><?php sera_e( 'Design the article page with the same care as the homepage from the start, since that is where most readers land', 'Desenhar a página de matéria com o mesmo cuidado da home desde o começo, porque é nela que a maioria dos leitores chega' ); ?></li></ul></div>
		</div>
		<?php
		break;

	case 'nb-signals':
		?>
		<div class="signals">
			<div><i>01</i><b><?php sera_e( 'Ran a product end to end, audience to revenue', 'Toquei um produto de ponta a ponta, da audiência à receita' ); ?></b><span><?php sera_e( 'Audience, design, front end and revenue in one pair of hands, so every trade-off between reading and revenue was mine to make.', 'Audiência, design, front-end e receita nas mesmas mãos, então cada escolha entre leitura e receita era minha.' ); ?></span></div>
			<div><i>02</i><b><?php sera_e( 'Designed the business model into the layout', 'Desenhei o modelo de negócio dentro do layout' ); ?></b><span><?php sera_e( 'Ads became components of the system, with sizes, rules and a place in the grid.', 'Os anúncios viraram componentes do sistema, com tamanhos, regras e lugar no grid.' ); ?></span></div>
			<div><i>03</i><b><?php sera_e( 'Put the core value up front', 'Pus o que importa na frente' ); ?></b><span><?php sera_e( 'Criticism is why people choose Bastidores, so reviews became the structure of the homepage.', 'A crítica é o motivo de as pessoas escolherem o Bastidores, então as críticas viraram a estrutura da home.' ); ?></span></div>
			<div><i>04</i><b><?php sera_e( 'Treated performance as design', 'Tratei performance como design' ); ?></b><span><?php sera_e( 'A lighter page on the phone is a better reading experience and a better ad inventory.', 'Uma página mais leve no celular é uma leitura melhor e um inventário de anúncios melhor.' ); ?></span></div>
			<div><i>05</i><b><?php sera_e( 'Measured against a baseline', 'Medi contra uma linha de base' ); ?></b><span><?php sera_e( 'Visits and revenue read in the 30 days after launch against the 30 before, with the same publishing rhythm.', 'Visitas e receita lidas nos 30 dias após o lançamento contra os 30 anteriores, com o mesmo ritmo de publicação.' ); ?></span></div>
			<div><i>06</i><b><?php sera_e( 'Shipped the whole thing', 'Entreguei tudo, do começo ao fim' ); ?></b><span><?php sera_e( 'Identity, templates, mobile and a custom WordPress theme, written so one person can maintain it.', 'Identidade, templates, mobile e um tema WordPress sob medida, escrito para uma pessoa só dar conta de manter.' ); ?></span></div>
		</div>
		<?php
		break;

	case 'nb-fold':
		$fold = sera_t( 'Fold', 'Dobra' );
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Above the fold · desktop', 'Acima da dobra · desktop' ); ?></span>
			<span class="art-title"><?php sera_e( 'What sat above the fold, before and after.', 'O que ficava acima da dobra, antes e depois.' ); ?></span>
			<div class="nb-fold">
				<figure class="old">
					<figcaption><b><?php sera_e( '2022 · stock theme', '2022 · tema pronto' ); ?></b><span><?php sera_e( 'What a reader met before the first story', 'O que o leitor encontrava antes da primeira matéria' ); ?></span></figcaption>
					<div class="scr" aria-hidden="true">
						<div class="l l-soc"><i>1</i><span><?php sera_e( 'Social links', 'Redes sociais' ); ?></span><em></em><em></em><em></em><em></em></div>
						<div class="l l-logo"><i>2</i><?php echo sera_nb_old_logo(); // phpcs:ignore ?><span>Popular · Quente · Tendência</span></div>
						<div class="l l-menu"><i>3</i><span><?php sera_e( 'Main menu · 7 sections, search, account', 'Menu principal · 7 seções, busca, conta' ); ?></span></div>
						<div class="l l-thumbs"><i>4</i><span>Últimas publicações</span><div><em></em><em></em><em></em><em></em><em></em><em></em></div></div>
						<div class="fold"><span><?php echo esc_html( $fold ); ?></span></div>
						<div class="l l-story"><span><?php sera_e( 'First story', 'Primeira matéria' ); ?></span></div>
					</div>
					<ol>
						<li><?php sera_e( '<b>1–3</b> Three bars of links at the same volume, all uppercase', '<b>1–3</b> Três barras de links no mesmo volume, tudo em caixa-alta' ); ?></li>
						<li><?php sera_e( '<b>4</b> Six tiny thumbnails, reviews and news mixed', '<b>4</b> Seis miniaturas minúsculas, críticas e notícias misturadas' ); ?></li>
						<li><?php sera_e( '<b>→</b> The first story starts below the fold', '<b>→</b> A primeira matéria começa abaixo da dobra' ); ?></li>
					</ol>
				</figure>
				<figure class="new">
					<figcaption><b><?php sera_e( '2026 · redesign', '2026 · redesign' ); ?></b><span><?php sera_e( 'One line of news, one header, then criticism', 'Uma linha de notícias, um cabeçalho, e então a crítica' ); ?></span></figcaption>
					<div class="scr" aria-hidden="true">
						<div class="l l-tick"><i>1</i><b>Últimas</b><span><?php sera_e( 'Latest headlines, one glance away', 'As últimas manchetes, num relance' ); ?></span></div>
						<div class="l l-head"><i>2</i><?php echo sera_nb_logo(); // phpcs:ignore ?><span><?php sera_e( '6 sections', '6 seções' ); ?></span></div>
						<div class="l l-ad"><i>3</i><span><?php sera_e( 'Publicidade · planned slot', 'Publicidade · espaço planejado' ); ?></span></div>
						<div class="l l-hero"><i>4</i><div class="m"><small>Review · Games</small><span><?php sera_e( 'Lead review', 'Crítica principal' ); ?></span></div><div class="s"><em></em><em></em><em></em><em></em></div></div>
						<div class="fold"><span><?php echo esc_html( $fold ); ?></span></div>
						<div class="l l-sec"><span><em>Críticas</em> de <strong>Cinema</strong></span></div>
					</div>
					<ol>
						<li><?php sera_e( '<b>1–2</b> A black ticker and a single header replace three bars', '<b>1–2</b> Um ticker preto e um único cabeçalho no lugar de três barras' ); ?></li>
						<li><?php sera_e( '<b>3</b> The ad has a place of its own, decided with the layout', '<b>3</b> O anúncio tem lugar próprio, decidido junto com o layout' ); ?></li>
						<li><?php sera_e( '<b>4</b> A mosaic led by a review opens the page', '<b>4</b> Um mosaico puxado por uma crítica abre a página' ); ?></li>
					</ol>
				</figure>
			</div>
			<p class="art-cap"><?php sera_e( 'Schematic, not to scale. Rebuilt from the archived 2022 homepage and the 2026 redesign shown below.', 'Esquema, fora de escala. Reconstruído a partir da home de 2022 arquivada e do redesign de 2026 mostrado abaixo.' ); ?></p>
		</div>
		<?php
		break;

	case 'nb-slot':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Component anatomy · in-feed ad slot', 'Anatomia do componente · espaço de anúncio no feed' ); ?></span>
			<span class="art-title"><?php sera_e( 'An ad slot with its own rules.', 'Um espaço de anúncio com regras próprias.' ); ?></span>
			<div class="nb-slot">
				<div class="feed" aria-hidden="true">
					<div class="sec"><strong>Últimas</strong> <em>do Bastidores</em></div>
					<div class="row"><span><i></i><b></b><b></b></span><span><i></i><b></b><b></b></span><span><i></i><b></b><b></b></span></div>
					<div class="ad">
						<span class="tag">Publicidade</span>
						<span class="pin p1">1</span><span class="pin p2">2</span><span class="pin p3">3</span>
					</div>
					<div class="row"><span><i></i><b></b><b></b></span><span><i></i><b></b><b></b></span><span><i></i><b></b><b></b></span></div>
				</div>
				<ol>
					<li><i>1</i><div><b><?php sera_e( 'Labelled', 'Sinalizado' ); ?></b><span><?php sera_e( '“Publicidade” sits on every slot, so an ad never passes for a story.', '“Publicidade” aparece em todo espaço, para um anúncio nunca se passar por matéria.' ); ?></span></div></li>
					<li><i>2</i><div><b><?php sera_e( 'Reserved space', 'Espaço reservado' ); ?></b><span><?php sera_e( 'The box holds its size before the ad loads, so the stories around it don’t jump.', 'A caixa guarda o tamanho antes de o anúncio carregar, então as matérias em volta não pulam.' ); ?></span></div></li>
					<li><i>3</i><div><b><?php sera_e( 'Between sections, on the grid', 'Entre seções, no grid' ); ?></b><span><?php sera_e( 'Slots only appear under the header or between feed rows, never inside a row of stories.', 'Os espaços só aparecem abaixo do cabeçalho ou entre fileiras do feed, nunca no meio de uma fileira de matérias.' ); ?></span></div></li>
					<li><i>4</i><div><b><?php sera_e( 'Sized per screen', 'Do tamanho de cada tela' ); ?></b><span><?php sera_e( 'The same component on the phone, with a unit sized for the screen.', 'O mesmo componente no celular, com um formato pensado para a tela.' ); ?></span></div></li>
				</ol>
			</div>
		</div>
		<?php
		break;

	case 'nb-weight':
		?>
		<div class="art-panel">
			<span class="art-label"><?php sera_e( 'Performance as design', 'Performance como design' ); ?></span>
			<span class="art-title"><?php sera_e( 'The homepage now carries about a quarter of its old HTML.', 'A home agora carrega cerca de um quarto do HTML de antes.' ); ?></span>
			<div class="nb-weight">
				<div class="bars">
					<div class="bar old"><span class="k"><?php sera_e( 'Old theme', 'Tema antigo' ); ?></span><div class="track"><i style="width:100%"></i></div><b>~200 KB</b></div>
					<div class="bar new"><span class="k">Redesign</span><div class="track"><i style="width:26%"></i><em><?php sera_e( '~4× lighter', '~4× mais leve' ); ?></em></div><b>~52 KB</b></div>
				</div>
				<div class="cut">
					<span class="art-label"><?php sera_e( 'What left the homepage', 'O que saiu da home' ); ?></span>
					<ul>
						<li><?php sera_e( 'Two of the three navigation bars', 'Duas das três barras de navegação' ); ?></li>
						<li><?php sera_e( 'The row of six thumbnails above the fold', 'A fileira de seis miniaturas acima da dobra' ); ?></li>
						<li><?php sera_e( 'Sidebar widgets: newsletter, rankings, discussions', 'Widgets da barra lateral: newsletter, rankings, discussões' ); ?></li>
						<li><?php sera_e( 'Repeated rows of social links', 'Fileiras repetidas de links para redes sociais' ); ?></li>
					</ul>
				</div>
				<div class="why">
					<div><b><?php sera_e( 'Reading', 'Leitura' ); ?></b><span><?php sera_e( 'Less to download on the phone before the first story.', 'Menos coisa para baixar no celular antes da primeira matéria.' ); ?></span></div>
					<div><b><?php sera_e( 'Revenue', 'Receita' ); ?></b><span><?php sera_e( 'A lighter page is a better ad inventory.', 'Página mais leve é inventário de anúncios melhor.' ); ?></span></div>
				</div>
			</div>
			<p class="art-cap"><?php sera_e( 'Homepage HTML only, measured on archived snapshots (April and May 2026). Bars to scale.', 'Só o HTML da home, medido em snapshots arquivados (abril e maio de 2026). Barras em escala.' ); ?></p>
		</div>
		<?php
		break;

endswitch;
