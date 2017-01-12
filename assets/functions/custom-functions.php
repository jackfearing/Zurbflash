<?php

// Display Links in Excerpts
// http://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt
function wpse_allowedtags() {
    // Add custom tags to this string
        return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>,<strong>';
    }

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) :

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) {

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'wpse' ), get_the_title()) . '</a>';
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */

            return $wpse_excerpt;

        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif;

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt');




function wpse_custom_excerpts($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, '&hellip; <div><a class="button" href="'. esc_url( get_permalink() ) . '">' . '&nbsp;' . __( 'Read more &nbsp;&raquo;', 'wpse' ) . '</a></div>');
}










/**
 * Tests if any of a post's assigned categories are descendants of target categories
 * @link http://miftyisbored.com/how-to-determine-if-a-post-is-in-a-category-or-its-subcategory-in-wordpress/
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
    function post_is_in_descendant_category( $cats, $_post = null ) {
        foreach ( (array) $cats as $cat ) {
            // get_term_children() accepts integer ID only
            $descendants = get_term_children( (int) $cat, 'category' );
            if ( $descendants && in_category( $descendants, $_post ) )
                return true;
        }
        return false;
    }
}




	// Allows Custom Post Types to display on archive.php
	// Change 'namespace_add_custom_types' to custom post type name i.e. 'book'
	add_filter( 'pre_get_posts', 'my_get_posts' );

	function my_get_posts( $query ) {
	    if( !is_admin() ) {
	        if ( !is_post_type_archive() && $query->is_archive() ) {
	            $query->set( 'post_type', array( 'post', 'book' ) );
	        }
	        return $query;
	    }
	}


	// Define what post types to search
	// Change 'custom_post_type1' to custom post type name i.e. 'book'
	function searchAll( $query ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', array( 'post', 'page', 'feed', 'book', 'custom_post_type2'));
		}
		return $query;
	}

	// The hook needed to search ALL content
	add_filter( 'the_search_query', 'searchAll' );



	// !Search: Extend WordPress search to include custom fields
	// http://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/

	function cf_search_join( $join ) {
	    global $wpdb;

	    if ( is_search() ) {
	        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	    }

	    return $join;
	}
	add_filter('posts_join', 'cf_search_join' );

	// Modify the search query with posts_where
	function cf_search_where( $where ) {
	    global $pagenow, $wpdb;

	    if ( is_search() ) {
	        $where = preg_replace(
	            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
	            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
	    }

	    return $where;
	}
	add_filter( 'posts_where', 'cf_search_where' );

	// Prevent duplicates
	function cf_search_distinct( $where ) {
	    global $wpdb;

	    if ( is_search() ) {
	        return "DISTINCT";
	    }

	    return $where;
	}
	add_filter( 'posts_distinct', 'cf_search_distinct' );



	// Custom pagination for Custom Post Types (use: php posts_nav(); )
	function posts_nav() {

		if( is_singular() )
			return;

		global $wp_query;

		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 )
			return;

		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $wp_query->max_num_pages );

		/**	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;

		/**	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<nav class="page-navigation"><ul class="page-pagination">' . "\n";

		/**	Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

		/**	Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="current"' : '';

			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( ! in_array( 2, $links ) )
				echo '<li>…</li>';
		}

		/**	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/**	Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li>…</li>' . "\n";

			$class = $paged == $max ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/**	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li>%s</li>' . "\n", get_next_posts_link() );

		echo '</ul></nav>' . "\n";

	}




	// Custom Search form for use with SHORTCODE
/*
	function wpsearchform( $form ) {

		$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
			<div>
				<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search..." />
				<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','jointstheme' ) .'" />
			</div>
	    </form>';

	    return $form;
	}

	add_shortcode('wpsearch', 'wpsearchform');
*/



	// Replace jQuery with Google CDN jQuery
	if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
	function my_jquery_enqueue() {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js", false, null);
	   wp_enqueue_script('jquery');
	}


	// Defer jQuery Parsing using HTML5's defer property
	// When active will cause the Foudnation off-canvas menu to NOT work
