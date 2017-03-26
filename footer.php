					<footer class="footer" role="contentinfo">
						<div id="inner-footer">

							<?php
								$footerSectionWidth 		= get_field('footer_section_width','options');
								$footerSectionRows 			= get_field('footer_section_rows','options');
								$footerSectionBGColor 		= get_field('footer_section_background_color','options');
								$footerCopyrightColor 		= get_field('footer_copyright_color','options');
								$footerCopyrightPosition 	= get_field('footer_copyright_position','options');
								$footerCopyrightBackground 	= get_field('footer_copyright_background','options');

							?>

							<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color: <?php echo $footerSectionBGColor;?>">

								<div class="large-12 columns">

									<?php if( have_rows('footer_flexible_content','options') ): // field label: ?>

										<?php
											$f=0; // var used for featured image and , then zeroed out and used for the tab content.
											$outerCounterFooter=0;
										?>

										<?php while ( have_rows('footer_flexible_content','options') ) : the_row(); // field label: ?>

												<?php
													//New class names. this will only populate IF its a content component.
													$outerCounterFooter ++;
													$footer_id_name  = 'footer-mod-of-'.$f.'-'.$outerCounterFooter;
												?>

												<?php
													$footerSectionWidth 			= get_sub_field('footer_section_container_width');
													$footerSectionRows 				= get_sub_field('footer_section_container_rows');
													$footerSectionBackground 		= get_sub_field('footer_section_container_background');

													$footerContentWidth 			= get_sub_field('footer_content_width');
													$footerContentRows 				= get_sub_field('footer_content_rows');

													$footer_height_large 			= get_sub_field('footer_content_height_large');
													$footer_height_medium 			= get_sub_field('footer_content_height_medium');
													$footer_height_small 			= get_sub_field('footer_content_height_small');

													$contentFooterColBG 			= "background-size:cover; background-repeat:no-repeat;";
													$dataEqualizer 					= 'data-equalizer data-equalize-on-stack="true"';

													$footer_Content_align_left 		= get_sub_field('footer_column_left_align_content');
													$footer_Content_align_right 	= get_sub_field('footer_column_right_align_content');
													$footer_Content_align_middle 	= get_sub_field('footer_column_middle_align_content');
													$footer_Content_align_last 		= get_sub_field('footer_column_last_align_content');

													$attachment_id_footer_left 		= get_sub_field('footer_column_left_image');
													$image_thumbnail_footer_left 	= wp_get_attachment_image_src( $attachment_id_footer_left, "mobile-small" );
													$image_medium_footer_left 		= wp_get_attachment_image_src( $attachment_id_footer_left, "mobile-small" );
													$image_large_footer_left 		= wp_get_attachment_image_src( $attachment_id_footer_left, "large-desktop" );
													$image_retina_footer_left 		= wp_get_attachment_image_src( $attachment_id_footer_left, "retina-large" );
													$alt_footer_left 				= get_post_meta($attachment_id_footer_left , '_wp_attachment_image_alt', true);

													$attachment_id_footer_right 	= get_sub_field('footer_column_right_image');
													$image_thumbnail_footer_right 	= wp_get_attachment_image_src( $attachment_id_footer_right, "mobile-small" );
													$image_medium_footer_right		= wp_get_attachment_image_src( $attachment_id_footer_right, "mobile-small" );
													$image_large_footer_right 		= wp_get_attachment_image_src( $attachment_id_footer_right, "large-desktop" );
													$image_retina_footer_right 		= wp_get_attachment_image_src( $attachment_id_footer_right, "retina-large" );
													$alt_footer_right 				= get_post_meta($attachment_id_footer_right , '_wp_attachment_image_alt', true);

													$attachment_id_footer_middle 	= get_sub_field('footer_column_middle_image');
													$image_thumbnail_footer_middle 	= wp_get_attachment_image_src( $attachment_id_footer_middle, "mobile-small" );
													$image_medium_footer_middle		= wp_get_attachment_image_src( $attachment_id_footer_middle, "mobile-small" );
													$image_large_footer_middle 		= wp_get_attachment_image_src( $attachment_id_footer_middle, "large-desktop" );
													$image_retina_footer_middle 	= wp_get_attachment_image_src( $attachment_id_footer_middle, "retina-large" );
													$alt_footer_middle 				= get_post_meta($attachment_id_footer_middle , '_wp_attachment_image_alt', true);

													$attachment_id_footer_last 		= get_sub_field('footer_column_last_image');
													$image_thumbnail_footer_last 	= wp_get_attachment_image_src( $attachment_id_footer_last, "mobile-small" );
													$image_medium_footer_last		= wp_get_attachment_image_src( $attachment_id_footer_last, "mobile-small" );
													$image_large_footer_last		= wp_get_attachment_image_src( $attachment_id_footer_last, "large-desktop" );
													$image_retina_footer_last 		= wp_get_attachment_image_src( $attachment_id_footer_last, "retina-large" );
													$alt_footer_last 				= get_post_meta($attachment_id_footer_last , '_wp_attachment_image_alt', true);

													$image_position_footer_left 	= get_sub_field('footer_column_left_image_position');
													$image_position_footer_right	= get_sub_field('footer_column_right_image_position');
													$image_position_footer_middle	= get_sub_field('footer_column_middle_image_position');
													$image_position_footer_last		= get_sub_field('footer_column_last_image_position');

													$image_bg_color_footer_left		= get_sub_field('footer_column_left_background_color');
													$image_bg_color_footer_right	= get_sub_field('footer_column_right_background_color');
													$image_bg_color_footer_middle	= get_sub_field('footer_column_middle_background_color');
													$image_bg_color_footer_last		= get_sub_field('footer_column_last_background_color');

												?>




										        <?php if( get_row_layout() == 'footer_content_module' ): // layout: ?>

													<style>
													/* Large and up */
													@media screen and (min-width: 64em) {
														#<?php echo $footer_id_name ;?> {
															height: <?php echo $footer_height_large;?>px;
															min-height: 100%;
														}
													}
													/* Medium only */
													@media screen and (min-width: 40em) and (max-width: 63.9375em) {
														#<?php echo $footer_id_name ;?> {
															height: <?php echo $footer_height_medium;?>px;
															min-height: 100%;
														}
													}
													/* Small only */
													@media screen and (max-width: 39.9375em) {
														#<?php echo $footer_id_name ;?> {
															height: <?php echo $footer_height_small;?>px;
															min-height: 100%;
														}
													}
													</style>

													<?php if (get_sub_field('footer_component_width') == '1/1') : // Radio Button Values ?>

														<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color:<?php echo $footerSectionBackground;?>;">
															<div class="large-12 columns">

																<div class="row table-overlay <?php echo $footerContentWidth; ?> <?php echo $footerContentRows; ?>">

																	<div class="large-12 columns overlay-wrapper"

																		<?php if (get_sub_field('add_footer_column_left_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_left [0].', only screen and (min-width: 1px)] alt='.$alt_footer_left .' width='.$image_thumbnail_footer_left [1].' height='.$image_thumbnail_footer_left [2].', ['.$image_large_footer_left [0].', only screen and (min-width: 40em)] alt='.$alt_footer_left .' width='.$image_large_footer_left [1].' height='.$image_large_footer_left [2].', ['.$image_retina_footer_left [0].', only screen and (min-width: 64em)] alt='.$alt_footer_left .' width='.$image_retina_footer_left [1].' height='.$image_retina_footer_left [2].'"' ;?> style="background-position:<?php echo $image_position_footer_left;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_left_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_left_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_left;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_left; ?>">

			<?php if( have_rows('flexible_footer_left') ): // field label: ?>

				<?php while ( have_rows('flexible_footer_left') ) : the_row(); // field label: ?>

					<?php if( get_row_layout() == 'flexible_footer_left_component_content' ): // layout: ?>

						<?php if(get_sub_field('flexible_footer_left_col_content')){
							echo get_sub_field('flexible_footer_left_col_content');
							}
						?>

					<?php elseif( get_row_layout() == 'flexible_footer_left_component_relationship' ): // layout: ?>

						<?php
						$posts = get_sub_field('flexible_footer_left_col_relationship');
						if( $posts ): ?>
						    <ul>
						    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
						        <?php setup_postdata($post); ?>
						        <li>
						            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						        </li>
						    <?php endforeach; ?>
						    </ul>
						    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
						<?php endif; //$posts ?>

					<?php endif; // flexible_footer_left_component_content ?>

				<?php endwhile; // flexible_footer_left ?>

			<?php endif; // flexible_footer_left ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end .columns .overlay-wrapper -->

																</div> <!-- end .row .table-overlay -->
															</div> <!-- end .columns -->
														</div> <!-- end .rows -->



													<?php elseif (get_sub_field('footer_component_width') == '1/2') : // Radio Button Values ?>

														<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color:<?php echo $footerSectionBackground;?>;">
															<div class="large-12 columns">

																<div class="row table-overlay <?php echo $footerContentWidth; ?> <?php echo $footerContentRows; ?>" <?php echo $dataEqualizer; ?>>

																	<div class="large-6 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_left_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_left [0].', only screen and (min-width: 1px)] alt='.$alt_footer_left .' width='.$image_thumbnail_footer_left [1].' height='.$image_thumbnail_footer_left [2].', ['.$image_large_footer_left [0].', only screen and (min-width: 40em)] alt='.$alt_footer_left .' width='.$image_large_footer_left [1].' height='.$image_large_footer_left [2].', ['.$image_retina_footer_left [0].', only screen and (min-width: 64em)] alt='.$alt_footer_left .' width='.$image_retina_footer_left [1].' height='.$image_retina_footer_left [2].'"' ;?> style="background-position:<?php echo $image_position_footer_left;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_left_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_left_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_left;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_left; ?>">
		<?php if( have_rows('flexible_footer_left') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_left') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_left_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_left_col_content')){
						echo get_sub_field('flexible_footer_left_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_left_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_left_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_left_component_content ?>

			<?php endwhile; // flexible_footer_left ?>

		<?php endif; // flexible_footer_left ?>

																				</td>
																			</tr>
																		</table>








																	</div> <!-- end .columns .table-overlay -->


																	<div class="large-6 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_right_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_right [0].', only screen and (min-width: 1px)] alt='.$alt_footer_right .' width='.$image_thumbnail_footer_right [1].' height='.$image_thumbnail_footer_right [2].', ['.$image_large_footer_right [0].', only screen and (min-width: 40em)] alt='.$alt_footer_right .' width='.$image_large_footer_right [1].' height='.$image_large_footer_right [2].', ['.$image_retina_footer_right [0].', only screen and (min-width: 64em)] alt='.$alt_footer_right .' width='.$image_retina_footer_right [1].' height='.$image_retina_footer_right [2].'"' ;?> style="background-position:<?php echo $image_position_footer_right;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_right_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_right_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_right;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_right; ?>">
																					<?php if(get_sub_field('footer_column_right')){
																						echo get_sub_field('footer_column_right');
																						}
																					?>


		<?php if( have_rows('flexible_footer_right') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_right') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_right_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_right_col_content')){
						echo get_sub_field('flexible_footer_right_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_right_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_right_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_right_component_content ?>

			<?php endwhile; // flexible_footer_right ?>

		<?php endif; // flexible_footer_right ?>




																				</td>
																			</tr>
																		</table>

																	</div> <!-- end .columns .overlay-wrapper -->

																</div> <!-- end .row .table-overlay -->
															</div> <!-- end .columns -->
														</div> <!-- end .rows -->





													<?php elseif (get_sub_field('footer_component_width') == '2/3') : // Radio Button Values ?>

														<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color:<?php echo $footerSectionBackground;?>;">
															<div class="large-12 columns">

																<div class="row table-overlay <?php echo $footerContentWidth; ?> <?php echo $footerContentRows; ?>" <?php echo $dataEqualizer; ?>>

																	<div class="large-8 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_left_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_left [0].', only screen and (min-width: 1px)] alt='.$alt_footer_left .' width='.$image_thumbnail_footer_left [1].' height='.$image_thumbnail_footer_left [2].', ['.$image_large_footer_left [0].', only screen and (min-width: 40em)] alt='.$alt_footer_left .' width='.$image_large_footer_left [1].' height='.$image_large_footer_left [2].', ['.$image_retina_footer_left [0].', only screen and (min-width: 64em)] alt='.$alt_footer_left .' width='.$image_retina_footer_left [1].' height='.$image_retina_footer_left [2].'"' ;?> style="background-position:<?php echo $image_position_footer_left;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_left_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_left_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_left;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_left; ?>">
		<?php if( have_rows('flexible_footer_left') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_left') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_left_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_left_col_content')){
						echo get_sub_field('flexible_footer_left_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_left_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_left_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_left_component_content ?>

			<?php endwhile; // flexible_footer_left ?>

		<?php endif; // flexible_footer_left ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-4 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_right_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_right [0].', only screen and (min-width: 1px)] alt='.$alt_footer_right .' width='.$image_thumbnail_footer_right [1].' height='.$image_thumbnail_footer_right [2].', ['.$image_large_footer_right [0].', only screen and (min-width: 40em)] alt='.$alt_footer_right .' width='.$image_large_footer_right [1].' height='.$image_large_footer_right [2].', ['.$image_retina_footer_right [0].', only screen and (min-width: 64em)] alt='.$alt_footer_right .' width='.$image_retina_footer_right [1].' height='.$image_retina_footer_right [2].'"' ;?> style="background-position:<?php echo $image_position_footer_right;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_right_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_right_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_right;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_right; ?>">
		<?php if( have_rows('flexible_footer_right') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_right') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_right_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_right_col_content')){
						echo get_sub_field('flexible_footer_right_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_right_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_right_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_right_component_content ?>

			<?php endwhile; // flexible_footer_right ?>

		<?php endif; // flexible_footer_right ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end .columns .overlay-wrapper -->

																</div> <!-- end .row .table-overlay -->
															</div> <!-- end .columns -->
														</div> <!-- end .rows -->








													<?php elseif (get_sub_field('footer_component_width') == '3/2') : // Radio Button Values ?>

														<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color:<?php echo $footerSectionBackground;?>;">
															<div class="large-12 columns">

																<div class="row table-overlay <?php echo $footerContentWidth; ?> <?php echo $footerContentRows; ?>" <?php echo $dataEqualizer; ?>>

																	<div class="large-4 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_left_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_left [0].', only screen and (min-width: 1px)] alt='.$alt_footer_left .' width='.$image_thumbnail_footer_left [1].' height='.$image_thumbnail_footer_left [2].', ['.$image_large_footer_left [0].', only screen and (min-width: 40em)] alt='.$alt_footer_left .' width='.$image_large_footer_left [1].' height='.$image_large_footer_left [2].', ['.$image_retina_footer_left [0].', only screen and (min-width: 64em)] alt='.$alt_footer_left .' width='.$image_retina_footer_left [1].' height='.$image_retina_footer_left [2].'"' ;?> style="background-position:<?php echo $image_position_footer_left;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_left_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_left_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_left;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_left; ?>">
		<?php if( have_rows('flexible_footer_left') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_left') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_left_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_left_col_content')){
						echo get_sub_field('flexible_footer_left_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_left_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_left_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_left_component_content ?>

			<?php endwhile; // flexible_footer_left ?>

		<?php endif; // flexible_footer_left ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-8 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_right_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_right [0].', only screen and (min-width: 1px)] alt='.$alt_footer_right .' width='.$image_thumbnail_footer_right [1].' height='.$image_thumbnail_footer_right [2].', ['.$image_large_footer_right [0].', only screen and (min-width: 40em)] alt='.$alt_footer_right .' width='.$image_large_footer_right [1].' height='.$image_large_footer_right [2].', ['.$image_retina_footer_right [0].', only screen and (min-width: 64em)] alt='.$alt_footer_right .' width='.$image_retina_footer_right [1].' height='.$image_retina_footer_right [2].'"' ;?> style="background-position:<?php echo $image_position_footer_right;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_right_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_right_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_right;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_right; ?>">
		<?php if( have_rows('flexible_footer_right') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_right') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_right_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_right_col_content')){
						echo get_sub_field('flexible_footer_right_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_right_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_right_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_right_component_content ?>

			<?php endwhile; // flexible_footer_right ?>

		<?php endif; // flexible_footer_right ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end .columns .overlay-wrapper -->

																</div> <!-- end .row .table-overlay -->
															</div> <!-- end .columns -->
														</div> <!-- end .rows -->






													<?php elseif (get_sub_field('footer_component_width') == '1/3') : // Radio Button Values ?>

														<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color:<?php echo $footerSectionBackground;?>;">
															<div class="large-12 columns">

																<div class="row table-overlay <?php echo $footerContentWidth; ?> <?php echo $footerContentRows; ?>" <?php echo $dataEqualizer; ?>>

																	<div class="large-4 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_left_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_left [0].', only screen and (min-width: 1px)] alt='.$alt_footer_left .' width='.$image_thumbnail_footer_left [1].' height='.$image_thumbnail_footer_left [2].', ['.$image_large_footer_left [0].', only screen and (min-width: 40em)] alt='.$alt_footer_left .' width='.$image_large_footer_left [1].' height='.$image_large_footer_left [2].', ['.$image_retina_footer_left [0].', only screen and (min-width: 64em)] alt='.$alt_footer_left .' width='.$image_retina_footer_left [1].' height='.$image_retina_footer_left [2].'"' ;?> style="background-position:<?php echo $image_position_footer_left;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_left_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_left_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_left;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_left; ?>">
		<?php if( have_rows('flexible_footer_left') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_left') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_left_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_left_col_content')){
						echo get_sub_field('flexible_footer_left_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_left_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_left_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_left_component_content ?>

			<?php endwhile; // flexible_footer_left ?>

		<?php endif; // flexible_footer_left ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-4 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_middle_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_middle [0].', only screen and (min-width: 1px)] alt='.$alt_footer_middle .' width='.$image_thumbnail_footer_middle [1].' height='.$image_thumbnail_footer_middle [2].', ['.$image_large_footer_middle [0].', only screen and (min-width: 40em)] alt='.$alt_footer_middle .' width='.$image_large_footer_middle [1].' height='.$image_large_footer_middle [2].', ['.$image_retina_footer_middle [0].', only screen and (min-width: 64em)] alt='.$alt_footer_middle .' width='.$image_retina_footer_middle [1].' height='.$image_retina_footer_middle [2].'"' ;?> style="background-position:<?php echo $image_position_footer_middle;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_middle_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_middle_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_middle;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_middle; ?>">
		<?php if( have_rows('flexible_footer_middle') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_middle') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_middle_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_middle_col_content')){
						echo get_sub_field('flexible_footer_middle_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_middle_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_middle_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_middle_component_content ?>

			<?php endwhile; // flexible_footer_middle ?>

		<?php endif; // flexible_footer_middle ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-4 medium-12 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_right_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_right [0].', only screen and (min-width: 1px)] alt='.$alt_footer_right .' width='.$image_thumbnail_footer_right [1].' height='.$image_thumbnail_footer_right [2].', ['.$image_large_footer_right [0].', only screen and (min-width: 40em)] alt='.$alt_footer_right .' width='.$image_large_footer_right [1].' height='.$image_large_footer_right [2].', ['.$image_retina_footer_right [0].', only screen and (min-width: 64em)] alt='.$alt_footer_right .' width='.$image_retina_footer_right [1].' height='.$image_retina_footer_right [2].'"' ;?> style="background-position:<?php echo $image_position_footer_right;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_right_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_right_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_right;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_right; ?>">
		<?php if( have_rows('flexible_footer_right') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_right') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_right_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_right_col_content')){
						echo get_sub_field('flexible_footer_right_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_right_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_right_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_right_component_content ?>

			<?php endwhile; // flexible_footer_right ?>

		<?php endif; // flexible_footer_right ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end .columns .overlay-wrapper -->

																</div> <!-- end .row .table-overlay -->
															</div> <!-- end .columns -->
														</div> <!-- end .rows -->














													<?php elseif (get_sub_field('footer_component_width') == '1/4') : // Radio Button Values ?>

														<div class="row <?php echo $footerSectionWidth; ?> <?php echo $footerSectionRows; ?>" style="background-color:<?php echo $footerSectionBackground;?>;">
															<div class="large-12 columns">

																<div class="row table-overlay <?php echo $footerContentWidth; ?> <?php echo $footerContentRows; ?>" <?php echo $dataEqualizer; ?>>

																	<div class="large-3 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_left_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_left [0].', only screen and (min-width: 1px)] alt='.$alt_footer_left .' width='.$image_thumbnail_footer_left [1].' height='.$image_thumbnail_footer_left [2].', ['.$image_large_footer_left [0].', only screen and (min-width: 40em)] alt='.$alt_footer_left .' width='.$image_large_footer_left [1].' height='.$image_large_footer_left [2].', ['.$image_retina_footer_left [0].', only screen and (min-width: 64em)] alt='.$alt_footer_left .' width='.$image_retina_footer_left [1].' height='.$image_retina_footer_left [2].'"' ;?> style="background-position:<?php echo $image_position_footer_left;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_left_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_left_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_left;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_left; ?>">
		<?php if( have_rows('flexible_footer_left') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_left') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_left_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_left_col_content')){
						echo get_sub_field('flexible_footer_left_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_left_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_left_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_left_component_content ?>

			<?php endwhile; // flexible_footer_left ?>

		<?php endif; // flexible_footer_left ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-3 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_middle_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_middle [0].', only screen and (min-width: 1px)] alt='.$alt_footer_middle .' width='.$image_thumbnail_footer_middle [1].' height='.$image_thumbnail_footer_middle [2].', ['.$image_large_footer_middle [0].', only screen and (min-width: 40em)] alt='.$alt_footer_middle .' width='.$image_large_footer_middle [1].' height='.$image_large_footer_middle [2].', ['.$image_retina_footer_middle [0].', only screen and (min-width: 64em)] alt='.$alt_footer_middle .' width='.$image_retina_footer_middle [1].' height='.$image_retina_footer_middle [2].'"' ;?> style="background-position:<?php echo $image_position_footer_middle;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_middle_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_middle_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_middle;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_middle; ?>">
		<?php if( have_rows('flexible_footer_middle') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_middle') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_middle_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_middle_col_content')){
						echo get_sub_field('flexible_footer_middle_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_middle_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_middle_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_middle_component_content ?>

			<?php endwhile; // flexible_footer_middle ?>

		<?php endif; // flexible_footer_middle ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-3 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_right_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_right [0].', only screen and (min-width: 1px)] alt='.$alt_footer_right .' width='.$image_thumbnail_footer_right [1].' height='.$image_thumbnail_footer_right [2].', ['.$image_large_footer_right [0].', only screen and (min-width: 40em)] alt='.$alt_footer_right .' width='.$image_large_footer_right [1].' height='.$image_large_footer_right [2].', ['.$image_retina_footer_right [0].', only screen and (min-width: 64em)] alt='.$alt_footer_right .' width='.$image_retina_footer_right [1].' height='.$image_retina_footer_right [2].'"' ;?> style="background-position:<?php echo $image_position_footer_right;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_right_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_right_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_right;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_right; ?>">
		<?php if( have_rows('flexible_footer_right') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_right') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_right_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_right_col_content')){
						echo get_sub_field('flexible_footer_right_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_right_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_right_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_right_component_content ?>

			<?php endwhile; // flexible_footer_right ?>

		<?php endif; // flexible_footer_right ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																	<div class="large-3 medium-6 columns overlay-wrapper" data-equalizer-watch

																		<?php if (get_sub_field('add_footer_column_last_background','options') == 'yes') : // Radio Button Values ?>

																			<?php echo 'data-interchange=" ['.$image_thumbnail_footer_last [0].', only screen and (min-width: 1px)] alt='.$alt_footer_last .' width='.$image_thumbnail_footer_last [1].' height='.$image_thumbnail_footer_last [2].', ['.$image_large_footer_last [0].', only screen and (min-width: 40em)] alt='.$alt_footer_last .' width='.$image_large_footer_last [1].' height='.$image_large_footer_last [2].', ['.$image_retina_footer_last [0].', only screen and (min-width: 64em)] alt='.$alt_footer_last .' width='.$image_retina_footer_last [1].' height='.$image_retina_footer_last [2].'"' ;?> style="background-position:<?php echo $image_position_footer_last;?>; <?php echo $contentFooterColBG; ?>"

																		<?php elseif (get_sub_field('add_footer_column_last_background') == 'no') : // Radio Button Values ?>

																		<?php endif; ?>

																		> <!-- end .overlay-wrapper -->

																		<table id="<?php echo $footer_id_name ;?>" style="
																			<?php if (get_sub_field('add_footer_column_last_background') == 'yes') : // Radio Button Values ?>
																				background-color: <?php echo $image_bg_color_footer_last;?>;
																			<?php endif;?>
																		"> <!-- end table style -->
																			<tr>
																				<td style="vertical-align: <?php echo $footer_Content_align_last; ?>">
		<?php if( have_rows('flexible_footer_last') ): // field label: ?>

			<?php while ( have_rows('flexible_footer_last') ) : the_row(); // field label: ?>

				<?php if( get_row_layout() == 'flexible_footer_last_component_content' ): // layout: ?>

					<?php if(get_sub_field('flexible_footer_last_col_content')){
						echo get_sub_field('flexible_footer_last_col_content');
						}
					?>

				<?php elseif( get_row_layout() == 'flexible_footer_last_component_relationship' ): // layout: ?>

					<?php
					$posts = get_sub_field('flexible_footer_last_col_relationship');
					if( $posts ): ?>
					    <ul>
					    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					        <?php setup_postdata($post); ?>
					        <li>
					            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					        </li>
					    <?php endforeach; ?>
					    </ul>
					    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					<?php endif; //$posts ?>

				<?php endif; // flexible_footer_last_component_content ?>

			<?php endwhile; // flexible_footer_last ?>

		<?php endif; // flexible_footer_last ?>
																				</td>
																			</tr>
																		</table>

																	</div> <!-- end columns -->


																</div> <!-- end .row .table-overlay -->
															</div> <!-- end .columns -->
														</div> <!-- end .rows -->












													<?php endif; // end if footer_component_width: ?>





											<?php endif; // end if flexible: ?>

										<?php endwhile; // end flexible: ?>

										<?php else : ?>

										<?php //CONTENT GOES HERE ?>

									<?php endif; ?>

									<?php wp_reset_query(); ?>




									<nav role="navigation">
			    						<?php joints_footer_links(); ?>
			    					</nav>

									<div class="copyright" style="background-color: <?php echo $footerCopyrightBackground;?>; color:<?php echo $footerCopyrightColor;?>; text-align: <?php echo $footerCopyrightPosition;?>">


										<?php if(get_field('footer_copyright','options')):?>

<!-- 											<span class="source-org"><strong>&copy;</strong> <?php echo date('Y'); ?> <?php echo get_field('footer_copyright','options');?></span> -->

											<?php echo '<div class="source-org"><strong>&copy; </strong>' . date('Y') .' '. get_field('footer_copyright','options') . '</div>';?>

										<?php else:?>

											<p class="source-org"><strong>&copy;</strong><?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <span class="break">All Rights Reserved.</span> </p>

										<?php endif;?>


									</div> <!-- end .copyright -->

								</div> <!-- end .columns -->

							</div> <!-- end .rows -->



						</div> <!-- end #inner-footer -->
					</footer> <!-- end .footer -->
				</div>  <!-- end .off-canvas-content -->

		</div> <!-- end .off-canvas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->