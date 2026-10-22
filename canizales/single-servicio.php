<?php
/**
 * Servicio individual.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$current = get_the_ID();
	canizales_page_hero( get_the_title(), '', __( 'Servicios', 'canizales' ) );
	?>
	<div class="section section--content">
		<div class="container service-layout">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php if ( 'regimen-de-insolvencia' === get_post_field( 'post_name' ) ) : ?>
					<p><a class="link-arrow" href="<?php echo esc_url( canizales_page_link( 'insolvencia-y-reorganizacion' ) ); ?>"><?php esc_html_e( 'Cómo funciona la Ley 1116 de 2006', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a></p>
				<?php endif; ?>
			</div>

			<aside class="service-aside">
				<div class="aside-card aside-card--forest">
					<h2><?php esc_html_e( '¿Necesita orientación?', 'canizales' ); ?></h2>
					<p><?php esc_html_e( 'Cuéntenos su caso y le indicaremos qué alternativas tiene.', 'canizales' ); ?></p>
					<a class="btn btn--olive" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php echo esc_html( canizales_opt( 'cta_texto' ) ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
					<?php if ( canizales_whatsapp_url() ) : ?>
						<a class="aside-card__wa" href="<?php echo esc_url( canizales_whatsapp_url() ); ?>" target="_blank" rel="noopener"><?php echo canizales_icon( 'whatsapp' ); // phpcs:ignore ?> <?php echo esc_html( canizales_opt( 'telefono' ) ); ?></a>
					<?php endif; ?>
				</div>
				<nav class="aside-card" aria-label="<?php esc_attr_e( 'Otros servicios', 'canizales' ); ?>">
					<h2><?php esc_html_e( 'Otros servicios', 'canizales' ); ?></h2>
					<ul class="aside-links">
						<?php foreach ( canizales_get_servicios() as $servicio ) : ?>
							<li<?php echo $servicio->ID === $current ? ' class="is-current"' : ''; ?>><a href="<?php echo esc_url( get_permalink( $servicio ) ); ?>"<?php echo $servicio->ID === $current ? ' aria-current="page"' : ''; ?>><?php echo esc_html( get_the_title( $servicio ) ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</aside>
		</div>
	</div>
	<?php
endwhile;

canizales_cta_band();
get_footer();
