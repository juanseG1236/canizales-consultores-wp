<?php
/**
 * Shortcodes del tema:
 *   [canizales_migas]  Ruta de navegación (Inicio · Página actual).
 *   [canizales_anio]   Año actual, para el pie de página.
 *   [canizales_anios]  Años transcurridos desde 1999.
 *   [canizales_formulario correo="destino@dominio.com"]  Formulario de contacto (ver contact-form.php).
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_shortcode_anio() {
	return esc_html( wp_date( 'Y' ) );
}
add_shortcode( 'canizales_anio', 'canizales_shortcode_anio' );

function canizales_shortcode_anios( $atts ) {
	$atts = shortcode_atts( array( 'desde' => 1999 ), $atts, 'canizales_anios' );
	return esc_html( max( 1, (int) wp_date( 'Y' ) - (int) $atts['desde'] ) );
}
add_shortcode( 'canizales_anios', 'canizales_shortcode_anios' );

function canizales_shortcode_migas() {
	if ( is_front_page() ) {
		return '';
	}

	$items = array( array( __( 'Inicio', 'canizales' ), home_url( '/' ) ) );

	if ( is_singular( 'servicio' ) ) {
		$servicios = get_page_by_path( 'servicios' );
		if ( $servicios ) {
			$items[] = array( get_the_title( $servicios ), get_permalink( $servicios ) );
		}
	} elseif ( is_singular( 'post' ) || is_category() || is_tag() ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		if ( $blog_id ) {
			$items[] = array( get_the_title( $blog_id ), get_permalink( $blog_id ) );
		}
	} elseif ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_queried_object_id() ) ) as $ancestor ) {
			$items[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
		}
	}

	if ( is_singular() ) {
		$current = get_the_title( get_queried_object_id() );
	} elseif ( is_home() ) {
		$current = get_the_title( (int) get_option( 'page_for_posts' ) );
	} elseif ( is_search() ) {
		$current = __( 'Búsqueda', 'canizales' );
	} elseif ( is_404() ) {
		$current = __( 'Página no encontrada', 'canizales' );
	} else {
		$current = wp_strip_all_tags( get_the_archive_title() );
	}

	$out = '<nav class="migas" aria-label="' . esc_attr__( 'Ruta de navegación', 'canizales' ) . '"><ol>';
	foreach ( $items as $item ) {
		$out .= sprintf( '<li><a href="%s">%s</a></li>', esc_url( $item[1] ), esc_html( $item[0] ) );
	}
	if ( $current ) {
		$out .= sprintf( '<li aria-current="page">%s</li>', esc_html( $current ) );
	}
	return $out . '</ol></nav>';
}
add_shortcode( 'canizales_migas', 'canizales_shortcode_migas' );

/**
 * Las partes de plantilla (cabecera, pie) no procesan shortcodes escritos
 * dentro de párrafos, títulos o listas; aquí se habilitan los del tema.
 */
function canizales_shortcodes_in_blocks( $content ) {
	if ( false !== strpos( $content, '[canizales_' ) ) {
		$content = do_shortcode( $content );
	}
	return $content;
}
foreach ( array( 'core/paragraph', 'core/heading', 'core/list-item' ) as $canizales_block ) {
	add_filter( 'render_block_' . $canizales_block, 'canizales_shortcodes_in_blocks' );
}
