<?php
/**
 * The template for displaying an event-category page
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

		<!-- This template follows the TwentyTwelve theme-->
		<div class="page-container group taxonomy-container">

			<div class="serve-banner">
				<img src="<?php bloginfo('template_directory'); ?>/_i/banner-attend.jpg" />
				
				<h1 class="entry-title">
					<?php
						printf( __( '%s', 'eventorganiser' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?>
				</h1>
			</div>

			<div id="primary" class="primary event-archive attend-event">

			<?php if ( have_posts() ) : ?>

				<!-- Page header, display category title-->
				<!-- <header class="event-header">
					<h1 class="entry-title"><?php
						//printf( __( '%s', 'eventorganiser' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1> -->

				<!-- If the category has a description display it-->
					<!-- <?php
						//$category_description = category_description();
						//if ( ! empty( $category_description ) )
						//	echo apply_filters( 'category_archive_meta', '<div class="category-archive-//meta">' . $category_description . '</div>' );
					?>
				</header> -->

				<!-- Navigate between pages-->
				<!-- In TwentyEleven theme this is done by twentyeleven_content_nav-->
				<?php
				//global $wp_query;
				//if ( $wp_query->max_num_pages > 1 ) : ?>
					<!-- <nav id="nav-above">
						<div class="nav-next events-nav-newer"><?php // next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
						<div class="nav-previous events-nav-newer"><?php // previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
					</nav> --> <!-- #nav-above -->
				<?php //endif; ?>
				<ul class="three-list group event-list">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<li id="post-<?php the_ID(); ?>" <?php post_class('event-list-archive'); ?>>
					<header class="entry-header">

				<h4>
				<a href="<?php the_permalink(); ?>">
					<?php
						//If it has one, display the thumbnail
						if( has_post_thumbnail() )
							the_post_thumbnail();

						//Display the title
						the_title()
					;?>
				</a>
				</h4>

				<div class="event-entry-meta">

					<!-- Output the date of the occurrence-->
					<?php
					//Format date/time according to whether its an all day event.
					//Use microdata http://support.google.com/webmasters/bin/answer.py?hl=en&answer=176035
 					if( eo_is_all_day() ){
						$format = 'F j, Y';
						$microformat = 'Y-m-d';
					}else{
						$format = 'F j, Y @ '.get_option('time_format');
						$microformat = 'c';
					}?>
					<time itemprop="startDate" datetime="<?php eo_the_start($microformat); ?>"><?php eo_the_start($format); ?></time>

					<!-- Display event meta list -->
					<?php //echo eo_get_event_meta_list(); ?>

					<div class="entry-excerpt">
						<hr />
						<!-- Show Event text as 'the_excerpt' or 'the_content' -->
						<?php echo get_desc_excerpt(); ?>
						... <a href="<?php the_permalink(); ?>">Read More</a>

					</div>

				</div><!-- .event-entry-meta -->

					</header><!-- .entry-header -->

				</li><!-- #post-<?php the_ID(); ?> -->

    				<?php endwhile; ?><!--The Loop ends-->
    			</ul><!--two-list-->
				<!-- Navigate between pages-->
				<?php
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<nav id="nav-below">
						<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
						<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
					</nav><!-- #nav-below -->
				<?php endif; ?>

			<?php else : ?>

				<!-- If there are no events -->
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no events were found for the requested category. ', 'eventorganiser' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #primary -->

		<?php //get_sidebar(); ?>
	</div><!--page-container-->
<?php get_footer(); ?>
