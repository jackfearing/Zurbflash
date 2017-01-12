<?php
/*-------------------------------------------------------------------------------------------*/
/* FLEXIBLE HEADER SECTION: FULL-WIDTH SEPERATE FROM CONTENT WRAPPER */
/*-------------------------------------------------------------------------------------------*/
?>
	<?php
		$k=0; // var used for featured image and , then zeroed out and used for the tab content.
		$outerCounterAlt=0;
	?>

	<?php if( have_rows('flexible_header') ): // field label: ?>

		<?php while ( have_rows('flexible_header') ) : the_row(); // field label: ?>

			<?php
				$headerWidthImage 			= get_sub_field('header_featured_image_width'); // sub field:
				$headerWidthGallery 		= get_sub_field('header_gallery_slider_width'); // sub field:
				$headerWidthVideo 			= get_sub_field('video_container_width'); // sub field:

				$headerHeightGalleryLarge 	= get_sub_field('header_gallery_slider_height_large'); // sub field:
				$headerHeightGalleryMedium 	= get_sub_field('header_gallery_slider_height_medium'); // sub field:
				$headerHeightGallerySmall 	= get_sub_field('header_gallery_slider_height_small'); // sub field:

				$headerWidthContent 		= get_sub_field('header_content_width'); // sub field:

				$headerRowFeatured 			= get_sub_field('header_rows_featured_image'); // sub field:
				$headerRowGallery 			= get_sub_field('header_rows_gallery'); // sub field:
				$headerRowContent 			= get_sub_field('header_rows_content'); // sub field:
				$headerRowVideo 			= get_sub_field('header_rows_video'); // sub field:

				$headerSliderAutoPlay 		= get_sub_field('header_slider_autoplay');
				$headerSliderAutoPlaySpeed 	= get_sub_field('header_slider_autoplay_speed');

				$headerVideoID 				= get_sub_field('video_id');

			?>

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* FLEXIBLE HEADER SECTION: HEADER FEATURED IMAGE */
			/*-------------------------------------------------------------------------------------------*/
			?>

				<?php if( get_row_layout() == 'header_featured_image' ): // layout: ?>

					<?php
						$image_featured 			= get_sub_field('featured_header_image');
						$image_featured_thumbnail 	= wp_get_attachment_image_src( $image_featured, "mobile-small" );
						$image_featured_medium 		= wp_get_attachment_image_src( $image_featured, "mobile-medium" );
						$image_featured_large 		= wp_get_attachment_image_src( $image_featured, "mobile-large" );
						$image_featured_alt 		= get_post_meta($image_featured , '_wp_attachment_image_alt', true);

						$imageFeaturedContentWidth 	= get_sub_field('featured_image_content_width'); // sub field:
						$imageFeaturedContent 		= get_sub_field('featured_image_content'); // sub field:

						$imageHeight 				= get_sub_field('featured_image_height'); // sub field:
						$imageFixedHeight			= get_sub_field('fixed_height_image'); // sub field:
						$imagePosition				= get_sub_field('featured_image_position'); // sub field:


					?>

					<div class="header-container module-section row <?php echo $headerWidthImage; ?> <?php echo $headerRowFeatured; ?>">

						<div class="column">

							<div class="header-featured-image featured-header">

								<?php // conditional statement using radio button for background image + headline
									if (get_sub_field('featured_image_height') =='Fixed') :?>

										<?php
											$outerCounterAlt ++;
											$inline_image_adjust  		= 'inline-image-adjust-'.$k.'-'.$outerCounterAlt;
											$min_inline_image_adjust  	= 'min-inline-image-adjust-'.$k.'-'.$outerCounterAlt;
											$featured_content_width  	= 'featured-content-width-'.$k.'-'.$outerCounterAlt;
										?>

										<?php // INLINE STYLES USING PHP CALLS ?>
										<style>
											/* Small only */
											@media screen and (max-width: 39.9375em) {
											    #<?php echo $inline_image_adjust ;?> {
											        height: calc(<?php echo $imageFixedHeight ;?>px / 3);
											        min-height: calc(<?php echo $imageFixedHeight ;?>px / 3);
											    }
											    #<?php echo $min_inline_image_adjust ;?> {
											        height: calc(<?php echo $imageFixedHeight ;?>px / 3);
											        min-height: calc(<?php echo $imageFixedHeight ;?>px / 3);
											        display: table; /* Fixes Firefox min-height */
											        width: 100%; /* Fixes Firefox min-height */
											    }
											}

											/* Medium and up */
											@media screen and (min-width: 40em) {}

											/* Medium only */
											@media screen and (min-width: 40em) and (max-width: 63.9375em) {
											   #<?php echo $inline_image_adjust ;?> {
											        height: calc(<?php echo $imageFixedHeight ;?>px / 2);
											        min-height: calc(<?php echo $imageFixedHeight ;?>px / 2);
											    }
											    #<?php echo $min_inline_image_adjust ;?> {
											        height: calc(<?php echo $imageFixedHeight ;?>px / 2);
											        min-height: calc(<?php echo $imageFixedHeight ;?>px / 2);
											        display: table; /* Fixes Firefox min-height */
											        width: 100%; /* Fixes Firefox min-height */
											    }
											}

											/* Large and up */
											@media screen and (min-width: 64em) {
											   #<?php echo $inline_image_adjust ;?> {
											        height: <?php echo $imageFixedHeight ;?>px; /* fallback if needed */
											        min-height: calc(<?php echo $imageFixedHeight ;?>px / 1);
											    }
											    #<?php echo $min_inline_image_adjust ;?> {
											        height: calc(<?php echo $imageFixedHeight ;?>px / 1); /* fallback if needed */
											        min-height: calc(<?php echo $imageFixedHeight ;?>px / 1);
											        display: table; /* Fixes Firefox min-height */
											        width: 100%; /* Fixes Firefox min-height */
											    }
											   #<?php echo $featured_content_width ;?> {
											        width: <?php echo $imageFeaturedContentWidth ;?>%; /* fallback if needed */
											        max-width: 1200px;
											    }
											}

											/* Large only */
											@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
										</style> <!-- end inline styles -->

