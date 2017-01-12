<?php
/*
Template Name: Custom Post Type
*/
?>

<?php get_header(); ?>

	<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 columns" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		    <?php get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->



<?php
 // ******************************************************************

 // CUSTOM POST TYPE MAGIC

 // ******************************************************************
?>

<?php
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');

	$args = array(
		'post_type' => 'book',
		'post_status' => 'publish',
		//'posts_per_page' => '1',
		'paged' => $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'type',
				'field' => 'slug',
				'terms' => 'fiction',
				)
			)
	);

	$products_loop = new WP_Query( $args );
		if ( $products_loop->have_posts() ) :
		while ( $products_loop->have_posts() ) : $products_loop->the_post();
?>
<!-- CUSTOM CONTENT GOES HERE -->
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

<h2>Tags</h2>

<p><strong>TAGS with links (Conditional)</strong></p>

<?php if ( get_the_tags() ) :?>

	<div class="article-footer">
		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>
	</div> <!-- end article footer -->

<?php else : ?>
	<!-- EMPTY -->
<?php endif; ?>

<p><strong>TAGS List with links and separator</strong></p>

<?php echo get_the_tag_list('',', ',''); ?>

<p><strong>TAGS List without links and separator</strong></p>

<?php echo strip_tags(get_the_tag_list('',', ','')); ?>

<p><strong>TAGS list without links and list item</strong></p>

 <?php
$posttags = get_the_tags();
if ($posttags) {
	echo '<ul>';
  foreach($posttags as $tag) {
    echo '<li>' .$tag->name. '</li>';
  }
  echo '</ul>';
}
?>

<p><strong>TAGS list with links and list item</strong></p>

<?php

$terms = get_the_tags();

echo '<ul>';

foreach ( $terms as $term ) {

    // The $term is an object, so we don't need to specify the $taxonomy.
    $term_link = get_term_link( $term );

    // If there was an error, continue to the next term.
    if ( is_wp_error( $term_link ) ) {
        continue;
    }

    // We successfully got a link. Print it out.
    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
}

echo '</ul>';

?>




<h2>Taxonomy</h2>

<hr>

<p><strong>Taxonomy with links and separator</strong></p>

<?php echo get_the_term_list( $post->ID, 'type', '', ', ', '' ); ?>

<p><strong>Taxonomy without links and separator</strong></p>

<?php echo strip_tags( get_the_term_list( $post->ID, 'type', '', ', ', '' ) ); ?>


<p><strong>Taxonomy list without links</strong></p>

<?php $terms = get_terms( 'type' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
     echo '<ul>';
     foreach ( $terms as $term ) {
       echo '<li>' . $term->name . '</li>';

     }
     echo '</ul>';
 } ?>




<p><strong>Taxonomy list with Links</strong></p>

<?php

$terms = get_terms( 'type' );

echo '<ul>';

foreach ( $terms as $term ) {

    // The $term is an object, so we don't need to specify the $taxonomy.
    $term_link = get_term_link( $term );

    // If there was an error, continue to the next term.
    if ( is_wp_error( $term_link ) ) {
        continue;
    }

    // We successfully got a link. Print it out.
    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
}

echo '</ul>';

?>

<hr>

<h2>Categories</h2>
<p><strong>Category with links and separator</strong></p>

<?php echo get_the_term_list( $post->ID, 'category', '', ', ', '' ); ?>


<p><strong>Category without links and separator</strong></p>

<?php echo strip_tags( get_the_term_list( $post->ID, 'category', '', ', ', '' ) ); ?>



<p><strong>Category List without links and separator</strong></p>

<?php $terms = get_terms( 'category' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
     echo '<ul>';
     foreach ( $terms as $term ) {
       echo '<li>' . $term->name . '</li>';

     }
     echo '</ul>';
 } ?>

<p><strong>Category list with links and lists</strong></p>

<?php echo get_the_term_list( $post->ID, 'category', '<ul><li>', '</li><li>', '</li></ul>' ); ?>





<p><strong>Category List with links and lists (Optional)</strong></p>

<?php

	$terms = wp_get_post_terms( $post->ID, 'category');
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	echo '<ul>';
	foreach ($terms as $term) {
	    echo '<li><a href="'.get_term_link($term->slug, 'category').'">'.$term->name.'</a></li>';
	}
	echo '</ul>';

}?>




<?php endwhile; wp_reset_postdata(); ?>

<?php else : ?>

	<!-- show 404 error here -->
	<p><?php _e( 'Sorry, no posts matched your criteria.', 'jointswp' ); ?></p>

<?php endif; ?>





<?php
if ( get_query_var('paged') ) $paged = get_query_var('paged');
if ( get_query_var('page') ) $paged = get_query_var('page');

$wp_query = new WP_Query( array( 'post_type' => 'book', 'paged' => $paged ) );

if ( $wp_query->have_posts() ) : ?>

	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
			<header class="article-header">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<?php //get_template_part( 'parts/content', 'byline' ); ?>
			</header> <!-- end article header -->

			<section class="entry-content" itemprop="articleBody">
				<!-- <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full'); ?></a> -->
				<?php //the_content('<button class="tiny">Read more...</button>'); ?>
				<?php the_excerpt(); ?>
			</section> <!-- end article section -->




<p><strong>TAGS</strong></p>
	<div class="article-footer">
		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>
	</div> <!-- end article footer -->

 <?php
$posttags = get_the_tags();
if ($posttags) {
  foreach($posttags as $tag) {
    echo '<li>' .$tag->name. '</li>';
  }
}
?>




<p><strong>Taxonomy NO links</strong></p>

<?php $terms = get_terms( 'type' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
     echo '<ul>';
     foreach ( $terms as $term ) {
       echo '<li>' . $term->name . '</li>';

     }
     echo '</ul>';
 } ?>


<p><strong>Taxonomy with Links</strong></p>

<?php

$terms = get_terms( 'type' );

echo '<ul>';

foreach ( $terms as $term ) {

    // The $term is an object, so we don't need to specify the $taxonomy.
    $term_link = get_term_link( $term );

    // If there was an error, continue to the next term.
    if ( is_wp_error( $term_link ) ) {
        continue;
    }

    // We successfully got a link. Print it out.
    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
}

echo '</ul>';

?>




		</article> <!-- end article -->

	<?php endwhile; wp_reset_postdata(); ?>

	<!-- show pagination here -->
	<?php joints_page_navi(); ?>

<?php else : ?>

	<!-- show 404 error here -->
	<p><?php _e( 'Sorry, no posts matched your criteria.', 'jointswp'  ); ?></p>

<?php endif; ?>




<?php get_footer(); ?>
