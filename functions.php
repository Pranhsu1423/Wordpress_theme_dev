<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );
	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';


// User role: Tech
// Jyot@gmail.com
// 8IS&zfenq70y!6

// User role: Tutor
// abostos@gmail.com
// EeV8GYuNR2N)#

// Change User Role 1 Capabilities Start
add_action('init', function(){

	add_role('tech', 'Tech');
	
	$tech = get_role('tech');
	$tech-> add_cap('read');
	$tech-> add_cap('edit_pages');
	$tech-> add_cap('edit_page');
	$tech-> add_cap('edit_others_page');
	$tech-> add_cap('edit_others_pages');
	});

// Change User Role 1 Capabilities End

// Change User Role 2 Capabilities Start

add_action('init', function(){

	add_role('tutor', 'Tutor');
	
	$tech = get_role('tutor');
	$tech-> add_cap('read');
	$tech-> add_cap('edit_posts');
	$tech-> add_cap('edit_post');
	$tech-> add_cap('edit_others_post');
	$tech-> add_cap('edit_others_posts');
	});

// Change User Role 2 Capabilities End

// Change labels of custom post type start
add_action( 'init', 'pranshu_developer_post_type_labels' );
function pranshu_developer_post_type_labels() {
    global $wp_post_types;

    $labels = &$wp_post_types['page']->labels;
    
    $labels->name = 'Articles';
    $labels->singular_name = 'Article';
    $labels->add_new = 'Add New Article';
    $labels->add_new_item = 'Add New Article';
    $labels->edit_item = 'Edit Article';
    $labels->new_item = 'New Article';
    $labels->view_item = 'View Article';
    $labels->search_items = 'Search Articles';
    $labels->not_found = 'No Articles found';
    $labels->not_found_in_trash = 'No Articles found in trash';
    $labels->all_items = 'All Articles';
    $labels->menu_name = 'Articles';
    $labels->name_admin_bar = 'Article';
}
// Change labels of custom post type end