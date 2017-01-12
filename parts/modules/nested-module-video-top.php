<div class="gallery-item wow <?php echo $wow_animation_effect ;?>" data-wow-duration="2s" data-wow-delay="<?php echo $wow_array[1] ,'s';?>" style="visibility: hidden;">

    <a class="gallery-item-link button-reveal <?php echo 'PageID-'.$i.'-launchGallery-', $outerCounter ,'-', $count_01 ;?>" type="button" >

    <table>
        <td class="video-gallery"></td>

        <td>
            <?php if ($button_label) {
                echo '<p>'.$button_label.'</p>';
                }
            ?>
        </td>
    </table>

        <?php //echo $content ;?>

    </a> <!-- end .gallery-item-link -->

</div> <!-- end .gallery-item -->