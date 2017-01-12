<div class="large-12 medium-6 columns">

	<div class="sidebar-callout" data-equalizer-watch>


<!--
		<?php if (get_sub_field('clone_test_headline', 'options')) {
			echo '<h3>' , get_sub_field('clone_test_headline') , '</h3>'; // sub field:
			}
		?>

		<?php if (get_sub_field('clone_master', 'options')) {
			echo the_sub_field('clone_master'); // sub field:
			}
		?>

		<?php if( have_rows('sidebar_module', 'options') ): // field: Flexible ?>

			<?php while ( have_rows('sidebar_module', 'options') ) : the_row(); // field: Flexible ?>

				<?php if (get_sub_field('clone_flex', 'options')) {
					echo '<h3>' , get_sub_field('clone_flex') , '</h3>'; // sub field:
					}
				?>

				<?php if (get_sub_field('clone_flex_content', 'options')) {
					echo get_sub_field('clone_flex_content'); // sub field:
					}
				?>

		    <?php endwhile; ?>

		<?php endif; ?>
-->



		<?php if (get_sub_field('sidebar_image')) :?>

		    <img data-interchange="
			    [<?php echo $image_thumbnail_sb[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $alt_sb; ?>' width='<?php echo $image_thumbnail_sb[1]; ?>' height='<?php echo $image_thumbnail_sb[2]; ?>',
			    [<?php echo $image_medium_sb[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $alt_sb; ?>' width='<?php echo $image_medium_sb[1]; ?>' height='<?php echo $image_medium_sb[2]; ?>',
			    [<?php echo $image_large_sb[0]; ?>, only screen and (min-width: 929px)] alt='<?php echo $alt_sb; ?>' width='<?php echo $image_large_sb[1]; ?>' height='<?php echo $image_large_sb[2]; ?>'"
				src="<?php echo $image_thumbnail_sb[0]?>"
			/>

		<?php else :?>

		<?php endif ;?>

		<?php if (get_sub_field('sidebar_headline', 'options')) {
			echo '<h3>' , get_sub_field('sidebar_headline') , '</h3>'; // sub field:
			}
		?>
		<?php if (get_sub_field('sidebar_description', 'options')) {
			echo the_sub_field('sidebar_description'); // sub field:
			}
		?>

		<?php // conditional statement using radio button for section header
			if (get_sub_field('sidebar_link_select') =='sidebar-none') :?>

				<?php //echo 'something goes here' ;?>

		<?php elseif (get_sub_field('sidebar_link_select') =='sidebar-file') :?>

			<?php //echo '<a href="' , $sidebarFile['url'] ,'" target="_blank">' ;?>
				<?php //echo '<div class="button">', $sidebarFileButton ,'</div>'; // Display sidebar field name ?>
			<?php //echo '</a>'; ?>

		<?php elseif (get_sub_field('sidebar_link_select') =='sidebar-link') :?>

			<?php //echo '<div class="button">', $sidebarFileButton ,'</div>'; // Display sidebar field name ?>

		<?php else :?>

				<?php //echo 'something goes here' ;?>

		<?php endif; ?>


	</div> <!-- end .sidebar-callout -->

</div> <!-- end .columns -->
