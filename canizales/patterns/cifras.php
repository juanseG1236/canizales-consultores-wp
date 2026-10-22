<?php
/**
 * Title: Franja de cifras
 * Slug: canizales/cifras
 * Categories: canizales
 * Description: Cuatro datos destacados sobre fondo verde. Se pueden quitar o añadir columnas.
 *
 * @package Canizales
 */

$canizales_cifras = array(
	array( '1999', 'Año de fundación. Más de 25 años de trayectoria.' ),
	array( '1116', 'Especialistas en el régimen de insolvencia de 2006.' ),
	array( 'Supersociedades', 'Experiencia como auxiliares de la justicia: promotores y liquidadores.' ),
	array( 'Empresas y familias', 'Personas jurídicas y personas naturales.' ),
);
?>
<!-- wp:group {"align":"full","className":"is-style-cifras","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-cifras"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><?php foreach ( $canizales_cifras as $canizales_cifra ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"cifra__valor"} -->
<p class="cifra__valor"><?php echo esc_html( $canizales_cifra[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cifra__texto"} -->
<p class="cifra__texto"><?php echo esc_html( $canizales_cifra[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
