<?php get_header(); ?>

	<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-12 columns" role="main">



<div class="row large-up-2" data-balancer data-respect-sibling-width="false">
			    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="column">
					<!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive' ); ?>

</div>
				<?php endwhile; ?>
</div>
					<?php joints_page_navi(); ?>

				<?php else : ?>

					<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>
<?php wp_reset_postdata(); ?>


		    </main> <!-- end #main -->

		    <?php get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>