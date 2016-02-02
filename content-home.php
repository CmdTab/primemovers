<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Primemovers
 */
?>
	<div class="full-section hero">
		<div class="hero-content">
			<h1>Unleashing Spiritual Entrepreneurs<span>For Kingdom Venture</span></h1>
			<p>Primemovers is committed to helping high-capacity leaders recognize and then respond to their God-prepared purpose in life.</p>
			<a href = "/contact" class="btn white">Contact Us</a>
			<a href = "#" class="btn gray" id="watch">Watch Video</a>
		</div>
	</div>
	<div class="full-section overview">
		<div class="smwrap what-is">
			<h2>What is Prime<strong><em>movers</em></strong>?</h1>
			<p>Primemovers is a six-month, facilitated discovery process for spiritual entrepreneurs. It is designed to reveal God's unique dream for your life with fresh vision and clarity. The process combines directed personal study with monthly group sessions with peers who will encourage, challenge, and ultimately help equip you to live out the call of God on your life.</p>
		</div>
		<ul class="three-list overview-list group">
			<li>
				<a href = "/process" class="overview-icon">
					<img src = "<?php bloginfo('template_directory'); ?>/_i/process.png">
				</a>
				<a href = "/process"><h3>A Unique Process</h3></a>
				<p>The Primemovers' process helps high-capacity leaders discover and then launch into their destiny.</p>
			</li>
			<li>
				<a href = "/about" class="overview-icon">
					<img src = "<?php bloginfo('template_directory'); ?>/_i/world.png">
				</a>
				<a href = "/about"><h3>The Right People</h3></a>
				<p>Created when Chip Ingram and Rick Linamen, after three decades of ministry, came together around a dream.</p>
			</li>
			<li>
				<a href = "/testimonies" class="overview-icon">
					<img src = "<?php bloginfo('template_directory'); ?>/_i/graph.png">
				</a>
				<a href = "/testimonies"><h3>Life Changing Results</h3></a>
				<p>Each Primemover realizes the God-sized dreams that they have been uniquely prepared to respond to.</p>
			</li>
		</ul>
	</div>
	<div class="full-section quotes">
		<div class="group">
			<div class="half first">
				<p>"We are looking for high-impact players who really want to make a difference in their world...and the world."</p>
				<div class="quote-attr group">
					<img src = "http://primemoversonline.com/wp-content/uploads/2012/08/Chip-150x150.jpg">
					<strong>Chip Ingram</strong>
					<em>Co-Founder, Primemovers</em>
					<em>CEO, Living on the Edge</em>
				</div>
			</div>
			<div class="half">
				<div class="quote-attr group">
					<img src = "http://primemoversonline.com/wp-content/uploads/2012/08/Rick-150x150.jpg">
					<strong>Rick Linamen</strong>
					<em>President & Co-Founder, Primemovers</em>
				</div>
				<p>" God has carefully prepared you to respond to a significant need in the world for Kingdom impact."</p>
			</div>
		</div>
	</div>

<!--<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			/*wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'primemovers' ),
				'after'  => '</div>',
			) );*/
		?>
	</div>
	<?php //edit_post_link( __( 'Edit', 'primemovers' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
