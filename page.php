<body>
<h2>this is page php </h2>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_title();
    the_category();
    the_content();
    the_author();
    the_tags();
endwhile;
endif;
?>