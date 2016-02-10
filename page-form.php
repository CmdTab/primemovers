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

		if(rcp_is_active()) {
   		get_header('secure');
		} else {
			get_header('login');
		?> 
			<div class="please-login">
				<h1>Login above to view this content.</h1>
			</div>
		<?php }

	?>

				<?php //get_template_part( 'content', 'form' ); ?>

			<?php endwhile; // end of the loop. ?>

<?php //get_sidebar(); ?>
<?php get_footer('form'); ?>
