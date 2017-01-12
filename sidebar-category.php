<?php
	$taxonomy = get_queried_object();

	$title = get_field('category_title', $taxonomy );
	//$image = get_field('category_header', $taxonomy );
	$description = get_field('category_description', $taxonomy );
	$sidebar = get_field('sidebar_select', $taxonomy );

?>


<!--
<div class="table-cell-wrapper">
	<?php echo '<strong>'.$taxonomy->name.'</strong>';?>

	<?php if ($title):?>
		<?php echo '<h2>'.$title.'<h2>'; ?>
	<?php endif;?>

	<?php if ($description):?>
		<?php echo '<div class="category-description">'.$description.'</div>'; ?>
	<?php endif;?>

</div>
-->








<div id="sidebar" class="sidebar large-4 columns" role="complementary">

	<div class="row sidebar-container" data-equalizer data-equalize-by-row="true">

			<?php $sidebar = get_field('sidebar_select', $taxonomy); ?>

				<?php if( have_rows($sidebar, 'options') ): // field: Flexible ?>

					<?php while ( have_rows($sidebar, 'options') ) : the_row(); // field: Flexible ?>

						<?php get_template_part( 'parts/content', 'sidebar' ); ?>

				    <?php endwhile; ?>

				<?php elseif ( is_active_sidebar( 'sidebar1' ) ) : ?>

					<div class="columns">

						<?php dynamic_sidebar( 'sidebar1' ); ?>

						<?php get_template_part( 'parts/nav', 'login' ); ?>

				    	<?php joints_related_posts(); ?>

					</div> <!-- end .columns -->

				<!-- This content shows up if there are no widgets defined in the backend. -->
				<?php else : ?>
					<div class="columns">

						<?php get_template_part( 'parts/nav', 'login' ); ?>

						<div class="alert help">
							<p><?php _e( 'Please activate some Widgets.', 'jointswp' );  ?></p>
						</div> <!-- end .alert -->

					</div> <!-- end .columns -->

				<?php endif; ?>

	</div> <!-- end .sidebar-container -->

</div> <!-- end .sidebar -->