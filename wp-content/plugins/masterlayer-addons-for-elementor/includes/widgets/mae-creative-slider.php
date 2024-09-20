<?php
/*
Widget Name: Creative Slider
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
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

class MAE_Creative_Slider_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'gsap', 'touchSwipe' ];
    }

    public function get_script_style() {
        return [ 'gsap', 'touchSwipe' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-creative-slider';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Creative Slider', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-slider';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        //----------------------------------------------//
        // CONTENT TAB                                  //
        //----------------------------------------------//
        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Slides', 'masterlayer' ),
                ]
            );

            $repeater = new Repeater();

            $repeater->start_controls_tabs( 'tab_content' );

            // Content

                $repeater->add_control(
                    'active',
                    [
                        'label' => __( 'Active', 'masterlayer' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => __( 'Yes', 'masterlayer' ),
                        'label_off' => __( 'No', 'masterlayer' ),
                        'return_value' => 'yes',
                        'default' => 'no',
                    ]
                );

                $repeater->add_control(
                    'slide',
                    [
                        'label'     => __( 'Choose Templates', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => mae_get_slider_templates(),
                    ]
                );

                $repeater->end_controls_tabs();

            $this->add_control(
                'slides',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [   
                            'active' => 'yes',
                            'title'  => __( 'Slide #1', 'masterlayer' ),
                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

            $this->end_controls_section();

        // Settings
            $this->start_controls_section(
                'section__settings',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'slider_style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'          => __( 'Default', 'masterlayer'),
                        'full-width'       => __( 'Full Width', 'masterlayer'),
                        'full-screen'      => __( 'Full Screen', 'masterlayer'),
                    ],
                    'prefix_class' => 'slider-'
                ]
            );

            // $this->add_responsive_control(
            //     'slider_height',
            //     [
            //         'label'      => __( 'Slider Height', 'masterlayer' ),
            //         'type'       => Controls_Manager::SLIDER,
            //         'size_units' => [ 'px', '%', 'vh' ],
            //         'range'      => [
            //             'px' => [
            //                 'min' => 300,
            //                 'max' => 1500,
            //             ],
            //         ],
            //         'default' => [
            //             'unit' => 'px',
            //             'size' => 500,
            //         ],
            //         'selectors'  => [
            //             '{{WRAPPER}} .master-slider' => 'min-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            //         ],
            //         50,
            //     ]
            // );

            // $this->add_responsive_control(
            //     'slider_height_offset',
            //     [
            //         'label'      => __( 'Slider Height Offset', 'masterlayer' ),
            //         'type'       => Controls_Manager::SLIDER,
            //         'size_units' => [ 'px' ],
            //         'range'      => [
            //             'px' => [
            //                 'min' => 0,
            //                 'max' => 500,
            //             ],
            //         ],
            //         'default' => [
            //             'unit' => 'px',
            //         ],
            //         'selectors'  => [
            //             '{{WRAPPER}} .master-slider' => 'height: calc(100vh - {{SIZE}}{{UNIT}})',
            //         ],
            //         50,
            //         'condition' => [ 'slider_style' => 'full-screen' ]
            //     ]
            // );

            $this->add_control(
                'autoplay',
                [
                    'label'     => __( 'Autoplay', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'        => __( 'No', 'masterlayer'),
                        'yes'       => __( 'Yes', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'autoplaySpeed',
                [
                    'label' => __( 'Autoplay Speed(ms)', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1000,
                    'max' => 10000,
                    'step' => 100,
                    'default' => '9000',
                    'condition' => ['autoplay' => 'yes']
                ]
            ); 

            $this->end_controls_section();

        // Arrows
            $this->start_controls_section(
                'section__settings_arrows',
                [
                    'label' => __( 'Arrows', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'slider_arrow',
                [
                    'label'     => __( 'Show Arrows', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'yes',
                    'options'   => [
                        'yes'           => __( 'Show', 'masterlayer'),
                        'no'            => __( 'Hide', 'masterlayer'),
                    ],
                    'prefix_class' => 'slider-arrows-'
                ]
            );

            if ( is_rtl() ) {
                $this->add_control(
                    'slider_arrow_pos',
                    [
                        'label'     => __( 'Arrows Position', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'cc',
                        'options'   => [
                            'cc'            => __( 'Center', 'masterlayer'),
                            'cfw'           => __( 'Center (Full Width)', 'masterlayer'),
                            'cr'            => __( 'Center Left', 'masterlayer'),
                            'br'            => __( 'Bottom Left', 'masterlayer'),
                        ],
                        'prefix_class' => 'arrows-pos-',
                        'condition' => [
                            'slider_arrow' => 'yes' 
                        ]
                    ]
                );
            } else {
                $this->add_control(
                    'slider_arrow_pos',
                    [
                        'label'     => __( 'Arrows Position', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'cc',
                        'options'   => [
                            'cc'            => __( 'Center', 'masterlayer'),
                            'cfw'           => __( 'Center (Full Width)', 'masterlayer'),
                            'cr'            => __( 'Center Right', 'masterlayer'),
                            'br'            => __( 'Bottom Right', 'masterlayer'),
                        ],
                        'prefix_class' => 'arrows-pos-',
                        'condition' => [
                            'slider_arrow' => 'yes' 
                        ]
                    ]
                );
            }

            $this->add_control(
                'slider_arrow_size',
                [
                    'label'     => __( 'Arrows Size', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'big',
                    'options'   => [
                        'big'            => __( 'Big', 'masterlayer'),
                        'medium'           => __( 'Medium', 'masterlayer'),
                    ],
                    'prefix_class' => 'arrows-size-',
                    'condition' => [
                        'slider_arrow' => 'yes' 
                    ]
                ]
            );

            $this->add_control(
                'slider_arrow_top_offset',
                [
                    'label'     => __( 'Arrows Top Offset', 'masterlayer'),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}}.arrows-pos-cfw .master-slider .arrow,
                        {{WRAPPER}}.arrows-pos-cc .master-slider .arrow' => 'top: calc(50% + {{SIZE}}{{UNIT}})',
                        '{{WRAPPER}}.arrows-pos-cr .master-slider .nav-arrow' => 'top: calc(50% + {{SIZE}}{{UNIT}})',
                    ],
                    50,
                    'condition' => [ 'slider_arrow_pos' => [ 'cc', 'cfw', 'cr'] ]
                ]
            );

            $this->add_control(
                'slider_arrow_rounded',
                [
                    'label' => __( 'Arrows Rounded', 'masterlayer' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-slider .arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_arrow' => 'yes' 
                    ]
                ]
            );

            $this->end_controls_section();

        // Dots
            $this->start_controls_section(
                'section__settings_dots',
                [
                    'label' => __( 'Dots', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'slider_dots',
                [
                    'label'     => __( 'Show Dots', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'yes',
                    'options'   => [
                        'yes'           => __( 'Show', 'masterlayer'),
                        'no'            => __( 'Hide', 'masterlayer'),
                    ],
                    'prefix_class' => 'slider-dots-'
                ]
            );

            if ( is_rtl() ) {
                $this->add_control(
                    'slider_dots_pos',
                    [
                        'label'     => __( 'Dots Position', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'bc',
                        'options'   => [
                            'bl'           => __( 'Right', 'masterlayer'),
                            'bc'           => __( 'Center', 'masterlayer'),
                            'br'            => __( 'Left', 'masterlayer'),
                        ],
                        'condition' => [ 'slider_dots' => 'yes' ],
                        'prefix_class' => 'dots-pos-'
                    ]
                );
            } else {
                $this->add_control(
                    'slider_dots_pos',
                    [
                        'label'     => __( 'Dots Position', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'bc',
                        'options'   => [
                            'bl'           => __( 'Left', 'masterlayer'),
                            'bc'           => __( 'Center', 'masterlayer'),
                            'br'            => __( 'Right', 'masterlayer'),
                        ],
                        'condition' => [ 'slider_dots' => 'yes' ],
                        'prefix_class' => 'dots-pos-'
                    ]
                );
            }
            

            $this->add_control(
                'slider_dots_bottom_offset',
                [
                    'label'     => __( 'Dots Bottom Offset', 'masterlayer'),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-slider .nav-dots' => 'bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [ 'slider_dots' => 'yes' ]
                ]
            );

            $this->add_control(
                'slider_dots_size',
                [
                    'label'     => __( 'Dots Size', 'masterlayer'),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-slider .nav-dots .dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'slider_dots' => 'yes' ]
                ]
            );

            $this->add_control(
                'slider_dots_rounded',
                [
                    'label' => __( 'Dots Rounded', 'masterlayer' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-slider .nav-dots .dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_dots' => 'yes' 
                    ]
                ]
            );

            $this->end_controls_section();
        
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $slides = $this->get_settings_for_display( 'slides' );

        ?>

        <div class="master-slider">
            <div class="slides">
                <?php 
                $index = 0;
                $foundActive = false;
                foreach( $slides as $slide ) { 
                    if (!empty($slide['slide'])) {
                        $active = '';
                        if ($slide['active'] == 'yes') {
                            if (!$foundActive) {
                                $active = ' active';
                                $foundActive = true;
                            }
                        } 
                        echo '<div class="slide' . $active . '">';
                        echo Plugin::$instance->frontend->get_builder_content($slide['slide'], false);
                        echo '</div>';
                    }
                    $index++;
                } 
                ?>
            </div>

            <div class="control-wrap">
                <div class="nav-arrow">
                    <div class="arrow arrow-prev"></div>
                    <div class="arrow arrow-next"></div>         
                </div>

                <div class="nav-dots">
                </div>
            </div>
        </div><!-- /.master-slider -->


        <?php
    }

    protected function content_template() {}
}

