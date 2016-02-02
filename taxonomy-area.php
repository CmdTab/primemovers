<?php
/**
 * The template for displaying Ambition Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Primemovers
 */

get_header('secure'); ?>

			<div class="full-section secure-page">
				<div class="group">
					<article class="entry-content group secure-content dash-content">
						<header class="secure-page-header dash-header">
							<h1>Holy Ambition</h1>
							<?php if ( have_posts() ) : ?>
							<p><?php single_cat_title(); ?></p>
							<a href = "<?php echo esc_url( home_url( '/' ) ); ?>holy-ambitions" class="view-all">View All</a>
						</header>
						<div class="ambition-list group">
			<?php /* Start the Loop */ $i = 1;?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class='single-ambition <?php if ($i % 2 == 0){echo "even";} else {echo "odd";}?>'>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'ambition' );
					echo '</div>';
					$i++;
				?>
			<?php endwhile; ?>
					</div>
			<?php primemovers_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>
			</article>
			<?php get_sidebar('news'); ?>
		</div><!-- #main -->
	</div><!-- #primary -->


<?php get_footer('secure'); ?>
