// Carousel Box
(function($, window, document, undefined) {
    "use strict";

    var masterCarouselBox = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterCarouselBox.prototype = {
        defaults: {
            contain: !0,
            imagesLoaded: !0,
            arrowShape: "M34.2,49.6C34.2,49.6,34.2,49.6,34.2,49.6l6.8-6.8c0.5-0.5,1.3-0.5,1.8,0c0.5,0.5,0.5,1.3,0,1.8l-4.6,4.5h27.6 c0.7,0,1.3,0.6,1.3,1.3s-0.6,1.3-1.3,1.3H38.3l4.6,4.5c0.5,0.5,0.5,1.3,0,1.8c-0.5,0.5-1.3,0.5-1.8,0l-6.8-6.8c0,0,0,0,0,0 C33.7,50.9,33.7,50.1,34.2,49.6z",
            // M8,12.1l8.7-8.7c0.3-0.3,0.3-0.8,0-1.1c-0.3-0.3-0.8-0.3-1.1,0l-9.2,9.2c-0.3,0.3-0.3,0.8,0,1.1l9.2,9.2c0.3,0.3,0.8,0.3,1.1,0s0.3-0.8,0-1.1L8,12.1z

            percentPosition: !1,
            adaptiveHeight: !1,
            cellAlign: "center",
            groupCells: !0,
            dragThreshold: 20,
            wrapAround: !1,
            autoPlay: !1,
            navArrow: 1,
            filters: !1,
            equalHeightCells: !1,
            randomVerOffset: !1,
            draggable: !0,

            column: 3,
            gap: "30px",
            stretch: '',
            prevNextButtons: !1,
            arrowStyle: "arrow-style-1",
            arrowPosition: "middle",
            arrowMiddleOffset: "0px",
            arrowTopOffset: "40px",
            pageDots: !1,
            dotStyle: "dot-style-1",
            dotOffset: "40px",
            filter: !1,
            stretch: '',
            initialIndex: 0,
            //cellSelector: ".item-carousel"
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            this.responsive();
            this.event(); 
            return this;
        },
        build: function() {
            var
            t = this,
            c = t.args.stretch,
            d = t.args.prevNextButtons,
            e = t.args.arrowStyle,
            f = t.args.arrowPosition,
            j = t.args.pageDots,
            m = t.args.filter,
            o = t.args.autoPlay,
            p = t.args.groupCells,
            q = t.args.cellAlign,
            id = "filter-" + (new Date).getTime();

            if ( $('html').is('[dir="rtl"]') ) {
                switch (t.args.cellAlign) {
                    case 'left': t.args.cellAlign = 'right';
                        break;
                    case 'right': t.args.cellAlign = 'left';
                        break;
                    default:
                        break;
                }
            };

            t.$elm.alterClass("arrow-position-*", "arrow-position-" + f),
            j ? t.$elm.alterClass("bullets-*", "bullets-yes") : t.$elm.alterClass("bullets-*", "bullets-no"),
                          
            (c == 'stretch-both') && ( t.args.initialIndex = 1 ),
            o && (t.args.autoPlay = 5000),
            m && ( t.$elm.alterClass("filter-*", id), t.filter(id) ),

            t.$elm.waitForImages(function() { 
                t.$elm.flickity(t.args);
                switch (c) {
                    case 'stretch-right':
                        if ( $('html').is('[dir="rtl"]') ) {
                            var
                            u = t.$elm,
                            v = u.width(),
                            w = t.$elm.find(".flickity-viewport"),
                            x = w.offset().left,
                            y = $("<div />").addClass("flickity-wrap");

                            w.wrap(y).css("overflow", "visible")
                            .parent().css({"padding-left": x, "margin-left": -x, "overflow": "hidden"})
                        } else {
                            var
                            u = t.$elm,
                            v = u.width(),
                            w = t.$elm.find(".flickity-viewport"),
                            x = window.innerWidth - (v + w.offset().left),
                            y = $("<div />").addClass("flickity-wrap");

                            w.wrap(y).css("overflow", "visible")
                            .parent().css({"padding-right": x, "margin-right": -x, "overflow": "hidden"});
                        }
                        break;
                    case 'stretch-both':
                        var
                        u = t.$elm,
                        v = u.width(),
                        w = t.$elm.find(".flickity-viewport"),
                        x1 = window.innerWidth - (v + w.offset().left),
                        x2 = w.offset().left,
                        y = $("<div />").addClass("flickity-wrap");

                        w.wrap(y).css("overflow", "visible")
                        .parent().css({"padding-right": x1, "margin-right": -x1, "overflow": "hidden",
                            "padding-left": x2, "margin-left": -x2})
                        break;
                    default:
                        break;
                }
            }); 

            // Custom Nav
            (t.$elm.siblings('.carousel-nav').length > 0) && t.customNav();
        }, 
        filter: function(id) {
            var
            t = this,
            css = "",
            cls = "#" + id,
            arr = [],
            a = t.args.filterAll,
            b = t.args.filterCat,
            c = b.split(","),
            z = $("<div />").attr("id", id).addClass("carousel-filter");
            
            t.$elm.before(z)
            a && $('<div class="filter-item" data-filter="*">All</div>').appendTo(z)
            for (var i1 = 0; i1 < c.length; i1++) {
                $('<div class="filter-item" data-filter="' + c[i1].replace(" ", "-").toLowerCase() + '">' + c[i1] + '</div>').appendTo(z)
            }
        },
        event: function() {
            var 
            t = this,
            a = t.args.activeIndex;

            // Filter
            $(".carousel-filter .filter-item").on("click", function() {
                var 
                a = $(this).parent().attr("id"),
                b = $(this).data("filter");
                
                if (b !== "*") {
                    var
                    c = $("." + a + " .item-carousel").not("." + b),
                    d = $("." + a + " .item-carousel." + b);
                    c.hide()
                    d.show()
                } else {
                    $("." + a + " .item-carousel").show()
                }

                // Remove other element before destroy
                $("." + a).find(".ctr-edit").remove(),
                t.args.fullRight && t.$elm.find(".flickity-viewport").unwrap()

                t.$elm.flickity("destroy");
                t.$elm.waitForImages(function() {
                    t.$elm.flickity(t.args);
                })         
            })

            var selected = t.$elm.find('.item-carousel.is-selected'),
            items = t.$elm.find('.item-carousel');

            if (a) {
                if (selected.length >= a) selected.eq(a - 1).addClass('active');

                t.$elm.on( 'select.flickity', function( event, index ) {   
                    selected = t.$elm.find('.item-carousel.is-selected')
                    var items2 = t.$elm.find('.item-carousel')
                    items2.removeClass('active');

                    if (selected.length >= a) selected.eq(a - 1).addClass('active');
                });
            } else {
                t.$elm.on('mouseleave', function () {
                    items.removeClass('active');
                })
            }

            items.each(function (idx, el) {
                $(el).on('mouseenter', function() {
                    items.removeClass('active');
                    $(el).addClass('active');
                })
            })
        },
        responsive: function() {
            var
            t = this,
            items = t.$elm.find('.item-carousel'),
            a = t.args.column,
            b = t.args.gap,
            c = t.args.columnTablet,
            d = t.args.gapTablet,
            e = t.args.columnMobile,
            f = t.args.gapMobile,
            g = t.args.columnWidescreen,
            h = t.args.gapWidescreen,
            i = t.args.columnTabletExtra,
            j = t.args.gapTabletExtra,
            k = t.args.columnMobileExtra,
            l = t.args.gapMobileExtra,
            m = t.args.columnLaptop,
            n = t.args.gapLaptop,
            w = '',
            ga = 0;
            var bk = elementorFrontend.config.responsive.activeBreakpoints;

            var calcWidth = function() {
                if (elementorFrontend) {
                    var mode = '';
                    for (let [key, value] of Object.entries(bk)) {
                        let text = 'only screen and (' + value.direction + '-width: ' + value.value + 'px)';
                        if ( matchMedia(text).matches && (mode === '') ) {
                            mode = key;
                        }
                    }
                    if (mode === '') mode = 'desktop';

                    !a && (a = 3), !g && (g = a), !m && (m = g), !i && (i = m), !c && (c = i),!k && (k = c), !e && (e = k), 
                    !b && (b = 30), !h && (h = b), !n && (n = h), !j && (j = n), !d && (d = j), !l && (l = d), !f && (f = l)
                    
                    switch (mode) {
                        case 'widescreen':
                            w = 'calc( (100% - ' + ((g - 1) * h) + 'px) / ' + g + ')',
                            ga = h
                            break;
                        case 'laptop':
                            w = 'calc( (100% - ' + ((m - 1) * n) + 'px) / ' + m + ')',
                            ga = n
                            break;
                        case 'tablet_extra':
                            w = 'calc( (100% - ' + ((i - 1) * j) + 'px) / ' + i + ')',
                            ga = j
                            break;
                        case 'mobile_extra':
                            w = 'calc( (100% - ' + ((k - 1) * l) + 'px) / ' + k + ')',
                            ga = l
                            break;
                        case 'tablet':
                            w = 'calc( (100% - ' + ((c - 1) * d) + 'px) / ' + c + ')',
                            ga = d
                            break;
                        case 'mobile':
                            w = 'calc( (100% - ' + ((e - 1) * f) + 'px) / ' + e + ')',
                            ga = f
                            break;
                        default:
                            w = 'calc( (100% - ' + ((a - 1) * b) + 'px) / ' + a + ')',
                            ga = b
                    }
                    items.css({width: w, 'margin-right': ga + 'px'})
                } else {
                    var mode = 'desktop';

                    if ( matchMedia( 'only screen and (max-width: 1024px)' ).matches )
                        mode = 'tablet';

                    if ( matchMedia( 'only screen and (max-width: 767px)' ).matches )
                        mode = 'mobile';

                    !a && (a = 3),
                    !c && (c = a),
                    !e && (e = c),
                    !b && (b = 30),
                    !d && (d = b),
                    !f && (f = d)

                    switch (mode) {
                        case 'tablet':
                            w = 'calc( (100% - ' + ((c - 1) * d) + 'px) / ' + c + ')',
                            ga = d
                            break;
                        case 'mobile':
                            w = 'calc( (100% - ' + ((e - 1) * f) + 'px) / ' + e + ')',
                            ga = f
                            break;
                        default:
                            w = 'calc( (100% - ' + ((a - 1) * b) + 'px) / ' + a + ')',
                            ga = b
                    }

                    items.css({width: w, 'margin-right': ga + 'px'})
                }
                
            }
            calcWidth();
            
            $(window).on('resize', calcWidth );
        },
        customNav: function() {
        	var t = this,
        		a = t.$elm.siblings('.carousel-nav'),
        		b = a.find('.nav-item'),
        		c = t.$elm.data('flickity');

        	a.on('click', '.nav-item', function(event) {
        		var index = $( event.currentTarget ).index();
  				t.$elm.flickity( 'select', index );
        	})

        	t.$elm.on( 'change.flickity', function() {
        		var n0, n1, n2, n3;
        		var total = b.length - 1;
        		n0 = c.selectedIndex,
        		(n0 < total) ? n1 = n0 + 1 : n1 = 0,
        		(n1 < total) ? n2 = n1 + 1 : n2 = 0,
        		(n2 < total) ? n3 = n2 + 1 : n3 = 0
        		gsap.to(b, 0.3, {opacity: 0, scale: 0.8, onComplete: function() {
        			b.removeClass('nav0 nav1 nav2 nav3');
        			b.eq(n0).addClass('nav0'),
        			b.eq(n1).addClass('nav1'),
        			b.eq(n2).addClass('nav2'),
        			b.eq(n3).addClass('nav3'),
        			gsap.to(b, 0.3, {opacity: 1, scale: 1})
        		}})
			});
        } 
    };

    masterCarouselBox.defaults = masterCarouselBox.prototype.defaults;

    $.fn.masterCarouselBox = function(opts) {
        return this.each(function() {
            new masterCarouselBox(this, opts).init();
        });
    };
}(jQuery, window, document));

