<?php
/**
 * Formulario de contacto nativo: envía un correo y guarda una copia
 * en el panel (Consultas) para que ningún mensaje se pierda si falla el correo.
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
	$back = wp_get_referer() ? wp_get_referer() : canizales_contact_url();
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

	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'canizales_form_' . md5( $ip );
	if ( get_transient( $key ) ) {
		wp_safe_redirect( add_query_arg( 'error', 'espera', $back ) . '#formulario' );
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

	$destino = canizales_opt( 'correo_destino' );
	if ( ! is_email( $destino ) ) {
		$destino = canizales_opt( 'email' );
	}
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
