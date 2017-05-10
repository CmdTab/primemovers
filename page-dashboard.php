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
						<div class="content-block full dashboard-intro">
							<div class="sm-wrap">
								<p>Welcome to the Primemovers secure website which features resource sections just for Primemovers, Alumni, Conveners and Facilitators.</p><p><strong>Primemovers</strong> can now access all the Primemovers teaching content, both audio and video, teaching notes from Chip Ingram and Living on the Edge Ministries, as well as additional resources to enhance their Primemovers experience. The content is organized by Session in a user-friendly format. This is an ideal platform for Primemovers who want to access the material online, on-the-go or who want to go deeper with the content.</p><p>The <strong>Alumni</strong> section features news and events of Alumni gatherings as well as a section to connect with fellow Primemovers and learn about their Holy Ambitions. <strong>Conveners</strong> and <strong>Facilitators</strong> will each find all the information and resources they need to launch and lead new groups of Primemovers.</p>
								<div class="intro-video">
									<a href = "#" class="btn action-required" data-type="video" data-code="209497584">Video from Chip</a>
								</div>
							</div>

						</div>
						<?php //get_template_part( 'content', 'block' ); ?>
						<?php
							global $current_user, $display_name, $user_email;
							global $user_ID;
							$subscription_id = rcp_get_subscription( $user_ID );
							get_currentuserinfo();
						?>
						<div class="content-block full next-steps group">
							<img src = "<?php bloginfo('template_directory'); ?>/_i/clipboard.png">
							<nav class="dashboard-links" role="navigation">
								<h3>What's Next</h3>
								<ul>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/primemover"><svg class="icon icon-arrow-circle-right"><use xlink:href="#icon-arrow-circle-right"></use></svg>Access Resources</a>
									</li>
									<li>
										<a href = "http://secure.primemoversonline.com/news"><svg class="icon icon-newspaper-o"><use xlink:href="#icon-newspaper-o"></use></svg>Latest News</a>
									</li>
									<li>
										<a href="<?php  echo esc_url( home_url( '/' ) ); ?>/edit-profile"><svg class="icon icon-address-card-o"><use xlink:href="#icon-address-card-o"></use></svg>Edit Profile</a>
									</li>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni"><svg class="icon icon-graduation-cap"><use xlink:href="#icon-graduation-cap"></use></svg>Alumni</a>
									</li>
									<?php
										if( $subscription_id == 'Convener' ) { ?>

									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener"><svg class="icon icon-group"><use xlink:href="#icon-group"></use></svg>Convener</a>
									</li>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni"><svg class="icon icon-graduation-cap"><use xlink:href="#icon-graduation-cap"></use></svg>Alumni</a>
									</li>
									<?php }
										if( $subscription_id == 'Facilitator' ) { ?>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator"><svg class="icon icon-briefcase"><use xlink:href="#icon-briefcase"></use></svg>Facilitator</a>
									</li>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener"><svg class="icon icon-group"><use xlink:href="#icon-group"></use></svg>Convener</a>
									</li>
									<li>
										<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni"><svg class="icon icon-graduation-cap"><use xlink:href="#icon-graduation-cap"></use></svg>Alumni</a>
									</li>
									<?php } ?>

								</ul>
							</nav>
						</div>
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
