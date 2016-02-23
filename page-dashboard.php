<?php
/**
 * Template name: Dashboard
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Primemovers
 */
get_header('login');
if( rcp_is_active() ) :
	while ( have_posts() ) : the_post();

?>

			<div class="full-section secure-page">
				<div class="group">

					<article class="entry-content group secure-content dash-content">
						<header class="secure-page-header dash-header">
							<h1><?php the_title(); ?></h1>
							<p><?php the_field('sidebar_quote');?></p>

						</header>
						<?php get_template_part( 'content', 'block' ); ?>
						<?php
							global $current_user, $display_name, $user_email;
							global $user_ID;
							$subscription_id = rcp_get_subscription( $user_ID );
							get_currentuserinfo();
						?>
						<nav class="dashboard-links" role="navigation">
							<h2>Access Resources</h2>
							<ul>
								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/primemover" class="btn">Primemovers</a>
								</li>
								<?php if( $subscription_id == 'Alumni' ) { ?>
								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni" class="btn">Alumni</a>
								</li>
								<?php }
									if( $subscription_id == 'Convener' ) { ?>

								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener" class="btn">Convener</a>
								</li>
								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni" class="btn">Alumni</a>
								</li>
								<?php }
									if( $subscription_id == 'Facilitator' ) { ?>
								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator" class="btn">Facilitator</a>
								</li>
								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener" class="btn">Convener</a>
								</li>
								<li>
									<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni" class="btn">Alumni</a>
								</li>
								<?php } ?>

							</ul>
						</nav>
					</article>
					<?php get_sidebar('news'); ?>
				</div>
			</div>

	<?php endwhile; // end of the loop. ?>
<?php else : ?>
	<div class="full-section login-problem">
		<div class="login-needed">Please use the login form above to see this content.</div>
	</div>
<?php endif; ?>

<?php //get_sidebar(); ?>
<?php get_footer('secure'); ?>
