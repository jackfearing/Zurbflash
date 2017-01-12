<?php
	if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Header Settings',
			'menu_title'	=> 'Header',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Footer Settings',
			'menu_title'	=> 'Footer',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Header Settings',
			'menu_title'	=> 'Archives',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			//'page_title' 	=> 'Theme Sidebar Settings',
			//'menu_title'	=> 'Sidebar Default',
			//'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Sidebar Module Settings',
			'menu_title'	=> 'Sidebar 1',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Sidebar Module Settings',
			'menu_title'	=> 'Sidebar 2',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Sidebar Module Settings',
			'menu_title'	=> 'Sidebar 3',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Sidebar Module Settings',
			'menu_title'	=> 'Sidebar 4',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Sidebar Module Settings',
			'menu_title'	=> 'Sidebar 5',
			'parent_slug'	=> 'theme-general-settings',
		));

	}
