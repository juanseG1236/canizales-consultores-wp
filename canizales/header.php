<?php
/**
 * Cabecera del sitio.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#1A3029">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#contenido"><?php esc_html_e( 'Saltar al contenido', 'canizales' ); ?></a>

<header class="site-header" data-header>
	<div class="container site-header__inner">
		<?php if ( has_custom_logo() ) : ?>
			<?php canizales_logo( 'header' ); ?>
		<?php else : ?>
			<a class="brand brand--header" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="brand__mark" src="<?php echo esc_url( CANIZALES_URI . '/assets/img/simbolo.svg' ); ?>" alt="" width="34" height="51">
				<span class="brand__text">
					<span class="brand__name">Canizales</span>
					<span class="brand__sub">Consultores</span>
				</span>
				<span class="screen-reader-text"><?php esc_html_e( '— Inicio', 'canizales' ); ?></span>
			</a>
		<?php endif; ?>

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Principal', 'canizales' ); ?>" data-nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'principal',
					'container'      => false,
					'menu_class'     => 'site-nav__menu',
					'depth'          => 2,
					'fallback_cb'    => 'canizales_fallback_menu',
				)
			);
			?>
			<div class="site-nav__extra">
				<a class="btn btn--light" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php echo esc_html( canizales_opt( 'cta_texto' ) ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></a>
				<?php if ( canizales_opt( 'telefono' ) ) : ?>
					<a class="site-nav__phone" href="<?php echo esc_url( canizales_tel_url() ); ?>"><?php echo canizales_icon( 'phone' ); // phpcs:ignore ?> <?php echo esc_html( canizales_opt( 'telefono' ) ); ?></a>
				<?php endif; ?>
			</div>
		</nav>

		<div class="site-header__actions">
			<a class="btn btn--light btn--sm site-header__cta" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php echo esc_html( canizales_opt( 'cta_texto' ) ); ?></a>
			<button class="nav-toggle" type="button" aria-controls="site-nav" aria-expanded="false" data-nav-toggle>
				<span class="nav-toggle__open"><?php echo canizales_icon( 'menu' ); // phpcs:ignore ?></span>
				<span class="nav-toggle__close"><?php echo canizales_icon( 'close' ); // phpcs:ignore ?></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menú', 'canizales' ); ?></span>
			</button>
		</div>
	</div>
</header>

<main id="contenido" class="site-main">
