<?php
/*
Template Name: Snippets
*/
?>

<?php get_header(); ?>




<?php

$table = get_field( 'table_layout' );

if ( $table ) {

    echo '<table class="acf-table" border="0">';

        if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table>';
}


?>




<h2>FONT AWESOME</h2>
<?php if(get_field('font_awesome')){
	echo '<li class="font-awesome">'.get_field('font_awesome').' This is a line item using ACF Font Awesome</li>';
	}
?>








<?php // Relationship - Basic loop (with setup_postdata)

$postsCustom = get_field('navigation_relationship', 'options');

if( $postsCustom ): ?>

	<p class="button"><a data-open="navigation">Click me for a modal navigation</a></p>

	<!-- http://zurb.com/playground/motion-ui -->
	<div class="reveal bounce-in" id="navigation" data-reveal data-close-on-click="true" data-animation-in="slide-in-down" data-animation-out="slide-out-up">

		<div class="row">

			<div class="large-12 columns">

			    <?php foreach( $postsCustom as $post): // variable must be called $post (IMPORTANT) ?>

			        <?php setup_postdata($post); ?>

						<?php if(get_field('navigation_title')){
							echo '<h2>'. get_field('navigation_title') .'</h2>';
							}
						?>

						<?php if(get_field('navigation_image')):?>

							<?php
								$attachment_id_2 = get_field('navigation_image');
								$image_thumbnail_2 = wp_get_attachment_image_src( $attachment_id_2, "thumbnail" );
								$image_medium_2 = wp_get_attachment_image_src( $attachment_id_2, "full" );
								$image_large_2 = wp_get_attachment_image_src( $attachment_id_2, "full" );
								$alt_2 = get_post_meta($attachment_id_2 , '_wp_attachment_image_alt', true);
							?>

							<div class="featured-logo group">
								<img data-interchange=" [<?php echo $image_thumbnail_2[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $alt_2; ?>' width='<?php echo $image_thumbnail_2[1]; ?>' height='<?php echo $image_thumbnail_2[2]; ?>', [<?php echo $image_medium_2[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $alt_2; ?>' width='<?php echo $image_medium_2[1]; ?>' height='<?php echo $image_medium_2[2]; ?>', [<?php echo $image_large_2[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $alt_2; ?>' width='<?php echo $image_large_2[1]; ?>' height='<?php echo $image_large_2[2]; ?>'"/>
							</div> <!-- end .featured-logo -->

						<?php endif; ?>

						<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							}
						?>
						<?php the_title('<h2>','</h2>'); ?>
										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				    	<?php the_excerpt(); ?>

				<?php endforeach; ?>

			</div>  <!-- end .columns -->

		</div> <!-- end .row -->

		<button class="close-button" data-close aria-label="Close modal" type="button">

			<span aria-hidden="true">&times;</span>

		</button> <!-- end .close-button -->

	</div> <!-- end .reveal -->

    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

	<?php else : ?>

		<?php // _e( 'Sorry, no posts matched your criteria.', 'jointswp' ); ?>

<?php endif; // end $postsCustom ?>










<?php if( have_rows('flexible_section') ): // field label: ?>

	<?php while ( have_rows('flexible_section') ) : the_row(); // field label: ?>

	        <?php if( get_row_layout() == 'flexible_module' ): // layout: ?>


		    	<?php if (get_sub_field('flexible_section_header')) {
					echo '<h2>'.get_sub_field('flexible_section_header').'</h2>';
					}
				?>





				<?php if( have_rows('flexible_nested') ): // nested field label: ?>

					<?php $outerCounter = 0; ?>

					<?php while ( have_rows('flexible_nested') ) : the_row(); // nested field label: ?>

					<?php $outerCounter ++; ?>

					        <?php if( get_row_layout() == 'flexible_nested_module' ): // nested layout: ?>

						    	<?php if (get_sub_field('button_text')) {
									echo '<h3>'.get_sub_field('button_text').'</h3>';
									}
								?>



								<?php if( have_rows('repeater_group') ): $count_01 = 0; // START REPEATER ROWS ?>



										<?php while( have_rows('repeater_group') ): $count_01++; the_row();

											// vars
											$content = get_sub_field ('repeater_text');
											$videos = get_sub_field ('repeater_video');

											?>



