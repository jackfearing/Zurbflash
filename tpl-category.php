<?php
/*
Template Name: Category
*/
?>

<?php get_header(); ?>

	<?php get_template_part( 'parts/content', 'header' ); ?>

	<?php
		$sidebar 		= get_field('sidebar_select');
		$rowWidthPage 	= get_field('page_width'); // sub field:
		$rowPage 		= get_field('page_row'); // sub field:
	?>





<!--
<?php if( $sidebar == 'sidebar_module_default' ): ?>
	<h2>Sidebar Default</h2>

<?php elseif( have_rows($sidebar, 'options') ): // field: Flexible ?>
	<h2>SIDEBAR</h2>

<?php else:?>
	<h2>NO SIDEBAR</h2>

<?php endif; ?>
-->



<?php if( $sidebar == 'sidebar_module_default' ): // loads default sidebar using widgets ?>

		<div id="content">

			<div id="inner-content">

			    <main id="main" role="main">

					<div class="row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

						<div class="large-8 columns">
							<div class="grid-margin-right">
								<?php get_template_part( 'parts/loop', 'feed' ); ?>
							</div>

						</div> <!-- end .columns -->

						<?php wp_reset_query(); // reset the query, needed for sidebar ?>

						<?php include(locate_template('sidebar-acf.php')); // columns assigned within sidebar ?>

					</div> <!-- end .row -->

			    </main> <!-- end #main -->

			</div> <!-- end #inner-content -->

		</div> <!-- end #content -->

	<?php elseif( have_rows($sidebar, 'options') ): // field: Flexible ?>

		<div id="content">

			<div id="inner-content">

			    <main id="main" role="main">

					<div class="row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

						<div class="large-8 columns">
							<div class="grid-margin-right">
								<?php get_template_part( 'parts/loop', 'feed' ); ?>
							</div>

						</div> <!-- end .columns -->

						<?php wp_reset_query(); // reset the query, needed for sidebar ?>

						<?php include(locate_template('sidebar-acf.php')); // columns assigned within sidebar ?>

					</div> <!-- end .row -->

			    </main> <!-- end #main -->

			</div> <!-- end #inner-content -->

		</div> <!-- end #content -->

	<?php else : ?>
	<!-- This content shows up if there are no sidebars defined in the backend. -->

		<div id="content">

			<div id="inner-content">

			    <main id="main" role="main">

					<div class="row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

						<div class="large-12 columns">

							<?php get_template_part( 'parts/loop', 'feed' ); ?>

						</div> <!-- end .columns -->

					</div> <!-- end .row -->

			    </main> <!-- end #main -->

			</div> <!-- end #inner-content -->

		</div> <!-- end #content -->

	<?php endif; ?>

<?php get_footer(); ?>