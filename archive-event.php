<?php
/**
 * The template for displaying lists of events
 *
 * Queries to do with events will default to this template if a more appropriate template cannot be found
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory.
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
<div class="page-container group">
		<div id="primary" class="primary event-archive">
			<h1>HELLO</h1>
		<!-- Page header-->
		<header class="page-header">
		<h1 class="entry-title">
			<?php
				if( eo_is_event_archive('day') )
					//Viewing date archive
					echo __('Events: ','eventorganiser').' '.eo_get_event_archive_date('jS F Y');
				elseif( eo_is_event_archive('month') )
					//Viewing month archive
					echo __('Events: ','eventorganiser').' '.eo_get_event_archive_date('F Y');
				elseif( eo_is_event_archive('year') )
					//Viewing year archive
					echo __('Events: ','eventorganiser').' '.eo_get_event_archive_date('Y');
				else
					_e('Events','eventorganiser');
			?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>

			<!-- Navigate between pages-->
			<!-- In TwentyEleven theme this is done by twentyeleven_content_nav-->


			<?php /* Start the Loop */?>
			<div class="recurring-events">
				<p style="text-align: right; padding-bottom: 0.5em; font-size: 0.75em;"><span style="font-size: 1em; color: #dda427;" class="icon-clock-o"></span> Multiple Dates</p>
			</div>
			<ul class="three-list group event-list">
			<?php while ( have_posts() ) : the_post(); ?>
			<li id="post-<?php the_ID(); ?>" <?php post_class('event-list-archive'); ?>>
				<header class="entry-header">
					<a href="<?php the_permalink(); ?>">
					<?php
						//If it has one, display the thumbnail
						the_post_thumbnail();
					?>
					</a>
					<h4>
						<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
						<?php if( eo_reoccurs() ) : ?>
							<span style="font-size:0.8em; color: #dda427;" class="icon-clock-o"></span>
						<?php endif; ?>
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
    	</ul>
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
					<h2><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h2>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. ', 'eventorganiser' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

			<?php endif; ?>

		</div><!-- #primary -->

<!-- Call template sidebar and footer -->

<?php get_footer(); ?>