<!--
								<?php echo '<script>
								$(document).ready(function() {
								 $(".html5-videos-', $outerCounter ,'-', $count_01 ,'").lightGallery();
								});
								</script>'; ?>
-->

								<?php echo '<script>
								$(document).ready(function() {
									$(".html5-videos-', $outerCounter ,'-', $count_01 ,'").lightGallery();
									$(".launchGallery-', $outerCounter ,'-', $count_01 ,'").click(function(){
									    $(".firstVideo-', $outerCounter ,'-', $count_01 ,'").trigger("click");
									});
								});
								</script>'; ?>

								<?php echo '<a class="button-reveal launchGallery-', $outerCounter ,'-', $count_01 ,'" type="button">',$content,'</a>'; ?>








											<?php if( $videos ): ?>

											<?php foreach( $videos as $video ): $count_01++ ?>
						                    	<?php //echo $video['url']; ?>

											<div style="display:none;" id="<?php echo $outerCounter ,'-', $count_01 ?>">
											    <video class="lg-video-object lg-html5" controls>
											        <source src="<?php echo $video['url']; ?>" type="<?php echo $video['mime_type']; ?>">
											         Your browser does not support HTML5 video.
											    </video>
											</div>

						                    <?php endforeach; ?>

						                    <?php endif; ?>


												<?php if( $videos ): $count_01 = 1;?>

												<ul class="html5-videos-<?php echo $outerCounter ,'-', $count_01 ?>">

													<?php foreach( $videos as $video ): $count_01++ ?>
													  <li class="firstVideo-1-1" data-poster="http://placehold.it/400x200" data-sub-html="video caption1" data-html="#<?php echo $outerCounter ,'-', $count_01; ?>" >
													      <img src="http://placehold.it/400x200" />
													  </li>


								                    <?php endforeach; ?>
												</ul> <!-- end .html5-videos -->

							                    <?php endif; ?>





											<?php echo '<a data-toggle="', $outerCounter ,'-', $count_01 ,'" class="button-reveal display">', $content ,'</a>';?>

												<?php echo '<div class="reveal bounce-in" id="', $outerCounter ,'-', $count_01 ,'" data-reveal data-close-on-click="true" data-animation-in="hinge-in-from-middle-y">'; ?>

													<?php echo $content ?>

													<?php echo '<button class="close-button" data-close aria-label="Close reveal" type="button"><span aria-hidden="true">&times;</span></button>'; ?>

												<?php echo '</div>'; ?>


											<li>
											    <?php echo $content; // END REPEATER ROWS ?>
										    </li>

										<?php endwhile; ?>

								<?php endif; ?>


						<?php endif; // end if nested flexible: ?>

					<?php endwhile; // end nested flexible: ?>

				<?php endif; // end if nested flexible: ?>

















			<?php elseif( get_row_layout() == 'layout_field_name' ): // layout: ?>

				<?php if(get_sub_field('sub_field_name')){
					echo get_sub_field('sub_field_name');
					}
				?>

		<?php endif; // end if flexible: ?>

	<?php endwhile; // end flexible: ?>

	<?php else : ?>

	<?php //CONTENT GOES HERE ?>

<?php endif; ?>

<?php wp_reset_query(); ?>













































<h2>CENTERING @MIXIN SNIPPETS</h2>

<div class="parent">
  <div class="child both">I'm centered on both axis!</div>
</div>

<div class="parent">
  <div class="child top">I'm centered top!</div>
</div>

<div class="parent">
  <div class="child right">I'm centered right!</div>
</div>

