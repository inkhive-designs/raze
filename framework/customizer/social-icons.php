<?php
function raze_customize_register_social( $wp_customize ) {
    // Social Icons
    $wp_customize->add_section('raze_social_section', array(
        'title' => __('Social Icons','raze'),
        'priority' => 44 ,
        'panel' => 'raze_header_panel'
    ));

    $social_networks = array( //Redefinied in Sanitization Function.
        'none' => __('-','raze'),
        'facebook-f' => __('Facebook','raze'),
        'twitter' => __('Twitter','raze'),
        'google-plus-g' => __('Google Plus','raze'),
        'instagram' => __('Instagram','raze'),
        'vine' => __('Vine','raze'),
        'vimeo-v' => __('Vimeo','raze'),
        'youtube' => __('Youtube','raze'),
        'flickr' => __('Flickr','raze'),
        'pinterest-p'	=> __('Pinterest', 'raze'),
    );

    $social_icon_styles = array(
        'none' => __('Default', 'raze'),
        'style1' => __('Style 1', 'raze'),
        'style2' => __('Style 2', 'raze'),
        'style3' => __('Style 3', 'raze')
    );

    $wp_customize->add_setting('raze_social_icon_style', array(
        'default' => 'none',
        'sanitize_callback' => 'raze_sanitize_social_style'
    ) );

    function raze_sanitize_social_style($input) {
        $social_icon_styles = array(
            'none',
            'style1',
            'style2',
            'style3',
        );
        if ( in_array($input, $social_icon_styles))
            return $input;
        else
            return '';
    }

    $wp_customize->add_control('raze_social_icon_style', array(
            'setting' => 'raze_social_icon_style',
            'section' => 'raze_social_section',
            'label' => __('Social Icon Effects', 'raze'),
            'type' => 'select',
            'choices' => $social_icon_styles,
        )
    );

    $social_count = count($social_networks);

    for ($x = 1 ; $x <= ($social_count - 4) ; $x++) :

        $wp_customize->add_setting(
            'raze_social_'.$x, array(
            'sanitize_callback' => 'raze_sanitize_social',
            'default' => 'none'
        ));

        $wp_customize->add_control( 'raze_social_'.$x, array(
            'settings' => 'raze_social_'.$x,
            'label' => __('Icon ','raze').$x,
            'section' => 'raze_social_section',
            'type' => 'select',
            'choices' => $social_networks,
        ));

        $wp_customize->add_setting(
            'raze_social_url'.$x, array(
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control( 'raze_social_url'.$x, array(
            'settings' => 'raze_social_url'.$x,
            'description' => __('Icon ','raze').$x.__(' Url','raze'),
            'section' => 'raze_social_section',
            'type' => 'url',
            'choices' => $social_networks,
        ));

    endfor;

    function raze_sanitize_social( $input ) {
        $social_networks = array(
            'none' ,
            'facebook-f',
            'twitter',
            'google-plus-g',
            'instagram',
            'vine',
            'vimeo-v',
            'youtube',
            'flickr',
            'pinterest-p',
        );
        if ( in_array($input, $social_networks) )
            return $input;
        else
            return '';
    }
}
add_action('customize_register', 'raze_customize_register_social');