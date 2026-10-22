<?php
/**
 * Title: Últimos artículos
 * Slug: canizales/ultimos-articulos
 * Categories: canizales, query
 * Description: Las tres entradas más recientes del blog en tarjetas.
 *
 * @package Canizales
 */

?>
<!-- wp:group {"align":"full","className":"is-style-seccion","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion"><!-- wp:group {"align":"wide","className":"encabezado-seccion","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group alignwide encabezado-seccion"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Recursos</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Información para decidir mejor.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-flecha"} -->
<div class="wp-block-button is-style-flecha"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/recursos/' ) ); ?>">Ver todos los artículos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":30,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"is-style-tarjetas"} -->
<div class="wp-block-query alignwide is-style-tarjetas"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /-->

<!-- wp:group {"className":"tarjeta__cuerpo","layout":{"type":"default"}} -->
<div class="wp-block-group tarjeta__cuerpo"><!-- wp:post-date /-->

<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"large"} /-->

<!-- wp:post-excerpt {"excerptLength":22} /-->

<!-- wp:read-more {"content":"Leer artículo"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph -->
<p>Pronto publicaremos nuevos artículos.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->
