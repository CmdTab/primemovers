<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Primemovers
 */
?>

	</div><!-- #content -->
	<footer class="secure-footer group">
		<nav id="site-navigation" class="footer-navigation" role="navigation">
			<ul>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/dashboard">Dashboard</a>
				</li>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/primemover">Primemovers</a>
				</li>
				<?php if( $subscription_id == 'Alumni' ) { ?>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni">Alumni</a>
				</li>
				<?php } if( $subscription_id == 'Convener' ) { ?>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
				</li>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni">Alumni</a>
				</li>
				<?php }
					if( $subscription_id == 'Facilitator' ) { ?>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator">Facilitator</a>
				</li>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
				</li>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni">Alumni</a>
				</li>
				<?php }
					if( current_user_can( edit_pages ) ) { ?>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/facilitator">Facilitator</a>
				</li>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/convener">Convener</a>
				</li>
				<li>
					<a href = "<?php echo esc_url( home_url( '/' ) ); ?>/alumni">Alumni</a>
				</li>
				<?php } ?>
				<li>
					<a href = "http://primemoversonline.com/contact">Contact</a>
				</li>
				<li>
					<a href = "https://donate.livingontheedge.org/Default.aspx?p=primemover-donate-page">Donate</a>
				</li>
			</ul>
		</nav><!-- #site-navigation -->
		<div class="copyright-bar group">

			<div class="lote"><span>Primemovers is a ministry of</span><a href = "http://livingontheedge.org"><img src = "<?php bloginfo('template_directory'); ?>/_i/LOTE-logo-white.png"></a></div>
			<div class="copyright">&copy; <?php echo date('Y'); ?> Primemovers</div>
		</div>
	</footer>
	<div class="overlay">
		<div class="overlay-container">
			<div class="overlay-content">
				<div class="video">

				</div>
				<a href = "#" id="close">Close</a>
			</div>
		</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_js/functions-min.js"></script>
<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_directory'); ?>/_js/ie.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44567027-1', 'primemoversonline.com');
  ga('send', 'pageview');

</script>
</body>
</html>