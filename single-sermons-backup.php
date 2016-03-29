<?php
/**
 * The Template for displaying sermons.
 *
 * @package Church
 */

get_header(); ?>

	<div class="page-container group">
		<div id="primary" class="primary two-third first single-sermon">

		<?php while ( have_posts() ) : the_post(); ?>
			<header class="entry-header">
				<h1 class="entry-title speaker-archive"><?php the_title(); ?></h1>


			</header><!-- .entry-header -->

			<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
			?>

			<audio src = "<?php echo get_field('audio_file'); ?>"  controls="controls"></audio>
			<?php //church_post_nav(); ?>
			<?php the_content(); ?>
			<div class="entry-meta sermon-meta group">
<?php
	//Series Name
	$seriesArgs = array(
		'taxonomy' => 'series',
	);
	//$seriesCat = get_categories($seriesArgs);
	$seriesCat = get_the_terms($post->ID, 'series');
	echo '<div class="half first"><h4>Sermon Series</h4>';
	$i = 0;
	foreach($seriesCat as $cat) {
		$i++;
		if($i > 1) {
			echo ', ';
		}
		echo '<a href="' . get_term_link( $cat->slug, 'series' ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>' . $cat->name.'</a>';

	}
	echo '</div>';
	//Teacher Name
	$teacherArgs = array(
		'taxonomy' => 'speaker',
	);
	//$teacherCat = get_categories($teacherArgs);
	$teacherCat = get_the_terms($post->ID, 'speaker');
	echo '<div class="half"><h4>Speaker</h4>';
	$i = 0;
	foreach($teacherCat as $cat) {
		$i++;
		if($i > 1) {
			echo ', ';
		}
		echo '<a href="' . get_term_link( $cat->slug, 'speaker' ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>' . $cat->name.'</a>';

	}
	echo '</div>';
?>
				</div><!-- .entry-meta -->

		<?php endwhile; // end of the loop. ?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!--page-container-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>