<?php
/**
 * Acordo Certo · homepage redesign — Portuguese version (mirrors sera_starter_cases()).
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'ac-glance' );
$c .= sera_b_chapter( 1, 'O problema', 'A home de uma plataforma de negociação de dívidas não passava segurança.' );
$c .= sera_b_p( 'A Acordo Certo ajuda brasileiros a negociar dívidas pela internet, sem passar horas no telefone. Para quem está devendo, é de graça: a empresa ganha uma porcentagem sobre cada acordo fechado na plataforma. A home e as landing pages eram o primeiro contato com o produto, e carregavam quatro problemas de uma vez.', 'lead' );
$c .= sera_b_art( 'ac-obstacles' );
$c .= sera_b_mock( 'ac-before-after' );
$c .= sera_b_chapter( 2, 'O time', 'Dupla de design: eu dava a direção, a Carolina dava forma.' );
$c .= sera_b_p( 'Na Acordo Certo, o time de design era eu e a Carolina. Eu liderava a estratégia, a pesquisa, o workshop de visão e a direção geral: o que aprender primeiro, como aprender, quem chamar para a sala e como as peças iam se encaixar. A Carolina, product designer júnior do meu time, ajudou do começo ao fim, dando forma ao visual na UI. O discovery a gente fez lado a lado.' );
$c .= sera_b_art( 'ac-duo' );
$c .= sera_b_p( 'Redesenhar a página primeiro seria chutar. Então defini a ordem do trabalho: <strong>entender o cliente, construir uma visão de produto com a empresa e só depois desenhar o layout</strong>.' );
$c .= sera_b_art( 'ac-sequence' );
$c .= sera_b_chapter( 3, 'Discovery', 'Entrevistas sobre por que as pessoas negociam uma dívida, e o que vem depois.' );
$c .= sera_b_p( 'Adaptei a entrevista de Jobs-to-be-Done ao nosso contexto, em cinco etapas que acompanham o cliente desde o primeiro pensamento sobre a dívida até a vida depois de quitá-la. Entrevistamos dois grupos que tinham fechado acordo: clientes satisfeitos e insatisfeitos.' );
$c .= sera_b_art( 'ac-jtbd' );
$c .= sera_b_p( 'As etapas antes e depois do acordo foram as que mais pesaram. Antes dele, perguntamos quando as pessoas começaram a notar as opções que tinham para limpar o nome. Depois, do que mais gostaram, do que menos gostaram e se agora conseguiam fazer algo que antes não conseguiam. As respostas quase nunca eram sobre a dívida em si.' );
$c .= sera_b_art( 'ac-voices' );
$c .= sera_b_art( 'ac-findings' );
$c .= sera_b_p( 'Depois, distribuí os achados ao longo da jornada do cliente. Cada etapa carregava um medo próprio, e a página precisava responder a ele antes que o próximo passo parecesse seguro.' );
$c .= sera_b_art( 'ac-journey' );
$c .= sera_b_chapter( 4, 'Arquétipos', 'Três arquétipos, montados a partir do que as pessoas contaram.' );
$c .= sera_b_p( 'Os rótulos que a gente tinha, promotor e detrator, devedor e pagador, não explicavam como as pessoas se comportavam. As entrevistas explicavam, então transformamos o que ouvimos em três arquétipos e num storyboard que a empresa toda podia usar para falar do cliente.' );
$c .= sera_b_art( 'ac-personas' );
$c .= sera_b_chapter( 5, 'Visão', 'Uma visão de produto escrita junto com a empresa.' );
$c .= sera_b_p( 'Com os arquétipos em mãos, conduzi um workshop de visão de produto com pessoas-chave da empresa. O ponto de partida era uma máquina do tempo: ler a matéria de jornal de amanhã sobre o nosso produto e contar o que ela diz.' );
$c .= sera_b_art( 'ac-vision' );
$c .= sera_b_chapter( 6, 'A home', 'Quatro pilares, decididos juntos.' );
$c .= sera_b_p( 'Para a home, seguimos o Double Diamond e trouxemos Marketing, Atendimento, CRO e líderes de tribo para o brainstorm. Eles conheciam as dores da página antiga melhor que ninguém e, depois de ajudar a moldar a nova, saíram defendendo a página.' );
$c .= sera_b_art( 'ac-process' );
$c .= sera_b_art( 'ac-pillars' );
$c .= sera_b_chapter( 7, 'Testes', 'Poucos usuários, três decisões que mudaram a página.' );
$c .= sera_b_art( 'ac-testing' );
$c .= sera_b_chapter( 8, 'O resultado', 'Uma página mais leve, construída sobre o nosso design system.' );
$c .= sera_b_p( 'A Carolina deu forma ao design em alta fidelidade, comigo na direção, em cima do Atlas, o design system que a gente vinha construindo. Layout limpo, formas arredondadas, uma tipografia mais amigável, uma paleta mais ampla para deixar leve um assunto pesado, ilustrações simples e o passo a passo da negociação na própria página.' );
$c .= sera_b_mock( 'acordo-certo' );
$c .= sera_b_p( 'Cada bloco da nova página veio de algo que ouvimos nas entrevistas ou vimos nos testes.' );
$c .= sera_b_art( 'ac-anatomy' );
$c .= sera_b_p( 'No celular, onde boa parte dessas negociações começa, a página abre com uma promessa só, o campo de CPF e um botão.' );
$c .= sera_b_mock( 'ac-mobile' );
$c .= sera_b_art( 'ac-system' );
$c .= sera_b_chapter( 9, 'Impacto', 'Mais conversão e novas vagas de design.' );
$c .= sera_b_art( 'ac-impact' );
$c .= sera_b_p( 'Com o mesmo sistema, também redesenhamos as páginas Sobre e Parceiros e as landing pages de parceiros.' );
$c .= sera_b_chapter( 10, 'Por que importa', 'O que este case diz sobre como eu lidero.' );
$c .= sera_b_art( 'ac-reflection' );
$c .= sera_b_art( 'ac-signals' );

return array(
	'title'   => 'Acordo Certo: redesign da home',
	'excerpt' => 'A Acordo Certo é uma plataforma de negociação de dívidas gratuita para quem está devendo, e a home dela não passava segurança. Num time de design de duas pessoas, liderei a estratégia, a pesquisa, um workshop de visão com a empresa toda e a direção geral, com a Carolina Miguel, product designer júnior do meu time, dando forma ao visual do começo ao fim. O redesign, construído sobre o nosso design system Atlas, aumentou a conversão em 15%.',
	'meta'    => array(
		'_sera_headline' => 'Acordo Certo: uma plataforma de negociação de dívidas segura o bastante para dar o primeiro passo',
		'_sera_year'     => '2021–22',
		'_sera_role'     => 'Product Design Manager, liderando uma dupla de design',
		'_sera_metrics'  => "+15% | De conversão na home e nas landing pages\n3 | Arquétipos que a empresa adotou para falar dos clientes\nAtlas | Design system construído pelo time (sem relação com a Atlas Technologies)",
		'_sera_chips'    => 'Liderança de design, Pesquisa JTBD, Design system',
	),
	'content' => $c,
);
