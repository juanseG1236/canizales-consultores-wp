<?php
/**
 * Configuración base del tema.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_setup() {
	load_theme_textdomain( 'canizales', CANIZALES_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 240,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_editor_style( 'assets/css/editor.css' );

	add_image_size( 'canizales-card', 720, 480, true );
	add_image_size( 'canizales-hero', 1920, 1080, true );

	register_nav_menus(
		array(
			'principal' => __( 'Menú principal', 'canizales' ),
			'pie'       => __( 'Menú del pie de página', 'canizales' ),
		)
	);

	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'canizales_setup' );

function canizales_assets() {
	$css = CANIZALES_DIR . '/assets/css/main.css';
	$js  = CANIZALES_DIR . '/assets/js/main.js';

	wp_enqueue_style( 'canizales', CANIZALES_URI . '/assets/css/main.css', array(), CANIZALES_VERSION . '.' . filemtime( $css ) );
	wp_enqueue_script( 'canizales', CANIZALES_URI . '/assets/js/main.js', array(), CANIZALES_VERSION . '.' . filemtime( $js ), array( 'strategy' => 'defer', 'in_footer' => true ) );

	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'canizales_assets' );

function canizales_js_class() {
	echo "<script>document.documentElement.classList.add('js');</script>\n";
}
add_action( 'wp_head', 'canizales_js_class', 0 );

function canizales_preload_fonts() {
	$fonts = array( 'fraunces.woff2', 'garet-book.woff2' );
	foreach ( $fonts as $font ) {
		if ( file_exists( CANIZALES_DIR . '/assets/fonts/' . $font ) ) {
			printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( CANIZALES_URI . '/assets/fonts/' . $font ) );
		}
	}
}
add_action( 'wp_head', 'canizales_preload_fonts', 1 );

/**
 * Las @font-face se imprimen desde PHP para que las rutas funcionen
 * en cualquier instalación y para declarar Garet solo si sus archivos existen.
 */
function canizales_font_faces() {
	$base  = CANIZALES_URI . '/assets/fonts/';
	$faces = array(
		array( 'Fraunces', 'fraunces.woff2', '300 700', 'normal' ),
		array( 'Fraunces', 'fraunces-italic.woff2', '300 700', 'italic' ),
		array( 'Manrope', 'manrope.woff2', '300 800', 'normal' ),
		array( 'Garet', 'garet-book.woff2', '400', 'normal' ),
		array( 'Garet', 'garet-heavy.woff2', '800', 'normal' ),
	);

	$css = '';
	foreach ( $faces as $face ) {
		if ( ! file_exists( CANIZALES_DIR . '/assets/fonts/' . $face[1] ) ) {
			continue;
		}
		$css .= sprintf(
			"@font-face{font-family:'%s';src:url('%s') format('woff2');font-weight:%s;font-style:%s;font-display:swap;}",
			$face[0],
			esc_url( $base . $face[1] ),
			$face[2],
			$face[3]
		);
	}
	return $css;
}

function canizales_print_font_faces() {
	echo '<style id="canizales-fonts">' . canizales_font_faces() . "</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput
}
add_action( 'wp_head', 'canizales_print_font_faces', 2 );
add_action( 'admin_head', 'canizales_print_font_faces' );

function canizales_editor_fonts( $settings ) {
	$settings['styles'][] = array( 'css' => canizales_font_faces() );
	return $settings;
}
add_filter( 'block_editor_settings_all', 'canizales_editor_fonts' );

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

function canizales_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" type="image/png">' . "\n", esc_url( CANIZALES_URI . '/assets/img/favicon.png' ) );
}
add_action( 'wp_head', 'canizales_favicon' );

function canizales_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'canizales_excerpt_length' );

function canizales_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'canizales_excerpt_more' );

function canizales_block_styles() {
	register_block_style(
		'core/list',
		array(
			'name'  => 'numerada',
			'label' => __( 'Numerada con líneas', 'canizales' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'panel',
			'label' => __( 'Panel marfil', 'canizales' ),
		)
	);
	register_block_style(
		'core/group',
		array(
			'name'  => 'panel-bosque',
			'label' => __( 'Panel verde bosque', 'canizales' ),
		)
	);
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'destacado',
			'label' => __( 'Párrafo destacado', 'canizales' ),
		)
	);
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'antetitulo',
			'label' => __( 'Antetítulo', 'canizales' ),
		)
	);
}
add_action( 'init', 'canizales_block_styles' );
