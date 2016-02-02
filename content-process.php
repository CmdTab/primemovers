<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Primemovers
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('full-section sub-page'); ?>>
	<div class="group">
		<aside class="entry-side third first">
			<img src = "<?php the_field('sidebar_image');?>" class="section-image">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p><?php the_field('sidebar_quote');?></p>
			<?php wp_nav_menu( array( 'theme_location' => 'process', 'container_class' => 'sub-navigation' ) ); ?>
			<!--<nav class="sub-navigation">
				<ul>
					<li>
						<a href = "#">How it Works</a>
					</li>
					<li>
						<a href = "#">Kickoff Event</a>
					</li>
					<li>
						<a href = "#">Monthly Sessions</a>
					</li>
				</ul>
			</nav>-->
		</aside><!-- .entry-header -->

		<article class="two-third entry-content group">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'primemovers' ),
					'after'  => '</div>',
				) );
			?>
		</article><!-- .entry-content -->
	</div>
	<?php edit_post_link( __( 'Edit', 'primemovers' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</div><!-- #post-## -->
