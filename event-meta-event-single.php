<?php
/**
 * The template is used for displaying a single event details.
 *
 * You can use this to edit how the details re displayed on your site. (see notice below).
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme.
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
 * @since 1.7
 */
?>

<div class="entry-meta event-meta">
	<!-- Choose a different date format depending on whether we want to include time -->
	<?php if( eo_is_all_day() ){
		$date_format = 'F j, Y';
	}else{
		$date_format = 'F j, Y @ ' . get_option('time_format');
	} ?>

	<!-- Event details -->
		<!-- Is event recurring or a single event -->
		<?php if( eo_reoccurs() ):?>
			<!-- Event reoccurs - is there a next occurrence? -->
			<?php $next =   eo_get_next_occurrence($date_format);?>

			<?php if($next): ?>
				<!-- If the event is occurring again in the future, display the date -->
				<?php //printf('<p>'.__('This event is running from %1$s until %2$s. It is next occurring on %3$s','eventorganiser').'.</p>', eo_get_schedule_start('j F Y'), eo_get_schedule_last('j F Y'), $next);?>

			<?php else: ?>
				<!-- Otherwise the event has finished (no more occurrences) -->
				<?php printf('<p>'.__('This event finished on %s','eventorganiser').'.</p>', eo_get_schedule_last('d F Y',''));?>
			<?php endif; ?>
		<?php endif; ?>

	<ul class="eo-event-meta group">

		<?php if( !eo_reoccurs() ){ ?>
				<!-- Single event -->
				<li class="half first"><h4><?php _e('When', 'eventorganiser') ;?></h4> <?php eo_the_start($date_format); ?> </li>
				<?php
		 } ?>
		<?php if( eo_reoccurs() ){
				//Event reoccurs - display dates.
				$upcoming = new WP_Query(array(
					'post_type'=>'event',
					'event_start_after' => 'today',
					'posts_per_page' => -1,
					'event_series' => get_the_ID(),
					'group_events_by'=>'occurrence'//Don't group by series
				));

				if( $upcoming->have_posts() ): ?>

					<li class="half first"><h4><?php _e('Upcoming Dates','eventorganiser'); ?></h4>
						<ul id="eo-upcoming-dates">
							<?php while( $upcoming->have_posts() ): $upcoming->the_post(); ?>
									<li> <?php eo_the_start($date_format) ?></li>
							<?php endwhile; ?>
						</ul>
					</li>

					<?php
					wp_reset_postdata();
					//With the ID 'eo-upcoming-dates', JS will hide all but the next 5 dates, with options to show more.
					wp_enqueue_script('eo_front');
					?>
				<?php endif; ?>
		<?php } ?>

		<?php if( eo_get_venue() ){ ?>
			<li class="half"><h4><?php _e('Where','eventorganiser'); ?></h4> <a href="<?php eo_venue_link(); ?>"> <?php eo_venue_name(); ?></a></li>
		<?php } ?>

	</ul>

	<!-- Does the event have a venue? -->





</div><!-- .entry-meta -->
