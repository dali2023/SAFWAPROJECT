<?php
/*
Widget Name: Price Box
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
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
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Price_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-price-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Price Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-price-table';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

        // Content
    		$this->start_controls_section(
    			'section__content',
    			[
    				'label' => __( 'Content', 'masterlayer' ),
    			]
    		);

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'heading_align',
                    [
                        'label' => __( 'Heading Alignment', 'masterlayer' ),
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
                        'selectors'  => [
                            '{{WRAPPER}} .master-price-box .heading-wrap' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'heading_align',
                    [
                        'label' => __( 'Heading Alignment', 'masterlayer' ),
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
                        'selectors'  => [
                            '{{WRAPPER}} .master-price-box .heading-wrap' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );
            }

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'content_align',
                    [
                        'label' => __( 'Content Alignment', 'masterlayer' ),
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
                        'selectors'  => [
                            '{{WRAPPER}} .master-price-box .content-wrap' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'content_align',
                    [
                        'label' => __( 'Content Alignment', 'masterlayer' ),
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
                        'selectors'  => [
                            '{{WRAPPER}} .master-price-box .content-wrap' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );
            }

            $this->start_controls_tabs( 'box_content_tabs' );

            // Content
                $this->start_controls_tab(
                    'box_content',
                    [
                        'label' => __( 'Content', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'extra_text',
                    [
                        'label'     => __( 'Extra Text', 'masterlayer'),
                        'type'      => Controls_Manager::TEXT,
                    ]
                );  

        		$this->add_control(
                    'price',
                    [
                        'label'     => __( 'Price', 'masterlayer'),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => __( '$100', 'masterlayer'),
                    ]
                );	

                $this->add_control(
                    'plan',
                    [
                        'label'     => __( 'Plan', 'masterlayer'),
                        'type'      => Controls_Manager::TEXT,
                        'default'   => __( 'Basic Plan', 'masterlayer'),
                    ]
                );	

                $this->add_control(
                    'desc',
                    [
                        'label'      => __( 'Description', 'masterlayer' ),
                        'type'       => Controls_Manager::TEXTAREA,
                        'rows'       => 10,
                        'default'    => __( 
                            '<div class="featured-list">
                            <div class="item">
                                <span class="icon fas fa-check"></span>
                                <span>Extra features</span>
                            </div>
                            <div class="item">
                                <span class="icon fas fa-check"></span>
                                <span>Lifetime free support</span>
                            </div>
                            <div class="item">
                                <span class="icon fas fa-check"></span>
                                <span>Upgrate options</span>
                            </div>
                            <div class="item">
                                <span class="icon fas fa-check"></span>
                                <span>Full access</span>
                            </div></div>', 'masterlayer' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ]
                );

                $this->end_controls_tab();

            // URL
                $this->start_controls_tab(
                    'box_url',
                    [
                        'label' => __( 'URL', 'masterlayer' ),
                    ]
                );  

                $this->add_control(
                    'url_heading',
                    [
                        'label' => __( 'URL', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
                    'url_type',
                    [
                        'label'     => __( 'URL Type', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'button',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'link'      => __( 'Link', 'masterlayer'),
                            'button'    => __( 'Button', 'masterlayer'),
                        ],
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
                        'default'   => __( 'Read More', 'masterlayer'),
                        'condition' => [ 'url_type!' => [ 'none', '' ] ]
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

                if ( is_rtl() ) {
                    $this->add_control(
                        'link_icon_position',
                        [
                            'label'     => __( 'Has Icon ?', 'masterlayer'),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => 'right',
                            'options'   => [
                                'none'      => __( 'None', 'masterlayer'),
                                'left'      => __( 'Icon Right', 'masterlayer'),
                                'right'     => __( 'Icon Left', 'masterlayer')
                            ],
                            'condition' => [ 'url_type' => 'link' ]
                        ]
                    );
                } else {
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
                }
                

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

                // Button
                $this->add_control(
                    'button_style',
                    [
                        'label'     => __( 'Button Style', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'btn-accent',
                        'options'   => [
                            'btn-accent'      => __( 'Accent', 'masterlayer'),
                            'btn-light'       => __( 'Light', 'masterlayer'),
                            'btn-dark'     => __( 'Dark', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );

                $this->add_control(
                    'button_size',
                    [
                        'label'     => __( 'Button Size', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'big',
                        'options'   => [
                            'big'      => __( 'Big', 'masterlayer'),
                            'medium'       => __( 'Medium', 'masterlayer'),
                            'small'     => __( 'Small', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );

                if ( is_rtl() ) {
                    $this->add_control(
                        'button_icon_position',
                        [
                            'label'     => __( 'Has Icon ?', 'masterlayer'),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => 'none',
                            'options'   => [
                                'none'      => __( 'None', 'masterlayer'),
                                'left'      => __( 'Icon Right', 'masterlayer'),
                                'right'     => __( 'Icon Left', 'masterlayer')
                            ],
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );
                } else {
                    $this->add_control(
                        'button_icon_position',
                        [
                            'label'     => __( 'Has Icon ?', 'masterlayer'),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => 'none',
                            'options'   => [
                                'none'      => __( 'None', 'masterlayer'),
                                'left'      => __( 'Icon Left', 'masterlayer'),
                                'right'     => __( 'Icon Right', 'masterlayer')
                            ],
                            'condition' => [ 'url_type' => 'button' ]
                        ]
                    );
                }

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

                $this->end_controls_tab();
            $this->end_controls_tabs();
        	$this->end_controls_section();

        // Style - Color
            $this->start_controls_section( 'setting_service_section',
                [
                    'label' => __( 'Color & Background', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'box' );

            $this->start_controls_tab(
                'box_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'heading_bg',
                [
                    'label' => __( 'Heading Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .heading-wrap' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'content_bg',
                [
                    'label' => __( 'Content Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'extrar_color',
                [
                    'label' => __( 'Extra Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .extra-text' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'price_color',
                [
                    'label' => __( 'Price Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .price' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'plan_color',
                [
                    'label' => __( 'Plan Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .plan' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'desc_color',
                [
                    'label' => __( 'Description Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .desc' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'service_box_hover',
                [
                    'label' => __( 'Hover', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'heading_bg_hover',
                [
                    'label' => __( 'Heading Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box .heading-wrap' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'content_bg_hover',
                [
                    'label' => __( 'Content Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'extra_color_hover',
                [
                    'label' => __( 'Extra Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box .extra-text' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'price_color_hover',
                [
                    'label' => __( 'Price Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box .price' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'plan_color_hover',
                [
                    'label' => __( 'Plan Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box .plan' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'desc_color_hover',
                [
                    'label' => __( 'Description Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box .desc' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Style - Border & Shadow
            $this->start_controls_section( 'style_border_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'box_bs' );

            $this->start_controls_tab(
                'box_normal_bs',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'box_border',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-price-box',
                ]
            );

            $this->add_control(
                'box_rounded',
                [
                    'label' => __('Border Radius', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selector' => '{{WRAPPER}} .master-price-box',
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'service_box_hover_bs',
                [
                    'label' => __( 'Hover', 'masterlayer' ),
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'box_border_hover',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-price-box:hover',
                ]
            );

            $this->add_control(
                'box_rounded_hover',
                [
                    'label' => __('Border Radius', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-price-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow_hover',
                    'selector' => '{{WRAPPER}} .master-price-box:hover',
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

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
                        '{{WRAPPER}}:hover .master-price-box .master-link' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}}:hover .master-price-box .master-link .icon' => 'color: {{VALUE}};',
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
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
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
                        '{{WRAPPER}}:hover .master-price-box .master-button' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}}:hover .master-price-box .master-button .icon' => 'color: {{VALUE}};',
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
                        '{{WRAPPER}}:hover .master-price-box .master-button' => 'background-color: {{VALUE}};',
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
                        '{{WRAPPER}}:hover .master-price-box .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}}:hover .master-price-box .master-button' => 'border-color: {{VALUE}};'
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
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}}:hover .master-price-box .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'selector' => '{{WRAPPER}}:hover .master-price-box .master-button',
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
                        '{{WRAPPER}} .master-button .content-hover' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .master-button .content-hover .icon' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .master-price-box .master-button .bg-hover' => 'background-color: {{VALUE}}',
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
                        '{{WRAPPER}} .master-price-box .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-price-box .master-button:hover' => 'border-color: {{VALUE}};'
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
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'selector' => '{{WRAPPER}} .master-price-box .master-button:hover',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'heading_padding',
                [
                    'label' => __('Heading Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .heading-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-price-box .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'extra_spacing',
                [
                    'label'      => __( 'Extra Text Bottom Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 150,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-price-box .extra-text ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'plan_spacing',
                [
                    'label'      => __( 'Plan Bottom Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 150,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-price-box .plan ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'price_spacing',
                [
                    'label'      => __( 'Price Bottom Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 150,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-price-box .price ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'desc_spacing',
                [
                    'label'      => __( 'Description Bottom Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 150,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-price-box .desc ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50,
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
                    'name' => 'extra_typography',
                    'label' => __('Extra Text', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-price-box .extra-text'
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'label' => __('Price', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-price-box .price'
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'plan_typography',
                    'label' => __('Plan', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-price-box .plan'
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-price-box .desc'
                ],
            );

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
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'z-index: {{VALUE}}',
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
		$settings = $this->get_settings_for_display();
        $price = $plan = $desc = $url = '';

        // URL
        if ($settings['url_type'] != 'none')
            $url = $this->render_link( $settings['url'], $settings['url_text']);
		?>
        <?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo $this->render_decor(); ?>
		<div class="master-price-box">
            <div class="heading-wrap">
                <div class="extra-text"><?php echo $settings['extra_text']; ?></div>
                <div class="price"><?php echo $settings['price']; ?></div>
                <h2 class="plan headline-2"><?php echo $settings['plan']; ?></h2>
            </div>

            <div class="content-wrap">
			 <div class="desc"><?php echo $settings['desc']; ?></div>

                <?php echo $url; ?>
            </div>
	    </div>
        <?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo '</div>';
	}

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = $url_attr = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            if ( $url['is_external'] ) {
                $url_attr .= 'target="_blank" ';
            }

            if ( ! empty( $url['nofollow'] ) ) {
                $url_attr .= 'rel="nofollow" ';
            }

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url['url']); ?>" <?php echo esc_attr($url_attr); ?>>
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = $url_attr = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'] . ' ' . $button['button_size'];

            if ( $url['is_external'] ) {
                $url_attr .= 'target="_blank" ';
            }

            if ( ! empty( $url['nofollow'] ) ) {
                $url_attr .= 'rel="nofollow" ';
            }

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button btn-hover-2 <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url['url']); ?>" <?php echo esc_attr($url_attr); ?>>
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
            return $return;
        }
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

