<?php
/*
 * @package raze, Copyright Rohit Tripathi, rohitink.com
 * This file contains Custom Theme Related Functions.
 */

class Raze_Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="menu-desc">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

class Raze_Menu_With_Icon extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
		$attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}

/*
 * Pagination Function. Implements core paginate_links function.
 */
function raze_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array',
        'prev_text' => __('<< Newer', 'raze'),
        'next_text' => __('Older >>', 'raze'),
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}


/*
** Function to Trim the length of Excerpt and More
*/
function raze_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'raze_excerpt_length', 999 );

function raze_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'raze_excerpt_more' );


/*
** Function to check if Sidebar is enabled on Current Page 
*/
function raze_load_sidebar() {
	$load_sidebar = true;
	if ( get_theme_mod('raze_disable_sidebar')  == 'disable' ) :
		$load_sidebar = false;
	elseif( get_theme_mod('raze_disable_sidebar_home')  == 'disable' && is_home() )	:
		$load_sidebar = false;
	elseif( get_theme_mod('raze_disable_sidebar_front')  == 'disable' && is_front_page() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('raze_disable_sidebar_archive')  == 'disable' && is_archive() ) :
		$load_sidebar = false;
	elseif( get_theme_mod('raze_disable_sidebar_portfolio')  == 'disable' && (get_post_type() == 'portfolio') ) :
		$load_sidebar = false;			
	elseif ( get_post_meta( get_the_ID(), 'enable-full-width', true ) )	:
		$load_sidebar = false;
	endif;
	
	return  $load_sidebar;
}


/*
**	Determining Sidebar and Primary Width
*/
function raze_primary_class() {
	$sw = esc_html( get_theme_mod('raze_sidebar_width',4) );
	$class = "col-md-".(12-$sw);
	
	if ( !raze_load_sidebar() ) 
		$class = "col-md-12";
	
	echo $class;
}
add_action('raze_primary-width', 'raze_primary_class');

function raze_secondary_class() {
	$sw = esc_html( get_theme_mod('raze_sidebar_width',4) );
	$class = "col-md-".$sw;
	
	echo $class;
}
add_action('raze_secondary-width', 'raze_secondary_class');

/*
**	Helper Function to Convert Colors
*/
function raze_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}
function raze_fade($color, $val) {
	return "rgba(".raze_hex2rgb($color).",". $val.")";
}



/*
** Function to Set Main Class 
*/
function raze_get_main_class(){
	
	$layout = get_theme_mod('raze_blog_layout');
	$template = get_post_meta( get_the_id(), '_wp_page_template', true );
	if ( $template == 'templates/template-blog-raze.php' ) {
		$mason = true;
	} else { 
		$mason = false;
	}
	if ($layout == 'raze' || $mason) {
	    	echo 'masonry-main';
	}		
}
add_action('raze_main-class', 'raze_get_main_class');


/*
** Function to Get Theme Layout 
*/
function raze_get_blog_layout(){
	$ldir = 'framework/layouts/content';
	if (get_theme_mod('raze_blog_layout') ) :
		get_template_part( $ldir , get_theme_mod('raze_blog_layout') );
	else :
		get_template_part( $ldir ,'grid');	
	endif;	
}
add_action('raze_blog_layout', 'raze_get_blog_layout');

/*
** Function to Render Featured Category Area for Front Page
*/
function raze_featured_posts( $title, $category_id = 0, $icon = "fa-star"  ) { ?>
	
	<div class="featured-section">
		
		<div class="section-title">
			<i class="fa <?php echo esc_attr($icon); ?>"></i><span><?php echo esc_html($title); ?></span>
		</div>
		
		<?php /* Start the Loop */  
		$args = array( 
			'posts_per_page' => 3,
			'cat' => $category_id,
			'ignore_sticky_posts' => true,
		);
		
		$lastposts = new WP_Query($args);
		
		while ( $lastposts->have_posts() ) :
		  $lastposts->the_post(); 
		  
		  global $raze_fpost_ids;
		  $raze_fpost_ids[] = get_the_id(); 
		  
		 	
		
		  ?> 	
				
		<article id="post-<?php the_ID(); ?>" <?php post_class('item col-md-4 col-xs-10 col-xs-offset-1 col-sm-offset-0 col-sm-4'); ?>>
			<div class="item-container">
					<?php if (has_post_thumbnail()) : ?>	
						<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('raze-thumb'); ?></a>
					<?php else : ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/featpostthumb.jpg"; ?>"></a>

					<?php endif; ?>
					<div class="featured-caption">
						<a class="post-title" href="<?php the_permalink() ?>"><?php echo the_title(); ?></a>
						<span class="postdate title-font"><?php the_time(__('M j, Y','raze')); ?></span>
					</div>
					
			</div>		
				
		</article><!-- #post-## -->
			
		<?php endwhile; 
		wp_reset_postdata();?>
			
	</div>	
	
<?php }
//Create an Array to Store Post Ids of all posts that have been displayed already.
$raze_fpost_ids = array();
			
//Function to Exclude already displayed posts form the Homepage.
for ($i = 1; $i < 3; $i++ ) :
	if (get_theme_mod('raze_featposts_enable'.$i) && get_theme_mod('raze_featposts_cat'.$i) ) :
		
		$args = array( 
			'posts_per_page' => 3,
			'cat' => get_theme_mod('raze_featposts_cat'.$i),
			'ignore_sticky_posts' => true,
		);
		
		$lastposts = new WP_Query($args);
		
		while ( $lastposts->have_posts() ) :
		  $lastposts->the_post(); 
		  
		  global $raze_fpost_ids;
		  $raze_fpost_ids[] = get_the_id(); 
		  
		 endwhile; 
	endif;	
	
	wp_reset_postdata();
		
