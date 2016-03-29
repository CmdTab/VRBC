<?php
/**
 * The template used for displaying the latest sermon
 *
 * @package Church
 */
?>

<?php
//Get upcoming
$args = array(
	'posts_per_page'=>3,
	'event_start_after'=>'today',
	'showpastevents'=>true,
	'post_type'=>'event',
	'suppress_filters'=>false
);

$eventloop = new WP_Query( $args );
	if ( $eventloop->have_posts() ) :?>
	<ul>
<?php
	while ( $eventloop->have_posts() ) : $eventloop->the_post();
?>
	<li class="group">
		<div class="date-box">
			<div class="date-day">
				<?php eo_the_start('j'); ?>
			</div>
			<div class="date-month">
				<?php eo_the_start('M'); ?>
			</div>
		</div>
		<div class="event-details">
			<a href='<?php the_permalink() ?>'>
				<h3><?php the_title(); ?></h3>
			</a>
			<?php
				//$content = get_the_content();
				//$trimmed_content = wp_trim_words( $content, 30, '... <a href="'. get_permalink() .'" class="event-more">More &raquo;</a></p>' );
				//echo '<p>' . $trimmed_content; ?>
				<p><?php echo excerpt(25); ?></p>
		</div>
	</li>
<?php
	endwhile;
	wp_reset_postdata();
?>
	</ul>
<?php

	else :
		echo 'No Upcoming Events';
	endif;
?>
