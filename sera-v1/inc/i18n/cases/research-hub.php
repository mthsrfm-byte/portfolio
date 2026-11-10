<?php
/**
 * Research Hub (Pagaleve) — Brazilian Portuguese version.
 * Mirrors the English builder in inc/starter-content.php block by block.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'rh-glance' );
$c .= sera_b_chapter( 1, 'O problema', 'Nossa pesquisa caía no esquecimento logo depois da apresentação.' );
$c .= sera_b_p( 'Faço pesquisa há mais de dez anos, e a parte mais difícil sempre foi o que acontece depois da apresentação. Na Pagaleve, os achados viviam em decks espalhados pelo Drive. Alguém de produto perguntava algo que a gente já tinha respondido, e quem acabava de chegar não tinha como descobrir o que já sabíamos sobre nossos clientes, a não ser perguntando para a única pessoa que conduziu o estudo.', 'lead' );
$c .= sera_b_p( 'Ao mesmo tempo, mais gente no time queria pesquisar, inclusive designers que nunca tinham escrito um questionário. E a matéria-prima da pesquisa, planilhas com ID de cliente e gravações de sessão com rosto e voz, ficava a um clique dos slides que qualquer um podia abrir. Com a <strong>LGPD</strong> em jogo, esse não é um risco para deixar na memória das pessoas.' );
$c .= sera_b_art( 'rh-failures' );
$c .= sera_b_chapter( 2, 'A aposta', 'Fazer da publicação uma etapa do estudo, para o acervo se montar sozinho.' );
$c .= sera_b_art( 'rh-statement' );
$c .= sera_b_p( 'Quatro princípios guiaram cada decisão, da estrutura de pastas ao último toggle.' );
$c .= sera_b_art( 'rh-principles' );
$c .= sera_b_chapter( 3, 'O sistema', 'Um ciclo só, do que aprendemos ao que vamos aprender.' );
$c .= sera_b_p( 'Uma skill do Claude conduz a pesquisa, o Google Drive guarda os arquivos e o Research Hub, construído no Lovable, transforma os dois em algo que as pessoas podem navegar, consultar e usar para planejar. As peças conversam por um <strong>servidor MCP que construí dentro do hub</strong> (o MCP é o padrão aberto que deixa um assistente de IA chamar uma ferramenta). Assim, o acervo vira uma ferramenta que a skill usa no começo e no fim de cada estudo, um conector que qualquer pessoa da empresa pode adicionar ao próprio Claude e a fonte de onde sai o roadmap do próximo trimestre.' );
$c .= sera_b_art( 'rh-system' );
$c .= sera_b_chapter( 4, 'O hub', 'As pastas do time no Drive viram produto.' );
$c .= sera_b_p( 'O hub lê a estrutura que o time já usava. Uma pasta é uma área, uma subpasta é um estudo (data e método vêm do nome) e um <code>resumo.md</code> vira o resumo e os insights. Dá para soltar um .zip, um PDF, um deck ou uma planilha; nada vai para o ar antes de você revisar o que cada arquivo vira. Por trás, um painel de admin reúne estudos, autores, feedback e configurações num lugar só.' );
$c .= sera_b_mock( 'rh-shots-archive' );
$c .= sera_b_art( 'rh-import' );
$c .= sera_b_chapter( 5, 'A skill', 'O meu jeito de pesquisar, empacotado para qualquer designer.' );
$c .= sera_b_p( 'Empacotei numa skill do Claude o jeito como eu conduzo pesquisa. Ela descobre em que etapa você está, faz o trabalho e puxa o próximo passo. Só para quando precisa entregar o que cabe a uma pessoa (entrar na conta, apertar enviar, aprovar os insights), num card curto de “sua vez”. E conversa com o hub por MCP: lê o acervo no começo e publica os insights no fim, sozinha.' );
$c .= sera_b_art( 'rh-flow' );
$c .= sera_b_art( 'rh-mcp' );
$c .= sera_b_p( 'Uma skill só ajuda se as pessoas instalam. Então o hub ganhou um guia: cinco minutos de leitura que montam com você a primeira pergunta em quatro partes (público, momento, dúvida e a decisão que ela informa), transformam tudo num pedido pronto para colar no Claude e ficam ao lado do download da skill. O guia também deixa claras as regras da casa: a skill sugere, as pessoas decidem, e dado de cliente nunca sai da sala.' );
$c .= sera_b_art( 'rh-guide' );
$c .= sera_b_chapter( 6, 'O formato', 'Todo estudo, as mesmas seis seções.' );
$c .= sera_b_p( 'Venha de uma rodada de entrevistas, de um survey ou de um teste de usabilidade, todo estudo se lê do mesmo jeito, então dá para comparar estudos e entender cada um em um minuto, com o detalhe ali quando você precisa.' );
$c .= sera_b_art( 'rh-format' );
$c .= sera_b_chapter( 7, 'Pergunte ao acervo', 'Perguntas do seu jeito, respostas com fonte.' );
$c .= sera_b_p( 'O chat só responde com base no hub e marca cada afirmação com o estudo de onde ela veio, a um toque da fonte. Ele abre numa página em branco com algumas perguntas para começar, e dá para anexar até dez estudos para manter a resposta dentro deles.' );
$c .= sera_b_p( 'Depois, o chat virou o centro do hub. Um menu só passou a comandar o produto inteiro, como barra lateral no desktop e gaveta no celular: acervo, roadmap, guia e o conector do Claude ficam a um toque, ao lado das conversas que você quer guardar. Toda resposta pode ser copiada, refeita ou avaliada, e um joinha para baixo pergunta o que faltou, para o chat aprender com os próprios erros.' );
$c .= sera_b_mock( 'rh-shots-ask' );
$c .= sera_b_p( 'O mesmo acervo também vive fora do hub. O servidor MCP virou um conector que qualquer pessoa da Pagaleve pode adicionar ao próprio Claude, entrando com a conta da empresa: ferramentas para listar estudos, publicar um estudo, ler o roadmap e atualizá-lo. As pessoas perguntam no próprio chat, e as regras de confidencialidade viajam junto com os dados, então arquivos confidenciais continuam trancados lá também.' );
$c .= sera_b_art( 'rh-connect' );
$c .= sera_b_chapter( 8, 'O roadmap', 'Usar o acervo para planejar os estudos do próximo trimestre.' );
$c .= sera_b_p( 'Com o acervo pesquisável, o time precisava decidir o que pesquisar no próximo trimestre, e por quê. O planejamento acontecia numa planilha, de memória. Adicionei ao hub um roadmap de pesquisa que parte do acervo, em três passos.', 'lead' );
$c .= sera_b_art( 'rh-roadmap-steps' );
$c .= sera_b_mock( 'rh-shots-roadmap' );
$c .= sera_b_p( 'Ideias do time e ideias da IA ficam lado a lado, e as duas precisam conquistar o lugar do mesmo jeito: com uma pergunta, uma decisão que ela informa e um motivo para fazer agora. A IA só lê conteúdo Interno, então estudos confidenciais informam o time sem vazar para as sugestões.' );
$c .= sera_b_p( 'Depois, a lista ordenada vira calendário. Um rascunho só vira o plano quando alguém publica, e é a publicação que cria os cards no Jira, então o roadmap e o backlog do time nunca se desencontram. Três travas pequenas nasceram do uso: um alerta quando o calendário deixa de seguir a prioridade, uma simulação que mostra o que mudaria no Jira antes de criar qualquer coisa e uma sincronização que traz de volta o status de cada card.' );
$c .= sera_b_p( 'Com isso, o roadmap alimenta a skill, a skill alimenta o acervo, e o acervo alimenta o próximo roadmap.' );
$c .= sera_b_chapter( 9, 'Privacidade por padrão', 'O sistema aplica as regras da LGPD, e ninguém precisa lembrar delas.' );
$c .= sera_b_p( 'Desenhei as regras de privacidade antes da primeira tela. Os achados são abertos para a empresa toda, e os dados das pessoas por trás deles ficam trancados. Toda regra é aplicada automaticamente: na importação, dentro da skill e no que a IA do roadmap tem permissão de ler.' );
$c .= sera_b_art( 'rh-privacy' );
$c .= sera_b_chapter( 10, 'O que mudou', 'De “quem fez aquele estudo?” para “o que a gente aprende agora?”' );
$c .= sera_b_art( 'rh-impact' );
$c .= sera_b_chapter( 11, 'O que aprendi', 'Com IA, boa parte do meu trabalho passou a ser descrever como o sistema deve se comportar.' );
$c .= sera_b_art( 'rh-reflection' );
$c .= sera_b_art( 'rh-signals' );
$c .= sera_b_p( 'Telas reais do produto, anonimizadas: estudos, pessoas, citações e números são fictícios. Os achados, números e dados internos da Pagaleve são confidenciais e não aparecem aqui.', 'note' );

return array(
	'title'   => 'Research Hub: uma memória e um plano para a pesquisa',
	'excerpt' => 'A pesquisa da Pagaleve terminava em decks que ninguém abria de novo. Desenhei e construí um Research Hub com Lovable e Claude: um acervo que se enche sozinho, uma skill do Claude que guia cada estudo, um chat que cita a fonte de cada afirmação e um roadmap com IA que manda os estudos do próximo trimestre para o Jira.',
	'meta'    => array(
		'_sera_headline' => 'Research Hub: um acervo da pesquisa da Pagaleve que o time pode consultar',
		'_sera_year'     => '2026',
		'_sera_role'     => 'Product Designer Especialista · conceito, design e construção',
		'_sera_metrics'  => "Pesquisável | Um acervo só, em linguagem natural, no hub e pelo Claude\nCom fonte | Cada afirmação ligada ao estudo de onde veio\n→ Jira | Um roadmap com IA transforma achados nos estudos do próximo trimestre",
		'_sera_chips'    => 'Research ops, Ferramentas de IA, LGPD por padrão',
	),
	'content' => $c,
);
