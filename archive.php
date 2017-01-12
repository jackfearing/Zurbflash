<?php get_header(); ?>







<?php
 // Post is assigned to "blog" category or any descendant of "blog" category?
 // we need to get the category name and then get the category ID from the name
 // Needs custom function snipper to work located in 'custom-functions.php'
 $category_name = 'blog';
 $category_to_check = get_term_by( 'name', $category_name, 'category' );?>
<?php if ( in_category( $category_name ) || post_is_in_descendant_category( $category_to_check->term_id ) ):?>
    <h2>Success</h2>
<?php else:?>
	<h2>not the blog parent or child category</h2>
<?php endif;?>



<!--
<?php if (is_category('blog')) : ?>
	<h1 class="page-title"><?php single_cat_title();?></h1>
	<p><strong><?php single_cat_title();?></strong> is the name of the current category</p>

	<?php
	  $taxonomy = get_queried_object();
	  echo  $taxonomy->name;
	?>

	<?php elseif (is_category('category_name_02')) : ?>
		<h1 class="page-title"><?php single_cat_title();?></h1>
		<p><strong><?php single_cat_title();?></strong> is the name of the current category</p>

	<?php
	  $taxonomy = get_queried_object();
	  echo  $taxonomy->name;
	?>

<?php else : ?>

	<p><strong>NOT BLOG CATEGORY:</strong>This is some generic text to describe all other category pages, I could be left blank</p>

<?php endif; ?>
-->



<?php
	$taxonomy = get_queried_object();

	$title = get_field('category_title', $taxonomy );
	//$image = get_field('category_header', $taxonomy );
	$description = get_field('category_description', $taxonomy );

	$attachment_id = get_field('category_header', $taxonomy);
	$image_thumbnail = wp_get_attachment_image_src( $attachment_id, "callout-mobile-small" );
	$image_medium = wp_get_attachment_image_src( $attachment_id, "callout-mobile-medium" );
	$image_large = wp_get_attachment_image_src( $attachment_id, "callout-desktop-large" );
	$alt = get_post_meta($attachment_id , '_wp_attachment_image_alt', true);

	$image_featured 			= get_field('category_header', $taxonomy);
	$image_featured_thumbnail 	= wp_get_attachment_image_src( $image_featured, "mobile-small" );
	$image_featured_medium 		= wp_get_attachment_image_src( $image_featured, "mobile-medium" );
	$image_featured_large 		= wp_get_attachment_image_src( $image_featured, "retina-large" );
	$image_featured_alt 		= get_post_meta($image_featured , '_wp_attachment_image_alt', true);

?>
	<?php //echo '<h4>'.$title.'</h4>'; ?>
	<?php //echo '<div class="category-description">'.$description.'</div>'; ?>

<!--
<div class="header-category-container">
<img data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'"/>
</div>
-->

<?php
	$archiveHeaderHeightLarge 	= get_field('archive_header_height_large','options');
	$archiveHeaderHeightMedium 	= get_field('archive_header_height_medium','options');
	$archiveHeaderHeightSmall 	= get_field('archive_header_height_small','options');
?>

<style>
	/* Small only */
	@media screen and (max-width: 39.9375em) {
	    #archiveHeaderHeight {
	        height: calc(<?php echo $archiveHeaderHeightSmall ;?>px / 1); /* fallback if needed */
	        min-height: calc(<?php echo $archiveHeaderHeightSmall ;?>px / 1);

	    }
	}

	/* Medium only */
	@media screen and (min-width: 40em) and (max-width: 63.9375em) {
	    #archiveHeaderHeight {
	        height: calc(<?php echo $archiveHeaderHeightMedium ;?>px / 1); /* fallback if needed */
	        min-height: calc(<?php echo $archiveHeaderHeightMedium ;?>px / 1);

	    }
	}

	/* Large and up */
	@media screen and (min-width: 64em) {
	    #archiveHeaderHeight {
	        height: calc(<?php echo $archiveHeaderHeightLarge ;?>px / 1); /* fallback if needed */
	        min-height: calc(<?php echo $archiveHeaderHeightLarge ;?>px / 1); /* fallback if needed */
	    }
	}

	/* Large only */
	@media screen and (min-width: 64em) and (max-width: 74.9375em) {}
</style> <!-- end inline styles -->



