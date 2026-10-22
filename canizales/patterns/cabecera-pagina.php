<?php
/**
 * Title: Cabecera de página (verde con rayos)
 * Slug: canizales/cabecera-pagina
 * Categories: canizales, banner
 * Description: Título grande y texto de apoyo sobre fondo verde. Úsela en páginas con la plantilla "Página en blanco".
 *
 * @package Canizales
 */

?>
<!-- wp:group {"align":"full","className":"is-style-cabecera","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-cabecera"><!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:shortcode -->
[canizales_migas]
<!-- /wp:shortcode -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Título de la página</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cabecera__texto","fontSize":"large"} -->
<p class="cabecera__texto has-large-font-size">Texto de apoyo de la página.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
