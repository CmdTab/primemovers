<?php
/**
 * Template name: Ambitions
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Primemovers
 */
get_header('secure');
if( rcp_is_active() ) :
while ( have_posts() ) : the_post();

?>

			<div class="full-section secure-page">
				<div class="group">

					<article class="entry-content group secure-content dash-content">
						<header class="secure-page-header dash-header">
							<h1><?php the_title(); ?></h1>
							<p><?php the_field('sidebar_quote');?></p>
							<a href = "#ambition-nav" class="view-all">Browse by Topic</a>

						</header>
						<?php get_template_part( 'content', 'block' ); ?>
						<div class="ambition-list group">
<?php
	$i = 1;
	$args = array( 'post_type' => 'ambitions', 'posts_per_page' => 10 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	$terms = get_the_terms( $post->ID, 'area' );
?>
							<div class='single-ambition <?php if ($i % 2 == 0){echo "even";} else {echo "odd";}?>'>
								<h4><?php the_title(); ?></h4>

								<div class="ambition-content">
									<?php the_content(); ?>
								</div>
								<div class="ambition-actions">
<?php
	$contact = get_field('contact_preference');
	if ($contact == 'Yes') {
		echo '<a href = "mailto:';
		echo get_field('contact_email');
		echo '" class="btn">Contact</a>';
	}
?>
<?php
	if ( $terms && ! is_wp_error( $terms ) ) :
		echo '<div class="category-list">';
		$cats = array();

		foreach ( $terms as $term ) {
			echo '<a href = "' . esc_url( home_url( '/' ) ).'area/' . $term->slug . '">';
			echo $term->name;
			echo '</a>';
		}
		echo '</div>';
	endif;
?>
								</div>
							</div>
							<?php
								$i++;
								endwhile;
								wp_reset_postdata();
							?>
						</div>
						<nav id="ambition-nav" class="ambition-cats">
							<h2>Discover More</h2>
<?php
//list terms in a given taxonomy
$taxonomy = 'area';
$tax_terms = get_terms($taxonomy);
?>
							<ul class="group">
<?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>
							</ul>
						</nav>
					</article>
					<?php get_sidebar('news'); ?>
				</div>
			</div>

	<?php endwhile; // end of the loop. ?>
<?php else : ?>
	<div class="full-section login-problem">
		<div class="login-needed">Please use the login form above to see this content.</div>
	</div>
<?php endif; ?>
<?php //get_sidebar(); ?>
<?php get_footer('secure'); ?>
