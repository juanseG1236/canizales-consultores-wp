<?php
/**
 * Title: Ley 1116 — caminos de la insolvencia
 * Slug: canizales/ley-1116
 * Categories: canizales, featured
 * Description: Sección verde con rayos de luz, texto y tres tarjetas.
 *
 * @package Canizales
 */

$canizales_tarjetas = array(
	array( 'Continuidad', 'Reorganización empresarial', 'Reestructurar deudas y compromisos mediante un acuerdo con los acreedores para restablecer la viabilidad de la empresa.' ),
	array( 'Cierre ordenado', 'Liquidación judicial', 'Cerrar las operaciones de manera ordenada cuando la empresa no puede continuar, conforme al orden legal.' ),
);
?>
<!-- wp:group {"align":"full","className":"is-style-seccion-rayos","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion-rayos"><!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"columnas-amplias"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center columnas-amplias"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Ley 1116 de 2006</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Cuando la empresa enfrenta una crisis, la ley ofrece caminos.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>El régimen de insolvencia busca proteger el crédito, promover la continuidad de las empresas viables y preservar el empleo. Le ayudamos a entender cuál es el mecanismo adecuado y a recorrerlo con orden.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-flecha"} -->
<div class="wp-block-button is-style-flecha"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/insolvencia-y-reorganizacion/' ) ); ?>">Insolvencia y reorganización</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:columns {"className":"tarjetas"} -->
<div class="wp-block-columns tarjetas"><?php foreach ( $canizales_tarjetas as $canizales_t ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-tarjeta-linea","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-tarjeta-linea"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo"><?php echo esc_html( $canizales_t[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $canizales_t[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $canizales_t[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns -->

<!-- wp:group {"className":"is-style-tarjeta-linea","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-tarjeta-linea"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Ley 1564 de 2012</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Insolvencia de persona natural</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Negociación de deudas, convalidación de acuerdos privados y liquidación patrimonial para personas naturales no comerciantes.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
