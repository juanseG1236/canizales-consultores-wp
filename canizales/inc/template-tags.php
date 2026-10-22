<?php
/**
 * Funciones de apoyo para las plantillas.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_whatsapp_url( $mensaje = '' ) {
	$numero = preg_replace( '/\D+/', '', canizales_opt( 'whatsapp' ) );
	if ( ! $numero ) {
		return '';
	}
	$mensaje = $mensaje ? $mensaje : canizales_opt( 'whatsapp_mensaje' );
	return 'https://wa.me/' . $numero . ( $mensaje ? '?text=' . rawurlencode( $mensaje ) : '' );
}

function canizales_tel_url() {
	return 'tel:+' . ltrim( preg_replace( '/\D+/', '', canizales_opt( 'telefono' ) ), '+' );
}

function canizales_years() {
	return max( 1, (int) wp_date( 'Y' ) - (int) canizales_opt( 'anio_fundacion' ) );
}

/**
 * Enlace a una página del sitio por su slug, con alternativa si no existe.
 */
function canizales_page_link( $slug, $fallback = '' ) {
	$page = get_page_by_path( $slug );
	if ( $page && 'publish' === $page->post_status ) {
		return get_permalink( $page );
	}
	return $fallback ? $fallback : home_url( '/' . $slug . '/' );
}

function canizales_contact_url() {
	return canizales_page_link( 'contacto' );
}

function canizales_logo( $variant = 'header' ) {
	$name = get_bloginfo( 'name' );
	if ( has_custom_logo() ) {
		$logo_id = get_theme_mod( 'custom_logo' );
		$img     = wp_get_attachment_image(
			$logo_id,
			'full',
			false,
			array(
				'class'         => 'brand__logo',
				'alt'           => $name,
				'fetchpriority' => 'header' === $variant ? 'high' : 'auto',
			)
		);
	} else {
		$img = sprintf(
			'<img class="brand__logo" src="%s" alt="%s" width="220" height="240">',
			esc_url( CANIZALES_URI . '/assets/img/logo.png' ),
			esc_attr( $name )
		);
	}

	printf(
		'<a class="brand brand--%1$s" href="%2$s" rel="home" aria-label="%3$s">%4$s</a>',
		esc_attr( $variant ),
		esc_url( home_url( '/' ) ),
		esc_attr( $name . ' — ' . __( 'Inicio', 'canizales' ) ),
		$img // phpcs:ignore WordPress.Security.EscapeOutput
	);
}

/**
 * Íconos SVG de trazo fino, en línea con el lenguaje gráfico del manual.
 */
function canizales_icon( $name, $class = '' ) {
	$paths = array(
		'arrow'     => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'chevron'   => '<path d="M9 6l6 6-6 6"/>',
		'phone'     => '<path d="M5 4h3l2 5-2.5 1.5a11 11 0 0 0 6 6L15 14l5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2"/>',
		'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'pin'       => '<path d="M12 21s-7-6.2-7-12a7 7 0 0 1 14 0c0 5.8-7 12-7 12z"/><circle cx="12" cy="9" r="2.5"/>',
		'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'menu'      => '<path d="M4 7h16M4 12h16M4 17h10"/>',
		'close'     => '<path d="M6 6l12 12M18 6 6 18"/>',
		'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/>',
		'facebook'  => '<path d="M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v6h4v-6h3l1-4h-4V8z"/>',
		'linkedin'  => '<rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 10v7"/>',
		'whatsapp'  => '<path d="M4 20l1.3-4A8 8 0 1 1 8 18.7z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1-1.5-2-1-1 .8a4 4 0 0 1-1.8-1.8l.8-1-1-2z"/>',
		'shield'    => '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="M9 12l2 2 4-4"/>',
		'compass'   => '<circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5z"/>',
		'chart'     => '<path d="M4 20V4M4 20h16M8 16v-5M12 16V8M16 16v-3"/>',
		'scale'     => '<path d="M12 4v16M6 20h12M5 8h14M7 8l-3 6a3 3 0 0 0 6 0zM17 8l-3 6a3 3 0 0 0 6 0z"/>',
		'doc'       => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5M9 13h6M9 17h6"/>',
		'users'     => '<circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0M16 4.5a3.5 3.5 0 0 1 0 7M18 14.5a6.5 6.5 0 0 1 3.5 5.5"/>',
		'play'      => '<circle cx="12" cy="12" r="10"/><path d="m10 8 6 4-6 4z" fill="currentColor"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="icon icon--%1$s %2$s" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		esc_attr( $class ),
		$paths[ $name ]
	);
}

/**
 * Rayos de luz del faro: trazos finos y direccionales que salen de un punto.
 *
 * @param string $class Clase CSS adicional.
 * @param int    $count Número de rayos.
 */
