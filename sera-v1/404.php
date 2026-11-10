<?php
/**
 * 404.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="page-plain">
	<div class="wrap">
		<span class="eyebrow">404</span>
		<h1 style="margin-top:16px"><?php sera_e( 'This page doesn’t exist.', 'Esta página não existe.' ); ?></h1>
		<p style="margin-top:20px;max-width:520px;color:var(--ink-2)"><?php sera_e( 'It may have moved. The selected work is on the home page.', 'Talvez tenha mudado de endereço. Os trabalhos selecionados estão na página inicial.' ); ?></p>
		<p style="margin-top:28px"><a class="btn btn-dark" href="<?php echo esc_url( home_url( '/#work' ) ); ?>"><?php sera_e( 'See selected work', 'Ver trabalhos selecionados' ); ?></a></p>
	</div>
</section>
<?php
get_footer();
