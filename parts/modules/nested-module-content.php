

<style>


/* background setup */
.background {
	background-size: cover;
    background-repeat:no-repeat;
    /* custom background-position */
    background-position:50% 50%;
/*     background-position:center bottom !important; */
    /* ie8- graceful degradation */
    background-position:50% 50%\9 !important;
}

/* fullscreen setup */
html, body {
    /* give this to all tags from html to .fullscreen */
/*     height:100%; */
}
.fullscreen,
.content-a {
    width:100%;
    height:100%;
    overflow:hidden;
}
.fullscreen.overflow,
.fullscreen.overflow .content-a {
    height:auto;
    min-height:100%;
}

/* content centering styles */
.content-a {
    display:table;
}
.content-b {
	display:table-cell;
    position:relative;
	vertical-align:middle;
	text-align:center;
}


.not-fullscreen {
    height:50%;
}
</style>






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
		$contentWidth 						= get_sub_field('content_width');
		$contentRows 						= get_sub_field('content_rows');

		$image_position_left 				= get_sub_field('column_left_image_position');
		$image_position_middle 				= get_sub_field('column_middle_image_position');
		$image_position_right 				= get_sub_field('column_right_image_position');

		$image_bg_color_left				= get_sub_field('column_left_background_color');
		$image_bg_color_left_hover			= get_sub_field('column_left_background_color_hover');
		$image_content_color_left			= get_sub_field('column_left_content_color');
		$image_content_color_left_hover		= get_sub_field('column_left_content_color_hover');

		$image_bg_color_middle				= get_sub_field('column_middle_background_color');
		$image_bg_color_middle_hover		= get_sub_field('column_middle_background_color_hover');
		$image_content_color_middle			= get_sub_field('column_middle_content_color');
		$image_content_color_middle_hover	= get_sub_field('column_middle_content_color_hover');

		$image_bg_color_right				= get_sub_field('column_right_background_color');
		$image_bg_color_right_hover			= get_sub_field('column_right_background_color_hover');
		$image_content_color_right			= get_sub_field('column_right_content_color');
		$image_content_color_right_hover	= get_sub_field('column_right_content_color_hover');

		$content_align_left 				= get_sub_field('column_left_align_content');
		$content_align_middle 				= get_sub_field('column_middle_align_content');
		$content_align_right 				= get_sub_field('column_right_align_content');

		$content_height_large 				= get_sub_field('column_content_height_large');
		$content_height_medium 				= get_sub_field('column_content_height_medium');
		$content_height_small 				= get_sub_field('column_content_height_small');

		$parallax_height_large 				= get_sub_field('parallax_content_height_large');
		$parallax_height_medium 			= get_sub_field('parallax_content_height_medium');
		$parallax_height_small 				= get_sub_field('parallax_content_height_small');

		$contentColBG 						= "background-size: cover; background-repeat: no-repeat;";
		$dataEqualizer 						= 'data-equalizer data-equalize-on="medium" data-equalize-on-stack="true"';

		$attachment_id_parallax 			= get_sub_field('parallax_image_background');
		$image_thumbnail_parallax 			= wp_get_attachment_image_src( $attachment_id_parallax, "large-desktop" );
		$image_medium_parallax 				= wp_get_attachment_image_src( $attachment_id_parallax, "large-desktop" );
		$image_large_parallax 				= wp_get_attachment_image_src( $attachment_id_parallax, "large-desktop" );
		$image_retina_parallax 				= wp_get_attachment_image_src( $attachment_id_parallax, "retina-large" );
		$alt_parallax 						= get_post_meta($attachment_id_parallax , '_wp_attachment_image_alt', true);

		$attachment_id_left 				= get_sub_field('column_left_image');
		$image_thumbnail_left 				= wp_get_attachment_image_src( $attachment_id_left, "mobile-small" );
		$image_medium_left 					= wp_get_attachment_image_src( $attachment_id_left, "mobile-small" );
		$image_large_left 					= wp_get_attachment_image_src( $attachment_id_left, "large-desktop" );
		$image_retina_left 					= wp_get_attachment_image_src( $attachment_id_left, "retina-large" );
		$alt_left 							= get_post_meta($attachment_id_left , '_wp_attachment_image_alt', true);

		$attachment_id_middle 				= get_sub_field('column_middle_image');
		$image_thumbnail_middle 			= wp_get_attachment_image_src( $attachment_id_middle, "mobile-small" );
		$image_medium_middle				= wp_get_attachment_image_src( $attachment_id_middle, "mobile-small" );
		$image_large_middle					= wp_get_attachment_image_src( $attachment_id_middle, "large-desktop" );
		$image_retina_middle				= wp_get_attachment_image_src( $attachment_id_middle, "retina-large" );
		$alt_middle 						= get_post_meta($attachment_id_middle , '_wp_attachment_image_alt', true);

		$attachment_id_right 				= get_sub_field('column_right_image');
		$image_thumbnail_right 				= wp_get_attachment_image_src( $attachment_id_right, "mobile-small" );
		$image_medium_right					= wp_get_attachment_image_src( $attachment_id_right, "mobile-small" );
		$image_large_right					= wp_get_attachment_image_src( $attachment_id_right, "large-desktop" );
		$image_retina_right					= wp_get_attachment_image_src( $attachment_id_right, "retina-large" );
		$alt_right 							= get_post_meta($attachment_id_right , '_wp_attachment_image_alt', true);

		$componentLinkLeft 					= get_sub_field('link_component_left');
		$componentLinkMiddle 				= get_sub_field('link_component_middle');
		$componentLinkRight					= get_sub_field('link_component_right');

