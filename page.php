<?php get_header(); ?>

<h2>Page Template Code:</h2>

<div class="card" style="width: 300px;">
  <div class="card-divider">
    This is a header
  </div>
  <img src="https://placeimg.com/640/480/nature" />
  <div class="card-section">
    <h4>This is a card.</h4>
    <p>It has an easy to override visual style, and is appropriately subdued.</p>
  </div>
</div>


<!-- Change the accordian to tabs or tabs to accordian -->
<ul class="accordion" data-responsive-accordion-tabs="accordion medium-accordion large-tabs">
  <li class="accordion-item is-active" data-accordion-item>
    <a href="#" class="accordion-title">Accordion 1</a>
    <div class="accordion-content" data-tab-content>
      I would start in the open state, due to using the `is-active` state class.
    </div>
  </li>
  <li class="accordion-item" data-accordion-item>
    <a href="#" class="accordion-title">Accordion 2</a>
    <div class="accordion-content" data-tab-content>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus doloremque, beatae impedit autem, atque excepturi? Illo tempore, nulla sint, quam accusamus itaque laudantium, totam accusantium modi officiis, unde nostrum dignissimos.
    </div>
  </li>
  <li class="accordion-item" data-accordion-item>
    <a href="#" class="accordion-title">Accordion 3</a>
    <div class="accordion-content" data-tab-content>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus doloremque, beatae impedit autem, atque excepturi? Illo tempore, nulla sint, quam accusamus itaque laudantium, totam accusantium modi officiis, unde nostrum dignissimos. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, rem aut iusto sunt voluptatem veniam, placeat magnam et alias rerum praesentium dicta voluptate, veritatis provident odit sapiente inventore cumque Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium nulla ratione perferendis, quibusdam nisi asperiores ducimus, labore qui hic praesentium, necessitatibus aspernatur placeat. Sint, deserunt, consequatur tenetur praesentium nostrum quaerat.
    </div>
  </li>

</ul>










<?php
if (is_page_template('default'))  {
    echo 'show some content when you ARE in template-custom.php OR template-custom2.php';
} else {
	echo 'Im not a template default';
}
?>


<?php if (is_page_template('default')) :?>
   <?php echo 'show some content when you ARE in template-custom.php OR template-custom2.php'; ?>
<?php else : ?>
	<?php echo 'Im not a template default'; ?>
<?php endif; ?>


<?php
if ( is_page_template( 'default' ) ) {
    echo '<p>page.php is used</p>';
} else {
    echo '<p>page.php is not used</p>';
}
?>


<?php if( is_page_template('page.php') ) { // check for page template
    echo '<p>page.php is used</p>';
} elseif( is_single() || is_page() ) { // it's not the page template. Is it at least a post or page?
     echo '<p>Single</p>';
} else { // I suspect you want a fallback condition, not sure what it is.
     echo '<p>page.php is not used</p>';
} ?>
=================






	<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="large-8 medium-12 columns scene_element scene_element--fadeIn" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>

			    <?php endwhile; endif; ?>

			</main> <!-- end #main -->

		    <?php get_sidebar('acf'); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>