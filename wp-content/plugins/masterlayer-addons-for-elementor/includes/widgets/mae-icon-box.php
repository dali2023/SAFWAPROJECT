<?php
/*
Widget Name: Icon Box
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
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Icon_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-icon-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Icon Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-icon-box';
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

            // Alignment
                $this->add_control(
                    'align_heading',
                    [
                        'type'    => Controls_Manager::HEADING,
                        'label'   => __( 'General', 'masterlayer' ),
                        'separator' => 'after'
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
                    'sep',
                    [
                        'label'     => __( 'Separator', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'         => __( 'None', 'masterlayer'),
                            'before'       => __( 'Before Title', 'masterlayer'),
                            'after'        => __( 'After Title', 'masterlayer'),
                        ],
                    ]
                );

            // Icon
                $this->add_control(
                    'icon_heading',
                    [
                        'type'    => Controls_Manager::HEADING,
                        'label'   => __( 'Icon', 'masterlayer' ),
                        'separator' => 'after'
                    ]
                );

                if ( is_rtl() ) {
                    $this->add_control(
                        'icon_position',
                        [
                            'label' => __( 'Icon Position', 'masterlayer' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'right' => [
                                    'title' => __( 'Left', 'masterlayer' ),
                                    'icon' => 'eicon-h-align-left',
                                ],
                                'top' => [
                                    'title' => __( 'Top', 'masterlayer' ),
                                    'icon' => 'eicon-v-align-top',
                                ],
                                'left' => [
                                    'title' => __( 'Right', 'masterlayer' ),
                                    'icon' => 'eicon-h-align-right',
                                ],
                                'bottom' => [
                                    'title' => __( 'Bottom', 'masterlayer' ),
                                    'icon' => 'eicon-v-align-bottom',
                                ],
                            ],
                            'default' => 'top',
                            'prefix_class' => 'icon-position-'
                        ]
                    );
                } else {
                    $this->add_control(
                        'icon_position',
                        [
                            'label' => __( 'Icon Position', 'masterlayer' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'masterlayer' ),
                                    'icon' => 'eicon-h-align-left',
                                ],
                                'top' => [
                                    'title' => __( 'Top', 'masterlayer' ),
                                    'icon' => 'eicon-v-align-top',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'masterlayer' ),
                                    'icon' => 'eicon-h-align-right',
                                ]
                            ],
                            'default' => 'top',
                            'prefix_class' => 'icon-position-'
                        ]
                    );
                }
                

                $this->add_responsive_control(
                    'vertical-align',
                    [
                        'label' => __( 'Vertical Alignment', 'masterlayer' ),
                        'type' => Controls_Manager::SELECT,
                        'options'   => [
                            'flex-start'   => __( 'Top', 'masterlayer'),
                            'center'       => __( 'Middle', 'masterlayer'),
                            'flex-end'     => __( 'Bottom', 'masterlayer'),
                        ],
                        'default' => 'flex-start',
                        'condition' => [
                            'icon_position!' => [ 'top', 'bottom' ]
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .master-icon-box .inner' => 'align-items: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'icon_view',
                    [
                        'label'     => __( 'Icon Style', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'has-bg',
                        'options'   => [
                            ''            => __( 'Default', 'masterlayer'),
                            'has-bg'      => __( 'Has background', 'masterlayer'),
                        ],
                        'prefix_class' => 'icon-',
                    ]
                );

                $this->add_control(
                    'box_icon',
                    [
                        'label' => __( 'Icon', 'masterlayer' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'fas fa-star',
                            'library' => 'fa-solid',
                        ],
                    ]
                );

            // Title & Description
                $this->add_control(
                    'title_heading',
                    [
                        'type'    => Controls_Manager::HEADING,
                        'label'   => __( 'Title & Description', 'masterlayer' ),
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'title',
                    [
                        'type'    => Controls_Manager::TEXT,
                        'default' => __( 'Icon Box Title', 'masterlayer' ),
                        'placeholder' => __( 'Enter your title', 'masterlayer' ),
                        'dynamic' => [ 'active' => true, ],
                        'label_block' => true,
                    ]
                );

                $this->add_control(
                    'desc',
                    [
                        'label' => '',
                        'type' => Controls_Manager::TEXTAREA,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'masterlayer' ),
                        'placeholder' => __( 'Enter your description', 'masterlayer' ),
                        'rows' => 10,
                        'show_label' => false,
                    ]
                );

            // URL
                $this->add_control(
                    'url_heading',
                    [
                        'type'    => Controls_Manager::HEADING,
                        'label'   => __( 'URL', 'masterlayer' ),
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'url_type',
                    [
                        'label'     => __( 'URL Type', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'link'      => __( 'Link', 'masterlayer'),
                            'button'    => __( 'Button', 'masterlayer'),
                            'arrow'     => __( 'Arrow', 'masterlayer'),
                        ],
                    ]
                );

                $this->add_control(
                    'url',
                    [
                        'label'      => __( 'URL', 'masterlayer'),
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
                        'condition' => [ 'url_type!' => 'none' ]
                    ]
                );

                $this->add_control(
                    'url_text',
                    [
                        'label'     => __( 'URL Text', 'masterlayer'),
                        'type'      => Controls_Manager::TEXT,
                        'dynamic'   => [
                            'active'   => true,
                        ],
                        'default'   => __( 'Learn More', 'masterlayer'),
                        'condition' => [ 'url_type!' => ['none', 'arrow'] ]
                    ]
                );

                $this->add_control(
                    'link_icon_position',
                    [
                        'label'     => __( 'Has Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'right',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Left', 'masterlayer'),
                            'right'     => __( 'Icon Right', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'link' ]
                    ]
                );

                $this->add_control(
                    'link_icon',
                    [
                        'label' => __( 'Link Icon', 'masterlayer' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'fas fa-arrow-right',
                            'library' => 'solid',
                        ],
                        'label_block'      => false,
                        'skin'             => 'inline',
                        'condition' => [ 
                            'link_icon_position!' => 'none', 
                            'url_type' => 'link',
                        ]
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
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );

                $this->add_control(
                    'button_style',
                    [
                        'label'     => __( 'Button Style', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'btn-accent',
                        'options'   => [
                            'btn-accent'      => __( 'Accent', 'masterlayer'),
                            'btn-white'       => __( 'White', 'masterlayer'),
                            'btn-outline'     => __( 'Outline', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );

                $this->add_control(
                    'button_icon_position',
                    [
                        'label'     => __( 'Has Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'right',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Left', 'masterlayer'),
                            'right'     => __( 'Icon Right', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );

                $this->add_control(
                    'button_icon',
                    [
                        'label' => __( 'Button Icon', 'masterlayer' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'fas fa-arrow-right',
                            'library' => 'solid',
                        ],
                        'label_block'      => false,
                        'skin'             => 'inline',
                        'condition' => [ 
                            'button_icon_position!' => 'none', 
                            'url_type' => 'button',
                        ]
                    ]
                );

                $this->add_control(
                    'arrow_icon',
                    [
                        'label' => __( 'Arrow Icon', 'masterlayer' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'fas fa-arrow-right',
                            'library' => 'solid',
                        ],
                        'label_block'      => false,
                        'skin'             => 'inline',
                        'condition' => [ 
                            'url_type' => 'arrow',
                        ]
                    ]
                );

            $this->end_controls_section();

        // Style - General
            $this->start_controls_section( 'style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'hoverEffect',
                [
                    'label'     => __( 'Hover Effect', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'         => __( 'None', 'masterlayer'),
                        'style-1'      => __( 'Move Up', 'masterlayer'),
                        'style-2'      => __( 'Icon Effect', 'masterlayer'),
                    ],
                    'prefix_class' => 'hover-effect-',
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'title_max_width',
                [
                    'label'      => __( 'Title Max Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 200,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .headline-2' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'desc_max_width',
                [
                    'label'      => __( 'Description Max Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 200,
                            'max' => 1000,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .desc' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'sep_width',
                [
                    'label'      => __( 'Separator Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon-box .sep' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'sep!' => 'none' ]
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label'      => __( 'Icon Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'icon_top_offset',
                [
                    'label'      => __( 'Icon Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .inner .icon-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'icon_position' => ['left', 'right'] ]
                ]
            );

            $this->add_responsive_control(
                'desc_left_offset',
                [
                    'label'      => __( 'Description Left Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .desc' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'icon_position' => ['left'] ]
                ]
            );

            $this->add_responsive_control(
                'desc_right_offset',
                [
                    'label'      => __( 'Description Right Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .desc' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'icon_position' => ['right'] ]
                ]
            );

            $this->add_responsive_control(
                'bg_icon_size',
                [
                    'label'      => __( 'Background Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => ['icon_view' => 'has-bg'],
                    50
                ]
            );

            $this->start_controls_tabs( 'tabs_icon', [ 'condition' => [ 'icon_view' => 'has-bg' ] ] );
                $this->start_controls_tab(
                    'tab_icon_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'icon_rounded',
                    [
                        'label' => __('Border Radius', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} .master-icon-box .master-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                 
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} .master-icon',
                    ]
                );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'tab_icon_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'icon_rounded_hover',
                    [
                        'label' => __('Border Radius', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} .master-icon-box:hover .master-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                     
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} .master-icon-box:hover .master-icon',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();

        // Style - Color & Background
            $this->start_controls_section( 'style_cbg_section',
                [
                    'label' => __( 'Color & Background', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'tabs_cbg' );

                // Normal
                    $this->start_controls_tab(
                        'tab_cbg_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'box_bg',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .master-icon-box .bg, {{WRAPPER}} .master-icon-box .bg-static',
                            'fields_options' => [
                                'background' => [ 'label' => __( 'Box Background', 'masterlayer' ) ],
                                'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                                'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_color',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'icon_bg',
                        [
                            'label' => __( 'Icon Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'icon_view' => 'has-bg' ],
                        ]
                    );  

                    $this->add_control(
                        'title_color',
                        [
                            'label' => __( 'Title Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .headline-2' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'desc_color',
                        [
                            'label' => __( 'Description Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'sep_color',
                        [
                            'label' => __( 'Separator Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .sep' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'sep!' => 'none' ]
                        ]
                    );  

                    $this->end_controls_tab();

                // Hover
                    $this->start_controls_tab(
                        'tab_cbg_hover',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'box_bg_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .master-icon-box .bg-hover',
                            'fields_options' => [
                                'background' => [ 'label' => __( 'Box Background', 'masterlayer' ) ],
                                'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                                'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                            ],
                        ]
                    );

                    $this->add_control(
                        'icon_color_hover',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .master-icon-box.active .master-icon' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'icon_bg_hover',
                        [
                            'label' => __( 'Icon Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon:after' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .master-icon:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'icon_view' => 'has-bg' ],
                        ]
                    ); 

                    $this->add_control(
                        'title_color_hover',
                        [
                            'label' => __( 'Title Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .headline-2' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'desc_color_hover',
                        [
                            'label' => __( 'Description Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .desc' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'sep_color_hover',
                        [
                            'label' => __( 'Separator Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .sep' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'sep!' => 'none' ]
                        ]
                    );

                    $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Border & Shadow
            $this->start_controls_section( 'bs_style_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'box1' );

                // Normal
                    $this->start_controls_tab(
                        'box1_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border',
                            'label' => __( 'Border', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-icon-box .bg, {{WRAPPER}} .master-icon-box .bg-static',
                        ]
                    );

                    $this->add_control(
                        'border_radius',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_shadow',
                            'label' => __('Icon Shadow', 'masterlayer'),
                            'selector' => '{{WRAPPER}} .master-icon-box .master-icon',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'selector' => '{{WRAPPER}} .master-icon-box',
                        ]
                    );

                    $this->end_controls_tab();

                // Hover
                    $this->start_controls_tab(
                        'box1_hover',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border_hover',
                            'label' => __( 'Border', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-icon-box:hover .bg, {{WRAPPER}} .master-icon-box:hover .bg-static',
                        ]
                    );

                    $this->add_control(
                        'border_radius_hover',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'icon_shadow_hover',
                            'label' => __('Icon Shadow', 'masterlayer'),
                            'selector' => '{{WRAPPER}} .master-icon-box:hover .master-icon',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow_hover',
                            'selector' => '{{WRAPPER}} .master-icon-box:hover',
                        ]
                    );

                    $this->end_controls_tab();
                $this->end_controls_tabs();
            $this->end_controls_section();

        // Style - Spacing
            $this->start_controls_section( 'style_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'icon_space',
                    [
                        'label' => __( 'Icon', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'selectors' => [
                            '{{WRAPPER}}.icon-position-top .icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}}.icon-position-left .icon-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}}.icon-position-right .icon-wrap' => 'margin-right: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}}.icon-position-bottom .icon-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                            '(mobile){{WRAPPER}}.icon-position-right .icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'icon_space',
                    [
                        'label' => __( 'Icon', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'selectors' => [
                            '{{WRAPPER}}.icon-position-top .icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}}.icon-position-left .icon-wrap' => 'margin-right: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}}.icon-position-right .icon-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}}.icon-position-bottom .icon-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
                            '(mobile){{WRAPPER}}.icon-position-right .icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            }
            
            $this->add_responsive_control(
                'title_space',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'desc_space',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sep_space',
                [
                    'label' => __( 'Separator', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'size' => 30,
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sep' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'sep!' => 'none' ]
                ]
            );

            $this->end_controls_section();

        // Style - Typography
            $this->start_controls_section( 'style_typo_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'headline_typography',
                    'label' => __('Title', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .headline-2'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'link_typography',
                    'label' => __('Link', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-link',
                    'condition' => [ 'url_type' => 'link' ]
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => __('Button', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ],
            );

            $this->end_controls_section();

        // URL
                $this->start_controls_section( 'style_url_section',
                    [
                        'label' => __( 'URL', 'masterlayer' ),
                        'tab' => Controls_Manager::TAB_STYLE,
                        'condition' => [ 'url_type!' => 'none' ]
                    ]
                );

                // URL - Link
                    $this->add_responsive_control(
                        'link_icon_font_size',
                        [
                            'label'      => __( 'Icon Font Size', 'masterlayer' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min' => 10,
                                    'max' => 50,
                                ],
                                '%' => [
                                    'min' => 50,
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 16,
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                            50,
                            'condition' => [ 
                                'link_icon_position!' => 'none', 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->add_control(
                        'link_icon_margin',
                        [
                            'label' => __('Icon Margin', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'link_icon_position!' => 'none', 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->start_controls_tabs( 'link_hover_tabs' );

                // Link normal
                    $this->start_controls_tab(
                        'link_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'link' ]
                        ]
                    );

                    $this->add_control(
                        'link_color',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-link' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->add_control(
                        'link_icon_color',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'link_icon_position!' => 'none', 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->end_controls_tab();

                // Box hover
                    $this->start_controls_tab(
                        'link_box_hover',
                        [
                            'label' => __( 'Box Hover', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'link' ]
                        ]
                    );

                    $this->add_control(
                        'link_color_box_hover',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-link' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .master-icon-box.active .master-link' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->add_control(
                        'link_icon_color_box_hover',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-link .icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .master-icon-box.active .master-link .icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'link_icon_position!' => 'none', 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->end_controls_tab();

                // Link hover
                    $this->start_controls_tab(
                        'link_hover',
                        [
                            'label' => __( 'URL Hover', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'link' ]
                        ]
                    );

                    $this->add_control(
                        'link_color_hover',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                            ],
                            'condition' => [ 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->add_control(
                        'link_icon_color_hover',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                            ],
                            'condition' => [ 
                                'link_icon_position!' => 'none', 
                                'url_type' => 'link',
                            ]
                        ]
                    );

                    $this->end_controls_tab();

                $this->end_controls_tabs();

                // URL - Button     
                    $this->add_responsive_control(
                        'button_icon_font_size',
                        [
                            'label'      => __( 'Icon Font Size', 'masterlayer' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min' => 10,
                                    'max' => 50,
                                ],
                                '%' => [
                                    'min' => 50,
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 16,
                            ],
                            'selectors'  => [
                                '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                            ],
                            50,
                            'condition' => [ 
                                'button_icon_position!' => 'none', 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_icon_margin',
                        [
                            'label' => __('Icon Margin', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px'],
                            'selectors' => [
                                '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'button_icon_position!' => 'none', 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->start_controls_tabs( 'button_hover_tabs' );

                // Button normal
                    $this->start_controls_tab(
                        'button_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );

                    $this->add_control(
                        'button_color',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-button' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_icon_color',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'button_icon_position!' => 'none', 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_bg_color',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_rounded',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_color',
                        [
                            'label' => __( 'Border Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                                'button_style' => [ 'btn-outline' ]
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_width',
                        [
                            'label' => __('Border Width', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                                'button_style' => [ 'btn-outline' ]
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow',
                            'selector' => '{{WRAPPER}} .master-button',
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );

                    $this->end_controls_tab();

                // Box hover
                    $this->start_controls_tab(
                        'button_box_hover',
                        [
                            'label' => __( 'Box Hover', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );

                    $this->add_control(
                        'button_color_box_hover',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-button' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_icon_color_box_hover',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-button .icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'button_icon_position!' => 'none', 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_bg_color_box_hover',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-button' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_rounded_box_hover',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_color_box_hover',
                        [
                            'label' => __( 'Border Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-button' => 'border-color: {{VALUE}};'
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                                'button_style' => [ 'btn-outline' ]
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_width_box_hover',
                        [
                            'label' => __('Border Width', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                                'button_style' => [ 'btn-outline' ]
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow_box_hover',
                            'selector' => '{{WRAPPER}} .master-icon-box:hover .master-button',
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );

                    $this->end_controls_tab();

                // Button hover
                    $this->start_controls_tab(
                        'button_hover',
                        [
                            'label' => __( 'URL Hover', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );

                    $this->add_control(
                        'button_color_hover',
                        [
                            'label' => __( 'Text Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-button:hover' => 'color: {{VALUE}} !important;',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_icon_color_hover',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                            ],
                            'condition' => [ 
                                'button_icon_position!' => 'none', 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_bg_color_hover',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .master-button:hover' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_rounded_hover',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_color_hover',
                        [
                            'label' => __( 'Border Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .master-button:hover' => 'border-color: {{VALUE}};'
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                                'button_style' => [ 'btn-outline' ]
                            ]
                        ]
                    );

                    $this->add_control(
                        'button_border_width_hover',
                        [
                            'label' => __('Border Width', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [ 
                                'url_type' => 'button',
                                'button_style' => [ 'btn-outline' ]
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow_hover',
                            'selector' => '{{WRAPPER}} .master-icon-box .master-button:hover',
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );

                    $this->end_controls_tab();

                $this->end_controls_tabs();

                $this->add_responsive_control(
                    'arrow_size',
                    [
                        'label' => __( 'Arrow Icon Size', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .url-wrap .master-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [ 'url_type' => 'arrow' ]
                    ]
                );

                $this->add_responsive_control(
                    'arrow_bg_size',
                    [
                        'label' => __( 'Arrow Size', 'masterlayer' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .url-wrap .master-arrow' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [ 'url_type' => 'arrow' ]
                    ]
                );

                $this->start_controls_tabs( 'arrow_hover_tabs' );

                // Arrow normal
                    $this->start_controls_tab(
                        'arrow_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->add_control(
                        'arrow_icon_color',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .url-wrap .master-arrow' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->add_control(
                        'arrow_bg_color',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .url-wrap .master-arrow' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->end_controls_tab();

                // Arrow box hover
                    $this->start_controls_tab(
                        'arrow_normal_box',
                        [
                            'label' => __( 'Box Hover', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->add_control(
                        'arrow_icon_color_box',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .url-wrap .master-arrow' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .master-icon-box.active .url-wrap .master-arrow' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->add_control(
                        'arrow_bg_color_box',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box:hover .url-wrap .master-arrow' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .master-icon-box.active .url-wrap .master-arrow' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->end_controls_tab();

                // Arrow hover
                    $this->start_controls_tab(
                        'arrow_normal_hover',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->add_control(
                        'arrow_icon_color_hover',
                        [
                            'label' => __( 'Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .url-wrap .master-arrow:hover' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->add_control(
                        'arrow_bg_color_hover',
                        [
                            'label' => __( 'Background Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .master-icon-box .url-wrap .master-arrow:hover' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'url_type' => 'arrow' ]
                        ]
                    );

                    $this->end_controls_tab();
                $this->end_controls_tabs();

                $this->end_controls_section();

        // Decoration
        $this->start_controls_section(
            'section__decor',
            [
                'label' => __( 'Decoration', 'masterlayer' )
            ]
        );

        $rd = new Repeater();

        $rd->start_controls_tabs( 'tab_decor' );
        $rd->start_controls_tab( 
            'tab_content',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ] 
        );

        $rd->add_control(
            'decor_title', [
                'label' => esc_html__( 'Title', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Decoration Item #01' , 'masterlayer' ),
                'label_block' => true,
            ]
        );

        $rd->add_control(
            'decor_type',
            [
                'label' => __( 'Item Type', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none'    => [
                        'title' => __( 'None', 'masterlayer' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'masterlayer' ),
                        'icon' => 'eicon-image',
                    ],
                    'icon' => [
                        'title' => __( 'Icon', 'masterlayer' ),
                        'icon' => 'eicon-favorite',
                    ],
                    'html' => [
                        'title' => __( 'HTML', 'masterlayer' ),
                        'icon' => 'eicon-editor-code',
                    ],
                ],
                'default' => 'none'
            ]
        );

        $rd->add_control(
            'decor_image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_image_rounded',
            [
                'label' => __('Image Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_icon',
            [
                'label' => __( 'Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
                'condition' => [ 'decor_type' => 'icon' ]
            ]
        );

        $rd->add_responsive_control(
            'decor_icon_size',
            [
                'label'      => __( 'Icon Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_type' => 'icon' ]
            ]
        );

        $rd->add_control(
            'decor_icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                ],
                'condition' => [ 'decor_type' => 'icon' ]
            ]
        );

        $rd->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'decor_image_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_html',
            [
                'label' => __( 'HTML', 'masterlayer' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your HTML', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'decor_type' => 'html' ]
            ]
        );

        $rd->end_controls_tab();

        $rd->start_controls_tab( 
            'tab_style',
            [
                'label' => __( 'Style', 'masterlayer' ),
            ] 
        );

        $rd->add_control(
            'decor_width',
            [
                'label' => __( 'Width', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [ 
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );


        $rd->add_responsive_control(
            'decor_visibility',
            [
                'label'     => __( 'Visibility', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'visible',
                'options'   => [
                    'visible' =>  __( 'Visible', 'masterlayer'),
                    'hidden' =>  __( 'Hidden', 'masterlayer'),
                ],
                'selectors' => [
                    '{{CURRENT_ITEM}}.master-decor' => 'visibility: {{VALUE}};',
                ],
            ]
        );

        $rd->add_control(
            'decor_index',
            [
                'label' => __( 'Z-index', 'masterlayer' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -10,
                'max' => 100,
                'step' => 1,
                'selectors'  => ['{{CURRENT_ITEM}}.master-decor' => 'z-index: {{VALUE}}',
                ],
            ]
        ); 

        $rd->add_responsive_control(
            'decor_align',
            [
                'label' => __( 'Horizontal Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterlayer' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterlayer' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $rd->add_responsive_control(
            'decor_left_offset',
            [
                'label'      => __( 'Left Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'left: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_align' => 'left', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_right_offset',
            [
                'label'      => __( 'Right Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                ],
                50,
                'condition' => [ 'decor_align' => 'right', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_valign',
            [
                'label' => __( 'Vertical Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'masterlayer' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'masterlayer' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top'
            ]
        );

        $rd->add_responsive_control(
            'decor_top_offset',
            [
                'label'      => __( 'Top Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'top: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_valign' => 'top', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_bottom_offset',
            [
                'label'      => __( 'Bottom Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_valign' => 'bottom', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_control(
            'decor_class',
            [
                'label' => __( 'CSS Classes', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $rd->end_controls_tab();
        $rd->end_controls_tabs();

        $this->add_control(
            'decors',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $rd->get_controls(),
                'default'     => [
                    [
                        'decor_title'  => __( 'Decoration Item #01', 'masterlayer' )
                    ]
                ],
                'title_field' => '{{{ decor_title }}}'
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $config = array();
        $cls = $css = $data = $title = $desc = $url = "";
        $settings = $this->get_settings_for_display();

        ?>
        <?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo $this->render_decor(); ?>
        <div class="master-icon-box" <?php echo $data; ?>>
            <?php
            $cls = $html = $title = $content = $sep = $image_url = $icon = $url = "";
            
            // Title
            if ($settings['title'])
                $title = sprintf('<h3 class="headline-2">%1$s</h3>', 
                    $settings['title'] );

            // Description
            if ($settings['desc'])
                $desc = sprintf('<div class="desc">%1$s</div>', 
                    $settings['desc'] );

            //Separator
            if ($settings['sep'] !== 'none')
                $sep = '<div class="sep"></div>';

            // Icon
            if ($settings['box_icon']) {
                $icon = sprintf('<div class="icon-wrap"><div class="master-icon"><i class="%1$s"></i></div></div>', 
                    esc_attr( $settings['box_icon']['value'] ) );
            }

            if ($settings['hoverEffect'] == 'style-2')
                $icon = sprintf('<div class="icon-wrap"><div class="inner"><span class="line line1"></span><span class="line line2"></span><div class="master-icon"><i class="%1$s"></i></div></div></div>', 
                    esc_attr( $settings['box_icon']['value'] ) );

            // URL
            if ($settings['url_type'] != 'none')
                 $url = $this->render_link( $settings['url']['url'], $settings['url_text'], 
                    $settings['url']);
        
            // HTML render
            ?>
            
            <div class="inner">
                <?php echo $icon; ?>

                <div class="text-wrap">
                    <?php
                    
                    if ($settings['sep'] == 'before') echo $sep;
                    echo $title;
                    if ($settings['sep'] == 'after') echo $sep;
                    echo $desc;
                    echo $url;
                    ?>
                </div>
            </div>

            <?php 
                if ( $settings['box_bg_hover_background'] ) {
                    echo '<div class="bg"></div><div class="bg-hover"></div>'; 
                } else {
                    echo '<div class="bg-static"></div>'; 
                }
            ?>
        </div>
        <?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo '</div>';

    }

    protected function render_link( $url, $text, $attr ) {
        $link = $this->get_settings_for_display();
        $url_attr = "";
        if ( $attr["is_external"] ) {
            $url_attr .= "target=_blank ";
        }

        if ( ! empty( $attr["nofollow"] ) ) {
            $url_attr .= "rel=nofollow ";
        }
        $return = "";

        if ($link['url_type'] == 'link') {
            $cls = "";
            $cls .= ' icon-' . $link['link_icon_position'];
            

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($url_attr); ?>>
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'] . ' ' . $button['btn_hover'];

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button btn-hover-2 small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($url_attr); ?>>
                    <span class="inner">
                        <span class="content-base">
                            <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                            <span class="text"><?php echo $text; ?></span>
                            <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                        </span>

                        <span class="content-hover">
                            <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                            <span class="text"><?php echo $text; ?></span>
                            <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                        </span>
                    </span>

                    <?php echo '<span class="bg-hover"></span>'; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
        } else if ($link['url_type'] == 'arrow') {
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-arrow" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($url_attr); ?>>
                    <?php Icons_Manager::render_icon( $link['arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
            </div>
            <?php $return = ob_get_clean();
        }

        return $return;
    }

    public function render_decor() {
        $settings = $this->get_settings_for_display( 'decors' );

        ob_start(); ?>
        <div class="master-wrap">
            <?php foreach ($settings as $item) {
                $cls = 'elementor-repeater-item-' . $item['_id'] . ' ' . $item['decor_class'];

                if ( $item['decor_type'] == 'image' ) { ?>
                    <div class="master-decor image <?php echo $cls; ?>">
                        <?php echo wp_get_attachment_image( $item['decor_image']['id'], 'full' ); ?>
                    </div>
                <?php }

                if ( $item['decor_type'] == 'html' ) { ?>
                    <div class="master-decor html <?php echo $cls; ?>">
                        <?php echo $item['decor_html']; ?>
                    </div>
                <?php }

                if ( $item['decor_type'] == 'icon' ) { ?>
                    <div class="master-decor icon <?php echo $cls; ?>">
                        <span class="icon <?php echo $item['decor_icon']['value']; ?>"></span>
                    </div>
                <?php }
            }

        $return = ob_get_clean();
        return $return;
    }
}

