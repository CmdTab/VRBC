<?php
/**
 * The Template for displaying sermons.
 *
 * @package Church
 */

get_header(); ?>

<div class="page-container group page">
	<div id="primary" class="sermon-page group">
		<header class="entry-header">
			<h1 class="entry-title speaker-archive"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->
		<?php while ( have_posts() ) : the_post(); ?>
		<div id="primary" class="primary third sermon-archive">
			<?php
				$seriesTerm = get_the_terms($post->ID, 'series');
				//$seriesImage = get_field('series_image', $seriesTerm );
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
			?>
		</div>
		<div id="sermon-box" class="sermon-content two-third page group">
			<div class="sermon-archive group">
				<div class="sermon-info">
				
					<p><strong>Date: </strong><?php the_date(); ?></p>
					<p><strong>Speaker: </strong>
						<?php 
							//Teacher Name
							$teacherArgs = array(
								'taxonomy' => 'speaker',
							);
							//$teacherCat = get_categories($teacherArgs);
							$teacherCat = get_the_terms($post->ID, 'speaker');
							$i = 0;
							foreach($teacherCat as $cat) {
								$i++;
								if($i > 1) {
									echo ', ';
								}
								echo '<a href="' . get_term_link( $cat->slug, 'speaker' ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>' . $cat->name.'</a>';
							}
							?>
					</p>
				</div>
				<div class="btn-links group">
						<?php if(get_field('sermon_video')): ?>
							<a href="#sermon-box" class="sermon-btn watch-trigger">Watch</a>
						<?php endif; ?>
						<a href="#sermon-box" class="sermon-btn listen-trigger">Listen</a>
						<a href="<?php echo get_field('audio_file'); ?>" target="_blank" class="sermon-btn download-trigger" download>Download</a>
						<?php if(get_field('worship_playlist')): ?>
							<a href="#sermon-box" class="sermon-btn worship-trigger">Worship</a>
						<?php endif; ?>
					</div>

					<?php if(get_field('sermon_video')): ?>
						<div class="sermon-video watch">
							<?php the_field('sermon_video'); ?>
						</div>
					<?php endif; ?>

					<div class="sermon-audio listen">
						<audio src = "<?php echo get_field('audio_file'); ?>"  controls="controls"></audio>
					</div>
					
					<?php if(get_field('worship_playlist')): ?>
						<div class="worship-playlist worship">		
							<?php

							// check if the repeater field has rows of data
							if( have_rows('worship_playlist') ):

							 	// loop through the rows of data
							    while ( have_rows('worship_playlist') ) : the_row();

							        // display a sub field value
							        the_sub_field('embed_code');

							    endwhile;

							else :

							    // no rows found

							endif;

							?>
						</div>
					<?php endif; ?>

					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<div class="addthis_sharing_toolbox"></div>
				</div>
			</div>
			<!-- <audio src = "<?php echo get_field('audio_file'); ?>"  controls="controls"></audio> -->
			<?php //church_post_nav(); ?>
			<?php //the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>
		</div>
	</div><!-- #primary -->

</div><!--page-container-->

<?php get_footer(); ?>