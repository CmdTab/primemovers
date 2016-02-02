<?php
/**
 * @package Primemovers
 */
?>
<div class="full-section sub-page">
	<div class="group">
		<aside class="entry-side third first">
			<img src = "<?php the_field('staff_title'); ?>" class="section-image">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p><?php the_field('staff_title');?></p>
			<div class="sub-navigation">
				<a href = "/leadership" class="back">Back to Leadership</a>
			</div>
		</aside><!-- .entry-header -->
		<article id="post-<?php the_ID(); ?>" <?php post_class('two-third'); ?>>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php primemovers_content_nav( 'nav-below' ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div>
</div>
