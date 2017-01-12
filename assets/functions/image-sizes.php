<?php

	// Add featured image sizes
	//add_image_size( 'featured-large', 640, 294, true ); // width, height, crop
	//add_image_size( 'featured-small', 320, 147, true );
	//add_image_size( 'section-image', 166, 70, true ); //(cropped)
	//add_image_size( 'slider-image', 1000, 400, true ); //(cropped)
	//add_image_size( 'homepage-thumb', 220, 180 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
	//add_image_size( 'homepage-thumb', 220, 180, true ); // 220 pixels wide by 180 pixels tall, hard crop mode



	// Add other useful image sizes for use through Add Media modal
	//add_image_size( 'medium-width', 480 );
	add_image_size( 'header-featured', 3000, 460, array( 'right', 'top' ) );
	//add_image_size( 'home-featured-callout', 400, 300, true );
	//add_image_size( 'page-featured', 3000, 260, array( 'right', 'top' ) );
	//add_image_size( 'loan-officer-thumbnail', 260, 260, true );
	//add_image_size( 'header-featured-crop', 480, 300, array( 'left', 'top' ) ); // Hard crop left top
	//add_image_size( 'medium-something', 480, 480 );



	//Used for Foundation Interchange
	//add_image_size('mobile-small', 650);
	//add_image_size('mobile-medium', 960);

	// Used for custom button thumbnail
	add_image_size( 'button-thumb', 320, 320 ); // 160 pixels wide by 160 pixels tall, hard crop mode

	// Used for custom video thumbnail
	add_image_size( 'video-thumbnail', 990, 560, array( 'center', 'center' ) );

	// Used for custom category feed
	//add_image_size( 'feed-thumbnail', 300, 300, array( 'center', 'center' ) );
	add_image_size( 'feed-thumbnail', 480, 280, array( 'center', 'center' ) ); // Hard crop left top

	add_image_size( 'custom-size', 320, 320, true); // Hard crop left top

	// USed for Bio Profile
	add_image_size( 'bio-thumbnail', 450, 350, array( 'center', 'top' ) );;

	// Used for LightGallery
	add_image_size( 'lg-thumbnail', 200, 160, array( 'center', 'center' ) );
	//add_image_size( 'lg-medium', 400, 260, array( 'center', 'center' ) );
	add_image_size( 'lg-medium', 500, 360, array( 'center', 'center' ) );

	// Used for Foundation Interchange + Retina
	add_image_size('mobile-small', 640, 480);
	add_image_size('retina-small', 1024, 720);

	add_image_size('mobile-medium', 1024, 720);
	add_image_size('retina-medium', 1600, 1440);

	add_image_size('mobile-large', 1200, 1440);
	add_image_size('retina-large', 1920, 1600);

	add_image_size('large-desktop', 1200);


	// Register the three useful image sizes for use in Add Media modal
	add_filter( 'image_size_names_choose', 'my_custom_sizes' );
	function my_custom_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	        'header-featured' => __( 'Header Featured','jointstheme' ),
	        //'home-featured-callout' => __( 'Home Featured Callout' ),
	        //'page-featured' => __( 'Page Featured' ),
	        //'loan-officer-thumbnail' => __( 'Loan Officer' ),
	    ) );
	}

?>