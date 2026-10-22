<?php
/**
 * Listado de artículos (Recursos), archivos y búsqueda.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

$blog_id = (int) get_option( 'page_for_posts' );
$title   = $blog_id ? get_the_title( $blog_id ) : __( 'Recursos', 'canizales' );
$lead    = $blog_id && has_excerpt( $blog_id ) ? get_the_excerpt( $blog_id ) : __( 'Artículos y guías para entender la insolvencia, la reorganización y la salud financiera de su empresa.', 'canizales' );

if ( is_search() ) {
	/* translators: %s: término buscado */
	$title = sprintf( __( 'Resultados para «%s»', 'canizales' ), get_search_query() );
	$lead  = '';
} elseif ( is_archive() ) {
	$title = get_the_archive_title();
	$lead  = get_the_archive_description();
}

canizales_page_hero( $title, $lead );
?>
<div class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
			</div>
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => __( 'Anterior', 'canizales' ),
					'next_text' => __( 'Siguiente', 'canizales' ),
				)
			);
			?>
		<?php else : ?>
			<div class="empty-state">
				<h2><?php esc_html_e( 'Pronto publicaremos nuevos artículos.', 'canizales' ); ?></h2>
				<p><?php esc_html_e( 'Mientras tanto, puede escribirnos con su pregunta.', 'canizales' ); ?></p>
				<a class="btn btn--forest" href="<?php echo esc_url( canizales_contact_url() ); ?>"><?php esc_html_e( 'Contactar', 'canizales' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php
canizales_cta_band();
get_footer();
