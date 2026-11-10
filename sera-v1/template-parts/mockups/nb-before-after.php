<?php
/**
 * Mockup: Bastidores — 2022 homepage × 2026 homepage, full length.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="ac-compare nb-compare mk-anim mk-compare">
	<div class="col">
		<span class="ba-tag"><?php sera_e( 'Before · 2022', 'Antes · 2022' ); ?></span>
		<?php echo sera_browser( sera_scr_nb_before(), array( 'url' => 'nosbastidores.com.br', 'label' => sera_t( 'The 2022 homepage', 'A home de 2022' ), 'caption' => sera_t( 'September 2022, as archived by the Wayback Machine: a stock theme, uppercase everywhere, three menus competing for attention and no planned place for ads.', 'Setembro de 2022, como ficou arquivada na Wayback Machine: tema pronto, caixa-alta em tudo, três menus disputando atenção e nenhum lugar planejado para anúncios.' ) ) ); // phpcs:ignore ?>
	</div>
	<div class="col">
		<span class="ba-tag new"><?php sera_e( 'After · 2026', 'Depois · 2026' ); ?></span>
		<?php echo sera_browser( sera_scr_nb_after(), array( 'url' => 'nosbastidores.com.br', 'label' => sera_t( 'The 2026 homepage', 'A home de 2026' ), 'caption' => sera_t( 'The redesign: an editorial identity, reviews as the front door, a clear hierarchy, and ad slots designed into the layout.', 'O redesign: identidade editorial, críticas como porta de entrada, hierarquia clara e espaços de anúncio desenhados no layout.' ) ) ); // phpcs:ignore ?>
	</div>
</div>
