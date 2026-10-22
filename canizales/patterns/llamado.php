<?php
/**
 * Title: Franja de llamado a la acción
 * Slug: canizales/llamado
 * Categories: canizales, call-to-action
 * Description: Franja verde con rayos de luz, frase y botones de contacto.
 *
 * @package Canizales
 */

$canizales_wa = 'https://wa.me/573116356306?text=' . rawurlencode( 'Hola, quisiera agendar una asesoría con Canizales Consultores.' );
?>
<!-- wp:group {"align":"full","className":"is-style-seccion-rayos llamado","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-seccion-rayos llamado"><!-- wp:columns {"verticalAlignment":"bottom","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-bottom"><!-- wp:column {"verticalAlignment":"bottom","width":"62%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:62%"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Agenda tu asesoría</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"titulo-ligero"} -->
<h2 class="wp-block-heading titulo-ligero">La claridad es el primer paso para avanzar.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cuéntenos la situación de su empresa o la suya como persona natural. Analizamos el caso y le orientamos sobre las alternativas que contempla la ley.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom"} -->
<div class="wp-block-column is-vertically-aligned-bottom"><!-- wp:buttons {"layout":{"type":"flex","orientation":"vertical","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Agenda tu asesoría</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $canizales_wa ); ?>" target="_blank" rel="noreferrer noopener">Escribir por WhatsApp</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
