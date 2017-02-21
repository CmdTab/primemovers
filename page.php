<?php
/**
 * The template for displaying all pages.
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

				<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>
<?php else : ?>
	<div class="full-section login-problem">
		<div class="login-needed">Please use the login form above to see this content.</div>
	</div>
<?php endif; ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
