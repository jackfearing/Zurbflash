<?php get_header(); ?>

<h2>Page Template Code:</h2>

<?php
if (is_page_template('default'))  {
    echo 'show some content when you ARE in template-custom.php OR template-custom2.php';
} else {
	echo 'Im not a template default';
}
?>


<?php if (is_page_template('default')) :?>
   <?php echo 'show some content when you ARE in template-custom.php OR template-custom2.php'; ?>
<?php else : ?>
	<?php echo 'Im not a template default'; ?>
<?php endif; ?>


<?php
if ( is_page_template( 'default' ) ) {
    echo '<p>page.php is used</p>';
} else {
    echo '<p>page.php is not used</p>';
}
?>


<?php if( is_page_template('page.php') ) { // check for page template
    echo '<p>page.php is used</p>';
} elseif( is_single() || is_page() ) { // it's not the page template. Is it at least a post or page?
     echo '<p>Single</p>';
} else { // I suspect you want a fallback condition, not sure what it is.
     echo '<p>page.php is not used</p>';
} ?>
=================






	<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-12 columns scene_element scene_element--fadeIn" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		    <?php get_sidebar('acf'); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>