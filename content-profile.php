<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Primemovers
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('full-section form-page'); ?>>
	<div class="group">
		<article class="form-wrap group">
				<?php include 'rcp/profile-editor.php'; ?>
		</article><!-- .entry-content -->
	</div>
</div><!-- #post-## -->
