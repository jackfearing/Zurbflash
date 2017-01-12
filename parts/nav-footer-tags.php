<?php if ( get_the_tags() ) :?>

	<div class="article-footer">
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>
	</div> <!-- end article footer -->

<?php else : ?>
	<!-- EMPTY -->
<?php endif; ?>



<?php if ( get_the_category() ) :?>

	<div class="article-footer">
		<p class="categories">Categories: <?php the_category(', ') ?></p>
	</div> <!-- end article footer -->

<?php else : ?>
	<!-- EMPTY -->
<?php endif; ?>