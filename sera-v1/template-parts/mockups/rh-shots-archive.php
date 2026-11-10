<?php
/**
 * Mockup: Research Hub · the archive — real screens (anonymised), desktop + mobile pairs in a slider.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/rh-shots-slider.php';

echo sera_rh_shots_slider( // phpcs:ignore WordPress.Security.EscapeOutput
	array(
		'id'    => 'archive',
		'label' => sera_t( 'Research Hub archive, desktop and mobile screens', 'Acervo do Research Hub, telas de desktop e celular' ),
		'url'   => sera_t( 'research-hub · internal', 'research-hub · interno' ),
		'shots' => array(
			array( '01-home', sera_t( 'The front door', 'A porta de entrada' ), sera_t( 'A greeting, the archive at a glance, shortcuts to ask, connect and learn, and the published roadmap.', 'Uma saudação, o acervo num relance, atalhos para perguntar, conectar e aprender, e o roadmap publicado.' ), sera_t( 'Research Hub home on desktop: a greeting, a headline about everything the team has learned, blurred counts, three shortcuts and the dark Q4 roadmap card.', 'Home do Research Hub no desktop: uma saudação, um título sobre tudo o que o time já aprendeu, contagens borradas, três atalhos e o card escuro do roadmap do 4º trimestre.' ), sera_t( 'Research Hub home on mobile.', 'Home do Research Hub no celular.' ) ),
			array( '02-search', sera_t( 'Search every study', 'Busca em todos os estudos' ), sera_t( 'Results show each study with its method and date, so the newest evidence is easy to spot.', 'Os resultados mostram cada estudo com método e data, então a evidência mais recente salta aos olhos.' ), sera_t( 'Search results on desktop: a list of studies with their method, month and year.', 'Resultados de busca no desktop: uma lista de estudos com método, mês e ano.' ), sera_t( 'Search results on mobile.', 'Resultados de busca no celular.' ) ),
			array( '03-report', sera_t( 'One study, one page', 'Um estudo, uma página' ), sera_t( 'Cover, method and executive summary first; a section nav jumps anywhere in a tap.', 'Capa, método e resumo executivo primeiro; um menu de seções leva a qualquer parte num toque.' ), sera_t( 'A study report on desktop: the cover of a one-click checkout usability test, its details, an executive summary and a section menu.', 'O relatório de um estudo no desktop: a capa de um teste de usabilidade do checkout em um clique, os detalhes, um resumo executivo e um menu de seções.' ), sera_t( 'The same study report on mobile.', 'O mesmo relatório no celular.' ) ),
			array( '04-findings', sera_t( 'Findings with their evidence', 'Achados com evidência' ), sera_t( 'Each finding is numbered and carries the participant quote that backs it.', 'Cada achado é numerado e traz a fala do participante que o sustenta.' ), sera_t( 'Key findings on desktop: numbered findings, each with an evidence quote.', 'Principais achados no desktop: achados numerados, cada um com uma citação como evidência.' ), sera_t( 'Key findings on mobile.', 'Principais achados no celular.' ) ),
			array( '05-limits', sera_t( 'Context, and its limits', 'O contexto e seus limites' ), sera_t( 'AI desk research sourced to public market data, next to an honest list of what the study can’t say.', 'Desk research feita com IA a partir de dados públicos de mercado, ao lado de uma lista honesta do que o estudo não consegue afirmar.' ), sera_t( 'Desk research and limitations on desktop: an AI-generated section citing public market data, followed by the study’s limitations.', 'Desk research e limitações no desktop: uma seção gerada por IA citando dados públicos de mercado, seguida das limitações do estudo.' ), sera_t( 'Desk research and limitations on mobile.', 'Desk research e limitações no celular.' ) ),
			array( '12-admin', sera_t( 'One panel to run it', 'Um painel para tocar tudo' ), sera_t( 'Studies, authors, feedback and settings in one place, with filters and an export.', 'Estudos, autores, feedback e configurações num lugar só, com filtros e exportação.' ), sera_t( 'The admin panel on desktop: a feedback overview, filters and a table of feedback.', 'O painel de admin no desktop: um resumo do feedback, filtros e uma tabela de feedbacks.' ), sera_t( 'The admin panel on mobile.', 'O painel de admin no celular.' ) ),
		),
	)
);
