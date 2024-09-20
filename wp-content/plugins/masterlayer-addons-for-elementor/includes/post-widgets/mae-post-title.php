<?php
/*
Widget Name: Post Title
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Post_Title_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-post-title';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Post Title', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-post-title';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
        // Style  
        $this->start_controls_section(
            'section__style_general',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        if ( is_rtl() ) {
            $this->add_responsive_control(
                'align',
                [
                    'label' => __( 'Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'right'    => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'masterlayer' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'left' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'prefix_class' => 'align-%s'
                ]
            );
        } else {
            $this->add_responsive_control(
                'align',
                [
                    'label' => __( 'Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left'    => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'masterlayer' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'prefix_class' => 'align-%s'
                ]
            );
        }

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .main-title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'      => __( 'Bottom Spacing', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .main-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                50,
            ]
        );

        $this->end_controls_section();
	}


	protected function render() {
        // Get default title for all pages
        $title = agrios_get_mod( 'blog_featured_title', 'Our Blog' );

        // Override title for specify pages
        if ( is_singular() ) {
            $title = get_the_title();
        } elseif ( is_search() ) {
            $title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'agrios' ), get_search_query() );
        } elseif ( is_404() ) {
            $title = esc_html__( 'Not Found', 'agrios' );
        } elseif ( is_author() ) {
            the_post();
            $title = sprintf( esc_html__( 'Author Archives: %s', 'agrios' ), get_the_author() );
            rewind_posts();
        } elseif ( is_day() ) {
            $title = sprintf( esc_html__( 'Daily Archives: %s', 'agrios' ), get_the_date() );
        } elseif ( is_month() ) {
            $title = sprintf( esc_html__( 'Monthly Archives: %s', 'agrios' ), get_the_date( 'F Y' ) );
        } elseif ( is_year() ) {
            $title = sprintf( esc_html__( 'Yearly Archives: %s', 'agrios' ), get_the_date( 'Y' ) );
        } elseif ( is_tax() || is_category() || is_tag() ) {
            $title = single_term_title( '', false );
        }

        // For shop page
        if ( agrios_is_woocommerce_shop() ) {
            $title = agrios_get_mod( 'shop_featured_title', 'Our Shop' );
        }

        // For single shop page
        if ( is_singular( 'product' ) ) {
            $sst = agrios_get_mod( 'shop_single_featured_title', 'Our Shop' );
            if ( $sst != '' ) { $title = $sst; }
            else { $title = get_the_title(); }
        }

        // For single project
        if ( is_singular( 'project' ) ) {
            $title = agrios_get_mod( 'project_single_featured_title', '' );
            if ( !$title ) $title = get_the_title();
        }

        // For single service
        if ( is_singular( 'service' ) ) {
            $title = agrios_get_mod( 'service_single_featured_title', '' );
            if ( !$title ) $title = get_the_title();
        }

        // For single post
        if ( is_singular( 'post' ) ) {
            $title = agrios_get_mod( 'blog_single_featured_title', '' );
            if ( !$title ) $title = get_the_title();
        } 
        ?>

        <h1 class="main-title">
            <?php 
                if ( agrios_get_elementor_option('custom_featured_title') ) {
                    echo esc_html(agrios_get_elementor_option('custom_featured_title'));
                } else {
                    echo do_shortcode( $title ); 
                }
            ?>
        </h1>
	<?php }
}

