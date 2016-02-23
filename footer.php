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

	<footer id="colophon" class="full-section site-footer group" role="contentinfo">
		<div class="footer-nav">
			<ul class="group">
				<li>
					<a href = "/process">Process</a>
				</li>
				<li>
					<a href = "/testimonies">Testimonies</a>
				</li>
				<li>
					<a href = "/about">About</a>
				</li>
				<!--<li>
					<a href = "/news">News</a>
				</li>-->
			</ul>
		</div><!-- footer-nav -->
		<ul class="footer-btns group">
			<li>
				<a href = "/contact">Contact</a>
			</li>
			<!--<li>
				<a href = "#">Login</a>
			</li>-->
		</ul>
	</footer><!-- #colophon -->
	<div class="copyright-bar group">
		<div class="copyright">&copy; <?php echo date('Y'); ?> Primemovers</div>
		<!-- <div class="lote">Primemovers is a ministry of <a href = "http://livingontheedge.org"><img src = "<?php //bloginfo('template_directory'); ?>/_i/lote-logo.png"></a></div> -->
	</div>
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
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_js/plugins-ck.js"></script>
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