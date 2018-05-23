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
	
	$wp_customize->add_setting(
		'raze_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'raze_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(red)','raze'),
					'green' => __('Green','raze'),
					'brown' => __('Brown','raze'),
					'darkblue' => __('Dark Blue','raze'),
					'grayscale' => __('Grayscale','raze'),
					'yellow' => __('Yellow','raze'),
					'brie' => __('Brie','raze'),
					);


	$wp_customize->add_control(
		'raze_skin',array(
				'settings' => 'raze_skin',
				'section'  => 'raze_skin_options',
				'label' => __('Choose from the Skins Below','raze'),
				'type' => 'select',
				'choices' => $skins,
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
            'default'			=> '#555',
            'sanitize_callback' => 'raze_sanitize_text'
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
                'choices'       => $raze_skin_array,
            )
        )
    );
	
	//CUSTOM SKIN BUILDER
	
	$wp_customize->add_setting('raze_skin_var_background', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'raze_skin_var_background', array(
			'label' => __('Primary Background','raze'),
			'section' => 'raze_skin_options',
			'settings' => 'raze_skin_var_background',
			'active_callback' => 'raze_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	
	$wp_customize->add_setting('raze_skin_var_accent', array(
	    'default'     => '#be2819',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'raze_skin_var_accent', array(
			'label' => __('Primary Accent','raze'),
			'description' => __('For Most Users, Changing this only color is sufficient.','raze'),
			'section' => 'raze_skin_options',
			'settings' => 'raze_skin_var_accent',
			'type' => 'color',
			'active_callback' => 'raze_skin_custom',
		) ) 
	);	
	
	$wp_customize->add_setting('raze_skin_var_content', array(
	    'default'     => '#777777',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'raze_skin_var_content', array(
			'label' => __('Content Color','raze'),
			'description' => __('Must be Dark, like Black or Dark grey. Any darker color is acceptable.','raze'),
			'section' => 'raze_skin_options',
			'settings' => 'raze_skin_var_content',
			'active_callback' => 'raze_skin_custom',
			'type' => 'color'
		) ) 
	);
	
	function raze_skin_custom( $control ) {
		$option = $control->manager->get_setting('raze_skin');
	    return $option->value() == 'custom' ;
	}

}
	
add_action( 'customize_register', 'raze_customize_register_skins' );