<div id="<?php echo $min_inline_image_adjust ;?>" class="header-category-container group">
		<table id="<?php echo $min_inline_image_adjust ;?>" data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'">

			<tr>
				<td>
					<div id="<?php echo $featured_content_width;?>" class="table-cell-wrapper">
						<?php echo $imageFeaturedContent ;?>
					</div>
				</td>
			</tr>
		</table>
</div>


<!-- 										<div id="<?php echo $inline_image_adjust ;?>" class="module-background align-container group" style="background-position: <?php echo $imagePosition;?>;" data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'"></div> -->



								<?php else: ?>

									<?php
										$outerCounterAlt ++;
										$fluid_inline_image_adjust  = 'fluid-inline-image-adjust-'.$k.'-'.$outerCounterAlt;
										$featured_content_width  	= 'featured-content-width-'.$k.'-'.$outerCounterAlt;
									?>

									<?php // INLINE STYLES USING PHP CALLS ?>
									<style>
										/* Small only */
										@media screen and (max-width: 39.9375em) {
										   #<?php echo $fluid_inline_image_adjust ;?> {
										        height: calc(<?php echo $image_featured_large[2] ;?>px / 3);
										        min-height: calc(<?php echo $image_featured_large[2] ;?>px / 3);
										        display: table; /* Fixes Firefox min-height */
										        width: 100%; /* Fixes Firefox min-height */
										    }
										}

										/* Medium and up */
										@media screen and (min-width: 40em) {}

										/* Medium only */
										@media screen and (min-width: 40em) and (max-width: 63.9375em) {
										   #<?php echo $fluid_inline_image_adjust ;?> {
										        height: calc(<?php echo $image_featured_large[2] ;?>px / 2);
										        min-height: calc(<?php echo $image_featured_large[2] ;?>px / 2);
										        display: table; /* Fixes Firefox min-height */
										        width: 100%; /* Fixes Firefox min-height */
										    }
										}

										/* Large and up */
										@media screen and (min-width: 64em) {
										   #<?php echo $fluid_inline_image_adjust ;?> {
										        height: <?php echo $image_featured_large[2] ;?>px; /* fallback if needed */
										        min-height: calc(<?php echo $image_featured_large[2] ;?>px / 1);
										        display: table; /* Fixes Firefox min-height */
										        width: 100%; /* Fixes Firefox min-height */
										    }
										   #<?php echo $featured_content_width ;?> {
										        width: <?php echo $imageFeaturedContentWidth ;?>%; /* fallback if needed */
										        max-width: 1200px;
										    }
										}

										/* Large only */
										@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
									</style> <!-- end inline styles -->



									<!-- <img data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'"/> -->

									<div id="<?php echo $fluid_inline_image_adjust ;?>" class="header-category-container group">
											<table id="<?php echo $fluid_inline_image_adjust ;?>" data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'">

												<tr>
													<td>
														<div id="<?php echo $featured_content_width;?>" class="table-cell-wrapper">
															<?php echo $imageFeaturedContent ;?>
														</div>
													</td>
												</tr>
											</table>
									</div>

								<?php endif ;?>

							</div> <!-- end .header-featured-image -->

						</div> <!-- end .column -->

					</div> <!-- end .module-section row -->

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* END - FLEXIBLE HEADER SECTION: HEADER FEATURED IMAGE */
			/*-------------------------------------------------------------------------------------------*/
			?>

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* FLEXIBLE HEADER SECTION: HEADER GALLERY SLIDER */
			/*-------------------------------------------------------------------------------------------*/
			?>

				<?php elseif( get_row_layout() == 'header_gallery_slider' ): // layout: ?>

					<?php
						$outerCounterAlt ++;
						$inline_slider_adjust  	= 'inline-slider-adjust-'.$k.'-'.$outerCounterAlt.'-'.$k;
						$flexsliderOverlay 		= get_sub_field('header_slider_overlay');
					?>

					<?php // INLINE STYLES USING PHP CALLS ?>
					<style>
						/* Small only */
						@media screen and (max-width: 39.9375em) {
						    .<?php echo $inline_slider_adjust ;?> {
								/* height: calc(<?php echo $headerHeightGalleryLarge ;?>px / 3); */
								/* min-height: calc(<?php echo $headerHeightGalleryLarge ;?>px / 1); */
							    height: calc(<?php echo $headerHeightGallerySmall ;?>px);
						        min-height: calc(<?php echo $headerHeightGallerySmall ;?>px);

						    }
						    .flexslider.<?php echo $inline_slider_adjust ;?>:after {
								/* background-color: rgba(0, 0, 255, 0.83); */
								background-color: <?php //echo $flexsliderOverlay;?>
						    }
						    .flexslider-bg.<?php echo $inline_slider_adjust ;?> {
								background-color: <?php echo $flexsliderOverlay;?>
						    }
						}

						/* Medium and up */
						@media screen and (min-width: 40em) {}

						/* Medium only */
						@media screen and (min-width: 40em) and (max-width: 63.9375em) {
						    .<?php echo $inline_slider_adjust ;?> {
								/* height: calc(<?php echo $headerHeightGalleryMedium ;?>px / 2); */
								/* min-height: calc(<?php echo $headerHeightGalleryMedium ;?>px / 2); */
							    height: calc(<?php echo $headerHeightGalleryMedium ;?>px);
						        min-height: calc(<?php echo $headerHeightGalleryMedium ;?>px);

						    }
						    .flexslider.<?php echo $inline_slider_adjust ;?>:after {
								/* background-color: rgba(0, 0, 255, 0.83); */
								background-color: <?php //echo $flexsliderOverlay;?>
						    }
						    .flexslider-bg.<?php echo $inline_slider_adjust ;?> {
								background-color: <?php echo $flexsliderOverlay;?>
						    }
						}

						/* Large and up */
						@media screen and (min-width: 64em) {
						    .<?php echo $inline_slider_adjust ;?> {
							    height: <?php echo $headerHeightGalleryLarge ;?>px; /* fallback if needed */
						        min-height: <?php echo $headerHeightGalleryLarge ;?>px; /* fallback if needed */
						        min-height: calc(<?php echo $headerHeightGalleryLarge ;?>px / 1);
						    }
						    .flexslider.<?php echo $inline_slider_adjust ;?>:after {
								/* background-color: rgba(0, 0, 255, 0.83); */
								background-color: <?php //echo $flexsliderOverlay;?>
						    }
						    .flexslider-bg.<?php echo $inline_slider_adjust ;?> {
								background-color: <?php echo $flexsliderOverlay;?>
						    }

						}

						/* Large only */
						@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
					</style> <!-- end inline styles -->

