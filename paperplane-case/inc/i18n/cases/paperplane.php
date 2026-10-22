<?php
/**
 * Paperplane Studio — Brazilian Portuguese version (draft for review).
 * Same block grammar as the other cases: narrative in core blocks, visuals in
 * "sera/artifact" (pp-*) and "sera/mockup" (paperplane, pp-*).
 * Frames, cast sheets and locations are images made in the Paperplane for the two
 * sample episodes (assets/cases/paperplane/); the screens around them are code.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'pp-glance' );
$c .= sera_b_art( 'pp-coldopen' );
$c .= sera_b_chapter( 1, 'O problema', 'Um minuto de filme, oito abas abertas.' );
$c .= sera_b_p( 'Os geradores de imagem e vídeo ficaram impressionantes em fazer um quadro bonito. Só que ninguém assiste a um quadro. Uma história é a mesma pessoa, no mesmo lugar, na mesma luz, cena depois de cena. E é aí que a IA de hoje se perde.', 'lead' );
$c .= sera_b_p( 'Quem tenta contar uma história com IA vira montador de quebra-cabeça: o roteiro num documento, as referências num mural, os personagens num gerador, os vídeos em outro, as vozes num terceiro, a montagem num editor e o upscale num programa à parte. Cada passagem é um download, um upload e um prompt reescrito do zero. E quando o cliente pede para trocar uma fala da cena 3, ninguém lembra mais em qual aba ela mora.' );
$c .= sera_b_art( 'pp-scatter' );
$c .= sera_b_p( 'Olhando o meu próprio processo e o de quem roteiriza, dirige e entrega vídeo para cliente, as dores se repetem em três lugares. Nenhum deles é a qualidade da imagem.' );
$c .= sera_b_art( 'pp-pains' );
$c .= sera_b_chapter( 2, 'O mercado', 'As ferramentas de IA pensam em prompt. Quem faz filme pensa em cena.' );
$c .= sera_b_p( 'Mapeei o que existe pelo trabalho de quem faz filme, e não pela beleza de um quadro isolado. O padrão se repete: cada categoria resolve muito bem o seu pedaço e para na borda dele. Os geradores fazem imagem e vídeo, as ferramentas locais dão controle a quem sabe montar um fluxo de nós, os editores montam. O meio do caminho, onde a história de fato acontece, fica por conta da pessoa.' );
$c .= sera_b_art( 'pp-market' );
$c .= sera_b_p( 'Duas linhas dessa tabela viraram o produto. Ninguém junta <strong>o fluxo de um estúdio</strong>, do roteiro à montagem, com <strong>a liberdade de escolher o motor</strong>: o modelo de cada etapa e quem paga a GPU. Quem entrega o fluxo prende você nos créditos. Quem entrega a liberdade cobra em complexidade.' );
$c .= sera_b_chapter( 3, 'A aposta', 'Escreva uma frase. Dirija o resto.' );
$c .= sera_b_art( 'pp-statement' );
$c .= sera_b_p( 'Chamei de Paperplane, porque toda história começa como uma folha dobrada. Fundei sozinho, com IA do começo ao fim: pesquisa, produto, design, código e até os dois episódios que aparecem nesta página. É o meu primeiro produto fundado solo, e ele está em beta: o que você vê aqui é o estado atual, não um final feliz garantido. Quatro decisões deram a forma dele antes da primeira tela.' );
$c .= sera_b_art( 'pp-principles' );
$c .= sera_b_chapter( 4, 'O estúdio', 'Dez etapas, três atos: escrever, visualizar, filmar.' );
$c .= sera_b_p( 'O estúdio segue a ordem em que um filme é feito de verdade. Cada etapa entrega para a próxima, e a barra lateral mostra onde o projeto está. Dá para pular, voltar e chamar o Origami, o assistente do estúdio, em qualquer ponto. Mas o caminho padrão leva uma frase até um episódio.', 'lead' );
$c .= sera_b_art( 'pp-acts' );
$c .= sera_b_p( 'As telas abaixo são o estúdio redesenhado em código, com os quadros que o próprio Paperplane gerou para “A estação sem nome” e “Sem Partidas”. Cada uma aparece no computador e no celular.' );
$c .= sera_b_mock( 'pp-shots-studio' );
$c .= sera_b_chapter( 5, 'Continuidade', 'O difícil não é gerar um quadro bonito. É gerar o oitavo igual ao primeiro.' );
$c .= sera_b_p( 'Consistência virou a regra de produto mais importante. Um gerador sozinho não lembra de nada; o Paperplane lembra por ele. Cada pedido de imagem sai montado com o que o projeto já sabe: o estilo, a ficha de cada personagem, o cenário e o quadro anterior.', 'lead' );
$c .= sera_b_art( 'pp-cast' );
$c .= sera_b_art( 'pp-consist' );
$c .= sera_b_p( 'No modo avançado do storyboard, cada tomada vira uma árvore: as referências ligadas ao pedido, os takes crescendo lado a lado, cada um com modelo, seed e custo. Nenhuma versão boa se perde no caminho.' );
$c .= sera_b_mock( 'pp-nodes' );
$c .= sera_b_p( 'E como o estilo é uma camada separada, dá para trocar o traço do projeto inteiro sem perder nada. Anime hoje, noir amanhã, sitcom no fim de semana: o Paperplane redesenha cada quadro, e o elenco, os lugares e os planos continuam no lugar.' );
$c .= sera_b_art( 'pp-styles' );
$c .= sera_b_chapter( 6, 'Filmar', 'Só vira vídeo o que já foi aprovado como imagem.' );
$c .= sera_b_p( 'Imagem custa centavos; vídeo custa dólares. Por isso o storyboard é a porta da animação. O quadro aprovado vira o primeiro frame do vídeo, e quem dirige só conta o que se move, escolhe a duração e o modelo. A fala sai na voz do próprio personagem.', 'lead' );
$c .= sera_b_mock( 'pp-cut' );
$c .= sera_b_p( 'A montagem fecha o episódio numa linha do tempo com vídeo, efeitos, falas e trilha, e exporta em 1080p nativo, com <strong>upscale até 4K</strong> sem sair do projeto. Nada de baixar, subir em outro programa e torcer.' );
$c .= sera_b_chapter( 7, 'Em qualquer tela', 'Um estúdio de cinema que cabe no bolso.' );
$c .= sera_b_p( 'O estúdio foi feito para o computador, mas ideia boa não espera você sentar. Aprove um take no metrô, ajuste uma fala na fila do café, revise a montagem no sofá. Dobrado, cabe no bolso; aberto, vira uma mesa de storyboard. Role a página para abrir.' );
$c .= sera_b_mock( 'pp-duo' );
$c .= sera_b_chapter( 8, 'O motor', 'Seu filme, seu modelo, seu jeito de pagar.' );
$c .= sera_b_p( 'Quase toda ferramenta de vídeo com IA vende a mesma coisa: créditos, num modelo que ela escolheu, no preço que ela definiu. Para quem produz muito, a conta não fecha. Para quem já tem uma placa de vídeo boa, é pagar duas vezes. No Paperplane, o motor é uma camada separada do estúdio, e quem escolhe é quem dirige.', 'lead' );
$c .= sera_b_art( 'pp-engines' );
$c .= sera_b_p( 'A GPU própria é a parte que ainda está em pesquisa, e é onde mora o maior diferencial. O setup mínimo que estou desenhando é uma placa como a RTX 4090, com 24 GB de memória de vídeo. O caminho mais provável é um app de desktop que conecta a placa ao estúdio. Como o produto inteiro é construído com IA, levar a interface para um app é um port, não uma reescrita.' );
$c .= sera_b_art( 'pp-gpu-map' );
$c .= sera_b_chapter( 9, 'No laboratório', 'Dois truques novos, ainda no caldeirão.' );
$c .= sera_b_p( 'Dois recursos estão em teste com quem entrou primeiro, e ainda podem mudar de forma, de nome e de jeito. Os dois atacam o mesmo problema por lados diferentes: o Origami diminui o trabalho de quem dirige, e o Smart Engine diminui a conta.' );
$c .= sera_b_art( 'pp-lab' );
$c .= sera_b_chapter( 10, 'Feito no Paperplane', 'Nenhum coelho saiu de outra cartola.' );
$c .= sera_b_p( 'A regra que me guiou foi usar o produto para fazer o produto. Cada quadro, personagem e cenário desta página nasceu no Paperplane, para dois episódios de verdade: “Sem Partidas” e “A estação sem nome”. O único truque é o do produto.', 'lead' );
$c .= sera_b_art( 'pp-made' );
$c .= sera_b_p( 'Construí tudo sozinho, com IA em todas as camadas. Não foi mágica: foi outro jeito de dividir o trabalho.' );
$c .= sera_b_art( 'pp-solo' );
$c .= sera_b_chapter( 11, 'Onde está', 'O que já funciona, o que está em ajuste e o que vem em seguida.' );
$c .= sera_b_art( 'pp-status' );
$c .= sera_b_chapter( 12, 'O que aprendi até aqui', 'Um filme é continuidade. O resto é gerador.' );
$c .= sera_b_art( 'pp-reflection' );
$c .= sera_b_art( 'pp-signals' );
$c .= sera_b_p( 'Produto próprio, em beta, publicado de propósito. As telas foram reconstruídas em HTML e CSS a partir do Paperplane; quadros, personagens e cenários são imagens geradas no próprio Paperplane para os dois episódios de exemplo. Preços e tempos são ilustrativos.', 'note' );

return array(
	'title'   => 'Paperplane: um estúdio de cinema com IA, da primeira frase ao episódio em 4K',
	'excerpt' => 'Fazer filme com IA hoje é montar um quebra-cabeça com peças de oito caixas: roteiro aqui, imagem ali, vídeo, voz, montagem e upscale em mais quatro abas. O Paperplane junta tudo num estúdio só. Você escreve uma frase, e ele leva a ideia por roteiro, elenco, storyboard e animação até um episódio montado, em até 4K, deixando você escolher o modelo de cada etapa e quem paga a GPU. Fundei sozinho, com IA. Está em beta, publicado de propósito.',
	'meta'    => array(
		'_sera_headline' => 'Paperplane: escreva uma frase, dirija o resto. Um estúdio de cinema com IA, da ideia ao 4K',
		'_sera_company'  => 'Paperplane Studio',
		'_sera_year'     => '2026 · em beta',
		'_sera_role'     => 'Fundador solo · produto, design e construção com IA',
		'_sera_metrics'  => "1 frase | é tudo o que precisa para começar; o episódio sai montado\n10 etapas | da ideia à montagem em 4K, numa janela só\n2 episódios | de exemplo, com cada quadro e personagem feito no próprio Paperplane",
		'_sera_chips'    => 'Produto próprio, IA generativa, Fundador solo, Em beta',
		'_sera_visual'   => 'paperplane',
	),
	'content' => $c,
);
