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


<?php
	$contentSliderWidth 		= get_sub_field('slider_gallery_width');
	$contentSliderRows 			= get_sub_field('slider_gallery_rows');
	$contentSliderHeight 		= get_sub_field('slider_gallery_height');
	$gallerySliderAutoPlay 		= get_sub_field('gallery_slider_autoplay');
	$gallerySliderAutoPlaySpeed = get_sub_field('galley_slider_autoplay_speed');
	$gallerySliderColor 		= get_sub_field('gallery_slider_overlay');
?>


<?php if( get_row_layout() == 'gallery_slider_component' ): // nested layout: ?>


				<?php
 //New class names. this will only populate IF its a content component.
				  $content_slider_adjust  	= 'nested-mod-of-'.$i.'-'.$outerCounter;
				?>

				<?php // INLINE STYLES USING PHP CALLS ?>
				<style>
					/* Small only */
					@media screen and (max-width: 39.9375em) {
					    .<?php echo $content_slider_adjust ;?> {
					        max-height: calc(<?php echo $contentSliderHeight ;?>px / 1);
					    }
					    .flexslider.<?php echo $content_slider_adjust ;?>:after {
							/* background-color: rgba(0, 0, 255, 0.83); */
							background-color: <?php echo $gallerySliderColor;?>
					    }
					}

					/* Medium and up */
					@media screen and (min-width: 40em) {}

					/* Medium only */
					@media screen and (min-width: 40em) and (max-width: 63.9375em) {
					    .<?php echo $content_slider_adjust ;?> {
					        max-height: calc(<?php echo $contentSliderHeight ;?>px / 1);
					    }
					    .flexslider.<?php echo $content_slider_adjust ;?>:after {
							/* background-color: rgba(0, 0, 255, 0.83); */
							background-color: <?php echo $gallerySliderColor;?>
					    }
					}

					/* Large and up */
					@media screen and (min-width: 64em) {
					    .<?php echo $content_slider_adjust ;?> {
					        max-height: <?php echo $contentSliderHeight ;?>px; /* fallback if needed */
					        max-height: calc(<?php echo $contentSliderHeight ;?>px / 1);
					    }
					    .flexslider.<?php echo $content_slider_adjust ;?>:after {
							/* background-color: rgba(0, 0, 255, 0.83); */
							background-color: <?php echo $gallerySliderColor;?>
					    }
					}

					/* Large only */
					@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
				</style> <!-- end inline styles -->



<script>
	$(window).load(function() {

		$('.flexslider.<?php echo $content_slider_adjust ;?>').each(function(index, value) {
			if(this.id){
				var id = this.id;
				var controlId = id.replace("flexslides", "flexcontrol");

			  $('#'+id).flexslider({
				  animation: "fade", 			//slide or fade
				  //direction: "horizontal", //vertical or horizontal
				  smoothHeight: true,
				  slideshow: <?php echo $gallerySliderAutoPlay ;?>,
				  slideshowSpeed: <?php echo $gallerySliderAutoPlaySpeed ;?>,
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




				<div class="row featured-header <?php echo $contentSliderWidth; ?> <?php echo $contentSliderRows; ?>">
				<div class="column">

					<?php // Gallery //http://www.advancedcustomfields.com/resources/gallery/

						$images = get_sub_field('gallery_slider');

						if( $images ): ?>

							<section class="flexslider <?php echo $content_slider_adjust ;?>" <?php echo('id="flexslides-'.$i.'-'.$outerCounter.'" '); ?>>

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

								<ul class="custom-controls" <?php echo('id="flexcontrol-'.$i.'-'.$outerCounter.'" '); ?>>
									<?php foreach( $images as $image ): ?>
										<li><a href="#"></a></li>
									<?php endforeach; ?>
								</ul> <!-- end custom-controls -->

							</div> <!-- end .group -->

				<?php endif; ?>

			</div>
			</div> <!-- end .featured-header -->






<?php endif; ?>