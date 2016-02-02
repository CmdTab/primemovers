<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Primemovers
 */
?>
	<aside class="secure-side branded-side">
		<div class="sidebar-intro">
			<p>Primemovers Newsletter Archives</p>
		</div>
		<div class="secure-nav">
			<div class="secure-menu">
				<ul class="menu">
				<?php
					wp_list_categories('orderby=ID&order=DESC&title_li=&taxonomy=month');
				?>
				</ul>
			</div>
		</div>
	</aside>
