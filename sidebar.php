<div id="sidebar1" class="sidebar large-4 columns" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar1' ); ?>

		<?php get_template_part( 'parts/nav', 'login' ); ?>

    	<?php joints_related_posts(); ?>

	<?php else : ?>

	<!-- This content shows up if there are no widgets defined in the backend. -->

		<div class="alert help">
			<p><?php _e( 'Please activate some Widgets.', 'jointswp' );  ?></p>
		</div>

	<?php endif; ?>

</div>