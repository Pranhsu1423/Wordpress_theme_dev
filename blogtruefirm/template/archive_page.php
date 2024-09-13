<?php
/*
Template Name: Archives
*/
get_header(); ?>
<!-- placeholder="Latest Blogs & Categories"  -->
<section class="archive-banner ast-container-full">
    <img src="http://devblog.softgetix.com/wp-content/uploads/2024/09/blog-banner.png" alt="Blog Banner">
    <div id="main-header-search" class="container">
        <div class="container-inner">
        <?php get_search_form(); ?>
        </div>
    </div>
</section>
<section class="ast-container body"> 
    <div class="tabs-contaner">
        <ul class="tab-list">
            <?php
            $categories = array(
                'ai-artificial-intelligence' => 'Artificial Intelligence',
                'digital-marketing'          => 'Digital Marketing',
                'services'                   => 'Services',
                'software-development'       => 'Software Development',
                'uncategorized'              => 'Uncategorized',
                'web3-development'           => 'Web3 Development'
            );
            $counter = 1;

            foreach ($categories as $slug => $name) {
                $category = get_category_by_slug($slug);
                if ($category) {
                    echo '<li class="tab" data-tab="tab-' . esc_attr($counter) . '"><a href="#tab-' . esc_attr($counter) . '">' . esc_html($name) . '</a></li>';
                    $counter++;
                }
            }
            ?>
            <li><a href="#tab-<?php echo esc_attr($counter); ?>" class="tab" data-tab="tab-<?php echo esc_attr($counter); ?>"><span class="material-icons">schedule</span></a></li>
            <li><a href="#tab-<?php echo esc_attr($counter + 1); ?>" class="tab" data-tab="tab-<?php echo esc_attr($counter + 1); ?>"><span class="material-icons">star</span></a></li>
            <li><a href="#tab-<?php echo esc_attr($counter + 2); ?>" class="tab" data-tab="tab-<?php echo esc_attr($counter + 2); ?>"><span class="material-icons">comment</span></a></li>
            <li><a href="#tab-<?php echo esc_attr($counter + 3); ?>" class="tab" data-tab="tab-<?php echo esc_attr($counter + 3); ?>"><span class="material-icons">sell</span></a></li>
        </ul>
    </div>

    <div class="tab-content">
        <?php
        $counter = 1; // Reset counter for content section
        foreach ($categories as $slug => $name) {
            $category = get_category_by_slug($slug);
            if ($category) {
                echo '<div id="tab-' . esc_attr($counter) . '" class="content" role="tabpanel">';
                $query = new WP_Query(array('cat' => $category->term_id));
                if ($query->have_posts()) {
                    echo '<div class="card-grid">'; 
                    while ($query->have_posts()) {
                        $query->the_post();
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="card-image">
                                        <?php the_post_thumbnail('full'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <span class="card-category"><?php echo esc_html($name); ?></span>
                                <span class="card-date"><?php echo get_the_date('F j, Y'); ?></span>
                                <h2 class="card-title"><?php the_title(); ?></h2>
                                <div class="card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="card-read-more">Read More...</a>
                            </div>
                        </div>
                        <?php
                    }
                    echo '</div>'; 
                    wp_reset_postdata();
                } else {
                    echo '<p>No posts found in this category.</p>';
                }
                echo '</div>';
                $counter++;
            }
        }
        ?>
        
        <div id="tab-<?php echo esc_attr($counter); ?>" class="content">
            <?php
            // Recent posts query
            $recent_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
            );
            $recent_query = new WP_Query($recent_args);

            if ($recent_query->have_posts()) :
                echo '<div class="card-grid">';
                while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
                   <div class="card">
                            <div class="card-header">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="card-image">
                                        <?php the_post_thumbnail('full'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <span class="card-category"><?php echo esc_html($name); ?></span>
                                <span class="card-date"><?php echo get_the_date('F j, Y'); ?></span>
                                <h2 class="card-title"><?php the_title(); ?></h2>
                                <div class="card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="card-read-more">Read More...</a>
                            </div>
                        </div>
                <?php endwhile;
                echo '</div>';
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <div id="tab-<?php echo esc_attr($counter + 1); ?>" class="content">
            <?php
            // Popular posts query
            $popular_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'orderby'        => 'comment_count',
                'order'          => 'DESC',
                'date_query'     => array(
                    array(
                        'after' => '1 month ago',
                    ),
                ),
            );
            $popular_query = new WP_Query($popular_args);
     
            if ($popular_query->have_posts()) :
                echo '<div class="card-grid">';
                while ($popular_query->have_posts()) : $popular_query->the_post(); ?>
                    <div class="card">
                            <div class="card-header">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="card-image">
                                        <?php the_post_thumbnail('full'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <span class="card-category"><?php echo esc_html($name); ?></span>
                                <span class="card-date"><?php echo get_the_date('F j, Y'); ?></span>
                                <h2 class="card-title"><?php the_title(); ?></h2>
                                <div class="card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="card-read-more">Read More...</a>
                            </div>
                        </div>
                <?php endwhile;
                echo '</div>';
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <div id="tab-<?php echo esc_attr($counter + 2); ?>" class="content">
            <?php
            // Query for recent comments
            $recent_comments = get_comments(array(
                'number'      => 15,
                'status'      => 'approve',
                'post_status' => 'publish'
            ));

            if (!empty($recent_comments)) {
                echo '<ul class="recent-comments">';
                foreach ($recent_comments as $comment){

                    $post_title = get_the_title($comment->comment_post_ID);
            $post_link = get_permalink($comment->comment_post_ID);
            $avatar = get_avatar($comment, 50); // Get comment author's avatar
            ?>
            <li class="comment-item">
                <div class="comment-avatar">
                    <?php echo $avatar; ?>
                </div>
                <div class="comment-details">
                    <a href="<?php echo esc_url($post_link); ?>" class="comment-author">
                        <?php echo esc_html($comment->comment_author); ?> says:
                    </a>
                    <p class="comment-excerpt"><?php echo esc_html(wp_trim_words($comment->comment_content, 10, '...')); ?></p>
                </div>
            </li>
            <?php

                }
                echo '</ul>';
            } else {
                echo '<p>No recent comments found.</p>';
            }
            ?>
        </div>
        <div id="tab-<?php echo esc_attr($counter + 3); ?>" class="content">
        <h2 class="tag-title">Tags</h2>
            <?php
            // Display tag cloud
            echo '<div class="tag-cloud">';
            wp_tag_cloud(array(
                'number'  => 25,
                'orderby' => 'name',
                'order'   => 'ASC',
            ));
            echo '</div>';
            ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>
