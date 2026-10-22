<?php
/**
 * Mockup: Paperplane · the studio tour. A sticky stage: the copy changes on the left, the desktop
 * screen fills the right and the camera pushes in on what matters in each step, with the phone
 * version of the same step in the corner. Motion: assets/js/pp-case.js (tour). Reduced motion keeps
 * the steps switching with the scroll, without the push-in.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

// desk screen, phone screen, act, title, text, callout, url, focus x, focus y (canvas px), zoom.
$steps = array(
	array( 'ideia', 'ideia', 0, 'Era uma vez uma frase.', 'A ideia entra do jeito que vier, até bagunçada. Título, duração e formato vão aparecendo enquanto a história cresce.', 'Uma frase já é o bastante', 'ideia', 520, 250, 1.55 ),
	array( 'universo', 'universo', 0, 'Todo mágico tem regras.', 'Tom, lugar e as leis que ninguém quebra. O Paperplane estuda o universo antes de escrever e ainda aponta os furos que a trama não fechou.', 'Os furos que a história ainda não fechou', 'universo', 1000, 420, 1.5 ),
	array( 'roteiro', 'roteiro', 0, 'Um parceiro de roteiro que nunca dorme.', 'Cena por cena, em formato de cinema. O Origami sugere, você decide, e ele já encontra os personagens que vão para o elenco.', 'Origami, o assistente do estúdio', 'roteiro', 1010, 420, 1.45 ),
	array( 'estilo', 'estilo', 1, 'O mesmo traço, do primeiro ao último quadro.', 'Das referências saem regras de traço, proporção, acabamento e paleta. Elas entram em todo pedido de imagem, sem ninguém precisar lembrar.', 'Regras e paleta tiradas das referências', 'estilo', 420, 330, 1.45 ),
	array( 'personagem', 'elenco', 1, 'Um elenco que não muda de cara.', 'Ficha em quatro vistas, figurino fixo e voz própria. Na cena 1 ou na cena 80, o Ren continua sendo o Ren.', 'Frente, três quartos, perfil e costas', 'personagens/ren', 620, 380, 1.3 ),
	array( 'cenarios', 'cenarios', 1, 'Lugares que existem de verdade.', 'Cada cenário nasce de uma vista de frente. Quer ver de outro lado? Gire a câmera no mapa e o lugar vira junto.', 'Escolha de onde a câmera olha', 'cenarios', 640, 330, 1.35 ),
	array( 'decupagem', 'decupagem', 1, 'Pense como diretor. Ou peça ajuda.', 'A decupagem quebra a cena em tomadas e escolhe plano, altura e movimento, explicando o porquê. A palavra final é sempre de quem dirige.', 'Plano escolhido pela IA, com o motivo', 'decupagem', 560, 470, 1.4 ),
	array( 'storyboard', 'storyboard', 1, 'O filme, antes do filme.', 'Um quadro por tomada, com elenco, cenário e plano no lugar. Imagem custa centavos e vídeo custa dólares, então é aqui que se aprova.', 'Aprove aqui, anime depois', 'storyboard', 560, 470, 1.3 ),
	array( 'animacao', 'animacao', 2, 'E… ação!', 'O quadro aprovado vira o primeiro frame. Conte o que se move, escolha a duração e o modelo, e a fala sai na voz do próprio personagem.', 'O que se move nesta tomada', 'animacao', 600, 300, 1.35 ),
	array( 'montagem', 'montagem', 2, 'Abracadabra. Seu filme, em até 4K.', 'Linha do tempo com vídeo, efeitos, falas e trilha. O episódio sai em 1080p nativo, com upscale até 4K sem sair do projeto.', 'Vídeo, efeitos, falas e trilha juntos', 'montagem', 760, 560, 1.25 ),
);
$acts  = array( 'Escrever', 'Visualizar', 'Filmar' );
$total = count( $steps );
?>
<div class="pp-tour" data-pp-tour style="--n:<?php echo (int) $total; ?>">
	<div class="pp-tour-sticky">
		<div class="pp-tour-copy">
			<div class="pp-tour-acts" aria-hidden="true">
				<?php foreach ( $acts as $ai => $a ) : ?>
					<span data-act="<?php echo (int) $ai; ?>"><b><?php echo esc_html( 'Ato ' . ( $ai + 1 ) ); ?></b><?php echo esc_html( $a ); ?></span>
				<?php endforeach; ?>
			</div>
			<div class="pp-tour-segs" aria-hidden="true">
				<?php foreach ( $steps as $i => $s ) : ?>
					<i data-act="<?php echo (int) $s[2]; ?>"<?php echo 7 === $i ? ' class="is-gate"' : ''; ?>><b></b></i>
				<?php endforeach; ?>
			</div>
			<ol class="pp-tour-txt">
				<?php foreach ( $steps as $i => $s ) : ?>
					<li class="pp-tour-t<?php echo 0 === $i ? ' is-on' : ''; ?>">
						<span class="pp-tour-n"><?php printf( '%02d / %02d · %s', $i + 1, $total, esc_html( $acts[ $s[2] ] ) ); ?></span>
						<h3><?php echo esc_html( $s[3] ); ?></h3>
						<p><?php echo esc_html( $s[4] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
		<div class="pp-tour-stage">
			<div class="pp-tour-win">
				<div class="pp-tour-bar" aria-hidden="true"><span class="pp-tour-dots"><i></i><i></i><i></i></span><span class="pp-tour-url">paperplane.studio/<b><?php echo esc_html( $steps[0][6] ); ?></b></span></div>
				<div class="pp-tour-screen">
					<?php foreach ( $steps as $i => $s ) : ?>
						<div class="pp-tour-scr<?php echo 0 === $i ? ' is-on' : ''; ?>" data-url="<?php echo esc_attr( $s[6] ); ?>" data-f="<?php echo (int) $s[7] . ',' . (int) $s[8]; ?>" data-z="<?php echo esc_attr( $s[9] ); ?>" data-call="<?php echo esc_attr( $s[5] ); ?>" role="img" aria-label="<?php echo esc_attr( 'Paperplane no computador: ' . $s[3] ); ?>">
							<div class="pp-tour-cam"><?php echo sera_pp_desk( $s[0] ); // phpcs:ignore ?></div>
						</div>
					<?php endforeach; ?>
					<div class="pp-tour-call" aria-hidden="true"><i><?php echo sera_pp_tsuru(); // phpcs:ignore ?></i><span><?php echo esc_html( $steps[0][5] ); ?></span></div>
				</div>
			</div>
			<div class="pp-tour-phone" aria-hidden="true">
				<?php
				$ph = '';
				foreach ( $steps as $i => $s ) {
					$ph .= '<div class="pp-tour-ph' . ( 0 === $i ? ' is-on' : '' ) . '">' . sera_pp_phone( $s[1] ) . '</div>';
				}
				echo sera_device( 'ppx-screen pp-tour-pscreen', $ph ); // phpcs:ignore
				?>
			</div>
		</div>
	</div>
</div>
