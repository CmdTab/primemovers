<?php
/**
 * Template name: Prime Content
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Primemovers
 */


if( rcp_is_paid_content('') ) {
    get_header('secure');
} else {
	get_header();
}
if( rcp_user_has_access($user_ID, 1) ) :
    while ( have_posts() ) : the_post();
?>

			<div class="full-section sub-page">
				<div class="group">
					<aside class="entry-side third first">
						<img src = "<?php the_field('sidebar_image');?>" class="section-image">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<p><?php the_field('sidebar_quote');?></p>
						<a href = "#" class="subnav-toggle">Pages in this Section</a>
						<?php wp_nav_menu( array( 'theme_location' => 'prime', 'container_class' => 'sub-navigation' ) ); ?>
					</aside>
					<article class="two-third entry-content group">
						<?php get_template_part( 'content', 'block' ); ?>
					</article>
				</div>
			</div>

	<?php endwhile; // end of the loop. ?>
<?php else : ?>
	<div class="full-section login-problem">
		<div class="login-needed">Please use the login form above to see this content.</div>
	</div>
<?php endif; ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
