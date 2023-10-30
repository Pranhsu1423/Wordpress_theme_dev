// jQuery
jQuery(document).ready(function() {
    jQuery('.testimonial-slider').owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        margin: 30,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            991: {
                items: 1
            }
        }
    });
});
