<?php // conditional statement using radio button for section header
	if (get_sub_field('add_section_header') =='Yes') :?>

	<?php if (get_sub_field('section_background')) :?>

		<?php
			$attachment_id 				= get_sub_field('section_background');
			$image_thumbnail 			= wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
			$image_medium 				= wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
			$image_large 				= wp_get_attachment_image_src( $attachment_id, "large-desktop" );
			$image_retina 				= wp_get_attachment_image_src( $attachment_id, "retina-large" );
			$alt 						= get_post_meta($attachment_id , '_wp_attachment_image_alt', true);

			$headline_background_color 	= get_sub_field('headline_background_color');
			$background_image_color 	= get_sub_field('background_image_color');
			$sectionRowWidthHeadline 	= get_sub_field('section_row_width_headline');
			$sectionRowWidthDescription = get_sub_field('section_row_width_description');

		?>

		<?php // conditional statement using radio button for background image + headline
			if (get_sub_field('add_background_image') =='Yes') :?>

				<?php echo '<div class="module-background align-container group" data-interchange=" ['.$image_thumbnail[0].', only screen and (min-width: 1px)] alt='.$alt.' width='.$image_thumbnail[1].' height='.$image_thumbnail[2].', ['.$image_large[0].', only screen and (min-width: 40em)] alt='.$alt.' width='.$image_large[1].' height='.$image_large[2].', ['.$image_retina[0].', only screen and (min-width: 64em)] alt='.$alt.' width='.$image_retina[1].' height='.$image_retina[2].'">' ;?>

					<div style="background-color:<?php echo $background_image_color;?>">

						<div class="module-wrapper" style="min-height: <?php the_sub_field('background_image_height'); ?>px">

							<?php if (get_sub_field('section_headline')) :?>

								<div class="align bottom" style="background-color:<?php echo $headline_background_color;?>">

									<div class="row <?php echo $sectionRowWidthHeadline;?>">

										<div class="column">

											<?php the_sub_field('section_headline');?>

										</div> <!-- end .column -->

									</div> <!-- end .row -->

								</div> <!-- end .align-bottom $headline_background_color -->

							<?php endif; ?>

						</div> <!-- end .module-wrapper -->

					</div> <!-- end $background_image_color -->

				</div> <!-- end .module-background -->

			<?php else : // if not background image then display the following ?>

				<?php if (get_sub_field('section_headline')) :?>

					<div style="background-color:<?php echo $headline_background_color;?>">

						<div class="row <?php echo $sectionRowWidthHeadline;?>">

							<div class="column">

								<?php the_sub_field('section_headline');?>

							</div> <!-- end .column -->

						</div> <!-- end .row -->

					</div> <!-- end .align-bottom $headline_background_color -->

				<?php endif; // end section_headline ?>

		<?php endif; // end background image + headline  ?>

	<?php endif; // end section_background ?>

	<?php if (get_sub_field('section_description')): ?>

		<div class="row <?php echo $sectionRowWidthDescription;?>">

			<div class="column">

				<?php echo get_sub_field('section_description'); ?>

			</div> <!-- end .column -->

		</div> <!-- end .row -->

	<?php endif;?>

<?php endif; // end add_section_header ?>
