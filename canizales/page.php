<?php
/**
 * Página genérica.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	canizales_page_hero( get_the_title(), has_excerpt() ? get_the_excerpt() : '' );
	?>
	<div class="section section--content">
		<div class="container">
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<?php
endwhile;

canizales_cta_band();
get_footer();
