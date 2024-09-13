<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <div class="single-card">
                        <div class="single-card-header">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="single-card-image">
                                    <?php the_post_thumbnail('full'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="single-card-body">
                            <span class="single-card-category"><?php the_category(', '); ?></span>
                            <h1 class="single-card-title"><?php the_title(); ?></h1>
                            <div class="single-card-date">
                                <p>
                                    BY <?php the_author(); ?> · PUBLISHED <?php echo get_the_date(); ?> · UPDATED <?php echo get_the_modified_date(); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->

                <div class="sigle-page-tags">
                    <h3>TAGS:</h3>
                    <?php if (has_tag()) : ?>
                        <?php the_tags('', ', '); // Display tags as links ?>
                    <?php endif; ?>
                </div>

                <div class="also-like">
                   <div class="title-img"> 
                    <img src="http://devblog.softgetix.com/wp-content/uploads/2024/09/el_hand-up.png" alt="">
                    <h3 class="also-like-post">YOU MAY ALSO LIKE...</h3>
                    </div> 
                    <?php
// Query for recent posts
$recent_query = new WP_Query(array(
    'posts_per_page' => 4,
    'post__not_in' => array(get_the_ID())
));
if ($recent_query->have_posts()) : 
    echo '<div class="post-grid-container card-grid">'; // Grid Container
    while ($recent_query->have_posts()) : $recent_query->the_post(); 
        echo '<div class="post-grid-item">'; // Grid Item with card-grid class
        ?>
            <div class="card">
                <div class="card-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="card-image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <span class="card-category">
                        <?php $category = get_the_category(); echo esc_html($category[0]->name); ?>
                    </span>
                    <span class="card-date">
                        <?php echo get_the_date('F j, Y'); ?>
                    </span>
                    <h2 class="card-title"><?php the_title(); ?></h2>
                    <div class="card-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="card-read-more">Read More...</a>
                </div>
            </div>
        <?php
        echo '</div>'; // End the grid item
    endwhile; 
    echo '</div>'; // End the grid container
endif;
wp_reset_postdata();?>
</div><!-- .also-like -->

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
