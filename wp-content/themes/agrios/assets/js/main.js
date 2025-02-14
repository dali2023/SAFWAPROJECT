;(function($) {
    'use strict';

    var agriosTheme = {

        // Main init function
        init : function() {
            this.config();
            this.events();
        },

        // Define vars for caching
        config : function() {
            this.config = {
                $window : $( window ),
                $document : $( document ),
            };
        },

        // Events
        events : function() {
            var self = this;
            // Run on document ready
                
            // PreLoader
            self.preLoader();

            // Menu Search Icon
            self.searchIcon();
            
            // Cart Icon
            self.cartIcon();

            // One Page
            self.onePage();

            // Responsive Videos
            self.responsiveVideos();

            // Header Fixed
            self.headerFixed();

            //Scroll to Top
            self.scrollToTop();

            // Quantity Button
            self.quantityButton(); 

            // Hamburger Menu
            self.hamburgerMenu(); 

            // Comment no Reply
            self.noReply();

            // Custom Widget
            self.customWidget();

            // Wishlist
            self.wishlist();
        },

        // PreLoader
        preLoader: function() {
           if ( $().animsition ) {
                if ( $('.animsition.image').length ) {
                    var $url = $('.animsition.image').data('preloader');
                    $('.animsition').animsition({
                        inClass: 'fade-in',
                        outClass: 'fade-out',
                        inDuration: 300,
                        outDuration: 300,
                        loading: true,
                        loadingParentElement: 'body',
                        loadingClass: 'animsition-image',
                        loadingInner: '<img src="' + $url + '" alt="Image" />',
                        timeout: true,
                        timeoutCountdown: 5000,
                        onLoadEvent: true,
                        browser: [
                            '-webkit-animation-duration',
                            '-moz-animation-duration',
                            'animation-duration'
                            ],
                        overlay: false,
                        overlayClass: 'animsition-overlay-slide',
                        overlayParentElement: 'body',
                        transition: function(url){ window.location.href = url; }
                    });
                } else {
                    $('.animsition').animsition({
                        inClass: 'fade-in',
                        outClass: 'fade-out',
                        inDuration: 100,
                        outDuration: 100,
                        loading: true,
                        loadingParentElement: 'body',
                        loadingClass: 'animsition-loading',
                        timeout: true,
                        timeoutCountdown: 5000,
                        onLoadEvent: true,
                        browser: [
                            '-webkit-animation-duration',
                            '-moz-animation-duration',
                            'animation-duration'
                            ],
                        overlay: false,
                        overlayClass: 'animsition-overlay-slide',
                        overlayParentElement: 'body',
                        transition: function(url){ window.location.href = url; }
                    });
                }
            } 
        },

        // Menu Search Icon
        searchIcon: function() {
            var search_wrap = $('.search-style-fullscreen');
            var search_trigger = $('.search-trigger');
            var search_field = search_wrap.find('.search-field');

            search_trigger.on('click', function(e) {
                if ( ! search_wrap.hasClass('search-opened') ) {
                    search_wrap.addClass('search-opened');
                    search_field.get(0).focus();

                } else if (search_field.val() === '') {
                    if ( search_wrap.hasClass('search-opened') )
                        search_wrap.removeClass('search-opened');
                    else search_field.get(0).focus();

                } else {
                     search_wrap.find('form').get(0).submit();
                }

                $('html').addClass( 'disable-scroll' );
                e.preventDefault();
                return false;
            });

            search_wrap.find('.search-close').on('click', function(e) {
                search_wrap.removeClass('search-opened');
                $('html').removeClass( 'disable-scroll' );
                e.preventDefault();
                return false;
            });
        },

        // Menu Cart Icon
        cartIcon: function() {
            $( document ).on( 'woocommerce-cart-changed', function( e, data ) {
                if ( parseInt(data.items_count,10) >= 0 ) {
                    $('.shopping-cart-items-count')
                        .text( data.items_count )
                }
            } );
        },
        

        // One Page
        onePage: function() {
            if ( $('#menu-one-page').length ) {
                $('#menu-one-page li').filter(':first').addClass('current-menu-item');
    
                $('#menu-one-page li a').on('click',function() {
                    var anchor = $(this).attr('href').split('#')[1];
    
                    if ( anchor ) {
                        if ( $('#'+anchor).length > 0 ) {
                            var headerHeight = 0;
    
                            var target = $('#' + anchor).offset().top - headerHeight;
    
                            $('html,body').animate({scrollTop: target}, 1000, 'easeInOutExpo');
                       }
                    }
                    return false;
                });
    
                $(window).on("scroll", function() {
                    var scrollPos = $(window).scrollTop();
    
                    if ( $('body').hasClass('header-fixed') ) {
                        var headerHeight = $('#site-header').height();
                        scrollPos = scrollPos + headerHeight;
                    }
    
                    $('#menu-one-page .menu-item a').each(function () {
                        var link = $(this);
                        var block = $( link.attr("href") );
    
                        if ( block.offset().top <= scrollPos 
                            && block.offset().top + block.height() > scrollPos ) {
                            $('#menu-one-page li').removeClass("current-menu-item");
                            link.parent().addClass("current-menu-item");
                        } else {
                            link.parent().removeClass("current-menu-item");
                        }
                    });
                });
            }
        },

        // Responsive Videos
        responsiveVideos: function() {
            if ( $().fitVids ) {
                $('.agrios-container').fitVids();
            }
        },

        // Header Fixed
        headerFixed: function() {
            var nav = $('.agrios-header-fixed');
            var sp = 0;
            
            var showHeader = function() {
                var np = $('body')[0].getBoundingClientRect().top;
                var st = $(window).scrollTop();

                if (np > sp) {
                    if (st > 500) {
                        nav.addClass('fixed-show');
                    }
                    if (st < 300) {
                        nav.removeClass('fixed-show');
                    }
                } else {
                    nav.removeClass('fixed-show');
                }

                sp = np
            }

            $(window).on('scroll', showHeader);  
        },

        // Scroll to Top
        scrollToTop: function() {
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 800 ) {
                    $('#scroll-top').addClass('show');
                } else {
                    $('#scroll-top').removeClass('show');
                }
            });

            $('#scroll-top').on('click', function() {
                var rocket = $(this);
                setTimeout(function(){ $('html, body').animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo'); }, 250);
            });
        },

        // Featured Media
        featuredMedia: function() {
            $('.blog-gallery').each(function () {
                const gallery = new Swiper( $(this), {
                    direction: 'horizontal',
                    pagination: {
                        el: $(this).find('.swiper-pagination'),
                        clickable: true
                    },
                    navigation: {
                        nextEl: $(this).find('.swiper-button-next'),
                        prevEl: $(this).find('.swiper-button-prev'),
                    },
                    autoplay: {
                       delay: 5000,
                     },
                });
            })
        },

        // Quantity Button
        quantityButton: function() {
            if ( ! String.prototype.getDecimals ) {
                String.prototype.getDecimals = function() {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if ( ! match ) {
                        return 0;
                    }
                    return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
                }
            }
            // Quantity "plus" and "minus" buttons
            $( document.body ).on( 'click', '.plus, .minus', function() {
                var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                    currentVal  = parseFloat( $qty.val() ),
                    max         = parseFloat( $qty.attr( 'max' ) ),
                    min         = parseFloat( $qty.attr( 'min' ) ),
                    step        = $qty.attr( 'step' );

                // Format values
                if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                if ( max === '' || max === 'NaN' ) max = '';
                if ( min === '' || min === 'NaN' ) min = 0;
                if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

                // Change the value
                if ( $( this ).is( '.plus' ) ) {
                    if ( max && ( currentVal >= max ) ) {
                        $qty.val( max );
                    } else {
                        $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                    }
                } else {
                    if ( min && ( currentVal <= min ) ) {
                        $qty.val( min );
                    } else if ( currentVal > 0 ) {
                        $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                    }
                }

                // Trigger change event
                $qty.trigger( 'change' );
            });
        },

        // Hamburger Menu
        hamburgerMenu: function() {
            $('.agrios-menu-panel').each(function () {
                var 
                t = $(this),
                btn = t.siblings('.agrios-hamburger-icon'),
                c = t.find('.close-menu'),
                o = t.find('.menu-panel-overlay'),
                w = t.find('.menu-panel-wrap');

                t.find('.menu-item-has-children').children('ul').before('<span class="arrow"></span>');

                t.find('.menu-item-has-children > .arrow').on('click', function() {
                    $(this).parent().toggleClass("active").siblings().removeClass("active");
                    $(this).next("ul").slideToggle();
                    $(this).parent().siblings().find("ul").slideUp();
                })

                o.on('click', function() {
                    btn.removeClass('hide');
                    o.removeClass('show');
                    w.animate({ right: "-100%" }, 300, 'easeInOutExpo')
                    $('html').removeClass( 'disable-scroll' );
                } );

                c.on('click', function() {
                    btn.removeClass('hide');
                    o.removeClass('show');
                    w.animate({ right: "-100%" }, 300, 'easeInOutExpo')
                    $('html').removeClass( 'disable-scroll' );
                } );

                btn.on('click', function() {
                    btn.addClass('hide');
                    o.addClass('show');
                    $('html').addClass( 'disable-scroll' );
                    w.animate({ right: "0"}, 300, 'easeInOutExpo');
                })   
            })      
        },

        // Comment no Reply
        noReply: function() {
            $('#comments .comment-list .comment').each(function (idx, el) {
                var btn = $(el).find('.comment-reply-link');
                if ( btn.length === 0 ) {
                    $(el).addClass('comment-no-reply');
                }
            })
        },

        // Custom Widget
        customWidget: function () {
            if ( $('.custom-widget').length ) {
                $('.custom-widget').each(function(idx, el) {
                    $(el).parent('.widget').addClass('widget-custom');
                })
            }
        },

        // Wishlist
        wishlist: function () {
            if ( $('.shopengine_add_to_list_action.shopengine-wishlist').length ) {
                $('.shopengine_add_to_list_action.shopengine-wishlist').each(function(idx, el) {
                    if ( $(el).is('.active') ) {
                        $(el).find('.text').text('Remove wishlist');
                    }

                    $(el).on('click', function() {
                        if ( $(el).is('.active') ) {
                            $(el).find('.text').text('Add to wishlist');
                        } else {
                            $(el).find('.text').text('Remove wishlist');
                        }
                    })
                })
            }
        },
        
    }; // end agriosTheme

    // Start things up
    agriosTheme.init();

})(jQuery);