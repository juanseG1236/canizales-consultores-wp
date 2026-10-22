<?php
/**
 * SEO básico: descripción, Open Graph y datos estructurados.
 * Se desactiva solo si hay un plugin de SEO activo (Yoast, Rank Math, SEOPress).
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

function canizales_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' );
}

function canizales_meta_description() {
	$default = __( 'Canizales Consultores S.A.S.: asesoría jurídica y financiera en insolvencia y reorganización empresarial en Colombia desde 1999. Ley 1116 de 2006, liquidación judicial e insolvencia de persona natural.', 'canizales' );

	if ( is_singular() ) {
		$post = get_queried_object();
		if ( $post && has_excerpt( $post ) ) {
			return wp_strip_all_tags( get_the_excerpt( $post ) );
		}
		if ( $post && ! is_front_page() ) {
			$text = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
			if ( $text ) {
				return wp_trim_words( $text, 28, '…' );
			}
		}
	}
	return $default;
}

function canizales_seo_head() {
	if ( canizales_seo_plugin_active() ) {
		return;
	}

	$desc  = canizales_meta_description();
	$title = wp_get_document_title();
	$url   = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
	$image = CANIZALES_URI . '/assets/img/faro-haz.jpg';
	if ( is_singular() && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( null, 'canizales-hero' );
	}

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:locale" content="es_CO">' . "\n" );
	printf( '<meta property="og:type" content="%s">' . "\n", is_singular( 'post' ) ? 'article' : 'website' );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
}
add_action( 'wp_head', 'canizales_seo_head', 3 );

function canizales_schema() {
	if ( ! is_front_page() || canizales_seo_plugin_active() ) {
		return;
	}

	$same_as = array_values( array_filter( array( canizales_opt( 'instagram' ), canizales_opt( 'facebook' ), canizales_opt( 'linkedin' ) ) ) );

	$schema = array(
		'@context'     => 'https://schema.org',
		'@type'        => array( 'LegalService', 'ProfessionalService' ),
		'name'         => 'Canizales Consultores S.A.S.',
		'url'          => home_url( '/' ),
		'logo'         => CANIZALES_URI . '/assets/img/logo.png',
		'image'        => CANIZALES_URI . '/assets/img/faro-haz.jpg',
		'description'  => canizales_meta_description(),
		'foundingDate' => canizales_opt( 'anio_fundacion' ),
		'founder'      => array(
			'@type' => 'Person',
			'name'  => 'Ángel M. Canizales',
		),
		'areaServed'   => array(
			'@type' => 'Country',
			'name'  => 'Colombia',
		),
		'knowsAbout'   => array( 'Insolvencia empresarial', 'Reorganización empresarial', 'Ley 1116 de 2006', 'Liquidación judicial', 'Insolvencia de persona natural', 'Reestructuración financiera' ),
		'telephone'    => canizales_opt( 'telefono' ),
	);

	if ( canizales_opt( 'email' ) ) {
		$schema['email'] = canizales_opt( 'email' );
	}
	if ( canizales_opt( 'direccion' ) ) {
		$schema['address'] = array(
			'@type'          => 'PostalAddress',
			'streetAddress'  => canizales_opt( 'direccion' ),
			'addressLocality' => canizales_opt( 'ciudad' ),
			'addressCountry' => 'CO',
		);
	}
	if ( $same_as ) {
		$schema['sameAs'] = $same_as;
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'canizales_schema', 20 );
