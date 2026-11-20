<?php
/**
 * Mockup: Acordo Certo — old homepage × new homepage, full length.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="ac-compare ba-sync mk-anim mk-compare">
	<div class="ba-tabs" role="tablist" aria-label="<?php echo esc_attr( sera_t( 'Compare homepages', 'Comparar homes' ) ); ?>">
		<button type="button" role="tab" class="ba-tab" data-ba="0" aria-selected="false"><?php sera_e( 'Before', 'Antes' ); ?></button>
		<button type="button" role="tab" class="ba-tab is-on" data-ba="1" aria-selected="true"><?php sera_e( 'After', 'Depois' ); ?></button>
	</div>
	<p class="ba-hint"><?php sera_e( 'Scroll inside each page to see it whole', 'Role dentro de cada página para ver inteira' ); ?></p>
	<div class="col" data-ba-col="0">
		<span class="ba-tag"><?php sera_e( 'Before', 'Antes' ); ?></span>
		<?php echo sera_browser( sera_scr_ac_before(), array( 'label' => sera_t( 'The old homepage', 'A home antiga' ), 'caption' => sera_t( 'The old homepage: one blue, stock imagery, competing messages and no system behind the components.', 'A home antiga: um azul só, fotos de banco de imagem, mensagens disputando atenção e nenhum sistema por trás dos componentes.' ) ) ); // phpcs:ignore ?>
	</div>
	<div class="col is-on" data-ba-col="1">
		<span class="ba-tag new"><?php sera_e( 'After', 'Depois' ); ?></span>
		<?php echo sera_browser( sera_scr_ac_after(), array( 'label' => sera_t( 'The new homepage', 'A nova home' ), 'caption' => sera_t( 'The new homepage, built on Atlas: real people, one clear action, proof and a visible process. Photos replaced by placeholders.', 'A nova home, construída no Atlas: gente de verdade, uma ação clara, prova e um processo à vista. Fotos substituídas por placeholders.' ) ) ); // phpcs:ignore ?>
	</div>
</div>
