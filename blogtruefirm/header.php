<?php
/**
 * The header for Astra Theme.
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php 
if ( apply_filters( 'astra_header_profile_gmpg_link', true ) ) {
    ?>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php
} 
?>
<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
</head>
<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>

<a
    class="skip-link screen-reader-text"
    href="#content"
    role="link"
    title="<?php echo esc_attr( astra_default_strings( 'string-header-skip-link', false ) ); ?>">
        <?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?>
</a>

<div <?php echo astra_attr( 'site', array( 'id' => 'page', 'class' => 'hfeed site', ) ); ?>>
    <?php astra_header_before(); ?>

    <!-- Custom Header Code Starts -->
    <header id="masthead" class="site-header">
        <div class="container">    
        <div class="header-top-row">
            <div class="logo-container">
                <?php
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                ?>
            </div>
            <div class="nav-buttons">
            <button class="btn primary-btn">
            <a href="https://www.truefirms.co/job-post">Post Job - It's Free</a>
            </button>
            <button class="btn my-2 my-sm-0 btn secondary-btn" type="submit">
            <a data-toggle="modal" data-target="#exampleModalCenter" id="openModalBtn">Sign up</a>
            </button></div>
        </div>
        </div>
         <div class="nev-header"> 
        <div class="header-bottom-row">
            <nav id="site-navigation" class="main-navigation">
                <?php
	astra_header_before();

	astra_header();

	astra_header_after();

	astra_content_before();
	?>
            </nav>
        </div>
        </div>
    </header>
    <!-- Custom Header Code Ends -->

    <?php astra_header_after(); ?>

    <?php astra_content_before(); ?>
    <div id="content" class="site-content">
        <div class="ast-container">
        <?php astra_content_top(); ?>
