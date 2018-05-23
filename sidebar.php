<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package raze
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( raze_load_sidebar() ) : ?>
    <div id="secondary" class="widget-area <?php do_action('raze_secondary-width'); ?>" role="complementary">
        <div class="section-title"><span><?php echo get_theme_mod('raze_sidebar_title',__('More Info','raze')); ?></span></div>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
