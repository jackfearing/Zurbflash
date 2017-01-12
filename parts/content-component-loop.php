		<?php if( have_rows('section_group') ): // nested field label: ?>

			<?php while ( have_rows('section_group') ) :  the_row(); // nested field label: ?>
				<?php $outerCounter ++;
					//echo "module - ".$outerCounter;
				?>

				<?php // Module: Section
					include(locate_template('parts/modules/nested-module-section.php'));
				?>

				<?php // Module: Featured
					include(locate_template('parts/modules/nested-module-featured.php'));
				?>

				<?php // Module: Content
					include(locate_template('parts/modules/nested-module-content.php'));
				?>

				<?php // Module: Image Billboard
					include(locate_template('parts/modules/nested-module-image.php'));
				?>

				<?php // Module: Reveal
					include(locate_template('parts/modules/nested-module-reveal.php'));
				?>

	            <?php // Module: Video
					include(locate_template('parts/modules/nested-module-video.php'));
				?>

				<?php // Module: Photo
					include(locate_template('parts/modules/nested-module-photo.php'));
				?>

				<?php // Module: Link
					include(locate_template('parts/modules/nested-module-link.php'));
				?>

				<?php // Module: Gallery Slider
					include(locate_template('parts/modules/nested-module-gallery-slider.php'));
				?>

				<?php // Module: Tabs
					include(locate_template('parts/modules/nested-module-tabs.php'));
				?>

				<?php // Module: Accordion
					include(locate_template('parts/modules/nested-module-accordion.php'));
				?>

			<?php endwhile; // end nested flexible: ?>

		<?php endif; // end if nested flexible: ?>
