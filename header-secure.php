<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Primemovers
 */
global $current_user, $display_name, $user_email;
global $user_ID;
$subscription_id = rcp_get_subscription( $user_ID );
get_currentuserinfo();
$pagegender = get_user_meta( get_current_user_id(), 'rcp_gender', true );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon"
      type="image/png"
      href="<?php bloginfo('template_directory'); ?>/_i/favicon.png">
<?php wp_head(); ?>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="//use.typekit.net/tzl1far.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" />
	<script src="<?php bloginfo('template_directory'); ?>/_js/html5shiv.js"></script>
<![endif]-->
</head>

<body <?php body_class('secure'); ?>>

<svg style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
	<defs>
		<symbol id="icon-sort" viewBox="0 0 585 1024">
			<title>sort</title>
			<path class="path1" d="M585.143 621.714q0 14.857-10.857 25.714l-256 256q-10.857 10.857-25.714 10.857t-25.714-10.857l-256-256q-10.857-10.857-10.857-25.714t10.857-25.714 25.714-10.857h512q14.857 0 25.714 10.857t10.857 25.714zM585.143 402.286q0 14.857-10.857 25.714t-25.714 10.857h-512q-14.857 0-25.714-10.857t-10.857-25.714 10.857-25.714l256-256q10.857-10.857 25.714-10.857t25.714 10.857l256 256q10.857 10.857 10.857 25.714z"></path>
		</symbol>
		<symbol id="icon-sort-desc" viewBox="0 0 585 1024">
			<title>sort-desc</title>
			<path class="path1" d="M585.143 621.714q0 14.857-10.857 25.714l-256 256q-10.857 10.857-25.714 10.857t-25.714-10.857l-256-256q-10.857-10.857-10.857-25.714t10.857-25.714 25.714-10.857h512q14.857 0 25.714 10.857t10.857 25.714z"></path>
		</symbol>
		<symbol id="icon-sort-asc" viewBox="0 0 585 1024">
			<title>sort-asc</title>
			<path class="path1" d="M585.143 402.286q0 14.857-10.857 25.714t-25.714 10.857h-512q-14.857 0-25.714-10.857t-10.857-25.714 10.857-25.714l256-256q10.857-10.857 25.714-10.857t25.714 10.857l256 256q10.857 10.857 10.857 25.714z"></path>
		</symbol>
	</defs>
</svg>
<div id="page" class="hfeed site <?php echo $pagegender;?>">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="full-section site-header" role="banner">
		<div class="wrap group">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src ="<?php bloginfo('template_directory'); ?>/_i/logo.png"></a>
			</div>
			<a href = "#" class="nav-toggle login-toggle">
				<span aria-hidden="true" data-icon="&#x4e;"></span>
				<span class="assistive-text">Navigation</span>
			</a>

			<?php if(rcp_user_has_access($user_ID, 1)) : ?>
			   <nav id="site-navigation" class="main-navigation" role="navigation">
				<ul>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/primemover">Primemovers</a>
					</li>
                    <?php if( $subscription_id != 'Unleashed' ) : ?>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni">Alumni</a>
					</li>
                    <?php endif; ?>
					<?php if( $subscription_id == 'Convener' ) : ?>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
					</li>
					<?php endif;
						if( $subscription_id == 'Facilitator' ) : ?>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator">Facilitator</a>
					</li>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
					</li>

					<?php endif; ?>
                    <?php if( $subscription_id != 'Unleashed' ) : ?>
					<li>
						<a href = "http://secure.primemoversonline.com/news">News</a>
					</li>

					<li>
						<a href = "https://store.livingontheedge.org/primemovers-donation/">Donate</a>
					</li>
                    <?php endif; ?>
				</ul>

			</nav><!-- #site-navigation -->

			<div class="user-info">
				<strong>Welcome <?php  echo $current_user->user_firstname; ?>!</strong>
				<?php  if(current_user_can('publish_pages')): ?>
				<a href = "http://secure.primemoversonline.com/wp-admin">Backend</a>
				<?php  endif; ?>
				<a href = "http://primemoversonline.com">Main Site</a>
				<a href="<?php  echo esc_url( home_url( '/' ) ); ?>/edit-profile">Edit Profile</a>
				<a href="<?php  echo wp_logout_url( home_url() ); ?>"><?php _e( 'Logout', 'rcp' ); ?></a>
			</div>

			<?php else : ?>
				<div class="header-login">
					<?php echo do_shortcode('[login_form]'); ?>
				</div>
			<?php endif;?>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content group">
