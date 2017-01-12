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



<?php if( get_row_layout() == 'section_header_component' ): // nested layout: ?>

	<?php
		$sectionHeaderWidth 		= get_sub_field('section_header_width');
		$sectionHeaderRows 			= get_sub_field('section_header_rows');
		$sectionBackgroundHeight 	= get_sub_field('section_background_image_height');
		$sectionBackgroundColor		= get_sub_field('section_background_image_color');
		$sectionContentPosition 	= get_sub_field('section_header_content_position');
		$sectionContentHorPosition 	= get_sub_field('section_header_content_horizontal_position');
		$sectionContentWidth 		= get_sub_field('section_header_content_width');
		$sectionContentColor 		= get_sub_field('section_header_color');


		$attachment_id 				= get_sub_field('section_header_background');
		$image_thumbnail 			= wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
		$image_medium 				= wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
		$image_large 				= wp_get_attachment_image_src( $attachment_id, "large-desktop" );
		$image_retina 				= wp_get_attachment_image_src( $attachment_id, "retina-large" );
		$alt 						= get_post_meta($attachment_id , '_wp_attachment_image_alt', true);
	?>

	<div class="row <?php echo $sectionHeaderWidth; ?> <?php echo $sectionHeaderRows; ?>">

		<div class="large-12 columns">

			<?php if (get_sub_field('section_header_description')) :?>

				<div class="section-table-wrapper">

					<table class="section-header-component" style="min-height:<?php //echo $image_thumbnail[2] ; // default min-height of the upload image?>px; height:<?php echo $sectionBackgroundHeight ; // ACF input field override value?>px;">

						<?php // conditional statement using radio button for section header
							if (get_sub_field('add_section_background_image') =='Yes') :?>

							<tbody align="<?php echo $sectionContentHorPosition;?>" valign="<?php echo $sectionContentPosition;?>" <?php echo 'class="module-background group" data-interchange=" ['.$image_thumbnail[0].', only screen and (min-width: 1px)] alt='.$alt.' width='.$image_thumbnail[1].' height='.$image_thumbnail[2].', ['.$image_large[0].', only screen and (min-width: 40em)] alt='.$alt.' width='.$image_large[1].' height='.$image_large[2].', ['.$image_retina[0].', only screen and (min-width: 64em)] alt='.$alt.' width='.$image_retina[1].' height='.$image_retina[2].'"' ;?>>

						<?php else :?>

						<?php // if no background image ?>

							<tbody align="<?php echo $sectionContentHorPosition;?>" valign="<?php echo $sectionContentPosition;?>">

						<?php endif; ?>

						<tr style="background-color:<?php echo $sectionBackgroundColor;?>;">

							<td>

								<div style="width:<?php echo $sectionContentWidth ;?>; background-color:<?php echo $sectionContentColor; ?>">

									<?php if (get_sub_field('section_header_description')) :?>

										<?php the_sub_field('section_header_description');?>

									<?php endif; ?>

								</div> <!-- end $sectionContentWidth -->

							</td>

						</tr>
</tbody>
					</table> <!-- end table .section-header-component -->

				</div> <!-- end .section-table-wrapper -->

			<?php endif; ?>

		</div> <!-- end .columns -->

	</div> <!-- end .row -->

<?php endif; ?> <!-- end get_row_layout -->