/*
	if (!(is_admin() )) {
	  function defer_parsing_of_js ( $url ) {
	    if ( FALSE === strpos( $url, '.js' ) ) return $url;
	    if ( strpos( $url, 'jquery.js' ) ) return $url;
	    return "$url' defer ";
	  }
	  add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
	}
*/



	// Remove WordPress.org Links from Toolbar
	add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

	function remove_wp_logo( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
	}



	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );



	// !WP Custom Header (http://codex.wordpress.org/Custom_Headers)
	add_theme_support( 'custom-header',
	array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
		)
	);



	// !WP Custom Background
	add_theme_support( 'custom-background',
		array(
		'default-image' => '',  // background image default
		'default-color' => '', // background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
		 )
	);


	// !Add Excerpts to Pages
	add_action( 'init', 'my_add_excerpts_to_pages' );
	function my_add_excerpts_to_pages() {
	     add_post_type_support( 'page', 'excerpt' );
	}



	// !Add the browser name and version to the body class
/*
	add_filter('body_class','browser_body_class');
	function browser_body_class($classes) {
	    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	    if($is_lynx) $classes[] = 'lynx';
	    elseif($is_gecko) $classes[] = 'gecko';
	    elseif($is_opera) $classes[] = 'opera';
	    elseif($is_NS4) $classes[] = 'ns4';
	    elseif($is_safari) $classes[] = 'safari';
	    elseif($is_chrome) $classes[] = 'chrome';
	    elseif($is_IE) $classes[] = 'ie';
	    else $classes[] = 'unknown';
	    if($is_iphone) $classes[] = 'iphone';
	    return $classes;
	}
*/


	// !Add the browser name and version to the body class
	function mv_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
	        $classes[] = 'ie';
	        if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
	        $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';
        if($is_iphone) $classes[] = 'iphone';
        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
	         $classes[] = 'osx';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
             $classes[] = 'linux';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
             $classes[] = 'windows';
           }
        return $classes;
	}
	add_filter('body_class','mv_browser_body_class');



	// !Page Slug Body Class
	function add_slug_body_class( $classes ) {
		global $post;
		if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
		return $classes;
	}

	add_filter( 'body_class', 'add_slug_body_class' );



	// !Category Slug Body Class
	add_filter('body_class','add_category_to_single');
	function add_category_to_single($classes) {
		if (is_single() ) {
			global $post;
			foreach((get_the_category($post->ID)) as $category) {
				// add category slug to the $classes array
				$classes[] = $category->category_nicename;
			}
		}
		// return the $classes array
		return $classes;
	}



	// !Tests if any of a post's assigned categories are descendants of target categories
	// Reference Snippets
	if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
		function post_is_in_descendant_category( $cats, $_post = null ) {
			foreach ( (array) $cats as $cat ) {
				// get_term_children() accepts integer ID only
				if ( is_string( $cat ) ) {
					$cat = get_term_by( 'slug', $cat, 'category' );
					if ( ! isset( $cat, $cat->term_id ) )
						continue;
					$cat = $cat->term_id;
				}
				$descendants = get_term_children( (int) $cat, 'category' );
				if ( $descendants && in_category( $descendants, $_post ) )
					return true;
			}
			return false;
		}
	}



	// !Check If Page Is Child
	// Reference Snippets

	//https://gist.github.com/ericrasch/4723316
	/* =BEGIN: Check If Page Is Child
    Source: http://bavotasan.com/2011/is_child-conditional-function-for-wordpress/
   ---------------------------------------------------------------------------------------------------- */
    function is_child( $page_id_or_slug ) { // $page_id_or_slug = The ID of the page we're looking for pages underneath
	    global $post; // load details about this page

	    if ( !is_numeric( $page_id_or_slug ) ) { // Used this code to change a slug to an ID, but had to change is_int to is_numeric for it to work.
	        $page = get_page_by_path( $page_id_or_slug );
	        $page_id_or_slug = $page->ID;
	    }

	    if ( is_page() && ( $post->post_parent == $page_id_or_slug ) )
	        return true; // we're at the page or at a sub page
	    else
	        return false; // we're elsewhere
	};


	// !Check If Page Is Parent/Child/Ancestor
	// Reference Snippets

	//https://gist.github.com/ericrasch/4723316
	/* =BEGIN: Check If Page Is Parent/Child/Ancestor
    Source: http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/#comment-172337
   ---------------------------------------------------------------------------------------------------- */
    function is_tree( $page_id_or_slug ) { // $page_id_or_slug = The ID of the page we're looking for pages underneath
        global $post; // load details about this page

        if ( !is_numeric( $page_id_or_slug ) ) { // Used this code to change a slug to an ID, but had to change is_int to is_numeric for it to work: http://bavotasan.com/2011/is_child-conditional-function-for-wordpress/
            $page = get_page_by_path( $page_id_or_slug );
            $page_id_or_slug = $page->ID;
        }

        if ( is_page() && ( $post->post_parent == $page_id_or_slug || (is_page( $page_id_or_slug ) || in_array($page_id_or_slug, $post->ancestors) ) ) )
            return true; // we're at the page or at a sub page
        else
            return false; // we're elsewhere
    };


	// ! Remove Automatic JPEG Compression
	add_filter( 'jpeg_quality', 'smashing_jpeg_quality' );
	function smashing_jpeg_quality() {
	   return 80;
	}







