<?php
/**
 * Opciones editables desde Apariencia → Personalizar.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valores por defecto de todas las opciones del tema.
 */
function canizales_defaults() {
	return array(
		'whatsapp'         => '573116356306',
		'whatsapp_mensaje' => 'Hola, quisiera agendar una asesoría con Canizales Consultores.',
		'telefono'         => '+57 311 635 6306',
		'email'            => '',
		'direccion'        => '',
		'ciudad'           => 'Colombia',
		'horario'          => 'Lunes a viernes · 8:00 a. m. – 5:00 p. m.',
		'mapa'             => '',
		'instagram'        => '',
		'facebook'         => '',
		'linkedin'         => '',
		'anio_fundacion'   => '1999',
		'hero_antetitulo'  => 'Insolvencia y reorganización empresarial · Desde 1999',
		'hero_titulo'      => 'Claridad para decidir y avanzar.',
		'hero_texto'       => 'Acompañamos a empresas y personas naturales que enfrentan una crisis financiera, con análisis jurídico y financiero riguroso y una comunicación clara en cada etapa.',
		'cta_texto'        => 'Agenda tu asesoría',
		'video_fundador'   => 'https://vimeo.com/285196105',
		'correo_destino'   => '',
	);
}

/**
 * Obtiene una opción del tema con su valor por defecto.
 *
 * @param string $key Clave de la opción.
 * @return string
 */
function canizales_opt( $key ) {
	$defaults = canizales_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'canizales_' . $key, $default );
}

function canizales_customize_register( $wp_customize ) {
	$defaults = canizales_defaults();

	$wp_customize->add_panel(
		'canizales',
		array(
			'title'    => __( 'Canizales Consultores', 'canizales' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'canizales_contacto' => array(
			'title'  => __( 'Datos de contacto', 'canizales' ),
			'fields' => array(
				'whatsapp'         => array( __( 'WhatsApp (solo números, con indicativo 57)', 'canizales' ), 'text' ),
				'whatsapp_mensaje' => array( __( 'Mensaje inicial de WhatsApp', 'canizales' ), 'text' ),
				'telefono'         => array( __( 'Teléfono visible', 'canizales' ), 'text' ),
				'email'            => array( __( 'Correo electrónico visible', 'canizales' ), 'email' ),
				'correo_destino'   => array( __( 'Correo que recibe el formulario (si se deja vacío se usa el correo visible o el del administrador)', 'canizales' ), 'email' ),
				'direccion'        => array( __( 'Dirección', 'canizales' ), 'text' ),
				'ciudad'           => array( __( 'Ciudad / país', 'canizales' ), 'text' ),
				'horario'          => array( __( 'Horario de atención', 'canizales' ), 'text' ),
				'mapa'             => array( __( 'Dirección para el mapa de Google (ej. "Calle 00 # 00-00, Bogotá")', 'canizales' ), 'text' ),
			),
		),
		'canizales_redes'    => array(
			'title'  => __( 'Redes sociales', 'canizales' ),
			'fields' => array(
				'instagram' => array( __( 'Instagram (URL)', 'canizales' ), 'url' ),
				'facebook'  => array( __( 'Facebook (URL)', 'canizales' ), 'url' ),
				'linkedin'  => array( __( 'LinkedIn (URL)', 'canizales' ), 'url' ),
			),
		),
		'canizales_inicio'   => array(
			'title'  => __( 'Portada', 'canizales' ),
			'fields' => array(
				'hero_antetitulo' => array( __( 'Antetítulo', 'canizales' ), 'text' ),
				'hero_titulo'     => array( __( 'Título principal', 'canizales' ), 'text' ),
				'hero_texto'      => array( __( 'Texto de apoyo', 'canizales' ), 'textarea' ),
				'cta_texto'       => array( __( 'Texto del botón principal', 'canizales' ), 'text' ),
				'anio_fundacion'  => array( __( 'Año de fundación', 'canizales' ), 'number' ),
			),
		),
		'canizales_firma'    => array(
			'title'  => __( 'La Firma', 'canizales' ),
			'fields' => array(
				'video_fundador' => array( __( 'URL del video en memoria del fundador (YouTube o Vimeo)', 'canizales' ), 'url' ),
			),
		),
	);

	$priority = 10;
	foreach ( $sections as $section_id => $section ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => $section['title'],
				'panel'    => 'canizales',
				'priority' => $priority,
			)
		);
		$priority += 10;

		foreach ( $section['fields'] as $key => $field ) {
			list( $label, $type ) = $field;

			switch ( $type ) {
				case 'url':
					$sanitize = 'esc_url_raw';
					break;
				case 'email':
					$sanitize = 'sanitize_email';
					break;
				case 'textarea':
					$sanitize = 'sanitize_textarea_field';
					break;
				case 'number':
					$sanitize = 'absint';
					break;
				default:
					$sanitize = 'sanitize_text_field';
			}

			$wp_customize->add_setting(
				'canizales_' . $key,
				array(
					'default'           => $defaults[ $key ],
					'sanitize_callback' => $sanitize,
				)
			);
			$wp_customize->add_control(
				'canizales_' . $key,
				array(
					'label'   => $label,
					'section' => $section_id,
					'type'    => $type,
				)
			);
		}
	}
}
add_action( 'customize_register', 'canizales_customize_register' );
