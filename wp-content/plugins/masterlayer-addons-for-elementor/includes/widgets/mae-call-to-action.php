<?php
/*
Widget Name: Call To ACtion
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
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_CTA_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-cta';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Call To ACtion', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-cta';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
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
                        'prefix_class' => 'item-align-%s'
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
                        'prefix_class' => 'item-align-%s'
                    ]
                );
            }

            $this->add_control(
                'image',
                [
                    'label' => __( 'Choose Image', 'masterlayer' ),
                    'type' => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'ci-phone-call',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                ]
            );

            $this->add_control(
                'text',
                [
                    'label'     => __( 'Text', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ],
                    'default'   => __( 'Call Anytime', 'masterlayer'),
                ]
            );

            $this->add_control(
                'phone',
                [
                    'label'     => __( 'Phone', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ],
                    'default'   => __( '92 666 888 0000', 'masterlayer'),
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
                    'placeholder'       => 'tel:555-555-5555',
                    'default'           => [
                        'url' => 'tel:555-555-5555',
                    ],
                ]
            );        

            $this->end_controls_section();

        // Style - General
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'content_rounded',
                [
                    'label' => __('Content Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->end_controls_section();

        // Style - Icon
            $this->start_controls_section( 'setting_icon_section',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'icon_shake',
                [
                    'label' => __( 'Icon Shake', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'hover',
                    'options' => [
                        'none'   => __( 'none', 'masterlayer' ),
                        'hover'  => __( 'Hover', 'masterlayer' ),
                        'always'  => __( 'Always', 'masterlayer' ),
                    ],
                    'prefix_class' => 'shake-'
                ]
            );

            $this->add_control(
                'icon_view',
                [
                    'label' => __( 'Icon View', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'has-bg',
                    'options' => [
                        'default'    => __( 'Default', 'masterlayer' ),
                        'has-bg'  => __( 'Has Background', 'masterlayer' ),
                    ],
                    'prefix_class' => 'icon-'
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Icon Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .icon svg' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_bg_size',
                [
                    'label' => __( 'Icon Background Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .icon' => 'width: {{SIZE}}{{UNIT}};
                         height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'icon_view' => 'has-bg']
                ]
            );

            $this->add_control(
                'icon_rounded',
                [
                    'label' => __('Icon Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-cta .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'icon_border',
                    'label' => esc_html__( 'Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}}  .master-cta .icon',
                    'condition' => [ 'icon_view' => 'has-bg']
                ]
            );

            $this->end_controls_section();

        // Style - Color
            $this->start_controls_section( 'setting_general_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'tabs_color' );
            $this->start_controls_tab(
                'tab_color_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'background_color',
                [
                    'label' => __( 'Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .content-wrap' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_bg',
                [
                    'label' => __( 'Icon Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .icon' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 'icon_view' => 'has-bg']
                ]
            );

            $this->add_control(
                'text_color',
                [
                    'label' => __( 'Text', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .text' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'text!' => '']
                ]
            );

            $this->add_control(
                'phone_color',
                [
                    'label' => __( 'Phone Text', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .phone' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'phone!' => '']
                ]
            );

            $this->end_controls_tab();
            $this->start_controls_tab(
                'tab_color_hover',
                [
                    'label' => __( 'Hover', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'background_color_hover',
                [
                    'label' => __( 'Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .master-cta:hover .content-wrap' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_color_hover',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .master-cta:hover .icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_bg_hover',
                [
                    'label' => __( 'Icon Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .master-cta:hover .icon' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 'icon_view' => 'has-bg']
                ]
            );

            $this->add_control(
                'text_color_hover',
                [
                    'label' => __( 'Text', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}}  .master-cta:hover .text' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'text!' => '']
                ]
            );

            $this->add_control(
                'phone_color_hover',
                [
                    'label' => __( 'Phone Text', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}}  .master-cta:hover .phone' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'phone!' => '']
                ]
            );

            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();

        // Style - Spacing
            $this->start_controls_section( 'setting_general_spacing',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'icon_spacing',
                    [
                        'label'      => __( 'Icon Spacing', 'masterlayer' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                        ],
                        50,
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'icon_spacing',
                    [
                        'label'      => __( 'Icon Spacing', 'masterlayer' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                        ],
                        50,
                    ]
                );
            }

            $this->add_responsive_control(
                'text_spacing',
                [
                    'label'      => __( 'Text Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'text!' => '']
                ]
            );

            $this->end_controls_section();

        // Style - Typography
            $this->start_controls_section( 'setting_general_typo',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => __( 'Text', 'masterlayer' ),
                    'name' => 'text_typography',
                    'selector' => '{{WRAPPER}} .text',
                    'condition' => [ 'text!' => '' ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [   
                    'label' => __( 'Phone', 'masterlayer' ),
                    'name' => 'phone_typography',
                    'selector' => '{{WRAPPER}} .phone',
                    'condition' => [ 'phone!' => '' ]
                ]
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $url_attr = "";
        if ( $settings['url']['url'] ) {
            if ( $settings['url']["is_external"] ) {
                $url_attr .= "target=_blank ";
            }

            if ( ! empty( $settings['url']["nofollow"] ) ) {
                $url_attr .= "rel=nofollow ";
            }
        }
        ?>

        <a class="master-cta" href="<?php echo esc_url($settings['url']['url']); ?>" <?php echo esc_attr($url_attr); ?>>
            <?php if ( $settings['image']['id'] ) {
                echo '<span class="image-wrap">' . wp_get_attachment_image( $settings['image']['id'], 'full' ) . '</span>';
            } ?>
            <span class="content-wrap">
                <span class="icon"><?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                <span class="texts">
                    <?php if ($settings['text']) echo '<span class="text">' . $settings['text'] . '</span>'; ?>
                    <?php if ($settings['phone']) echo '<span class="phone">' . $settings['phone'] . '</span>'; ?>
                </span>
            </span>
        </a>

        <?php
    }

    protected function content_template() {}
}

