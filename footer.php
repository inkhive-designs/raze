<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package raze
 */
?>

	</div><!-- #content -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php printf( __( 'Designed by %1$s.', 'raze' ), '<a href="'.esc_url("https://inkhive.com/").'" rel="nofollow">Inkhive Web Design</a>' ); ?>
			<span class="sep"></span>
			<?php echo ( get_theme_mod('raze_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','raze')) : esc_html( get_theme_mod('raze_footer_text') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->
<script><?php echo get_theme_mod('raze_analytics'); ?></script>


<?php wp_footer(); ?>

</body>
</html>
