<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.

if (class_exists('rt_slider') ) :
	$count = esc_html( rt_slider::fetch('count') );
?>
<div id="slider-bg" data-stellar-background-ratio="0.5">
	<div class="container-fluid slider-container-wrapper">
		<div class="slider-container featured-area container theme-default">
	            <div class="swiper-wrapper">
	            <?php
	            for ( $i = 1; $i <= $count; $i++ ) :

                    $url = esc_url( rt_slider::fetch('url', $i ) );
                    $img = esc_url( rt_slider::fetch('img', $i ) );
                    $title = esc_html( rt_slider::fetch('title', $i ) );
                    $desc = esc_html( rt_slider::fetch('desc', $i) );
                    $button = esc_html( rt_slider::fetch('cta_button', $i) );


                    ?>
					<div class="swiper-slide">
		            	<a href="<?php echo $url; ?>">
		            		<img src="<?php echo $img ?>" data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
		            	</a>
		            	<div class="slidecaption">
			                
			                <?php if ($title) : ?>
				                <div class="slide-title"><?php echo $title ?></div>
                            <?php endif; ?>
                            <?php if ($desc): ?>
				                <div class="slide-desc"><span><?php echo $desc ?></span></div>
				            <?php endif; ?>
                            <?php if ($button): ?>
                                <div class="slide-cta"><a href="<?php echo $url; ?>"><?php echo $button ?></a></div>
                            <?php endif; ?>
						</div>
		            </div>
	             <?php endfor; ?>
	               
	            </div>
	            <?php if ( get_theme_mod('raze_slider_pager', true ) ) : ?>
	            <div class="swiper-pagination swiper-pagination-white"></div>
	            <?php endif; ?>
				
				 <?php if ( get_theme_mod('raze_slider_arrow', true ) ) : ?>
				<div class="swiper-button-next slidernext swiper-button-white"></div>
				<div class="swiper-button-prev sliderprev swiper-button-white"></div>
				<?php endif; ?>
	        </div>
	</div> 
</div>
<?php endif; ?>
 