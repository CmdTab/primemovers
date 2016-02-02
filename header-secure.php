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
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="//use.typekit.net/tzl1far.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" />
	<script src="<?php bloginfo('template_directory'); ?>/_js/html5shiv.js"></script>
<![endif]-->
</head>

<body <?php body_class('secure'); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="full-section site-header" role="banner">
		<div class="wrap group">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src ="<?php bloginfo('template_directory'); ?>/_i/logo.png"></a>
			</div>
			<a href = "#" class="nav-toggle">
				<span aria-hidden="true" data-icon="&#x4e;"></span>
				<span class="assistive-text">Navigation</span>
			</a>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<ul>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/primemover">Primemovers</a>
					</li>
					<?php //if( $subscription_id == 'Alumni' ) { ?>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni">Alumni</a>
					</li>
					<?php if( $subscription_id == 'Convener' ) { ?>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
					</li>
					<?php }
						if( $subscription_id == 'Facilitator' ) { ?>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator">Facilitator</a>
					</li>
					<li>
						<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
					</li>

					<?php } ?>
					<li>
						<a href = "http://secure.primemoversonline.com/news">News</a>
					</li>
					<li>
						<a href = "https://donate.livingontheedge.org/Default.aspx?p=primemover-donate-page">Donate</a>
					</li>
				</ul>


			</nav><!-- #site-navigation -->
			<div class="user-info">
				<strong>Welcome <?php echo $current_user->user_firstname; ?>!</strong>
				<?php if(current_user_can('publish_pages')): ?>
				<a href = "http://secure.primemoversonline.com/wp-admin">Backend</a>
				<?php endif; ?>
				<a href = "http://primemoversonline.com">Main Site</a>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>/edit-profile">Edit Profile</a>
				<a href="<?php echo wp_logout_url( home_url() ); ?>"><?php _e( 'Logout', 'rcp' ); ?></a>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content group">
