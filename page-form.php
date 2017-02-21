<?php
/**
 * Template name: Form
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Primemovers
 */

	while ( have_posts() ) : the_post();

		if(rcp_user_has_access($user_ID, 1)) {
   		get_header('secure');
		} else {
			get_header('form');
		?>

		<?php }

	?>

				<?php get_template_part( 'content', 'form' ); ?>

			<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer('form'); ?>
