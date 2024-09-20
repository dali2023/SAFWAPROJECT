<?php
/*
Widget Name: Testimonial Slider
Comment: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Testimonial_Slider_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'slick', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'slick' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-slider';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Testimonial Slider', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-media-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'avatar',
                [
                    'label'   => __( 'Avatar', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                ]
            );

            $repeater->add_control(
                'name',
                [
                    'label'   => __( 'Name', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'New Member', 'masterlayer' ),
                ]
            );

            $repeater->add_control(
                'position',
                [
                    'label'   => __( 'Position', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Manager', 'masterlayer' ),
                ]
            );

            $repeater->add_control(
                'comment',
                [
                    'label'      => __( 'Comment', 'masterlayer' ),
                    'type'       => Controls_Manager::WYSIWYG,
                    'default'    => __( 'Rump spare ribs tail pastrami ham hock turducken fatback salami. Ham hock tenderloin drumstick pork belly.', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'testimonials',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'name'  => __( 'Client #1', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #2', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #3', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Client #4', 'masterlayer' ),
                        ],
                    ],
                    'title_field' => '{{{ name }}}',
                ]
            );

            $this->end_controls_section();

        // Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'accent_color',
                [
                    'label' => __( 'Accent', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .slick-slider-nav .slick-slide.slick-center .avatar' => 'border-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'desc_color',
                [
                    'label' => __( 'Comment', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .content-wrap .comment' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'name_color',
                [
                    'label' => __( 'Name', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .name' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'position_color',
                [
                    'label' => __( 'Position', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .position' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'content_side_padding',
                [
                    'label' => __( 'Side Padding', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 400,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .content-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'comment_spacing',
                [
                    'label' => __( 'Comment', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .comment' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'name_spacing',
                [
                    'label' => __( 'Name', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-testimonial-slider .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ]
                ]
            );

            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'comment_typography',
                    'label' => __('Comment', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .comment'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'name_typography',
                    'label' => __('Name', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .name'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'position_typography',
                    'label' => __('Position', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .position'
                ]
            );
            
            $this->end_controls_section();
    }

    protected function render() {
        $nav_config = array();
        $content_config = array();
        $cls = $css = $data_nav = $data_content = "";
        $settings = $this->get_settings_for_display();
        $testimonials = $this->get_settings_for_display( 'testimonials' );
        $slidesToShow = $slidesToShow_tablet = $slidesToShow_mobile = 1;

        // if ($settings['nav_number']) $slidesToShow = $settings['nav_number'];
        // $settings['nav_number_tablet']
        //     ? $slidesToShow_tablet = $settings['nav_number_tablet']
        //     : $slidesToShow_tablet = $slidesToShow;
        // $settings['nav_number_mobile']
        //     ? $slidesToShow_mobile = $settings['nav_number_mobile']
        //     : $slidesToShow_mobile = $slidesToShow_tablet;

        // Data       
        $nav_config['centerMode'] = true;
        $nav_config['infinite'] = true;
        $nav_config['focusOnSelect'] = true;
        $nav_config['centerPadding'] = 0;
        $nav_config['slidesToShow'] = $slidesToShow;
        $nav_config['slidesToScroll'] = 1;
        $nav_config['arrows'] = false;
        // if ( ($settings['show_arrow'] == 'true') && ($settings['arrow_pos'] == 'bottom') )
        //     $nav_config['arrows'] = true;

        $nav_config['responsive'][0]['breakpoint'] = 1200; 
        $nav_config['responsive'][0]['settings']['slidesToShow'] = 1; 
        $nav_config['responsive'][0]['settings']['slidesToScroll'] = 1; 
        $nav_config['responsive'][0]['settings']['centerMode'] = true;

        $nav_config['responsive'][1]['breakpoint'] = 1025; 
        $nav_config['responsive'][1]['settings']['slidesToShow'] = 1;
        $nav_config['responsive'][1]['settings']['slidesToScroll'] = 1; 
        $nav_config['responsive'][1]['settings']['centerMode'] = true; 
        $nav_config['responsive'][1]['settings']['vertical'] = false;         
        $nav_config['responsive'][1]['settings']['verticalSwiping'] = false;         

        $nav_config['responsive'][2]['breakpoint'] = 767; 
        $nav_config['responsive'][2]['settings']['slidesToShow'] = 1; 
        $nav_config['responsive'][2]['settings']['slidesToScroll'] = 1; 
        $nav_config['responsive'][2]['settings']['centerMode'] = true; 
        $nav_config['responsive'][2]['settings']['vertical'] = false;         
        $nav_config['responsive'][2]['settings']['verticalSwiping'] = false; 

        $nav_config['slidesToShow'] = 3;
        $nav_config['centerPadding'] = '0px';
        $nav_config['infinite'] = true;

        $data_nav = 'data-slick=\'' . json_encode( $nav_config ) . '\'';
        
        $content_config['arrows'] = false;
        // if ( ($settings['show_arrow'] == 'true') && ($settings['arrow_pos'] == 'middle') )
        $content_config['dots'] = true;
        $content_config['infinite'] = true;
        
        // if ( $settings['autoplay'] == 'true' ) {
        //     $content_config['autoplay'] = true;
        //     $content_config['autoplaySpeed'] = 3000;
        // }

        $data_content = 'data-slick=\'' . json_encode( $content_config ) . '\'';
        ?>

        <div class="master-slick-slider master-testimonial-slider">
            <div class="slick-container slick-nav">
                <div class="slick-slider-nav" id="carousel-quotes-nav" data-nav-target="#carousel-quotes" <?php echo $data_nav; ?>>
                    <?php
                    foreach ( $testimonials as $index => $item ) { 
                        $html = $name = $position = $avatar = "";
        
                        // Avatar 
                        if ($item['avatar'])
                            $avatar = sprintf('<div class="avatar">%1$s</div>', 
                                wp_get_attachment_image( $item['avatar']['id'], 'full' ));
                        ?>
                        <div class="slick-nav-item">
                            <?php echo $avatar; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>  
            
            <div class="slick-container slick-content">
                <div class="slick-slider" data-nav-target="#carousel-quotes-nav" id="carousel-quotes" <?php echo $data_content; ?>>
                    <?php
                    foreach ( $testimonials as $index => $item ) { 
                        $html = $comment = $name = $position = "";

                        // Name
                        if ($item['name'])
                            $name = sprintf('<h3 class="name">%1$s</h3>', 
                                esc_html( $item['name'] ) );

                        // Position
                        if ($item['position'])
                            $position = sprintf('<div class="position">%1$s</div>', 
                                esc_html( $item['position'] ) );

                        // Comment
                        if ($item['comment'])
                            $comment = sprintf('<div class="comment">%1$s</div>', 
                                $item['comment'] );

                        echo '<div><div class="content-wrap">';
                        echo $comment;
                        echo $name;
                        echo $position;
                        echo '</div></div>'; 

                    } ?>
                </div>
            </div> 
        </div>

        <?php
    } 
}

