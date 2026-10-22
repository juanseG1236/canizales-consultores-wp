<?php
/**
 * Template Name: Contacto
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

$notice  = canizales_form_notice();
$wa      = canizales_whatsapp_url();
$privacy = get_privacy_policy_url();
$mapa    = canizales_opt( 'mapa' );

while ( have_posts() ) :
	the_post();
	canizales_page_hero( get_the_title(), has_excerpt() ? get_the_excerpt() : '', __( 'Agenda tu asesoría', 'canizales' ) );
	?>
	<div class="section">
		<div class="container contact-grid">
			<div class="contact-form-wrap" id="formulario">
				<h2 class="section-title section-title--sm"><?php esc_html_e( 'Escríbanos', 'canizales' ); ?></h2>
				<p class="muted"><?php esc_html_e( 'Toda la información que nos comparta es tratada de forma confidencial.', 'canizales' ); ?></p>

				<?php if ( $notice ) : ?>
					<div class="form-notice form-notice--<?php echo esc_attr( $notice[0] ); ?>" role="<?php echo 'ok' === $notice[0] ? 'status' : 'alert'; ?>"><?php echo esc_html( $notice[1] ); ?></div>
				<?php endif; ?>

				<?php the_content(); ?>

				<form class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate data-form>
					<input type="hidden" name="action" value="canizales_contacto">
					<?php wp_nonce_field( 'canizales_contacto', 'canizales_nonce' ); ?>
					<div class="hp" aria-hidden="true">
						<label for="cz-web">Sitio web</label>
						<input type="text" id="cz-web" name="sitio_web" tabindex="-1" autocomplete="off">
					</div>

					<div class="field-row">
						<div class="field">
							<label for="cz-nombre"><?php esc_html_e( 'Nombre completo', 'canizales' ); ?> <span aria-hidden="true">*</span></label>
							<input type="text" id="cz-nombre" name="nombre" required autocomplete="name">
						</div>
						<div class="field">
							<label for="cz-empresa"><?php esc_html_e( 'Empresa', 'canizales' ); ?> <span class="field__hint"><?php esc_html_e( '(opcional)', 'canizales' ); ?></span></label>
							<input type="text" id="cz-empresa" name="empresa" autocomplete="organization">
						</div>
					</div>
					<div class="field-row">
						<div class="field">
							<label for="cz-correo"><?php esc_html_e( 'Correo electrónico', 'canizales' ); ?> <span aria-hidden="true">*</span></label>
							<input type="email" id="cz-correo" name="correo" required autocomplete="email">
						</div>
						<div class="field">
							<label for="cz-telefono"><?php esc_html_e( 'Teléfono / WhatsApp', 'canizales' ); ?></label>
							<input type="tel" id="cz-telefono" name="telefono" autocomplete="tel">
						</div>
					</div>
					<div class="field">
						<label for="cz-asunto"><?php esc_html_e( '¿En qué podemos ayudarle?', 'canizales' ); ?> <span aria-hidden="true">*</span></label>
						<select id="cz-asunto" name="asunto" required>
							<option value=""><?php esc_html_e( 'Seleccione un tema', 'canizales' ); ?></option>
							<?php foreach ( canizales_form_asuntos() as $value => $label ) : ?>
								<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field">
						<label for="cz-mensaje"><?php esc_html_e( 'Cuéntenos brevemente su situación', 'canizales' ); ?> <span aria-hidden="true">*</span></label>
						<textarea id="cz-mensaje" name="mensaje" rows="5" required></textarea>
					</div>
					<div class="field field--check">
						<input type="checkbox" id="cz-acepto" name="acepto" value="1" required>
						<label for="cz-acepto">
							<?php
							if ( $privacy ) {
								printf(
									/* translators: %s: enlace a la política */
									esc_html__( 'Autorizo el tratamiento de mis datos personales conforme a la %s (Ley 1581 de 2012).', 'canizales' ),
									'<a href="' . esc_url( $privacy ) . '" target="_blank">' . esc_html__( 'Política de tratamiento de datos', 'canizales' ) . '</a>'
								);
							} else {
								esc_html_e( 'Autorizo a Canizales Consultores S.A.S. el tratamiento de mis datos personales para atender esta consulta, conforme a la Ley 1581 de 2012.', 'canizales' );
							}
							?>
						</label>
					</div>
					<button class="btn btn--forest btn--lg" type="submit"><?php esc_html_e( 'Enviar consulta', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></button>
				</form>
			</div>

			<aside class="contact-aside">
				<?php if ( $wa ) : ?>
					<a class="channel channel--wa" href="<?php echo esc_url( $wa ); ?>" target="_blank" rel="noopener">
						<span class="channel__icon"><?php echo canizales_icon( 'whatsapp' ); // phpcs:ignore ?></span>
						<span class="channel__body">
							<span class="channel__label"><?php esc_html_e( 'Respuesta más rápida', 'canizales' ); ?></span>
							<span class="channel__value"><?php esc_html_e( 'Escribir por WhatsApp', 'canizales' ); ?></span>
						</span>
						<?php echo canizales_icon( 'arrow', 'channel__arrow' ); // phpcs:ignore ?>
					</a>
				<?php endif; ?>
				<?php if ( canizales_opt( 'telefono' ) ) : ?>
					<a class="channel" href="<?php echo esc_url( canizales_tel_url() ); ?>">
						<span class="channel__icon"><?php echo canizales_icon( 'phone' ); // phpcs:ignore ?></span>
						<span class="channel__body">
							<span class="channel__label"><?php esc_html_e( 'Teléfono', 'canizales' ); ?></span>
							<span class="channel__value"><?php echo esc_html( canizales_opt( 'telefono' ) ); ?></span>
						</span>
					</a>
				<?php endif; ?>
				<?php if ( canizales_opt( 'email' ) ) : ?>
					<a class="channel" href="mailto:<?php echo esc_attr( antispambot( canizales_opt( 'email' ) ) ); ?>">
						<span class="channel__icon"><?php echo canizales_icon( 'mail' ); // phpcs:ignore ?></span>
						<span class="channel__body">
							<span class="channel__label"><?php esc_html_e( 'Correo', 'canizales' ); ?></span>
							<span class="channel__value"><?php echo esc_html( antispambot( canizales_opt( 'email' ) ) ); ?></span>
						</span>
					</a>
				<?php endif; ?>
				<?php if ( canizales_opt( 'direccion' ) ) : ?>
					<div class="channel">
						<span class="channel__icon"><?php echo canizales_icon( 'pin' ); // phpcs:ignore ?></span>
						<span class="channel__body">
							<span class="channel__label"><?php esc_html_e( 'Oficina', 'canizales' ); ?></span>
							<span class="channel__value"><?php echo esc_html( canizales_opt( 'direccion' ) ); ?><br><?php echo esc_html( canizales_opt( 'ciudad' ) ); ?></span>
						</span>
					</div>
				<?php endif; ?>
				<?php if ( canizales_opt( 'horario' ) ) : ?>
					<div class="channel">
						<span class="channel__icon"><?php echo canizales_icon( 'clock' ); // phpcs:ignore ?></span>
						<span class="channel__body">
							<span class="channel__label"><?php esc_html_e( 'Horario', 'canizales' ); ?></span>
							<span class="channel__value"><?php echo esc_html( canizales_opt( 'horario' ) ); ?></span>
						</span>
					</div>
				<?php endif; ?>
				<?php if ( $mapa ) : ?>
					<div class="map">
						<iframe title="<?php esc_attr_e( 'Ubicación de la oficina', 'canizales' ); ?>" src="<?php echo esc_url( 'https://www.google.com/maps?q=' . rawurlencode( $mapa ) . '&output=embed' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				<?php endif; ?>
			</aside>
		</div>
	</div>
	<?php
endwhile;

get_footer();
