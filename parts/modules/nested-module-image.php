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
	$imageBillboardWidth 		= get_sub_field('image_billboard_width');
	$imageBillboardRows 		= get_sub_field('image_billboard_rows');
	$imageBillboardHeight 		= get_sub_field('image_billboard_height');
	$imageBillboardPosition 	= get_sub_field('image_billboard_position');

	$addAnimationImage			= get_sub_field('add_animation_image');
	$animationEffectImage		= get_sub_field('animation_effect_image');
	$animationEffectOffset 		= 'data-aos-offset="300"';
	$animationEffectDelay 		= 'data-aos-delay="300"';

?>


	<?php if( get_row_layout() == 'image_component' ): // nested layout: ?>

		<div class="row <?php echo $imageBillboardWidth; ?> <?php echo $imageBillboardRows; ?> <?php echo $addAnimationImage;?>"

		<?php if (get_sub_field('add_animation_image') == 'aos-item') : // Radio Button Values ?>
			<?php echo $animationEffectImage ;?> <?php echo $animationEffectDelay ;?> <?php echo $animationEffectOffset ;?>
		<?php endif;?>

	> <!-- end .row -->

			<div class="large-12 columns">

				<?php
					$image_billboard = get_sub_field('image_billboard');
					$image_billboard_thumbnail = wp_get_attachment_image_src( $image_billboard, "mobile-small" );
					$image_billboard_medium = wp_get_attachment_image_src( $image_billboard, "mobile-medium" );
					$image_billboard_large = wp_get_attachment_image_src( $image_billboard, "mobile-large" );
					$image_billboard_alt = get_post_meta($image_billboard , '_wp_attachment_image_alt', true);
				?>

				<!-- Image background + height option -->
				<?php echo '<div style="background-position:'.$imageBillboardPosition.'; height:'.$imageBillboardHeight.'px;" class="module-background group" data-interchange=" ['.$image_billboard_thumbnail[0].', only screen and (min-width: 1px)] alt='.$alt.' width='.$image_billboard_thumbnail[1].' height='.$image_billboard_thumbnail[2].', ['.$image_billboard_medium[0].', only screen and (min-width: 40em)] alt='.$alt.' width='.$image_billboard_medium[1].' height='.$image_billboard_medium[2].', ['.$image_billboard_large[0].', only screen and (min-width: 64em)] alt='.$alt.' width='.$image_billboard_large[1].' height='.$image_billboard_large[2].'"></div>' ;?>

				<!-- Standard image insert -->
				<!-- <img data-interchange=" [<?php echo $image_billboard_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_billboard_alt; ?>' width='<?php echo $image_billboard_thumbnail[1]; ?>' height='<?php echo $image_billboard_thumbnail[2]; ?>', [<?php echo $image_billboard_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_billboard_alt; ?>' width='<?php echo $image_billboard_medium[1]; ?>' height='<?php echo $image_billboard_medium[2]; ?>', [<?php echo $image_billboard_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_billboard_alt; ?>' width='<?php echo $image_billboard_large[1]; ?>' height='<?php echo $image_billboard_large[2]; ?>'"/> -->

			</div> <!-- end .columns -->

		</div> <!-- end .row -->

	<?php endif; ?>

