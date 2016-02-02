<?php
/**
 * @package Primemovers
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="news-title">
		<h2 class="entry-title"><?php the_title(); ?></h2>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} elseif (get_field('news_video')) {
				echo '<div class="video">';
				echo get_field('news_video');
				echo '</div>';
			}
		?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'primemovers' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</div><!-- #post-## -->
