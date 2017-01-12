<?php
/*
Template Name: Modules (Sidebar)
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




	<?php
		$sidebar = get_field('sidebar_select');
		$rowWidthTabs = get_field('page_section_width'); // sub field:
	?>

		<?php if( have_rows($sidebar, 'options') ): // field: Flexible ?>

			<?php echo '<strong class="highlight">SIDEBAR - ACTIVE</strong>';?>

			<?php while ( have_rows($sidebar, 'options') ) : the_row(); // field: Flexible ?>

			<?php endwhile; ?>

			<div class="module-section row <?php echo $rowWidthTabs; ?>">

				<div class="large-8 columns">

					<?php include(locate_template('parts/content-module-loop.php')); ?>

				</div> <!-- end .columns -->

					<?php include(locate_template('sidebar-acf.php')); // columns assigned within sidebar ?>

			</div> <!-- end .module-section .row $rowWidthTabs -->

			<?php else : ?>
			<!-- This content shows up if there are no sidebars defined in the backend. -->

			<?php echo '<strong class="highlight">NO SIDEBAR SELECTED</strong>';?>

			<div class="module-section row <?php echo $rowWidthTabs; ?>">

				<div class="large-12 columns">

					<?php include(locate_template('parts/content-module-loop.php')); ?>

				</div> <!-- end .columns -->

			</div> <!-- end .module-section .row $rowWidthTabs -->

		<?php endif; ?>









<?php get_footer(); ?>
