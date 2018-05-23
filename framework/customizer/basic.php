<?php
/**
 * Raze Theme Customizer
 *
 * @package raze
 */
 
function raze_customize_register_basic( $wp_customize ) {
	
	//Basic Theme Settings
	$wp_customize->add_section( 'raze_basic_settings' , array(
	    'title'      => __( 'Basic Settings', 'raze' ),
	    'priority'   => 10,
	) );
	
	$wp_customize->add_setting( 'raze_blog_title' , array(
	    'default'     => 'Latest Posts',
	    'sanitize_callback' => 'raze_sanitize_text',
	) );
	
	$wp_customize->add_control(	   
        'raze_blog_title',
        array(
            'label' => __('Title For Blog Posts on Homepage.','raze'),
            'section' => 'raze_basic_settings',
            'settings' => 'raze_blog_title',
            'priority' => 5,
            'type' => 'text',
        )
	);

    $wp_customize->add_setting( 'raze_sidebar_title' , array(
        'default'     => 'More Info',
        'sanitize_callback' => 'raze_sanitize_text',
    ) );

    $wp_customize->add_control(
        'raze_sidebar_title',
        array(
            'label' => __('Title For Sidebar.','raze'),
            'section' => 'raze_basic_settings',
            'settings' => 'raze_sidebar_title',
            'priority' => 5,
            'type' => 'text',
        )
    );

	$wp_customize->add_setting( 'raze_disable_foot_clink' , array(
	    'default'     => true,
	    'sanitize_callback' => 'raze_sanitize_checkbox',
	) );



	$wp_customize->add_control(
        'raze_disable_foot_clink',
        array(
            'label' => __('Disable Footer Credit Line', 'raze'),
            'section' => 'raze_basic_settings',
            'settings' => 'raze_disable_foot_clink',
            'priority' => 5,
            'type' => 'checkbox',
        )
	);
	
	//Logo Section Related
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Title, Tagline & Logo', 'raze' );
	
}
add_action( 'customize_register', 'raze_customize_register_basic' );
