<?php
/**
 * Paperplane Studio — Brazilian Portuguese version (draft for review).
 * Same block grammar as the other cases: narrative in core blocks, visuals in
 * "sera/artifact" (pp-*) and "sera/mockup" (paperplane, pp-*).
 * Story: four pains → four decisions → one chapter answering each pain.
 * Frames, cast sheets, locations and clips were made in the Paperplane for the two sample
 * episodes (assets/cases/paperplane/); the screens around them are code.
 * Chapter 07 lives inside the pp-duo mockup (its title sits on the sticky stage).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'pp-glance' );
$c .= sera_b_art( 'pp-coldopen' );
$c .= sera_b_p( 'Os 25 segundos acima saíram de uma linha de texto. Elenco, cenários, planos, animação e montagem: tudo dentro de um estúdio só, que eu fundei sozinho, com IA. Esta é a história de por que ele precisava existir e de como ele funciona por dentro.', 'lead' );

$c .= sera_b_chapter( 1, 'O problema', 'Hoje, quem faz filme com IA trabalha de montador, não de diretor.' );
$c .= sera_b_p( 'Os geradores de imagem e vídeo ficaram impressionantes em fazer um quadro bonito. Só que ninguém assiste a um quadro. Uma história é a mesma pessoa, no mesmo lugar, na mesma luz, cena depois de cena, e é exatamente aí que a IA de hoje se perde. Para entregar um minuto de filme, a pessoa abre oito ferramentas e vira transportadora de arquivo entre elas.', 'lead' );
$c .= sera_b_art( 'pp-tabs' );
$c .= sera_b_p( 'Olhando o meu próprio processo e o de quem roteiriza, dirige e entrega vídeo para cliente, as dores se repetem em quatro lugares. Nenhum deles é a qualidade da imagem. Cada um virou um capítulo deste case.' );
$c .= sera_b_art( 'pp-pains' );

$c .= sera_b_chapter( 2, 'O mercado', 'As ferramentas de IA pensam em prompt. Quem faz filme pensa em cena.' );
$c .= sera_b_p( 'Mapeei o que existe pelo trabalho de quem faz filme, e não pela beleza de um quadro isolado. O padrão se repete: cada categoria resolve muito bem o seu pedaço e para na borda dele. O meio do caminho, onde a história de fato acontece, fica por conta da pessoa.' );
$c .= sera_b_art( 'pp-market' );
$c .= sera_b_p( 'Duas linhas dessa tabela viraram o produto. Ninguém junta <strong>o fluxo de um estúdio</strong>, do roteiro à montagem, com <strong>a liberdade de escolher o motor</strong>: o modelo de cada etapa e quem paga a GPU. Quem entrega o fluxo prende você nos créditos. Quem entrega a liberdade cobra em complexidade.' );

$c .= sera_b_chapter( 3, 'A aposta', 'Escreva uma frase. Dirija o resto.' );
$c .= sera_b_art( 'pp-statement' );
$c .= sera_b_p( 'Chamei de Paperplane. Fundei sozinho, com IA do começo ao fim: pesquisa, produto, design, código e até os dois episódios que aparecem nesta página. É o meu primeiro produto fundado solo; está no ar, em beta fechado. Antes da primeira tela, quatro decisões, uma contra cada dor.' );
$c .= sera_b_art( 'pp-principles' );

$c .= sera_b_chapter( 4, 'O estúdio', 'Dez etapas, três atos, uma aba só.' );
$c .= sera_b_p( 'O estúdio segue a ordem em que um filme é feito de verdade: escrever, visualizar, filmar. Cada etapa entrega para a próxima, e o Origami, o assistente do estúdio, acompanha o projeto inteiro. Role devagar: a tela do computador mostra o estúdio por dentro, e o celular, a mesma etapa no bolso.', 'lead' );
$c .= sera_b_mock( 'pp-tour' );

$c .= sera_b_chapter( 5, 'Continuidade', 'O difícil não é gerar um quadro bonito. É gerar o oitavo igual ao primeiro.' );
$c .= sera_b_p( 'Consistência virou a regra de produto mais importante. Um gerador sozinho não lembra de nada; o Paperplane lembra por ele. Tudo começa numa ficha: quatro vistas, figurino fixo, uma descrição que não muda. É ela que o gerador recebe, em vez de adivinhar a pessoa a partir de um prompt.', 'lead' );
$c .= sera_b_art( 'pp-cast' );
$c .= sera_b_p( 'No modo avançado do storyboard dá para ver a costura acontecendo. Cada tomada vira uma árvore: o estilo, a ficha, o cenário e o quadro anterior se ligam ao pedido, que já sai escrito com o que não pode aparecer. Os takes crescem lado a lado, cada um com modelo, seed e custo, e nenhuma versão boa se perde.' );
$c .= sera_b_mock( 'pp-nodes' );
$c .= sera_b_p( 'E como o estilo é uma camada separada, dá para trocar o traço do projeto inteiro sem perder nada. O Paperplane redesenha cada quadro, e o elenco, os lugares e os planos continuam no lugar.' );
$c .= sera_b_art( 'pp-styles' );

$c .= sera_b_chapter( 6, 'Filmar', 'Imagem custa centavos. Vídeo custa dólares. Aprove antes.' );
$c .= sera_b_p( 'A regra de fluxo que mais mudou a conta: só vira vídeo o que já foi aprovado como imagem. O quadro do storyboard vira o primeiro frame do take, e quem dirige só conta o que se move. A fala sai na voz do próprio personagem.', 'lead' );
$c .= sera_b_art( 'pp-take' );
$c .= sera_b_p( 'Depois, a montagem fecha o episódio numa linha do tempo com vídeo, efeitos, falas e trilha, e exporta em 1080p nativo, com <strong>upscale até 4K</strong> sem sair do projeto. Nada de baixar, subir em outro programa e torcer.' );

$c .= sera_b_mock( 'pp-duo' );

$c .= sera_b_chapter( 8, 'O motor', 'Seu filme, seu modelo, seu jeito de pagar.' );
$c .= sera_b_p( 'Quase toda ferramenta de vídeo com IA vende a mesma coisa: créditos, num modelo que ela escolheu, no preço que ela definiu. No Paperplane, o motor é uma camada separada do estúdio. O pedido que o projeto monta é sempre o mesmo; quem dirige escolhe quem gera e quem paga a GPU.', 'lead' );
$c .= sera_b_art( 'pp-router' );
$c .= sera_b_p( 'São quatro jeitos de pagar, e dá para trocar no meio do projeto. O último é o maior diferencial e já está no ar: um app de desktop conecta a placa de vídeo de quem usa ao mesmo estúdio. O setup mínimo é algo como uma RTX 4090, com 24 GB de memória de vídeo.' );
$c .= sera_b_art( 'pp-engines' );

$c .= sera_b_chapter( 9, 'Em beta, no ar', 'Duas funções novas, testadas por quem entrou primeiro.' );
$c .= sera_b_p( 'O Origami Assistant e o Smart Engine já estão no ar para quem entrou no beta, e ainda podem mudar de forma e de nome com o que eles ensinarem. Os dois atacam o mesmo problema por lados diferentes: o Origami diminui o trabalho de quem dirige, e o Smart Engine diminui a conta.' );
$c .= sera_b_art( 'pp-lab' );

$c .= sera_b_chapter( 10, 'Feito no Paperplane', 'Nenhum coelho saiu de outra cartola.' );
$c .= sera_b_p( 'A regra que me guiou foi usar o produto para fazer o produto. Cada quadro, personagem, cenário e take desta página nasceu no Paperplane, para dois episódios de verdade: “Sem Partidas” e “A estação sem nome”. O único truque é o do produto.', 'lead' );
$c .= sera_b_art( 'pp-made' );
$c .= sera_b_p( 'Construí tudo sozinho, com IA em todas as camadas. Não foi mágica: foi outro jeito de dividir o trabalho.' );
$c .= sera_b_art( 'pp-solo' );

$c .= sera_b_chapter( 11, 'Onde está', 'O que está no ar, o que está em beta e o que vem em seguida.' );
$c .= sera_b_art( 'pp-status' );

$c .= sera_b_chapter( 12, 'O que aprendi até aqui', 'Um filme é continuidade. O resto é gerador.' );
$c .= sera_b_art( 'pp-reflection' );
$c .= sera_b_art( 'pp-signals' );
$c .= sera_b_p( 'Produto próprio, no ar em beta, publicado de propósito. As telas foram reconstruídas em HTML e CSS a partir do Paperplane; quadros, personagens, cenários e clipes foram gerados no próprio Paperplane para os dois episódios de exemplo. Preços e tempos são ilustrativos.', 'note' );

return array(
	'title'   => 'Paperplane: um estúdio de cinema com IA, da primeira frase ao episódio em 4K',
	'excerpt' => 'Fazer filme com IA hoje é montar um quebra-cabeça com peças de oito caixas: roteiro aqui, imagem ali, vídeo, voz, montagem e upscale em mais quatro abas. O Paperplane junta tudo num estúdio só. Você escreve uma frase, e ele leva a ideia por roteiro, elenco, storyboard e animação até um episódio montado, em até 4K, deixando você escolher o modelo de cada etapa e quem paga a GPU, até a sua própria placa. Fundei sozinho, com IA. Está no ar, em beta.',
	'meta'    => array(
		'_sera_headline' => 'Paperplane: escreva uma frase, dirija o resto. Um estúdio de cinema com IA, da ideia ao 4K',
		'_sera_company'  => 'Paperplane Studio',
		'_sera_year'     => '2026 · no ar, em beta',
		'_sera_role'     => 'Fundador solo · produto, design e construção com IA',
		'_sera_metrics'  => "1 frase | é tudo o que precisa para começar; o episódio sai montado\n10 etapas | da ideia à montagem em 4K, numa aba só\n2 episódios | de exemplo, com cada quadro e personagem feito no próprio Paperplane",
		'_sera_chips'    => 'Produto próprio, IA generativa, Fundador solo, No ar · beta',
		'_sera_visual'   => 'paperplane',
	),
	'content' => $c,
);