<div class="parent">
  <div class="child bottom">I'm centered bottom!</div>
</div>

<div class="parent">
  <div class="child left">I'm centered left!</div>
</div>



<p>Wordpress (ACF with Gallery and Flexslider)</p>

<div class"flex-container">

	<?php // Gallery //http://www.advancedcustomfields.com/resources/gallery/

	$images = get_field('image_gallery');

	if( $images ): ?>

			<section class="flexslider">

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

				<ul class="custom-controls">
					<?php foreach( $images as $image ): ?>
						<li><a href="#"></a></li>
					<?php endforeach; ?>
				</ul>

			</div> <!-- end .group -->

	   <!--?php var_dump($images); // Used to pull the values above ?-->

	<?php endif; ?>

</div> <!-- end .flex-container -->

<h1>END</h1>


<p><button type="button" class="button" data-toggle="motion-example-1" aria-controls="motion-example-1">Fade</button><button type="button" class="button" data-toggle="motion-example-2" aria-controls="motion-example-2">Slide</button></p>


<div class="row">
  <div class="small-6 columns">
    <div data-toggler="s953hi-toggler" data-animate="fade-in fade-out" class="callout secondary ease" id="motion-example-1" aria-expanded="true" style="display: block; transition: 0ms; -webkit-transition: 0ms;">
      <p>This panel <strong>fades</strong>.</p>
    </div>
  </div>
  <div class="small-6 columns">
    <div data-toggler="sup0qc-toggler" data-animate="slide-in-down slide-out-up" class="callout secondary ease" id="motion-example-2" aria-expanded="true" style="display: block; transition: 0ms; -webkit-transition: 0ms;">
      <p>This panel <strong>slides</strong>.</p>
    </div>
  </div>
</div>








<p><a data-toggle="animatedModal10">Click me for a modal</a></p>

<div class="reveal" id="animatedModal10" data-reveal data-close-on-click="true" data-animation-in="spin-in" data-animation-out="spin-out">
  <h1>Whoa, I'm dizzy!</h1>
  <p class='lead'>There are many options for animating modals, check out the Motion UI library to see them all</p>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



<p><a data-open="exampleModal2">Click me for a modal</a></p>

<!-- This is the first modal -->
<div class="reveal" id="exampleModal2" data-reveal>
  <h1>Awesome!</h1>
  <p class="lead">I have another modal inside of me!</p>
  <a class="button" data-open="exampleModal3">Click me for another modal!</a>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- This is the nested modal -->
<div class="reveal" id="exampleModal3" data-reveal>
  <h2>ANOTHER MODAL!!!</h2>
		<div class="flex-video widescreen vimeo">
			<iframe width="1280" height="720" src="//www.youtube-nocookie.com/embed/wnXCopXXblE?rel=0" frameborder="0" allowfullscreen></iframe>
		</div> <!-- end #videoModalTitle -->
  <button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


	<p><a data-toggle="exampleModal12">Click me for a modal #2</a></p>

	<div class="reveal" id="exampleModal12" data-reveal data-reset-on-close="true">
		<h2 id="videoModalTitle">This modal has video</h2>
		<div class="flex-video widescreen vimeo">
			<iframe width="1280" height="720" src="//www.youtube-nocookie.com/embed/wnXCopXXblE?rel=0" frameborder="0" allowfullscreen></iframe>
		</div> <!-- end #videoModalTitle -->
		<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> <!-- end .reveal -->





<section class="wow slideInLeft" data-wow-duration="2s" data-wow-delay="1s" style="visibility: hidden;">
  <ul><li>Text1</li></ul></section>
<section class="wow slideInLeft" data-wow-duration="2s" data-wow-delay="1.5s" style="visibility: hidden;"><ul><li>Text2</li></ul></section>
<section class="wow slideInLeft" data-wow-duration="2s" data-wow-delay="2s" style="visibility: hidden;"><ul><li>Text3</li></ul></section>