<script>
	$(window).load(function() {

		$('.flexslider.<?php echo $inline_slider_adjust ;?>').each(function(index, value) {
			if(this.id){
				var id = this.id;
				var controlId = id.replace("flexslides", "flexcontrol");

			  $('#'+id).flexslider({
				  animation: "fade", 			//slide or fade
				  //direction: "horizontal", //vertical or horizontal
				  smoothHeight: true,
				  slideshow: <?php echo $headerSliderAutoPlay ;?>,
				  slideshowSpeed: <?php echo $headerSliderAutoPlaySpeed ;?>,
				  //animationSpeed: 10000,
				  pauseOnHover: true,
				  randomize: false,
				  controlNav: true,
				  touch: true,
				  manualControls: '.custom-controls#'+controlId+' li a', // Turn on when using fade and smooth height
				  controlsContainer: '.flex-container', // Turn on when using fade and smooth height
				  prevText: "",    	  //String: Set the text for the "previous" directionNav item
				  nextText: "",        //String: Set the text for the "next" directionNav item
				  start: function(slider) {
					  $('body').removeClass('loading');
				  }
			  });
			};

		});

	}); // end flexslider
</script>



					<div class="header-container module-section row <?php echo $headerWidthGallery; ?> <?php echo $headerRowGallery; ?>">

						<div class="column">

							<div class="featured-header">

								<?php // Gallery //http://www.advancedcustomfields.com/resources/gallery/

									$images = get_sub_field('header_gallery_slider');

									if( $images ): ?>

										<section class="flexslider <?php echo $inline_slider_adjust ;?>" <?php echo('id="flexslides-'.$k.'-'.$outerCounterAlt.'-'.$k.'" '); ?>  >



