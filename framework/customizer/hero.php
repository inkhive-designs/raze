<?php
function raze_customize_register_hero($wp_customize) {
    //HERO 1
    $wp_customize->add_panel('raze_hero_panel', array(
        'title' => __('Hero Settings', 'raze'),
        'priority' => 40,
    ));

    $wp_customize->add_section('raze_hero1_section',
        array(
            'title' => __('HERO (Above Content)', 'raze'),
            'priority' => 40,
            'panel' => 'raze_hero_panel'
        )
    );

    $wp_customize->add_setting(
        'raze_hero_top_enable',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_hero_top_enable',
            array(
                'settings'		=> 'raze_hero_top_enable',
                'section'		=> 'raze_hero1_section',
                'label'			=> __( 'Enable Featured Page Section On Home/Blog', 'raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );

    $wp_customize->add_setting(
        'raze_hero_top_enable_front',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_hero_top_enable_front',
            array(
                'settings'		=> 'raze_hero_top_enable_front',
                'section'		=> 'raze_hero1_section',
                'label'			=> __( 'Enable Featured Page Section On Front Page', 'raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );


    $wp_customize->add_setting(
        'raze_hero_top_enable_posts',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_hero_top_enable_posts',
            array(
                'settings'		=> 'raze_hero_top_enable_posts',
                'section'		=> 'raze_hero1_section',
                'label'			=> __( 'Enable Featured Page Section On All Posts', 'raze' ),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );



    $wp_customize->add_setting('raze_hero1_background_image',
        array(
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'raze_hero1_background_image',
            array (
                'setting' => 'raze_hero1_background_image',
                'section' => 'raze_hero1_section',
                'label' => __('Background Image', 'raze'),
                'description' => __('Upload an image to display in background of HERO', 'raze'),
                'active_callback' => 'raze_hero_top_active_callback'
            )
        )
    );

    $wp_customize->add_setting('raze_hero1_selectpage',
        array(
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control('raze_hero1_selectpage',
        array(
            'setting' => 'raze_hero1_selectpage',
            'section' => 'raze_hero1_section',
            'label' => __('Title', 'raze'),
            'description' => __('Select a Page to display Title', 'raze'),
            'type' => 'dropdown-pages',
            'active_callback' => 'raze_hero_top_active_callback'
        )
    );

    $wp_customize->add_setting('raze_hero1_full_content',
        array(
            'sanitize_callback' => 'raze_sanitize_checkbox'
        )
    );

    $wp_customize->add_control('raze_hero1_full_content',
        array(
            'setting' => 'raze_hero1_full_content',
            'section' => 'raze_hero1_section',
            'label' => __('Show Full Content instead of excerpt', 'raze'),
            'type' => 'checkbox',
            'default' => false,
            'active_callback' => 'raze_hero_top_active_callback'
        )
    );

    $wp_customize->add_setting('raze_hero1_button',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('raze_hero1_button',
        array(
            'setting' => 'raze_hero1_button',
            'section' => 'raze_hero1_section',
            'label' => __('Button Name', 'raze'),
            'description' => __('Leave blank to disable Button.', 'raze'),
            'type' => 'text',
            'active_callback' => 'raze_hero_top_active_callback'
        )
    );

    for ($i=1; $i<=3; $i++):
        $wp_customize->add_setting('raze_hero1_loadbar_title'.$i,
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control('raze_hero1_loadbar_title'.$i,
            array(
                'setting' => 'raze_hero1_loadbar_title'.$i,
                'section' => 'raze_hero1_section',
                'label' => __('Enter Title for laodbar ', 'raze').$i,
                'description' => __('Leave blank to disable Loadbar.', 'raze'),
                'type' => 'text',
                'active_callback' => 'raze_hero_top_active_callback'
            )
        );

        $wp_customize->add_setting('raze_hero1_loadbar'.$i,
            array(
                'sanitize_callback' => 'absint'
            )
        );
        $wp_customize->add_control('raze_hero1_loadbar'.$i,
            array(
                'setting' => 'raze_hero1_loadbar'.$i,
                'section' => 'raze_hero1_section',
                'label' => __('Loadbar Number(%) ', 'raze').$i,
                'description' => __('Leave blank to disable Loadbar.', 'raze'),
                'type' => 'text',
                'active_callback' => 'raze_hero_top_active_callback'
            )
        );
    endfor;

    /* Active Callback Function */
    function raze_hero_top_active_callback( $control ) {
        $option = $control->manager->get_setting('raze_hero_top_enable');
        return $option->value() == 'enable';
    }


    //HERO 2
    $wp_customize->add_section('raze_hero2_section',
        array(
            'title' => __('HERO (Below Content)', 'raze'),
            'priority' => 40,
            'panel' => 'raze_hero_panel'
        )
    );

    $wp_customize->add_setting(
        'raze_hero_bottom_enable',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_hero_bottom_enable',
            array(
                'settings'		=> 'raze_hero_bottom_enable',
                'section'		=> 'raze_hero2_section',
                'label' => __('Enable HERO', 'raze'),
                'enable_disable' 	=> array(
                    'enable' => __( 'Enabled', 'raze' ),
                    'disable' => __( 'Disabled', 'raze' )
                )
            )
        )
    );


    $wp_customize->add_setting('raze_hero2_background_image',
        array(
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'raze_hero2_background_image',
            array (
                'setting' => 'raze_hero2_background_image',
                'section' => 'raze_hero2_section',
                'label' => __('Background Image', 'raze'),
                'description' => __('Upload an image to display in background of HERO', 'raze'),
                'active_callback' => 'raze_hero_bottom_active_callback'
            )
        )
    );

    $wp_customize->add_setting('raze_hero2_selectpage',
        array(
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control('raze_hero2_selectpage',
        array(
            'setting' => 'raze_hero2_selectpage',
            'section' => 'raze_hero2_section',
            'label' => __('Title', 'raze'),
            'description' => __('Select a Page to display Title', 'raze'),
            'type' => 'dropdown-pages',
            'active_callback' => 'raze_hero_bottom_active_callback'
        )
    );

    $wp_customize->add_setting('raze_hero2_full_content',
        array(
            'sanitize_callback' => 'raze_sanitize_checkbox'
        )
    );

    $wp_customize->add_control('raze_hero2_full_content',
        array(
            'setting' => 'raze_hero2_full_content',
            'section' => 'raze_hero2_section',
            'label' => __('Show Full Content instead of excerpt', 'raze'),
            'type' => 'checkbox',
            'default' => false,
            'active_callback' => 'raze_hero_bottom_active_callback'
        )
    );

    $wp_customize->add_setting('raze_hero2_button',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('raze_hero2_button',
        array(
            'setting' => 'raze_hero2_button',
            'section' => 'raze_hero2_section',
            'label' => __('Button Name', 'raze'),
            'description' => __('Leave blank to disable Button.', 'raze'),
            'type' => 'text',
            'active_callback' => 'raze_hero_bottom_active_callback'
        )
    );

    /* Active Callback Function */
    function raze_hero_bottom_active_callback( $control ) {
        $option = $control->manager->get_setting('raze_hero_bottom_enable');
        return $option->value() == 'enable';
    }
}
add_action('customize_register', 'raze_customize_register_hero');