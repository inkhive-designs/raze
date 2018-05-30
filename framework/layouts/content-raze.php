<?php
/**
 * @package Raze
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('raze col-md-12 col-sm-12 col-xs-12'); ?>>
		<div class="featured-thumb col-md-4 col-sm-4">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('raze-thumb'); ?>
                </a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                    <img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-sq.jpg"; ?>">
                </a>
			<?php endif; ?>
			<div class="postedon"><?php raze_posted_on_date(); ?></div>
		</div><!--.featured-thumb-->
		
		<div class="out-thumb col-md-8 col-sm-8">
			<header class="entry-header">
                <h1 class="entry-title title-font">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
                <div class="entry-excerpt">
                    <?php echo substr(get_the_excerpt(),0,140).(get_the_excerpt() ? "..." : "" ); ?>
                </div>
                <div class="author">
                        <?php echo get_avatar('ID'); ?>
                    <span class="author-name">
                        <?php the_author();?>
                    </span>

                </div>
                <div class="read-more">
                    <a href="<?php the_permalink(); ?>"><?php _e('Read More', 'raze'); ?></a>
                </div>
            </header><!-- .entry-header -->
		</div>	
</article><!-- #post-## -->