<!-- <section class="flexslider inline-image-adjust" <?php echo('id="flexslides-a" '); ?> style="height:<?php echo $headerHeightGallery; ?>px;"> -->

											<ul class="slides">

												<?php foreach( $images as $image ): ?>


													<li>




<div class="header-category-container group">
		<table id="<?php echo $inline_slider_adjust ;?>" data-interchange="[<?php echo $image['sizes']['large-desktop']; ?>, default] alt=<?php echo $image['alt'];?> width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['mobile-small']; ?>, small] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['mobile-medium']; ?>, medium] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['retina-large']; ?>, large] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>"src="<?php echo $image['sizes']['large-desktop']; ?>">

			<tr>
				<td class="flexslider-bg <?php echo $inline_slider_adjust ;?>">
					<div style="width: 80%;" class="table-cell-wrapper">
							<p><?php echo $image['title'];?><p>
							<p><?php echo $image['alt'];?></p>
							<p><?php echo $image['caption'];?></p>
							<p><?php echo $image['description'];?></p>
					</div>
				</td>
			</tr>
		</table>
</div>


<!--
<div class="flexslider-content" style="height: 550px;">
<div class="parent">
  <div class="child both">
	<p><?php echo $image['title'];?><p>
	<p><?php echo $image['alt'];?></p>
	<p><?php echo $image['caption'];?></p>
	<p><?php echo $image['description'];?></p>
  </div>
</div>
</div>
-->






