<?php
/*
//////////////////////////////////
NESTED MODULE 01

Variables that need to be set in a different page IF you are not using TABS
$i : originally for TAB id's
$outerCounter : with tabs, this handles the counting of each module in each tabbed area.
$galleryJSCode : this is the JS code that is needed to activate and store the desired modal window code.


not sure we need the follwing counter since we aren't digging into a deeper nested field.
$count_01++;
//////////////////////////////////
*/


?>




<?php if( get_row_layout() == 'video_gallery_component' ): // nested layout: ?>




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





	    <?php

	        $button_or_thumbnails 		= get_sub_field('button_or_thumbnail_modal_trigger'); // New ACF to determine if we use thumbnails or a button
			$videoGalleryWidth 			= get_sub_field('video_gallery_width');
			$videoGalleryRows 			= get_sub_field('video_gallery_rows');

	        $button_label 				= get_sub_field('video_gallery_button'); // New Label
	        $video_gallery_content 		= get_sub_field('video_gallery_content'); // New Label
			$video_host_type 			= get_sub_field('video_gallery_type');
			$videos 					= get_sub_field( "local_videos" );
			$wow_array 					= wow_duration_delay_change();
			$videoDivContent 			= NULL;
			$videoULContent 			= NULL;
			$videoCount 				= 0; // start with zero so we can set the default video to show on external triggers
			$videoGallerySmall 			= get_sub_field('small_thumbnail_video_display');
			$videoGalleryMedium 		= get_sub_field('medium_thumbnail_video_display');
			$videoGalleryLarge 			= get_sub_field('large_thumbnail_video_display');
			$videoBalancer 				= get_sub_field('video_balancer');

			$addAnimationVideo 		 	= get_sub_field('add_animation_video');
			$animationEffectVideo		= get_sub_field('animation_effect_video');
			$animationEffectOffset 		= 'data-aos-offset="300"';
			$animationEffectDelay 		= 'data-aos-delay="300"';

		?>

	<div class="row <?php echo $videoGalleryWidth; ?> <?php echo $videoGalleryRows; ?> <?php echo $addAnimationVideo;?>"

		<?php if (get_sub_field('add_animation_video') == 'aos-item') : // Radio Button Values ?>
			<?php echo $animationEffectVideo ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
		<?php endif;?>

	> <!-- end .row -->

		<div class="large-12 columns">

		<?php if ($video_gallery_content) {
		    echo '<div class="video-gallery-content">'.$video_gallery_content.'</div>';
		    }
		?>

		<?php if( have_rows('local_videos') || have_rows('vimeo_youtube_gallery_v1')):
		 			$count_01 = 0;
					$count_01++;
		 		endif;
		?>


		<?php
		/*
		//////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////
		Local/Self Hosted Video
		//////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////
		*/
			if($button_or_thumbnails == "button"):
				/* Module: Video Top */
				include(locate_template('parts/modules/nested-module-video-top.php'));
			endif;

		 ?>


	        <?php if($video_host_type =='local' && have_rows('local_videos')): ?>

				<?php // NEW VIDEO GALLERY CODE ?>

				<?php if( $videos ):


					// prep the UL
					$videoULContent = '<ul';

					if($button_or_thumbnails == "button"):

						//if Button, than we need to hide the thumbnails
						$videoULContent .= ' style="display: none;"';

						//if Button, than we need to activate the JS that will allow the button to trigger the modal window
						$galleryJSCode .= '
										$(".PageID-'.$i.'-launchGallery-'.$outerCounter.'-'.$count_01.'").click(function(){
										$("#VideoList-page-'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'").trigger("click");});';
					endif;


					$videoULContent .= ' class="html5gallery">';

					?>

						<?php foreach( $videos as $video ): the_row();


						  // generate the divs that house the videos.
				          $videoDivContent .= '<div style="display:none;" id="'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'">
				                                  <video class="lg-video-object lg-html5" controls preload="metadata">
				                                      <source src="'.$video['url'].'" type="'.$video['mime_type'].'">
				                                       Your browser does not support HTML5 video.
				                                  </video>
				                              </div>';

							// lets add the videos the the UL
							if (has_post_thumbnail($video['ID'])) {
								//echo 'HAS Thumbnail';
								$videoULContent .= '<li class="localVideo" data-poster="'.$video['sizes']['large'].'" id="VideoList-page-'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" data-sub-html="<h3>'.$video['title'].'</h3>'.$video['description'].'" data-html="#'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" ><img src="'.$video['sizes']['lg-thumbnail'].'" /></li>';

							}
							else {
								//echo 'NO IMAGE';
								$videoULContent .= '<li class="localVideo" data-poster="'.get_template_directory_uri().'/assets/build/images/video-thumbnail-1000x550.png" id="VideoList-page-'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" data-sub-html="video caption1" data-html="#'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" ><img src="'.get_template_directory_uri().'/assets/build/images/video-thumbnail-260x160.png" /></li>';
							}

						  //$videoULContent .= '<li class="localVideo" data-poster="'.$video['sizes']['large'].'" id="VideoList-page-'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" data-sub-html="video caption1" data-html="#'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" ><img src="'.$video['sizes']['lg-thumbnail'].'" /></li>';

						  $videoCount ++;

				          ?>

				      <?php endforeach; ?>

			      <?php
				  //close out the UL
			      $videoULContent .= '</ul>';

				  // Dump the video content on the page!
			      echo $videoDivContent.$videoULContent; ?>

			    <?php endif; ?>

				<?php // END NEW VIDEO GALLERY CODE ?>

			<?php // endwhile; ?>


		<?php
		/*
		//////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////
		Vimeo / Youtube
		//////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////
		*/

		else :
			// prep the DIV
			$videoDivContent .= '<div';

			if($button_or_thumbnails == "button"):

				//if Button, than we need to hide the thumbnails
				$videoDivContent .= ' style="display: none;"';

				//if Button, than we need to activate the JS that will allow the button to trigger the modal window
				$galleryJSCode .= '
								$(".PageID-'.$i.'-launchGallery-'.$outerCounter.'-'.$count_01.'").click(function(){
								$(" #'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.' a:first-child").trigger("click");});';
			endif;


			$videoDivContent .= ' class="vimeo-youtube-video-gallery row small-up-'.$videoGallerySmall.' medium-up-'.$videoGalleryMedium.' large-up-'.$videoGalleryLarge.' block-container" id="'.$i.'-'.$outerCounter.'-'.$count_01.'-'.$videoCount.'" '.$videoBalancer.'>';


			while(have_rows('vimeo_youtube_gallery_v1')) : the_row();

			//data-exthumbimage will trigger if we need to pull in a custom WP thumbnail. if NULL or Empty, we pull the vimeo/Youtube thumbnail.

			$videoThumbnail = NULL;
			$exVideoThumbnail = '';
			$imageData = NULL;
			$externalImageClass = NULL;
			$videoID ='';
			$YTexThumb =NULL;
			$url = get_sub_field('vimeo_youtube_video_url');


			 /*
			This can be turned into a function if needed. but for simplicity it's here.
			* type1: http://www.youtube.com/watch?v=9Jr6OtgiOIw
			* type2: http://www.youtube.com/watch?v=9Jr6OtgiOIw&feature=related
			* type3: http://youtu.be/9Jr6OtgiOIw
			*/
			$flag = false;
			if(isset($url) && !empty($url)){
				/*case1 and 2*/
				$parts = explode("?", $url);
				if(isset($parts) && !empty($parts) && is_array($parts) && count($parts)>1){
					$params = explode("&", $parts[1]);
					if(isset($params) && !empty($params) && is_array($params)){
						foreach($params as $param){
							$kv = explode("=", $param);
							if(isset($kv) && !empty($kv) && is_array($kv) && count($kv)>1){
								if($kv[0]=='v'){
									$videoID = $kv[1];
									$flag = true;
									break;
								}
							}
						}
					}
				}

				/*case 3*/
				if(!$flag){
					$needle = "youtu.be/";
					$pos = null;
					$pos = strpos($url, $needle);
					if ($pos !== false) {
						$start = $pos + strlen($needle);
						$videoID = substr($url, $start, 11);
						$flag = true;
					}
				}
			}

			if ($flag) :
				$externalImageClass = 'YTexImage';
				$YTexThumb = '//img.youtube.com/vi/'.$videoID.'/hqdefault.jpg';

			elseif (strpos($url, 'vimeo') > 0) :
				$externalImageClass = 'VIexImage';
				$regexstr = '~
				  # Match Vimeo link and embed code
				  (?:&lt;iframe [^&gt;]*src=")?		# If iframe match up to first quote of src
				  (?:							# Group vimeo url
					  https?:\/\/				# Either http or https
					  (?:[\w]+\.)*			# Optional subdomains
					  vimeo\.com				# Match vimeo.com
					  (?:[\/\w]*\/videos?)?	# Optional video sub directory this handles groups links also
					  \/						# Slash before Id
					  ([0-9]+)				# $1: VIDEO_ID is numeric
					  [^\s]*					# Not a space
				  )							# End group
				  "?							# Match end quote if part of src
				  (?:[^&gt;]*&gt;&lt;/iframe&gt;)?		# Match the end of the iframe
				  (?:&lt;p&gt;.*&lt;/p&gt;)?		        # Match any title information stuff
				  ~ix';

				preg_match($regexstr, $url , $matches);

				$videoID = $matches[1];

			else:
				$externalImageClass = '';
			endif;

			if(get_sub_field('vimeo_youtube_privacy_setting') =='public' && get_sub_field('use_vimeo_youtube_hosted_thumbnail') == 'no' && $externalImageClass = 'VIexImage'){
				$externalImageClass = 'NoVIexImage';
			}

			$videoDivContent .= '<a data-equalizer-watch class="'.$externalImageClass.' tint gallery-item-link column" id="'.$videoID.'" href="'.get_sub_field('vimeo_youtube_video_url').'" data-sub-html="<h3>'.get_sub_field('vimeo_youtube_video_title').'</h3>'.get_sub_field('vimeo_youtube_video_caption').''.get_sub_field('vimeo_youtube_video_description').'"  ';

					//if private, we need to pull in our own image from WP
					if(get_sub_field('vimeo_youtube_privacy_setting') == 'private' || (get_sub_field('vimeo_youtube_privacy_setting') =='public' && get_sub_field('use_vimeo_youtube_hosted_thumbnail') == 'no')):


						$imageData = get_sub_field('vimeo_youtube_video_thumbnail');

						if($imageData):

							 	//$dataInterchange = ' data-interchange="['.$imageData['sizes']['lg-medium'].', default] alt='.$imageData['alt'].' width='.$imageData['width'].' height='.$imageData['height'].',['.$imageData['sizes']['lg-medium'].', small] width='.$imageData['width'].' height='.$imageData['height'].',['.$imageData['sizes']['lg-medium'].', medium] width='.$imageData['width'].' height='.$imageData['height'].',['.$imageData['sizes']['lg-medium'].', large] width='.$imageData['width'].' height='.$imageData['height'].' " src="'.$imageData['sizes']['lg-medium'].'" ';
								//$videoDivContent .= $dataInterchange;

							  	$videoThumbnail ='<div class="headline-container"><h4>'.get_sub_field('vimeo_youtube_video_title').'</h4></div><figure class="'.$effect.'"><div class="yt-thumb">					<img data-interchange="['.$imageData['sizes']['lg-medium'].', default] alt='.$imageData['alt'].' width='.$imageData['width'].' height='.$imageData['height'].',['.$imageData['sizes']['lg-medium'].', small] width='.$imageData['width'].' height='.$imageData['height'].',['.$imageData['sizes']['lg-medium'].', medium] width='.$imageData['width'].' height='.$imageData['height'].',['.$imageData['sizes']['lg-medium'].', large] width='.$imageData['width'].' height='.$imageData['height'].' "src="'.$imageData['sizes']['lg-medium'].'"/>
</div>';

						else:
							//$videoThumbnail ='<img src="'.get_template_directory_uri().'/assets/build/images/video-thumbnail-260x160.png" />';
							$videoThumbnail ='<div class="headline-container"><h4>'.get_sub_field('vimeo_youtube_video_title').'</h4></div><figure class="'.$effect.'">"<div class="yt-thumb" style="background-image: url("http://placehold.it/500x360");"></div>';
						endif;

					elseif($button_or_thumbnails == "button"):
						//$videoThumbnail ='<img src="'.get_template_directory_uri().'/assets/build/images/video-thumbnail-260x160.png"  />';
						$videoThumbnail ='<div class="headline-container"><h4>'.get_sub_field('vimeo_youtube_video_title').'</h4></div><figure class="'.$effect.'">"<div class="yt-thumb" style="background-image: url("http://placehold.it/500x360");"></div>';



					else:
						if($externalImageClass = 'YTexImage' && $YTexThumb):
							//YOUTUBE THUMBNAIL
							$videoThumbnail ='<div class="headline-container"><h4>'.get_sub_field('vimeo_youtube_video_title').'</h4></div><figure class="'.$effect.'">"<div class="yt-thumb"><img src="'.$YTexThumb.'"/></div>';
						else:
							//VIMEO THUMBNAIL
							//$videoThumbnail ='<h4>'.get_sub_field('vimeo_youtube_video_title').'</h4><figure class="'.$effect.'">"<div class="yt-thumb" style="background-image: url("http://placehold.it/500x360");"></div>';
							$videoThumbnail ='<div class="headline-container"><h4>'.get_sub_field('vimeo_youtube_video_title').'</h4></div><figure class="'.$effect.'">"<img />';
						endif;

					endif;





			$videoDivContent .= ' '.$exVideoThumbnail.'>'.$videoThumbnail.'

					<figcaption>
						<div class="icon-play"></div>
						<div class="caption-table">
							<div class="caption-row">
								<div class="caption-cell">
									<h3>'.get_sub_field('vimeo_youtube_video_title').'</h3>'.get_sub_field('vimeo_youtube_video_description').'
								</div>
							</div>
						</div>
					</figcaption>
				</figure>
			</a>';

			$videoCount ++;
			endwhile;

			$videoDivContent .= '</div>';
			echo $videoDivContent;

		?>

		<?php endif; ?>


		</div> <!-- end .columns -->

	</div> <!-- end .row -->



<?php endif; // end if nested flexible: ?>

