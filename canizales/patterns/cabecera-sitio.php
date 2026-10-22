<?php
/**
 * Title: Cabecera del sitio
 * Slug: canizales/cabecera-sitio
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 *
 * @package Canizales
 */

$canizales_nav = get_posts(
	array(
		'post_type'      => 'wp_navigation',
		'name'           => 'principal',
		'posts_per_page' => 1,
		'post_status'    => 'publish',
		'fields'         => 'ids',
	)
);
$canizales_nav_attrs = array(
	'overlayMenu'            => 'mobile',
	'textColor'              => 'marfil',
	'overlayBackgroundColor' => 'bosque-oscuro',
	'overlayTextColor'       => 'marfil',
	'className'              => 'sitio-nav',
	'layout'                 => array(
		'type'           => 'flex',
		'justifyContent' => 'right',
	),
);
if ( $canizales_nav ) {
	$canizales_nav_attrs = array( 'ref' => (int) $canizales_nav[0] ) + $canizales_nav_attrs;
}
?>
<!-- wp:group {"align":"full","className":"sitio-cabecera","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull sitio-cabecera"><!-- wp:group {"align":"wide","className":"sitio-cabecera__fila","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide sitio-cabecera__fila"><!-- wp:group {"className":"marca","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group marca"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"marca__simbolo"} -->
<figure class="wp-block-image size-full marca__simbolo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/simbolo.svg' ) ); ?>" alt="Canizales Consultores — Inicio"/></a></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"marca__texto","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group marca__texto"><!-- wp:paragraph {"className":"marca__nombre"} -->
<p class="marca__nombre"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Canizales</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"marca__sub"} -->
<p class="marca__sub">Consultores</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"sitio-cabecera__acciones","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
<div class="wp-block-group sitio-cabecera__acciones"><!-- wp:navigation <?php echo wp_json_encode( $canizales_nav_attrs, JSON_UNESCAPED_SLASHES ); ?> /-->

<!-- wp:buttons {"className":"sitio-cabecera__cta"} -->
<div class="wp-block-buttons sitio-cabecera__cta"><!-- wp:button {"className":"is-style-claro"} -->
<div class="wp-block-button is-style-claro"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Agenda tu asesoría</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
