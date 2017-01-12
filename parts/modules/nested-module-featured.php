<?php
/*
//////////////////////////////////
NESTED MODULE 01

Variables that need to be set in a different page IF you are not using TABS
$i : originally for TAB id's
$outerCounter : with tabs, this handles the counting of each module in each tabbed area.
$galleryJSCode : this is the JS code that is needed to activate and store the desired modal window code.
//////////////////////////////////
*/
?>



<?php if( get_row_layout() == 'content_featured_component' ): // nested layout: ?>

<?php //if (get_sub_field('content_featured_background')) :?>

	<?php
		$contentContainerWidth = get_sub_field('content_container_width');
		$contentContainerRows = get_sub_field('content_container_rows');
		$contentContainerColor = get_sub_field('content_container_background_color');

		$attachment_id = get_sub_field('content_featured_background');
		$image_thumbnail = wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
		$image_medium = wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
		$image_large = wp_get_attachment_image_src( $attachment_id, "large-desktop" );
		$image_retina = wp_get_attachment_image_src( $attachment_id, "retina-large" );
		$alt = get_post_meta($attachment_id , '_wp_attachment_image_alt', true);
	?>

	<div class="row <?php echo $contentContainerWidth; ?> <?php echo $contentContainerRows; ?>">

		<div class="large-12 columns">

			<?php // conditional statement using radio button for background image + headline
				if (get_sub_field('add_content_background_image') =='Yes') :?>

					<?php echo '<div class="module-background align-container group" data-interchange=" ['.$image_thumbnail[0].', only screen and (min-width: 1px)] alt='.$alt.' width='.$image_thumbnail[1].' height='.$image_thumbnail[2].', ['.$image_large[0].', only screen and (min-width: 40em)] alt='.$alt.' width='.$image_large[1].' height='.$image_large[2].', ['.$image_retina[0].', only screen and (min-width: 64em)] alt='.$alt.' width='.$image_retina[1].' height='.$image_retina[2].'">' ;?>

				<?php else :?>

					<div class="module-background align-container group">

				<?php endif; //end add_content_background_image ?>

				<div style="background-color:<?php echo $contentContainerColor ;?>;">

						<div class="module-wrapper">

						<?php if (get_sub_field('content_container') == '1/1') : // Radio Button Values ?>

								<?php the_sub_field('column_left_01'); ?>

							<?php elseif (get_sub_field('content_container') == '1/2') : // Radio Button Values?>

								<div class="row">

									<div class="medium-6 columns">
										<?php the_sub_field('column_left_01'); ?>
									</div> <!-- end .columns -->

									<div class="medium-6 columns">
										<?php the_sub_field('column_right_01'); ?>
									</div> <!-- end .columns -->

								</div> <!-- end .row -->

							<?php elseif (get_sub_field('content_container') == '2/3') : // Radio Button Values?>

								<div class="row">

									<div class="large-8 columns">
										<?php the_sub_field('column_left_01'); ?>
									</div> <!-- end .columns -->

									<div class="large-4 columns">
										<?php the_sub_field('column_right_01'); ?>
									</div> <!-- end .columns -->

								</div> <!-- end .row -->

							<?php elseif (get_sub_field('content_container') == '3/2') : // Radio Button Values?>

								<div class="row">

									<div class="large-4 columns">
										<?php the_sub_field('column_left_01'); ?>
									</div> <!-- end .columns -->

									<div class="large-8 columns">
										<?php the_sub_field('column_right_01'); ?>
									</div> <!-- end .columns -->

								</div> <!-- end .row -->

							<?php elseif (get_sub_field('content_container') == '1/3') : // Radio Button Values?>

								<div class="row">

									<div class="large-4 columns">
										<?php the_sub_field('column_left_01'); ?>
									</div> <!-- end .columns -->

									<div class="large-4 columns">
										<?php the_sub_field('column_middle_01'); ?>
									</div> <!-- end .columns -->

									<div class="large-4 columns">
										<?php the_sub_field('column_right_01'); ?>
									</div> <!-- end .columns -->

								</div> <!-- end .row -->

						<?php endif; //end content_container ?>

						</div> <!-- end .module-wrapper -->

					</div> <!-- end .background-color -->

				</div> <!-- end .module-background -->

			</div> <!-- end .columns -->

		</div> <!-- end .row -->

	<?php else : ?>

	<?php //endif; ?>

<?php endif; //end content_featured_component ?>