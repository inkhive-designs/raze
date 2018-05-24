<?php
/**
 * raze functions and definitions
 *
 * @package raze
 */



if ( ! function_exists( 'raze_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function raze_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on raze, use a find and replace
	 * to change 'raze' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'raze', get_template_directory() . '/languages' );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 global $content_width;
	 if ( ! isset( $content_width ) ) {
		$content_width = 731; /* pixels */
	 }
	 
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'raze' ),
		'mobile' => __( 'Smartphone Menu', 'raze' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'raze_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
	add_image_size('raze-sq-thumb', 600,600, true );
	add_image_size('raze-thumb', 600, 600, true );
	add_image_size('pop-thumb',542, 340, true );
	add_image_size('raze-slider-thumb',860, 430, true );
	
	//Declare woocommerce support
	add_theme_support('woocommerce');

    //Slider Support
    add_theme_support('rt-slider', array( 10 ) );
	
}
endif; // raze_setup
add_action( 'after_setup_theme', 'raze_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function raze_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'raze' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'raze' ), 
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'raze' ), 
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'raze' ), 
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'raze_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function raze_scripts() {
	wp_enqueue_style( 'raze-style', get_stylesheet_uri() );
	
	wp_enqueue_style('raze-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('raze_title_font', 'Nunito') )).':100,300,400,700' );
	
	if (get_theme_mod('raze_title_font') != get_theme_mod('raze_body_font') ) :
		wp_enqueue_style('raze-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", esc_html(get_theme_mod('raze_body_font', 'Alegreya') )).':100,300,400,700' );
	endif;

    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/fontawesome-all.min.css' );
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'hover-css', get_template_directory_uri() . '/assets/css/hover.min.css' );
	
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.min.css' );

    wp_enqueue_style( 'raze-main-theme-style', get_template_directory_uri() . '/assets/theme-styles/css/'.get_theme_mod('raze_skins', 'default').'.css', array(), null );

    //wp_enqueue_style( 'raze-main-theme-style', get_template_directory_uri() . '/assets/theme-styles/css/'.get_theme_mod('raze_skin', 'default').'.css', array(), filemtime( get_template_directory() . '/assets/theme-styles/css/'.get_theme_mod('raze_skin', 'default').'.css' ) );

	wp_enqueue_script('jquery');

    wp_enqueue_script( 'raze-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'raze-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery'), '20120206', true );

    wp_enqueue_script( 'raze-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'raze-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery-masonry','raze-externaljs') );
	
	// Localize the script with new data
	$translation_array = array(
		'menu_text' => get_theme_mod('raze_menu_text','Browse...'),
	);
	wp_localize_script( 'raze-externaljs', 'menu_obj', $translation_array );

}
add_action( 'wp_enqueue_scripts', 'raze_scripts' );

/**
 * Enqueue Scripts for Customizer Preview screen
 */
function raze_custom_wp_admin_style() {
	
        wp_enqueue_style( 'raze-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/fontawesome-all.min.css' );
}
add_action( 'admin_enqueue_scripts', 'raze_custom_wp_admin_style' );

function raze_custom_wp_customizer_script() {

    wp_enqueue_script( 'raze-customizer-js', get_template_directory_uri() . '/js/customizer.js' );
}
add_action( 'admin_enqueue_scripts', 'raze_custom_wp_customizer_script' );

function raze_custom_control_js() {
	
    wp_enqueue_script('raze-customize-control-js', get_template_directory_uri() . '/js/custom-control.js');
}
add_action('customize_controls_enqueue_scripts', 'raze_custom_control_js');

/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
require get_template_directory() . '/framework/customizer/init.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load TGM.
 */
require get_template_directory() . '/framework/tgmpa.php';

/**
 * FontAwesome Array
 */
require get_template_directory() . '/inc/fa-icons.php';