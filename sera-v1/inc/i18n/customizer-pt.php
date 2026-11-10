<?php
/**
 * Brazilian Portuguese defaults for the Customizer copy (Home at /pt/).
 *
 * Same line formats as sera_fields() (inc/customizer.php): xp_items "período | empresa | cargo | descrição"
 * (use "hoje" or "now" in the period to mark the current job), about_items "título | texto",
 * about_chips separated by ";", hero_rotate separated by "," (the 1st word must be in hero_title).
 * E-mails, URLs, slugs and the case order are shared by both languages and are not here.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

/**
 * key => Portuguese default. Only text/textarea fields from sera_fields().
 */
function sera_fields_pt() {
	return array(
		// Hero.
		'hero_status'     => 'Aberto a vagas de Lead e Design Manager',
		// Every rotating verb takes "em", so "em que as pessoas ___" stays grammatical for all of them.
		'hero_title'      => 'Desenho produtos financeiros que as pessoas usam de novo',
		'hero_rotate'     => 'usam de novo, indicam, recomendam, entendem',
		'hero_title_2'    => 'e construo a IA que coloca eles no ar.',
		'hero_lede'       => 'Onze anos em produto, sete em fintech: Nubank, will bank, Western Union e Pagaleve. Pesquisa, design e construção, com IA em cada etapa.',
		'hero_photo_alt'  => 'Selfie com lente olho de peixe de Matheus Serafim à noite em Shibuya, Tóquio',
		'hero_role'       => 'Product Design Lead · hoje na Pagaleve',
		'hero_status_note' => 'CLT ou PJ',
		'hero_freela'     => 'Aceitando projetos freela',
		'hero_freela_note' => 'por projeto',
		'hero_now_text'   => 'Product Designer nível Staff, Retention & Monetization',
		'fact_1_value'    => '11',
		'fact_1_label'    => 'anos desenhando produtos digitais, 6 em liderança de design (gestão e Staff IC)',
		'fact_2_value'    => '5',
		'fact_2_label'    => 'fintechs, de apostas 0→1 a produtos com milhões de clientes',
		'fact_3_value'    => '3',
		'fact_3_label'    => 'produtos de IA que desenhei e construí de ponta a ponta, um deles já em produção',
		// Logos.
		'logos_title'     => 'Empresas e marcas para quem já desenhei',
		// Work.
		'work_title'      => 'Trabalhos selecionados',
		'work_intro'      => 'Cada case mostra o que o negócio precisava, o que a evidência mostrou, o que foi para o ar e o que mudou. Os mais recentes também mostram as ferramentas de IA que construí no caminho.',
		'more_title'      => 'Mais trabalhos',
		// Approach.
		'approach_title'  => 'Como trabalho',
		'approach_intro'  => 'O que não muda de uma empresa para outra, seja uma aposta 0→1 ou uma plataforma com milhões de usuários. O que mudou é a velocidade entre a evidência e algo que funciona.',
		'p1_title'        => 'Começar pelos números do negócio',
		'p1_text'         => 'Começo pela linha do P&L onde o problema mora (conversão, perdas, taxa de contato, multas por atraso) e desenho na direção dela. Às vezes, a entrega de design mais valiosa é uma nova prioridade no backlog.',
		'p1_proof'        => 'will bank: uma migração de infraestrutura virou ganho de satisfação do cliente.',
		'p2_title'        => 'Buscar evidência, mesmo sem verba de pesquisa',
		'p2_text'         => 'Analytics de sessão, visitas a lojas, tickets de suporte, uma pilha de documentos recusados. Cruzo o que estiver à mão até o problema ficar específico o bastante para ser resolvido.',
		'p2_proof'        => 'Western Union: uma auditoria dos documentos recusados mostrou que a maioria das recusas vinha de uma única etapa ambígua.',
		'p3_title'        => 'Medir o que vai para o ar e assumir o resultado',
		'p3_text'         => 'Lanço com rollout controlado, grupo de controle e um plano para quando um release dá errado. Quando um lançamento cai, trato como incidente, encontro a causa e recupero o número.',
		'p3_proof'        => 'Pagaleve: um orquestrador de IA medido toda semana contra um grupo de controle.',
		'p4_title'        => 'Construir a ferramenta, não só a tela',
		'p4_text'         => 'Quando o processo do time é o gargalo, eu desenho e construo a ferramenta, com Lovable, Claude e MCP. A IA faz o trabalho repetitivo e mostra as fontes; as pessoas continuam com as decisões.',
		'p4_proof'        => 'Pagaleve: um Research Hub que a empresa consulta pelo próprio Claude e um moderador de IA por voz para testes de usabilidade.',
		// Experience.
		'xp_title'        => 'Experiência',
		'xp_intro'        => 'Fui gestor e voltei a IC por escolha, sempre em crédito e pagamentos.',
		'xp_items'        => implode(
			"\n",
			array(
				'2026 — hoje | Pagaleve | Product Designer Especialista, Retention & Monetization | Lidero o design de ponta a ponta do principal produto de BNPL da empresa, junto com risco, growth e engenharia. Levei um orquestrador de IA do pitch de um hackathon à produção e desenhei e construí as ferramentas de pesquisa com IA do time: um Research Hub que a empresa inteira consulta e o Lume, um moderador de IA por voz para testes de usabilidade.',
				'2024 — 2026 | Western Union | Product Designer Especialista, atuando como Designer + PO | Liderei o fluxo de envio de dinheiro (Send Money) e o onboarding da conta digital. Conduzi discovery contínuo com Quantum Metric, benchmarking e pesquisa em web e mobile, para clientes do mundo inteiro.',
				'2024 | Atlas Technologies | Staff Product Designer, líder de pesquisa | Cuidei da estratégia de design nas principais iniciativas, escalei o design system e fui mentor de designers.',
				'2022 — 2024 | will bank | Staff Product Designer, Cartão de Crédito · antes Product Design Manager | Liderei o design de um banco digital com mais de 5 milhões de clientes ativos, a maioria de baixa renda. Fui gestor do time de design e depois voltei a ser IC para liderar a estratégia de cartão de crédito.',
				'2020 — 2022 | Acordo Certo | Product Design Manager | Montei e liderei o time de design de uma plataforma de renegociação de dívidas, e estruturei os processos e a estratégia de design do time.',
				'2019 — 2020 | Nubank | Senior Product Designer, Cartão de Crédito | Desenhei para o cartão de crédito do maior banco digital da América Latina.',
			)
		),
		'xp_more'         => 'Antes disso: Jüssi (Honda), Laureate International Universities e Procuradoria-Geral da Fazenda Nacional (PGFN), 2015–2019.',
		// About.
		'about_text'      => 'Estudei comunicação, comecei no setor público e me mudei para São Paulo em 2017 para trabalhar com produto. Desde então, quase tudo que faço é tentar deixar o dinheiro *previsível* para quem não pode ser pego de surpresa.',
		'about_items'     => implode(
			"\n",
			array(
				'Player 1 desde sempre. | Nerd de tecnologia desde criança: meu sonho era construir um Game Boy. Aos 14, criei um blog de games que chegou a mais de 1 milhão de visitas orgânicas por mês.',
				'De capital importância. | Sou de Brasília, onde comecei a carreira em comunicação e design no governo antes de ir para produto.',
				'Versão do diretor. | Ex-cineasta: escrevi e dirigi dois curtas premiados. Vem daí a mania de fazer storyboard de todo fluxo.',
				'Fluente em português, inglês e espresso. | Trabalho com times globais nas duas línguas, movido a muito café bom.',
			)
		),
		'about_chips'     => 'Bacharelado em Comunicação Organizacional, UnB; Especialização em UX/UI, EBAC; Liderança em Design · Design Systems & Ops',
		// SEO.
		'seo_title'       => 'Matheus Serafim — Product Design Lead que constrói com IA | Fintech, BNPL e Crédito',
		'seo_description' => 'Product design lead no Brasil, 11 anos em produto, 7 em fintech. Desenho o produto e construo as ferramentas de IA em volta dele. Aberto a vagas Staff, Lead e Manager.',
		// Contact.
		'contact_title'   => 'Se você constrói algo que movimenta o dinheiro das pessoas,',
		'contact_title_2' => 'vamos conversar.',
	);
}
