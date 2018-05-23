<?php
/**
 * raze Theme Customizer
 *
 * @package raze
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function raze_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
}
add_action( 'customize_register', 'raze_customize_register' );

//Load All Individual Settings Based on Sections/Panels.
require_once get_template_directory().'/framework/customizer/customizer-controls.php';
require_once get_template_directory().'/framework/customizer/sanitization.php';
require_once get_template_directory().'/framework/customizer/basic.php';
require_once get_template_directory().'/framework/customizer/header.php';
require_once get_template_directory().'/framework/customizer/layouts.php';
require_once get_template_directory().'/framework/customizer/showcase.php';
require_once get_template_directory().'/framework/customizer/skins.php';
require_once get_template_directory().'/framework/customizer/social-icons.php';
require_once get_template_directory().'/framework/customizer/featured-page.php';
require_once get_template_directory().'/framework/customizer/hero.php';
require_once get_template_directory().'/framework/customizer/googlefonts.php';
require_once get_template_directory().'/framework/customizer/misc-scripts.php';
require_once get_template_directory().'/framework/customizer/temp.php';


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function raze_customize_preview_js() {
	if(is_customize_preview()) {
		wp_enqueue_script( 'raze_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
	}	
}
add_action( 'customize_preview_init', 'raze_customize_preview_js' );
