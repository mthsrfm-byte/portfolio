<?php
/**
 * Paperplane Studio — Brazilian Portuguese version (draft for review).
 * Same block grammar as the other cases: narrative in core blocks, visuals in
 * "sera/artifact" (pp-*) and "sera/mockup" (paperplane, pp-*).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'pp-glance' );
$c .= sera_b_chapter( 1, 'O problema', 'Fazer um filme com IA hoje é montar um quebra-cabeça com peças de oito caixas diferentes.' );
$c .= sera_b_p( 'Os geradores de imagem e vídeo ficaram impressionantes em fazer um quadro bonito. Só que ninguém faz um quadro: faz uma cena, depois outra, com as mesmas pessoas, no mesmo lugar, na mesma luz. Quem tenta contar uma história com IA hoje vira montador de um quebra-cabeça espalhado: o roteiro num documento, as referências num mural, os personagens num gerador, os vídeos em outro, as vozes num terceiro, a montagem num editor e o upscale num programa à parte.', 'lead' );
$c .= sera_b_p( 'Cada passagem entre ferramentas é um download, um upload e um prompt reescrito do zero. E quando o cliente pede para trocar uma fala da cena 3, ninguém sabe mais em qual aba ela mora.' );
$c .= sera_b_art( 'pp-scatter' );
$c .= sera_b_p( 'Olhando o meu próprio processo e o de quem roteiriza, dirige e entrega vídeo para cliente, as dores se repetem em três lugares, e nenhum deles é a qualidade da imagem.' );
$c .= sera_b_art( 'pp-pains' );
$c .= sera_b_chapter( 2, 'O mercado', 'As ferramentas de IA pensam em prompt. Quem faz filme pensa em cena.' );
$c .= sera_b_p( 'Mapeei o que existe olhando para o trabalho de quem faz filme, e não para a qualidade de um quadro isolado. O padrão se repete: cada categoria resolve muito bem um pedaço e para na borda dele. Os geradores fazem imagem e vídeo, as ferramentas locais dão controle a quem sabe montar um fluxo de nós, os editores montam. O meio do caminho, onde mora a história, fica com a pessoa.' );
$c .= sera_b_art( 'pp-market' );
$c .= sera_b_p( 'Duas linhas da tabela viraram o produto. Ninguém junta <strong>o fluxo de um estúdio</strong>, do roteiro à montagem, com <strong>a liberdade de escolher o motor</strong>: o modelo de cada etapa e quem paga a GPU. Quem tem o fluxo prende a pessoa nos créditos; quem dá liberdade cobra em complexidade.' );
$c .= sera_b_chapter( 3, 'A aposta', 'Um estúdio inteiro numa janela só, com o roteiro no comando.' );
$c .= sera_b_art( 'pp-statement' );
$c .= sera_b_p( 'Chamei de Paperplane. Fundei sozinho, com IA do começo ao fim: pesquisa, produto, design, código e até os dois episódios que aparecem na landing. É meu primeiro case de produto fundado solo, e ele ainda está em beta: esta página é o estado atual, não uma história pronta. Quatro decisões deram a forma dele antes da primeira tela.' );
$c .= sera_b_art( 'pp-principles' );
$c .= sera_b_chapter( 4, 'O estúdio', 'Dez etapas, três atos: escrever, visualizar, filmar.' );
$c .= sera_b_p( 'O estúdio segue a ordem em que um filme é feito de verdade. Cada etapa entrega para a próxima, e a barra lateral mostra onde o projeto está. Dá para pular, voltar e pedir ajuda ao Origami em qualquer ponto, mas o caminho padrão leva uma frase até um episódio.', 'lead' );
$c .= sera_b_art( 'pp-acts' );
$c .= sera_b_p( 'O estúdio foi feito para o computador e cabe no celular, para aprovar um take no metrô ou ajustar uma fala na fila do café. Cada tela abaixo aparece nos dois.' );
$c .= sera_b_mock( 'pp-shots-studio' );
$c .= sera_b_chapter( 5, 'Continuidade', 'O difícil não é gerar um quadro bonito. É gerar o oitavo igual ao primeiro.' );
$c .= sera_b_p( 'Consistência virou a regra de produto mais importante. Um gerador sozinho não lembra de nada; o Paperplane lembra por ele. Cada pedido de imagem sai montado a partir do que o projeto já sabe, e quem dirige vê de onde veio cada peça.' );
$c .= sera_b_art( 'pp-consist' );
$c .= sera_b_p( 'No modo avançado do storyboard, cada tomada vira uma árvore: as referências ligadas ao pedido, os takes crescendo lado a lado, cada um com modelo, seed e custo. Nenhuma versão boa se perde no caminho.' );
$c .= sera_b_mock( 'pp-nodes' );
$c .= sera_b_chapter( 6, 'Filmar', 'Só vira vídeo o que já foi aprovado. E monta tudo no mesmo lugar.' );
$c .= sera_b_p( 'Na animação, o quadro aprovado vira o primeiro frame do vídeo. Quem dirige conta o que se move, escolhe a duração e o modelo, e a fala sai na voz do próprio personagem. A montagem fecha o episódio numa linha do tempo com vídeo, efeitos, falas e trilha, e exporta em 1080p nativo, com <strong>upscale até 4K</strong> sem sair do projeto.' );
$c .= sera_b_mock( 'pp-cut' );
$c .= sera_b_chapter( 7, 'O motor', 'O estúdio é o mesmo. Quem paga a GPU é escolha de quem dirige.' );
$c .= sera_b_p( 'Quase toda ferramenta de vídeo com IA vende a mesma coisa: créditos, num modelo que ela escolheu, no preço que ela definiu. Para quem produz muito, a conta não fecha; para quem já tem uma placa de vídeo boa, é pagar duas vezes. No Paperplane, o motor é uma camada separada do estúdio.', 'lead' );
$c .= sera_b_art( 'pp-engines' );
$c .= sera_b_p( 'A GPU própria é a parte que ainda está em pesquisa, e é onde mora o maior diferencial. O setup mínimo que estou desenhando é uma placa como a RTX 4090, com 24 GB de memória de vídeo. O caminho mais provável é um app de desktop que conecta a placa ao estúdio. Como o produto inteiro é construído com IA, levar a interface para um app é um port, não uma reescrita.' );
$c .= sera_b_art( 'pp-gpu-map' );
$c .= sera_b_chapter( 8, 'No laboratório', 'Dois truques ainda no caldeirão.' );
$c .= sera_b_p( 'Dois recursos estão sendo testados com quem entrou primeiro. Os dois atacam o mesmo problema por lados diferentes: o Origami diminui o trabalho de quem dirige, e o Smart Engine diminui a conta.' );
$c .= sera_b_art( 'pp-lab' );
$c .= sera_b_chapter( 9, 'A construção', 'Um fundador, vários modelos de IA e nenhuma equipe de 50 pessoas.' );
$c .= sera_b_p( 'Construí o Paperplane sozinho, com IA em todas as camadas. A regra que me guiou foi usar o produto para fazer o produto: cada vídeo, quadro e personagem da landing nasceu no Paperplane, para dois episódios de verdade.' );
$c .= sera_b_art( 'pp-solo' );
$c .= sera_b_chapter( 10, 'Onde está', 'O que funciona, o que está em ajuste e o que vem em seguida.' );
$c .= sera_b_art( 'pp-status' );
$c .= sera_b_chapter( 11, 'O que aprendi até aqui', 'Um filme é continuidade. O resto é gerador.' );
$c .= sera_b_art( 'pp-reflection' );
$c .= sera_b_art( 'pp-signals' );
$c .= sera_b_p( 'Produto próprio, em beta, publicado de propósito. Telas reconstruídas em HTML e CSS a partir do Paperplane, com os quadros desenhados em código no lugar das imagens geradas. Projetos, personagens e falas vêm dos episódios de exemplo; preços e tempos são ilustrativos.', 'note' );

return array(
	'title'   => 'Paperplane: um estúdio de cinema com IA, da ideia à montagem em 4K',
	'excerpt' => 'Quem faz vídeo com IA hoje monta um quebra-cabeça: roteiro num lugar, imagem em outro, vídeo, voz e montagem em mais três. Fundei sozinho, com IA, o Paperplane: um estúdio que leva uma frase até um episódio montado, com roteiro, elenco, storyboard e upscale até 4K no mesmo lugar, e deixa quem dirige escolher o modelo e quem paga a GPU. Meu primeiro produto fundado solo. Em beta, publicado de propósito.',
	'meta'    => array(
		'_sera_headline' => 'Paperplane: um estúdio de cinema inteiro numa janela, da primeira frase ao 4K',
		'_sera_company'  => 'Paperplane Studio',
		'_sera_year'     => '2026 · em beta',
		'_sera_role'     => 'Fundador solo · produto, design e construção com IA',
		'_sera_metrics'  => "1 frase | é o ponto de partida; o episódio sai montado, em até 4K\n10 etapas | da ideia à montagem, numa janela só\n3 motores | créditos, GPU por hora ou a sua própria placa",
		'_sera_chips'    => 'Produto próprio, IA generativa, Fundador solo, Em beta',
		'_sera_visual'   => 'paperplane',
	),
	'content' => $c,
);
