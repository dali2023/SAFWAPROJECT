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

class MAE_Testimonial_Vertical_Slider_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'swiper', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'swiper' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-testimonial-vertical-slider';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Testimonial Vertical Slider', 'masterlayer' );
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

        // Setting - Slider
            $this->start_controls_section( 'setting_carousel_section',
                [
                    'label' => __( 'Slider', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'row',
                [
                    'label' => __( 'Row', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 10,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'gap',
                [
                    'label' => __( 'Gap', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-slide > div' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template',

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
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $testimonials = $this->get_settings_for_display( 'testimonials' );

        // Data       
        $config['row'] = $settings['row']['size'];
        $config['gap'] = $settings['gap']['size'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-vertical-slider" <?php echo $data; ?>>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    foreach ( $testimonials as $index => $item ) { 
                        $name = $role = $comment = $avatar = '';
                        // Name
                        if ($item['name'])
                            $name = sprintf('<h3 class="name">%1$s</h3>', 
                                esc_html( $item['name'] ) );

                        // Role
                        if ($item['position'])
                            $role = sprintf('<div class="role">%1$s</div>', 
                                esc_html( $item['position'] ) );

                        // Comment
                        if ($item['comment'])
                            $comment = sprintf('<div class="comment">%1$s</div>', 
                                $item['comment'] );

                        // Avatar
                        if ($item['avatar'])
                            $avatar = sprintf('<div class="avatar">%1$s</div>', 
                                wp_get_attachment_image( $item['avatar']['id'], 'full' ) );
                        ?>
                        <div class="swiper-slide">
                             <div class="master-testimonial">
                                <div class="content-wrap">
                                    <?php echo $comment; ?>
                                    <div class="author-wrap">
                                        <?php
                                        echo $name;
                                        echo $role;
                                        ?>
                                        <div class="star-rating">
                                            <span class="ci-star1"></span>
                                            <span class="ci-star1"></span>
                                            <span class="ci-star1"></span>
                                            <span class="ci-star1"></span>
                                            <span class="ci-star1"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="avatar-wrap">
                                    <?php echo $avatar; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>  
            </div>
            <div class="swiper-control">
                <div class="swiper-button swiper-button-next"></div>
                <div class="swiper-button swiper-button-prev"></div>
            </div>
        </div>

        <?php
    } 
}

