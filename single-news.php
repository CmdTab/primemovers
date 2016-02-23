<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Primemovers
 */

get_header(); ?>
			<div class="branded-title">
				<h1>Newsletter</h1>
				<a href = "<?php echo esc_url( home_url( '/' ) ); ?>news" class="view-all">View All News</a>
			</div>
		</div>
	</header><!-- #masthead -->
	<div id="content" class="site-content group">
	<?php if( rcp_is_active() ) : ?>
	<div class="full-section secure-page">
				<div class="group">

					<article class="entry-content group secure-content branded-content">
						<div class="smwrap">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>


			</div>
			</article>

		<?php endwhile; // end of the loop. ?>
			<?php get_sidebar('newsletter'); ?>
		</div><!-- #main -->
	</div><!-- #primary -->
	<?php else : ?>
		<div class="full-section login-problem">
			<div class="login-needed">Please use the login form above to see this content.</div>
		</div>
	<?php endif; ?>
<?php //get_sidebar('news'); ?>
<?php get_footer('secure'); ?>
