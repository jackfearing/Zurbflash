<div id="sidebar" class="sidebar large-4 columns" role="complementary">

	<div class="row sidebar-container" data-equalizer data-equalize-by-row="true">

			<?php $sidebar = get_field('sidebar_select'); ?>

				<?php if( have_rows($sidebar, 'options') ): // field: Flexible ?>

					<!-- <p><strong>CUSTOM SIDEBAR CONTENT</strong></p> -->

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

						<div class="callout warning">
							<p><strong><?php _e( 'Please activate some Widgets.', 'jointswp' );  ?></strong></p>
						</div> <!-- end .alert -->

					</div> <!-- end .columns -->

				<?php endif; ?>

	</div> <!-- end .sidebar-container -->

</div> <!-- end .sidebar -->