
<?php if( get_row_layout() == 'tabs_component' ): // nested layout: ?>

	<?php
			$tabsWidth 	= get_sub_field('tabs_width');
			$tabsRows 	= get_sub_field('tabs_rows');
	?>

	<div class="custom-tabs tab-container">

		<ul role="tablist" class="tabs">

		<?php
			foreach(get_sub_field('tabs_module') as $relationship) {
				echo '<li><a role="tab" class="tab '.$relationship->post_name.'" href="#tab-'.$relationship->post_name.'-'.$i++.'">'.$relationship->post_title.'</a></li>';
			}
		?>

		</ul><!-- .tabs -->


		<div class="tab-content">

		    <?php
            	$i=0;
				$posts = get_sub_field('tabs_module');
				if( $posts ): $temp_post = $post;
					foreach( $posts as $post): setup_postdata($post);
			?>

				<div class="row <?php echo $tabsWidth; ?> <?php echo $tabsRows; ?>">

	                <div class="large-12 columns">

						<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	                        <section class="entry-content" itemprop="articleBody" role="tabpanel" id="tab-<?php echo $post->post_name; ?>-<?php echo($i++); ?>">

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

	                </div> <!-- end .columns -->

	            </div> <!-- end .row -->

            <?php
				endforeach;
				wp_reset_postdata();
                $post = $temp_post;
				endif;
			?>

		</div> <!-- end .tab-content -->


	</div> <!-- end .custom-tabs .tab-container -->

	<?php else : ?>

		<?php //if (get_sub_field('full_width_content')) :?>
			<?php //the_sub_field('full_width_content'); ?>
		<?php //endif; ?>

<?php endif; ?>