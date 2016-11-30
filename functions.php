<?php
/**
 * Church functions and definitions
 *
 * @package Church
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'church_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function church_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Church, use a find and replace
	 * to change 'church' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'church', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'church' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'church_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // church_setup
add_action( 'after_setup_theme', 'church_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function church_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'church' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'church_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function church_scripts() {
	wp_enqueue_style( 'church-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'church-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'church-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		//wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'church_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*Custom Taxnonomy*/
add_action( 'init', 'create_tax' );
function create_tax() {
	register_taxonomy(
		'series',
		array('sermons'),
		array(
			'label' => __( 'Series' ),
			'rewrite' => array( 'slug' => 'series' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'speaker',
		array('speaker'),
		array(
			'label' => __( 'Speaker' ),
			'rewrite' => array( 'slug' => 'speaker' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'eventtype',
		array('event'),
		array(
			'label' => __( 'Event Type' ),
			'rewrite' => array( 'slug' => 'eventtype' ),
			'hierarchical' => true,
		)
	);
	register_taxonomy(
		'service-type',
		array('service'),
		array(
			'label' => __( 'Type of Service' ),
			'rewrite' => array( 'slug' => 'service-type' ),
			'hierarchical' => true,
		)
	);
}
/*Custom Post Types*/
function create_post_type() {
	$sermonArgs = array(
		'label'  => 'Sermons',
		'labels' => array(
			'singular_name' => 'Sermon'
			),
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'taxonomies' => array('series', 'speaker'),
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', 'author')
	);
	register_post_type( 'sermons', $sermonArgs );

	$serviceArgs = array(
		'label'  => 'Services',
		'labels' => array(
			'singular_name' => 'Service'
			),
		'public' => true,
		'has_archive' => true,
		'menu_position' => 6,
		'taxonomies' => array('grow', 'family', 'serve', 'explore'),
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', 'author')
	);
	register_post_type( 'service', $serviceArgs );
}
add_action( 'init', 'create_post_type' );

function addPodcast($content){
	global $post;
	if($post->post_type=='sermons') {
		$content .= '<a href = "' . get_field('audio_file') . '">Listen Now</a>';
		return $content;
	} else {
		return $content;
	}
}
//add_filter('the_content', 'addPodcast');
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}
function get_desc_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 150);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Service Settings',
		'menu_title'	=> 'Service Settings',
		'menu_slug' 	=> 'service-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}