<?php

/**
 * Add a Feature Images.
 */
// add_theme_support('post_thumbnails');
add_theme_support( 'post-thumbnails' );
/**
 * Add a Html5 supports.
 */
add_theme_support('html5', array(
	'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'
));

/**
 * Add a custom-logo.
 */
function Wordpress_theme_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'Wordpress_theme_custom_logo_setup' );

/**
 * Add a Register function to add nav menu in Navigation Bar and Footer Bar.
 */
function add_nav_menus()
{
	register_nav_menus(array(
		'primary_menu' => 'Primary Menu',
		'footer_menu'  => 'Footer Menu',
	));
}
add_action('init', 'add_nav_menus');

?>