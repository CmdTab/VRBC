<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Church
 */
?>
<div class="third sidebar single-event-sidebar">
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside class="widget side-event-desc">
				<h2>Event Details</h2>
				<!-- Get event information, see template: event-meta-event-single.php -->
				<?php eo_get_template_part('event-meta','event-single'); ?>
				<div class="event-meta side-category">
					<?php
						//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
						$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ','');

						if ( '' != $categories_list ) {
							$utility_text = __( 'Event category: %1$s', 'eventorganiser' );
						}
						printf($utility_text,
							$categories_list,
							esc_url( get_permalink() ),
							the_title_attribute( 'echo=0' ),
							get_the_author(),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
						);
					?>
				</div>
			</aside>

			
			

			<!-- <aside class="widget side-events">
				<h2>Events Center</h2>
				<div class="side-event-list">
					<?php //get_template_part( 'content', 'events' ); ?>
					<a href = "<?php //echo esc_url( home_url( '/' ) ); ?>events" class="btn all-events">View more events <img src ="<?php //bloginfo('template_directory'); ?>/_i/arrows.png"></a>
				</div>
			</aside> -->

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
</div>
