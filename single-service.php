<?php
/**
 * The template for displaying a single event
 *
 * Please note that since 1.7, this template is not used by default. You can edit the 'event details'
 * by using the event-meta-event-single.php template.
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme. You can use this template as a guide.
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://wp-event-organiser.com/documentation/editing-the-templates/ for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

<div class="page-container group">
	<div class="single-event-container group">
		<div class="service-breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>service">
				<?php include('svg/icon-left.php'); ?>Back to All Service Dates
			</a>
		</div>

		<div class="event-detail-mobile group">
			<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} else {
					echo '<img src="http://placehold.it/500x500 />';
				}
			?>
			<header class="entry-header">

				<!-- Display event title -->
				<h1 class="entry-title"><?php the_title(); ?></h1>

			</header><!-- .entry-header -->



			<?php get_sidebar('details-mobile'); ?>
		</div>

		<div id="primary" class="primary two-third first group">
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">

				<!-- Display event title -->
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<!-- Get event information, see template: event-meta-event-single.php -->
				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
				?>
				<?php //eo_get_template_part('event-meta','event-single'); ?>

				<!-- The content or the description of the event-->
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<div class="more-info-container group">

				<?php if( get_field('choose_form') == 'contact' ): ?>

					<?php

						$post_object = get_field('event_page');

						if( $post_object ):

							// override $post
							$post = $post_object;
							setup_postdata( $post );

							?>

							<div class="half first serve">
								<h2><?php the_field('serve_title' , 'option'); ?></h2>
								<p><?php the_field('serve_text_area' , 'option'); ?></p>
								<a href="#" class="btn contact-form-trigger"><?php the_field('serve_button_text' , 'option'); ?></a>
							</div>

							<div class="half attend">
								<h2><?php the_field('attend_title' , 'option'); ?></h2>
								<p><?php the_field('attend_text_area' , 'option'); ?></p>
								<a href="<?php echo $post_object; ?>" class="btn"><?php the_field('attend_button_text' , 'option'); ?></a>
							</div>

						<?php else: ?>

							<div class="serve">
								<h2><?php the_field('serve_title' , 'option'); ?></h2>
								<p><?php the_field('serve_text_area' , 'option'); ?></p>
								<a href="#" class="btn contact-form-trigger"><?php the_field('serve_button_text' , 'option'); ?></a>
							</div>

						<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; ?>

				<?php endif; ?>

				<?php if( get_field('choose_form') == 'external' ): ?>

					<?php
						$external_link = get_field('external_form_link');
						$post_object = get_field('event_page');

						if( $post_object ):

							// override $post
							$post = $post_object;
							setup_postdata( $post );

							?>

							<div class="half first serve">
								<h2><?php the_field('serve_title' , 'option'); ?></h2>
								<p><?php the_field('serve_text_area' , 'option'); ?></p>
								<a href="<?php echo $external_link; ?>" class="btn" target="_blank"><?php the_field('serve_button_text' , 'option'); ?></a>
							</div>

							<div class="half attend">
								<h2><?php the_field('attend_title' , 'option'); ?></h2>
								<p><?php the_field('attend_text_area' , 'option'); ?></p>
								<a href="<?php echo $post_object; ?>" class="btn"><?php the_field('attend_button_text' , 'option'); ?></a>
							</div>

						<?php else: ?>

							<div class="serve">
								<h2><?php the_field('serve_title' , 'option'); ?></h2>
								<p><?php the_field('serve_text_area' , 'option'); ?></p>
								<a href="<?php echo $external_link; ?>" class="btn" target="_blank"><?php the_field('serve_button_text' , 'option'); ?></a>
							</div>

						<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; ?>

				<?php endif; ?>



			</div>

			<footer class="entry-meta">
			<?php
				// Events have their own 'event-category' taxonomy. Get list of categories this event is in.
				// $categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ','');

				// if ( '' != $categories_list ) {
				// 	$utility_text = __( 'Event category: %1$s', 'eventorganiser' );
				// }
				// printf($utility_text,
				// 	$categories_list,
				// 	esc_url( get_permalink() ),
				// 	the_title_attribute( 'echo=0' ),
				// 	get_the_author(),
				// 	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
				// );
			?>

			<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->

			</article><!-- #post-<?php the_ID(); ?> -->

			<!-- If comments are enabled, show them -->
			<!--<div class="comments-template">
				<?php //comments_template(); ?>
			</div>-->

			<?php endwhile; // end of the loop. ?>
		</div><!-- #primary -->

		<div class="event-detail-desktop group">
			<?php get_sidebar('service'); ?>
		</div>
	</div>
</div><!--page-container-->

<?php get_footer(); ?>
