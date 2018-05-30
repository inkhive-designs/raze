<?php
/* The Template to Render the showcase
*
*/

//Define all Variables.
?>

<div id="showcase" class="featured-area">
	<div class="container">
		<div class="showcase-container">
	            <div class="showcase-wrapper">
	            <?php
	            for ( $i = 1; $i <= 3; $i++ ) :

					$url = esc_url ( get_theme_mod('raze_showcase_url'.$i) );
					$img = esc_url ( get_theme_mod('raze_showcase_img'.$i) );
					$title = esc_html( get_theme_mod('raze_showcase_title'.$i) );
					$desc = esc_html( get_theme_mod('raze_showcase_desc'.$i) );
					 

					?>
					<div class="showcase-item col-md-4 col-sm-4 col-xs-6 col-xs-12">
						<?php if ($url !=	'') { ?>
		            	<a href="<?php echo $url; ?>">
			            <?php } ?>
                            <?php if($img): ?>
		            		<img src="<?php echo $img ?>" data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
                            <?php else: ?>
		            		<img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>" data-thumb="<?php echo $img ?>" title="<?php echo $title." - ".$desc ?>" />
                            <?php endif; ?>

		            	<div class="showcase-caption">
			                
			                <?php if ($title) : ?>
				                <div class="showcase-title"><?php echo $title ?></div>
				                <div class="showcase-desc"><span><?php echo $desc ?></span></div>
				            <?php endif; ?> 
				            
						</div>
						
						<?php if ($url !=	'') { ?>
						</a>
						<?php } ?>

		            </div>
	             <?php endfor; ?>
	               
	            </div>
	         
	        </div>
	</div>
</div>
