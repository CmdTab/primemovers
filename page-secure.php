<?php
	/**
	 * Template name: Secure Page
	 *
	 * This is the template that displays all pages by default.
	 * Please note that this is the WordPress construct of pages
	 * and that other 'pages' on your WordPress site will use a
	 * different template.
	 *
	 * @package Primemovers
	 */
    get_header('secure');
    if( rcp_is_active() ) :
    	while ( have_posts() ) : the_post();
?>

			<div class="full-section secure-page">
				<div class="group">
					<?php get_sidebar(); ?>
					<article class="entry-content group secure-content">
						<header class="secure-page-header">
							<h1><?php the_title(); ?></h1>
							<p><?php the_field('sidebar_quote');?></p>
						</header>
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
<?php get_footer('secure'); ?>
