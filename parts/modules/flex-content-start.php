<?php
/*
//////////////////////////////////
flex-content-start

Variables that need to be set in a different page IF you are not using TABS
$i : originally for TAB id's
$outerCounter : with tabs, this handles the counting of each module in each tabbed area. 
$galleryJSCode : this is the JS code that is needed to activate and store the desired modal window code.
//////////////////////////////////
*/



$i=0; 
$galleryJSCode = NULL;  // store all the JS code needed for gallery items. this will then be dumped at the end; it can be used for ALL gallery JS code!
?>

          <?php if( have_rows('flexible_section') ): // field label: ?>

                          <?php $outerCounter = 0; ?>

              <?php while ( have_rows('flexible_section') ) : the_row(); // field label: ?>

                  <?php if( get_row_layout() == 'flexible_module' ): // layout: ?>


                      <?php if (get_sub_field('flexible_section_header')) {
                          echo '<h2>'.get_sub_field('flexible_section_header').'</h2>';
                          }
                      ?>

                      <?php if( have_rows('flexible_nested') ): // nested field label: ?>


                          <?php while ( have_rows('flexible_nested') ) : the_row(); // nested field label: ?>

                          <?php $outerCounter ++; 
						  echo "module - ".$outerCounter;
						  ?>