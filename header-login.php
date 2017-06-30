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
<link rel="icon"
      type="image/png"
      href="<?php bloginfo('template_directory'); ?>/_i/favicon.png">
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
		<symbol id="icon-arrow-circle-right" viewBox="0 0 24 28">
			<title>arrow-circle-right</title>
			<path d="M20.078 14c0-0.266-0.094-0.516-0.281-0.703l-7.078-7.078c-0.187-0.187-0.438-0.281-0.703-0.281s-0.516 0.094-0.703 0.281l-1.422 1.422c-0.187 0.187-0.281 0.438-0.281 0.703s0.094 0.516 0.281 0.703l2.953 2.953h-7.844c-0.547 0-1 0.453-1 1v2c0 0.547 0.453 1 1 1h7.844l-2.953 2.953c-0.187 0.187-0.297 0.438-0.297 0.703s0.109 0.516 0.297 0.703l1.422 1.422c0.187 0.187 0.438 0.281 0.703 0.281s0.516-0.094 0.703-0.281l7.078-7.078c0.187-0.187 0.281-0.438 0.281-0.703zM24 14c0 6.625-5.375 12-12 12s-12-5.375-12-12 5.375-12 12-12 12 5.375 12 12z"></path>
		</symbol>
		<symbol id="icon-briefcase" viewBox="0 0 28 28">
			<title>briefcase</title>
			<path d="M10 4h8v-2h-8v2zM28 14v7.5c0 1.375-1.125 2.5-2.5 2.5h-23c-1.375 0-2.5-1.125-2.5-2.5v-7.5h10.5v2.5c0 0.547 0.453 1 1 1h5c0.547 0 1-0.453 1-1v-2.5h10.5zM16 14v2h-4v-2h4zM28 6.5v6h-28v-6c0-1.375 1.125-2.5 2.5-2.5h5.5v-2.5c0-0.828 0.672-1.5 1.5-1.5h9c0.828 0 1.5 0.672 1.5 1.5v2.5h5.5c1.375 0 2.5 1.125 2.5 2.5z"></path>
		</symbol>
		<symbol id="icon-group" viewBox="0 0 30 28">
			<title>group</title>
			<path d="M9.266 14c-1.625 0.047-3.094 0.75-4.141 2h-2.094c-1.563 0-3.031-0.75-3.031-2.484 0-1.266-0.047-5.516 1.937-5.516 0.328 0 1.953 1.328 4.062 1.328 0.719 0 1.406-0.125 2.078-0.359-0.047 0.344-0.078 0.688-0.078 1.031 0 1.422 0.453 2.828 1.266 4zM26 23.953c0 2.531-1.672 4.047-4.172 4.047h-13.656c-2.5 0-4.172-1.516-4.172-4.047 0-3.531 0.828-8.953 5.406-8.953 0.531 0 2.469 2.172 5.594 2.172s5.063-2.172 5.594-2.172c4.578 0 5.406 5.422 5.406 8.953zM10 4c0 2.203-1.797 4-4 4s-4-1.797-4-4 1.797-4 4-4 4 1.797 4 4zM21 10c0 3.313-2.688 6-6 6s-6-2.688-6-6 2.688-6 6-6 6 2.688 6 6zM30 13.516c0 1.734-1.469 2.484-3.031 2.484h-2.094c-1.047-1.25-2.516-1.953-4.141-2 0.812-1.172 1.266-2.578 1.266-4 0-0.344-0.031-0.688-0.078-1.031 0.672 0.234 1.359 0.359 2.078 0.359 2.109 0 3.734-1.328 4.062-1.328 1.984 0 1.937 4.25 1.937 5.516zM28 4c0 2.203-1.797 4-4 4s-4-1.797-4-4 1.797-4 4-4 4 1.797 4 4z"></path>
		</symbol>
		<symbol id="icon-newspaper-o" viewBox="0 0 32 28">
			<title>newspaper-o</title>
			<path d="M16 8h-6v6h6v-6zM18 18v2h-10v-2h10zM18 6v10h-10v-10h10zM28 18v2h-8v-2h8zM28 14v2h-8v-2h8zM28 10v2h-8v-2h8zM28 6v2h-8v-2h8zM4 21v-15h-2v15c0 0.547 0.453 1 1 1s1-0.453 1-1zM30 21v-17h-24v17c0 0.344-0.063 0.688-0.172 1h23.172c0.547 0 1-0.453 1-1zM32 2v19c0 1.656-1.344 3-3 3h-26c-1.656 0-3-1.344-3-3v-17h4v-2h28z"></path>
		</symbol>
		<symbol id="icon-address-card-o" viewBox="0 0 32 28">
			<title>address-card-o</title>
			<path d="M16 17.672c0 1.359-0.891 2.328-2 2.328h-8c-1.109 0-2-0.969-2-2.328 0-2.422 0.594-5.109 3.062-5.109 0.766 0.438 1.797 1.188 2.938 1.188s2.172-0.75 2.938-1.188c2.469 0 3.062 2.688 3.062 5.109zM13.547 9.547c0 1.969-1.594 3.547-3.547 3.547s-3.547-1.578-3.547-3.547c0-1.953 1.594-3.547 3.547-3.547s3.547 1.594 3.547 3.547zM28 16.5v1c0 0.281-0.219 0.5-0.5 0.5h-9c-0.281 0-0.5-0.219-0.5-0.5v-1c0-0.281 0.219-0.5 0.5-0.5h9c0.281 0 0.5 0.219 0.5 0.5zM28 12.563v0.875c0 0.313-0.25 0.562-0.562 0.562h-8.875c-0.313 0-0.562-0.25-0.562-0.562v-0.875c0-0.313 0.25-0.562 0.562-0.562h8.875c0.313 0 0.562 0.25 0.562 0.562zM28 8.5v1c0 0.281-0.219 0.5-0.5 0.5h-9c-0.281 0-0.5-0.219-0.5-0.5v-1c0-0.281 0.219-0.5 0.5-0.5h9c0.281 0 0.5 0.219 0.5 0.5zM30 23.5v-19c0-0.266-0.234-0.5-0.5-0.5h-27c-0.266 0-0.5 0.234-0.5 0.5v19c0 0.266 0.234 0.5 0.5 0.5h5.5v-1.5c0-0.281 0.219-0.5 0.5-0.5h1c0.281 0 0.5 0.219 0.5 0.5v1.5h12v-1.5c0-0.281 0.219-0.5 0.5-0.5h1c0.281 0 0.5 0.219 0.5 0.5v1.5h5.5c0.266 0 0.5-0.234 0.5-0.5zM32 4.5v19c0 1.375-1.125 2.5-2.5 2.5h-27c-1.375 0-2.5-1.125-2.5-2.5v-19c0-1.375 1.125-2.5 2.5-2.5h27c1.375 0 2.5 1.125 2.5 2.5z"></path>
		</symbol>
		<symbol id="icon-graduation-cap" viewBox="0 0 36 28">
			<title>graduation-cap</title>
			<path d="M27.719 13.062l0.281 4.937c0.125 2.203-4.484 4-10 4s-10.125-1.797-10-4l0.281-4.937 8.969 2.828c0.25 0.078 0.5 0.109 0.75 0.109s0.5-0.031 0.75-0.109zM36 8c0 0.219-0.141 0.406-0.344 0.484l-17.5 5.5c-0.063 0.016-0.109 0.016-0.156 0.016s-0.094 0-0.156-0.016l-10.187-3.219c-0.891 0.703-1.516 2.422-1.641 4.531 0.594 0.344 0.984 0.969 0.984 1.703 0 0.703-0.359 1.313-0.906 1.672l0.906 6.766c0.016 0.141-0.031 0.281-0.125 0.391s-0.234 0.172-0.375 0.172h-3c-0.141 0-0.281-0.063-0.375-0.172s-0.141-0.25-0.125-0.391l0.906-6.766c-0.547-0.359-0.906-0.969-0.906-1.672 0-0.75 0.422-1.391 1.016-1.734 0.094-1.828 0.562-3.797 1.531-5.156l-5.203-1.625c-0.203-0.078-0.344-0.266-0.344-0.484s0.141-0.406 0.344-0.484l17.5-5.5c0.063-0.016 0.109-0.016 0.156-0.016s0.094 0 0.156 0.016l17.5 5.5c0.203 0.078 0.344 0.266 0.344 0.484z"></path>
		</symbol>
	</defs>
</svg>
<div id="page" class="hfeed site">
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
					<?php endif; ?>
					<li>
						<a href = "https://store.livingontheedge.org/primemovers-donation/">Donate</a>
					</li>
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
