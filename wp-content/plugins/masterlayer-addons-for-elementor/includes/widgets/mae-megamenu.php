<?php
/*
Widget Name: Megamenu
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
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Plugin;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Megamenu_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-megamenu';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Mega Menu', 'masterlayer' );
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

            $this->add_control(
                'item_heading',
                [
                    'label' => __( 'Menu Items', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => ['sub_type!' => 'none']
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'main_text',
                [
                    'label' => __( 'Text', 'masterlayer' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Home #01', 'masterlayer' ),
                    'label_block' => true,
                ]
            );

            $repeater->add_control(
                'main_url',
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

            $repeater->add_control(
                'sub_heading',
                [
                    'label' => __( 'Sub-Menu Items', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => ['sub_type!' => 'none']
                ]
            );

            $repeater->add_control(
                'sub_type',
                [
                    'label'     => __( 'Sub Menu Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'               => __( 'None', 'masterlayer'),
                        'simple'             => __( 'Simple Dropdown', 'masterlayer'),
                        'html'               => __( 'Custom HTML', 'masterlayer'),
                        'template'           => __( 'Template Builder', 'masterlayer'),
                    ],
                ]
            );

            $repeater->add_control(
                'sub_col',
                [
                    'label'     => __( 'Column', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'         => __( 'Default', 'masterlayer'),
                        '3'               => __( '3', 'masterlayer'),
                        '4'               => __( '4', 'masterlayer'),
                        '5'               => __( '5', 'masterlayer'),
                    ],
                    'condition' => ['sub_type' => 'simple']
                ]
            );

            $repeater->add_control(
                'sub_template',
                [
                    'label'     => __( 'Choose Templates', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '',
                    'options'   => mae_get_templates(),
                    'condition' => [ 'sub_type' => 'template' ]
                ]
            );

            $repeater->add_control(
                'sub_html',
                [
                    'label' => __( 'HTML', 'masterlayer' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Enter your HTML', 'masterlayer' ),
                    'label_block' => true,
                    'condition' => [ 'sub_type' => 'html' ]
                ]
            );

            // Sub menu
                $repeater->add_control(
                    'sub_heading1',
                    [
                        'label' => __( 'Menu Item 1', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text1',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Page #01', 'masterlayer' ),
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url1',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading2',
                    [
                        'label' => __( 'Menu Item 2', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text2',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Page #02', 'masterlayer' ),
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url2',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading3',
                    [
                        'label' => __( 'Menu Item 3', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text3',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Page #03', 'masterlayer' ),
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url3',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading4',
                    [
                        'label' => __( 'Menu Item 4', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text4',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url4',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading5',
                    [
                        'label' => __( 'Menu Item 5', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text5',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url5',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading6',
                    [
                        'label' => __( 'Menu Item 6', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text6',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url6',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading7',
                    [
                        'label' => __( 'Menu Item 7', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text7',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url7',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading8',
                    [
                        'label' => __( 'Menu Item 8', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text8',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url8',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading9',
                    [
                        'label' => __( 'Menu Item 9', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text9',
                    [
                        'label' => __( 'Text ', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url9',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  

                $repeater->add_control(
                    'sub_heading10',
                    [
                        'label' => __( 'Menu Item 10', 'masterlayer' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'after',
                        'condition' => ['sub_type' => 'simple']
                    ]
                );

                $repeater->add_control(
                    'sub_text10',
                    [
                        'label' => __( 'Text', 'masterlayer' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'condition' => ['sub_type' => 'simple']
                    ]  
                );

                $repeater->add_control(
                    'sub_url10',
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
                        'condition' => ['sub_type' => 'simple']
                    ]
                );  


            $this->add_control(
                'menu',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'main_text'  => __( 'Home', 'masterlayer' ),
                            'sub_type'   => 'simple',
                        ],
                        [
                            'main_text'  => __( 'Pages', 'masterlayer' )
                        ],
                        [
                            'main_text'  => __( 'Contact', 'masterlayer' )
                        ],
                        [
                            'main_text'  => __( 'About Us', 'masterlayer' )
                        ]
                    ],
                    'title_field' => '{{{ main_text }}}'
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
        $menu = $this->get_settings_for_display('menu'); 
        ?>
        <div class="agrios-menu-wrap">
            <nav class="agrios-menu">
                <ul class="menu">
                    <?php foreach ($menu as $index => $nav) {
                        $cls = '';
                        if ( $nav['sub_type'] !== 'none' ) $cls .= 'menu-item-has-children';
                        if ( $nav['sub_type'] == 'html' ) $cls .= ' custom-megamenu';
                        if ( $nav['sub_type'] == 'template' ) $cls .= ' custom-megamenu';
                        if ( $nav['sub_col'] !== 'default' ) $cls .= ' megamenu col-' . $nav['sub_col'];

                        ?>
                        <li class="menu-item <?php echo esc_attr($cls); ?>">
                            <a href="<?php echo esc_url($nav['main_url']['url']); ?>"><span><?php echo $nav['main_text']; ?></span></a>
                            <?php
                            switch ($nav['sub_type']) {
                                case 'simple': ?>
                                    <ul class="sub-menu">
                                        <?php if ( $nav['sub_text1'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url1']['url']); ?>"><span><?php echo $nav['sub_text1']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text2'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url2']['url']); ?>"><span><?php echo $nav['sub_text2']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text3'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url3']['url']); ?>"><span><?php echo $nav['sub_text3']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text4'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url4']['url']); ?>"><span><?php echo $nav['sub_text4']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text5'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url5']['url']); ?>"><span><?php echo $nav['sub_text5']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text6'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url6']['url']); ?>"><span><?php echo $nav['sub_text6']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text7'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url7']['url']); ?>"><span><?php echo $nav['sub_text7']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text8'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url8']['url']); ?>"><span><?php echo $nav['sub_text8']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text9'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url9']['url']); ?>"><span><?php echo $nav['sub_text9']; ?></span></a>
                                            </li>
                                        <?php } ?>

                                        <?php if ( $nav['sub_text10'] ) { ?>
                                            <li class="menu-item">
                                                <a href="<?php echo esc_url($nav['sub_url10']['url']); ?>"><span><?php echo $nav['sub_text10']; ?></span></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <?php break;

                                case 'template': ?>
                                    <div class="sub-menu">
                                        <?php if (!empty($nav['sub_template'])) {
                                            echo Plugin::$instance->frontend->get_builder_content($nav['sub_template'], true);
                                        }  ?>
                                    </div>
                                    <?php break;
                                case 'html':  ?>
                                    <div class="sub-menu">
                                        <?php echo $nav['sub_html']; ?>
                                    </div>
                                    <?php break;
                                default:
                                    # code...
                                    break;
                            }
                            ?>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <?php
    }
}

