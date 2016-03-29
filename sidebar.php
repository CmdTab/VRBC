<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Church
 */
?>
<div class="third sidebar">
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside class="widget side-sermon">
				<h2>Latest Sermon</h2>
				<?php get_template_part( 'content', 'latestsermon' ); ?>
				<a href = "<?php echo esc_url( home_url( '/' ) ); ?>sermons" class="btn all-sermons">View all sermons <img src ="<?php bloginfo('template_directory'); ?>/_i/arrows.png"></a>
			</aside>

			<aside class="widget side-events">
				<h2>Connection Center</h2>
				<div class="side-event-list">
					<?php get_template_part( 'content', 'events' ); ?>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>events" class="btn all-events">View more events <img src ="<?php bloginfo('template_directory'); ?>/_i/arrows.png"></a>
				</div>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
</div>
