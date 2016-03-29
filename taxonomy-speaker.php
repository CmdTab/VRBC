<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Church
 */

get_header(); ?>

	<div class="page-container group">
		<div id="primary" class="primary">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="entry-title speaker-archive">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'church' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'church' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'church' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'church' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'church' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'church' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'church' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'church');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'church');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'church' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'church' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'church' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'church' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'church' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'church' );
						elseif ( is_tax( 'series' ) ) :
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							echo $term->name;
						elseif ( is_tax( 'speaker' ) ) :
							$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
							echo $term->name;
						else :
							_e( 'Archives', 'church' );

						endif;
					?>
				</h1>
			</header><!-- .page-header -->
			<div class="primary third sermon-archive">
					<?php

						// vars
						$queried_object = get_queried_object();
						$taxonomy = $queried_object->taxonomy;
						$term_id = $queried_object->term_id;

						// load thumbnail for this taxonomy term (term string)
						$thumbnail = get_field('teacher_photo', $taxonomy . '_' . $term_id);

					?>
						<img src = "<?php echo $thumbnail; ?>">
					<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					?>
				</div>
			<div id="sermon-box" class="sermon-content two-third page group">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'sermons' );
					?>

					<?php endwhile; ?>

					<?php speaker_paging_nav(); ?>

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>
			</div>
		</div><!-- #primary -->

		<?php //get_sidebar(); ?>
	</div><!--page-container-->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
