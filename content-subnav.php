<?php
/**
 * The template used for displaying subnav
 *
 * @package Church
 */
?>

<?php
// check if the repeater field has rows of data
if( have_rows('subnav_link') ):
?>
<nav class="sub-nav">
	<ul class="three-list group">
		<?php
		// loop through the rows of data
		while ( have_rows('subnav_link') ) : the_row();
		$image = get_sub_field('subnav_icon');
		?>
		<li>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<h4><?php the_sub_field('subnav_title'); ?></h4>
			<p><?php the_sub_field('subnav_text'); ?></p>
			<a href = "<?php the_sub_field('subnav_action_url'); ?>"><?php the_sub_field('subnav_action_text'); ?></a>
		</li>
		<?php endwhile; ?>
	</ul>
</nav>
<?php endif; ?>
