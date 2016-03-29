<?php
/**
 * The template used for displaying the latest sermon
 *
 * @package Church
 */
?>

<?php
	$args = array( 'post_type' => 'sermons', 'posts_per_page' => 1);
	$loop = new WP_Query( $args );
	if ( $loop->have_posts() ) :
	while ( $loop->have_posts() ) : $loop->the_post();
?>	

<?php
	$series = get_the_terms( get_the_id(), 'series' );
	$key = key($series);
	$slug = $series[$key]->slug;
	$link = esc_url( home_url( '/' ) );
?>

	<a href="<?php echo esc_url( home_url( '/series/' ) ) . $slug; ?>" rel="bookmark">
		<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
		?>
		<h4><?php the_title(); ?></h4>
		<span><?php the_date(); ?></span>
	</a>
	<p><?php echo excerpt(25); ?></p>
<?php endwhile; wp_reset_postdata(); endif;  ?>
