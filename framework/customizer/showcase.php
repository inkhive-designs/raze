<?php
/**
 * Raze Theme Customizer
 *
 * @package raze
 */
 
function raze_customize_register_showcase( $wp_customize ) {

    //CUSTOM SHOWCASE
	$wp_customize->add_panel( 'raze_showcase_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Custom Showcase','raze'),
	) );
	
	$wp_customize->add_section(
	    'raze_sec_showcase_options',
	    array(
	        'title'     => __('Enable/Disable','raze'),
	        'priority'  => 0,
	        'panel'     => 'raze_showcase_panel'
	    )
	);

    //ENABLE/DISABLE Showcase
    $wp_customize->add_setting(
        'raze_showcase_enable',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_showcase_enable',
            array(
                'settings'		=> 'raze_showcase_enable',
                'section'		=> 'raze_sec_showcase_options',
                'label'			=> __( 'Enable Showcase on Home/Blog', 'total' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );

    $wp_customize->add_setting(
        'raze_showcase_enable_front',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_showcase_enable_front',
            array(
                'settings'		=> 'raze_showcase_enable_front',
                'section'		=> 'raze_sec_showcase_options',
                'label'			=> __( 'Enable Showcase on Front Page', 'total' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );

    $wp_customize->add_setting(
        'raze_showcase_enable_posts',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_showcase_enable_posts',
            array(
                'settings'		=> 'raze_showcase_enable_posts',
                'section'		=> 'raze_sec_showcase_options',
                'label'			=> __( 'Enable Showcase on All Posts', 'total' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );
	
	$wp_customize->add_setting(
		'raze_showcase_priority',
		array( 'default'=> 10, 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'raze_showcase_priority', array(
		    'settings' => 'raze_showcase_priority',
		    'label'    => __( 'Priority', 'raze' ),
		    'section'  => 'raze_sec_showcase_options',
		    'type'     => 'number',
		    'description' => __('Elements with Low Value of Priority will appear first.','raze'),
		)
	);
	
	for ( $i = 1 ; $i <= 3 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		$wp_customize->add_section(
		    'raze_showcase_sec'.$i,
		    array(
		        'title'     => __('ShowCase ','raze').$i,
		        'priority'  => $i,
		        'panel'     => 'raze_showcase_panel',
		        
		    )
		);	
		
		$wp_customize->add_setting(
			'raze_showcase_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'raze_showcase_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'raze_showcase_sec'.$i,
		            'settings' => 'raze_showcase_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'raze_showcase_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'raze_showcase_title'.$i, array(
			    'settings' => 'raze_showcase_title'.$i,
			    'label'    => __( 'Showcase Title','raze' ),
			    'section'  => 'raze_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'raze_showcase_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'raze_showcase_desc'.$i, array(
			    'settings' => 'raze_showcase_desc'.$i,
			    'label'    => __( 'Showcase Description','raze' ),
			    'section'  => 'raze_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'raze_showcase_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'raze_showcase_url'.$i, array(
			    'settings' => 'raze_showcase_url'.$i,
			    'label'    => __( 'Target URL','raze' ),
			    'section'  => 'raze_showcase_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;

}
	
add_action( 'customize_register', 'raze_customize_register_showcase' );