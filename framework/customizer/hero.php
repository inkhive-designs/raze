<?php
function raze_customize_register_hero($wp_customize) {
    //HERO 2
    $wp_customize->add_section('raze_hero2_section',
        array(
            'title' => __('HERO (Below Content)', 'raze'),
            'priority' => 40,
        )
    );

    $wp_customize->add_setting(
        'raze_hero_eta_enable',
        array(
            'sanitize_callback' => 'raze_sanitize_text',
            'default' => 'enable'
        )
    );

    $wp_customize->add_control(
        new Raze_Switch_Control(
            $wp_customize,
            'raze_hero_eta_enable',
            array(
                'settings'		=> 'raze_hero_eta_enable',
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
                'active_callback' => 'raze_hero_eta_active_callback'
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
            'active_callback' => 'raze_hero_eta_active_callback'
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
            'active_callback' => 'raze_hero_eta_active_callback'
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
            'active_callback' => 'raze_hero_eta_active_callback'
        )
    );

    /* Active Callback Function */
    function raze_hero_eta_active_callback( $control ) {
        $option = $control->manager->get_setting('raze_hero_eta_enable');
        return $option->value() == 'enable';
    }
}
add_action('customize_register', 'raze_customize_register_hero');