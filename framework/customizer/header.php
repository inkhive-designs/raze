<?php
function raze_customize_register_header( $wp_customize ) {	
	//Header Sections
	$wp_customize->add_panel(
	    'raze_header_panel',
	    array(
	        'title'     => __('Header Settings','raze'),
	        'priority'  => 20,
	    )
	);
	
	$wp_customize->get_section('title_tagline')->panel = 'raze_header_panel';
	$wp_customize->get_section('header_image')->panel = 'raze_header_panel';
}
add_action('customize_register','raze_customize_register_header');	