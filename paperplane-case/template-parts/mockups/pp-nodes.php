<?php
/**
 * Mockup: Paperplane · storyboard, advanced mode, in motion. The references wire into the request of
 * take 3F, the request types itself, three takes grow side by side and one gets approved.
 * Motion: assets/js/pp-case.js (nodes), on the same cursor and step chips as the lab demos.
 * Reduced motion shows the finished tree.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

$refs  = array(
	array( 'Estilo do projeto', 'cel-1', '50% 50%', 108 ),
	array( 'Personagem · Lia', 'sb-b', '40% 20%', 258 ),
	array( 'Cenário · vagão', 'loc-vagao', '50% 50%', 408 ),
	array( 'Quadro anterior · 3E', 'sb-i', '50% 40%', 558 ),
);
$takes = array(
	array( '1.0', 'c-c2a7bb59', 800, 78, 'Nano Banana 2.1', '8841', 'US$ 0,03' ),
	array( '1.1', 'v-mesa', 800, 420, 'FLUX.2', '1907', 'US$ 0,04' ),
	array( '1.2', 'v-mesa-f0', 1046, 250, 'FLUX.2', '2210', 'US$ 0,04' ),
);
?>
<div class="pp-nodes" data-pp-nodes>
	<div class="pp-nodes-head">
		<div class="lx-steps mono" id="ndSteps"><span>Referências</span><span>Pedido</span><span>Takes</span><span>Aprovar</span></div>
		<span class="pp-nodes-hint">Clique numa etapa para rever</span>
	</div>
	<div class="ppl"><div class="lx-stage pp-nodes-stage"><div class="lx-canvas pp-nd" id="ndCv">
		<div class="lx-win">
			<div class="lx-bar"><i></i><i></i><i></i><span>paperplane.studio/storyboard · modo avançado</span></div>
			<div class="pp-nd-top"><b>Storyboard</b><span class="pp-nd-chip">Modo avançado</span><span class="pp-nd-chip">Cena 3 de 8 · Mesa 4</span><span class="pp-nd-chip is-ink">Tomada 3F</span><span class="pp-nd-sum" id="ndSum">0 takes</span></div>
			<svg class="pp-nd-wires" viewBox="0 0 1280 760" aria-hidden="true">
				<?php foreach ( $refs as $i => $r ) : ?>
					<path class="w-ref" style="--i:<?php echo (int) $i; ?>" d="M226 <?php echo (int) ( $r[3] + 66 ); ?> C 300 <?php echo (int) ( $r[3] + 66 ); ?>, 300 <?php echo (int) ( 300 + $i * 34 ); ?>, 372 <?php echo (int) ( 300 + $i * 34 ); ?>"/>
				<?php endforeach; ?>
				<path class="w-take" data-t="0" d="M732 360 C 770 360, 760 150, 800 150"/>
				<path class="w-take" data-t="1" d="M732 380 C 770 380, 760 490, 800 490"/>
				<path class="w-take" data-t="2" d="M1010 150 C 1030 150, 1020 320, 1046 320"/>
			</svg>
			<?php foreach ( $refs as $i => $r ) : ?>
				<div class="pp-nd-node pp-nd-ref" style="left:36px;top:<?php echo (int) $r[3]; ?>px;--i:<?php echo (int) $i; ?>">
					<span class="pp-nd-l"><?php echo esc_html( $r[0] ); ?></span>
					<?php echo sera_pp_frame( $r[1], 'height:94px', $r[2] ); // phpcs:ignore ?>
				</div>
			<?php endforeach; ?>
			<div class="pp-nd-node pp-nd-req" id="ndReq">
				<div class="pp-nd-h"><b>Pedido</b><span class="pp-nd-chip is-ink">3F</span></div>
				<div class="pp-nd-chips"><span>Plano médio</span><span>6 s</span><span>Câmera parada</span></div>
				<div class="pp-nd-prompt"><span id="ndPrompt" data-full="Trem freia, Lia é jogada contra Dante. Plano médio, câmera parada. Luz dourada das arandelas, sombras azuladas da janela. Lia de colete cinza e avental; Dante de terno escuro. Dante NÃO está de chapéu. O condutor NÃO está no quadro.">Trem freia, Lia é jogada contra Dante. Plano médio, câmera parada. Luz dourada das arandelas, sombras azuladas da janela. Lia de colete cinza e avental; Dante de terno escuro. Dante NÃO está de chapéu. O condutor NÃO está no quadro.</span><i class="pp-nd-caret"></i></div>
				<div class="pp-nd-pt"><span class="pp-nd-l">Em português · só para você ler</span>O trem freia, Lia é jogada contra Dante.</div>
				<span class="pp-nd-new" id="ndNew">Novo take · US$ 0,04</span>
			</div>
			<?php foreach ( $takes as $i => $t ) : ?>
				<div class="pp-nd-node pp-nd-take" data-t="<?php echo (int) $i; ?>" style="left:<?php echo (int) $t[2]; ?>px;top:<?php echo (int) $t[3]; ?>px">
					<div class="pp-nd-h"><b>Take #<?php echo esc_html( $t[0] ); ?></b><span class="pp-nd-tag">Em revisão</span></div>
					<div class="pp-nd-img"><?php echo sera_pp_frame( $t[1], 'height:118px' ); // phpcs:ignore ?><i class="pp-nd-load"></i></div>
					<div class="pp-nd-meta"><span>Modelo</span><b><?php echo esc_html( $t[4] ); ?></b><span>Seed</span><b><?php echo esc_html( $t[5] ); ?></b><span>Custo</span><b><?php echo esc_html( $t[6] ); ?></b></div>
					<div class="pp-nd-acts"><span class="pp-nd-btn">Comparar</span><span class="pp-nd-btn is-lime">Aprovar</span></div>
				</div>
			<?php endforeach; ?>
			<div class="lx-toast" id="ndToast">✓ Take #1.2 aprovado · segue para a animação</div>
		</div>
		<div class="lx-cur" id="ndCur"><svg viewBox="0 0 24 24"><path d="M5 3l14 8-6 1.6L10 19z" fill="#1A1A1A" stroke="#fff" stroke-width="1.4" stroke-linejoin="round"/></svg></div>
	</div></div></div>
</div>