<section class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="5s" style="visibility: hidden;">
	<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h2>
</section>




<button id="launchGallery" type="button">Launch Gallery</button>
<ul id="lightGallery">
    <li id="firstImage" data-src="http://placehold.it/200x200">
	    <img class="img-responsive" src="http://placehold.it/200x200">
    </li>
    <li data-src="http://placehold.it/200x200">
	    <img class="img-responsive" src="http://placehold.it/200x200">
    </li>
</ul>



<h2>ACF FLEXIBLE LAYOUT GALLERY - LIGHT GALLERY SIMPLIFIED</h2>

<?php if( have_rows('flex_gallery') ): // field label: ?>

	<?php while ( have_rows('flex_gallery') ) : the_row(); // field label: ?>

        <?php if( get_row_layout() == 'flexible_gallery' ): // layout: ?>

			<?php // (Buttons with Media Light Gallery)

				$images_gallery_flex = get_sub_field('flex_gallery'); // ACF - Gallery Field
				$gallery_name_flex = get_sub_field ('flex_gallery_button');  // ACF - Text Field
			?>

			<?php if( $images_gallery_flex ): // field label var: ?>

				<script>
					$(document).ready(function() {
						$(".lightGallery").lightGallery();
						$(".launchGallery").click(function(){
						    $(".firstImage").trigger("click");
						});
					});
				</script>

				<button class="launchGallery" type="button"><?php echo $gallery_name_flex; // field label var: ?></button>

				<div class="lightGallery">

					<ul class="custom-transitions group">

						<?php foreach( $images_gallery_flex as $images_gallery_flex_item ): ?>

							<li data-exthumbimage="<?php echo $images_gallery_flex_item['sizes']['thumbnail'];?>" class="firstImage" data-src="<?php echo $images_gallery_flex_item['sizes']['large-desktop'];?>" data-sub-html="<h4><?php echo $images_gallery_flex_item['title']; ?></h4><p><?php echo $images_gallery_flex_item['caption']?></p>" >

									<!-- Standard Single Image -->
									<!-- <a href=""><img class="img-responsive" src="<?php echo $image_gallery_item['sizes']['medium'] ?>"></a> -->

									<!-- Responsive Images-->
									<a href=""><img data-interchange="[<?php echo $images_gallery_flex_item['sizes']['large-desktop']; ?>, default] alt=<?php echo $images_gallery_flex_item['alt'];?> width=<?php echo $images_gallery_flex_item['width'];?> height=<?php echo $images_gallery_flex_item['height'];?>,[<?php echo $images_gallery_flex_item['sizes']['mobile-small']; ?>, small] width=<?php echo $images_gallery_flex_item['width'];?> height=<?php echo $images_gallery_flex_item['height'];?>,[<?php echo $images_gallery_flex_item['sizes']['mobile-medium']; ?>, medium] width=<?php echo $images_gallery_flex_item['width'];?> height=<?php echo $images_gallery_flex_item['height'];?>,[<?php echo $images_gallery_flex_item['sizes']['thumbnail']; ?>, large] width=<?php echo $images_gallery_flex_item['width'];?> height=<?php echo $images_gallery_flex_item['height'];?>"src="<?php echo $images_gallery_flex_item['sizes']['large-desktop']; ?>"/></a>

									<div class="demo-gallery-poster">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/build/images/zoom.png">
									</div>

							</li>

						<?php endforeach; ?>

					</ul> <!-- end .custom-transitions -->

				</div> <!-- end .lightGallery -->

			<?php endif; ?>

		<?php endif; // end if flexible: ?>

	<?php endwhile; // end flexible: ?>

	<?php else : ?>

	<?php //CONTENT GOES HERE ?>

<?php endif; ?>

<?php wp_reset_query(); ?>





















<h2>ACF GALLERY - SINGLE LIGHT GALLERY SIMPLIFIED</h2>

