<?php
/*
Widget Name: Post Tags
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
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

class MAE_Post_Tags_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-post-tags';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Post Tags', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-tags';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
        // Content  
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'masterlayer' )
            ]
        );

        $this->add_control(
            'prefix_text',
            [
                'label'     => __( 'Text', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'default' => __('Tags', 'masterlayer')
            ]
        );

        $this->end_controls_section();

        // Style  
        $this->start_controls_section(
            'section__style_general',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
            'title_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tag-text' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tag_color',
            [
                'label' => __( 'Tags Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post-tags a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tag_hover',
            [
                'label' => __( 'Tags Hover Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post-tags a:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tag_bg',
            [
                'label' => __( 'Tags Background', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post-tags a' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tag_bg_hover',
            [
                'label' => __( 'Tags Hover Background', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .post-tags a:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => __('Text Typography', 'masterlayer'),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .tag-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'label' => __('Tags Typography', 'masterlayer'),
                'name' => 'tag_typography',
                'selector' => '{{WRAPPER}} .post-tags a',
            ]
        );

        $this->add_control(
            'tags_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-tags a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label' => __('Text Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tag-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tags_margin',
            [
                'label' => __('Tags Margin', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-tags a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
	}


	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( get_post_type() == 'elementor_library' ) {
            $text = $settings['prefix_text'];
            if ($text) {
                echo '<div class="post-tags"><div class="inner"><span class="tag-text">'. esc_html( $text ) . '</span><a href="#" rel="tag">' . 
                __('Branding', 'masterlayer') . '</a></span><a href="#" rel="tag">' . 
                __('Design', 'masterlayer') . '</a></div></div>';
            } else {
                echo '<div class="post-tags"><div class="inner"><a href="#" rel="tag">' . 
                __('Branding', 'masterlayer') . '</a></span><a href="#" rel="tag">' . 
                __('Design', 'masterlayer') . '</a></div></div>';
            }
        } else {
             $text = $settings['prefix_text'];
            if ($text) {
                the_tags( '<div class="post-tags"><div class="inner"><span class="tag-text">'. esc_html( $text ) . '</span>','','</div></div>' );
            } else {
                the_tags( '<div class="post-tags"><div class="inner">','','</div></div>' );
            }
        }
        ?>
	<?php }
}

