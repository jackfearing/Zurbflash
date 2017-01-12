<?php
/*
//////////////////////////////////
NESTED MODULE PHOTO

Variables that need to be set in a different page IF you are not using TABS
$i : originally for TAB id's
$outerCounter : with tabs, this handles the counting of each module in each tabbed area.
$galleryJSCode : this is the JS code that is needed to activate and store the desired modal window code.
//////////////////////////////////
*/ ?>




<?php if( get_row_layout() == 'photo_gallery_component' ): // nested layout:

	$button_or_thumbnails 	= get_sub_field('button_or_thumbnail_modal_trigger'); // New ACF to determine if we use thumbnails or a button
	$photoGalleryWidth 		= get_sub_field('photo_gallery_width');
	$photoGalleryRows 		= get_sub_field('photo_gallery_rows');
	$photo_gallery_title 	= get_sub_field('photo_gallery_title'); // New Label
	$photoGallerySmall 		= get_sub_field('small_thumbnail_display');
	$photoGalleryMedium 	= get_sub_field('medium_thumbnail_display');
	$photoGalleryLarge 		= get_sub_field('large_thumbnail_display');
	$photoBalancer 			= get_sub_field('photo_balancer');

	$addAnimationPhoto		= get_sub_field('add_animation_photo');
	$animationEffectPhoto	= get_sub_field('animation_effect_photo');
	$animationEffectOffset 	= 'data-aos-offset="300"';
	$animationEffectDelay 	= 'data-aos-delay="300"';
?>


<?php
/*
//////////////////////////////////
CHANGE HOVER EFFECT

Hover effects are created using CODROPS Hover Effects Ideas
http://tympanus.net/codrops/?p=19292

The css for the below effects have already been modified to work with this new setup.
Remember to update the css file if you add additional effects
//////////////////////////////////
*/
?>

<?php //$effect = 'effect-oscar'; ?>
<?php $effect = 'effect-lily'; ?>




	<div class="row <?php echo $photoGalleryWidth; ?> <?php echo $photoGalleryRows; ?> <?php echo $addAnimationPhoto;?>"

		<?php if (get_sub_field('add_animation_photo') == 'aos-item') : // Radio Button Values ?>
			<?php echo $animationEffectPhoto ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
		<?php endif;?>

	> <!-- end .row -->

		<div class="large-12 columns">

		<?php if ($photo_gallery_title) {
		    echo '<h2 class="gallery-title">'.$photo_gallery_title.'</h2>';
		    }
		?>

				<?php if( have_rows('photo_gallery') ): $count_01 = 0; // START REPEATER ROWS ?>

					<?php while( have_rows('photo_gallery') ): $count_01++; the_row();
						// vars
						$content = get_sub_field ('photo_gallery_button');
						$gallery = get_sub_field ('photo_gallery_files');
						$wow_array = wow_duration_delay_change();

					?>

		<?php if($button_or_thumbnails == "button"): ?>
					<div class="gallery-item wow <?php echo $wow_animation_effect ;?>" data-wow-duration="2s" data-wow-delay="<?php echo $wow_array[1] ,'s';?>" style="visibility: hidden;">

						<a class="gallery-item-link button-reveal <?php echo 'PageID-'.$i.'-launchGallery-', $outerCounter ,'-', $count_01 ;?>" type="button">

							<div class="gallery-icon">
								<svg>
									<use xlink:href="#icon-photo"/></use>
								</svg>
							</div> <!-- end .gallery-icon -->

							<?php //echo $content ;?>

							<?php if (get_sub_field('photo_gallery_button')) {
									echo '<h3>'.get_sub_field('photo_gallery_button').'</h3>';
								}
							?>

						</a> <!-- end .gallery-item-link -->

					</div> <!-- end .gallery-item -->

		<?php endif; ?>

					<?php // START PHOTO GALLERY CODE ?>

					<?php if( $gallery ):

						$galleryDivContent = NULL;
						$galleryCount = 0; // start with zero so we can set the default video to show on external triggers

						// Setup DIV content
						$galleryDivContent .= '<div';
						if($button_or_thumbnails == "button"):

							$galleryDivContent .= ' style="display:none;" ';

								$galleryJSCode .= '
					$(".PageID-'.$i.'-launchGallery-'.$outerCounter.'-'.$count_01.'").click(function(){
					$("#'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$galleryCount.'.imageGallery a:first").trigger("click");});';
						endif;

						$galleryDivContent .= ' id="'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$galleryCount.'" class="imageGallery row small-up-'.$photoGallerySmall.' medium-up-'.$photoGalleryMedium.' large-up-'.$photoGalleryLarge.' block-container" '.$photoBalancer.'>';
					?>

						<?php foreach( $gallery as $galleryUnits ): ?>

							<?php //$galleryDivContent .= '<a href="'.$galleryUnits['url'].'">  <img src="'.$galleryUnits['sizes']['thumbnail'].'" /></a>';?>
							<?php

							 $galleryDivContent .='<a class="tint gallery-item-link column" data-sub-html="<h3>'.$galleryUnits['title'].'</h3>'.$galleryUnits['description'].'" href="'.$galleryUnits['url'].'" data-equalizer-watch>


							<div class="headline-container"><h4>'.$galleryUnits['title'].'</h4></div>


							 <figure class="'.$effect.'">

	 							 <div class="yt-thumb" style="background-image: url('.$galleryUnits['sizes']['lg-medium'].');"></div>

								 <img data-interchange="['.$galleryUnits['sizes']['lg-medium'].', default] alt='.$galleryUnits['alt'].' width='.$galleryUnits['width'].' height='.$galleryUnits['height'].',['.$galleryUnits['sizes']['lg-medium'].', small] width='.$galleryUnits['width'].' height='.$galleryUnits['height'].',['.$galleryUnits['sizes']['lg-medium'].', medium] width='.$galleryUnits['width'].' height='.$galleryUnits['height'].',['.$galleryUnits['sizes']['lg-medium'].', large] width='.$galleryUnits['width'].' height='.$galleryUnits['height'].' "src="'.$galleryUnits['sizes']['lg-medium'].'"/>



									<figcaption>
										<div class="icon-camera"></div>
										<div class="caption-table">
											<div class="caption-row">
												<div class="caption-cell">
													<h3>'.$galleryUnits['title'].'</h3>
													<p>'.$galleryUnits['description'].'</p>
												</div>
											</div>
										</div>
									</figcaption>
								</figure>
							 </a>';
			 				?>

							<?php $galleryCount ++ ;?>

						<?php endforeach; ?>

						<?php
						//close out the UL
						$galleryDivContent .= '</div>';

						// Dump the PHOTO GALLERY content on the page!

						echo $galleryDivContent; ?>

			        <?php endif; ?>

					<?php // END PHOTO GALLERY CODE ?>

					<?php endwhile; ?>

				<?php endif; ?>

		</div> <!-- end .columns -->

	</div> <!-- end .row -->

<?php endif; // end if nested flexible: ?>