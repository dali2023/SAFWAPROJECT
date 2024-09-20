<?php
/*
Widget Name: Team Carousel
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

class MAE_Team_Carousel_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'flickity', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'flickity' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-team-carousel';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Team Carousel', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-carousel';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' )
                ]
            );

            $repeater = new Repeater();

            $repeater->start_controls_tabs( 'tabs_team' );
                // Avatar
                $repeater->start_controls_tab( 'tab_team_image',[ 'label' => __( 'Avatar', 'masterlayer' ) ] );

                $repeater->add_control(
                    'avatar',
                    [
                        'label'   => __( 'Avatar', 'masterlayer' ),
                        'type'    => Controls_Manager::MEDIA,
                        'default' => [ 
                            'url' => Utils::get_placeholder_image_src() 
                            ]
                        ]
                    );

                $repeater->end_controls_tab();

                // Content
                    $repeater->start_controls_tab( 'tab_team_content', ['label' => __( 'Content', 'masterlayer' ) ] );

                    $repeater->add_control(
                        'name',
                        [
                            'label'   => __( 'Member Name', 'masterlayer' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => __( 'New Member', 'masterlayer' ),
                            'dynamic' => [
                                'active' => true
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'role',
                        [
                            'label'   => __( 'Member Role', 'masterlayer' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => __( 'Manager', 'masterlayer' ),
                            'dynamic' => [
                                'active' => true
                            ]
                        ]
                    );

                    $repeater->add_control(
                        'url',
                        [
                            'label'      => __( 'Bio URL', 'masterlayer'),
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
                            ]
                        ]
                    );

                    // $repeater->add_control(
                    //     'desc',
                    //     [
                    //         'label'      => __( 'Description', 'masterlayer' ),
                    //         'type'       => Controls_Manager::WYSIWYG,
                    //         'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                    //         'dynamic' => [
                    //             'active' => true,
                    //         ]
                    //     ]
                    // );

                    $repeater->end_controls_tab();
            
                // Socials
                    $repeater->start_controls_tab( 'tab_team_socials', ['label' => __( 'Socials', 'masterlayer' ) ] );

                    $repeater->add_control(
                        'socials_heading1',
                        [
                            'label'     => __( 'Social 1', 'masterlayer'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after'
                        ]
                    );

                    $repeater->add_control(
                        'social_icon1',
                        [
                            'label' => __( 'Icon', 'masterlayer' ),
                            'type' => Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'ci-twitter',
                                'library' => 'core',
                            ],
                            'label_block'      => false,
                            'skin'             => 'inline',
                        ]
                    );

                    $repeater->add_control(
                        'social_url1',
                        [
                            'label'      => __( 'URL', 'masterlayer'),
                            'type'       => Controls_Manager::URL,
                            'dynamic'    => [ 'active'        => true, ],
                            'placeholder'       => 'https://www.your-link.com',
                            'default'           => [ 'url' => '#', ],
                            'label_block'      => false,
                        ]
                    );

                    $repeater->add_control(
                        'socials_heading2',
                        [
                            'label'     => __( 'Social 2', 'masterlayer'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after'
                        ]
                    );

                    $repeater->add_control(
                        'social_icon2',
                        [
                            'label' => __( 'Icon', 'masterlayer' ),
                            'type' => Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'ci-facebook-square',
                                'library' => 'core',
                            ],
                            'label_block'      => false,
                            'skin'             => 'inline',
                        ]
                    );

                    $repeater->add_control(
                        'social_url2',
                        [
                            'label'      => __( 'URL', 'masterlayer'),
                            'type'       => Controls_Manager::URL,
                            'dynamic'    => [ 'active'        => true, ],
                            'placeholder'       => 'https://www.your-link.com',
                            'default'           => [ 'url' => '#', ],
                            'label_block'      => false,
                        ]
                    );

                    $repeater->add_control(
                        'socials_heading3',
                        [
                            'label'     => __( 'Social 3', 'masterlayer'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after'
                        ]
                    );

                    $repeater->add_control(
                        'social_icon3',
                        [
                            'label' => __( 'Icon', 'masterlayer' ),
                            'type' => Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'ci-pinterest',
                                'library' => 'core',
                            ],
                            'label_block'      => false,
                            'skin'             => 'inline',
                        ]
                    );

                    $repeater->add_control(
                        'social_url3',
                        [
                            'label'      => __( 'URL', 'masterlayer'),
                            'type'       => Controls_Manager::URL,
                            'dynamic'    => [ 'active'        => true, ],
                            'placeholder'       => 'https://www.your-link.com',
                            'default'           => [ 'url' => '#', ],
                            'label_block'      => false,
                        ]
                    );

                    $repeater->add_control(
                        'socials_heading4',
                        [
                            'label'     => __( 'Social 4', 'masterlayer'),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after'
                        ]
                    );

                    $repeater->add_control(
                        'social_icon4',
                        [
                            'label' => __( 'Icon', 'masterlayer' ),
                            'type' => Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'default' => [
                                'value' => 'ci-instagram',
                                'library' => 'core',
                            ],
                            'label_block'      => false,
                            'skin'             => 'inline',
                        ]
                    );

                    $repeater->add_control(
                        'social_url4',
                        [
                            'label'      => __( 'URL', 'masterlayer'),
                            'type'       => Controls_Manager::URL,
                            'dynamic'    => [ 'active'        => true, ],
                            'placeholder'       => 'https://www.your-link.com',
                            'default'           => [ 'url' => '#', ],
                            'label_block'      => false,
                        ]
                    );

                    $repeater->end_controls_tab();
                $repeater->end_controls_tabs();

            $this->add_control(
                'teams',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'name'  => __( 'Member #1', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Member #2', 'masterlayer' ),
                        ],
                        [
                            'name'  => __( 'Member #3', 'masterlayer' ),
                        ],
                    ],
                    'title_field' => '{{{ name }}}',
                ]
            );

            $this->end_controls_section();

        // Carousel settings
            $this->start_controls_section( 'setting_carousel_section',
                [
                    'label' => __( 'Carousel', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_responsive_control(
                'column',
                [
                    'label' => __( 'Column', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 10,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'gap',
                [
                    'label' => __( 'Gap', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'stretch',
                [
                    'label'     => __( 'Stretch View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'        => __( 'No', 'masterlayer'),
                        'stretch-right'     => __( 'Stretch Right', 'masterlayer'),
                        'stretch-both'      => __( 'Full Width', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'outViewOpacity',
                [
                    'label'     => __( 'Outview Opacity', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 0.7,
                    'min'     => 0,
                    'max'     => 1,
                    'step'    => 0.1,
                    'condition'             => [
                        'stretch!'   => 'no',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box .item-carousel.is-selected' => 'opacity: 1;',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel' => 'opacity: {{VALUE}};',
                        '{{WRAPPER}} .master-carousel-box:hover .item-carousel.is-selected' => 'opacity: 1;',
                    ],
                ]
            );

            $this->add_control(
                'autoPlay',
                [
                    'label'        => __( 'Auto Play', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'true',
                ]
            );

            $this->add_control(
                'prevNextButtons',
                [
                    'label'        => __( 'Show Arrows?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'separator'    => 'before'
                ]
            );

            $this->add_control(
                'arrowPosition',
                [
                    'label'     => __( 'Arrows Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'middle',
                    'options'   => [
                        'top'        => __( 'Top', 'masterlayer'),
                        'middle'     => __( 'Middle', 'masterlayer'),
                        'bottom'     => __( 'Bottom', 'masterlayer'),
                    ],
                    'condition' => [
                         'prevNextButtons' => 'true'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowMiddleOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button.previous' => 'left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .flickity-prev-next-button.next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'middle'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowTopOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'top'
                    ]
                ]
            );

            $this->add_responsive_control(
                'arrowBottomOffset',
                [
                    'label' => __( 'Arrows Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .flickity-prev-next-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'prevNextButtons' => 'true', 'arrowPosition' => 'bottom'
                    ]
                ]
            );

            $this->add_control(
                'pageDots',
                [
                    'label'        => __( 'Show Bullets?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false',
                    'separator'    => 'before'
                ]
            );

            $this->add_responsive_control(
                'dotOffset',
                [
                    'label' => __( 'Bullets Offset', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'render_type' => 'template',
                    'condition' => [ 'pageDots' => 'true' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-carousel-box' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'activeIndex',
                [
                    'label' => __( 'Active Index', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                    'separator' => 'before'
                ]
            ); 

            $this->end_controls_section();

        // STYLE TAB - General
            $this->start_controls_section( 'style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            // $this->add_control(
            //     'style',
            //     [
            //         'label'     => __( 'Style', 'masterlayer'),
            //         'type'      => Controls_Manager::SELECT,
            //         'default'   => 'style-1',
            //         'options'   => [
            //             'style-1'      => __( 'Style 1', 'masterlayer'),
            //             'style-2'      => __( 'Style 2', 'masterlayer'),
            //             'style-3'      => __( 'Style 3', 'masterlayer')
            //         ],
            //         'prefix_class' => 'team-',
            //         'render_type' => 'template'
            //     ]
            // );

            $this->end_controls_section();

        // STYLE TAB - Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'box' );
                

            // Normal
                $this->start_controls_tab(
                    'box_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'name_color',
                    [
                        'label' => __( 'Name', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-team .team-name' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'role_color',
                    [
                        'label' => __( 'Role', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-team .team-role' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'socials_color',
                    [
                        'label' => __( 'Socials Icon', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-team .socials-wrap a' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();

            // Active
                $this->start_controls_tab(
                    'box_active',
                    [
                        'label' => __( 'Active', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'name_color_active',
                    [
                        'label' => __( 'Name', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-team.active .team-name' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'role_color_active',
                    [
                        'label' => __( 'Role', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-team.active .team-role' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'socials_color_active',
                    [
                        'label' => __( 'Socials Icon', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-team.active .socials-wrap a' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_section();

        // Border & Shadow
            $this->start_controls_section( 'style_border_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-team',
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
                        '{{WRAPPER}} .master-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selector' => '{{WRAPPER}} .master-team',
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

            $this->add_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}}.team-style-1 .master-team .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}}.team-style-2 .master-team .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}}.team-style-3 .master-team .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'name_spacing',
                [
                    'label'      => __( 'Team Name', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team .team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'role_spacing',
                [
                    'label'      => __( 'Team Role', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team .team-role' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'socials_icon_spacing',
                [
                    'label'      => __( 'Socials Icon', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team .socials-wrap a' => 'margin: 0 {{SIZE}}{{UNIT}};'
                    ],
                    50
                ]
            );

            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'name_typography',
                    'label' => __('Team Name', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .team-name'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'role_typography',
                    'label' => __('Team Role', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .team-role'
                ]
            );

            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $teams = $this->get_settings_for_display( 'teams' );

        $cls .=  'mlr-' . rand();

        // Data config for carousel
        if ( isset($settings['column']) )
            $config['column'] = $settings['column']['size'];
        if ( isset($settings['column_tablet']) )
            $config['columnTablet'] = $settings['column_tablet']['size'];
        if ( isset($settings['column_mobile']) )
            $config['columnMobile'] = $settings['column_mobile']['size'];
        if ( isset($settings['column_widescreen']) )
            $config['columnWidescreen'] = $settings['column_widescreen']['size'];
        if ( isset($settings['column_tablet_extra']) )
            $config['columnTabletExtra'] = $settings['column_tablet_extra']['size'];
        if ( isset($settings['column_mobile_extra']) )
            $config['columnMobileExtra'] = $settings['column_mobile_extra']['size'];
        if ( isset($settings['column_laptop']) )
            $config['columnLaptop'] = $settings['column_laptop']['size'];
        if ( isset($settings['gap']) )
            $config['gap'] = $settings['gap']['size'];
        if ( isset($settings['gap_tablet']) )
            $config['gapTablet'] = $settings['gap_tablet']['size'];
        if ( isset($settings['gap_mobile']) )
            $config['gapMobile'] = $settings['gap_mobile']['size'];
        if ( isset($settings['gap_widescreen']) )
            $config['gapWidescreen'] = $settings['gap_widescreen']['size'];
        if ( isset($settings['gap_tablet_extra']) )
            $config['gapTabletWxtra'] = $settings['gap_tablet_extra']['size'];
        if ( isset($settings['gap_mobile_extra']) )
            $config['gapMobileExtra'] = $settings['gap_mobile_extra']['size'];
        if ( isset($settings['gap_laptop']) )
            $config['gapLaptop'] = $settings['gap_laptop']['size'];
        $config['arrowPosition'] = $settings['arrowPosition'];
        $config['arrowMiddleOffset'] = $settings['arrowMiddleOffset'];
        $config['arrowTopOffset'] = $settings['arrowTopOffset'];
        
        $config['stretch'] = $settings['stretch'];
        $config['autoPlay'] = $settings['autoPlay'] == 'true' ? true : false;
        $config['prevNextButtons'] = $settings['prevNextButtons'] == 'true' ? true : false;
        $config['pageDots'] = $settings['pageDots'] == 'true' ? true : false;
        $config['activeIndex'] = $settings['activeIndex'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-carousel-box <?php echo esc_attr( $cls ); ?>" <?php echo $data; ?>>
            <?php
            foreach ( $teams as $index => $item ) { 
                $html = $name = $role = $desc = $avatar = $icon = $url = "";
                $socials = "";

                $socials_html = $this->render_socials($item);
                if ($socials_html)
                    $socials = '<div class="socials"><span class="btn"></span><div class="socials-wrap">' . $socials_html . '</div></div>';

                
                // Name
                if ($item['name'])
                    $name = sprintf('<h3 class="team-name"><a href="%2$s">%1$s</a></h3>', 
                        $item['name'],
                        esc_url( $item['url']['url'] ) );

                // Role
                if ($item['role'])
                    $role = sprintf('<span class="team-role">%1$s</span>', 
                        $item['role']);

                // Avatar
                if ( $item['avatar']['id'] ) {
                    $avatar = sprintf('<div class="avatar"><a class="thumb" aria-label="avatar" href="%2$s"><span class="inner">%1$s</span></a></div>', 
                        wp_get_attachment_image( $item['avatar']['id'], 'full' ),
                        esc_url($item['url']['url'])
                    );
                } else {
                    $avatar = sprintf('<div class="avatar"><a aria-label="avatar" href="%2$s"><img alt="Image" src="%1$s" ></a></div>', 
                        esc_url( $item['avatar']['url'] ),
                        esc_url($item['url']['url'])
                    );
                }
            
                // HTML render

                ?>
                <div class="master-team item-carousel">
                    <div class="inner">
                        <div class="image-wrap">
                            <?php 
                                echo $avatar; 
                                
                            ?>
                        </div>

                        <div class="content-wrap">
                            <?php echo $socials; ?>
                            <div class="name-role-info">
                                <?php 
                                    echo $name;
                                    echo $role;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
    }

    protected function render_socials( $item ) {
        $socials = "";
        ob_start(); 
        if ($item['social_url1']['url']) {
            echo '<a aria-label="icon" href="' . esc_url($item['social_url1']['url']) . '">';
            Icons_Manager::render_icon( $item['social_icon1'], [ 'aria-hidden' => 'true' ] );
            echo '</a>';
        }

        if ($item['social_url2']['url']) {
            echo '<a aria-label="icon" href="' . esc_url($item['social_url2']['url']) . '">';
            Icons_Manager::render_icon( $item['social_icon2'], [ 'aria-hidden' => 'true' ] );
            echo '</a>';
        }

        if ($item['social_url3']['url']) {
            echo '<a aria-label="icon" href="' . esc_url($item['social_url3']['url']) . '">';
            Icons_Manager::render_icon( $item['social_icon3'], [ 'aria-hidden' => 'true' ] );
            echo '</a>';
        }

        if ($item['social_url4']['url']) {
            echo '<a aria-label="icon" href="' . esc_url($item['social_url4']['url']) . '">';
            Icons_Manager::render_icon( $item['social_icon4'], [ 'aria-hidden' => 'true' ] );
            echo '</a>';
        }
        $socials = ob_get_clean();
        return $socials;
    }
}

