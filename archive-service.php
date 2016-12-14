<?php
/**
 * The template for displaying lists of events
 *
 * Queries to do with events will default to this template if a more appropriate template cannot be found
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory.
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

<!-- This template follows the TwentyTwelve theme-->
<div class="page-container group">
	<div class="feature-banner">
		<img src="http://local-vrbc.com/wp-content/uploads/2016/03/banner-attend.jpg" />
		<h1 class="entry-title">
			<?php
				if( eo_is_event_archive('day') )
					//Viewing date archive
					echo __('Service Opportunities: ','eventorganiser').' '.eo_get_event_archive_date('jS F Y');
				elseif( eo_is_event_archive('month') )
					//Viewing month archive
					echo __('Service Opportunities: ','eventorganiser').' '.eo_get_event_archive_date('F Y');
				elseif( eo_is_event_archive('year') )
					//Viewing year archive
					echo __('Service Opportunities: ','eventorganiser').' '.eo_get_event_archive_date('Y');
				else
					_e('Service Opportunities','eventorganiser');
			?>
		</h1>
	</div>

	<!--    FEATURED LOOP      -->

	<?php
		$args = array(
			'post_type' => 'service',
			'tax_query' => array(
				array(
					'taxonomy' => 'featured',
					'field'    => 'slug',
					'terms'    => 'featured-post',
				),
			),
			'meta_key'       => 'date_of_event',
			'orderby'        => 'meta_value',
			'order'          => 'ASC'
		);

		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) :
			$i = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$i++;
			endwhile; wp_reset_postdata();

	?>

	<!--    LOOP THROUGH NUMBERS OF POSTS     -->

	<?php if($i == 1) : ?>

		<div class="featured-post group">
			<?php while ( $loop->have_posts() ) : $loop->the_post();
				$event_date = get_field('date_of_event');
				$event_time = get_field('time_of_event');
			?>
					<div class="half first">
						<a href="<?php the_permalink(); ?>">
							<?php
								//If it has one, display the thumbnail
								the_post_thumbnail();
								?>
						</a>
					</div>
					<div class="half last">
						<a href="<?php the_permalink(); ?>" class="serve-title">
							<h2><?php the_title();?></h2>
							<div class="event-time">
								<?php echo $event_date; ?> at
								<?php echo $event_time; ?>
							</div>
						</a>
						<hr />
						<!-- Show Event text as 'the_excerpt' or 'the_content' -->
						<p><?php echo get_desc_excerpt(); ?></p>
						<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
					</div>
			<?php $exclude_post[] = get_the_ID(); endwhile; ?>
		</div>

	<?php elseif($i == 2) : ?>

		<div class="two-featured-post group">
			<ul class="two-list group">
				<?php while ( $loop->have_posts() ) : $loop->the_post();
					$event_date = get_field('date_of_event');
					$event_time = get_field('time_of_event');
				?>
					<li id="post-<?php the_ID(); ?>" <?php post_class('event-list-archive'); ?>>
						<a href="<?php the_permalink(); ?>">
							<?php
								//If it has one, display the thumbnail
								the_post_thumbnail();
								?>
						</a>
						<a href="<?php the_permalink(); ?>" class="serve-title">
							<h3><?php the_title();?></h3>
							<span>
								<?php echo $event_date; ?>
								<?php echo $event_time; ?>
							</span>
						</a>
						<hr />
						<!-- Show Event text as 'the_excerpt' or 'the_content' -->
						<?php echo get_desc_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
					</li>
				<?php $exclude_post[] = get_the_ID(); endwhile; ?>
			</ul>
		</div>

		<?php elseif($i == 3) : ?>

			<div class="three-featured-post group">
				<ul class="three-list group event-list">

					<?php while ( $loop->have_posts() ) : $loop->the_post();
						$event_date = get_field('date_of_event');
						$event_time = get_field('time_of_event');
					?>

						<li id="post-<?php the_ID(); ?>" <?php post_class('event-list-archive'); ?>>
							<div class="entry-header">
								<a href="<?php the_permalink(); ?>">
									<?php
										//If it has one, display the thumbnail
										the_post_thumbnail();
										?>
								</a>
								<a href="<?php the_permalink(); ?>" class="serve-title">
									<h3><?php the_title();?></h3>
									<span>
										<?php echo $event_date; ?>
										<?php echo $event_time; ?>
									</span>
								</a>
								<div class="entry-excerpt">
									<hr />
									<!-- Show Event text as 'the_excerpt' or 'the_content' -->
									<?php echo get_desc_excerpt(); ?>
									... <a href="<?php the_permalink(); ?>" class="btn">Read More</a>

								</div>
							</div><!-- .entry-header -->
						</li><!-- #post-<?php the_ID(); ?> -->

					<?php $exclude_post[] = get_the_ID(); endwhile; ?>

				</ul>
			</div>

		<?php endif; ?>
	<?php wp_reset_postdata(); endif;  ?>
	<div id="primary" class="primary serve-feature">
		<div class="service-nav">
			<div class="service-cat">
				<a href="#" class="btn">
					Browse by Type
					<?php include('svg/icon-down.php'); ?>
					<?php include('svg/icon-up.php'); ?>
				</a>
				<ul>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/explore">
							<img src="<?php the_field('explore_icon' , 'option'); ?>" /> Explore
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/family">
							<img src="<?php the_field( 'family_icon' , 'option'); ?>" /> Family
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/grow">
							<img src="<?php the_field('grow_icon' , 'option'); ?>" /> Grow
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/serve">
							<img src="<?php the_field('serve_icon' , 'option'); ?>" /> Serve
						</a>
					</li>
				</ul>
			</div>
			<div class="service-cat">
				<a href="#" class="btn">
					Browse by Location
					<?php include('svg/icon-down.php'); ?>
					<?php include('svg/icon-up.php'); ?>
				</a>
				<ul>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/on-campus">
							<img src="<?php the_field('on_campus_icon' , 'option'); ?>" /> On Campus
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/local">
							<img src="<?php the_field('local_icon' , 'option'); ?>" /> Local
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>service-type/international">
							<img src="<?php the_field('international_icon' , 'option'); ?>" /> International
						</a>
					</li>
				</ul>
			</div>
		</div>

		<?php
			$exclude_arg = array(
				'post_type'      => 'service',
				'post__not_in'   => $exclude_post,
				'post_per_page'  => 1,
				'meta_key'       => 'date_of_event',
				'orderby'        => 'meta_value',
				'order'          => 'ASC'
			);
			$full_loop = new WP_Query( $exclude_arg );

			if ( $full_loop->have_posts() ) : ?>

				<ul class="three-list group event-list">

				<?php while ( $full_loop->have_posts() ) : $full_loop->the_post();
					$event_date = get_field('date_of_event');
					$event_time = get_field('time_of_event');
				?>

					<li id="post-<?php the_ID(); ?>" <?php post_class('event-list-archive'); ?>>
						<header class="entry-header">
							<a href="<?php the_permalink(); ?>">
								<?php
									//If it has one, display the thumbnail
									the_post_thumbnail();
								?>
							</a>
								<a href="<?php the_permalink(); ?>" class="serve-title">
									<h4><?php the_title();?></h4>
									<div class="event-time">
										<?php echo $event_date; ?> at
										<?php echo $event_time; ?>
									</div>
								</a>
							</h4>

							<div class="entry-excerpt">
								<hr />
								<!-- Show Event text as 'the_excerpt' or 'the_content' -->
								<?php echo get_desc_excerpt(); ?>
								... <a href="<?php the_permalink(); ?>">Read More</a>

							</div>

						</header><!-- .entry-header -->

					</li><!-- #post-<?php the_ID(); ?> -->

	    		<?php endwhile; ?><!--The Loop ends-->

				</ul>

			<?php wp_reset_postdata(); endif;

		?>

		<!-- Navigate between pages-->

		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below">
					<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
					<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
				</nav><!-- #nav-below -->
		<?php endif; ?>

	</div><!-- #primary -->

<!-- Call template sidebar and footer -->

<?php get_footer(); ?>
