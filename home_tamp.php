<?php /* Template Name: Home Tampleate */ ?>
<?php get_header(); ?>

<div class="owl-carousel">
   <?php
   
$args = array('post_type' => 'testimonial', 'posts_per_page' => 10);
$the_query = new WP_Query($args);
$html = '';
if ($the_query->have_posts()) :
   while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <div class="">
      <?php the_post_thumbnail();
       the_title();
      //  the_category();
       the_content();
       ?>
      </div>
   <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
</div>

<?php if (have_posts()) : while (have_posts()) : the_post();
      //  get_template_part('/Tampleate/home_tamp.php');
      the_title();
      the_category();
      the_content();
      the_author();
      the_tags();
   endwhile;
endif;
get_sidebar();
?>
<?php get_footer(); ?>