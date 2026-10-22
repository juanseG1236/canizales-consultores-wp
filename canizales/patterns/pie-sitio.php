<?php
/**
 * Title: Pie de página del sitio
 * Slug: canizales/pie-sitio
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package Canizales
 */

$canizales_wa = 'https://wa.me/573116356306?text=' . rawurlencode( 'Hola, quisiera agendar una asesoría con Canizales Consultores.' );
?>
<!-- wp:group {"align":"full","className":"sitio-pie","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull sitio-pie"><!-- wp:columns {"align":"wide","className":"sitio-pie__columnas"} -->
<div class="wp-block-columns alignwide sitio-pie__columnas"><!-- wp:column {"width":"32%"} -->
<div class="wp-block-column" style="flex-basis:32%"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"sitio-pie__logo"} -->
<figure class="wp-block-image size-full sitio-pie__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo.png' ) ); ?>" alt="Canizales Consultores"/></a></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"textColor":"gris"} -->
<p class="has-gris-color has-text-color">Asesoría jurídica y financiera en insolvencia y reorganización empresarial. Desde 1999.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">La firma</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"lista-enlaces"} -->
<ul class="wp-block-list lista-enlaces"><!-- wp:list-item -->
<li><a href="<?php echo esc_url( home_url( '/la-firma/' ) ); ?>">La Firma</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( home_url( '/insolvencia-y-reorganizacion/' ) ); ?>">Insolvencia</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>">Servicios</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( home_url( '/recursos/' ) ); ?>">Recursos</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Servicios</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":90,"query":{"perPage":10,"pages":0,"offset":0,"postType":"servicio","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"lista-enlaces"} -->
<div class="wp-block-query lista-enlaces"><!-- wp:post-template -->
<!-- wp:post-title {"isLink":true,"fontSize":"medium","fontFamily":"garet"} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Contacto</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"lista-enlaces lista-contacto"} -->
<ul class="wp-block-list lista-enlaces lista-contacto"><!-- wp:list-item -->
<li><a href="<?php echo esc_url( $canizales_wa ); ?>">WhatsApp +57 311 635 6306</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Colombia</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Lunes a viernes · 8:00 a. m. – 5:00 p. m.</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"wide","className":"sitio-pie__base","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide sitio-pie__base"><!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">© [canizales_anio] Canizales Consultores S.A.S. Todos los derechos reservados.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">La información publicada es de carácter general y no constituye asesoría para un caso particular.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"wa-flotante"} -->
<div class="wp-block-buttons wa-flotante"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $canizales_wa ); ?>" target="_blank" rel="noreferrer noopener">WhatsApp</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
