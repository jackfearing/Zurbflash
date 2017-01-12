<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">
	<header class="article-header">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
	</header> <!-- end article header -->

	<section class="entry-content group" itemprop="articleBody">

<!--
<?php if ( has_post_thumbnail()) : ?>
   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
   <?php the_post_thumbnail('feed-thumbnail'); ?>
   </a>
 <?php endif; ?>
-->

					<?php if(has_post_thumbnail()):?>
						<div class="article-thumbnail">
							<?php the_post_thumbnail('feed-thumbnail'); ?>
						</div>
						<!-- <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a> -->
					<?php else :?>
						<?php //echo 'CONTENT_GOES_HERE'; ?>
					<?php endif;?>

<!-- 		<a class="thumbnail-custom" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('feed-thumbnail'); ?></a> -->
		<?php //the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
		<?php //the_excerpt(); ?>
		<?php //excerpt('15'); ?>
		<?php echo wpse_custom_excerpts(30); ?>
	</section> <!-- end article section -->

	<?php //get_template_part( 'parts/content', 'social' ); ?>

	<?php get_template_part( 'parts/nav', 'footer-tags' ); ?>

</article> <!-- end article -->