// Theme URI: https://github.com/WordPress/wordpress-develop  (this is Theme and Wordpress development URL we can use this file code and create on theme, Wordpress & Plugin). 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php wp_head(); ?>
</head>

<body <?php  body_class();?>>
  <!-- Navbar Start -->
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
          <a href="http://localhost/wordpress/" class="navbar-brand">
            <?php the_custom_logo(); ?>
          </a>
        </div>
        <div class="col-lg-10">
          <div class="nav" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-xl-auto p-0">

              <!-- ****** -->
              <?php
              wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'menu_id' => 'primary-menu',
                'menu_class' => 'nav-item nav-link',
              ));
              ?>
              <!-- ****** -->
            </div>
          </div>
          
          <!-- <?php get_search_form(); ?> -->
        </div>
      </div>
      </nav>
    </div>
  </div>
  <!-- Navbar End -->
