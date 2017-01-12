<?php
/*
Template Name: Lightbox Component
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="large-8 medium-8 columns" role="main">

		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		    	<?php get_template_part( 'parts/loop', 'single' ); ?>

<?php

// check if the repeater field has rows of data
if( have_rows('lightbox_component_group') ):

 	// loop through the rows of data
    while ( have_rows('lightbox_component_group') ) : the_row();

        // display a sub field value
        the_sub_field('component_title');

    endwhile;

else :

    // no rows found

endif;

?>

		    <?php endwhile; else : ?>

		   		<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

		</main> <!-- end #main -->

		<?php get_sidebar(); ?>

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>