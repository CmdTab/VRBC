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
		<?php

		$image = get_field('serve_page_banner' , 'option');

		if( !empty($image) ): ?>

			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

		<?php endif; ?>

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
			<?php while ( $loop->have_posts() ) : $loop->the_post();?>
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
						</a>
						<hr />
						<!-- Show Event text as 'the_excerpt' or 'the_content' -->
						<p><?php echo get_desc_excerpt(); ?></p>
						<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
						<div class="type-icon">

							<?php
								$postID = get_the_ID();
								$terms = get_the_terms( $postID, 'service-type' );

								foreach ( $terms as $term ) :
									$term_ID = $term->term_id;
									$taxonomy_name = $term->taxonomy;
									$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
							?>

								<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

							<?php endforeach; ?>

							<?php
								$postID = get_the_ID();
								$terms = get_the_terms( $postID, 'service-location' );

								foreach ( $terms as $term ) :
									$term_ID = $term->term_id;
									$taxonomy_name = $term->taxonomy;
									$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
							?>

								<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

							<?php endforeach; ?>

						</div>
					</div>
			<?php $exclude_post[] = get_the_ID(); endwhile; ?>
		</div>

	<?php elseif($i == 2) : ?>

		<div class="two-featured-post group">
			<ul class="two-list group">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li id="post-<?php the_ID(); ?>" <?php post_class('event-list-archive'); ?>>
						<a href="<?php the_permalink(); ?>">
							<?php
								//If it has one, display the thumbnail
								the_post_thumbnail();
								?>
						</a>
						<a href="<?php the_permalink(); ?>" class="serve-title">
							<h3><?php the_title();?></h3>
						</a>
						<hr />
						<!-- Show Event text as 'the_excerpt' or 'the_content' -->
						<p><?php echo get_desc_excerpt(); ?></p>
						<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
						<div class="type-icon">

							<?php
								$postID = get_the_ID();
								$terms = get_the_terms( $postID, 'service-type' );

								foreach ( $terms as $term ) :
									$term_ID = $term->term_id;
									$taxonomy_name = $term->taxonomy;
									$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
							?>

								<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

							<?php endforeach; ?>

							<?php
								$postID = get_the_ID();
								$terms = get_the_terms( $postID, 'service-location' );

								foreach ( $terms as $term ) :
									$term_ID = $term->term_id;
									$taxonomy_name = $term->taxonomy;
									$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
							?>

								<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

							<?php endforeach; ?>

						</div>
					</li>
				<?php $exclude_post[] = get_the_ID(); endwhile; ?>
			</ul>
		</div>

		<?php elseif($i == 3) : ?>

			<div class="three-featured-post group">
				<ul class="three-list group event-list">

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

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
								</a>
								<div class="entry-excerpt">
									<hr />
									<!-- Show Event text as 'the_excerpt' or 'the_content' -->
									<p><?php echo get_desc_excerpt(); ?></p>
									<a href="<?php the_permalink(); ?>" class="btn">Read More</a>
									<div class="type-icon">

										<?php
											$postID = get_the_ID();
											$terms = get_the_terms( $postID, 'service-type' );

											foreach ( $terms as $term ) :
												$term_ID = $term->term_id;
												$taxonomy_name = $term->taxonomy;
												$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
										?>

											<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

										<?php endforeach; ?>

										<?php
											$postID = get_the_ID();
											$terms = get_the_terms( $postID, 'service-location' );

											foreach ( $terms as $term ) :
												$term_ID = $term->term_id;
												$taxonomy_name = $term->taxonomy;
												$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
										?>

											<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

										<?php endforeach; ?>

									</div>
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
			<div class="service-search-bar">
				<input type="hidden" name="post_type[]" value="service" />
				<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
					<input type="text" name="s" id="s" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="Search Service &hellip;" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"<?php } ?> /><br />

					<?php $query_types = get_query_var('post_type'); ?>

					<input type="checkbox" name="post_type[]" value="service" checked />

					<input type="submit" id="searchsubmit" value="Search" />
				</form>
			</div>
			<div class="service-cat">
				<a href="#" class="btn">
					Browse by Type
					<?php include('svg/icon-down.php'); ?>
					<?php include('svg/icon-up.php'); ?>
				</a>
				<ul>
					<?php
						$args = array(
						  'taxonomy'  =>  'service-type',
						  'title_li'   =>   0,
						  'orderby'    =>   'name',
						);
						$terms = get_terms( $args );
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$icon = get_field('service_icon', $term );
							echo '<li><a href="' . $term_link . '"><img src="' . $icon['url'] . '" />' . $term->name . ' </a></li>';
						}
					?>
				</ul>
			</div>
			<div class="service-cat">
				<a href="#" class="btn">
					Browse by Location
					<?php include('svg/icon-down.php'); ?>
					<?php include('svg/icon-up.php'); ?>
				</a>
				<ul>
					<?php
						$args = array(
						  'taxonomy'  =>  'service-location',
						  'title_li'   =>   0,
						  'orderby'    =>   'name',
						);
						$terms = get_terms( $args );
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$icon = get_field('service_icon', $term );
							echo '<li><a href="' . $term_link . '"><img src="' . $icon['url'] . '" />' . $term->name . ' </a></li>';
						}
					?>
				</ul>
			</div>
		</div>

		<?php
			$currentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$exclude_arg = array(
				'post_type'      => 'service',
				'post__not_in'   => $exclude_post,
				'meta_key'       => 'date_of_event',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
				'paged'          => $currentPage
			);

			$service_loop = new WP_Query( $exclude_arg );

			if ( $service_loop->have_posts() ) : ?>

				<ul class="three-list group event-list">

				<?php while ( $service_loop->have_posts() ) : $service_loop->the_post();
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
									<!-- <div class="event-time">
										<?php //echo $event_date; ?> at
										<?php //echo $event_time; ?>
									</div> -->
								</a>
							</h4>

							<div class="entry-excerpt">
								<hr />
								<!-- Show Event text as 'the_excerpt' or 'the_content' -->
								<?php echo get_desc_excerpt(); ?>
								<a href="<?php the_permalink(); ?>">Read More</a>

								<div class="type-icon">

									<?php
										$postID = get_the_ID();
										$terms = get_the_terms( $postID, 'service-type' );

										foreach ( $terms as $term ) :
											$term_ID = $term->term_id;
											$taxonomy_name = $term->taxonomy;
											$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
									?>

										<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

									<?php endforeach; ?>

									<?php
										$postID = get_the_ID();
										$terms = get_the_terms( $postID, 'service-location' );

										foreach ( $terms as $term ) :
											$term_ID = $term->term_id;
											$taxonomy_name = $term->taxonomy;
											$icon = get_field('service_icon', $taxonomy_name . '_' . $term_ID );
									?>

										<img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" />

									<?php endforeach; ?>

								</div>
							</div>

						</header><!-- .entry-header -->

					</li><!-- #post-<?php the_ID(); ?> -->

	    		<?php endwhile; ?><!--The Loop ends-->

				</ul>
				<nav class="service-post-nav">
					<?php previous_posts_link( 'Previous Page' ); ?>
					<?php next_posts_link('Next Page' , $service_loop->max_num_pages); ?>
				</nav>

			<?php wp_reset_postdata(); endif;

		?>


	</div><!-- #primary -->

<!-- Call template sidebar and footer -->

<?php get_footer(); ?>