// Changing excerpt length
/*
function new_excerpt_length($length) {
return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Changing excerpt more
function new_excerpt_more($more) {
return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
*/

// Replaces the excerpt "Read More" text by a link
/*
function new_excerpt_more($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
*/


/* Change Excerpt length */
/*
function custom_excerpt_length( $length ) {
return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
*/




	// !Filter the <p> tags from the images for both Wordpress and ACF Editor
	function filter_ptags_on_images($content) {
	    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
	}
	add_filter('acf_the_content', 'filter_ptags_on_images');
	add_filter('the_content', 'filter_ptags_on_images');


	// !Excerpt changing length of the_excerpt without changing the whole wordpress
	/* Usage <?php excerpt('15'); ?>*/
		function excerpt($num) {
		$limit = $num+1;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt)."...";
		echo $excerpt;
	}

		function content($num) {
		$theContent = get_the_content();
		$output = preg_replace('/<img[^>]+./','', $theContent);
		$limit = $num+1;
		$content = explode(' ', $output, $limit);
		array_pop($content);
		$content = implode(" ",$content)."...";
		echo $content;
	}

		function title($num) {
		$limit = $num+1;
		$title = explode(' ', get_the_title(), $limit);
		array_pop($title);
		$title = implode(" ",$title)."...";
		echo $title;
	}



	// !Add a button link beneath an Wordpress excerpt to the full post
	function excerpt_read_more_link($output) {
	 global $post;
	 return $output . '<div class="read-more"><a href="'. get_permalink($post->ID) . '" class="button">Continue Reading...</a></div>';
	}
	add_filter('the_excerpt', 'excerpt_read_more_link');





	// !Adding a Custom Dashboard Logo
	function custom_admin_logo() {
		echo '<style type="text/css">
		#wp-admin-bar-wp-logo > .ab-item .ab-icon {
			background-image: url('  . get_template_directory_uri('template_directory') . '/assets/images/favicon.ico) !important;
			background-position: 0 !important;
		}
		</style>';
	}
	add_action( 'admin_head', 'custom_admin_logo' );



	// !Replace "Howdy" with "Logged in as" in WordPress bar
	function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
		$user_id = get_current_user_id();
		$current_user = wp_get_current_user();
		$profile_url = get_edit_profile_url( $user_id );

		if ( 0 != $user_id ) {
			/* Add the "My Account" menu */
			/*	Additional display settings for user
				$current_user->user_login
				$current_user->user_email
				$current_user->user_firstname
				$current_user->user_lastname
				$current_user->display_name
				$current_user->ID
			*/
			$avatar = get_avatar( $user_id, 28 );
			$howdy = sprintf( __('Hello, %1$s','joinstheme'), $current_user->user_firstname );
			$class = empty( $avatar ) ? '' : 'with-avatar';
			$wp_admin_bar->add_menu( array(
				'id' => 'my-account',
				'parent' => 'top-secondary',
				'title' => $howdy . $avatar,
				'href' => $profile_url,
				'meta' => array(
					'class' => $class,
				),
			));
		}
	}
	add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );



	// !Change login URL
	function my_custom_login_url() {
		return site_url();
	}
	add_filter( 'login_headerurl', 'my_custom_login_url', 10, 4 );



	// !Change the title attribute of the login image
	function  custom_login_title() {
	        return get_option('blogname');
	}
	add_filter('login_headertitle', 'custom_login_title');



	// Add body class to Visual Editor to match class used live
	function mytheme_mce_settings( $initArray ){
	 $initArray['body_class'] = 'post';
	 return $initArray;
	}
	add_filter( 'tiny_mce_before_init', 'mytheme_mce_settings' );



	// !Add Thumbnails in Manage Posts/Pages List
	if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
    // For post and page
    add_theme_support('post-thumbnails', array( 'post', 'page' ) );
    function AddThumbColumn($cols) {
        $cols['thumbnail'] = __('Thumbnail', 'foundation');
        return $cols;
    }
    function AddThumbValue($column_name, $post_id) {
            $width = (int) 60;
            $height = (int) 60;
            if ( 'thumbnail' == $column_name ) {
                // thumbnail of WP 2.9
                $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
                // image from gallery
                $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
                if ($thumbnail_id)
                    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
                elseif ($attachments) {
                    foreach ( $attachments as $attachment_id => $attachment ) {
                        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                    }
                }
                    if ( isset($thumb) && $thumb ) {
                        echo $thumb;
                    } else {
                        echo __('None','foundation');
                    }
            }
    }
    // Posts
    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
    // Pages
    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
	}



	// !Custom CSS styles on WYSIWYG Editor
	function my_theme_add_editor_styles() {
	    add_editor_style( 'custom-editor-style.css' );
	}
	add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

	// Callback function to insert 'styleselect' into the $buttons array
	function my_mce_buttons_3( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
	// Register our callback to the appropriate filter
	add_filter('mce_buttons_3', 'my_mce_buttons_3');

	// Callback function to filter the MCE settings
	function my_mce_before_init_insert_formats( $init_array ) {
		// Define the style_formats array
		$style_formats = array(
			// Each array child is a format with it's own settings
			array(
				'title' => 'Button',
				'block' => 'span',  // Used for block elements (div, span etc...)
				'classes' => 'button outline',
				'wrapper' => true,

			),
			array(
				'title' => 'Block H1',
				'format' => 'h1',  // Used for format elements (h1, h2 etc...)
				'classes' => 'redheader',
				'wrapper' => true,

			),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );

		return $init_array;

	}
	// Attach callback to 'tiny_mce_before_init'
	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );



	// !Custom CSS styles in WYSIWYG Editor
	if ( ! function_exists( 'myCustomTinyMCE' ) ) :
	function myCustomTinyMCE($init) {
		$init['theme_advanced_disable'] = ''; // Removes the undesired buttons
	  	$init['theme_advanced_buttons2_add_before'] = 'styleselect'; // Adds the buttons at the begining. (theme_advanced_buttons2_add adds them at the end)
	  	$init['theme_advanced_styles'] = 'style1=style1, style2=style2';
	 return $init;
	}
	endif;
	add_filter('tiny_mce_before_init', 'myCustomTinyMCE' );



	// !Add NextPage Button WYSIWYG Editor
	add_filter('mce_buttons','wysiwyg_editor');

	function wysiwyg_editor($mce_buttons) {
		$pos = array_search('wp_more',$mce_buttons,true);
		if ($pos !== false) {
		$buttons = array_slice($mce_buttons, 0, $pos+1);
		$buttons[] = 'wp_page';
		$mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos+1));
	}
	return $mce_buttons;
	}



	// !Add Additional Buttons WYSIWYG Editor
	function enable_more_buttons($buttons) {
		$buttons[] = 'fontsizeselect';
		$buttons[] = 'subscript';
		$buttons[] = 'superscript';
		//$buttons[] = 'charmap';
		//$buttons[] = 'newdocument';
		//$buttons[] = 'fontselect';
		//$buttons[] = 'styleselect';
		//$buttons[] = 'backcolor';
		//$buttons[] = 'cut';
		//$buttons[] = 'copy';
	  return $buttons;
	}
	add_filter("mce_buttons_3", "enable_more_buttons");


	// !Customize mce editor font sizes
	if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
		function wpex_mce_text_sizes( $initArray ){
			$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
			return $initArray;
		}
	}
	add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );



