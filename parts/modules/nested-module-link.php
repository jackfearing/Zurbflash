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



<?php if( get_row_layout() == 'page_link_component' ): // nested layout: ?>

	<?php
	// check if the repeater field has rows of data
	if( have_rows('page_link_module') ) : ?>


		 	<?php
		 	// loop through the rows of data
		    while ( have_rows('page_link_module') ) : the_row(); ?>

		       <?php // display a sub field value
					$pageLinkButton = get_sub_field('page_link_button');
					$pageLink = get_sub_field('page_link_url');

					// image display
					$attachment_id_page = get_sub_field('page_link_thumbnail');
					$image_thumbnail_page = wp_get_attachment_image_src( $attachment_id_page, "callout-mobile-small" );
					$image_medium_page = wp_get_attachment_image_src( $attachment_id_page, "callout-mobile-medium" );
					$image_large_page = wp_get_attachment_image_src( $attachment_id_page, "callout-desktop-large" );
					$alt_page = get_post_meta($attachment_id_page , '_wp_attachment_image_alt', true);
				?>

				<div class="gallery-section">

					<div class="gallery-list">

						<?php if (get_sub_field('page_link_thumbnail')) :?>

							<?php // display a sub field values (Using new custom field for button name display)
								echo '<a class="button-reveal" href="'.$pageLink ['url'].'" target="'.$pageLink['target'].'">';
							?>

								<img data-interchange="
								    [<?php echo $image_thumbnail_page[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $alt_page; ?>' width='<?php echo $image_thumbnail_page[1]; ?>' height='<?php echo $image_thumbnail_page[2]; ?>',
								    [<?php echo $image_medium_page[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $alt_page; ?>' width='<?php echo $image_medium_page[1]; ?>' height='<?php echo $image_medium_page[2]; ?>',
								    [<?php echo $image_large_page[0]; ?>, only screen and (min-width: 929px)] alt='<?php echo $alt_page; ?>' width='<?php echo $image_large_page[1]; ?>' height='<?php echo $image_large_page[2]; ?>'"
								    src="<?php echo $image_thumbnail_page[0]?>"
								/>

								<?php // display a sub field values (Using new custom field for button name display)
									echo '<button>'.$pageLinkButton.' &raquo;</button>';
								?>

							<?php echo '</a>';?> <!-- end page link -->

							<?php else : ?>

								<h2>NO IMAGE UPLOAD</h2>

						<?php endif; ?>

					</div> <!-- end .gallery-list -->

				</div> <!-- end .gallery-section-->

		    <?php endwhile; ?>



	<?php else : ?>

	    <?php // no rows found ?>

	<?php endif; ?>


<?php endif; ?>