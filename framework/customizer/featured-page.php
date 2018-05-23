<?php
function raze_customize_register_featured_page($wp_customize) {
    $wp_customize->add_section('raze_fpage_sec', array(
            'title' => __('Featured Page Section', 'raze'),
            'priority' => 21,
        )
    );



    $wp_customize->add_setting(
        'raze_fpage_enable',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_fpage_enable',
            array(
                'settings'		=> 'raze_fpage_enable',
                'section'		=> 'raze_fpage_sec',
                'label'			=> __( 'Enable Featured Page Section On Home/Blog', 'raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );

    $wp_customize->add_setting(
        'raze_fpage_enable_posts',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_fpage_enable_front',
            array(
                'settings'		=> 'raze_fpage_enable_posts',
                'section'		=> 'raze_fpage_sec',
                'label'			=> __( 'Enable Featured Page Section On Front Page', 'raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );


    $wp_customize->add_setting(
        'raze_fpage_enable_front',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_fpage_enable_posts',
            array(
                'settings'		=> 'raze_fpage_enable_front',
                'section'		=> 'raze_fpage_sec',
                'label'			=> __( 'Enable Featured Page Section On All Posts', 'raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );


    $wp_customize->add_setting(
        'raze_fpage_title',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('raze_fpage_title', array(
                'settings'		=> 'raze_fpage_title',
                'section'		=> 'raze_fpage_sec',
                'label'         => __('Enter The Section Heading', 'raze'),
                'type'			=> 'text',
            )
    );

    $wp_customize->add_setting(
        'raze_fpage_description',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control('raze_fpage_description', array(
            'settings'		=> 'raze_fpage_description',
            'section'		=> 'raze_fpage_sec',
            'label'         => __('Enter The Section Description', 'raze'),
            'type'			=> 'text',
        )
    );

    for($x=1; $x<=4; $x++):

    $wp_customize->add_setting('raze_select_fpage_'.$x,
        array(
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control('raze_select_fpage_'.$x,
        array(
            'setting' => 'raze_select_fpage_'.$x,
            'section' => 'raze_fpage_sec',
            'label'	=> __( 'Select Featured Page ', 'raze' ).$x,
            'type' => 'dropdown-pages',
        )
    );


    $wp_customize->add_setting(
        'raze_fpage_icons_'.$x,
        array(
            'default'			=> 'fa fa-star',
            'sanitize_callback' => 'raze_sanitize_text'
        )
    );

    $wp_customize->add_control(
        new Raze_Fontawesome_Icon_Chooser(
            $wp_customize,
            'raze_fpage_icons_'.$x,
            array(
                'settings'		=> 'raze_fpage_icons_'.$x,
                'section'		=> 'raze_fpage_sec',
                'label'			=> __( 'Select FontAwesome Icon ', 'raze' ).$x,
                'type'			=> 'icon',
            )
        )
    );
    endfor;

    $wp_customize->add_setting(
        'raze_fpage_section_img',
        array( 'sanitize_callback' => 'esc_url_raw' )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'raze_fpage_section_img',
            array(
                'section' => 'raze_fpage_sec',
                'label' => __('Upload an Image', 'raze'),
                'settings' => 'raze_fpage_section_img',
            )
        )
    );
}
add_action('customize_register', 'raze_customize_register_featured_page');