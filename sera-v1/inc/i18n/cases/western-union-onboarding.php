<?php
/**
 * Western Union · onboarding da conta digital — versão em português (/pt/).
 * Espelha, bloco a bloco, o builder em inglês de inc/starter-content.php.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'wu-glance' );
$c .= sera_b_chapter( 1, 'Contexto', 'A maioria vinha sacar um dinheiro que já estava esperando.' );
$c .= sera_b_p( 'A conta digital da Western Union no Brasil atende imigrantes e suas famílias: Pix, pagamento de contas e o essencial de um banco. O cenário mais comum é alguém que já tem dinheiro esperando para ser recebido e precisa sacar com urgência, antes mesmo de ter uma conta.', 'lead' );
$c .= sera_b_p( 'A métrica principal também era o OKR: a parcela de pessoas que terminam o onboarding, do KYC (a verificação de identidade, o “conheça seu cliente”) até a conta aberta. O principal gargalo também era claro: <strong>os documentos enviados estavam sendo recusados</strong>. Cada cliente que a gente perdia nessa etapa já tinha decidido abrir a conta.' );
$c .= sera_b_chapter( 2, 'Restrições', 'Sem orçamento, sem fornecedor, um time pequeno e Compliance em cada etapa.' );
$c .= sera_b_art( 'wu-constraints' );
$c .= sera_b_chapter( 3, 'A tese', 'Fazer o documento passar na primeira tentativa.' );
$c .= sera_b_p( 'Gente demais precisava de mais de uma tentativa para fazer um documento passar. Em vez de chutar, cruzei três fontes que a gente já tinha à mão.' );
$c .= sera_b_art( 'wu-triangle' );
$c .= sera_b_p( 'As lojas nos deram as palavras dos próprios clientes. É para lá que eles vão quando algo dá errado, e a equipe ouve as mesmas frases todos os dias.' );
$c .= sera_b_art( 'wu-voices' );
$c .= sera_b_chapter( 4, 'A auditoria', 'Separei as fotos recusadas por motivo de recusa.' );
$c .= sera_b_p( 'Pedi o lote de documentos recusados e categorizei cada motivo de recusa e cada padrão de erro. Um padrão respondia pela maioria delas.' );
$c .= sera_b_art( 'wu-audit' );
$c .= sera_b_p( 'A tela de erro que o cliente via só piorava as coisas. Ela aparecia depois que a foto já tinha sido recusada, e falava do plástico e da legibilidade, nunca do verso do documento. O produto explicava um problema que quase ninguém tinha.' );
$c .= sera_b_art( 'wu-error-screen' );
$c .= sera_b_art( 'wu-statement' );
$c .= sera_b_p( 'Sucesso significava três coisas: mais envios corretos de frente e verso, menos recusas por erros simples e mais conversão sem aumentar o risco de fraude.' );
$c .= sera_b_chapter( 5, 'O redesign', 'Dividi a etapa do documento em duas e deixei o verso visualmente diferente.' );
$c .= sera_b_p( 'O fluxo antigo pedia, numa única etapa, “uma foto da frente e uma do verso”, na mesma tela. Era a quinta de cinco etapas, com um quadro de “Importante” denso e fácil de pular. O novo fluxo separa frente e verso, dá a cada lado as suas próprias instruções e coloca o verso num fundo visualmente diferente.' );
$c .= sera_b_mock( 'wu-before-after' );
$c .= sera_b_p( 'Decisões menores em volta dessa mudança cuidaram do resto da ambiguidade e das etapas que só criavam atrito.' );
$c .= sera_b_mock( 'wu-solutions' );
$c .= sera_b_art( 'wu-solutions' );
$c .= sera_b_p( 'Cada uma dessas decisões responde a uma das causas que a auditoria encontrou, e todas foram julgadas pelos mesmos três critérios.' );
$c .= sera_b_art( 'wu-diagnosis' );
$c .= sera_b_p( 'A quinta decisão mudou o formato do funil. A maioria dos clientes vinha para receber dinheiro, mas o caminho até a conta também pedia ocupação, renda estimada, origem dos recursos e um segundo bloco de dados do documento, tudo exigido apenas para quem envia dinheiro ao exterior. Com Compliance e a liderança LATAM, esses dados foram para trás de uma escolha, “completar agora ou depois”, e pararam de travar a abertura da conta.' );
$c .= sera_b_art( 'wu-journey' );
$c .= sera_b_chapter( 6, 'Testes', 'Testamos os protótipos com clientes nas lojas.' );
$c .= sera_b_art( 'wu-testing' );
$c .= sera_b_chapter( 7, 'Entrega', 'O primeiro release derrubou a conversão, e o segundo chegou ao recorde.' );
$c .= sera_b_p( 'O primeiro release derrubou a conversão do onboarding. Tratei como incidente. Achamos as causas rápido, corrigimos e lançamos de novo.' );
$c .= sera_b_art( 'wu-release' );
$c .= sera_b_chapter( 8, 'Impacto', 'Um ganho de dois dígitos na conversão e um mês recorde.' );
$c .= sera_b_art( 'wu-impact' );
$c .= sera_b_p( 'Com esses resultados, a empresa aprovou orçamento para um fornecedor de verificação de identidade, para melhorar a autenticação.' );
$c .= sera_b_chapter( 9, 'Olhando para trás', 'O que eu manteria, e o que eu mudaria.' );
$c .= sera_b_art( 'wu-reflection' );
$c .= sera_b_chapter( 10, 'Por que importa', 'O que este case diz sobre como eu trabalho.' );
$c .= sera_b_art( 'wu-signals' );

return array(
	'title'   => 'Western Union: onboarding da conta digital',
	'excerpt' => 'Sem orçamento de pesquisa, sem fornecedor de OCR, um time de engenharia pequeno e Compliance revisando cada mudança. Uma auditoria dos documentos recusados mostrou que as pessoas mandavam a frente do RG duas vezes. O redesign evitou esse erro, e os resultados garantiram orçamento para um fornecedor de verificação de identidade.',
	'meta'    => array(
		'_sera_headline' => 'Western Union: consertando um onboarding em que a maioria das recusas vinha de uma única etapa ambígua',
		'_sera_year'     => '2025–26',
		'_sera_role'     => 'Product Designer Especialista, atuando como Designer + PO',
		'_sera_metrics'  => "Dois dígitos | De ganho na conversão do onboarding, até um recorde histórico\nMenos | Reenvios de documento, muito mais perto de uma tentativa só\n~2 min | A menos no funil, com etapas movidas para depois do onboarding",
		'_sera_chips'    => 'Onboarding, Pesquisa enxuta, Compliance',
	),
	'content' => $c,
);
