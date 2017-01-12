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
	/*-------------------------------------------------------------------------------------------*/
	/* NEW (COMPONENTS) */
	/*-------------------------------------------------------------------------------------------*/
	?>

	<?php if( get_row_layout() == 'lightbox_component' ): // nested layout: ?>

		<?php
			$thumbnailLarge 			= get_sub_field('lightbox_thumbnail_count_large');
			$thumbnailMedium 			= get_sub_field('lightbox_thumbnail_count_medium');
			$thumbnailSmall 			= get_sub_field('lightbox_thumbnail_count_small');
			$lightboxWidth 				= get_sub_field('lightbox_width');
			$lightboxRow 				= get_sub_field('lightbox_row');
			$noEffect 					= get_sub_field('lightbox_effect');
			$lightboxBalancer 			= get_sub_field('lightbox_balancer');

			$addAnimationLightbox		= get_sub_field('add_animation_lightbox');
			$animationEffectLightbox 	= get_sub_field('animation_effect_lightbox');
			$animationEffectOffset 		= 'data-aos-offset="300"';
			$animationEffectDelay 		= 'data-aos-delay="300"';

			$module_id_name_lb  = 'nested-light-of-'.$i.'-'.$outerCounter;
		?>

		<style>
		#<?php echo $module_id_name_lb ;?> .componentGallery figure img.imgCover,
		#<?php echo $module_id_name_lb ;?> .post-image-container,
		#<?php echo $module_id_name_lb ;?> .postfeatured-image {
		/* 	height: 350px; */
		height: <?php echo get_sub_field('lightbox_image_height');?>px;
		}
		</style>

		<?php //$effect = 'effect-oscar'; ?>
		<?php $effect = 'effect-lily'; ?>





	<div class="<?php echo $addAnimationLightbox;?>"
		<?php if (get_sub_field('add_animation_lightbox') == 'aos-item') : // Radio Button Values ?>
			<?php echo $animationEffectLightbox ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
		<?php endif;?>
	> <!-- end .div $addAnimationLightbox -->

	<?php if( have_rows('lightbox_repeater') ): // repeater: ?>
		 <!-- add 'no-effect' class to remove hover effect -->

		<div id="<?php echo $module_id_name_lb;?>" class="row <?php echo $noEffect;?> <?php echo $lightboxWidth;?> <?php echo $lightboxRow;?>">
		<div class="large-12 columns">
		<div class="row componentGallery small-up-<?php echo $thumbnailSmall;?> medium-up-<?php echo $thumbnailMedium;?> large-up-<?php echo $thumbnailLarge;?>" data-balancer data-respect-sibling-width="<?php echo $lightboxBalancer;?>" >

	        <?php $lightbox_repeater_id = 0; $reveal2_content =''; ?>

				<?php while ( have_rows('lightbox_repeater') ) : the_row(); // repeater: ?>

					<?php // display a sub field value
						$reveal2 				= get_sub_field('lightbox_button_repeater');
						$attachment_id_lb2 		= get_sub_field('lightbox_image_repeater');
						$image_thumbnail_lb2 	= wp_get_attachment_image_src( $attachment_id_lb2, "callout-mobile-small" );
						$image_medium_lb2 		= wp_get_attachment_image_src( $attachment_id_lb2, "callout-mobile-medium" );
						$image_large_lb2 		= wp_get_attachment_image_src( $attachment_id_lb2, "large" );
						$alt_lb2 				= get_post_meta($attachment_id_lb2 , '_wp_attachment_image_alt', true);
						$subfield_lb2 			= get_sub_field('lightbox_headline_repeater'); // not sure if you need this or not.
						$componentLink 			= get_sub_field('component_links');

						$componentImage 			= get_sub_field('component_image');
						$componentImage_thumbnail 	= wp_get_attachment_image_src( $componentImage, "mobile-small" );
						$componentImage_medium 		= wp_get_attachment_image_src( $componentImage, "mobile-small" );
						$componentImage_large 		= wp_get_attachment_image_src( $componentImage, "mobile-small" );
						$componentImage_alt 		= get_post_meta($componentImage , '_wp_attachment_image_alt', true);

						/*
						$componentImage 			= get_sub_field('component_image');
						$componentImage_thumbnail 	= wp_get_attachment_image_src( $componentImage, "bio-thumbnail" );
						$componentImage_medium 		= wp_get_attachment_image_src( $componentImage, "bio-thumbnail" );
						$componentImage_large 		= wp_get_attachment_image_src( $componentImage, "bio-thumbnail" );
						$componentImage_alt 		= get_post_meta($componentImage , '_wp_attachment_image_alt', true);
						*/

					?>




					<?php if ($componentImage) :?>
							<span class="tint gallery-item-link column component-wrapper <?php echo get_sub_field('component_options') ;?>">
