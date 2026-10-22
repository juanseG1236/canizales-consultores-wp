<?php
/**
 * Title: Servicios en tarjetas (con detalle)
 * Slug: canizales/servicios-tarjetas
 * Categories: canizales, services
 * Description: Todos los servicios del menú Servicios en tarjetas de dos columnas, con su lista de puntos.
 *
 * @package Canizales
 */

?>
<!-- wp:group {"align":"full","className":"is-style-seccion","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion"><!-- wp:query {"queryId":40,"query":{"perPage":20,"pages":0,"offset":0,"postType":"servicio","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","className":"is-style-tarjetas tarjetas-servicio"} -->
<div class="wp-block-query alignwide is-style-tarjetas tarjetas-servicio"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:group {"className":"tarjeta__cuerpo","layout":{"type":"default"}} -->
<div class="wp-block-group tarjeta__cuerpo"><!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /-->

<!-- wp:post-content /-->

<!-- wp:read-more {"content":"Ver detalle"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->

<!-- wp:paragraph {"align":"center","className":"nota-final"} -->
<p class="has-text-align-center nota-final">Tenemos servicios para cada necesidad. Consúltenos: le orientaremos, ese es nuestro compromiso.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
