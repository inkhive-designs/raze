<?php
function raze_customize_register_temp($wp_customize) {
    $wp_customize->add_section('raze_tempr_sec', array(
            'title' => __('Temp Section', 'raze'),
            'priority' => 19,
        )
    );
    $wp_customize->add_setting(
        'raze_featured_header',
        array(
            'sanitize_callback' => 'raze_sanitize_text'
        )
    );

    $wp_customize->add_setting(
        'raze_featured_page',
        array(
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        'raze_featured_page',
        array(
            'settings'		=> 'raze_featured_page',
            'section'		=> 'raze_tempr_sec',
            'type'			=> 'dropdown-pages',
            'label'			=> __( 'Select a Page', 'raze' )
        )
    );


    $wp_customize->add_setting(
        'raze_tempr_icon',
        array(
            'default'			=> 'fa fa-bell',
            'sanitize_callback' => 'raze_sanitize_text'
        )
    );

    $wp_customize->add_control(
        new Raze_Fontawesome_Icon_Chooser(
            $wp_customize,
            'raze_tempr_icon',
            array(
                'settings'		=> 'raze_tempr_icon',
                'section'		=> 'raze_tempr_sec',
                'label'			=> __( 'FontAwesome Icon', 'raze' ),
                'type'			=> 'icon',
            )
        )
    );

//    $wp_customize->add_setting(
//        'raze_skins',
//        array(
//            'sanitize_callback' => 'raze_sanitize_text'
//        )
//    );
//
//    $wp_customize->add_control(
//        new Raze_Skin_Chooser(
//            $wp_customize,
//            'raze_skins',
//            array(
//                'settings'		=> 'raze_skins',
//                'section'		=> 'raze_tempr_sec',
//                'label'			=> __( 'Skins', 'raze' ),
//                'description'   => __('Select a Skin', 'raze'),
//                'type'			=> 'skin',
//            )
//        )
//    );


    $wp_customize->add_setting('schedule_digit_setting', array(
        'default' => '',
        'type' => 'option',
    ));

    $wp_customize->add_setting('schedule_type_setting', array(
        'default' => '',
        'type' => 'option',
    ));

    $wp_customize->add_control(new WP_Customize_Schedule_Fields_Control(
        $wp_customize,
        'email_notification_schedule',
        array(
            'label' => __('Schedule Email Campaign'),
            'section' => 'raze_tempr_sec',
            'settings' => [
                'schedule_digit' => 'schedule_digit_setting',
                'schedule_type' => 'schedule_type_setting'
            ],
            // specify the kind of input field
            'type' => 'text',
            'input_attrs' => ['size' => 2, 'maxlength' => 2, 'style' => 'width:auto'],
            'select_attrs' => ['style' => 'width:auto'],
            'select_choices' => [
                'minutes' => __('Minutes'),
                'hours' => __('Hours'),
                'days' => __('Days'),
            ],
            'description' => __('Configure when email newsletter will be sent out after publication.'),
            'priority' => 80
        )
    ));

}
add_action('customize_register', 'raze_customize_register_temp');