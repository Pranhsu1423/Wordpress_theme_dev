<?php get_header(); ?>
<body>
<!-- <h2>This is Front page  </h2> -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    // the_title();
    the_category();
    the_content();
    the_author();
    the_tags();
endwhile;
endif;
?>


<?php bloginfo('title');?>
<?php bloginfo('descreption');?>


<?php get_footer(); ?>