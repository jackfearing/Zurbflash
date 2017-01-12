















<?php if(get_field('pages')) :?>


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
		$rowWidthTabs = get_field('page_section_width'); // sub field:
	?>



	<?php

		$i=0; // var used for tabs, then zeroed out and used for the tab content.
		$galleryJSCode = NULL;  // store all the JS code needed for gallery items. this will then be dumped at the end; it can be used for ALL gallery JS code!
	?>







	<div class="module-section row <?php echo $rowWidthTabs; ?>">

	<div class="column">

	<div class="custom-tabs tab-container">

		<ul role="tablist" class="tabs">

		<?php
			foreach(get_field('pages') as $relationship) {
				echo '<li><a role="tab" class="tab '.$relationship->post_name.'" href="#tab-'.$relationship->post_name.'-'.$i++.'">'.$relationship->post_title.'</a></li>';
			}
		?>

		</ul><!-- .tabs -->

		<div class="tab-content">

		    <?php $i=0;
		      foreach(get_field('pages') as $relationship) {
		    ?>

		    <section role="tabpanel" id="tab-<?php echo $relationship->post_name ;?>-<?php echo($i++); ?>">

				<div class="content-wrapper">

				<?php
					// the query
					$the_query = new WP_Query( "page_id=".$relationship->ID."" ); ?>

					<?php if ( $the_query->have_posts() ) : ?>

					<!-- pagination here -->

					<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<div class="row jack">

						<?php $myPostID = $relationship->ID; // this will be used to aid in triggering the right content for each post. Meaning, It will help determine which gallery to open ?>

						<div class="large-12 columns jack">












<?php
/*-------------------------------------------------------------------------------------------*/
/* NEW LAYOUT */
/*-------------------------------------------------------------------------------------------*/
?>
							<?php if( have_rows('module') ): // field label: ?>

								<?php $outerCounter = 0; ?>






<?php
/*-------------------------------------------------------------------------------------------*/
/* NEW CONDITIONAL */
/*-------------------------------------------------------------------------------------------*/
?>
<?php $sidebar = get_field('sidebar_select'); ?>

		<?php if( have_rows($sidebar, 'options') ): // field: Flexible ?>

			<?php echo '<strong class="highlight">SIDEBAR - ACTIVE</strong>';?>

			<?php while ( have_rows($sidebar, 'options') ) : the_row(); // field: Flexible ?>

			<?php endwhile; ?>

			<div class="row">
				<div class="large-8 columns">
					large-8

						<?php while ( have_rows('module') ) : the_row(); // field label: ?>

							<?php if( get_row_layout() == 'section' ): // layout: ?>


<?php
	/* Module: Header */
	/* Template part can be used if NOT using counter */
	get_template_part( 'parts/modules/nested', 'module-header' );
?>


									<?php if( have_rows('section_group') ): // nested field label: ?>

										<?php while ( have_rows('section_group') ) :  the_row(); // nested field label: while ?>

												<div class="gallery-container">

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

														<?php // Module: Link
															include(locate_template('parts/modules/nested-module-gallery-slider.php'));
														?>

												</div> <!-- end .gallery-container -->



										<?php endwhile; // end nested field label: ?>

									<?php endif; // end nested field label: ?>

							<?php endif; // end layout:  ?>

						<?php endwhile; // end field label: ?>


				</div> <!-- end .row -->
				<div>
					large-4 columns
					<?php // Module: Link
						include(locate_template('sidebar-acf.php'));
					?>
				</div>
			</div>

			<?php else: ?>


			<div class="row">
				<div class="large-12 columns">
					SOMETHING 12 COLUMNS

						<?php while ( have_rows('module') ) : the_row(); // field label: ?>

							<?php if( get_row_layout() == 'section' ): // layout: ?>

<?php
	/* Module: Header */
	/* Template part can be used if NOT using counter */
	get_template_part( 'parts/modules/nested', 'module-header' );
?>



							<?php if( have_rows('section_group') ): // nested field label: ?>

								<?php while ( have_rows('section_group') ) :  the_row(); // nested field label: while ?>

										<div class="gallery-container">

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

												<?php // Module: Link
													include(locate_template('parts/modules/nested-module-gallery-slider.php'));
												?>

										</div> <!-- end .gallery-container -->



								<?php endwhile; // end nested field label: ?>

								<?php endif; // end nested field label: ?>

							<?php endif; // end layout:  ?>

						<?php endwhile; // end field label: ?>





				</div> <!-- end .columns -->
			</div> <!-- end .rows -->



			<?php endif;?>









	<?php else : ?>

	<?php echo 'CONTENT GOES HERE'; ?>




	<?php $sidebar = get_field('sidebar_select'); ?>

		<?php if( have_rows($sidebar, 'options') ): // field: Flexible ?>

			<div class="row">
				<div class="large-8 columns">
					<?php the_content(); ?>
				</div>
				<div class="large-4 columns">

					<?php while ( have_rows($sidebar, 'options') ) : the_row(); // field: Flexible ?>

						<?php get_template_part( 'parts/content', 'sidebar' ); ?>

				    <?php endwhile; ?>

				</div>
			</div>


	<?php //elseif ( is_active_sidebar( 'sidebar1' ) ) : ?>

		<?php //dynamic_sidebar( 'sidebar1' ); ?>

		<?php //get_template_part( 'parts/nav', 'login' ); ?>

    	<?php //joints_related_posts(); ?>

	<!-- When uncommented, this content shows up if there are no widgets defined in the backend. -->

	<?php else : ?>
			<!-- This content shows up if there are no sidebars defined in the backend. -->
			<div class="row">
				<div class="large-12 columns">
					<?php the_content(); ?>
				</div>
			</div>

	<?php endif; ?>













<?php
/*-------------------------------------------------------------------------------------------*/
/* END CONDITIONAL */
/*-------------------------------------------------------------------------------------------*/
?>























							<?php endif; ?>

							<?php edit_post_link('Edit this section','<p class="button radius">','</p>'); ?>

							<?php /* End Flexable content */ ?>

							<?php wp_reset_query(); ?>











						</div> <!-- .columns jack -->

					</div><!-- .row jack -->

					<?php endwhile; ?>

					<!-- end of the loop -->

					<!-- pagination here -->

					<?php wp_reset_postdata(); ?>

					<?php else : ?>

						<p><?php _e( 'Sorry, no posts matched your criteria.', 'jointswp' ); ?></p>

					<?php endif; ?>

				</div> <!-- end .content-wrapper -->

		    </section> <!-- end tabspanel -->

	    <?php } ?>



<?php
/*-------------------------------------------------------------------------------------------*/
/* LIGHTGALLERY SETTINGS */
/*-------------------------------------------------------------------------------------------*/
?>

				<?php // Configuration: Settings for lightgallery
					include(locate_template('parts/config-lightgallery.php'));
				?>






		</div> <!-- end .tab-content -->

	</div> <!-- end tab-container -->

	</div> <!-- end .columns -->

</div> <!-- end .row -->







<?php endif; ?>  <!-- end IF pages -->