// Project Grid
(function( $, window, document, undefined ) {
    "use strict";

    var masterPortfolio = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config" );
    };

    masterPortfolio.prototype = {
        defaults: {
            filters: ".projects-filter",
            layoutMode: "grid",
            defaultFilter: "*",
            gapHorizontal: 30,
            gapVertical: 30,
            showNavigation: !0,
            showPagination: !0,
            gridAdjustment: "responsive",
            rewindNav: !1,
            auto: !1,
            mediaQueries: [{
                width: 1200,
                cols: 4,
            }, {
                width: 992,
                cols: 3,
            }, {
                width: 768,
                cols: 2,
            }],
            columns: 3,
            filterStyle: "filter-style-1",
            filterColor: "light",
            displayType: 'bottomToTop',
            displayTypeSpeed: 100
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            return this;
        },
        build: function() {
            var
            t = this,
            css = "",
            cls = "",
            arr = [],
            a = t.config.columns,
            b = t.args.mediaQueries,
            c = t.args.filterStyle,
            d = t.args.filterColor,
            e = t.args.filterMargin,
            z = t.$elm.attr("class").split(" ");

            t.$elm.find(".projects-filter").alterClass("filter-style-*", c),
            t.$elm.find(".projects-filter").alterClass("filter-color-*", "filter-color" + d),

            (isNaN(t.args.columnsTablet) || (t.args.columnsTablet == 0) ) && (t.args.columnsTablet = t.args.columns),
            (isNaN(t.args.columnsMobile) || (t.args.columnsMobile == 0) ) && (t.args.columnsMobile = t.args.columnsTablet),

            t.args.mediaQueries = [
                {"width": 900, "cols": t.args.columns},
                {"width": 690, "cols": t.args.columnsTablet},
                {"width": 400, "cols": t.args.columnsMobile},
                {"width": 400, "cols": 1}]

            if ( t.args.layoutMode == 'mosaic' && matchMedia( 'only screen and (max-width: 1300px)' ).matches ) {
                t.args.gridAdjustment = 'responsive';
                t.args.sortToPreventGaps = true;
            }

            t.$elm.waitForImages( function() {
                t.$elm.find('.galleries').cubeportfolio( t.args ); 
            } );
        },
        event: function () {
            var t = this,
            items = t.$elm.find('.cbp-item');

            items.each(function (idx, el) {
                $(el).on('mouseenter', function() {
                    items.removeClass('active');
                    $(el).addClass('active');
                })
            })

            t.$elm.on('mouseleave', function () {
                items.removeClass('active');
            })
        }
    };

    masterPortfolio.defaults = masterPortfolio.prototype.defaults;

    $.fn.masterPortfolio = function(opts) {
        return this.each(function() {
            new masterPortfolio(this, opts).init();
        });
    };
}(jQuery, window, document));

