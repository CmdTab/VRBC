<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Church
 */

get_header(); ?>


	<div class="page-container group">
		<div id="primary" class="primary two-third first">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php church_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!--page-container-->

<?php get_footer(); ?>