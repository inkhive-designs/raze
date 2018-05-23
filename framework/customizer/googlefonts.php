<?php
function raze_customize_register_fonts( $wp_customize ) {
    //Fonts
    $wp_customize->add_section(
        'raze_typo_options',
        array(
            'title'     => __('Google Web Fonts','raze'),
            'priority'  => 41,
            'description' => __('Defaults: Droid Serif, Ubuntu.','raze'),
            'panel' => 'raze_design_panel'
        )
    );

    $font_array = array('Nunito','Alegreya', 'Arvo','Source Sans Pro','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora');
    $fonts = array_combine($font_array, $font_array);

    $wp_customize->add_setting(
        'raze_title_font',
        array(
            'default'=> 'Nunito',
            'sanitize_callback' => 'raze_sanitize_gfont'
        )
    );

    function raze_sanitize_gfont( $input ) {
        if ( in_array($input, array('Nunito','Alegreya', 'Arvo','Source Sans Pro','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora',) ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'raze_title_font',array(
            'label' => __('Title','raze'),
            'settings' => 'raze_title_font',
            'section'  => 'raze_typo_options',
            'type' => 'select',
            'choices' => $fonts,
        )
    );

    $wp_customize->add_setting(
        'raze_body_font',
        array(	'default'=> 'Alegreya',
            'sanitize_callback' => 'raze_sanitize_gfont' )
    );

    $wp_customize->add_control(
        'raze_body_font',array(
            'label' => __('Body','raze'),
            'settings' => 'raze_body_font',
            'section'  => 'raze_typo_options',
            'type' => 'select',
            'choices' => $fonts
        )
    );
}
add_action('customize_register', 'raze_customize_register_fonts');