<?php
include get_template_directory() . "/assets/inc/add_support.php";

/**
 * Add a Register sidebar.
 */
function mywpdocs_theme_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Main Sidebar', 'PTheme'),
		'id'            => 'sidebar',
		'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'mywpdocs_theme_widgets_init');

/**
 * Add a functions templeates files.
 */
//  this function work with parent theme 
// get_template_directory();
//  this function work with child theme 
// get_stylesheet_directory();
//  this function uri work with parent theme 
// get_template_directory_uri();
//  this function uri work with child theme 
// get_stylesheet_directory_uri();

// get_stylesheet_uri();

// include( get_template_directory() . '/includes/my_file.php' );

// hooks tuturaial :-https://www.youtube.com/watch?v=Sxf3sqbbjAM&list=PL9fcHFJHtFaaxzIQth3Z3fDeVlZkzkY5v&index=4

// Url for updates hooks in wordpress :- https://adambrown.info/p/wp_hooks

/**
 * Add Proper way to enqueue scripts and styles
 */
function mywpdocs_wordpress_theme_scripts() {
	wp_enqueue_style('my-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style('carousel-style', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '1.0.0', 'all');
	wp_enqueue_script('my-script', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('carousel-script', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '1.0.0', true);
	
	// wp_dequeue_style();
	// wp_dequeue_script();
	// and 
	// wp_deregeste_style();
	// wp_deregester_script();
}
add_action( 'wp_enqueue_scripts', 'mywpdocs_wordpress_theme_scripts' );

/**
 * Custom Post type for Carousel
 */
// --------------------testimonial custom post type-------------- //
function testimonial() {
    register_post_type( 'testimonial',
        array(
            'labels' => array(
                'name' => __( 'Our Customers' ),
                'singular_name' => __( 'Our Customer' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'testimonial'),
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-slides', // Change custom post type menu icon URL: https://developer.wordpress.org/resource/dashicons
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        )
    );
}
add_action('init', 'testimonial');

// <div class="slide item"><img src="'.$featured_img_url.'" alt=""> <div class="content"><h4>'.$title.'</h4><p>'.$content.'</p></div></div>

// clients post type  
function create_client_post_type() {
    $labels = array(
        'name' => 'Clients',
        'singular_name' => 'Client',
        'menu_name' => 'Clients',
        // Add other labels here	
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        // 'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'clients'),
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 20,
        'has_archive' => true,
        // Add other arguments here
    );
    register_post_type('client', $args);
}
add_action('init', 'create_client_post_type');

// clients post type shortcode 
// dsffs
function clients_shortcode() {
    $args = array(
        'post_type' => 'client', // Replace with your custom post type name if different
        'posts_per_page' => -1, // Display all client posts
    );

    $client_query = new WP_Query($args);

    if ($client_query->have_posts()) {
        ob_start();

        while ($client_query->have_posts()) {
            $client_query->the_post();

            // Retrieve custom field values using ACF functions
            // $image_name = get_field('image_name');
            $position = get_field('position');
            $image_codes = get_field('codes');
            $paragraph = get_field('paragraph');

            // Output client information (display fields in HTML format on the webpage)
			// echo '<div class="icon-box-container">';

            echo '<div class="client">';
            // if ($image_name) {
            //     echo '<img src="' . esc_url($image_name) . '" alt="' . esc_attr(get_the_title()) . '" />';
            // }
			echo '<img>' . the_post_thumbnail(); '</img>';
            echo '<h3>' . esc_html(get_the_title()) . '</h3>';
            if ($position) {
                echo '<p>' . esc_html($position) . '</p>';
            }
            // if ($image_codes) {
            //     echo '<p>' . esc_html($image_codes) . '</p>';
            // }
            if ($paragraph) {
                echo '<p>' . esc_html($paragraph) . '</p>';
            }
            echo '</div>';
			// echo '</div>';
        }

        wp_reset_postdata();

        return ob_get_clean();
    } else {
        return 'No clients found.';
    }
}
add_shortcode('display_clients', 'clients_shortcode');  