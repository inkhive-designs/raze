<?php
/*
** Template to Render Social Icons on Top Bar
*/

for ($i = 1; $i < 13; $i++) : 
	$social = get_theme_mod('raze_social_'.$i);
	if ( ($social != 'none') && ($social != '') ) : ?>
	<a href="<?php echo esc_url( get_theme_mod('raze_social_url'.$i) ); ?>"><i class="fab fa-fw fa-<?php echo $social; ?>"></i></a>
	<?php endif;

endfor; ?>