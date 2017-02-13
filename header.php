<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Church
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon"
      type="image/png"
      href="<?php bloginfo('template_directory'); ?>/_i/favicon.png">
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/_i/vrbc_logo_icon.png">

<?php wp_head(); ?>
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" />
	<script src="<?php bloginfo('template_directory'); ?>/_js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="//use.typekit.net/cji1qej.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>

<body <?php body_class(); ?>>

<div class="contact-form-container">
	<div class="serve-contact-form" data-recipient="<?php the_field('recipient_email'); ?>">
		<?php include('svg/icon-close.php'); ?>
		<?php gravity_form( 3, true, true, false, '', true ); ?>
	</div>
</div>

<div id="page" class="hfeed site-wrapper">
	<header id="masthead" class="site-header group" role="banner">
		<img src ="<?php bloginfo('template_directory'); ?>/_i/cloud.png" class="cloud">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src ="<?php bloginfo('template_directory'); ?>/_i/new_logo.png">
			</a>
		</div>
		<div class="contact-info">
			<div class="social-icons">
				<?php get_search_form(); ?>
				<a id="search-icon" class="search-icon" href = "#"><img src = "<?php bloginfo('template_directory'); ?>/_i/search.png"></a>

				<a href = "https://twitter.com/VRBC1"><img src = "<?php bloginfo('template_directory'); ?>/_i/twitter.png"></a>

				<a href = "https://www.facebook.com/valleyranchbaptistchurch"><img src = "<?php bloginfo('template_directory'); ?>/_i/facebook.png"></a>
			</div>
			<div class="contact-group">
				<div class="address">1501 E. Belt Line Road  |  Coppell, Texas 75019</div>
				<div class="telephone">972-304-VRBC (8722)</div>
			</div>

		</div>
		<a href = "#" class="toggle-nav">Menu</a>
		<nav id="site-navigation" class="main-navigation" role="navigation">

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'main-nav-list' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
