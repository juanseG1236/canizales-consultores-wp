<?php
/**
 * Template Name: Servicios
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	canizales_page_hero( get_the_title(), has_excerpt() ? get_the_excerpt() : '', __( 'Portafolio', 'canizales' ) );
	?>
	<div class="section section--tight">
		<div class="container">
			<div class="entry-content entry-content--intro">
				<?php the_content(); ?>
				<p class="badge-line"><?php echo canizales_icon( 'shield' ); // phpcs:ignore ?> <?php esc_html_e( 'Experiencia como auxiliares de la justicia, promotores y liquidadores de la Superintendencia de Sociedades.', 'canizales' ); ?></p>
			</div>
		</div>
	</div>

	<div class="section section--flush-top">
		<div class="container">
			<div class="service-grid">
				<?php foreach ( canizales_get_servicios() as $i => $servicio ) : ?>
					<article class="service-card reveal" id="<?php echo esc_attr( $servicio->post_name ); ?>">
						<span class="service-card__num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h2 class="service-card__title"><a href="<?php echo esc_url( get_permalink( $servicio ) ); ?>"><?php echo esc_html( get_the_title( $servicio ) ); ?></a></h2>
						<p class="service-card__text"><?php echo esc_html( get_the_excerpt( $servicio ) ); ?></p>
						<?php
						$lists = array();
						foreach ( parse_blocks( $servicio->post_content ) as $block ) {
							if ( 'core/list' === $block['blockName'] ) {
								$lists[] = render_block( $block );
							}
						}
						if ( $lists ) :
							?>
							<div class="service-card__list"><?php echo wp_kses_post( implode( '', $lists ) ); ?></div>
						<?php endif; ?>
						<a class="link-arrow" href="<?php echo esc_url( get_permalink( $servicio ) ); ?>"><?php esc_html_e( 'Ver detalle', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
					</article>
				<?php endforeach; ?>
			</div>
			<p class="service-grid__note"><?php esc_html_e( 'Tenemos servicios para cada necesidad. Consúltenos: le orientaremos, ese es nuestro compromiso.', 'canizales' ); ?></p>
		</div>
	</div>
	<?php
endwhile;

canizales_cta_band();
get_footer();
