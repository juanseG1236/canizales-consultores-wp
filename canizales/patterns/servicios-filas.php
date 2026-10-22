<?php
/**
 * Title: Servicios en filas numeradas
 * Slug: canizales/servicios-filas
 * Categories: canizales, services
 * Description: Lista automática de los servicios (menú Servicios del panel), en filas numeradas.
 *
 * @package Canizales
 */

?>
<!-- wp:group {"align":"full","className":"is-style-seccion-crema","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion-crema"><!-- wp:group {"align":"wide","className":"encabezado-seccion","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group alignwide encabezado-seccion"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Áreas de práctica</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Un acompañamiento integral, jurídico y financiero.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-flecha"} -->
<div class="wp-block-button is-style-flecha"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>">Ver todos los servicios</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":20,"query":{"perPage":12,"pages":0,"offset":0,"postType":"servicio","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"is-style-filas"} -->
<div class="wp-block-query alignwide is-style-filas"><!-- wp:post-template -->
<!-- wp:post-title {"isLink":true,"level":3} /-->

<!-- wp:post-excerpt {"excerptLength":28} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
