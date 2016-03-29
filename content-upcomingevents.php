<?php
/**
 * The template used for displaying the latest sermon
 *
 * @package Church
 */
?>

<?php
//Get upcoming '
$events = eo_get_events(array(
	'numberposts'=>3,
	'event_start_after'=>'today',
	'showpastevents'=>true,//Will be deprecated, but set it to true to play it safe.
));

if( $events ) :
	global $post;
?>
	<ul>
<?php
	foreach( $events as $post ) :
		setup_postdata($post);
?>
	<li>
		<a href='<?php the_permalink() ?>'>
			<h5><?php the_title(); ?></h5>
		</a>
		on <?php eo_the_start('jS F Y'); ?>
		<p><?php echo get_the_content(); ?></p>
	</li>
<?php
	endforeach;
?>
	</ul>
<?php
	wp_reset_postdata();
	else :
		echo 'No Upcoming Events';
	endif;
?>
