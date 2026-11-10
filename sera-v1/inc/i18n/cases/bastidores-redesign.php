<?php
/**
 * Bastidores · editorial redesign — Portuguese version (mirrors sera_starter_cases()).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'nb-glance' );
$c .= sera_b_chapter( 1, 'Contexto', 'Um site de crítica com cara de feed de notícia viral.' );
$c .= sera_b_p( 'O Bastidores é um site brasileiro de crítica de cinema, séries e games e de notícias de cultura pop, com uma promessa simples no slogan: <em>Aqui a crítica acontece</em>. O produto é meu, da estratégia e do design ao front-end (um tema WordPress sob medida, em PHP), e o negócio vive de anúncios.', 'lead' );
$c .= sera_b_p( 'De 2022 a 2026, o site rodou num tema pronto de notícias virais. Funcionava como blog, mas não dizia nada sobre o que fazia o Bastidores diferente, e não tinha nenhum lugar planejado para anúncios, justamente o que sustenta o negócio.' );
$c .= sera_b_chapter( 2, 'A auditoria', 'Quatro problemas, visíveis só na home.' );
$c .= sera_b_art( 'nb-audit' );
$c .= sera_b_p( 'O jeito mais claro de ver o problema é olhar o que o leitor encontrava antes da primeira matéria. O tema antigo empilhava três barras de links e uma fileira de seis miniaturas acima da dobra. O redesign mantém uma linha de notícias, um cabeçalho e um espaço de anúncio planejado, e entrega o resto da tela à crítica.' );
$c .= sera_b_art( 'nb-fold' );
$c .= sera_b_mock( 'nb-before-after' );
$c .= sera_b_chapter( 3, 'A aposta', 'Fazer crescer a audiência e o negócio, juntos.' );
$c .= sera_b_p( 'A maioria dos sites de mídia trata isso como uma troca: mais anúncio, leitura pior, menos tráfego. Eu tratei como um problema de produto só, e desenhei os dois lados ao mesmo tempo.' );
$c .= sera_b_art( 'nb-levers' );
$c .= sera_b_chapter( 4, 'O redesign', 'A crítica como porta de entrada.' );
$c .= sera_b_p( 'A nova home abre com um mosaico das críticas e matérias que importam no dia, seguido das seções de crítica de cinema e de games, e só depois vem o fluxo de notícias. Um ticker preto deixa as últimas manchetes a um olhar de distância, e a identidade toda trocou um azul genérico por papel, tinta e uma fonte serifada nos títulos.' );
$c .= sera_b_mock( 'bastidores' );
$c .= sera_b_art( 'nb-system' );
$c .= sera_b_chapter( 5, 'Estratégia de anúncios', 'Anúncios como componentes do sistema.' );
$c .= sera_b_p( 'Decidi onde os anúncios ficam antes de desenhar o layout: um espaço abaixo do cabeçalho e blocos entre as seções do feed. A leitura fica tranquila, e os anúncios param de competir com as matérias.' );
$c .= sera_b_art( 'nb-ads' );
$c .= sera_b_p( 'Cada espaço é um componente com regras próprias. Ele é sinalizado, guarda o tamanho antes de o anúncio carregar e só aparece entre seções, então a página nunca pula e um anúncio nunca se passa por matéria.' );
$c .= sera_b_art( 'nb-slot' );
$c .= sera_b_chapter( 6, 'Mobile', 'Chegar mais rápido à primeira matéria no celular.' );
$c .= sera_b_p( 'No celular, o site antigo empilhava uma barra de menu, uma faixa de assuntos em alta e uma fileira de miniaturas minúsculas antes da primeira matéria. O novo abre direto na matéria, com seções e espaços de anúncio do tamanho da tela.' );
$c .= sera_b_mock( 'nb-mobile' );
$c .= sera_b_p( 'O redesign também carrega menos. Sem os menus extras, os widgets de barra lateral e os blocos repetidos do tema pronto, o HTML da home caiu de cerca de 200 KB para cerca de 52 KB. Isso pesa mais no celular, onde tanto a primeira matéria quanto os anúncios precisam carregar.' );
$c .= sera_b_art( 'nb-weight' );
$c .= sera_b_chapter( 7, 'Impacto', 'Uma audiência muito maior, e um negócio mais rentável.' );
$c .= sera_b_art( 'nb-impact' );
$c .= sera_b_chapter( 8, 'Por que importa', 'O que tocar meu próprio produto diz sobre como eu trabalho.' );
$c .= sera_b_art( 'nb-reflection' );
$c .= sera_b_art( 'nb-signals' );

return array(
	'title'   => 'Bastidores: redesign editorial e estratégia de anúncios',
	'excerpt' => 'O Bastidores, site brasileiro de crítica de cinema, séries e games, rodava num tema pronto de notícias virais. Redesenhei o site de ponta a ponta, coloquei as críticas na porta de entrada e desenhei os anúncios dentro do layout. Nos 30 dias após o lançamento, as visitas cresceram cerca de 500% e a receita de anúncios por visita subiu 20%, na comparação com os 30 dias anteriores.',
	'meta'    => array(
		'_sera_headline' => 'Bastidores: de blog de notícias virais a publicação de crítica, e um negócio melhor',
		'_sera_year'     => '2026',
		'_sera_role'     => 'Dono do produto · estratégia, design e front-end',
		'_sera_metrics'  => "~500% | Mais visitas nos 30 dias após o lançamento, contra os 30 anteriores\n+20% | Mais receita de anúncios por visita no mesmo período\n1 | Espaço de anúncio planejado acima da dobra, onde antes não havia nenhum",
		'_sera_chips'    => 'Product ownership, Design editorial, Monetização',
	),
	'content' => $c,
);
