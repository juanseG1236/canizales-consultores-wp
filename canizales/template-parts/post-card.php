<?php
/**
 * Tarjeta de artículo.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

$cat = get_the_category();
?>
<article <?php post_class( 'post-card reveal' ); ?>>
	<a class="post-card__link" href="<?php the_permalink(); ?>">
		<div class="post-card__media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'canizales-card', array( 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<span class="post-card__placeholder" aria-hidden="true"><?php echo canizales_rays( '', 9 ); // phpcs:ignore ?></span>
			<?php endif; ?>
		</div>
		<div class="post-card__body">
			<p class="post-card__meta">
				<?php if ( $cat && 'sin-categoria' !== $cat[0]->slug && 'uncategorized' !== $cat[0]->slug ) : ?>
					<span><?php echo esc_html( $cat[0]->name ); ?></span> ·
				<?php endif; ?>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			</p>
			<h3 class="post-card__title"><?php the_title(); ?></h3>
			<p class="post-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<span class="link-arrow"><?php esc_html_e( 'Leer artículo', 'canizales' ); ?> <?php echo canizales_icon( 'arrow' ); // phpcs:ignore ?></span>
		</div>
	</a>
</article>
