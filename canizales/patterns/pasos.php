<?php
/**
 * Title: Cómo trabajamos (pasos numerados)
 * Slug: canizales/pasos
 * Categories: canizales
 * Description: Título centrado y columnas numeradas automáticamente, unidas por una línea con puntos.
 *
 * @package Canizales
 */

$canizales_pasos = array(
	array( 'Escuchamos', 'Una conversación inicial y confidencial para entender la situación de la empresa o de la persona.' ),
	array( 'Diagnosticamos', 'Análisis jurídico y financiero: activos, pasivos, flujo de caja, contingencias y obligaciones vigentes.' ),
	array( 'Definimos la estrategia', 'Presentamos las alternativas que contempla la ley y sus implicaciones, para que decida con información.' ),
	array( 'Acompañamos', 'Representación y seguimiento en cada etapa del proceso, ante acreedores, jueces y la Superintendencia.' ),
);
?>
<!-- wp:group {"align":"full","className":"is-style-seccion","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion"><!-- wp:paragraph {"align":"center","className":"is-style-antetitulo"} -->
<p class="has-text-align-center is-style-antetitulo">Cómo trabajamos</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Claridad en cada etapa.</h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","className":"is-style-pasos"} -->
<div class="wp-block-columns alignwide is-style-pasos"><?php foreach ( $canizales_pasos as $canizales_p ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo esc_html( $canizales_p[0] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gris"} -->
<p class="has-gris-color has-text-color"><?php echo esc_html( $canizales_p[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
