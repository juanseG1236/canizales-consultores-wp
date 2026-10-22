<?php
/**
 * Franja de llamado a la acción.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

$wa = canizales_whatsapp_url();
?>
<section class="cta-band" aria-labelledby="cta-band-title">
	<?php echo canizales_rays( 'cta-band__rays', 13 ); // phpcs:ignore ?>
	<div class="container cta-band__inner">
		<div class="cta-band__copy">
			<?php canizales_eyebrow( __( 'Agenda tu asesoría', 'canizales' ), 'eyebrow--light' ); ?>
			<h2 id="cta-band-title" class="cta-band__title reveal"><?php echo esc_html( $args['title'] ); ?></h2>
			<p class="cta-band__text reveal"><?php echo esc_html( $args['text'] ); ?></p>
		</div>
		<div class="cta-band__actions reveal">
			<a class="btn btn--olive btn--lg" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php echo esc_html( canizales_opt( 'cta_texto' ) ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
			<?php if ( $wa ) : ?>
				<a class="btn btn--ghost-light btn--lg" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener"><?php echo canizales_icon( 'whatsapp' ); // phpcs:ignore ?> <?php esc_html_e( 'Escribir por WhatsApp', 'canizales' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</section>
