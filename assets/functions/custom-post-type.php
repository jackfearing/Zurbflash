<?php

/****************************************/
/* TAXONOMY FOR CUSTOM POST TYPES       */
/****************************************/

	add_action( 'init', 'my_custom_post_type_init' );
	/**
	 * Register a custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 * @link https://developer.wordpress.org/resource/dashicons/
	 */
	function my_custom_post_type_init() {
		$labels = array(
			'name'               => _x( 'Books', 'post type general name', 'jointstheme' ),
			'singular_name'      => _x( 'Book', 'post type singular name', 'jointstheme' ),
			'menu_name'          => _x( 'Books', 'admin menu', 'jointstheme' ),
			'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'jointstheme' ),
			'add_new'            => _x( 'Add New', 'book', 'jointstheme' ),
			'add_new_item'       => __( 'Add New Book', 'jointstheme' ),
			'new_item'           => __( 'New Book', 'jointstheme' ),
			'edit_item'          => __( 'Edit Book', 'jointstheme' ),
			'view_item'          => __( 'View Book', 'jointstheme' ),
			'all_items'          => __( 'All Books', 'jointstheme' ),
			'search_items'       => __( 'Search Books', 'jointstheme' ),
			'parent_item_colon'  => __( 'Parent Books:', 'jointstheme' ),
			'not_found'          => __( 'No books found.', 'jointstheme' ),
			'not_found_in_trash' => __( 'No books found in Trash.', 'jointstheme' )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'jointstheme' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'          => 'dashicons-book-alt',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'book' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'taxonomies' 		 => array('category','post_tag'),
		);

		register_post_type( 'book', $args );
	}



	// hook into the init action and call create_product_taxonomies when it fires
	add_action( 'init', 'create_product_taxonomies', 0 );

	// create taxonomy, types for the post type "product"
	function create_product_taxonomies() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Types', 'taxonomy general name', 'jointstheme' ),
			'singular_name'     => _x( 'Type', 'taxonomy singular name', 'jointstheme' ),
			'search_items'      => __( 'Search Types', 'jointstheme' ),
			'all_items'         => __( 'All Types', 'jointstheme' ),
			'parent_item'       => __( 'Parent Type', 'jointstheme' ),
			'parent_item_colon' => __( 'Parent Type:', 'jointstheme' ),
			'edit_item'         => __( 'Edit Type', 'jointstheme' ),
			'update_item'       => __( 'Update Type', 'jointstheme' ),
			'add_new_item'      => __( 'Add New Type', 'jointstheme' ),
			'new_item_name'     => __( 'New Type Name', 'jointstheme' ),
			'menu_name'         => __( 'Type', 'jointstheme' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'type' ),
		);

		register_taxonomy( 'type', array( 'book' ), $args );

	}


/*******************************************/
/* TAXONOMY FILTER FOR CUSTOM POST TYPES  */
/*****************************************/

	/**
	 * Display a custom taxonomy dropdown in admin
	 * @author Mike Hemberger
	 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
	 */
	add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
	function tsm_filter_post_type_by_taxonomy() {
		global $typenow;
		$post_type = 'book'; // change to your post type
		$taxonomy  = 'type'; // change to your taxonomy
		if ($typenow == $post_type) {
			$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
			));
		};
	}
	/**
	 * Filter posts by taxonomy in admin
	 * @author  Mike Hemberger
	 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
	 */
	add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
	function tsm_convert_id_to_term_in_query($query) {
		global $pagenow;
		$post_type = 'book'; // change to your post type
		$taxonomy  = 'type'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}





/****************************************/
/* TAXONOMY FOR PAGES 					*/
/****************************************/

	// Add custom taxonomy to pages
	//hook into the init action and call create_book_taxonomies when it fires
	add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );

	//create a custom taxonomy name it topics for your posts
	function create_topics_hierarchical_taxonomy() {
		// Add new taxonomy, make it hierarchical like categories
		$labels = array(
			'name' 				=> _x( 'Topics', 'taxonomy general name', 'jointstheme' ),
			'singular_name' 	=> _x( 'Topic', 'taxonomy singular name', 'jointstheme' ),
			'search_items' 		=> __( 'Search Topics', 'jointstheme' ),
			'all_items' 		=> __( 'All Topics', 'jointstheme' ),
			'parent_item' 		=> __( 'Parent Topic', 'jointstheme' ),
			'parent_item_colon'	=> __( 'Parent Topic:', 'jointstheme' ),
			'edit_item' 		=> __( 'Edit Topic', 'jointstheme' ),
			'update_item' 		=> __( 'Update Topic', 'jointstheme' ),
			'add_new_item' 		=> __( 'Add New Topic', 'jointstheme' ),
			'new_item_name' 	=> __( 'New Topic Name', 'jointstheme' ),
			'menu_name' 		=> __( 'Topics', 'jointstheme' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'topic' ),
		);

		register_taxonomy( 'topics', array( 'page' ), $args );

	}


/****************************************/
/* TAXONOMY FILTER FOR PAGES 			*/
/****************************************/

	/**
	 * Display a custom taxonomy dropdown in admin
	 * @author Mike Hemberger
	 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
	 */
	add_action('restrict_manage_posts', 'tsm_filter_page_type_by_taxonomy');
	function tsm_filter_page_type_by_taxonomy() {
		global $typenow;
		$post_type = 'page'; // change to your post type
		$taxonomy  = 'topics'; // change to your taxonomy
		if ($typenow == $post_type) {
			$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
			));
		};
	}
	/**
	 * Filter posts by taxonomy in admin
	 * @author  Mike Hemberger
	 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
	 */
	add_filter('parse_query', 'tsm_convert_id_to_tax_in_query');
	function tsm_convert_id_to_tax_in_query($query) {
		global $pagenow;
		$post_type = 'page'; // change to your post type
		$taxonomy  = 'topics'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}



?>