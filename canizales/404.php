<?php
/**
 * Página no encontrada.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();
canizales_page_hero( __( 'No encontramos esta página.', 'canizales' ), __( 'Es posible que el enlace haya cambiado con la nueva versión del sitio.', 'canizales' ), '404' );
?>
<div class="section">
	<div class="container empty-state">
		<p><?php esc_html_e( 'Le invitamos a volver al inicio o a escribirnos directamente.', 'canizales' ); ?></p>
		<p class="empty-state__actions">
			<a class="btn btn--forest" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Ir al inicio', 'canizales' ); ?></a>
			<a class="btn btn--outline" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php esc_html_e( 'Contacto', 'canizales' ); ?></a>
		</p>
	</div>
</div>
<?php
get_footer();
