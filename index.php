<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package raze
 */

get_header(); ?>

	<div id="primary" class="content-areas <?php do_action('raze_primary-width') ?>">

		<?php if ( is_home() ) : ?>
			<div class="section-title"><span><?php echo get_theme_mod('raze_blog_title',__('Latest Blog Posts','raze')); ?></span></div> <?php
		endif; ?>
		<main id="main" class="site-main <?php do_action('raze_main-class') ?>" role="main">
		
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 */
					do_action('raze_blog_layout'); 
					
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		
		<?php if ( have_posts() ) { raze_pagination(); } ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
