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
						<section>
							<div class="table-container">
								<table id="alumniTable" class="tablesorter alumni-list">
									<thead>
										<tr class="titles">
											<th class="first-name">
												<div>
													First Name
													<svg class="icon icon-sort"><use xlink:href="#icon-sort"></use></svg>
													<svg class="icon icon-sort-asc"><use xlink:href="#icon-sort-asc"></use></svg>
													<svg class="icon icon-sort-desc"><use xlink:href="#icon-sort-desc"></use></svg>
												</div>
											</td>
											<th class="last-name">
												<div>
													Last Name
													<svg class="icon icon-sort"><use xlink:href="#icon-sort"></use></svg>
													<svg class="icon icon-sort-asc"><use xlink:href="#icon-sort-asc"></use></svg>
													<svg class="icon icon-sort-desc"><use xlink:href="#icon-sort-desc"></use></svg>
												</div>
											</td>
											<th class="city">
												<div>
													City
													<svg class="icon icon-sort"><use xlink:href="#icon-sort"></use></svg>
													<svg class="icon icon-sort-asc"><use xlink:href="#icon-sort-asc"></use></svg>
													<svg class="icon icon-sort-desc"><use xlink:href="#icon-sort-desc"></use></svg>
												</div>
											</td>
											<th class="state">
												<div>
													State
													<svg class="icon icon-sort"><use xlink:href="#icon-sort"></use></svg>
													<svg class="icon icon-sort-asc"><use xlink:href="#icon-sort-asc"></use></svg>
													<svg class="icon icon-sort-desc"><use xlink:href="#icon-sort-desc"></use></svg>
												</div>
											</td>
											<th class="holy-ambition">
												<div>
													Holy Ambition
													<svg class="icon icon-sort"><use xlink:href="#icon-sort"></use></svg>
													<svg class="icon icon-sort-asc"><use xlink:href="#icon-sort-asc"></use></svg>
													<svg class="icon icon-sort-desc"><use xlink:href="#icon-sort-desc"></use></svg>
												</div>
											</td>
										</tr>
									</thead>
									<tbody>
										<?php 
											$members = get_users('role=subscriber'); 
											foreach ( $members as $member ) :
												$sub = new RCP_Member( $member->ID );
												$status = $sub->get_status();
												if( $status == 'active' ) :
												if(get_user_meta($member->ID, 'rcp_ambition', true) == 1):
										?>
											<tr class="users">
												<td class="first-name"><?php echo get_user_meta($member->ID, 'first_name', true); ?></td>
												<td class="last-name"><?php echo get_user_meta($member->ID, 'last_name', true); ?></td>
												<td class="city"><?php echo get_user_meta($member->ID, 'rcp_city', true); ?></td>
												<td class="state"><?php echo get_user_meta($member->ID, 'rcp_state', true); ?></td>

												<?php
													$see_more = '<a href="#" class="more-ha"> <span>...</span> See More</a>';
													$str = get_user_meta($member->ID, 'rcp_ha', true);
													$out = strlen($str) > 30 ? substr($str,0,30). $see_more : $new_str;
													$table = '<tr class="users">';
													$tableOpen = '<td class="holy-ambition-full">';
													$tableClose = '</td>';

													if(strlen($str) > 30){ 

										         	echo '<td class="holy-ambition">';
														echo $out;
														echo '</td>';
														echo $tableOpen;
														echo $str;
														echo '<a href="#" class="more-ha close">Close</a>';
														echo $tableClose;
														echo '</tr>';

										    		} else { 

										    			echo '<td class="holy-ambition">';
														echo $str;
														echo '</td>';

										    		}

												?>

											</tr>
										<?php endif; endif;
											endforeach;
										?>
									</tbody>
								</table>
							</div>
						</section>
						<?php get_template_part( 'content', 'block' ); ?>
					</article>
				</div>
			</div>

			<?php endwhile; // end of the loop. ?>


<?php get_footer('secure'); ?>
