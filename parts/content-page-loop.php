<div class="content-wrapper">


	<?php
	/*-------------------------------------------------------------------------------------------*/
	/* HEADER SECTION */
	/*-------------------------------------------------------------------------------------------*/
	?>

	<?php if( have_rows('module') ): // field label: ?>

		<?php $outerCounter = 0; ?>

		<?php while ( have_rows('module') ) : the_row(); // field label: ?>

	        <?php if( get_row_layout() == 'section' ): // layout: ?>


	<?php
	/*-------------------------------------------------------------------------------------------*/
	/* SECTION BACKGROUND + HEADLINE MODULE */
	/*-------------------------------------------------------------------------------------------*/
	?>
			<?php
				/* Module: Header */
				/* Template part can be used if NOT using counter */
				//get_template_part( 'parts/modules/nested', 'module-header' );
			?>

	<?php
	/*-------------------------------------------------------------------------------------------*/
	/* END SECTION BACKGROUND + HEADLINE MODULE */
	/*-------------------------------------------------------------------------------------------*/
	?>


			<?php
				$rowWidth 					= get_sub_field('section_width'); // sub field:
				$backgroundColor 			= get_sub_field('header_featured_background_color');
				$sectionBackgroundImage 	= get_sub_field('section_background_image'); // sub field:
				$attachment_id 				= get_sub_field('section_background_image');
				$image_thumbnail 			= wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
				$image_medium 				= wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
				$image_large 				= wp_get_attachment_image_src( $attachment_id, "large-desktop" );
				$image_retina 				= wp_get_attachment_image_src( $attachment_id, "retina-large" );
				$alt 						= get_post_meta($attachment_id , '_wp_attachment_image_alt', true);
			?>


		<?php if (get_sub_field('add_section_background') == 'yes') : // Radio Button Values ?>

			<?php echo '<div style="background-size: cover; background-position: center center;" class=" '.$rowWidth.' module-background align-container section-background-image group" data-interchange=" ['.$image_thumbnail[0].', only screen and (min-width: 1px)] alt='.$alt.' width='.$image_thumbnail[1].' height='.$image_thumbnail[2].', ['.$image_large[0].', only screen and (min-width: 40em)] alt='.$alt.' width='.$image_large[1].' height='.$image_large[2].', ['.$image_retina[0].', only screen and (min-width: 64em)] alt='.$alt.' width='.$image_retina[1].' height='.$image_retina[2].'">' ;?>

				<div style="background-color:<?php echo $backgroundColor ;?>;">
					<?php //echo '<h2>'.$rowWidth.'</h2>'; // echo field name ?>

		<?php elseif (get_sub_field('add_section_background') == 'no') : // Radio Button Values ?>
					<div>
					<div class="module-background <?php echo $rowWidth ;?>">
						<?php //echo '<h2>'.$rowWidth.'</h2>'; // echo field name ?>
		<?php else :?>

		<?php endif; // end header-featured ?>



		<?php
		/*-------------------------------------------------------------------------------------------*/
		/* SECTION GROUP MODULE (COMPONENTS) */
		/*-------------------------------------------------------------------------------------------*/
		?>

			<?php // Module: Section
				include(locate_template('parts/content-component-loop.php'));
			?>



		<?php
		/*-------------------------------------------------------------------------------------------*/
		/* CONDITONAL STATEMENT (BACKGROUND IMAGE + COLOR)  */
		/*-------------------------------------------------------------------------------------------*/
		?>

				<?php if (get_sub_field('section_background_image')) :?>

					</div> <! -- end !add_section_background -->

				<?php else: ?>

					</div> <!-- end !NO add_section_background -->

				<?php endif;?>

			</div> <!-- end section_background_image -->



	<?php
	/*-------------------------------------------------------------------------------------------*/
	/* NEW LAYOUT */
	/*-------------------------------------------------------------------------------------------*/
	?>

	<?php elseif( get_row_layout() == 'layout_field_name' ): // layout: ?>

		<?php if(get_sub_field('sub_field_name')){
			//echo get_sub_field('sub_field_name');
			}
		?>

		<?php endif; // end if flexible: ?>

		<?php endwhile; // end flexible: ?>

	<?php else : ?>

	<?php //CONTENT GOES HERE ?>

	<?php endif; ?>

	<?php /* End Flexable content */ ?>

	<?php wp_reset_query(); ?>





</div> <!-- end .content-wrapper -->


<?php
/*-------------------------------------------------------------------------------------------*/
/* LIGHTGALLERY SETTINGS */
/*-------------------------------------------------------------------------------------------*/
?>

	<?php // Configuration: Settings for lightgallery
		include(locate_template('parts/config-lightgallery.php'));
	?>