<?php // (Buttons with Media Light Gallery)

	$images_gallery = get_field('lb_image_gallery'); // ACF - Gallery Field
	$gallery_name_01 = get_field ('lb_image_gallery_button');  // ACF - Text Field
?>

	<?php if( $images_gallery ): // field label var: ?>

		<script>
			$(document).ready(function() {
				$(".lightGallery").lightGallery();
				$(".launchGallery").click(function(){
				    $(".firstImage").trigger("click");
				});
			});
		</script>

		<button class="launchGallery" type="button"><?php echo $gallery_name_01; // field label var: ?></button>

		<div class="lightGallery">

			<ul class="custom-transitions group">

				<?php foreach( $images_gallery as $image_gallery_item ): ?>

					<li data-exthumbimage="<?php echo $image_gallery_item['sizes']['thumbnail'];?>" class="firstImage" data-src="<?php echo $image_gallery_item['sizes']['large-desktop'];?>" data-sub-html="<h4><?php echo $image_gallery_item['title']; ?></h4><p><?php echo $image_gallery_item['caption']?></p>" >

							<!-- Standard Single Image -->
							<!-- <a href=""><img class="img-responsive" src="<?php echo $image_gallery_item['sizes']['medium'] ?>"></a> -->

							<!-- Responsive Images-->
							<a href=""><img data-interchange="[<?php echo $image_gallery_item['sizes']['large-desktop']; ?>, default] alt=<?php echo $image_gallery_item['alt'];?> width=<?php echo $image_gallery_item['width'];?> height=<?php echo $image_gallery_item['height'];?>,[<?php echo $image_gallery_item['sizes']['mobile-small']; ?>, small] width=<?php echo $image_gallery_item['width'];?> height=<?php echo $image_gallery_item['height'];?>,[<?php echo $image_gallery_item['sizes']['mobile-medium']; ?>, medium] width=<?php echo $image_gallery_item['width'];?> height=<?php echo $image_gallery_item['height'];?>,[<?php echo $image_gallery_item['sizes']['medium']; ?>, large] width=<?php echo $image_gallery_item['width'];?> height=<?php echo $image_gallery_item['height'];?>"src="<?php echo $image_gallery_item['sizes']['large-desktop']; ?>"/></a>

					</li>

				<?php endforeach; ?>

			</ul> <!-- end .custom-transitions -->

		</div> <!-- end .lightGallery -->

	<?php endif; ?>





<h2>ACF GALLERY - LIGHT GALLERY</h2>

	<?php // Repeater (Buttons with Media Gallery)

		$images_gallery = get_field('lb_image_gallery');
		$gallery_name_01 = get_field ('lb_image_gallery_button');

		if( $gallery_name_01 ):

			echo '<script>
			$(document).ready(function() {
				$(".lightGallery").lightGallery();
				$(".launchGallery-', 'lightgallery' ,'-', 'outerCounter' ,'-', 'count_06' ,'").click(function(){
				    $(".firstImage-', 'lightgallery' ,'-', 'outerCounter' ,'-', 'count_06' ,'").trigger("click");

				});
			});
			</script>';

			echo '<a class="button-reveal launchGallery-', 'lightgallery' ,'-', 'outerCounter' ,'-', 'count_06' ,'" type="button">', $gallery_name_01 ,'</a>';

			echo '<div class="lightGallery">';

				echo '<ul class="custom-transitions group">';

				foreach( $images_gallery as $image_gallery_item ):

					echo '<li data-exthumbimage="',$image_gallery_item['sizes']['thumbnail'],'" class="firstImage-', 'lightgallery' ,'-', 'outerCounter' ,'-', 'count_06' ,'" data-src="', $image_gallery_item['sizes']['large-desktop'] ,'" data-sub-html="<h4>',$image_gallery_item['title'],'</h4><p>',$image_gallery_item['caption'],'</p>">';

						echo '<a href="">
								<img class="img-responsive" src="', $image_gallery_item['sizes']['medium'] ,'">
							</a>';

					echo '</li>';

				endforeach;

		    echo '</ul>'; //end .custom-transitions

		echo '</div>'; // end .light-gallery

		endif;

	?>










