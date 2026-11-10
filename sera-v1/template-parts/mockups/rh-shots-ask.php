<?php
/**
 * Mockup: Research Hub · ask the archive — real screens (anonymised), desktop + mobile pairs in a slider.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/rh-shots-slider.php';

echo sera_rh_shots_slider( // phpcs:ignore WordPress.Security.EscapeOutput
	array(
		'id'    => 'ask',
		'label' => sera_t( 'Ask the archive, desktop and mobile screens', 'Pergunte ao acervo, telas de desktop e celular' ),
		'url'   => sera_t( 'research-hub · internal', 'research-hub · interno' ),
		'shots' => array(
			array( '06-ask', sera_t( 'Ask in plain language', 'Pergunte do seu jeito' ), sera_t( 'A blank page and a few starting questions, with recent chats one click away.', 'Uma página em branco e algumas perguntas para começar, com as conversas recentes a um clique.' ), sera_t( 'Ask the archive on desktop: a blank page asking what you want to know about Pagaleve’s customers, starter questions and a sidebar of recent chats.', 'Pergunte ao acervo no desktop: uma página em branco perguntando o que você quer saber sobre os clientes da Pagaleve, perguntas iniciais e uma barra lateral com as conversas recentes.' ), sera_t( 'Ask the archive on mobile: the blank page with starter questions.', 'Pergunte ao acervo no celular: a página em branco com perguntas iniciais.' ) ),
			array( '07-answer', sera_t( 'Every claim has a source', 'Toda afirmação tem fonte' ), sera_t( 'Answers cite the study behind each claim and keep what we know apart from interpretation and gaps.', 'As respostas citam o estudo por trás de cada afirmação e separam o que sabemos do que é interpretação ou lacuna.' ), sera_t( 'An answer on desktop with pink study citations inline and a section for interpretation and gaps.', 'Uma resposta no desktop com citações de estudos em rosa no texto e uma seção para interpretação e lacunas.' ), sera_t( 'An answer with study citations on mobile.', 'Uma resposta com citações de estudos no celular.' ) ),
			array( '08-pick', sera_t( 'Answer from chosen studies', 'Resposta só dos estudos escolhidos' ), sera_t( 'Pick up to ten studies, filtered by area, and the chat answers only from them.', 'Escolha até dez estudos, com filtro por área, e o chat responde só com base neles.' ), sera_t( 'A dialog on desktop for choosing up to ten studies, with search and area filters.', 'Uma janela no desktop para escolher até dez estudos, com busca e filtros por área.' ), sera_t( 'The same study picker as a bottom sheet on mobile.', 'O mesmo seletor de estudos como bottom sheet no celular.' ) ),
			array( '09-menu', sera_t( 'One menu for the whole hub', 'Um menu para o hub inteiro' ), sera_t( 'Archive, chat, roadmap, guide, the Claude connector and admin, as a drawer on both screens.', 'Acervo, chat, roadmap, guia, o conector do Claude e o admin, numa gaveta nas duas telas.' ), sera_t( 'The product menu as a drawer on desktop: archive, ask, research roadmap, guide, use in Claude, admin, import and a feedback button.', 'O menu do produto como gaveta no desktop: acervo, perguntar, roadmap de pesquisa, guia, usar no Claude, admin, importar e um botão de feedback.' ), sera_t( 'The product menu as a drawer on mobile.', 'O menu do produto como gaveta no celular.' ) ),
			array( '11-feedback', sera_t( 'Did you find it?', 'Achou o que procurava?' ), sera_t( 'Feedback with a screenshot and an attachment goes straight to the admin panel.', 'O feedback, com print e anexo, vai direto para o painel de admin.' ), sera_t( 'A feedback dialog on desktop asking whether you found what you came for, with a screenshot and an attachment.', 'Uma janela de feedback no desktop perguntando se você achou o que procurava, com print e anexo.' ), sera_t( 'The feedback form as a bottom sheet on mobile.', 'O formulário de feedback como bottom sheet no celular.' ) ),
		),
	)
);
