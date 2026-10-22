<?php
/**
 * Formulario de contacto: [canizales_formulario]
 *
 * Envía un correo a la dirección definida en Ajustes → Generales
 * ("Correo que recibe el formulario") y guarda una copia en Consultas,
 * para que ningún mensaje se pierda si falla el envío de correo.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_register_consultas() {
	register_post_type(
		'consulta',
		array(
			'labels'          => array(
				'name'          => __( 'Consultas', 'canizales' ),
				'singular_name' => __( 'Consulta', 'canizales' ),
				'all_items'     => __( 'Consultas recibidas', 'canizales' ),
				'edit_item'     => __( 'Ver consulta', 'canizales' ),
				'not_found'     => __( 'Aún no hay consultas', 'canizales' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => 'dashicons-email-alt',
			'menu_position'   => 21,
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'canizales_register_consultas' );

function canizales_form_settings() {
	register_setting(
		'general',
		'canizales_correo_formulario',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_email',
			'default'           => '',
		)
	);
	add_settings_field(
		'canizales_correo_formulario',
		__( 'Correo que recibe el formulario de contacto', 'canizales' ),
		function () {
			printf(
				'<input type="email" class="regular-text" name="canizales_correo_formulario" value="%s" placeholder="%s"><p class="description">%s</p>',
				esc_attr( get_option( 'canizales_correo_formulario' ) ),
				esc_attr( get_option( 'admin_email' ) ),
				esc_html__( 'Si se deja vacío se usa el correo del administrador. Las consultas también quedan guardadas en el menú Consultas.', 'canizales' )
			);
		},
		'general'
	);
}
add_action( 'admin_init', 'canizales_form_settings' );

function canizales_form_asuntos() {
	return array(
		'reorganizacion' => __( 'Reorganización empresarial', 'canizales' ),
		'liquidacion'    => __( 'Liquidación judicial', 'canizales' ),
		'persona'        => __( 'Insolvencia de persona natural', 'canizales' ),
		'financiero'     => __( 'Asesoría financiera', 'canizales' ),
		'tributario'     => __( 'Asesoría tributaria', 'canizales' ),
		'juridico'       => __( 'Asesoría jurídica o contable', 'canizales' ),
		'otro'           => __( 'Otro tema', 'canizales' ),
	);
}

function canizales_handle_contact() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( array( 'enviado', 'error' ), $back );

	if ( ! isset( $_POST['canizales_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['canizales_nonce'] ) ), 'canizales_contacto' ) ) {
		wp_safe_redirect( add_query_arg( 'error', 'sesion', $back ) . '#formulario' );
		exit;
	}

	// Campo trampa: los bots lo llenan, las personas no lo ven.
	if ( ! empty( $_POST['sitio_web'] ) ) {
		wp_safe_redirect( add_query_arg( 'enviado', '1', $back ) . '#formulario' );
		exit;
	}

	$data = array(
		'nombre'   => isset( $_POST['nombre'] ) ? sanitize_text_field( wp_unslash( $_POST['nombre'] ) ) : '',
		'empresa'  => isset( $_POST['empresa'] ) ? sanitize_text_field( wp_unslash( $_POST['empresa'] ) ) : '',
		'correo'   => isset( $_POST['correo'] ) ? sanitize_email( wp_unslash( $_POST['correo'] ) ) : '',
		'telefono' => isset( $_POST['telefono'] ) ? sanitize_text_field( wp_unslash( $_POST['telefono'] ) ) : '',
		'asunto'   => isset( $_POST['asunto'] ) ? sanitize_key( wp_unslash( $_POST['asunto'] ) ) : '',
		'mensaje'  => isset( $_POST['mensaje'] ) ? sanitize_textarea_field( wp_unslash( $_POST['mensaje'] ) ) : '',
		'acepto'   => ! empty( $_POST['acepto'] ),
	);

	$asuntos = canizales_form_asuntos();
	if ( ! $data['nombre'] || ! is_email( $data['correo'] ) || ! $data['mensaje'] || ! $data['acepto'] || ! isset( $asuntos[ $data['asunto'] ] ) ) {
		wp_safe_redirect( add_query_arg( 'error', 'campos', $back ) . '#formulario' );
		exit;
	}

	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'canizales_form_' . md5( $ip );
	if ( get_transient( $key ) ) {
		wp_safe_redirect( add_query_arg( 'error', 'espera', $back ) . '#formulario' );
		exit;
	}
	set_transient( $key, 1, 30 );

	$asunto_label = $asuntos[ $data['asunto'] ];
	$cuerpo       = sprintf(
		"Nombre: %s\nEmpresa: %s\nCorreo: %s\nTeléfono: %s\nTema: %s\n\nMensaje:\n%s\n\n—\nAutorizó el tratamiento de datos personales el %s desde %s.",
		$data['nombre'],
		$data['empresa'] ? $data['empresa'] : '—',
		$data['correo'],
		$data['telefono'] ? $data['telefono'] : '—',
		$asunto_label,
		$data['mensaje'],
		wp_date( 'j/m/Y H:i' ),
		$back
	);

	wp_insert_post(
		array(
			'post_type'    => 'consulta',
			'post_status'  => 'private',
			'post_title'   => sprintf( '%s — %s', $data['nombre'], $asunto_label ),
			'post_content' => $cuerpo,
		)
	);

	$destino = get_option( 'canizales_correo_formulario' );
	if ( ! is_email( $destino ) ) {
		$destino = get_option( 'admin_email' );
	}

	wp_mail(
		$destino,
		sprintf( '[Web] Nueva consulta: %s', $asunto_label ),
		$cuerpo,
		array( 'Reply-To: ' . $data['nombre'] . ' <' . $data['correo'] . '>' )
	);

	wp_safe_redirect( add_query_arg( 'enviado', '1', $back ) . '#formulario' );
	exit;
}
add_action( 'admin_post_nopriv_canizales_contacto', 'canizales_handle_contact' );
add_action( 'admin_post_canizales_contacto', 'canizales_handle_contact' );

function canizales_form_notice() {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended
	if ( isset( $_GET['enviado'] ) ) {
		return array( 'ok', __( 'Gracias. Recibimos su consulta y le responderemos a la mayor brevedad.', 'canizales' ) );
	}
	if ( isset( $_GET['error'] ) ) {
		$errores = array(
			'campos' => __( 'Revise los campos obligatorios y la autorización de tratamiento de datos.', 'canizales' ),
			'espera' => __( 'Ya recibimos un mensaje hace un momento. Intente de nuevo en unos segundos.', 'canizales' ),
			'sesion' => __( 'La sesión expiró. Recargue la página e intente de nuevo.', 'canizales' ),
		);
		$code = sanitize_key( wp_unslash( $_GET['error'] ) );
		return array( 'error', isset( $errores[ $code ] ) ? $errores[ $code ] : $errores['campos'] );
	}
	// phpcs:enable
	return null;
}

function canizales_shortcode_formulario( $atts ) {
	$atts    = shortcode_atts( array( 'boton' => __( 'Enviar consulta', 'canizales' ) ), $atts, 'canizales_formulario' );
	$notice  = canizales_form_notice();
	$privacy = get_privacy_policy_url();

	ob_start();
	?>
	<div class="formulario" id="formulario">
		<?php if ( $notice ) : ?>
			<div class="form-notice form-notice--<?php echo esc_attr( $notice[0] ); ?>" role="<?php echo 'ok' === $notice[0] ? 'status' : 'alert'; ?>"><?php echo esc_html( $notice[1] ); ?></div>
		<?php endif; ?>
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
			<div class="wp-block-button is-style-bosque">
				<button class="wp-block-button__link wp-element-button" type="submit"><?php echo esc_html( $atts['boton'] ); ?></button>
			</div>
		</form>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'canizales_formulario', 'canizales_shortcode_formulario' );
