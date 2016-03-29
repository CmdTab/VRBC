<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Church
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'church' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'church' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	<?php
	if ( get_field('subnav') ) {
		get_template_part( 'content', 'subnav' );
	}
	if ( get_field('bottom_content') ) {
		the_field('bottom_content');
	}
	?>
</article><!-- #post-## -->
