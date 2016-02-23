<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Primemovers
 */

get_header(); ?>
			<div class="branded-title">
				<h1>Newsletter</h1>
				<p><?php $month = get_the_category(); echo $month[0]->cat_name; ?></p>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php if ( have_posts() ) : ?>
	<div id="content" class="site-content group">
		<?php if( rcp_is_active() ) : ?>
	<div class="full-section secure-page">
		<div class="group">
			<article class="entry-content group secure-content branded-content">

				<?php /* Start the Loop */ $i = 1; $fullWidth = 0;?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="content-block full">
						<?php if($fullWidth == 0) {$fullWidth ++;} ?>
					<?php elseif (get_field('news_video')): ?>
					<div class="content-block full">
						<?php if($fullWidth == 0) {$fullWidth ++;} ?>
					<?php elseif($fullWidth == 0) : ?>
						<?php if ($i % 2 == 0): ?>
						<div class="content-block odd">
							<?php $fullWidth = 0; ?>
						<?php else : ?>
						<div class="content-block even">
							<?php $fullWidth = 0; ?>
						<?php endif;?>
					<?php elseif($fullWidth == 1) : ?>
						<?php if ($i % 2 == 0): ?>
						<div class="content-block even">
							<?php $fullWidth = 0; ?>
						<?php else : ?>
						<div class="content-block odd">
							<?php $fullWidth = 0; ?>
						<?php endif;?>
					<?php endif; ?>
						<div class="news-article group">
							<header class="news-title">
								<a href = "<?php the_permalink(); ?>" >
									<h3><?php the_title(); ?></h3>
								</a>
							</header>
							<?php
								if ( has_post_thumbnail() ) {
									echo '<div class="thumbnail">';
									the_post_thumbnail();
									echo '</div>';
								} elseif (get_field('news_video')) {
									echo '<div class="thumbnail video">';
									echo get_field('news_video');
									echo '</div>';
								}
							?>
							<div class="entry-content group">
								<?php
									if ( has_excerpt() ):
										the_excerpt();
								?>
								<a href = "<?php the_permalink(); ?>">Read &raquo;</a>
								<?php
									else :
										$ex = get_the_content();
										$count = str_word_count($ex, 0);
										if( $count > 75) :
											echo '<p>';
											echo excerpt(75) . '...';
											echo '</p>';
								?>
								<a href = "<?php the_permalink(); ?>">Read &raquo;</a>
								<?php
									else :
										the_content();
									endif;
									endif;
								?>

							</div>
						</div>
					</div>
					<?php $i++; ?>
				<?php endwhile; ?>
				<?php primemovers_content_nav( 'nav-below' ); ?>
				</article>
				<?php get_sidebar('newsletter'); ?>
			</div><!-- #group -->
			<?php else : ?>
				<div class="full-section login-problem">
					<div class="login-needed">Please use the login form above to see this content.</div>
				</div>
			<?php endif; ?>
		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>


	</div><!-- #secure-page -->

<?php get_footer('secure'); ?>