<h2>Image Gallery</h2>
	<div class="light-gallery">
	    <ul class="custom-transitions group">
	        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="http://placehold.it/200x200 500, http://placehold.it/300x300 600, http://placehold.it/400x400 700" data-src="http://placehold.it/800x1500" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	            <a href="">
	                <img class="img-responsive" src="http://placehold.it/200x200">
	            </a>
	        </li>
	        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="http://placehold.it/200x200 500, http://placehold.it/300x300 600, http://placehold.it/400x400 700" data-src="http://placehold.it/1600x1000" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	            <a href="">
	              <img class="img-responsive" src="http://placehold.it/200x200">
	            </a>
	        </li>
	        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/13-375.jpg 375, img/13-480.jpg 480, img/13.jpg 800" data-src="http://placehold.it/1600x500" data-sub-html="<h4>Excerpt fpr the image above</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time....</p>">
	            <a href="">
	              <img class="img-responsive" src="http://placehold.it/200x200">
	            </a>
	        </li>
	        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="img/4-375.jpg 375, img/4-480.jpg 480, img/4.jpg 800" data-src="http://placehold.it/1200x800" data-sub-html="<h4>Surise today</h4><p>A beautiful Sunrise this morning taken En-route to Keswick not one as planned but I'm extremely happy I was passing the right place at the right time ....</p>">
	            <a href="">
	              <img class="img-responsive" src="http://placehold.it/200x200">
	            </a>
	        </li>
	    </ul> <!-- end .custom-transitions -->
	</div> <!-- end .light-gallery -->


<h2>Local Video Test Gallery</h2>




<div style="display:none;" id="video1">
    <video class="lg-video-object lg-html5" controls>
        <source src="http://local.zurb62/wp-content/uploads/2016/03/Apple-Designed-By-Apple-Intention.mp4" type="video/mp4">
         Your browser does not support HTML5 video.
    </video>
</div>
<div style="display:none;" id="video2">
    <video class="lg-video-object lg-html5" controls>
        <source src="http://local.zurb62/wp-content/uploads/2016/03/color_mirror.mov" type="video/mp4">
         Your browser does not support HTML5 video.
    </video>
</div>
<div style="display:none;" id="video3">
    <video class="lg-video-object lg-html5" controls>
        <source src="http://local.zurb62/wp-content/uploads/2016/03/vc_title_wb.mov" type="video/mp4">
         Your browser does not support HTML5 video.
    </video>
</div>

<!-- data-src should not be provided when you use html5 videos -->
<ul id="html5-videos">
  <li data-poster="http://placehold.it/400x200" data-sub-html="video caption1" data-html="#video1" >
      <img src="http://placehold.it/400x200" />
  </li>
  <li data-poster="http://placehold.it/400x200" data-sub-html="video caption2" data-html="#video2" >
      <img src="http://placehold.it/400x200" />
  </li>
  <li data-poster="http://placehold.it/400x200" data-sub-html="video caption3" data-html="#video3" >
      <img src="http://placehold.it/400x200" />
  </li>
</ul>



<h2>Video Gallery</h2>
	 <!-- end remove data-poster image to autoplay videos
		 data-poster="http://placehold.it/400x200"
	 -->
	<div class="light-gallery" id="video-thumbnails">

		<div class="video-gallery">

			<a href="https://youtu.be/UdddIJd3bLc">
				<img class="img-responsive" src="http://placehold.it/400x200">
			</a>
	        <span data-responsive="http://placehold.it/200x200 500, http://placehold.it/300x300 600, http://placehold.it/400x400 700" data-src="http://placehold.it/1600x1000" data-sub-html="<h4>Fading Light</h4><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
	            <a href="">
	              <img class="img-responsive" src="http://placehold.it/200x200">
	            </a>
	        </span>

			<a href="https://youtu.be/D9TpswDIBS8"  >
				<img class="img-responsive" src="http://placehold.it/400x200">
			</a>

			<a href="https://vimeo.com/1084537" data-poster="http://placehold.it/400x200">
				<img class="img-responsive" src="http://placehold.it/400x200">
			</a>
		</div> <!-- end .video-gallery -->

	</div> <!-- end .light-gallery -->


