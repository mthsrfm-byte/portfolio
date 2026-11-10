<?php
/**
 * Fallback template (blog, archives, search). Lists titles with links.
 *
 * @package Sera
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="page-plain">
	<div class="wrap">
		<h1><?php echo esc_html( sera_index_title() ); ?></h1>
		<?php if ( have_posts() ) : ?>
			<div class="more-work">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/case-row', null, array( 'id' => get_the_ID() ) );
				endwhile;
				?>
			</div>
			<div style="margin-top:32px"><?php the_posts_pagination(); ?></div>
		<?php else : ?>
			<p style="margin-top:24px;color:var(--muted)"><?php sera_e( 'Nothing here yet.', 'Nada por aqui ainda.' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
