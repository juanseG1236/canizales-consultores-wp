<?php
/**
 * Configuración base del tema de bloques.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_setup() {
	load_theme_textdomain( 'canizales', CANIZALES_DIR . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/main.css' );

	add_image_size( 'canizales-card', 720, 480, true );

	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'canizales_setup' );

function canizales_assets() {
	$css = CANIZALES_DIR . '/assets/css/main.css';
	$js  = CANIZALES_DIR . '/assets/js/main.js';

	wp_enqueue_style( 'canizales', CANIZALES_URI . '/assets/css/main.css', array(), CANIZALES_VERSION . '.' . filemtime( $css ) );
	wp_enqueue_script( 'canizales', CANIZALES_URI . '/assets/js/main.js', array(), CANIZALES_VERSION . '.' . filemtime( $js ), array( 'strategy' => 'defer', 'in_footer' => true ) );
}
add_action( 'wp_enqueue_scripts', 'canizales_assets' );

function canizales_head() {
	echo "<script>document.documentElement.classList.add('js');</script>\n";
	if ( ! has_site_icon() ) {
		printf( '<link rel="icon" href="%s" type="image/png">' . "\n", esc_url( CANIZALES_URI . '/assets/img/favicon.png' ) );
	}
	echo '<meta name="theme-color" content="#1A3029">' . "\n";
}
add_action( 'wp_head', 'canizales_head', 0 );

/**
 * Garet tiene licencia comercial: sus archivos no se incluyen en el tema.
 * Si se copian en assets/fonts/ (garet-book.woff2 y garet-heavy.woff2),
 * se registran automáticamente como parte de la familia "Garet (textos)".
 */
function canizales_garet_font( $theme_json ) {
	$files = array(
		'garet-book.woff2'  => '400',
		'garet-heavy.woff2' => '800',
	);
	$faces = array();
	foreach ( $files as $file => $weight ) {
		if ( file_exists( CANIZALES_DIR . '/assets/fonts/' . $file ) ) {
			$faces[] = array(
				'fontFamily'  => 'Garet',
				'fontStyle'   => 'normal',
				'fontWeight'  => $weight,
				'fontDisplay' => 'swap',
				'src'         => array( 'file:./assets/fonts/' . $file ),
			);
		}
	}
	if ( ! $faces ) {
		return $theme_json;
	}

	$data     = $theme_json->get_data();
	$families = isset( $data['settings']['typography']['fontFamilies']['theme'] ) ? $data['settings']['typography']['fontFamilies']['theme'] : array();
	foreach ( $families as &$family ) {
		if ( 'garet' === $family['slug'] ) {
			$family['fontFace'] = array_merge( $faces, isset( $family['fontFace'] ) ? $family['fontFace'] : array() );
		}
	}
	unset( $family );

	return $theme_json->update_with(
		array(
			'version'  => 3,
			'settings' => array( 'typography' => array( 'fontFamilies' => $families ) ),
		)
	);
}
add_filter( 'wp_theme_json_data_theme', 'canizales_garet_font' );

function canizales_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
}
add_action( 'init', 'canizales_cleanup' );

function canizales_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'canizales_excerpt_more' );

/**
 * Estilos de bloque: aparecen en el panel "Estilos" de cada bloque.
 * Su apariencia está definida en assets/css/main.css.
 */
function canizales_block_styles() {
	$styles = array(
		'core/group'     => array(
			'seccion'        => __( 'Sección', 'canizales' ),
			'seccion-crema'  => __( 'Sección crema', 'canizales' ),
			'seccion-bosque' => __( 'Sección verde bosque', 'canizales' ),
			'seccion-rayos'  => __( 'Sección con rayos de luz', 'canizales' ),
			'faro'           => __( 'Portada con foto', 'canizales' ),
			'cabecera'       => __( 'Cabecera de página', 'canizales' ),
			'panel'          => __( 'Tarjeta clara', 'canizales' ),
			'panel-bosque'   => __( 'Tarjeta verde', 'canizales' ),
			'tarjeta-linea'  => __( 'Tarjeta con borde (fondo oscuro)', 'canizales' ),
			'ovalo'          => __( 'Con óvalo de fondo', 'canizales' ),
			'cifras'         => __( 'Franja de cifras', 'canizales' ),
		),
		'core/columns'   => array(
			'pasos' => __( 'Pasos numerados', 'canizales' ),
		),
		'core/list'      => array(
			'numerada' => __( 'Numerada con líneas', 'canizales' ),
		),
		'core/paragraph' => array(
			'antetitulo' => __( 'Antetítulo', 'canizales' ),
			'destacado'  => __( 'Párrafo destacado', 'canizales' ),
		),
		'core/query'     => array(
			'filas'    => __( 'Filas numeradas', 'canizales' ),
			'tarjetas' => __( 'Tarjetas', 'canizales' ),
		),
		'core/button'    => array(
			'bosque' => __( 'Verde bosque', 'canizales' ),
			'claro'  => __( 'Marfil', 'canizales' ),
			'flecha' => __( 'Enlace con flecha', 'canizales' ),
		),
		'core/image'     => array(
			'ovalo' => __( 'Óvalo', 'canizales' ),
		),
		'core/embed'     => array(
			'marco' => __( 'Con marco', 'canizales' ),
		),
	);

	foreach ( $styles as $block => $list ) {
		foreach ( $list as $name => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'canizales_block_styles' );

function canizales_pattern_categories() {
	register_block_pattern_category( 'canizales', array( 'label' => __( 'Canizales Consultores', 'canizales' ) ) );
}
add_action( 'init', 'canizales_pattern_categories', 9 );
