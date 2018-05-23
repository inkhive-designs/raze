<div id="fpage">

    <div class="fpage-content col-md-6 col-sm-6 col-xs-12">

        <div class="fpage-sec-title title-font">
            <?php echo esc_html( get_theme_mod('raze_fpage_title',__('Featured Section','raze')) ) ?>
        </div>
        <div class="fpage-description">
            <?php echo esc_html( get_theme_mod('raze_fpage_description', __('Enter Description Here', 'raze'))) ?>
        </div>

        <?php for( $i=1; $i<=4; $i++ ) : ?>

		            <?php
                    $pageid = array(get_theme_mod('raze_select_fpage_'.$i));
                    $args = array(
                        'post_type' => 'page',
                        'posts_per_page' => 1,
                        'post__in' => $pageid,
                    );
					        $loop = new WP_Query( $args );
					        while ( $loop->have_posts() ) :

					        	$loop->the_post();
					        ?>
							    	<div class="fg-item">
							    		<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
                                            <div class="fpage-icon col-md-2">
                                                <span class="fa-layers fa-fw" style="background:MistyRose">
                                                    <i class="fas fa-circle" style="color:Tomato"></i>
                                                    <i class="<?php echo get_theme_mod('raze_fpage_icons_'.$i); ?>" data-fa-transform="shrink-6"></i>
                                                </span>
                                                <div class="color"><?php echo get_theme_mod('raze_skins'); ?></div>
                                            </div>
                                            <div class="fpage-title col-md-10">
                                                <h3><?php the_title(); ?></h3>
                                            </div>
							    		</a>
                                    </div>
							 <?php endwhile; ?>
							 <?php wp_reset_query(); ?>

        <?php endfor; ?>
    </div>
    <div class="fpage-thumbnail col-md-6 col-sm-6 col-xs-12">
        <div class="fpage-imh">
            <a href="#">
                <?php if (get_theme_mod('raze_fpage_section_img')!= ''): ?>
                    <img src="<?php echo get_theme_mod('raze_fpage_section_img'); ?>">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>">
                <?php endif; ?>
            </a>
        </div>
    </div>
</div>