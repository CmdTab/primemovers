<?php
/**
 * @package Primemovers
 */
?>
	<h4><?php the_title(); ?></h4>
	<div class="ambition-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'primemovers' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .ambition-content -->
	<div class="ambition-actions">
<?php
	$contact = get_field('contact_preference');
	if ($contact == 'Yes') {
		echo '<a href = "mailto:';
		echo get_field('contact_email');
		echo '" class="btn">Contact</a>';
	}
?>
	</div>