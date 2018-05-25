    <div id="hero1" class="hero-content">
        <?php if (get_theme_mod('raze_hero1_background_image')): ?>
            <div class="layer"></div>
        <?php endif; ?>
        <div class="container hero-container">
            <?php
            $args = array(
                'post_type' => 'page',
                'posts_per_page' => 1,
                'post__in' => array(get_theme_mod('raze_hero1_selectpage')),
            );

            $loop = new WP_Query( $args );
            while( $loop -> have_posts() ):
                $loop->the_post();

                $class = has_post_thumbnail() ?  'col-md-8 col-sm-8' : 'col-md-12 centered' ; ?>
                <div class="<?php echo $class; ?> h-content">
                    <h1 class="title">
                        <?php the_title(); ?>
                    </h1>
                    <?php if(get_theme_mod('raze_hero1_full_content', true)) : ?>
                        <div class="excerpt">
                            <?php the_content(); ?>
                        </div>
                    <?php else : ?>
                        <div class="excerpt">
                            <?php echo substr(get_the_content(), 0, 250)."..."; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(get_theme_mod('raze_hero1_button') != ''): ?>
                    <div class="button">
                        <a href="<?php the_permalink(); ?>" class="more-button">
                            <?php echo esc_html(get_theme_mod('raze_hero1_button')); ?>
                        </a>
                    </div>
                    <?php endif;?>
                    <div class="razep-bar">
                        <?php for($i=1; $i<=3; $i++): ?>
                            <?php if(get_theme_mod('raze_hero1_loadbar_title'.$i) !='' && get_theme_mod('raze_hero1_loadbar'.$i) != ''): ?>
                            <h3 class="title"><?php echo get_theme_mod('raze_hero1_loadbar_title'.$i); ?></h3>
                            <h3 class="percentage"><?php echo get_theme_mod('raze_hero1_loadbar'.$i); ?>%</h3>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo get_theme_mod('raze_hero1_loadbar'.$i); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo get_theme_mod('raze_hero1_loadbar'.$i); ?>%    "></div>
                            </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>

                </div>
                <?php if (has_post_thumbnail()) : ?>
                <div class="col-md-4 col-sm-4 htop-f-image">
                    <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(); ?>"  alt="<?php the_title(); ?>"></a>
                </div>
            <?php endif; ?>
            <?php
            endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
