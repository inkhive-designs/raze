<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function raze_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	
	//If Menu Description is Disabled.
	if ( !has_nav_menu('primary') || get_theme_mod('raze_disable_nav_desc') ) :
		echo "#site-navigation ul li a { padding: 29px 20px; }";
	endif;
	
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('raze_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;

    // Title & Tagline Color
    if ( get_theme_mod('raze_title_font') ) :
        echo ".title-font, h1, h2, .section-title, .woocommerce ul.products li.product h3 { font-family: ".esc_html( get_theme_mod('raze_title_font','Nunito') )."; }";
    endif;

    if ( get_theme_mod('raze_body_font') ) :
        echo "body, h2.site-description { font-family: ".esc_html( get_theme_mod('raze_body_font','Alegreya') )."; }";
    endif;
	
	if ( get_theme_mod('raze_site_titlecolor', '#fff') ) :
		echo "#masthead h1.site-title a { color: ".esc_html( get_theme_mod('raze_site_titlecolor', '#fff') )."; }";
	endif;
	
	
	if ( get_theme_mod('raze_header_desccolor','#ffff') ) :
		echo "#masthead h2.site-description { color: ".esc_html( get_theme_mod('raze_header_desccolor','#ffff') )."; }";
	endif;

    if (get_theme_mod('raze_hero1_background_image')) :
        $image1 = get_theme_mod('raze_hero1_background_image');
        echo "#hero1 {
                    background-image: url('" . $image1 . "');
                    background-size: cover;
                }";
    endif;

    if (get_theme_mod('raze_hero1_background_image')):
        echo "#hero1 .h-content .excerpt, #hero1 .h-content h1.title {
                    color: white;
                }";
    else:
        echo "#hero1 .h-content .excerpt, #hero1 .h-content h1.title {
                    color: black;
                } ";

    endif;

    if (get_theme_mod('raze_hero2_background_image')) :
        $image2 = get_theme_mod('raze_hero2_background_image');
        echo "#hero2 {
                    background-image: url('" . $image2 . "');
                    background-size: cover;
                }";
    endif;

    if (get_theme_mod('raze_hero2_background_image')):
        echo "#hero2 .h-content .excerpt, #hero2 .h-content h1.title {
                    color: white;
                }";
    else:
        echo "#hero2 .h-content .excerpt, #hero2 .h-content h1.title {
                    color: black;
                } ";

    endif;

	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		echo '.pagination { display: none; }';
	
	
	if ( get_theme_mod('raze_logo_resize') ) :
		$val = esc_html( get_theme_mod('raze_logo_resize') )/100;
		echo "#masthead .custom-logo { transform-origin: center; transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;

	echo "</style>";
}

add_action('wp_head', 'raze_custom_css_mods');