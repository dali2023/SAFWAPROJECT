<?php
/*
Widget Name: Team Box
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
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
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Team_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'gsap', 'appear' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-team-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Team Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-user-circle-o';
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

            $this->start_controls_tabs( 'tabs_team' );
            $this->start_controls_tab( 'tab_team_image',[ 'label' => __( 'Avatar', 'masterlayer' ) ] );
                $this->add_control(
                    'avatar',
                    [
                        'label'   => __( 'Avatar', 'masterlayer' ),
                        'type'    => Controls_Manager::MEDIA,
                        'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                    ],
                );
            $this->end_controls_tab();

            $this->start_controls_tab( 'tab_team_text',[ 'label' => __( 'Content', 'masterlayer' ) ] );
                $this->add_control(
                    'name',
                    [
                        'label'   => __( 'Name', 'masterlayer' ),
                        'type'    => Controls_Manager::TEXT,
                        'default' => __( 'Mike Hardson', 'masterlayer' ),
                        'dynamic' => [
                            'active' => true,
                        ],
                        'label_block' => true
                    ]
                );

                $this->add_control(
                    'position',
                    [
                        'label'   => __( 'Position', 'masterlayer' ),
                        'type'    => Controls_Manager::TEXT,
                        'default' => __( 'DAY CARE', 'masterlayer' ),
                        'dynamic' => [
                            'active' => true,
                        ],
                        'label_block' => true
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab( 'tab_team_social',[ 'label' => __( 'Socials', 'masterlayer' ) ] );
                $this->add_control(
                    'general_icon',
                    [
                        'label' => __( 'Social Icon', 'masterlayer' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'default' => [
                            'value' => 'fas fa-share-alt',
                            'library' => 'solid',
                        ],
                        'label_block'      => false,
                        'skin'             => 'inline',
                    ]
                );

                $this->add_control(
                    'socials_heading1',
                    [
                        'label'     => __( 'Social 1', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
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

                $this->add_control(
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

                $this->add_control(
                    'socials_heading2',
                    [
                        'label'     => __( 'Social 2', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
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

                $this->add_control(
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

                $this->add_control(
                    'socials_heading3',
                    [
                        'label'     => __( 'Social 3', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
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

                $this->add_control(
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

                $this->add_control(
                    'socials_heading4',
                    [
                        'label'     => __( 'Social 4', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'after'
                    ]
                );

                $this->add_control(
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

                $this->add_control(
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

            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();

        // Setting
            $this->start_controls_section( 'setting_toogle_section',
                [
                    'label' => __( 'Toogle', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'animFirst',
                [
                    'label'        => __( 'Animate First Item?', 'masterlayer' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'masterlayer' ),
                    'label_off'    => __( 'Off', 'masterlayer' ),
                    'return_value' => 'true',
                    'default'      => 'false'
                ]
            );

            $this->add_control(
                'angle',
                [
                    'label'     => __( 'Toogle Angle', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 140,
                    'step'    => 1
                ]
            );

            $this->add_control(
                'distance',
                [
                    'label'     => __( 'Toogle Distance', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 90,
                    'step'    => 1
                ]
            );

            $this->add_control(
                'delay',
                [
                    'label'     => __( 'Toogle Delay', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 0.08,
                    'step'    => 0.01
                ]
            );

            $this->end_controls_section();

        // Blob Decoration
            $this->start_controls_section( 'style_blob_section',
                [
                    'label' => __( 'Blob', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'blob',
                [
                    'label'     => __( 'Blob Decoration', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'          => __( 'None', 'masterlayer'),
                        'style-1'       => __( 'Style 1', 'masterlayer'),
                        'style-2'       => __( 'Style 2', 'masterlayer'),
                        'style-3'       => __( 'Style 3', 'masterlayer'),
                    ],
                ]
            );

            $this->add_control(
                'blob_color',
                [
                    'label' => __( 'Blob Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .svg-decor' => 'fill: {{VALUE}};',
                    ],
                    'condition' => ['blob!' => 'none']
                ]
            );

            $this->add_responsive_control(
                'blob_width',
                [
                    'label'      => __( 'Blob Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 500
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team .decor-wrap' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => ['blob!' => 'none']
                ]
            );

            $this->add_responsive_control(
                'blob_height',
                [
                    'label'      => __( 'Blob Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 500
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team .decor-wrap' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => ['blob!' => 'none']
                ]
            );

            $this->add_responsive_control(
                'blob_rotate',
                [
                    'label'      => __( 'Blob Rotate (deg)', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 500
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team svg' => 'transform: rotate({{SIZE}}deg);',
                    ],
                    50,
                    'condition' => ['blob!' => 'none']
                ]
            );

            $this->add_responsive_control(
                'blob_top_offset',
                [
                    'label'      => __( 'Blob Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 500
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-team svg' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => ['blob!' => 'none']
                ]
            );

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
                        '{{WRAPPER}} .master-team .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        if ( $settings['blob'] !== 'none' ) $cls .= 'has-decor';
        $html = $name = $position = $avatar = $blob = $socials = "";
        
        // Title
        if ($settings['name'])
            $name = sprintf('<h3 class="headline-2 team-name">%1$s</h3>', 
                $settings['name'] );

        // Position
        if ($settings['position'])
            $position = sprintf('<span class="team-role">%1$s</span>', 
                $settings['position'] );

        // Image URL
        if ($settings['avatar']['id']) {
            $avatar = sprintf('<div class="avatar">%1$s</div>', 
                wp_get_attachment_image( $settings['avatar']['id'], 'full' ) );
        } else {
            $avatar = sprintf('<div class="avatar"><img alt="Image" src="%1$s" ></div>', 
                esc_url( $settings['avatar']['url'] ) );
        }

        // Blob Decoration
        switch ($settings['blob']) {
            case 'style-1':
                $blob = '<div class="decor-wrap"><svg class="svg-decor blob-1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 98.6 97.1" style="enable-background:new 0 0 98.6 97.1;" xml:space="preserve">
                    <path class="p1" d="M42.5,8.7C20,33.5,0.2,31.6,0,53.5C-0.3,81.3,17.3,70,32,84.8c28.2,28.4,78.8,3.3,54.2-31.3c-8.6-12.2,1.3-30.7-4.6-41.5C73.9-2,54.5-4.6,42.5,8.7z"/>
                    <path class="p2" d="M80.9,28.7C68.2-4.4,32.4-0.3,19.2,14.4C14.4,19.7,8.6,29,10.4,39.6l0,0c0.3,2,1,4,1.9,6.1c5.9,15-7.4,10.3-5.7,27C7.5,81,16.4,89.3,28,84.5c24.1-9.8,33.5,10.4,60.9-8c10.1-6.8,11.3-19.5,8-28.3C92.5,36.1,84.9,39.2,80.9,28.7z"/>
                    </svg></div>';
                break;
            case 'style-2':
                $blob = '<div class="decor-wrap"><svg class="svg-decor blob-2" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 98.6 97.1" style="enable-background:new 0 0 98.6 97.1;" xml:space="preserve">
                    <path class="p1" d="M21.8,16.8C13.2,23.9,8.6,31,6.9,40.4c-0.6,23,2.7,34.7,16.3,40.8c9.7,4.6,58.4,18.2,58.8-4.1C80.9,55,92.3,54.9,92.3,42.5C89.6-1.2,33.8,3.5,21.8,16.8z"/>
                    <path class="p2" d="M86.5,16.7c-12.7-33.1-35.8-7.4-46.2,9c-4.8,5.3-16.2-7.4-26.1-3.4l-2.9,1.2C9.7,24-2.5,32.7,1.3,45.4c5.9,15,20.6,14.4,22.3,31.1c0.9,8.3,13,19.9,24.6,15.1c7.3-2.5,16.7-16.1,22.7-17.2c21.3-4.7,33.3-11.5,16.8-27.8C77.3,36,90.5,27.2,86.5,16.7z"/>
                    </svg></div>';
                break;
            case 'style-3':
                $blob = '<div class="decor-wrap"><svg class="svg-decor blob-3" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 98.6 97.1" style="enable-background:new 0 0 98.6 97.1;" xml:space="preserve">
                    <path class="p1" d="M16.8,16.1c-8.6,7.1-16.7,17.8-16,27.7C0,56.9,3.5,66.3,13.7,70.1C55,74.7,39.7,93.7,65,92.8c24.9-4.3,26.2-29.9,26.2-42.3C88.5,6.8,39.7-0.9,16.8,16.1z"/>
                    <path class="p2" d="M78.1,24.2C66.5,1.4,47.1,1.6,31.8,6.7c-6.6,3.6-17.8,7.7-20,22.1l-0.5,6.4c0,5.5,0.2,4.4,4,17c1.9,7.4-13.2,13-6.7,26.5c8,10.2,15.9,8.6,27.5,3.8c7.3-2.5,24.9,3.5,30.9,2.4c24.4-1.6,38.4-23.2,25.2-42.8C82,31.4,82.1,34.7,78.1,24.2z"/>
                    </svg></div>';
                break;
            default:
                $blob = '';
                break;
        }

        // Socials
        $socials = $this->render_socials();

        $config['angle'] = $settings['angle'];
        $config['distance'] = $settings['distance'];
        $config['delay'] = $settings['delay'];
        $config['first'] = $settings['animFirst'];
        $config['parentHover'] = '.master-team';

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        // HTML render
        ?>
        <div class="master-team <?php echo esc_attr($cls); ?>">
            <div class="avatar-wrap">
                <?php echo $blob; ?>
                <?php echo $avatar; ?>
                <div class="social-icons master-toogle-menu" <?php echo $data; ?>>
                    <?php echo $socials; ?>
                </div>
            </div>

            <div class="content-wrap">
                <?php echo $name; ?>
                <?php echo $position; ?>
            </div>
        </div>

        <?php
    }

    protected function render_socials() {
        $settings = $this->get_settings_for_display();
        $socials = "";
        ob_start(); 

        if ($settings['social_url1']['url']) {
            echo '<div class="menu-item"><a class="menu-item-button" aria-label="icon" href="' . esc_url($settings['social_url1']['url']) . '">';
            Icons_Manager::render_icon( $settings['social_icon1'], [ 'aria-hidden' => 'true' ] );
            echo '</a><div class="menu-item-bounce"></div></div>';
        }

        if ($settings['social_url2']['url']) {
            echo '<div class="menu-item"><a class="menu-item-button" aria-label="icon" href="' . esc_url($settings['social_url2']['url']) . '">';
            Icons_Manager::render_icon( $settings['social_icon2'], [ 'aria-hidden' => 'true' ] );
            echo '</a><div class="menu-item-bounce"></div></div>';
        }

        if ($settings['social_url3']['url']) {
            echo '<div class="menu-item"><a class="menu-item-button" aria-label="icon" href="' . esc_url($settings['social_url3']['url']) . '">';
            Icons_Manager::render_icon( $settings['social_icon3'], [ 'aria-hidden' => 'true' ] );
            echo '</a><div class="menu-item-bounce"></div></div>';
        }

        if ($settings['social_url4']['url']) {
            echo '<div class="menu-item"><a class="menu-item-button" aria-label="icon" href="' . esc_url($settings['social_url4']['url']) . '">';
            Icons_Manager::render_icon( $settings['social_icon4'], [ 'aria-hidden' => 'true' ] );
            echo '</a><div class="menu-item-bounce"></div></div>';
        }

        echo '<div class="menu-toggle-button">';
        Icons_Manager::render_icon( $settings['general_icon'], [ 'aria-hidden' => 'true' ] );
        echo '</div>';

        $socials = ob_get_clean();
        return $socials;
    }
}