?>








	<?php if( get_row_layout() == 'content_component' ): // nested layout: ?>


			  <?php
	              //New class names. this will only populate IF its a content component.
	              $parallax_id_name 			= 'nested-parallax-of-'.$i.'-'.$outerCounter;
	              $module_id_name  				= 'nested-mod-of-'.$i.'-'.$outerCounter;
	              $module_image_right 			= 'nested-image-of-'.$i.'-'.$outerCounter;
	              //$wow_animation_effect_custom = get_sub_field('animation_effect');
	              $animationTrigger 			= get_sub_field('animation_effect');
	              $animationTriggerRight		= get_sub_field('animation_effect_right');

				  $addAnimationLeftColumn 		= get_sub_field('add_animation_left_column');
	              $animationEffectLeftColumn	= get_sub_field('animation_effect_left_column');
				  $addAnimationMiddleColumn 	= get_sub_field('add_animation_middle_column');
	              $animationEffectMiddleColumn	= get_sub_field('animation_effect_middle_column');
				  $addAnimationRightColumn 		= get_sub_field('add_animation_right_column');
	              $animationEffectRightColumn	= get_sub_field('animation_effect_right_column');
	              $animationEffectOffset 		= 'data-aos-offset="300"';
	              $animationEffectDelay 		= 'data-aos-delay="300"';
              ?>


              <style>
              /* Large and up */
              @media screen and (min-width: 64em) {
                  #<?php echo $module_id_name ;?> {
                      height: <?php echo $content_height_large;?>px;
                      min-height: 100%;
                  }
                  #<?php echo $parallax_id_name ;?> {
						height: <?php echo $parallax_height_large;?>px;
						/*min-height: 100%; */
						min-height: <?php echo $content_height_large;?>px;
                  }
              }
              /* Medium only */
                  @media screen and (min-width: 40em) and (max-width: 63.9375em) {
                  #<?php echo $module_id_name ;?> {
                      height: <?php echo $content_height_medium;?>px !important;
                      min-height: 100%;
                  }
                  #<?php echo $parallax_id_name ;?> {
						height: <?php echo $parallax_height_medium;?>px;
						/*min-height: 100%; */
						min-height: <?php echo $content_height_medium;?>px;
                  }
              }
              /* Small only */
              @media screen and (max-width: 39.9375em) {
                  #<?php echo $module_id_name ;?> {
                      height: <?php echo $content_height_small;?>px !important;
                      min-height: 100%;
                  }
                  #<?php echo $parallax_id_name ;?> {
						height: <?php echo $parallax_height_small;?>px;
						/*min-height: 100%; */
						min-height: <?php echo $content_height_msmall;?>px;
                  }
                  .<?php echo $module_image_right ;?> {
	                  height: <?php echo $image_thumbnail_right[2];?>px;
                  }
              }
              #<?php echo $module_id_name ;?>.image-bg-left {
	              <?php if ($image_bg_color_left) :?>
	              	background-color: <?php echo $image_bg_color_left;?>;
	              <?php else :?>
	              <?php endif;?>
	              transition: background-color 0.25s ease-out, color 0.25s ease-out;
              }
              #<?php echo $module_id_name ;?>.image-bg-middle {
	              <?php if ($image_bg_color_middle) :?>
	              	background-color: <?php echo $image_bg_color_middle;?>;
	              <?php else :?>
	              <?php endif;?>
	              transition: background-color 0.25s ease-out, color 0.25s ease-out;
              }

              #<?php echo $module_id_name ;?>.image-bg-right {
	              <?php if ($image_bg_color_left) :?>
	              	background-color: <?php echo $image_bg_color_right;?>;
	              <?php else :?>
	              <?php endif;?>
	              transition: background-color 0.25s ease-out, color 0.25s ease-out;
              }

              #<?php echo $module_id_name ;?>.image-content-left td,
              #<?php echo $module_id_name ;?>.image-content-left td p
              #<?php echo $module_id_name ;?>.image-content-left td h1,
              #<?php echo $module_id_name ;?>.image-content-left td h2,
              #<?php echo $module_id_name ;?>.image-content-left td h3,
              #<?php echo $module_id_name ;?>.image-content-left td h4,
              #<?php echo $module_id_name ;?>.image-content-left td h5,
              #<?php echo $module_id_name ;?>.image-content-left td h1 span,
              #<?php echo $module_id_name ;?>.image-content-left td h2 span,
              #<?php echo $module_id_name ;?>.image-content-left td h3 span,
              #<?php echo $module_id_name ;?>.image-content-left td h4 span,
              #<?php echo $module_id_name ;?>.image-content-left td h5 span {
	              <?php if ($image_content_color_left) :?>
	              	color: <?php echo $image_content_color_left;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }

              #<?php echo $module_id_name ;?>.image-bg-left:hover {
	              <?php if ($image_bg_color_left_hover) :?>
	              background-color: <?php echo $image_bg_color_left_hover;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }
              #<?php echo $module_id_name ;?>.image-bg-left:hover td,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td p,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h1,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h2,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h3,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h4,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h5,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h1 span,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h2 span,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h3 span,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h4 span,
              #<?php echo $module_id_name ;?>.image-bg-left:hover td h5 span {
	              <?php if ($image_content_color_left_hover) :?>
	              	color: <?php echo $image_content_color_left_hover;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }




              #<?php echo $module_id_name ;?>.image-content-middle td,
              #<?php echo $module_id_name ;?>.image-content-middle td p
              #<?php echo $module_id_name ;?>.image-content-middle td h1,
              #<?php echo $module_id_name ;?>.image-content-middle td h2,
              #<?php echo $module_id_name ;?>.image-content-middle td h3,
              #<?php echo $module_id_name ;?>.image-content-middle td h4,
              #<?php echo $module_id_name ;?>.image-content-middle td h5,
              #<?php echo $module_id_name ;?>.image-content-middle td h1 span,
              #<?php echo $module_id_name ;?>.image-content-middle td h2 span,
              #<?php echo $module_id_name ;?>.image-content-middle td h3 span,
              #<?php echo $module_id_name ;?>.image-content-middle td h4 span,
              #<?php echo $module_id_name ;?>.image-content-middle td h5 span {
	              <?php if ($image_content_color_middle) :?>
	              	color: <?php echo $image_content_color_middle;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }

              #<?php echo $module_id_name ;?>.image-bg-middle:hover {
	              <?php if ($image_bg_color_middle_hover) :?>
	              background-color: <?php echo $image_bg_color_middle_hover;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td p,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h1,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h2,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h3,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h4,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h5,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h1 span,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h2 span,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h3 span,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h4 span,
              #<?php echo $module_id_name ;?>.image-bg-middle:hover td h5 span {
	              <?php if ($image_content_color_middle_hover) :?>
	              	color: <?php echo $image_content_color_middle_hover;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }



              #<?php echo $module_id_name ;?>.image-content-right td,
              #<?php echo $module_id_name ;?>.image-content-right td p
              #<?php echo $module_id_name ;?>.image-content-right td h1,
              #<?php echo $module_id_name ;?>.image-content-right td h2,
              #<?php echo $module_id_name ;?>.image-content-right td h3,
              #<?php echo $module_id_name ;?>.image-content-right td h4,
              #<?php echo $module_id_name ;?>.image-content-right td h5,
              #<?php echo $module_id_name ;?>.image-content-right td h1 span,
              #<?php echo $module_id_name ;?>.image-content-right td h2 span,
              #<?php echo $module_id_name ;?>.image-content-right td h3 span,
              #<?php echo $module_id_name ;?>.image-content-right td h4 span,
              #<?php echo $module_id_name ;?>.image-content-right td h5 span {
	              <?php if ($image_content_color_right) :?>
	              	color: <?php echo $image_content_color_right;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }

              #<?php echo $module_id_name ;?>.image-bg-right:hover {
	              <?php if ($image_bg_color_right_hover) :?>
	              background-color: <?php echo $image_bg_color_right_hover;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }
              #<?php echo $module_id_name ;?>.image-bg-right:hover td,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td p,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h1,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h2,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h3,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h4,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h5,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h1 span,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h2 span,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h3 span,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h4 span,
              #<?php echo $module_id_name ;?>.image-bg-right:hover td h5 span {
	              <?php if ($image_content_color_right_hover) :?>
	              	color: <?php echo $image_content_color_right_hover;?> !important;
	              <?php else :?>
	              <?php endif;?>
              }


              </style>


