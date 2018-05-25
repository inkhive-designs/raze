<?php
/*
 * The Footer Widget Area
 * @package raze
 */
 ?>
 </div><!--.mega-container-->

<?php if (is_home()) :
    get_template_part('hero-bottom');
endif;
?>

 <?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) : ?>
	 <div id="footer-sidebar" class="widget-area">
	 	<div class="container">
		 	<?php 
				if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="footer-column col-md-6 col-sm-6">
                        <div class="site-branding">
                            <?php if ( raze_has_logo() ) : ?>
                                <div id="site-logo">
                                    <?php raze_logo(); ?>
                                </div>
                            <?php else: ?>
                                <div id="text-title-desc">
                                    <h1 class="site-title title-font"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                                </div>
                            <?php endif; ?>
                            <div id="social-icons">
                                <?php get_template_part('social', 'fa'); ?>
                            </div>
                        </div>
						<?php dynamic_sidebar( 'footer-1'); ?> 
					</div> 
				<?php endif;
					
				if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="footer-column col-md-3 col-sm-3">
						<?php dynamic_sidebar( 'footer-2'); ?> 
					</div> 
				<?php endif;
		
				if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="footer-column col-md-3 col-sm-3"> <?php
						dynamic_sidebar( 'footer-3'); ?> 
					</div>
				<?php endif; ?>
				
	 	</div>
	 </div>	<!--#footer-sidebar-->	
<?php endif; ?>