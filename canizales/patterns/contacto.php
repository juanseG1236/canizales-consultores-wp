<?php
/**
 * Title: Contacto (formulario y canales)
 * Slug: canizales/contacto
 * Categories: canizales, contact
 * Description: Formulario de contacto a la izquierda y tarjetas de WhatsApp, teléfono y horario a la derecha. Las tarjetas se pueden duplicar o editar.
 *
 * @package Canizales
 */

$canizales_wa = 'https://wa.me/573116356306?text=' . rawurlencode( 'Hola, quisiera agendar una asesoría con Canizales Consultores.' );
$canizales_canales = array(
	array( 'Teléfono', '<a href="tel:+573116356306">+57 311 635 6306</a>' ),
	array( 'Horario', 'Lunes a viernes · 8:00 a. m. – 5:00 p. m.' ),
	array( 'Ubicación', 'Colombia' ),
);
?>
<!-- wp:group {"align":"full","className":"is-style-seccion","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion"><!-- wp:columns {"align":"wide","className":"columnas-amplias"} -->
<div class="wp-block-columns alignwide columnas-amplias"><!-- wp:column {"width":"58%"} -->
<div class="wp-block-column" style="flex-basis:58%"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Escríbanos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gris"} -->
<p class="has-gris-color has-text-color">Toda la información que nos comparta es tratada de forma confidencial.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[canizales_formulario]
<!-- /wp:shortcode --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-panel-bosque canal","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel-bosque canal"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Respuesta más rápida</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"canal__valor"} -->
<p class="canal__valor"><a href="<?php echo esc_url( $canizales_wa ); ?>" target="_blank" rel="noreferrer noopener">Escribir por WhatsApp →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php foreach ( $canizales_canales as $canizales_c ) : ?><!-- wp:group {"className":"is-style-panel canal","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-panel canal"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo"><?php echo esc_html( $canizales_c[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"canal__valor"} -->
<p class="canal__valor"><?php echo wp_kses_post( $canizales_c[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
