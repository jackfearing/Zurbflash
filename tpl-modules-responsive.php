<?php
/*
Template Name: Modules (Responsive)
*/
?>

<?php get_header(); ?>

	<?php get_template_part( 'parts/content', 'header' ); ?>

<?php
/*-------------------------------------------------------------------------------------------*/
/* FLEXIBLE SECTION GALLERY SLIDER: FULL-WIDTH SEPERATE FROM CONTENT WRAPPER */
/*-------------------------------------------------------------------------------------------*/
?>

	<?php if( have_rows('module') ): // field label: ?>

		<?php while ( have_rows('module') ) : the_row(); // field label: ?>
			<?php if( get_row_layout() == 'gallery_section' ): // layout: ?>

				<?php get_template_part( 'parts/modules/nested-module', 'slider' ); ?>

			<?php endif; // end if flexible: ?>

		<?php endwhile; // end flexible: ?>

		<?php else : ?>

		<?php //CONTENT GOES HERE ?>

	<?php endif; ?>



	<?php

		$i=0;
		$galleryJSCode = NULL;  // store all the JS code needed for gallery items. this will then be dumped at the end; it can be used for ALL gallery JS code!

		$wow_duration = 0;
		$wow_duration_inc = 0;
		$wow_delay = 0;
		$wow_delay_inc = 0;
		$wow_animation_effect = 'bounceIn';
		//$wow_animation_effect = 'bounceInLeft';
		//$wow_animation_effect = 'zoomIn';

		function wow_duration_delay_change() {
			global $wow_duration;
			global $wow_duration_inc;

			global $wow_delay;
			global $wow_delay_inc;

			$wow_duration = $wow_duration + $wow_duration_inc;
			$wow_delay = $wow_delay + $wow_delay_inc;

			return array($wow_duration, $wow_delay);
		};

	?>



	<?php

		$i=0; // var used for tabs, then zeroed out and used for the tab content.
		$galleryJSCode = NULL;  // store all the JS code needed for gallery items. this will then be dumped at the end; it can be used for ALL gallery JS code!
	?>



	<?php
		$sidebar = get_field('sidebar_select');
		$rowWidthPage = get_field('page_width'); // sub field:
		$rowPage = get_field('page_row'); // sub field:
	?>

	<?php if( $sidebar == 'sidebar_module_default' ): // loads default sidebar using widgets ?>

			<?php //echo '<strong class="highlight">SIDEBAR - ACTIVE</strong>';?>

			<div id="content">

				<div id="inner-content">

					<main id="main" role="main">

						<?php while ( have_rows($sidebar, 'options') ) : the_row(); // field: Flexible ?>

						<?php endwhile; ?>

						<div class="module-section row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

							<div class="large-8 columns">

								<!--<h2>Large-8</h2> -->

								<?php include(locate_template('parts/content-page-loop.php')); ?>

							</div> <!-- end .columns -->

								<?php include(locate_template('sidebar-acf.php')); // columns assigned within sidebar ?>

						</div> <!-- end .module-section .row -->

					</main> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

		<?php elseif( have_rows($sidebar, 'options') ): // field: Flexible ?>

			<?php //echo '<strong class="highlight">SIDEBAR - ACTIVE</strong>';?>

			<div id="content">

				<div id="inner-content">

					<main id="main" role="main">

						<?php while ( have_rows($sidebar, 'options') ) : the_row(); // field: Flexible ?>

						<?php endwhile; ?>

						<div class="module-section row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

							<div class="large-8 columns">

								<!--<h2>Large-8</h2> -->

								<?php include(locate_template('parts/content-page-loop.php')); ?>

							</div> <!-- end .columns -->

								<?php include(locate_template('sidebar-acf.php')); // columns assigned within sidebar ?>

						</div> <!-- end .module-section .row -->

					</main> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

			<?php else : ?>
			<!-- This content shows up if there are no sidebars defined in the backend. -->

			<?php //echo '<strong class="highlight">NO SIDEBAR SELECTED</strong>';?>

			<div id="content">

				<div id="inner-content">

					<main id="main" role="main">

						<div class="module-section row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

							<div class="large-12 columns">

								<!-- <h2>Large-12</h2> -->

								<?php include(locate_template('parts/content-page-loop.php')); ?>

							</div> <!-- end .columns -->

						</div> <!-- end .module-section .row -->

					</main> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

		<?php endif; ?>






<?php get_footer(); ?>