<div class="light-gallery" id="video-thumbnails">
	<div class="video-gallery">
	  <a href="https://www.youtube.com/watch?v=meBbDqAXago" >
		<img class="img-responsive" src="http://placehold.it/100x100">
	  </a>
	  <a href="https://vimeo.com/1084537" >
		<img class="img-responsive" src="http://placehold.it/100x100">
	  </a>

	</div>
</div>

<div class="light-gallery" id="video-thumbnails">
	<div class="video-gallery">
	  <a href="https://www.youtube.com/watch?v=meBbDqAXago" >
		<img class="img-responsive" src="http://placehold.it/100x100">
	  </a>
	  <a href="https://vimeo.com/1084537" >
		<img class="img-responsive" src="http://placehold.it/100x100">
	  </a>

	</div>
</div>


	<div class="tab-container">

		<ul role="tablist" class="tabs">
			<li><a role="tab" class="tab" href="#tab-1">Dizzy</a></li>
			<li><a role="tab" class="tab" href="#tab-2">Ninja</a></li>
			<li><a role="tab" class="tab" href="#tab-3">Missy</a></li>
		</ul>

		<div class="tab-content">

			<section role="tabpanel" id="tab-1">
				<div class="content-wrapper">
					<img src="http://placehold.it/400x200" alt="FPO Image"/>
					<h1>TAB #1 (Deep Linking)</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div> <!-- end .content-wrapper -->
			</section> <!-- end tabspanel -->

			<section role="tabpanel" id="tab-2">
				<div class="content-wrapper">
					<img src="http://placehold.it/200x400" alt="FPO Image"/>
					<h1>TAB #2 (Deep Linking)</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div> <!-- end .content-wrapper -->
			</section> <!-- end tabspanel -->

			<section role="tabpanel" id="tab-3">
				<div class="content-wrapper">
					<img src="http://placehold.it/800x200" alt="FPO Image"/>
					<h1>TAB #3 (Deep Linking)</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div> <!-- end .content-wrapper -->
			</section> <!-- end tabspanel -->

	  </div> <!-- end .tab-content -->

	</div> <!-- end tab-container -->







	<ul class="tabs" data-tabs id="example-tabs">
	  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Tab 1</a></li>
	  <li class="tabs-title"><a href="#panel2">Tab 2</a></li>
	  <li class="tabs-title"><a href="#panel3">Tab 3</a></li>
	</ul> <!-- end .tabs -->


	<div class="tabs-content" data-tabs-content="example-tabs">

		<section class="tabs-panel is-active" id="panel1">
			<div class="content-wrapper">
				<p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
			</div> <!-- end .content-wrapper -->
		</section>

		<section class="tabs-panel" id="panel2">
			<div class="content-wrapper">
				<p>arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
			</div> <!-- end .content-wrapper -->
		</section>

		<section class="tabs-panel" id="panel3">
			<div class="content-wrapper">
				<p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
			</div> <!-- end .content-wrapper -->
		</section>

	</div> <!-- end .tabs-content -->

	<div class="row">
	    <div class="large-12 columns">
	        <div class="panel">
	           <p>Normal row with fixed column span</p>
	        </div> <!-- end .panel -->
	    </div> <!-- end .columns -->
	</div> <!-- end .full-width -->


	<div class="row full-width">
	    <div class="large-12 columns">
	        <div class="panel">
	           <p>Full width bar with only 1 class added to the row</p>
	        </div> <!-- end .panel -->
	    </div> <!-- end .columns -->
	</div> <!-- end .full-width -->

	<div class="row">
	    <div class="large-12 columns">
	        <div class="panel">
	           <p>Normal row with fixed column span</p>
	        </div> <!-- end .panel -->
	    </div> <!-- end .columns -->
	</div> <!-- end .full-width -->


	<?php //Make sure assets have been loaded ?>

	<svg class="notification"><use xlink:href="#icon-notification"/></svg>

	<svg class="notification"><use xlink:href="#icon-notification"/></use></svg>
	<svg class="chat-active"><use xlink:href="#icon-chat-active"/></use></svg>
	<svg class="pin"><use xlink:href="#icon-pin"/></use></svg>
	<svg><use xlink:href="#icon-pin"/></use></svg>
	<svg><use xlink:href="#icon-folder"/></use></svg>

	<ul>
		<li class="facebook"><a href="#"><svg><use xlink:href="#icon-car"/></use></svg>Money hand icon for list </a></li>
		<li class="facebook"><svg><use xlink:href="#icon-car"/></use></svg>Money hand icon for list </li>
		<li class="facebook"><svg><use xlink:href="#icon-alarm"/></use></svg>Money hand icon for list </li>
		<li class="facebook"><svg><use xlink:href="#icon-notification"/></use></svg>Money hand icon for list </li>
		<li class="facebook"><svg><use xlink:href="#icon-folder"/></use></svg>Money hand icon for list </li>

	</ul>




	<p><a data-open="exampleModal1">Click me for a modal</a></p>

	<div class="reveal" id="exampleModal1" data-reveal>
		<h1>Awesome. I Have It.</h1>
		<p class="lead">Your couch. It is mine.</p>
		<p>I'm a cool paragraph that lives inside of an even cooler modal. Wins! Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Aenean lacinia bibendum nulla sed consectetur. Donec sed odio dui.Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Aenean lacinia bibendum nulla sed consectetur. Donec sed odio dui.</p>
		<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> <!-- end .reveal -->



	<p><a data-open="exampleModal1">Click me for a modal</a></p>

	<div class="reveal" id="exampleModal1" data-reveal>
		<h1>Awesome. I Have It.</h1>
		<p class="lead">Your couch. It is mine.</p>
		<p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
		<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> <!-- end .reveal -->


	<p><a data-toggle="exampleModal12">Click me for a modal</a></p>

	<div class="reveal" id="exampleModal12" data-reveal data-reset-on-close="true">
		<h2 id="videoModalTitle">This modal has video</h2>
		<div class="flex-video widescreen vimeo">
			<iframe width="1280" height="720" src="//www.youtube-nocookie.com/embed/wnXCopXXblE?rel=0" frameborder="0" allowfullscreen></iframe>
		</div> <!-- end #videoModalTitle -->
		<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div> <!-- end .reveal -->





	<a href="#" class="button radius">TEST BUTTON RADIUS</a>

	<ul class="tabs" data-tabs id="example-tabs">
	  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Tab 1</a></li>
	  <li class="tabs-title"><a href="#panel2">Tab 2</a></li>
	  <li class="tabs-title"><a href="#panel3">Tab 3</a></li>
	</ul> <!-- end .tabs -->


	<div class="tabs-content" data-tabs-content="example-tabs">

	  <section class="tabs-panel is-active" id="panel1">
		  <div class="content-wrapper">
	    <p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
	    </div> <!-- end .tabs-panel -->
	  </section>

	  <section class="tabs-panel" id="panel2">
		  <div class="content-wrapper">
	    <p>arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
	    </div> <!-- end .tabs-panel -->
	  </section>

	  <section class="tabs-panel" id="panel3">
		  <div class="content-wrapper">
	    <p>Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
	    </div> <!-- end .tabs-panel -->
	  </section>

	</div> <!-- end .tabs-content -->



	<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-8 columns" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		    <?php get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
