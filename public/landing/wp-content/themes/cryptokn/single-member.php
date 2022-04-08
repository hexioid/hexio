<?php
/**
 * The template for displaying all single posts.
 *
 */
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'member' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->