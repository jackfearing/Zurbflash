<?php
/*
Template Name: Modules (Full Width - Single)
*/
?>

<?php get_header(); ?>


<?php
/*-------------------------------------------------------------------------------------------*/
/* FLEXIBLE HEADER SECTION: FULL-WIDTH SEPERATE FROM CONTENT WRAPPER */
/*-------------------------------------------------------------------------------------------*/
?>



	<?php if( have_rows('flexible_header') ): // field label: ?>

		<?php while ( have_rows('flexible_header') ) : the_row(); // field label: ?>



<?php
	$headerWidthImage = get_sub_field('header_featured_image_width'); // sub field:
	$headerWidthGallery = get_sub_field('header_gallery_slider_width'); // sub field:
	$headerWidthContent = get_sub_field('header_content_width'); // sub field:
?>



			<?php if( get_row_layout() == 'header_featured_image' ): // layout: ?>

				<?php
					$image_featured = get_sub_field('featured_header_image');
					$image_featured_thumbnail = wp_get_attachment_image_src( $image_featured, "full" );
					$image_featured_medium = wp_get_attachment_image_src( $image_featured, "full" );
					$image_featured_large = wp_get_attachment_image_src( $image_featured, "full" );
					$image_featured_alt = get_post_meta($image_featured , '_wp_attachment_image_alt', true);
				?>

<h1>Field Name=<?php echo get_sub_field('header_featured_image_width');?></h1>
<div class="module-section row <?php echo $headerWidthImage; ?>">
<div class="column">

				<div class="header-featured-image featured-header">

					<img data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'"/>

				</div> <!-- end header-featured-image -->
</div>
</div>


			<?php elseif( get_row_layout() == 'header_gallery_slider' ): // layout: ?>


<h1>Field Name=<?php echo get_sub_field('header_gallery_slider_width');?></h1>
<div class="module-section row <?php echo $headerWidthGallery; ?>">
<div class="column">

				<div class="featured-header">

					<?php // Gallery //http://www.advancedcustomfields.com/resources/gallery/

						$images = get_sub_field('header_gallery_slider');

						if( $images ): ?>

							<section class="flexslider" <?php echo('id="flexslides-a" '); ?>>

								<ul class="slides">

									<?php foreach( $images as $image ): ?>
										<li>
											<img data-interchange="[<?php echo $image['sizes']['large-desktop']; ?>, default] alt=<?php echo $image['alt'];?> width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['mobile-small']; ?>, small] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['mobile-medium']; ?>, medium] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['retina-large']; ?>, large] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>"src="<?php echo $image['sizes']['large-desktop']; ?>"
											/>
										</li>
									<?php endforeach; ?>

								</ul> <!-- end slides -->

							</section> <!-- end flexslider -->

							<div class="group">

								<ul class="custom-controls" <?php echo('id="flexcontrol-a" '); ?>>
									<?php foreach( $images as $image ): ?>
										<li><a href="#"></a></li>
									<?php endforeach; ?>
								</ul> <!-- end custom-controls -->

							</div> <!-- end .group -->

				<?php endif; ?>

			</div> <!-- end .featured-header -->
</div>
</div>


			<?php elseif( get_row_layout() == 'header_content' ): // layout: ?>
<h1>Field Name=<?php echo get_sub_field('header_content_width');?></h1>
<div class="module-section row <?php echo $headerWidthContent; ?>">
<div class="column">
				<?php if(get_sub_field('header_content')) : ?>
					<div class="header-content">
						<?php the_sub_field('header_content'); ?>
					</div> <!-- end .header-content -->
				<?php endif; ?>
</div>
</div>




			<?php endif; // end if flexible: ?>

		<?php endwhile; // end flexible: ?>


		<?php else : ?>

			<?php //echo '<h2>CONTENT GOES HERE</h2>' ;?>

		<?php endif; ?>


<?php
/*-------------------------------------------------------------------------------------------*/
/* FLEXIBLE HEADER SECTION: !END */
/*-------------------------------------------------------------------------------------------*/
?>











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

				<div class="content-wrapper">



<?php
/*-------------------------------------------------------------------------------------------*/
/* NEW LAYOUT */
/*-------------------------------------------------------------------------------------------*/
?>

							<?php if( have_rows('module') ): // field label: ?>

								<?php $outerCounter = 0; ?>

								<?php while ( have_rows('module') ) : the_row(); // field label: ?>

							        <?php if( get_row_layout() == 'section' ): // layout: ?>

									<?php
										/* Module: Header */
										/* Template part can be used if NOT using counter */
										get_template_part( 'parts/modules/nested', 'module-header' );
									?>



									<?php
										$radioButton = get_sub_field('section_header_module'); // sub field:
										$rowWidth = get_sub_field('section_width'); // sub field:

										// Used for header-featured field (background-image and background-color)
										$backgroundColor = get_sub_field('header_featured_background_color');
										$attachment_id = get_sub_field('header_featured_background_image');
										$image_thumbnail = wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
										$image_medium = wp_get_attachment_image_src( $attachment_id, "mobile-medium" );
										$image_large = wp_get_attachment_image_src( $attachment_id, "large-desktop" );
										$image_retina = wp_get_attachment_image_src( $attachment_id, "retina-large" );
										$alt = get_post_meta($attachment_id , '_wp_attachment_image_alt', true);
									?>

								<?php // conditional statement using radio button for section header
									if (get_sub_field('section_header_module') =='header-featured') :?>


									<?php echo '<div style="background-color:pink;" class="',$radioButton,' module-background align-container group" data-interchange=" ['.$image_thumbnail[0].', only screen and (min-width: 1px)] alt='.$alt.' width='.$image_thumbnail[1].' height='.$image_thumbnail[2].', ['.$image_large[0].', only screen and (min-width: 40em)] alt='.$alt.' width='.$image_large[1].' height='.$image_large[2].', ['.$image_retina[0].', only screen and (min-width: 64em)] alt='.$alt.' width='.$image_retina[1].' height='.$image_retina[2].'">' ;?>

										<?php echo '<h2>'.$radioButton.'</h2>'; // echo field name ?>

									<?php elseif (get_sub_field('section_header_module') =='header-section') :?>


										<div class="<?php echo $radioButton; ?>">

											<?php echo '<h2>'.$radioButton.'</h2>'; // echo field name ?>

									<?php elseif (get_sub_field('section_header_module') =='header-none') :?>


										<div class="<?php echo $radioButton; ?>">

											<?php echo '<h2>'.$radioButton.'</h2>'; // echo field name ?>

									<?php else :?>

									<?php // CONTENT GOES HERE ?>

								<?php endif; // end header-featured ?>




										<?php if (get_sub_field('section_width')) :?>

											<div class="row <?php echo $rowWidth; ?>">

												<div class="large-12 columns">

													<?php echo $rowWidth; ?>

													<?php // Module: Section
														include(locate_template('parts/modules/nested-module-section-header.php'));
													?>

												</div> <?php // end .columns ?>

											</div> <?php // end .row ?>

											<?php else : ?>

												<?php echo $rowWidth; ?>

										<?php endif;?>





									<?php if( have_rows('section_group') ): // nested field label: ?>

<div class="row <?php echo $rowWidth; ?>">
<div class="large-12 columns">

										<div class="gallery-container">

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

												<?php // Module: Link
													include(locate_template('parts/modules/nested-module-gallery-slider.php'));
												?>

											<?php endwhile; // end nested flexible: ?>

										</div> <!-- end .gallery-container -->
</div>
</div>

									<?php endif; // end if nested flexible: ?>

	</div> <!-- end Section Header Module -->


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





<?php get_footer(); ?>
