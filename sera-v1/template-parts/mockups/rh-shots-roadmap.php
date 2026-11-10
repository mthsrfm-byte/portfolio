<?php
/**
 * Mockup: Research Hub · research roadmap — real screens (anonymised), desktop + mobile pairs in a slider.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/rh-shots-slider.php';

echo sera_rh_shots_slider( // phpcs:ignore WordPress.Security.EscapeOutput
	array(
		'id'    => 'roadmap',
		'label' => sera_t( 'Research roadmap, desktop and mobile screens', 'Roadmap de pesquisa, telas de desktop e celular' ),
		'url'   => 'research-hub · roadmap',
		'shots' => array(
			array( '10a-ideas', sera_t( 'Ideas', 'Ideias' ), sera_t( 'Ideas from the team and from AI side by side, each with a question and a reason to do it now.', 'Ideias do time e da IA lado a lado, cada uma com uma pergunta e um motivo para fazer agora.' ), sera_t( 'Roadmap step one on desktop: idea cards from the team and from AI, with a “suggest with AI” button.', 'Primeiro passo do roadmap no desktop: cards de ideias do time e da IA, com um botão “sugerir com IA”.' ), sera_t( 'Roadmap ideas on mobile.', 'Ideias do roadmap no celular.' ) ),
			array( '10b-prioritise', sera_t( 'Prioritise', 'Priorizar' ), sera_t( 'An impact × effort matrix the AI suggests and the team adjusts, with a reason for every rank.', 'Uma matriz de impacto × esforço que a IA sugere e o time ajusta, com um motivo para cada posição.' ), sera_t( 'Roadmap step two on desktop: an impact by effort matrix with numbered bubbles and a ranked list of justifications.', 'Segundo passo do roadmap no desktop: uma matriz de impacto por esforço com bolhas numeradas e uma lista ordenada de justificativas.' ), sera_t( 'The prioritisation matrix and ranked list on mobile.', 'A matriz de priorização e a lista ordenada no celular.' ) ),
			array( '10c-timeline', 'Roadmap', sera_t( 'A week-by-week calendar that stays a draft until someone publishes it and sends it to Jira.', 'Um calendário semana a semana que fica em rascunho até alguém publicar e mandar para o Jira.' ), sera_t( 'Roadmap step three on desktop: a week-by-week calendar, a draft badge and a button to publish and send to Jira.', 'Terceiro passo do roadmap no desktop: um calendário semana a semana, um selo de rascunho e um botão para publicar e mandar para o Jira.' ), sera_t( 'The roadmap as a weekly list on mobile.', 'O roadmap como lista semanal no celular.' ) ),
		),
	)
);
