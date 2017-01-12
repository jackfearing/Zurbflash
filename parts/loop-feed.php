
	<?php
		echo get_field('true_select'); // sub field: used for nested loop to remove margins
	?>

	<?php
		if (get_field('true_select') == '0') {
				echo 'FALSE';
		} else if (get_field('true_select') == '1') {
	        echo "TRUE";
		}
	?>


<?php if (get_field( 'true_select' )): ?>
	<h2>TRUE</h2>
<?php else: ?>
	<h2>FALSE</h2>
<?php endif; ?>









<?php
	$columnDisplayLarge 	= get_field('column_display_large'); // sub field:
	$columnDisplayMedium 	= get_field('column_display_medium'); // sub field:
	$columnDisplaySmall 	= get_field('column_display_small'); // sub field:

	$terms = get_field('category_select'); // ACF Taxonomy Field
	$postNumber = get_field('number_of_posts'); // ACF Number Field

	$string_of_terms_search = false;
	$string_of_terms = false;

	//echo "<br><h1>string to pass to query: </h1>";
		$total = count($terms);
		$count = 1;
		foreach( $terms as $term ):
			$string_of_terms .= '<a href="'.get_term_link( $term ).'">'.$term->name.'</a>';
			$string_of_terms_search .= $term->name;
			if ($count < $total) {
				$string_of_terms .= ', ';
				$string_of_terms_search .= ', ';
		}
		$count++;

	endforeach;
	//echo $string_of_terms;
	//echo "<br>";
	//echo $string_of_terms_search;
?>



<!--
	<?php
		// Get current page and append to custom query parameters array
		// Conditional statment to check if function is on front_page
		// Fixes issue of page vs paged when function is run on front_page

		global $paged;

		if ( is_front_page() ) {
			$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
		} else {
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		}
	?>
-->
	<?php // Define custom query parameters
	$custom_query_args = array(
		'post_type' 			=> 'post',
		//'posts_per_page' 		=> get_option('posts_per_page'),
		'posts_per_page'   		=> $postNumber,
		'post_status' 			=> 'publish',
		'ignore_sticky_posts' 	=> true,
		'category_name' 		=> $string_of_terms_search,
		//'category_name' 		=> 'dog',
		'order' 				=> 'DESC', // 'ASC'
		'orderby' 				=> 'date', // modified | title | name | ID | rand
		'paged' 				=> $paged
	); ?>



	<?php // Instantiate custom query
	$custom_query = new WP_Query( $custom_query_args ); ?>

	<?php // Pagination fix
		$temp_query = $wp_query;
		$wp_query   = NULL;
		$wp_query   = $custom_query;
	?>



	<?php
		$rowPage 	= get_field('page_row'); // sub field: used for nested loop to remove margins
	?>

<?php //echo $rowPage; ?>

<div class="category-feed">
	<div class="row column">

<!-- 	<div class="row large-up-<?php echo $columnDisplayLarge; ?> medium-up-<?php echo $columnDisplayMedium; ?> small-up-<?php echo $columnDisplaySmall; ?>" data-balancer data-respect-sibling-width="false" data-equalizer data-equalize-on="medium" data-equalize-on-stack="false"> -->

	<div class="row <?php echo $rowPage; ?> large-up-<?php echo $columnDisplayLarge; ?> medium-up-<?php echo $columnDisplayMedium; ?> small-up-<?php echo $columnDisplaySmall; ?>" data-balancer data-respect-sibling-width="true" data-equalizer data-equalize-by-row="true">


<!--
		<div class="row large-up-<?php echo $columnDisplayLarge; ?> medium-up-<?php echo $columnDisplayMedium; ?> small-up-<?php echo $columnDisplaySmall; ?>"
			<?php // Conditional statement for data-balancer
				if (get_field('balance_rows') == 'yes') {
						echo 'data-balancer data-respect-sibling-width="false"';
				} else if (get_field('balance_rows') == 'no') {
			        //echo "do something else";
				}
			?>
		>
-->

			<?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

				<div class="column" data-equalizer-watch>
					<?php if(has_post_thumbnail()):?>
						<div class="article-thumbnail">
							<?php the_post_thumbnail('feed-thumbnail'); ?>
						</div>
						<!-- <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a> -->
					<?php else :?>
						<?php //echo 'CONTENT_GOES_HERE'; ?>
					<?php endif;?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
						<header class="article-header">
							<div class="byline">
								<p class="time-date"><?php the_time('F j, Y') ?></p>
							</div>
							<h2><?php the_title(); ?></h2>
							<?php //get_template_part( 'parts/content', 'byline' ); ?>
						</header> <!-- end article header -->

						<section class="entry-content group" itemprop="articleBody">
							<?php //the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
							<?php the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
							<?php //the_excerpt();?>
								<p class="time-category"><?php the_category(' ') ?></p>
						</section> <!-- end article section -->

						<?php //get_template_part( 'parts/content', 'social' ); ?>

						<?php //get_template_part( 'parts/nav', 'footer-tags' ); ?>

					</article> <!-- end article -->

				</div> <!-- end .column -->

			<?php endwhile; ?>

			<?php else: ?>

			<h2><?php _e( 'Sorry, no posts matched your criteria.', 'jointswp' ); ?></h2>

			<?php endif;?>

		</div> <!-- end .row -->

		<?php joints_page_navi(); ?>

	</div> <!-- end .row .column -->
</div> <!-- end .category-feed -->

	<?php // Reset main query object
		$wp_query = NULL;
		$wp_query = $temp_query;
	?>

