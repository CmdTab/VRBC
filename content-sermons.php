<?php
/**
 * @package Church
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sermon-archive group'); ?>>
	<header class="entry-header">
		<h2 class="sermon-link">
			<a href = "<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
	</header><!-- .entry-header -->

	<div class="sermon-info">
		<p><strong>Date: </strong><?php the_date(); ?></p>
		<p>
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
					echo '<strong>Speaker: </strong><a href="' . get_term_link( $cat->slug, 'speaker' ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>' . $cat->name.'</a>';
					}
					$speaker_name = get_term_link( $cat->slug, 'speaker' );
					if (!empty($speaker_name)) {
						echo ' ';
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
	<div class="addthis_sharing_toolbox" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>"></div>

	<div class="entry-content">
		<?php //the_content(); ?>
	</div>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'church' ),
			'after'  => '</div>',
		) );
	?>
</article><!-- #post-## -->
