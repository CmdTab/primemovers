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
			<?php wp_nav_menu( array( 'theme_location' => 'about', 'container_class' => 'sub-navigation' ) ); ?>
		</aside><!-- .entry-header -->

		<article class="two-third entry-content group">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'primemovers' ),
					'after'  => '</div>',
				) );
			?>
			<div class="staff-list group">
				<?php
					$args = array( 'post_type' => 'staff', 'posts_per_page' => 10, 'order' => 'ASC' );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
				?>
				<div class="staff-excerpt staff">
					<img src = "<?php the_field('staff_picture'); ?>">
					<div class="staff-content">
						<h3><?php the_title(); ?></h3>
						<h4><?php the_field('staff_title'); ?></h4>
						<?php the_content(); ?>
					</div>
				</div>
				<?php
					endwhile;
					wp_reset_postdata();
				?>
			</div>
		</article><!-- .entry-content -->
	</div>
	<?php edit_post_link( __( 'Edit', 'primemovers' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</div><!-- #post-## -->
