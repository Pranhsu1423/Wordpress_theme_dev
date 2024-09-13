<?php
/*
 * This is the child theme for Astra theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'blogtruefirm_enqueue_styles' );
function blogtruefirm_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );

    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true );
    
    // Enqueue Poppins Fonts
    wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins&display=swap', false );
    
    // Enqueue Material Icons correctly
    wp_enqueue_style( 'custom-google-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', false );
}

/**
 * Custom template tags for this theme.
 */
// require_once ASTRA_THEME_DIR . 'inc/widgets.php';

function custom_blog_widgets_init() {
    // Register Recent Posts widget
    register_sidebar(array(
        'name'          => 'Recent Posts',
        'id'            => 'recent-posts-widget',
        'before_widget' => '<div class="widget recent-posts">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Register Popular Posts widget
    register_sidebar(array(
        'name'          => 'Popular Posts',
        'id'            => 'popular-posts-widget',
        'before_widget' => '<div class="widget popular-posts">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Register Comments widget
    register_sidebar(array(
        'name'          => 'Comments',
        'id'            => 'comments-widget',
        'before_widget' => '<div class="widget comments-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    // Register Tags widget
    register_sidebar(array(
        'name'          => 'Tags',
        'id'            => 'tags-widget',
        'before_widget' => '<div class="widget tags-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'custom_blog_widgets_init');

// customize the "Recent Posts" widget
class Recent_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'recent_posts_widget', 
            __('Recent Posts', 'text_domain'), 
            array('description' => __('Displays recent posts', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        
        // Fetch recent posts
        $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
        echo '<ul>';
        foreach ($recent_posts as $post) {
            echo '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a></li>';
        }
        echo '</ul>';

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent Posts', 'text_domain');
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_recent_posts_widget() {
    register_widget('Recent_Posts_Widget');
}
add_action('widgets_init', 'register_recent_posts_widget');

// customize the "Popular Posts" widget
class Popular_Posts_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'popular_posts_widget', 
            __('Popular Posts', 'text_domain'), 
            array('description' => __('Displays popular posts', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        
        // Fetch popular posts based on comment count (or post views if available)
        $popular_posts = new WP_Query(array(
            'posts_per_page' => 5,
            'orderby' => 'comment_count', // or 'meta_value_num' if using post views
            'order' => 'DESC'
        ));

        if ($popular_posts->have_posts()) {
            echo '<ul>';
            while ($popular_posts->have_posts()) {
                $popular_posts->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a> (' . get_comments_number() . ' comments)</li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Popular Posts', 'text_domain');
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_popular_posts_widget() {
    register_widget('Popular_Posts_Widget');
}
add_action('widgets_init', 'register_popular_posts_widget');

// Recent Comments Widget

class Recent_Comments_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'recent_comments_widget', 
            __('Recent Comments', 'text_domain'), 
            array('description' => __('Displays recent comments', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];

        // Fetch recent comments
        $recent_comments = get_comments(array(
            'number' => 5,
            'status' => 'approve'
        ));

        if (!empty($recent_comments)) {
            echo '<ul>';
            foreach ($recent_comments as $comment) {
                echo '<li><a href="' . get_comment_link($comment->comment_ID) . '">';
                echo get_comment_author($comment->comment_ID) . ' on ' . get_the_title($comment->comment_post_ID);
                echo '</a><br>';
                echo '<p>' . $comment->comment_content . '</p>'; // Display the comment content
                echo '</li>';
            }
            echo '</ul>';
        } 

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent Comments', 'text_domain');
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_recent_comments_widget() {
    register_widget('Recent_Comments_Widget');
}
add_action('widgets_init', 'register_recent_comments_widget');

// Tags Widget
class Tags_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'tags_widget', 
            __('Tags', 'text_domain'), 
            array('description' => __('Displays post tags', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];

        // Display tags
        $tags = get_tags();
        if ($tags) {
            echo '<div class="tagcloud">';
            foreach ($tags as $tag) {
                echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-cloud-link" style="font-size: ' . (8 + $tag->count) . 'px;">' . $tag->name . '</a> ';
            }
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Tags', 'text_domain');
        ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
}

function register_tags_widget() {
    register_widget('Tags_Widget');
}
add_action('widgets_init', 'register_tags_widget');

