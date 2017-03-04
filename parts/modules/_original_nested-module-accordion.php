
<?php if( get_row_layout() == 'accordion_component' ): // nested layout: ?>

	<?php
		$accordionWidth 	= get_sub_field('accordion_width');
		$accordionRows 	= get_sub_field('accordion_rows');
	?>






<div class="row <?php echo $accordionWidth; ?> <?php echo $accordionRows; ?>">

    <div class="large-12 columns">

		<?php
		 // data-allow-all-closed="true" - Allows toggle
		 // data-multi-expand="true" - Allows multiple panes to be displayed
		?>

		<ul class="accordion" data-accordion data-allow-all-closed="true" data-multi-expand="false">

		    <?php
            	$i=0;
				$posts = get_sub_field('accordion_module');
				if( $posts ): $temp_post = $post;
					foreach( $posts as $post): setup_postdata($post);
			?>

			<li class="accordion-item" data-accordion-item><a aria-expanded="true" aria-selected="true" role="tab" class="accordion-title"><?php echo the_title() ;?></a>

				<div class="accordion-content" data-tab-content aria-hidden="false">


					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	                    <section class="entry-content" itemprop="articleBody" role="tabpanel" id="tab-<?php echo $post->post_name; ?>-<?php echo($i++); ?>">
							<?php the_title('<h2>','</h2>'); ?>
							<?php the_content(); ?>

							<div class="article-footer">

								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>

								<?php if (the_tags()) :?>
									<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>
								<?php endif; ?>

								<?php if (has_category()) :?>
									<p class="category">Category: <?php the_category(', '); ?> </p>
								<?php endif; ?>

							</div> <!-- end .article-footer -->

						</section> <!-- end tabspanel -->

					</article>

		            <?php
						endforeach;
						wp_reset_postdata();
		                $post = $temp_post;
						endif;
					?>

				</div> <!-- end .accordion-content -->

			</li>

		    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

		</ul> <!-- end .accordion -->

    </div> <!-- end .columns -->

</div> <!-- end .row -->



	<?php else : ?>

		<?php //if (get_sub_field('full_width_content')) :?>
			<?php //the_sub_field('full_width_content'); ?>
		<?php //endif; ?>

<?php endif; ?>