<!-- 								<a class="wow <?php echo $wow_animation_effect ;?>" data-open="Modal-<?php echo $i , '-', $outerCounter ,'-0-', $lightbox_repeater_id ?>" data-wow-duration="2s" data-wow-delay="', $wow_array[1] ,'s" style="visibility: hidden;"> -->

								<?php if (get_sub_field('component_options') == 'add_lightbox_modal') : // Radio Button Values ?>

									<a data-open="Modal-<?php echo $i , '-', $outerCounter ,'-0-', $lightbox_repeater_id;?>">

										<?php include(locate_template('parts/modules/nested-module-reveal-content.php'));?>

									</a> <!-- end Modal -->

								<?php elseif (get_sub_field('component_options') == 'add_page_link') : // Radio Button Values ?>

									<?php echo '<a href="'.$componentLink ['url'].'" target="'.$componentLink['target'].'">';?>

										<?php include(locate_template('parts/modules/nested-module-reveal-content.php'));?>

									</a>

								<?php else :?>

									<?php include(locate_template('parts/modules/nested-module-reveal-content.php'));?>

								<?php endif ;?>

							</span>

						<?php else :?>

							<!--
							<div>
								<h2>NO IMAGE</h2>
								<a data-open="Modal-<?php echo $i , '-', $outerCounter ,'-0-', $lightbox_repeater_id;?>">
									<h2>LINK</h2>
								</a>
							</div>
							-->

						<?php endif; ?>



                    <?php // assign content to a variable
						$reveal2_content .= '<div class="large reveal" id="Modal-'.$i.'-'.$outerCounter.'-0-'.$lightbox_repeater_id.'" data-reveal>';?>

						<?php $reveal2_content .= '<div class="reveal-content resize-do-to-reveal">';?>



							<?php if (get_sub_field('lightbox_headline_repeater')) {
								$reveal2_content .= '<h2>'.get_sub_field('component_content_title').'</h2>';
								}
							?>

							<?php if (get_sub_field('lightbox_button_repeater')) :?>
								<?php $reveal2_content .= get_sub_field('component_content_description') ;?>
							<?php endif; ?>



<?php // check if the flexible content field has rows of data
	if( have_rows('lightbox_flexible') ):

		// loop through the rows of data
		while ( have_rows('lightbox_flexible') ) : the_row(); ?>

			<?php if( get_row_layout() == 'lightbox_flex_content' ): ?>

				<?php $reveal2_content .= get_sub_field('lightbox_flex_content_editor') ;?>

			<?php elseif( get_row_layout() == 'lightbox_flex_download' ): // layout: ?>

					<?php if( have_rows('lightbox_download_repeater') ): // START REPEATER ROWS ?>

							<?php while( have_rows('lightbox_download_repeater') ): the_row(); ?>

								<?php
									$downloadFlexFileLink = get_sub_field('lightbox_flex_download_file');
									$downloadFlexFileName = get_sub_field('lightbox_flex_download_name');
								?>

								<?php if( $downloadFlexFileLink ): ?>
									<?php $reveal2_content .= '<a class="button radius" href="' .$downloadFlexFileLink['url']. '" target="_blank">'.$downloadFlexFileName.'</a>';?>
								<?php endif; ?>

							<?php endwhile; ?>

					<?php endif; ?> <!-- end Rows: Lightbox Download Files -->








			<?php elseif( get_row_layout() == 'lightbox_flex_pages' ): // layout: ?>

					<?php $posts = get_sub_field('lightbox_flex_relationship');

						if( $posts ): ?>
                        <?php $temp_post = $post; // Storing the object temporarily ?>

						    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>

						        <?php setup_postdata($post); ?>

									<?php
									$reveal2_content .= '<article id="post-'.get_the_ID().'" class="group" role="article" itemscope itemtype="http://schema.org/WebPage">
															<header class="article-header">
																<h1 class="page-title">'.get_the_title().'</h1>
															</header> <!-- end article header -->
															<section class="entry-content" itemprop="articleBody">
																'.get_the_content().'<br />
															</section> <!-- end article section -->
														</article>';
									?>

									<?php // $reveal2_content .= get_template_part( 'parts/loop', 'page') ;?>

						    <?php endforeach; ?>

						    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                            <?php $post = $temp_post; ?>
						<?php endif; ?> <!-- end $posts -->







			<?php endif; ?>

		<?php endwhile; ?>

<?php endif; ?>





						<?php $reveal2_content .= '</div><!-- end .reveal-content -->'; ?>

						<?php $reveal2_content .= '<button class="close-button fixed" aria-label="Close alert" type="button" data-close><span aria-hidden="true">&times;</span></button>';?>

						<?php $reveal2_content .= '</div> <!-- end .reveal -->';
					?>


			<?php $lightbox_repeater_id ++; endwhile;?>

		</div> <!-- end .componentGallery -->
		</div> <!-- end .columns -->
		</div> <!-- end .row -->

		</div><!-- end .div $addAnimationLightbox -->

        <?php echo $reveal2_content; // dump the DIVS ?>

		<?php else :?>

		    <?php // NO CONTENT ?>

		<?php endif; ?>

	<?php endif; ?>


<?php
/*-------------------------------------------------------------------------------------------*/
/* END NEW (COMPONENTS) */
/*-------------------------------------------------------------------------------------------*/
?>





















