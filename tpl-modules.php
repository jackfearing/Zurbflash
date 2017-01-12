<?php
/*
Template Name: Modules
*/
?>

<?php get_header(); ?>

<?php //get_template_part( 'parts/content', 'flexslider' ); ?>



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




















<div class="row headlines">

	<div class="column">

		<?php if(get_field('main_headline')){
			echo '<h1>'. get_field('main_headline') .'</h1>';
			}
		?>

		<?php if(get_field('main_description')){
			echo '<div>'. get_field('main_description') .'</div>';
			}
		?>

	</div> <!-- end .column -->

</div> <!-- end .row -->

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

					<div class="row">

						<?php $myPostID = $relationship->ID; // this will be used to aid in triggering the right content for each post. Meaning, It will help determine which gallery to open ?>

						<div class="large-12 columns">

							<?php  the_content(); ?>

<?php
/*-------------------------------------------------------------------------------------------*/
/* NEW LAYOUT */
/*-------------------------------------------------------------------------------------------*/
?>
							<?php if( have_rows('module') ): // field label: ?>

								<?php $outerCounter = 0; ?>

								<?php while ( have_rows('module') ) : the_row(); // field label: ?>

							        <?php if( get_row_layout() == 'section' ): // layout: ?>

									<div class="section-container">

									<?php
										/* Module: Header */
										/* Template part can be used if NOT using counter */
										get_template_part( 'parts/modules/nested', 'module-header' );
									?>

									<?php if( have_rows('section_group') ): // nested field label: ?>


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


									<?php endif; // end if nested flexible: ?>

									</div> <!-- end .section-container -->
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

							<?php edit_post_link('Edit this section','<p class="button radius">','</p>'); ?>

							<?php /* End Flexable content */ ?>

							<?php wp_reset_query(); ?>

						</div> <!-- .columns -->

					</div><!-- .row -->

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

	<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 columns" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php //get_template_part( 'parts/loop', 'page' ); ?>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		    <?php //get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->



<?php get_footer(); ?>
