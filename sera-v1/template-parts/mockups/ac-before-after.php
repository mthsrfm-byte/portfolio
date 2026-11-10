<?php
/**
 * Mockup: Acordo Certo — old homepage × new homepage, full length.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="ac-compare mk-anim mk-compare">
	<div class="col">
		<span class="ba-tag"><?php sera_e( 'Before', 'Antes' ); ?></span>
		<?php echo sera_browser( sera_scr_ac_before(), array( 'label' => sera_t( 'The old homepage', 'A home antiga' ), 'caption' => sera_t( 'The old homepage: one blue, stock imagery, competing messages and no system behind the components.', 'A home antiga: um azul só, fotos de banco de imagem, mensagens disputando atenção e nenhum sistema por trás dos componentes.' ) ) ); // phpcs:ignore ?>
	</div>
	<div class="col">
		<span class="ba-tag new"><?php sera_e( 'After', 'Depois' ); ?></span>
		<?php echo sera_browser( sera_scr_ac_after(), array( 'label' => sera_t( 'The new homepage', 'A nova home' ), 'caption' => sera_t( 'The new homepage, built on Atlas: real people, one clear action, proof and a visible process. Photos replaced by placeholders.', 'A nova home, construída no Atlas: gente de verdade, uma ação clara, prova e um processo à vista. Fotos substituídas por placeholders.' ) ) ); // phpcs:ignore ?>
	</div>
</div>
