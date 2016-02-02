<?php
/**
 * Template name: Prime Home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Primemovers
 */

while ( have_posts() ) : the_post();
if( rcp_is_paid_content('') ) {
    get_header('secure');
} else {
	get_header();
}
?>

			<div class="full-section sub-page">
				<div class="group">
					<aside class="entry-side third first">
						<img src = "<?php the_field('sidebar_image');?>" class="section-image">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<p><?php the_field('sidebar_quote');?></p>
						<?php wp_nav_menu( array( 'theme_location' => 'prime', 'container_class' => 'sub-navigation' ) ); ?>
					</aside>
					<article class="two-third entry-content group">
						<div class="video">
							<iframe src="//player.vimeo.com/video/79207986?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>
						<p>This is some text about how Primemovers Online works. We did not wear such things in those days. Even the slaves had better  garments. And we were most clean. We washed our faces and hands often  every day. You boys never wash unless you fall into the water or go  swimming.</p>
					</article>
				</div>
			</div>

			<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
