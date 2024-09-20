<?php
/*
Widget Name: Slider
Description: 
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
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Slider_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'gsap', 'touchSwipe' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-slider';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Simple Slider', 'masterlayer' );
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
                $repeater->start_controls_tab( 
                    'tab_content_content',
                    [
                        'label' => __( 'Content', 'masterlayer' ),
                    ] 
                );

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
                    'sub_title',
                    [
                        'label' => __( 'Sub-title', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => __( 'Slide sub-stitle', 'masterlayer' ),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'title',
                    [
                        'label' => __( 'Title', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => __( 'Slide Title', 'masterlayer' ),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'desc',
                    [
                        'label' => __( 'Description', 'masterlayer' ),
                        'placeholder' => __( 'Slide Description', 'masterlayer' ),
                        'type' => Controls_Manager::WYSIWYG,
                    ]
                );

                $repeater->end_controls_tab();

            // URL
                $repeater->start_controls_tab( 
                    'tab_content_url',
                    [
                        'label' => __( 'BG & URL', 'masterlayer' ),
                    ] 
                );

                $repeater->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'slide_bg',
                        'label' => __( 'Background', 'masterlayer' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .bg-wrap {{CURRENT_ITEM}}',
                    ]
                ); 

                $repeater->add_control(
                    'heading_url1',
                    [
                        'label'     => __( 'URL 1', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $repeater->add_control(
                    'url1_type',
                    [
                        'label'     => __( 'Type', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'button',
                        'options'   => [
                            'none'          => __( 'None', 'masterlayer'),
                            'button'        => __( 'Button', 'masterlayer'),
                            'link'          => __( 'Link', 'masterlayer'),
                            'video-icon'    => __( 'Video Icon', 'masterlayer'),
                            'html'          => __( 'HTML', 'masterlayer'),
                        ]
                    ]
                );

                $repeater->add_control(
                    'url1_text',
                    [
                        'label'     => __( 'Text', 'masterlayer'),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => __( 'Learn More', 'masterlayer'),
                        'label_block' => false,
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url1',
                    [
                        'label'      => __( 'Url', 'masterlayer'),
                        'type'       => Controls_Manager::URL,
                        'dynamic'    => [
                            'active'        => true,
                            'categories'    => [
                                TagsModule::POST_META_CATEGORY,
                                TagsModule::URL_CATEGORY
                            ],
                        ],
                        'placeholder'       => 'https://www.your-link.com',
                        'default'           => [
                            'url' => '#',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'heading_url2',
                    [
                        'label'     => __( 'URL 2', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $repeater->add_control(
                    'url2_type',
                    [
                        'label'     => __( 'Type', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'          => __( 'None', 'masterlayer'),
                            'button'        => __( 'Button', 'masterlayer'),
                            'link'          => __( 'Link', 'masterlayer'),
                            'video-icon'    => __( 'Video Icon', 'masterlayer'),
                            'html'          => __( 'HTML', 'masterlayer'),
                        ]
                    ]
                );

                $repeater->add_control(
                    'url2_text',
                    [
                        'label'     => __( 'Text', 'masterlayer'),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => __( 'Learn More', 'masterlayer'),
                        'label_block' => false,
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url2',
                    [
                        'label'      => __( 'Url', 'masterlayer'),
                        'type'       => Controls_Manager::URL,
                        'dynamic'    => [
                            'active'        => true,
                            'categories'    => [
                                TagsModule::POST_META_CATEGORY,
                                TagsModule::URL_CATEGORY
                            ],
                        ],
                        'placeholder'       => 'https://www.your-link.com',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->end_controls_tab();

            // Style
                $repeater->start_controls_tab( 
                    'tab_content_style',
                    [
                        'label' => __( 'Style', 'masterlayer' ),
                    ] 
                );

                // General
                $repeater->add_control(
                    'heading_general',
                    [
                        'label' => __( 'General', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                    ]
                );

                $repeater->add_control(
                    'alignmentV',
                    [
                        'label'     => __( 'Vertical Align', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'center',
                        'options'   => [
                            'flex-start'        => __( 'Top', 'masterlayer'),
                            'center'            => __( 'Middle', 'masterlayer'),
                            'flex-end'          => __( 'Bottom', 'masterlayer'),
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide' => 'justify-content: {{VALUE}}',
                        ],
                    ]
                );

                $repeater->add_control(
                    'alignmentH',
                    [
                        'label'     => __( 'Horizontal Align', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'flex-start',
                        'options'   => [
                            'flex-start'        => __( 'Start', 'masterlayer'),
                            'center'            => __( 'Center', 'masterlayer'),
                            'flex-end'          => __( 'End', 'masterlayer'),
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide' => 'align-items: {{VALUE}}',
                        ],
                    ]
                );

                if ( is_rtl() ) {
                    $repeater->add_control(
                        'text_align',
                        [
                            'label'     => __( 'Text Align', 'masterlayer'),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => 'start',
                            'options'   => [
                                'end'       => __( 'Right', 'masterlayer'),
                                'center'      => __( 'Center', 'masterlayer'),
                                'start'        => __( 'Left', 'masterlayer'),
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide' => 'text-align: {{VALUE}}',
                            ],
                        ]
                    );
                } else {
                    $repeater->add_control(
                        'text_align',
                        [
                            'label'     => __( 'Text Align', 'masterlayer'),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => 'left',
                            'options'   => [
                                'left'        => __( 'Left', 'masterlayer'),
                                'center'      => __( 'Center', 'masterlayer'),
                                'right'       => __( 'Right', 'masterlayer'),
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide' => 'text-align: {{VALUE}}',
                            ],
                        ]
                    );
                }

                $repeater->add_responsive_control(
                    'content_margin',
                    [
                        'label' => __( 'Content Margin', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                
                $repeater->add_responsive_control(
                    'content_padding',
                    [
                        'label' => __( 'Content Padding', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                // Sub Title
                    $repeater->add_control(
                        'heading_max_width',
                        [
                            'label' => __( 'Sub Title', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                            'condition' => [ 'sub_title!' => '' ]
                        ]
                    );

                    $repeater->add_responsive_control(
                        'sub_title_mx',
                        [
                            'label'      => __( 'Max Width', 'masterlayer' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                                '%' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .sub-title' => 'max-width: {{SIZE}}{{UNIT}}',
                            ],
                            50,
                            'condition' => [ 'sub_title!' => '' ]
                        ]
                    );

                    $repeater->add_control(
                        'sub_color',
                        [
                            'label' => __( 'Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .sub-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'sub_title!' => '' ]
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'sub_title_typography',
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .sub-title',
                            'condition' => [ 'sub_title!' => '' ]
                        ]
                    );

                    $repeater->add_responsive_control(
                        'sub_title_margin',
                        [
                            'label' => __( 'Margin', 'masterlayer' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 'sub_title!' => '' ]
                        ]
                    );

                // Title
                    $repeater->add_control(
                        'heading_style_title',
                        [
                            'label' => __( 'Title', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                            'condition' => [ 'title!' => '' ]
                        ]
                    );

                    $repeater->add_responsive_control(
                        'title_mx',
                        [
                            'label'      => __( 'Max Width', 'masterlayer' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                                '%' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .title' => 'max-width: {{SIZE}}{{UNIT}}',
                            ],
                            50,
                            'condition' => [ 'title!' => '' ]
                        ]
                    );

                    $repeater->add_control(
                        'title_color',
                        [
                            'label' => __( 'Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'title!' => '' ]
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .title',
                            'condition' => [ 'title!' => '' ]
                        ]
                    );

                    $repeater->add_responsive_control(
                        'title_margin',
                        [
                            'label' => __( 'Margin', 'masterlayer' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 'title!' => '' ]
                        ]
                    );

                // Description
                    $repeater->add_control(
                        'heading_desc',
                        [
                            'label' => __( 'Description', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                            'condition' => [ 'desc!' => '' ]
                        ]
                    );

                    $repeater->add_responsive_control(
                        'desc_mx',
                        [
                            'label'      => __( 'Max Width', 'masterlayer' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                                '%' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => '%',
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .desc' => 'max-width: {{SIZE}}{{UNIT}}',
                            ],
                            50,
                            'condition' => [ 'desc!' => '' ]
                        ]
                    );


                    $repeater->add_control(
                        'desc_color',
                        [
                            'label' => __( 'Description', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .desc' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'desc!' => '' ]
                        ]
                    );
 

                    $repeater->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'desc_typography',
                            'label' => __('Description', 'masterlayer'),
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .desc',
                            'condition' => [ 'desc!' => '' ]
                        ]
                    );

                    $repeater->add_responsive_control(
                        'desc_margin',
                        [
                            'label' => __( 'Description', 'masterlayer' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}.slide .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 'desc!' => '' ]
                        ]
                    );

                    $repeater->end_controls_tab();

            // Url Style
                $repeater->start_controls_tab( 
                    'tab_content_style_url',
                    [
                        'label' => __( 'URL Style', 'masterlayer' ),
                    ] 
                );

                $repeater->add_control(
                    'heading_url1_default',
                    [
                        'label' => __( 'URL 1: Normal', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'url1_typography',
                        'label' => __('Typography', 'masterlayer'),
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1',
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url1_color',
                    [
                        'label' => __( 'Text Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-link,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-video-icon a,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-button .content-base' => 'color: {{VALUE}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url1_bg_color',
                    [
                        'label' => __( 'Background Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'url1_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a',
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_responsive_control(
                    'url1_border_radius',
                    [
                        'label' => __( 'Rounded', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'url1_box_shadow',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a',
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_responsive_control(
                    'url1_padding',
                    [
                        'label' => __( 'Padding', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_responsive_control(
                    'url1_margin',
                    [
                        'label' => __( 'Margin', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'heading_url1_hover',
                    [
                        'label' => __( 'URL 1: Hover', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url1_color_hover',
                    [
                        'label' => __( 'Text Hover Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-link:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-video-icon a:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-button .content-hover' => 'color: {{VALUE}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url1_bg_color_hover',
                    [
                        'label' => __( 'Background Hover Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-link:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-video-icon a:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 .master-button .bg-hover' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'url1_border_hover',
                        'label' => __( 'Border Hover', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1:hover a',
                        'show_label' => true,
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'url1_box_shadow_hover',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url1 a',
                        'condition' => [ 'url1_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'heading_url2_default',
                    [
                        'label' => __( 'URL 2: Normal', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'url2_typography',
                        'label' => __('Typography', 'masterlayer'),
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url2_color',
                    [
                        'label' => __( 'Text Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-link,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-video-icon a,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-button .content-base' => 'color: {{VALUE}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url2_bg_color',
                    [
                        'label' => __( 'Background Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'url2_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_responsive_control(
                    'url2_border_radius',
                    [
                        'label' => __( 'Rounded', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'url2_box_shadow',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_responsive_control(
                    'url2_padding',
                    [
                        'label' => __( 'Padding', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_responsive_control(
                    'url2_margin',
                    [
                        'label' => __( 'Margin', 'masterlayer' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'heading_url2_hover',
                    [
                        'label' => __( 'URL 2: Hover', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                
                $repeater->add_control(
                    'url2_color_hover',
                    [
                        'label' => __( 'Text Hover Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-link:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-video-icon a:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-button .content-hover' => 'color: {{VALUE}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_control(
                    'url2_bg_color_hover',
                    [
                        'label' => __( 'Background Hover Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-link:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-video-icon a:hover,
                            {{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 .master-button .bg-hover' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'url2_border_hover',
                        'label' => __( 'Border Hover', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2:hover a',
                        'show_label' => true,
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'url2_box_shadow_hover',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.slide .url2 a',
                        'condition' => [ 'url2_type!' => 'none' ]
                    ]
                );

                $repeater->end_controls_tab();

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
                        [   
                            'active' => 'no',
                            'title'  => __( 'Slide #2', 'masterlayer' ),
                        ],
                        [   
                            'active' => 'no',
                            'title'  => __( 'Slide #3', 'masterlayer' ),
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

            $this->add_control(
                'accent_color',
                [
                    'label' => __( 'Accent Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-slider' => '--e-global-color-agrios_accent_h1: {{VALUE}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'slider_height',
                [
                    'label'      => __( 'Slider Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vh' ],
                    'range'      => [
                        'px' => [
                            'min' => 300,
                            'max' => 1500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 500,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-slider' => 'min-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'slider_height_offset',
                [
                    'label'      => __( 'Slider Height Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-slider' => 'height: calc(100vh - {{SIZE}}{{UNIT}})',
                    ],
                    50,
                    'condition' => [ 'slider_style' => 'full-screen' ]
                ]
            );

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

            $this->add_control(
                'btn_hover',
                [
                    'label'     => __( 'Button Hover Effect', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'btn-hover-2',
                    'options'   => [
                        'btn-hover-1'      => __( 'Style 1', 'masterlayer'),
                        'btn-hover-2'      => __( 'Style 2', 'masterlayer'),
                    ]
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
                        'hover'         => __( 'Show on Hover', 'masterlayer'),
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
                            'slider_arrow!' => 'no' 
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
                            'slider_arrow!' => 'no'  
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
                        'slider_arrow!' => 'no'  
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
                'slider_arrow_side_offset',
                [
                    'label'     => __( 'Arrows Side Offset', 'masterlayer'),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => -200,
                            'max' => 200,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-slider .arrow.arrow-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .master-slider .arrow.arrow-next' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'slider_arrow_pos' => [ 'cc', 'cfw'] ]
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
                        'slider_arrow!' => 'no' 
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

        // Animation
            $bgEffOut = [
                'none'              => __( 'None', 'masterlayer'),
            ];

            $bgEffIn = [
                'fade'              => __( 'Fade', 'masterlayer'),
                'slide'             => __( 'Slide', 'masterlayer'),
                'slideScale'        => __( 'Slide & Scale', 'masterlayer'),
            ];

            $bgEffOut = array_merge($bgEffOut, $bgEffIn);

            $textEff = [
                'fade'              => __( 'Fade', 'masterlayer'),
                'slide'             => __( 'Slide', 'masterlayer'),
                'textSlide'         => __( 'Text Slide', 'masterlayer'),
            ];

            $urlEff = [
                'fade'              => __( 'Fade', 'masterlayer'),
                'slide'             => __( 'Slide', 'masterlayer'),
                'slideUp'           => __( 'Slide Up', 'masterlayer'),
            ];

            $this->start_controls_section(
                'section__animation',
                [
                    'label' => __( 'Animation', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'kenburns',
                [
                    'label'     => __( 'Ken Burns Effect', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'              => __( 'No', 'masterlayer'),
                        'yes'             => __( 'Yes', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'kenburnsZoom',
                [
                    'label' => __( 'Zoom', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 3,
                    'step' => 0.1,
                    'default' => '1.5',
                    'condition' => [ 'kenburns' => 'yes' ]
                ]
            );

            $this->add_control(
                'kenburnsDuration',
                [
                    'label' => __( 'Zoom Duration', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1000,
                    'max' => 20000,
                    'step' => 100,
                    'default' => 9000,
                    'condition' => [ 'kenburns' => 'yes' ]
                ]
            );

            $this->add_control(
                'slide_animation',
                [
                    'label'     => __( 'Slide Animation', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'slide',
                    'options'   => [
                        'fade'              => __( 'Simple Fade', 'masterlayer'),
                        'slide'             => __( 'Simple Slide', 'masterlayer'),
                        'style-1'           => __( 'Style 1', 'masterlayer'),
                        'style-2'           => __( 'Style 2', 'masterlayer'),
                        'style-3'           => __( 'Style 3', 'masterlayer'),
                        //'custom'            => __( 'Custom', 'masterlayer'),
                    ],
                ]
            );     

            $this->end_controls_section();
        
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $slides = $this->get_settings_for_display( 'slides' );

        // Data config 
        // Predefined animation styles
        if ($settings['slide_animation'] !== 'custom') {
            switch($settings['slide_animation']) {
                case 'fade':
                    $config = [
                        'bgEffIn' => [ 'eff' => 'fade' ],
                        'bgEffOut' => [ 'eff' => 'fade' ],
                        'subEffIn' => [ 'eff' => 'fade' ],
                        'subEffOut' => [ 'eff' => 'fade' ],
                        'titleEffIn' => [ 'eff' => 'fade' ],
                        'titleEffOut' => [ 'eff' => 'fade' ],
                        'descEffIn' => [ 'eff' => 'fade' ],
                        'descEffOut' => [ 'eff' => 'fade' ],
                        'url1EffIn' => [ 'eff' => 'fade' ],
                        'url1EffOut' => [ 'eff' => 'fade' ],
                        'url2EffIn' => [ 'eff' => 'fade' ],
                        'url2EffOut' => [ 'eff' => 'fade' ],
                        'wrapEffIn' => [ 'eff' => 'none' ],
                        'wrapEffOut' => [ 'eff' => 'none' ],
                    ];
                    break;
                case 'style-1':
                    $config = [
                        'bgEffIn' => [ 'eff' => 'reveal' ],
                        'bgEffOut' => [ 'eff' => 'reveal' ],
                        'subEffIn' => [ 'eff' => 'none' ],
                        'subEffOut' => [ 'eff' => 'none' ],
                        'titleEffIn' => [ 'eff' => 'none' ],
                        'titleEffOut' => [ 'eff' => 'none' ],
                        'descEffIn' => [ 'eff' => 'none' ],
                        'descEffOut' => [ 'eff' => 'none' ],
                        'url1EffIn' => [ 'eff' => 'none' ],
                        'url1EffOut' => [ 'eff' => 'none' ],
                        'url2EffIn' => [ 'eff' => 'none' ],
                        'url2EffOut' => [ 'eff' => 'none' ],
                        'wrapEffIn' => [ 'eff' => 'fadeRight',
                            'prop' => [ 'duration' => '0.5', 'delay' => '0.7' ]
                        ],
                        'wrapEffOut' => [ 'eff' => 'fadeRight',
                            'prop' => [ 'duration' => '0.5' ]
                        ],
                    ];
                    break;
                case 'style-4':
                    $config = [
                        'bgEffIn' => [ 'eff' => 'reveal' ],
                        'bgEffOut' => [ 'eff' => 'none' ],
                        'subEffIn' => [ 'eff' => 'textSlide' ],
                        'subEffOut' => [ 'eff' => 'textSlide' ],
                        'titleEffIn' => [ 'eff' => 'textSlide' ],
                        'titleEffOut' => [ 'eff' => 'textSlide' ],
                        'descEffIn' => [ 'eff' => 'fadeUp' ],
                        'descEffOut' => [ 'eff' => 'fadeUp' ],
                        'url1EffIn' => [ 'eff' => 'slideUp' ],
                        'url1EffOut' => [ 'eff' => 'slideUp' ],
                        'url2EffIn' => [ 'eff' => 'slideUp' ],
                        'url2EffOut' => [ 'eff' => 'slideUp' ],
                        'wrapEffIn' => [ 'eff' => 'none' ],
                        'wrapEffOut' => [ 'eff' => 'none' ],
                    ];
                    //wp_enqueue_style('splitting');
                    //wp_enqueue_script('splitting');
                    break;
                case 'style-2':
                    $config = [
                        'bgEffIn' => [ 'eff' => 'zoomOut' ],
                        'bgEffOut' => [ 'eff' => 'zoomOut' ],
                        'wrapEffIn' => [ 'eff' => 'none' ],
                        'wrapEffOut' => [ 'eff' => 'zoomOut',  
                            'prop' => [ 'duration' => '1', 'delay' => '0' ] ],
                        'subEffIn' => [ 'eff' => 'fadeDown',
                            'prop' => [ 'duration' => '0.3', 'delay' => '1.1' ]
                        ],
                        'subEffOut' => [ 'eff' => 'none' ],
                        'titleEffIn' => [ 'eff' => 'fadeRight',
                            'prop' => [ 'duration' => '0.4', 'delay' => '0.7' ]
                        ],
                        'titleEffOut' => [ 'eff' => 'none' ],
                        'descEffIn' => [ 'eff' => 'fadeUp',
                            'prop' => [ 'duration' => '0.3', 'delay' => '1.1' ]
                        ],
                        'descEffOut' => [ 'eff' => 'none' ],
                        'url1EffIn' => [ 'eff' => 'fadeUp',
                            'prop' => [ 'duration' => '0.3', 'delay' => '1.1' ]
                        ],
                        'url1EffOut' => [ 'eff' => 'none' ],
                        'url2EffIn' => [ 'eff' => 'fadeUp',
                            'prop' => [ 'duration' => '0.3', 'delay' => '1.1' ]
                        ],
                        'url2EffOut' => [ 'eff' => 'none' ],
                    ];
                    break;
                case 'style-3':
                    $config = [
                        'bgEffIn' => [ 'eff' => 'vslide' ],
                        'bgEffOut' => [ 'eff' => 'vslide' ],
                        'subEffIn' => [ 'eff' => 'none' ],
                        'subEffOut' => [ 'eff' => 'none' ],
                        'titleEffIn' => [ 'eff' => 'none' ],
                        'titleEffOut' => [ 'eff' => 'none' ],
                        'descEffIn' => [ 'eff' => 'none' ],
                        'descEffOut' => [ 'eff' => 'none' ],
                        'url1EffIn' => [ 'eff' => 'none' ],
                        'url1EffOut' => [ 'eff' => 'none' ],
                        'url2EffIn' => [ 'eff' => 'none' ],
                        'url2EffOut' => [ 'eff' => 'none' ],
                        'wrapEffIn' => [ 'eff' => 'fadeRight',
                            'prop' => [ 'delay' => '1.2' ]
                        ],
                        'wrapEffOut' => [ 'eff' => 'fadeRight' ],
                    ];
                    break;
                default:
                    //default is slide
                    $config = [
                        'bgEffIn' => [ 'eff' => 'slide' ],
                        'bgEffOut' => [ 'eff' => 'slide' ],
                        'subEffIn' => [ 'eff' => 'slide' ],
                        'subEffOut' => [ 'eff' => 'slide' ],
                        'titleEffIn' => [ 'eff' => 'slide' ],
                        'titleEffOut' => [ 'eff' => 'slide' ],
                        'descEffIn' => [ 'eff' => 'slide' ],
                        'descEffOut' => [ 'eff' => 'slide' ],
                        'url1EffIn' => [ 'eff' => 'slide' ],
                        'url1EffOut' => [ 'eff' => 'slide' ],
                        'url2EffIn' => [ 'eff' => 'slide' ],
                        'url2EffOut' => [ 'eff' => 'slide' ],
                        'wrapEffIn' => [ 'eff' => 'none' ],
                        'wrapEffOut' => [ 'eff' => 'none' ],
                    ];
            }
        } 
        
        $config['autoplay'] = $settings['autoplay'];
        $config['autoplaySpeed'] = $settings['autoplaySpeed'];
        $config['kenburns'] = $settings['kenburns'];
        $config['kenburnsZoom'] = $settings['kenburnsZoom'];
        $config['kenburnsDuration'] = $settings['kenburnsDuration'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-slider" <?php echo $data; ?>>
            <div class="bg-wrap">
                <?php 
                $index = 0;
                $foundActive = false;
                foreach( $slides as $slide ) { 
                    $active = '';
                    if ($slide['active'] == 'yes') {
                        if (!$foundActive) {
                            $active = ' active';
                            $foundActive = true;
                        }
                    } 
                    echo '<div class="bg elementor-repeater-item-' . $slide['_id'] . $active . '"></div>';
                    $index++;
                } ?>
            </div>

            <div class="content-wrap">
                <?php 
                $index = 0;
                $foundActive = false;
                foreach( $slides as $slide ) { 
                    $active = '';
                    if ($slide['active'] == 'yes') {
                        if (!$foundActive) {
                            $active = ' active';
                            $foundActive = true;
                        }
                    } 
                    echo '<div class="slide elementor-repeater-item-' . $slide['_id'] . $active . '">';
                    
                        // Sub Title
                        if ( $slide['sub_title'] )
                            echo '<div class="sub-title">' . $slide['sub_title'] . '</div>';

                        // Title
                        if ( $slide['title'] )
                            echo '<h1 class="title">' . $slide['title'] . '</h1>';

                        // Description
                        if ( $slide['desc'] )
                            echo '<div class="desc">' . $slide['desc'] . '</div>';

                        echo '<div class="url-wrap">';
                            // Url 1
                            if ( $slide['url1_type'] !== 'none')
                                if ( $slide['url1']['url'] )
                                    echo $this->render_link($slide['url1'], $slide['url1_text'], 
                                        $slide['url1_type'], 1);

                            // Url 2
                            if ( $slide['url2_type'] !== 'none')
                                if ( $slide['url2']['url'] )
                                    echo $this->render_link($slide['url2'], $slide['url2_text'], 
                                        $slide['url2_type'], 2);

                        echo '</div>';
                    echo '</div>';
                    $index++;
                } ?>
            </div><!-- /.content-wrap -->

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

    public function render_link($url, $text, $type, $number) {
        $settings = $this->get_settings_for_display();
        $html = $url_html = '';
        $url_attr = '';
        if ( $url['is_external'] ) {
            $url_attr .= 'target="_blank" ';
        }

        switch ($type) {
            case 'button':
                $url_html = 
                    '<a class="master-button big ' . $settings['btn_hover'] . '" href="' . esc_url($url['url']) . '" ' . $url_attr . '>' . 
                        '<span class="inner">' .
                            '<span class="content-base">' . $text . '</span>' .
                            '<span class="content-hover">' . $text . '</span>' .
                        '</span>' .
                        '<span class="bg-hover"></span>' .
                    '</a>';
                break;
            case 'video-icon':
                wp_enqueue_script('magnific-popup');
                wp_enqueue_style('magnific-popup');
                $url_html = 
                    '<div class="master-video-icon">' .
                        '<a aria-label="Video" class="popup-video" href="' . esc_url($url['url']) . '" ' . $url_attr . '><i class="ci-play-button"></i>' . $text . 
                        '</a>' .
                    '</div>';
                break;
            case 'link':
                $url_html = '<a class="master-link" href="' . esc_url($url['url']) . '" ' . $url_attr . '>' . $text . '</a>';
            default:
                $url_html = $url['url'];
        }

        
        $html = '<div class="slide-url url' . $number . '">' . $url_html . '</div>';
        return $html;
    }
}