endfor;
		
function raze_exclude_single_posts_home($query) {		
global $raze_fpost_ids;
if ($query->is_home() && $query->is_main_query()) {
    $query->set('post__not_in', $raze_fpost_ids);
  }
}	
add_action('pre_get_posts', 'raze_exclude_single_posts_home');


/*
** Function to Deal with Elements of Inequal Heights, Enclose them in a bootstrap row.
*/
function raze_open_div_row() {
	echo "<div class='row grid-row col-md-12'>";
}
function raze_close_div_row() {
	echo "</div><!--.grid-row-->";
}


function raze_before_article() {

	global $raze_post_count;
	$array_2_3_4 = array('grid_2_column',
							'raze',	//2 col
							'templates/template-blog-raze.php',
							'templates/template-blog-grid2c.php',
						);
	//wp_reset_postdata();	- Don't Reset any Data, because we are not using get_post_meta	
	//See what the get_queried_object_id() function does. Though, the Query is reset in template files.			
	//For 2,3,4 Column Posts
	$page_template = get_post_meta( get_queried_object_id(), '_wp_page_template', true );
	$raze_layout = get_theme_mod('raze_blog_layout'); //BUG FIXER
	if (is_page_template() ) : //Disable input from raze Layout if we are in a page template.
		$raze_layout = 'none';
	endif;
	
	if ( in_array( $raze_layout, $array_2_3_4 ) || in_array( $page_template, $array_2_3_4 ) ) : 
			 if ( $raze_post_count  == 0 ) {
			  	raze_open_div_row();
			  }
	endif;	  	
}
add_action('raze_before-article', 'raze_before_article');



/*
** Function to check if Component is Enabled.
*/
function raze_is_enabled( $component ) {
	
	wp_reset_postdata();
	$return_val = false;
	switch ($component) {
		case 'showcase' :
		
			 if ( ( get_theme_mod('raze_showcase_enable') == 'enable' && is_home() )
			 	|| ( get_theme_mod('raze_showcase_enable_posts') == 'enable' && is_single() )
			 	|| ( get_theme_mod('raze_showcase_enable_front') == 'enable'  && is_front_page() )):
			 		$return_val = true;
			 	endif;
			 	break;

        case 'hero' :

            if ( ( get_theme_mod('raze_hero_top_enable') == 'enable' && is_home() )
                || ( get_theme_mod('raze_hero_top_enable_posts') == 'enable' && is_single() )
                || ( get_theme_mod('raze_hero_top_enable_front') == 'enable'  && is_front_page() ) ):
                $return_val = true;
            endif;
            break;

        case 'featured-page' :

            if( ( get_theme_mod('raze_fpage_enable') == 'enable' && is_home() )
                || ( get_theme_mod('raze_fpage_enable_posts') == 'enable' && is_single() )
                || ( get_theme_mod('raze_fpage_enable_front') == 'enable' && is_front_page() ) ) :
                $return_val = true;
            endif;
            break;

	}//endswitch
	
	return $return_val;
	
}

/*
**	Hook Just before content. To Display Featured Content and Slider.
*/
function raze_display_fc() {
	
		//Nested Function
		function show($s) {
			switch ($s) {
				case 'showcase':
					if  ( raze_is_enabled( 'showcase' ) )
						get_template_part('featured','showcase' );
					break;
                case 'hero-top':
                    if  ( raze_is_enabled( 'hero' ) )
                        get_template_part('hero','top' );
                    break;
                case 'featured-page':
                    if ( raze_is_enabled('featured-page'))
                        get_template_part('featured', 'pagesection');
                    break;
			}	
					
		}

		//get order of components
		$list = array('showcase', 'hero-top', 'featured-page'); //Write Them in their Default Order of Appearance.
		$order = array();
		
		$x = 0;
		foreach ($list as $i) {	
			if( get_theme_mod('raze_'.$i.'_priority') == 10 ) : //Customizer Defaults Loaded
				$order[] = 10 + $x;
			else :		
				$order[] = get_theme_mod('raze_'.$i.'_priority' , 10 + $x);
			endif;	
			$x += 0.01; //Use Decimel Because users can set priority as 11 too.
		}
		
		$sorted = array_combine($order, $list);
		ksort($sorted); //Sort on the Value of Keys 
		$sorted = array_values($sorted); //Fetch only the values, get rid of keys.
				
		
		//Display the Components
		foreach($sorted as $s) {
				show($s);
		}	
		
}
add_action('raze-before_content', 'raze_display_fc');

/*
** Header custom js
*/
function raze_header_js() {
	if ( get_theme_mod('raze_custom_js') ) 
		echo "<script>".get_theme_mod('raze_custom_js')."</script>";
		
}
add_action('wp_head', 'raze_header_js');

/*
** Load WooCommerce Compatibility FIle
*/
if ( class_exists('woocommerce') ) :
	require get_template_directory() . '/framework/woocommerce.php';
endif;


//Backwards Compatibility FUnction
function raze_logo() {
    if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }
}

function raze_has_logo() {
    if (function_exists( 'has_custom_logo')) {
        if ( has_custom_logo() ) {
            return true;
        }
    } else {
        return false;
    }
}


/**
 * Include Meta Boxes.
 */
 
require get_template_directory() . '/framework/metaboxes/page-attributes.php';
require get_template_directory() . '/framework/metaboxes/display-options.php';

