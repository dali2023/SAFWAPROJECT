<?php
/*
Widget Name: Project Detail
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

class MAE_Project_Detail_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-project-detail';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Project Detail', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-table-of-contents';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
        
        // Content Accordion 
        $this->start_controls_section(
            'section__content',
            [
                'label' => __( 'Information', 'masterlayer' ),
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

        $rp = new Repeater();

        $rp->add_control(
            'info_title',
            [
                'label' => __( 'Title', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Services:', 'masterlayer' ),
                'placeholder' => __( 'Title', 'masterlayer' ),
                'label_block' => true,
            ]
        );

        $rp->add_control(
            'info_detail',
            [
                'label' => __( 'Detail', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Easy Harvesting', 'masterlayer' ),
                'placeholder' => __( 'Detail', 'masterlayer' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'infos',
            [
                'label' => __( 'Items', 'masterlayer' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $rp->get_controls(),
                'default' => [
                    [
                        'info_title' => __( 'Services:', 'masterlayer' ),
                        'info_detail' => __( 'Easy Harvesting', 'masterlayer' ),
                    ],
                    [
                        'info_title' => __( 'Farmer:', 'masterlayer' ),
                        'info_detail' => __( 'Mike Hardson', 'masterlayer' ),
                    ],
                    [
                        'info_title' => __( 'Duration:', 'masterlayer' ),
                        'info_detail' => __( '4.5 Months', 'masterlayer' ),
                    ],
                    [
                        'info_title' => __( 'Location:', 'masterlayer' ),
                        'info_detail' => __( 'Broklyn, New York', 'masterlayer' ),
                    ],
                ],
                'title_field' => '{{{ info_title }}}',
            ]
        );

        $repeater = new Repeater();

            $repeater->add_control(
                'icon_font',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-twitter',
                        'library' => 'core',
                    ]
                ]
            );

            $repeater->add_control(
                'link',
                [
                    'label' => __( 'Link', 'masterlayer' ),
                    'type' => Controls_Manager::URL,
                    'label_block' => true,
                    'label_block' => true,
                    'placeholder' => 'https://www.your-link.com',
                        'default'  => [
                            'url' => '#',
                        ]
                ]
            );
        

            $this->add_control(
                'icons',
                [
                    'label' => __( 'Social Icons', 'masterlayer' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [   
                            'icon_font' => [
                                'value' => 'ci-twitter',
                                'library' => 'core',
                            ],
                        ],
                        [
                            'icon_font' => [
                                'value' => 'ci-facebook-square',
                                'library' => 'core',
                            ],
                        ],
                        [
                            'icon_font' => [
                                'value' => 'ci-pinterest-p',
                                'library' => 'core',
                            ],
                        ],
                        [
                            'icon_font' => [
                                'value' => 'ci-instagram',
                                'library' => 'core',
                            ],
                        ],
                    ],
                    'title_field' => '{{{ elementor.helpers.renderIcon( this, icon_font, { "aria-hidden": true }, "i", "panel" ) }}}',
                ]
            );

            $this->end_controls_section();


        $this->end_controls_section();

        // Style  
        $this->start_controls_section(
                'section__style_info',
                [
                    'label' => __( 'Project Information', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'general_heading',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'decor_color',
                [
                    'label' => __( 'Decorating Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .project-info:before' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_spacing',
                [
                    'label'      => __( 'Items Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .project-info .info' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_control(
                'title_heading',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .project-info .title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => 
                        '{{WRAPPER}} .project-info .title',
                ]
            );

            $this->add_control(
                'info_heading',
                [
                    'label' => __( 'Information', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'info_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .project-info .info' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'info_typography',
                    'selector' => 
                        '{{WRAPPER}} .project-info .info',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
                'section__style_social',
                [
                    'label' => __( 'Social Icons', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'view',
                [
                    'label'     => __( 'View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'        => __( 'Default', 'masterlayer'),
                        'has-bg'         => __( 'Has Background', 'masterlayer'),
                    ],
                    'prefix_class' => 'icon-'
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Icon Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 14,
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} a' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'bg_size',
                [
                    'label' => __( 'Background Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'view' => 'has-bg' ]
                ]
            );

            $this->add_responsive_control(
                'icon_rounded',
                [
                    'label' => __( 'Rounded', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} a' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'view' => 'has-bg' ]
                ]
            );

            $this->add_responsive_control(
                'icon_spacing',
                [
                    'label' => __( 'Icon Spacing', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} a' => 'margin-left: calc({{SIZE}}{{UNIT}} / 2); margin-right: calc({{SIZE}}{{UNIT}} / 2);',
                    ],
                ]
            );

            $this->start_controls_tabs( 'tabs_icon' );
            // Normal
                $this->start_controls_tab(
                    'tab_icon_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'icon_color',
                    [
                        'label' => __( 'Icon Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} a' => 'color: {{VALUE}};',
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
                            '{{WRAPPER}} a' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} a',
                    ]
                );

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'tab_icon_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'icon_color_hover',
                    [
                        'label' => __( 'Icon Hover Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'icon_bg_hover',
                    [
                        'label' => __( 'Icon Background Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} a:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} a',
                    ]
                );

                $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->end_controls_section();
	}


	protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="project-info">
            <?php $i = 0; foreach ( $settings['infos'] as $item ) { ?>
                <span class="title"><?php echo $item['info_title']; ?></span>
                <span class="info"><?php echo $item['info_detail']; ?></span>
            <?php } ?>

            <div class="master-social-icons">
                <?php $i = 1; foreach ( $settings['icons'] as $icon ) { 
                    $url_attr = "";
                    if ( $icon['link']["is_external"] ) {
                        $url_attr .= "target=_blank ";
                    }

                    if ( ! empty( $icon['link']["nofollow"] ) ) {
                        $url_attr .= "rel=nofollow ";
                    }
                    ?>
                    <a href="<?php echo esc_url($icon['link']['url']) ?>" aria-label="icon" <?php echo esc_attr($url_attr); ?>>
                        <?php Icons_Manager::render_icon( $icon['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
                <?php $i++; } ?>
            </div>
        </div>
	<?php }
}

