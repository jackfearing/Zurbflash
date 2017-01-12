<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="article-header">
		<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
		<?php get_template_part( 'parts/content', 'byline' ); ?>
    </header> <!-- end article header -->

    <section class="entry-content" itemprop="articleBody">
		<?php the_post_thumbnail('video-thumbnail'); ?>
		<?php the_content(); ?>
	</section> <!-- end article section -->

	<div class="article-footer">

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>

		<?php if (the_tags()) :?>
			<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>
		<?php endif; ?>

		<?php if (has_category()) :?>
			<p class="category">Category: <?php the_category(', '); ?> </p>
		<?php endif; ?>

		<strong>Navigation:</strong><br>
<?php previous_post_link(); ?>  |  <?php next_post_link(); ?>
<br>
<?php next_post_link( '<strong>%link</strong>' ); ?>
<br>
<?php next_post_link( '%link', 'Next post in category', FALSE ); ?>
<br>
<?php previous_post_link( '%link', 'Previous post in category', FALSE ); ?>
<br>
Change Link Text
<?php previous_post_link('<h1>%link</h1>'); ?>
<br>
Link To Next Posts In Same Category
<?php next_post_link('&raquo; %link', '%title', TRUE); ?>
<br>
Link To Previous Posts In Same Category
<?php previous_post_link('&laquo; %link', '%title', TRUE); ?>
<br>
Change Link Text
<?php next_post_link('%link', 'Link To Next Post'); ?>
<br>
Change Link Text
<?php previous_post_link('%link', 'Link To Previous Post'); ?>
<br>
<?php
    previous_post_link('<span class="left">&laquo; %link</span>');
    next_post_link('<span class="right">%link &raquo;</span>');
?>
<div class="clearfix"></div>





<hr>
<br>
<?php
$next_post = get_next_post();
if (!empty( $next_post )): ?>
  Next Post NOT Empty: <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
  <?php else: ?>
  <strong>NO NEXT POST</strong>
<?php endif; ?>
<br>
<?php
$next_post = get_previous_post();
if (!empty( $next_post )): ?>
  Previous Post NOT Empty: <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
    <?php else: ?>
  <strong>NO PREVIOUS POST</strong>
<?php endif; ?>
<hr>


	</div> <!-- end article footer -->

	<?php comments_template(); ?>

</article> <!-- end article -->