<?php
/**
 * @package Church
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="blog-header">
		<h1 class="blog-title"><?php the_title(); ?></h1>

		<div class="blog-meta">
			<?php church_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="blog-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'church' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="blog-footer-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'church' ) );

			if ( ! church_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'church' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'church' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'Blog Categories: %1$s', 'church' );
				} else {
					$meta_text = __( 'Blog Categories: %1$s', 'church' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'church' ), '<span class="edit-link">', '</span>' ); ?>
		<?php echo '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" class="blog-home-link">Back to Blog</a>'; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
