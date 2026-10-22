<?php
/**
 * Title: Portada con foto del faro
 * Slug: canizales/portada
 * Categories: canizales, banner
 * Description: Primera pantalla con foto de fondo, título grande y botones. La foto se cambia en Estilos del bloque → Fondo.
 *
 * @package Canizales
 */

$canizales_bg = array(
	'background' => array(
		'backgroundImage'    => array(
			'url'    => get_theme_file_uri( 'assets/img/faro-haz.jpg' ),
			'source' => 'file',
			'title'  => 'Faro',
		),
		'backgroundSize'     => 'cover',
		'backgroundPosition' => '72% 30%',
	),
);
$canizales_attrs = array(
	'align'     => 'full',
	'className' => 'is-style-faro',
	'style'     => $canizales_bg,
	'layout'    => array( 'type' => 'constrained' ),
);
?>
<!-- wp:group <?php echo wp_json_encode( $canizales_attrs, JSON_UNESCAPED_SLASHES ); ?> -->
<div class="wp-block-group alignfull is-style-faro"><!-- wp:group {"align":"wide","className":"portada__contenido","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide portada__contenido"><!-- wp:paragraph {"className":"is-style-antetitulo"} -->
<p class="is-style-antetitulo">Insolvencia y reorganización empresarial · Desde 1999</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"fontSize":"display"} -->
<h1 class="wp-block-heading has-display-font-size">Claridad para decidir y <em>avanzar.</em></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"portada__texto","fontSize":"large"} -->
<p class="portada__texto has-large-font-size">Acompañamos a empresas y personas naturales que enfrentan una crisis financiera, con análisis jurídico y financiero riguroso y una comunicación clara en cada etapa.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Agenda tu asesoría</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/insolvencia-y-reorganizacion/' ) ); ?>">Conocer la Ley 1116</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
