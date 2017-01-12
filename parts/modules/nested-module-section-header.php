<?php // conditional statement using radio button for section header
	if (get_sub_field('section_header_module') =='header-featured') :?>

		<?php echo '<h3>'.$radioButton.'</h3>'; ?>

		<?php if(get_sub_field('header_section_content')){
			echo get_sub_field('header_section_content');
			}
		?>

	<?php elseif (get_sub_field('section_header_module') =='header-section') :?>

		<?php echo '<h3>'.$radioButton.'</h3>'; ?>

		<?php if(get_sub_field('header_section_content')){
			echo get_sub_field('header_section_content');
			}
		?>

	<?php elseif (get_sub_field('section_header_module') =='header-none') :?>

		<?php echo '<h3>'.$radioButton.'</h3>'; ?>

	<?php else :?>

	<?php // CONTENT GOES HERE ?>

<?php endif; // end header-featured ?>
