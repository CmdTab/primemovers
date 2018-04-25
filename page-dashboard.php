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
if( rcp_user_has_access($user_ID, 1) ) :
	while ( have_posts() ) : the_post();

?>

			<div class="full-section secure-page">
				<div class="group">

					<article class="entry-content group secure-content dash-content">
						<header class="secure-page-header dash-header">
							<h1>WELCOME TO PRIMEMOVERS ONLINE</h1>
							<p><?php the_field('sidebar_quote');?></p>
						</header>
						<?php
							global $current_user, $display_name, $user_email;
							global $user_ID;
							$subscription_id = rcp_get_subscription( $user_ID );
							get_currentuserinfo();
						?>
						<div class="content-block full dashboard-intro">
							<div class="sm-wrap">
								<?php if( $subscription_id == 'Ministry Partners' || current_user_can( 'manage_options' ) || $subscription_id == 'Facilitator' ) : ?>
									<?php if(current_user_can( 'manage_options' ) || $subscription_id == 'Facilitator' ) : ?>
										<h5 class="admin-note">This is the welcome note that Ministry Partners see</h5>
									<?php endif; ?>
									<?php the_field('ministry_partner_welcome'); ?>
									<?php
										$video = get_field('mp_welcome_video');
										if($video) :
									?>
									<div class="intro-video">
										<div class="video">
											<?php echo $video; ?>
										</div>
										<!--<a href = "#" class="btn action-required" data-type="video" data-code="<?php echo $video; ?>">Video from Chip</a>-->
									</div>
									<?php endif; ?>
								<?php else : ?>
									<?php the_field('general_welcome'); ?>
								<?php endif; ?>
								<?php if(current_user_can( 'manage_options' ) || $subscription_id == 'Facilitator' ) : ?>
									<h5 class="admin-note">This is the welcome note that general Primemovers see</h5>
									<?php the_field('general_welcome'); ?>
								<?php endif; ?>
							</div>

						</div>
						<?php //get_template_part( 'content', 'block' ); ?>
						<div class="content-block full next-steps group">
							<img src = "<?php bloginfo('template_directory'); ?>/_i/clipboard.png">
							<nav class="dashboard-links" role="navigation">
								<h3>What's Next</h3>
								<ul>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/primemover"><svg class="icon icon-arrow-circle-right"><use xlink:href="#icon-arrow-circle-right"></use></svg>Access Resources</a>
									</li>
									<?php if( $subscription_id != 'Unleashed' ) : ?>
									<li>
										<a href = "http://secure.primemoversonline.com/news"><svg class="icon icon-newspaper-o"><use xlink:href="#icon-newspaper-o"></use></svg>Latest News</a>
									</li>
									<?php endif; ?>
									<li>
										<a href="<?php  echo esc_url( home_url( '/' ) ); ?>/edit-profile"><svg class="icon icon-address-card-o"><use xlink:href="#icon-address-card-o"></use></svg>Edit Profile</a>
									</li>
									<?php if( $subscription_id != 'Unleashed' ) : ?>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni"><svg class="icon icon-graduation-cap"><use xlink:href="#icon-graduation-cap"></use></svg>Alumni</a>
									</li>
									<?php endif; ?>
									<?php
										if( $subscription_id == 'Convener' ) { ?>

									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener"><svg class="icon icon-group"><use xlink:href="#icon-group"></use></svg>Convener</a>
									</li>
									<?php }
										if( $subscription_id == 'Facilitator' ) { ?>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator"><svg class="icon icon-briefcase"><use xlink:href="#icon-briefcase"></use></svg>Facilitator</a>
									</li>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener"><svg class="icon icon-group"><use xlink:href="#icon-group"></use></svg>Convener</a>
									</li>
									<?php } ?>

								</ul>
							</nav>
						</div>
					</article>
					<?php if( $subscription_id == 'Unleashed' ) :?>

							<aside class="secure-side">
								<div class="secure-nav">
									<?php wp_nav_menu( array( 'theme_location' => 'prime', 'container_class' => 'secure-menu' ) ); ?>
									<h4>Sessions</h4>
									<?php wp_nav_menu( array( 'theme_location' => 'sessions', 'container_class' => 'secure-menu sessions' ) ); ?>
								</div>
							</aside>
						<?php
							else :
								get_sidebar('news');
							endif;
						?>
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
