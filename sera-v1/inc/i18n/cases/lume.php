<?php
/**
 * Lume (Pagaleve) — Brazilian Portuguese version.
 * Mirrors the English builder in inc/starter-content.php block by block.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'lm-glance' );
$c .= sera_b_chapter( 1, 'O problema', 'A maioria dos protótipos vai para a rua sem teste, porque testar bem custa uma semana de designer.' );
$c .= sera_b_p( 'Um teste de usabilidade moderado ainda é o melhor jeito de entender por que alguém se perde numa tela. Também é a primeira coisa cortada de uma sprint: recrutar, agendar, conduzir e transcrever oito sessões, e a semana acabou. Na Pagaleve, o time tinha o problema inverso também. Mais designers queriam testar, e as ferramentas que escalam, mapas de clique e tarefas não moderadas, mostram onde as pessoas tocaram, mas nunca perguntam o que elas esperavam que acontecesse.', 'lead' );
$c .= sera_b_p( 'E quando o designer que desenhou a tela modera a sessão, o teste se inclina, em silêncio, para a resposta que ele espera.' );
$c .= sera_b_art( 'lm-pains' );
$c .= sera_b_chapter( 2, 'A aposta', 'Um moderador que vai junto com o link.' );
$c .= sera_b_art( 'lm-statement' );
$c .= sera_b_p( 'Chamei de Lume. Estou construindo para o time no Lovable, sobre um modelo de voz em tempo real, e ainda está em andamento: esta página é o estado atual, não uma história pronta. Quatro decisões deram a forma dele antes da primeira tela.' );
$c .= sera_b_art( 'lm-principles' );
$c .= sera_b_chapter( 3, 'O sistema', 'Entra um link do Figma, sai um link de convite, e um relatório que se preenche sozinho.' );
$c .= sera_b_p( 'O designer manda o link do protótipo do Figma. Uma skill do Claude lê as telas, monta o roteiro e cria o estudo pelo servidor MCP do próprio Lume, o mesmo padrão aberto que usei no Research Hub. O designer marca o que não pode ser pulado, ensaia com participantes simulados e publica. O CRM dispara o convite. Os clientes conversam pelo protótipo no celular, e o relatório vai se escrevendo conforme as sessões chegam.' );
$c .= sera_b_art( 'lm-system' );
$c .= sera_b_p( 'A área do designer foi feita para o computador e funciona também no celular, para dar uma olhada no estudo entre uma reunião e outra. Cada tela abaixo aparece nos dois.' );
$c .= sera_b_mock( 'lm-shots-setup' );
$c .= sera_b_chapter( 4, 'A sessão', 'O protótipo ocupa a tela. O moderador é um cartão embaixo.' );
$c .= sera_b_p( 'O lado do participante é onde foi a maior parte do design, e a maior parte foi tirar coisas. A sessão que funciona é a que o moderador quase desaparece.', 'lead' );
$c .= sera_b_mock( 'lume-flow' );
$c .= sera_b_art( 'lm-session' );
$c .= sera_b_p( 'O problema mais difícil não foi o que o Lume diz, mas <strong>quando ele para</strong>. Um assistente de voz que preenche toda pausa parece mal-educado, e um participante interrompido para de pensar em voz alta. Então o turno da conversa virou regra de produto.' );
$c .= sera_b_art( 'lm-turns' );
$c .= sera_b_p( 'Cada versão da sessão ficou menor. A primeira tinha um chat embaixo do protótipo, depois um bottom sheet, depois um iPhone desenhado dentro do iPhone. Tudo isso disputava atenção com a coisa sendo testada.' );
$c .= sera_b_art( 'lm-cut' );
$c .= sera_b_chapter( 5, 'O lado do designer', 'Rascunho, blocos essenciais, um ensaio e depois o campo.' );
$c .= sera_b_p( 'A área do designer é pequena de propósito: uma conta, login da empresa, e um estudo que é rascunho até alguém decidir que não é mais.' );
$c .= sera_b_art( 'lm-designer' );
$c .= sera_b_art( 'lm-profiles' );
$c .= sera_b_p( 'Com o estudo em campo, o designer não espera a última sessão. Os achados vão se preenchendo conforme as sessões chegam, cada um com o número de sessões por trás e uma citação, e qualquer sessão pode ser revista ao lado da transcrição, como no topo desta página.' );
$c .= sera_b_mock( 'lm-findings' );
$c .= sera_b_chapter( 6, 'A construção', 'Um agente de produto melhora o Lume toda noite. Eu reviso o registro de manhã.' );
$c .= sera_b_p( 'Um produto de voz tem mil falhas pequenas que você só ouve usando, e eu não consigo rodar vinte sessões por noite. Então o Lume tem um agente de produto agendado que roda: ele audita a sessão, compara o que encontra com a visão e as decisões já registradas, corrige o que der e me manda a lista.' );
$c .= sera_b_art( 'lm-agent' );
$c .= sera_b_chapter( 7, 'Onde está', 'O que funciona, o que está em ajuste e o que vem em seguida.' );
$c .= sera_b_art( 'lm-status' );
$c .= sera_b_chapter( 8, 'O que aprendi até aqui', 'As palavras vieram por último. Os turnos vieram primeiro.' );
$c .= sera_b_art( 'lm-reflection' );
$c .= sera_b_art( 'lm-signals' );
$c .= sera_b_p( 'Trabalho em andamento, publicado de propósito. Telas reais do produto, reconstruídas em HTML e CSS a partir da UI no Lovable e anonimizadas; estudos, participantes, perguntas e citações são fictícios. Os achados e dados internos da Pagaleve são confidenciais e não aparecem aqui.', 'note' );

return array(
	'title'   => 'Lume: um moderador de IA por voz para testes de protótipo no Figma',
	'excerpt' => 'Teste de usabilidade moderado não escala, e ferramenta não moderada perde o porquê. Estou construindo o Lume, um moderador de IA por voz que transforma o link de um protótipo do Figma num teste de usabilidade que os clientes fazem no celular, com um relatório que cita cada achado. Trabalho em andamento, publicado de propósito.',
	'meta'    => array(
		'_sera_headline' => 'Lume: testes de usabilidade conduzidos por uma voz de IA, a partir de um link do Figma',
		'_sera_year'     => '2026 · em andamento',
		'_sera_role'     => 'Product Designer Especialista · conceito, design e construção',
		'_sera_metrics'  => "Um link | Entra um protótipo do Figma, sai um convite para o CRM\nPor voz | O moderador pergunta, espera e nunca interrompe\n5 a 12 | sessões por estudo, ensaiadas antes com participantes simulados",
		'_sera_chips'    => 'Ferramentas de pesquisa, IA por voz, Em andamento',
	),
	'content' => $c,
);