<?php if ($attachment_id):?>

	<div class="header-category-container group">
		<table data-interchange=" [<?php echo $image_featured_thumbnail[0]; ?>, only screen and (min-width: 1px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_thumbnail[1]; ?>' height='<?php echo $image_featured_thumbnail[2]; ?>', [<?php echo $image_featured_medium[0]; ?>, only screen and (min-width: 641px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_medium[1]; ?>' height='<?php echo $image_featured_medium[2]; ?>', [<?php echo $image_featured_large[0]; ?>, only screen and (min-width: 961px)] alt='<?php echo $image_featured_alt; ?>' width='<?php echo $image_featured_large[1]; ?>' height='<?php echo $image_featured_large[2]; ?>'">
			<tr>
				<td id="archiveHeaderHeight">
					<div class="table-cell-wrapper">
						<?php echo '<strong>'.$taxonomy->name.'</strong>';?>

						<?php if ($title):?>
							<?php echo '<h2>'.$title.'<h2>'; ?>
						<?php endif;?>

						<?php if ($description):?>
							<?php echo '<div class="category-description">'.$description.'</div>'; ?>
						<?php endif;?>

					</div>
				</td>
			</tr>
		</table>
	</div> <!-- end .header-category-container .group -->

<?php else:?>

	<div class="header-category-container group">
		<table style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/fpo3.jpg);">
			<tr>
				<td id="archiveHeaderHeight">
					<div class="table-cell-wrapper">
						<?php echo '<strong>'.$taxonomy->name.'</strong>';?>

						<?php if ($title):?>
							<?php echo '<h2>'.$title.'<h2>'; ?>
						<?php endif;?>

						<?php if ($description):?>
							<?php echo '<div class="category-description">'.$description.'</div>'; ?>
						<?php endif;?>

					</div>
				</td>
			</tr>
		</table>
	</div> <!-- end .header-category-container .group -->

<?php endif; ?>












<?php
	$rowWidthPage 	= get_field('page_width','options'); // sub field:
	$rowPage 		= get_field('page_row','options'); // sub field:
	$columnDisplayLarge 	= get_field('column_display_large','options'); // sub field:
	$columnDisplayMedium 	= get_field('column_display_medium','options'); // sub field:
	$columnDisplaySmall 	= get_field('column_display_small','options'); // sub field:
?>





<?php $sidebar = get_field('sidebar_select', $taxonomy); ?>


<?php if( $sidebar == 'sidebar_module_default' ): // loads default sidebar using widgets ?>

<h2>SIDEBAR DEFAULT</h2>

	<div id="content">

		<div id="inner-content">

		    <main id="main" role="main">

					<div class="row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

						<div class="large-8 columns">

							<div class="grid-margin-right">




	<div class="category-feed">
	<div class="row column">
	<div class="row <?php echo $rowPage; ?> large-up-<?php echo $columnDisplayLarge;?> medium-up-<?php echo $columnDisplayMedium;?> small-up-<?php echo $columnDisplaySmall;?>" data-equalizer data-equalize-by-row="true">




	<!--
						    	<header>
						    		<h1 class="page-title"><?php the_archive_title();?></h1>
									<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
						    	</header>
	-->

						    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<!-- To see additional archive styles, visit the /parts directory -->
					<div class="column" data-equalizer-watch>

						<?php if(has_post_thumbnail()):?>
							<div class="article-thumbnail">
								<?php the_post_thumbnail('video-thumbnail'); ?>
							</div>
							<!-- <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a> -->
						<?php else :?>
							<?php //echo 'CONTENT_GOES_HERE'; ?>
						<?php endif;?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
							<header class="article-header">
								<div class="byline">
									<p class="time-date"><?php the_time('F j, Y') ?></p>
								</div>
								<h2><?php the_title(); ?></h2>
								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								<?php //get_template_part( 'parts/content', 'byline' ); ?>
							</header> <!-- end article header -->

							<section class="entry-content group" itemprop="articleBody">
								<?php //the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
								<?php the_excerpt();?>
									<p class="time-category"><?php the_category(' ') ?></p>
							</section> <!-- end article section -->

							<?php //get_template_part( 'parts/content', 'social' ); ?>

							<?php //get_template_part( 'parts/nav', 'footer-tags' ); ?>

						</article> <!-- end article -->

					</div> <!-- end .column -->

								<?php endwhile; ?>





	</div> <!-- end .row -->
	</div> <!-- end .row .column -->
	</div> <!-- end .category-feed -->


									<?php joints_page_navi(); ?>



								<?php else : ?>

									<?php get_template_part( 'parts/content', 'missing' ); ?>

								<?php endif; ?>

							</div> <!-- end .grid-margin-right -->

						</div> <!-- end .columns -->

						<?php get_sidebar('category'); ?>

					</div> <!-- end .row -->

			    </main> <!-- end #main -->

	    </div> <!-- end #inner-content -->

	</div> <!-- end #content -->













