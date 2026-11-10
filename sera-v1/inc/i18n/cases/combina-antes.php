<?php
/**
 * Combina Antes (Pagaleve) — Brazilian Portuguese version.
 * Mirrors the English builder in inc/starter-content.php block by block.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'pg-glance' );
$c .= sera_b_chapter( 1, 'O problema', 'A multa entrava como receita, mas boa parte desse dinheiro nunca chegava.' );
$c .= sera_b_p( 'No compre agora, pague depois, uma parcela não paga gera multa, e na planilha multa parece receita. Os dados mostravam que boa parte dessa multa nunca é recebida, e o principal que não volta pesa mais do que tudo o que as multas trazem.', 'lead' );
$c .= sera_b_p( 'Um atraso também costuma puxar o próximo.' );
$c .= sera_b_art( 'pg-stats' );
$c .= sera_b_chapter( 2, 'O lado do cliente', 'Entre o “não vou conseguir pagar” e o “estou atrasado”, o cliente não tinha opção no app.' );
$c .= sera_b_p( 'O cliente costuma saber com dias de antecedência que um pagamento não vai fechar. A saída que existia, a renegociação, foi pensada para quem já está na cobrança: só abre depois do atraso, pede entrada e tem um valor mínimo que muita gente com uma única parcela vencida nem alcança. Isso desgastava a relação justo quando o cliente precisava de ajuda, e a multa por atraso estava entre as reclamações mais comuns nas avaliações do app.' );
$c .= sera_b_art( 'pg-gap' );
$c .= sera_b_p( 'O tempo virou a restrição de design. Cada semana a mais de atraso deixa o dinheiro muito mais difícil de recuperar. Por isso o acordo é curto de propósito: poucos dias, sem nunca passar do dia em que a parcela vai para negativação.' );
$c .= sera_b_art( 'pg-window' );
$c .= sera_b_chapter( 3, 'A ideia', 'Deixar o cliente combinar uma nova data antes do vencimento.' );
$c .= sera_b_p( 'Nosso squad escolheu essa ideia no hackathon de 2026. Meu trabalho era transformá-la em algo que funcionasse para o cliente, para o crédito e para o P&amp;L ao mesmo tempo. O produto em si tinha que ser bem simples: um aviso, uma nova data e o pagamento.' );
$c .= sera_b_art( 'pg-steps' );
$c .= sera_b_mock( 'pagaleve-flow' );
$c .= sera_b_p( 'Desenhei cada tela para que <strong>o cliente nunca seja surpreendido por um número ou por uma regra</strong>.' );
$c .= sera_b_art( 'pg-decisions' );
$c .= sera_b_chapter( 4, 'A parte difícil', 'Mostrar a oferta para todo mundo ia comer a receita de multas.' );
$c .= sera_b_p( 'A liderança levantou uma objeção justa: se todo mundo tem o botão, todo mundo clica, inclusive quem pagaria só um dia atrasado de qualquer jeito. Aceitamos a objeção e desenhamos em torno dela.' );
$c .= sera_b_art( 'pg-economics' );
$c .= sera_b_chapter( 5, 'O sistema', 'A IA decide quem vê a oferta, e o crédito fica com a decisão.' );
$c .= sera_b_p( 'O engenheiro do squad estava preocupado, com razão, que a gente estivesse abraçando coisa demais para um MVP e pisando no terreno do time de Risco. Então tracei uma linha firme. O orquestrador decide só a <strong>exposição, ou seja, quem vê o botão e quem recebe um aviso</strong>. Se a pessoa pode mesmo adiar, por quanto tempo e a que preço continua com o motor de crédito, na hora do clique. Foi essa linha que fez a ideia sair do papel, e é a parte deste case de que mais me orgulho.' );
$c .= sera_b_art( 'pg-orchestrator' );
$c .= sera_b_p( 'Perguntaram se isso precisava mesmo de IA. A regra é simples e auditável de propósito. Os agentes decidem a exposição com um motivo por escrito e recalibram a regra contra o grupo de controle toda semana. No clique, as duas camadas passam o bastão sem atrito, e todo caminho termina num lugar que o cliente já conhece. Se o crédito diz não, o app mostra “oferta indisponível no momento”. Se o acordo não é cumprido, volta a valer o vencimento original. Um modelo preditivo para chegar ao cliente antes da primeira parcela em atraso fica como refinamento futuro, sempre por meio de propostas aprovadas.' );
$c .= sera_b_art( 'pg-paths' );
$c .= sera_b_chapter( 6, 'O resultado', 'Do pitch ao piloto, e do piloto à produção.' );
$c .= sera_b_p( 'Antes do pitch, o squad testou a demanda com um e-mail de fake door. Uma amostra de clientes com parcela perto de vencer recebeu uma mensagem oferecendo a escolha de uma nova data, e o botão levava a um formulário curto, não a um produto. O teste media se as pessoas iriam atrás da oferta antes do vencimento, sem nenhuma multa empurrando. Gente suficiente foi para mostrar que a demanda era real, e a conversa com a liderança começou pelo que os clientes tinham feito.' );
$c .= sera_b_p( 'Levamos a proposta para a liderança como piloto: uma fatia pequena da base, um grupo de controle em cada público e algumas semanas para trocar nossas estimativas por números medidos. A ideia foi implementada e hoje está em produção. Segui no produto durante a implementação, como dono do fluxo até ele ir para o ar.' );
$c .= sera_b_art( 'pg-pilot' );
$c .= sera_b_art( 'pg-impact' );
$c .= sera_b_chapter( 7, 'Por que importa', 'O que este case diz sobre como eu trabalho.' );
$c .= sera_b_art( 'pg-reflection' );
$c .= sera_b_art( 'pg-signals' );

return array(
	'title'   => 'Combina Antes: uma nova data antes do atraso',
	'excerpt' => 'O cliente sabia com dias de antecedência que não ia conseguir pagar, e o app não tinha nada a oferecer até a multa chegar. Desenhamos um jeito de combinar uma nova data de vencimento antes, com agentes de IA decidindo quem vê a oferta para ela não comer a receita de multas. Começou como pitch de hackathon e hoje está em produção.',
	'meta'    => array(
		'_sera_headline' => 'Combina Antes: o cliente remarca o pagamento antes de atrasar',
		'_sera_year'     => '2026',
		'_sera_role'     => 'Product Designer Especialista, squad do hackathon',
		'_sera_metrics'  => "0→1 | Da ideia de hackathon a um produto lançado\n2 agentes de IA | Escolhem quem vê a oferta e recalibram toda semana vs. controle\nNo ar | Implementado depois do pitch para a liderança",
		'_sera_chips'    => 'BNPL, Orquestração com IA, Crédito e cobrança',
	),
	'content' => $c,
);
