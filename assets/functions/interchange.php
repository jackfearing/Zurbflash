<?php

// build an interchange image tag for all uploaded images in the content
add_filter( 'the_content', 'replace_images_with_interchange' );

// build an interchange image tag for all uploaded images for the Post Thumbnail
// depending on the usage this might a good idea to leave commented out)
//add_filter( 'post_thumbnail_html', 'replace_images_with_interchange' );

// build an interchange image tag for all uploaded images in the ACF Editor WYSIWYG
add_filter( 'acf_the_content', 'replace_images_with_interchange' );


/**
 * Swap out uploaded image tags with Interchange tags
 *
 * @link http://jaredcobb.com/automatically-replace-images-with-zurb-interchange-in-wordpress
 *
 * @param string $content
 *
 * @return string
 */
function replace_images_with_interchange($content) {

  // build a collection of all image tags found in the content
  $image_matches = array();
  if (preg_match_all("/<img[^>]*./", $content, $image_matches, PREG_OFFSET_CAPTURE)) {

    // if we found some image tags in the content
    if (is_array($image_matches[0]) && !empty($image_matches[0])) {

      // setup helper values, and reverse the array of found images because as we begin to
      // monkey with the content we'll be changing the string length of the $content and thus
      // the found locations of the image tag positions
      $image_matches[0] = array_reverse($image_matches[0]);
      $uploads_path = '/wp-content/uploads/';

      foreach ($image_matches[0] as $image_collection) {

        if (is_array($image_collection) && !empty($image_collection)) {

          $image_tag = $image_collection[0];
          $image_tag_start_pos = $image_collection[1];

          // we know that we only want to tweak image tags that have been uploaded via WordPress (and have a thumbnail
          // version, so don't bother trying to work with any other images (theme images or externally linked images, etc)
          if (strpos($image_tag, $uploads_path)) {

            // set some helpful position points in the $content and in the $image_tag strings
            $src_full_content_start_pos = strpos($content, 'src="', intval($image_tag_start_pos));
            $src_start_pos = strpos($image_tag, 'src="');
            $src_end_pos = strpos($image_tag, '"', ($src_start_pos + 5));
            $src_value = substr($image_tag, ($src_start_pos + 5), ($src_end_pos - $src_start_pos - 5));

            // now that we have the image source url, we need to look up the attachment id so that we can
            // query WordPress and ask for the mobile image version (thank you Rarst)
            $attachment_id = get_attachment_id($src_value);

            if ($attachment_id) {

				// get mobile and original size. if the attachment doesn't have a small version, that's okay, both values
				// will be returned as the same image URL
				$mobile_image_small = wp_get_attachment_image_src($attachment_id, 'feed-thumbnail');
				$mobile_image_medium = wp_get_attachment_image_src($attachment_id, 'large');
				$mobile_image_large = wp_get_attachment_image_src($attachment_id, 'large');

				//$standard_image = wp_get_attachment_url($attachment_id);
				$standard_image = wp_get_attachment_url($attachment_id, 'large');

				$retina_small = wp_get_attachment_image_src($attachment_id, 'feed-thumbnail');
				$retina_medium = wp_get_attachment_image_src($attachment_id, 'feed-thumbnail');
				$retina_large = wp_get_attachment_image_src($attachment_id, 'large');


			  if ($mobile_image_small && $retina_small && $mobile_image_medium && $retina_medium && $mobile_image_large && $retina_large && $standard_image) {

				  $interchange_tag = ' data-interchange="[' . $mobile_image_small[0] . ', only screen and (min-width: 1px)], [' . $retina_small[0] . ', only screen and (min-width: 1px) and (-webkit-min-device-pixel-ratio: 2), only screen and (min-width: 1px) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 1px) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 1px) and (min-device-pixel-ratio: 2), only screen and (min-width: 1px) and (min-resolution: 192dpi), only screen and (min-width: 1px) and (min-resolution: 2dppx)], [' . $mobile_image_medium[0] . ', only screen and (min-width: 641px)], [' . $retina_medium[0] . ', only screen and (min-width: 641px) and (-webkit-min-device-pixel-ratio: 2), only screen and (min-width: 641px) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 641px) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 641px) and (min-device-pixel-ratio: 2), only screen and (min-width: 641px) and (min-resolution: 192dpi), only screen and (min-width: 641px) and (min-resolution: 2dppx)], [' . $mobile_image_large[0] . ', only screen and (min-width: 1025px)], [' . $retina_large[0] . ', only screen and (min-width: 1025px) and (-webkit-min-device-pixel-ratio: 2), only screen and (min-width: 1025px) and (min--moz-device-pixel-ratio: 2), only screen and (min-width: 1025px) and (-o-min-device-pixel-ratio: 2/1), only screen and (min-width: 1025px) and (min-device-pixel-ratio: 2), only screen and (min-width: 1025px) and (min-resolution: 192dpi), only screen and (min-width: 1025px) and (min-resolution: 2dppx)], [' . $retina_large[0] . ', only screen and (min-width: 1441px)]"';

                // prepend the 'src' attribute with a data attribute so the browser doesn't render the image AND
                // it's nice to be able to inspect it and see the original value
                $content = substr_replace($content, 'data-old-', $src_full_content_start_pos, 0);
                // inject the Interchange attribute into the image tag
                $content = substr_replace($content, $interchange_tag, $image_tag_start_pos + 4, 0);
              }

            }

          }

        }

      }

    }

  }

  return $content;
}

/**
 * Get the Attachment ID for a given image URL.
 *
 * @link http://wordpress.stackexchange.com/a/7094
 *
 * @param string $url
 *
 * @return boolean|integer
 */
function get_attachment_id( $url ) {

  $dir = wp_upload_dir();

  // baseurl never has a trailing slash
  if ( false === strpos( $url, $dir['baseurl'] . '/' ) ) {
    // URL points to a place outside of upload directory
    return false;
  }

  $file  = basename( $url );
  $query = array(
      'post_type'  => 'attachment',
      'fields'     => 'ids',
      'meta_query' => array(
        array(
          'value'   => $file,
          'compare' => 'LIKE',
          ),
        )
      );

  $query['meta_query'][0]['key'] = '_wp_attached_file';

  // query attachments
  $ids = get_posts( $query );

  if ( ! empty( $ids ) ) {

    foreach ( $ids as $id ) {

      // first entry of returned array is the URL
      //if ( $url === array_shift( wp_get_attachment_image_src( $id, 'full' ) ) )
        return $id;
    }
  }

  $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
  // query attachments again
  $ids = get_posts( $query );

  if ( empty( $ids) )
    return false;

  foreach ( $ids as $id ) {

    $meta = wp_get_attachment_metadata( $id );

    foreach ( $meta['sizes'] as $size => $values ) {
      	//if ( $values['file'] === $file && $url === array_shift( wp_get_attachment_image_src( $id, $size ) ) )
        return $id;
    }
  }

  return false;
}
?>