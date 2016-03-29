<?php
/**
 * Template Name: Staff
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Church
 */

get_header(); ?>

	<div class="page-container group">
		<div id="primary" class="primary two-third first">

			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if( have_rows('staff_section') ): ?>
				<div class="staff-group">
					<?php while ( have_rows('staff_section') ) : the_row(); ?>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_sub_field('section_title'); ?></h1>
					</header><!-- .entry-header -->
					<?php if( have_rows('staff_member') ): ?>
					<ul class="staff-list group">
						<?php while ( have_rows('staff_member') ) : the_row(); ?>
						<?php $image = get_sub_field('staff_photo'); ?>
	 					<li class="group">
	        				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"  class="third first"/>
	        				<div class="two-third">
		        				<h4><?php the_sub_field('staff_name'); ?></h4>
		        				<span class="staff-title"><?php the_sub_field('staff_title'); ?></span>
		        				<a href = "mailto:<?php the_sub_field('staff_email'); ?>"><?php the_sub_field('staff_email'); ?></a>
		        				<p><?php the_sub_field('staff_bio'); ?></p>
		        			</div>
	        			</li>
						<?php endwhile; ?>
					</ul>
					<?php endif; ?>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</article>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div><!--page-container-->
<?php get_footer(); ?>
