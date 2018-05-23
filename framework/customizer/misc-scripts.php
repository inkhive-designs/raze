<?php
/**
 * raze Theme Customizer
 *
 * @package raze
 */

function raze_customize_register_misc( $wp_customize ) {

	//Important Links
    $wp_customize->add_section(
        'raze_sec_premsupport',
        array(
            'title'     => __('Important Links','raze'),
            'priority'  => 1,
        )
    );

    $wp_customize->add_setting(
        'raze_important_links',
        array(
            'sanitize_callback' => 'raze_sanitize_text'
        )
    );

    $wp_customize->add_control(
        new Raze_misc_scripts(
            $wp_customize,
            'raze_important_links',
            array(
                'settings'		=> 'raze_important_links',
                'section'		=> 'raze_sec_premsupport',
                'description'	=> '<a class="raze-important-links" href="https://inkhive.com/contact-us/" target="_blank">'.__('InkHive Support Forum', 'raze').'</a>
                                    <a class="raze-important-links" href="https://demo.inkhive.com/raze-plus/" target="_blank">'.__('Raze Live Demo', 'raze').'</a>
                                    <a class="raze-important-links" href="https://inkhive.com/documentation/raze" target="_blank">'.__('Raze Documentation', 'raze').'</a>
                                    <a class="raze-important-links" href="https://www.facebook.com/inkhivethemes/" target="_blank">'.__('We Love Our Facebook Fans', 'raze').'</a>
                                    <a class="raze-important-links" href="https://wordpress.org/support/theme/wpre/reviews" target="_blank">'.__('Review Us', 'raze').'</a>'
            )
        )
    );
}
add_action( 'customize_register', 'raze_customize_register_misc' );