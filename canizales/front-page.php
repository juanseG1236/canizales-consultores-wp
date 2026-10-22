<?php
/**
 * Portada.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

$titulo   = canizales_opt( 'hero_titulo' );
$palabras = explode( ' ', trim( $titulo ) );
$ultima   = array_pop( $palabras );
$titulo   = esc_html( implode( ' ', $palabras ) ) . ( $palabras ? ' ' : '' ) . '<em>' . esc_html( $ultima ) . '</em>';

$servicios   = canizales_get_servicios();
$insolvencia = canizales_page_link( 'insolvencia-y-reorganizacion' );
$wa          = canizales_whatsapp_url();
$posts       = get_posts(
	array(
		'posts_per_page' => 3,
		'no_found_rows'  => true,
	)
);
?>

<section class="hero" aria-labelledby="hero-title">
	<div class="hero__media" aria-hidden="true">
		<img src="<?php echo esc_url( CANIZALES_URI . '/assets/img/faro-haz.jpg' ); ?>" alt="" width="1024" height="577" fetchpriority="high" decoding="async">
	</div>
	<div class="container hero__inner">
		<div class="hero__copy">
			<?php canizales_eyebrow( canizales_opt( 'hero_antetitulo' ), 'eyebrow--light hero__eyebrow' ); ?>
			<h1 id="hero-title" class="hero__title"><?php echo $titulo; // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
			<p class="hero__lead"><?php echo esc_html( canizales_opt( 'hero_texto' ) ); ?></p>
			<div class="hero__actions">
				<a class="btn btn--olive btn--lg" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php echo esc_html( canizales_opt( 'cta_texto' ) ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
				<a class="btn btn--ghost-light btn--lg" href="<?php echo esc_url( $insolvencia ); ?>"><?php esc_html_e( 'Conocer la Ley 1116', 'canizales' ); ?></a>
			</div>
		</div>
	</div>

	<div class="hero__facts">
		<ul class="container facts">
			<li class="fact">
				<span class="fact__value"><?php echo esc_html( canizales_years() ); ?></span>
				<span class="fact__label"><?php esc_html_e( 'años de trayectoria, desde 1999', 'canizales' ); ?></span>
			</li>
			<li class="fact">
				<span class="fact__value">1116</span>
				<span class="fact__label"><?php esc_html_e( 'Especialistas en el régimen de insolvencia de 2006', 'canizales' ); ?></span>
			</li>
			<li class="fact">
				<span class="fact__value fact__value--text"><?php esc_html_e( 'Supersociedades', 'canizales' ); ?></span>
				<span class="fact__label"><?php esc_html_e( 'Experiencia como auxiliares de la justicia: promotores y liquidadores', 'canizales' ); ?></span>
			</li>
			<li class="fact">
				<span class="fact__value fact__value--text"><?php esc_html_e( 'Empresas y familias', 'canizales' ); ?></span>
				<span class="fact__label"><?php esc_html_e( 'Personas jurídicas y personas naturales', 'canizales' ); ?></span>
			</li>
		</ul>
	</div>
</section>

<section class="section intro" aria-labelledby="intro-title">
	<div class="container intro__grid">
		<div class="intro__statement">
			<?php canizales_eyebrow( __( 'Quiénes somos', 'canizales' ) ); ?>
			<h2 id="intro-title" class="display reveal"><?php esc_html_e( 'Transformamos la crisis en oportunidad, siendo solución para empresas y familias.', 'canizales' ); ?></h2>
		</div>
		<div class="intro__body reveal">
			<p class="lead"><?php esc_html_e( 'Desde 1999 acompañamos a empresas y personas naturales en la búsqueda de soluciones sostenibles ante situaciones de crisis financiera, con un enfoque estratégico y humano orientado a preservar el patrimonio y la continuidad empresarial.', 'canizales' ); ?></p>
			<p><?php esc_html_e( 'Somos un equipo interdisciplinario con experiencia en dirección, investigación y desarrollo, que presta servicios a empresas de los sectores industrial, financiero, comercial, de servicios y solidario, con herramientas prácticas adaptadas a cada organización.', 'canizales' ); ?></p>
			<a class="link-arrow" href="<?php echo esc_url( canizales_page_link( 'la-firma' ) ); ?>"><?php esc_html_e( 'Conozca la firma', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
		</div>
	</div>
</section>

<?php if ( $servicios ) : ?>
<section class="section services" aria-labelledby="services-title">
	<div class="container">
		<header class="section-head">
			<?php canizales_eyebrow( __( 'Áreas de práctica', 'canizales' ) ); ?>
			<h2 id="services-title" class="section-title reveal"><?php esc_html_e( 'Un acompañamiento integral, jurídico y financiero.', 'canizales' ); ?></h2>
			<a class="link-arrow section-head__link" href="<?php echo esc_url( canizales_page_link( 'servicios' ) ); ?>"><?php esc_html_e( 'Ver todos los servicios', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
		</header>

		<ol class="service-rows">
			<?php foreach ( $servicios as $i => $servicio ) : ?>
				<li class="service-row reveal">
					<a href="<?php echo esc_url( get_permalink( $servicio ) ); ?>">
						<span class="service-row__num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
						<span class="service-row__title"><?php echo esc_html( get_the_title( $servicio ) ); ?></span>
						<span class="service-row__text"><?php echo esc_html( get_the_excerpt( $servicio ) ); ?></span>
						<span class="service-row__arrow"><?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
<?php endif; ?>

<section class="section feature" aria-labelledby="feature-title">
	<?php echo canizales_rays( 'feature__rays', 17 ); // phpcs:ignore ?>
	<div class="container feature__grid">
		<div class="feature__copy">
			<?php canizales_eyebrow( __( 'Ley 1116 de 2006', 'canizales' ), 'eyebrow--light' ); ?>
			<h2 id="feature-title" class="section-title reveal"><?php esc_html_e( 'Cuando la empresa enfrenta una crisis, la ley ofrece caminos.', 'canizales' ); ?></h2>
			<p class="reveal"><?php esc_html_e( 'El régimen de insolvencia busca proteger el crédito, promover la continuidad de las empresas viables y preservar el empleo. Le ayudamos a entender cuál es el mecanismo adecuado y a recorrerlo con orden.', 'canizales' ); ?></p>
			<a class="link-arrow link-arrow--light" href="<?php echo esc_url( $insolvencia ); ?>"><?php esc_html_e( 'Insolvencia y reorganización', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
		</div>

		<div class="feature__cards">
			<article class="path-card reveal">
				<span class="path-card__tag"><?php esc_html_e( 'Continuidad', 'canizales' ); ?></span>
				<h3><?php esc_html_e( 'Reorganización empresarial', 'canizales' ); ?></h3>
				<p><?php esc_html_e( 'Reestructurar deudas y compromisos mediante un acuerdo con los acreedores para restablecer la viabilidad de la empresa.', 'canizales' ); ?></p>
			</article>
			<article class="path-card reveal">
				<span class="path-card__tag"><?php esc_html_e( 'Cierre ordenado', 'canizales' ); ?></span>
				<h3><?php esc_html_e( 'Liquidación judicial', 'canizales' ); ?></h3>
				<p><?php esc_html_e( 'Cerrar las operaciones de manera ordenada cuando la empresa no puede continuar, conforme al orden legal.', 'canizales' ); ?></p>
			</article>
			<article class="path-card path-card--wide reveal">
				<span class="path-card__tag"><?php esc_html_e( 'Ley 1564 de 2012', 'canizales' ); ?></span>
				<h3><?php esc_html_e( 'Insolvencia de persona natural', 'canizales' ); ?></h3>
				<p><?php esc_html_e( 'Negociación de deudas, convalidación de acuerdos privados y liquidación patrimonial para personas naturales no comerciantes.', 'canizales' ); ?></p>
			</article>
		</div>
	</div>
</section>

<section class="section process" aria-labelledby="process-title">
	<div class="container">
		<header class="section-head section-head--center">
			<?php canizales_eyebrow( __( 'Cómo trabajamos', 'canizales' ) ); ?>
			<h2 id="process-title" class="section-title reveal"><?php esc_html_e( 'Claridad en cada etapa.', 'canizales' ); ?></h2>
		</header>
		<ol class="steps">
			<?php
			$steps = array(
				array( __( 'Escuchamos', 'canizales' ), __( 'Una conversación inicial y confidencial para entender la situación de la empresa o de la persona.', 'canizales' ) ),
				array( __( 'Diagnosticamos', 'canizales' ), __( 'Análisis jurídico y financiero: activos, pasivos, flujo de caja, contingencias y obligaciones vigentes.', 'canizales' ) ),
				array( __( 'Definimos la estrategia', 'canizales' ), __( 'Presentamos las alternativas que contempla la ley y sus implicaciones, para que decida con información.', 'canizales' ) ),
				array( __( 'Acompañamos', 'canizales' ), __( 'Representación y seguimiento en cada etapa del proceso, ante acreedores, jueces y la Superintendencia.', 'canizales' ) ),
			);
			foreach ( $steps as $i => $step ) :
				?>
				<li class="step reveal" style="--d:<?php echo (int) $i; ?>">
					<span class="step__num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3 class="step__title"><?php echo esc_html( $step[0] ); ?></h3>
					<p><?php echo esc_html( $step[1] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<section class="section legacy" aria-label="<?php esc_attr_e( 'Nuestro compromiso', 'canizales' ); ?>">
	<div class="container legacy__inner">
		<span class="legacy__oval" aria-hidden="true"></span>
		<blockquote class="legacy__quote reveal">
			<p><?php esc_html_e( 'Detrás de cada empresa hay personas, esfuerzos y sueños que merecen una segunda oportunidad.', 'canizales' ); ?></p>
			<footer><?php esc_html_e( 'Canizales Consultores · Desde 1999', 'canizales' ); ?></footer>
		</blockquote>
	</div>
</section>

<?php if ( $posts ) : ?>
<section class="section resources" aria-labelledby="resources-title">
	<div class="container">
		<header class="section-head">
			<?php canizales_eyebrow( __( 'Recursos', 'canizales' ) ); ?>
			<h2 id="resources-title" class="section-title reveal"><?php esc_html_e( 'Información para decidir mejor.', 'canizales' ); ?></h2>
			<?php if ( get_option( 'page_for_posts' ) ) : ?>
				<a class="link-arrow section-head__link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Ver todos los artículos', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
			<?php endif; ?>
		</header>
		<div class="post-grid">
			<?php
			foreach ( $posts as $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride
				setup_postdata( $post );
				get_template_part( 'template-parts/post-card' );
			endforeach;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php
canizales_cta_band();
get_footer();
