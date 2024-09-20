<?php
/*
Widget Name: Menu
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Menu_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-menu';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Nav Menu', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-nav-menu';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $arr = array();
            $menus = wp_get_nav_menus();
            foreach ( $menus as $menu ) {
                $arr[$menu->slug] = $menu->name;
            }

            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Nav Menu', 'masterlayer' ),
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
                            ]
                        ],
                        'default' => '',
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
                            ]
                        ],
                        'default' => '',
                        'prefix_class' => 'align-%s'
                    ]
                );
            }

            $this->add_control(
                'menu_name',
                [
                    'label'     => __( 'Select Menu', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '',
                    'options'   => $arr
                ]
            );

            $this->add_responsive_control(
                'menu_height',
                [
                    'label'      => __( 'Menu Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 50,
                            'max' => 400,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .agrios-menu > ul > li > a' => 'line-height: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

            $this->end_controls_section();


        // Style - Color
            $this->start_controls_section(
                'section__style_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'menu_hover_tabs' );
                //Tab - normal
                    $this->start_controls_tab(
                        'normal_panel',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'main_color',
                        [
                            'label' => __( 'Main Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .agrios-menu > ul > li > a > span' => 'color: {{VALUE}};',
                                '{{WRAPPER}}.menu-sep-yes .agrios-menu .menu-item:after' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'sub_color',
                        [
                            'label' => __( 'Sub Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .agrios-menu .sub-menu .menu-item a > span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'line_color',
                        [
                            'label' => __( 'Line Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .agrios-menu > ul > li > a > span:before' => 'background-color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->end_controls_tab();

                //Tab - hover
                    $this->start_controls_tab(
                        'hover_panel',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'hover_main_color',
                        [
                            'label' => __( 'Main Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .agrios-menu > ul > li:hover > a > span,
                                {{WRAPPER}} .agrios-menu > ul > li.current-menu > a > span,
                                {{WRAPPER}} .agrios-menu > ul > li.current-menu-parent > a > span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'hover_sub_color',
                        [
                            'label' => __( 'Sub Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .agrios-menu .sub-menu .menu-item:hover a > span' => 'color: {{VALUE}};',
                            ]
                        ]
                    );

                    $this->add_control(
                        'hover_line_color',
                        [
                            'label' => __( 'Line Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .agrios-menu > ul > li:hover > a > span:before' => 'background-color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();

        // Style - Typography
            $this->start_controls_section(
                'section__style_typography',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'main_nav_typography',
                    'label' => __('Main Menu', 'masterlayer'),
                    'selector' => 
                        '{{WRAPPER}} .agrios-menu > ul > li > a > span, {{WRAPPER}}.menu-sep-yes .agrios-menu .menu-item:after',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sub_nav_typography',
                    'label' => __('Sub Menu', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .agrios-menu .sub-menu .menu-item a > span',
                ]
            );

            $this->end_controls_section();

        // Style - Spacing
            $this->start_controls_section(
                'section__style_spacing',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'menu_item_spacing',
                [
                    'label'      => __( 'Menu Items', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .agrios-menu > ul > li' => 'margin: 0 {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display(); 
        ?>
        <div class="agrios-menu-wrap">
            <nav class="agrios-menu">
                <?php
                if ($settings['menu_name'] !== '') {
                    wp_nav_menu( array(
                        'menu' => $settings['menu_name'],
                        'link_before' => '<span>',
                        'link_after'=>'</span>',
                        'fallback_cb' => false,
                        'container' => false,
                        'menu_id' => 'menu-' . uniqid()
                    ) );
                } ?>
            </nav>
        </div>
        <?php
    }
}

