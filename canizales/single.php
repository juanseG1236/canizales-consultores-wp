<?php
/**
 * Artículo individual.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	canizales_page_hero( get_the_title(), has_excerpt() ? get_the_excerpt() : '', wp_strip_all_tags( get_the_date() ) );
	?>
	<article <?php post_class( 'section section--content' ); ?>>
		<div class="container">
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-figure"><?php the_post_thumbnail( 'canizales-hero' ); ?></figure>
			<?php endif; ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<nav class="post-nav" aria-label="<?php esc_attr_e( 'Más artículos', 'canizales' ); ?>">
				<?php
				previous_post_link( '<div class="post-nav__prev">%link</div>', '<span>' . esc_html__( 'Anterior', 'canizales' ) . '</span>%title' );
				next_post_link( '<div class="post-nav__next">%link</div>', '<span>' . esc_html__( 'Siguiente', 'canizales' ) . '</span>%title' );
				?>
			</nav>
		</div>
	</article>
	<?php
endwhile;

canizales_cta_band();
get_footer();
