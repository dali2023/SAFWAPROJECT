<?php
/*
Widget Name: Link
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Link_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-link';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Link', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-link';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {

        //Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Link', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'link_text',
                [
                    'label'     => __( 'URL Text', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ],
                    'default'   => __( 'Learn More', 'masterlayer'),
                ]
            );

            $this->add_control(
                'link_url',
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
                ]
            );

            if ( is_rtl() ) {
                $this->add_control(
                    'link_icon_position',
                    [
                        'label'     => __( 'Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Right', 'masterlayer'),
                            'right'     => __( 'Icon Left', 'masterlayer')
                        ],
                    ]
                );
            } else {
                $this->add_control(
                    'link_icon_position',
                    [
                        'label'     => __( 'Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Left', 'masterlayer'),
                            'right'     => __( 'Icon Right', 'masterlayer')
                        ],
                    ]
                );
            }
            

            $this->add_control(
                'link_icon',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow2',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [
                        'link_icon_position!' => 'none'
                    ]
                ]
            );

            $this->add_control(
                'link_underline',
                [
                    'label'     => __( 'Underline ?', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'        => __( 'No', 'masterlayer'),
                        'yes'       => __( 'Yes', 'masterlayer'),
                        'hover'     => __( 'On Hover', 'masterlayer'),
                    ],
                    'prefix_class' => 'line-'
                ]
            );

            $this->end_controls_section();

        // Style 
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
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

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'link_typography',
                    'selector' => '{{WRAPPER}} .master-link',
                ]
            );

            $this->add_responsive_control(
                'link_font_size',
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
                        '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [
                        'link_icon_position!' => 'none'
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
                        '{{WRAPPER}} .master-link .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'link_icon_position!' => 'none'
                    ]
                ]
            );

            $this->start_controls_tabs( 'link_hover_tabs' );

            // Normal
                $this->start_controls_tab(
                    'link_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
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
                            'link_icon_position!' => 'none'
                        ]
                    ]
                );

                $this->add_control(
                    'link_underline_color',
                    [
                        'label' => __( 'Underline Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-link:after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'link_underline!' => 'no'
                        ]
                    ]
                );

                $this->end_controls_tab();

            //Hover
                $this->start_controls_tab(
                    'link_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'link_color_hover',
                    [
                        'label' => __( 'Text Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'link_icon_color_hover',
                    [
                        'label' => __( 'Icon Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'link_icon_position!' => 'none'
                        ]
                    ]
                );

                $this->add_control(
                    'link_underline_color_hover',
                    [
                        'label' => __( 'Underline Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-link:hover:after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'link_underline!' => 'no'
                        ]
                    ]
                );

                $this->end_controls_tab();

                $this->end_controls_tabs();

            $this->end_controls_section();

    }

    protected function render() {
        $link = $this->get_settings_for_display();

        $cls = $url_attr = "";
        $cls .= ' icon-' . $link['link_icon_position'];

        if ( $link['link_url']["is_external"] ) {
            $url_attr .= 'target="_blank" ';
        }

        if ( ! empty( $link['link_url']["nofollow"] ) ) {
            $url_attr .= 'rel="nofollow" ';
        }

        $link_icon = '';
        if ($link['link_icon'])  {
            $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
        }
        ?>

        <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($link['link_url']['url']); ?>" <?php echo esc_attr($url_attr); ?>>
            <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
            <span><?php echo $link['link_text']; ?></span>
            <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
        </a>

        <?php
    }

    protected function content_template() {}
}

