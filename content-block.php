<?php

/*  Loop through Flexible Content field  */
$i = 1;
$fullVideo = 0;
$gender = get_user_meta( get_current_user_id(), 'rcp_gender', true );
while(has_sub_field("content_block")): ?>

	<?php
		if(get_row_layout() == "full_width_top_section"):
			$fullVideo++;
	?>
		<div class="content-block full-block">
			<div class="sm-wrap"><?php the_sub_field('top_section_content'); ?></div>
			<?php if( have_rows('top_video_list') ): ?>
			<ul class="two-list video-list group">
				<?php
					while ( have_rows('top_video_list') ) : the_row();
						$vidAudience = get_sub_field('top_audience');
						if($vidAudience == $gender || $vidAudience == 'both' || $subscription_id == 'Facilitator' || empty($vidAudience) ) :
							$video = get_sub_field('top_vimeo');
							$image = get_sub_field('top_thumb');
							/*$videoContents = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video.php"));
							$vidImg = $videoContents[0]['thumbnail_large'];*/
				?>
					<li>
						<a href = "#" class="content-title action-required" data-type="video" data-code="<?php echo $video; ?>">

							<div class="img-container">
								<span aria-hidden="true" data-icon="&#x76;"></span>
								<?php if( !empty($image) ): ?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<?php the_sub_field('top_video_title'); ?>
						</a>
					</li>
				<?php endif; endwhile; ?>
			</ul>
			<?php endif; ?>
		</div>
		<?php
		elseif(get_row_layout() == "video_content"): // layout: Content
			if($i == 1) {
				$fullVideo++;
		?>
		<div class="content-block full-video">
		<?php
			} elseif($fullVideo > 0) {
				if ($i % 2 == 0){
		?>
		<div class="content-block odd">
		<?php 	} else { ?>
		<div class="content-block even">
		<?php 	}
			} else {
				if($i == 1) { ?>
		<div class="content-block odd">
		<?php 	} elseif ($i % 2 == 0){ ?>
		<div class="content-block even">
		<?php 	} else { ?>
		<div class="content-block odd">
		<?php 	} } ?>
			<h3 class="block-title"><?php the_sub_field("video_title"); ?></h3>
			<div class="video-box">
				<iframe src="//player.vimeo.com/video/<?php the_sub_field("video_code"); ?>?title=0&amp;byline=0&amp;portrait=0" width="500" height="288" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
		</div>

	<?php elseif(get_row_layout() == "text_content"): // layout: File ?>

		<?php
			if($fullVideo > 0) {
				if ($i % 2 == 0){
		?>
		<div class="content-block odd">
		<?php 	} else { ?>
		<div class="content-block even">
		<?php 	}
			} else {
				if($i == 1) { ?>
		<div class="content-block odd">
		<?php 	} elseif ($i % 2 == 0){ ?>
		<div class="content-block even">
		<?php 	} else { ?>
		<div class="content-block odd">
		<?php 	} } ?>
			<h3 class="block-title"><?php the_sub_field("text_title"); ?></h3>
			<div class="text-content">
				<?php the_sub_field("text_html"); ?>
			</div>
		</div>

	<?php elseif(get_row_layout() == "list_content"): // layout: Featured Posts
			if($fullVideo > 0) {
				if ($i % 2 == 0){
		?>
		<div class="content-block odd">
		<?php 	} else { ?>
		<div class="content-block even">
		<?php 	}
			} else {
				if($i == 1) { ?>
		<div class="content-block odd">
		<?php 	} elseif ($i % 2 == 0){ ?>
		<div class="content-block even">
		<?php 	} else { ?>
		<div class="content-block odd">
		<?php 	} } ?>
			<h3 class="block-title"><?php the_sub_field("list_title"); ?></h3>
			<?php

				$rows = get_sub_field('content_item');
				if($rows) {
					echo '<ul class="content-list">';

					foreach($rows as $row) {
						$audience = $row['item_audience'];
						global $user_ID;
						$subscription_id = rcp_get_subscription( $user_ID );
						if($audience == $gender || $audience == 'both' || $subscription_id == 'Facilitator' || empty($audience) ) {
							echo '<li>';
							$itemType = $row['item_type'];
							if ($itemType == 'Video') {
								echo '<a href = "#" class="content-title action-required" data-type="video" data-code="'. $row['item_url'] . '">';
								echo '<span aria-hidden="true" data-icon="&#x76;"></span>';
							} elseif ($itemType == 'Audio') {
								echo '<a href = "#" class="content-title action-required" data-type="audio" data-code="'. $row['item_url'] . '">';
								echo '<span aria-hidden="true" data-icon="&#x61;"></span>';
							} elseif ($itemType == 'Document') {
								echo '<a href = "' .$row['item_url'] . '" class="content-title" data-type="document">';
								echo '<span aria-hidden="true" data-icon="&#x6e;"></span>';
							} elseif ($itemType == 'URL') {
								echo '<a href = "' .$row['item_url'] . '" class="content-title" data-type="url" target="_blank">';
								echo '<span aria-hidden="true" data-icon="&#x77;"></span>';
							}
							echo '<h4>' . $row['item_title'] . '</h4>';
							echo '<span class="subtitle">' . $row['item_subtitle'] . '</span>';
							echo '</a>';
							echo '<div class="content-action">';

							if ($itemType == 'Video') {
								echo '<a href = "#" class="btn action-required" data-type="video" data-code="'. $row['item_url'] . '">Watch</a>';
							} elseif ($itemType == 'Audio') {
								echo '<a href = "#" class="btn action-required" data-type="audio" data-code="'. $row['item_url'] . '">Listen</a>';
								echo '<a href = "'. $row['item_url'] . '" class="btn">Download</a>';
							} elseif ($itemType == 'Document') {
								echo '<a href = "'. $row['item_url'] . '" class="btn">Download</a>';
							} elseif ($itemType == 'URL') {
								echo '<a href = "'. $row['item_url'] . '" class="btn" target="_blank">View</a>';
							}
							echo '</div><div class="content-player"></div></li>';
						}
					}

					echo '</ul>';
				}
			?>

		</div>

	<?php
		endif;
		$i++;
	?>

<?php endwhile; ?>
