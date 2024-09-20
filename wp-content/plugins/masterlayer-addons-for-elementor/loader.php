<?php

namespace MasterlayerAddons;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Masterlayer_Elementor_Addons' ) ) {
    /**
     * Main Class
     */
    final class Masterlayer_Elementor_Addons {
        private static $instance;
        /**
         * Insures that only one instance of Masterlayer_Elementor_Addons exists in memory at any one time.
         */
        public static function instance() {
            if ( ! isset( self::$instance ) && ! self::$instance instanceof Masterlayer_Elementor_Addons ) {
                self::$instance = new Masterlayer_Elementor_Addons();
                self::$instance->includes_and_hooks();
            }

            return self::$instance;
        }

        /**
         * Include required files and init hooks
         */
        private function includes_and_hooks() {
            // if ( is_admin() ) {
            //     require_once MAE_PATH . 'admin/admin.php';
            // }
            require_once MAE_PATH . 'includes/mae-functions.php';
            require_once MAE_PATH . 'includes/icons.php';
            require_once MAE_PATH . 'includes/cpt.php';
            require_once MAE_PATH . 'includes/mae-hooks.php';

            add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
            add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
            add_action( 'elementor/widgets/register', array( $this, 'include_widgets' ) );
            add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'enqueue_frontend_admin_styles' ), 20 );
            add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_frontend_scripts' ), 20 );
            add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_frontend_styles' ), 20 );
            add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_frontend_styles' ), 20 );  
        }

        /**
         * Load plugin text domain
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'masterlayer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

        /**
         * Add a custom category to Elementor panel
         */
        public function add_elementor_category() {
            \Elementor\Plugin::instance()->elements_manager->add_category( 
                'masterlayer-addons',
                array(
                    'title' => __( 'Masterlayer Addons', 'masterlayer' ),
                    'icon'  => 'fa fa-plug',
                ),
                1
            );
        }

        /**
         * Load frontend style
         */
        public function enqueue_frontend_admin_styles() {
            wp_enqueue_style( 'mae-icons', MAE_URL . 'assets/css/mae-icons.css', array(), '1.0.0' );
        }
        
        /**
         * Load frontend scripts
         */
        public function register_frontend_scripts() {
            wp_register_script( 'appear', MAE_URL . 'assets/js/appear.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'slick', MAE_URL . 'assets/js/slick.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'countto', MAE_URL . 'assets/js/countto.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'flickity', MAE_URL . 'assets/js/flickity.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'cubeportfolio', MAE_URL . 'assets/js/cubeportfolio.js', array( 'jquery' ), '1.0.0', true );
            $e_swiper_latest = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' );
            $e_swiper_asset_path = $e_swiper_latest ? 'lib/swiper/v8/' : 'lib/swiper/';
            $e_swiper_version = $e_swiper_latest ? '8.4.5' : '5.3.6';
            $path = ELEMENTOR_ASSETS_URL . $e_swiper_asset_path . 'swiper.min.js';
            wp_register_script( 'swiper', $path, array( 'jquery' ), $e_swiper_version, true );
            wp_register_script( 'touchSwipe', MAE_URL . 'assets/js/touchSwipe.min.js', array( 'jquery' ), '1.6.18', true );
            wp_register_script( 'splitting', MAE_URL . 'assets/js/splitting.min.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'piechart', MAE_URL . 'assets/js/easypiechart.min.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'threejs', MAE_URL . 'assets/js/three.min.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'parallaxScroll', MAE_URL . 'assets/js/parallax-scroll.js', array( 'jquery' ), '3.7.1', true );
            wp_register_script( 'gsap', MAE_URL . 'assets/js/gsap.min.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'snapSVG', MAE_URL . 'assets/js/snap.svg-min.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'waitforimages', MAE_URL . 'assets/js/waitforimages.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'magnific-popup', MAE_URL . 'assets/js/magnific.popup.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'particle', MAE_URL . 'assets/js/particles.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'globe', MAE_URL . 'assets/js/globe.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'threeOrbit', MAE_URL . 'assets/js/threeOrbit.js', array( 'jquery' ), '1.0.0', true );
            wp_register_script( 'threeMesh', MAE_URL . 'assets/js/threeMesh.js', array( 'jquery' ), '1.0.0', true );
            wp_enqueue_script( 'alterClass', MAE_URL . 'assets/js/alterClass.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'mae-core', MAE_URL . 'assets/js/core.js', array( 'jquery' ), '1.0', true );
            wp_enqueue_script( 'mae-init', MAE_URL . 'assets/js/init.js', array( 'jquery' ), '1.0', true );
        }
        
        /**
         * Load frontend styles
         */
        public function register_frontend_styles() {
            wp_register_style( 'swiper', MAE_URL . 'assets/css/swiper.min.css', array(), '5.3.6' );
            wp_register_style( 'slick', MAE_URL . 'assets/css/slick.css', array(), '1.0' );
            wp_register_style( 'splitting', MAE_URL . 'assets/css/splitting.css', array(), '1.0' );
            wp_register_style( 'cubeportfolio', MAE_URL . 'assets/css/cubeportfolio.css', array(), '1.0' );
            wp_register_style( 'flickity', MAE_URL . 'assets/css/flickity.css', array(), '2.2.1' );
            wp_register_style( 'magnific-popup', MAE_URL . 'assets/css/magnific.popup.css', array(), '2.2.1' );
        }

        /**
         * Enqueue frontend styles
         */
        public function enqueue_frontend_styles() {
            wp_enqueue_style( 'mae-widgets', MAE_URL . 'assets/css/mae-widgets.css', array( 'agrios-theme-style' ), '1.0' );
        }
        
        /**
         * Include required files
         */
        public function include_widgets() {
            $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

            // Header & Footer Widgets
            require_once MAE_WIDGET_PATH . 'mae-logo.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Logo_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-menu.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Menu_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-hamburger.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Hamburger_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-megamenu.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Megamenu_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-search-icon.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Search_Icon_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-cart-icon.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Cart_Icon_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-copyright.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_CopyRight_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-slider.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Slider_Widget() );

            // Single Widget
            require_once MAE_WIDGET_PATH . 'mae-headings.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Headings_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-link.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Link_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-button.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Button_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-call-to-action.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_CTA_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-list.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_List_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-icon-text.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Icon_Text_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-icon-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Icon_Box_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-text-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Text_Box_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-text-box-grid.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Text_Box_Grid_Widget() );

            require_once MAE_WIDGET_PATH . 'mea-social-icons.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Social_Icons_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-video-icon.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Video_Icon_Widget() );

            // Image

            require_once MAE_WIDGET_PATH . 'mae-fancy-image.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Fancy_Image_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-gallery-stack.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Gallery_Stack_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-image-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Image_Box_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-image-morphing.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Image_Morphing_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-png-dots.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Png_Dots_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-particles.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Particles_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-gallery-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Gallery_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-gallery-grid.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Gallery_Grid_Widget() );
            // UX
            require_once MAE_WIDGET_PATH . 'mae-accordion.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Accordion_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-tabs.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Tabs_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-counter.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Counter_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-progress-bar.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Progress_Bar_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-piechart.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Pie_Chart_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-svg-drawing.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_SVG_Drawing_Widget() );

            // Form
            require_once MAE_WIDGET_PATH . 'mae-contact-form-7.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Contact_Form_7_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-subscribe-form.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Subscribe_Form_Widget() );

            // Price Box
            require_once MAE_WIDGET_PATH . 'mae-price-box.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Price_Box_Widget() );

            // Post
            require_once MAE_WIDGET_PATH . 'mae-news-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_News_Carousel_Widget() ); 

            require_once MAE_WIDGET_PATH . 'mae-news-grid.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_News_Grid_Widget() ); 

            require_once MAE_WIDGET_PATH . 'mae-news-block.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_News_Block_Widget() ); 

            require_once MAE_WIDGET_PATH . 'mae-project-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-project-grid.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Grid_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-team-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Team_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-partner-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Partner_Carousel_Widget() );  

            require_once MAE_WIDGET_PATH . 'mae-testimonial-carousel.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Testimonial_Carousel_Widget() );

            require_once MAE_WIDGET_PATH . 'mae-testimonial-vertical-slider.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Testimonial_Vertical_Slider_Widget() );

            // 3D
            require_once MAE_WIDGET_PATH . 'mae-globe.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Globe_Widget() );

            // Single Post Widget
            require_once MAE_POST_WIDGET_PATH . 'mae-post-title.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Title_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-breadcrumbs.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Breadcrumbs_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-content-title.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Content_Title_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-meta-date.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Meta_Date_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-meta-author.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Meta_Author_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-meta-comment.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Meta_Comment_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-meta-category.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Meta_Category_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-featured-image.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Featured_Image_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-content.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Content_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-tags.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Tags_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-post-comment.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Post_Comment_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-related-post.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Related_Post_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-project-related.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Related_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-project-detail.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Project_Detail_Widget() );

            require_once MAE_POST_WIDGET_PATH . 'mae-product-review.php';
            $widgets_manager->register( new \MasterlayerAddons\Widgets\MAE_Product_Review_Widget() );
        }
    }

    /**
     * Loader
     */
    function MAE() {
        return Masterlayer_Elementor_Addons::instance();
    }
    MAE();
}