function canizales_rays( $class = '', $count = 15 ) {
	$lines = '';
	$ox    = 0;
	$oy    = 0;
	for ( $i = 0; $i < $count; $i++ ) {
		$angle   = deg2rad( 4 + ( 82 / max( 1, $count - 1 ) ) * $i );
		$length  = 1600 + ( $i % 3 ) * 200;
		$x2      = round( $ox + cos( $angle ) * $length, 1 );
		$y2      = round( $oy + sin( $angle ) * $length, 1 );
		$lines  .= sprintf( '<line x1="%s" y1="%s" x2="%s" y2="%s" style="--i:%d"/>', $ox, $oy, $x2, $y2, $i );
	}
	$uid = wp_unique_id( 'rays-' );

	return sprintf(
		'<svg class="rays %1$s" viewBox="0 0 1200 900" preserveAspectRatio="xMinYMin slice" aria-hidden="true" focusable="false"><defs><radialGradient id="%2$s" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="scale(1400)"><stop offset="0" stop-color="currentColor" stop-opacity=".55"/><stop offset=".6" stop-color="currentColor" stop-opacity=".12"/><stop offset="1" stop-color="currentColor" stop-opacity="0"/></radialGradient></defs><g stroke="url(#%2$s)" stroke-width="1">%3$s</g></svg>',
		esc_attr( $class ),
		esc_attr( $uid ),
		$lines
	);
}

function canizales_eyebrow( $text, $class = '' ) {
	printf( '<p class="eyebrow %s"><span class="eyebrow__dot" aria-hidden="true"></span>%s</p>', esc_attr( $class ), esc_html( $text ) );
}

/**
 * Cabecera de páginas interiores.
 */
function canizales_page_hero( $title, $lead = '', $eyebrow = '' ) {
	?>
	<header class="page-hero">
		<?php echo canizales_rays( 'page-hero__rays', 11 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<div class="container page-hero__inner">
			<?php canizales_breadcrumbs(); ?>
			<?php if ( $eyebrow ) : ?>
				<?php canizales_eyebrow( $eyebrow, 'eyebrow--light' ); ?>
			<?php endif; ?>
			<h1 class="page-hero__title reveal"><?php echo wp_kses_post( $title ); ?></h1>
			<?php if ( $lead ) : ?>
				<p class="page-hero__lead reveal"><?php echo wp_kses_post( $lead ); ?></p>
			<?php endif; ?>
		</div>
	</header>
	<?php
}

function canizales_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$items   = array();
	$items[] = array( __( 'Inicio', 'canizales' ), home_url( '/' ) );

	if ( is_singular( 'servicio' ) ) {
		$items[] = array( __( 'Servicios', 'canizales' ), canizales_page_link( 'servicios' ) );
	} elseif ( is_singular( 'post' ) || is_category() || is_tag() ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		if ( $blog_id ) {
			$items[] = array( get_the_title( $blog_id ), get_permalink( $blog_id ) );
		}
	} elseif ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor ) {
			$items[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
		}
	}

	if ( is_singular() ) {
		$current = get_the_title();
	} elseif ( is_home() ) {
		$current = '';
	} elseif ( is_search() ) {
		$current = __( 'Búsqueda', 'canizales' );
	} elseif ( is_404() ) {
		$current = __( 'Página no encontrada', 'canizales' );
	} else {
		$current = wp_strip_all_tags( get_the_archive_title() );
	}
	if ( is_home() && get_option( 'page_for_posts' ) ) {
		$current = get_the_title( get_option( 'page_for_posts' ) );
	}

	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Ruta de navegación', 'canizales' ) . '"><ol>';
	foreach ( $items as $item ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $item[1] ), esc_html( $item[0] ) );
	}
	if ( $current ) {
		printf( '<li aria-current="page">%s</li>', esc_html( $current ) );
	}
	echo '</ol></nav>';
}

function canizales_fallback_menu( $args = array() ) {
	$slugs = array(
		'la-firma'                     => __( 'La Firma', 'canizales' ),
		'insolvencia-y-reorganizacion' => __( 'Insolvencia', 'canizales' ),
		'servicios'                    => __( 'Servicios', 'canizales' ),
		'recursos'                     => __( 'Recursos', 'canizales' ),
		'contacto'                     => __( 'Contacto', 'canizales' ),
	);
	$class = isset( $args['menu_class'] ) ? $args['menu_class'] : 'menu';
	echo '<ul class="' . esc_attr( $class ) . '">';
	foreach ( $slugs as $slug => $label ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			continue;
		}
		$current = is_page( $page->ID ) ? ' class="current-menu-item"' : '';
		printf( '<li%s><a href="%s">%s</a></li>', $current, esc_url( get_permalink( $page ) ), esc_html( $label ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</ul>';
}

function canizales_social_links( $class = '' ) {
	$redes = array(
		'instagram' => 'Instagram',
		'facebook'  => 'Facebook',
		'linkedin'  => 'LinkedIn',
	);
	$out = '';
	foreach ( $redes as $key => $label ) {
		$url = canizales_opt( $key );
		if ( $url ) {
			$out .= sprintf( '<li><a href="%s" target="_blank" rel="noopener" aria-label="%s">%s</a></li>', esc_url( $url ), esc_attr( $label ), canizales_icon( $key ) );
		}
	}
	if ( $out ) {
		echo '<ul class="social ' . esc_attr( $class ) . '">' . $out . '</ul>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

/**
 * Bloque de llamado a la acción reutilizable al final de las páginas.
 */
function canizales_cta_band( $title = '', $text = '' ) {
	$title = $title ? $title : __( 'La claridad es el primer paso para avanzar.', 'canizales' );
	$text  = $text ? $text : __( 'Cuéntenos la situación de su empresa o la suya como persona natural. Analizamos el caso y le orientamos sobre las alternativas que contempla la ley.', 'canizales' );
	get_template_part(
		'template-parts/cta-band',
		null,
		array(
			'title' => $title,
			'text'  => $text,
		)
	);
}
