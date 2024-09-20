<?php
/*
Widget Name: Demo Box
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Demo_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-demo-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Demo Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {

        $this->start_controls_section( 'section_content',
            [
                'label' => __( 'Demo Box', 'masterlayer' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => __( 'Title', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Homepage Main', 'masterlayer' ),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true
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
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
            ],
        );

        $this->end_controls_section();

        $this->start_controls_section( 'section_style',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .master-demo-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_heading',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::HEADING,
                'separator' => 'after'
            ],
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => __( 'Height', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 770,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-demo-box .image-wrap' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .master-demo-box:hover .image-wrap img' => 'transform: translateY( calc(-100% + {{SIZE}}{{UNIT}}) );',
                ],
                50
            ]
        );

        $this->add_responsive_control(
            'image_bottom_spacing',
            [
                'label'      => __( 'Bottom Spacing', 'masterlayer' ),
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
                    'size' => 22,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-demo-box .image-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Border', 'masterlayer' ),
                'selector' => '{{WRAPPER}} .master-demo-box .image-wrap',
            ]
        );

        $this->add_control(
            'image_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-demo-box .image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'selector' => '{{WRAPPER}} .master-demo-box .image-wrap',
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'   => __( 'Title', 'masterlayer' ),
                'type'    => Controls_Manager::HEADING,
                'separator' => 'after'
            ],
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'headline_typography',
                'label' => __('Title', 'masterlayer'),
                'selector' => '{{WRAPPER}} master-demo-box .headline-2'
            ],
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} master-demo-box .headline-2' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Color Hover', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} master-demo-box .headline-2:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="master-demo-box">
            <div class="image-wrap">
                <?php 
                echo '<a href="' .  esc_url( $settings['url']['url'] ) . '">';
                if ( $settings['image'] ) {
                    if ( $settings['image']['url'] )
                        echo '<img alt="Demo" src="' . esc_url( $settings['image']['url'] ) . '" />';
                }
                echo '</a>';
                ?>
            </div>

            <h3 class="headline-2">
                <?php 
                echo '<a href="' .  esc_url( $settings['url']['url'] ) . '">';
                echo $settings['title']; 
                echo '</a>';
                ?>     
            </h3>
        </div>
        <?php
    }

    protected function content_template() {}
}

