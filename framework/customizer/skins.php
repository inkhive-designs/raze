<?php
/**
 * Raze Theme Customizer
 *
 * @package raze
 */
 
function raze_customize_register_skins( $wp_customize ) {

	//Replace Header Text Color with, separate colors for Title and Description
	//Override raze_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_control('background_color');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_setting('header_textcolor');

	$wp_customize->add_setting('raze_site_titlecolor', array(
	    'default'     => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'raze_site_titlecolor', array(
			'label' => __('Site Title Color','raze'),
			'section' => 'raze_skin_options',
			'settings' => 'raze_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('raze_header_desccolor', array(
	    'default'     => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'raze_header_desccolor', array(
			'label' => __('Site Tagline Color','raze'),
			'section' => 'raze_skin_options',
			'settings' => 'raze_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Select the Default Theme Skin
	$wp_customize->add_section(
	    'raze_skin_options',
	    array(
	        'title'     => __('Theme Skin & Colors','raze'),
	        'priority'  => 39,
            'panel'     => 'raze_design_panel'
	    )
	);
	
	function raze_sanitize_skin( $input ) {
		if ( in_array($input, array('default','brown','green','grayscale', 'darkblue','yellow','brie') ) )
			return $input;
		else
			return '';
	}

	//Skins
    $wp_customize->add_setting(
        'raze_skins',
        array(
	        'default'	=> 'default',
            'sanitize_callback' => 'raze_sanitize_skin',
            'transport'	=> 'refresh'
        )
    );

    if(!function_exists('raze_skin_array')){
        function raze_skin_array(){
            return array(
                '#2590df' => 'default',
                '#34c94a' => 'green',
                '#555' => 'grayscale',
                '#8b8c72' => 'brie',
                '#16447b' => 'darkblue',
                '#FFFA3B' => 'yellow',
                '#473432' => 'brown'
            );
        }
    }

    $raze_skin_array = raze_skin_array();


    $wp_customize->add_control(
        new Raze_Skin_Chooser(
            $wp_customize,
            'raze_skins',
            array(
                'settings'		=> 'raze_skins',
                'section'		=> 'raze_skin_options',
                'label'			=> __( 'Select Skins', 'raze' ),
                'type'			=> 'skins',
                'choices'		=> $raze_skin_array,
            )
        )
    );


}
	
add_action( 'customize_register', 'raze_customize_register_skins' );