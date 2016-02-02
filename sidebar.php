<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Primemovers
 */
	$sidebarOption = get_field('choose_sidebar');
?>
	<aside class="secure-side">
		<?php
			if($sidebarOption == 'prime') {
		?>
		<!--<div class="sidebar-intro">
			<p>View the content for the Primemovers course below.</p>
		</div>-->
		<div class="secure-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'prime', 'container_class' => 'secure-menu' ) ); ?>
			<h4>Sessions</h4>
			<?php wp_nav_menu( array( 'theme_location' => 'sessions', 'container_class' => 'secure-menu sessions' ) ); ?>
		</div>
		<?php
			} elseif($sidebarOption == 'convener') {
		?>
		<div class="sidebar-intro">
			<p>View the content to help you as a Convener below.</p>
		</div>
		<div class="secure-nav">
				<?php wp_nav_menu( array( 'theme_location' => 'convener', 'container_class' => 'secure-menu' ) );
			?>
		</div>
		<?php
			} elseif($sidebarOption == 'facilitator') {
		?>
		<div class="sidebar-intro">
			<p>View the content to help you as a Facilitator.</p>
		</div>
		<div class="secure-nav">
				<?php wp_nav_menu( array( 'theme_location' => 'facilitator', 'container_class' => 'secure-menu' ) );
				?>
		</div>
		<?php } ?>
	</aside>
