<?php
/**
 * Displays news/events
 *
 * @package Primemovers
 */

?>
	<?php if ($i % 2 == 0): ?>
	<div class="content-block even">
	<?php else : ?>
	<div class="content-block odd">
	<?php endif; ?>
		<div class="news-article">
			<header class="news-title">
				<a href = "<?php the_permalink(); ?>" >
					<h4><?php the_title(); ?></h4>
					<em><?php echo get_the_date(); ?></em>
				</a>
			</header>
			<div class="entry-content group">
				<?php the_excerpt(); ?>
				<a href = "<?php the_permalink(); ?>">Read &raquo;</a>

			</div>
		</div>
	</div>
	<?php $i++; ?>
