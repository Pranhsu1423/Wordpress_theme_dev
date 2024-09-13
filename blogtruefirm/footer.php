<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
    <section id="footer-short-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="tf-h2">CONNECT WITH YOUR NEXT BEST CUSTOMER ON TRUEFIRMS</h2>
                </div>
            <div class="col-md-4">
                <div class="ec-btn">
                    <a href="https://www.truefirms.co/free-listing" class="btn primary-btn">Become A Provider</a>
                </div>
            </div>
            </div>
        </div>
    </section>
<?php 
	astra_content_after();
		
	astra_footer_before();
		
	astra_footer();
		
	astra_footer_after(); 
?>
	</div><!-- #page -->
<?php 
	astra_body_bottom();    
	wp_footer(); 
?>
	</body>
</html>