// Slider
(function($, window, document, undefined) {
    "use strict";

    var masterSlider = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterSlider.prototype = {
        defaults: {
            autoplay: 'no',
            autoplaySpeed: 6,
            kenburns: 'no',
            kenburnsZoom: 2,
            kenburnsDuration: 10
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.eIO();
            return this;
        },
        eIO: function e() {
            var t = this;
            new IntersectionObserver(
                function e(i, n) {
                    i.forEach(function (e) {
                        e.isIntersecting && (t.build(), t.event(), n.unobserve(e.target));
                    });
                }
            ).observe(t.elm);
        },
        build: function() {
            var 
            t = this,
            a = t.args.subEffIn.eff,
            b = t.args.subEffOut.eff,
            c = t.args.titleEffIn.eff,
            d = t.args.titleEffOut.eff,
            e = t.args.descEffIn.eff,
            f = t.args.descEffOut.eff,
            g = t.args.url1EffIn.eff,
            h = t.args.url1EffOut.eff,
            i = t.args.url1EffIn.eff,
            j = t.args.url1EffOut.eff,
            k = t.args.wrapEffIn.eff,
            l = t.args.wrapEffOut.eff,
            m = t.args.bgEffIn.eff,
            n = t.args.bgEffOut.eff,
            slides = t.$elm.find('.slide');

            t.$elm.find('.content-wrap .slide').each(function() {
                $('<span class="dot"></span>').appendTo(t.$elm.find('.nav-dots'))
            })
            
            if (!t.$elm.find('.content-wrap .slide.active').length) {
                t.$elm.find('.bg-wrap .bg').first().addClass('active'),
                t.$elm.find('.content-wrap .slide').first().addClass('active').css('z-index', 2),
                t.$elm.find('.nav-dots .dot').first().addClass('active') 
            } else {
                var current = t.$elm.find('.content-wrap .slide.active').first().index();
                t.$elm.find('.content-wrap .slide').eq(current).css('z-index', 2),
                t.$elm.find('.nav-dots .dot').eq(current).addClass('active')
            }

            if (k == 'zoomOut') t.$elm.find('.slide').addClass('cb-zoom');
            switch (m) {
                case 'zoomOut':
                    t.$elm.find('.bg-wrap').addClass('cb-zoom');
                    break;
                case 'vslide':
                    t.$elm.find('.bg-wrap').addClass('cb-vslide2');
                    break;
                default:
                    break;
            }

            // Params for animation
            t.params = {
                images: {
                    none: { 
                        out: {}, 
                        set: { 
                            next: { opacity: 1, x: 0, y: 0, scale: 1 },
                            prev: { opacity: 1, x: 0, y: 0, scale: 1}
                        }, 
                        in: {} 
                    },
                    fade: {
                        out: {
                            next: { opacity: 0, duration: 1 },
                            prev: { opacity: 0, duration: 1 },
                        },
                        set: {
                            next: { opacity: 0 },
                            prev: { opacity: 0 },
                        },
                        in: { opacity: 1, duration: 1 }
                    },
                    fadeScale: {
                        out: {
                            next: { opacity: 0, duration: 0.3, delay: 0.5 },
                            prev: { opacity: 0, duration: 0.3, delay: 0.5 },
                        },
                        set: {
                            next: { scale: 0.9, opacity: 0 },
                            prev: { scale: 0.9, opacity: 0 },
                        },
                        in: { opacity: 1, scale: 1, duration: 0.6 }
                    },
                    reveal: {
                        out: {
                            next: {  },
                            prev: {  },
                        },
                        set: {
                            next: { clipPath: 'polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)', scale: 1.3 },
                            prev: { clipPath: 'polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)', scale: 1.3 },
                        },
                        in: { clipPath: 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)', scale: 1, ease: Power2.out, duration: 1.2 }
                    },
                    reveal2: {
                        out: {
                            next: {  },
                            prev: {  },
                        },
                        set: {
                            prev: { clipPath: 'polygon(0% 0%, 0% 0%, 0% 100%, 0% 100%)', scale: 1.3 },
                            next: { clipPath: 'polygon(100% 0%, 100% 0%, 100% 100%, 100% 100%)', scale: 1.3 },
                        },
                        in: { clipPath: 'polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%)', scale: 1, ease: Power2.out, duration: 1.2 }
                    },
                    slide: {
                        out: {
                            next: { x: '-100%', duration: 0.5, ease: 'power2.inOut' },
                            prev: { x: '100%', duration: 0.5, ease: 'power2.inOut' },
                        },
                        set: {
                            next: { x: '100%' },
                            prev: { x: '-100%' },
                        },
                        in: { x: 0, duration: 0.5, ease: 'power2.inOut' }
                    },
                    vslide: {
                        out: {
                            next: { y: '-100%', duration: 1.2 },
                            prev: { y: '100%', duration: 1.2 },
                        },
                        set: {
                            next: { y: '100%' },
                            prev: { y: '-100%' },
                        },
                        in: { y: 0, duration: 1.2 }
                    },
                    fadeRight: {
                        out: {
                            next: { x: 50, opacity: 0, duration: 0.3 },
                            prev: { x: -50, opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { x: -50, opacity: 0, duration: 0.3 },
                            prev: { x: 50, opacity: 0, duration: 0.3 },
                        },
                        in: { x: 0, opacity: 1, duration: 0.3, delay: 0.5 }
                    },
                    fadeLeft: {
                        out: {
                            next: { x: -50, opacity: 0, duration: 0.3 },
                            prev: { x: 50, opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { x: 50, opacity: 0, duration: 0.3 },
                            prev: { x: -50, opacity: 0, duration: 0.3 },
                        },
                        in: { x: 0, opacity: 1, duration: 0.3, delay: 0.5 }
                    },
                    slideScale: {
                        out: {
                            next: { x: '-100%', duration: 0.3, delay: 0.3 },
                            prev: { x: '100%', duration: 0.3, delay: 0.3 },
                        },
                        set: {
                            next: { x: '100%', scale: 2 },
                            prev: { x: '-100%', scale: 2 },
                        },
                        in: { x: 0, scale: 1, duration: 0.6 }
                    },
                    zoomOut: {
                        out: {
                            next: { y: -50, scale: 1.2, opacity: 0, duration: 1.5 },
                            prev: { y: -50, scale: 1.2, opacity: 0, duration: 1.5 },
                        },
                        set: {
                            next: { y: 50, scale: 0.95, opacity: 0, zIndex: 2 },
                            prev: { y: 50, scale: 0.95, opacity: 0, zIndex: 2 },
                        },
                        in: { y: 0, scale: 1, opacity: 1, duration: 1 }
                    },
                },
                text: {
                    none: { 
                        out: {}, 
                        set: { 
                            next: { opacity: 1, x: 0, y: 0, scale: 1 },
                            prev: { opacity: 1, x: 0, y: 0, scale: 1}
                        }, 
                        in: {} 
                    },
                    slide: {
                        out: {
                            next: { x: '-80vw', opacity: 0, duration: 0.3 },
                            prev: { x: '80vw', opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { x: '80vw' },
                            prev: { x: '-80vw' },
                        },
                        in: { x: 0, opacity: 1, duration: 0.3, delay: 0.3 }
                    },
                    fade: {
                        out: {
                            next: { opacity: 0, duration: 0.3 },
                            prev: { opacity: 0, duration: 0.3 },
                        },
                        set: {},
                        in: { x: 0, opacity: 1, duration: 0.3, delay: 0.3 }
                    },
                    fadeUp: {
                        out: {
                            next: { y: -20, opacity: 0, duration: 0.3 },
                            prev: { y: 20, opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { y: 20, opacity: 0, duration: 0.3 },
                            prev: { y: -20, opacity: 0, duration: 0.3 },
                        },
                        in: { y: 0, opacity: 1, duration: 0.3, delay: 0.5 }
                    },
                    fadeDown: {
                        out: {
                            next: { y: 20, opacity: 0, duration: 0.3 },
                            prev: { y: -20, opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { y: -20, opacity: 0, duration: 0.3 },
                            prev: { y: 20, opacity: 0, duration: 0.3 },
                        },
                        in: { y: 0, opacity: 1, duration: 0.3, delay: 0.5 }
                    },
                    textSlide: {
                        out: {
                            next: { y: '-120%', duration: 0.3 },
                            prev: { y: '120%', duration: 0.3 },
                        },
                        set: {
                            next: { y: '120%' },
                            prev: { y: '-120%' }
                        },
                        in: { y: 0, duration: 0.3, delay: 0.5 }
                    },
                    fadeRight: {
                        out: {
                            next: { opacity: 0, x: 100, duration: 0.3 },
                            prev: { opacity: 0, x: 100, duration: 0.3 },
                        },
                        set: {
                            next: { opacity: 0, x: -100 },
                            prev: { opacity: 0, x: -100 }
                        },
                        in: { opacity: 1, x: 0, duration: 0.3 }
                    },
                    zoomOut: {
                        out: {
                            next: { y: -50, scale: 1.2, opacity: 0, duration: 1.5 },
                            prev: { y: -50, scale: 1.2, opacity: 0, duration: 1.5 },
                        },
                        set: {
                            next: { y: 50, scale: 0.9, opacity: 0 },
                            prev: { y: 50, scale: 0.9, opacity: 0 },
                        },
                        in: { y: 0, scale: 1, opacity: 1, duration: 1.5, delay: 1.5 }
                    },
                },
                url: {
                    none: { 
                        out: {}, 
                        set: { 
                            next: { opacity: 1, x: 0, y: 0, scale: 1 },
                            prev: { opacity: 1, x: 0, y: 0, scale: 1}
                        }, 
                        in: {} 
                    },
                    slide: {
                        out: {
                            next: { x: '-80vw', opacity: 0, duration: 0.3 },
                            prev: { x: '80vw', opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { x: '80vw' },
                            prev: { x: '-80vw' },
                        },
                        in: { x: 0, opacity: 1, duration: 0.3, delay: 0.3 }
                    },
                    fade: {
                        out: {
                            next: { opacity: 0, duration: 0.3 },
                            prev: { opacity: 0, duration: 0.3 },
                        },
                        set: {},
                        in: { x: 0, opacity: 1, duration: 0.3, delay: 0.3 }
                    },
                    fadeUp: {
                        out: {
                            next: { y: -20, opacity: 0, duration: 0.3 },
                            prev: { y: 20, opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { y: 20, opacity: 0, duration: 0.3 },
                            prev: { y: -20, opacity: 0, duration: 0.3 },
                        },
                        in: { y: 0, opacity: 1, duration: 0.3, delay: 0.5 }
                    },
                    fadeDown: {
                        out: {
                            next: { y: 20, opacity: 0, duration: 0.3 },
                            prev: { y: -20, opacity: 0, duration: 0.3 },
                        },
                        set: {
                            next: { y: -20, opacity: 0, duration: 0.3 },
                            prev: { y: 20, opacity: 0, duration: 0.3 },
                        },
                        in: { y: 0, opacity: 1, duration: 0.3, delay: 0.5 }
                    },
                    slideUp: {
                        out: {
                            next: { y: '-120%', duration: 0.3 },
                            prev: { y: '120%', duration: 0.3 },
                        },
                        set: {
                            next: { y: '120%' },
                            prev: { y: '-120%' }
                        },
                        in: { y: 0, duration: 0.3, delay: 0.5 }
                    },
                    zoomOut: {
                        out: {
                            next: { y: -50, scale: 1.2, opacity: 0, duration: 1.5 },
                            prev: { y: -50, scale: 1.2, opacity: 0, duration: 1.5 },
                        },
                        set: {
                            next: { y: 50, scale: 0.9, opacity: 0 },
                            prev: { y: 50, scale: 0.9, opacity: 0 },
                        },
                        in: { y: 0, scale: 1, opacity: 1, duration: 1.5, delay: 1.5 }
                    },
                }
            }

            // Split text
            if ( ('textSlide' == a) || ('textSlide' == b) ) {
                Splitting({
                    target: slides.find('.sub-title').get(),
                    by: 'lines'
                })
                slides.find('.sub-title').find('> span').wrap('<span class="text-wrap"></span>');
            }

            if ( ('textSlide' == c) || ('textSlide' == d) ) {
                Splitting({
                    target: slides.find('.title').get(),
                    by: 'lines'
                })
                slides.find('.title').find('> span').wrap('<span class="text-wrap"></span>');
            }

            if ( ('textSlide' == e) || ('textSlide' == f) ) {
                if (!slides.find('.desc').children().length) {
                    Splitting({
                        target: slides.find('.desc').get(),
                        by: 'lines'
                    })

                    slides.find('.desc').find('> span').wrap('<span class="text-wrap"></span>');
                } else {
                    Splitting({
                        target: slides.find('.desc').children().get(),
                        by: 'lines'
                    })

                    slides.find('.desc').children().find('> span, > i').wrap('<span class="text-wrap"></span>');
                }
            }

            if ( ('slideUp' == g) || ('slideUp' == h) ) {
                slides.find('.url1').find('> *').wrap('<span class="text-wrap"><span class="url-wrap"></span></span>');
            }

            if ( ('slideUp' == i) || ('slideUp' == j) ) {
                slides.find('.url2').find('> *').wrap('<span class="text-wrap"><span class="url-wrap"></span></span>');
            }
        },
        event: function() {
            var 
            t = this,
            a = t.args.subEffIn.eff,
            b = t.args.subEffOut.eff,
            c = t.args.titleEffIn.eff,
            d = t.args.titleEffOut.eff,
            e = t.args.descEffIn.eff,
            f = t.args.descEffOut.eff,
            k = t.args.wrapEffIn.eff,
            l = t.args.wrapEffOut.eff,
            autoplay = t.args.autoplay,
            autoplaySpeed = t.args.autoplaySpeed,
            kenburns = t.args.kenburns,
            kenburnsZoom = t.args.kenburnsZoom,
            kenburnsDuration = t.args.kenburnsDuration / 1000,
            slides = t.$elm.find('.content-wrap .slide'),
            images = t.$elm.find('.bg-wrap .bg'),
            nextArrow = t.$elm.find('.control-wrap .arrow-next'),
            prevArrow = t.$elm.find('.control-wrap .arrow-prev'),
            dots = t.$elm.find('.control-wrap .nav-dots .dot'),
            current = t.$elm.find('.content-wrap .slide.active').first().index(),
            newIndex = 0,
            direction = 'next',
            playing = false;

            // Event
            (kenburns == 'yes') && gsap.to(images[current], { duration: kenburnsDuration, scale: kenburnsZoom, ease: 'zoom', delay: 0.3 })

            nextArrow.on('click', function() { navigation('next') });
            prevArrow.on('click', function() { navigation('prev') });
            
            dots.each(function(idx, elm) {
                $(elm).on('click', function() {
                    navigationDots(idx);
                })
            })

            t.$elm.swipe({
                swipeLeft: function (event, direction, distance, duration, fingerCount) {
                    navigation('next')
                },
                swipeRight: function (event, direction, distance, duration, fingerCount) {
                    navigation('prev')
                }
            })

            if (autoplay == 'yes') {
                setInterval(function () {
                    navigation('next');
                }, autoplaySpeed )
            }

            function navigation(way) {
                if (playing) return;
                playing = true;

                direction = way;
                way == 'next'
                    ? newIndex = current === slides.length - 1 ? 0 : current + 1
                    : newIndex = current === 0 ? slides.length - 1 : current - 1;

                updateSlide(newIndex);
            }

            function navigationDots(index) {
                if (playing) return;
                if (index == current) return;
                playing = true;
                newIndex = index;
                newIndex > current ? direction = 'next' : direction = 'prev';
                updateSlide(newIndex);
            }

            function updateSlide(newIndex) {
                let currentSlide = slides.eq(current);
                let newSlide = slides.eq(newIndex);

                Promise.all([
                    updateStart(),
                    imageOut(),
                    imageIn(),
                    subOut(),
                    subIn(),
                    titleOut(),
                    titleIn(),
                    descOut(),
                    descIn(),
                    url1Out(),
                    url1In(),
                    url2Out(),
                    url2In(),
                    wrapIn(),
                    wrapOut()
                ]).then(function() {
                    updateEnd()
                });
            }

            function updateStart() {
                (kenburns == 'yes') && (
                    gsap.set( images[newIndex], { scale: 1 } ),
                    gsap.killTweensOf( images[current] ) ),
                dots.eq(current).removeClass('active'),
                dots.eq(newIndex).addClass('active'),
                slides.eq(newIndex).addClass('animating'),
                gsap.set(images[current], { zIndex: 1 }),
                gsap.set(images[newIndex], { zIndex: 2, visibility: 'visible' }),
                gsap.set(slides[current], { zIndex: 1 }),
                gsap.set(slides[newIndex], { zIndex: 2, visibility: 'visible', opacity: 1 }),
                slides.eq(newIndex).find('.sub-title').length &&
                    (slides.eq(newIndex).find('.sub-title .text-wrap').length 
                        ? gsap.set(slides.eq(newIndex).find('.sub-title'), { opacity: 1 })
                        : gsap.set(slides.eq(newIndex).find('.sub-title'), { opacity: 0 })),
                slides.eq(newIndex).find('.title').length &&
                    (slides.eq(newIndex).find('.title .text-wrap').length
                        ? gsap.set(slides.eq(newIndex).find('.title'), { opacity: 1 })
                        : gsap.set(slides.eq(newIndex).find('.title'), { opacity: 0 })),
                slides.eq(newIndex).find('.desc').length &&
                    (slides.eq(newIndex).find('.desc .text-wrap').length
                        ? gsap.set(slides.eq(newIndex).find('.desc'), { opacity: 1 })
                        : gsap.set(slides.eq(newIndex).find('.desc'), { opacity: 0 })),
                slides.eq(newIndex).find('.url1').length &&
                    (slides.eq(newIndex).find('.url1 .text-wrap').length
                        ? gsap.set(slides.eq(newIndex).find('.url1'), { opacity: 1 })
                        : gsap.set(slides.eq(newIndex).find('.url1'), { opacity: 0 })),
                slides.eq(newIndex).find('.url2').length &&
                    (slides.eq(newIndex).find('.url2 .text-wrap').length
                        ? gsap.set(slides.eq(newIndex).find('.url2'), { opacity: 1 })
                        : gsap.set(slides.eq(newIndex).find('.url2'), { opacity: 0 }))
            }

            function updateEnd() {
                slides.eq(current).removeClass('active'),
                images.eq(current).removeClass('active'),
                slides.eq(newIndex).removeClass('animating'),
                slides.eq(newIndex).addClass('active'),
                images.eq(newIndex).addClass('active'),
                gsap.set(slides[current], { visibility: 'hidden', zIndex: 0 }),
                gsap.set(images[current], { visibility: 'hidden', zIndex: 0 }),
                current = newIndex,
                playing = false,
                (kenburns == 'yes') && gsap.to(images[newIndex], { duration: kenburnsDuration, scale: kenburnsZoom, ease: 'zoom' })
            }

            function imageOut() {
                var effect = t.args.bgEffOut.eff;
                var prop = $.extend({}, t.params.images[effect].out[direction], t.args.bgEffOut.prop );
                return gsap.to( images[current], prop );
            }

            function imageIn() {
                var effect = t.args.bgEffIn.eff;
                var prop1 = t.params.images[effect].set;
                var prop2 = $.extend({}, t.params.images[effect].in, t.args.bgEffIn.prop );

                if ( prop1[direction] )
                    gsap.set( images[newIndex], prop1[direction] );
                if ( prop2 )
                    return gsap.to( images[newIndex], prop2 );
            }

            function wrapOut() {
                var effect = t.args.wrapEffOut.eff;
                var prop = $.extend({}, t.params.images[effect].out[direction], t.args.wrapEffOut.prop );
                return gsap.to( slides[current], prop );
            }

            function wrapIn() {
                var effect = t.args.wrapEffIn.eff;
                var prop1 = t.params.images[effect].set;
                var prop2 = $.extend({}, t.params.images[effect].in, t.args.wrapEffIn.prop );
                if ( prop1[direction] )
                    gsap.set( slides[newIndex], prop1[direction] );
                if ( prop2 )
                    return gsap.to( slides[newIndex], prop2 );
            }

            function subOut() {
                if (!slides.eq(current).find('.sub-title').length) return;

                var target = slides.eq(current).find('.sub-title');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.subEffOut.eff;
                var prop = $.extend({}, t.params.text[effect].out[direction], t.args.subEffOut.prop );
                return gsap.to( target, prop );
            }

            function subIn() {
                if (!slides.eq(newIndex).find('.sub-title').length) return;

                var target = slides.eq(newIndex).find('.sub-title');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.subEffIn.eff;
                var prop1 = t.params.text[effect].set;
                var prop2 = $.extend({}, t.params.text[effect].in, t.args.subEffIn.prop );

                if ( prop1[direction] )
                    gsap.set( target, prop1[direction] );
                if ( prop2 )
                    return gsap.to( target, prop2 );
            }

            function titleOut() {
                if (!slides.eq(current).find('.title').length) return;

                var target = slides.eq(current).find('.title');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.titleEffOut.eff;
                var prop = $.extend({}, t.params.text[effect].out[direction], t.args.titleEffOut.prop );
                return gsap.to( target, prop );
            }

            function titleIn() {
                if (!slides.eq(newIndex).find('.title').length) return;

                var target = slides.eq(newIndex).find('.title');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.titleEffIn.eff;
                var prop1 = t.params.text[effect].set;
                var prop2 = $.extend({}, t.params.text[effect].in, t.args.titleEffIn.prop );

                if ( prop1[direction] )
                    gsap.set( target, prop1[direction] );
                if ( prop2 )
                    return gsap.to( target, prop2 );
            }

            function descOut() {
                if (!slides.eq(current).find('.desc').length) return;

                var target = slides.eq(current).find('.desc');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.descEffOut.eff;
                var prop = $.extend({}, t.params.text[effect].out[direction], t.args.descEffOut.prop );

                return gsap.to( target, prop );
            }

            function descIn() {
                if (!slides.eq(newIndex).find('.desc').length) return;

                var target = slides.eq(newIndex).find('.desc');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.descEffIn.eff;
                var prop1 = t.params.text[effect].set;
                var prop2 = $.extend({}, t.params.text[effect].in, t.args.descEffIn.prop );

                if ( prop1[direction] )
                    gsap.set( target, prop1[direction] );
                if ( prop2 )
                    return gsap.to( target, prop2 );
            }

            function url1Out() {
                if (!slides.eq(current).find('.url1').length) return;

                var target = slides.eq(current).find('.url1');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.url1EffOut.eff;
                var prop = $.extend({}, t.params.url[effect].out[direction], t.args.url1EffOut.prop );

                return gsap.to( target, prop );
            }

            function url1In() {
                if (!slides.find('.url1').length) return;

                var target = slides.eq(newIndex).find('.url1');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.url1EffIn.eff;
                var prop1 = t.params.url[effect].set;
                var prop2 = $.extend({}, t.params.url[effect].in, t.args.url1EffIn.prop );

                if ( prop1[direction] )
                    gsap.set( target, prop1[direction] );
                if ( prop2 )
                    return gsap.to( target, prop2 );
            }

            function url2Out() {
                if (!slides.eq(current).find('.url2').length) return;

                var target = slides.eq(current).find('.url2');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.url2EffOut.eff;
                var prop = $.extend({}, t.params.url[effect].out[direction], t.args.url2EffOut.prop );

                return gsap.to( target, prop );
            }

            function url2In() {
                if (!slides.eq(newIndex).find('.url2').length) return;

                var target = slides.eq(newIndex).find('.url2');
                if (target.find('.text-wrap').length)
                    target = target.find('.text-wrap > *');
                var effect = t.args.url2EffIn.eff;
                var prop1 = t.params.url[effect].set;
                var prop2 = $.extend({}, t.params.url[effect].in, t.args.url2EffIn.prop );

                if ( prop1[direction] )
                    gsap.set( target, prop1[direction] );
                if ( prop2 )
                    return gsap.to( target, prop2 );
            }
        }
    };

    masterSlider.defaults = masterSlider.prototype.defaults;

    $.fn.masterSlider = function(opts) {
        return this.each(function() {
            new masterSlider(this, opts).init();
        });
    };
}(jQuery, window, document));

// Pie Chart
(function($, window, document, undefined) {
    "use strict";

    var masterPieChart = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterPieChart.prototype = {
        defaults: {
            barColor: "#42d9be",
            trackColor: "#eef3f7",
            lineCap: "round",
            scaleColor: false,
            scaleLength: 0,
            lineWidth: 3,
            size: 140,
            animate: {
                duration: 700,
                enabled: true
            },
            percent: 70
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.build();
            return this;
        },
        build: function() {
            var
            t = this,
            a = t.$elm.find(".chart"),
            b = t.args.percent,
            c = t.$elm.find(".percent");

            a.easyPieChart(t.args);
            a.data('easyPieChart').update(0);

            t.$elm.appear(function() {
                a.data('easyPieChart').update(b);
                c.countTo({ from: 0, to: b, speed: 500 })
            })
        }
    };

    masterPieChart.defaults = masterPieChart.prototype.defaults;

    $.fn.masterPieChart = function(opts) {
        return this.each(function() {
            new   masterPieChart(this, opts).init();
        });
    };
}(jQuery, window, document));

(function($, window, document, undefined) {
    "use strict";

    var masterPngDots = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterPngDots.prototype = {
        defaults: {
            color: "#3B5E75",
            size: 5,
            gap: 2,
            shape: "circle",
            image: "",
            animation: "random",
            rotate3D: false,
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.config);
            this.build();
            return this;
        },
        build: function() {
            var t = this,
                id = "dots-" + (new Date).getTime(),
                a = t.args.color,
                b = t.args.size,
                c = t.args.shape,
                d = t.args.image,
                e = t.args.gap,
                f = t.args.animation,
                g = t.args.rotate3D,
                h = t.args.moving,
                y = t.$elm.find(".canvas-dots canvas").attr("id", id),
                z = t.$elm;

            //z = t.$elm.find(".canvas-dots img")

            var renderer, scene, camera, ww, wh, particles;

            ww = z.innerWidth(),
            wh = z.innerHeight()

            var centerVector = new THREE.Vector3(0, 0, 0);
            var previousTime = 0;

            var init = function() {
                THREE.ImageUtils.crossOrigin = '';

                renderer = new THREE.WebGLRenderer({
                    canvas: document.getElementById(id),
                    antialias: true,
                    alpha: true
                });
                renderer.setSize(ww, wh);
                renderer.setClearColor(0x000000, 0);

                scene = new THREE.Scene();

                camera = new THREE.PerspectiveCamera(100, ww / wh, 1, 1000);
                camera.position.set(0, 0, 280);
                camera.lookAt(centerVector);
                scene.add(camera);
                
                // instantiate a loader
                var loader = new THREE.TextureLoader();

                // load a resource
                loader.load(
                    // resource URL
                    d,

                    // onLoad callback
                    function ( texture ) {
                        // Get Image Data
                        var canvas = document.createElement("canvas");
                        canvas.width = texture.image.width;
                        canvas.height = texture.image.height;
                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(texture.image, 0, 0);
                        var imagedata = ctx.getImageData(0, 0, texture.image.width, texture.image.height);
                        
                        drawTheMap(imagedata);
                    },

                    // onProgress callback currently not supported
                    undefined,

                    // onError callback
                    function ( err ) {
                        console.error( 'An error happened.' );
                    }
                );

                window.addEventListener('resize', onResize, false);
            };
            var drawTheMap = function(imagedata) {
                if ( c == "circle" ) {
                    var geometry = new THREE.Geometry();
                    var material = new THREE.PointsMaterial({
                        size: b,
                        sizeAttenuation: false,
                        map: t.circlePoint(a, b),
                        transparent: true
                    })
                } else {
                    var geometry = new THREE.Geometry();
                    var material = new THREE.PointsMaterial({
                        size: b,
                        color: a,
                        sizeAttenuation: false,
                    });
                }

                var tl = new TimelineMax();

                var gap = b + e;

                for (var y = 0, y2 = imagedata.height; y < y2; y += gap) {
                    for (var x = 0, x2 = imagedata.width; x < x2; x += gap) {
                        if (imagedata.data[(x * 4 + y * 4 * imagedata.width) + 3] > 128) {

                            var vertex = new THREE.Vector3();
                            switch(f) {
                                case "vertical":
                                    vertex.x = x - imagedata.width / 2;
                                    vertex.y = -y + Math.random() * 1000 - 500;
                                    vertex.z = 0;
                                    break;
                                case "horizontal":
                                    vertex.x = x + Math.random() * 1000 - 500;
                                    vertex.y = -y + imagedata.height / 2;
                                    vertex.z = 0;
                                    break;
                                case "slideInLeft":
                                    vertex.x = x - Math.random() * 1000 - 500;
                                    vertex.y = -y + imagedata.height / 2;
                                    vertex.z = 0;
                                    break;
                                case "slideInRight":
                                    vertex.x = x + Math.random() * 1000 + 500;
                                    vertex.y = -y + imagedata.height / 2;
                                    vertex.z = 0;
                                    break;
                                case "slideInTop":
                                    vertex.x = x - imagedata.width / 2;
                                    vertex.y = -y + Math.random() * 1000 + 500;
                                    vertex.z = 0;
                                    break;
                                case "slideInBottom":
                                    vertex.x = x - imagedata.width / 2;
                                    vertex.y = -y - Math.random() * 1000 - 500;
                                    vertex.z = 0;
                                    break;
                                case "center":
                                    vertex.x = x - imagedata.width / 2;
                                    vertex.y = y - imagedata.height / 2;
                                    vertex.z = 0;
                                    break;
                                case "zoomIn":
                                    var cx = imagedata.width / 2;
                                    var cy = imagedata.height / 2;
                                    vertex.x = (x - cx) * -0.01;
                                    vertex.y = (y - cy) * -0.01;
                                    vertex.z = 0;
                                    break;
                                default: 
                                    vertex.x = Math.random() * 1000 - 500;
                                    vertex.y = Math.random() * 1000 - 500;
                                    vertex.z = -Math.random() * 500;
                            }
                            
                            vertex.destination = {
                                x: x - imagedata.width / 2,
                                y: -y + imagedata.height / 2,
                                z: 0
                            };

                            vertex.speed = Math.random() / 200 + 0.015;

                            geometry.vertices.push(vertex);
                        }
                    }
                }

                particles = new THREE.Points(geometry, material);

                scene.add(particles);

                t.$elm.appear(function () {
                    requestAnimationFrame(render);
                })
                
            };
            var onResize = function(){
                ww = z.innerWidth();
                wh = z.innerHeight();
                renderer.setSize(ww, wh);
                camera.aspect = ww / wh;
                camera.updateProjectionMatrix();
            };
            var render = function(a) {

                requestAnimationFrame(render);

                var j = particles.geometry.vertices.length;
                for (var i = 0; i < j; i++) {
                    var particle = particles.geometry.vertices[i];
                    if ( particle.destination ) {
                        particle.x += (particle.destination.x - particle.x) * particle.speed;
                        particle.y += (particle.destination.y - particle.y) * particle.speed;
                        particle.z += (particle.destination.z - particle.z) * particle.speed;
                    }
                }

                if (h) {
                    if((a-previousTime>500) && (a < 300000) ){
                        var index = Math.floor(Math.random()*particles.geometry.vertices.length);
                        var particle1 = particles.geometry.vertices[index];
                        var particle2 = particles.geometry.vertices[particles.geometry.vertices.length-index];
                        if (particle2) {
                            gsap.to(particle1, Math.random()*2+1,{x:particle2.x, y:particle2.y, ease:Power2.easeInOut});
                        }
                        if (particle1) {    
                            gsap.to(particle2, Math.random()*2+1,{x:particle1.x, y:particle1.y, ease:Power2.easeInOut});
                        }
                        previousTime = a;
                    }
                }
                

                particles.geometry.verticesNeedUpdate = true;
                if (g) camera.position.x = Math.sin(a / 5000) * 15;
                camera.lookAt(centerVector);

                renderer.render(scene, camera);
            };
            init(); 
        },
        circlePoint: function(color, size) {
            var matCanvas = document.createElement('canvas');
            matCanvas.width = matCanvas.height = size;
            var matContext = matCanvas.getContext('2d');
            // create texture object from canvas.
            var texture = new THREE.Texture(matCanvas);
            // Draw a circle
            var center = size / 2;
            matContext.beginPath();
            matContext.arc(center, center, size/2, 0, 2 * Math.PI, false);
            matContext.closePath();
            matContext.fillStyle = color;
            matContext.fill();
            // need to set needsUpdate
            texture.needsUpdate = true;
            // return a texture made from the canvas
            return texture;
        }
    };

    masterPngDots.defaults = masterPngDots.prototype.defaults;

    $.fn.masterPngDots = function(opts) {
        return this.each(function() {
            new masterPngDots(this, opts).init();
        });
    };
}(jQuery, window, document));

(function($, window, document, undefined) {
    "use strict";

    var masterParticles = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterParticles.prototype = {
        defaults: {
            particles: {
                number: { value: 80, density: { enable: !0, value_area: 800 } },
                color: { value: ["#f7ccaf", "#f6cacd", "dbf5f8", "#c5d8f8", "#c5f8ce", "#f7afbd", "#b2d6ef", "#f1ecb7"] },
                shape: { type: "triangle" },
                size: { value: 50, random: !0, anim: { enable: !0, speed: 1 } },
                opacity: { value: 0.2 },
                move: { direction: "right", attract: { enable: !0 } },
                line_linked: { enable: !0, distance: 150, opacity: 0.4, width: 1 }
            },
            retina_detect: !0,
            number: 100,
            shape: "triangle",
            color: "#f7ccaf|#f6cacd|#dbf5f8",
            size: 10,
            direction: "none",
            lines: !0,
            lineColor: "#ffffff",
            lineOpacity: 0.4,
            lineWidth: 1,
            speed: 1
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.config);
            this.build();
            return this;
        },
        build: function() {
            var 
            t = this,
            a = "cp-" + (new Date).getTime(),
            c = t.args.number,
            d = t.args.shape,
            e = t.args.color,
            f = e.split("|"),
            g = t.args.size,
            h = t.args.opacity,
            i = t.args.direction,
            j = t.args.speed,
            k = t.args.lines,
            l = t.args.lineColor,
            m = t.args.lineOpacity,
            n = t.args.lineWidth,
            z = t.$elm.find(".canvas-particles").attr("id", a);

            t.args.particles.number.value = c,
            t.args.particles.shape.type = d,
            t.args.particles.color.value = f,
            t.args.particles.size.value = g,
            t.args.particles.opacity.value = h,
            t.args.particles.move.direction = i,
            t.args.particles.move.speed = j,
            t.args.particles.line_linked.enable = k,
            t.args.particles.line_linked.color = l,
            t.args.particles.line_linked.opacity = m,
            t.args.particles.line_linked.width = n

            if ( t.args.json ) {
                var json = JSON.parse(t.args.json);
                particlesJS(a, json);
            } else {
                particlesJS(a, t.args);
            }
        }
    };

    masterParticles.defaults = masterParticles.prototype.defaults;

    $.fn.masterParticles = function(opts) {
        return this.each(function() {
            new masterParticles(this, opts).init();
        });
    };
}(jQuery, window, document));

// SVG drawing
(function($, window, document, undefined) {
    "use strict";

    var masterDrawingSVG = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("draw");
    };

    masterDrawingSVG.prototype = {
        defaults: {
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.eIO();
            return this;
        },
        eIO: function e() {
            var t = this;
            new IntersectionObserver(
                function e(i, n) {
                    i.forEach(function (e) {
                        e.isIntersecting && (t.build(), n.unobserve(e.target));
                    });
                }
            ).observe(t.elm);
        },
        build: function() {
            var t = this,
                c = t.args.child,
                d = t.args.duration,
                p = t.$elm.find("path");

            typeof(c) != "undefined" && c && (p = t.$elm.find(c)),
            anime({
                targets: p.get(),
                duration: d,
                strokeDashoffset: [anime.setDashoffset, 0],
                easing: "easeInOutSine"
            })
        }
    };

    masterDrawingSVG.defaults = masterDrawingSVG.prototype.defaults;

    $.fn.masterDrawingSVG = function(opts) {
        return this.each(function() {
            new masterDrawingSVG(this, opts).init();
        });
    };
}(jQuery, window, document));

// Image Morphing
(function($, window, document, undefined) {
    "use strict";

    var masterImageMorphing = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterImageMorphing.prototype = {
        defaults: {
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.eIO();
        },
        eIO: function e() {
            var t = this;
            new IntersectionObserver(
                function e(i, n) {
                    i.forEach(function (e) {
                        e.isIntersecting && (t.build(), n.unobserve(e.target));
                    });
                }
            ).observe(t.elm);
        },
        build: function() {
            var t = this,
                a = t.$elm.find('clipPath > path'),
                b = t.$elm.find('g > image'),
                c = t.args.duration,
                d = t.args.repeat,
                paths = []; 

            a.each(function(idx, el) {
                let duration = 0;
                (idx !== 0) && (duration = 3000),
                paths.push({ value : el.getAttribute('d'), duration: duration });
            }) 

            var snap = Snap(t.elm.querySelector("svg"));
            var path = snap.select('path');
            
            var ir = 0;
            var ip = 0;
            var tp = paths.length - 1;
            var ii = b.length - 1;
            var ti = b.length - 1;
            var current = 0;
            gsap.set( b, { opacity: 0 } )
            gsap.set( b[0], { opacity: 1 } )

            t.$elm.appear(function() {
                animate();
            })
            
            function animate() {
                if ( ir < d ) {                
                    (ip == tp) ? (ip = 0, ir++) : (ip++),
                    path.animate({ 'path' : paths[ip].value }, c, mina.easeinout, animate)
                    if ( ( ti > 0 ) ) {
                        current = ii,
                        (ii == ti) ? (ii = 0) : (ii++),
                        gsap.to(b[current], 1, { opacity: 0, delay: 0.3 }),
                        gsap.to(b[ii], 1, { opacity: 1 })
                    }
                }
            }
        }      
    };

    masterImageMorphing.defaults = masterImageMorphing.prototype.defaults;

    $.fn.masterImageMorphing = function(opts) {
        return this.each(function() {
            new masterImageMorphing(this, opts).init();
        });
    };
}(jQuery, window, document));

// Vertical Slider
(function($, window, document, undefined) {
    "use strict";

    var masterVerticalSlider = function(elm, opts) {
        this.elm = elm;
        this.$elm = $(elm);
        this.opts = opts;
        this.config = this.$elm.data("config");
    };

    masterVerticalSlider.prototype = {
        defaults: {
        },
        init: function() {
            this.args = $.extend({}, this.defaults, this.opts, this.config);
            this.eIO();
        },
        eIO: function e() {
            var t = this;
            new IntersectionObserver(
                function e(i, n) {
                    i.forEach(function (e) {
                        e.isIntersecting && (t.build(), n.unobserve(e.target));
                    });
                }
            ).observe(t.elm);
        },
        build: function() {
            var t = this,
                ih = t.$elm.find('.swiper-slide').eq(0),
                btnNext = t.$elm.find('.swiper-button-next'),
                btnPrev = t.$elm.find('.swiper-button-prev'),
                wrap = t.$elm.find('.swiper-container'),
                a = t.args.row,
                b = t.args.gap;

            (a == 0) && (a = 1)

            t.$elm.waitForImages(function() {
                var wh = ih.height() * a;
                wrap.css('height', wh + 'px');

                var swiper = new Swiper(wrap.get(0), {
                    direction: 'vertical',
                    slidesPerView: a,
                    mousewheel: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: btnNext.get(0),
                        prevEl: btnPrev.get(0),
                    },
                });
                
                swiper.on('slideChange', function (e) {
                  if (e.isEnd) {
                    e.mousewheel.disable();
                   }
                });
            })
            
        }      
    };

    masterVerticalSlider.defaults = masterVerticalSlider.prototype.defaults;

    $.fn.masterVerticalSlider = function(opts) {
        return this.each(function() {
            new masterVerticalSlider(this, opts).init();
        });
    };
}(jQuery, window, document));