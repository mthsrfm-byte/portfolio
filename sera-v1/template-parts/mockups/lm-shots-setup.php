<?php
/**
 * Mockup: Lume · the designer area in code, each screen on desktop and on the phone (studies, new study, script).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/lm-shots-slider.php';

echo sera_lm_shots_slider( // phpcs:ignore WordPress.Security.EscapeOutput
	array(
		'id'    => 'setup',
		'label' => sera_t( 'The Lume designer area, on desktop and on the phone', 'A área do designer do Lume, no computador e no celular' ),
		'shots' => array(
			array( 'D2', 'M2', sera_t( 'Every study, one line', 'Todo estudo, uma linha' ), sera_t( 'Status, valid sessions and the next step for each study, with live sessions in green. On the phone, the table becomes a list with the same pills and bars.', 'Status, sessões válidas e o próximo passo de cada estudo, com as sessões ao vivo em verde. No celular, a tabela vira uma lista com as mesmas pílulas e barras.' ), sera_t( 'Studies on desktop: a table with status, valid sessions filling up, last session and next step.', 'Estudos no computador: uma tabela com status, sessões válidas se preenchendo, última sessão e próximo passo.' ), sera_t( 'Studies on the phone: the same studies as a list, with status and progress.', 'Estudos no celular: os mesmos estudos em lista, com status e progresso.' ) ),
			array( 'D3', 'M3', sera_t( 'Paste a link, get a study', 'Cole um link, ganhe um estudo' ), sera_t( 'The designer pastes the Figma prototype; the Lume reads the screens and drafts the script. On the phone, the same form stacks in one column.', 'O designer cola o protótipo do Figma; o Lume lê as telas e monta o roteiro. No celular, o mesmo formulário empilha numa coluna.' ), sera_t( 'New study on desktop: a Figma link being pasted, screens read, the suggested script and a summary of what the Lume will build.', 'Novo estudo no computador: um link do Figma sendo colado, telas lidas, o roteiro sugerido e um resumo do que o Lume vai montar.' ), sera_t( 'New study on the phone: the Figma link and the script in one column.', 'Novo estudo no celular: o link do Figma e o roteiro numa coluna.' ) ),
			array( 'D4', 'M4', sera_t( 'The script, block by block', 'O roteiro, bloco a bloco' ), sera_t( 'On desktop, the blocks and the editor sit side by side, with the essential ones marked. On the phone, the list stands alone and the editor opens as a panel.', 'No computador, os blocos e o editor ficam lado a lado, com os essenciais marcados. No celular, a lista fica sozinha e o editor abre como painel.' ), sera_t( 'Script on desktop: blocks on the left, the selected block’s questions on the right, Rehearse and Publish to the field at the top.', 'Roteiro no computador: blocos à esquerda, as perguntas do bloco selecionado à direita, Ensaiar e Publicar para o campo no topo.' ), sera_t( 'Script on the phone: the scenario and the list of blocks with the essential ones marked.', 'Roteiro no celular: o cenário e a lista de blocos com os essenciais marcados.' ) ),
		),
	)
);
