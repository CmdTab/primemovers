<?php
/**
 * Template name: About
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

				<?php get_template_part( 'content', 'about' ); ?>

			<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
