;(function($) {
    'use strict';

    // Featured Media
    function featuredMedia() {
        if ( $().slick ) {
            $('.blog-gallery').slick({
                dots: true,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
            })
        }
    };

    // Related Post
    function relatedPost() {
        if ( $().slick ) {
            $('.related-post').slick({
                dots: false,
                arrows: false,
                infinite: false,
                speed: 300,
                slidesToShow: 2,
                slidesToScroll: 2,
                responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
                ]
            });
        }
    };

    // Related Projects
    function relatedProject() {
        if ( $().slick ) {
            var t = $('.related-projects .projects'),
            col = t.data('column');

            t.slick({
                dots: false,
                arrows: false,
                infinite: false,
                speed: 300,
                slidesToShow: col,
                slidesToScroll: 1,
                responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 768,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
                ]
            });
        }
    };

    $(window).ready(function() {
        featuredMedia();
        relatedProject();
    })
    

})(jQuery);