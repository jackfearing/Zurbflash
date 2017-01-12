<div class="gallery-section" data-equalizer-watch>

	<?php //echo '<div>', $lightbox_repeater_id , '</div>' ;?>

	<?php if (get_sub_field('component_content_headline')) {
		echo '<div class="headline-container">';
			echo '<h4>'.get_sub_field('component_content_headline').'</h4>';
			echo '<p>'.get_sub_field('component_sub_headline').'</p>';
		echo '</div>';
		}
	?>

	 <figure class="<?php echo $effect;?> post-image-container">

		<img class="post-featured-image" data-interchange=" [<?php echo $componentImage_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $componentImage_alt; ?>' width='<?php echo $componentImage_thumbnail[1]; ?>' height='<?php echo $componentImage_thumbnail[2]; ?>', [<?php echo $componentImage_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $componentImage_alt; ?>' width='<?php echo $componentImage_medium[1]; ?>' height='<?php echo $componentImage_medium[2]; ?>', [<?php echo $componentImage_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $componentImage_alt; ?>' width='<?php echo $componentImage_large[1]; ?>' height='<?php echo $componentImage_large[2]; ?>'"/>

		<figcaption>

			<div class="caption-table">
				<div class="caption-row">
					<div class="caption-cell">

						<?php if (get_sub_field('component_content_title')) {
							echo '<h3>'.get_sub_field('component_content_title').'</h3>';
							}
						?>

						<?php if (get_sub_field('component_content_description')) {
							echo get_sub_field('component_content_description');
							}
						?>

					</div> <!-- end .caption-cell -->
				</div> <!-- end .caption-row -->
			</div> <!-- end .caption-table -->

		</figcaption>

	</figure>

</div> <!-- end .gallery-section -->