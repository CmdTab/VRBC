<?php
/**
 * Template name: Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Church
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="content-section">
		<div class="service-times">
			<span class="first-time"><?php the_field('first_time')?> <span><?php the_field('first_description')?></span></span>
			<span class="second-time"><?php the_field('second_time')?> <span><?php the_field('second_description')?></span></span>
		</div><!-- #main -->
	</div><!-- #primary -->

	<div class="content-section group">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<div class="carousel-top group">
				<div class="third important-actions">
					<a href = "<?php the_field('new_url'); ?>" class="new-action">
						<div class="top-action"><?php the_field('new_text'); ?></div>
						<div class="bottom-action"><?php the_field('new_subtext'); ?></div>
					</a>
					<a href = "<?php the_field('sermon_url'); ?>" class="sermon-action">
						<div class="top-action"><?php the_field('sermon_text'); ?></div>
						<div class="bottom-action"><?php the_field('sermon_subtext'); ?></div>
					</a>
					<a href = "<?php the_field('connect_url'); ?>" class="connect-action">
						<div class="top-action"><?php the_field('connect_text'); ?></div>
						<div class="bottom-action"><?php the_field('connect_subtext'); ?></div>
					</a>
					<a href = "<?php the_field('give_url'); ?>" class="give-action">
						<div class="top-action"><?php the_field('give_text'); ?></div>
						<div class="bottom-action"><?php the_field('give_subtext'); ?></div>
					</a>
				</div><!--third-->
				<?php
					// check if the repeater field has rows of data
					if( have_rows('slide') ):
				?>
				<div class="two-third first">
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php
							$i = 0;
						 	// loop through the rows of data
						    while ( have_rows('slide') ) : the_row();
						    $image = get_sub_field('slide_image');
					    ?>
					    <div class="item <?php if ($i == 0) {echo 'active';} ?>">
					    	<a href = "<?php the_sub_field('slide_url'); ?>">
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
								<div class="carousel-caption">
									<?php the_sub_field('slide_caption'); ?>
								</div>
							</a>
						</div>


						<?php
							$i++;
							endwhile;
						?>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="icon-angle-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="icon-angle-right"></span>
					</a>
				</div><!--two-third-->
				<?php endif; ?>

			</div>
			<!-- Indicators -->
			<?php
				// check if the repeater field has rows of data
				if( have_rows('slide') ):
			?>
			<ul class="carousel-indicators group">
				<?php
					$i = 0;
				 	// loop through the rows of data
				    while ( have_rows('slide') ) : the_row();
				    $image = get_sub_field('slide_image');
				    $thumb = $image['sizes'][ 'medium' ];
			    ?>
				<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {echo 'class="active"';} ?>><img src="<?php echo $thumb ?>" alt="<?php echo $image['alt']; ?>"></li>
				<?php
					$i++;
					endwhile;
				?>
			</ul>
			<?php endif; ?>
		</div>
	</div>
	<div class="content-section home-thirds">
		<div class="home-thirds-titles group">
			<div class="third-section about-third">
				<h2>About VRBC</h2>
			</div>
			<div class="third-section sermons-third">
				<h2>Sermons &amp; Podcasts</h2>
			</div>
			<div class="third-section events-third">
				<h2>Connection Center</h2>
			</div>
		</div>
		<div class="home-thirds-content group">
			<div class="third-section about-third">
				<div class="home-third">
					<?php if( have_rows('about_section') ): ?>
					<?php while ( have_rows('about_section') ) : the_row(); ?>
					<p><?php the_sub_field('about_text'); ?></p>
					<a href = "<?php the_sub_field('about_button_url'); ?>" class="btn"><?php the_sub_field('about_button_text'); ?><img src = "<?php bloginfo('template_directory'); ?>/_i/arrows.png"></a>
					<?php endwhile; endif; ?>
				</div>
			</div>
			<div class="third-section sermons-third">

				<div class="home-third">
					<h3>Latest Series</h3>
					<?php get_template_part( 'content', 'latestsermon' ); ?>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>sermons" class="btn all-sermons">View all sermons <img src ="<?php bloginfo('template_directory'); ?>/_i/arrows.png"></a>
				</div>
			</div>
			<div class="third-section events-third">
				<div class="home-third">
					<?php get_template_part( 'content', 'events' ); ?>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>events" class="btn all-events">View more events <img src ="<?php bloginfo('template_directory'); ?>/_i/arrows.png"></a>
				</div>
			</div>
		</div><!--home-third-content-->
	</div>


			<?php endwhile; // end of the loop. ?>



<?php //get_sidebar(); ?>
<?php get_footer(); ?>
