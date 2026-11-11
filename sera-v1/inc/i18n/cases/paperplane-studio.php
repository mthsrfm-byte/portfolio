<?php
/**
 * Paperplane Studio — Brazilian Portuguese version (text version of the case: SEO, llms.txt, editor).
 * Mirrors the English builder in inc/starter-content.php block by block. The page layout itself is
 * template-parts/cases/paperplane.php, bilingual via sera_t().
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_p( 'Uma frase entra, um episódio animado sai, e cada clique mostra o preço antes de acontecer. Defini o produto, o escopo e o padrão de acabamento de cada tela. Quem construiu foi uma equipe de agentes de IA, sob a minha direção, em 23 dias.', 'lead' );
$c .= sera_b_p( 'A IA escreveu o código. Cada decisão que faz o Paperplane parecer simples e bem acabado foi minha.' );
$c .= sera_b_chapter( 1, 'O cenário', 'Fazer um episódio com IA hoje é dirigir com seis abas abertas e a fatura no escuro.' );
$c .= sera_b_p( 'Quem tenta fazer animação com IA conhece a cena. Uma aba para a imagem, outra para o vídeo, outra para a voz e uma planilha para lembrar quanto já foi.', 'lead' );
$c .= sera_b_p( 'O prompt sai em inglês, copiado de um tutorial. Cada tentativa custa, e o preço só aparece depois. O personagem que tinha cabelo curto na cena 1 volta de franja na cena 2. E o total da brincadeira chega no fim do mês, na fatura do cartão.' );
$c .= sera_b_p( 'No meio disso tudo, a história se perde. Quem queria dirigir passa o dia como operador de ferramenta: copia, cola, traduz, espera na fila, baixa, sobe de novo. A ideia que cabia numa frase vira uma pasta de arquivos com nomes como "final_v3".' );
$c .= sera_b_p( '<strong>O Paperplane junta essa mesa inteira numa tela só, na ordem de uma filmagem, e põe o preço em cada botão.</strong>' );
$c .= sera_b_chapter( 2, 'O produto', 'Da frase ao episódio em dez etapas que qualquer set de filmagem reconhece.' );
$c .= sera_b_p( 'Montei o estúdio na ordem de uma produção de verdade. Escrever, Visualizar, Filmar. Cada tela pede uma coisa só.', 'lead' );
$c .= sera_b_p( 'A ordem é o segredo da continuidade. Personagens e cenários ganham ficha aprovada antes do storyboard, e essa ficha vai junto em cada quadro. A Decupagem vem depois deles de propósito: decupar é planejar a câmera, e o Origami, o assistente de IA do estúdio, só escolhe bem o plano quando conhece o elenco e os lugares.' );
$c .= sera_b_p( 'O vocabulário também é de set: tomada, plano, decupagem. Cada tela tem um título curto, uma frase que explica o porquê e um botão principal. Até os nomes foram escolhidos: "universo", no lugar de "bíblia", para a série não ganhar termo religioso.' );
$c .= sera_b_chapter( 3, 'O preço antes do clique', 'Cada clique custa dinheiro. Por isso o preço chega antes do clique.' );
$c .= sera_b_p( 'Essa decisão segura todas as outras. Um gerador de vídeo cobra por tentativa, e um assistente que age sozinho pode queimar o saldo de alguém em silêncio.', 'lead' );
$c .= sera_b_p( 'Desenhei quatro regras para que <strong>nenhum crédito saia sem um gesto claro</strong>. Elas valem no estúdio inteiro, inclusive para o Origami, e nenhuma mudança vai ao ar se quebrar uma delas.' );
$c .= sera_b_p( '<strong>Saldo contado em minutos</strong> O saldo diz quanto vídeo ainda rende, como estimativa, na qualidade escolhida. Com saldo zero a frase some, nunca mostra "0 s".' );
$c .= sera_b_p( '<strong>Mídia só sai com clique</strong> O clique é o consentimento, e o botão traz o preço estimado. Recusei um modo automático com teto porque ele quebrava essa regra.' );
$c .= sera_b_p( '<strong>Falhou, o crédito volta</strong> O crédito fica reservado durante a geração e volta se der erro. Resultado concluído consome, e a interface diz isso com todas as letras.' );
$c .= sera_b_p( '<strong>Imagem primeiro, vídeo depois</strong> Cada tomada é aprovada como imagem antes de animar. Só o quadro aprovado vira o primeiro quadro do vídeo.' );
$c .= sera_b_chapter( 4, 'O redesign', 'Fácil de usar, sério por baixo do capô.' );
$c .= sera_b_p( 'Cinco dias depois do começo, o estúdio crescia por acúmulo e cada tela tinha um esqueleto diferente. Em 24 de outubro parei e redesenhei tudo sobre quatro regras, para que quem chega pela primeira vez termine uma etapa sem abrir nada e quem é profissional encontre tudo o que precisa por dentro.', 'lead' );
$c .= sera_b_p( 'Depois cortei o que intimidava. Quatro modos técnicos viraram uma escolha só: Básico ou Avançado. Nome de modelo, preço por segundo e prompt em inglês saíram da tela. A pessoa escreve em português, menciona @Maria ou @tomada 1A, e o estúdio cuida do resto.' );
$c .= sera_b_chapter( 5, 'Microinterações', 'Cada movimento do estúdio diz onde está o seu dinheiro.' );
$c .= sera_b_p( 'Escolhi uma personalidade de movimento e dei a ela um nome: "Quieto com pouso, o crédito dá energia". A base é calma. Quando algo se move, é porque tem algo a dizer.', 'lead' );
$c .= sera_b_p( 'A regra mais forte: <strong>a partícula é o crédito</strong>. Ela só aparece onde há crédito ou Origami, viaja do saldo para a ação e nasce sempre de um evento real. Com movimento reduzido, tudo para e a informação continua no texto.' );
$c .= sera_b_chapter( 6, 'Dobra', 'Um design system que comanda o estúdio inteiro.' );
$c .= sera_b_p( 'Criei a Dobra para o estúdio inteiro ter um padrão só. Cor, espaço, canto e movimento moram num lugar, e é por ele que cada peça do produto é ajustada. Quando mudo uma escolha ali, tudo acompanha, e os agentes falam a mesma língua que eu: peço <code>--accent</code>, eles sabem onde mexer.', 'lead' );
$c .= sera_b_p( 'Nada fora do padrão chega ao ar: cor, espaço e contraste são conferidos a cada mudança.' );
$c .= sera_b_chapter( 7, 'O site', 'Papel com luz: a home fala a mesma língua do estúdio.' );
$c .= sera_b_p( 'A home tem um trabalho só: fazer quem ainda não entrou querer entrar. Levei para ela o vocabulário da Dobra, com grão de papel, luz vindo de cima à esquerda e o limão com volume. A promessa vai junto: o preço aparece antes de cada take. A lista de espera mede o funil sem cookies e sem guardar nome, e-mail ou IP nos eventos.', 'lead' );
$c .= sera_b_p( 'O estúdio inteiro cabe no seu bolso, com tudo o que o computador faz.' );
$c .= sera_b_chapter( 8, 'Como trabalho', 'Toda noite, uma equipe de agentes pesquisa o que o Paperplane deve virar. De manhã, eu escolho.' );
$c .= sera_b_p( 'Enquanto eu durmo, agentes analisam a plataforma, estudam a concorrência e acompanham as novidades do mercado de IA. Dali sai uma curadoria do que merece entrar no roadmap.', 'lead' );
$c .= sera_b_p( 'As melhores ideias chegam prontas para testar, atrás de uma chave que eu desligo quando quiser. Ao meio-dia abro o resumo da noite e decido o que fica, o que volta e o que sai.' );
$c .= sera_b_p( 'São nove agentes, cada um com um papel: pesquisa, memória dos temas, estratégia, crítica, design, construção, qualidade, segurança e o resumo da manhã. O crítico ataca cada ideia antes de ela ganhar forma.' );
$c .= sera_b_p( 'Em 23 dias, cada marco desta linha começou com uma decisão minha. Os agentes propõem, constroem e testam. O rumo, o corte e o padrão de acabamento são meus.' );
$c .= sera_b_chapter( 9, 'O que aprendi', 'O que aprendi até aqui, e o que vem agora.' );
$c .= sera_b_p( '<strong>Decisão escrita vence decisão lembrada.</strong> Agentes não guardam contexto de uma sessão para a outra. Numerar e datar cada decisão fez o produto parar de andar em círculo.' );
$c .= sera_b_p( '<strong>Padrão que importa fica escrito no produto.</strong> Pedir "não use cor solta" durou um dia. Quando a regra entrou no estúdio, nenhuma cor escapou de novo.' );
$c .= sera_b_p( '<strong>Tirar da tela é o trabalho mais difícil.</strong> Agentes adicionam com facilidade. Cada corte exigiu uma decisão minha, e foi cortando que o estúdio ficou simples.' );
$c .= sera_b_p( '<strong>Em teste com gente do audiovisual.</strong> O beta está fechado. Eu mesmo estou testando, junto com amigos próximos do audiovisual, e coletando o feedback deles para decidir o que vem a seguir.' );
$c .= sera_b_p( '<strong>Minutos funcionam para quem nunca gerou vídeo?</strong> É a hipótese que mais quero validar com quem está testando agora.' );
$c .= sera_b_chapter( 10, 'Onde está', 'O estúdio está em beta fechado. A home já está no ar.' );
$c .= sera_b_p( 'O Paperplane continua em andamento, e esta página mostra o estado de hoje. Se você trabalha com produto, IA ou animação e quer conversar sobre como um designer dá rumo a uma equipe de agentes, me escreve.' );
$c .= sera_b_p( 'As imagens e os vídeos dentro das telas são de exemplo.', 'note' );

return array(
	'title'   => 'Paperplane Studio: um estúdio de cinema com IA que mostra o preço antes do clique',
	'excerpt' => 'Uma frase entra, um episódio animado sai, e cada clique mostra o preço antes de acontecer. Defini o produto, o escopo e o padrão de acabamento de cada tela; quem construiu foi uma equipe de agentes de IA, sob a minha direção, em 23 dias. Projeto pessoal, em beta fechado.',
	'meta'    => array(
		'_sera_headline' => 'Paperplane Studio: um estúdio de cinema com IA que mostra o preço antes do clique',
		'_sera_year'     => '2026 · em beta',
		'_sera_role'     => 'Product designer · conceito, design e direção dos agentes',
		'_sera_metrics'  => "23 dias | Da primeira tela a um estúdio completo, com montagem e cobrança\n10 etapas | Da frase ao episódio, como num set de verdade\nZero | Mídia gerada sem o clique da pessoa",
		'_sera_chips'    => 'Projeto pessoal, IA generativa, Design system',
	),
	'content' => $c,
);