<?php elseif( have_rows($sidebar, 'options') ): // field: Flexible ?>
<h2>SIDEBAR</h2>




	<div id="content">

		<div id="inner-content">

		    <main id="main" role="main">

					<div class="row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

						<div class="large-8 columns">

							<div class="grid-margin-right">




	<div class="category-feed">
	<div class="row column">
	<div class="row <?php echo $rowPage; ?> large-up-<?php echo $columnDisplayLarge;?> medium-up-<?php echo $columnDisplayMedium;?> small-up-<?php echo $columnDisplaySmall;?>" data-equalizer data-equalize-by-row="true">




	<!--
						    	<header>
						    		<h1 class="page-title"><?php the_archive_title();?></h1>
									<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
						    	</header>
	-->

						    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									<!-- To see additional archive styles, visit the /parts directory -->
					<div class="column" data-equalizer-watch>

						<?php if(has_post_thumbnail()):?>
							<div class="article-thumbnail">
								<?php the_post_thumbnail('video-thumbnail'); ?>
							</div>
							<!-- <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a> -->
						<?php else :?>
							<?php //echo 'CONTENT_GOES_HERE'; ?>
						<?php endif;?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
							<header class="article-header">
								<div class="byline">
									<p class="time-date"><?php the_time('F j, Y') ?></p>
								</div>
								<h2><?php the_title(); ?></h2>
								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								<?php //get_template_part( 'parts/content', 'byline' ); ?>
							</header> <!-- end article header -->

							<section class="entry-content group" itemprop="articleBody">
								<?php //the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
								<?php the_excerpt();?>
									<p class="time-category"><?php the_category(' ') ?></p>
							</section> <!-- end article section -->

							<?php //get_template_part( 'parts/content', 'social' ); ?>

							<?php //get_template_part( 'parts/nav', 'footer-tags' ); ?>

						</article> <!-- end article -->

					</div> <!-- end .column -->

								<?php endwhile; ?>





	</div> <!-- end .row -->
	</div> <!-- end .row .column -->
	</div> <!-- end .category-feed -->


									<?php joints_page_navi(); ?>



								<?php else : ?>

									<?php get_template_part( 'parts/content', 'missing' ); ?>

								<?php endif; ?>

							</div> <!-- end .grid-margin-right -->

						</div> <!-- end .columns -->

						<?php get_sidebar('category'); ?>

					</div> <!-- end .row -->

			    </main> <!-- end #main -->

	    </div> <!-- end #inner-content -->

	</div> <!-- end #content -->








<?php else:?>
<h2>NO SIDEBAR</h2>




	<div id="content">

		<div id="inner-content">

		    <main id="main" role="main">

					<div class="row <?php echo $rowWidthPage; ?> <?php echo $rowPage; ?>">

						<div class="large-12 columns">




<div class="category-feed">
<div class="row column">
<div class="row <?php echo $rowPage; ?> large-up-<?php echo $columnDisplayLarge;?> medium-up-<?php echo $columnDisplayMedium;?> small-up-<?php echo $columnDisplaySmall;?>" data-equalizer data-equalize-by-row="true">




<!--
					    	<header>
					    		<h1 class="page-title"><?php the_archive_title();?></h1>
								<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
					    	</header>
-->

					    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<!-- To see additional archive styles, visit the /parts directory -->
				<div class="column" data-equalizer-watch>

						<?php if(has_post_thumbnail()):?>
							<div class="article-thumbnail">
								<?php the_post_thumbnail('video-thumbnail'); ?>
							</div>
							<!-- <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a> -->
						<?php else :?>
							<?php //echo 'CONTENT_GOES_HERE'; ?>
						<?php endif;?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
						<header class="article-header">
							<div class="byline">
								<p class="time-date"><?php the_time('F j, Y') ?></p>
							</div>
							<h2><?php the_title(); ?></h2>
							<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
							<?php //get_template_part( 'parts/content', 'byline' ); ?>
						</header> <!-- end article header -->

						<section class="entry-content group" itemprop="articleBody">
							<?php the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
							<?php //the_excerpt();?>
								<p class="time-category"><?php the_category(' ') ?></p>
						</section> <!-- end article section -->

						<?php //get_template_part( 'parts/content', 'social' ); ?>

						<?php //get_template_part( 'parts/nav', 'footer-tags' ); ?>

					</article> <!-- end article -->

				</div> <!-- end .column -->

							<?php endwhile; ?>





</div> <!-- end .row -->
</div> <!-- end .row .column -->
</div> <!-- end .category-feed -->


								<?php joints_page_navi(); ?>



							<?php else : ?>

								<?php get_template_part( 'parts/content', 'missing' ); ?>

							<?php endif; ?>

						</div> <!-- end .columns -->

					</div> <!-- end .row -->

			    </main> <!-- end #main -->

	    </div> <!-- end #inner-content -->

	</div> <!-- end #content -->










<?php endif ;?>











<?php get_footer(); ?>