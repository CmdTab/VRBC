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
					Sermons
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php //while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );
				?>
				<?php
					$taxonomy = 'series';
					$args = array(
						'orderby'       => 'ID',
						'order'         => 'DESC'
					);
					$terms = get_terms($taxonomy, $args); // Get all terms of a taxonomy

					if ( $terms && !is_wp_error( $terms ) ) :
				?>
				    <ul class="three-list series-list group">
				        <?php foreach ( $terms as $term ) { ?>
				            <li>
				            	<?php $custom_field = get_field('series_image', $taxonomy . '_' . $term->term_id );
				            	?>

				            	<?php the_field('series_image', 'series'); ?>
				            	<a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">
				            		<img src = "<?php echo $custom_field; ?>">
				            		<?php echo $term->name; ?></a></li>
				        <?php } ?>
				    </ul>
				<?php endif;?>

			<?php //endwhile; ?>

			<?php church_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div><!-- #primary -->

	</div><!--page-container-->
<?php get_footer(); ?>
