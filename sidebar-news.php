<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Primemovers
 */
?>
	<aside class="secure-side news-side">
		<div class="sidebar-intro">
			<p><?php the_field('dash_side'); ?></p>
		</div>
		<div class="secure-nav">
			<?php
				$args = array( 'post_type' => 'news', 'posts_per_page' => 3 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
				$actionType = get_field('action_type');
			?>
				<div class="news-item">
					<h4><?php the_title(); ?></h4>
					<div class="entry-content">
						<?php if ($actionType == 'None') {
							the_content();
						} else {
							the_excerpt();
						} ?>
					</div>
					<?php if ($actionType == 'Read More') { ?>
					<a href = "<?php the_permalink(); ?> " class="btn white">Read More</a>
					<?php } elseif ($actionType == 'Register') { ?>
					<a href = "<?php the_field('register_link');?>" class="btn white">Register</a>
					<?php } ?>
				</div>
			<?php
				endwhile;
				wp_reset_postdata();
			?>
			<a href = "<?php echo esc_url( home_url( '/' ) ); ?>news" class="all-news">View This Month's News</a>
		</div>
	</aside>
