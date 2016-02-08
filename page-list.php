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
							<p class="disclaimer">This directory was created for Primemovers Alumni use only and with the permission of those who wish to be included. Please respect the privacy of others and refrain from sharing this information outside of the Primemovers community.</p>
							<!-- <p><?php // the_field('sidebar_quote');?></p> -->
						</header>
						<form class="search-form">  
							<span class="search-field">
								<label>Search for Alumni:</label>                                          
						   	<input type="text" id="search" placeholder="" />
						   </span>
						</form>
						<ul class="sticky-nav group">
							<li>First Name</li>
							<li>Last Name</li>
							<li>City</li>
							<li>State</li>
							<li>Holy Ambition</li>
						</ul>
						<table id="alumniTable" class="tablesorter alumni-list">
							<thead>
								<tr class="titles">
									<th class="first-name">First Name</td>
									<th class="last-name">Last Name</td>
									<th class="city">City</td>
									<th class="state">State</td>
									<th class="holy-ambition">Holy Ambition</td>
								</tr>
							</thead>
							<tbody>
								<?php 
									$members = get_users('role=subscriber'); 
									foreach ( $members as $member ) :
										/*echo '<pre>';
										var_dump($member);
										echo '</pre>';*/
										/*echo $member->display_name . ' - ';*/
										$sub = new RCP_Member( $member->ID );
										$status = $sub->get_status();
										// if( $status == 'active' ) :
											// if(get_user_meta($member->ID, 'rcp_ambition', true) == 1):
								?>
									<tr class="users">
										<td class="first-name"><?php echo get_user_meta($member->ID, 'first_name', true); ?></td>
										<td class="last-name"><?php echo get_user_meta($member->ID, 'last_name', true); ?></td>
										<td class="city"><?php echo get_user_meta($member->ID, 'rcp_city', true); ?></td>
										<td class="state"><?php echo get_user_meta($member->ID, 'rcp_state', true); ?></td>

										<?php
											$str = get_user_meta($member->ID, 'rcp_ha', true);
											$out = strlen($str) > 130 ? substr($str,0,130)." ... " : $str;
											$table = '<tr class="users">';
											$tableOpen = '<td class="holy-ambition-full">';
											$tableClose = '</td>';

											if(strlen($str) > 130){ 

								         	echo '<td class="holy-ambition">';
												echo $out;
												echo '<a href="#" class="more-ha">More</a>';
												echo '</td>';
												echo '</tr>';

												echo $table;
												echo $tableOpen;
												echo $out;
												echo $tableClose;

								    		} else { 

								    			echo '<td class="holy-ambition">';
												echo $str;
												echo '</td>';

								    		}

										?>

										<!-- if

										<td class="holy-ambition">
											<?php // echo get_user_meta($member->ID, 'rcp_ha', true); ?>
										</td>

										else

										<td class="holy-ambition">
											<?php // echo get_user_meta($member->ID, 'rcp_ha', true); ?>
											<a href="#">More</a>
										</td>
									</tr>

									<tr class="holy-ambition-full">
										<td>
											<?php // echo get_user_meta($member->ID, 'rcp_ha', true); ?>
										</td>

										endif -->

									</tr>
								<?php // endif; endif;
									endforeach;
								?>
							</tbody>
						</table>
						<?php get_template_part( 'content', 'block' ); ?>
					</article>
				</div>
			</div>

			<?php endwhile; // end of the loop. ?>


<?php get_footer('secure'); ?>
