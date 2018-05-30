<?php
/**
 * Raze Theme Customizer
 *
 * @package raze
 */

function raze_customize_register_layouts( $wp_customize ) {

    $wp_customize->get_section('background_image')->panel ='raze_design_panel';
	// Layout and Design
	$wp_customize->add_panel( 'raze_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','raze'),
	) );

	$wp_customize->add_section(
	    'raze_design_options',
	    array(
	        'title'     => __('Blog Layout','raze'),
	        'priority'  => 0,
	        'panel'     => 'raze_design_panel'
	    )
	);


	$wp_customize->add_setting(
		'raze_blog_layout',
		array( 
			'default'		=> 'raze',
		'sanitize_callback' => 'raze_sanitize_blog_layout' )
	);

	function raze_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','raze','grid_2_column','photos_1_column') ) )
			return $input;
		else
			return '';
	}

	$wp_customize->add_control(
		'raze_blog_layout',array(
				'label' => __('Select Layout','raze'),
				'settings' => 'raze_blog_layout',
				'section'  => 'raze_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Standard Blog Layout','raze'),
						'raze' => __('Raze Theme Layout','raze'),
						'grid_2_column' => __('Grid - 2 Column','raze'),
						'photos_1_column' => __('Photography - 1 Column','raze'),
					)
			)
	);

	$wp_customize->add_section(
	    'raze_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','raze'),
	        'priority'  => 0,
	        'panel'     => 'raze_design_panel'
	    )
	);

    $wp_customize->add_setting(
        'raze_disable_sidebar',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_disable_sidebar',
            array(
                'settings'		=> 'raze_disable_sidebar',
                'section'		=> 'raze_sidebar_options',
                'label'    => __( 'Disable Sidebar Everywhere.','raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );

    $wp_customize->add_setting(
        'raze_disable_sidebar_home',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_disable_sidebar_home',
            array(
                'settings'		=> 'raze_disable_sidebar_home',
                'section'		=> 'raze_sidebar_options',
                'label'    => __( 'Disable Sidebar on Home/Blog.','raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                ),
                'active_callback' => 'raze_show_sidebar_options',
            )
        )
    );


    $wp_customize->add_setting(
        'raze_disable_sidebar_front',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_disable_sidebar_front',
            array(
                'settings'		=> 'raze_disable_sidebar_front',
                'section'		=> 'raze_sidebar_options',
                'label'    => __( 'Disable Sidebar on Front Page.','raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                ),
                'active_callback' => 'raze_show_sidebar_options',
            )
        )
    );


	$wp_customize->add_setting(
		'raze_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'raze_sanitize_positive_number' )
	);

	$wp_customize->add_control(
			'raze_sidebar_width', array(
		    'settings' => 'raze_sidebar_width',
		    'label'    => __( 'Sidebar Width','raze' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','raze'),
		    'section'  => 'raze_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'raze_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);

	$wp_customize->add_setting(
		'raze_sidebar_loc',
		array(
			'default' => 'right',
		    'sanitize_callback' => 'raze_sanitize_sidebar_loc' )
	);

	$wp_customize->add_control(
			'raze_sidebar_loc', array(
		    'settings' => 'raze_sidebar_loc',
		    'label'    => __( 'Sidebar Location','raze' ),
		    'section'  => 'raze_sidebar_options',
		    'type'     => 'select',
		    'active_callback' => 'raze_show_sidebar_options',
		    'choices' => array(
		        'left'   => "Left",
		        'right'   => "Right",
		    ),
		)
	);

	/* sanitization */
	function raze_sanitize_sidebar_loc( $input ) {
		if (in_array($input, array('left','right') ) ) :
			return $input;
		else :
			return '';
		endif;
	}


	/* Active Callback Function */
	function raze_show_sidebar_options($control) {

	    $option = $control->manager->get_setting('raze_disable_sidebar');
	    return $option->value() == 'enable' ;

	}

	$wp_customize-> add_section(
    'raze_footer_columns',
    array(
    	'title'			=> __('Custom Footer Text','raze'),
    	'priority'		=> 10,
    	'panel'			=> 'raze_design_panel'
    	)
    );

	$wp_customize->add_setting(
	'raze_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
	       'raze_footer_text',
	        array(
		        'label' => 'Custom Footer Text',
	            'section' => 'raze_footer_columns',
	            'settings' => 'raze_footer_text',
	            'type' => 'text'
	        )
	);

}

add_action( 'customize_register', 'raze_customize_register_layouts' );