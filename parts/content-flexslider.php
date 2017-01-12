<div class="flex-wrapper">

	<?php // Gallery //http://www.advancedcustomfields.com/resources/gallery/

	$images = get_field('slider');

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

</div> <!-- end .flex-wrapper -->
