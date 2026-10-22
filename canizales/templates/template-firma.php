<?php
/**
 * Template Name: La Firma
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

$video = canizales_opt( 'video_fundador' );
$thumb = '';
$embed = '';
if ( $video ) {
	$cache_key = 'canizales_video_' . md5( $video );
	$data      = get_transient( $cache_key );
	if ( false === $data ) {
		$oembed = _wp_oembed_get_object();
		$data   = $oembed->get_data( $video, array( 'width' => 1280 ) );
		$data   = $data ? (array) $data : array();
		set_transient( $cache_key, $data, WEEK_IN_SECONDS );
	}
	$thumb = isset( $data['thumbnail_url'] ) ? $data['thumbnail_url'] : '';
	if ( preg_match( '~vimeo\.com/(?:video/)?(\d+)~', $video, $m ) ) {
		$embed = 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1&dnt=1';
	} elseif ( preg_match( '~(?:youtu\.be/|v=|embed/)([\w-]{11})~', $video, $m ) ) {
		$embed = 'https://www.youtube-nocookie.com/embed/' . $m[1] . '?autoplay=1&rel=0';
	}
}

while ( have_posts() ) :
	the_post();
	canizales_page_hero( get_the_title(), has_excerpt() ? get_the_excerpt() : '', __( 'Desde 1999', 'canizales' ) );
	?>
	<div class="section section--content">
		<div class="container">
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

	<section class="section founder" aria-labelledby="founder-title">
		<div class="container founder__grid">
			<div class="founder__media reveal">
				<?php if ( $embed ) : ?>
					<button class="video-facade" type="button" data-video="<?php echo esc_url( $embed ); ?>" aria-label="<?php esc_attr_e( 'Reproducir el video en memoria de Ángel M. Canizales', 'canizales' ); ?>">
						<img src="<?php echo esc_url( $thumb ? $thumb : CANIZALES_URI . '/assets/img/faro-haz.jpg' ); ?>" alt="" loading="lazy" decoding="async"<?php echo $thumb ? '' : ' class="is-fallback"'; ?>>
						<span class="video-facade__play"><?php echo canizales_icon( 'play' ); // phpcs:ignore ?></span>
					</button>
				<?php else : ?>
					<div class="founder__oval" aria-hidden="true"><img src="<?php echo esc_url( CANIZALES_URI . '/assets/img/simbolo.svg' ); ?>" alt=""></div>
				<?php endif; ?>
			</div>
			<div class="founder__copy">
				<?php canizales_eyebrow( __( 'En memoria', 'canizales' ) ); ?>
				<h2 id="founder-title" class="section-title reveal"><?php esc_html_e( 'Ángel M. Canizales, fundador', 'canizales' ); ?></h2>
				<p class="reveal"><?php esc_html_e( 'Su visión dio origen a la firma y sigue guiando nuestra forma de trabajar: rigor técnico, ética profesional y compromiso con las personas que hay detrás de cada empresa.', 'canizales' ); ?></p>
				<p class="founder__sign reveal"><?php esc_html_e( 'La claridad guía cada decisión.', 'canizales' ); ?></p>
			</div>
		</div>
	</section>
	<?php
endwhile;

canizales_cta_band();
get_footer();
