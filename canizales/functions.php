<?php
/**
 * Canizales Consultores — funciones del tema.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

define( 'CANIZALES_VERSION', '2.0.0' );
define( 'CANIZALES_DIR', get_template_directory() );
define( 'CANIZALES_URI', get_template_directory_uri() );

require CANIZALES_DIR . '/inc/setup.php';
require CANIZALES_DIR . '/inc/post-types.php';
require CANIZALES_DIR . '/inc/shortcodes.php';
require CANIZALES_DIR . '/inc/contact-form.php';
require CANIZALES_DIR . '/inc/seo.php';
require CANIZALES_DIR . '/inc/seed.php';
