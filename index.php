
<?php get_header(); ?>



<div class="container">
<div class="row">
<div class="col">

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>    
    <?php the_title( '<h3>', '</h3>' ); ?>
    <?php the_content( '<p>', '</p>' ); ?>
	<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
</div>





<?php
get_sidebar();
?>
<?php get_footer(); ?>