<!-- Footer Start -->
<div class="container-fluid footer bg-dark" data-wow-delay=".3s">
    <div class="container pt-5 pb-4">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <a href="http://localhost/wordpress/" class="navbar-brand">
                    <div> <?php the_custom_logo(); ?></div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#" class="h3 text-secondary">Short Link</a>
                <div class="mt-4 d-flex flex-column short-link">
                    <!-- ****** footer menu-->
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_menu',
                        'menu_id' => 'footer_menu',
                        'menu_class' => 'nav-item nav-link',
                    ));
                    ?>
                    <!-- ****** -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#" class="h3 text-secondary">Help Link</a>
                <div class="mt-4 d-flex flex-column help-link">
                    <!-- ****** footer menu-->
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer_menu',
                        'menu_id' => 'footer_menu',
                        'menu_class' => 'nav-item nav-link',
                    ));
                    ?>
                    <!-- ****** -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="#" class="h3 text-secondary">Contact Us</a>
                <div class="text-white mt-4 d-flex flex-column contact-link">
                    <div class="footer-contact">
                        <p> <?php get_post_meta(get_the_ID(), 'contact', true) ?> </p>
                        <p> <?php get_post_meta(get_the_ID(), 'encary', true) ?> </p>

                    </div>
                </div>
            </div>
        </div>
        <hr class="text-light mt-5 mb-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <span class="text-light"><a href="#" class="text-secondary"><i class="fas fa-copyright text-secondary me-2"></i>Your Site Name</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
               <p>Distributed By ThemeWagon</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
<?php wp_footer(); ?>

</body>

</html>