(function($) {
    'use strict';

    var popupVideo = function() {
        if ( $().magnificPopup ) {
            var $el = $('.popup-video');
            if ($el.length) {
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                $el.magnificPopup({
                                    disableOn: 700,
                                    type: 'iframe',
                                    mainClass: 'mfp-fade',
                                    removalDelay: 160,
                                    preloader: false,
                                    fixedContentPos: true
                                });
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            }
        }
    };

    var popupImages = function () {
        if ($().magnificPopup) {
            var $el = $('.master-galleries');
            if ($el.length) {
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                $el.each(function () {
                                    $(this).find('.zoom-popup-mfp').magnificPopup({
                                        disableOn: 700,
                                        type: 'image',
                                        gallery: {
                                            enabled: true
                                        },
                                        mainClass: 'mfp-fade',
                                        removalDelay: 160,
                                        preloader: false,
                                        fixedContentPos: true
                                    });
                                });
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            }
        }
    };

    var inViewport =  function() {
        if ( $('.elementor-invisible').length ) {
            $('.elementor-invisible').each(function (idx, el) {
                var $el = $(el);
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                var data = $el.data('settings');
                                if ( (data !== undefined) && (data !== 'undefined') && (data !== null) ) {
                                    if (!data.hasOwnProperty('_animation') && !data.hasOwnProperty('animation')) {
                                        $el.addClass('no-animate');
                                    } else {
                                        var 
                                        animation = '',
                                        delay = 0;

                                        if ( data.hasOwnProperty('_animation') ) {
                                            animation = data._animation;
                                            delay = data._animation_delay;
                                        } else {
                                            animation = data.animation;
                                            delay = data.animation_delay;
                                        }

                                        if (!delay) { 
                                            delay = 0 
                                        } 
                                        $el.removeAttr('data-settings').addClass('master-animation');
                                        setTimeout(function() {
                                            if ( !$el.hasClass('animated') ) {
                                                $el.removeClass('elementor-invisible').addClass('animated ' + animation);
                                                setTimeout(function() { $el.addClass('animate'); }, 1000)
                                            }
                                        }, delay + 300)
                                                    
                                    }
                                } else {
                                    $el.addClass('no-animate');
                                }
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            })
        }
    };

    /**
     * Elementor JS Hooks
     */
    $(window).on("elementor/frontend/init", function() {
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-button.default", 
            function( $scope ) { 
                if ( $scope.find('.master-button.btn-hover-2').length ) {
                    var $el = $scope.find('.master-button.btn-hover-2');
                    new IntersectionObserver(
                        function e(i, n) {
                            i.forEach(function (e) {
                                if (e.isIntersecting) {
                                    $el.mouseenter(function(e) {
                                       var parentOffset = $el.offset(); 
                                      
                                       var relX = e.pageX - parentOffset.left;
                                       var relY = e.pageY - parentOffset.top;
                                       $el.find('.bg-hover').css({"left": relX, "top": relY });
                                    });

                                    $el.mouseleave(function(e) {

                                         var parentOffset = $el.offset(); 

                                         var relX = e.pageX - parentOffset.left;
                                         var relY = e.pageY - parentOffset.top;
                                         $el.find('.bg-hover').css({"left": relX, "top": relY });
                                    });

                                    n.unobserve(e.target)
                                }
                            });
                        }
                    ).observe($el.get(0));
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-pie-chart.default", 
            function( $scope ) { $scope.find('.master-pie-chart').masterPieChart(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-counter.default", 
            function( $scope ) { 
                var $el = $scope.find('.master-counter').get(0);
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if ( e.isIntersecting ) {
                                let $format = $scope.find('.master-counter').data('format');
                                $scope.find('.number').countTo({ 
                                    speed: $scope.find('.number').data('time'),
                                    formatter: function (value, options) {
                                        switch($format) {
                                        case 'separator':
                                            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        case 'decimal':
                                            return value.toFixed(2);
                                        case 'both':
                                            return value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        default:
                                            return value;
                                        }
                                    }
                                });
                                n.unobserve(e.target)
                            }
                        })
                    }
                ).observe($el);
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-tabs.default", 
            function( $scope ) { 
                var number = $scope.find('.tab-link').length;

                $scope.find('.tab-link-wrap li').css('max-width', (100 / number) + '%').first().addClass('active');
                $scope.find('.tab-content').first().addClass('active');

                $scope.find('.tab-link-wrap li').on('click', function() {
                    var
                    t = $(this),
                    id = t.attr('data-tab');

                    t.addClass('active')
                        .siblings().removeClass('active')
                        .closest('.master-tabs')
                        .find('.tab-content').removeClass('active').hide();
                    $("#" + id).addClass('active').fadeIn("slow");
                });
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-accordion.default", 
            function( $scope ) { 
                var args = {easing:'easeOutExpo', duration:300};
                var t = $scope.find('.master-accordions');

                var items = t.find('.item');

                items.each(function(idx, el) {
                    if ( $(el).is('.active') ) $(el).children('.content').show();

                    var btn = $(el).find('.title');
                    btn.on('click', function() {
                        var currentItem = items.eq(idx);

                        if ( !currentItem.is('.active') ) {
                            currentItem.siblings('.active').removeClass('active')
                                .children('.content').slideToggle(args);
                            currentItem.addClass('active')
                                .children('.content').slideToggle(args);
                        }
                    })
                })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-progress-bar.default", 
            function( $scope ) {  
                var
                t = $scope,
                v = t.find(".progress"),
                c = t.find(".percent"),
                p = v.data('percent');

                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                v.css({ 'width': p }, "slow");
                                c.css({ 'width': p }, "slow");

                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe(t.get(0));
            });

        // Carousel & Cube & Slider
        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-vertical-slider.default", 
            function( $scope ) { $scope.find('.master-vertical-slider').masterVerticalSlider(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-slider.default", 
            function( $scope ) { $scope.find('.master-slider').masterSlider(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-creative-slider.default", 
            function( $scope ) { $scope.find('.master-creative-slider').masterSlider(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 

                var imgs = $scope.find('.thumb').addClass('master-animation');
                var $el = $scope.find('.master-carousel-box');
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                imgs.addClass('reveal revealBottom2');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-related.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 

                var imgs = $scope.find('.thumb').addClass('master-animation');
                var $el = $scope.find('.master-carousel-box');
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                imgs.addClass('reveal revealBottom2');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-testimonial-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-carousel-box.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-svg-drawing.default", 
            function( $scope ) { 
                
                var paths = $scope.find('path');
                var clip = $scope.find('clipPath');
                if (clip.length) {
                    paths = $scope.find('svg > path');
                }

                var duration = $scope.find('.master-svg-drawing').data('duration');
                var delay = $scope.find('.master-svg-drawing').data('delay');
                var totalLength = 0;

                duration ? duration = duration / 1000 : duration = 1,
                delay ? delay = delay / 1000 : delay = 0.3

                var tl = gsap.timeline({ paused: true, delay: delay });
                paths.each(function(idx, el) {
                    var a = el.getTotalLength();
                    totalLength += a;
                    gsap.set(el, {strokeDasharray: a, strokeDashoffset: a, opacity: 0});
                })

                paths.each(function(idx, el) {
                    var a = el.getTotalLength();
                    var time = a / totalLength * duration;
                    tl.set(el, { opacity: 1 });
                    tl.to(el, time, {strokeDashoffset: 0} )
                })
                
                $scope.appear(function() { tl.play(); })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-team-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
                var imgs = $scope.find('.thumb').addClass('master-animation');
                var $el = $scope.find('.master-carousel-box');
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                imgs.addClass('reveal revealBottom2');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-carousel.default", 
            function( $scope ) { $scope.find('.master-carousel-box').masterCarouselBox(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-carousel.default", 
            function( $scope ) { 
                $scope.find('.master-carousel-box').masterCarouselBox(); 
                var imgs = $scope.find('.image-wrap').addClass('master-animation');
                var $el = $scope.find('.master-carousel-box');
                new IntersectionObserver(
                    function e(i, n) {
                        i.forEach(function (e) {
                            if (e.isIntersecting) {
                                imgs.addClass('reveal revealBottom2');
                                n.unobserve(e.target)
                            }
                        });
                    }
                ).observe($el.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-partner-carousel.default", 
            function( $scope ) { $scope.find('.master-carousel-box').masterCarouselBox(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-grid.default", 
            function( $scope ) { $scope.find('.master-portfolio').masterPortfolio(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-project-grid.default", 
            function( $scope ) { $scope.find('.master-portfolio').masterPortfolio(); }
            );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-grid.default",
            function ($scope) { $scope.find('.master-portfolio').masterPortfolio(); }
        );

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-news-block.default", 
            function( $scope ) { 
                var items = $scope.find('.master-news');
                items.each(function(idx, el) {
                    $(el).on('mouseenter', function() {
                        items.removeClass('active');
                        $(el).addClass('active')
                    })
                })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-text-box-grid.default", 
            function( $scope ) { 
                var active = $scope.find('.grid-container').data('active');
                var items = $scope.find('.master-text-box');

                if ( active !== 'none' && !isNaN(active) ) {
                    items.eq(active - 1).addClass('active');
                }

                items.each(function(idx, el) {
                    $(el).on('mouseenter', function() {
                        items.removeClass('active');
                        $(el).addClass('active')
                    })

                    if (active == 'none') {
                        $(el).on('mouseleave', function() { $(el).removeClass('active'); })
                    }
                })
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-gallery-stack.default", 
            function( $scope ) { 
                var calcHeight = function() {
                    $scope.waitForImages(function() {
                        var 
                        arr = [],
                        wrap = $scope.find('.master-gallery-stack'),
                        items = wrap.find('[data-calcheight="yes"]');
                        
                        if (items.length) {
                            items.each(function(idx, item) {
                                var 
                                top = $(item).data('top');
                                if (!top) top = '0px';
                                if (top.indexOf("%") >= 0) {
                                    var height = $(item).height()/(100 - parseFloat(top))*100;
                                    isNaN(height) && (height = 0)
                                    arr.push(height);
                                } else {
                                    arr.push(parseInt(top) + $(item).height());
                                }
                            })
                        }

                        wrap.css("min-height", Math.max.apply(null, arr));
                    }) 
                }
                
                calcHeight();

                new IntersectionObserver(function e(i, n) {
                    i.forEach(function (e) {
                        if (e.isIntersecting) {
                            $(window).on('resize', function() {
                                calcHeight();
                            })

                            // Entrance Animation
                            if ($scope.find('.master-animation').length) {
                                new IntersectionObserver(
                                    function e(i, n) {
                                        i.forEach(function (e) {
                                            if (e.isIntersecting) {
                                                var $el = $scope.find('.master-animation');
                                                $el.each(function(idx, ele) {
                                                    $(ele).addClass($(ele).data('animation'));
                                                });
                                                n.unobserve(e.target)
                                            }
                                        });
                                    }
                                ).observe($scope.get(0));
                            }

                            // Parallax Hover
                            if ($scope.find('.parallax-hover').length && !matchMedia( 'only screen and (max-width: 991px)' ).matches) {
                                var $wrap = $scope;
                                if ($scope.parents('.section-parallax-hover').length)
                                    $wrap = $scope.parents('.section-parallax-hover');

                                $wrap.on('mousemove', function(e) {
                                    var items = $scope.find('.parallax-hover');
                                    items.each(function(idx, el) {
                                        var 
                                        r = $(el).data('range'),
                                        d = $(el).data('direction'),
                                        w = el.getBoundingClientRect(),
                                        ox = e.clientX - w.x - w.width/2,
                                        oy = e.clientY - w.y - w.height/2;
                                        !r ? r = 0 : r = r / 10;
                                        (d == 'opposite') && (r = r * -1)

                                        gsap.to(el, 1, { x: ox * r, y: oy * r, ease: 'Expo.easeOut', overwrite: 'all' })
                                    })
                                })

                                $wrap.on('mouseleave', function(e) {
                                    var items = $scope.find('.parallax-hover');
                                    gsap.to(items, 1, {x: 0, y: 0, ease: 'Expo.easeOut', overwrite: 'all' })
                                })
                            }

                            n.unobserve(e.target)
                        }
                    }) }, {rootMargin: "200px 0px 200px 0px"}
                ).observe($scope.get(0));
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-png-dots.default", 
            function( $scope ) { 
                // disable on mobile for better performance
                if ( !matchMedia( 'only screen and (max-width: 991px)' ).matches ) {
                    $scope.find('.master-png-dots').masterPngDots(); 
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-globe.default", 
            function( $scope ) { 
                // disable on mobile for better performance
                if ( !matchMedia( 'only screen and (max-width: 991px)' ).matches ) {
                    $scope.find('.master-globe').masterGlobe();
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-particles.default", 
            function( $scope ) {
                $scope.css('position', 'static'); 
                // disable on mobile for better performance
                if ( !matchMedia( 'only screen and (max-width: 991px)' ).matches ) {
                    $scope.find('.master-particles').masterParticles();
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/section", 
            function( $scope ) {
                if ( $scope.is('.elementor-top-section') && $scope.not('.elementor-section-stretched') ) {
                    var c = $scope.find('> .elementor-container'),
                    w1 = parseInt( c.css('max-width') ) - 30;
                    
                    var calcWidth = function() {
                        if (w1 && (w1 > 1170) ) {
                            $scope.addClass('custom-section');
                            var w2 = $('.agrios-container').width(),
                            w3 = $(window).width() - 30,
                            left = ((w3 - w2) - (w3 - w1))/-2;

                            if ( w1 > w2 ) {
                                if (w3 > w1) {
                                    $scope.css({'width': w1, 'left': left + 'px'})
                                } else {
                                    left = (w3 - w2)/-2
                                    $scope.css({'width': w3, 'left': left + 'px'})
                                }
                            } else {
                                $scope.css({'width': w3, 'left': '15px'})
                            }
                        }
                    }
                    
                    calcWidth();
                    $(window).on('resize', function() { calcWidth(); })
                }
                
                // Header Sticky
                if ( $scope.is('.elementor-top-section.is-sticky') ) {
                    if ( $scope.parents('.agrios-header').length ) {
                        var header = $scope.parents('.agrios-header');
                        var sticky = header.find('.is-sticky');
                        if ( sticky.length ) {
                            var headerHeight = sticky.height(),
                                offsetTop = sticky.offset().top;

                            if ( $('.header-float').length ) {
                                headerHeight = 0;
                            }

                            if (!sticky.find('.inject-space').length) {
                                var injectSpace = $('<div />', {
                                    height: headerHeight
                                }).insertAfter(sticky).addClass('inject-space');
                            }

                            if ( $('.header-float').length ) {
                                if ($('#wpadminbar').length) {
                                    offsetTop = offsetTop - $('#wpadminbar').height();
                                }
                            } else {
                                sticky.find('>div').addClass('position-absolute');
                            }
                            
                            if ( !$('.header-float').length ) {
                                // recalculate height
                                $(window).ready(function() {
                                    var s = $('.inject-space');
                                    s.height(sticky.find('>div').height());
                                    offsetTop = s.offset().top;
                                })
                                
                                $(window).on('resize', function() {
                                    setTimeout(function() {
                                        var s = $('.inject-space');
                                        s.height(sticky.find('>div').height());
                                        offsetTop = s.offset().top;
                                    },50) 
                                })
                            }

                            $(window).on('load scroll', function() {
                                if ( $(window).scrollTop() > offsetTop ) {
                                    sticky.addClass('fixed-show');
                                } else {
                                    sticky.removeClass('fixed-show');
                                }
                            })  
                        }
                    }
                }
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-image-morphing.default", 
            function( $scope ) {
                $scope.find('.master-image-morphing').masterImageMorphing();
            });

        elementorFrontend.hooks.addAction("frontend/element_ready/mae-megamenu.default", 
            function( $scope ) { 
                $scope.find('.agrios-menu .custom-megamenu').each(function(idx, el) {
                    var navPos = function() {
                        let offset = - $(el).find('>a>span').offset().left - 10;
                        $(el).find('> .sub-menu').css('left', offset + 'px');
                    }
                    
                    navPos();

                    $(window).on('resize', function() {
                        navPos();
                    })
                })
            });

        inViewport();
        popupVideo();
        popupImages();
    });


})(jQuery);


