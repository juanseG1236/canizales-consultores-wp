<?php
/**
 * Pie de página.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

$servicios = canizales_get_servicios( 6 );
$privacy   = get_privacy_policy_url();
$wa        = canizales_whatsapp_url();
?>
</main>

<footer class="site-footer">
	<div class="container site-footer__grid">
		<div class="site-footer__brand">
			<?php canizales_logo( 'footer' ); ?>
			<p><?php esc_html_e( 'Asesoría jurídica y financiera en insolvencia y reorganización empresarial. Desde 1999.', 'canizales' ); ?></p>
			<?php canizales_social_links(); ?>
		</div>

		<div class="site-footer__col">
			<h2 class="site-footer__title"><?php esc_html_e( 'La firma', 'canizales' ); ?></h2>
			<?php
			if ( has_nav_menu( 'pie' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'pie',
						'container'      => false,
						'menu_class'     => 'site-footer__links',
						'depth'          => 1,
					)
				);
			} else {
				canizales_fallback_menu( array( 'menu_class' => 'site-footer__links' ) );
			}
			?>
		</div>

		<?php if ( $servicios ) : ?>
			<div class="site-footer__col">
				<h2 class="site-footer__title"><?php esc_html_e( 'Servicios', 'canizales' ); ?></h2>
				<ul class="site-footer__links">
					<?php foreach ( $servicios as $servicio ) : ?>
						<li><a href="<?php echo esc_url( get_permalink( $servicio ) ); ?>"><?php echo esc_html( get_the_title( $servicio ) ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="site-footer__col">
			<h2 class="site-footer__title"><?php esc_html_e( 'Contacto', 'canizales' ); ?></h2>
			<ul class="contact-list">
				<?php if ( $wa ) : ?>
					<li><?php echo canizales_icon( 'whatsapp' ); // phpcs:ignore ?><a href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener"><?php echo esc_html( canizales_opt( 'telefono' ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( canizales_opt( 'email' ) ) : ?>
					<li><?php echo canizales_icon( 'mail' ); // phpcs:ignore ?><a href="mailto:<?php echo esc_attr( antispambot( canizales_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( canizales_opt( 'email' ) ) ); ?></a></li>
				<?php endif; ?>
				<?php if ( canizales_opt( 'direccion' ) || canizales_opt( 'ciudad' ) ) : ?>
					<li><?php echo canizales_icon( 'pin' ); // phpcs:ignore ?><span><?php echo esc_html( trim( canizales_opt( 'direccion' ) . ( canizales_opt( 'direccion' ) && canizales_opt( 'ciudad' ) ? ', ' : '' ) . canizales_opt( 'ciudad' ) ) ); ?></span></li>
				<?php endif; ?>
				<?php if ( canizales_opt( 'horario' ) ) : ?>
					<li><?php echo canizales_icon( 'clock' ); // phpcs:ignore ?><span><?php echo esc_html( canizales_opt( 'horario' ) ); ?></span></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<div class="container site-footer__bottom">
		<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Canizales Consultores S.A.S. <?php esc_html_e( 'Todos los derechos reservados.', 'canizales' ); ?></p>
		<?php if ( $privacy ) : ?>
			<p><a href="<?php echo esc_url( $privacy ); ?>"><?php esc_html_e( 'Política de tratamiento de datos', 'canizales' ); ?></a></p>
		<?php endif; ?>
		<p class="site-footer__legal"><?php esc_html_e( 'La información publicada es de carácter general y no constituye asesoría para un caso particular.', 'canizales' ); ?></p>
	</div>
</footer>

<?php if ( $wa ) : ?>
	<a class="wa-float" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Escríbanos por WhatsApp', 'canizales' ); ?>">
		<?php echo canizales_icon( 'whatsapp' ); // phpcs:ignore ?>
		<span class="wa-float__label"><?php esc_html_e( 'WhatsApp', 'canizales' ); ?></span>
	</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