<!-- <h2>Parallax ID Name: <strong><?php echo $parallax_id_name;?></strong></h2> -->


		<?php if (get_sub_field('content_component_width') == '1/1') : // Radio Button Values ?>





<?php if (get_sub_field( 'add_parallax_background' )): ?>
	<div class="row full-width parallax background" <?php echo 'data-interchange=" ['.$image_thumbnail_parallax[0].', only screen and (min-width: 1px)] alt='.$alt_parallax.' width='.$image_thumbnail_parallax[1].' height='.$image_thumbnail_parallax[2].', ['.$image_large_parallax[0].', only screen and (min-width: 40em)] alt='.$alt_parallax.' width='.$image_large_parallax[1].' height='.$image_large_parallax[2].', ['.$image_retina_parallax[0].', only screen and (min-width: 64em)] alt='.$alt_parallax.' width='.$image_retina_parallax[1].' height='.$image_retina_parallax[2].'"' ;?> data-diff="200" data-img-width="<?php echo $image_retina_parallax[1];?>" data-img-height="<?php echo $image_retina_parallax[2];?>">
	    <div id="<?php echo $parallax_id_name;?>" class="content-a">
	        <div class="content-b">
<?php else: ?>
<?php endif; ?>


			<div class="row table-overlay <?php echo $contentWidth; ?> <?php echo $contentRows; ?>" <?php echo $dataEqualizer; ?>>

				<div class="medium-12 columns overlay-wrapper <?php echo $addAnimationLeftColumn;?>"

					<?php if (get_sub_field('add_animation_left_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectLeftColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_left[0].', only screen and (min-width: 1px)] alt='.$alt_left.' width='.$image_thumbnail_left[1].' height='.$image_thumbnail_left[2].', ['.$image_large_left[0].', only screen and (min-width: 40em)] alt='.$alt_left.' width='.$image_large_left[1].' height='.$image_large_left[2].', ['.$image_retina_left[0].', only screen and (min-width: 64em)] alt='.$alt_left.' width='.$image_retina_left[1].' height='.$image_retina_left[2].'"' ;?> style="background-position:<?php echo $image_position_left;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_left_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->


					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkLeft ['url'].'" target="'.$componentLinkLeft['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>

					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-left image-content-left"
						<?php else:?>
							class="image-content-left"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_left;?>">
								<?php the_sub_field('column_component_left'); ?>


							</td>
						</tr>
					</table>


					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Left Column) -->

			</div> <!-- end .row -->

<?php if (get_sub_field( 'add_parallax_background' )): ?>
	        </div> <!-- end .content-b -->
	    </div> <!-- end .content-a -->
	</div> <!-- end .parallax -->
<?php else: ?>
<?php endif; ?>




		<?php elseif (get_sub_field('content_component_width') == '1/2') : // Radio Button Values?>


<?php if (get_sub_field( 'add_parallax_background' )): ?>
	<div class="row full-width parallax background" <?php echo 'data-interchange=" ['.$image_thumbnail_parallax[0].', only screen and (min-width: 1px)] alt='.$alt_parallax.' width='.$image_thumbnail_parallax[1].' height='.$image_thumbnail_parallax[2].', ['.$image_large_parallax[0].', only screen and (min-width: 40em)] alt='.$alt_parallax.' width='.$image_large_parallax[1].' height='.$image_large_parallax[2].', ['.$image_retina_parallax[0].', only screen and (min-width: 64em)] alt='.$alt_parallax.' width='.$image_retina_parallax[1].' height='.$image_retina_parallax[2].'"' ;?> data-diff="200" data-img-width="<?php echo $image_retina_parallax[1];?>" data-img-height="<?php echo $image_retina_parallax[2];?>">
	    <div id="<?php echo $parallax_id_name;?>" class="content-a">
	        <div class="content-b">
<?php else: ?>
<?php endif; ?>

			<div class="row table-overlay <?php echo $contentWidth; ?> <?php echo $contentRows; ?>" <?php echo $dataEqualizer; ?>>

				<div class="medium-6 columns overlay-wrapper <?php echo $addAnimationLeftColumn;?>"

					<?php if (get_sub_field('add_animation_left_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectLeftColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_left[0].', only screen and (min-width: 1px)] alt='.$alt_left.' width='.$image_thumbnail_left[1].' height='.$image_thumbnail_left[2].', ['.$image_large_left[0].', only screen and (min-width: 40em)] alt='.$alt_left.' width='.$image_large_left[1].' height='.$image_large_left[2].', ['.$image_retina_left[0].', only screen and (min-width: 64em)] alt='.$alt_left.' width='.$image_retina_left[1].' height='.$image_retina_left[2].'"' ;?> style="background-position:<?php echo $image_position_left;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_left_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->


					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkLeft ['url'].'" target="'.$componentLinkLeft['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>


					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-left image-content-left"
						<?php else:?>
							class="image-content-left"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_left;?>">
								<?php the_sub_field('column_component_left'); ?>


							</td>
						</tr>
					</table>

					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Left Column) -->



				<div class="medium-6 columns overlay-wrapper <?php echo $addAnimationRightColumn;?>"

					<?php if (get_sub_field('add_animation_right_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectRightColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_right[0].', only screen and (min-width: 1px)] alt='.$alt_right.' width='.$image_thumbnail_right[1].' height='.$image_thumbnail_right[2].', ['.$image_large_right[0].', only screen and (min-width: 40em)] alt='.$alt_right.' width='.$image_large_right[1].' height='.$image_large_right[2].', ['.$image_retina_right[0].', only screen and (min-width: 64em)] alt='.$alt_right.' width='.$image_retina_right[1].' height='.$image_retina_right[2].'"' ;?> style="background-position:<?php echo $image_position_right;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_right_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->

					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkRight ['url'].'" target="'.$componentLinkRight['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>

					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-right image-content-right"
						<?php else:?>
							class="image-content-right"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_right;?>">
								<?php the_sub_field('column_component_right'); ?>


							</td>
						</tr>
					</table>
					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Right Column) -->

			</div> <!-- end .row -->

<?php if (get_sub_field( 'add_parallax_background' )): ?>
	        </div> <!-- end .content-b -->
	    </div> <!-- end .content-a -->
	</div> <!-- end .parallax -->
<?php else: ?>
<?php endif; ?>



		<?php elseif (get_sub_field('content_component_width') == '2/3') : // Radio Button Values?>

<?php if (get_sub_field( 'add_parallax_background' )): ?>
	<div class="row full-width parallax background" <?php echo 'data-interchange=" ['.$image_thumbnail_parallax[0].', only screen and (min-width: 1px)] alt='.$alt_parallax.' width='.$image_thumbnail_parallax[1].' height='.$image_thumbnail_parallax[2].', ['.$image_large_parallax[0].', only screen and (min-width: 40em)] alt='.$alt_parallax.' width='.$image_large_parallax[1].' height='.$image_large_parallax[2].', ['.$image_retina_parallax[0].', only screen and (min-width: 64em)] alt='.$alt_parallax.' width='.$image_retina_parallax[1].' height='.$image_retina_parallax[2].'"' ;?> data-diff="200" data-img-width="<?php echo $image_retina_parallax[1];?>" data-img-height="<?php echo $image_retina_parallax[2];?>">
	    <div id="<?php echo $parallax_id_name;?>" class="content-a">
	        <div class="content-b">
<?php else: ?>
<?php endif; ?>

			<div class="row table-overlay <?php echo $contentWidth; ?> <?php echo $contentRows; ?>" <?php echo $dataEqualizer; ?>>

				<div class="medium-8 columns overlay-wrapper <?php echo $addAnimationLeftColumn;?>"

					<?php if (get_sub_field('add_animation_left_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectLeftColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_left[0].', only screen and (min-width: 1px)] alt='.$alt_left.' width='.$image_thumbnail_left[1].' height='.$image_thumbnail_left[2].', ['.$image_large_left[0].', only screen and (min-width: 40em)] alt='.$alt_left.' width='.$image_large_left[1].' height='.$image_large_left[2].', ['.$image_retina_left[0].', only screen and (min-width: 64em)] alt='.$alt_left.' width='.$image_retina_left[1].' height='.$image_retina_left[2].'"' ;?> style="background-position:<?php echo $image_position_left;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_left_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->


					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkLeft ['url'].'" target="'.$componentLinkLeft['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>


					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-left image-content-left"
						<?php else:?>
							class="image-content-left"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_left;?>">
								<?php the_sub_field('column_component_left'); ?>


							</td>
						</tr>
					</table>

					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Left Column) -->



				<div class="medium-4 columns overlay-wrapper <?php echo $addAnimationRightColumn;?>"

					<?php if (get_sub_field('add_animation_right_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectRightColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_right[0].', only screen and (min-width: 1px)] alt='.$alt_right.' width='.$image_thumbnail_right[1].' height='.$image_thumbnail_right[2].', ['.$image_large_right[0].', only screen and (min-width: 40em)] alt='.$alt_right.' width='.$image_large_right[1].' height='.$image_large_right[2].', ['.$image_retina_right[0].', only screen and (min-width: 64em)] alt='.$alt_right.' width='.$image_retina_right[1].' height='.$image_retina_right[2].'"' ;?> style="background-position:<?php echo $image_position_right;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_right_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->

					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkRight ['url'].'" target="'.$componentLinkRight['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>

					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-right image-content-right"
						<?php else:?>
							class="image-content-right"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_right;?>">
								<?php the_sub_field('column_component_right'); ?>


							</td>
						</tr>
					</table>
					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Right Column) -->

				</div> <!-- end .row -->

<?php if (get_sub_field( 'add_parallax_background' )): ?>
	        </div> <!-- end .content-b -->
	    </div> <!-- end .content-a -->
	</div> <!-- end .parallax -->
<?php else: ?>
<?php endif; ?>



			<?php elseif (get_sub_field('content_component_width') == '3/2') : // Radio Button Values?>


<?php if (get_sub_field( 'add_parallax_background' )): ?>
	<div class="row full-width parallax background" <?php echo 'data-interchange=" ['.$image_thumbnail_parallax[0].', only screen and (min-width: 1px)] alt='.$alt_parallax.' width='.$image_thumbnail_parallax[1].' height='.$image_thumbnail_parallax[2].', ['.$image_large_parallax[0].', only screen and (min-width: 40em)] alt='.$alt_parallax.' width='.$image_large_parallax[1].' height='.$image_large_parallax[2].', ['.$image_retina_parallax[0].', only screen and (min-width: 64em)] alt='.$alt_parallax.' width='.$image_retina_parallax[1].' height='.$image_retina_parallax[2].'"' ;?> data-diff="200" data-img-width="<?php echo $image_retina_parallax[1];?>" data-img-height="<?php echo $image_retina_parallax[2];?>">
	    <div id="<?php echo $parallax_id_name;?>" class="content-a">
	        <div class="content-b">
<?php else: ?>
<?php endif; ?>

			<div class="row table-overlay <?php echo $contentWidth; ?> <?php echo $contentRows; ?>" <?php echo $dataEqualizer; ?>>

				<div class="medium-4 columns overlay-wrapper <?php echo $addAnimationLeftColumn;?>"

					<?php if (get_sub_field('add_animation_left_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectLeftColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_left[0].', only screen and (min-width: 1px)] alt='.$alt_left.' width='.$image_thumbnail_left[1].' height='.$image_thumbnail_left[2].', ['.$image_large_left[0].', only screen and (min-width: 40em)] alt='.$alt_left.' width='.$image_large_left[1].' height='.$image_large_left[2].', ['.$image_retina_left[0].', only screen and (min-width: 64em)] alt='.$alt_left.' width='.$image_retina_left[1].' height='.$image_retina_left[2].'"' ;?> style="background-position:<?php echo $image_position_left;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_left_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->


					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkLeft ['url'].'" target="'.$componentLinkLeft['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>


					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-left image-content-left"
						<?php else:?>
							class="image-content-left"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_left;?>">
								<?php the_sub_field('column_component_left'); ?>


							</td>
						</tr>
					</table>

					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Left Column) -->



				<div class="medium-8 columns overlay-wrapper <?php echo $addAnimationRightColumn;?>"

					<?php if (get_sub_field('add_animation_right_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectRightColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_right[0].', only screen and (min-width: 1px)] alt='.$alt_right.' width='.$image_thumbnail_right[1].' height='.$image_thumbnail_right[2].', ['.$image_large_right[0].', only screen and (min-width: 40em)] alt='.$alt_right.' width='.$image_large_right[1].' height='.$image_large_right[2].', ['.$image_retina_right[0].', only screen and (min-width: 64em)] alt='.$alt_right.' width='.$image_retina_right[1].' height='.$image_retina_right[2].'"' ;?> style="background-position:<?php echo $image_position_right;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_right_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->

					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkRight ['url'].'" target="'.$componentLinkRight['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>

					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-right image-content-right"
						<?php else:?>
							class="image-content-right"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_right;?>">
								<?php the_sub_field('column_component_right'); ?>


							</td>
						</tr>
					</table>
					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Right Column) -->

				</div> <!-- end .row -->

<?php if (get_sub_field( 'add_parallax_background' )): ?>
	        </div> <!-- end .content-b -->
	    </div> <!-- end .content-a -->
	</div> <!-- end .parallax -->
<?php else: ?>
<?php endif; ?>



		<?php elseif (get_sub_field('content_component_width') == '1/3') : // Radio Button Values?>

<?php if (get_sub_field( 'add_parallax_background' )): ?>
	<div class="row full-width parallax background" <?php echo 'data-interchange=" ['.$image_thumbnail_parallax[0].', only screen and (min-width: 1px)] alt='.$alt_parallax.' width='.$image_thumbnail_parallax[1].' height='.$image_thumbnail_parallax[2].', ['.$image_large_parallax[0].', only screen and (min-width: 40em)] alt='.$alt_parallax.' width='.$image_large_parallax[1].' height='.$image_large_parallax[2].', ['.$image_retina_parallax[0].', only screen and (min-width: 64em)] alt='.$alt_parallax.' width='.$image_retina_parallax[1].' height='.$image_retina_parallax[2].'"' ;?> data-diff="200" data-img-width="<?php echo $image_retina_parallax[1];?>" data-img-height="<?php echo $image_retina_parallax[2];?>">
	    <div id="<?php echo $parallax_id_name;?>" class="content-a">
	        <div class="content-b">
<?php else: ?>
<?php endif; ?>

			<div class="row table-overlay <?php echo $contentWidth; ?> <?php echo $contentRows; ?>" <?php echo $dataEqualizer; ?>>

				<div class="medium-4 columns overlay-wrapper <?php echo $addAnimationLeftColumn;?>"

					<?php if (get_sub_field('add_animation_left_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectLeftColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_left[0].', only screen and (min-width: 1px)] alt='.$alt_left.' width='.$image_thumbnail_left[1].' height='.$image_thumbnail_left[2].', ['.$image_large_left[0].', only screen and (min-width: 40em)] alt='.$alt_left.' width='.$image_large_left[1].' height='.$image_large_left[2].', ['.$image_retina_left[0].', only screen and (min-width: 64em)] alt='.$alt_left.' width='.$image_retina_left[1].' height='.$image_retina_left[2].'"' ;?> style="background-position:<?php echo $image_position_left;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_left_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->


					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkLeft ['url'].'" target="'.$componentLinkLeft['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>


					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_left_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-left image-content-left"
						<?php else:?>
							class="image-content-left"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_left;?>">
								<?php the_sub_field('column_component_left'); ?>


							</td>
						</tr>
					</table>

					<?php if (get_sub_field('add_link_component_left') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Left Column) -->



				<div class="medium-4 columns overlay-wrapper <?php echo $addAnimationMiddleColumn;?>"

					<?php if (get_sub_field('add_animation_middle_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectMiddleColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_middle_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_middle[0].', only screen and (min-width: 1px)] alt='.$alt_middle.' width='.$image_thumbnail_middle[1].' height='.$image_thumbnail_middle[2].', ['.$image_large_middle[0].', only screen and (min-width: 40em)] alt='.$alt_middle.' width='.$image_large_middle[1].' height='.$image_large_middle[2].', ['.$image_retina_middle[0].', only screen and (min-width: 64em)] alt='.$alt_middle.' width='.$image_retina_middle[1].' height='.$image_retina_middle[2].'"' ;?> style="background-position:<?php echo $image_position_middle;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_middle_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->

					<?php if (get_sub_field('add_link_component_middle') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkMiddle ['url'].'" target="'.$componentLinkMiddle['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>

					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_middle_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-middle image-content-middle"
						<?php else:?>
							class="image-content-middle"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_middle;?>">
								<?php the_sub_field('column_component_middle'); ?>


							</td>
						</tr>
					</table>
					<?php if (get_sub_field('add_link_component_middle') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Middle Column) -->




				<div class="medium-4 columns overlay-wrapper <?php echo $addAnimationRightColumn;?>"

					<?php if (get_sub_field('add_animation_right_column') == 'aos-item') : // Radio Button Values ?>
						<?php echo $animationEffectRightColumn ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
					<?php endif;?>

					<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>

						<?php echo 'data-interchange=" ['.$image_thumbnail_right[0].', only screen and (min-width: 1px)] alt='.$alt_right.' width='.$image_thumbnail_right[1].' height='.$image_thumbnail_right[2].', ['.$image_large_right[0].', only screen and (min-width: 40em)] alt='.$alt_right.' width='.$image_large_right[1].' height='.$image_large_right[2].', ['.$image_retina_right[0].', only screen and (min-width: 64em)] alt='.$alt_right.' width='.$image_retina_right[1].' height='.$image_retina_right[2].'"' ;?> style="background-position:<?php echo $image_position_right;?>; <?php echo $contentColBG; ?>"

					<?php elseif (get_sub_field('add_column_right_background') == 'no') : // Radio Button Values ?>

					<?php endif; ?>

				> <!-- end .overlay-wrapper -->

					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '<a class="component-link" href="'.$componentLinkRight ['url'].'" target="'.$componentLinkRight['target'].'" data-equalizer-watch>'; ?>
						<?php else :?>
						<div data-equalizer-watch>
					<?php endif;?>

					<table id="<?php echo $module_id_name ;?>"
						<?php if (get_sub_field('add_column_right_background') == 'yes') : // Radio Button Values ?>
							class="image-bg-right image-content-right"
						<?php else:?>
							class="image-content-right"
						<?php endif;?>
					> <!-- end table style -->

						<tr>
							<td style="vertical-align: <?php echo $content_align_right;?>">
								<?php the_sub_field('column_component_right'); ?>


							</td>
						</tr>
					</table>
					<?php if (get_sub_field('add_link_component_right') == 'yes') : ?>
						<?php echo '</a>'; ?>
						<?php else :?>
						</div>
					<?php endif;?>

				</div> <!-- end .columns (Right Column) -->

				</div> <!-- end .row -->


<?php if (get_sub_field( 'add_parallax_background' )): ?>
	        </div> <!-- end .content-b -->
	    </div> <!-- end .content-a -->
	</div> <!-- end .parallax -->
<?php else: ?>
<?php endif; ?>




		<?php endif; ?>

	<?php endif; ?>