<?php
/**
 * Mockup: Paperplane · the studio in code, each step on desktop and on the phone (idea → storyboard).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/pp-shots-slider.php';

echo sera_pp_shots_slider( // phpcs:ignore WordPress.Security.EscapeOutput
	array(
		'id'    => 'studio',
		'label' => 'O estúdio do Paperplane, no computador e no celular',
		'shots' => array(
			array( 'ideia', 'ideia', 'Uma frase já é o bastante', 'O projeto começa por uma ideia, do jeito que ela vier. Título, duração e formato aparecem no caminho, conforme o roteiro cresce.', 'Ideia no computador: a frase do episódio, o título sugerido e a duração calculada pelas cenas.', 'Ideia no celular: a frase e o título numa coluna.', 'ideia' ),
			array( 'universo', 'universo', 'Regras antes do roteiro', 'Lugar, tom e as leis que ninguém quebra. O Origami lê esta página antes de escrever qualquer coisa e aponta os furos que a história ainda não fechou.', 'Universo no computador: o mundo, o tom, as regras fixas e as perguntas em aberto que o Origami encontrou.', 'Universo no celular: as regras e as perguntas em aberto.', 'universo' ),
			array( 'roteiro', 'roteiro', 'Roteiro em formato de cinema', 'Cena por cena, com cabeçalho, ação e diálogo. O Origami sugere, a pessoa aceita ou não, e já encontra os personagens que vão para o elenco.', 'Roteiro no computador: a cena 3 em formato de cinema e o Origami ao lado com duas sugestões.', 'Roteiro no celular: a mesma cena e uma sugestão do Origami.', 'roteiro' ),
			array( 'personagem', 'elenco', 'Um elenco que não muda de cara', 'Ficha em quatro vistas, figurino fixo e voz própria. É essa ficha que entra em todo pedido de imagem, da cena 1 à cena 80.', 'Personagem no computador: o Ren de frente, três quartos, perfil e costas, com a aparência fixa descrita.', 'Elenco no celular: quatro personagens, cada um com a sua voz.', 'personagens/ren' ),
			array( 'decupagem', 'decupagem', 'A cena vira tomadas, com o porquê', 'A decupagem quebra a cena em planos e diz por que escolheu cada um. A palavra final é sempre de quem dirige.', 'Decupagem no computador: cinco tomadas da cena 1, com plano, duração e o motivo do close escolhido pela IA.', 'Decupagem no celular: a lista de tomadas com os planos.', 'decupagem' ),
			array( 'storyboard', 'storyboard', 'O filme antes do filme', 'Um quadro por tomada, com elenco, cenário e plano no lugar. Imagem custa centavos e vídeo custa dólares, então é aqui que se aprova.', 'Storyboard no computador: quatro quadros da cena 3, três aprovados e um esperando aprovação.', 'Storyboard no celular: as tomadas aprovadas em grade.', 'storyboard' ),
		),
	)
);