<!-- 														<img data-interchange="[<?php echo $image['sizes']['large-desktop']; ?>, default] alt=<?php echo $image['alt'];?> width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['mobile-small']; ?>, small] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['mobile-medium']; ?>, medium] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>,[<?php echo $image['sizes']['retina-large']; ?>, large] width=<?php echo $image['width'];?> height=<?php echo $image['height'];?>"src="<?php echo $image['sizes']['large-desktop']; ?>"/> -->











													</li>
												<?php endforeach; ?>

											</ul> <!-- end slides -->

										</section> <!-- end flexslider -->

										<div class="group">

											<ul class="custom-controls" <?php echo('id="flexcontrol-'.$k.'-'.$outerCounterAlt.'-'.$k.'" '); ?>>

<!-- <ul class="custom-controls" <?php echo('id="flexcontrol-a" '); ?>> -->
												<?php foreach( $images as $image ): ?>
													<li><a href="#"></a></li>
												<?php endforeach; ?>
											</ul> <!-- end custom-controls -->

										</div> <!-- end .group -->

								<?php endif; // end images ?>

							</div> <!-- end .featured-header -->

						</div> <!-- end .column -->

					</div> <!-- end .module-section row -->

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* END - FLEXIBLE HEADER SECTION: HEADER GALLERY SLIDER */
			/*-------------------------------------------------------------------------------------------*/
			?>

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* FLEXIBLE HEADER SECTION: HEADER CONTENT */
			/*-------------------------------------------------------------------------------------------*/
			?>

				<?php elseif( get_row_layout() == 'header_content' ): // layout: ?>