function my_mce4_options($init) {
	$default_colours =
			'"000000", "Black",
			"FFFFFF", "White"';
/*
		'"000000", "Black",
		"993300", "Burnt orange",
		"333300", "Dark olive",
		"003300", "Dark green",
		"003366", "Dark azure",
		"000080", "Navy Blue",
		"333399", "Indigo",
		"333333", "Very dark gray",
		"800000", "Maroon",
		"FF6600", "Orange",
		"808000", "Olive",
		"008000", "Green",
		"008080", "Teal",
		"0000FF", "Blue",
		"666699", "Grayish blue",
		"808080", "Gray",
		"FF0000", "Red",
		"FF9900", "Amber",
		"99CC00", "Yellow green",
		"339966", "Sea green",
		"33CCCC", "Turquoise",
		"3366FF", "Royal blue",
		"800080", "Purple",
		"999999", "Medium gray",
		"FF00FF", "Magenta",
		"FFCC00", "Gold",
		"FFFF00", "Yellow",
		"00FF00", "Lime",
		"00FFFF", "Aqua",
		"00CCFF", "Sky blue",
		"993366", "Red violet",
		"FFFFFF", "White",
		"FF99CC", "Pink",
		"FFCC99", "Peach",
		"FFFF99", "Light yellow",
		"CCFFCC", "Pale green",
		"CCFFFF", "Pale cyan",
		"99CCFF", "Light sky blue",
		"CC99FF", "Plum"';
*/

  $custom_colours =  '"f57b20", "Orange",
                      "efefef", "Light Gray"';

  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

  // enable 6th row for custom colours in grid
  $init['textcolor_rows'] = 6;

  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');








	// !Check for display of unnecessary information on failed login attempts.
	function wrong_login() {
  		return 'Wrong username or password.';
	}
	add_filter('login_errors', 'wrong_login');


	// !Used for Google Analytics Dashboard plugin to clean DB
	add_action( 'wp_scheduled_delete', 'delete_expired_db_transients' );

	function delete_expired_db_transients() {

	    global $wpdb, $_wp_using_ext_object_cache;

	    if( $_wp_using_ext_object_cache )
	        return;

	    $time = isset ( $_SERVER['REQUEST_TIME'] ) ? (int)$_SERVER['REQUEST_TIME'] : time() ;
	    $expired = $wpdb->get_col( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < {$time};" );

	    foreach( $expired as $transient ) {

	        $key = str_replace('_transient_timeout_', '', $transient);
	        delete_transient($key);
	    }
	}



	// !Add PDF mime type, here: 'application/pdf'
	function modify_post_mime_types( $post_mime_types ) {
	// select the mime type, here: 'application/pdf'
	// then we define an array with the label values
	$post_mime_types['application/pdf'] = array( __( 'PDFs','foundation' ), __( 'Manage PDFs','foundation' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>', 'jointstheme' ) );

	// then we return the $post_mime_types variable
	return $post_mime_types;
	}
	// Add Filter Hook
	add_filter( 'post_mime_types', 'modify_post_mime_types' );



	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');



	// !Only Allow Administrators to Access the WordPress Admin Area
	add_action( 'admin_init', 'redirect_non_admin_users' );
	/**
	 * Redirect non-admin users to home page
	 *
	 * This function is attached to the 'admin_init' action hook.
	 */
	function redirect_non_admin_users() {
		if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
			wp_redirect( home_url() );
			exit;
		}
	}



	// !Disable Comments on WordPress Media Attachments (USED WITH JETPACK)
	function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
	}
	add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );



	// !Get Current Page Template
	function define_current_theme_file( $template ) {
	    $GLOBALS['current_theme_template'] = basename($template);

	    return $template;
	}
	add_action('template_include', 'define_current_theme_file', 1000);

	// !Remove query strings
	function jw_remove_script_version( $src ){
	 return remove_query_arg( 'ver', $src );
	}
	add_filter( 'script_loader_src', 'jw_remove_script_version' );
	add_filter( 'style_loader_src', 'jw_remove_script_version' );


	// Emoji detection script.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

	// Emoji styles.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Add custom text below wp-login logo
	function wps_login_message( $message ) {
	    if ( empty($message) ){
	        return '<p class="message">If you don’t have a username and password, <br>email: <a style="color:#1abc9c;" href="#">Some Email Address</a> to request access.</p>';
	    } else {
	        return $message;
	    }
	}
	add_filter( 'login_message', 'wps_login_message' );

	// Change wp-login text for wordpress lables
	global $pagenow;
	if ($pagenow==='wp-login.php') {
	  add_filter( 'gettext', 'user_email_login_text', 20, 3 );
	  function user_email_login_text( $translated_text, $text, $domain ) {
	    if ($translated_text === 'Lost your password?') {

	        $translated_text = '&larr; Reset your password';
	    }

	    return $translated_text;
	  }

	}



	// Add custom Twitter and LinkedIN share functions
	// Remember to add the seperate echo calls for each function to the template pages
	function custom_scripts() {
		if (!is_admin()) {

			wp_register_script( 'twitter', 'http://platform.twitter.com/widgets.js', array('jquery'), 'null', true);
			wp_enqueue_script( 'twitter');

			wp_register_script( 'linkedin', 'http://platform.linkedin.com/in.js', array('jquery'), 'null', true);
			wp_enqueue_script( 'linkedin');

		}
	}
	add_action('init', 'custom_scripts');

?>