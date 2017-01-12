<?php // conditional statement using radio button for section header
	if (get_sub_field('section_header_module') =='Header Featured') :?>

	<div class="header-featured">

		<h2>Header Featured</h2>

<?php endif; ?>


<?php // conditional statement using radio button for section header
	if (get_sub_field('section_header_module') =='Header Section') :?>

		<h2>HEADER SECTION</h2>

<?php endif; ?>


<?php // conditional statement using radio button for section header
	if (get_sub_field('section_header_module') =='None') :?>

		<h2>NONE</h2>

<?php endif; ?>