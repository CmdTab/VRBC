<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Church
 */

get_header(); ?>
<div class="page-container group page">
	<div class="content-section group page-search">

		<?php if ( have_posts() ) : ?>

			<header class="page-header search-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'church' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php church_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
	</div>

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
