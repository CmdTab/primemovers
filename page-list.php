<?php
	/**
	 * Template name: List
	 *
	 * This is the template that displays all pages by default.
	 * Please note that this is the WordPress construct of pages
	 * and that other 'pages' on your WordPress site will use a
	 * different template.
	 *
	 * @package Primemovers
	 */


    get_header('secure');
	while ( have_posts() ) : the_post();

?>

			<div class="full-section secure-page">
				<div class="group">
					<?php get_sidebar(); ?>
					<article class="entry-content group secure-content">
						<header class="secure-page-header">
							<h1><?php the_title(); ?></h1>
							<p><?php the_field('sidebar_quote');?></p>
						</header>
						<table class="member-list">
						<?php 
							$members = get_users('role=subscriber'); 
							foreach ( $members as $member ) :
								/*echo '<pre>';
								var_dump($member);
								echo '</pre>';*/
								/*echo $member->display_name . ' - ';*/
								$sub = new RCP_Member( $member->ID );
								$status = $sub->get_status();
								if( $status == 'active' ) :
									if(get_user_meta($member->ID, 'rcp_ambition', true) == 1):
						?>
							<tr>
								<td><?php echo get_user_meta($member->ID, 'first_name', true); ?></td>
								<td><?php echo get_user_meta($member->ID, 'last_name', true); ?></td>
								<td><?php echo get_user_meta($member->ID, 'rcp_city', true); ?></td>
								<td><?php echo get_user_meta($member->ID, 'rcp_state', true); ?></td>
								<td><?php echo get_user_meta($member->ID, 'rcp_ha', true); ?></td>
							</tr>
								<?php endif; endif;
							endforeach;
						?>
						</table>
						<?php get_template_part( 'content', 'block' ); ?>
					</article>
				</div>
			</div>

			<?php endwhile; // end of the loop. ?>


<?php get_footer('secure'); ?>
