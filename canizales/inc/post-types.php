<?php
/**
 * Tipo de contenido "Servicio".
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_register_post_types() {
	register_post_type(
		'servicio',
		array(
			'labels'        => array(
				'name'               => __( 'Servicios', 'canizales' ),
				'singular_name'      => __( 'Servicio', 'canizales' ),
				'add_new'            => __( 'Añadir servicio', 'canizales' ),
				'add_new_item'       => __( 'Añadir nuevo servicio', 'canizales' ),
				'edit_item'          => __( 'Editar servicio', 'canizales' ),
				'new_item'           => __( 'Nuevo servicio', 'canizales' ),
				'view_item'          => __( 'Ver servicio', 'canizales' ),
				'search_items'       => __( 'Buscar servicios', 'canizales' ),
				'not_found'          => __( 'No hay servicios', 'canizales' ),
				'not_found_in_trash' => __( 'No hay servicios en la papelera', 'canizales' ),
				'all_items'          => __( 'Todos los servicios', 'canizales' ),
			),
			'public'        => true,
			'has_archive'   => false,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-portfolio',
			'menu_position' => 20,
			'hierarchical'  => false,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'rewrite'       => array(
				'slug'       => 'servicios',
				'with_front' => false,
			),
		)
	);
}
add_action( 'init', 'canizales_register_post_types' );

/**
 * Servicios ordenados según el campo "Orden" del editor.
 *
 * @param int $limit Número máximo de servicios.
 * @return WP_Post[]
 */
function canizales_get_servicios( $limit = -1 ) {
	return get_posts(
		array(
			'post_type'      => 'servicio',
			'posts_per_page' => $limit,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			),
			'no_found_rows'  => true,
		)
	);
}
