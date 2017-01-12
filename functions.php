<?php
// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php');

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php');

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php');

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php');

// Adds support for multiple languages
require_once(get_template_directory().'/assets/translation/translation.php');

// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php');

// Adds site styles to the WordPress editor
require_once(get_template_directory().'/assets/functions/editor-styles.php');

// Related post function - no need to rely on plugins
require_once(get_template_directory().'/assets/functions/related-posts.php');

// Use this as a template for custom post types
require_once(get_template_directory().'/assets/functions/custom-post-type.php');

// Customize the WordPress login menu
require_once(get_template_directory().'/assets/functions/login.php');

// Customize the WordPress admin
// require_once(get_template_directory().'/assets/functions/admin.php');

// New functions

// Adds Custom Functions
require_once(get_template_directory().'/assets/functions/custom-functions.php');

// Adds Custom style classes to ACF WYSIWYG admin editor
require_once(get_template_directory().'/assets/functions/acf-custom-wysiwyg-css.php');

// Adds ACF Options function
require_once(get_template_directory().'/assets/functions/acf-options.php');

// Adds Additonal image sizes to WP media settings page
require_once(get_template_directory().'/assets/functions/image-sizes.php');

// Adds Foundation Interchange Responsive Images + ACF
require_once(get_template_directory().'/assets/functions/interchange.php');

// Adds Foundation Interchange Responsive Thumbnail Images + ACF
require_once(get_template_directory().'/assets/functions/interchange-thumbnail.php');