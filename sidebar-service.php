<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Church
 */
?>
<div class="third sidebar single-event-sidebar">
	<div class="full-event-info">
		<h2>Serve Details</h2>
		<?php while ( have_posts() ) : the_post();
			$event_date = get_field('date_of_event');
			$event_time = get_field('time_of_event');
		?>
		<ul>
			<li>
				<div><b>TIME OF EVENT:</b></div>
				<?php echo $event_date; ?>
				<?php echo $event_time; ?>
			</li>
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

							<strong><?php echo $label; ?></strong>
							<?php echo $info; ?>


				        	<?php elseif( get_row_layout() == 'text_field_repeater' ):

				        		$repeat_label = get_sub_field('repeater_label');

				        	?>

				        		<strong><?php echo $repeat_label; ?></strong>

				        		<?php if( have_rows('repeater_info') ): ?>
								<?php while ( have_rows('repeater_info') ) : the_row();

									$repeat_info = get_sub_field('repeater_text_field');

								?>


								<?php echo $repeat_info; ?>,

								<?php endwhile; ?>
							<?php endif; ?>

						<?php elseif( get_row_layout() == 'text_link' ):

							$label = get_sub_field('url_label');
							$info = get_sub_field('url_info');

							?>

							<strong><?php echo $label; ?></strong>
							<a href="<?php echo $info; ?>" target="_blank"><?php echo $info; ?></a>

						<?php elseif( get_row_layout() == 'text_area' ):

							$label = get_sub_field('text_area_label');
							$info = get_sub_field('text_area_info');

							?>

							<strong><?php echo $label; ?></strong>
							<?php echo $info; ?>

						<?php endif; ?>

				    	</li>

				<?php endwhile;

			else :

			    // no layouts found

			endif;

			?>
		</ul>
	<?php endwhile; ?>
	</div>
</div>
