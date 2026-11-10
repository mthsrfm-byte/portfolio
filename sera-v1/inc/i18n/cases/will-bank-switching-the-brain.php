<?php
/**
 * will bank · trocando o cérebro — versão em português (/pt/).
 * Espelha, bloco a bloco, o builder em inglês de inc/starter-content.php.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$c  = sera_b_art( 'wb-glance' );
$c .= sera_b_chapter( 1, 'Contexto', 'O nosso cartão de crédito rodava num processador terceirizado.' );
$c .= sera_b_p( 'O will bank usava um processador terceirizado para orquestrar todas as operações do cartão de crédito. Isso deu velocidade para chegar ao mercado, mas também trouxe instabilidade em tarefas muito básicas e uma taxa de aprovação de transações abaixo da dos principais concorrentes.', 'lead' );
$c .= sera_b_art( 'wb-stakes' );
$c .= sera_b_p( 'Trocar o processador inteiro seria um trabalho grande demais, então o time decidiu internalizar a parte que mais dava problema, o autorizador. No papel, era um projeto de infraestrutura, sem nada que o cliente fosse ver.' );
$c .= sera_b_art( 'wb-statement' );
$c .= sera_b_p( 'Além da taxa de aprovação, o time via no autorizador um jeito de aumentar a satisfação dos clientes e a nossa competitividade. Para encontrar essas melhorias, o trabalho rodou em seis etapas, cada uma somando uma perspectiva antes de qualquer coisa chegar ao backlog.' );
$c .= sera_b_art( 'wb-process' );
$c .= sera_b_chapter( 2, 'Discovery', 'Li os chamados primeiro, depois entrevistei clientes.' );
$c .= sera_b_p( 'Usei um LLM para classificar as transcrições de chat por causa e medir quanto o cérebro antigo nos custava em operação. Depois entrevistei clientes que tinham aberto chamados, para entender o que aqueles tickets significavam na vida deles.' );
$c .= sera_b_art( 'wb-quotes' );
$c .= sera_b_art( 'wb-pains' );
$c .= sera_b_p( 'Para quem faz as contas até o último centavo, <strong>uma fatura que muda depois que o dinheiro já foi separado é motivo para largar o cartão</strong>.' );
$c .= sera_b_p( 'Nas entrevistas, os clientes descreviam a fatura como o orçamento deles, e não só a do mês. Eles olham as faturas pagas para entender o que gastaram, conferem a aberta para separar o dinheiro e contam as parcelas dos próximos meses antes de comprar de novo. O cliente pensa a fatura no tempo, e o nosso cartão mostrava só o presente.' );
$c .= sera_b_p( 'Pior: nem o presente era confiável. Compras ainda em processamento não entravam na fatura aberta, e parcelas de meses anteriores só apareciam depois que a fatura já tinha aberto.' );
$c .= sera_b_art( 'wb-bill-model' );
$c .= sera_b_chapter( 3, 'Mercado e ideias', 'Comparamos o nosso cartão com o que o mercado já oferece.' );
$c .= sera_b_p( 'Com a Mastercard, mapeamos o que se espera de todo cartão no Brasil, e fomos atrás do que faltava no nosso.' );
$c .= sera_b_art( 'wb-framework' );
$c .= sera_b_p( 'Do workshop saiu um norte que batizamos de Controle Temporal: o cliente precisava ver o passado, o presente e o futuro da fatura, e conseguir agir sobre eles. A ordem também ficou clara ali. Ninguém planeja os próximos meses em cima de uma fatura que muda, então o presente vinha primeiro.' );
$c .= sera_b_art( 'wb-next' );
$c .= sera_b_chapter( 4, 'O presente', 'Primeiro, uma fatura aberta em que dava para confiar.' );
$c .= sera_b_p( 'Fiz protótipos de baixa fidelidade para refinar a solução com a engenharia, já que tudo dependia do que o novo autorizador conseguia fazer. As versões em alta fidelidade foram para testes de usabilidade com clientes, para reduzir o risco de implementação antes de qualquer linha de código.' );
$c .= sera_b_mock( 'will-bank-detail' );
$c .= sera_b_art( 'wb-before-after' );
$c .= sera_b_p( 'A segunda funcionalidade saiu direto dos “Básicos Impecáveis” da Mastercard. Nem todo cartão no Brasil abre a fatura já com todas as parcelas dos meses anteriores, então fechar a nossa lacuna também nos deu um diferencial.' );
$c .= sera_b_chapter( 5, 'Passado e futuro', 'Depois, o resto do tempo da fatura.' );
$c .= sera_b_p( 'Com o autorizador interno, o banco passou a saber em tempo real o que cai em cada fatura, inclusive nas que ainda nem abriram. Foi isso que tornou possível o resto do Controle Temporal, em três frentes que desenhei com o time.', 'lead' );
$c .= sera_b_p( '<strong>Faturas no tempo.</strong> Uma linha do tempo de meses abre a área de faturas. As pagas ficam em segundo plano, a aberta em destaque e as previstas logo depois, cada uma já com o seu valor. Tocar num mês mostra o que está nele, inclusive as parcelas que ainda vão cair. Quem antes precisava de planilha para se planejar passou a ver os próximos meses no app.' );
$c .= sera_b_mock( 'will-bank-bills' );
$c .= sera_b_p( '<strong>Antecipar parcelas com desconto.</strong> Era uma das cinco dores da pesquisa. Na fatura prevista, a pessoa escolhe quais parcelas futuras quer pagar agora, e quanto mais distante a parcela, maior o desconto nos juros. Antes de confirmar, ela vê quanto economiza e em qual fatura o valor entra. Pagando com Pix, o limite volta no mesmo instante, porque agora a autorização é nossa.' );
$c .= sera_b_mock( 'will-bank-advance' );
$c .= sera_b_p( '<strong>Planejar antes de comprar.</strong> A última frente olha para a próxima compra. A simulação mostra como cada fatura futura fica com a compra nova, e o calendário explica o ciclo da fatura sem jargão: quando fecha, qual é o melhor dia de compra e quando vence. Ao mudar o vencimento, cada dia já mostra qual passa a ser o melhor dia de compra.' );
$c .= sera_b_mock( 'will-bank-plan' );
$c .= sera_b_p( 'Na época, nem todo banco no Brasil dava esse controle no app. Faturas futuras completas, antecipação com desconto em poucos toques e limite liberado na hora viraram diferenciais do nosso cartão, todos saídos de um projeto que começou como infraestrutura.' );
$c .= sera_b_art( 'wb-lessons' );
$c .= sera_b_chapter( 6, 'Impacto', 'Medido contra um grupo de controle.' );
$c .= sera_b_p( 'As entregas foram para um rollout controlado, com o grupo de teste comparado a um grupo de controle. Também trabalhei com outros times para que eles usassem o novo autorizador em produtos do próprio escopo.' );
$c .= sera_b_art( 'wb-impact' );
$c .= sera_b_chapter( 7, 'Por que importa', 'O que este case diz sobre como eu trabalho.' );
$c .= sera_b_art( 'wb-reflection' );
$c .= sera_b_art( 'wb-signals' );

return array(
	'title'   => 'will bank: trocando o cérebro',
	'excerpt' => 'Uma migração de back-end parecia só trabalho de infraestrutura. Dados de contato e entrevistas mostraram que o cliente planeja a vida pela fatura, olhando para trás e para a frente, e o sistema antigo não deixava. Usamos o novo autorizador para devolver esse controle do tempo: fatura aberta em tempo real, faturas passadas e futuras no app, antecipação de parcelas com desconto e planejamento antes da compra.',
	'meta'    => array(
		'_sera_headline' => 'Trocando o cérebro: como a migração do autorizador devolveu ao cliente o controle do tempo da fatura',
		'_sera_year'     => '2023',
		'_sera_role'     => 'Staff Product Designer, Cartão de Crédito',
		'_sera_metrics'  => "A/B | Lançado contra um grupo de controle\nCSAT & NPS ↑ | Maiores no grupo de teste do que no de controle\nContatos ↓ | Menos chamados no grupo de teste",
		'_sera_chips'    => 'Cartão de crédito, Estratégia de produto, Controle Temporal',
	),
	'content' => $c,
);
