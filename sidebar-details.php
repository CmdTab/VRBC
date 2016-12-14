<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Church
 */
?>
<div class="third sidebar single-event-sidebar">
	<div class="full-event-info">
		<h2>Event Details</h2>

		<ul>
			<?php
			// check if the flexible content field has rows of data
			if( have_rows('serve_options') ): ?>

				<?php
			 	// loop through the rows of data
			    	while ( have_rows('serve_options') ) : the_row(); ?>

			    		<li>

						<?php if( get_row_layout() == 'text_field' ):

							$label = get_sub_field('text_label');
							$info = get_sub_field('text_info');

							?>

							<strong><?php echo $label; ?> </strong>
							<?php echo $info; ?>


				        	<?php elseif( get_row_layout() == 'text_field_repeater' ):

				        		$repeat_label = get_sub_field('repeater_label');

				        	?>

				        		<strong><?php echo $repeat_label; ?> </strong>

				        		<?php if( have_rows('repeater_info') ): ?>
								<?php while ( have_rows('repeater_info') ) : the_row();

									$repeat_info = get_sub_field('repeater_text_field');

								?>


								<?php echo $repeat_info; ?><br />

								<?php endwhile; ?>
							<?php endif; ?>

						<?php elseif( get_row_layout() == 'text_link' ):

							$label = get_sub_field('url_label');
							$info = get_sub_field('url_info');

							?>

							<strong><?php echo $label; ?> </strong>
							<a href="<?php echo $info; ?>" target="_blank"><?php echo $info; ?></a>

						<?php elseif( get_row_layout() == 'text_area' ):

							$label = get_sub_field('text_area_label');
							$info = get_sub_field('text_area_info');

							?>

							<strong><?php echo $label; ?> </strong>
							<?php echo $info; ?>

						<?php endif; ?>

				    	</li>

				<?php endwhile;

			else :

			    // no layouts found

			endif;

			?>
			<!-- <h2>Reminder</h2> -->
			<!-- Get event information, see template: event-meta-event-single.php -->
			<?php eo_get_template_part('event-meta','event-single'); ?>
			<!-- <li class="event-meta side-category"> -->

			<?php
				//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
				$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ','');

				if ( '' != $categories_list ) { ?>
					<li>
					<?php $utility_text = __( 'Event category: %1$s', 'eventorganiser' );
					printf(
						'<strong>'.$utility_text.'</strong>',
						$categories_list,
						esc_url( get_permalink() ),
						the_title_attribute( 'echo=0' ),
						get_the_author(),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
					); ?>
					</li>
				<?php }
			?>


		</ul>
	</div>
</div>