<!-- 					<h1>Field Name=<?php echo get_sub_field('header_content_width');?></h1> -->

					<div class="header-container module-section row <?php echo $headerWidthContent; ?> <?php echo $headerRowContent; ?>">

						<div class="column">

							<?php if(get_sub_field('header_content')) : ?>

								<div class="header-content">

									<?php the_sub_field('header_content'); ?>

								</div> <!-- end .header-content -->

							<?php endif; ?>

						</div> <!-- end .column -->

					</div> <!-- end .module-section row -->

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* END - FLEXIBLE HEADER SECTION: HEADER CONTENT */
			/*-------------------------------------------------------------------------------------------*/
			?>


			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* FLEXIBLE HEADER SECTION: VIDEO BACKGROUND */
			/*-------------------------------------------------------------------------------------------*/
			?>

				<?php elseif( get_row_layout() == 'header_video_background' ): // layout: ?>

					<div class="header-container module-section row <?php echo $headerWidthVideo; ?> <?php echo $headerRowVideo; ?>">

						<div class="column">

							<div class="youtube-video-wrapper">

								<?php // conditional statement using radio button for background Video and TEXT
									if (get_sub_field('video_content')) :?>


										<?php
											$outerCounterAlt ++;
											$inline_video_adjust  		= 'inline-video-adjust-'.$k.'-'.$outerCounterAlt.'-'.$k.'-'.$k;
											$inline_video_width  		= 'inline-video-width-'.$k.'-'.$outerCounterAlt.'-'.$k.'-'.$k;
											$videoFixedHeight 			= get_sub_field('video_header_height'); // sub field:
											$videoBGColor 				= get_sub_field('video_background_color'); // sub field:
											$videoOverlayColor 			= get_sub_field('video_overlay_color');
											$videoContent 				= get_sub_field('video_content');
											$videoPattern				= get_sub_field('video_pattern');
											$videoHeaderContentWidth  	= get_sub_field('video_header_content_width');
											$videoAlign 				= get_sub_field('video_header_align');

											$videoStart 				= get_sub_field('video_start');
											$videoEnd  					= get_sub_field('video_end');


											$attachment_id_video 		= get_sub_field('video_background_image');
											$image_thumbnail_video 		= wp_get_attachment_image_src( $attachment_id_video, "mobile-small" );
											$image_medium_video 		= wp_get_attachment_image_src( $attachment_id_video, "mobile-small" );
											$image_large_video 			= wp_get_attachment_image_src( $attachment_id_video, "large-desktop" );
											$image_retina_video 		= wp_get_attachment_image_src( $attachment_id_video, "retina-large" );
											$alt_video 					= get_post_meta($attachment_id_video , '_wp_attachment_image_alt', true);
										?>


										<?php // INLINE STYLES USING PHP CALLS ?>
										<style>
											/* Small only */
											@media screen and (max-width: 39.9375em) {
											    #<?php echo $inline_video_adjust ;?> {
											        height: calc(<?php echo $videoFixedHeight ;?>px / 3);
											        width: 90%;
											        margin: 0 auto;
											    }
											}

											/* Medium and up */
											@media screen and (min-width: 40em) {}

											/* Medium only */
											@media screen and (min-width: 40em) and (max-width: 63.9375em) {
											   #<?php echo $inline_video_adjust ;?> {
											        height: calc(<?php echo $videoFixedHeight ;?>px / 2) !important;
											        width: 80%;
											        margin: 0 auto;
											    }
											}

											/* Large and up */
											@media screen and (min-width: 64em) {
											  #<?php echo $inline_video_adjust ;?> {
											        height: calc(<?php echo $videoFixedHeight ;?>px / 1);
											    }
											  #<?php echo $inline_video_width ;?> {
													width: <?php echo $videoHeaderContentWidth ;?>%;
											        margin: 0 auto;
											    }
											}

											/* Large only */
											@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
										</style> <!-- end inline styles -->




										<div class="video-wrapper <?php echo $inline_video_adjust ;?>" data-video-id="<?php echo $headerVideoID ;?>" data-video-youtube-link="n" data-video-start="<?php echo get_sub_field('video_start') ;?>" data-video-end="<?php echo get_sub_field('video_end');?>" data-video-width-add="100" data-video-height-add="100" style="margin:0; background-position: center center; background-repeat: no-repeat; background-size: cover;" <?php echo 'data-interchange=" ['.$image_thumbnail_video[0].', only screen and (min-width: 1px)] alt='.$alt_video.' width='.$image_thumbnail_video[1].' height='.$image_thumbnail_video[2].', ['.$image_large_video[0].', only screen and (min-width: 40em)] alt='.$alt_video.' width='.$image_large_video[1].' height='.$image_large_video[2].', ['.$image_retina_video[0].', only screen and (min-width: 64em)] alt='.$alt_video.' width='.$image_retina_video[1].' height='.$image_retina_video[2].'"' ;?>>
											<div class="video-overlay <?php echo $videoPattern; ?>" style="background-color:<?php echo $videoOverlayColor;?>;"></div> <!-- end .video-overlay -->
											<div class="tv">
												<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
												<div id="player-<?php echo $inline_video_adjust ;?>" class="screen" style="<?php echo $videoAlign;?>"></div> <!-- end .player -->
											</div> <!-- end .tv -->

											  <table id="<?php echo $inline_video_adjust ;?>" style="position:relative;">
												<tr>
													<td>

													<div id="<?php echo $inline_video_width ;?>"><?php echo $videoContent;?></div>

												</td>
												</tr>
											</table>

										</div> <!-- end .video-wrapper -->







								<?php else: ?>


										<?php
											$outerCounterAlt ++;
											$inline_video_adjust  		= 'inline-video-adjust-'.$k.'-'.$outerCounterAlt.'-'.$k.'-'.$k;
											$inline_video_width  		= 'inline-video-width-'.$k.'-'.$outerCounterAlt.'-'.$k.'-'.$k;
											$videoFixedHeight 			= get_sub_field('video_header_height'); // sub field:
											$videoBGColor 				= get_sub_field('video_background_color'); // sub field:
											$videoOverlayColor 			= get_sub_field('video_overlay_color');
											$videoContent 				= get_sub_field('video_content');
											$videoPattern				= get_sub_field('video_pattern');
											$videoHeaderContentWidth  	= get_sub_field('video_header_content_width');
											$videoAlign 				= get_sub_field('video_header_align');

											$attachment_id_video 		= get_sub_field('video_background_image');
											$image_thumbnail_video 		= wp_get_attachment_image_src( $attachment_id_video, "mobile-small" );
											$image_medium_video 		= wp_get_attachment_image_src( $attachment_id_video, "mobile-small" );
											$image_large_video 			= wp_get_attachment_image_src( $attachment_id_video, "large-desktop" );
											$image_retina_video 		= wp_get_attachment_image_src( $attachment_id_video, "retina-large" );
											$alt_video 					= get_post_meta($attachment_id_video , '_wp_attachment_image_alt', true);
										?>

										<?php // INLINE STYLES USING PHP CALLS ?>
										<style>
											/* Small only */
											@media screen and (max-width: 39.9375em) {
											    .<?php echo $inline_video_adjust ;?> {
											        height: calc(<?php echo $videoFixedHeight ;?>px / 3);
											        width: 90%;
											        margin: 0 auto;
											    }
											}

											/* Medium and up */
											@media screen and (min-width: 40em) {}

											/* Medium only */
											@media screen and (min-width: 40em) and (max-width: 63.9375em) {
											   .<?php echo $inline_video_adjust ;?> {
											        height: calc(<?php echo $videoFixedHeight ;?>px / 2);
											        width: 80%;
											        margin: 0 auto;
											    }
											}

											/* Large and up */
											@media screen and (min-width: 64em) {
											  .<?php echo $inline_video_adjust ;?> {
											        height: <?php echo $videoFixedHeight ;?>px; /* fallback if needed */
											        height: calc(<?php echo $videoFixedHeight ;?>px / 1);
											    }
											}

											/* Large only */
											@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
										</style> <!-- end inline styles -->




										<!-- <h2>NEW NO VIDEO CONTENT</h2> -->
										<div class="video-wrapper <?php echo $inline_video_adjust ;?>" data-video-id="<?php echo $headerVideoID ;?>" data-video-youtube-link="n" data-video-start="<?php echo get_sub_field('video_start') ;?>" data-video-end="<?php echo get_sub_field('video_end') ;?>" data-video-width-add="100" data-video-height-add="100" style="margin:0; background-position: center center; background-repeat: no-repeat; background-size: cover;" <?php echo 'data-interchange=" ['.$image_thumbnail_video[0].', only screen and (min-width: 1px)] alt='.$alt_video.' width='.$image_thumbnail_video[1].' height='.$image_thumbnail_video[2].', ['.$image_large_video[0].', only screen and (min-width: 40em)] alt='.$alt_video.' width='.$image_large_video[1].' height='.$image_large_video[2].', ['.$image_retina_video[0].', only screen and (min-width: 64em)] alt='.$alt_video.' width='.$image_retina_video[1].' height='.$image_retina_video[2].'"' ;?>>
											<div class="video-overlay <?php echo $videoPattern; ?>" style="background-color:<?php echo $videoOverlayColor;?>"></div> <!-- end .video-overlay -->
											<div class="tv">
												<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
												<div id="player-<?php echo $inline_video_adjust ;?>" class="screen" style="<?php echo $videoAlign;?>"></div> <!-- end .player -->
											</div> <!-- end .tv -->
										</div> <!-- end .video-wrapper -->

								<?php endif ;?>

							</div> <!-- end .youtube-video-wrapper -->

						</div> <!-- end .column -->

					</div> <!-- end .module-section row -->

			<?php
			/*-------------------------------------------------------------------------------------------*/
			/* END - FLEXIBLE HEADER SECTION: VIDEO BACKGROUND */
			/*-------------------------------------------------------------------------------------------*/
			?>





				<?php endif; //end get_row_layout (first layout in chain) ?>

		<?php endwhile; // endwhile flexible_header ?>

		<?php else : ?>

		<?php //echo '<h2>CONTENT GOES HERE</h2>' ;?>

	<?php endif; // endif flexible_header ?>

<?php
/*-------------------------------------------------------------------------------------------*/
/* END - FLEXIBLE HEADER SECTION: FULL-WIDTH SEPERATE FROM CONTENT WRAPPER */
/*-------------------------------------------------------------------------------------------*/
?>

