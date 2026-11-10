<?php
/**
 * Fatal Model · PerfisAD — Portuguese version (mirrors sera_starter_cases()).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'fm-glance' );
$c .= sera_b_chapter( 1, 'A pergunta', 'Um briefing comercial sobre anunciantes que a gente mal conhecia.' );
$c .= sera_b_p( 'Na Atlas Technologies, a empresa por trás do Fatal Model, eu trabalhava na tribo que atende os anunciantes (ADs): acompanhantes independentes que pagam por planos para aparecer na plataforma. O briefing era comercial: entender nossos anunciantes a ponto de encontrar caminhos para aumentar a rentabilidade do site.', 'lead' );
$c .= sera_b_p( 'As pessoas por trás dessa receita eram quase invisíveis dentro da empresa. A gente as conhecia como planos, pontos e posições no ranking. Por isso, desde o primeiro dia, o objetivo que dei à pesquisa foi <strong>humanizar esses usuários</strong>: ouvir essas pessoas como pessoas, com as palavras delas, antes de decidir qualquer coisa sobre o negócio.' );
$c .= sera_b_art( 'fm-chair' );
$c .= sera_b_chapter( 2, 'O recorte', 'Quatro perfis que sustentam quase toda a plataforma.' );
$c .= sera_b_p( 'Primeiro, era preciso decidir quem ouvir. Com o time de ciência de dados, segmentamos os anunciantes ativos com um modelo RFM, de quem sempre compra planos a quem nunca comprou nenhum.' );
$c .= sera_b_art( 'fm-rfm' );
$c .= sera_b_chapter( 3, 'O método', 'Entrevistas que cabiam na vida de quem a gente queria ouvir.' );
$c .= sera_b_p( 'Entrevistas ao vivo seriam lentas, e pouco adequadas para quem valoriza a discrição, trabalha em horários irregulares e muitas vezes tem um segundo emprego. Então desenhei um fluxo assíncrono: o time gravou as perguntas em vídeo, e cada anunciante respondeu por vídeo, áudio ou texto, quando e onde se sentisse à vontade.' );
$c .= sera_b_mock( 'fm-method' );
$c .= sera_b_p( 'Depois, as respostas passaram por um pipeline: fala transcrita em texto, uma rodada de IA para agrupar respostas parecidas, um questionário para testar os padrões em escala e clusters que cruzavam o que as pessoas diziam com o que elas faziam.' );
$c .= sera_b_art( 'fm-pipeline' );
$c .= sera_b_chapter( 4, 'Os perfis', 'Quatro jeitos de viver a mesma profissão.' );
$c .= sera_b_p( 'Cada perfil veio com seus subgrupos, rotinas, objetivos e dores, descritos a partir das pessoas que fazem parte dele. Veteranos e Leais mantêm a plataforma de pé. Malabaristas e Improvisadores são onde ela pode crescer, se conquistar a confiança deles.' );
$c .= sera_b_art( 'fm-profiles' );
$c .= sera_b_p( 'Uma pergunta simples nos contou muita coisa. Quando pedimos que contassem um dia normal, do acordar ao dormir, cada perfil descreveu um dia diferente: trabalho que engole a hora das refeições, trabalho com horário próprio, trabalho espremido entre outro emprego, ou longas horas à espera de um cliente.' );
$c .= sera_b_art( 'fm-day' );
$c .= sera_b_art( 'fm-voices' );
$c .= sera_b_p( 'Alguns achados deu para conferir com os dados da plataforma. Os Veteranos eram os que mais reclamavam de advertências e banimentos sem explicação clara, e os números batiam.' );
$c .= sera_b_art( 'fm-warnings' );
$c .= sera_b_p( 'Planos e ranking eram o ponto em que o briefing comercial e a experiência se encontravam, e nenhum perfil lia os dois do mesmo jeito. O entendimento caía dos Veteranos aos Improvisadores, e a compra caía junto. Quem comprava sem entender sentia que tinha pagado por nada.' );
$c .= sera_b_art( 'fm-plans' );
$c .= sera_b_chapter( 5, 'Além do briefing', 'As vulnerabilidades por trás de cada perfil.' );
$c .= sera_b_p( 'A pesquisa era sobre rentabilidade, mas o único padrão comum aos quatro perfis não tinha nada a ver com planos. Em todos eles, os anunciantes falaram de clientes tóxicos, golpes, limites desrespeitados e um medo constante de violência. Escolhi fechar a apresentação sobre receita com esse achado, e dei à segurança o mesmo peso dos achados comerciais.' );
$c .= sera_b_art( 'fm-common' );
$c .= sera_b_chapter( 6, 'Impacto', 'A apresentação orientou os OKRs seguintes e uma reorganização.' );
$c .= sera_b_p( 'Apresentei a pesquisa para a empresa como quatro perfis com nome, cada um contado pelas pessoas que fazem parte dele. A apresentação virou a base dos <strong>OKRs e de uma reorganização interna em torno dos anunciantes</strong> no ciclo de planejamento seguinte, com segurança, clareza e justiça pesando tanto quanto a receita.' );
$c .= sera_b_art( 'fm-impact' );
$c .= sera_b_p( 'Cada área de oportunidade nasce de algo que os anunciantes pediram. Os pedidos que ainda não dava para atender ficaram na apresentação como perguntas em aberto.' );
$c .= sera_b_art( 'fm-asks' );
$c .= sera_b_art( 'fm-next' );
$c .= sera_b_chapter( 7, 'Por que importa', 'O que esta pesquisa diz sobre como eu trabalho.' );
$c .= sera_b_art( 'fm-reflection' );
$c .= sera_b_art( 'fm-signals' );

return array(
	'title'   => 'Fatal Model: quem são os anunciantes?',
	'excerpt' => 'Uma pesquisa para aumentar a receita com os anunciantes da plataforma virou um retrato das pessoas por trás dela. Desenhei um fluxo de pesquisa assíncrono, com apoio de IA, que ouviu acompanhantes independentes em vídeo e validou os padrões com um questionário. Os achados viraram a base dos OKRs do ciclo de planejamento seguinte e de uma reorganização da Atlas Technologies em torno dos anunciantes.',
	'meta'    => array(
		'_sera_headline' => 'Fatal Model: humanizando os anunciantes por trás da plataforma, das entrevistas em vídeo aos novos OKRs',
		'_sera_year'     => '2024',
		'_sera_role'     => 'Staff Product Designer, à frente da pesquisa',
		'_sera_metrics'  => "Em vídeo | Entrevistas assíncronas, respondidas no tempo de cada pessoa\n4 perfis | Cada um com rotinas, objetivos e dores\nNovos OKRs | Uma reestruturação para atender melhor os anunciantes",
		'_sera_chips'    => 'Pesquisa de métodos mistos, Síntese com IA, Segmentação',
	),
	'content' => $c,
);
